<?php 
include '../../../config.php';

$rating = $_POST['rate'];
$ulasan = $_POST['ulasan'];
$idBuku = $_POST['idBuku'];
$idUser = $_POST['idUser'];

$unduh = mysqli_query($con, "INSERT INTO ulasanbuku (id_user, id_buku, ulasan, rating)
VALUE ('$idUser', '$idBuku', '$ulasan', '$rating')");

if ($unduh){
    echo "<script>window.location='../index.php?buku=$idBuku'</script>";
}
else{
    echo 'oh nooo error :(';
}


?>
