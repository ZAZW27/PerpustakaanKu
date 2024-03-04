<?php 
include '../../../config.php';

$search = $_POST['searchBook'];
$id_user = $_POST['id_user'];
$orQuery = '';

if(isset($_POST['checkCat'])){
    $catArray = $_POST['checkCat'];
    foreach ($catArray as $i) {
        $orQuery = $orQuery . "$i,";
    }
    $orQuery = substr($orQuery, 0, -1);

    $getRecent = mysqli_query($con, 
    "SELECT 
        tbl_buku.*, 
        ROUND(AVG(rating), 1) as rate,
        tbl_koleksi_pribadi.id_user 
    FROM tbl_buku 
    LEFT JOIN ulasanbuku ON tbl_buku.id_buku = ulasanbuku.id_buku
    LEFT JOIN tbl_koleksi_pribadi ON tbl_koleksi_pribadi.id_buku = tbl_buku.id_buku
    LEFT JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku
    WHERE id_kategori IN ($orQuery) AND tbl_buku.judul LIKE '%$search%'
    GROUP BY tbl_buku.id_buku 
    order by tbl_buku.id_buku DESC 

    ");

}else{
    $catArray = '';
    $getRecent = mysqli_query($con, 
    "SELECT 
        tbl_buku.*, 
        ROUND(AVG(rating), 1) as rate,
        tbl_koleksi_pribadi.id_user 
    FROM tbl_buku 
    LEFT JOIN ulasanbuku ON tbl_buku.id_buku = ulasanbuku.id_buku
    LEFT JOIN tbl_koleksi_pribadi ON tbl_koleksi_pribadi.id_buku = tbl_buku.id_buku
    LEFT JOIN tbl_kategori_buku ON tbl_kategori_buku.id_buku = tbl_buku.id_buku
    WHERE tbl_buku.judul LIKE '%$search%'
    GROUP BY tbl_buku.id_buku 
    order by tbl_buku.id_buku DESC 
    ");
}

while($book = mysqli_fetch_array($getRecent)){
    $fetchBook = $book['id_buku'];
    $getCollection = mysqli_query($con, "SELECT id_user FROM tbl_koleksi_pribadi WHERE id_user = '$id_user' AND id_buku = '$fetchBook'");
    $checkCollection = (mysqli_fetch_array($getCollection) > 0) ? True: False;
?>

<div id="book" idBuku="<?=$book['id_buku']?>" class="w-[10rem] md:w-[10.15rem] h-[18rem] md:h-[18rem] bg-cover bg-no-repeat bg-center shadow-lg shadow-slate-600/60 cursor-pointer hover:scale-105 transition-all duration-200 ease-out" style="background-image: url('../../../public/images/buku/<?=$book['image'] > 0 ? $book['image'] : 'notfound.jpeg' ?>');"> 
    <div class="flex flex-col w-full h-full justify-end">
        <div class="h-full w-full flex justify-end items-end relative z-[11] px-1" style="background: linear-gradient(to top, rgba(9, 38, 53, 0.9), rgba(9, 38, 53, 0.7), rgba(9, 38, 53, 0.4), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0), rgba(9, 38, 53, 0));">
            <div class="overflow-x-scroll flex items-end gap-1 relative top-4 z-10 w-full justify-start whitespace-nowrap rounded-sm">
                <?php 
                $id_buku = $book['id_buku'];
                $categoryQuery = mysqli_query($con, 
                    "SELECT tbl_kategori.id_kategori, tbl_kategori.nama_kategori 
                    FROM tbl_kategori_buku INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_kategori_buku.id_kategori
                    WHERE id_buku = '$id_buku'
                ");

                while($fetchCat = mysqli_fetch_array($categoryQuery)){
                ?>
                
                <p id="spec-cat" idBuku="<?=$fetchCat['id_kategori']?>" class="bg-[#53cbff] text-slate-900 relative rounded-sm px-0.5 text-[0.8rem] font-bold flex-shrink-0">
                    <?= $fetchCat['nama_kategori'] ?>
                </p>
                <?php } ?>
            </div>
        </div>
        <div class="w-full h-[6rem] px-2 pb-1 text-white bg-[rgb(9,38,53)]/90 relative z-[11]">
            <div class="text-[0.7rem] grid grid-cols-8 h-11 ">
                <h1 class="text-sm leading-5 col-span-7 overflow-hidden"><?= (strlen($book['judul']) > 28) ? substr($book['judul'], 0, 28) . '..' : $book['judul'] ?></h1>
                <div href="#" id="koleksi" class="col-span-1 relative left-1 md:left-0.5 transition-all duration-200 ease-linear">
                    <input value="<?=$book['id_buku']?>" id="idBuku" hidden/>
                    <input value="<?=$id_user?>" id="idUser" hidden/>
                    <input value="<?=$book['id_user'] == $id_user ? 'true' : 'false'?>" id="isSaved" hidden/>
                    <svg width="2rem" height="2rem" viewBox="-3.8 -3.8 27.60 27.60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>bookmark_fill [#1227]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="1.22" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-265.000000, -2679.000000)" 
                    fill="<?= $checkCollection ? '#ffffff' : '#fbfbfb00'?>"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M219,2521 L219,2537.998 C219,2538.889 217.923,2539.335 217.293,2538.705 L214.707,2536.119 C214.317,2535.729 213.683,2535.729 213.293,2536.119 L210.707,2538.705 C210.077,2539.335 209,2538.889 209,2537.998 L209,2521 C209,2519.895 209.895,2519 211,2519 L217,2519 C218.105,2519 219,2519.895 219,2521" id="bookmark_fill-[#1227]"> </path> </g> </g> </g> </g></svg>
                </div>
            </div>
            <div class="text-slate-200/90 text-[0.7rem] leading-3 grid grid-cols-2 h-8 ">
                <p idbuku='<?=$book['id_buku']?>' class="col-span-1 text-start"><?= (strlen($book['penulis']) > 27) ? substr($book['penulis'], 0, 27) . '..' : $book['penulis'] ?></p>
                <p class="col-span-1 flex justify-end items-start"><?= date('d M Y', strtotime($book['tahun_terbit'])) ?></p>
            </div>
        </div>
    </div>
</div>
<?php } 
echo $orQuery
?>
