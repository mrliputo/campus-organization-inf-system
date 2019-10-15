<?php

/**
 * Description of proses_edit_profil
 *
 * @author Norman Syarif
 */

session_start();
date_default_timezone_set("Asia/Jakarta");
include 'connect.php';

$nim = $_SESSION['nim'];
$tempat_lahir = $mysqli->real_escape_string($_POST['tempat_lahir']);
$tanggal_lahir = $mysqli->real_escape_string($_POST['tanggal_lahir']);
$alamat = $mysqli->real_escape_string($_POST['alamat']);
$email = $mysqli->real_escape_string($_POST['email']);

$query = "UPDATE tb_anggota SET tempat_lahir='$tempat_lahir', "
        . "tanggal_lahir='$tanggal_lahir',alamat='$alamat', email='$email' "
        . "WHERE nim='$nim'";

if ($mysqli->query($query)) {

  //Set new session values
  $_SESSION['tempat_lahir'] = $tempat_lahir;
  $_SESSION['tanggal_lahir'] = $tanggal_lahir;
  $_SESSION['alamat'] = $alamat;
  $_SESSION['email'] = $email;
  

  if ($_FILES['foto']['error'] == 0 && $_FILES['foto']['size'] < 1000000 && $_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "images/png") {
    move_uploaded_file($_FILES['foto']['tmp_name'], "../img/foto_anggota/" . $_SESSION['nim'] . ".jpg");
    $mysqli->query("UPDATE `tb_anggota` SET `pic`=1 WHERE nim='$nim'");
    $_SESSION['pic'] = 1;
  }
  
   header("Location: ../profil.php");
} else {
  echo "Data gagal diubah";
}
?>