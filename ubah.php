<?php
session_start();

if ( !isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}



require "koneksi.php";

$id = $_GET["id"];

$spt = query("SELECT * FROM sepatu WHERE id = $id")[0];

if ( isset($_POST["submit"])) {
    if(ubah($_POST)>0){
        echo "
        <script>
        alert('data berhasil diubah');
        document.location.href = 'index.php';
        </script>";  
    }else{
        echo "
        <script>
        alert('data gagal diubah');
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah</title>
</head>
<body>
    <h1>Tambah Barang</h1>
    
<form action="" method="post" enctype="multipart/form-data">
    <ul>
    <input type="hidden" name="id" value="<?=$spt['id']?>">
    <input type="hidden" name="gambarLama" value="<?=$spt['gambar']?>">
    <li>
        <label for="nama">Nama : </label>
            
            <input type="text" name="nama" id="nama" value="<?=$spt['nama']?>">      
    </li>
    <li>
        <label for="ukuran">Ukuran : </label>
            <input type="text" name="ukuran" id="ukuran" value="<?=$spt['ukuran']?>">   
    </li>
    <li>
        <label for="harga">Harga : </label>
            <input type="text" name="harga" id="harga" value="<?=$spt['harga']?>">  
    </li>
    <li>
        <label for="gambar">Gambar : </label><br>
        <img src="img/<?= $spt['gambar']; ?>" alt="" width="30"><br>
            <input type="file" name="gambar" id="gambar">  
    </li>
    </ul>
    <button type="submit" name="submit" onclick="return confirm('Yakin diubah?');">Ubah</button>
</form>


</body>
</html>