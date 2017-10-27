<?php
include 'header.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Pindah Aset Modis</h3>
<a class="btn" href="aset.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_asset=$_GET['id'];
$det=sqlsrv_query($kon, "select a.*, b.nama_karyawan, c.nama_depo from asset a LEFT JOIN karyawan b ON a.nik_karyawan = b.nik_karyawan LEFT JOIN depo c ON a.id_depo = c.id_depo where a.id_asset='$id_asset'")or die(sqlsrv_errors());
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="pindahkan_aset.php" method="post">
	                <input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
					<input name="uu_depo" type="hidden" class="form-control" value= "<?=$uu['id_depo']?>">
					<input name="uu_region" type="hidden" class="form-control" value= "<?=$uu['nama_region']?>">

					<input name="nik_dulu" type="hidden" class="form-control" value= "<?=$d['nik_karyawan']?>">
					<input name="nama_dulu" type="hidden" class="form-control" value= "<?=$d['nama_karyawan']?>">
					<input name="depo_dulu" type="hidden" class="form-control" value= "<?=$d['nama_depo']?>">
					<input name="serial_number" type="hidden" class="form-control" value= "<?=$d['serial_number']?>">
					<input name="tanggal_terima" type="hidden" class="form-control" value= "<?=$d['tanggal_terima']?>">
					<input name="nama_kepemilikan" type="hidden" class="form-control" value= "<?=$d['nama_kepemilikan']?>">
					<input name="status_modis" type="hidden" class="form-control" value= "<?=$d['status_modis']?>">
					<input name="status_device" type="hidden" class="form-control" value= "<?=$d['status_device']?>">
					        <div class="form-group">
							<label>No.IMEI</label>
							<input name="id_asset" type="hidden" class="form-control" value= "<?=$d['id_asset']?>">
                            <input name="no_imei" type="hidden" class="form-control" value= "<?=$d['no_imei']?>">
							<input name="imei" type="text" class="form-control" id="no_imei" value= "<?=$d['no_imei']?>" autocomplete="off" disabled="disabled">
						    </div>
							<div class="form-group">
							<label>Merk</label>
							<input name="nama_merk" type="hidden" class="form-control" value= "<?=$d['nama_merk']?>">
							<input name="merk" type="text" class="form-control" id="nama_merk" value= "<?=$d['nama_merk']?>" autocomplete="off" disabled="disabled">
						    </div>
							<div class="form-group">
							<label>Tipe</label>
							<input name="nama_tipe" type="hidden" class="form-control" value= "<?=$d['nama_tipe']?>">
							<input name="tipe" type="text" class="form-control" id="nama_tipe" value= "<?=$d['nama_tipe']?>" autocomplete="off" disabled="disabled">
						    </div>
                            <div class="form-group">
							<label>No.Aset</label>
							<input name="no_asset" type="hidden" class="form-control" value= "<?=$d['no_asset']?>" >
							<input name="noaset" type="text" class="form-control" value= "<?=$d['no_asset']?>" disabled = "disabled">
						    </div>
					<div id="accordion" class="accordion-style1 panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Pindah Aset Ke :
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseZero">
							<div class="panel-body">
							<div class="form-group">
							<label>NIK Karyawan</label>
							<select class="form-control autocomplete" id="nik_karyawan" name="nik_karyawan" onchange="ChangesButuhModis()">
							<option value=" --- --- --- ">- Pilih NIK -</option>
								<?php
								$dp=sqlsrv_query($kon, "select a.*, b.nama_jabatan, b.butuh_modis, d.nama_depo from karyawan a LEFT JOIN jabatan b ON a.nama_jabatan = b.nama_jabatan LEFT JOIN depo d ON a.id_depo = d.id_depo where a.nama_region = '".$uu['nama_region']."' AND a.status = '1' AND b.status = '1' ");
								while($rw=sqlsrv_fetch_array($dp)){
									echo'<option value="'.$rw['nik_karyawan'].'---'.$rw['butuh_modis'].'---'.$rw['nama_karyawan'].'---'.$rw['nama_jabatan'].'---'.$rw['status'].'---'.$rw['id_depo'].'---'.$rw['nama_depo'].'---'.$rw['nama_region'].'">
									'.$rw['nik_karyawan'].' --- '.$rw['nama_karyawan'].'</option> ';}
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
								    document.getElementById('id_depo').disabled = false;
									}else if(rr1=='0')
									{
									document.getElementById('id_depo').disabled = true;
									alert('Maaf Jabatan Karyawan ini Tidak Membutuhkan Modis !!. TERIMAKASIH');history.go(-1)
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
							<label>Depo</label>
							<select class="form-control autocomplete" id="id_depo" name="id_depo">
							<option value="<?=$d['id_depo'].'---'.$d['nama_depo'].'---'.$d['nama_region']?>">- Pilih Depo -</option>
								<?php
								$dp=sqlsrv_query($kon, "select * from depo where nama_region = '".$uu['nama_region']."' AND status = '1'");
								while($rw=sqlsrv_fetch_array($dp)){
									$dep = $rw['nama_depo'];
									$depx = explode(" ",$dep);
									echo'<option value="'.$rw['id_depo'].'---'.$rw['nama_depo'].'---'.$rw['nama_region'].'">'.$depx[1].' '.$depx[2].' '.$depx[3].' === '.$depx[0].'</option> ';
								}
								?>
							</select>
						    </div>
							<div class="form-group">
							<label>Region</label>
							<input type="hidden" name="nama_region" value="<?=$d['nama_region']?>" class="form-control">
							<input type="text" id="nama_region" name="nama_region" value="<?=$d['nama_region']?>" class="form-control" autocomplete="off" disabled = "disabled">
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
			//$("#tgl").datepicker({dateFormat : 'dd-MM-yy'});
			//$("#tgl_berlaku").datepicker({dateFormat : 'dd-MM-yy'});
			//$("#nik_karyawan").autocomplete({maxLength:10});
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
