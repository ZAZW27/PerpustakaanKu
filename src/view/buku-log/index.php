<?php include '../partials/_header.php' ?>
<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i');

    /*----------------------------------------------------------
    GENERAL
    ----------------------------------------------------------*/
    *{
    margin:0;
    padding:0;
    font-family: 'Roboto', sans-serif;
    }

    html, body{
    display:table;
    height:100%;
    width:100%;
    color: #252a3b;
    background-color: #f8f8f8;
    }
    .row__title{
    color: #53646f;
    font-weight: 400;
    font-size: 20px;
    margin: 0;
    }

    .row--top-40{
    margin-top: 40px;
    }

    .row--top-20{
    margin-top: 20px;
    }
    .table__th {
        color: #9eabb4;
        font-weight: 500;
        font-size: 12px;
        text-transform: uppercase;
    cursor: pointer;
        border:0 !important;
    padding: 15px 8px !important;
    }

    .table-row {
        border-bottom: 1px solid #e4e9ea;
    background-color: #fff;
    }
    .table__th:hover {
        color: #01b9d1;
    }

    .table--select-all {
        width: 18px;
        height: 18px;
        padding: 0 !important;
        border-radius: 50%;
        border: 2px solid #becad2;
    }
    .table-row__td {
        padding: 12px 8px !important;
        vertical-align: middle !important;
        color: #53646f;
        font-size: 13px;
        font-weight: 400;
    position:relative;
        line-height: 18px !important;
    border:0 !important;
    }

    .table-row__img{
    width: 36px;
        height: 36px;
        display: inline-block;
        border-radius: 50%;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    vertical-align: middle;
    }

    .table-row--chris .table-row__img {
        background-image: url('https://images.pexels.com/photos/428333/pexels-photo-428333.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb');
    }

    .table-row--angie .table-row__img {
        background-image: url('https://images.pexels.com/photos/785667/pexels-photo-785667.jpeg?w=940&h=650&auto=compress&cs=tinysrgb');
    }

    .table-row--ronald .table-row__img {
        background-image: url('https://images.pexels.com/photos/211050/pexels-photo-211050.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb');
    }

    .table-row--june .table-row__img {
        background-image: url('https://images.pexels.com/photos/709802/pexels-photo-709802.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb');
    }

    .table-row--ben .table-row__img {
        background-image: url('https://images.pexels.com/photos/736716/pexels-photo-736716.jpeg?w=940&h=650&auto=compress&cs=tinysrgb');
    }

    .table-row--natalie .table-row__img {
        background-image: url('https://images.pexels.com/photos/38554/girl-people-landscape-sun-38554.jpeg?w=940&h=650&auto=compress&cs=tinysrgb');
    }

    .table-row--thomas .table-row__img {
        background-image: url('https://images.pexels.com/photos/415326/pexels-photo-415326.jpeg?w=940&h=650&auto=compress&cs=tinysrgb');
    }








    .table-row__info {
        display: inline-block;
        padding-left: 12px;
    vertical-align: middle;
    }

    .table-row__name {
        color: #53646f;
        font-size: 14px;
        font-weight: 400;
    line-height: 18px;
        margin-bottom: 0px;
    }

    .table-row__small {
        color: #9eabb4;
        font-weight: 300;
        font-size: 12px;
    }

    .table-row__policy {
        color: #53646f;
        font-size: 13px;
        font-weight: 400;
        line-height: 18px;
        margin-bottom: 0px;
    }
    .table-row__p-status {
        margin-bottom: 0;
        font-size: 13px;
        vertical-align: middle;
        display: inline-block;
    color: #9eabb4;
    }


    .table-row__status{
        margin-bottom: 0;
        font-size: 13px;
        vertical-align: middle;
        display: inline-block;
    color: #9eabb4;
    }


    .table-row__progress{
        margin-bottom: 0;
        font-size: 13px;
        vertical-align: middle;
        display: inline-block;
    color: #9eabb4;
    }

    .status:before{
    content: '';
    margin-bottom: 0;
    width: 9px;
    height: 9px;
    display: inline-block;
    margin-right: 7px;
    border-radius: 50%; 
    }

    .status--red:before{
    background-color: #e36767;
    }

    .status--red{
    color: #e36767;
    }

    .status--blue:before{
    background-color: #3fd2ea;
    }

    .status--blue{
    color: #3fd2ea;
    }

    .status--yellow:before{
    background-color: #ecce4e;
    }

    .status--yellow{
    color: #ecce4e;
    }

    .status--green{
    color: #6cdb56;
    }
    .status--green:before{
    background-color: #6cdb56;
    }

    .status--grey{
    color: #9eabb4;
    }
    .status--grey:before{
    background-color: #9eabb4;
    }

    .table__select-row {
        appearence: none;
        -moz-appearance: none;
        -o-appearance: none;
        -webkit-appearance: none;
        width: 17px;
        height: 17px;
        margin: 0 0 0 5px !important;
        vertical-align: middle;
        border: 2px solid #beccd7;
        border-radius: 50%;
    cursor: pointer;
    }

    .table__select-row:hover{
    border-color:#01b9d1;
    }

    .table__select-row:checked {
        background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDI2IDI2IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNiAyNiIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCI+CiAgPHBhdGggZD0ibS4zLDE0Yy0wLjItMC4yLTAuMy0wLjUtMC4zLTAuN3MwLjEtMC41IDAuMy0wLjdsMS40LTEuNGMwLjQtMC40IDEtMC40IDEuNCwwbC4xLC4xIDUuNSw1LjljMC4yLDAuMiAwLjUsMC4yIDAuNywwbDEzLjQtMTMuOWgwLjF2LTguODgxNzhlLTE2YzAuNC0wLjQgMS0wLjQgMS40LDBsMS40LDEuNGMwLjQsMC40IDAuNCwxIDAsMS40bDAsMC0xNiwxNi42Yy0wLjIsMC4yLTAuNCwwLjMtMC43LDAuMy0wLjMsMC0wLjUtMC4xLTAuNy0wLjNsLTcuOC04LjQtLjItLjN6IiBmaWxsPSIjMDFiOWQxIi8+Cjwvc3ZnPgo=);
        background-position: center;
        background-size: 7px;
        background-repeat: no-repeat;
        border-color: #01b9d1;
    }

    .table-row--overdue {
        width: 3px;
        background-color: #e36767;
        display: inline-block;
        position: absolute;
        height: calc(100% - 24px);
        top: 50%;
        left: 0;
        transform: translateY(-50%);
    }

    .table-row__edit {
        width: 46px;
        padding: 8px 17px;
        display: inline-block;
        background-color: #daf3f8;
        border-radius: 18px;
        vertical-align: middle;
        margin-right: 10px;
    cursor: pointer;
    }

    .table-row__bin {
        width: 16px;
        display: inline-block;
        vertical-align: middle;
    cursor: pointer;
    }

    .table-row--red {
        background-color: #fff2f2;
    }

    @media screen and (max-width: 991px){
    .table__thead {
        display: none;
    }
    .table-row {
        display: inline-block;
        border: 0;
        background-color: #fff;
        width: calc(33.3% - 13px);
        margin-right: 10px;
        margin-bottom: 10px;
    }
    .table-row__img {
        width: 42px;
        height: 42px;
        margin-bottom: 10px;
    }
    
    .table-row__td:before{
        content:attr(data-column);
        color: #9eabb4;
        font-weight: 500;
        font-size: 12px;
        text-transform: uppercase;
        display: block;
    }
    
    .table-row__info {
        display: block;
        padding-left: 0;
    }
    
    .table-row__td {
        display: block;
        text-align: center;
        padding: 8px !important;
    }
    .table-row--red {
        background-color: #fff2f2;
    }
    .table__select-row{
        display: none;
    }
    
    .table-row--overdue {
        width: 100%;
        top: 0;
        left: 0;
        transform: translateY(0%);
        height: 4px;
        }
    }


    @media screen and (max-width: 680px){
    .table-row {
        width: calc(50% - 13px);
    }
    }

    @media screen and (max-width: 480px){
    .table-row {
        width: 100%;
    }
    }
</style>
    <main class="relative top-16 z-[10] px-4 md:px-4 py-10 flex flex-col justify-center items-center gap-4">
        <div class="container">
            <div class="row row--top-40">
                <div class="col-md-12">
                <h2 class="row__title">Not Retrieved (<?= mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id_peminjaman) as count FROM tbl_peminjaman WHERE tgl_pengembalian IS NULL"))['count'] ?>)</h2>
            </div>
        </div>
        <div class="w-full md:px-12 px-2 flex flex-col gap-4 md:flex-row justify-end items-center">
            <div class="flex gap-2">
                <p>Sort by</p>
                <select name="" id="sort-status">
                    <option value="">all status</option>
                    <?php 
                        $getStatus = mysqli_query($con, "SELECT status_peminjaman FROM `tbl_peminjaman` group by status_peminjaman");
                        while($s = mysqli_fetch_array($getStatus)['status_peminjaman']){
                    ?>
                    <option value="<?=$s?>"><?= $s ?></option>
                    <?php } ?>
                    <option value="late">late</option>
                </select>
            </div>
            <div class="flex gap-2">
                <p>Cari peminjam</p>
                <input type="text" class="focus:outline-none focus:ring-0 bg-transparent border-b-2 border-slate-400">
            </div>
        </div>
        <div class="row row--top-20 md:px-12 lg:px-24">
            <div class="col-md-12">
                <div class="table-container">
                    <table class="table" id="">
                        <thead class="table__thead">
                            <tr>
                                <th class="table__th">No</th>
                                <th class="table__th">Name</th>
                                <th class="table__th">Buku</th>
                                <th class="table__th">Awal/akhir pinjam </th>
                                <th class="table__th">dikembalikan</th>
                                <th class="table__th">Status</th>
                                <th class="table__th">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table__tbody">
                            <?php 
                            $currDate = date('Y-m-d');
                            $getIdentity = mysqli_query($con, 
                                "SELECT
                                    u.username, u.nama_lengkap, u.email, u.alamat, u.level,
                                    b.judul, b.image, 
                                    p.*
                                FROM
                                    tbl_peminjaman p
                                INNER JOIN tbl_user u ON p.id_user = u.id_user 
                                INNER JOIN tbl_buku b ON p.id_buku = b.id_buku
                                -- WHERE tgl_tegat < '$currDate' AND tgl_pengembalian IS NULL
                                ORDER BY tgl_tegat desc
                            ");
                            $rec = 1;
                            while($i = mysqli_fetch_array($getIdentity)){
                            
                            ?>
                                <tr class="table-row <?= $i['tgl_tegat'] < date('Y-m-d') && $i['tgl_pengembalian'] == NULL ? 'table-row--red' : '' ?>">
                                    <td class="table-row__td">
                                        <div class="<?= $i['tgl_tegat'] < date('Y-m-d') && $i['tgl_pengembalian'] == NULL ? 'table-row--overdue' : '' ?>"></div>
                                        <?= $rec ?>
                                    </td>
                                    <td class="table-row__td">
                                        <div class="table-row__info">
                                        <p class="table-row__name"><?= $i['nama_lengkap'] ?></p>
                                        <span class="table-row__small"><?= $i['level'] ?></span>
                                        </div>
                                    </td>
                                    <td data-column="Buku" class="table-row__td">
                                        <div class="">
                                            <p class="table-row__policy"><?= $i['judul'] ?></p>
                                        </div>                
                                    </td>
                                    <td data-column="Awal/akhir pinjam" class="table-row__td">
                                        <p class=""><?= DateTime::createFromFormat('Y-m-d', $i['tgl_peminjaman'])->format('d M Y') . ' - ' . DateTime::createFromFormat('Y-m-d', $i['tgl_tegat'])->format('d M Y') ?></p>
                                    </td>
                                    <td data-column="tanggal pengembalian" class="table-row__td">
                                        <?= $i['tgl_pengembalian'] != NULL ? DateTime::createFromFormat('Y-m-d', $i['tgl_pengembalian'])->format('d M Y') : 'Belum' ?>
                                    </td>
                                    <td  data-column="Status" class="table-row__td">
                                        <?php if($i['tgl_tegat'] == date('Y-m-d') && $i['tgl_pengembalian'] == NULL){ ?>
                                            <p class="table-row__status status--yellow status">Due</p>
                                        <?php }elseif($i['tgl_tegat'] < date('Y-m-d') && $i['tgl_pengembalian'] == NULL){ ?>
                                            <p class="table-row__status status--red status">Late</p>
                                        <?php }else{ ?>
                                            <p class="table-row__status status--<?= $i['status_peminjaman'] == 'on going' ? '' : ($i['status_peminjaman'] == 'retrieved' ? 'green status' : 'red status') ?> "><?= $i['status_peminjaman'] ?></p>
                                        <?php } ?>
                                    </td>
                                    <td class="table-row__td">
                                        <button>
                                            <svg width="2rem" height="2rem" viewBox="0 0 32.00 32.00" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.32"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#75cede;}.cls-2{fill:#00a6bc;}</style> </defs> <title></title> <g data-name="Layer 6" id="Layer_6"> <path class="cls-1" d="M3.64,6,16,14.77,28.36,6a1,1,0,0,1,1.08,0A4.08,4.08,0,0,0,26.92,5H5.08a4.08,4.08,0,0,0-2.52.9A1,1,0,0,1,3.64,6Z"></path> <path class="cls-2" d="M29.56,6a.86.86,0,0,1,.19.19,1,1,0,0,1-.23,1.39L16.58,16.81a1,1,0,0,1-1.16,0L2.48,7.57a1,1,0,0,1-.23-1.39A.86.86,0,0,1,2.44,6,4.08,4.08,0,0,0,1,9.08V22.92A4.08,4.08,0,0,0,5.08,27H26.92A4.08,4.08,0,0,0,31,22.92V9.08A4.08,4.08,0,0,0,29.56,6ZM13.78,18.81,3.64,26.05a1,1,0,0,1-.58.19,1,1,0,0,1-.81-.42,1,1,0,0,1,.23-1.39l10.14-7.24a1,1,0,0,1,1.16,1.62Zm16,7a1,1,0,0,1-.81.42,1,1,0,0,1-.58-.19L18.22,18.81a1,1,0,1,1,1.16-1.62l10.14,7.24A1,1,0,0,1,29.75,25.82Z"></path> </g> </g></svg>
                                        </button>  
                                    </td>
                                </tr>
                            <?php $rec++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
<?php include '../partials/_footer.php' ?>