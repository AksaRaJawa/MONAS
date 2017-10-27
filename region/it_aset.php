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
    <script src="../assets/js/exporting.js" type="text/javascript"></script>
<div style="margin-top:10px;background-color:#39ac73;width:100%;display:block;float:left; color:#fff; font-family:Georgia; font-weight:bold; font-size:24px; text-align:center; margin-bottom:20px;">
SELAMAT DATANG : <?=$uu['nama_lengkap']?>  <br />
==================================<br />
TOOLS MONITORING PERANGKAT IT -- SNS
</div>
<div style="font-family:Lucida Sans;  font-weight:bold; font-size:16px;">
    Hak Akses Anda : USER REGION
    <h4><?=$uu['nama_region'] ?></h4>
</div>

<?php
$jumlah_record=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from perangkat_it WHERE nama_region = '".$uu['nama_region']."'", $param, $option);
$jum=sqlsrv_fetch_array($jumlah_record);

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
            options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
            }
         },
         title: {
            text: 'TOTAL PERANGKAT IT <?=$uu['nama_region']?> = <?=$jum['jumlah']?> unit'
         },

         xAxis: {
            categories: ['DEPO']
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
                 enabled: false,
                 rotation: -60,
                 //color: '#000000',
                 //connectorColor: 'red',
                 format: '<span style="font-size:9px">{series.name}</span>'
             }
             }
           },
          legend: {
                  enabled: true
              },
              series:
            [
          <?php
          $query=sqlsrv_query($kon, "select DISTINCT nama_depo from perangkat_it where nama_region = '".$uu['nama_region']."'", $param, $option);
          while($ambil=sqlsrv_fetch_array($query)){
          	$depo=$ambil['nama_depo'];
            $depox = strstr($depo," ");
          	$query_jumlah=sqlsrv_query($kon, "select count(*) AS jumlah from perangkat_it where nama_depo = '".$depo."' ", $param, $option);
          	while($data=sqlsrv_fetch_array($query_jumlah)){
          	   $jumlahx = $data['jumlah'];
          	  }
          	  ?>
	  {
		  name: '<?php echo $depox; ?>',
		  data: [<?php echo $jumlahx;?>],
      dataLabels: {
              enabled: true,
              rotation: -90,
              color: '#000000',
              align: 'right',
              format: '{series.name} : {point.y}',
              y: -50, // 10 pixels down from the top
              style: {
                  fontSize: '9px',
                  fontFamily: 'Verdana, sans-serif'
              }
          }
	  },
	  <?php } ?>

]
});
});
</script>
<div id="container" style="min-width: 400px; height: 400px; margin: 1 auto"></div>


<?php
include 'footer.php';

?>
