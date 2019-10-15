<?php

/**
 * Description of proses_password
 *
 * @author Norman Syarif
 */

session_start();
require_once('connect.php');

if (isset($_POST['form_cur_pass']) && isset($_POST['form_new_pass']) && isset($_SESSION['password_benar']) && isset($_SESSION['lebih_dari_lima']) && isset($_SESSION['password_cocok'])) {

  if ($_SESSION['password_benar'] == 1 && $_SESSION['lebih_dari_lima'] == 1 && $_SESSION['password_cocok'] == 1) {
    $new_pass = md5($_POST['form_new_pass']);
    $nim = $_SESSION['nim'];
    $query = "UPDATE tb_anggota SET password='$new_pass' WHERE nim='$nim'";
    $result = $mysqli->query($query);
    if ($result) {
      $_SESSION['password'] = $new_pass;
      header("Location: ../profil.php?successpass");
    }
  } else {
    header("Location: ../ubah_password.php?failpass");
  }
}

$_SESSION['lebih_dari_lima'] = 0;
$_SESSION['password_benar'] = 0;
$_SESSION['password_cocok'] = 0;
?>