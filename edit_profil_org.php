<?php
/**
 * Description of edit_profil_org
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'top.php';

$id_org = $_SESSION['admin_of'];

//Select organization data and store them in variables
$result = $mysqli->query("SELECT * FROM tb_organisasi WHERE id_org=$id_org");
if ($result->num_rows != 0) {
  while ($row = $result->fetch_assoc()) {
    $name_short = $row['nama_org'];
    $name_long = $row['kepanjangan_org'];
    $chairman = $row['ketua_org'];
    $description = $row['keterangan'];
    $vision = $row['visi'];
    $mission = $row['misi'];
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
        <form enctype="multipart/form-data" action="php/proses_edit_org.php" method="post">

            <?php
                $row = $mysqli->query("SELECT pic FROM tb_organisasi WHERE id_org = $id_org")->fetch_assoc();
                $pic = $row['pic'];

                if($pic == 1) {
                    echo '<img src="img/logo/'.$id_org.'.jpg">';
                }else{
                    echo '<img src="assets/logo_unja.png">';
                }
            ?>

            <input style="display: none" id="i" type="file" id="file_gambar" name="logo" accept="image/png, image/jpeg" />
            <div id="change-button"><a href="javascript:void(0)">Ubah logo</a></div>

            <div class="profil-org">
                <p class="nama"><input type="text" name="name_short" class="form-control" value="<?= $name_short ?>" required /></p>
                <p class="kepanjangan-org"><input type="text" name="name_long" class="form-control input-sm" value="<?= $name_long ?>" required/></p>
            </div>
            <div class="clear"></div>
            <table>
                <tr>
                    <th>Ketua</th>
                    <td><input type="text" name="chairman" class="form-control input-sm" value="<?= $chairman ?>" required/></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>
                        <textarea name="description" class="form-control" rows="6" required><?= $description ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Visi</th>
                    <td>
                        <textarea name="vision" class="form-control" rows="6" required><?= $vision ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Misi</th>
                    <td>
                        <textarea name="mission" class="form-control" rows="6" required><?= $mission ?></textarea>
                    </td>
                </tr>
            </table>
            <button class="btn btn-primary">Ubah</button>
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