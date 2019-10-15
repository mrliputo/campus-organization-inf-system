<?php
/**
 * Description of top
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'php/timestamp.php';

$id_in = $_GET['id'];
$id_org = substr($id_in, 0, 1);

$nim = $_SESSION['nim'];
$link = $_GET['id'];

$kueri = $mysqli->query("SELECT * FROM tb_notif WHERE nim='$nim' AND link='$link' AND id_org=$id_org AND type=1");
if($kueri->num_rows != 0 && $kueri->fetch_assoc()['dibaca'] == 0) {
    $mysqli->query("UPDATE `tb_notif` SET `dibaca`=1 WHERE nim='$nim' AND link='$link' AND id_org=$id_org AND type=1");
}

//Select info data

$tanggal_post_info = substr($id_in, 2, 4) . "-" . substr($id_in, 6, 2) . "-" . substr($id_in, 8, 2) . " " . substr($id_in, 11, 2) . ":" . substr($id_in, 13, 2) . ":" . substr($id_in, 15, 2);
$query = "SELECT tb_info.nama_info, tb_info.tanggal_post_info, tb_info.isi_info, tb_info.pic, tb_organisasi.nama_org FROM tb_info INNER JOIN tb_organisasi ON tb_info.id_org=tb_organisasi.id_org WHERE tb_info.id_org=$id_org AND tb_info.tanggal_post_info='$tanggal_post_info'";
$result = $mysqli->query($query);
if ($result->num_rows != 0) {
  while ($row = $result->fetch_assoc()) {
    $name = $row['nama_info'];
    $name_org = $row['nama_org'];
    $date = time_ago($row['tanggal_post_info']);
    $info = $row['isi_info'];
    $is_pic = $row['pic'];

    if ($is_pic == 1) {
      $pic = "img/info/" . $id_in . ".jpg";
    } else {
      $pic = "img/logo/" . $id_org . ".jpg";
    }
    
  }
}else{
    header("Location: 404.php");
}

require_once 'top.php';

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
        <a target="_blank" href="<?= $pic ?>"><img src="<?= $pic ?>" alt="gambar info"></a>
        <div class="event-page">
            <p class="nama-event"><?= $name ?></p>
            <p class="org-event"><?= $name_org ?></p>
            <?php
            if($id_org == $_SESSION['admin_of']) {
                echo '<p><a class="btn btn-info" href="edit_info.php?id='.$id_in.'" id="edit"><span class="glyphicon glyphicon-edit"></span> Edit</a></p>';
            }else{
                echo "<br><br>";
            }
            ?>
        </div>
        <div class="clear"></div>
        <p style="font-size: 90%; font-style: italic"><?= $date ?></p>
        <p><?= $info ?></p>
    </div>

</div>

</div>
</div>
</div>

<?php include 'bottom.php' ?>

<script type="text/javascript" src="assets/script.js"></script>

</body>
</html>