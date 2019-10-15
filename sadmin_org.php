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

if ($_SESSION['nim'] != 'admin') {
  header("Location: index.php?login");
}

if(isset($_POST['proses'])) {
  $nim = $_POST['admin'];
  $cari_admin = $mysqli->query("SELECT nim FROM tb_anggota WHERE nim='$nim'");
  if($cari_admin->num_rows == 0) {
    echo "<script>alert('NIM admin tidak terdaftar');</script>";
  }else{
    $id=$_POST['id'];

    $status = $mysqli->query("SELECT status FROM tb_status_anggota WHERE nim='$nim' AND status='admin'");

    if($status->num_rows != 0) {
      echo "<script>alert('NIM telah terdaftar sebagai admin di organisasi lain');</script>";

    }else{
      $nama = $_POST['nama'];

      if(!$mysqli->query("INSERT INTO `tb_organisasi`(`id_org`, `nama_org`) VALUES ($id,'$nama')")) {
        echo "Gagal";
      }else{
        $mysqli->query("INSERT INTO `tb_status_anggota`(`nim`, `id_org`, `status`) VALUES ('$nim',$id,'admin')");
      }

    }
  }
}

$daftar = $mysqli->query("SELECT id_org, nama_org FROM tb_organisasi ORDER BY id_org DESC");
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
            <span><li class="aktif"><a href="sadmin_org.php">Organisasi</a></li></span>
            <span><li class="inaktif"><a href="request.php">Request Password Baru</a></li></span>
          </ul>
        </div>
      </div>


      <div id="content" class="container col-md-9setengah">



        <div class="col-md-5 anggota-div" style="width: 50%; position: relative; left: 4%; top: 7%">
          <label style="position: relative; left: 37%">Tambah Organisasi</label>
          <form method="post">
            <table class="table table-hover table-striped">
              <tr>
                <th>ID</th>
                <td><input name="id" type="text" class="form-control input-sm" placeholder="ID Organisasi" required></td>
              </tr>
              <tr>
                <th>Nama Organisasi</th>
                <td><input name="nama" type="text" class="form-control input-sm" placeholder="Nama Organisasi" required></td>
              </tr>
              <tr>
                <th>NIM Admin</th>
                <td><input name="admin" type="text" class="form-control input-sm" placeholder="NIM Ketua" required></td>
              </tr>
              <tr>
                <td colspan="3"><button name="proses" type="submit" class="btn btn-info btn-sm" style="background-color: #3c8dbc">Save</button></td>
              </tr>
            </table>
          </form>
        </div>

        <div class="col-md-5 anggota-div" style="width: 40%; position: relative; left: 5%; top: 7%">
          <label style="position: relative; left: 37%">Daftar Organisasi</label>
          <table class="table table-hover table-striped">
            <tr>
              <th style="width: 10%">ID</th>
              <th>Nama</th>
              <th style="width: 15%">Aksi</th>
            </tr>

            <?php
            if($daftar->num_rows != 0) {
              while ($row=$daftar->fetch_assoc()) {
                echo "<tr>
                <td>".$row['id_org']."</td>
                <td><a href='profil_org.php?id=".$row['id_org']."'>".$row['nama_org']."</a></td>
                <td><a title='Hapus' href='php/hapus_org.php?id=".$row['id_org']."' class='btn btn-info hapus'><span class='glyphicon glyphicon-remove'></span> Hapus</a></td>
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
