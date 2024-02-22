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
    
    <div class="relative top-16 w-full md:h-[30rem] h-[90vh] bg-red-500 overflow-clip">
        <div id="banner" class="w-full h-full bg-blue-600/50 absolute" style="top: 0px;">
            <div class="bg-no-repeat bg-cover bg-bottom w-full h-full" style="background-image: url('../../../public/images/background/library.jpg')">
                <div class="w-full h-full flex flex-col justify-center items-center text-white" style="background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0,  0.5));">
                    <h1 class="text-center text-5xl font-normal">WELCOME TO <span class="text-center  italic">LIBRARY</span></h1>
                    <p class="text-center text-md font-thin leading-9 mt-1"><?= $level ?></p>
                    <h1 class="text-center text-4xl font-thin"><?= $nama_lengkap ?></h1>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $(window).scroll(function(){
                    var scrollVal = $(this).scrollTop();
                    
                    var bannerScrolling = (scrollVal * 0.4) + "px"
                    // Apply the new object-position value to the '#banner' element
                    $('#banner').css("top",bannerScrolling );
                });
            });
        </script>
    </div>
    <main class="relative mt-16 z-[10] px-2 md:px-3 py-4 flex flex-col justify-center items-center">
        <div class="flex flex-col justify-between items-start w-full px-0 md:px-6">
            <div class="w-full">
                <h1 class="text-3xl font-light">Cari Buku</h1>
                <div id="category-modal" class="w-full h-12 flex md:flex-row flex-col justify-start items-center px-4 my-4">
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
                    <div class="ml-auto">
                        <marquee class="w-full font-normal" behavior="scroll" direction="left">Ingin <span class="font-medium">meminjam</span> buku? Kunjungilah perpustakaan Balikpapan dan registrasi melalui administrator kami!</marquee> </h1>
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
                    <div class="divider divider-start text-3xl font-thin w-full mb-2 mt-10"><?= $cat['nama_kategori'] ?></div>
                    <div class="w-full relative z-[10] flex flex-row flex-wrap gap-1 md:gap-4 justify-center md:justify-start items-center card rounded-box p-2">
                        <?php 
                            $id_kategori = $cat['id_kategori'];
                            $getBook = mysqli_query($con, "SELECT tbl_buku.id_buku, image, judul, penulis FROM tbl_kategori_buku INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE id_kategori = $id_kategori LIMIT 6");
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