<?php 
include '../../../config.php';

$search = $_POST['searchBook'];

if(isset($_POST['checkCat'])){
    $catArray = $_POST['checkCat'];
    
    $orQuery = '';
    foreach ($catArray as $i) {
        $orQuery = $orQuery . " OR id_kategori = '$i'";
    }
}else{
    $catArray = '';
}

$searchBook = mysqli_query($con, "SELECT ")

?>