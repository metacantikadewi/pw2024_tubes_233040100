<?php 
session_start();
require 'functions.php';

if(!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

$product = query("SELECT * FROM product");

// tombol cari ditekan 
if(isset($_POST["cari"]) ) {
    $product = cari($_POST["keyword"]);
}

?>

<?php include('partials/navbar.php');?>

<div class="container">

<h1>Daftar product</h1>

<a href="tambah.php" class="tambah btn btn-primary">Tambah Data Product</a>
<br><br>

<form class="d-flex mb-4">
    <input class="form-control me-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>

<div id="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>aksi.</th>
                <th>nama_produk.</th>
                <th>harga_produk.</th>
                <th>image.</th>
            </tr>
        </thead>
    <?php $i = 1; ?>
    <?php foreach( $product as $row ) : ?>
        <tbody>
            <tr>
                <td><?= $i; ?></td>
                <td class="aksi">
                    <a href="ubah.php?id=<?= $row["produk_id"]; ?>">ubah</a> |
                    <a href="hapus.php?id=<?= $row["produk_id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
                </td>
                <td><?= $row["nama_produk"]; ?></td>
                <td><?= $row["harga_produk"]; ?></td>
                <td><?= $row["image"]; ?></td>
            </tr>
        </tbody>
    <?php $i++; ?>
    <?php endforeach; ?>

    </table>
</div>
</div>


<?php require('partials/footer.php');