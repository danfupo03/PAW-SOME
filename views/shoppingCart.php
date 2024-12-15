<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login');
  exit();
}

$uid = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT sc.sid, sc.quantity, p.price, p.name, p.description, p.image
    FROM shopping_cart sc
    JOIN products p ON sc.pid = p.pid
    WHERE sc.uid = ?
");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sid = $_POST['sid'];

  $conn->begin_transaction();

  try {
    $stmt = $conn->prepare('DELETE FROM shopping_cart WHERE sid = ?');
    $stmt->bind_param('i', $sid);
    $stmt->execute();

    $conn->commit();

    header('Location: shoppingCart');
    exit();
  } catch (Exception $e) {
    $conn->rollback();
    echo "Error deleting item: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<body>
  <?php include 'includes/navbar.php'; ?>

  <section>
    <div class="container">
      <h2 class="title is-3">Your Shopping Cart</h2>
      <?php foreach ($products as $product) : ?>
        <div class="shopping-cart-item">
          <div class="shopping-cart-content">
            <img src="assets/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" />
            <p><?= $product['name'] ?></p>
            <div>
              <label for="quantity">Quantity:</label>
              <input type="number" name="quantity" value="<?= $product['quantity'] ?>" min="1" data-price="<?= $product['price'] ?>" class="quantity-input">
            </div>
            <p>Price: $<span class="total-price"><?= $product['price'] * $product['quantity'] ?></span></p>
          </div>
          <form action="" method="POST">
            <input type="hidden" name="sid" value="<?= $product['sid'] ?>">
            <button type="submit" name="delete" class="delete-button is-danger">
              <i class="fa-solid fa-circle-xmark fa-2xl" style="color: #c0382b;"></i>
            </button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="container">
      <hr>
      <h2 class="title is-3">Total Price</h2>
      <p class="content">
        <span class="total-price">$0.00</span>
      </p>
      <button class="button is-primary" type="submit">
        <i class="fa-solid fa-cart-arrow-down"></i>
        Checkout
      </button>
    </div>
  </section>
</body>
<script src="assets/js/cartPrice.js"></script>

</html>