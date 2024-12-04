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
        <form action="" method="GET" id="customerForm">
          <label for="username">Username</label>
          <input
            type="text"
            placeholder="JohnDoe03"
            value="JohnDoe03"
            required
            id="username" />
          <span id="usernameError" style="color: red; display: none">The username must contain at least 5 characters and at least one
            capital letter and one lower case letter</span>

          <label for="password">Password</label>
          <input
            type="text"
            placeholder="password"
            value="password123"
            id="password"
            required />
          <span id="passwordError">The password must be at least 10 characters long</span>

          <button class="button is-secondary" type="submit">
            Update account
          </button>
        </form>
      </div>
    </div>
  </section>
  <script src="assets/js/customer.js"></script>
</body>

</html>