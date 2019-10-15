<?php
/**
 * Description of anggota
 *
 * @author Norman Syarif
 */

session_start();

require_once 'php/connect.php';
require_once 'php/extract_nim.php';
require_once 'top.php';

$id_org = $_SESSION['admin_of'];

$query = "SELECT tb_status_anggota.nim, tb_anggota.nama_anggota FROM tb_status_anggota INNER JOIN tb_anggota ON tb_status_anggota.nim=tb_anggota.nim WHERE tb_status_anggota.id_org=$id_org";
$result = $mysqli->query($query);
$result_org = $mysqli->query("SELECT * FROM tb_organisasi WHERE id_org=$id_org");
if ($result_org->num_rows != 0) {
    while ($row = $result_org->fetch_assoc()) {
        $name_short = $row['nama_org'];
        $name_long = $row['kepanjangan_org'];
    }
}
$select_request = $mysqli->query("SELECT * FROM `tb_request` INNER JOIN `tb_anggota` ON `tb_request`.nim=`tb_anggota`.nim WHERE `tb_request`.`id_org`=$id_org");
?>

<div class="menu-list">
    <ul>
        <span><li class="inaktif"><a href="awal.php">Info & Event</a></li></span>
        <?php
        if ($_SESSION['admin_of'] != 0) {
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

    <div class="row info-event col-md-offset-dibawah1">
        <div>

            <div class="col-md-5 anggota-div">
                <label>Anggota organisasi</label>
                <table class="table table-hover table-striped">
                    <tr>
                        <th id="nama-org">Nama</th>
                        <th id="prodi">Prodi</th>
                        <th id="operasi">Operasi</th>
                    </tr>

                    <?php
                    if ($result->num_rows != 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td><a style='font-weight: bold' href='profil.php?nim=".$row['nim']."'>" . $row['nama_anggota'] . "</a></td>"
                            . "<td>" . get_fak_prodi_angkatan($row['nim'])['prodi'] . "</td>"
                            . "<td><a href='javascript:void(0)' data-toggle='modal' data-target='#hapus-" . $row['nim'] . "' class='btn btn-danger hapus'><span class='glyphicon glyphicon-remove-sign'></span> Hapus</a></td></tr>";

                            echo '<div class="modal fade" id="hapus-' . $row['nim'] . '" role="dialog" style="text-align: left">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close pull left" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Hapus Anggota</h4>
                        </div>
                        <div class="modal-body">
                            <p>Kamu yakin ingin menghapus ' . $row['nama_anggota'] . ' dari ' . $name_short . '?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Gak jadi</button>
                            <a href="php/hapus_anggota.php?id=' . $row['nim'] . '&org=' . $id_org . '" class="btn btn-success">Ya</a>
                        </div>
                    </div>
                </div>
            </div>';
                        }
                    } else {
                        echo "<tr><th style='text-align: center; color: red' colspan='3'>Tidak ada anggota</th></tr>";
                    }
                    ?>

                </table>
            </div>

            <div class="col-md-5 anggota-div">
                <label>Request Keanggotaan Baru</label>
                <table class="table table-hover table-striped">
                    <tr>
                        <th id="nama-org">Nama</th>
                        <th id="prodi">Prodi</th>
                        <th id="operasi">Operasi</th>
                    </tr>

                    <?php
                    if ($select_request->num_rows != 0) {
                        while ($row = $select_request->fetch_assoc()) {
                            echo "<tr><td><a style='font-weight: bold' href='profil.php?nim=".$row['nim']."'>" . $row['nama_anggota'] . "</a></td>"
                            . "<td>" . get_fak_prodi_angkatan($row['nim'])['prodi'] . "</td>"
                            . "<td><div class='btn-group'><a title='Terima' href='php/proses_request.php?terima&nim=".$row['nim']."&id=$id_org' class='btn btn-success hapus'><span class='glyphicon glyphicon-ok'></span></a><a title='Tolak' href='php/proses_request.php?tolak&nim=".$row['nim']."&id=$id_org' class='btn btn-danger hapus'><span class='glyphicon glyphicon-remove'></span></a></div></td></tr>";
                        }
                    }else{
                        echo "<tr><th style='text-align: center; color: green' colspan='3'>Tidak ada request!</th></tr>";
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