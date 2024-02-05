<?php 
include '../../../config.php';
session_start();

$id_user = $_SESSION['id_user'];
$id_buku = $_GET['buku'];

$unsave = mysqli_query($con, "DELETE FROM tbl_koleksi_pribadi WHERE id_user = '$id_user' AND id_buku='$id_buku'");
if($unsave){
    echo "<script>alert('berhasil save');window.history.go(-1);</script>";
    // echo "<script>alert('berhasil save');window.location='../index.php?buku=$id_buku';</script>";
}else{
    echo "<script>alert('berhasil save');window.history.go(-1);</script>";
}
?>
