<?php
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Asuransi Kendaraan</h3>
<a class="btn" href="asuransi.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id=$_GET['id'];
$det=sqlsrv_query($kon, "select * from asuransi_kendaraan where no_rangka='$id'");
$a = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '1'");
$ax = sqlsrv_fetch_array($a);
$b = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '2'");
$bx = sqlsrv_fetch_array($b);
$c = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '3'");
$cx = sqlsrv_fetch_array($c);
$e = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '4'");
$ex = sqlsrv_fetch_array($e);
$f = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '5'");
$fx = sqlsrv_fetch_array($f);
$g = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '6'");
$gx = sqlsrv_fetch_array($g);
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_asuransi.php" method="post">
		<input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
		<div id="accordion" class="accordion-style1 panel-group">
		<div class="panel panel-default">
		<div class="panel-heading">
				<h4 class="panel-title">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
				<i class="ace-icon fa fa-angle-right bigger-110"></i>
				&nbsp; Detail Kendaraan
					</a>
				</h4>
		</div>
			<div class="panel-collapse collapse" id="collapseZero">
			<div class="panel-body">
				<div class="form-group">
				<label>No. Rangka</label>
				<input id="no_rangka" name="no_rangka" type="hidden" class="form-control" value="<?php echo $d['no_rangka']?>">
					<input id="norangka" name="norangka" type="text" class="form-control" value="<?php echo $d['no_rangka']?>"  disabled>
				</div>
				<div class="form-group">
				<label>No. Polisi</label>
				  <input id="nopol_lama" name="nopol_lama" type="hidden" class="form-control" value="<?php echo $d['no_polisi']?>">
					<input id="no_polisi" name="no_polisi" type="text" class="form-control" value="<?php echo $d['no_polisi']?>"  required>
				</div>
				<div class="form-group">
				<label>No. Mesin</label>
					<input id="no_mesin" name="no_mesin" type="text" class="form-control" value="<?php echo $d['no_mesin']?>"  required>
				</div>
				<div class="form-group">
				<label>Nama Merk</label>
					<input id="nama_merk" name="nama_merk" type="text" class="form-control" value="<?php echo $d['nama_merk']?>"  >
				</div>
				<div class="form-group">
				<label>Nama Type</label>
					<input id="nama_tipe" name="nama_tipe" type="text" class="form-control" value="<?php echo $d['nama_tipe']?>"  >
				</div>
				<div class="form-group">
				<label>Warna Kendaraan</label>
					<input id="warna_kendaraan" name="warna_kendaraan" type="text" class="form-control" value="<?php echo $d['warna_kendaraan']?>"  >
				</div>
				<div class="form-group">
				<label>Tahun</label>
					<input id="tahun_kendaraan" name="tahun_kendaraan" type="text" class="form-control" value="<?php echo $d['tahun_kendaraan']?>" >
				</div>
				<div class="form-group">
				<label>No. STNK</label>
					<input id="no_stnk" name="no_stnk" type="text" class="form-control" value="<?php echo $d['no_stnk']?>" >
				</div>
				<div class="form-group">
						<label>Tanggal STNK</label>
						<input id="tanggal_stnk" name="tanggal_stnk" type="text" class="form-control" value="<?php echo $d['tanggal_stnk']?>">
				</div>
				<div class="form-group">
					<label>Status</label>
					<select class="form-control autocomplete" id="status_kendaraan" name="status_kendaraan" >
					<option value="<?php echo $d['status_kendaraan']?>"><?php echo $d['status_kendaraan']?></option>
					<option value="OPR"> OPR </option>
					<option value="MOP"> MOP </option>
					<option value="COP"> COP </option>
					</select>
				</div>
				<div class="form-group">
				<label>NIK User</label>
				  <input name="nik_lama" type="hidden" class="form-control" value="<?php echo $d['nik_user']?>" >
					<input name="nik_user" type="text" class="form-control" maxlength="8" value="<?php echo $d['nik_user']?>" onkeyup="validAngka(this)">
				</div>
			</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					<i class="ace-icon fa fa-angle-right bigger-110"></i>
					&nbsp; Detail Biaya Asuransi
					</a>
				</h4>
			</div>
			<div class="panel-collapse collapse" id="collapseOne">
				<div class="panel-body">
					<div class="form-group">
					<label>No. Polis Asuransi</label>
						<input id="no_asuransi" name="no_asuransi" type="text" class="form-control" value="<?php echo $d['no_asuransi']?>" onkeyup="validAngka(this)">
					</div>
					<div class="form-group">
						<label>Note Leasing</label>
						<select class="form-control autocomplete" id="note_leasing" name="note_leasing" >
						<option value="<?php echo $d['note_leasing']?>"><?php echo $d['note_leasing']?></option>
						<option value="">- Tidak Menggunakan Leasing -</option>
							<?php
							$dp=sqlsrv_query($kon, "select * from asuransi_leasing where status = '1'");
							while($rw=sqlsrv_fetch_array($dp)){
								echo'<option value="'.$rw['nama_note'].'">'.$rw['nama_note'].'</option> ';
							}
							?>
						</select>
					</div>
						<div class="form-group">
								<label>Awal Asuransi</label>
								<input id="awal_asuransi" name="awal_asuransi" type="text" class="form-control" value="<?php echo $d['awal_asuransi']?>" >
						</div>
						<div class="form-group">
								<label>Akhir Asuransi</label>
								<input id="akhir_asuransi" name="akhir_asuransi" type="text" class="form-control" value="<?php echo $d['akhir_asuransi']?>">
						</div>
						<div class="form-group">
								<label>Biaya Admin</label>
								<input id="biaya_admin" name="biaya_admin" type="text" class="form-control" value="<?php echo $d['biaya_admin']?>" onkeyup="validAngka(this)">
						</div>
						<div class="form-group">
								<label>Biaya Comprehensive</label>&nbsp;&nbsp;
								<input id="jumlah_biaya_comprehensive" name="jumlah_biaya_comprehensive" type="text" class="form-control-static" value="<?php echo $ax['jumlah_biaya']?>" onkeyup="validAngka(this)" >
								<input id="persen_biaya_comprehensive" name="persen_biaya_comprehensive" type="text" class="form-control-static" value="<?php echo $ax['persen_biaya']?>"  >&nbsp;&nbsp;<label>%</label>
						</div>
						<div class="form-group">
								<label>Biaya Gempa Bumi</label>&nbsp;&nbsp;
								<input id="jumlah_biaya_gempa_bumi" name="jumlah_biaya_gempa_bumi" type="text" class="form-control-static" value="<?php echo $bx['jumlah_biaya']?>" onkeyup="validAngka(this)" >
								<input id="persen_biaya_gempa_bumi" name="persen_biaya_gempa_bumi" type="text" class="form-control-static" value="<?php echo $bx['persen_biaya']?>"  >&nbsp;&nbsp;<label>%</label>
						</div>
						<div class="form-group">
								<label>Biaya Banjir & Angin Topan</label>&nbsp;&nbsp;
								<input id="jumlah_biaya_banjir_angin_topan" name="jumlah_biaya_banjir_angin_topan" type="text" class="form-control-static" value="<?php echo $cx['jumlah_biaya']?>" onkeyup="validAngka(this)" >
								<input id="persen_biaya_banjir_angin_topan" name="persen_biaya_banjir_angin_topan" type="text" class="form-control-static" value="<?php echo $cx['persen_biaya']?>"  >&nbsp;&nbsp;<label>%</label>
						</div>
						<div class="form-group">
								<label>Biaya Huru Hara</label>&nbsp;&nbsp;
								<input id="jumlah_biaya_huru_hara" name="jumlah_biaya_huru_hara" type="text" class="form-control-static" value="<?php echo $ex['jumlah_biaya']?>" onkeyup="validAngka(this)" >
								<input id="persen_biaya_huru_hara" name="persen_biaya_huru_hara" type="text" class="form-control-static" value="<?php echo $ex['persen_biaya']?>" >&nbsp;&nbsp;<label>%</label>
						</div>
						<div class="form-group">
								<label>Biaya Pihak Ke-3</label>&nbsp;&nbsp;
								<input id="jumlah_pihak_ke_3" name="jumlah_pihak_ke_3" type="text" class="form-control-static" value="<?php echo $fx['jumlah_biaya']?>" onkeyup="validAngka(this)" >
								<input id="persen_pihak_ke_3" name="persen_pihak_ke_3" type="text" class="form-control-static" value="<?php echo $fx['persen_biaya']?>"  >&nbsp;&nbsp;<label>%</label>
						</div>
						<div class="form-group">
								<label>Biaya Terorisme & Sabotase</label>&nbsp;&nbsp;
								<input id="jumlah_terorisme_sabotase" name="jumlah_terorisme_sabotase" type="text" class="form-control-static" value="<?php echo $gx['jumlah_biaya']?>" onkeyup="validAngka(this)" >
								<input id="persen_terorisme_sabotase" name="persen_terorisme_sabotase" type="text" class="form-control-static" value="<?php echo $gx['persen_biaya']?>"  >&nbsp;&nbsp;<label>%</label>
						</div>
						<div class="form-group">
								<label>Keterangan</label>
								<input id="keterangan" name="keterangan" type="text" class="form-control" value="<?php echo $d['keterangan']?>" >
						</div>
				</div>
			</div>
		</div>
	</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Simpan">
			</div>
	</form>
	<?php
}
?>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){
		//$("#tgl").datepicker($.datepicker.regional["id"]);
		$("#tanggal_stnk").datepicker({dateFormat : 'dd-M-y'});
		$("#awal_asuransi").datepicker({dateFormat : 'dd-M-y'});
		$("#akhir_asuransi").datepicker({dateFormat : 'dd-M-y'});
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
