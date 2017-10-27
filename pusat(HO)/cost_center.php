<?php include 'header_aset.php';	?>
<?php
$usern = sqlsrv_query($kon, "select * from admin where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Cost Center</h3>


<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Tambah</button>
<div class="col-md-10">
<button onclick="document.location='import_cost_center.php'" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Import dari Excel</button>

<button onclick="document.location='lap_cost_center.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>
</div>

<br/>
<br/>
<br/>
    <div style="overflow-y:auto">
	<div style="width:1100px">
		<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
		<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">ID Cost Center</th>
		<th class="col-md-0">Person Responsible</th>
		<th class="col-md-0">Desc CC</th>
		<th class="col-md-0">Nama Depo</th>
		<th class="col-md-0">Nama RO</th>
		<th class="col-md-0">Kepala Akun</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody style="overflow-x:auto">
	<?php

		$brg=sqlsrv_query($kon, "select * from cost_center ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
			$status = $b['status'];
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['id_cc'] ?></td>
			<td><?php echo $b['person_responsible'] ?></td>
			<td><?php echo $b['desc_cc'] ?></td>
			<td><?php echo $b['nama_depo'] ?></td>
			<td><?php echo $b['nama_ro'] ?></td>
			<td><?php echo $b['kepala_akun'] ?></td>
            <td>
				<a href="edit_cost_center.php?id=<?php echo $b['id_cc']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_cost_center.php?id=<?php echo $b['id_cc']; ?>" name="status" class="btn btn-plus"><?php if($status=='1'){ echo "Non-Aktifkan"; }else if($status=='0'){ echo "Aktifkan";}?></a>
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
				<h4 class="modal-title">Tambah Cost Center
				</div>
				<div class="modal-body">
					<form action="tambah_cost_center.php" method="post">
						<div class="form-group">
						    <label>ID Cost Center</label>
							<input name="id_cc" type="text" class="form-control" placeholder = "ID Cost Center" >
						</div>
						<div class="form-group">
						<label>Person Responsible</label>
							<input name="person_responsible" type="text" class="form-control" placeholder = "Person Responsible"  >
						</div>
						<div class="form-group">
							<label>Desc Cost Center</label>
							<input name="desc_cc" type="text" class="form-control" placeholder="Desc Cost Center">
						</div>
						<div class="form-group">
							<label>Nama Depo</label>
							<input name="nama_depo" type="text" class="form-control" placeholder="Nama Depo">
						</div>
						<div class="form-group">
							<label>Nama RO</label>
							<input name="nama_ro" type="text" class="form-control" placeholder="Nama RO">
						</div>
						<div class="form-group">
							<label>Kepala Akun</label>
							<input name="kepala_akun" type="text" class="form-control" placeholder="Kepala Akun">
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