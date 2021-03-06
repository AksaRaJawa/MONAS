<?php include 'header.php'; ?>
<?php
error_reporting(0);
include "config.php";
require "excel_reader.php";

if(isset($_POST['submit'])){
    $target = basename($_FILES['file_jabatan']['name']) ;
    move_uploaded_file($_FILES['file_jabatan']['tmp_name'], $target);
    $data = new Spreadsheet_Excel_Reader($_FILES['file_jabatan']['name'],false);
    $baris = $data->rowcount($sheet_index=0);
    if(isset($_POST['drop']))
    {
	 $truncate ="TRUNCATE table jabatan";
      sqlsrv_query($kon, $truncate);
    }
    for ($i=2; $i<=$baris; $i++)
    {
		
		  $nama_jabatan	    = strtoupper($data->val($i, 1));
		  $butuh_modis      = $data->val($i, 2);
		  $tipe_aktif       = '1';
		  $status           = '1';
	   $cek = "select * from jabatan where nama_jabatan = '".$nama_jabatan."' ";
	   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
	   $data_cek = sqlsrv_fetch_array($proses_cek);
		if(sqlsrv_num_rows($proses_cek)>0)
		{
			echo"<script>alert('DATA ADA YANG SAMA !!!! Nama Jabatan = ".$data_cek['nama_jabatan']." ');history.go(-1)</script>";
		}
		else
		{	
		  $query = "INSERT into jabatan values ('$nama_jabatan','$butuh_modis','$tipe_aktif','$status')";
		  $hasil = sqlsrv_query($kon, $query);
		  echo "<script>window.location='jabatan.php'</script>";
		}
    }

    if(!$hasil){
          echo "<script>alert('Import Gagal !!')</script>";
      }else{
          echo "<script>alert('Import Berhasil !!')</script>";
		  echo "<script>window.location='jabatan.php'</script>";
    }
    unlink($_FILES['file_jabatan']['name']);
}

?>

<h3><i class="glyphicon glyphicon-paperclip"></i>&nbsp;&nbsp;Import Data Jabatan Karyawan</h3>
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel" style="padding-bottom:25px;">

<form name="myForm" id="myForm" onSubmit="return validateForm()" action="" method="post" enctype="multipart/form-data"  class="form-horizontal style-form">
<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Import File Dari Excel</label>
			<div class="col-sm-10"><input type="file" id="file_jabatan" name="file_jabatan" /></div>
			<p class="help-block">  &nbsp;&nbsp;   Hanya file Excel 2003 (.xls) yg diperbolehkan</p>
            </div>
	         <div class="form-group">
			<label class="col-sm-3 col-sm-2">Format Kolom : </label>
			<div class="col-sm-10">
            [ Nama Jabatan ] - [ Butuh Modis (1/0) ]
            </div>
            </div>
     <div class="form-group">
     <div class="col-sm-10">
	 <input type="checkbox" value="Kosong" name="drop">  Kosongkan Data Sebelumnya<br/><br/>
	<input type="submit" class="btn btn-primary btn-blocks" value="Import" name="submit">
	 <button type="button" class="btn btn-warning btn-blocks" onclick="document.location='jabatan.php'">Kembali</button>
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

        if(!hasExtension('file_jabatan', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
<?php 
include 'footer.php';

?>