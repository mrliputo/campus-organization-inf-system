<?php

require_once 'connect.php';

$nim = $_GET['nim'];
$id_org = $_GET['id'];
$time = date("Y-m-d H:i:s");

if(isset($_GET['terima'])) {
    $mysqli->query("DELETE FROM tb_request WHERE nim='$nim' AND id_org=$id_org");
    $mysqli->query("INSERT INTO `tb_status_anggota`(`nim`, `id_org`, `status`) VALUES ('$nim',$id_org,'user')");
    $mysqli->query("INSERT INTO `tb_notif`(`nim`, `id_org`, `type`, `time`, `dibaca`) VALUES ('$nim',$id_org,3,'$time',0)");
}else{
    $mysqli->query("DELETE FROM tb_request WHERE nim='$nim' AND id_org=$id_org");
    $mysqli->query("INSERT INTO `tb_notif`(`nim`, `id_org`, `type`, `time`, `dibaca`) VALUES ('$nim',$id_org,4,'$time',0)");
}

header("Location: ../anggota.php");