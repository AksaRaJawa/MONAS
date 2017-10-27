<?php
include "config.php"; 
$id = $_GET['DetailDepo'];
?>
<?php
$depo = sqlsrv_query($kon, "select * from depo where nama_region = '".$id."'");
$dp = sqlsrv_fetch_array($depo);

?>
                <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">LIST DEPO <?=$dp['nama_region']?>
				</div>
				<div class="modal-body">				
	<div class="form-panel" style="padding-bottom:25px;">
	<table class="table table-hover table-nomargin table-bordered">
	<thead style="color:white;background:#A9A9A9;">
	<tr>
		<th>NAMA DEPO</th>
		<th>SUDAH PAKAI</th>
		<th>BELUM PAKAI </th>
		<th>MODIS BACKUP</th>
		<th>TOTAL MODIS</th>
	</tr>
	</thead>
	<tbody>
	<?php 
		$brgx=sqlsrv_query($kon, "select * from depo 
		WHERE nama_region = '".$id."'");
	    $nox=1;
	    while($bx=sqlsrv_fetch_array($brgx)){
		$bsqlx=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a 
		LEFT JOIN depo b ON a.id_depo = b.id_depo 
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan 
		WHERE a.id_depo = '".$bx['id_depo']."' AND c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan NOT IN (select nik_karyawan from asset)", $param, $option);
		$bsqlxs=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a 
		LEFT JOIN depo b ON a.id_depo = b.id_depo 
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan 
		WHERE a.id_depo = '".$bx['id_depo']."' AND c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan IN (select nik_karyawan from asset)", $param, $option);
		$bsqlx1=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset a 
		LEFT JOIN depo b ON a.id_depo = b.id_depo
        LEFT JOIN karyawan c ON a.nik_karyawan = c.nik_karyawan		
		WHERE a.id_depo = '".$bx['id_depo']."' AND a.status_device ='Backup' ", $param, $option);
		$brgt=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset 	
		WHERE id_depo = '".$bx['id_depo']."'");
		while($bxz=sqlsrv_fetch_array($bsqlx)AND$bxzs=sqlsrv_fetch_array($bsqlxs)AND$bxz1=sqlsrv_fetch_array($bsqlx1)AND$brt=sqlsrv_fetch_array($brgt))
			{
		?>
		<tr  style="color:black" >
			<td><?php echo $bx['nama_depo'] ?></td>
			<td><?php echo $bxzs['jumlah'] ?></td>
			<td><?php echo $bxz['jumlah'] ?></td>
			<td><?php echo $bxz1['jumlah'] ?></td>
			<td><?php echo $brt['jumlah'] ?></td>
		</tr>		
		<?php 
	}
		}
	?>
	</tbody>
    </table>
	</div>
			    </div>
				<div id="detailinfo" class="modal fade" aria-hidden="true" tabindex="-1" role="dialog"> 
				<div class="modal-dialog">
					<div class="modal-content">			
								
					</div>
					</div>
				</div>
	<script>
	$('.DetailInfo').click(function(){
		var DetailInfo=$(this).attr('data-whatever');
		$.ajax({url:"detail.php?DetailInfo="+DetailInfo, cache:false, success:function(result){
			$(".modal-content").html(result);
		}});
	});
</script>