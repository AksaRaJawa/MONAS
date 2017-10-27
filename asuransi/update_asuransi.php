<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$waktu = date("H:i:s");
$tanggal_perubahan = date("d-M-Y");
$no_rangka= $_POST['no_rangka'];
$no_asuransi= $_POST['no_asuransi'];
$no_polisi= $_POST['no_polisi'];
$note_leasing = $_POST['note_leasing'];
$tahun_kendaraan= $_POST['tahun_kendaraan'];
$status_kendaraan = $_POST['status_kendaraan'];
$nik_user= $_POST['nik_user'];
$sql = sqlsrv_query($kon, "select nama_depo, nama_region from karyawan_perangkat_it where nik_karyawan = '$nik_user' ");
$row = sqlsrv_fetch_array($sql);
$depo = $row['nama_depo'];
$nama_depo = strstr($depo," ");
$region = $row['nama_region'];
$nama_region = strstr($region," ");

$awal_asuransi= $_POST['awal_asuransi'];
$akhir_asuransi = $_POST['akhir_asuransi'];
$nama_merk= $_POST['nama_merk'];
$nama_tipe = $_POST['nama_tipe'];
$warna_kendaraan= $_POST['warna_kendaraan'];
$no_mesin = $_POST['no_mesin'];
$no_stnk= $_POST['no_stnk'];
$tanggal_stnk = $_POST['tanggal_stnk'];
$keterangan = $_POST['keterangan'];
$biaya_admin = $_POST['biaya_admin'];

$nopol_lama = $_POST['nopol_lama'];
$nik_lama = $_POST['nik_lama'];
$status = "1";
$uname = '';

//====== BIAYA =====
$jumlah_biaya_comprehensive = $_POST['jumlah_biaya_comprehensive'];
$jumlah_biaya_gempa_bumi = $_POST['jumlah_biaya_gempa_bumi'];
$jumlah_biaya_banjir_angin_topan = $_POST['jumlah_biaya_banjir_angin_topan'];
$jumlah_biaya_huru_hara = $_POST['jumlah_biaya_huru_hara'];
$jumlah_pihak_ke_3 = $_POST['jumlah_pihak_ke_3'];
$jumlah_terorisme_sabotase = $_POST['jumlah_terorisme_sabotase'];
//====== PERSEN ========//
$persen_biaya_comprehensive = $_POST['persen_biaya_comprehensive'];
$persen_biaya_gempa_bumi = $_POST['persen_biaya_gempa_bumi'];
$persen_biaya_banjir_angin_topan = $_POST['persen_biaya_banjir_angin_topan'];
$persen_biaya_huru_hara = $_POST['persen_biaya_huru_hara'];
$persen_pihak_ke_3 = $_POST['persen_pihak_ke_3'];
$persen_terorisme_sabotase = $_POST['persen_terorisme_sabotase'];


$sql = sqlsrv_query($kon, "UPDATE asuransi_kendaraan SET no_asuransi = '$no_asuransi', no_polisi = '$no_polisi', note_leasing = '$note_leasing', tahun_kendaraan = '$tahun_kendaraan',
  status_kendaraan = '$status_kendaraan', nik_user = '$nik_user', nama_depo = '$nama_depo', nama_region='$nama_region', awal_asuransi = '$awal_asuransi',
  akhir_asuransi = '$akhir_asuransi', nama_merk = '$nama_merk', nama_tipe = '$nama_tipe', warna_kendaraan='$warna_kendaraan', no_mesin = '$no_mesin',
  no_stnk='$no_stnk', tanggal_stnk = '$tanggal_stnk', keterangan='$keterangan', biaya_admin = '$biaya_admin' WHERE no_rangka = '$no_rangka'  ");

sqlsrv_query($kon, "UPDATE asuransi_biaya SET jumlah_biaya = '$jumlah_biaya_comprehensive', persen_biaya = '$persen_biaya_comprehensive' where no_rangka = '$no_rangka' AND id_jenis_biaya = '1' ");
sqlsrv_query($kon, "UPDATE asuransi_biaya SET jumlah_biaya = '$jumlah_biaya_gempa_bumi', persen_biaya = '$persen_biaya_gempa_bumi' where no_rangka = '$no_rangka' AND id_jenis_biaya = '2' ");
sqlsrv_query($kon, "UPDATE asuransi_biaya SET jumlah_biaya = '$jumlah_biaya_banjir_angin_topan', persen_biaya = '$persen_biaya_banjir_angin_topan' where no_rangka = '$no_rangka' AND id_jenis_biaya = '3' ");
sqlsrv_query($kon, "UPDATE asuransi_biaya SET jumlah_biaya = '$jumlah_biaya_huru_hara', persen_biaya = '$persen_biaya_huru_hara' where no_rangka = '$no_rangka' AND id_jenis_biaya = '4' ");
sqlsrv_query($kon, "UPDATE asuransi_biaya SET jumlah_biaya = '$jumlah_pihak_ke_3', persen_biaya = '$persen_pihak_ke_3' where no_rangka = '$no_rangka' AND id_jenis_biaya = '5' ");
sqlsrv_query($kon, "UPDATE asuransi_biaya SET jumlah_biaya = '$jumlah_terorisme_sabotase', persen_biaya = '$persen_terorisme_sabotase' where no_rangka = '$no_rangka' AND id_jenis_biaya = '6' ");

if($nopol_lama==$no_polisi && $nik_lama!=$nik_user)
{
  sqlsrv_query($kon, "INSERT INTO histori_asuransi VALUES ('$tanggal_perubahan','$waktu','$no_mesin','$no_rangka','$nama_merk','$nama_tipe','','$no_polisi','$nik_lama','$nik_user')");
}
if($nopol_lama!=$no_polisi && $nik_lama==$nik_user)
{
  sqlsrv_query($kon, "INSERT INTO histori_asuransi VALUES ('$tanggal_perubahan','$waktu','$no_mesin','$no_rangka','$nama_merk','$nama_tipe','$nopol_lama','$no_polisi','','$nik_user')");
}
if($nopol_lama!=$no_polisi && $nik_lama!=$nik_user)
{
sqlsrv_query($kon, "INSERT INTO histori_asuransi VALUES ('$tanggal_perubahan','$waktu','$no_mesin','$no_rangka','$nama_merk','$nama_tipe','$nopol_lama','$no_polisi','$nik_lama','$nik_user')");
}


if($sql)
{
	echo"<script>history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL RUBAH DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}

 ?>
