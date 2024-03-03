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
    
    <main class="relative top-16 z-[10] py-4 flex flex-col justify-center items-center">
        <div class="flex flex-col justify-between items-start w-full">
            <!-- <div class="w-full md:px-4">
                <h1 class="text-3xl font-light select-none">Cari Buku</h1>
                <form action="crud/aksi-rinci.php" method="post" id="category-modal" class="w-full bg-[#008170] px-2 md:py-4 md:px-6  text-white flex md:flex-row flex-col justify-start items-center my-4 md:rounded-t-lg md:rounded-b-sm">
                    <div class="flex gap-6 md:gap-0 md:flex-row w-full md:w-auto my-4 pl-2 md:my-0 flex-col md:border-l-[3px] border-l-[5px] border-[#c8e661] md:px-4 py-1">
                        <div class="md:border-r-2 border-b-2 md:border-b-0 border-slate-500/50 pr-1 flex  items-center">
                            <input placeholder="Cari nama buku" id="search-bar" type="text" name="search-buku" class="focus:ring-0 placeholder:text-slate-300 focus:border-none focus:outline-none bg-transparent w-full">
                        </div>
                        <div class="pl-1 w-full md:w-[20vw] ">
                            <label for="" class="text-lg font-normal">Kategori</label>
                            <select name="category-option" id="category-option" class="focus:outline-none focus:border-none focus:ring-0 bg-transparent text-slate-300">
                                <option value="">all</option>
                                <?php
                                $getSortCat = mysqli_query($con, "SELECT tbl_kategori_buku.id_kategori, tbl_kategori.nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_buku ON tbl_buku.id_buku = tbl_kategori_buku.id_buku INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori GROUP BY tbl_kategori.id_kategori;");
                                while($kat = mysqli_fetch_array($getSortCat)){
                                ?>
                                <option class="text-black" <?= isset($_GET['kategori']) ? $kat['id_kategori'] == $_GET['kategori'] ? 'selected' : '' : '' ?> value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="justify-self-start">
                        <button class="bg-[#a1e661] hover:bg-lime-500/80 hover:rounded-md mx-2 transition-all duration-100 ease-in hover:text-white text-black  font-semibold px-3 py-1">
                            Search
                        </button>
                    </div>
                    <div class="ml-auto w-full md:w-[40vw]">
                        <marquee class="w-full font-normal" behavior="scroll" direction="left">Ingin <span class="font-medium">meminjam</span> buku? Kunjungilah perpustakaan Balikpapan dan registrasi melalui administrator kami!</marquee> </h1>
                    </div>
                </form>
            </div> -->
            
            <div id="book-section" class="w-full relative z-[10] flex flex-col md:flex-row gap-2 px-2">
                <form class="md:col-span-1 md:h-auto md:pl-3 md:border-r-[0.4rem] border-[#a1e661] w-full md:w-[40rem]">
                    <div class="sticky top-16 w-full">
                        <h1 class="text-black text-3xl md:text-4xl font-thin">Search Book</h1>
                        <div class="flex flex-col overflow-x-auto md:overflow-x-clip mt-3 gap-2 pr-4 w-full">
                            <div class="w-full">
                                <input id="search-query" type="text" class="w-full bg-transparent border-b-2 border-slate-600 focus:ring-0 focus:outline-none" placeholder="🔍search book">
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <?php 
                                $getCategory = mysqli_query($con, "SELECT * FROM tbl_kategori");

                                while($cat = mysqli_fetch_array($getCategory)){
                                
                                ?>
                                <div class="form-control">
                                    <label class="label py-1 cursor-pointer justify-start gap-2">
                                        <input type="checkbox" id="kategori-check" name="kategori[]" value="<?=$cat['id_kategori']?>" class="checkbox checkbox-sm border-2 border-slate-700" />
                                        <span class="label-text"><?=$cat['nama_kategori'] ?></span> 
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="md:col-span-3 md:border-t-0 border-t-[6px] border-[#a1e661] flex flex-col gap-8">
                    <div id="recent-upload" class="mt-4 md:mt-0">
                        <div class="flex justify-between items-cente ">
                            <h1 class="text-black text-3xl md:text-4xl font-thin">Search Result</h1>
                        </div>
                        <div id="book-container" class="w-full md:px-4 flex justify-center md:justify-center flex-wrap items-center gap-3 py-3">
                            <!-- MULAI DARI CONTAINER BUKU -->
                            <?php 
                            $getRecent = mysqli_query($con, 
                                "SELECT 
                                    tbl_buku.*, 
                                    ROUND(AVG(rating), 1) as rate,
                                    tbl_koleksi_pribadi.id_user 
                                FROM tbl_buku 
                                LEFT JOIN ulasanbuku ON tbl_buku.id_buku = ulasanbuku.id_buku
                                LEFT JOIN tbl_koleksi_pribadi ON tbl_koleksi_pribadi.id_buku = tbl_buku.id_buku
                                GROUP BY tbl_buku.id_buku order by tbl_buku.id_buku DESC ;"
                                );
                            while($book = mysqli_fetch_array($getRecent)){
                                $fetchBook = $book['id_buku'];
                                $getCollection = mysqli_query($con, "SELECT id_user FROM tbl_koleksi_pribadi WHERE id_user = '$id_user' AND id_buku = '$fetchBook'");
                                $checkCollection = (mysqli_fetch_array($getCollection) > 0) ? True: False;
                            ?>
                            <div id="book" idBuku="<?=$book['id_buku']?>" class="w-[10rem] md:w-[10.3rem] h-[18rem] md:h-[18rem] bg-cover bg-no-repeat bg-center shadow-lg shadow-slate-600/60 cursor-pointer hover:scale-105 transition-all duration-200 ease-out" style="background-image: url('../../../public/images/buku/<?=$book['image'] > 0 ? $book['image'] : 'notfound.jpeg' ?>');"> 
                                <div class="flex flex-col w-full h-full justify-end">
                                    <div class="h-full w-full flex justify-end items-end relative z-[11] px-1" style="background: linear-gradient(to top, rgba(9, 38, 53, 0.9), rgba(9, 38, 53, 0.7), rgba(9, 38, 53, 0.4), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0));">
                                        <div class="overflow-x-scroll flex items-end gap-1 relative top-4 z-10 w-full justify-start whitespace-nowrap rounded-sm">
                                            <?php 
                                            $id_buku = $book['id_buku'];
                                            $categoryQuery = mysqli_query($con, 
                                                "SELECT tbl_kategori.id_kategori, tbl_kategori.nama_kategori 
                                                FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori
                                                WHERE id_buku = '$id_buku'
                                            ");
    
                                            while($fetchCat = mysqli_fetch_array($categoryQuery)){
                                            ?>
                                            
                                            <p id="spec-cat" idBuku="<?=$fetchCat['id_kategori']?>" class="bg-[#53cbff] text-slate-900 relative rounded-sm px-0.5 text-[0.8rem] font-bold flex-shrink-0">
                                                <?= $fetchCat['nama_kategori'] ?>
                                            </p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="w-full h-[6rem] px-2 pb-1 text-white bg-[rgb(9,38,53)]/90 relative z-[11]">
                                        <div class="text-[0.7rem] grid grid-cols-8 h-11 ">
                                            <h1 class="text-sm leading-5 col-span-7 overflow-hidden"><?= (strlen($book['judul']) > 28) ? substr($book['judul'], 0, 28) . '..' : $book['judul'] ?></h1>
                                            <div href="#" id="koleksi" class="col-span-1 relative left-1 md:left-0.5 transition-all duration-200 ease-linear">
                                                <input value="<?=$book['id_buku']?>" id="idBuku" hidden/>
                                                <input value="<?=$id_user?>" id="idUser" hidden/>
                                                <input value="<?=$book['id_user'] == $id_user ? 'true' : 'false'?>" id="isSaved" hidden/>
                                                <svg width="2rem" height="2rem" viewBox="-3.8 -3.8 27.60 27.60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>bookmark_fill [#1227]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="1.22" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-265.000000, -2679.000000)" 
                                                fill="<?= $checkCollection ? '#ffffff' : '#fbfbfb00'?>"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M219,2521 L219,2537.998 C219,2538.889 217.923,2539.335 217.293,2538.705 L214.707,2536.119 C214.317,2535.729 213.683,2535.729 213.293,2536.119 L210.707,2538.705 C210.077,2539.335 209,2538.889 209,2537.998 L209,2521 C209,2519.895 209.895,2519 211,2519 L217,2519 C218.105,2519 219,2519.895 219,2521" id="bookmark_fill-[#1227]"> </path> </g> </g> </g> </g></svg>
                                            </div>
                                        </div>
                                        <div class="text-slate-200/90 text-[0.7rem] leading-3 grid grid-cols-2 h-8 ">
                                            <p idbuku='<?=$book['id_buku']?>' class="col-span-1 text-start"><?= (strlen($book['penulis']) > 27) ? substr($book['penulis'], 0, 27) . '..' : $book['penulis'] ?></p>
                                            <p class="col-span-1 flex justify-end items-start"><?= date('d M Y', strtotime($book['tahun_terbit'])) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- AKNHIRAN DARI CONTAINER BUKU -->
                        </div>  
                    </div>
                </div>
                
                
            </div>
        </div>
    </main>
    <script>
        $(document).off('click', '#book').on('click', '#book', function(e){
            if(!$(e.target).is('path')){
                let idBuku = $(this).attr('idBuku')
                let linkToRinci = '../book/index.php?buku=' + idBuku;
                window.location.href = linkToRinci;
            }
        });
        $(document).off('click', '#koleksi').on('click', '#koleksi', function(){
            let idBuku = $(this).find('#idBuku').val()
            let idUser = $(this).find('#idUser').val()
            let isSaved = $(this).find('#isSaved').val()
            let collection = $(this)
            // console.log(collection.html())

            console.log(`${idBuku} ${idUser} ${isSaved} `)

            $(this).addClass('scale-125')

            setTimeout(() => {
                $(this).removeClass('scale-125')
            }, 110);

            $.ajax({
                type: 'POST',
                dataType: 'html', 
                url: 'crud/aksi-koleksi.php',
                data: {
                    id_buku: idBuku, 
                    id_user: idUser, 
                    is_saved: isSaved
                }, 
                success: function(data){
                    collection.html(data)
                }, 
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors during the AJAX request
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            })
        })
    </script>
    <script>
        let checkArray = []
        let searchQuery = '';

        $(document).off('click', '#kategori-check').on('click', '#kategori-check', function(){
            let newCheck = $(this).val()

            if(!checkArray.includes(newCheck)){
                checkArray.push(newCheck)
            }
            else{
                let checkedIndex = checkArray.indexOf(newCheck)
                checkArray.splice(checkedIndex, 1)
            }
            searchFun()
        })

        $('#search-query').on('input', function(){
            searchQuery = $(this).val()
            searchFun()
        })

        function searchFun(){
            $.ajax({
                type: 'POST', 
                dataType:'html',
                url: 'crud/search-book.php',
                data: {
                    checkCat: checkArray, 
                    searchBook: searchQuery
                },
                success: function(data){
                    $('#book-container').html(data)
                },
            })
        }
    </script>
    <script src="main.js"></script>
<?php include '../partials/_footer.php' ?>