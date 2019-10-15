<?php

require_once 'connect.php';

$nim = $_GET['nim'];

$mysqli->query("DELETE FROM tb_notif WHERE nim='$nim'");