<?php
/**
 * Description of event
 *
 * @author Norman Syarif
 */

session_start();

require_once 'php/connect.php';
require_once 'php/timestamp.php';

$id_ev = $_GET['id'];
$id_org = substr($id_ev, 0, 1);

$nim = $_SESSION['nim'];
$link = $_GET['id'];

$kueri = $mysqli->query("SELECT * FROM tb_notif WHERE nim='$nim' AND link='$link' AND id_org=$id_org AND type=2");
if($kueri->num_rows != 0 && $kueri->fetch_assoc()['dibaca'] == 0) {
    $mysqli->query("UPDATE `tb_notif` SET `dibaca`=1 WHERE nim='$nim' AND link='$link' AND id_org=$id_org AND type=2");
}

//Select event data
$tanggal_post_event = substr($id_ev, 2, 4) . "-" . substr($id_ev, 6, 2) . "-" . substr($id_ev, 8, 2) . " " . substr($id_ev, 11, 2) . ":" . substr($id_ev, 13, 2) . ":" . substr($id_ev, 15, 2);
$result = $mysqli->query("SELECT tb_event.tanggal_event, tb_event.nama_event, tb_event.tanggal_post_event, tb_event.lokasi, tb_event.dresscode, tb_event.ket_event, tb_event.pic, tb_organisasi.nama_org FROM tb_event INNER JOIN tb_organisasi ON tb_event.id_org=tb_organisasi.id_org WHERE tb_event.id_org=$id_org AND tb_event.tanggal_post_event='$tanggal_post_event'");
if ($result->num_rows != 0) {
  while ($row = $result->fetch_assoc()) {
    $name = $row['nama_event'];
    $name_org = $row['nama_org'];
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
}else{
    // header("Location: 404.php");
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
        <a target="_blank" href="<?= $pic ?>"><img src="<?= $pic ?>" alt="Gambar event"></a>
        <div class="event-page">
            <p class="nama-event"><?= $name ?></p>
            <p class="org-event"><?= $name_org ?></p>
            
            <?php
            if($id_org == $_SESSION['admin_of']) {
                echo '<p><a class="btn btn-info" href="edit_event.php?id='.$id_ev.'" id="edit"><span class="glyphicon glyphicon-edit"></span> Edit</a></p>';
            }else{
                echo "<br>";
            }
            ?>
            
        </div>
        <div class="clear"></div>
        <table>
            <tr>
                <th>Tanggal</th>
                <td><?= $date ." ". $day_left?></td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td><?= $location ?></td>
            </tr>
            <tr>
                <th>Dresscode</th>
                <td><?= $dresscode ?></td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td><?= $note ?></td>
            </tr>
        </table>
    </div>

</div>

</div>
</div>
</div>

<?php include 'bottom.php' ?>

<script type="text/javascript" src="assets/script.js"></script>

</body>
</html>