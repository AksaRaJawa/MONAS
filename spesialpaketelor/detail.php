<?php
include "config.php"; 
$id = $_GET['DetailInfo'];
?>
                <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Data Salesman yang Belum Pakai Modis <?=$id?>
				</div>
				<div class="modal-body">				
					<?php
						
						$jumlah_record1=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a 
								LEFT JOIN depo b ON a.id_depo = b.id_depo 
								LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan 
								WHERE a.status = '1' AND a.nama_region = '".$id."' AND c.butuh_modis = '1' AND a.nik_karyawan NOT IN (select nik_karyawan from asset) ", $param, $option);
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
		<th>NIK SALESMAN</th>
		<th>NAMA SALESMAN</th>
		<th>JABATAN</th>
		<th>DEPO</th>
	</tr>
	</thead>
	<tbody>
	<?php 
		$brgx=sqlsrv_query($kon, "select * from karyawan a 
		LEFT JOIN depo b ON a.id_depo = b.id_depo 
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan 
		WHERE a.status = '1' AND a.nama_region = '".$id."' AND c.butuh_modis = '1' AND a.nik_karyawan NOT IN (select nik_karyawan from asset) ORDER BY a.id_depo");
	    $nox=1;
	    while($bx=sqlsrv_fetch_array($brgx)){
		?>
		<tr  style="color:black" >
			<td class="text-center"><?php echo $nox++ ?></td>
			<td><?php echo $bx['nik_karyawan'] ?></td>
			<td><?php echo $bx['nama_karyawan'] ?></td>
			<td><?php echo $bx['nama_jabatan'] ?></td>
			<td><?php echo $bx['nama_depo'] ?></td>
		</tr>		
		<?php 
	}
	?>
	</tbody>
    </table>
	</div>
			    </div>