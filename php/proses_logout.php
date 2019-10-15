<?php

/**
 * Description of proses_logout
 *
 * @author Norman Syarif
 */

session_start();
session_destroy();

header("Location: ../index.php?logout");
?>