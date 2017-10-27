<?php
include 'header_aset.php';
?>
<script language="javascript" src="../assets/js/jquery.js"></script>
<script>
$(document).ready(function()
{
	$('#profit_center').change(function(){
		var pc = $(this).val();
		$.ajax({
			type:'POST',
			url:'ambil_cost_center.php',
			data:'id_pc=' +pc,
			success:function(response){
			$('#cost_center').html(response);
			}
		});
	});
});
</script>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Pindah Profit Center Perangkat IT</h3>
<a class="btn" href="perangkat_it.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$no_aset=$_GET['id'];
$det=sqlsrv_query($kon, "select a.*, b.person_responsible from perangkat_it a LEFT JOIN cost_center b ON a.cost_center = b.id_cc where a.no_aset='$no_aset'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="pindahkan_perangkat_it.php" method="post" >
	        <input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
					<input name="cc_dulu" type="hidden" class="form-control" value= "<?=$d['cost_center']?>">
					<input name="pc_dulu" type="hidden" class="form-control" value= "<?=$d['profit_center']?>">
					<input name="nik_dulu" type="hidden" class="form-control" value= "<?=$d['nik_karyawan']?>">
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
								&nbsp; Pindahkan Ke Profit Center :
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseOne">
							<div class="panel-body">
								<div class="form-group">
								<label>Profit Center</label>
								<select class="form-control autocomplete" id="profit_center" name="profit_center" required>
								<option value=" ">- Pilih Profit Center -</option>
									<?php
									$dp=sqlsrv_query($kon, "select * from profit_center where nama_ro = '".$uu['nama_region']."' AND status = '1'");
									while($rw=sqlsrv_fetch_array($dp)){
										echo'<option value="'.$rw['pc'].'">'.$rw['pc'].' --- '.$rw['nama_depo'].'</option> ';
									}
									?>
								</select>
								</div>
								<script type="text/javascript">
										function ChangesPC(){
										var fr = document.getElementById('profit_center').value;
										var xr = String(fr);
										var rr = xr.split("---");
										//document.getElementById('nama_depo').innerHTML = rr[1];
										//document.getElementById('nama_region').innerHTML = rr[2];
										};
								</script>
								<?php $idpc = ""?>
								  <div class="form-group">
								  <label>Cost Center</label>
									<select class="form-control autocomplete" id="cost_center" name="cost_center"  onchange="ChangesCC()" required>
									</select>
								  </div>
									<script type="text/javascript">
											function ChangesCC(){
											var fr = document.getElementById('cost_center').value;
											var xr = String(fr);
											var rr = xr.split("---");
											//document.getElementById('nama_depo').innerHTML = xr;
											//document.getElementById('nama_region').innerHTML = rr[2];
											};
									</script>
									<div class="form-group">
											<label>NIK User Responsible</label>
											<input name="nik_karyawan" type="hidden" class="form-control" maxlength="8" value = "<?php echo $d['nik_karyawan']?>" onkeyup="validAngka(this)" >
											<input name="nikkaryawan" type="text" class="form-control" maxlength="8" value = "<?php echo $d['nik_karyawan']?>" onkeyup="validAngka(this)" disabled>
									</div>
							</div>
						</div>
					</div>
				</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Pindahkan">
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
<?php include 'footer.php'; ?>
