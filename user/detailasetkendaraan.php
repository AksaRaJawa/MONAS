<?php
include "config.php";
$id = $_GET['Detail'];
$dtail = sqlsrv_query($kon, "select * from kendaraan_asetkendaraan where no_aset_kendaraan = '".$id."' ");
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
				<h4 class="modal-title">DETAIL KENDARAAN
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
        			<td> Merk & Tipe </td><td><?php echo $b['nama_merk']?> --- <?php echo $b['nama_tipe']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Tahun Kendaraan </td><td><?php echo $b['tahun_kendaraan']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> No. Aset Box </td><td><?php echo $b['no_aset_peripheral']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Cap. Date </td><td><?php echo $b['cap_date'] ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Umur Aset </td><td>5 Tahun</td>
        		</tr>
            <tr style="color:black" >
        			<td> Umur Aset Berakhir </td><td><?php echo $exdate ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Acquis Value </td><td><?php echo $acquis_value?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Tahun Pemakaian </td><td><?php echo $pemakaian->format('%y Tahun - %m Bulan - %d Hari')?></td>
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
