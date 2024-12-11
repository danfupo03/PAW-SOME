<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login');
  exit();
}

require 'db.php';
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
              <input type="number" name="quantity" value="1" min="1" class="input">
            </div>
            <p>Price: $<?= $product['price'] ?></p>
          </div>
          <div>
            <form action="" method="POST">
              <input type="hidden" name="sid" value="<?= $product['sid'] ?>">
              <button type="submit" name="delete" class="delete-button is-danger">
                <i class="fa-solid fa-circle-xmark fa-2xl" style="color: #c0382b;"></i>
              </button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <script src="assets/js/index.js"></script>
</body>

</html>