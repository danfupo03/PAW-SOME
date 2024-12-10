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
    <div class="container mt-5">
      <div class="log-out">
        <h1 class="title is-1">You are logged out</h1>
        <p class="content">
          Thank you for visiting. You have successfully logged out of your
          account.
        </p>

        <figure>
          <img src="assets/images/dogLoggedOut.png" alt="Logged Out" />
          <figcaption>We hope to see you again soon!</figcaption>
        </figure>
        <div class="mt-5 mb-5">
          <a class="button is-secondary" href="login">Login Page</a>
          <a class="button is-primary" href="">Home Page</a>
        </div>
      </div>
    </div>
  </section>
  <script src="assets/js/logout.js"></script>
</body>

</html>