<?php include 'header.php'; ?>


<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Depo & Region</h3>


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
