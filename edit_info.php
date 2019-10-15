<?php
/**
 * Description of edit_info
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'top.php';

$id_in = $_GET['id'];

$id_org = substr($id_in, 0, 1);
$tanggal_post_info = substr($id_in, 2, 4) . "-" . substr($id_in, 6, 2) . "-" . substr($id_in, 8, 2) . " " . substr($id_in, 11, 2) . ":" . substr($id_in, 13, 2) . ":" . substr($id_in, 15, 2);
$query = "SELECT * FROM tb_info INNER JOIN tb_organisasi ON tb_info.id_org=tb_organisasi.id_org WHERE tb_info.id_org=$id_org AND tb_info.tanggal_post_info='$tanggal_post_info'";
$result = $mysqli->query($query);
if ($result->num_rows != 0) {
  while ($row = $result->fetch_assoc()) {
    $name = $row['nama_info'];
    $name_org = $row['nama_org'];
    $info = $row['isi_info'];
    
    $is_pic = $row['pic'];
    
    if ($is_pic == 1) {
      $pic = "img/info/" . $id_in . ".jpg";
    } else {
      $pic = "img/logo/" . $id_org . ".jpg";
    }
    
  }
}

?>

<div class="menu-list">
    <ul>
        <span><li class="inaktif"><a href="awal.php">Info & Event</a></li></span>
        <?php
        if($_SESSION['admin_of'] != 0) {
            echo '<span><li class="aktif"><a href="javascript:void(0)">Kelola Organisasi <span class="caret"></span></a></li>
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
        <form enctype="multipart/form-data" action="php/proses_edit_info.php?id=<?= $id_in ?>" method="post">
            
            <a target="_blank" href="<?= $pic ?>"><img src="<?= $pic ?>" alt="Gambar event"></a>
            
            <input style="display: none" id="i" type="file" id="file_gambar" name="logo" accept="image/png, image/jpeg" />
            <div id="change-button"><a href="javascript:void(0)">Ubah gambar</a></div>
            
            <div class="event-page">
                <p class="nama-event"><input type="text" name="subject" class="form-control input-sm" placeholder="Subject" value="<?= $name ?>" required></p>
                <p class="org-event"><?= $name_org ?></p>
            </div>
            <div class="clear"></div>
            <p>
                <textarea name="info" class="form-control input-sm kebawah-sedikit" rows="6" placeholder="Informasi" required><?= $info ?></textarea>
                <input type="hidden" name="is_pic" value="<?= $is_pic ?>"> 
                <button type="submit" class="btn btn-primary">Ubah</button>
        </form>
    </div>

</div>

</div>
</div>
</div>

<?php include 'bottom.php' ?>

<script type="text/javascript" src="assets/script.js"></script>

<script type="text/javascript">
  $('#change-button').click(function () {
      $('#i').click();
  });

  $('#i').change(function () {
      var full_fakepath = $('#i').val().toString().split('\\');
      var fakepath = full_fakepath[full_fakepath.length - 1];
      if (fakepath.length <= 10) {
          $("#change-button a").html(fakepath);
      } else {
          var new_fake_path = fakepath.substr(0, 12);
          $("#change-button a").html(new_fake_path + '...');
      }

  });
</script>

</body>
</html>