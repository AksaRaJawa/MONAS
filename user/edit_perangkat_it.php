<?php
include 'header_aset.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Perangkat IT</h3>
<a class="btn" href="perangkat_it.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$no_aset=$_GET['id'];
$det=sqlsrv_query($kon, "select a.*, b.person_responsible from perangkat_it a LEFT JOIN cost_center b ON a.cost_center = b.id_cc where a.no_aset='$no_aset'");
while($d=sqlsrv_fetch_array($det)){
?>
<form action="update_gambar.php" method="post" enctype="multipart/form-data">
	 <input name="no_aset" type="hidden" class="form-control" value = "<?php echo $d['no_aset']?>" >
	<div class="form-group">
		<label>Gambar (Ukuran Maks = 1 MB)</label>
			<input id="gambar" name="gambar" type="file" class="form-control focus" required >
	</div>
	<div class="footer">
		<input type="submit" class="btn btn-primary" value="Upload Gambar">
	</div>
	<br/>
</form>
	<form action="update_perangkat_it.php" method="post" >
	        <input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
					<div id="accordion" class="accordion-style1 panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
								<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Detail Perangkat
									</a>
								</h4>
						</div>
							<div class="panel-collapse collapse" id="collapseZero">
							<div class="panel-body">
								<div class="form-group">
								<label>No.Aset</label>
								  <input name="no_aset" type="hidden" class="form-control" value = "<?php echo $d['no_aset']?>" >
									<input name="no" type="text" class="form-control" value = "<?php echo $d['no_aset']?>" disabled="disabled" >
								</div>
								<div class="form-group">
									<label>Aset Group</label>
									<input name="aset_group" type="hidden" class="form-control" value = "<?php echo $d['aset_group']?>" >
									<input name="as_group" type="text" class="form-control" value = "<?php echo $d['aset_group']?>" disabled="disabled" >
								</div>
								<div class="form-group">
								<label>Aset Description</label>
									<input id="" name="aset_desc" type="hidden" class="form-control" value = "<?php echo $d['aset_desc']?>">
									<input id="" name="as_desc" type="text" class="form-control" value = "<?php echo $d['aset_desc']?>" disabled="disabled">
								</div>
								<div class="form-group">
								<label>Merk & Tipe</label>
									<input id="" name="nama_merk" type="text" class="form-control" value = "<?php echo $d['nama_merk']?>" >
								</div>
							</div>
							</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Cos Center, NIK Karyawan, Cap.Date & Acquis Val
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseOne">
							<div class="panel-body">
								  <div class="form-group">
								  <label>Cost Center</label>
									<input id="cost_center" name="cost_center" type="hidden" class="form-control" value = "<?php echo $d['cost_center']?>" >
									<input id="cc" name="cc" type="text" class="form-control" value = "<?php echo $d['cost_center']?>" disabled="disabled">
								  </div>

									<div class="form-group">
											<label>NIK User Responsible</label>
											<input id="nik_karyawan" name="nik_karyawan" type="text" class="form-control" maxlength="8" value = "<?php echo $d['nik_karyawan']?>" onkeyup="validAngka(this)">
									</div>
									<div class="form-group">
											<label>Profit Center</label>
											<input name="profit_center" type="hidden" class="form-control" value = "<?php echo $d['profit_center']?>">
											<input name="pc" type="text" class="form-control" value = "<?php echo $d['profit_center']?>" disabled="disabled">
									</div>
									<div class="form-group">
											<label>Nama Depo</label>
											<input name="nama_depo" type="hidden" class="form-control" value = "<?php echo $d['nama_depo']?>">
											<input name="namdep" type="text" class="form-control" value = "<?php echo $d['nama_depo']?>" disabled="disabled">
									</div>
									<div class="form-group">
											<label>Nama Region</label>
											<input name="nama_region" type="hidden" class="form-control" value = "<?php echo $d['nama_region']?>">
											<input name="namreg" type="text" class="form-control" value = "<?php echo $d['nama_region']?>" disabled="disabled">
									</div>
									<div class="form-group">
											<label>Cap. Date</label>
											<input id="cap_date" name="cap_date" type="hidden" class="form-control" value = "<?php echo $d['cap_date']?>" >
											<input id="cd" name="cd" type="text" class="form-control" value = "<?php echo $d['cap_date']?>" disabled="disabled">
									</div>
									<div class="form-group">
											<label>Acquis Val</label>
											<input name="acquis_val" type="hidden" class="form-control" value = "<?php echo $d['acquis_val']?>">
											<input name="acval" type="text" class="form-control" value = "<?php echo $d['acquis_val']?>" disabled="disabled">
									</div>
									<div class="form-group">
											<label>Thn Pemakaian</label>
											<input name="thn_pemakaian" type="hidden" class="form-control" value = "<?php echo $d['thn_pemakaian']?>">
											<input name="thnpem" type="text" class="form-control" value = "<?php echo $d['thn_pemakaian']?>" disabled="disabled">
									</div>

							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Status Perangkat & Status Jual
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseTwo">
							<div class="panel-body">
								<div class="form-group">
								<label>Status Aset</label>
								<select class="form-control" id="status_aset" name="status_aset" onchange="ChangesStatusAset()">
								<option value="<?php echo $d['status_aset']?>">- Pilih Status -</option>
								<option value="1">Aktif</option>
								<option value="0">Non-Aktif</option>
								</select>
							    </div>
								<script type="text/javascript">
									    function ChangesStatusAset(){
										var fr = document.getElementById('status_aset').value;
										var xr = String(fr);
										if(xr=='1')
										{
									    document.getElementById('status_perangkat').innerHTML = '<option value="Operasional">Operasional</option> <option value="Backup">Backup</option>';
										}else if(xr=='0')
										{
										document.getElementById('status_perangkat').innerHTML = '<option value="Hilang">Hilang</option> <option value="Fisik Tidak Ada">Fisik Tdk Ada</option> <option value="Servis">Servis</option> <option value="Rusak">Rusak</option>';
										}
										};
										</script>
							    <div class="form-group">
								<label>Status Perangkat</label>
								<select class="form-control" id="status_perangkat" name="status_perangkat">
								<option value="<?php echo $d['status_perangkat']?>">- Pilih Status -</option>
								</select>
								<p class="help-block"> - Jika Status Perangkat tdk muncul, silahkan pilih Status Aset terlebih dahulu</p>
							    </div>
								<div class="form-group">
								<label>Status Jual</label>
								<input name="status" type="hidden" class="form-control" value = "<?php echo $d['status_jual']?>">
								<input name="stas_ju" type="text" class="form-control" value = "<?php echo $d['status_jual']?>" disabled="disabled">
									<div class="form-group">
											<label>Harga Jual</label>
											<input id="harga_jual" name="harga_jual" type="hidden" class="form-control" value = "<?php echo $d['harga_jual']?>">
											<input id="harg_ju" name="harg_ju" type="text" class="form-control" value = "<?php echo $d['harga_jual']?>" disabled="disabled">
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
			$("#cap_date").datepicker({dateFormat : 'dd-M-y'});
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
			<script language='javascript'>
			var target=document.getElementById("nik_karyawan");
			function cekBatas(){
			    if(target.value.length >= 8 ){
			    target.readOnly=true;
			    }
			}
			</script>
<?php include 'footer.php'; ?>
