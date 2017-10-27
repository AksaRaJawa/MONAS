<?php include 'header.php'; ?>

<?php
$usern = sqlsrv_query($kon, "select * from admin where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Depo & Region</h3>


<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Tambah</button>
<div class="col-md-10">
<button onclick="document.location='import_depo.php'" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Import dari Excel</button>

</div>

<br/>
<br/>
<br/>

<div style="overflow-y:auto">
<div style="width:1000px">
<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;">
	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">Kode Depo</th>
		<th class="col-md-0">Nama Depo</th>
		<th class="col-md-0">Nama Region</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody style="overflow-x:auto">
	<?php

		$brg=sqlsrv_query($kon, "select * from depo ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){

		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['id_depo'] ?></td>
			<td><?php echo $b['nama_depo'] ?></td>
			<td><?php echo $b['nama_region'] ?></td>
			<td>
				<!--<a href="det_depo.php?id=<?php echo $b['id_depo']; ?>" class="btn btn-info">Detail</a>-->
				<a href="edit_depo.php?id=<?php echo $b['id_depo']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_depo.php?id=<?php echo $b['id_depo']; ?>" name="status" class="btn btn-plus"><?php if($b['status']=='1'){ echo "Non-Aktifkan"; }else if($b['status']=='0'){ echo"Aktifkan";}?></a>
				<!--<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_depo.php?id=<?php echo $b['id_depo']; ?>' }" class="btn btn-danger">Hapus</a>-->
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
				<h4 class="modal-title">Tambah Depo Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tambah_depo.php" method="post">
				    <div class="form-group">
						<label>Kode Depo</label>
						<input name="id_depo" type="text" class="form-control" placeholder="Kode Depo .." onkeyup="validAngka(this)">
					</div>
					<div class="form-group">
						<label>Nama Depo</label>
						<input name="nama_depo" type="text" class="form-control" placeholder="Nama Depo ..">
					</div>
					<div class="form-group">
						<label>Nama Region</label>
						<input name="nama_region" type="text" class="form-control" placeholder="Nama Region ..">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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

<?php
include 'footer.php';
?>
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
