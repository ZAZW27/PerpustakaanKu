<?php include '../partials/_header.php' ?>
    <main class="relative top-16 z-[10] px-0 md:px-3 py-4 flex flex-col justify-center items-center">
        <form action="crud/aksi-pinjam.php" enctype="multipart/form-data" method="post" class="bg-base-200 w-full md:w-[40rem] rounded-md px-4 md:px-12 py-4  flex flex-col justify-center items-center">
            <h1 class="text-2xl font-semibold">Peminjaman Buku </h1>    
            <input type="text" name="id_buku" value="<?=$_GET['buku']?>" hidden>        
            <div class="flex flex-col py-2 items-start self-start w-full">
                <select name="id_user" class="border-b-2 border-neutral w-full bg-transparent" name="" id="">
                    <?php 
                    $getCat = mysqli_query($con, "SELECT * FROM `tbl_user` WHERE level NOT IN ('administrator', 'petugas');");
                    while($cat = mysqli_fetch_array($getCat)){
                    ?>
                    <option value="<?= $cat['id_user']?>"><?= $cat['username'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <button class="btn btn-success text-base-100 mt-3">Submit</button>
        </form>
    </main>
<?php include '../partials/_footer.php' ?>