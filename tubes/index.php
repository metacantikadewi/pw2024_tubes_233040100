<?php

session_start();
require 'functions.php';

$products = query("SELECT * FROM product");

include('partials/navbar.php');
?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-1 bold text-white">Welcome to Our Website</h1>
    <a class="btn btn-primary btn-lg" href="#produk" role="button">Lihat Prdouk</a>
  </div>
</div>

<div class="container mt-5 " id="produk">
  <h2>Our Products</h2>
  <div class="row">
    <?php foreach($products as $product): ?>
    <div class="col-md-4">
      <div class="card mb-4">
        <img src="img/<?= $product['image'] ?>" class="card-img-top" alt="Product 1">
        <div class="card-body">
          <h5 class="card-title"><?= $product['nama_produk']; ?></h5>
          <p class="card-text"><?= $product['harga_produk']; ?></p>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>
