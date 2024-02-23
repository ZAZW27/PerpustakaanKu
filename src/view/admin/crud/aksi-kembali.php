<?php 
include '../../../config.php';
$id_peminjaman = $_GET['peminjaman'];
$currDate = date("Y-m-d");

$seeBook = mysqli_query($con, "SELECT * FROM tbl_peminjaman INNER JOIN tbl_buku ON tbl_peminjaman.id_buku = tbl_buku.id_buku WHERE id_peminjaman = '$id_peminjaman'");

$f = mysqli_fetch_array($seeBook);


if ($seeBook) {
    $status = $f['tgl_tegat'] < $currDate ? 'late retrieved' : 'retrieved';
    $kembalikan  = mysqli_query($con, "UPDATE tbl_peminjaman SET tgl_pengembalian = '$currDate', status_peminjaman = '$status' WHERE id_peminjaman = '$id_peminjaman'");
    
    if($kembalikan){
        echo "<script>alert('buku sudah dikembalikan');window.history.go(-2);</script>";
    }
    else{
        echo "<script>alert('gagal sudah dikembalikan');window.history.go(-2);</script>";
    }
}


?>

