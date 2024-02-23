<?php 
include '../../config.php'; 
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.html');
}

$nama_lengkap = $_SESSION['nama_lengkap'];
$username = $_SESSION['username'];
$level = $_SESSION['level'];
$id_user = $_SESSION['id_user'];

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/output.css">
    <link rel="stylesheet" href="../../../public/overwrite.css">
    <script src="../../jquery.js"></script>
</head>

<body class="bg-slate-50">
    <header class="fixed w-[100vw] z-[99]">
        <nav class="navbar bg-base-100 w-full shadow-lg px-1 md:px-12">
            <div class="navbar-start">
                <div class="dropdown md:hidden">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                    </div>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li>
                            <a class="<?= $level == 'administrator' ? '' : 'hidden' ?>" href="../admin/index.php" class="btn btn-ghost btn-circle">Peminjaman</a>
                        </li>
                        <li>
                            <a class="<?= $level == 'administrator' ? '' : 'hidden' ?>" href="../buku-log/index.php" class="btn btn-ghost btn-circle">Buku Log</a>
                        </li>
                        <li>
                            <a class="<?= $level == 'administrator' ? '' : 'hidden' ?>" href="../pengguna/index.php" class="btn btn-ghost btn-circle">Pengguna</a>
                        </li>
                        <li>
                            <a class="<?= $level == 'petugas' ? '' : 'hidden' ?>" href="../sortir/index.php" class="btn btn-ghost btn-circle">Sortir</a>
                        </li>
                        <li>
                            <a class="" href="../user/index.php" class="btn btn-ghost btn-circle">User</a>
                        </li>
                        <li>
                            <a href="../auth/crud/aksi-logout.php" class="btn btn-ghost btn-circle">
                                <div class="indicator">
                                    <!-- <svg fill="#3e3737" width="64px" height="64px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" stroke="#3e3737" stroke-width="0.00016"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#fefbfb" stroke-width="1.536"><path d="M1.3 3.75h5.88V2.5H1.3A1.25 1.25 0 0 0 .05 3.75v8.5A1.25 1.25 0 0 0 1.3 13.5h5.88v-1.25H1.3z"></path><path d="m15.4 7-4-2.74-.71 1 3.08 2.1H4.71v1.26h9.07l-3.08 2.11.71 1L15.4 9a1.24 1.24 0 0 0 0-2z"></path></g><g id="SVGRepo_iconCarrier"><path d="M1.3 3.75h5.88V2.5H1.3A1.25 1.25 0 0 0 .05 3.75v8.5A1.25 1.25 0 0 0 1.3 13.5h5.88v-1.25H1.3z"></path><path d="m15.4 7-4-2.74-.71 1 3.08 2.1H4.71v1.26h9.07l-3.08 2.11.71 1L15.4 9a1.24 1.24 0 0 0 0-2z"></path></g></svg> -->
                                    <svg fill="#3e3737" class="w-6 h-6" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" stroke="#3e3737" stroke-width="0.00016"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#fefbfb" stroke-width="1.536"><path d="M1.3 3.75h5.88V2.5H1.3A1.25 1.25 0 0 0 .05 3.75v8.5A1.25 1.25 0 0 0 1.3 13.5h5.88v-1.25H1.3z"></path><path d="m15.4 7-4-2.74-.71 1 3.08 2.1H4.71v1.26h9.07l-3.08 2.11.71 1L15.4 9a1.24 1.24 0 0 0 0-2z"></path></g><g id="SVGRepo_iconCarrier"><path d="M1.3 3.75h5.88V2.5H1.3A1.25 1.25 0 0 0 .05 3.75v8.5A1.25 1.25 0 0 0 1.3 13.5h5.88v-1.25H1.3z"></path><path d="m15.4 7-4-2.74-.71 1 3.08 2.1H4.71v1.26h9.07l-3.08 2.11.71 1L15.4 9a1.24 1.24 0 0 0 0-2z"></path></g></svg>
                                </div>
                            </a>
                        </li>                
                    </ul>
                </div>
                <!-- <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                    </div>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a>Homepage</a></li>
                        <li><a>Portfolio</a></li>
                        <li><a>About</a></li>
                    </ul>
                </div> -->
            </div>
            <div class="navbar-center">
                <a class="btn btn-ghost text-xl"  href="../main/index.php">Perpustakaan</a>
            </div>
            <div class="navbar-end md:hidden"></div>
            <div class="navbar-end md:flex gap-5 hidden text-lg font-normal">
                <a class="<?= $level == 'administrator' ? '' : 'hidden' ?>" href="../admin/index.php" class="btn btn-ghost btn-circle">Peminjaman</a>
                <a class="<?= $level == 'administrator' ? '' : 'hidden' ?>" href="../buku-log/index.php" class="btn btn-ghost btn-circle">Buku Log</a>
                <a class="<?= $level == 'administrator' ? '' : 'hidden' ?>" href="../pengguna/index.php" class="btn btn-ghost btn-circle">Pengguna</a>
                <a class="<?= $level == 'petugas' ? '' : 'hidden' ?>" href="../sortir/index.php" class="btn btn-ghost btn-circle">Sortir</a>
                <a class="" href="../user/index.php" class="btn btn-ghost btn-circle">User</a>
                <a href="../auth/crud/aksi-logout.php" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <!-- <svg fill="#3e3737" width="64px" height="64px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" stroke="#3e3737" stroke-width="0.00016"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#fefbfb" stroke-width="1.536"><path d="M1.3 3.75h5.88V2.5H1.3A1.25 1.25 0 0 0 .05 3.75v8.5A1.25 1.25 0 0 0 1.3 13.5h5.88v-1.25H1.3z"></path><path d="m15.4 7-4-2.74-.71 1 3.08 2.1H4.71v1.26h9.07l-3.08 2.11.71 1L15.4 9a1.24 1.24 0 0 0 0-2z"></path></g><g id="SVGRepo_iconCarrier"><path d="M1.3 3.75h5.88V2.5H1.3A1.25 1.25 0 0 0 .05 3.75v8.5A1.25 1.25 0 0 0 1.3 13.5h5.88v-1.25H1.3z"></path><path d="m15.4 7-4-2.74-.71 1 3.08 2.1H4.71v1.26h9.07l-3.08 2.11.71 1L15.4 9a1.24 1.24 0 0 0 0-2z"></path></g></svg> -->
                        <svg fill="#3e3737" class="w-6 h-6" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" stroke="#3e3737" stroke-width="0.00016"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#fefbfb" stroke-width="1.536"><path d="M1.3 3.75h5.88V2.5H1.3A1.25 1.25 0 0 0 .05 3.75v8.5A1.25 1.25 0 0 0 1.3 13.5h5.88v-1.25H1.3z"></path><path d="m15.4 7-4-2.74-.71 1 3.08 2.1H4.71v1.26h9.07l-3.08 2.11.71 1L15.4 9a1.24 1.24 0 0 0 0-2z"></path></g><g id="SVGRepo_iconCarrier"><path d="M1.3 3.75h5.88V2.5H1.3A1.25 1.25 0 0 0 .05 3.75v8.5A1.25 1.25 0 0 0 1.3 13.5h5.88v-1.25H1.3z"></path><path d="m15.4 7-4-2.74-.71 1 3.08 2.1H4.71v1.26h9.07l-3.08 2.11.71 1L15.4 9a1.24 1.24 0 0 0 0-2z"></path></g></svg>
                    </div>
                </a>
            </div>
        </nav>
    </header>
