<?php
/**
 * Description of edit_event
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'top.php';

$id_ev = $_GET['id'];

//Select event data
$id_org = substr($id_ev, 0, 1);
$tanggal_post_event = substr($id_ev, 2, 4) . "-" . substr($id_ev, 6, 2) . "-" . substr($id_ev, 8, 2) . " " . substr($id_ev, 11, 2) . ":" . substr($id_ev, 13, 2) . ":" . substr($id_ev, 15, 2);
$query = "SELECT * FROM tb_event INNER JOIN tb_organisasi ON tb_event.id_org=tb_organisasi.id_org WHERE tb_event.id_org=$id_org AND tb_event.tanggal_post_event='$tanggal_post_event'";
$result = $mysqli->query($query);
if ($result->num_rows != 0) {
  while ($row = $result->fetch_assoc()) {
    $name = $row['nama_event'];
    $name_org = $row['nama_org'];
    $tanggal = $row['tanggal_event'];
    $date = date_format(date_create($row['tanggal_event']), "l, j F Y. g:i A");
    $day_left = days_left($row['tanggal_event']);
    $location = $row['lokasi'];
    $dresscode = $row['dresscode'];
    $note = $row['ket_event'];
    $is_pic = $row['pic'];
    
    if ($is_pic == 1) {
      $pic = "img/event/" . $id_ev . ".jpg";
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
        <form enctype="multipart/form-data" action="php/proses_edit_event.php?id=<?= $id_ev ?>" method="post">
            
            <a target="_blank" href="<?= $pic ?>"><img src="<?= $pic ?>" alt="Gambar event"></a>
            
            <input style="display: none" id="i" type="file" id="file_gambar" name="logo" accept="image/png, image/jpeg" />
            <div id="change-button"><a href="javascript:void(0)">Ubah gambar</a></div>
            
            <div class="event-page">
                <p class="nama-event"><input type="text" name="nama-event" class="form-control" placeholder="Nama event" value="<?= $name ?>" required/></p>
                <p class="org-event"><?= $name_org ?></p>
            </div>
            <div class="clear"></div>
            <table>
                <tr>
                    <th>Tanggal</th>
                    <td><input type="text" name="tanggal-event" class="form-control input-sm" value="<?= substr($tanggal, 0, 16) ?>" placeholder="Tanggal event" required/></td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td><input type="text" name="lokasi" class="form-control input-sm" placeholder="Lokasi event" value="<?= $location ?>" required/></td>
                </tr>
                <tr>
                    <th>Dresscode</th>
                    <td><input type="text" name="dresscode" class="form-control input-sm" placeholder="Dresscode" value="<?= $dresscode ?>" required/></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>
                        <textarea name="keterangan" class="form-control input-sm" rows="6" placeholder="Keterangan"><?= $note ?></textarea>
                    </td>
                </tr>
                <tr>
                <input type="hidden" name="is_pic" value="<?= $is_pic ?>"> 
                    <td><button type="submit" class="btn btn-primary">Ubah</button></td>
                </tr>
            </table>
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