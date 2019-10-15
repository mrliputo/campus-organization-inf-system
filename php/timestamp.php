<?php

/**
 * Description of timestamp
 *
 * @author Norman Syarif
 */

date_default_timezone_set("Asia/Jakarta");

//This function returns the timestamp of an info since the time it was posted
function time_ago($date) {
  $date_diff = (time() - strtotime($date));
  if ($date_diff < 60) {
    $e = "Baru saja";
  } elseif ($date_diff < 3600) {
    $minutes = floor($date_diff / 60);
    $e = $minutes . " menit yang lalu";
  } elseif ($date_diff < 86400) {
    $hours = floor($date_diff / 60 / 60);
    $e = $hours . " jam yang lalu";
  } elseif ($date_diff < 432000) {
    $days = floor($date_diff / 60 / 60 / 24);
    $e = $days . " hari yang lalu";
  } else {
    $e = date_format(date_create($date), "j M Y");
  }
  return $e;
}

//This function returns the information about the number of day left until an event occurs 
function days_left($date) {
  $year = substr($date, 0, 4);
  $month = substr($date, 5, 2);
  $day = substr($date, 8, 2);

  $date_target = strtotime(date("Y-m-d H:i:s", mktime(0, 0, 0, $month, $day, $year)));
  $date_diff = $date_target - time();
  if ($date_diff <= -86400) {
    $e = "<span style='font-size: 90%; color: red'>(Passed)</span>";
  } elseif ($date_diff <= 0) {
    $e = "<span style='font-size: 90%; color: green; font-weight: bold'>(Hari ini)</span>";
  } elseif ($date_diff <= 86400) {
    $e = "<span style='font-size: 90%; color: blue'>(Besok)</span>";
  } else {
    $n = ceil($date_diff / 60 / 60 / 24);
    $e = "<span style='font-size: 90%; color: blue'>(" . $n . " hari lagi)</span>";
  }
  return $e;
}
