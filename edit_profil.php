<?php
/**
 * Description of edit_profil
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'top.php';

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
    <span><li class="aktif"><a href="profil.php">Profil Pengguna</a></li></span>
    <span><li class="inaktif"><a href="chat.php">Chat Room</a></li></span>
    <span><li class="inaktif"><a href="tentang.php">Tentang Sistem</a></li></span>
</ul>
</div>
</div>

<div id="content" class="col-md-9setengah">

    <div class="profil-box col-md-8 col-md-offset-2">
        <form action="php/proses_edit_profil.php" method="post" enctype="multipart/form-data">
            <?php
            if($_SESSION['pic'] != 0) {
                echo '<img src="img/foto_anggota/'.$nim.'.jpg">';
            }else{
                if($_SESSION['jenis_kelamin'] == "Laki-laki") {
                    echo '<img src="img/foto_anggota/default_guy.jpg">';    
                }else{
                    echo '<img src="img/foto_anggota/default_girl.jpg">';
                }
            }
            ?>

            <input style="display: none" id="i" type="file" id="file_gambar" name="foto" accept="image/png, image/jpeg" />
            <div id="change-button"><a href="javascript:void(0)">Ubah foto</a></div>

            <div class="nama-jurusan">
                <p class="nama"><?= $_SESSION['nama_anggota'] ?></p>
                <p><?= $_SESSION['jurusan'] ?></p>
            </div>
            <div class="clear"></div>
            <table class="bio">
                <tr>
                    <th>NIM</th>
                    <td><?= strtoupper($_SESSION['nim']) ?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><?= $_SESSION['jenis_kelamin'] ?></td>
                </tr>
                <tr>
                    <th>Fakultas</th>
                    <td><?= $_SESSION['fakultas'] ?></td>
                </tr>
                <tr>
                    <th>Angkatan</th>
                    <td><?= $_SESSION['angkatan'] ?></td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>
                        <input type="text" name="tempat_lahir" class="form-control input-sm" value="<?= $_SESSION['tempat_lahir'] ?>" required /></td>
                        <td><input type="date" name="tanggal_lahir" class="form-control input-sm" value="<?= $_SESSION['tanggal_lahir'] ?>" required />
                        </td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td colspan="2"><input type="text" name="alamat" class="form-control input-sm" value="<?= $_SESSION['alamat'] ?>" required /></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td colspan="2"><input type="email" name="email" class="form-control input-sm" value="<?= $_SESSION['email'] ?>" required /></td>
                    </tr>
                    <tr>
                        <td><a href="ubah_password.php">Ubah password</a></td>
                    </tr>
                </table>
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
