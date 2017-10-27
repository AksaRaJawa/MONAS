<?php include 'header.php';	?>
<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Salesman</h3>


<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Tambah</button>
<div class="col-md-10">
<button onclick="document.location='import_karyawan.php'" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Import dari Excel</button>
</div>

<br/>
<br/>
<br/>
    <div style="overflow-y:auto">
	<div style="width:1300px">
<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;">
	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">NIK</th>
		<th class="col-md-0">NAMA</th>
		<th class="col-md-0">JABATAN</th>
		<th class="col-md-0">KODE DEPO</th>
		<th class="col-md-0">NAMA DEPO</th>
		<th class="col-md-0">REGION</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody style="overflow-x:auto">
	<?php

		$brg=sqlsrv_query($kon, "select a.*, b.nama_depo from karyawan a LEFT JOIN depo b ON a.id_depo = b.id_depo ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
			$statuskar = $b['status'];
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['nik_karyawan'] ?></td>
			<td><?php echo $b['nama_karyawan'] ?></td>
			<td><?php echo $b['nama_jabatan'] ?></td>
			<td><?php echo $b['id_depo'] ?></td>
			<td><?php echo $b['nama_depo'] ?></td>
			<td><?php echo $b['nama_region'] ?></td>
            <td>
				<!--<a href="det_karyawan.php?id=<?php echo $b['nik_karyawan']; ?>" class="btn btn-info">Detail</a>-->
				<a href="edit_karyawan.php?id=<?php echo $b['nik_karyawan']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_karyawan.php?id=<?php echo $b['nik_karyawan']; ?>" name="status" class="btn btn-plus"><?php if($statuskar=='1'){ echo "Non-Aktifkan"; }else if($statuskar=='0'){ echo "Aktifkan";}?></a>
				<!--<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_karyawan.php?id=<?php echo $b['nik_karyawan']; ?>' }" class="btn btn-danger">Hapus</a>-->
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
				<h4 class="modal-title">Tambah Salesman
				</div>
				<div class="modal-body">
					<form action="tambah_karyawan.php" method="post">
						<div class="form-group">
						    <label>NIK Salesman</label>
							<input name="nik_karyawan" type="text" class="form-control" placeholder = "NIK" onkeyup = "validAngka(this)">
						</div>
                        <div class="form-group">
							<label>NAMA Salesman</label>
							<input name="nama_karyawan" type="text" class="form-control" placeholder = "Nama" >
						</div>
						<div class="form-group">
							<label>Jabatan</label>
							<select class="form-control autocomplete" id="nama_jabatan" name="nama_jabatan">
							<option value=" ">- Pilih Jabatan -</option>
								<?php
								$dp=sqlsrv_query($kon, "select * from jabatan where status = '1'");
								while($rw=sqlsrv_fetch_array($dp)){
									echo'<option value="'.$rw['nama_jabatan'].'">'.$rw['nama_jabatan'].'</option> ';
								}
								?>
							</select>
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
			$("#tgl").datepicker({dateFormat : 'dd/MM/yy'});
			$("#id_depo").autocomplete({minLength:3});
			$("#nama_jabatan").autocomplete({maxLength:10});
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
