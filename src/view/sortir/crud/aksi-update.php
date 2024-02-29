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
        if (!$update) {
            echo "<script>alert('GAGAL: update buku');window.history.go(-1);</script>";
            return;
        }
    
        $deleteOldCategory = mysqli_query($con, "DELETE FROM tbl_kategori_buku WHERE id_buku = '$id_buku'");
        if(!$deleteOldCategory){
            echo "<script>alert('GAGAL: Hapus kategori');window.history.go(-1);</script>";
            return;
        }
    
        $rep = 0;
        foreach($kategori as $k => $v){
            $id_kategori = $kategori[$rep];
            $insertNewCategory = mysqli_query($con, "INSERT INTO tbl_kategori_buku (id_buku, id_kategori) VALUES ('$id_buku', '$id_kategori')");
    
            if(!$insertNewCategory){
                echo "<script>alert('GAGAL: Insert kategori baru');window.history.go(-1);</script>";
                return;
            }
    
            $rep ++;
        }
    
        echo "<script>alert('BERHASIL: Update kategori baru');window.history.go(-1);</script>";
    }
}else{
    $update = mysqli_query($con, "UPDATE tbl_buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit' WHERE id_buku = '$id_buku'");
    if (!$update) {
        echo "<script>alert('GAGAL: update buku');window.history.go(-1);</script>";
        return;
    }

    $deleteOldCategory = mysqli_query($con, "DELETE FROM tbl_kategori_buku WHERE id_buku = '$id_buku'");
    if(!$deleteOldCategory){
        echo "<script>alert('GAGAL: Hapus kategori');window.history.go(-1);</script>";
        return;
    }

    $rep = 0;
    foreach($kategori as $k => $v){
        $id_kategori = $kategori[$rep];
        $insertNewCategory = mysqli_query($con, "INSERT INTO tbl_kategori_buku (id_buku, id_kategori) VALUES ('$id_buku', '$id_kategori')");

        if(!$insertNewCategory){
            echo "<script>alert('GAGAL: Insert kategori baru');window.history.go(-1);</script>";
            return;
        }

        $rep ++;
    }

    echo "<script>alert('BERHASIL: Update kategori baru');window.history.go(-1);</script>";
}

?>

