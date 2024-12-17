<?php
session_start();

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

$uid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (!$uid) {
    header('Location: login');
    exit();
  }

  $userId = $_POST['userId'];
  $productId = $_POST['productId'];
  $quantity = $_POST['quantity'];

  $conn->begin_transaction();

  try {
    $checkStmt = $conn->prepare('SELECT quantity FROM shopping_cart WHERE uid = ? AND pid = ?');
    $checkStmt->bind_param('ii', $userId, $productId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
      $row = $checkResult->fetch_assoc();
      $newQuantity = $row['quantity'] + $quantity;

      $updateStmt = $conn->prepare('UPDATE shopping_cart SET quantity = ? WHERE uid = ? AND pid = ?');
      $updateStmt->bind_param('iii', $newQuantity, $userId, $productId);
      $updateStmt->execute();
    } else {
      $insertStmt = $conn->prepare('INSERT INTO shopping_cart (uid, pid, quantity) VALUES (?, ?, ?)');
      $insertStmt->bind_param('iii', $userId, $productId, $quantity);
      $insertStmt->execute();
    }

    $conn->commit();

    header('Location: shoppingCart');
    exit();
  } catch (Exception $e) {
    $conn->rollback();
    echo "Error adding to cart: " . $e->getMessage();
  }
}

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
          <form action="" method="POST">
            <input type="hidden" name="userId" value="<?= $uid ?>">
            <input type="hidden" name="productId" value="<?= $product['pid'] ?>">
            <div>
              <label for="quantity">Quantity:</label>
              <input type="number" name="quantity" value="1" min="1" class="input">
            </div>
            <div class="mt-3">
              <button class="button is-secondary" type="submit">
                <i class="fa-solid fa-cart-arrow-down"></i>
                Add to Cart
              </button>
            </div>
          </form>
        </div>
      </div>
      <button class="button is-danger" onclick="window.history.back();">
        <i class="fa-solid fa-arrow-left"></i> Go Back
      </button>
    </div>
  </section>
  <script src="assets/js/product.js"></script>
</body>

</html>