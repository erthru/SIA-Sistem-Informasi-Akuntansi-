<?php
if (isset($_POST['simpan'])) {
  include('lib/config.php');
  $id       = $_POST['id'];
  $tgl      = $_POST['tgl'];
  $id_akun  = $_POST['id_akun'];
  $nominal  =   $_POST['nominal'];
  $ket      =   $_POST['ket'];
  $tipe     = $_POST['tipe'];

  if ($tipe == "K") {
    $cek = mysqli_fetch_assoc(mysqli_query($config->koneksi(), "SELECT SUM(nominal) as nominal FROM tb_jurnal WHERE tipe='D' AND tgl='$tgl'"))['nominal'];

    if ($cek != $nominal) {
      echo "<script>
      window.alert('Nominal tidak sama dengan Debet.');
      window.location.href='" . $siteurl . "/jurnalumum.php';
      </script>";
    } else {
      $update = mysqli_query($config->koneksi(), "UPDATE tb_jurnal SET tgl='$tgl', id_akun='$id_akun', nominal='$nominal',ket='$ket',tipe='$tipe' WHERE id='$id'") or die('haha lucu');
      header('location: jurnalumum.php');
    }
  } else {
    $update = mysqli_query($config->koneksi(), "UPDATE tb_jurnal SET tgl='$tgl', id_akun='$id_akun', nominal='$nominal',ket='$ket',tipe='$tipe' WHERE id='$id'") or die('haha lucu');
    header('location: jurnalumum.php');
  }
}
