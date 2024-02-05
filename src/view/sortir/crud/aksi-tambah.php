<?php 

include '../../../config.php';
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
$kategori = $_POST['kategori'];

if (isset($_FILES['gambar'])) {
    $newFileName = $judul . '_' . $penulis . '_' . $penerbit . '_' . $tahun_terbit;
    
    $fileExtension = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    
    $gambar =  rand(1, 10000) . '_' . $newFileName . '.' . $fileExtension;
    
    $uploadPath = '../../../../public/images/buku/';
    
    $destinationPath = $uploadPath . $gambar;

    if(move_uploaded_file($_FILES['gambar']['tmp_name'], $destinationPath)){
        $insert = mysqli_query($con, "INSERT INTO tbl_buku (judul, penulis, penerbit, image, tahun_terbit)
        VALUES ('$judul', '$penulis', '$penerbit', '$gambar', '$tahun_terbit')");
        if ($insert) {
            $getLatestBuku = mysqli_query($con, "SELECT id_buku FROM tbl_buku ORDER BY id_buku DESC LIMIT 1");
            $id_buku = mysqli_fetch_array($getLatestBuku)['id_buku'];
            $cattegorize = mysqli_query($con, "INSERT INTO tbl_kategori_buku (id_buku, id_kategori)
            VALUES ('$id_buku', '$kategori')");
            if($cattegorize){
                echo "<script>alert('BERHAISL: menambahkan buku');window.history.go(-2);</script>";
            }
        }
        else{
            echo "<script>alert('GAGAL: menambahkan buku');window.history.go(-1);</script>";
        }
    }
    // echo 'something 1';
}else{
    echo 'something 2';
    $insert = mysqli_query($con, "INSERT INTO tbl_buku (judul, penulis, penerbit, image, tahun_terbit)
    VALUES ('$judul', '$penulis', '$penerbit', NULL, '$tahun_terbit')");
    if ($insert) {
        $getLatestBuku = mysqli_query($con, "SELECT id_buku FROM tbl_buku ORDER BY id_buku DESC LIMIT 1");
        $id_buku = mysqli_fetch_array($getLatestBuku)['id_buku'];
        $cattegorize = mysqli_query($con, "INSERT INTO tbl_kategori_buku (id_buku, id_kategori)
        VALUES ('$id_buku', '$kategori')");
        if($cattegorize){
            echo "<script>alert('BERHAISL: menambahkan buku');window.history.go(-2);</script>";
        }
    }
    else{
        echo "<script>alert('GAGAL: menambahkan buku');window.history.go(-1);</script>";
    }
}

?>

