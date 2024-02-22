<?php 
    include '../../../config.php';

    $idKategori = $_POST['kategori'];
    $searchVal = $_POST['value'];

    if ($idKategori == ''){
        $getBook = mysqli_query($con, "SELECT b.judul, b.id_buku, b.image, b.penulis, b.penerbit, p.tgl_peminjaman, p.tgl_tegat, p.tgl_pengembalian, p.status_peminjaman
            FROM tbl_buku b
            INNER JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = b.id_buku
            INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori
            LEFT JOIN (
                SELECT id_buku, tgl_peminjaman, tgl_tegat, tgl_pengembalian, status_peminjaman,
                    ROW_NUMBER() OVER (PARTITION BY id_buku ORDER BY tgl_peminjaman DESC) AS row_num
                FROM tbl_peminjaman
            ) p ON b.id_buku = p.id_buku AND p.row_num = 1
            WHERE (p.status_peminjaman IS NULL OR p.status_peminjaman NOT IN ('late', 'on going')) 
            AND b.judul LIKE '%$searchVal%'
            GROUP BY b.id_buku;"
        );
    }else{
        $getBook = mysqli_query($con, "SELECT b.judul, b.id_buku, b.image, b.penulis, b.penerbit, p.tgl_peminjaman, p.tgl_tegat, p.tgl_pengembalian, p.status_peminjaman
            FROM tbl_buku b
            INNER JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = b.id_buku
            INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori
            LEFT JOIN (
                SELECT id_buku, tgl_peminjaman, tgl_tegat, tgl_pengembalian, status_peminjaman,
                    ROW_NUMBER() OVER (PARTITION BY id_buku ORDER BY tgl_peminjaman DESC) AS row_num
                FROM tbl_peminjaman
            ) p ON b.id_buku = p.id_buku AND p.row_num = 1
            WHERE (p.status_peminjaman IS NULL OR p.status_peminjaman NOT IN ('late', 'on going')) 
            AND b.judul LIKE '%$searchVal%' AND tbl_kategori.id_kategori = '$idKategori'
            GROUP BY b.id_buku;"
        );
    }
    while($book = mysqli_fetch_array($getBook)){
?>
    <a href="register.php?buku=<?=$book['id_buku']?>" id="buku" idBuku="<?=$book['id_buku']?>" class="w-[9rem] shadow-lg overflow-hidden md:w-[14rem] h-[17rem] md:h-[20rem] place-items-center card bg-base-300 bg-cover bg-no-repeat bg-center transition-all duration-300 ease-in-out" 
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