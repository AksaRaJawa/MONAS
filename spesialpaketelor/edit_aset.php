<?php 
include 'header.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from admin where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Asset Modis</h3>
<a class="btn" href="aset.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_asset=$_GET['id'];
$det=sqlsrv_query($kon, "select * from asset where id_asset='$id_asset'");
while($d=sqlsrv_fetch_array($det)){
?>					
	<form action="update_aset.php" method="post">
	                <input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
					<div id="accordion" class="accordion-style1 panel-group">					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Asset Modis
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseZero">
							<div class="panel-body">
                            <div class="form-group">
							<label>No.IMEI</label>
                            <input name="id_asset" type="hidden" class="form-control" value= "<?=$d['id_asset']?>">							
							<input name="no_imei" type="text" class="form-control" id="no_imei" value= "<?=$d['no_imei']?>" autocomplete="off" onkeyup = "validAngka(this)">
						    <p class="help-block"> - Untuk melihat No.IMEI ketik : *#06# di layar HP Anda</p>
							<p class="help-block"> - Jika HP Anda Dual SIM, harap hanya masukan IMEI-1 saja. Terimakasih</p>
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
							<label>No.Asset</label>
							<!--<input name="no_asset" type="hidden" class="form-control" value= "<?=$d['no_asset']?>">-->
							<input name="no_asset" type="text" class="form-control" id="no_asset" value= "<?=$d['no_asset']?>" autocomplete="off" onkeyup = "validAngka(this)">
						    </div>
							<div class="form-group">
							<label>Serial Number</label>
							<!--<input name="serial_number" type="hidden" class="form-control" value= "<?=$d['serial_number']?>">-->
							<input name="serial_number" type="text" class="form-control" id="serial_number" value= "<?=$d['serial_number']?>" autocomplete="off">
						    </div>
							<div class="form-group">
							<label>ID Device</label>
							<input id="id_device" name="id_device" type="text" class="form-control" value= "<?=$d['id_device']?>" autocomplete="off" >
						    </div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
					<div class="panel-heading">
							<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							<i class="ace-icon fa fa-angle-right bigger-110"></i>
							&nbsp; Pilih Karyawan
						    </a>
							</h4>
					</div>
						<div class="panel-collapse collapse" id="collapseOne">
						<div class="panel-body">
                            <div class="form-group">
							<label>NIK Karyawan</label>								
							<select class="form-control autocomplete" id="nik_karyawan" name="nik_karyawan" onchange="ChangesButuhModis()">
							<option value="<?=$d['nik_karyawan']?>--- --- --- --- --- --- ">- Pilih NIK -</option>
								<?php 
								$dp=sqlsrv_query($kon, "select * from karyawan a LEFT JOIN jabatan b ON a.nama_jabatan = b.nama_jabatan LEFT JOIN depo d ON a.id_depo = d.id_depo where a.status = '1' AND b.status = '1' AND a.nama_region = '".$d['nama_region']."' ");
								while($rw=sqlsrv_fetch_array($dp)){
									echo'<option value="'.$rw['nik_karyawan'].'---'.$rw['butuh_modis'].'---'.$rw['nama_karyawan'].'---'.$rw['nama_jabatan'].'---'.$rw['status'].'---'.$rw['id_depo'].'---'.$rw['nama_region'].'">
									'.$rw['nik_karyawan'].' --- '.$rw['nama_karyawan'].'</option> ';
								}
								?>
							</select>
						    </div>
							<script type="text/javascript">
								    function ChangesButuhModis(){
									var fr = document.getElementById('nik_karyawan').value;
									var xr = String(fr);
									var rr = xr.split("---");
									document.getElementById('nama_karyawan').innerHTML = rr[2];
									document.getElementById('nama_jabatan').innerHTML = rr[3];
									var rr4 = rr[4];
									if(rr4 == '1')
									{
										document.getElementById('tipe_aktif').innerHTML = "AKTIF";
									}
									else if(rr4 == '0')
									{
										document.getElementById('tipe_aktif').innerHTML = "NON-AKTIF";
									}
									var rr1 = rr[1];
									if(rr1=='1')
									{
								    document.getElementById('tanggal_terima').disabled = false;
									document.getElementById('nama_kepemilikan').disabled = false;
									document.getElementById('status_modis').disabled = false;
									document.getElementById('status_device').disabled = false;
									}else if(rr1=='0')
									{
									document.getElementById('tanggal_terima').disabled = true;
									document.getElementById('nama_kepemilikan').disabled = true;
									document.getElementById('status_modis').disabled = true;
									document.getElementById('status_device').disabled = true;
									}
									};			
									</script>
                            <div class="form-group">
							<label>Nama Karyawan</label>
							<span id="nama_karyawan" name="nama_karyawan" class="form-control" autocomplete="off" disabled = "disabled"></span>
						    </div>
							<div class="form-group">
							<label>Jabatan Karyawan</label>
							<span id="nama_jabatan" name="nama_jabatan" class="form-control" autocomplete="off" disabled = "disabled"></span>
						    </div>
							<div class="form-group">
							<label>Status Karyawan</label>
							<span id="tipe_aktif" name="tipe_aktif" class="form-control" autocomplete="off" disabled = "disabled"></span>
						    <!--<p class="help-block"> - 1 untuk : "Aktif" & 0 untuk : "Non-Aktif"</p>-->
							</div>
							<div class="form-group">
							<label>Kepemilikan</label>								
							<select class="form-control" id="nama_kepemilikan" name="nama_kepemilikan">
								<option value="<?=$d['nama_kepemilikan']?>"><?=$d['nama_kepemilikan']?></option>
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
							<option value="<?=$d['status_modis']?>">- Pilih Status -</option>
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
							<option value="<?=$d['status_device']?>"><?=$d['status_device']?></option>
							</select>
						    </div>
							<div class="form-group">
							<label>Masa Berlaku</label>
							<input name="masa_berlaku" type="text" class="form-control" id="tgl_berlaku" autocomplete="off" value= "<?=$d['masa_berlaku']?>">
							<p class="help-block"> - Masa berlaku modis setelah tanda terima</p>
						    </div>
							<div class="form-group">
							<label>Depo</label>								
							<select class="form-control autocomplete" id="id_depo" name="id_depo" onchange="ChangesValue()">
							<option value="<?=$d['id_depo'].'---'.$d['nama_region']?>">- Pilih Depo -</option>
								<?php 
								$dp=sqlsrv_query($kon, "select * from depo where status = '1'");
								while($rw=sqlsrv_fetch_array($dp)){
									$dep = $rw['nama_depo'];
									$depx = explode(" ",$dep);
									echo'<option value="'.$rw['id_depo'].'---'.$rw['nama_region'].'">'.$depx[1].' '.$depx[2].' '.$depx[3].' === '.$depx[0].'</option> ';
								}
								?>
							</select>
						    </div>
						    <div class="form-group">
							<label>Region</label>
							<span id="nama_region" name="nama_region" class="form-control" autocomplete="off" disabled = "disabled"></span>
							<script type="text/javascript">
								    function ChangesValue(){
									var fr = document.getElementById('id_depo').value;
									var xr = String(fr);
									var rr = xr.split("---");
									document.getElementById('nama_region').innerHTML = rr[1];
									};			
									</script>
						    </div>
							
						</div>
						</div>	
					</div>
					<div class="panel panel-default">
					<div class="panel-heading">
							<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
							<i class="ace-icon fa fa-angle-right bigger-110"></i>
							&nbsp; Keterangan
						    </a>
							</h4>
					</div>
						<div class="panel-collapse collapse" id="collapseTwo">
						<div class="panel-body">
                           <div class="form-group">
							<label>Keterangan</label>
							<input name="keterangan" type="text" class="form-control" value="<?=$d['keterangan']?>">
						    </div>
							<div class="form-group">
							<label>Provider</label>
							<select class="form-control" id="provider" name="provider" >
							<option value="<?=$d['provider']?>">- Pilih Provider -</option>
							<option value="Telkomsel">Telkomsel</option>
							<option value="XL">XL</option>
							<option value="Indosat">Indosat</option>
							<option value="Three">Three (3)</option>
							<option value="Axis">Axis</option>
							<option value="Smartfren">Smartfren</option>
							</select>
							</div>
							<div class="form-group">
							<label>No HP</label>
							<input name="nohp" type="text" class="form-control" value="<?=$d['nohp']?>">
						    </div>
                            <div class="form-group">
							<label>Tanggal Aktif</label>
							<input name="tgglaktif" type="text" class="form-control" autocomplete="off" id="tgglaktif" value="<?=$d['tgglaktif']?>">
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
			//$("#tgl").datepicker($.datepicker.regional["id"]);
			$("#tanggal_terima").datepicker({dateFormat : 'dd-MM-yy'});
			$("#tgl_berlaku").datepicker({dateFormat : 'dd-MM-yy'});
			$("#tgglaktif").datepicker({dateFormat : 'dd-MM-yy'});
			//$("#id_depo").autocomplete({maxLength:10});
			//$("#nama_merk").autocomplete({maxLength:10});
			$("#nik_karyawan").autocomplete({maxLength:10});
			
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