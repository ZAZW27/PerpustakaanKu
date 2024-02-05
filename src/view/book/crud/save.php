<?php 
include '../../../config.php';
session_start();

$id_user = $_SESSION['id_user'];
$id_buku = $_GET['buku'];

$save = mysqli_query($con, "INSERT INTO tbl_koleksi_pribadi (id_user, id_buku) VALUES ('$id_user', '$id_buku')");
if($save){
    echo "<script>alert('berhasil save');window.history.go(-1);</script>";
    // echo "<script>alert('berhasil save');window.location='../index.php?buku=$id_buku';</script>";
}else{
    echo "<script>alert('berhasil save');window.history.go(-1);</script>";
}
    
?>
