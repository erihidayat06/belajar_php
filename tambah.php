<?php
session_start();

if ( !isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}


require "koneksi.php";
session_start();

if ( !isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

if ( isset($_POST["submit"])) {
    if(tambah($_POST)>0){
        echo "
        <script>
        alert('data berhasil ditambah');
        document.location.href = 'index.php';
        </script>";  
    }else{
        echo "
        <script>
        alert('data gagal ditambah');
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
        
    <li>
        <label for="nama">Nama : </label>
            
            <input type="text" name="nama" id="nama">      
    </li>
    <li>
        <label for="ukuran">Ukuran : </label>
            <input type="text" name="ukuran" id="ukuran">   
    </li>
    <li>
        <label for="harga">Harga : </label>
            <input type="text" name="harga" id="harga">  
    </li>
    <li>
        <label for="gambar">Gambar : </label>
            <input type="file" name="gambar" id="gambar">  
    </li>
    </ul>
    <button type="submit" name="submit">Tambah</button>
</form>


</body>
</html>