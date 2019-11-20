<?php

include "lib/config.php";
$nama_akun    =    $_POST['nama_akun'];
$kat        =    $_POST['kategori'];
$kode        =    $_POST['kode'];
mysqli_query($config->koneksi(), "INSERT INTO  `sia`.`tb_akun` (
`id` ,
`nama_akun` ,
`kategori` ,
`kode`
)
VALUES (
NULL ,  '$nama_akun',  '$kat',  '$kode'
);");
header('location: akun.php');
