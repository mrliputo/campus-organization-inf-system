<?php
/**
 * Description of top
 *
 * @author Norman Syarif
 */
session_start();

if ($_SESSION['nim'] != 'admin') {
    header("Location: index.php?login");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Super Admin</title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="assets/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/style.css">
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 atas" style="background-color: #3c8dbc">
                    <span id="logo-header">
                        <img src="assets/logo_unja.png" alt="Unja logo">
                    </span>
                    <span id="text-header">
                        Sistem Informasi Organisasi<br/>
                        Universitas Jambi
                    </span>
                    <div class="logout-dan-notif">
                        <a href="javascript:void(0)" id="logout" data-toggle="modal" data-target="#logout-modal" class="pull-right"><span class="glyphicon glyphicon-log-out"></span> Keluar</a>

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

        <div class="container-fluid">
            <div class="row row-eq-height">
                <div id="menu" class="col-md-2setengah">

                    <div id="profile">
                        <img src="img/foto_anggota/admin.jpg" class="img-circle" alt="Profile photo"><br />
                        <div class="nama-dan-jurusan">
                            <p><span id="nama">Super Admin</p>
                        </div>
                    </div>
                    <div class="menu-list">
                        <ul>
                            <span><li class="inaktif"><a href="sadmin.php">Mahasiswa</a></li></span>
                            <span><li class="inaktif"><a href="sadmin_org.php">Organisasi</a></li></span>
                            <span><li class="aktif"><a href="request.php">Request Password Baru</a></li></span>
                        </ul>
                    </div>
                </div>


                <div id="content" class="container col-md-9setengah">



                    <div class="col-md-5 anggota-div" style="width:23%; position: relative; left: 36%; top: 20%">
                        <form class="form-inline" action="sadmin_ubah.php">
                        <input name="nim" type="text" class="form-control input-sm" placeholder="NIM" required>
                        <button type="submit" class="btn btn-info btn-sm">Cari</button>
                        </form>
                    </div>


                </div>


            </div>
        </div>

        <?php require_once 'bottom.php'; ?>
