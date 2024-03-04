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
    <input type="text" value="<?=$id_user?>" id="id_user" hidden>
    <main class="relative top-16 z-[10] py-4 flex flex-col justify-center items-center">
        <div class="flex flex-col justify-between items-start w-full">
            <span onclick="window.history.go(-1)" class="bg-blue-500 px-4 rounded-l-xl relative left-3 rounded-r-sm text-white font-bold text-lg cursor-pointer">Return</span>
            <div id="book-section" class="w-full relative z-[10] flex flex-col md:flex-row gap-2 px-2">
                <form class="md:col-span-1 md:h-auto md:pl-3 md:border-r-[0.4rem] border-[#a1e661] w-full md:w-[20%]">
                    <div class="sticky top-16 w-full">
                        <h1 class="text-black text-3xl md:text-4xl font-thin">Search Book</h1>
                        <div class="flex flex-col overflow-x-auto md:overflow-x-clip mt-3 gap-2 pr-4 w-full">
                            <div class="w-full">
                                <input id="search-query" value="<?= isset($_POST['search-buku']) ? $_POST['search-buku'] : '' ?>" type="text" class="w-full bg-transparent border-b-2 border-slate-600 focus:ring-0 focus:outline-none" placeholder="🔍search book">
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <?php 
                                $getCategory = mysqli_query($con, "SELECT * FROM tbl_kategori");

                                while($cat = mysqli_fetch_array($getCategory)){
                                
                                ?>
                                <div class="form-control">
                                    <label class="label py-1 cursor-pointer justify-start gap-2">
                                        <input <?= (isset($_POST['category-option']) && $_POST['category-option'] > 0 && $_POST['category-option'] == $cat['id_kategori']) ? 'checked' : '' ?> type="checkbox" id="kategori-check" name="kategori[]" value="<?=$cat['id_kategori']?>" class="checkbox checkbox-sm border-2 border-slate-700" />
                                        <span class="label-text"><?=$cat['nama_kategori'] ?></span> 
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="md:col-span-3 md:border-t-0 border-t-[6px] w-full border-[#a1e661] flex flex-col gap-8">
                    <div id="recent-upload" class="mt-4 md:mt-0">
                        <div class="flex justify-between items-cente ">
                            <h1 class="text-black text-3xl md:text-4xl font-thin">Search Result</h1>
                        </div>
                        <div id="book-container" class="w-full md:px-4 flex justify-center md:justify-start flex-wrap items-center gap-3 py-3">
                            <!-- MULAI DARI CONTAINER BUKU -->
                            <?php 
                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                $searchQuery = $_POST['search-buku'];
                                if($_POST['category-option']){
                                    $idCat = $_POST['category-option'];
                                    $getRecent = mysqli_query($con, 
                                        "SELECT 
                                            tbl_buku.*, 
                                            ROUND(AVG(rating), 1) as rate,
                                            tbl_koleksi_pribadi.id_user 
                                        FROM tbl_buku 
                                        LEFT JOIN ulasanbuku ON tbl_buku.id_buku = ulasanbuku.id_buku
                                        LEFT JOIN tbl_koleksi_pribadi ON tbl_koleksi_pribadi.id_buku = tbl_buku.id_buku
                                        LEFT JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku
                                        WHERE id_kategori = '$idCat' AND judul LIKE '%$searchQuery%'
                                        GROUP BY tbl_buku.id_buku 
                                        order by tbl_buku.id_buku DESC ;"
                                    );
                                }
                                else{
                                    $getRecent = mysqli_query($con, 
                                        "SELECT 
                                            tbl_buku.*, 
                                            ROUND(AVG(rating), 1) as rate,
                                            tbl_koleksi_pribadi.id_user 
                                        FROM tbl_buku 
                                        LEFT JOIN ulasanbuku ON tbl_buku.id_buku = ulasanbuku.id_buku
                                        LEFT JOIN tbl_koleksi_pribadi ON tbl_koleksi_pribadi.id_buku = tbl_buku.id_buku
                                        LEFT JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku
                                        WHERE judul LIKE '%$searchQuery%'
                                        GROUP BY tbl_buku.id_buku 
                                        order by tbl_buku.id_buku DESC ;"
                                    );
                                }
                            }else{
                                $getRecent = mysqli_query($con, 
                                    "SELECT 
                                        tbl_buku.*, 
                                        ROUND(AVG(rating), 1) as rate,
                                        tbl_koleksi_pribadi.id_user 
                                    FROM tbl_buku 
                                    LEFT JOIN ulasanbuku ON tbl_buku.id_buku = ulasanbuku.id_buku
                                    LEFT JOIN tbl_koleksi_pribadi ON tbl_koleksi_pribadi.id_buku = tbl_buku.id_buku
                                    LEFT JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku
                                    GROUP BY tbl_buku.id_buku 
                                    order by tbl_buku.id_buku DESC ;"
                                );
                            }

                            while($book = mysqli_fetch_array($getRecent)){
                                $fetchBook = $book['id_buku'];
                                $getCollection = mysqli_query($con, "SELECT id_user FROM tbl_koleksi_pribadi WHERE id_user = '$id_user' AND id_buku = '$fetchBook'");
                                $checkCollection = (mysqli_fetch_array($getCollection) > 0) ? True: False;
                            ?>
                            <div id="book" idBuku="<?=$book['id_buku']?>" class="w-[10rem] md:w-[10.15rem] h-[18rem] md:h-[18rem] bg-cover bg-no-repeat bg-center shadow-lg shadow-slate-600/60 cursor-pointer hover:scale-105 transition-all duration-200 ease-out" style="background-image: url('../../../public/images/buku/<?=$book['image'] > 0 ? $book['image'] : 'notfound.jpeg' ?>');"> 
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
        let searchQuery = ''; = $_POST[];
        let id_user = $('#id_user').val()

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
            searchQuery = $(this).val() = $_POST[];
            searchFun()
        })

        function searchFun(){
            $.ajax({
                type: 'POST', 
                dataType:'html',
                url: 'crud/search-book.php',
                data: {
                    checkCat: checkArray, 
                    searchBook: searchQuery,  = $_POST[];
                    id_user: id_user
                },
                success: function(data){
                    $('#book-container').html(data)
                },
            })
        }
    </script>
    <script src="main.js"></script>
<?php include '../partials/_footer.php' ?>