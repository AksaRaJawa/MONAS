<?php
include 'header_kendaraan.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
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
	<input name="uname" type="hidden" class="form-control" value = "<?php echo $uu['uname']?>" >
	 <input name="no_aset_kendaraan" type="hidden" class="form-control" value = "<?php echo $d['no_aset_kendaraan']?>" >
	 <input name="gambar_lama" type="hidden" class="form-control" value = "<?php echo $d['gambar_lama']?>" >
	<div class="form-group">
		<label>Gambar Ter-Update (Ukuran Maks = 1 MB)</label>
			<input id="gambar_baru" name="gambar_baru" type="file" class="form-control focus" required >
	</div>
	<div class="footer">
		<input type="submit" class="btn btn-primary" value="Ubah Gambar">
	</div>
	<br/>
</form>
	<form action="update_aset_kendaraan.php" method="post" >
	        <input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
					<input name="akses" type="hidden" class="form-control" value = "<?php echo $uu['akses']?>" >
					<input name="nama_merk" type="hidden" class="form-control" value= "<?=$d['nama_merk']?>">
					<input name="nama_tipe" type="hidden" class="form-control" value= "<?=$d['nama_tipe']?>">
					<input name="no_peripheral_lama" type="hidden" class="form-control" value= "<?=$d['no_aset_peripheral']?>">
					<input name="cost_center_id" type="hidden" class="form-control" value= "<?=$d['cost_center_id']?>">
					<input name="profit_center_id" type="hidden" class="form-control" value= "<?=$d['profit_center_id']?>">
					<input name="gambar_lama" type="hidden" class="form-control" value= "<?=$d['gambar_lama']?>">
					<input name="depo_uname" type="hidden" class="form-control" value= "<?=$uu['nama_depo']?>">
					<input name="region_uname" type="hidden" class="form-control" value= "<?=$uu['nama_region']?>">
					<div id="accordion" class="accordion-style1 panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
								<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Menggunakan Box Kendaraan ??.
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
  									<label>No. Box</label>
  									<select class="form-control autocomplete" id="no_peripheral_baru" name="no_peripheral_baru" >
  									<option value="<?php echo $d['no_aset_peripheral']?>"><?php echo $d['no_aset_peripheral']?></option>
  										<?php
  										$dp=sqlsrv_query($kon, "select no_aset_peripheral, jenis_peripheral from kendaraan_peripheral where nama_depo_peripheral = '".$uu['nama_region']."' AND status = '1'");
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
								&nbsp; User
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseOne">
							<div class="panel-body">

									<div class="form-group">
											<label>NIK User</label>
											<input name="nik_lama" type="hidden" class="form-control" value = "<?php echo $d['nik_baru']?>" >
											<input name="nik_baru" type="text" class="form-control" value = "<?php echo $d['nik_baru']?>"  onkeyup="validAngka(this)" maxlength="8">
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
