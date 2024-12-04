<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$products = json_decode(file_get_contents('assets/data/products.json'), true);

if ($products === null) {
  echo "Error al cargar el JSON: " . json_last_error_msg();
}

$category = isset($_GET['category']) ? $_GET['category'] : null;

if ($category) {
  $products = array_filter($products, function ($product) use ($category) {
    return $product['category'] === $category;
  });
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'includes/head.php';
?>

<body>
  <?php
  include 'includes/navbar.php';
  ?>

  <section>
    <div class="container mb-5">
      <h1 class="title is-3">Product List</h1>
      <form action="comparison" method="GET">
        <div class="cards-container">
          <?php foreach ($products as $product) : ?>
            <div class="card mb-4">
              <div class="card-content">
                <img src="assets/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" />
                <h1 class="title is-5"><?= $product['name'] ?> </h1>
                <div>
                  <span class="category-pill"><?= $product['category'] ?></span>
                  <span class="subcategory-pill"><?= $product['subcategory'] ?></span>
                </div>
                <p class="content">
                  <?= $product['description'] ?>
                </p>
                <p class="content mb-4">Price: $<?= $product['price'] ?></p>
                <div>
                  <a class="button is-info" href="<?= BASE_URL ?>product?pid=<?= htmlspecialchars($product['pid']) ?>">View Details</a>
                  <input type="checkbox" name="pid[]" value="<?= $product['pid'] ?>" id="<?= $product['pid'] ?>" />
                  <label for="<?= $product['pid'] ?>">Compare</label>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <button type="submit" class="button is-primary mt-3">Compare Selected</button>
      </form>
    </div>
  </section>
  <script src="assets/js/productList.js"></script>
</body>

</html>