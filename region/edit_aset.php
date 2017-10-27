<?php
include 'header.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Aset Modis</h3>
<a class="btn" href="aset.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_asset=$_GET['id'];
$det=sqlsrv_query($kon, "select a.*, b.nama_karyawan, b.nama_jabatan, b.status AS status_karyawan from asset a LEFT JOIN karyawan b ON a.nik_karyawan = b.nik_karyawan where a.id_asset='$id_asset'");
while($d=sqlsrv_fetch_array($det)){
	$sts = $d['status_karyawan'];
	if($sts == '1')
	{
		$status_kar = 'AKTIF';
	}
	else if($sts == '0')
	{
		$status_kar = 'NON-AKTIF (RESIGN)';
	}
?>
	<form action="update_aset.php" method="post">
	        <input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
					<input name="uu_depo" type="hidden" class="form-control" value= "<?=$uu['id_depo']?>">
					<input name="uu_region" type="hidden" class="form-control" value= "<?=$uu['nama_region']?>">
					<input name="merk_dulu" type="hidden" class="form-control" value= "<?=$d['nama_merk']?>">
					<div id="accordion" class="accordion-style1 panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Aset Modis
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseZero">
							<div class="panel-body">
                            <div class="form-group">
							<label>No.IMEI</label>
                            <input name="id_asset" type="hidden" class="form-control" value= "<?=$d['id_asset']?>">
							<input name="no_imei" type="text" class="form-control" id="no_imei" value= "<?=$d['no_imei']?>" autocomplete="off" onkeyup = "validAngka(this)">
						    </div>
							<div class="form-group">
							<label>Merk</label>
							<select class="form-control autocomplete" id="nama_merk" name="nama_merk" onchange="ChangesMerk()">
							<option value="<?=$d['nama_merk'].'---'.$d['nama_tipe']?>"><?=$d['nama_merk'].'---'.$d['nama_tipe']?></option>
								<?php
								$dp=sqlsrv_query($kon, "select * from merk where status = '1'");
								while($rw=sqlsrv_fetch_array($dp)){
									echo'<option value="'.$rw['nama_merk'].'---'.$rw['nama_tipe'].'">'.$rw['nama_merk'].'---'.$rw['nama_tipe'].'</option> ';
								}
								?>
							</select>
						    </div>
							<div class="form-group">
							<label>Tipe</label>
							<span id="nama_tipe" name="nama_tipe" class="form-control" disabled="disabled"></span>
								<script type="text/javascript">
										function ChangesMerk(){
										var fr = document.getElementById('nama_merk').value;
										var xr = String(fr);
										var rr = xr.split("---");
										document.getElementById('nama_tipe').innerHTML = rr[1];
										};
										</script>
						    </div>
                            <div class="form-group">
							<label>No.Aset</label>
							<input name="no_asset" type="text" class="form-control" value= "<?=$d['no_asset']?>" >
						    </div>
							<div class="form-group">
							<label>Serial Number</label>
							<input name="serial_number" type="text" class="form-control" value= "<?=$d['serial_number']?>">
						    </div>
							<div class="form-group">
							<label>ID Device</label>
							<input name="nik_karyawan" type="hidden" class="form-control" value= "<?=$d['nik_karyawan']?>">
							<input name="id_device" type="text" class="form-control" value= "<?=$d['id_device']?>">
						    </div>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
					<div class="panel-heading">
							<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
							<i class="ace-icon fa fa-angle-right bigger-110"></i>
							&nbsp; Rubah Status Aset Modis
						    </a>
							</h4>
					</div>
						<div class="panel-collapse collapse" id="collapseTwo">
						<div class="panel-body">
							<div class="form-group">
							<label>Kepemilikan</label>
							<select class="form-control" id="nama_kepemilikan" name="nama_kepemilikan">
								<option value="<?=$d['nama_kepemilikan']?>">- Pilih Kepemilikan -</option>
								<?php
								$dp=sqlsrv_query($kon, "select * from kepemilikan where status = '1'");
								while($rw=sqlsrv_fetch_array($dp)){
									echo'<option value="'.$rw['nama_kepemilikan'].'">'.$rw['nama_kepemilikan'].'</option> ';
								}
								?>
							</select>
						    </div>
							<div class="form-group">
							<label>Status Modis</label>
							<select class="form-control" id="status_modis" name="status_modis" onchange="ChangesStatusModis()">
							<option value="1">- Pilih Status -</option>
							<option value="1">Aktif</option>
							<option value="0">Non-Aktif</option>
							</select>
						    </div>
							<script type="text/javascript">
								    function ChangesStatusModis(){
									var fr = document.getElementById('status_modis').value;
									var xr = String(fr);
									if(xr=='1')
									{
								    document.getElementById('status_device').innerHTML = '<option value="Operasional">Operasional</option> <option value="Backup">Backup</option>';
									}else if(xr=='0')
									{
									document.getElementById('status_device').innerHTML = '<option value="Hilang">Hilang</option> <option value="Terjual">Terjual</option> <option value="Servis">Servis</option> <option value="Mati Total">Mati Total</option> <option value="Sudah Lunas">Sudah Lunas</option>';
									}
									};
									</script>
						    <div class="form-group">
							<label>Status Device</label>
							<select class="form-control" id="status_device" name="status_device">
							<option value="Operasional">- Pilih Status -</option>
							</select>
							<p class="help-block"> - Jika Status Device tdk muncul, silahkan pilih Status Modis terlebih dahulu</p>
						    </div>
							<div class="form-group">
							<label>Tanggal Terima</label>
							<input name="tanggal_terima" type="text" class="form-control" id="tanggal_terima" autocomplete="off" value= "<?=$d['tanggal_terima']?>">
						    </div>
							<div class="form-group">
							<label>Keterangan</label>
							<input name="keterangan" type="text" class="form-control" value="<?=$d['keterangan']?>">
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
			$("#tanggal_terima").datepicker({dateFormat : 'dd-MM-yy'});
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
