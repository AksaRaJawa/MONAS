<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_POST['uname'];
$no_aset=$_POST['no_aset'];
$aset_desc = $_POST['aset_desc'];
$aset_group = $_POST['aset_group'];
$nama_merk = strtoupper($_POST['nama_merk']);
$cost_center = $_POST['cost_center'];
$nik_karyawan=$_POST['nik_karyawan'];
$profit_center = $_POST['profit_center'];
$nama_depo = strtoupper($_POST['nama_depo']);
$nama_region = strtoupper($_POST['nama_region']);
$cap_date=$_POST['cap_date'];
//$cap = substr($cap_date,7);
$thn_pemakaian = $_POST['thn_pemakaian'];
$acquis_val=$_POST['acquis_val'];
$status_aset =$_POST['status_aset'];
$status_perangkat =$_POST['status_perangkat'];
$status_jual =$_POST['status'];
$harga_jual=$_POST['harga_jual'];
$foto="";
$barcode="";
$aktifitas = "Merubah Data Perangkat IT";
$tanggal = date("d/m/Y");
$waktu = date("H:i:s");
$tanggal_perubahan = date("d-M-Y");

			//move_uploaded_file($lokasi_file,$direktori);
			$sql = sqlsrv_query($kon, "update perangkat_it set aset_group = '".$aset_group."', aset_desc = '".$aset_desc."', nama_merk = '".$nama_merk."', cost_center = '".$cost_center."', nik_karyawan = '".$nik_karyawan."', profit_center = '".$profit_center."', nama_depo = '".$nama_depo."', nama_region = '".$nama_region."', cap_date = '".$cap_date."', acquis_val = '".$acquis_val."', thn_pemakaian = '".$thn_pemakaian."',
			status_aset ='".$status_aset."', status_perangkat ='".$status_perangkat."', uname = '".$uname."', barcode = '".$barcode."' where no_aset='".$no_aset."' ");

			sqlsrv_query($kon, "insert into histori_perangkat_it values ('".$tanggal_perubahan."','".$aktifitas."','".$no_aset."','".$aset_group."','".$aset_desc."','".$nama_merk."','".$cost_center."','".$nik_karyawan."','".$status_perangkat."','".$uname."','".$nama_depo."','".$nama_region."','".$waktu."')");
			if($sql)
			{
				echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
			}
			else{
				echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
			}



?>
