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
    <main class="relative top-16 z-[10] px-0 md:px-3 py-4 flex flex-col justify-center items-center">
        <div id="modalCat" class="w-full md:w-[30rem] h-full fixed top-16 px-4 py-6 bg-gray-100 shadow-md z-[100] -right-[100%] transition-all duration-500 ease-in-out">
            <div class="flex w-full justify-between">
                <button id="closeCat" class="btn btn-success btn-sm text-base-100">close</button>
                <a class="btn btn-success btn-sm text-base-100" href="insert-cat.php">Tambah+</a>
            </div>
            <div class="w-full mt-4 overflow-auto h-[70vh]">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-md shadow-slate-400/20" id="datatables">
                    <thead class="text-xs uppercase bg-blue-400 text-white">
                        <tr class="border-b-[3px] border-slate-950 pt-4">
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $lol = 1;
                        $getUser = mysqli_query($con, "SELECT * FROM tbl_kategori");
                        while($u = mysqli_fetch_array($getUser)){
                        ?>
                            <tr class="bg-slate-50 border-b hover:bg-slate-100">
                                <td class="px-6 py-4 font-medium">
                                    <p><?= $lol ?></p>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $u['nama_kategori'] ?>
                                </td>
                                <td scope="col" class="px-6 py-4 text-center">
                                    <a class="font-bold" href="update-cat.php?cat=<?=$u['id_kategori']?>">Edit</a>
                                </td>
                            </tr>
                        <?php $lol++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mx-auto flex flex-row justify-around items-center w-full">
            <h1 class="text-3xl text-center font-bold flex justify-center items-center gap-2">Sortir <a href="tambah.php" class="btn btn-success btn-sm text-base-100">Tambah +</a></h1>
            <button id="toggleCat" class="btn btn-success btn-sm text-base-100">Category</button>
        </div>
        <script>
            var catModal = false;

            $('#toggleCat').on('click', function(){
                catModal = !catModal
                console.log(catModal)

                toggleModal()
            })
            $('#closeCat').on('click', function(){
                catModal = !catModal
                console.log(catModal)

                toggleModal()
            })
            function toggleModal(){
                if(catModal == true){
                    $('#modalCat').removeClass('-right-[100%]').addClass('right-0')
                }
                else{
                    $('#modalCat').addClass('-right-[100%]').removeClass('right-0')
                }
            }
        </script>
        <div class="flex justify-between items-start w-full px-0 md:px-6">
            <div id="category-modal" class="grid w-full md:w-[40rem] h-20 px-4 fixed -top-[100vh] z-[11] flex-grow transition-all duration-300 ease-in-out">
                <div class="card place-items-center bg-base-200 shadow-md rounded-box w-full h-full flex flex-col justify-start items-start px-4 pt-2 pb-4">
                    <div class="divider divider-start divider-neutral-content text-base-neutral font-bold">Katgori</div>
                    <div class="flex flex-col text-sm -mt-2 pl-4 w-full">
                    <a class="w-full divider divider-start my-1 px-2 hover:font-bold <?= !isset($_GET['kategori']) ? 'font-bold' : ''?>" href="index.php">all</a>
                        <?php 
                        $navCategory = mysqli_query($con, "SELECT tbl_kategori.id_kategori, nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku GROUP BY tbl_kategori_buku.id_kategori");
                        while($nav = mysqli_fetch_array($navCategory)){
                        ?>
                            <a class="w-full divider divider-start my-1 px-2 hover:font-bold <?=isset($_GET['kategori']) && $_GET['kategori'] == $nav['id_kategori'] ? 'font-bold' : '' ?>" href="?kategori=<?= $nav['id_kategori'] ?>"><?= $nav['nama_kategori'] ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="w-full relative z-[10] flex flex-col flex-wrap gap-2 md:gap-4 justify-start items-start card rounded-box p-2">
                <div class="divider my-0 w-full">No kategori</div>
                <div class="w-full relative z-[10] flex flex-row flex-wrap gap-1 md:gap-2 justify-center md:justify-start items-center card rounded-box">
                    <?php 
                    $noKategori = mysqli_query($con, "SELECT tbl_buku.*  FROM tbl_buku LEFT JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE id_kategoribuku IS NULL;");
                    while($nk = mysqli_fetch_array($noKategori)){
                    ?>
                    <a href="update.php?buku=<?=$nk['id_buku']?>" id="buku" idBuku="<?=$nk['id_buku']?>" class="w-[9rem] shadow-lg overflow-hidden md:w-[10rem] h-[13rem] md:h-[20rem] place-items-center card bg-base-300 bg-cover bg-no-repeat bg-center transition-all duration-300 ease-in-out" 
                    style="background-image: url('../../../public/images/buku/<?=$nk['image'] > 0 ? $nk['image'] : 'notfound.jpeg' ?>');">
                        <div class="w-full h-full hover:bg-gradient-to-t from-slate-900/80 to-slate-900/0 transition-all duration-300 ease-in-out flex flex-col justify-end items-start px-2 py-2 text-transparent hover:text-white">
                            <h1 class="text-md"><?= $nk['judul'] ?></h1>
                            <div class="flex justify-end text-sm font-extralight w-full">
                                <p>- </p>
                                <p class=""><?= $nk['penulis'] ?></p>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
                <?php 
                if($isCatgorySet){
                    $idKategori = $_GET['kategori'];
                    $getCategory = mysqli_query($con, "SELECT tbl_kategori.id_kategori, nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE tbl_kategori.id_kategori = '$idKategori' GROUP BY tbl_kategori_buku.id_kategori;");
                }else{
                    $getCategory = mysqli_query($con, "SELECT tbl_kategori.id_kategori, nama_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku GROUP BY tbl_kategori_buku.id_kategori;");
                }
                while($cat = mysqli_fetch_array($getCategory)){
                ?>
                    <div class="divider my-0 w-full"><?= $cat['nama_kategori'] ?></div>
                    <div class="w-full relative z-[10] flex flex-row flex-wrap gap-1 md:gap-2 justify-center md:justify-start items-center card rounded-box">
                        <?php 
                            $id_kategori = $cat['id_kategori'];
                            $getBook = mysqli_query($con, "SELECT tbl_buku.id_buku, image, judul, penulis FROM tbl_kategori_buku INNER JOIN tbl_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE id_kategori = $id_kategori");
                            while($book = mysqli_fetch_array($getBook)){
                        ?>
                            <a href="update.php?buku=<?=$book['id_buku']?>" id="buku" idBuku="<?=$book['id_buku']?>" class="w-[9rem] shadow-lg overflow-hidden md:w-[10rem] h-[13rem] md:h-[20rem] place-items-center card bg-base-300 bg-cover bg-no-repeat bg-center transition-all duration-300 ease-in-out" 
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
            </div>
        </div>
    </main>
    <script src="main.js"></script>
<?php include '../partials/_footer.php' ?>