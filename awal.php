<?php
/**
 * Description of awal
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'top.php';

$id_org = $_SESSION['id_org'];
$nama_org = $_SESSION['nama_org'];
?>

<div class="menu-list">
    <ul>
        <span><li class="aktif"><a href="awal.php">Info & Event</a></li></span>
        <?php
        if ($_SESSION['admin_of'] != 0) {
            echo '<span><li class="inaktif"><a href="javascript:void(0)">Kelola Organisasi <span class="caret"></span></a></li>
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

<!-- Biodata -->
<div id="content" class="container col-md-9setengah">
    <div class="row">
        <div class="bio col-md-5 col-md-offset-4">

            <?php
                if($_SESSION['pic'] != 0) {
                    echo '<img src="img/foto_anggota/'.$_SESSION['nim'].'.jpg" alt="Profile photo">';
                }else{
                    if($_SESSION['jenis_kelamin'] == "Laki-laki") {
                        echo '<img src="img/foto_anggota/default_guy.jpg" alt="Profile photo">';
                    }else{
                        echo '<img src="img/foto_anggota/default_girl.jpg" alt="Profile photo">';
                    }
                    
                }
            ?>
            
            <p class="bio-text"><span class="bio-name"><?= $_SESSION['nama_anggota'] ?></span><br /><?= $_SESSION['jurusan'] ?><br /><?= $_SESSION['angkatan'] ?></p>
        </div>
    </div> <!-- End of biodata -->

    <p style="margin-left: 6%; font-style: italic">Informasi dan event terbaru</p>

    <div class="row info-event col-md-offset-dibawah1 awal-event-info">
        <div>
            <?php
            if (count($_SESSION['id_org']) == 0) {
                echo '<div class="alert alert-info col-md-11">Kamu tidak tergabung dalam organisasi manapun.</div>';
            }

            for ($i = 0; $i < count($nama_org); $i++) {

                if ($id_org[$i] == $_SESSION['admin_of']) {
                    $admin = " (admin)";
                } else {
                    $admin = '';
                }

                $date_now = time();

                //Get the latest event of the organization
                $nama_event = '<td style="text-align: center">(Tidak ada event)</td>';
                $tanggal_event_tb = '';
                $lokasi = '';
                $dresscode = '';
                $ket = '';
                $link_event = '';

                $get_event = $mysqli->query("SELECT * FROM tb_event WHERE id_org='$id_org[$i]' ORDER BY tanggal_post_event DESC LIMIT 1");

                if ($get_event->num_rows != 0) {
                    while ($row = $get_event->fetch_assoc()) {
                        $id_ev = $row['id_org'] . "_" . date_format(date_create($row['tanggal_post_event']), "Ymd_His");
                        $nama_event = "<th class='tb-awal'>Nama</th><td>" . $row['nama_event'] . "</td>";
                        $hari_lagi = days_left($row['tanggal_event']);
                        $tanggal_event_tb = "<th class='tb-awal'>Tanggal</th><td>" . date_format(date_create($row['tanggal_event']), "j M Y, H:i") . " " . $hari_lagi . "</td>";
                        $lokasi = "<th class='tb-awal'>Lokasi</th><td>" . $row['lokasi'] . "</td>";
                        $dresscode = "<th class='tb-awal'>Dresscode</th><td>" . $row['dresscode'] . "</td>";
                        $ket = "<th class='tb-awal'>Ket.</th><td>" . $row['ket_event'] . "</td>";
                        $link_event = "<td rowspan='2' style='font-size: 85%'><a style='color: blue' href='event.php?id=$id_ev'>(Selengkapnya)</a></td>";
                    }
                }

                //Get the latest info of the organization
                $nama_info = '(Tidak ada info)';
                $tanggal_info_tb = '';
                $isi_info = '';
                $link_info = '';

                $get_info = $mysqli->query("SELECT * FROM tb_info WHERE id_org='$id_org[$i]' ORDER BY tanggal_post_info DESC LIMIT 1");

                if ($get_info->num_rows != 0) {
                    while ($row = $get_info->fetch_assoc()) {
                        $id_in = $row['id_org'] . "_" . date_format(date_create($row['tanggal_post_info']), "Ymd_His");
                        $nama_info = "<p style='text-align: left; font-weight: bold'>" . $row['nama_info'] . "</p>";
                        $tanggal_info = time_ago($row['tanggal_post_info']);
                        $tanggal_info_tb = "<p style='text-align: left; font-size: 85%'>" . $tanggal_info . "</p>";
                        $isi_info = "<p style='text-align: left'>" . $row['isi_info'] . "</p>";
                        $link_info = "<p style='text-align: left; font-size: 85%'><a style='color: blue' href='info.php?id=$id_in'>(Selengkapnya)</a></p>";
                    }
                }

                $row = $mysqli->query("SELECT pic FROM tb_organisasi WHERE id_org = $id_org[$i]")->fetch_assoc();
                $pic = $row['pic'];

                if($pic == 1) {
                    $src = "img/logo/".$id_org[$i].".jpg";
                }else{
                    $src = "assets/logo_unja.png";
                }

                echo "
			<div class='col-md-3 org'>
				<div class='nama-org'><a href='profil_org.php?id=$id_org[$i]'>$nama_org[$i]$admin</a></div>
				<img class='img-circle img-logo' src='".$src."' />
				<div class='hitler'>
					<p class='bold'>
						<a href='javascript:void(0)' class='btn btn-info btn-block btn-no-padding'>Info <span class='caret'></span></a>
					</p>
					<div id='setengah'>
						<p class='left'>
                $nama_info
                $tanggal_info_tb
                $isi_info
                $link_info
            </p>
					</div>
				</div>
				<div class='hitler'>
					<p class='bold'>
						<a class='btn btn-danger btn-block btn-no-padding' href='javascript:void(0)'>Event <span class='caret'></span></a>
					</p>
					<div id='setengah'>
                <table class='left'>
                    <tr>$nama_event</tr>
                    <tr>$tanggal_event_tb</tr>
                    <tr>$lokasi</tr>
                    <tr>$dresscode</tr>
                    <tr>$ket</tr>
                    <tr>$link_event</tr>
                </table>
					</div>
				</div>
			</div>
		";
            }
            ?>

        </div>
    </div>
</div>
</div>
</div>

<?php include 'bottom.php' ?>

<script type="text/javascript" src="assets/script.js"></script>

</body>
</html>
