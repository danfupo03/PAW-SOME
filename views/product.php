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
    <div class="container mt-5">
      <div class="product">
        <img src="/assets/images/kongBear.png" alt="Kong Bear" />
        <div class="container">
          <h2 class="title is-2">Kong Bear</h2>
          <h1 class="title is-4 is-primary">$7.99</h1>
          <p class="content">
            The Kong Bear plush toy is perfect for playful pets. This durable,
            high-quality plush is designed to be gentle on teeth and gums,
            while providing hours of fun and snuggles.
          </p>
          <h1 class="title is-5"><strong>Features:</strong></h1>
          <ul class="content">
            <li>Soft and durable plush material</li>
            <li>Perfect for both playtime and nap time</li>
            <li>Easy to clean, machine washable</li>
            <li>Dimensions: 10 x 8 x 5 inches</li>
          </ul>
          <div class="mt-5 buttons-container">
            <a id="changeColorButton" class="button is-info">
              Change Color
            </a>
            <a class="button is-secondary">
              <i class="fa-solid fa-cart-shopping"></i>
              Add to Cart
            </a>
            <a class="button is-danger" href="productList.html"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="../assets/js/product.js"></script>
</body>

</html>