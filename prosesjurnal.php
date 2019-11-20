<?php
if (isset($_POST['simpan'])) {
  include('lib/config.php');
  $id       = $_POST['id'];
  $tgl      = $_POST['tgl'];
  $id_akun  = $_POST['id_akun'];
  $nominal  =   $_POST['nominal'];
  $ket      =   $_POST['ket'];
  $tipe     = $_POST['tipe'];
  $update = mysqli_query($config->koneksi(), "UPDATE tb_jurnal SET tgl='$tgl', id_akun='$id_akun', nominal='$nominal',ket='$ket',tipe='$tipe' WHERE id='$id'") or die('haha lucu');

  if ($update) {
    ?>
    <script language="JavaScript">
      alert('Data Berhasil Di update');
      document.location = 'jurnalumum.php';
    </script>
<?php
  } else {
    echo 'Gagal menyimpan data!';
    echo '<a href="editjurnal.php?id=' . $id . '">Kembali</a>';
  }
} else {
  echo '<script>window.history.back()</script>';
}
?>