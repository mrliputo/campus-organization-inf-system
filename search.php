<?php

session_start();

require_once 'php/connect.php';
require_once 'top.php';

$keyword = $_GET['q'];
?>

<div class="menu-list">
  <ul>
    <span><li class="inaktif"><a href="awal.php">Info & Event</a></li></span>
    <?php
    if ($_SESSION['admin_of'] != 0) {
      echo '<span><li class="inaktif"><a href="javascript:void(0)">Kelola Organisasi <span class="caret"></span></a></li>
      <ul>
      <li><a href="profil_org.php">Profil Organisasi</a></li>
      <li><a href="anggota.php">Anggota</a></li>
      <li><a href="absensi.php">Absensi</a></li>
      </ul>
      </span>';
    }
    ?>
    <span><li class="inaktif"><a href="profil.php">Profil Pengguna</a></li></span>
    <span><li class="inaktif"><a href="chat.php">Chat Room</a></li></span>
    <span><li class="inaktif"><a href="tentang.php">Tentang Sistem</a></li></span>
  </ul>
</div>
</div>

<div id="content" class="col-md-9setengah">
  <div class="profil-box col-md-8 col-md-offset-2">

    <?php

    function anti_hacker($gak_safe) {
      $udah_safe = stripslashes(strip_tags(htmlspecialchars($gak_safe, ENT_QUOTES)));
      return $udah_safe;
    }

    if(isset($_GET['q'])){
      $kata_kunci = $mysqli->real_escape_string(anti_hacker(trim($_GET['q'])));

      if(strlen($kata_kunci)<3){
        echo '<p>Kata kunci terlalu pendek.</p>';
      }else{
        $where = "";
        $kata_kunci_split = preg_split('/[\s]+/', $kata_kunci);
        $total_kata_kunci = count($kata_kunci_split);

        foreach($kata_kunci_split as $key=>$kunci){
          $where .= "nama_org LIKE '%$kunci%'";
          if($key != ($total_kata_kunci - 1)){
            $where .= " OR ";
          }
        }

        $results = $mysqli->query("SELECT * FROM tb_organisasi WHERE $where");

        $num = $results->num_rows;

        if($num == 0){
          echo '<p>Pencarian <b>'.$kata_kunci.'</b> tidak ditemukan</p>';
        }else{
          echo '<p>Hasil pencarian <b>'.$kata_kunci.'</b></p>';
          while($row = $results->fetch_assoc()){
            echo '
            <a href="profil_org.php?id='.$row['id_org'].'">
            <img style="width: 100px; height: 100px; margin-top: 20px" src="./img/logo/'.$row['id_org'].'.jpg" />
            <p style="font-size: 130%; font-weight: bold; position: relative; left: 3%; top: 20px; color: black">'.$row['nama_org'].'</p>
            <p style="position: relative; left: 3%; top: 20px; color: black">'.$row['kepanjangan_org'].'</p>
            </a>';
          }
        }
      }
    }else{
      echo "Ketikkan keyboard diatas!";
    }

    ?>

  </div>


</div>
