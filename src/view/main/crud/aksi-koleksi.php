<?php 
include '../../../config.php';

$id_buku = $_POST['id_buku'];
$id_user = $_POST['id_user'];
$is_saved = $_POST['is_saved'];

if($is_saved == 'false'){
    $collect = mysqli_query($con, "INSERT INTO tbl_koleksi_pribadi (id_user, id_buku) VALUES ('$id_user', '$id_buku')");
    // echo 'ini false';
}else{
    $collect = mysqli_query($con, "DELETE FROM tbl_koleksi_pribadi WHERE id_user = '$id_user' AND id_buku = '$id_buku'");
    // echo 'real';
}

if(!$collect){
    echo "<script>alert('NOOOOOOOOOOOOOOOOOO NGA BISA :(')</script>";
    return;
}
?>

<?php 
if($is_saved == 'true'){

?>
    <input value="<?=$id_buku?>" id="idBuku" hidden/>
    <input value="<?=$id_user?>" id="idUser" hidden/>
    <input value="false" id="isSaved" hidden/>
    <svg width="2rem" height="2rem" viewBox="-3.8 -3.8 27.60 27.60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
    fill="#ffffff" stroke="#ffffff">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>bookmark_fill [#1227]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="1.22" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-265.000000, -2679.000000)" 
    fill="#fbfbfb00"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M219,2521 L219,2537.998 C219,2538.889 217.923,2539.335 217.293,2538.705 L214.707,2536.119 C214.317,2535.729 213.683,2535.729 213.293,2536.119 L210.707,2538.705 C210.077,2539.335 209,2538.889 209,2537.998 L209,2521 C209,2519.895 209.895,2519 211,2519 L217,2519 C218.105,2519 219,2519.895 219,2521" id="bookmark_fill-[#1227]"> </path> </g> </g> </g> </g></svg>

<?php } else{ ?>
    <input value="<?=$id_buku?>" id="idBuku" hidden/>
    <input value="<?=$id_user?>" id="idUser" hidden/>
    <input value="true" id="isSaved" hidden/>
    <svg width="2rem" height="2rem" viewBox="-3.8 -3.8 27.60 27.60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
    fill="#ffffff" stroke="#ffffff">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>bookmark_fill [#1227]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="1.22" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-265.000000, -2679.000000)" 
    fill="#ffffff"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M219,2521 L219,2537.998 C219,2538.889 217.923,2539.335 217.293,2538.705 L214.707,2536.119 C214.317,2535.729 213.683,2535.729 213.293,2536.119 L210.707,2538.705 C210.077,2539.335 209,2538.889 209,2537.998 L209,2521 C209,2519.895 209.895,2519 211,2519 L217,2519 C218.105,2519 219,2519.895 219,2521" id="bookmark_fill-[#1227]"> </path> </g> </g> </g> </g></svg>
<?php } ?>

