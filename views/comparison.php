<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$products = json_decode(file_get_contents('assets/data/products.json'), true);
if (!$products) {
    echo "Error al cargar los productos.";
    exit;
}

$pids = isset($_GET['pid']) ? $_GET['pid'] : [];
if (empty($pids)) {
    echo "No se seleccionaron productos.";
    exit;
}

$selectedProducts = array_filter($products, function ($product) use ($pids) {
    return in_array($product['pid'], $pids);
});

if (empty($selectedProducts)) {
    echo "No se encontraron productos seleccionados.";
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
                    <div class="container">
                        <h2 class="title is-2"><?= $product['name'] ?></h2>
                        <h1 class="title is-4 is-primary">$<?= $product['price'] ?></h1>
                        <p class="content">
                            <?= $product['description'] ?>
                        </p>
                        <h1 class="title is-5"><strong>Features:</strong></h1>
                        <ul class="content">
                            <?php foreach ($product['features'] as $feature): ?>
                                <li><?= $feature ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="mt-5 buttons-container">
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