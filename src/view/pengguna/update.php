<?php include '../partials/_header.php' ?>
    <?php
    $id_user = $_GET['user'];
    $getUser = mysqli_query($con, "SELECT * FROM tbl_user WHERE id_user='$id_user'");
    $f = mysqli_fetch_array($getUser);
    ?>
    <main class="relative top-16 z-[10] px-0 md:px-3 py-4 flex flex-col justify-center items-center">
        <form action="crud/aksi-update.php" enctype="multipart/form-data" method="post" class="bg-base-200 w-full md:w-[40rem] rounded-md px-4 md:px-12 py-4  flex flex-col justify-center items-center">
            <h1 class="text-2xl font-semibold">Update buku | <?= $f['username'] ?></h1>
            <input type="text" value="<?=$f['id_user']?>" name='id_user' hidden>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">username</label>
                <input name="username" value="<?=$f['username']?>" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">nama lengkap</label>
                <input name="nama_lengkap" value="<?=$f['nama_lengkap']?>" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">email</label>
                <input name="email" value="<?=$f['email']?>" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">Password</label>
                <input name="password" class="border-b-2 border-neutral w-full bg-transparent" type="text">
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label class="font-semibold" for="">Alamat</label>
                <textarea name="alamat" id="" cols="20" rows="10" class="border-b-2 border-neutral h-20 w-full bg-transparent"><?= $f['alamat'] ?></textarea>
            </div>
            <div class="flex flex-col py-2 items-start self-start w-full">
                <label for="">Level user</label>
                <select name="level" id="" class="border-b-2 border-neutral w-full bg-transparent">
                    <option <?= $f['level'] == 'peminjam' ? 'select' : '' ?> value="peminjam">peminjam</option>
                    <option <?= $f['level'] == 'administrator' ? 'select' : '' ?> value="administrator">administrator</option>
                    <option <?= $f['level'] == 'petugas' ? 'select' : '' ?> value="petugas">petugas</option>
                </select>
            </div>
            <button class="btn btn-success text-base-100 mt-3">Submit</button>
        </form>
    </main>
<?php include '../partials/_footer.php' ?>