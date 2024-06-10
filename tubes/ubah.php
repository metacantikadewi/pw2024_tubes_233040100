<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data teknologi berdasarkan id
$produk = query("SELECT * FROM product WHERE produk_id = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"]) ) {


    // cek apakah data berhasil diubah atau tidak
    if(ubah($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'dashboard.php';
            </script>
            ";
    } else {
        echo "
        <script>
        alert('data gagal diubah!');
        document.location.href = 'ubah.php';
         </script>
     ";
    }
}
?>


<?php include('partials/navbar.php'); ?>
<div class="container">
    <h1>Ubah data product</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="produk_id" value="<?= $produk['produk_id'] ?>">
        <div class="form-group">
            <label for="">Nama Produk</label>
            <input value="<?= $produk['nama_produk'] ?>" name="nama_produk" type="text" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Harga</label>
            <input value="<?= $produk['harga_produk'] ?>" name="harga_produk" type="text" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input value="<?= $produk['image'] ?>" name="image" type="file" name="image" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group mt-2">
            <input type="submit" class="btn btn-primary" value="Simpan" name="submit">
        </div>
    </form>
</div>
<?php include('partials/footer.php'); ?>