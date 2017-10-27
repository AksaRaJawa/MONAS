<?php
include 'config.php';
$no_aset=$_GET['id'];
$lepas=sqlsrv_query($kon, "update perangkat_it set nik_karyawan = '' where no_aset='$no_aset'");
header("location:perangkat_it.php");
?>
