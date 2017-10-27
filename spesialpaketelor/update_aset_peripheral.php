<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_POST['uname'];

$no_aset_peripheral=$_POST['no_aset_peripheral'];
$jenis_peripheral = $_POST['jenis_peripheral'];
$desc_peripheral = $_POST['desc_peripheral'];
$no_aset_peripheral=$_POST['no_aset_peripheral'];
$no_aset_kendaraan=' ';
$cost_center_id = $_POST['cost_center_id'];
$nik_lama = ' ';
$nik_baru=$_POST['nik_baru'];
$profit_center_id = substr($cost_center_id,0,6);
$sqldepo = sqlsrv_query($kon,"select nama_depo, nama_ro from cost_center where id_cc = '".$cost_center_id."' ");
$depo = sqlsrv_fetch_array($sqldepo);
$nama_depo_peripheral = $depo['nama_depo'];
$nama_region_peripheral = $depo['nama_ro'];
$cap_date=$_POST['cap_date'];
$cap = substr($cap_date,7);
$thn_pemakaian = $thn_sekarang-$cap;
$acquis_val=$_POST['acquis_val'];
$status_perangkat=$_POST['status_perangkat'];
$status_jual=$_POST['status_jual'];
$harga_jual=$_POST['harga_jual'];
$gambar_baru = '';
$status = '1';
$status_validasi = '0';
$barcode = '';

			$sql = sqlsrv_query($kon, "update kendaraan_peripheral set jenis_peripheral = '".$jenis_peripheral."', desc_peripheral = '".$desc_peripheral."',
			cost_center_id = '".$cost_center_id."', profit_center_id = '".$profit_center_id."', nama_depo_peripheral = '".$nama_depo_peripheral."', nama_region_peripheral = '".$nama_region_peripheral."',
		  nik_baru = '".$nik_baru."', cap_date = '".$cap_date."', status_perangkat = '".$status_perangkat."', acquis_value = '".$acquis_val."', thn_pemakaian = '".$thn_pemakaian."',
		  status_jual = '".$status_jual."', harga_jual = '".$harga_jual."',uname = '".$uname."' where no_aset_peripheral='".$no_aset_peripheral."' ");
			if($sql)
			{
				echo"<script>history.go(-2)</script>";
			}
			else{
				echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
			}



?>
