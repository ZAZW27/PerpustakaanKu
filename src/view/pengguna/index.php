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
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="datatables"     >
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
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
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $getUser = mysqli_query($con, "SELECT * FROM tbl_user ORDER BY level");
                        while($u = mysqli_fetch_array($getUser)){
                        ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
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
                                <th class="px-6 py-4 text-right">
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