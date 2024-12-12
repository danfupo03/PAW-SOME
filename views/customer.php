<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login');
  exit();
}

require 'db.php';
$uid = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $conn->begin_transaction();

  try {
    $stmt = $conn->prepare('UPDATE users SET username = ?, password = ? WHERE uid = ?');
    $stmt->bind_param('ssi', $username, $password, $uid);
    $stmt->execute();

    $conn->commit();

    header('Location: customer');
    exit();
  } catch (Exception $e) {
    $conn->rollback();
    echo "Error updating user: " . $e->getMessage();
  }
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
    <div class="container">
      <div class="form mt-5">
        <h1 class="title is-3">User Account</h1>
        <p class="content">Welcome back <?= $user_data['username'] ?></p>
        <form action="" method="POST" id="customerForm">
          <label for="username">Username</label>
          <input
            type="text"
            placeholder="New username"
            value="<?= $user_data['username'] ?>"
            id="username"
            name="username"
            required />

          <label for="password">Password</label>
          <input
            type="text"
            placeholder="New password"
            id="password"
            name="password"
            required />

          <button class="button is-secondary" type="submit">
            Update account
          </button>
        </form>
        <p class="content"><small>Note: For safety reasons your current password is not displayed</small></p>
      </div>
    </div>
  </section>

  <script src="assets/js/customer.js"></script>
</body>

</html>