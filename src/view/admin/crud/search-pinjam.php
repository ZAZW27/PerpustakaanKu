<?php 
    include '../../../config.php';

    $idKategori = $_POST['kategori'];
    $searchVal = $_POST['value'];

    if($idKategori == ''){
        $getBook = mysqli_query($con, "SELECT tbl_buku.id_buku, image, judul, penulis, id_peminjaman
        FROM tbl_peminjaman
        INNER JOIN tbl_buku ON tbl_peminjaman.id_buku = tbl_buku.id_buku
        INNER JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku
        INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori
        WHERE (tgl_pengembalian IS NULL) AND tbl_buku.judul LIKE '%$searchVal%'
        GROUP BY tbl_peminjaman.id_buku
        ORDER BY tgl_tegat DESC;");
    }else{
        $getBook = mysqli_query($con, "SELECT tbl_buku.id_buku, image, judul, penulis, id_peminjaman
        FROM tbl_peminjaman
        INNER JOIN tbl_buku ON tbl_peminjaman.id_buku = tbl_buku.id_buku
        INNER JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku
        INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori
        WHERE (tgl_pengembalian IS NULL) AND tbl_buku.judul LIKE '%$searchVal%' AND tbl_kategori.id_kategori = '$idKategori'
        GROUP BY tbl_peminjaman.id_buku
        ORDER BY tgl_tegat DESC;");
    }
    while($book = mysqli_fetch_array($getBook)){
        $id_buku = $book['id_buku'];
?>
    <a href="#" onclick="confirmAction(<?php echo $book['id_peminjaman']; ?>)" id="buku" idBuku="<?=$book['id_buku']?>" class="w-[9rem] shadow-lg overflow-hidden md:w-[14rem] h-[17rem] md:h-[20rem] place-items-center card bg-base-300 bg-cover bg-no-repeat bg-center transition-all duration-300 ease-in-out" 
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