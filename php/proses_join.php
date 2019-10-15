<?php

session_start();
require_once 'connect.php';

$id_org = $_GET['id'];
$nim = $_SESSION['nim'];

$insert = $mysqli->query("INSERT INTO `tb_request`(`nim`, `id_org`) VALUES ('$nim',$id_org)");

header("Location: ../profil_org.php?id=$id_org");