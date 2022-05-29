<?php
session_start();

if ( !isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

if ( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
 }

require "koneksi.php";

if ( isset($_POST["registrasi"])) {
    if ( registrasi($_POST) > 0) {
        echo "<script>
        alert('user berhasil ditambah');
        </script>";
    } else{
        echo mysqli_error($conn);
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h1>Registrasi</h1>
    
<form action="" method="post">
    <ul>
        <li>
            <label for="nama">Nama : </label><br>
            <input type="text" name="nama" id="nama">
        </li>
        <li>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="password2">Password : </label><br>
            <input type="password" name="password2" id="password2">
        </li>
        <li>
            <button type="submit" name="registrasi">Registrasi</button>
        </li>
    </ul>
</form>


</body>
</html>