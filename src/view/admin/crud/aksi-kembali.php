<?php 
include '../../../config.php';
$id_peminjaman = $_GET['peminjaman'];
$currDate = date("Y-m-d");

$kembalikan  = mysqli_query($con, "UPDATE tbl_peminjaman SET tgl_pengembalian = '$currDate', status_peminjaman = 'retrieved' WHERE id_peminjaman = '$id_peminjaman'");

if($kembalikan){
    echo "<script>alert('buku sudah dikembalikan');window.history.go(-2);</script>";
}
else{
    echo "<script>alert('gagal sudah dikembalikan');window.history.go(-2);</script>";
}
?>

