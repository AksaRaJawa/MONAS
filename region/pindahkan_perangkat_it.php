<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_POST['uname'];
$cost_center_dulu=$_POST['cc_dulu'];
$profit_center_dulu=$_POST['pc_dulu'];
$nik_dulu=$_POST['nik_dulu'];
$no_aset=$_POST['no_aset'];
$aset_group=$_POST['aset_group'];
$aset_desc=$_POST['aset_desc'];
$cost_center = $_POST['cost_center'];
$profit_center = $_POST['profit_center'];
$nik_karyawan = $_POST['nik_karyawan'];
/*$ambilpc = sqlsrv_query($kon, "select id_pc, id_cc, nama_depo, nama_region from karyawan_perangkat_it where nik_karyawan = '$nik_karyawan'", $param, $option);
$pccc = sqlsrv_fetch_array($ambilpc);
$pcc_pc = $pccc['id_pc'];
$pcc_cc = $pccc['id_cc'];
$ambildp= sqlsrv_query($kon, "select nama_depo, nama_ro from cost_center where id_cc = '$pcc_cc' ", $param, $option);
$dp = sqlsrv_fetch_array($ambildp);
$depo = $dp['nama_depo'];
$region = $dp['nama_ro'];*/
$ambildp_ro = sqlsrv_query($kon, "select nama_depo, nama_ro from cost_center where id_cc = '$cost_center' ", $param, $option);
$dp_ro = sqlsrv_fetch_array($ambildp_ro);
$nama_depo = $dp_ro['nama_depo'];
$nama_region = $dp_ro['nama_ro'];
$tanggal = date("d/m/Y");
$tanggal_perubahan = date("d-M-Y");
$waktu = date("H:i:s");

/*if($profit_center!=$pcc_pc&&$nik_karyawan!=' ')
{
		echo"<script>alert('Profit Center yang diinput tidak sama dengan Profit Center User Responsible, Maka Aset akan dimutasi sesuai Profit Center User Responsible = '$pcc_pc'. Terimakasih')</script>";
		$sql = sqlsrv_query($kon, "update perangkat_it set cost_center = '".$pcc_cc."', profit_center = '".$pcc_pc."', nik_karyawan = '".$nik_karyawan."',  nama_depo = '".$depo."', nama_region = '".$region."', uname = '".$uname."' where no_aset='".$no_aset."' ");

		$sqlsave = sqlsrv_query($kon, "insert into pindahan_perangkat values ('$no_aset',' ','$aset_group','$aset_desc','$cost_center_dulu','$profit_center_dulu','$nik_dulu','".$pcc_cc."','".$pcc_pc."','$nik_karyawan','".$depo."','".$region."','$uname','$tanggal_perubahan','$waktu')");

		if($sql)
		{
			echo"<script>alert('PINDAH PERANGKAT SUKSES. TERIMAKASIH');history.go(-2)</script>";
		}
		else{
			echo"<script>alert('GAGAL PINDAH PERANGKAT !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
        }
}
if($profit_center==$pcc_pc&&$nik_karyawan!=' ')
{
					$sql = sqlsrv_query($kon, "update perangkat_it set cost_center = '".$cost_center."', profit_center = '".$profit_center."', nik_karyawan = '".$nik_karyawan."',  nama_depo = '".$nama_depo."', nama_region = '".$nama_region."', uname = '".$uname."' where no_aset='".$no_aset."' ");

					$sqlsave = sqlsrv_query($kon, "insert into pindahan_perangkat values ('$no_aset',' ','$aset_group','$aset_desc','$cost_center_dulu','$profit_center_dulu','$nik_dulu','".$cost_center."','".$profit_center."','$nik_karyawan','".$nama_depo."','".$nama_region."','$uname','$tanggal_perubahan','$waktu')");

					if($sql)
					{
						echo"<script>alert('PINDAH PERANGKAT SUKSES. TERIMAKASIH');history.go(-2)</script>";
					}
					else{
						echo"<script>alert('GAGAL PINDAH PERANGKAT !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
					}
}
if($nik_karyawan=' ')
{
					$sql = sqlsrv_query($kon, "update perangkat_it set cost_center = '".$cost_center."', profit_center = '".$profit_center."', nik_karyawan = '".$nik_karyawan."',  nama_depo = '".$nama_depo."', nama_region = '".$nama_region."', uname = '".$uname."' where no_aset='".$no_aset."' ");

					$sqlsave = sqlsrv_query($kon, "insert into pindahan_perangkat values ('$no_aset',' ','$aset_group','$aset_desc','$cost_center_dulu','$profit_center_dulu','$nik_dulu','".$cost_center."','".$profit_center."','$nik_karyawan','".$nama_depo."','".$nama_region."','$uname','$tanggal_perubahan','$waktu')");

					if($sql)
					{
						echo"<script>alert('PINDAH PERANGKAT SUKSES. TERIMAKASIH');history.go(-2)</script>";
					}
					else{
						echo"<script>alert('GAGAL PINDAH PERANGKAT !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
					}
}*/

$sql = sqlsrv_query($kon, "update perangkat_it set cost_center = '".$cost_center."', profit_center = '".$profit_center."', nik_karyawan = '".$nik_karyawan."',  nama_depo = '".$nama_depo."', nama_region = '".$nama_region."', uname = '".$uname."' where no_aset='".$no_aset."' ");

$sqlsave = sqlsrv_query($kon, "insert into pindahan_perangkat values ('$no_aset',' ','$aset_group','$aset_desc','$cost_center_dulu','$profit_center_dulu','$nik_dulu','".$cost_center."','".$profit_center."','$nik_karyawan','".$nama_depo."','".$nama_region."','$uname','$tanggal_perubahan','$waktu')");

if($sql)
{
	echo"<script>alert('PINDAH PERANGKAT SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL PINDAH PERANGKAT !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
