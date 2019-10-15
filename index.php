<?php
/**
 * Description of index
 *
 * @author Norman Syarif
 */
session_start();
if (isset($_SESSION['nim'])) {
  header('Location: awal.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sistem Informasi Keorganisasian</title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/style.css">
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 atas" style="background: #ff5722">
                    <span id="logo-header">
                        <img src="assets/logo_unja.png" alt="Logo unja"/>
                    </span>
                    <span id="text-header">
                        Sistem Informasi Organisasi<br/>
                        Universitas Jambi
                    </span>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <div class="container login-form col-md-4 col-md-offset-1">

                        <div class="row">
                            <form action="php/proses_login.php" method="post" class="form-horizontal" role="form">
                                <div class="form-group">

                                    <?php
                                    // Show when an error occurs while login
                                    if (isset($_GET['salah'])) {
                                      echo '<div class="alert alert-danger salah">Password atau NIM Salah!</div>';
                                    } elseif (isset($_GET['notfound'])) {
                                      echo '<div class="alert alert-danger salah">NIM tidak ditemukan!</div>';
                                    } elseif (isset($_GET['login'])) {
                                      echo '<div class="alert alert-danger salah">Silahkan login dulu!</div>';
                                    } elseif (isset($_GET['logout'])) {
                                      echo '<div class="alert alert-success salah">Kamu telah logout!</div>';
                                    }
                                    ?>

                                    <div>
                                        <input id="input_nim" type="text" class="form-control" name="nim" placeholder="NIM" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div> 
                                        <input id="input_pass" type="password" class="form-control" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <div>
                                        <button id="login_btn" type="submit" class="btn btn-primary col-md-offset-4">Masuk</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <span>&copy; 2016<br />Kelompok 1 | Sistem Informasi UNJA</span>
        </div>

    </body>
</html>