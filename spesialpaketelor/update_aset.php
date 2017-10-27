<?php 
include 'config.php';
$id_asset = $_POST['id_asset'];
$no_imei=$_POST['no_imei'];
$nama_merk = $_POST['nama_merk'];
$merk = explode("---", $nama_merk);
$no_asset = $_POST['no_asset'];
$serial_number=$_POST['serial_number'];
$id_device=$_POST['id_device'];
$nik_karyawan=$_POST['nik_karyawan'];
$karyawan = explode("---",$nik_karyawan);
$nama_kepemilikan=$_POST['nama_kepemilikan'];
$status_modis=$_POST['status_modis'];
$status_device = $_POST['status_device'];
$masa_berlaku=$_POST['masa_berlaku'];
$id_depo=$_POST['id_depo'];
$depo = explode("---", $id_depo);
$keterangan = ucwords($_POST['keterangan']);
$provider = $_POST['provider'];
$nohp = $_POST['nohp'];
$tgglaktif = $_POST['tgglaktif'];
$uname = $_POST['uname'];


			$sql = sqlsrv_query($kon, "update asset set no_imei = '".$no_imei."', nama_merk = '".$merk[0]."', nama_tipe = '".$merk[1]."',no_asset = '".$no_asset."', serial_number = '".$serial_number."', id_device = '".$id_device."', nik_karyawan = '".$karyawan[0]."', nama_kepemilikan = '".$nama_kepemilikan."', status_modis = '".$status_modis."', status_device = '".$status_device."', masa_berlaku = '".$masa_berlaku."', id_depo ='".$depo[0]."', nama_region = '".$depo[1]."', keterangan = '".$keterangan."', uname = '".$uname."', provider = '".$provider."', nohp = '".$nohp."', tgglaktif = '".$tgglaktif."' where id_asset='".$id_asset."'");
			if($sql)
			{
				echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
			}
			else{
				echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
			}

		

?>