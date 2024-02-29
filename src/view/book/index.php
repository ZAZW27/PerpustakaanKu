<?php include '../partials/_header.php' ?>
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }


    </style>
    <?php 
    if(!isset($_GET['buku'])){
        header('location:../main/index.php');
    }
    $idBuku = $_GET['buku'];
    $getBook = mysqli_query($con, "SELECT * FROM tbl_buku WHERE id_buku = '$idBuku'");
    $f = mysqli_fetch_array($getBook);
    ?>
    <main class="relative top-16 z-[10] px-0 md:px-3 py-4 flex flex-col md:flex-row justify-center items-center md:items-start gap-4">
        <img class="min-h-[30rem] max-h-[30rem] shadow-xl rounded-lg" src="../../../public/images/buku/<?=$f['image'] > 0 ? $f['image'] : 'notfound.jpeg' ?>" alt="">
        <div class="flex flex-col gap-2">
            <div class="bg-base-200 px-2 flex flex-col flex-wrap items-start justify-start py-4">
                <a href="#" class="ml-auto bg-blue-600 text-white rounded-md shadow-sm px-2 py-[4px]" onclick="window.history.go(-1)">< Kembali</a>
                <h1 class="text-xl font-bold"><span class="font-medium">Ditulis oleh:</span> <?= $f['penulis'] ?></h1>
                <h1 class="text-xl font-bold"><span class="font-medium">Diterbitkan oleh:</span> <?= $f['penerbit'] ?></h1>
                <h1 class="text-xl font-bold"><span class="font-medium">Diterbitkan pada:</span> <?= $f['tahun_terbit'] ?></h1>
                <h1 class="mt-4">
                    Catergories: 
                    <?php 
                    $getCat = mysqli_query($con, "SELECT nama_kategori, tbl_kategori.id_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori INNER JOIN tbl_buku ON tbl_buku.id_buku = tbl_kategori_buku.id_buku WHERE tbl_buku.id_buku = $idBuku");
                    while($cat = mysqli_fetch_array($getCat)){
                    ?>
                        <a href="../main/index.php?kategori=<?= $cat['id_kategori'] ?>" class="btn btn-sm btn-info my-1"><?= $cat['nama_kategori'] ?></a>
                    <?php } ?>
                </h1>
                <?php 
                $getCol = mysqli_query($con, "SELECT * FROM tbl_koleksi_pribadi WHERE id_user = '$id_user' and id_buku = '$idBuku';");
                if(mysqli_num_rows($getCol) > 0){
                ?>
                    <a href="crud/unsave.php?buku=<?=$idBuku?>" id="unsave" class="btn btn-success btn-sm mt-3 ">Disimpan</a>
                <?php }else{ ?>
                    <a href="crud/save.php?buku=<?=$idBuku?>" id="save" class="btn btn-info btn-sm mt-3 ">Simpan buku +</a>
                <?php } ?>
            </div>
            <div class="bg-base-200 p-2 flex flex-col justify-center items-start">
                <h1 class="text-2xl font-bold self-center">Ulasan buku</h1>
                <div class="flex flex-col gap-2 w-full md:w-[30rem] h-[13rem] overflow-y-scroll py-4">
                    <?php 
                    $getUlasan = mysqli_query($con, "SELECT * FROM ulasanbuku INNER JOIN tbl_buku ON tbl_buku.id_buku = ulasanbuku.id_buku INNER JOIN tbl_user ON tbl_user.id_user = ulasanbuku.id_user WHERE ulasanbuku.id_buku = '$idBuku';");

                    while($u = mysqli_fetch_array($getUlasan)){
                    ?>
                        <div>
                            <div class="w-full flex justify-between">
                                <p id="nama-user"><?= $u['username'] ?></p>
                                <span class="flex justify-center items-center"><?= $u['rating'] ?><svg fill="#ffc700" width="1.4rem" height="1.4rem" viewBox="-4 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#ffc700"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>star</title> <path d="M4.625 27.531l7.531-3.906 7.531 3.906-1.438-8.344 6.063-5.906-8.406-1.219-3.75-7.625-3.75 7.625-8.406 1.219 6.094 5.906z"></path> </g></svg></span>
                            </div>
                            <p><?= $u['ulasan'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="bg-base-200 p-2">
            <p class="text-xl font-bold">Beri ulasan anda</p>
            <form method="POST" action="crud/kirim-ulasan.php" class="flex flex-col">
                <input type="text" value="<?=$id_user?>" hidden name="idUser">
                <input type="text" value="<?=$idBuku?>" hidden name="idBuku">
                <div class="rate self-start">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text">1 star</label>
                </div>
                <textarea name="ulasan" class="rounded-md" id="" cols="30" rows="10"></textarea>
                <button class="bg-green-400 my-1 px-3 py-1.5 text-white font-semibold">Send</button>
            </form>
        </div>
        <!-- <div class="w-full md:w-7/12 rounded-md shadow-xl h-[30rem] md:h bg-base-200 bg-no-repeat bg-center bg-contain" style="background-image: url('../../../public/images/buku/<?=$f['image'] > 0 ? $f['image'] : 'notfound.jpeg' ?>')"></div> -->
    </main>
<?php include '../partials/_footer.php' ?>