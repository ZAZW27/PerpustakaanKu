<?php 
session_start();
include '../../../config.php';  

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($con, "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'");
$userData = mysqli_fetch_array($login);
if (mysqli_num_rows($login) > 0) {

    $_SESSION['username'] = $username;
    $_SESSION['id_user'] = $userData['id_user'];
    $_SESSION['nama_lengkap'] = $userData['nama_lengkap'];
    $_SESSION['level'] = $userData['level'];

    echo "<script>alert('berhasil measuk selamat datang ke perpus!');window.location='../../main/index.php'</script>";
}
else{
    echo "<script>alert('GAGAL measuk selamat datang ke perpus!');window.location='../../main/index.php'</script>";
}
?>

