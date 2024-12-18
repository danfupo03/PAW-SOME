<?php
if (!isset($_SESSION)) {
    session_start();
}
require 'db.php';
$uid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$stmt = $conn->prepare("SELECT r.role FROM users u JOIN user_roles ur ON u.uid = ur.uid JOIN roles r ON ur.rid = r.rid WHERE u.uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$cart_count = 0;
if ($uid) {
    $stmt = $conn->prepare("SELECT SUM(quantity) AS total_items FROM shopping_cart WHERE uid = ?");
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = $result->fetch_assoc();
    $cart_count = $cart['total_items'] ?? 0;
}
?>

<nav class="navbar">
    <div class="navbar-start">
        <div class="navbar-brand">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                width="100">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                    fill="#000000"
                    d="M226.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5s.3-86.2 32.6-96.8s70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3S-2.7 179.3 21.8 165.3s59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7c-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2C84.9 480 64 459.1 64 433.3l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3s29.1 51.7 10.2 84.1s-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5s46.9 53.9 32.6 96.8s-52.1 69.1-84.4 58.5z" />
            </svg>
        </div>
        <a class="button is-primary" href=""><i class="fa-solid fa-house"></i> Home</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($user["role"] == 'admin'): ?>
                <a class="button is-primary" href="users"><i class="fa-solid fa-users"></i> Users</a>
            <?php endif; ?>
            <a class="button is-primary" href="orders"><i class="fa-solid fa-box"></i> Orders</a>
        <?php endif; ?>
    </div>

    <div class="buttons">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a class="button is-secondary" href="login"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
        <?php else: ?>
            <a class="button is-secondary" href="customer"><i class="fa-solid fa-user"></i></a>
            <a class="button is-info shopping-cart" href="shoppingCart">
                <i class="fa-solid fa-cart-shopping"></i>
                <?php if ($cart_count > 0): ?>
                    <span class="notification-badge"><?= $cart_count ?></span>
                <?php endif; ?>
            </a>
            <a class="button is-danger" href="logout"><i class="fa-solid fa-right-from-bracket"></i></a>
        <?php endif; ?>
        <a class="button is-dark" onclick="darkMode()" id="dark-mode"><i class="fa-solid fa-moon"></i></a>
    </div>
</nav>