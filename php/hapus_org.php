<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'connect.php';

$id = $_GET['id'];
$mysqli->query("DELETE FROM `tb_organisasi` WHERE id_org='$id'");
header("Location: ../sadmin_org.php");
