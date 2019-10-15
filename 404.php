<?php
/**
 * Description of top
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
        <p style="text-align: center; font-weight: bold; color: red; font-size: 400%">404</p>
        <p style="text-align: center; font-size: 120%; font-weight: bold">Konten tidak tersedia</p>
        <p style="text-align: center">Kemungkinan telah dihapus oleh admin organisasi</p>
    </div>

</div>

</div>
</div>
</div>

<?php include 'bottom.php' ?>

<script type="text/javascript" src="assets/script.js"></script>

</body>
</html>