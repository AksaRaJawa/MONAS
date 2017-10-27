<?php
include "config.php"; 
$id = $_GET['DetailDepo2'];
?>
<?php
$depo = sqlsrv_query($kon, "select * from depo where nama_region = '".$id."'");
$dp = sqlsrv_fetch_array($depo);

?>
                <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modis Ter-Validasi <?=$dp['nama_region']?>
				</div>
				<div class="modal-body">				
	<div class="form-panel" style="padding-bottom:25px;">
	<table class="table table-hover table-nomargin table-bordered">
	<thead style="color:white;background:#A9A9A9;">
	<tr>
		<th class="text-center">NO</th>
		<th>NAMA DEPO</th>
		<th>JUMLAH</th>
	</tr>
	</thead>
	<tbody>
	<?php 
		$brgx=sqlsrv_query($kon, "select * from depo 
		WHERE nama_region = '".$id."'");
	    $nox=1;
	    while($bx=sqlsrv_fetch_array($brgx)){
		$bsqlx=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset 	
		WHERE id_depo = '".$bx['id_depo']."' AND status_validasi ='1'", $param, $option);
		while($bxz=sqlsrv_fetch_array($bsqlx))
			{
		?>
		<tr  style="color:black" >
			<td class="text-center"><?php echo $nox++ ?></td>
			<td><?php echo $bx['nama_depo'] ?></td>
			<td>
			<?php echo $bxz['jumlah'] ?>
			<!--<a class="DetailInfo" data-toggle="modal" data-target="#detailinfo" data-whatever="">Lihat Detail</a>-->
			</td>
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