<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if ($user && $password) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header('Location: ' . 'customer');
    exit();
  } else {
    echo "Usuario o contraseña incorrectos.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'includes/head.php';
?>

<body class="body">
  <div class="mt-3">
    <a class="button is-dark ml-1" onclick="darkMode()" id="dark-mode"><i class="fa-solid fa-moon"></i></a>
  </div>
  <section>
    <div class="container">
      <div class="form mt-5">
        <h1 class="title is-3">Welcome to Paw-Some &#128054;</h1>
        <p class="content">
          We're glad you're here! Please log in to continue.
        </p>
        <form action="" method="POST">
          <label for="username">Username</label>
          <input type="text" placeholder="username" name="username" required />
          <label for="password">Password</label>
          <input type="password" placeholder="password" name="password" required />
          <button class="button is-secondary" type="submit">Login</button>
        </form>
        <div class="mb-3">
          <h1 class="title is-5">Not an account yet?</h1>
          <a class="button is-info" href="register">Register</a>
          <a class="button is-danger" href="">Back to Home</a>
        </div>
      </div>
    </div>
  </section>
</body>

</html>