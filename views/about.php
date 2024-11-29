<!DOCTYPE html>
<html lang="en">

<?php
include 'includes/head.php';
?>

<body>
  <?php
  include 'includes/navbar.php';
  ?>

  <div class="language-selector mt-3">
    <select id="language">
      <option value="en" selected>English</option>
      <option value="de">Deutsch</option>
      <option value="es">Español</option>
    </select>
  </div>

  <section>
    <div class="container">
      <h2 class="title is-3">About Us</h2>
      <p class="content">
        We are a dedicated platform committed to connecting pet lovers with
        top-quality pet products and services. Our mission is to provide a
        seamless shopping experience for pet owners, ensuring they find
        everything they need to keep their pets happy and healthy. Our team is
        passionate about making it easy for pet owners to access trusted
        products and services.
      </p>

      <h2 class="title is-3">Our Values</h2>
      <p class="content">
        We believe in transparency, quality, and the well-being of pets and
        their owners. Our marketplace is built on trust and strives to foster
        meaningful connections between suppliers and pet enthusiasts.
      </p>

      <h2 class="title is-3">Contact Us</h2>
      <div class="contact-card">
        <img src="assets/images/about.png" alt="cartoon dog" />
        <div>
          <p>
            <i class="fa-solid fa-envelope"></i>
            <a href="mailto:pet@ingolstadt.de">pet@ingolstadt.de</a>
          </p>
          <p><i class="fa-solid fa-phone"></i> +1 (123) 456-7890</p>
          <p>
            <i class="fa-solid fa-location-dot"></i> 123 Pet Lane, Ingolstadt,
            Germany
          </p>
        </div>
      </div>
    </div>
  </section>
  <script src="assets/js/about.js"></script>
</body>

</html>