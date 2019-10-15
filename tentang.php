<?php
/**
 * Description of tentang
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'top.php';
?>

<div class="menu-list">
    <ul>
        <span><li class="inaktif"><a href="awal.php">Info & Event</a></li></span>
        <?php
        if($_SESSION['admin_of'] != 0) {
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
        <span><li class="aktif"><a href="tentang.php">Tentang Sistem</a></li></span>
    </ul>
</div>
</div>

<div id="content" class="col-md-9setengah">

    <div class="about-box col-md-8 col-md-offset-2">
        <p id="about-title">Sistem Informasi Organisasi<br />Universitas Jambi</p>
        <p id="about-text">Sistem Informasi organisasi Universitas Jambi adalah sistem yang bertujuan untuk
            memfasilitasi anggota-anggota maupun pengurus organisasi di Universitas Jambi untuk saling berkomunikasi dan bertukar informasi.</p>
        <p id="about-text">Dengan adanya sistem ini diharapkan pengurus organisasi dapat memberikan informasi-informasi terbaru seperti event, kegiatan, ataupun hal lainnya yang berkaitan dengan organisasi kepada anggota-anggotanya dengan mudah dan cepat.</p>
        <p id="pengembang">Developers</p>
        <p id="kelompok-pengembang">Dikembangkan oleh kelompok 1</p>
        <ul id="list-kelompok">
            <li>Norman Syarif <span>(F1E115017)</span></li>
            <li>Nofita Rahayu Ningsih <span>(F1E115001)</span></li>
            <li>Soraya Mar'a Konita Tila <span>(F1E115031)</span></li>
            <li>M. Rodriguez Sumarsono <span>(F1E115013)</span></li>
            <li>Rizky Ananda <span>(F1E115031)</span></li>
        </ul>
        <p id="client">untuk <em>Kelompok 6</em></p>
    </div>

</div>
</div>
</div>

<?php include 'bottom.php' ?>

<script type="text/javascript" src="assets/script.js"></script>

</body>
</html>
