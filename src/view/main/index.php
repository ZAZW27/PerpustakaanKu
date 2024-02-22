<?php include '../partials/_header.php' ?>
    <?php 
    $isCatgorySet = false;

    if(isset($_GET['kategori'])){
        $isCatgorySet = true;
    }
    else{
        $isCatgorySet = false;
    }
    ?>
    
    <div id="carousel" class="relative top-16 w-full h-[30rem] bg-red-500">
        
    </div>
    <main class="relative z-[10] px-0 md:px-3 py-4 flex flex-col justify-center items-center">
        <div class="flex flex-col justify-between items-start w-full px-0 md:px-6">
            <div class="w-full">
                <h1 class="text-xl font-semibold">Cari Buku</h1>
                <div id="category-modal" class="w-full h-12 flex justify-start items-center px-4 my-4">
                    <div class="flex gap-2 md:gap-0 md:flex-row flex-col border-b-[3px] border-slate-500/50 px-2 py-1">
                        <div class="md:border-r-2 border-b-2 md:border-b-0 border-slate-500/50 pr-1">
                            <label for="" class="text-lg font-medium">Kategori</label>
                            <select name="category-option" id="category-option" class="focus:outline-none focus:border-none focus:ring-0">
                                <option value="">all</option>
                                <?php 
                                $getSortCat = mysqli_query($con, "SELECT tbl_kategori_buku.id_kategori, tbl_kategori.nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_buku ON tbl_buku.id_buku = tbl_kategori_buku.id_buku INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori GROUP BY tbl_kategori.id_kategori;");
                                while($kat = mysqli_fetch_array($getSortCat)){
                                ?>
                                <option <?= $kat['id_kategori'] == $_GET['kategori'] ? 'selected' : '' ?> value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="pl-1">
                            <!-- <textarea id="search-bar" name="search-bar" id="" cols="30" rows="10"></textarea> -->
                            <input placeholder="Cari nama buku" id="search-bar" type="text" name="search-buku" class="focus:ring-0 focus:border-none focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="book-section" class="w-full relative z-[10] flex flex-col flex-wrap gap-2 md:gap-4 justify-start items-start card rounded-box p-2">
                <?php 
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
                <?php } ?>
                <!-- <div class="divider divider-neutral w-full">Default</div> -->
            </div>
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
                url: "crud/search-book.php",
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
    <script src="main.js"></script>
<?php include '../partials/_footer.php' ?>