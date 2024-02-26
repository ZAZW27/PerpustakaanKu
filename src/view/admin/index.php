<?php include '../partials/_header.php' ?>
    <main class="relative top-16 z-[10] px-4 md:px-4 py-10 flex flex-col justify-center items-start gap-4">
        <div class="border-b border-base-300 pb-4 flex flex-col md:flex-row-reverse justify-around px-2 w-full">
            <div class="flex px-10">
                <a href="#" class="px-4 mx-2 border-b-[2.4px] rounded-t-md border-blue-900 bg-gradient-to-t from-sky-500/20 to-sky-500/0 font-medium">Available</a>
                <a href="dipinjam.php" class="px-4 mx-2 border-b-[2.4px] hover:bg-gradient-to-t from-sky-300/20 to-sky-500/0 rounded-t-md border-blue-900 font-medium transition-all duration-150 ease-in-out">Dipinjam</a>
            </div>
            <div class="flex gap-2 md:gap-0 md:flex-row flex-col border-b-[3px] border-slate-500/50 px-2 py-1">
                <div class="md:border-r-2 border-b-2 md:border-b-0 border-slate-500/50 pr-1">
                    <label for="" class="text-lg font-normal">Kategori</label>
                    <select name="category-option" id="category-option" class="focus:outline-none focus:border-none focus:ring-0 bg-transparent">
                        <option value="">all</option>
                        <?php 
                        $getSortCat = mysqli_query($con, "SELECT tbl_kategori_buku.id_kategori, tbl_kategori.nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_buku ON tbl_buku.id_buku = tbl_kategori_buku.id_buku INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori GROUP BY tbl_kategori.id_kategori;");
                        while($kat = mysqli_fetch_array($getSortCat)){
                        ?>
                        <option <?= isset($_GET['kategori']) ? $kat['id_kategori'] == $_GET['kategori'] ? 'selected' : '' : '' ?> value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="pl-1 w-full md:w-[20vw] ">
                    <!-- <textarea id="search-bar" name="search-bar" id="" cols="30" rows="10"></textarea> -->
                    <input placeholder="Cari nama buku" id="search-bar" type="text" name="search-buku" class="focus:ring-0 focus:border-none focus:outline-none bg-transparent w-full">
                </div>
            </div>
        </div>
        
        <div id="book-section" class="w-full relative z-[10] flex flex-row flex-wrap gap-1 md:gap-4 justify-center items-center card rounded-box p-2">
            <?php 
                $getBook = mysqli_query($con, "SELECT b.judul, b.id_buku, b.image, b.penulis, b.penerbit, p.tgl_peminjaman, p.tgl_tegat, p.tgl_pengembalian, p.status_peminjaman
                FROM tbl_buku b
                LEFT JOIN (
                    SELECT id_buku, tgl_peminjaman, tgl_tegat, tgl_pengembalian, status_peminjaman,
                        ROW_NUMBER() OVER (PARTITION BY id_buku ORDER BY tgl_peminjaman DESC) AS row_num
                    FROM tbl_peminjaman
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
    <script>
        
        $('#search-bar').on('input', searchBook)
        $('#category-option').on('change', searchBook)

        function searchBook(){
            var searchValue = $('#search-bar').val();
            var catergoryOpt = $('#category-option').val()
            
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: "crud/search-avail.php",
                data: {value: searchValue, kategori: catergoryOpt}, 
                success: function (msg){
                    $('#book-section').html(msg)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors during the AJAX request
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            })
        }
    </script>
<?php include '../partials/_footer.php' ?>