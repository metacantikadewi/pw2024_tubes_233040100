<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040100");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;

    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga_produk = htmlspecialchars($data["harga_produk"]);
    $image = htmlspecialchars($data["image"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO product (nama_produk, harga_produk, image)
                VALUES ('$nama_produk', '$harga_produk', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namafile   = $_FILES['image']['name'];
    $ukuranfile = $_FILES['image']['size'];
    $error      = $_FILES['image']['error'];
    $tmpName    = $_FILES['image']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Pilih image terlebih dahulu!')</script>";
        return false;
    }

    $ekstensiGambarValid    = ['jpg', 'jpeg', 'png'];
    $ekstensigambar         = explode('.', $namafile);
    $ekstensigambar         = strtolower(end($ekstensigambar));
    
    if (!in_array($ekstensigambar, $ekstensiGambarValid)) {
        echo "<script>alert('Yang Anda upload bukan image!')</script>";
        return false;
    }

    if ($ukuranfile > 1000000) {
        echo "<script>alert('Ukuran image terlalu besar!')</script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensigambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM product WHERE produk_id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    // var_dump($data); die();
    global $conn;
    $id = $data["produk_id"];

    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga_produk = htmlspecialchars($data["harga_produk"]);
    

    $produk = query("SELECT * FROM product WHERE produk_id = $id")[0];

    // cek apakah user pilih image baru atau tidak
        if ($_FILES['image']['error'] === 4) {
            $image = $produk['image'];
        } else {
            $image = upload();
        }
    
  
    $query = "UPDATE product SET
            nama_produk = '$nama_produk',
            harga_produk = '$harga_produk',
            image = '$image'
            WHERE produk_id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    global $conn;
    $query = "SELECT * FROM product
                WHERE
            produk_id LIKE '%$keyword%' OR
            nama_produk Like = '$nama_produk'%$keyword%' OR
            harga_produk LIKE = $harga_produk'%$keyword%' OR
            image LIKE = image'%$keyword%'";
    return mysqli_query($conn, $query);
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username sudah terdaftar!')</script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai!')</script>";
        return false;
    }

    // tambahkan username ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

?>
