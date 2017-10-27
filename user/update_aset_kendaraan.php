<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_POST['uname'];
$akses = $_POST['akses'];

$no_aset_kendaraan=$_POST['no_aset_kendaraan'];
$no_peripheral_lama=$_POST['no_peripheral_lama'];
$no_peripheral_baru=$_POST['no_peripheral_baru'];
$nama_merk = strtoupper($_POST['nama_merk']);
$nama_tipe= ucwords($_POST['nama_tipe']);
$cost_center_id = $_POST['cost_center_id'];
$profit_center_id = $_POST['profit_center_id'];
$ambildp_ro = sqlsrv_query($kon, "select nama_depo, nama_ro from cost_center where id_cc = '$cost_center_id' ", $param, $option);
$dp_ro = sqlsrv_fetch_array($ambildp_ro);
$nama_depo_kendaraan = $dp_ro['nama_depo'];
$nama_region_kendaraan = $dp_ro['nama_ro'];
$depo_uname = $_POST['depo_uname'];
$region_uname = $_POST['region_uname'];
$nik_lama = $_POST['nik_lama'];
$nik_baru=$_POST['nik_baru'];
$gambar_lama = $_POST['gambar_lama'];
$gambar_baru = '';
$aktifitas = "Merubah Data";
$tanggal = date("d/m/Y");
$waktu = date("H:i:s");
$tanggal_perubahan = date("d-M-Y");


			$sql = sqlsrv_query($kon, "update kendaraan_asetkendaraan set no_aset_peripheral = '".$no_peripheral_baru."', nik_lama = '".$nik_lama."',
		  nik_baru = '".$nik_baru."',  uname = '".$uname."' where no_aset_kendaraan='".$no_aset_kendaraan."' ");


			sqlsrv_query($kon, "INSERT INTO histori_kendaraan VALUES ('$tanggal_perubahan','$aktifitas','$no_aset_kendaraan','$nama_merk','$nama_tipe','$no_peripheral_lama','$no_peripheral_baru','$cost_center_id','$profit_center_id','$nik_lama','$nik_baru','$gambar_lama','$gambar_baru','$uname','$depo_uname','$region_uname','$waktu','$akses')");

			if($sql)
			{
				echo"<script>history.go(-2)</script>";
			}
			else{
				echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
			}



?>
