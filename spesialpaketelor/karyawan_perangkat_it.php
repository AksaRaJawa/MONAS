<?php include 'header_aset.php';	?>
<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data karyawan</h3>


<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Tambah</button>
<div class="col-md-10">
<button onclick="document.location='import_karyawan_perangkat_it.php'" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Import dari Excel</button>
</div>

<br/>
<br/>
<br/>
    <div style="overflow-y:auto">
	<div style="width:1500px">
<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;">
	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">NIK</th>
		<th class="col-md-0">NAMA</th>
		<th class="col-md-0">JABATAN</th>
		<th class="col-md-0">ID PC</th>
		<th class="col-md-0">ID CC</th>
		<th class="col-md-0">NAMA DEPO</th>
		<th class="col-md-0">REGION</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody style="overflow-x:auto">
	<?php

		$brg=sqlsrv_query($kon, "select * from karyawan_perangkat_it ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
			$statuskar = $b['status'];
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['nik_karyawan'] ?></td>
			<td><?php echo $b['nama_karyawan'] ?></td>
			<td><?php echo $b['nama_jabatan'] ?></td>
			<td><?php echo $b['id_pc'] ?></td>
			<td><?php echo $b['id_cc'] ?></td>
			<td><?php echo $b['nama_depo'] ?></td>
			<td><?php echo $b['nama_region'] ?></td>
            <td>
				<a href="edit_karyawan_perangkat_it.php?id=<?php echo $b['nik_karyawan']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_karyawan_perangkat_it.php?id=<?php echo $b['nik_karyawan']; ?>" name="status" class="btn btn-plus"><?php if($statuskar=='1'){ echo "Non-Aktifkan"; }else if($statuskar=='0'){ echo "Aktifkan";}?></a>
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
				<h4 class="modal-title">Tambah Karyawan
				</div>
				<div class="modal-body">
					<form action="tambah_karyawan_perangkat_it.php" method="post">
						<div class="form-group">
						    <label>NIK Karyawan</label>
							<input name="nik_karyawan" type="text" class="form-control" maxlength="8" placeholder = "NIK" onkeyup = "validAngka(this)">
						</div>
                        <div class="form-group">
							<label>Nama Karyawan</label>
							<input name="nama_karyawan" type="text" class="form-control" placeholder = "Nama" >
						</div>
						<div class="form-group">
							<label>Jabatan</label>
							<input name="nama_jabatan" type="text" class="form-control" placeholder = "Jabatan" >
						</div>
						<div class="form-group">
						    <label>Profit Center ID</label>
							<input name="id_pc" type="text" class="form-control" maxlength="6" placeholder = "Profit Center ID" onkeyup = "validAngka(this)">
						</div>
						<div class="form-group">
						    <label>Cost Center ID</label>
							<input name="id_cc" type="text" class="form-control" maxlength="10" placeholder = "Cost Center ID" onkeyup = "validAngka(this)">
						</div>
						<div class="form-group">
							<label>Depo</label>
							<input name="nama_depo" type="text" class="form-control" placeholder = "Nama Depo" >
						</div>
						<div class="form-group">
							<label>Region</label>
							<input name="nama_region" type="text" class="form-control" placeholder = "Nama region" >
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
