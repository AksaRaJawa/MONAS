<?php
include "config.php";
$id = $_GET['DetailGambar'];
$dtail = sqlsrv_query($kon, "select * from perangkat_it where no_aset = '".$id."'");
$b = sqlsrv_fetch_array($dtail);
date_default_timezone_set('Asia/Jakarta');
$cap_date = $b['cap_date'];
$acquis_value = number_format($b['acquis_val']);
$exdate = date('d-M-y', strtotime('+4 years', strtotime($cap_date)));
$cap =  new DateTime($cap_date);
$skrg = new DateTime("now");
$pemakaian = $cap->diff($skrg);
?>
        <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">DETAIL PERANGKAT
				</div>
				<div class="modal-body">
      	<div class="form-panel" style="padding-bottom:25px;">
          <table class="table table-hover table-nomargin table-nobordered">
        	<thead style="color:white;background:#A9A9A9;">
        	</thead>
        	<tbody>
        		<tr>
        			<td></td><td><?php echo "<img src='gambar_aset_it/".$b['foto']."' width:'30px' height:'30px'/>"?></td>
        		</tr>
            <tr style="color:blue" >
        			<td> No Aset </td><td><?php echo $id?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Aset Description </td><td><?php echo $b['aset_desc']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Merk & Tipe </td><td><?php echo $b['nama_merk']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Cap. Date </td><td><?php echo $b['cap_date'] ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Umur Aset </td><td>4 Tahun</td>
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
        			<td> Status Aset </td><td><?php if($b['status_aset']=='1'){ echo "AKTIF"; } elseif($b['status_aset']=='0'){ echo "NON-AKTIF"; }?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Status Perangkat </td><td><?php echo $b['status_perangkat']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Status Jual </td><td><?php echo $b['status_jual']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Harga Jual </td><td><?php echo $b['harga_jual']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Barcode </td><td><?php echo $b['barcode']?></td>
        		</tr>
        	</tbody>
            </table>
            <div class="modal-footer">
  						<a href="scrap_perangkat.php?no_aset=<?php echo $id; ?>" name="status" class="btn btn-success"><?php if($b['status']=='1'){ echo "Scrapping"; }else if($b['status']=='0'){ echo "Un-Scrapping";}?></a>
  					</div>
      	</div>
        </div>
