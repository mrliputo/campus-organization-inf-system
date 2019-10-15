<?php
/**
 * Description of chatroom
 *
 * @author Norman Syarif
 */

session_start();

require_once 'php/connect.php';
require_once 'top.php';

$id = $_GET['id'];

if (!in_array($id, $_SESSION['id_org'])) {
    die("<script>alert('Ndak boleh gitu dong!')</script>");
}


require_once 'php/connect.php';

//Find the organization name based on organization id
$query = "SELECT nama_org FROM tb_organisasi WHERE id_org=$id";
$result = $mysqli->query($query);
if ($result->num_rows != 0) {
    while ($row = $result->fetch_assoc()) {
        $nama_org = $row['nama_org'];
    }
}
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
        <span><li class="aktif"><a href="chat.php">Chat Room</a></li></span>
        <span><li class="inaktif"><a href="tentang.php">Tentang Sistem</a></li></span>
    </ul>
</div>
</div>

<div id="content" class="col-md-9setengah">

    <div class="chatbox">
        <p style="font-weight: bold"><?= $nama_org ?> Chat room</p>

        <div class="conversation">
            <p class="chat-warning">Kamu ada di <?= $nama_org ?> chat room.<br />Pesanmu akan dapat dilihat oleh semua anggota <?= $nama_org ?> yang aktif.</p>
            <div id="put_ajax"></div>
        </div>

        <div class="input-msg">
            <input class="form-control" id="msg-box" type="text" placeholder="Ketikkan pesan..." required>
            <button id="msg-button" class="btn btn-primary">kirim</button>
        </div>

    </div>

</div>
</div>
</div>

<?php include 'bottom.php' ?>

<script type="text/javascript" src="assets/script.js"></script>

<script type="text/javascript">

    $("#msg-box").keypress(function (event) {
        if (event.which === 13) {
            $("#msg-button").click();
            event.preventDefault();
        }
    });

    $("#msg-button").click(function () {
        sendMessage();
    });

    getMessage();
    
    var id_org = <?= $id ?>;
    var length = $(".direct-chat-msg").length;

    function sendMessage() {
        var content = $("#msg-box").val();
        $.ajax({
            method: "GET",
            url: "php/send_chat.php?id_org=" + id_org + "&content=" + content
        });
        $("#msg-box").val("");
    }

    function getMessage() {
        var id_org = <?= $id ?>;
        food = $("#user_input").val();
        $.ajax({
            method: "GET",
            url: "php/get_chat.php?id=" + id_org,
            success: function (data) {
                $("#put_ajax").html(data);
                if ($(".direct-chat-msg").length !== length) {
                    console.log(length);
                    length = $(".direct-chat-msg").length;
                    $(".conversation").scrollTop($(".conversation").prop("scrollHeight"));
                }
            }
        });
        setTimeout('getMessage()', 500);
    }

</script>

</body>
</html>