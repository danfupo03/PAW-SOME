<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';

$oid = isset($_GET['oid']) ? $_GET['oid'] : null;

$stmt = $conn->prepare("
    SELECT oi.oiid, oi.oid, oi.pid, p.name, p.image, p.description, p.price, oi.quantity, 
           oi.quantity * p.price AS total_price, u.username
    FROM order_items oi
    JOIN products p ON oi.pid = p.pid
    JOIN orders o ON oi.oid = o.oid
    JOIN users u ON o.uid = u.uid
    WHERE oi.oid = ?
");
$stmt->bind_param("i", $oid);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

$stmt = $conn->prepare("SELECT * FROM orders WHERE oid = ?");
$stmt->bind_param("i", $oid);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

$total = 0;
foreach ($products as $product) {
    $total += $product['total_price'];
}

$stmt = $conn->prepare("SELECT r.role FROM users u JOIN user_roles ur ON u.uid = ur.uid JOIN roles r ON ur.rid = r.rid WHERE u.uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $state = $_POST['state'];
    $message = $_POST['message'];

    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("UPDATE orders SET state = ?, message = ? WHERE oid = ?");
        $stmt->bind_param("ssi", $state, $message, $oid);
        $stmt->execute();

        $conn->commit();

        header('Location: orders');
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        throw $e;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<body>
    <?php include 'includes/navbar.php'; ?>
    <section>
        <form action="" method="POST">
            <div class="container">
                <div class="order-header">
                    <h2 class="title is-3">Order Details</h2>
                    <?php switch ($order['state']) {
                        case 'new':
                            echo '<span class="pill-info">New</span>';
                            break;
                        case 'in_progress':
                            echo '<span class="pill-warning">In Progress</span>';
                            break;
                        case 'rejected':
                            echo '<span class="pill-danger">Rejected</span>';
                            break;
                        case 'completed':
                            echo '<span class="pill-success">Completed</span>';
                            break;
                    } ?>
                </div>
                <?php if ($user['role'] == 'admin') : ?>
                    <h1 class="title is-5" style="color: #3498db;">Owner: <?= $products[0]['username'] ?></h1>
                <?php endif; ?>
                <?php if ($order['state'] == 'rejected'): ?>
                    <p class="content is-danger">Your order was rejected reason: <?= $order['message'] ?></p>
                <?php endif; ?>
                <?php foreach ($products as $product) : ?>
                    <div class="shopping-cart-content">
                        <img src="assets/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" />
                        <p><?= $product['name'] ?></p>
                        <p> Quantity: <?= $product['quantity'] ?> </p>
                        <p>Price: $<span><?= $product['price'] ?></span></p>
                        <p>Total Price: $<span><?= $product['total_price'] ?></span></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="container">
                <div class="content">
                    <hr>
                    <h2 class="title is-3">Order Summary</h2>
                    <p>Subtotal: $<span><?= $total ?></span></p>
                    <p>Taxes (19%): $<span><?= number_format($total * 0.19, 2) ?></span></p>
                    <p class="total-shop">Total Price: $<span><?= number_format($total + ($total * 0.19), 2) ?></span></p>

                </div>
                <?php if ($user['role'] == 'admin'): ?>
                    <form action="" method="POST">
                        <div class="order-form">
                            <select name="state" id="state" onchange="toggleMessageInput()">
                                <option value="new" <?= ($order['state'] == 'new') ? 'selected' : '' ?>>New</option>
                                <option value="in_progress" <?= ($order['state'] == 'in_progress') ? 'selected' : '' ?>>In Progress</option>
                                <option value="rejected" <?= ($order['state'] == 'rejected') ? 'selected' : '' ?>>Rejected</option>
                                <option value="completed" <?= ($order['state'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                            </select>
                            <input type="text" id="message-order" name="message" placeholder="Message" style="display: none;">
                            <button type="submit" class="button is-primary ml-2">Change Status</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </form>
    </section>
</body>
<script src="assets/js/darkMode.js"></script>
<script src="assets/js/order.js"></script>

</html>