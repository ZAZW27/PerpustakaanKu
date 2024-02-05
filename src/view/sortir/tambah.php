<?php include '../partials/_header.php' ?>
    <main class="relative top-16 z-[10] px-0 md:px-3 py-4 flex flex-col justify-center items-center">
        <form action="crud/aksi-tambah.php" enctype="multipart/form-data" method="post" class="bg-base-200 w-full md:w-[40rem] rounded-md px-4 md:px-12 py-4  flex flex-col justify-center items-center">
            <h1 class="text-2xl font-semibold">Tambah Buku</h1>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">Judul buku</label>
                <input name="judul" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">penulis buku</label>
                <input name="penulis" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">penerbit buku</label>
                <input name="penerbit" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">tahun terbit buku</label>
                <input name="tahun_terbit" class="border-b-2 border-neutral w-full bg-transparent" type="date">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">Gambar buku</label>
                <input name="gambar" class="border-b-2 border-neutral w-full bg-transparent" type="file">
            </div>
            
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">Gambar buku</label>
                <select name="kategori" class="border-b-2 border-neutral w-full bg-transparent" name="" id="">
                    <?php 
                    $getCat = mysqli_query($con, "SELECT * FROM tbl_kategori");
                    while($cat = mysqli_fetch_array($getCat)){
                    ?>
                    <option value="<?= $cat['id_kategori']?>"><?= $cat['nama_kategori'] ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <button class="btn btn-success text-base-100 mt-3">Submit</button>
        </form>
    </main>
<?php include '../partials/_footer.php' ?>