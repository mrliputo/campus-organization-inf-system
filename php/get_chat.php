<?php

/**
 * Description of get_chat
 *
 * @author Norman Syarif
 */

session_start();
date_default_timezone_set("Asia/Jakarta");
require_once 'connect.php';
$id = $_GET['id'];

//Get all the messages from database
$query = "SELECT * FROM tb_chat INNER JOIN tb_anggota ON tb_chat.nim=tb_anggota.nim WHERE tb_chat.id_org = $id ORDER BY tb_chat.waktu_post_chat ASC";
$result = $mysqli->query($query);

if ($result->num_rows != 0) {
  while ($row = $result->fetch_assoc()) {

    $nim = $row['nim'];
    $time = date_format(date_create($row['waktu_post_chat']), "j M y, g:i a");
    $content = $row['isi_chat'];

    if ($nim == $_SESSION['nim']) {
      $name = "Me";
      $direct_chat_msg = "right";
      $direct_chat_name = "right";
      $direct_chat_timestamp = "left";
      $isMe = "me";
    } else {
      $name = $row['nama_anggota'];
      $direct_chat_msg = "";
      $direct_chat_name = "left";
      $direct_chat_timestamp = "right";
      $isMe = '';
    }

    $get_pic = $mysqli->query("SELECT pic, jenis_kelamin FROM tb_anggota WHERE nim='$nim'");
    if($get_pic->num_rows != 0) {
      $row = $get_pic->fetch_assoc();
      if($row['pic'] == 1) {
        $pic = $nim.".jpg";
      }else{
        if($row['jenis_kelamin'] == "Laki-laki") {
          $pic = "default_guy.jpg";
        }else{
          $pic = "default_girl.jpg";
        }
      }
    }

    echo "
					<div class='direct-chat-msg $direct_chat_msg'>
						<div class='direct-chat-info clearfix'>
							<span class='direct-chat-name pull-$direct_chat_name'>$name</span>
							<span class='direct-chat-timestamp pull-$direct_chat_timestamp'>$time</span>
						</div>
						<img class='direct-chat-img' src='img/foto_anggota/".$pic."' alt='Message User Image'>
						<div class='direct-chat-text $isMe'>
							$content
						</div>
					</div>
					";
  }
}
?>
