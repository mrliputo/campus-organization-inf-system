<?php
/**
 * Description of ubah_password
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
        <span><li class="aktif"><a href="profil.php">Profil Pengguna</a></li></span>
        <span><li class="inaktif"><a href="chat.php">Chat Room</a></li></span>
        <span><li class="inaktif"><a href="tentang.php">Tentang Sistem</a></li></span>
    </ul>
</div>
</div>

<div id="content" class="col-md-9setengah">

    <div class="profil-box col-md-8 col-md-offset-2">
        <?php
        if (isset($_GET['failpass'])) {
          echo "<div id='alert' class='alert alert-danger fade in'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password gagal diganti. Mohon ketikkan password dengan benar!
	</div>";
        }
        ?>
        <form action="php/proses_password.php" method="post">
            <table class="pass">
                <tr>
                    <th>Password</th>
                    <td><input class="form-control pass-field" name="form_cur_pass" id="cur_pass" type="password" onChange="validateForm();" required></td>
                </tr>
                <tr>
                    <th>Password baru</th>
                    <td><input class="form-control pass-field" name="form_new_pass" id="new_pass" type="password" onChange="validateForm();" required></td>
                </tr>
                <tr>
                    <th>Konfirmasi password baru</th>
                    <td><input class="form-control pass-field" id="re_new_pass" type="password"  onChange="validateForm();" required></td>
                </tr>
                <tr>
                    <td><button type="submit" class="btn btn-primary">Ubah</button></td>
                </tr>

                <div id="warning"></div>

            </table>
        </form>
    </div>
</div>
</div>
</div>
</div>

<?php include 'bottom.php' ?>

<script type="text/javascript" src="assets/script.js"></script>

<script type="text/javascript">

            function validateForm() {
                var curPass = $("#cur_pass").val();
                var passLength = $("#new_pass").val().length;
                var password = $("#new_pass").val();
                var confirmPassword = $("#re_new_pass").val();

                $("#alert").css({
                    display: "none",
                }, 500);

                $.ajax({
                    method: "GET",
                    url: "php/validate.php?curpass=" + curPass + "&passlength=" + passLength + "&newpass=" + password + "&confirm=" + confirmPassword,
                    success: function (data) {
                        $("#warning").html(data);
                    }
                });

            }

            $(document).ready(function () {
                $("#cur_pass, #new_pass, #re_new_pass").keyup(validateForm);
            });

</script>

</body>
</html>