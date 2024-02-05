<?php include '../partials/_header.php' ?>
    <main class="relative top-16 z-[10] px-4 md:px-12 py-10 flex flex-col md:flex-row justify-center items-start gap-4">
        <div class="w-[40rem]">
            <h1 class="text-3xl font-bold">Profile</h1>
            <div id="information" class="text-xl">
                <h1 class="font-semibold"><?= $nama_lengkap ?> <span class="text-neutral">(<?= $username ?>)</span></h1>
                <h1 class="text-base-300 font-semibold"><?= $level ?></h1>   
            </div>
        </div>
        <div class="w-full">
            <h1 class="text-3xl font-bold my-2">Koleksi buku anda</h1>
            <div class="w-full bg-base-200 p-4">
                <div class="flex flex-wrap gap-4 justify-center w-full">
                    <?php 
                    $getCollections = mysqli_query($con, "SELECT * FROM tbl_koleksi_pribadi INNER JOIN tbl_user ON tbl_koleksi_pribadi.id_user = tbl_user.id_user INNER JOIN tbl_buku ON tbl_koleksi_pribadi.id_buku = tbl_buku.id_buku WHERE tbl_user.id_user = '$id_user'");
                    while($book = mysqli_fetch_array($getCollections)){
                    ?>
                    <a href="../book/index.php?buku=<?=$book['id_buku']?>" id="buku" idBuku="<?=$book['id_buku']?>" class="w-[9rem] shadow-lg overflow-hidden md:w-[13rem] h-[17rem] md:h-[20rem] place-items-center card bg-base-300 bg-cover bg-no-repeat bg-center transition-all duration-300 ease-in-out" 
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
            </div>
        </div>
    </main>
<?php include '../partials/_footer.php' ?>