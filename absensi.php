<?php
/**
 * Description of absensi
 *
 * @author Norman Syarif
 */

session_start();

require_once 'php/connect.php';
require_once 'top.php';

$id_org = $_SESSION['admin_of'];

$result_event = $mysqli->query("SELECT id_org, nama_event, tanggal_event, tanggal_post_event FROM tb_event WHERE id_org=$id_org ORDER BY tanggal_event DESC");
$result_org = $mysqli->query("SELECT * FROM tb_organisasi WHERE id_org=$id_org");
if ($result_org->num_rows != 0) {
    while ($row = $result_org->fetch_assoc()) {
        $name_short = $row['nama_org'];
        $name_long = $row['kepanjangan_org'];
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

<div id="content" class="container col-md-9setengah">
    <div class="row">
        <div class="anggota col-md-5 col-md-offset-4">
            
            <?php
                $row = $mysqli->query("SELECT pic FROM tb_organisasi WHERE id_org = $id_org")->fetch_assoc();
                $pic = $row['pic'];

                if($pic == 1) {
                    echo '<img src="img/logo/'.$id_org.'.jpg">';
                }else{
                    echo '<img src="assets/logo_unja.png">';
                }
            ?>

            <p class="kelola"><span class="bio-name"><?= $name_short ?></span><br /><?= $name_long ?></p>
        </div>
    </div>

    <div class="row info-event col-md-offset-2">
        <div>

            <div class="col-md-5 absensi-div">
                <label>Daftar Event</label>
                <table class="table table-hover table-striped">
                    <tr>
                        <th id="nama-org">Event</th>
                        <th id="tanggal">Tanggal</th>
                        <th id="operasi-absen">Operasi</th>
                    </tr>

                    <?php
                    if ($result_event->num_rows != 0) {
                        while ($row = $result_event->fetch_assoc()) {
                            $id_ev = $row['id_org'] . "_" . date_format(date_create($row['tanggal_post_event']), "Ymd_His");
                            echo "<tr><td>".$row['nama_event']."</td>"
                            . "<td>".date_format(date_create($row['tanggal_event']), "j F Y")."</td>"
                            . "<td><a onclick=frames['absen_page_".$id_ev."'].print() href='javascript:void(0)' class='btn btn-info hapus'><span class='glyphicon glyphicon-print'></span> Cetak absensi</a></td></tr>";
                            
                            echo "<iframe src='cetak_absen.php?id=".$id_ev."' name='absen_page_".$id_ev."' style='display: none'></iframe>";
                        }
                    }
                    ?>

                </table>
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