<?php
include "config.php";
$id = $_GET['Detail'];
$dtail = sqlsrv_query($kon, "select * from asuransi_kendaraan where no_polisi = '".$id."'");
$b = sqlsrv_fetch_array($dtail);
date_default_timezone_set('Asia/Jakarta');
?>
        <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">DETAIL KENDARAAN
				</div>
				<div class="modal-body">
      	<div class="form-panel" style="padding-bottom:25px;">
          <table class="table table-hover table-nomargin table-nobordered">
        	<thead style="color:white;background:#A9A9A9;">
        	</thead>
        	<tbody>
            <tr style="color:black" >
        			<td> No. Polisi </td><td><?php echo $id?></td>
        		</tr>
            <tr style="color:black" >
        			<td> No. Rangka </td><td><?php echo $b['no_rangka']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> No. Mesin </td><td><?php echo $b['no_mesin']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Merk & Tipe </td><td><?php echo $b['nama_merk'] ?> & <?php echo $b['nama_tipe'] ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Warna </td><td><?php echo $b['warna_kendaraan'] ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Tahun </td><td><?php echo $b['tahun_kendaraan'] ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> No. STNK </td><td><?php echo $b['no_stnk'] ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Tanggal STNK </td><td style="color:red"><?php echo $b['tanggal_stnk'] ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Status </td><td><?php echo $b['status_kendaraan'] ?></td>
        		</tr>
                  	</tbody>
            </table>
            <div class="modal-footer">
  						<!--<a href="scrap_perangkat.php?no_aset=<?php echo $id; ?>" name="status" class="btn btn-success"><?php if($b['status']=='1'){ echo "Scrapping"; }else if($b['status']=='0'){ echo "Un-Scrapping";}?></a>-->
  					</div>
      	</div>
        </div>
