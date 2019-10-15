<?php

/**
 * Description of extract_nim
 *
 * @author Norman Syarif
 */
//These functions return member's fakultas, jurusan, and angkatan initial value based
//on member's NIM

function get_fak_prodi_angkatan($nim) {
    $f = substr($nim, 0, 1);
    $j = substr($nim, 2, 2);
    $a = substr($nim, 4, 2);
    
    //FAK. SAINTEK
    if ($f == "f") {
        $fakultas = "Sains dan Teknologi";
        switch ($j) {
            case 'c1':
                $jurusan = "Kimia";
                break;

            case 'c2':
                $jurusan = "Matematika";
                break;

            case 'c3':
                $jurusan = "Fisika";
                break;

            case 'c4':
                $jurusan = "Biologi";
                break;

            case 'e1':
                $jurusan = "Sistem Informasi";
                break;

        }
    }

    //FAK. TEKNIK
    if ($f == "m") {
        $fakultas = "Teknik";
        switch ($j) {
            case 'a1':
                $jurusan = "Teknik Elektro";
                break;

            case 'b1':
                $jurusan = "Teknik Kimia";
                break;

            case 'c1':
                $jurusan = "Teknik Sipil";
                break;
        }
    }
    
    $angkatan = $a+2000;
    
    $hasil = array("fakultas"=>$fakultas,
                   "prodi"=>$jurusan,
                   "angkatan"=>$angkatan);
    return $hasil;
}

