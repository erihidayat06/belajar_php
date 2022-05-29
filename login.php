<?php
session_start();
require "koneksi.php";


// cek cookie

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];



    $result = mysqli_query($conn, "SELECT nama FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256',$row['nama'])) {
        $_SESSION['login'] = true;
    }
}

if ( isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
 }

if(isset($_POST["Login"])){

    $nama = $_POST["nama"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE nama = '$nama'");

    if (mysqli_num_rows($result) === 1) {

       

        $row = mysqli_fetch_assoc($result);
       if(password_verify($password,$row["password"])){

             // Set session
            $_SESSION["login"] = true;

            // cek remember

            if (isset($_POST["remember"])) {

                // membuat cookie

                setcookie('id',$row['id'],time() + 60);
                setcookie('key', hash('sha256',$row['nama']));

            }
           header("Location: index.php");
           exit;
       } 
    }
    $error = true;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h1>Halaman Login</h1>

<?php if (isset($error)) :?>
    <p style="color: red; font-style:italic;">Username / password salah</p>
<?php endif; ?>


<form action="" method="post">

    <ul>
        <li><label for="nama">Nama </label> </li>
        <li><input type="text" name="nama" id="nama" autocomplete="off"></li>
        <li><label for="password">Password </label> </li>
        <li><input type="password" name="password" id="password"></li>
        <li><input type="checkbox" name="remember" id="remembet"><label for="remember">Remember me</label></li>
        <li><button type="submit" name="Login">Login</button></li>
    </ul>

</form>

</body>
</html>