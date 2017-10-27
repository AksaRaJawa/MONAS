<?php
include 'header_peripheral.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from admin where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Aset Peripheral peripheral</h3>
<a class="btn" href="aset_peripheral.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$no_aset=$_GET['id'];
$det=sqlsrv_query($kon, "select a.*, b.person_responsible from kendaraan_peripheral a LEFT JOIN cost_center b ON a.cost_center_id = b.id_cc where a.no_aset_peripheral='$no_aset'");
while($d=sqlsrv_fetch_array($det)){
?>
<form action="update_gambar_peripheral.php" method="post" enctype="multipart/form-data">
	 <input name="no_aset_peripheral" type="hidden" class="form-control" value = "<?php echo $d['no_aset_peripheral']?>" >
	<div class="form-group">
		<label>Gambar (Ukuran Maks = 1 MB)</label>
			<input id="gambar_lama" name="gambar_lama" type="file" class="form-control focus" required >
	</div>
	<div class="footer">
		<input type="submit" class="btn btn-primary" value="Upload Gambar">
	</div>
	<br/>
</form>
	<form action="update_aset_peripheral.php" method="post" >
	        <input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
					<div id="accordion" class="accordion-style1 panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
								<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Detail Aset Peripheral
									</a>
								</h4>
						</div>
							<div class="panel-collapse collapse" id="collapseZero">
							<div class="panel-body">
								<div class="form-group">
								<label>No. Aset Peripheral</label>
								  <input name="no_aset_peripheral" type="hidden" class="form-control" value = "<?php echo $d['no_aset_peripheral']?>" >
									<input name="no" type="text" class="form-control" value = "<?php echo $d['no_aset_peripheral']?>" disabled="disabled" >
								</div>
								<div class="form-group">
									<label>Jenis Aset</label>
									<select class="form-control autocomplete" id="jenis_peripheral" name="jenis_peripheral" >
									<option  value = "<?php echo $d['jenis_peripheral']?>" ><?php echo $d['jenis_peripheral']?></option>
									</select>
								</div>
                <div class="form-group">
									<label>Desc Peripheral</label>
									<input id="" name="desc_peripheral" type="text" class="form-control"  value = "<?php echo $d['desc_peripheral']?>" >
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
									<input id="cost_center_id" name="cost_center_id" type="hidden" class="form-control" value = "<?php echo $d['cost_center_id']?>" >
									<input id="costcenter" name="costcenter" type="text" class="form-control" value = "<?php echo $d['cost_center_id']?>" disabled>
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
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									<i class="ace-icon fa fa-angle-right bigger-110"></i>
									&nbsp; Status Perangkat Status Jual, & Harga Jual
									</a>
								</h4>
							</div>
							<div class="panel-collapse collapse" id="collapseTwo">
								<div class="panel-body">
									<div class="form-group">
									<label>Status Perangkat</label>
									<select class="form-control" id="status_perangkat" name="status_perangkat">
									<option value = "<?php echo $d['status_perangkat']?>" ><?php echo $d['status_perangkat']?></option>
									<option value="Operasional">Operasional</option>
									<option value="Rusak">Rusak</option>
									<option value="Servis">Servis</option>
									</select>
									</div>
									<div class="form-group">
									<label>Status Jual</label>
									<select class="form-control" id="status_jual" name="status_jual" >
									<option value = "<?php echo $d['status_jual']?>" ><?php echo $d['status_jual']?></option>
									<option value="Masih Asset">Masih Asset</option>
									<option value="Siap dijual">Siap dijual</option>
									</select>
									</div>
									<script type="text/javascript">
											function ChangesStatus(){
											var fr = document.getElementById('status').value;
											var xr = String(fr);
											if(xr=='Siap dijual')
											{
												document.getElementById('harga_jual').disabled=false;
											}
											if(xr=='Masih Asset')
											{
												document.getElementById('harga_jual').disabled=false;
											}
											};
											</script>
										<div class="form-group">
												<label>Harga Jual</label>
												<input id="harga_jual" name="harga_jual" type="text" class="form-control" value = "<?php echo $d['harga_jual']?>"  onkeyup="validAngka(this)">
										</div>

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
			$("#tahun_peripheral").datepicker({dateFormat : 'yy',viewMode: 'years',orientation: 'auto top'});
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
