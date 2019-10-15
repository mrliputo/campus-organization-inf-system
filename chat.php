<?php
/**
 * Description of chat
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'top.php';

$id_org = $_SESSION['id_org'];
$nama_org = $_SESSION['nama_org'];
echo $_SESSION['admin_of'];
?>

<div class="menu-list">
    <ul>
        <span><li class="inaktif"><a href="awal.php">Info & Event</a></li></span>
        <?php
        if($_SESSION['admin_of'] != 0) {
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
    <span><li class="aktif"><a href="chat.php">Chat Room</a></li></span>
    <span><li class="inaktif"><a href="tentang.php">Tentang Sistem</a></li></span>
</ul>
</div>
</div>

<!-- Biodata -->
<div id="content" class="container col-md-9setengah">

    <h3 style="margin-left: 6%; margin-top: 30px; font-weight: bold">Chat Room</h3>

    <div class="row info-event col-md-offset-dibawah1 awal-event-info">
        <div>
            <?php
            if(count($_SESSION['id_org']) == 0) {
                echo '<div class="alert alert-info col-md-11">Kamu tidak tergabung dalam organisasi manapun.</div>';
            }
            
            for ($i = 0; $i < count($nama_org); $i++) {

              $id = $_SESSION['id_org'][$i];

              $row = $mysqli->query("SELECT pic FROM tb_organisasi WHERE id_org = $id")->fetch_assoc();
              $pic = $row['pic'];

              if($pic == 1) {
                $src = "img/logo/".$id_org[$i].".jpg";
              }else{
                $src = "assets/logo_unja.png";
              }

            echo "
            <div class='col-md-3 chatroom'>
                <div class='nama-chat'><a href='#''>$nama_org[$i]</a></div>
                <img class='img-circle img-logo' src='".$src."' />
                <div class='hitler'>
                 <p class='bold'>
                  <a href=chatroom.php?id=$id class='btn btn-info btn-block btn-no-padding'>Masuk</a>
              </p>
          </div>
      </div>
      ";
  }
  ?>	

</div>
</div>
</div>
</div>
</div>

<?php include 'bottom.php' ?>

<script type="text/javascript" src="assets/script.js"></script>

</body>
</html>