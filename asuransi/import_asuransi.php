<?php include 'header.php'; ?>
<?php
error_reporting(0);
include "config.php";
require "excel_reader.php";

if(isset($_POST['submit'])){
    $target = basename($_FILES['file_asuransi']['name']) ;
    move_uploaded_file($_FILES['file_asuransi']['tmp_name'], $target);
    $data = new Spreadsheet_Excel_Reader($_FILES['file_asuransi']['name'],false);
    $baris = $data->rowcount($sheet_index=0);
    if(isset($_POST['drop']))
    {
	 $truncate ="TRUNCATE table asuransi_kendaraan";
      sqlsrv_query($kon, $truncate);
    }
    for ($i=2; $i<=$baris; $i++)
    {

		  $no_asuransi	    = $data->val($i, 1);
		  $no_polisi       = $data->val($i, 2);
      $note_leasing        = $data->val($i, 3);
      $tahun_kendaraan        = $data->val($i, 4);
      $status_kendaraan	    = $data->val($i, 5);
		  $nik_user      = $data->val($i, 6);
      $queri = sqlsrv_query($kon, "select nama_depo, nama_region from karyawan_perangkat_it where nik_karyawan = '$nik_user' ");
      $row = sqlsrv_fetch_array($queri);
      $depo = $row['nama_depo'];
      $nama_depo = strstr($depo," ");
      $region = $row['nama_region'];
      $nama_region = strstr($region," ");

      $jumlah_biaya_comprehensive = $data->val($i,10);
      $jumlah_biaya_gempa_bumi = $data->val($i,11);
      $jumlah_biaya_banjir_angin_topan = $data->val($i,12);
      $jumlah_biaya_huru_hara = $data->val($i,13);
      $jumlah_pihak_ke_3 = $data->val($i,14);
      $jumlah_terorisme_sabotase = $data->val($i,15);

      $persen_comprehensive = $data->val($i,16);
      $persen_gempa_bumi = $data->val($i,17);
      $persen_banjir_angin_topan = $data->val($i,18);
      $persen_huru_hara = $data->val($i,19);
      $persen_pihak_ke_3 = $data->val($i,20);
      $persen_terorisme_sabotase = $data->val($i,21);
      $persen_comprehensive = $persen_comprehensive*100;
      $persen_gempa_bumi = $persen_gempa_bumi*100;
      $persen_banjir_angin_topan = $persen_banjir_angin_topan*100;
      $persen_huru_hara = $persen_huru_hara*100;
      $persen_pihak_ke_3 = $persen_pihak_ke_3*100;
      $persen_terorisme_sabotase = $persen_terorisme_sabotase*100;

      $awal_asuransi	    = $data->val($i, 22);
		  $akhir_asuransi      = $data->val($i, 23);
      $nama_merk        = $data->val($i, 24);
      $nama_tipe       = $data->val($i, 25);
      $warna_kendaraan	    = $data->val($i, 26);
		  $no_rangka      = $data->val($i, 27);
      $no_mesin        = $data->val($i, 28);
      $keterangan        = $data->val($i, 29);
      $no_stnk        = $data->val($i, 30);
      $tanggal_stnk        = $data->val($i, 31);
      $biaya_admin        = $data->val($i, 39);
      $uname        = '00100';
		  $status           = '1';
	   $cek = "select * from asuransi_kendaraan where no_rangka = '".$no_rangka."' OR no_polisi = '$no_polisi' ";
	   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
	   $data_cek = sqlsrv_fetch_array($proses_cek);
		if(sqlsrv_num_rows($proses_cek)>0)
		{
			echo"<script>alert('DATA ADA YANG SAMA !!!! Kendaraan Dengan No. Rangka = ".$data_cek['no_rangka']." ATAU No. Polisi ".$data_cek['no_polisi']."');history.go(-1)</script>";
		}
		else
		{
      $hasil = sqlsrv_query($kon, "insert into asuransi_kendaraan values ('$no_asuransi','$no_polisi','$note_leasing','$tahun_kendaraan','$status_kendaraan',
      '$nik_user','$nama_depo','$nama_region','$awal_asuransi','$akhir_asuransi','$nama_merk','$nama_tipe','$warna_kendaraan','$no_rangka','$no_mesin',
      '$no_stnk','$tanggal_stnk','$keterangan','$biaya_admin','$uname','$status')");
      sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','1','$jumlah_biaya_comprehensive','$persen_comprehensive')");
      sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','2','$jumlah_biaya_gempa_bumi','$persen_gempa_bumi')");
      sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','3','$jumlah_biaya_banjir_angin_topan','$persen_banjir_angin_topan')");
      sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','4','$jumlah_biaya_huru_hara','$persen_huru_hara')");
      sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','5','$jumlah_pihak_ke_3','$persen_pihak_ke_3')");
      sqlsrv_query($kon, "insert into asuransi_biaya values ('$no_rangka','6','$jumlah_terorisme_sabotase','$persen_terorisme_sabotase')");
		  echo "<script>window.location='asuransi.php'</script>";
		}
    }

    if(!$hasil){
          echo "<script>alert('Import Gagal !!')</script>";
      }else{
          echo "<script>alert('Import Berhasil !!')</script>";
		  echo "<script>window.location='asuransi.php'</script>";
    }
    unlink($_FILES['file_asuransi']['name']);
}

?>

<h3><i class="glyphicon glyphicon-paperclip"></i>&nbsp;&nbsp;Import Data Asuransi Kendaraan</h3>
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel" style="padding-bottom:25px;">

<form name="myForm" id="myForm" onSubmit="return validateForm()" action="" method="post" enctype="multipart/form-data"  class="form-horizontal style-form">
<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Import File Dari Excel</label>
			<div class="col-sm-10"><input type="file" id="file_asuransi" name="file_asuransi" /></div>
			<p class="help-block">  &nbsp;&nbsp;   Hanya file Excel 2003 (.xls) yg diperbolehkan</p>
            </div>

     <div class="form-group">
     <div class="col-sm-10">
	 <input type="checkbox" value="Kosong" name="drop">  Kosongkan Data Sebelumnya<br/><br/>
	<input type="submit" class="btn btn-primary btn-blocks" value="Import" name="submit">
	 <button type="button" class="btn btn-warning btn-blocks" onclick="document.location='asuransi.php'">Kembali</button>
    </div>
    </div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }

        if(!hasExtension('file_asuransi', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
<?php
include 'footer.php';

?>
