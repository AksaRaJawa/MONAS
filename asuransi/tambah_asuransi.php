<?php
include 'config.php';
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
$no_rangka= $_POST['no_rangka'];
$no_mesin = $_POST['no_mesin'];
$no_stnk= $_POST['no_stnk'];
$tanggal_stnk = $_POST['tanggal_stnk'];
$keterangan = $_POST['keterangan'];
$biaya_admin = $_POST['biaya_admin'];
$status = "1";
$uname = '00100';
//====== BIAYA ========//
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



$cek = "select * from asuransi_kendaraan where no_rangka = '".$no_rangka."' OR no_polisi = '$no_polisi' ";
$proses_cek = sqlsrv_query($kon, $cek, $param, $option);
$data_cek = sqlsrv_fetch_array($proses_cek);
if(sqlsrv_num_rows($proses_cek)>0)
{
 echo"<script>alert('DATA ADA YANG SAMA !!!! Asuransi Kendaraan dengan No. Rangka = ".$data_cek['no_rangka']." ATAU No. Polisi = ".$data_cek['no_polisi']." ');history.go(-1)</script>";
}
else
{
$sql = sqlsrv_query($kon, "insert into asuransi_kendaraan values ('$no_asuransi','$no_polisi','$note_leasing','$tahun_kendaraan','$status_kendaraan',
'$nik_user','$nama_depo','$nama_region','$awal_asuransi','$akhir_asuransi','$nama_merk','$nama_tipe','$warna_kendaraan','$no_rangka','$no_mesin',
'$no_stnk','$tanggal_stnk','$keterangan','$biaya_admin','$uname','$status')");
sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','1','$jumlah_biaya_comprehensive','$persen_biaya_comprehensive')");
sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','2','$jumlah_biaya_gempa_bumi','$persen_biaya_gempa_bumi')");
sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','3','$jumlah_biaya_banjir_angin_topan','$persen_biaya_banjir_angin_topan')");
sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','4','$jumlah_biaya_huru_hara','$persen_biaya_huru_hara')");
sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','5','$jumlah_pihak_ke_3','$persen_pihak_ke_3')");
sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','6','$jumlah_terorisme_sabotase','$persen_terorisme_sabotase')");
if($sql)
{
	echo"<script>history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}
}
 ?>
