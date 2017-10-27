<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_GET['uname'];
$no_aset=$_GET['no_aset'];
$detailaset = sqlsrv_query($kon, "select aset_group, aset_desc, cost_center, profit_center from perangkat_it where no_aset = '$no_aset'", $param, $option);
$det = sqlsrv_fetch_array($detailaset);
$aset_group = $det['aset_group'];
$aset_desc = $det['aset_desc'];
$cost_center_dulu = $det['cost_center'];
$profit_center_dulu = $det['profit_center'];
$nik_karyawan = $_GET['nik_karyawan'];
$ambilpc = sqlsrv_query($kon, "select id_pc, id_cc, nama_depo, nama_region from karyawan_perangkat_it where nik_karyawan = '$nik_karyawan'", $param, $option);
$pccc = sqlsrv_fetch_array($ambilpc);
$pcc_pc = $pccc['id_pc'];
$pcc_cc = $pccc['id_cc'];
$pcc_depo = $pccc['nama_depo'];
$pcc_region = $pccc['nama_region'];
$tanggal = date("d/m/Y");
$tanggal_perubahan = date("d-M-Y");
$waktu = date("H:i:s");

if($nik_karyawan==' '||$nik_karyawan==NULL)
{
		echo"<script>alert('MAAF, MASUKAN USER RESPONSIBLE TERLEBIH DAHULU. TERIMAKASIH');history.go(-1)</script>";
}
else {
	$sql = sqlsrv_query($kon, "update perangkat_it set cost_center = '".$pcc_cc."', profit_center = '".$pcc_pc."', nik_karyawan = '".$nik_karyawan."',  nama_depo = '".$pcc_depo."', nama_region = '".$pcc_region."', uname = '".$uname."' where no_aset='".$no_aset."' ");

	$sqlsave = sqlsrv_query($kon, "insert into pindahan_perangkat values ('$no_aset',' ','$aset_group','$aset_desc','$cost_center_dulu','$profit_center_dulu','$nik_karyawan','".$pcc_cc."','".$pcc_pc."','$nik_karyawan','".$pcc_depo."','".$pcc_region."','$uname','$tanggal_perubahan','$waktu')");

	if($sql)
	{
		echo"<script>alert('PERANGKAT SUDAH DIPINDAHKAN KE : $pcc_depo, $pcc_region. TERIMAKASIH');history.go(-1)</script>";
	}
	else{
		echo"<script>alert('GAGAL PINDAH PERANGKAT !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
			}

	}

?>
