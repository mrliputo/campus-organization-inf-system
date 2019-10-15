<?php

/**
 * Description of proses_edit_org
 *
 * @author Norman Syarif
 */

session_start();
include 'connect.php';

$id_org = $_SESSION['admin_of'];
$name_short = $mysqli->real_escape_string($_POST['name_short']);
$name_long = $mysqli->real_escape_string($_POST['name_long']);
$chairman = $mysqli->real_escape_string($_POST['chairman']);
$description = $mysqli->real_escape_string($_POST['description']);
$vision = $mysqli->real_escape_string($_POST['vision']);
$mission = $mysqli->real_escape_string($_POST['mission']);

$query = "UPDATE tb_organisasi SET "
        . "nama_org='$name_short', "
        . "kepanjangan_org='$name_long',"
        . "ketua_org='$chairman', "
        . "keterangan='$description', "
        . "visi='$vision', "
        . "misi='$mission' "
        . "WHERE id_org='$id_org'";

if ($mysqli->query($query)) {

  if ($_FILES['logo']['error'] == 0 && $_FILES['logo']['size'] < 1000000 && $_FILES['logo']['type'] == "image/jpeg" || $_FILES['logo']['type'] == "images/png") {
    move_uploaded_file($_FILES['logo']['tmp_name'], "../img/logo/" . $id_org . ".jpg");
    $mysqli->query("UPDATE `tb_organisasi` SET `pic`=1 WHERE id_org=$id_org");
  } else {
    echo "Logo gagal diubah!";
  }
  header("Location: ../profil_org.php");
} else {
  echo "Data gagal diubah";
}
