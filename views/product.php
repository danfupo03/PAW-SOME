<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

$pid = isset($_GET['pid']) ? $_GET['pid'] : null;

if ($pid) {
  $stmt = $conn->prepare("SELECT * FROM products WHERE pid = ?");
  $stmt->bind_param("i", $pid);
  $stmt->execute();
  $result = $stmt->get_result();
} else {
  echo "Product not found.";
  exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<body>
  <?php include 'includes/navbar.php'; ?>

  <section>
    <div class="container mt-5">
      <div class="product">
        <img src="assets/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" />
        <div class="container">
          <h2 class="title is-2"><?= $product['name'] ?></h2>
          <h1 class="title is-4 is-primary">$<?= $product['price'] ?></h1>
          <p class="content">
            <?= $product['description'] ?>
          </p>
          <h1 class="title is-5"><strong>Features:</strong></h1>
          <p class="content">
            <?= $product['features'] ?>
          </p>
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
    </div>
  </section>
  <script src="assets/js/product.js"></script>
</body>

</html>