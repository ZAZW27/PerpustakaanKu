<?php 
include '../../../config.php';

$searchVal = $_POST['value'];

if ($_POST['kategori'] == '' && $searchVal == '') {
    $getCategory = mysqli_query($con, "SELECT tbl_kategori.id_kategori, nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE judul LIKE '%$searchVal%' GROUP BY tbl_kategori_buku.id_kategori LIMIT 6;");
}
elseif($_POST['kategori'] == ''){
    $getCategory = mysqli_query($con, "SELECT tbl_kategori.id_kategori, nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE judul LIKE '%$searchVal%' GROUP BY tbl_kategori_buku.id_kategori;");
}
else{
    $idKategori = $_POST['kategori'];
    $getCategory = mysqli_query($con, "SELECT tbl_kategori.id_kategori, nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE tbl_kategori.id_kategori = '$idKategori' GROUP BY tbl_kategori_buku.id_kategori;");
} 
while($cat = mysqli_fetch_array($getCategory)){
?>
    <div class="divider divider-start text-3xl font-thin w-full mb-2 mt-10"><?= $cat['nama_kategori'] ?></div>
    <div class="w-full relative z-[10] flex flex-row flex-wrap gap-1 md:gap-4 justify-center md:justify-start items-center card rounded-box p-2">
        <?php 
            $id_kategori = $cat['id_kategori'];
            if($searchVal == ''){
                $getBook = mysqli_query($con, "SELECT tbl_buku.id_buku, image, judul, penulis FROM tbl_kategori_buku INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE id_kategori = $id_kategori LIMIT 4");
            }
            $getBook = mysqli_query($con, "SELECT tbl_buku.id_buku, image, judul, penulis FROM tbl_kategori_buku INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE id_kategori = $id_kategori AND judul LIKE '%$searchVal%'");
            while($book = mysqli_fetch_array($getBook)){
        ?>
            <a href="../book/index.php?buku=<?=$book['id_buku']?>" id="buku" idBuku="<?=$book['id_buku']?>" class="w-[9rem] myShadow overflow-hidden md:w-[14rem] h-[17rem] md:h-[20rem] place-items-center card bg-base-300 bg-cover bg-no-repeat bg-center transition-all duration-300 ease-in-out" 
            style="background-image: url('../../../public/images/buku/<?=$book['image'] > 0 ? $book['image'] : 'notfound.jpeg' ?>');">
                <div class="w-full h-full hover:bg-gradient-to-t from-slate-900/80 to-slate-900/0 transition-all duration-300 ease-in-out flex flex-col justify-end items-start px-2 py-2 text-transparent hover:text-white">
                    <h1 class="text-md"><?= $book['judul'] ?></h1>
                    <div class="flex justify-end text-sm font-extralight w-full">
                        <p>- </p>
                        <p class=""><?= $book['penulis'] ?></p>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
<?php } ?>