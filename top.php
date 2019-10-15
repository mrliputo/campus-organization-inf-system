<?php
/**
 * Description of top
 *
 * @author Norman Syarif
 */

date_default_timezone_set("Asia/Jakarta");

require_once 'php/timestamp.php';

if (!isset($_SESSION['nim'])) {
  header("Location: index.php?login");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $_SESSION['nama_anggota']." | ".strtoupper($_SESSION['nim']) ?></title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <?php
            if($_SESSION['nim'] != "admin") {
                $background = "#ff5722";
            }else{
                $background = "#3c8dbc";
            }
            ?>
            <div class="col-md-12 atas" style="background: <?= $background ?>">
                <span id="logo-header">
                    <img src="assets/logo_unja.png" alt="Unja logo">
                </span>
                <span id="text-header">
                    Sistem Informasi Organisasi<br/>
                    Universitas Jambi
                </span>
                <div class="logout-dan-notif">
                    <a href="javascript:void(0)" id="logout" data-toggle="modal" data-target="#logout-modal" class="pull-right"><span class="glyphicon glyphicon-log-out"></span> Keluar</a>

                    <?php
                    if($_SESSION['nim'] != 'admin') {
                        echo '<a href="javascript:void(0)" id="notif" class="pull-right"><span class="glyphicon glyphicon-info-sign"></span> <span id="notif_menu"></span></a>';
                    }
                    ?>

                    <div class="modal fade" id="logout-modal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close pull left" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Logout</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Kamu yakin ingin logout?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Gak jadi</button>
                                    <a href="php/proses_logout.php" class="btn btn-success modal-button">Ya</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="notif-box">

        <div id="notif_ajax"></div>

        <button id="clear" style="margin-top: 8px; width: 95%; height: 25px; position: relative; left: 3%; padding-top: 3px" class="btn btn-info btn-sm">Clear notifikasi</button>
    </div>

    <script type="text/javascript">

        var nim = "<?= $_SESSION['nim'] ?>";
        $("#clear").click(function() {
            $.ajax({
                method: "GET",
                url: "php/clear_notif.php?nim=" + nim
            });
        });

        get_notif();

        function get_notif() {
            $.ajax({
                method: "GET",
                url: "php/notif_box.php?nim=" + nim,
                success: function(data) {
                    $("#notif_ajax").html(data);
                }
            });
            setTimeout('get_notif()', 1000);
        }

    </script>

    <!-- SELESSSSSSSAAAAAAAAAAAAAAAAAAAAAAAAII -->


    <div class="container-fluid">
        <div class="row row-eq-height">
            <div id="menu" class="col-md-2setengah">

                <div id="profile">

                    <?php
                    if($_SESSION['pic'] != 0) {
                        echo '<img src="img/foto_anggota/'.$_SESSION['nim'].'.jpg" class="img-circle" alt="Profile photo">';
                    }else{
                        if($_SESSION['jenis_kelamin'] == "Laki-laki") {
                            echo '<img src="img/foto_anggota/default_guy.jpg" class="img-circle" alt="Profile photo">';    
                        }else{
                            echo '<img src="img/foto_anggota/default_girl.jpg" class="img-circle" alt="Profile photo">';
                        }
                    }
                    ?>
                    
                    <br />
                    <div class="nama-dan-jurusan">
                        <p><span id="nama"><?= $_SESSION['nama_anggota'] ?></span><br /><span id="jurusan"><?= $_SESSION['jurusan'] ?></span></p>
                    </div>
                </div>

                <div id="search">
                    <form action="search.php" method="get">
                        <input name="q" type="text" placeholder="Ketikkan nama organisasi...">
                    </form>
                </div>
