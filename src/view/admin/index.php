<?php include '../partials/_header.php' ?>
    <main class="relative top-16 z-[10] px-4 md:px-4 py-10 flex flex-col justify-center items-start gap-4">
        <div class="border-b border-base-300 pb-4 flex justify-start px-12 w-full">
            <a href="#" class="px-4 mx-2 border-b-2 bg-base-200 rounded-t-md border-neutral">Available</a>
            <a href="dipinjam.php" class="px-4 mx-2 border-b-2 hover:bg-base-200 rounded-t-md border-neutral">Dipinjam</a>
        </div>
        <div class="w-full relative z-[10] flex flex-row flex-wrap gap-1 md:gap-4 justify-center items-center card rounded-box p-2">
            <?php 
                $getBook = mysqli_query($con, "SELECT b.judul, b.id_buku, b.image, b.penulis, b.penerbit, p.tgl_peminjaman, p.tgl_tegat, p.tgl_pengembalian, p.status_peminjaman
                FROM tbl_buku b
                LEFT JOIN (
                    SELECT id_buku, tgl_peminjaman, tgl_tegat, tgl_pengembalian, status_peminjaman,
                        ROW_NUMBER() OVER (PARTITION BY id_buku ORDER BY tgl_peminjaman DESC) AS row_num
                    FROM
                        tbl_peminjaman
                ) p ON b.id_buku = p.id_buku AND p.row_num = 1
                WHERE p.status_peminjaman IS NULL OR p.status_peminjaman NOT IN ('late', 'on going');");
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
        </div>
    </main>
<?php include '../partials/_footer.php' ?>