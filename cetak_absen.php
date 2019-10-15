<?php
session_start();
require_once 'php/connect.php';
require_once 'php/extract_nim.php';
$id_ev = $_GET['id'];
$id_org = $_SESSION['admin_of'];

$id_org = substr($id_ev, 0, 1);
$tanggal_post_event = substr($id_ev, 2, 4) . "-" . substr($id_ev, 6, 2) . "-" . substr($id_ev, 8, 2) . " " . substr($id_ev, 11, 2) . ":" . substr($id_ev, 13, 2) . ":" . substr($id_ev, 15, 2);

$result_event = $mysqli->query("SELECT nama_event, tanggal_event FROM tb_event WHERE id_org=$id_org AND tanggal_post_event='$tanggal_post_event'");
if($result_event->num_rows != 0) {
    while ($row = $result_event->fetch_assoc()) {
        $nama_event = $row['nama_event'];
        $tanggal_event = $row['tanggal_event'];
    }
}

$result_org = $mysqli->query("SELECT * FROM tb_organisasi WHERE id_org=$id_org");
if ($result_org->num_rows != 0) {
    while ($row = $result_org->fetch_assoc()) {
        $name_short = $row['nama_org'];
        $name_long = $row['kepanjangan_org'];
    }
}

$result_anggota = $mysqli->query("SELECT tb_status_anggota.nim, tb_anggota.nama_anggota FROM tb_status_anggota INNER JOIN tb_anggota ON tb_status_anggota.nim=tb_anggota.nim WHERE tb_status_anggota.id_org=$id_org");

?>

<!DOCTYPE html>
<html>
<head>
    <title>.</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body style="background-color: #fff">

    <div class="absen-container">
        <div class="absen-header">
            <div class="absen-header-img">
                <?php
                $row = $mysqli->query("SELECT pic FROM tb_organisasi WHERE id_org = $id_org")->fetch_assoc();
                $pic = $row['pic'];

                if($pic == 1) {
                    echo '<img src="img/logo/'.$id_org.'.jpg">';
                }else{
                    echo '<img src="assets/logo_unja.png">';
                }
                ?>
                
            </div>
            <div class="absen-header-text">
                <p class="daftar-hadir bold">DAFTAR HADIR</p>
                <p class="absen-organisasi"><?= $name_short ?> (<?= $name_long ?>)</p>
                <p class="absen-universitas">Universitas Jambi</p>
            </div>
            <div class="absen-nama-tanggal">
                <table>
                    <tr>
                        <th id="absen-nama">Nama Kegiatan</th>
                        <td>:</td>
                        <td><?= $nama_event ?></td>
                    </tr>
                    <tr>
                        <th id="absen-tanggal">Tanggal</th>
                        <td>:</td>
                        <td><?= date_format(date_create($tanggal_event), "j F Y") ?></td>
                    </tr>
                </table>
            </div>
            <div class="absen-nama-anggota">
                <table>
                    <tr>
                        <th id="absen-no">No</th>
                        <th id="absen-nama-anggota">Nama</th>
                        <th id="absen-prodi">Prodi</th>
                        <th id="absen-paraf">Paraf</th>
                    </tr>

                    <?php
                    if($result_anggota->num_rows != 0) {
                        $i = 1;
                        while($row=$result_anggota->fetch_assoc()) {
                            echo "<tr><td>".$i."</td>"
                            . "<td>".$row['nama_anggota']."</td>"
                            . "<td>".get_fak_prodi_angkatan($row['nim'])['prodi']."</td>"
                            . "<td></td></tr>";
                        }
                        $i++;
                    }

                    ?>
                    
                </table>
            </div>
            <div class="absen-ttd">
                <p>Mengetahui,</p>
                <p id="nama-ketua">(______________)</p>
            </div>
        </div>
    </div>

</body>
</html>