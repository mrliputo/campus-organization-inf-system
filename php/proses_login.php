<?php

/**
 * Description of proses_login
 *
 * @author Norman Syarif
 */
session_start();

require_once 'connect.php';

$nim = strtolower($_POST['nim']);
$pass = $_POST['password'];

//Set fakultas, jurusan and angkatan session values based on NIM
require_once 'extract_nim.php';
$_SESSION['fakultas'] = get_fak_prodi_angkatan($nim)['fakultas'];
$_SESSION['jurusan'] = get_fak_prodi_angkatan($nim)['prodi'];
$_SESSION['angkatan'] = get_fak_prodi_angkatan($nim)['angkatan'];


$query = "SELECT * FROM tb_anggota WHERE nim='$nim'";
$result = $mysqli->query($query);

if ($result->num_rows != 0) {
    while ($row = $result->fetch_assoc()) {
        
        if ($nim == $row['nim'] && md5($pass) == $row['password']) {
            
            if ($row['nim'] == 'admin' && $row['password'] == '21232f297a57a5a743894a0e4a801fc3') {
                $_SESSION['nim'] = "admin";
                $_SESSION['nama_anggota'] = "Super Admin";
                $_SESSION['admin_of'] = 0;
                $_SESSION['pic'] = 1;
                header("Location: ../sadmin.php");
            } else {
                //Set member's personal data session values
                $_SESSION['nim'] = $row['nim'];
                $_SESSION['nama_anggota'] = $row['nama_anggota'];
                $_SESSION['jenis_kelamin'] = $row['jenis_kelamin'];
                $_SESSION['tempat_lahir'] = $row['tempat_lahir'];
                $_SESSION['tanggal_lahir'] = $row['tanggal_lahir'];
                $_SESSION['alamat'] = $row['alamat'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['pic'] = $row['pic'];

                //Select and set the values of all member's organization[s] from database
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
                    $_SESSION['nama_org'] = $nama_org;
                    $_SESSION['id_org'] = $id_org;
                } else {
                    $_SESSION['nama_org'] = array();
                    $_SESSION['id_org'] = array();
                }

                //Determine whether a member is an admin or not
                $select_admin = $mysqli->query("SELECT id_org FROM tb_status_anggota WHERE nim='$nim' AND status='admin'");
                if ($select_admin->num_rows != 0) {
                    while ($row = $select_admin->fetch_assoc()) {
                        $_SESSION['admin_of'] = $row['id_org'];
                    }
                } else {
                    $_SESSION['admin_of'] = 0;
                }
                //FINISH SETTING ALL THE VALUES

                header("Location: ../awal.php");
            }
        } else {
            header("Location: ../index.php?salah");
        }
    }
} else {
    header("Location: ../index.php?notfound");
}
