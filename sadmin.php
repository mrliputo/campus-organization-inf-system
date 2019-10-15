<?php
/**
* Description of top
*
* @author Norman Syarif
*/
session_start();

date_default_timezone_set("Asia/Jakarta");
require 'php/connect.php';
require_once 'php/timestamp.php';
require_once 'php/extract_nim.php';

if ($_SESSION['nim'] != 'admin') {
  header("Location: index.php?login");
}

if(isset($_POST['proses'])) {
  $nim = $mysqli->real_escape_string(strtolower($_POST['nim']));
  $nama = $mysqli->real_escape_string($_POST['nama']);
  $jk = $_POST['jk'];
  $pass = md5(strtolower($nim));
  if(!$mysqli->query("INSERT INTO `tb_anggota`(`nim`, `nama_anggota`, `jenis_kelamin`,`password`) VALUES ('$nim','$nama','$jk','$pass')")) {
    echo "Gagal";
  }
}

$daftar = $mysqli->query("SELECT nama_anggota, nim FROM tb_anggota ORDER BY nama_anggota ASC");
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
              <span><li class="aktif"><a href="sadmin.php">Mahasiswa</a></li></span>
              <span><li class="inaktif"><a href="sadmin_org.php">Organisasi</a></li></span>
              <span><li class="inaktif"><a href="request.php">Request Password Baru</a></li></span>
            </ul>
          </div>
        </div>


        <div id="content" class="container col-md-9setengah">



          <div class="col-md-5 anggota-div" style="width: 40%; position: relative; left: 4%; top: 7%">
            <label style="position: relative; left: 37%">Tambah Mahasiswa</label>
            <form method="post">
              <table class="table table-hover table-striped">
                <tr>
                  <th>Nama</th>
                  <td><input name="nama" type="text" class="form-control input-sm" placeholder="Nama" required></td>
                </tr>
                <tr>
                  <th>NIM</th>
                  <td><input name="nim" type="text" class="form-control input-sm" placeholder="NIM" required></td>
                </tr>
                <tr>
                  <th>Jenis Kelamin</th>
                  <td><span style="margin-right: 10%"><input type="radio" name="jk" value="Laki-laki" checked> Laki-laki</span><span><input type="radio" name="jk" value="Perempuan"> Perempuan</span></td>
                </tr>
                <tr>
                  <td colspan="3"><button type="submit" name="proses" class="btn btn-info btn-sm" style="background-color: #3c8dbc">Save</button></td>
                </tr>

              </table>
            </form>
          </div>


          <div class="col-md-5 anggota-div" style="width: 50%; position: relative; left: 5%; top: 7%">
            <label style="position: relative; left: 37%">Daftar Mahasiswa</label>
            <table class="table table-hover table-striped">
              <tr>
                <th>Nama</th>
                <th style="width: 40%">Prodi</th>
                <th style="width: 15%">Aksi</th>
              </tr>

              <?php
              if($daftar->num_rows != 0) {
                while($row=$daftar->fetch_assoc()) {
                  if($row['nim'] == 'admin') {
                    continue;
                  }
                  echo "<tr>
                  <td><a href='profil.php?nim=".$row['nim']."'>".$row['nama_anggota']."</a></td>
                  <td>".get_fak_prodi_angkatan($row['nim'])['prodi']."</td>
                  <td><a title='Hapus' href='php/hapus_anggota.php?id=".$row['nim']."' class='btn btn-info hapus'><span class='glyphicon glyphicon-remove'></span> Hapus</a></td>
                  </tr>";
                }
              }
              ?>

            </table>
          </div>


        </div>


      </div>
    </div>

    <?php require_once 'bottom.php'; ?>
