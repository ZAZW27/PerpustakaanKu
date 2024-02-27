<?php include '../partials/_header.php' ?>
    <?php
    $id_buku = $_GET['buku'];
    $checkKategori = mysqli_query($con, "SELECT id_kategoribuku  FROM tbl_buku LEFT JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE tbl_buku.id_buku = '$id_buku';");
    
    if(mysqli_fetch_array($checkKategori)['id_kategoribuku'] == NULL){
        $getBuku = mysqli_query($con, "SELECT tbl_buku.id_buku, judul, penulis, penerbit, tahun_terbit, image
        FROM tbl_buku WHERE tbl_buku.id_buku = '$id_buku'");
    }else{
        $getBuku = mysqli_query($con, "SELECT tbl_buku.id_buku, judul, penulis, penerbit, tahun_terbit, id_kategori, image
        FROM tbl_buku INNER JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku WHERE tbl_buku.id_buku = '$id_buku'");
    }

    $f = mysqli_fetch_array($getBuku);
    ?>
    <main class="relative top-16 z-[10] px-0 md:px-3 py-4 flex flex-col md:flex-row justify-center items-start">
        
        <img class="h-[30rem] rounded-md" src="../../../public/images/buku/<?=$f['image']?>" alt="">
        <form action="crud/aksi-update.php" enctype="multipart/form-data" method="post" class=" w-full md:w-[40rem] rounded-md px-4 md:px-12 py-4  flex flex-col justify-center items-center">
            <h1 class="text-2xl font-medium self-start"><span class=" font-light    ">Update buku |</span> <?= $f['judul'] ?></h1>
            <input type="text" value="<?=$f['id_buku']?>" name='id_buku' hidden>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">Judul buku</label>
                <input name="judul" value="<?=$f['judul']?>" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">penulis buku</label>
                <input name="penulis" value="<?=$f['penulis']?>" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">penerbit buku</label>
                <input name="penerbit" value="<?=$f['penerbit']?>" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">tahun terbit buku</label>
                <input name="tahun_terbit" value="<?=$f['tahun_terbit']?>" class="border-b-2 border-neutral w-full bg-transparent" type="date">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">Gambar buku</label>
                <input name="gambar" class="border-b-2 border-neutral w-full bg-transparent" type="file">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full ">
                <div id="uncheck-cat" class="absolute w-full md:w-[30rem] bg-slate-50/80 px-3 py-4 flex hidden flex-row flex-wrap gap-2 rounded-md shadow-lg shadow-slate-400/20 md:ml-[10rem] -mt-[10rem]">
                    <?php 
                        $getCatAdd = mysqli_query($con, "SELECT nama_kategori, tbl_kategori_buku.id_kategori 
                            FROM tbl_kategori_buku 
                            INNER JOIN tbl_kategori ON tbl_kategori_buku.id_kategori = tbl_kategori.id_kategori 
                            WHERE tbl_kategori_buku.id_kategori NOT IN (
                                select id_kategori 
                                from tbl_kategori_buku 
                                where id_buku = '$id_buku'
                            )
                            GROUP BY tbl_kategori_buku.id_kategori;"
                        );
                        while($catAdd = mysqli_fetch_array($getCatAdd)){
                        ?>
                        <div id="check-cat" catId="<?= $catAdd['id_kategori'] ?>" class="px-2 h-10 bg-blue-500 rounded-full text-white flex justify-center items-center font-semibold flex-wrap shadow-md gap-2 select-none cursor-pointer">
                            <?= $catAdd['nama_kategori'] ?>
                        </div>
                    <?php } ?>
                </div>
                <label class="font-semibold" for="">Kategori</label>
                <div id="katgoeri" class="flex flex-row flex-wrap gap-2 select-none">
                    <div id="category-container" class="flex flex-row flex-wrap gap-2">
                        <?php 
                        $getCats = mysqli_query($con, "SELECT nama_kategori, tbl_kategori_buku.id_kategori FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori_buku.id_kategori = tbl_kategori.id_kategori WHERE tbl_kategori_buku.id_buku = '$id_buku'");
                        while($cat = mysqli_fetch_array($getCats)){
                        ?>
                        <div class="px-2 h-10 bg-blue-500 rounded-full text-white flex justify-center items-center font-semibold flex-wrap shadow-md gap-2">
                            <input class="text-black bg-transparent" type="text" name="kategori[]" value="<?=$cat['id_kategori']?>" hidden>
                            <span class="nama_kategori"><?= $cat['nama_kategori'] ?></span>
                            <div id="hapus-kat" class="solute px-2 py-0.5 text-xs bg-red-600 rounded-full text-center mt-[4px] cursor-pointer" style="">X</div>
                        </div>
                        <?php } ?>
                    </div>
                    <div id="show-uncheck-cat" class="w-8 h-8 bg-gray-300 rounded-full text-center shadow-md text-2xl font-bold cursor-pointer select-none">+</div>
                </div>
            </div>
            <button class="btn btn-success text-base-100 mt-3 md:self-start">Submit</button>
            <script>
                $(document).off('click', '#hapus-kat').on('click', '#hapus-kat', function(){
                    $(this).parent().remove()
                })

                var uncheckCatBool = false;

                $('#show-uncheck-cat').on('click', function(){
                    uncheckCatBool = !uncheckCatBool;
                    
                    if(uncheckCatBool === true) {
                        $('#uncheck-cat').removeClass('hidden');
                    } else {
                        $('#uncheck-cat').addClass('hidden');
                    }
                });

                $(document).off('click', '#check-cat').on('click', '#check-cat', function() {
                    var catName = $(this).text()
                    var catId = $(this).attr('catId')

                    console.log(catId)

                    var isCatAdded = false

                    $('.nama_kategori').each(function(){
                        if($(this).text() === catName){
                            isCatAdded = true 
                            return false;
                        }
                    })

                    if(isCatAdded){return}

                    $('#category-container').append(`
                        <div class="px-2 h-10 bg-blue-500 rounded-full text-white flex justify-center items-center font-semibold flex-wrap shadow-md gap-2" >
                            <input class="text-black bg-transparent" type="text" name="kategori[]" value="${catId}" hidden>
                            <span class="nama_kategori">${catName}</span>
                            <div id="hapus-kat" class="solute px-2 py-0.5 text-xs bg-red-600 rounded-full text-center mt-[4px] cursor-pointer" style="">X</div>
                        </div>
                    `)

                })

            </script>
        </form>
    </main>
<?php include '../partials/_footer.php' ?>