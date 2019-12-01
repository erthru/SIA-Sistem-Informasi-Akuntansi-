<?php
error_reporting(0);

include "lib/config.php";
$tgl            =    $_POST['tgl'];
$id_akun    =    $_POST['id_akun'];
$ref    =    $_POST['ref'];
$ket            =     $_POST['ket'];
$nominal    =     $_POST['nominal'];
$tipe            =    $_POST['tipe'];

if ($tipe == "K") {
    $cek = mysqli_fetch_assoc(mysqli_query($config->koneksi(), "SELECT SUM(nominal) as nominal FROM tb_jurnal WHERE tipe='D' AND tgl='$tgl'"))['nominal'];

    if ($cek != $nominal) {
        echo "<script>
        window.alert('Nominal tidak sama dengan Debet.');
        window.location.href='".$siteurl."/jurnalumum.php';
        </script>";
    } else {
        mysqli_query($config->koneksi(), "INSERT INTO  `sia`.`tb_jurnal` (
            `id` ,
            `tgl` ,
            `id_akun` ,
            `ket` ,
            `ref` ,
            `nominal` ,
            `tipe`
            )
            VALUES (
            NULL ,  '$tgl',  '$id_akun',  '$ket',  '$ref',  '$nominal',  '$tipe'
            );");
        header('location: jurnalumum.php');
    }
} else {
    mysqli_query($config->koneksi(), "INSERT INTO  `sia`.`tb_jurnal` (
        `id` ,
        `tgl` ,
        `id_akun` ,
        `ket` ,
        `ref` ,
        `nominal` ,
        `tipe`
        )
        VALUES (
        NULL ,  '$tgl',  '$id_akun',  '$ket',  '$ref',  '$nominal',  '$tipe'
        );");
    header('location: jurnalumum.php');
}
