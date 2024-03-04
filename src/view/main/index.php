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
    
    <div class="relative top-16 w-full md:h-[30rem] h-[90vh] overflow-clip">
        <div id="banner" class="w-full h-full bg-blue-600/50 absolute" style="top: 0px;">
            <div class="bg-no-repeat bg-cover bg-bottom w-full h-full" style="background-image: url('../../../public/images/background/library.jpg')">
                <div class="w-full h-full flex flex-col justify-center select-none pointer-events-none items-center text-white" style="background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0,  0.5));">
                    <h1 class="text-center text-5xl font-normal">WELCOME TO <span class="text-center  italic">LIBRARY</span></h1>
                    <p class="text-center text-md font-thin leading-9 mt-1"><?= $level ?></p>
                    <h1 class="text-center text-4xl font-thin"><?= $nama_lengkap ?></h1>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                function parallaxScroll(){
                    var scrollVal = $(this).scrollTop();
                    var bannerScrolling = (scrollVal * 0.4) + "px"
                    
                    $('#banner').css("top",bannerScrolling );
                }
                parallaxScroll()
                $(window).scroll(parallaxScroll);
            });
        </script>
    </div>
    <main class="relative mt-16 z-[10] py-4 flex flex-col justify-center items-center">
        <div class="flex flex-col justify-between items-start w-full">
            <div class="w-full md:px-4">
                <h1 class="text-3xl font-light select-none">Cari Buku</h1>
                <form action="rinci.php" method="post" id="category-modal" class="w-full bg-[#008170] px-2 md:py-4 md:px-6  text-white flex md:flex-row flex-col justify-start items-center my-4 md:rounded-t-lg md:rounded-b-sm">
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
            </div>
            
            <div id="book-section" class="w-full relative z-[10] flex flex-col-reverse md:grid gap-2 md:grid-cols-4 px-2">
                <div class="md:col-span-3 md:border-r-[0.45rem] md:border-t-0 border-t-[6px] border-[#a1e661] flex flex-col gap-8">
                    <div id="recent-upload" class="mt-4 md:mt-0">
                        <div class="flex justify-between items-center">
                            <h1 class="text-black text-3xl md:text-5xl font-thin">Recent Uploads</h1>
                        </div>
                        <div class="w-full md:px-4 flex justify-center md:justify-start flex-wrap items-center gap-3 py-3">
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
                                GROUP BY tbl_buku.id_buku order by tbl_buku.id_buku DESC LIMIT 5;"
                                );
                            while($book = mysqli_fetch_array($getRecent)){
                                $fetchBook = $book['id_buku'];
                                $getCollection = mysqli_query($con, "SELECT id_user FROM tbl_koleksi_pribadi WHERE id_user = '$id_user' AND id_buku = '$fetchBook'");
                                $checkCollection = (mysqli_fetch_array($getCollection) > 0) ? True: False;
                            ?>
                            <div id="book" idBuku="<?=$book['id_buku']?>" class="w-[10rem] md:w-[12.3rem] h-[18rem] md:h-[20rem] bg-cover bg-no-repeat bg-center shadow-lg shadow-slate-600/60 cursor-pointer hover:scale-105 transition-all duration-200 ease-out" style="background-image: url('../../../public/images/buku/<?=$book['image'] > 0 ? $book['image'] : 'notfound.jpeg' ?>');"> 
                                <div class="flex flex-col w-full h-full justify-end">
                                    <div class="h-full w-full flex flex-row justify-between items-end relative z-[11] pl-2" style="background: linear-gradient(to top, rgba(9, 38, 53, 0.9), rgba(9, 38, 53, 0.7), rgba(9, 38, 53, 0.4), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0));">
                                        <div href="" class="bg-white rounded-sm px-0.5 flex gap-1 items-center">
                                            <svg width="0.7rem" height="0.7rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z" fill="#050500"></path> </g></svg>
                                            <p class="text-xs"><?= $book['rate'] == NULL ? '0.0' : $book['rate'] ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full h-[6rem] px-2 pb-1 text-white bg-[rgb(9,38,53)]/90 relative z-[9]">
                                        <div class="text-[0.7rem] grid grid-cols-8 h-11 ">
                                            <h1 class="text-sm leading-5 col-span-7 overflow-hidden"><?= (strlen($book['judul']) > 28) ? substr($book['judul'], 0, 28) . '..' : $book['judul'] ?></h1>
                                            <div href="#" id="koleksi" class="col-span-1 relative left-1 md:left-2 transition-all duration-200 ease-linear">
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
                    <div id="new-released">
                        <div class="flex justify-between items-center">
                            <h1 class="text-black text-3xl md:text-5xl font-thin">New releases</h1>
                        </div>
                        <div class="w-full md:px-4 flex justify-center md:justify-start flex-wrap items-center gap-3 py-3">
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
                                GROUP BY tbl_buku.id_buku order by tbl_buku.tahun_terbit DESC LIMIT 5;"
                                );
    
                            while($book = mysqli_fetch_array($getRecent)){
                                $fetchBook = $book['id_buku'];
                                $getCollection = mysqli_query($con, "SELECT id_user FROM tbl_koleksi_pribadi WHERE id_user = '$id_user' AND id_buku = '$fetchBook'");
                                $checkCollection = (mysqli_fetch_array($getCollection) > 0) ? True: False;
                            ?>
                            <div id="book" idBuku="<?=$book['id_buku']?>" class="w-[10rem] md:w-[12.3rem] h-[18rem] md:h-[20rem] bg-cover bg-no-repeat bg-center shadow-lg shadow-slate-600/60 cursor-pointer hover:scale-105 transition-all duration-200 ease-out" style="background-image: url('../../../public/images/buku/<?=$book['image'] > 0 ? $book['image'] : 'notfound.jpeg' ?>');">
                                <div class="flex flex-col w-full h-full justify-end">
                                    <div class="h-full w-full flex flex-row justify-between items-end relative z-[11] pl-2" style="background: linear-gradient(to top, rgba(9, 38, 53, 0.9), rgba(9, 38, 53, 0.7), rgba(9, 38, 53, 0.4), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0));">
                                        <div href="" class="bg-white rounded-sm px-0.5 flex gap-1 items-center">
                                            <svg width="0.7rem" height="0.7rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z" fill="#050500"></path> </g></svg>
                                            <p class="text-xs"><?= $book['rate'] == NULL ? '0.0' : $book['rate'] ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full h-[6rem] px-2 pb-1 text-white bg-[rgb(9,38,53)]/90 relative z-[9]">
                                        <div class="text-[0.7rem] grid grid-cols-8 h-11 ">
                                            <h1 class="text-sm leading-5 col-span-7 overflow-hidden"><?= (strlen($book['judul']) > 28) ? substr($book['judul'], 0, 28) . '..' : $book['judul'] ?></h1>
                                            <div href="#" id="koleksi" class="col-span-1 relative left-1 md:left-2 transition-all duration-200 ease-linear">
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
                    <div id="Collection">
                        <div class="flex justify-between items-center">
                            <h1 class="text-black text-3xl md:text-5xl font-thin">Your Collections</h1>
                        </div>
                        <div class="w-full md:px-4 flex justify-center md:justify-start flex-wrap items-center gap-3 py-3">
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
                                WHERE tbl_koleksi_pribadi.id_user = $id_user
                                GROUP BY tbl_buku.id_buku order by id_koleksi DESC LIMIT 5;"
                                );
    
                            while($book = mysqli_fetch_array($getRecent)){
                            ?>
                            <div id="book" idBuku="<?=$book['id_buku']?>" class="w-[10rem] md:w-[12.3rem] h-[18rem] md:h-[20rem] bg-cover bg-no-repeat bg-center shadow-lg shadow-slate-600/60 cursor-pointer hover:scale-105 transition-all duration-200 ease-out" style="background-image: url('../../../public/images/buku/<?=$book['image'] > 0 ? $book['image'] : 'notfound.jpeg' ?>');">
                                <div class="flex flex-col w-full h-full justify-end">
                                    <div class="h-full w-full flex flex-row justify-between items-end relative z-[11] pl-2" style="background: linear-gradient(to top, rgba(9, 38, 53, 0.9), rgba(9, 38, 53, 0.7), rgba(9, 38, 53, 0.4), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0));">
                                        <div href="" class="bg-white rounded-sm px-0.5 flex gap-1 items-center">
                                            <svg width="0.7rem" height="0.7rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z" fill="#050500"></path> </g></svg>
                                            <p class="text-xs"><?= $book['rate'] == NULL ? '0.0' : $book['rate'] ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full h-[6rem] px-2 pb-1 text-white bg-[rgb(9,38,53)]/90 relative z-[9]">
                                        <div class="text-[0.7rem] grid grid-cols-8 h-11 ">
                                            <h1 class="text-sm leading-5 col-span-7 overflow-hidden"><?= (strlen($book['judul']) > 28) ? substr($book['judul'], 0, 28) . '..' : $book['judul'] ?></h1>
                                            <div id="koleksi" class="col-span-1 relative left-1 md:left-2 transition-all duration-200 ease-linear">
                                                <input value="<?=$book['id_buku']?>" id="idBuku" hidden/>
                                                <input value="<?=$id_user?>" id="idUser" hidden/>
                                                <input value="<?=$book['id_user'] == $id_user ? 'true' : 'false'?>" id="isSaved" hidden/>
                                                <svg width="2rem" height="2rem" viewBox="-3.8 -3.8 27.60 27.60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                fill="#ffffff" stroke="#ffffff">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>bookmark_fill [#1227]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="1.22" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-265.000000, -2679.000000)" 
                                                fill="<?= $book['id_user'] == $id_user ? '#ffffff' : '#fbfbfb00'?>"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M219,2521 L219,2537.998 C219,2538.889 217.923,2539.335 217.293,2538.705 L214.707,2536.119 C214.317,2535.729 213.683,2535.729 213.293,2536.119 L210.707,2538.705 C210.077,2539.335 209,2538.889 209,2537.998 L209,2521 C209,2519.895 209.895,2519 211,2519 L217,2519 C218.105,2519 219,2519.895 219,2521" id="bookmark_fill-[#1227]"> </path> </g> </g> </g> </g></svg>
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
                
                <div class="md:col-span-1  md:h-auto md:pr-6">
                    <div class="sticky top-16">
                        <h1 class="text-black text-3xl md:text-5xl font-thin">Top Books</h1>
                        <div class="flex flex-row md:flex-col overflow-x-auto md:overflow-x-clip mt-3 gap-2 pr-4 ">
                            <!-- top book contaienr starty -->
                            <?php 
                            $getTop = mysqli_query($con, 
                                "SELECT
                                    tbl_buku.*, 
                                    ROUND(AVG(rating), 1) AS rate, 
                                    tbl_koleksi_pribadi.id_user 
                                FROM tbl_buku 
                                LEFT JOIN ulasanbuku ON tbl_buku.id_buku = ulasanbuku.id_buku
                                LEFT JOIN tbl_koleksi_pribadi ON tbl_koleksi_pribadi.id_buku = tbl_buku.id_buku
                                GROUP BY tbl_buku.id_buku order by rate DESC LIMIT 5"
                            );
    
                            while($top = mysqli_fetch_array($getTop)){
                                $fetchBook = $top['id_buku'];
                                $getCollection = mysqli_query($con, "SELECT id_user FROM tbl_koleksi_pribadi WHERE id_user = '$id_user' AND id_buku = '$fetchBook'");
                                $checkCollection = (mysqli_fetch_array($getCollection) > 0) ? True: False;
                            ?>
                            <div id="book" idBuku="<?=$top['id_buku']?>" class="w-full rounded-lg cursor-pointer">
                                <div class="w-[20rem] md:w-full bg-cover bg-no-repeat bg-center bg-gray-100 shadow-lg shadow-slate-300/10 flex flex-row justify-start items-center h-24 rounded-lg " style="background-image: url('../../../public/images/buku/<?=$top['image'] > 0 ? $top['image'] : 'notfound.jpeg' ?>');">
                                    <div class="py-2 px-2  flex bg-slate-950/50 backdrop-blur flex-row justify-start items-center w-full h-full rounded-lg ">
                                        <div class="h-full w-16 bg-slate-300 bg-cover bg-no-repeat bg-center rounded-md" style="background-image: url('../../../public/images/buku/<?=$top['image'] > 0 ? $top['image'] : 'notfound.jpeg' ?>');"></div>
                                        <div class="w-full h-full ml-2 flex flex-row ">
                                            <div class="w-[93%] h-full text-white  flex flex-col justify-between">
                                                <div class="h-full font-medium  "><?= (strlen($top['judul']) > 40) ? substr($top['judul'], 0, 40) . '..': $top['judul'] ?></div>
                                                <div class="flex gap-1 items-center">
                                                    <svg width="1rem" height="1rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z" fill="#dadada"></path> </g></svg>
                                                    <?= $top['rate'] == NULL ? '' :$top['rate'] ?>
                                                </div>
                                            </div>
                                            <div id="koleksi" class="w-[7%] h-full transition-all duration-200 ease-linear scale-150 mt-4 mr-1">
                                                <input value="<?=$top['id_buku']?>" id="idBuku" hidden/>
                                                <input value="<?=$id_user?>" id="idUser" hidden/>
                                                <input value="<?=$top['id_user'] == $id_user ? 'true' : 'false'?>" id="isSaved" hidden/>
                                                <svg class="" width="2rem" height="2rem" viewBox="-3.8 -3.8 27.60 27.60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    fill="#ffffff" stroke="#ffffff">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                                    </g><g id="SVGRepo_iconCarrier"> <title>bookmark_fill [#1227]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="1.22" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-265.000000, -2679.000000)" 
                                                    fill="<?= $checkCollection ? '#ffffff' : '#fbfbfb00'?>"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M219,2521 L219,2537.998 C219,2538.889 217.923,2539.335 217.293,2538.705 L214.707,2536.119 C214.317,2535.729 213.683,2535.729 213.293,2536.119 L210.707,2538.705 C210.077,2539.335 209,2538.889 209,2537.998 L209,2521 C209,2519.895 209.895,2519 211,2519 L217,2519 C218.105,2519 219,2519.895 219,2521" id="bookmark_fill-[#1227]"> </path> </g> </g> </g> </g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- top book contaienr end-->
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
    <script src="main.js"></script>
<?php include '../partials/_footer.php' ?>