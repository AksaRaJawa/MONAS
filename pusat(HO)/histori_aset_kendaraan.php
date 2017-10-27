<?php include 'header_kendaraan.php';	?>
<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Histori Aset Kendaraan</h3>

<div class="col-md-10">
<button onclick="document.location='lap_history_kendaraan.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>
</div>

<br/>
<br/>
<br/>
    <div style="overflow:auto">
    <div style="width:1800px">
			<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
			<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-1">Tanggal </th>
		<th class="col-md-1">Aktifitas</th>
		<th class="col-md-1">No. Aset</th>
		<th class="col-md-1">Merk & Tipe</th>
		<th class="col-md-1">No. Box Lama</th>
    <th class="col-md-1">No. Box Baru</th>
    <th class="col-md-1">User Lama</th>
    <th class="col-md-1">User Baru</th>
		<th class="col-md-1">Cost Center ID</th>
		<th class="col-md-1">Profit Center ID</th>
		<th class="col-md-1">Username</th>
    <th class="col-md-1">Level Akses</th>
		<th class="col-md-1">Waktu</th>
	</tr>
</thead>
	<tbody>
	<?php

		$brg=sqlsrv_query($kon, "select a.*, c.nama_karyawan, c.nama_depo AS nama_depox, c.nama_region AS nama_regionx from histori_kendaraan a LEFT JOIN karyawan_perangkat_it c ON a.nik_baru = c.nik_karyawan");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
		$nama = $b['nama_karyawan'];
		?>
		<tr>

			<td><?php echo $b['tanggal_perubahan'] ?></td>
			<td><?php echo $b['aktivitas'] ?></td>
      <td class="text-center">
				<a class="DetailHistoriKendaraan" data-toggle="modal" data-target="#detailhistorikendaraan" data-whatever="<?=$b['no_aset_kendaraan']?>"><?php echo $b['no_aset_kendaraan']?></a>
			</td>
      <td><?php echo $b['nama_merk'] ?> --- <?php echo $b['nama_tipe'] ?></td>
      <td><?php echo $b['no_peripheral_lama'] ?></td>
      <td><?php echo $b['no_peripheral_baru'] ?></td>
      <td><?php echo $b['nik_lama'] ?></td>
      <td><?php echo $b['nik_baru'] ?></td>
			<td><?php echo $b['cost_center_id'] ?></td>
      <td><?php echo $b['profit_center_id'] ?></td>
			<td>
				<a href=""  data-toggle="tooltip" title="<?php echo  $b['nama_depox'];?> == <?php echo  $b['nama_regionx'];?>" data-placement="top"><?php echo $b['uname'] ?></a>
			</td>
      <td><?php echo $b['akses'] ?></td>
      <td><?php echo $b['waktu'] ?></td>
		</tr>

		<?php
	}
	?>
</tbody>
</table>
</div>
</div>
<div id="detailhistorikendaraan" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">

  </div>
</div>
</div>
<?php include 'footer.php'; ?>

<script>
$('.DetailHistoriKendaraan').click(function(){
var Detail=$(this).attr('data-whatever');
$.ajax({url:"detailhistorikendaraan.php?Detail="+Detail, cache:false, success:function(result){
  $(".modal-content").html(result);
}});
});
</script>
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

	<?php include 'footer.php'; ?>
