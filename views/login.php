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
        <form action="" method="GET">
          <label for="username">Username</label>
          <input type="text" placeholder="username" />
          <label for="password">Password</label>
          <input type="password" placeholder="password" />
          <button class="button is-secondary" type="submit">Login</button>
        </form>
        <div class="mb-3">
          <h1 class="title is-5">Not an account yet?</h1>
          <a class="button is-info" href="<?= BASE_URL ?>register">Register</a>
          <a class="button is-danger" href="<?= BASE_URL ?>">Back to Home</a>
        </div>
      </div>
    </div>
  </section>
  <script src="../assets/js/login.js"></script>
</body>

</html>