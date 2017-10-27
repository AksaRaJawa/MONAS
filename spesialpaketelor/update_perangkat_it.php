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

			$sql = sqlsrv_query($kon, "update perangkat_it set aset_group = '".$aset_group."', aset_desc = '".$aset_desc."', nama_merk = '".$nama_merk."', cost_center = '".$cost_center."', nik_karyawan = '".$nik_karyawan."', profit_center = '".$profit_center."', nama_depo = '".$nama_depo."', nama_region = '".$nama_region."', cap_date = '".$cap_date."', acquis_val = '".$acquis_val."', thn_pemakaian = '".$thn_pemakaian."',
			status_aset ='".$status_aset."', status_perangkat ='".$status_perangkat."', status_jual ='".$status_jual."', harga_jual = '".$harga_jual."',  uname = '".$uname."', barcode = '".$barcode."' where no_aset='".$no_aset."' ");
			if($sql)
			{
				echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
			}
			else{
				echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
			}



?>
