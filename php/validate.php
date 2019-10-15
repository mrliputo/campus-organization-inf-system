<?php

/**
 * Description of validate
 *
 * @author Norman Syarif
 */

session_start();

$curpass = $_GET['curpass'];
$_SESSION['password_benar'] = 0;

$passlength = $_GET['passlength'];
$_SESSION['lebih_dari_lima'] = 0;

$newpass = $_GET['newpass'];
$confirm = $_GET['confirm'];
$_SESSION['password_cocok'] = 0;

//Check the current password
if (md5($curpass) == $_SESSION['password']) {
  echo "<p style='top: 36px; color: #259b24'>Password benar.</p>";
  $_SESSION['password_benar'] = 1;

  //Check the length of the new password (must be more than 5)
  if ($passlength >= 5) {
    echo "<p style='top: 91px; color: #259b24'>Lebih dari 5 karakter.</p>";
    $_SESSION['lebih_dari_lima'] = 1;

    //Re-type the new password
    if ($newpass == $confirm) {
      echo "<p style='top: 145px; color: #259b24'>Password cocok.</p>";
      $_SESSION['password_cocok'] = 1;
    } elseif ($newpass != $confirm && $confirm != "") {
      echo "<p style='top: 145px; color: #e51c23'>Password tidak cocok!</p>";
      $_SESSION['password_cocok'] = 0;
    }
  } elseif ($passlength < 5 && $passlength != 0) {
    echo "<p style='top: 91px; color: #e51c23'>Password  minimal 5 karakter!</p>";
    $_SESSION['lebih_dari_lima'] = 0;
  }
} elseif (md5($curpass != $_SESSION['password']) && $curpass != "") {
  echo "<p style='top: 36px; color: #e51c23'>Password salah!</p>";
  $_SESSION['password_benar'] = 0;
}
?>
