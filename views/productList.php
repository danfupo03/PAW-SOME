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
    <div class="container mb-5">
      <h2 class="title is-2">Toy List</h2>
      <h3 class="title is-3">Stuffed Animals</h3>
      <div class="cards-container">
        <div class="card">
          <div class="card-content">
            <img src="/assets/images/kongBear.png" alt="KONG Plush Bear" />
            <h1 class="title is-5">KONG Plush Teddy Bear Dog Toy</h1>
            <p>
              Soft, durable, and bear toy with a replaceable squeaker for
              endless fun. <br />
              <br />
              <strong>Price: $7.99</strong>
            </p>
            <div class="buttons-container">
              <a class="button is-info" href="<?= BASE_URL ?>product">View Details</a>
              <input type="number" min="1" value="1" />
              <button class="button is-warning">Add to list</button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <img
              src="/assets/images/friscoSquirrel.png"
              alt="Frisco Squirrel" />
            <h1 class="title is-5">
              Frisco Plush Squeaking Squirrel Dog Toy
            </h1>
            <p>
              Ultra-soft plush with squeakers to keep your dog engaged during
              playtime. <br />
              <br />
              <strong>Price: $6.99</strong>
            </p>
            <div class="buttons-container">
              <a class="button is-info" href="#">View Details</a>
              <input type="number" min="1" value="1" />
              <button class="button is-warning">Add to list</button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <img src="/assets/images/gato.png" alt="Cat Plush" />
            <h1 class="title is-5">Mr Mittens The Cat Plush Cat Toy</h1>
            <p>
              Super soft, with cute details for your cat to have a cuddly
              friend to play with. <br />
              <br />
              <strong>Price: $9.99</strong>
            </p>
            <div class="buttons-container">
              <a class="button is-info" href="#">View Details</a>
              <input type="number" min="1" value="1" />
              <button class="button is-warning">Add to list</button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <img src="/assets/images/perrybg.png" alt="PlatypusPlush" />
            <h1 class="title is-5">Terry The PLatypus Dog Toy</h1>
            <p>
              Australian Semi-aquatic mammalian agent Doobie, doobie, Doo-bah!
              it's Terry the platypus! <br />
              <br />
              <strong>Price: $8.99</strong>
            </p>
            <div class="buttons-container">
              <a class="button is-info" href="#">View Details</a>
              <input type="number" min="1" value="1" />
              <button class="button is-warning">Add to list</button>
            </div>
          </div>
        </div>
      </div>

      <h3 class="title is-3">Chewables</h3>
      <div class="cards-container">
        <div class="card">
          <div class="card-content">
            <img src="/assets/images/benebone.png" alt="Benebone Chew" />
            <h1 class="title is-5">Benebone Wishbone Durable Dog Chew Toy</h1>
            <p>
              Real bacon flavor with an ergonomic design for hours of
              enjoyable chewing. <br />
              <br />
              <strong class="mt-5">Price: $12.99</strong>
            </p>
            <div class="buttons-container">
              <a class="button is-info" href="#">View Details</a>
              <input type="number" min="1" value="1" />
              <button class="button is-warning">Add to list</button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <img src="/assets/images/nylabone.png" alt="Nylabone Chew" />
            <h1 class="title is-5">Nylabone Power Chew Dog Toy</h1>
            <p>
              Designed for aggressive chewers, flavored with chicken and made
              for long-lasting play. <br />
              <br />
              <strong>Price: $9.99</strong>
            </p>
            <div class="buttons-container">
              <a class="button is-info" href="#">View Details</a>
              <input type="number" min="1" value="1" />
              <button class="button is-warning">Add to list</button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <img src="/assets/images/pie.png" alt="Pie Chew" />
            <h1 class="title is-5">Little Piece of Pie Chew Dog Toy</h1>
            <p>
              To calm your dog's hunger, designed with a squeaker inside for
              hours of fun.<br />
              <br />
              <strong>Price: $6.99</strong>
            </p>
            <div class="buttons-container">
              <a class="button is-info" href="#">View Details</a>
              <input type="number" min="1" value="1" />
              <button class="button is-warning">Add to list</button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <img src="/assets/images/sqtoy.png" alt="Squeaky toy Chew" />
            <h1 class="title is-5">Rolling Squeaky Chew Dog Toy</h1>
            <p>
              Excellent for heavy duty use for the toughest chewers. Can be
              rolled for more fun!<br />
              <br />
              <strong>Price: $10.99</strong>
            </p>
            <div class="buttons-container">
              <a class="button is-info" href="#">View Details</a>
              <input type="number" min="1" value="1" />
              <button class="button is-warning">Add to list</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <h1 class="title is-3">Product List</h1>
      <div class="mb-5" id="product-list"></div>
    </div>
  </section>
  <script src="../assets/js/productList.js"></script>
</body>

</html>