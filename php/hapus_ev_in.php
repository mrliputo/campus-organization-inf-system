<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'connect.php';
$get_id=$_GET['id'];
$tanggal = substr($get_id, 2, 4) . "-" . substr($get_id, 6, 2) . "-" . substr($get_id, 8, 2) . " " . substr($get_id, 11, 2) . ":" . substr($get_id, 13, 2) . ":" . substr($get_id, 15, 2);
if(isset($_GET['ev'])) {
    $mysqli->query("DELETE FROM tb_event WHERE tanggal_post_event='$tanggal'");
    echo "wow";
}else{
    $mysqli->query("DELETE FROM tb_info WHERE tanggal_post_info='$tanggal'");
    echo "yay";
}
header("Location: ../all_event_info.php");