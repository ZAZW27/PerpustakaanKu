
<?php 
include '../../../config.php';

$value = $_POST['value'];

if ($value == '') {
    if($isCatgorySet){
        $idKategori = $_GET['kategori'];
        $getCategory = mysqli_query($con, "SELECT tbl_kategori.id_kategori, nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE tbl_kategori.id_kategori = '$idKategori' GROUP BY tbl_kategori_buku.id_kategori;");
    }else{
        $getCategory = mysqli_query($con, "SELECT tbl_kategori.id_kategori, nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku GROUP BY tbl_kategori_buku.id_kategori;");
    }
    while($cat = mysqli_fetch_array($getCategory)){
    ?>
    <div class="divider w-full"><?= $cat['nama_kategori'] ?></div>
    <div class="w-full relative z-[10] flex flex-row flex-wrap gap-1 md:gap-4 justify-center md:justify-start items-center card rounded-box p-2">
        <?php 
            $id_kategori = $cat['id_kategori'];
            $getBook = mysqli_query($con, "SELECT tbl_buku.id_buku, image, judul, penulis FROM tbl_kategori_buku INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE id_kategori = $id_kategori LIMIT 4");
            while($book = mysqli_fetch_array($getBook)){
        ?>
            <a href="../book/index.php?buku=<?=$book['id_buku']?>" id="buku" idBuku="<?=$book['id_buku']?>" class="w-[9rem] shadow-lg overflow-hidden md:w-[14rem] h-[17rem] md:h-[20rem] place-items-center card bg-base-300 bg-cover bg-no-repeat bg-center transition-all duration-300 ease-in-out" 
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
<?php }}else{ ?>
    <div class="divider w-full">Results></div>
        <div class="w-full relative z-[10] flex flex-row flex-wrap gap-1 md:gap-4 justify-center md:justify-start items-center card rounded-box p-2">
        <?php 
        $search = mysqli_query($con, "SELECT tbl_buku.id_buku, image, judul, penulis FROM tbl_kategori_buku INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE judul LIKE '%$value%' GROUP BY id_buku;");
        while($book = mysqli_fetch_array($search)){
        ?>
        <a href="../book/index.php?buku=<?=$book['id_buku']?>" id="buku" idBuku="<?=$book['id_buku']?>" class="w-[9rem] shadow-lg overflow-hidden md:w-[14rem] h-[17rem] md:h-[20rem] place-items-center card bg-base-300 bg-cover bg-no-repeat bg-center transition-all duration-300 ease-in-out" 
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