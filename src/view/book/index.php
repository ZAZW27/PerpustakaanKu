<?php include '../partials/_header.php' ?>
    <?php 
    if(!isset($_GET['buku'])){
        header('location:../main/index.php');
    }
    $idBuku = $_GET['buku'];
    $getBook = mysqli_query($con, "SELECT * FROM tbl_buku WHERE id_buku = '$idBuku'");
    $f = mysqli_fetch_array($getBook);
    ?>
    <main class="relative top-16 z-[10] px-0 md:px-3 py-4 flex flex-col md:flex-row justify-center items-center gap-4">
        <img class="min-h-[30rem] max-h-[30rem] shadow-xl rounded-lg" src="../../../public/images/buku/<?=$f['image'] > 0 ? $f['image'] : 'notfound.jpeg' ?>" alt="">
        <div class="bg-base-200 p-4 self-start">
            <h1 class="text-2xl font-bold"><span class="font-medium">Ditulis oleh:</span> <?= $f['penulis'] ?></h1>
            <h1 class="text-2xl font-bold"><span class="font-medium">Diterbitkan oleh:</span> <?= $f['penerbit'] ?></h1>
            <h1 class="text-2xl font-bold"><span class="font-medium">Diterbitkan pada:</span> <?= $f['tahun_terbit'] ?></h1>
            <h1 class="mt-4">
                Catergories: 
                <?php 
                $getCat = mysqli_query($con, "SELECT nama_kategori, tbl_kategori.id_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori INNER JOIN tbl_buku ON tbl_buku.id_buku = tbl_kategori_buku.id_buku WHERE tbl_buku.id_buku = $idBuku");
                while($cat = mysqli_fetch_array($getCat)){
                ?>
                    <a href="../main/index.php?kategori=<?= $cat['id_kategori'] ?>" class="btn btn-sm btn-info my-1"><?= $cat['nama_kategori'] ?></a>
                <?php } ?>
            </h1>
            <?php 
            $getCol = mysqli_query($con, "SELECT * FROM tbl_koleksi_pribadi WHERE id_user = '$id_user' and id_buku = '$idBuku';");
            if(mysqli_num_rows($getCol) > 0){
            ?>
                <a href="crud/unsave.php?buku=<?=$idBuku?>" id="unsave" class="btn btn-success btn-sm mt-3 ">Disimpan</a>
            <?php }else{ ?>
                <a href="crud/save.php?buku=<?=$idBuku?>" id="save" class="btn btn-info btn-sm mt-3 ">Simpan buku +</a>
            <?php } ?>
        </div>
        <div>
            woi ada kha ini 
        </div>
        <!-- <div class="w-full md:w-7/12 rounded-md shadow-xl h-[30rem] md:h bg-base-200 bg-no-repeat bg-center bg-contain" style="background-image: url('../../../public/images/buku/<?=$f['image'] > 0 ? $f['image'] : 'notfound.jpeg' ?>')"></div> -->
    </main>
<?php include '../partials/_footer.php' ?>