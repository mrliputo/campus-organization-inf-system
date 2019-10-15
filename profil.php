<?php
/**
 * Description of profil
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'top.php';

require_once 'php/extract_nim.php';
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $result = $mysqli->query("SELECT * FROM tb_anggota WHERE nim='$nim'");
    if ($result->num_rows != 0) {
        $row = $result->fetch_assoc();
        $nama = $row['nama_anggota'];
        $pic = $row['pic'];
        $prodi = get_fak_prodi_angkatan($nim)['prodi'];
        $jenis = $row['jenis_kelamin'];
        $fakultas = get_fak_prodi_angkatan($nim)['fakultas'];
        $angkatan = get_fak_prodi_angkatan($nim)['angkatan'];
        $tempat_lahir = $row['tempat_lahir'];
        $tanggal_lahir = $row['tanggal_lahir'];
        $alamat = $row['alamat'];
        $email = $row['email'];
        $select_org = $mysqli->query("SELECT tb_organisasi.id_org, tb_organisasi.nama_org "
            . "FROM tb_organisasi INNER JOIN tb_status_anggota ON "
            . "tb_organisasi.id_org=tb_status_anggota.id_org WHERE tb_status_anggota.nim='$nim'");
        $id_org = [];
        $nama_org = [];
        if ($select_org->num_rows != 0) {
            while ($row = $select_org->fetch_assoc()) {
                array_push($id_org, $row['id_org']);
                array_push($nama_org, $row['nama_org']);
            }
        } else {
            $nama_org = array();
            $id_org = array();
        }
    }
} else {
    $nim = $_SESSION['nim'];
    $nama = $_SESSION['nama_anggota'];
    $pic = $_SESSION['pic'];
    $prodi = $_SESSION['jurusan'];
    $jenis = $_SESSION['jenis_kelamin'];
    $fakultas = $_SESSION['fakultas'];
    $angkatan = $_SESSION['angkatan'];
    $tempat_lahir = $_SESSION['tempat_lahir'];
    $tanggal_lahir = $_SESSION['tanggal_lahir'];
    $alamat = $_SESSION['alamat'];
    $email = $_SESSION['email'];
    $nama_org = $_SESSION['nama_org'];
    $id_org = $_SESSION['id_org'];
}
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
            <span><li class="aktif"><a href="profil.php">Profil Pengguna</a></li></span>
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
        if (isset($_GET['successpass'])) {
            echo "<div id='alert' class='alert alert-success fade in'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password berhasil diganti.
        </div>";
    }

    if($pic != 0) {
        echo '<img src="img/foto_anggota/'.$nim.'.jpg">';
    }else{
        if($jenis == "Laki-laki") {
            echo '<img src="img/foto_anggota/default_guy.jpg">';    
        }else{
            echo '<img src="img/foto_anggota/default_girl.jpg">';
        }
    }
    ?>




    <div class="nama-jurusan">
        <p class="nama"><?= $nama ?></p>
        <p><?= $prodi ?></p>
        <?php
        if ($nim == $_SESSION['nim']) {
            echo '<p><a class="btn btn-info" href="edit_profil.php" id="edit"><span class="glyphicon glyphicon-edit"></span> Edit</a></p>';
        }
        ?>

    </div>
    <div class="clear"></div>
    <table class="bio">
        <tr>
            <th>NIM</th>
            <td><?= strtoupper($nim) ?></td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td><?= $jenis ?></td>
        </tr>
        <tr>
            <th>Fakultas</th>
            <td><?= $fakultas ?></td>
        </tr>
        <tr>
            <th>Angkatan</th>
            <td><?= $angkatan ?></td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td><?= $tempat_lahir . ", " . $tanggal_lahir ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?= $alamat ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $email ?></td>
        </tr>
    </table>
</div>

<div class="profil-box col-md-8 col-md-offset-2 profil-img">
    <p style="font-style: italic">Tergabung dalam organisasi : </p>

    <?php
    if (count($id_org) == 0) {
        echo '<div class="alert alert-info col-md-12">Tidak tergabung dalam organisasi manapun.</div>';
    }
    for ($i = 0; $i < count($nama_org); $i++) {
        echo "
        <a href='profil_org.php?id=" . $id_org[$i] . "'><div class='col-md-3 profil-bio'>
         <div class='float-text'>" . $nama_org[$i] . "</div>
         <img src='img/logo/" . $id_org[$i] . ".jpg'>
     </div></a>
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