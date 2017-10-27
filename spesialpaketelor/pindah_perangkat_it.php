<?php
include 'header_aset.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from admin where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Pindah Cost Center & Profit Center Perangkat IT</h3>
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
								&nbsp; Pindahkan Ke Cost Center & Profit Center :
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseOne">
							<div class="panel-body">
								<div class="form-group">
								<label>Cost Center & Profit Center</label>
								<input id="cost_center" name="cost_center" type="text" maxlength="10" value="XXXXXXXXXX" class="form-control" required >
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
