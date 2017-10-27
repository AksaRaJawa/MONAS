<?php
include "config.php";
$id = $_GET['Detail'];
$dtail = sqlsrv_query($kon, "select a.*, b.no_polisi, b.nama_merk, b.nama_tipe, b.biaya_admin, b.nik_user, c.nama_karyawan from asuransi_biaya a LEFT JOIN asuransi_kendaraan b ON a.no_rangka = b.no_rangka LEFT JOIN karyawan_perangkat_it c ON b.nik_user = c.nik_karyawan where a.no_rangka = '".$id."'");
$b = sqlsrv_fetch_array($dtail);
$a = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '1'");
$ax = sqlsrv_fetch_array($a);
$c = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '2'");
$cx = sqlsrv_fetch_array($c);
$d = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '3'");
$dx = sqlsrv_fetch_array($d);
$e = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '4'");
$ex = sqlsrv_fetch_array($e);
$f = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '5'");
$fx = sqlsrv_fetch_array($f);
$g = sqlsrv_query($kon, "select jumlah_biaya, persen_biaya from asuransi_biaya where no_rangka = '$id' AND id_jenis_biaya = '6'");
$gx = sqlsrv_fetch_array($g);
date_default_timezone_set('Asia/Jakarta');
//====== BIAYA ========//
$jumlah_biaya_comprehensive = $ax['jumlah_biaya'];
$jumlah_biaya_gempa_bumi = $cx['jumlah_biaya'];
$jumlah_biaya_banjir_angin_topan = $dx['jumlah_biaya'];
$jumlah_biaya_huru_hara = $ex['jumlah_biaya'];
$jumlah_pihak_ke_3 = $fx['jumlah_biaya'];
$jumlah_terorisme_sabotase = $gx['jumlah_biaya'];
//====== PERSEN ========//
$persen_biaya_comprehensive = $ax['persen_biaya'];
$persen_biaya_gempa_bumi = $cx['persen_biaya'];
$persen_biaya_banjir_angin_topan = $dx['persen_biaya'];
$persen_biaya_huru_hara = $ex['persen_biaya'];
$persen_pihak_ke_3 = $fx['persen_biaya'];
$persen_terorisme_sabotase = $gx['persen_biaya'];
//====== HITUNG =======//
$comprehensive = $jumlah_biaya_comprehensive*$persen_biaya_comprehensive/100;
$gempa_bumi = $jumlah_biaya_gempa_bumi*$persen_biaya_gempa_bumi/100;
$banjir_angin_topan = $jumlah_biaya_banjir_angin_topan*$persen_biaya_banjir_angin_topan/100;
$huru_hara = $jumlah_biaya_huru_hara*$persen_biaya_huru_hara/100;
$pihak_ke_3 = $jumlah_pihak_ke_3*$persen_pihak_ke_3/100;
$terorisme_sabotase = $jumlah_terorisme_sabotase*$persen_terorisme_sabotase/100;
$totalx = $comprehensive+$gempa_bumi+$banjir_angin_topan+$huru_hara+$pihak_ke_3+$terorisme_sabotase;
$diskonx = $totalx*25/100;
$total_premi = number_format($totalx+$b['biaya_admin']-$diskonx);
$diskon = number_format($totalx*25/100);
$total = number_format($comprehensive+$gempa_bumi+$banjir_angin_topan+$huru_hara+$pihak_ke_3+$terorisme_sabotase);
?>
        <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">DETAIL BIAYA ASURANSI
				</div>
				<div class="modal-body">
      	<div class="form-panel" style="padding-bottom:25px;">
          <table class="table table-hover table-nomargin table-nobordered">
        	<thead style="color:white;background:#A9A9A9;">
        	</thead>
        	<tbody>
            <tr style="color:black" >
        			<td> No. Rangka </td><td><?php echo $id?></td>
        		</tr>
            <tr style="color:black" >
        			<td> No. Polisi </td><td><?php echo $b['no_polisi']?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Merk & Tipe </td><td><?php echo $b['nama_merk'] ?> & <?php echo $b['nama_tipe'] ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> User </td><td><?php echo $b['nik_user'] ?> : <?php echo $b['nama_karyawan'] ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Comprehesive </td><td><?php echo number_format($jumlah_biaya_comprehensive) ?> x <?php echo $persen_biaya_comprehensive ?>% = <?php echo number_format($comprehensive)?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Gempa Bumi </td><td><?php echo number_format($jumlah_biaya_gempa_bumi) ?> x <?php echo $persen_biaya_gempa_bumi ?>% = <?php echo number_format($gempa_bumi) ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Banjir & Angin Topan </td><td><?php echo number_format($jumlah_biaya_banjir_angin_topan) ?> x <?php echo $persen_biaya_banjir_angin_topan ?>% = <?php echo number_format($banjir_angin_topan); ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Huru Hara </td><td><?php echo number_format($jumlah_biaya_huru_hara) ?> x <?php echo $persen_biaya_huru_hara ?>% = <?php echo number_format($huru_hara) ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Pihak Ke-3 </td><td><?php echo number_format($jumlah_pihak_ke_3) ?> x <?php echo $persen_pihak_ke_3 ?>% = <?php echo number_format($pihak_ke_3); ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Terorisme & Sabotase </td><td><?php echo $jumlah_terorisme_sabotase ?> x <?php echo $persen_terorisme_sabotase ?>% = <?php echo number_format($terorisme_sabotase); ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> TOTAL </td><td><?php echo $total ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Biaya Admin </td><td><?php echo number_format($b['biaya_admin']) ?></td>
        		</tr>
            <tr style="color:black" >
        			<td> Diskon 25% </td><td><?php echo $diskon ?></td>
        		</tr>
            <tr style="color:black" >
              <td> TOTAL PREMI </td><td style="color:red" ><?php echo $total_premi ?></td>
            </tr>
            </tbody>
            </table>
            <div class="modal-footer">
  						<!--<a href="scrap_perangkat.php?no_aset=<?php echo $id; ?>" name="status" class="btn btn-success"><?php if($b['status']=='1'){ echo "Scrapping"; }else if($b['status']=='0'){ echo "Un-Scrapping";}?></a>-->
  					</div>
      	</div>
        </div>
