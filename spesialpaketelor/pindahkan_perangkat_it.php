<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_POST['uname'];
$cost_center_dulu=$_POST['cc_dulu'];
$profit_center_dulu=$_POST['pc_dulu'];
$no_aset=$_POST['no_aset'];
$aset_group=$_POST['aset_group'];
$aset_desc=$_POST['aset_desc'];
$cost_center = $_POST['cost_center'];
$profit_center = substr($cost_center,0,6);
$sqldepo = sqlsrv_query($kon,"select nama_depo, nama_ro from cost_center where id_cc = '$cost_center' ",$param, $option);
$depo = sqlsrv_fetch_array($sqldepo);
$nama_depo = $depo['nama_depo'];
$nama_region = $depo['nama_ro'];
$tanggal = date("d/m/Y");
$tanggal_perubahan = date("d-M-Y");
$waktu = date("H:i:s");


			$sql = sqlsrv_query($kon, "update perangkat_it set cost_center = '".$cost_center."', profit_center = '".$profit_center."', nama_depo = '".$nama_depo."', nama_region = '".$nama_region."', uname = '".$uname."' where no_aset='".$no_aset."' ");

			$sqlsave = sqlsrv_query($kon, "insert into pindahan_perangkat values ('$no_aset','$aset_group','$aset_desc','$cost_center_dulu','$profit_center_dulu','".$cost_center."','".$profit_center."','".$nama_depo."','".$nama_region."','$uname','$tanggal_perubahan','$waktu')");

			if($sql)
			{
				echo"<script>alert('PINDAH PERANGKAT SUKSES. TERIMAKASIH');history.go(-2)</script>";
			}
			else{
				echo"<script>alert('GAGAL PINDAH PERANGKAT !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
			}



?>
