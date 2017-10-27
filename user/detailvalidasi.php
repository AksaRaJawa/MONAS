<?php
include "config.php"; 
$id = $_GET['DetailInfo2'];
?>
<?php
$depo = sqlsrv_query($kon, "select * from depo where id_depo = '".$id."'");
$dp = sqlsrv_fetch_array($depo);

?>
                <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Total Modis <?=$dp['nama_depo']?>
				</div>
				<div class="modal-body">				
					<?php
						
						$jumlah_record1=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset where id_depo = '".$id."' ", $param, $option);
						$jum1=sqlsrv_fetch_array($jumlah_record1);
					?>
					<div class="col-md-12">
					<table class="col-md-2">
							<tr>
								<td>Total :</td>		
								<td><?php echo $jum1['jumlah']; ?></td>
							</tr>
						</table>
					</div>
	<div class="form-panel" style="padding-bottom:25px;">
	<table class="table table-hover table-nomargin table-bordered">
	<thead style="color:white;background:#A9A9A9;">
	<tr>
		<th class="text-center">NO</th>
		<th>NO IMEI</th>
		<th>MERK</th>
		<th>TIPE</th>
		<th>NIK SALESMAN</th>
		<th>NAMA SALESMAN</th>
	</tr>
	</thead>
	<tbody>
	<?php 
		$brgx=sqlsrv_query($kon, "select * from asset a 
		LEFT JOIN karyawan b ON a.nik_karyawan = b.nik_karyawan 
		WHERE a.id_depo = '".$id."'");
	    $nox=1;
	    while($bx=sqlsrv_fetch_array($brgx)){

		?>
		<tr  style="color:black" >
			<td class="text-center"><?php echo $nox++ ?></td>
			<td><?php echo $bx['no_imei'] ?></td>
			<td><?php echo $bx['nama_merk'] ?></td>
			<td><?php echo $bx['nama_tipe'] ?></td>
			<td><?php echo $bx['nik_karyawan'] ?></td>
			<td><?php echo $bx['nama_karyawan'] ?></td>
		</tr>		
		<?php 
	}
	?>
	</tbody>
    </table>
	</div>
			    </div>