<?php
sleep(500000);
require '../function.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM teknologi
                WHERE
            produk_id LIKE =  '%$keyword%' OR
            nama_produk LIKE =  '%$keyword%' OR
            harga produk LIKE = '%$keyword%' OR
            image LIKE ='%$keyword%' OR
            ";
$teknologi = query($query);
?>
<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th>aksi.</th>
        <th>harga produk.</th>
        <th>image.</th>
</tr>
<?php $i = 1; ?>
<?php foreach( $product as $row ) : ?>
<tr>
    <td><?= $i; ?></td>
    <td>
        <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
        <a href="hapus.php?id=<?= $rows["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
        hapus</a>
    </td>
    <td><?= $row["produk_id"]; ?></td>
    <td><?= $row["nama_produk"]; ?></td>
    <td><?= $row["harga produk"]; ?></td>
    <td><?= $row["image"]; ?></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>