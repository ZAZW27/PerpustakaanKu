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
        <div class="md:w-[80vw] w-full">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $getUser = mysqli_query($con, "SELECT * FROM tbl_user ORDER BY level");
                    while($u = mysqli_fetch_array($getUser)){
                    ?>
                        <tr class="border-b border-neutral">
                            <td class="px-2"><p><?= $u['nama_lengkap'] ?></p><p><?= $u['username'] ?></p></td>
                            <td class="px-2"><?= $u['email'] ?></td>
                            <td class="px-2"><?= $u['alamat'] ?></td>
                            <td class="px-2"><?= $u['level'] ?></td>
                            <td class="px-2">
                                <a href="update.php?user=<?=$u['id_user']?>">Update</a>
                                <!-- <a href="crud/aksi-delete.php?user=<?=$u['id_user']?>">Delete</a> -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="main.js"></script>
<?php include '../partials/_footer.php' ?>;