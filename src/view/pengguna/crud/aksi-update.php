<?php 

include '../../../config.php';

$id_user = $_POST['id_user'];
$username = $_POST['username'];
$email = $_POST['email'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
$level = $_POST['level'];

if($_POST['password'] > 0){
    $password = md5($_POST['password']);
    $update = mysqli_query($con, "UPDATE tbl_user SET username='$username', email='$email',
    nama_lengkap='$nama_lengkap',alamat='$alamat',level='$level',password='$password' WHERE id_user='$id_user'");
    if($update){
        echo "<script>alert('berhasil update');window.location='../index.php'</script>";
    }else{
        echo "<script>alert('gagal update');window.location='../index.php'</script>";
    }
}else{
    $update = mysqli_query($con, "UPDATE tbl_user SET username='$username', email='$email',
    nama_lengkap='$nama_lengkap',alamat='$alamat',level='$level' WHERE id_user='$id_user'");

    if($update){
        echo "<script>alert('berhasil update');window.location='../index.php'</script>";
    }else{
        echo "<script>alert('gagal update');window.location='../index.php'</script>";
    }
}


?>
