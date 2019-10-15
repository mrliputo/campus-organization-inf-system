<?php

/**
 * Description of proses_edit_event
 *
 * @author Norman Syarif
 */
require_once 'connect.php';
$id_ev = $_GET['id'];

$id_org = substr($id_ev, 0, 1);
$tanggal_post_event = substr($id_ev, 2, 4) . "-" . substr($id_ev, 6, 2) . "-" . substr($id_ev, 8, 2) . " " . substr($id_ev, 11, 2) . ":" . substr($id_ev, 13, 2) . ":" . substr($id_ev, 15, 2);

$tanggal_event = $mysqli->real_escape_string($_POST['tanggal-event']);
$nama_event = $mysqli->real_escape_string($_POST['nama-event']);
$lokasi = $mysqli->real_escape_string($_POST['lokasi']);
$ket_event = $mysqli->real_escape_string($_POST['keterangan']);
$dresscode = $mysqli->real_escape_string($_POST['dresscode']);

$pic_ok = $_POST['is_pic'];

if ($_FILES['logo']['name'] != '') {
    if ($_FILES['logo']['error'] == 0 && $_FILES['logo']['size'] < 2000000 && $_FILES['logo']['type'] == "image/jpeg" || $_FILES['logo']['type'] == "images/png") {
        move_uploaded_file($_FILES['logo']['tmp_name'], "../img/event/" . $id_ev . ".jpg");
    }
    $pic_ok = 1;
}

$ubah = $mysqli->query("UPDATE tb_event SET id_org=$id_org, tanggal_event='$tanggal_event', nama_event='$nama_event', lokasi='$lokasi', dresscode='$dresscode', ket_event='$ket_event', pic=$pic_ok WHERE id_org=$id_org AND tanggal_post_event='$tanggal_post_event'");
if ($ubah) {
    echo "Berhasil";
    header("Location: ../event.php?id=$id_ev");
} else {
    echo "Gagal";
}