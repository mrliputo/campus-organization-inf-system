<?php
/**
 * Description of add_info
 *
 * @author Norman Syarif
 */

session_start();

require_once 'php/connect.php';
require_once 'top.php';

$id_org = $_SESSION['admin_of'];

//Select the organization's name and put them in variables
$result = $mysqli->query("SELECT nama_org FROM tb_organisasi WHERE id_org=$id_org");
if ($result->num_rows != 0) {
  while ($row = $result->fetch_assoc()) {
    $name_short = $row['nama_org'];
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
        <form action="php/proses_add_info.php" method="post" enctype="multipart/form-data">
            <img src="img/logo/<?= $_SESSION['admin_of'] ?>.jpg" alt="Gambar info">

            <input style="display: none" id="i" type="file" id="file_gambar" name="gambar-info" accept="image/png, image/jpeg" />
            <div id="change-button"><a href="javascript:void(0)">Upload gambar</a></div>
            
            <div class="event-page">
                <p class="nama-event"><input type="text" name="nama-info" class="form-control input-sm" placeholder="Subject" required></p>
                <p class="org-event"><?= $name_short ?></p>
            </div>
            <div class="clear"></div>
            <p>
                <textarea name="isi-info" class="form-control input-sm kebawah-sedikit" rows="6" placeholder="Informasi..." required></textarea>
                <button type="submit" class="btn btn-primary">Submit</button>
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