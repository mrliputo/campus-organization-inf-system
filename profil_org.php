<?php
/**
 * Description of profil_org
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';

if (isset($_GET['id'])) {
    $id_org = $_GET['id'];
} else {
    $id_org = $_SESSION['admin_of'];
}

$nim = $_SESSION['nim'];

if(isset($_GET['acc'])) {
    if($mysqli->query("SELECT * FROM tb_notif WHERE nim='$nim' AND id_org=$id_org AND type=3")->num_rows != 0) {
        $mysqli->query("UPDATE `tb_notif` SET `dibaca`=1 WHERE nim='$nim' AND id_org=$id_org AND type=3");

        $row = $mysqli->query("SELECT nama_org FROM tb_organisasi WHERE id_org = $id_org")->fetch_assoc();
        array_push($_SESSION['id_org'], $id_org);
        array_push($_SESSION['nama_org'], $row['nama_org']);
    }
}elseif(isset($_GET['ref'])) {
    if($mysqli->query("SELECT * FROM tb_notif WHERE nim='$nim' AND id_org=$id_org AND type=4")->num_rows != 0) {
        $mysqli->query("UPDATE `tb_notif` SET `dibaca`=1 WHERE nim='$nim' AND id_org=$id_org AND type=4");
    }
}


require_once 'top.php';

//Select the organization data and put them in variables
$result_org = $mysqli->query("SELECT * FROM tb_organisasi WHERE id_org=$id_org");
if ($result_org->num_rows != 0) {
    while ($row = $result_org->fetch_assoc()) {
        $name_short = $row['nama_org'];
        $name_long = $row['kepanjangan_org'];
        $chairman = $row['ketua_org'];
        $description = $row['keterangan'];
        $vision = $row['visi'];
        $mission = $row['misi'];
        $pic = $row['pic'];
    }
}

//Select the events and info
$result_ev = $mysqli->query("SELECT id_org, tanggal_post_event, pic FROM tb_event WHERE id_org='$id_org' ORDER BY tanggal_post_event DESC LIMIT 2");
$result_in = $mysqli->query("SELECT id_org, tanggal_post_info, pic FROM tb_info WHERE id_org='$id_org' ORDER BY tanggal_post_info DESC LIMIT 2");
?>

<div class="menu-list">
    <ul>
        <?php
        if($_SESSION['nim'] != "admin") {
            echo '
            <span><li class="inaktif"><a href="awal.php">Info & Event</a></li></span>';
            if($_SESSION['admin_of'] != 0) {
                echo '
                <span>
                    <li class="inaktif">
                        <a href="javascript:void(0)">Kelola Organisasi <span class="caret"></span></a>
                    </li>
                    <ul>
                        <li><a href="profil_org.php">Profil Organisasi</a></li>
                        <li><a href="anggota.php">Anggota</a></li>
                        <li><a href="absensi.php">Absensi</a></li>
                    </ul>
                </span>';
            }
            echo '
            <span><li class="inaktif"><a href="profil.php">Profil Pengguna</a></li></span>
            <span><li class="inaktif"><a href="chat.php">Chat Room</a></li></span>
            <span><li class="inaktif"><a href="tentang.php">Tentang Sistem</a></li></span>';
        }else{
            echo '<span><li class="inaktif"><a href="sadmin.php">Mahasiswa</a></li></span>
            <span><li class="inaktif"><a href="sadmin_org.php">Organisasi</a></li></span>
            <span><li class="inaktif"><a href="request.php">Request Password Baru</a></li></span>';
        }
        ?>
</ul>
</div>
</div>

<div id="content" class="col-md-9setengah">

    <div class="profil-box col-md-8 col-md-offset-2">
        <?php
            if($pic != 0) {
                echo '<img src="img/logo/'.$id_org.'.jpg" alt="Logo">';
            }else{
                echo '<img src="assets/logo_unja.png" alt="Logo">';
            }
        ?>
        
        <div class="profil-org">
            <p class="nama"><?= $name_short ?></p>
            <p class="kepanjangan-org"><?= $name_long ?></p>

            <?php
            if ($id_org == $_SESSION['admin_of']) {
                echo '<p><a class="btn btn-info" href="edit_profil_org.php" id="edit"><span class="glyphicon glyphicon-edit"></span> Edit</a></p>';
            }else{
                echo "<br>";
            }
            ?>

        </div>

        <?php
        if ($id_org == $_SESSION['admin_of']) {
            echo '<a href="add_event.php" class="btn btn-primary pull-right">Add Event</a><a href="add_info.php" class="btn btn-info kekiri-sedikit pull-right">Add Info</a>';
        }
        ?>

        <div class="clear"></div>
        <table id="profil-organisasi">
            <tr>
                <th>Ketua</th>
                <td><strong><?= $chairman ?></strong></td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td><?= $description ?></td>
            </tr>
            <tr>
                <th>Visi</th>
                <td><?= $vision ?></td>
            </tr>
            <tr>
                <th>Misi</th>
                <td><?= $mission ?></td>
            </tr>
            <tr>
                <td><a href="daftar.php?id=<?= $id_org ?>" style="font-weight: bold" >Daftar anggota</a></td>
            </tr>
        </table>
        
        <?php
        if($_SESSION['nim'] != "admin") {
            if(!in_array($id_org, $_SESSION['id_org'])) {
                $nim = $_SESSION['nim'];
                $request = $mysqli->query("SELECT * FROM tb_request WHERE nim='$nim' AND id_org=$id_org");
                if($request->num_rows == 0) {
                    echo '<a href="php/proses_join.php?id='.$id_org.'" style="position: relative; left: 43%" href="#" class="btn btn-primary">Gabung</a>';
                }else{
                    echo '<a style="position: relative; left: 40%" href="#" class="btn btn-primary" disabled>Menunggu konfirmasi...</a>';
                }

            }
        }

        ?>

    </div>

    <div id="to-profil-box" class="profil-box col-md-8 col-md-offset-2">
        <p style="font-style: italic">Informasi dan event terbaru : </p>
        <?php
        if ($result_ev->num_rows != 0) {
            while ($row = $result_ev->fetch_assoc()) {
                $id_ev = $row['id_org'] . "_" . date_format(date_create($row['tanggal_post_event']), "Ymd_His");
                $is_pic = $row['pic'];
                if ($is_pic == 1) {
                    $pic = "img/event/" . $id_ev . ".jpg";
                } else {
                    $pic = "img/logo/" . $id_org . ".jpg";
                }
                echo "<a href='event.php?id=$id_ev'><div class='col-md-3 profil-bio'>"
                . "<div class='float-text-org event'>EVENT</div>"
                . "<img src='$pic'>"
                . "</div></a>";
            }
        } else {
            echo "Tidak ada event.<br>";
        }

        if ($result_in->num_rows != 0) {
            while ($row = $result_in->fetch_assoc()) {
                $id_in = $row['id_org'] . "_" . date_format(date_create($row['tanggal_post_info']), "Ymd_His");
                $is_pic = $row['pic'];
                if ($is_pic == 1) {
                    $pic = "img/info/" . $id_in . ".jpg";
                } else {
                    $pic = "img/logo/" . $id_org . ".jpg";
                }
                echo "<a href='info.php?id=$id_in'><div class='col-md-3 profil-bio'>"
                . "<div class='float-text-org info'>INFO</div>"
                . "<img src='$pic'>"
                . "</div></a>";
            }
        } else {
            echo "Tidak ada info.";
        }
        ?>

        <div class="semua">
            <span id="semua-event"><a class="btn btn-primary btn-event" href="all_event_info.php?id=<?= $id_org ?>">Semua Event dan Info</a></span>
        </div>


    </div>


</div>

</div>
</div>
</div>

<?php include 'bottom.php' ?>

<script type="text/javascript" src="assets/script.js"></script>

</body>
</html>
