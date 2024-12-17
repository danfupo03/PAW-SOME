<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';

$oid = isset($_GET['oid']) ? $_GET['oid'] : null;

$stmt = $conn->prepare("
    SELECT oi.oiid, oi.oid, oi.pid, p.name, p.image ,p.description, p.price, oi.quantity, oi.quantity * p.price AS total_price
    FROM order_items oi
    JOIN products p ON oi.pid = p.pid
    WHERE oi.oid = ?
");
$stmt->bind_param("i", $oid);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

$total = 0;
foreach ($products as $product) {
    $total += $product['total_price'];
}

// TODO
// View the order status
// Admin can change the order status
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<body>
    <?php include 'includes/navbar.php'; ?>
    <section>
        <div class="container">
            <h2 class="title is-3">Your Order</h2>
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
                <form action="" method="POST">
                    <button class="button is-primary" type="submit" name="checkout">
                        <i class="fa-solid fa-cart-arrow-down"></i>
                        Checkout
                    </button>
                </form>
                <br>
            </div>
        </div>
    </section>
</body>
<script src="assets/js/darkMode.js"></script>

</html>