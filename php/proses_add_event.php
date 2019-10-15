<?php

/**
 * Description of proses_add_info
 *
 * @author Norman Syarif
 */
session_start();
include 'connect.php';
date_default_timezone_set("Asia/Jakarta");

$id_org = $mysqli->real_escape_string($_SESSION['admin_of']);
$name = $mysqli->real_escape_string($_POST['nama-event']);
$date = $mysqli->real_escape_string(str_replace("T", " ", $_POST['tanggal-event'])) . ":00";
$location = $mysqli->real_escape_string($_POST['lokasi-event']);
$dresscode = $mysqli->real_escape_string($_POST['dresscode']);
$note = $mysqli->real_escape_string($_POST['keterangan']);
$date_now = $mysqli->real_escape_string(date("Y-m-d H:i:s"));
$ok_pic = 0;

if($_FILES['gambar-event']['name'] != "") {
  $ok_pic = 1;
}

$query = "INSERT INTO tb_event (id_org, tanggal_event, nama_event, "
        . "tanggal_post_event, lokasi, dresscode, ket_event, pic) VALUES "
        . "('$id_org','$date','$name','$date_now','$location','$dresscode','$note', $ok_pic)";

if ($mysqli->query($query)) {
  
  echo $_FILES['gambar-event']['tmp_name'];

  if ($_FILES['gambar-event']['error'] == 0 && $_FILES['gambar-event']['size'] < 1000000 && $_FILES['gambar-event']['type'] == "image/jpeg" || $_FILES['gambar-event']['type'] == "images/png") {
    move_uploaded_file($_FILES['gambar-event']['tmp_name'], "../img/event/" . $id_org . "_" . date("Ymd_His") . ".jpg");
  }

  $anggota = $mysqli->query("SELECT nim FROM tb_status_anggota WHERE id_org = $id_org");
  if($anggota->num_rows != 0) {
  	while ($row = $anggota->fetch_assoc()) {
  		$nim = $row['nim'];
  		$link = $id_org."_".date("Ymd_His");
  		$mysqli->query("INSERT INTO `tb_notif`(`nim`, `id_org`, `type`, `link`, `time`, `dibaca`) VALUES ('$nim',$id_org,2,'$link','$date_now',0)");
  		
  	}
  }

  header("Location: ../all_event_info.php");
} else {
  echo "Gagal";
}