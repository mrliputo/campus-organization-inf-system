<?php
/**
 * Description of daftar
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'php/extract_nim.php';
require_once 'top.php';

$id_org = $_GET['id'];
$query = "SELECT tb_status_anggota.nim, tb_anggota.nama_anggota FROM tb_status_anggota INNER JOIN tb_anggota ON tb_status_anggota.nim=tb_anggota.nim WHERE tb_status_anggota.id_org=$id_org ORDER BY tb_anggota.nama_anggota ASC";
$result = $mysqli->query($query);
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
            <img src="img/logo/<?= $id_org ?>.jpg" alt="Logo <?= $name_short ?>">
            <p class="kelola"><span class="bio-name"><?= $name_short ?></span><br /><?= $name_long ?></p>
        </div>
    </div>

    <div class="row info-event col-md-offset-3">
        <div>

            <div class="col-md-5 anggota-div" style="width: 65%">
                <label>Anggota organisasi</label>
                <table class="table table-hover table-striped">
                    <tr>
                        <th id="nama-org">Nama</th>
                        <th id="prodi">Prodi</th>
                        <th id="operasi">Angkatan</th>
                    </tr>

                    <?php
                    if ($result->num_rows != 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td><a style='font-weight: bold' href='profil.php?nim=".$row['nim']."'>" . $row['nama_anggota'] . "</a></td>"
                            . "<td>" . get_fak_prodi_angkatan($row['nim'])['prodi'] . "</td>"
                            . "<td>". get_fak_prodi_angkatan($row['nim'])['angkatan']."</td></tr>";
                        }
                    }else{
                        echo "<tr><td style='color: red; font-weight: bold; text-align: center' colspan='3'>Tidak ada anggota!</td></tr>";
                    }
                    if($id_org == $_SESSION['admin_of']) {
                        echo "<tr><td colspan='3'><a href='anggota.php' class='btn btn-sm btn-primary'>Kelola anggota</a></td></tr>";
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