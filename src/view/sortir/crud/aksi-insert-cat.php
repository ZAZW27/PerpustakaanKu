
<?php 
include '../../../config.php';

$nama = $_POST['nama_kategori'];

$insert = mysqli_query($con, "INSERT INTO tbl_kategori (nama_kategori) VALUES ('$nama')");

if($insert)
{
    echo '<script>alert("berhasil menambahkan");window.history.go(-2)</script>';
}

?>

