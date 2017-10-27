<?php
include 'config.php';
$id_asset=$_GET['id'];
$lepas=sqlsrv_query($kon, "update asset set nik_karyawan = '' where id_asset='$id_asset'");
header("location:aset.php");
?>					
	