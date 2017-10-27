<?php include 'header.php';	?>


<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Asset Modis</h3>

<button onclick="document.location='lap_aset.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>


<br/>
<br/>
<br/>
    <div style="overflow-y:auto">

	<div style="width:2500px">

<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >
	<tr>
				<th class="col-md-0; text-center">No</th>
				<th class="col-md-0">No.IMEI</th>
				<th class="col-md-0">Merk</th>
				<th class="col-md-0">Tipe</th>
				<th class="col-md-0">No.Asset</th>
        <th class="col-md-0">NIK Karyawan</th>
				<th class="col-md-0">Nama Karyawan</th>
				<th class="col-md-0">Tanggal Terima</th>
				<th class="col-md-0">Status Kepemilikan</th>
				<th class="col-md-0">Status Modis</th>
				<th class="col-md-0">Status Device</th>
        <th class="col-md-0">Nama Depo</th>
		    <th class="col-md-0">Region</th>
        <th class="col-md-0">Provider</th>
        <th class="col-md-0">No HP</th>
        <th class="col-md-0">Tanggal Aktif</th>
        <th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody style="overflow-x:auto">
	<?php

	$brg=sqlsrv_query($kon, "select a.*, b.nama_karyawan, c.nama_depo from asset a left join karyawan b ON a.nik_karyawan = b.nik_karyawan left join depo c ON a.id_depo = c.id_depo ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
		$bt_modis = $b['status_modis'];
		if($bt_modis=='1')
		{
			$btuh_modis = 'AKTIF';
		}else if($bt_modis=='0')
		{
			$btuh_modis = 'NON-AKTIF';
		}
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['no_imei'] ?></td>
			<td><?php echo $b['nama_merk'] ?></td>
			<td><?php echo $b['nama_tipe'] ?></td>
			<td><?php echo $b['no_asset'] ?></td>
			<td><?php echo $b['nik_karyawan'] ?></td>
			<td><?php echo $b['nama_karyawan'] ?></td>
			<td><?php echo $b['tanggal_terima'] ?></td>
			<td><?php echo $b['nama_kepemilikan'] ?></td>
			<td><?php echo $btuh_modis ?></td>
      <td><?php echo $b['status_device'] ?></td>
			<td><?php echo $b['nama_depo'] ?></td>
			<td><?php echo $b['nama_region'] ?></td>
			<td><?php echo $b['provider'] ?></td>
			<td><?php echo $b['nohp'] ?></td>
			<td><?php echo $b['tgglaktif'] ?></td>
            <td>
				<a href="edit_aset.php?id=<?php echo $b['id_asset']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_aset.php?id=<?php echo $b['id_asset']; ?>" name="status" class="btn btn-plus"><?php if($b['status']=='1'){ echo "Non-Aktifkan"; }else if($b['status']=='0'){ echo"Aktifkan";}?></a>
				<a onclick="if(confirm('Apakah anda yakin ingin melepaskan kepemilikan asset ini ??')){ location.href='lepas_aset.php?id=<?php echo $b['id_asset']; ?>' }" class="btn btn-danger">Lepas Asset</a>
				<!--<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_aset.php?id=<?php echo $b['nik_salesman']; ?>' }" class="btn btn-danger">Hapus</a>-->
			</td>
		</tr>

		<?php
	}
	?>
	</tbody>
</table>
</div>
</div>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Aset Modis
				</div>
				<div class="modal-body">
					<form action="tambah_aset.php" method="post">
						<input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
						<div class="form-group">
						<label>No.IMEI</label>
							<input name="no_imei" type="text" class="form-control" placeholder="No.IMEI" onkeyup = "validAngka(this)" >
							<p class="help-block"> - Untuk melihat No.IMEI ketik : *#06# di layar HP Anda</p>
							<p class="help-block"> - Jika HP Anda Dual SIM, harap hanya masukan IMEI-1 saja. Terimakasih</p>
						</div>
						<div class="form-group">
							<label>Merk</label>
							<select class="form-control autocomplete" id="nama_merk" name="nama_merk" onchange="ChangesMerk()">
							<option value=" --- --- ">- Pilih Merk -</option>
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
							<input name="no_asset" type="text" class="form-control" placeholder="No.Asset" autocomplete="off" onkeyup = "validAngka(this)">
						</div>
                        <div class="form-group">
							<label>Tanggal Beli</label>
							<input name="tanggal_beli" type="text" class="form-control" id="tgl" autocomplete="off">
						</div>
                        <div class="form-group">
							<label>Serial Number</label>
							<input name="serial_number" type="text" class="form-control" placeholder="Serial Number" >
						</div>
						<div class="form-group">
							<label>NIK Karyawan</label>
							<input name="nik_karyawan" type="text" class="form-control" placeholder="NIK Karyawan" onkeyup = "validAngka(this)" >
						</div>

						<div class="form-group">
							<label>Kepemilikan</label>
							<select class="form-control" id="nama_kepemilikan" name="nama_kepemilikan">
							<option value=" ">- Pilih Kepemilikan -</option>
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
							</select>
						</div>
						<div class="form-group">
							<label>ID Device</label>
							<input id="id_device" name="id_device" type="text" class="form-control" placeholder="ID.Device" autocomplete="off" >
						</div>
						<div class="form-group">
							<label>Masa Berlaku</label>
							<input name="masa_berlaku" type="text" class="form-control" id="tgl_berlaku" autocomplete="off">
							<p class="help-block"> - Masa berlaku modis setelah tanda terima</p>
						</div>
					    <div class="form-group">
							<label>Depo</label>
							<select class="form-control autocomplete" id="id_depo" name="id_depo" onchange="ChangesValue()">
							<option value=" --- ">- Pilih Depo -</option>
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
                        <div class="form-group">
							<label>Keterangan</label>
							<input name="keterangan" type="text" class="form-control" placeholder="Keterangan Tambahan ..">
						</div>
                        <div class="form-group">
							<label>Provider</label>
							<select class="form-control" id="provider" name="provider" >
							<option value="">- Pilih Provider -</option>
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
							<input name="nohp" type="text" class="form-control" placeholder="No.HP">
						</div>
                        <div class="form-group">
							<label>Tanggal Aktif</label>
							<input name="tgglaktif" type="text" class="form-control" id="tgglaktif" autocomplete="off">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			//$("#tgl").datepicker($.datepicker.regional["id"]);
			$("#tgl").datepicker({dateFormat : 'dd-MM-yy'});
			$("#tanggal_terima").datepicker({dateFormat : 'dd-MM-yy'});
			$("#tgl_berlaku").datepicker({dateFormat : 'dd-mm-yy'});
			$("#tgglaktif").datepicker({dateFormat : 'dd-MM-yy'});
			$("#id_depo").autocomplete({maxLength:10});
			$("#nama_merk").autocomplete({maxLength:10});
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
	<script src="../datatables/jquery.dataTables.js"></script>
	<script src=../"datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
$(function () {
					$("#lookup1").dataTable({
		});
	$("#lookup2").dataTable({

		});
			});
</script>
