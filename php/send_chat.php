<?php

/**
 * Description of send_chat
 *
 * @author Norman Syarif
 */

require_once 'connect.php';
session_start();
date_default_timezone_set("Asia/Jakarta");

$nim = $_SESSION['nim'];
$time = date("Y-m-d H:i:s");
$id_org = $_GET['id_org'];
$content = $mysqli->real_escape_string($_GET['content']);

$query = "INSERT INTO tb_chat (nim, waktu_post_chat, id_org, isi_chat) VALUES ('$nim','$time','$id_org','$content')";

$result = $mysqli->query($query);
?>