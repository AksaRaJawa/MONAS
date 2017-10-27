<?php include 'header.php'; ?>
<?php
error_reporting(0);
include "config.php";
require "excel_reader.php";

if(isset($_POST['submit'])){
    $target = basename($_FILES['file_karyawan']['name']) ;
    move_uploaded_file($_FILES['file_karyawan']['tmp_name'], $target);
    $data = new Spreadsheet_Excel_Reader($_FILES['file_karyawan']['name'],false);
    $baris = $data->rowcount($sheet_index=0);
    if(isset($_POST['drop']))
    {
	 $truncate ="TRUNCATE table karyawan";
      sqlsrv_query($kon, $truncate);
    }
    for ($i=2; $i<=$baris; $i++)
    {
		
		  $nik_karyawan	  = $data->val($i, 1);
		  $nama_karyawan  = addslashes($data->val($i, 2));
		  $nama_jabatan	  = strtoupper($data->val($i, 3));
		  $id_depo	      = $data->val($i, 4);
		  $nama_region	  = strtoupper($data->val($i, 5));
		  $status           = '1';
		   $cek = "select * from karyawan where nik_karyawan = '".$nik_karyawan."' ";
		   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
		   $data_cek = sqlsrv_fetch_array($proses_cek);
		if(sqlsrv_num_rows($proses_cek)>0)
		{
			echo"<script>alert('DATA ADA YANG SAMA !!!! NIK Karyawan = ".$data_cek['nik_karyawan']." & Nama Karyawan = ".$data_cek['nama_karyawan']." ');history.go(-1)</script>";
		}
		else
		{	
		  $query = "INSERT into karyawan values ('$nik_karyawan','$nama_karyawan','$nama_jabatan','$id_depo','$nama_region','$status')";
		  $hasil = sqlsrv_query($kon, $query);
		  echo "<script>window.location='karyawan.php'</script>";
		}
    }

    if(!$hasil){
          echo "<script>alert('Import Gagal !!')</script>";
      }else{
          echo "<script>alert('Import Berhasil !!')</script>";
		  echo "<script>window.location='karyawan.php'</script>";
    }
    unlink($_FILES['file_karyawan']['name']);
}

?>

<h3><i class="glyphicon glyphicon-paperclip"></i>&nbsp;&nbsp;Import Data Karyawan</h3>
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel" style="padding-bottom:25px;">

<form name="myForm" id="myForm" onSubmit="return validateForm()" action="" method="post" enctype="multipart/form-data"  class="form-horizontal style-form">
<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Import File Dari Excel</label>
			<div class="col-sm-10"><input type="file" id="file_karyawan" name="file_karyawan" /></div>
			<p class="help-block">  &nbsp;&nbsp;   Hanya file Excel 2003 (.xls) yg diperbolehkan</p>
            </div>
	         <div class="form-group">
			<label class="col-sm-3 col-sm-2">Format Kolom : </label>
			<div class="col-sm-10">
            [ NIK Karyawan ] - [ Nama Karyawan ] - [ Jabatan ] - [ ID Depo ] - [ Nama Region ]
            </div>
            </div>
     <div class="form-group">
     <div class="col-sm-10">
	 <input type="checkbox" value="Kosong" name="drop">  Kosongkan Data Sebelumnya<br/><br/>
	<input type="submit" class="btn btn-primary btn-blocks" value="Import" name="submit">
	 <button type="button" class="btn btn-warning btn-blocks" onclick="document.location='karyawan.php'">Kembali</button>
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

        if(!hasExtension('file_karyawan', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
<?php 
include 'footer.php';

?>