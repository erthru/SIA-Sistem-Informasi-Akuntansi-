<?php 

include "lib/config.php";  
$tgl			=	$_POST['tgl'];
$id_akun	=	$_POST['id_akun'];
$ref	=	$_POST['ref'];
$ket			= 	$_POST['ket'];
$nominal	= 	$_POST['nominal'];
$tipe			=	$_POST['tipe'];
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
?>
