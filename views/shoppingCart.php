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
    SELECT sc.sid, sc.quantity, p.pid, p.price, p.name, p.description, p.image
    FROM shopping_cart sc
    JOIN products p ON sc.pid = p.pid
    WHERE sc.uid = ?
");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

$stmt = $conn->prepare("SELECT number_of_orders FROM users WHERE uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$number_of_orders = $user['number_of_orders'];

$discountRate = 0;

if ($user['number_of_orders'] >= 10 && $user['number_of_orders'] < 20) {
  $discountRate = 0.10;
} elseif ($user['number_of_orders'] >= 20) {
  $discountRate = 0.20;
}

$stmt = $conn->prepare("SELECT state FROM users WHERE uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$state = $user['state'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['update']) && isset($_POST['quantity']) && isset($_POST['sid'])) {
    $sid = $_POST['sid'];
    $quantity = (int)$_POST['quantity'];

    $stmt = $conn->prepare('UPDATE shopping_cart SET quantity = ? WHERE sid = ?');
    $stmt->bind_param('ii', $quantity, $sid);
    $stmt->execute();
    header('Location: shoppingCart');
    exit();
  }

  if (isset($_POST['delete']) && isset($_POST['sid'])) {
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

  if (isset($_POST['checkout'])) {
    if (count($products) === 0) {
      header('Location: shoppingCart');
      exit();
    }

    $conn->begin_transaction();
    try {
      $sub_total = 0;
      foreach ($products as $product) {
        $sub_total += $product['price'] * $product['quantity'];
      }
      $taxRate = 0.19;
      $discount = $sub_total * $discountRate;
      $sub_total = ($sub_total - $discount);
      $total = $sub_total + ($sub_total * $taxRate);

      $stmt = $conn->prepare('INSERT INTO orders (uid, total, order_date, state) VALUES (?, ?, NOW(), "new")');
      $stmt->bind_param('id', $uid, $total);
      $stmt->execute();

      $oid = $conn->insert_id;

      $stmt = $conn->prepare('INSERT INTO order_items (oid, pid, quantity) VALUES (?, ?, ?)');
      foreach ($products as $product) {
        $stmt->bind_param('iii', $oid, $product['pid'], $product['quantity']);
        $stmt->execute();
      }

      $stmt = $conn->prepare('UPDATE users SET number_of_orders = number_of_orders + 1 WHERE uid = ?');
      $stmt->bind_param('i', $uid);
      $stmt->execute();

      $stmt = $conn->prepare('DELETE FROM shopping_cart WHERE uid = ?');
      $stmt->bind_param('i', $uid);
      $stmt->execute();

      $conn->commit();
      header('Location: shoppingCart');
      exit();
    } catch (Exception $e) {
      $conn->rollback();
      echo "Error during checkout: " . $e->getMessage();
    }
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
            <form action="" method="POST">
              <label for="quantity">Quantity:</label>
              <div>
                <input type="number" name="quantity" value="<?= $product['quantity'] ?>" min="1" data-price="<?= $product['price'] ?>" class="quantity-input">
                <input type="hidden" name="sid" value="<?= $product['sid'] ?>">
                <button class=" button is-info ml-2" type="submit" name="update">
                  Update
                </button>
              </div>
            </form>
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
      <div class="content">
        <hr>
        <h2 class="title is-3">Cart Summary</h2>
        <p>This is your order number <?= $number_of_orders ?>! You get a <span id=discount-rate><?= $discountRate * 100 ?></span>% discount.</p>
        <p>Subtotal: $<span id="subtotal">0.00</span></p>
        <?php if ($discountRate > 0): ?>
          <p>Discount <?= ($discountRate * 100) ?>%: $<span id="discount">0.00</span></p>
        <?php endif; ?>
        <p>Taxes (19%): $<span id="taxes">0.00</span></p>
        <p class="total-shop">Total Price: $<span id="grand-total">0.00</span></p>
        <?php if ($state == "blocked"): ?>
          <p class="content is-danger">Your account is blocked by the administrator.</p>
        <?php else: ?>
          <form action="" method="POST">
            <button class="button is-primary" type="submit" name="checkout">
              <i class="fa-solid fa-cart-arrow-down"></i>
              Checkout
            </button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </section>
</body>
<script src="assets/js/cartPrice.js"></script>

</html>