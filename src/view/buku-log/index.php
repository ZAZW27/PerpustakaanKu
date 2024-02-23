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
    <main class="relative top-16 z-[10] px-4 md:px-4 py-10 flex flex-col justify-center items-start gap-4">
        <div class="container">
            <div class="row row--top-40">
                <div class="col-md-12">
                <h2 class="row__title">Employees (7)</h2>
            </div>
        </div>
        <div class="row row--top-20">
            <div class="col-md-12">
                <div class="table-container">
                    <table class="table">
                        <thead class="table__thead">
                            <tr>
                                <th class="table__th"><input id="selectAll" type="checkbox" class="table__select-row"></th>
                                <th class="table__th">Name</th>
                                <th class="table__th">Buku</th>
                                <th class="table__th">Awal/akhir pinjam </th>
                                <th class="table__th">dikembalikan</th>
                                <th class="table__th">Status</th>
                                <th class="table__th">Progress</th>
                                <th class="table__th"></th>
                            </tr>
                        </thead>
                        <tbody class="table__tbody">
                            <?php 
                            
                            $getIdentity = mysqli_query($con, 
                                "SELECT
                                    u.username, u.nama_lengkap, u.email, u.alamat, u.level,
                                    b.judul, b.image, 
                                    p.*
                                FROM
                                    tbl_peminjaman p
                                INNER JOIN tbl_user u ON p.id_user = u.id_user 
                                INNER JOIN tbl_buku b ON p.id_buku = b.id_buku
                                ORDER BY tgl_pengembalian
                            ");
                            $rec = 1;
                            while($i = mysqli_fetch_array($getIdentity)){
                            
                            ?>
                                <tr class="table-row">
                                    <td class="table-row__td">
                                        <?= $rec ?>
                                    </td>
                                    <td class="table-row__td">
                                        <div class="table-row__info">
                                        <p class="table-row__name"><?= $i['nama_lengkap'] ?></p>
                                        <span class="table-row__small"><?= $i['level'] ?></span>
                                        </div>
                                    </td>
                                    <td data-column="Buku" class="table-row__td">
                                        <div class="w-[10rem]">
                                            <p class="table-row__policy"><?= $i['judul'] ?></p>
                                        </div>                
                                    </td>
                                    <td data-column="Awal/akhir pinjam" class="table-row__td">
                                        <p class=""><?= $i['tgl_peminjaman'] . ' - ' . $i['tgl_tegat'] ?></p>
                                    </td>
                                    <td data-column="tanggal pengembalian" class="table-row__td">
                                        <?= $i['tgl_pengembalian'] != NULL ? $i['tgl_pengembalian'] : 'Belum' ?>
                                    </td>
                                    <td  data-column="Status" class="table-row__td">
                                        <?php if($i['tgl_tegat'] == date('Y-m-d') && $i['tgl_pengembalian'] == NULL){ ?>
                                            <p class="table-row__status status--yellow status">Due</p>
                                        <?php }else{ ?>
                                            <p class="table-row__status status--<?= $i['status_peminjaman'] == 'on going' ? 'blue' : ($i['status_peminjaman'] == 'retrieved' ? 'green' : 'red') ?> status"><?= $i['status_peminjaman'] ?></p>
                                        <?php } ?>
                                    </td>
                                    <td data-column="Progress" class="table-row__td">
                                        <p class="table-row__progress status--blue status">On Track</p>
                                    </td>
                                    <td class="table-row__td">
                                        <svg  data-toggle="tooltip" data-placement="bottom" title="Edit" version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve"><g>	<g>		<path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>
                                            <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>		<polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   " style="fill: rgb(1, 185, 209);"></polygon>	</g></g><g></g><g></g><g></g>
                                            <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                        </svg>
                                        <svg data-toggle="tooltip" data-placement="bottom" title="Delete" version="1.1" class="table-row__bin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M436,60h-90V45c0-24.813-20.187-45-45-45h-90c-24.813,0-45,20.187-45,45v15H76c-24.813,0-45,20.187-45,45v30    c0,8.284,6.716,15,15,15h16.183L88.57,470.945c0.003,0.043,0.007,0.086,0.011,0.129C90.703,494.406,109.97,512,133.396,512    h245.207c23.427,0,42.693-17.594,44.815-40.926c0.004-0.043,0.008-0.086,0.011-0.129L449.817,150H466c8.284,0,15-6.716,15-15v-30    C481,80.187,460.813,60,436,60z M196,45c0-8.271,6.729-15,15-15h90c8.271,0,15,6.729,15,15v15H196V45z M393.537,468.408    c-0.729,7.753-7.142,13.592-14.934,13.592H133.396c-7.792,0-14.204-5.839-14.934-13.592L92.284,150h327.432L393.537,468.408z     M451,120h-15H76H61v-15c0-8.271,6.729-15,15-15h105h150h105c8.271,0,15,6.729,15,15V120z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M256,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C271,186.716,264.284,180,256,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M346,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C361,186.716,354.284,180,346,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M166,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C181,186.716,174.284,180,166,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                            <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                        </svg>              
                                    </td>
                                </tr>
                            <?php $rec++; } ?>

                            <tr class="table-row table-row--angie">
                                <td class="table-row__td">
                                    1
                                </td>
                                <td class="table-row__td">
                                    <div class="table-row__info">
                                    <p class="table-row__name">Angie E. Swift</p>
                                    <span class="table-row__small">Vp of Sales</span>
                                    </div>
                                </td>
                                <td data-column="Policy" class="table-row__td">
                                    <div class="">
                                    <p class="table-row__policy">$20,000</p>
                                    <span class="table-row__small">All Inclusive Policy</span>
                                    </div>                
                                </td>
                                <td data-column="Policy Status" class="table-row__td">
                                    <p class="table-row__p-status status status--yellow">Awating Approval</p>
                                </td>
                                <td data-column="Destination" class="table-row__td">
                                    Huston, US
                                </td>
                                <td data-column="Status" class="table-row__td">
                                    <p class="table-row__status">Waiting</p>
                                </td>
                                <td data-column="Progress" class="table-row__td">
                                    <p class="table-row__progress">Waiting</p>
                                </td>
                                <td class="table-row__td">
                                    <svg  data-toggle="tooltip" data-placement="bottom" title="Edit" version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve"><g>	<g>		<path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>
                                        <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>		<polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   " style="fill: rgb(1, 185, 209);"></polygon>	</g></g><g></g><g></g><g></g>
                                        <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                    </svg>
                                    <svg data-toggle="tooltip" data-placement="bottom" title="Delete" version="1.1" class="table-row__bin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M436,60h-90V45c0-24.813-20.187-45-45-45h-90c-24.813,0-45,20.187-45,45v15H76c-24.813,0-45,20.187-45,45v30    c0,8.284,6.716,15,15,15h16.183L88.57,470.945c0.003,0.043,0.007,0.086,0.011,0.129C90.703,494.406,109.97,512,133.396,512    h245.207c23.427,0,42.693-17.594,44.815-40.926c0.004-0.043,0.008-0.086,0.011-0.129L449.817,150H466c8.284,0,15-6.716,15-15v-30    C481,80.187,460.813,60,436,60z M196,45c0-8.271,6.729-15,15-15h90c8.271,0,15,6.729,15,15v15H196V45z M393.537,468.408    c-0.729,7.753-7.142,13.592-14.934,13.592H133.396c-7.792,0-14.204-5.839-14.934-13.592L92.284,150h327.432L393.537,468.408z     M451,120h-15H76H61v-15c0-8.271,6.729-15,15-15h105h150h105c8.271,0,15,6.729,15,15V120z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M256,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C271,186.716,264.284,180,256,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M346,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C361,186.716,354.284,180,346,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M166,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C181,186.716,174.284,180,166,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                        <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                    </svg>              
                                </td>
                            </tr>
                            
                            <tr class="table-row table-row--june table-row--red">
                                <td class="table-row__td">
                                    <div class="table-row--overdue"></div>
                                    1
                                </td>
                                <td class="table-row__td">
                                    <div class="table-row__info">
                                    <p class="table-row__name">June Simmons</p>
                                    <span class="table-row__small">Social content manager</span>
                                    </div>
                                </td>
                                <td data-column="Policy" class="table-row__td">
                                    <div class="">
                                    <p class="table-row__policy">$5,000</p>
                                    <span class="table-row__small">Basic Policy</span>
                                    </div>                
                                </td>
                                <td data-column="Policy status" class="table-row__td">
                                    <p class="table-row__p-status status--red status">Rejected</p>
                                </td>
                                <td data-column="destination" class="table-row__td">
                                    Huston, US
                                </td>
                                <td data-column="status" class="table-row__td">
                                    <p class="table-row__status">Rejected</p>
                                </td>
                                <td data-column="progress" class="table-row__td">
                                    <p class="table-row__progress status status--red">Overdue</p>
                                </td>
                                <td class="table-row__td">
                                    <svg  data-toggle="tooltip" data-placement="bottom" title="Edit" version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve"><g>	<g>		<path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>
                                        <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>		<polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   " style="fill: rgb(1, 185, 209);"></polygon>	</g></g><g></g><g></g><g></g>
                                        <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                    </svg>
                                    <svg data-toggle="tooltip" data-placement="bottom" title="Delete" version="1.1" class="table-row__bin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M436,60h-90V45c0-24.813-20.187-45-45-45h-90c-24.813,0-45,20.187-45,45v15H76c-24.813,0-45,20.187-45,45v30    c0,8.284,6.716,15,15,15h16.183L88.57,470.945c0.003,0.043,0.007,0.086,0.011,0.129C90.703,494.406,109.97,512,133.396,512    h245.207c23.427,0,42.693-17.594,44.815-40.926c0.004-0.043,0.008-0.086,0.011-0.129L449.817,150H466c8.284,0,15-6.716,15-15v-30    C481,80.187,460.813,60,436,60z M196,45c0-8.271,6.729-15,15-15h90c8.271,0,15,6.729,15,15v15H196V45z M393.537,468.408    c-0.729,7.753-7.142,13.592-14.934,13.592H133.396c-7.792,0-14.204-5.839-14.934-13.592L92.284,150h327.432L393.537,468.408z     M451,120h-15H76H61v-15c0-8.271,6.729-15,15-15h105h150h105c8.271,0,15,6.729,15,15V120z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M256,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C271,186.716,264.284,180,256,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M346,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C361,186.716,354.284,180,346,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M166,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C181,186.716,174.284,180,166,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                        <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                    </svg>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
<?php include '../partials/_footer.php' ?>