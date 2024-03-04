<?php include '../partials/_header.php' ?>
    <?php
    $id_cat = $_GET['cat'];
    $getCat = mysqli_query($con, "SELECT * FROM tbl_kategori WHERE id_kategori = '$id_cat'");
    $f = mysqli_fetch_array($getCat);
    ?>
    <main class="relative top-16 z-[10] px-0 md:px-3 py-4 flex flex-col md:flex-row justify-center items-start">
        <form action="crud/aksi-update-cat.php" enctype="multipart/form-data" method="post" class=" w-full md:w-[40rem] rounded-md px-4 md:px-12 py-4  flex flex-col justify-center items-center">
            <h1 class="text-2xl font-medium self-start"><span class=" font-light    ">Update kategori |</span> <?= $f['nama_kategori'] ?></h1>
            <input type="text" value="<?=$f['id_kategori']?>" name='id_kategori' hidden>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">Nama Kategori</label>
                <input name="nama_kategori" value="<?=$f['nama_kategori']?>" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </main>
<?php include '../partials/_footer.php' ?>