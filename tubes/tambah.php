<?php
session_start();

if(!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"]) ) {
    // ambil daita dari alemen dalam form
    $nama_produk        = $_POST["nama_produk"];
    $harga_produk       = $_POST["harga_produk"];
    $image              = $_POST["image"];

    // cek apakah data berhasil di tambahkan atau tidak
    if(tambah($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = 'dashboard.php';
            </script>
            ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan');
            document.location.href = 'tambah.php';
        </script>";
    }
}
?>

<?php include('partials/navbar.php'); ?>
<div class="container">
    <h1>Tambah data product</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Nama Produk</label>
            <input name="nama_produk" type="text" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Harga</label>
            <input name="harga_produk" type="text" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input name="image" type="file" name="image" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group mt-2">
            <input type="submit" class="btn btn-primary" value="Simpan" name="submit">
        </div>
    </form>
</div>
<?php include('partials/footer.php'); ?>