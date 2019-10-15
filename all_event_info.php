<?php
/**
 * Description of all_event_info
 *
 * @author Norman Syarif
 */
session_start();

require_once 'php/connect.php';
require_once 'top.php';

if(isset($_GET['id'])) {
    $id_org = $_GET['id'];
}else{
    $id_org = $_SESSION['admin_of'];
}

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
    }
}

//Select the events and info
$result_ev = $mysqli->query("SELECT id_org, nama_event, tanggal_post_event, tanggal_event FROM tb_event WHERE id_org='$id_org' ORDER BY tanggal_post_event DESC");
$result_in = $mysqli->query("SELECT id_org, nama_info, tanggal_post_info FROM tb_info WHERE id_org='$id_org' ORDER BY tanggal_post_info DESC");
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

    <div class="row info-event col-md-offset-dibawah1">
        <div>

            <div class="col-md-5 anggota-div">
                <label style="color: #ff5722">EVENT</label>
                <table class="table table-hover table-striped">
                    <tr>
                        <th id="nama-org">Nama Event</th>
                        <th id="prodi">Tanggal Event</th>
                        <th id="operasi">Aksi</th>
                    </tr>

                    <?php
                    if ($result_ev->num_rows != 0) {
                        while ($row = $result_ev->fetch_assoc()) {
                            $id_ev = $row['id_org'] . "_" . date_format(date_create($row['tanggal_post_event']), "Ymd_His");
                            $nama_event = $row['nama_event'];
                            $tanggal_event = date_format(date_create($row['tanggal_event']), "d-m-y");
                            $days_left = days_left($row['tanggal_event']);
                            echo "<tr><td>" . $nama_event . "</td>"
                            . "<td>" . $tanggal_event . " " . $days_left . "</td>"
                            . "<td><div class='btn-group'><a href='event.php?id=$id_ev' class='btn btn-success button-event'>More</a>";
                            if($id_org == $_SESSION['admin_of']) {
                                echo "<a href='javascript:void(0)' data-toggle='modal' data-target='#remove-event-" . $id_ev . "' class='btn btn-danger hapus'><span class='glyphicon glyphicon-remove'></span></a>";
                            }
                            echo "</div></td></tr>";
                            
                            echo '<div class="modal fade" id="remove-event-' . $id_ev . '" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close pull left" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Hapus Event</h4>
                            </div>
                            <div class="modal-body">
                                <p>Kamu yakin ingin menghapus event ' . $nama_event . '?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Gak jadi</button>
                                <a href="php/hapus_ev_in.php?ev&id='.$id_ev.'" class="btn btn-success">Ya</a>
                            </div>
                        </div>
                    </div>
                </div>';
                            
                        }
                    }else{
                        echo "<tr><td style='text-align: center; font-weight:bold; color: red' colspan='3'>Tidak ada event!</td></tr>";

                    }
                    ?>

                </table>
            </div>


            <div class="col-md-5 anggota-div">
                <label style="color: #3c8dbc">INFO</label>
                <table class="table table-hover table-striped">
                    <tr>
                        <th id="nama-org">Subject</th>
                        <th id="prodi">Posted on</th>
                        <th id="operasi">Aksi</th>
                    </tr>


                    <?php
                    if ($result_in->num_rows != 0) {
                        while ($row = $result_in->fetch_assoc()) {
                            $id_in = $row['id_org'] . "_" . date_format(date_create($row['tanggal_post_info']), "Ymd_His");
                            $nama_info = $row['nama_info'];
                            $time_ago = time_ago($row['tanggal_post_info']);
                            echo "<tr><td>" . $nama_info . "</td>"
                            . "<td>" . $time_ago . "</td>"
                            . "<td><div class='btn-group'><a href='info.php?id=$id_in' class='btn btn-success button-info'>More</a>";
                            if($id_org == $_SESSION['admin_of']) {
                                echo "<a href='javascript:void(0)' data-toggle='modal' data-target='#remove-info-".$id_in."' class='btn btn-danger hapus'><span class='glyphicon glyphicon-remove'></span></a>";
                            }
                            echo "</div></td></tr>";
                        
                            echo '<div class="modal fade" id="remove-info-'.$id_in.'" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close pull left" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Hapus Info</h4>
                            </div>
                            <div class="modal-body">
                                <p>Kamu yakin ingin menghapus info '.$nama_info.'?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Gak jadi</button>
                                <a href="php/hapus_ev_in.php?in&id='.$id_in.'" class="btn btn-success">Ya</a>
                            </div>
                        </div>
                    </div>
                </div>';
                        }
                    }else{
                        echo "<tr><td style='text-align: center; font-weight:bold; color: red' colspan='3'>Tidak ada info!</td></tr>";
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