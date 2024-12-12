<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

$pids = isset($_GET['pid']) ? $_GET['pid'] : [];

if ($pids) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE pid = ?");
    $selectedProducts = [];
    foreach ($pids as $pid) {
        $stmt->bind_param("i", $pid);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $selectedProducts[] = $product;
    }
} else {
    echo "Product not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<body>
    <?php include 'includes/navbar.php'; ?>

    <section>
        <div class="container mt-5">
            <h1 class="title is-3">Selected Products</h1>
            <?php foreach ($selectedProducts as $product): ?>
                <div class="product mb-5">
                    <img src="assets/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" />
                    <div class="product-info">
                        <h2 class="title is-2"><?= $product['name'] ?></h2>
                        <h1 class="title is-4 is-primary">$<?= $product['price'] ?></h1>
                        <p class="content">
                            <?= $product['description'] ?>
                        </p>
                        <h1 class="title is-5"><strong>Features:</strong></h1>
                        <p class="content">
                            <?= $product['features'] ?>
                        </p>
                        <div class="buttons-container">
                            <button class="button is-secondary">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Add to Cart
                            </button>
                            <button class="button is-danger" onclick="window.history.back();">
                                <i class="fa-solid fa-arrow-left"></i> Go Back
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>

</html>