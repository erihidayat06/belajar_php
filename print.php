<?php 

require "koneksi.php";

$id = $_GET["id"];

$sepatu = query("SELECT * FROM sepatu WHERE id = $id")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <style>
        table{
            text-align: center;
        }
    </style>
</head>
<body>
<table border="1" cellpadding="10">

<?php $i = 1 ?>

    <tr>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Ukuran</th>
        <th>Harga</th>
    </tr>
    <tr>
        <td><img src="img/<?= $sepatu["gambar"]; ?>" alt="" width="50px"></td>
        <td><?= $sepatu["nama"]; ?></td>
        <td><?= $sepatu["ukuran"]; ?></td>
        <td><?= $sepatu["harga"]; ?></td>
    </tr>
    </table>


    <script>    
        window.print("hallo");
    </script>

</body>
</html>