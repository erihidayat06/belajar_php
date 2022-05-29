<?php 

sleep(1);

require '../koneksi.php';


$kataKunci = $_GET["kataKunci"];
$query = "SELECT * FROM sepatu WHERE 
        nama LIKE '%$kataKunci%' OR
        ukuran LIKE '%$kataKunci%' OR
        harga LIKE '%$kataKunci%'";

$sepatu = query($query);
?>

<table border="1" cellpadding="10">

<?php $i = 1 ?>

    <tr>
        <th>No</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Ukuran</th>
        <th>Harga</th>
    </tr>
    <?php foreach($sepatu as $spt): ?>
    <tr>
    <td><?= $i?></td>
        <td>
            <a href="print.php?id=<?= $spt["id"];?>">Print</a>
            <a href="ubah.php?id=<?= $spt["id"];?>">Edit</a>
            <a href="hapus.php?id=<?= $spt["id"]; ?>" onclick="return confirm('Yakin?');">Hapus</a>
        </td>
        <td><img src="img/<?= $spt["gambar"]; ?>" alt="" width="50px"></td>
        <td><?= $spt["nama"]; ?></td>
        <td><?= $spt["ukuran"]; ?></td>
        <td><?= $spt["harga"]; ?></td>
    </tr>
    <?php $i++?>
<?php endforeach; ?>
    </table>