<?php 
include '../../../config.php';

$username = $_POST['username'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$nama_lengkap = $_POST['nama_lengkap'];
$password = md5($_POST['password']);

$regis = mysqli_query($con, "INSERT INTO tbl_user (username, password, email, nama_lengkap, alamat, level) 
VALUES ('$username', '$password', '$email', '$nama_lengkap', '$alamat', 'peminjam')");

if($regis){
    echo "<script>alert('sudah masuk');window.location='../login.html'</script>";
}else{
    echo "<script>alert('sudah masuk');window.location='../regis.html'</script>";
}

?>

