<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_POST['uname'];

$no_aset_kendaraan=$_POST['no_aset_kendaraan'];
$jenis_kendaraan = $_POST['jenis_kendaraan'];
$tipe_kendaraan = $_POST['tipe_kendaraan'];
$nama_merk = strtoupper($_POST['nama_merk']);
$nama_tipe= ucwords($_POST['nama_tipe']);
$tahun_kendaraan = $_POST['tahun_kendaraan'];
$no_aset_peripheral=$_POST['no_aset_peripheral'];
$cost_center_id = $_POST['cost_center_id'];
$nik_lama = ' ';
$nik_baru=$_POST['nik_baru'];
$profit_center_id = substr($cost_center_id,0,6);
$sqldepo = sqlsrv_query($kon,"select nama_depo, nama_ro from cost_center where id_cc = '".$cost_center_id."' ");
$depo = sqlsrv_fetch_array($sqldepo);
$nama_depo_kendaraan = $depo['nama_depo'];
$nama_region_kendaraan = $depo['nama_ro'];
$cap_date=$_POST['cap_date'];
$end_date=$_POST['end_date'];
$cap = substr($cap_date,7);
$thn_pemakaian = $thn_sekarang-$cap;
$acquis_val=$_POST['acquis_val'];
$gambar_baru = '';
$status = '1';
$status_validasi = '0';

			$sql = sqlsrv_query($kon, "update kendaraan_asetkendaraan set jenis_kendaraan = '".$jenis_kendaraan."', tipe_kendaraan = '".$tipe_kendaraan."', nama_merk = '".$nama_merk."', nama_tipe = '".$nama_tipe."', tahun_kendaraan = '".$tahun_kendaraan."', no_aset_peripheral = '".$no_aset_peripheral."',
			cost_center_id = '".$cost_center_id."', profit_center_id = '".$profit_center_id."', nama_depo_kendaraan = '".$nama_depo_kendaraan."', nama_region_kendaraan = '".$nama_region_kendaraan."', nik_baru = '".$nik_baru."', cap_date = '".$cap_date."', end_date = '".$end_date."', acquis_value = '".$acquis_val."', thn_pemakaian = '".$thn_pemakaian."',
		  uname = '".$uname."' where no_aset_kendaraan='".$no_aset_kendaraan."' ");
			if($sql)
			{
				echo"<script>history.go(-2)</script>";
			}
			else{
				echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
			}



?>
