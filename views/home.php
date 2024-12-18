<!DOCTYPE html>
<html lang="en">
<?php
include 'includes/head.php';
?>

<?php
$description = "Everything you are looking for your best friend in one place.";
?>

<?php
$information = "In Paw-some we care about your furry friends. We offer a wide range 
of products and services to meet your needs. Whether you're looking for food, 
toys or any hygiene products, we have got you covered.";
?>

<body>
  <?php
  include 'includes/navbar.php';
  ?>
  <section class="hero">
    <div class="hero-text ml-5">
      <h1 class="title is-2">Welcome to Paw-some</h1>
      <p>
        <?= $description ?>
      </p>
      <a class="button is-light" href="about">About us</a>
    </div>
    <div class="hero-image">
      <img src="assets/images/dog.png" alt="Dog cartoon" />
    </div>
  </section>

  <section>
    <div class="container mb-5">
      <h2 class="title is-2">General Information</h2>
      <p class="content">
        <?= $information ?>
      </p>
    </div>
  </section>

  <section>
    <div class="container mb-5">
      <h2 class="title is-2">Our Services</h2>
      <div class="cards-container">
        <div class="card">
          <div class="card-content">
            <img src="assets/images/dogFood.png" alt="Dog Food" />
            <h3 class="title is-4">Food</h3>
            <p>Find the best food for your pet.</p>
            <a class="button is-primary" href="productList?category=Food">View products</a>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <img src="assets/images/dogHygiene.png" alt="Dog Hygiene" />
            <h3 class="title is-4">Hygiene</h3>
            <p>Keep your pet clean and healthy.</p>
            <a class="button is-primary" href="productList?category=Hygiene">View products</a>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <img src="assets/images/dogToys.png" alt="Dog" />
            <h3 class="title is-4">Toys</h3>
            <p>Toys and accessories for your pet.</p>
            <a class="button is-primary" href="productList?category=Toys">View products</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>