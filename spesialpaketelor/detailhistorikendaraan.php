<?php
include "config.php";
$id = $_GET['Detail'];
$dtail = sqlsrv_query($kon, "select * from histori_kendaraan where no_aset_kendaraan = '".$id."' ");
$b = sqlsrv_fetch_array($dtail);
date_default_timezone_set('Asia/Jakarta');
$cap_date = $b['cap_date'];
$acquis_value = number_format($b['acquis_value']);
$exdate = date('d-M-y', strtotime('+5 years', strtotime($cap_date)));
$cap =  new DateTime($cap_date);
$skrg = new DateTime("now");
$pemakaian = $cap->diff($skrg);
?>
        <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">DETAIL HISTORI ASET KENDARAAN
				</div>
				<div class="modal-body">
      	<div class="form-panel" style="padding-bottom:25px;">
          <table class="table table-hover table-nomargin table-nobordered">
        	<thead style="color:white;background:#A9A9A9;">
        	</thead>
        	<tbody>
        		<tr>
        			<td><?php echo "<img src='gambar_aset_kendaraan/".$b['gambar_lama']."' width:'30px' height:'30px'/>"?></td><td><?php echo "<img src='gambar_aset_kendaraan/".$b['gambar_baru']."' width:'30px' height:'30px'/>"?></td>
        		</tr>
            <tr style="color:blue" >
        			<td> No Aset </td><td><?php echo $id?></td>
        		</tr>
            <tr style="color:black" >
        			<td> User Lama </td><td><?php echo $b['nik_lama']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> User Baru </td><td><?php echo $b['nik_baru']?></td>
        		</tr>
        	</tbody>
            </table>
            <div class="modal-footer">
  						<!--<a href="scrap_aset_kendaraan.php?no_aset_kendaraan=<?php echo $id; ?>" name="status" class="btn btn-success"><?php if($b['status']=='1'){ echo "Scrapping"; }else if($b['status']=='0'){ echo "Un-Scrapping";}?></a>-->
  					</div>
      	</div>
        </div>
