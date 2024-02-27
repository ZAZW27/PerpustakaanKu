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
            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-md shadow-slate-400/20" id="datatables">
                    <thead class="text-xs uppercase bg-blue-400 text-white">
                        <tr class="border-b-[3px] border-slate-950 pt-4">
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Alamat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Level
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $getUser = mysqli_query($con, "SELECT * FROM tbl_user ORDER BY level");
                        while($u = mysqli_fetch_array($getUser)){
                        ?>
                            <tr class="bg-slate-50 border-b hover:bg-slate-100">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    <?= $u['nama_lengkap'] ?>
                                    <p class=" font-light"><?= $u['username'] ?></p>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $u['email'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $u['alamat'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $u['level'] ?>
                                </td>
                                <td scope="col" class="px-6 py-4 text-center">
                                    <a class="font-bold" href="update.php?user=<?=$u['id_user']?>">Edit</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="main.js"></script>
<?php include '../partials/_footer.php' ?>;