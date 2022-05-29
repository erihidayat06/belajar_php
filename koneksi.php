<?php

$conn = mysqli_connect("LocalHost","root","","db_sepatu");


// Function menampilkan data
function query($query){
    global $conn;
    $rutern = mysqli_query($conn,$query);
    $rows = [];

    // mysqli_fetch_assoc (mengambil data dari table)
    while($row = mysqli_fetch_assoc($rutern)){   
        $rows[] = $row ;
    }
    
    return $rows;
}

// Function menambah barang
function tambah($data){
    global $conn;
    $nama = htmlspecialchars($data["nama"]) ;
    $ukuran = htmlspecialchars($data["ukuran"]);
    $harga = htmlspecialchars($data["harga"]);
    $gambar = upload();
    if (!$gambar) {
     return false;
    }
    
    $query = "INSERT INTO sepatu
                VALUES('','$nama','$ukuran','$harga','$gambar')";

    
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
                
}


// Function upload

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpnama =$_FILES['gambar']['tmp_name'];
    
    if ($error === 4) {
        echo "<script>
        alert('Pilih Gambar terlebih dahulu!')
        </script>"; 
    return false;  
 }

 $gambarValid = ['jpg','jpng','png'];
 $ekstensiGambar = explode('.', $namaFile);
 $ekstensiGambar = strtolower( end ($ekstensiGambar));
 if (!in_array($ekstensiGambar,$gambarValid)) {
    echo "<script>
    alert('yang anda upload bukan gambar !')
    </script>"; 
    return false;
 }

 if ($ukuranFile > 1000000) {
    echo "<script>
    alert('ukuran gambar terlalu besar !')
    </script>"; 
    return false;
 }

 $namaFile = uniqid();
 $namaFile .= '.';
 $namaFile .= $ekstensiGambar;

 move_uploaded_file($tmpnama,'img/'.$namaFile);

 return $namaFile;
}

// Function Menghapus data
function hapus($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM sepatu WHERE id= $id");

    return mysqli_affected_rows($conn);
}

//  Function mengubah data
function ubah($data){
    global $conn;
    $id = ($data["id"]);
    $nama = htmlspecialchars($data["nama"]) ;
    $ukuran = htmlspecialchars($data["ukuran"]);
    $harga = htmlspecialchars($data["harga"]);

    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }

    
    
    $query = "UPDATE sepatu SET 
              nama = '$nama',
              ukuran = '$ukuran',
              harga = '$harga',
              gambar = '$gambar'
              WHERE id = $id  
              ";

    
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
      
}


// Function mencari data
function cari($kataKunci){
    $query = "SELECT * FROM sepatu WHERE 
    nama LIKE '%$kataKunci%' OR
    ukuran LIKE '%$kataKunci%' OR
    harga LIKE '%$kataKunci%'
    
    
    ";

    return query($query);
}


// Functin regestrasi

function registrasi($data){
    global $conn;
    $username = strtolower(stripslashes($data["nama"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);


    $result = mysqli_query($conn, "SELECT nama FROM user WHERE nama = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script> alert('nama tidak ada')</script>";
        return false;
    }
    if ($password !== $password2) {
        echo "<script> alert('konfirmasi password tidak sesuai')</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    

    mysqli_query($conn, "INSERT INTO user VALUES ('','$username','$password')");

    return mysqli_affected_rows($conn);

}




?>
