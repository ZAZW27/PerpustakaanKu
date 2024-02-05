<?php 
include '../../../config.php';

$currDate = date('Y-m-d');
$tegat = date('Y-m-d', strtotime($currDate . " +12 days"));

$id_user = $_POST['id_user'];
$id_buku = $_POST['id_buku'];

$regis = mysqli_query($con, "INSERT INTO tbl_peminjaman (id_user, id_buku, tgl_peminjaman, tgl_tegat, tgl_pengembalian, status_peminjaman) 
VALUES ('$id_user', '$id_buku', '$currDate', '$tegat', NULL, 'on going')");

if($regis){
    echo "<script>alert('berhasil resgitrasi peminjaman');window.history.go(-2)</script>";
}else{
    echo "<script>alert('gagal resgitrasi peminjaman');window.history.go(-2)</script>";
}


// echo 'current ' . $currDate . ' | tegat ' . $tegat;

?>
