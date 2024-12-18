<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login');
    exit();
}

$uid = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT r.role FROM users u JOIN user_roles ur ON u.uid = ur.uid JOIN roles r ON ur.rid = r.rid WHERE u.uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['role'] == 'admin') {
    $stmt = $conn->prepare("SELECT o.*, u.username FROM orders o JOIN users u ON o.uid = u.uid");
} else {
    $stmt = $conn->prepare("SELECT * FROM orders WHERE uid = ?");
    $stmt->bind_param("i", $uid);
}
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<body>
    <?php include 'includes/navbar.php'; ?>

    <section>
        <div class="container mb-5">
            <h1 class="title is-3">Orders</h1>
            <div class="orders">
                <?php foreach ($orders as $order) : ?>
                    <div class="order mb-4">
                        <div>
                            <h1 class="title is-4">Order: #<?= $order['oid'] ?></h1>
                            <?php
                            switch ($order['state']) {
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
                            }
                            ?>
                        </div>
                        <p style="color: gray;"><?= $order['order_date'] ?></p>
                        <p>Total: $<?= $order['total'] ?></p>
                        <?php if ($user['role'] == 'admin'): ?>
                            <p>Order owner: <strong><?= $order['username'] ?></strong></p>
                        <?php endif; ?>
                        <a href="order?oid=<?= $order['oid'] ?>" class="button is-primary mt-2">View</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <script src="assets/js/darkMode.js"></script>
</body>

</html>