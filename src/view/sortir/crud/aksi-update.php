<?php 
include '../../../config.php';

$id_buku = $_POST['id_buku'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
$kategori = $_POST['kategori'];

if ($_FILES['gambar']["name"] > 0) {
    // Combine the variables to create a new file name
    $newFileName = $judul . '_' . $penulis . '_' . $penerbit . '_' . $tahun_terbit;
    
    // Get the file extension from the original file name
    $fileExtension = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    
    // Create the new file name with the extension
    $gambar =  rand(1, 10000) . '_' . $newFileName . '.' . $fileExtension;
    
    $uploadPath = '../../../../public/images/buku/';
    
    $destinationPath = $uploadPath . $gambar;

    if(move_uploaded_file($_FILES['gambar']['tmp_name'], $destinationPath)){
        $update = mysqli_query($con, "UPDATE tbl_buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', image='$gambar', tahun_terbit='$tahun_terbit' WHERE id_buku = '$id_buku'");
        if ($update) {
            echo "<script>alert('BERHAISL: menambahkan buku');window.history.go(-2);</script>";
        }
        else{
            echo "<script>alert('GAGAL: menambahkan buku');window.history.go(-1);</script>";
        }
    }
}else{
    echo 'echo 1';
    $update = mysqli_query($con, "UPDATE tbl_buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit' WHERE id_buku = '$id_buku'");
    if ($update) {
        $cattegorize = mysqli_query($con, "UPDATE tbl_kategori_buku SET id_kategori = '$kategori' WHERE id_buku = '$id_buku'");
        if($cattegorize){
            echo "<script>alert('BERHAISL: menambahkan buku');window.history.go(-2);</script>";
        }
    }
    else{
        echo "<script>alert('GAGAL: menambahkan buku');window.history.go(-1);</script>";
    }
}

?>

