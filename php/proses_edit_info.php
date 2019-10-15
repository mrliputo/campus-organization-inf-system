<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'connect.php';
$id_in = $_GET['id'];

$id_org = substr($id_in, 0, 1);
$tanggal_post_info = substr($id_in, 2, 4) . "-" . substr($id_in, 6, 2) . "-" . substr($id_in, 8, 2) . " " . substr($id_in, 11, 2) . ":" . substr($id_in, 13, 2) . ":" . substr($id_in, 15, 2);

$subject = $mysqli->real_escape_string($_POST['subject']);
$info = $mysqli->real_escape_string($_POST['info']);
$pic_ok = $_POST['is_pic'];

if ($_FILES['logo']['name'] != '') {
    if ($_FILES['logo']['error'] == 0 && $_FILES['logo']['size'] < 2000000 && $_FILES['logo']['type'] == "image/jpeg" || $_FILES['logo']['type'] == "images/png") {
        move_uploaded_file($_FILES['logo']['tmp_name'], "../img/info/" . $id_in . ".jpg");
    }
    $pic_ok = 1;
}

$ubah = $mysqli->query("UPDATE tb_info SET id_org=$id_org, nama_info='$subject', isi_info='$info', pic=$pic_ok WHERE id_org=$id_org AND tanggal_post_info='$tanggal_post_info'");
if ($ubah) {
    echo "Berhasil";
    header("Location: ../info.php?id=$id_in");
} else {
    echo "Gagal";
}