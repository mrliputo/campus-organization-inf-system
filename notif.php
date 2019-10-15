<?php

function notif($type) {
	if($type == 1) {
		$msg = "menambahkan info baru";
	}elseif($type == 2) {
		$msg = "menambahkan event baru";
	}elseif($type == 3) {
		$msg = "menerima permintaan keanggotaan anda";
	}elseif($type == 4) {
		$msg = "menolak permintaan keanggotaan anda";
	}
	return $msg;
}

function go($type, $link, $id) {
	if($type == 1) {
		$lk = 'info.php?id='.$link.'';
	}elseif($type == 2) {
		$lk = 'event.php?id='.$link.'';
	}elseif($type == 3) {
		$lk = 'profil_org.php?id='.$id.'&acc';
	}elseif($type == 4) {
		$lk = 'profil_org.php?id='.$id.'&ref';
	}
	return $lk;
}

?>