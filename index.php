<?php


session_start();

if ( !isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

require "koneksi.php";


// // PAGE HALAMAN 
// $jumlahDataPerHalaman = 2;
// $jumlahData = count(query("SELECT * FROM sepatu"));
// $jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);


// // jika halaman aktif true maka ambil halaman=1
// $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"]: 1;
// $awalData = ($jumlahDataPerHalaman * $halamanAktif)-$jumlahDataPerHalaman;


// menampilkan data
$sepatu = query("SELECT * FROM sepatu");


// isset pencarian
if(isset($_POST["cari"])){
    $sepatu = cari($_POST["kataKunci"]);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .img{
            width: 100px;
            top: 50px;
           margin-left: 100px;
           position: absolute;
           z-index: -1;
        }
    </style>
</head>
<body>

<a href="logout.php" style="float:right;">Logout</a>

<a href="tambah.php">tambah barang!</a>

<h1>Table Barang</h1>

<form action="" method="post">
    <input type="text" name="kataKunci" id="kataKunci" autocomplete="off" size="50" autofocus placeholder="Masukan kata kunci">
    <button type="submit" name="cari" id="tombol-cari">Cari</button><img src="img/load.gif" alt="" class="img">
</form>
<br>


<div id="container">
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
    </div>
    

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>