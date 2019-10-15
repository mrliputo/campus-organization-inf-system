<?php

session_start();

require_once 'connect.php';
require_once '../notif.php';
require_once 'timestamp.php';


$nim = $_SESSION['nim'];
$notif = $mysqli->query("SELECT * FROM tb_notif WHERE nim='$nim' ORDER BY time DESC LIMIT 20");

$notif_rows = $mysqli->query("SELECT * FROM tb_notif WHERE nim='$nim' AND dibaca=0")->num_rows;
?>

<p class="center">Anda memiliki <?= $notif_rows ?> notifikasi baru <span id="close-button" class="glyphicon glyphicon-remove-circle pull-right text-danger" style="margin-right: 10px"></span></p>
<div class="notif-content">
    <ul>

        <?php
        if($notif->num_rows != 0) {
            while ($row = $notif->fetch_assoc()) {

                $id_org_notif = $row['id_org'];

                if($row['dibaca'] == 0) {
                    $font_weight = "bold";
                    $color = "#282c34";
                    $font_size = "100%";
                }else{
                    $font_weight = "normal";
                    $color = "#464b55";
                    $font_size = "95%";
                }

                $query_nama = $mysqli->query("SELECT nama_org FROM tb_organisasi INNER JOIN tb_notif ON tb_organisasi.id_org = tb_notif.id_org WHERE tb_notif.id_org=$id_org_notif")->fetch_assoc();
                echo '<li><a href="'.go($row['type'], $row['link'], $row['id_org']).'" style="font-weight: '.$font_weight.';color:'.$color.';font-size:'.$font_size.'">'.$query_nama['nama_org'].' '.notif($row['type']).'<br /><span class="waktu">'.time_ago($row['time']).'</span></a></li>';

            }
        }else{
            echo '<p style="text-align: center; position: relative; top: 20px; font-weight: bold; color: green">Tidak ada notifikasi!</p>';
        }
        ?>

    </ul>
</div>

<script type="text/javascript">

<?php
if($notif_rows == 0) {
    echo '$("#notif_menu").html("Notifikasi");';
}else{
    echo '$("#notif_menu").html("Notifikasi <span class=badge>'.$notif_rows.'</span>");';
}
?>


$("#close-button").click(function() {
    $(".notif-box").slideUp(150);
});

</script>

