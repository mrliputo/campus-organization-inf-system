<?php

/**
 * Description of proses_add_event
 *
 * @author Norman Syarif
 */
session_start();
include 'connect.php';
date_default_timezone_set("Asia/Jakarta");

$id_org = $mysqli->real_escape_string($_SESSION['admin_of']);
$name = $mysqli->real_escape_string($_POST['nama-info']);
$content = $mysqli->real_escape_string($_POST['isi-info']);
$date_now = $mysqli->real_escape_string(date("Y-m-d H:i:s"));
$ok_pic = 0;

if($_FILES['gambar-info']['name'] != "") {
  $ok_pic = 1;
}

$query = "INSERT INTO tb_info (id_org, nama_info, tanggal_post_info, isi_info, pic) VALUES ('$id_org','$name','$date_now','$content', $ok_pic)";

if ($mysqli->query($query)) {

  echo $_FILES['gambar-info']['tmp_name'];

  if ($_FILES['gambar-info']['error'] == 0 && $_FILES['gambar-info']['size'] < 1000000 && $_FILES['gambar-info']['type'] == "image/jpeg" || $_FILES['gambar-info']['type'] == "images/png") {
    move_uploaded_file($_FILES['gambar-info']['tmp_name'], "../img/info/" . $id_org . "_" . date("Ymd_His") . ".jpg");
  }

  $anggota = $mysqli->query("SELECT nim FROM tb_status_anggota WHERE id_org = $id_org");
  if($anggota->num_rows != 0) {
  	while ($row = $anggota->fetch_assoc()) {
  		$nim = $row['nim'];
  		$link = $id_org."_".date("Ymd_His");
  		$mysqli->query("INSERT INTO `tb_notif`(`nim`, `id_org`, `type`, `link`, `time`, `dibaca`) VALUES ('$nim',$id_org,1,'$link','$date_now',0)");
  		
  	}
  }

   header("Location: ../all_event_info.php");
} else {
  echo "Gagal";
}