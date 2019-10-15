<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'connect.php';
$id = $_GET['id'];

if(isset($_GET['org'])) {
  $org = $_GET['org'];
  $mysqli->query("DELETE FROM `tb_status_anggota` WHERE nim='$id' AND id_org=$org");
  header("Location: ../anggota.php");
}else{
  $mysqli->query("DELETE FROM `tb_anggota` WHERE nim='$id'");
  header("Location: ../sadmin.php");
}
