<?php
include 'header_aset.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);

?>
    <script src="../assets/js/Chart.js"></script>
    <script src="../assets/js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../assets/js/highcharts.js" type="text/javascript"></script>
    <script src="../assets/js/highcharts-3d.js" type="text/javascript"></script>
    <script src="../assets/js/exporting.js" type="text/javascript"></script>
<div style="margin-top:10px;background-color:#39ac73;width:100%;display:block;float:left; color:#fff; font-family:Georgia; font-weight:bold; font-size:24px; text-align:center; margin-bottom:20px;">
SELAMAT DATANG : <?=$uu['nama_lengkap']?>  <br />
==================================<br />
TOOLS MONITORING PERANGKAT IT -- SNS
</div>
<div style="font-family:Lucida Sans;  font-weight:bold; font-size:16px;">
    Hak Akses Anda : USER DEPO
    <h4><?=$uu['nama_depo'] ?></h4>
</div>

<?php
$jumlah_record=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from perangkat_it WHERE nama_depo = '".$uu['nama_depo']."'", $param, $option);
$jum=sqlsrv_fetch_array($jumlah_record);
?>

<?php
$jum_op=sqlsrv_query($kon, "SELECT COUNT(no_aset) AS jumlah from perangkat_it WHERE nama_depo = '".$uu['nama_depo']."' AND status_perangkat = 'Operasional' ", $param, $option);
$jum_bek=sqlsrv_query($kon, "SELECT COUNT(no_aset) AS jumlah from perangkat_it WHERE nama_depo = '".$uu['nama_depo']."' AND status_perangkat = 'Backup' ", $param, $option);
$jum_mas=sqlsrv_query($kon, "SELECT COUNT(no_aset) AS jumlah from perangkat_it WHERE nama_depo = '".$uu['nama_depo']."' AND status_jual = 'Masih Asset' ", $param, $option);
$jum_ju=sqlsrv_query($kon, "SELECT COUNT(no_aset) AS jumlah from perangkat_it WHERE nama_depo = '".$uu['nama_depo']."' AND status_jual = 'Siap dijual' ", $param, $option);
$jumlah_op=sqlsrv_fetch_array($jum_op);
$jumlah_bek=sqlsrv_fetch_array($jum_bek);
$jumlah_mas=sqlsrv_fetch_array($jum_mas);
$jumlah_ju=sqlsrv_fetch_array($jum_ju);
?>

<script type="text/javascript">
var chart1;
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
		  credits: {
                enabled: false
            },
         chart: {
            renderTo: 'container',
            type: 'column',
         },
         title: {
            text: 'TOTAL PERANGKAT IT <?=$uu['nama_depo']?> = <?=$jum['jumlah']?> unit'
         },
         subtitle: {
            text: 'Operasional + Backup = <?=$jum['jumlah']?> ----- Masih Asset + Siap Jual = <?=$jum['jumlah']?>'
         },
         xAxis: {
            categories: ['Operasional : <?php echo $jumlah_op['jumlah']?>', 'Backup : <?php echo $jumlah_bek['jumlah']?>', 'Masih Asset : <?php echo $jumlah_mas['jumlah']?>', 'Siap Jual : <?php echo $jumlah_ju['jumlah']?>'],

         },
         yAxis: {
            title: {
               text: 'JUMLAH PERANGKAT'
            }
         },
        tooltip: {
              //headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}',
              shared: false
          },
          plotOptions: {
            series: {
            dataLabels: {
                enabled: true,
                rotation: -60,
                //color: '#000000',
                //connectorColor: 'red',
                format: '<span style="font-size:7px">{series.name}</span>'
            }
            }
          },
         legend: {
                 enabled: true
             },
              series:
            [
                <?php
                $query=sqlsrv_query($kon, "select DISTINCT aset_group from perangkat_it where nama_depo = '".$uu['nama_depo']."'", $param, $option);
                while($ambil=sqlsrv_fetch_array($query)){
                $grup=$ambil['aset_group'];
                $query_jumlaha=sqlsrv_query($kon, "select count(*) AS jumlah from perangkat_it where aset_group = '".$grup."' AND status_perangkat = 'Operasional' AND nama_depo = '".$uu['nama_depo']."' ", $param, $option);
                $query_jumlahb=sqlsrv_query($kon, "select count(*) AS jumlah from perangkat_it where aset_group = '".$grup."' AND status_perangkat = 'Backup' AND nama_depo = '".$uu['nama_depo']."' ", $param, $option);
                $query_jumlahx=sqlsrv_query($kon, "select count(*) AS jumlah from perangkat_it where aset_group = '".$grup."' AND status_jual = 'Masih Asset' AND nama_depo = '".$uu['nama_depo']."' ", $param, $option);
                $query_jumlahy=sqlsrv_query($kon, "select count(*) AS jumlah from perangkat_it where aset_group = '".$grup."' AND status_jual = 'Siap dijual' AND nama_depo = '".$uu['nama_depo']."' ", $param, $option);
                while($dataa=sqlsrv_fetch_array($query_jumlaha)AND$datab=sqlsrv_fetch_array($query_jumlahb)AND$datax=sqlsrv_fetch_array($query_jumlahx)AND$datay=sqlsrv_fetch_array($query_jumlahy)){
                $jumlaha = $dataa['jumlah'];
                $jumlahb = $datab['jumlah'];
                $jumlahx = $datax['jumlah'];
                $jumlahy = $datay['jumlah'];
            	  }
            	  ?>
            	  {
            		  name: '<?php echo $grup;?>',
            		  data: [<?php echo $jumlaha; ?>,<?php echo $jumlahb; ?>,<?php echo $jumlahx; ?>,<?php echo $jumlahy; ?>]
            	  },

            	  <?php } ?>
]
});
});
</script>
<div id="container" style="min-width: 200px; height: 400px;"></div>


<?php
include 'footer.php';

?>
