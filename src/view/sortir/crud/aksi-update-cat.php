<?php 
include '../../../config.php';

$id_kat = $_POST['id_kategori'];
$nama = $_POST['nama_kategori'];

$update = mysqli_query($con, "UPDATE tbl_kategori SET nama_kategori='$nama' WHERE id_kategori='$id_kat'");

if($update){
    echo "<script>alert('berhasil update');window.history.back()</script>";
}


?>
