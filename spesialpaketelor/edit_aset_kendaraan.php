<?php
include 'header_kendaraan.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from admin where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Aset Kendaraan</h3>
<a class="btn" href="aset_kendaraan.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$no_aset=$_GET['id'];
$det=sqlsrv_query($kon, "select a.*, b.person_responsible from kendaraan_asetkendaraan a LEFT JOIN cost_center b ON a.cost_center_id = b.id_cc where a.no_aset_kendaraan='$no_aset'");
while($d=sqlsrv_fetch_array($det)){
?>
<form action="update_gambar_kendaraan.php" method="post" enctype="multipart/form-data">
	 <input name="no_aset_kendaraan" type="hidden" class="form-control" value = "<?php echo $d['no_aset_kendaraan']?>" >
	<div class="form-group">
		<label>Gambar (Ukuran Maks = 1 MB)</label>
			<input id="gambar_lama" name="gambar_lama" type="file" class="form-control focus" required >
	</div>
	<div class="footer">
		<input type="submit" class="btn btn-primary" value="Upload Gambar">
	</div>
	<br/>
</form>
	<form action="update_aset_kendaraan.php" method="post" >
	        <input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
					<div id="accordion" class="accordion-style1 panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
								<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Detail Aset Kendaraan
									</a>
								</h4>
						</div>
							<div class="panel-collapse collapse" id="collapseZero">
							<div class="panel-body">
								<div class="form-group">
								<label>No.Aset</label>
								  <input name="no_aset_kendaraan" type="hidden" class="form-control" value = "<?php echo $d['no_aset_kendaraan']?>" >
									<input name="no" type="text" class="form-control" value = "<?php echo $d['no_aset_kendaraan']?>" disabled="disabled" >
								</div>
								<div class="form-group">
									<label>Jenis Aset</label>
									<select class="form-control autocomplete" id="jenis_kendaraan" name="jenis_kendaraan" >
									<option value="<?php echo $d['jenis_kendaraan']?>"><?php echo $d['jenis_kendaraan']?></option>
										<?php
										$dp=sqlsrv_query($kon, "select nama_jenis_kendaraan from kendaraan_jeniskendaraan where status = '1'");
										while($rw=sqlsrv_fetch_array($dp)){
											echo'<option value="'.$rw['nama_jenis_kendaraan'].'">'.$rw['nama_jenis_kendaraan'].'</option> ';
										}
										?>
									</select>
								</div>
                <div class="form-group">
									<label>Status Aset</label>
									<select class="form-control autocomplete" id="tipe_kendaraan" name="tipe_kendaraan" >
									<option value="<?php echo $d['tipe_kendaraan']?>"><?php echo $d['tipe_kendaraan']?></option>
										<?php
										$dp=sqlsrv_query($kon, "select nama_tipe_kendaraan, detail_tipe_kendaraan from kendaraan_tipekendaraan where status = '1'");
										while($rw=sqlsrv_fetch_array($dp)){
											echo'<option value="'.$rw['nama_tipe_kendaraan'].' --- '.$rw['detail_tipe_kendaraan'].'">'.$rw['nama_tipe_kendaraan'].' --- '.$rw['detail_tipe_kendaraan'].'</option> ';
										}
										?>
									</select>
								</div>
								<div class="form-group">
								<label>Merk Kendaraan</label>
									<input id="" name="nama_merk" type="text" class="form-control" value="<?php echo $d['nama_merk']?>">
								</div>
								<div class="form-group">
								<label>Tipe Kendaraan</label>
									<input id="" name="nama_tipe" type="text" class="form-control" value="<?php echo $d['nama_tipe']?>" >
								</div>
                <div class="form-group">
								<label>Tahun Kendaraan</label>
									<input id="" name="tahun_kendaraan" type="text" class="form-control"  value="<?php echo $d['tahun_kendaraan']?>" >
								</div>
                <!--<div class="form-group">
    							<label>Pake Box ??</label>
    							<select class="form-control" id="peripheral" name="peripheral" onchange="ChangesPeripheral()">
    							<option value="0">TIDAK</option>
    							<option value="1">YA</option>
    							</select>
    						</div>
                <script type="text/javascript">
    								  function ChangesPeripheral(){
    									var fr = document.getElementById('peripheral').value;
    									var xr = String(fr);
    									if(xr=='1')
    									{
    								    document.getElementById('no_aset_peripheral').disabled = false;
    									}else
    									{
    								    document.getElementById('no_aset_peripheral').disabled = true;
    									}
    									};
    							</script>-->
                  <div class="form-group">
  									<label>No. Box</label>
  									<select class="form-control autocomplete" id="no_aset_peripheral" name="no_aset_peripheral" >
  									<option value="<?php echo $d['no_aset_peripheral']?>"><?php echo $d['no_aset_peripheral']?></option>
  										<?php
  										$dp=sqlsrv_query($kon, "select no_aset_peripheral, jenis_peripheral from kendaraan_peripheral where status = '1'");
  										while($rw=sqlsrv_fetch_array($dp)){
  											echo'<option value="'.$rw['no_aset_peripheral'].'">'.$rw['jenis_peripheral'].' --- '.$rw['no_aset_peripheral'].'</option> ';
  										}
  										?>
  									</select>
  								</div>
							</div>
							</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Cos Center, User, Cap.Date & Acquis Val
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseOne">
							<div class="panel-body">
								  <div class="form-group">
								  <label>Cost Center</label>
									<input id="cost_center_id" name="cost_center_id" type="text" class="form-control" value = "<?php echo $d['cost_center_id']?>" onkeyup="validAngka(this)" maxlength="10">
								  </div>
									<div class="form-group">
											<label>NIK User</label>
											<input name="nik_baru" type="text" class="form-control" value = "<?php echo $d['nik_baru']?>"  onkeyup="validAngka(this)" maxlength="8">
									</div>
									<div class="form-group">
											<label>Cap. Date</label>
											<input id="cap_date" name="cap_date" type="text" class="form-control" value = "<?php echo $d['cap_date']?>"  >
									</div>
									<div class="form-group">
											<label>End. Date</label>
											<input id="end_date" name="end_date" type="text" class="form-control" value = "<?php echo $d['end_date']?>"  >
									</div>
									<div class="form-group">
											<label>Acquis Val</label>
											<input id="acquis_val" name="acquis_val" type="text" class="form-control" value = "<?php echo $d['acquis_value']?>" onkeyup="validAngka(this)">
									</div>
							</div>
						</div>
					</div>

					</div>
				</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>

	</form>
	<?php
}
?>
<script type="text/javascript">
		$(document).ready(function(){
			$("#tahun_kendaraan").datepicker({dateFormat : 'yy',viewMode: 'years',orientation: 'auto top'});
			$("#cap_date").datepicker({dateFormat : 'dd-M-y'});
			$("#end_date").datepicker({dateFormat : 'dd-M-y'});
		});
	</script>
	<script language='javascript'>
		function validAngka(angka)
		{
			if(!/^[0-9.]+$/.test(angka.value))
			{
				angka.value = angka.value.substring(0,angka.value.length-1000);
			}
		}
    </script>
<?php include 'footer.php'; ?>
