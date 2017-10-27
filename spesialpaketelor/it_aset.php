<?php
include 'header_aset.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from admin where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);

?>
    <script src="../assets/js/Chart.js"></script>
    <script src="../assets/js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../assets/js/highcharts.js" type="text/javascript"></script>
    <script src="../assets/js/highcharts-3d.js" type="text/javascript"></script>
    <script src="../assets/js/exporting.js" type="text/javascript"></script>
<div style="margin-top:10px;background-color:#39ac73;width:100%;display:block;float:left; color:#fff; font-family:Georgia; font-weight:bold; font-size:24px; text-align:center; margin-bottom:20px;">
SELAMAT DATANG : <?=$uu['uname']?> <br />
==================================<br />
TOOLS MONITORING PERANGKAT IT -- SNS
</div>
<div style="font-family:Lucida Sans;  font-weight:bold; font-size:16px;">
    Hak Akses Anda : ADMINISTRATOR
</div>
<?php
$jumlah_record=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from perangkat_it ", $param, $option);
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
            alpha: 5,
            beta: 19,
            depth: 43,
            viewDistance: 25
            }
         },
         title: {
            text: 'TOTAL PERANGKAT IT = <?=$jum['jumlah']?> unit'
         },

         xAxis: {
            categories: ['REGION']
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
$query=sqlsrv_query($kon, "select DISTINCT nama_region from perangkat_it", $param, $option);
while($ambil=sqlsrv_fetch_array($query)){
	$region=$ambil['nama_region'];
  $regionx = strstr($region, " ");
	$query_jumlah=sqlsrv_query($kon, "select count(*) AS jumlah from perangkat_it where nama_region = '".$region."' ", $param, $option);
	while($data=sqlsrv_fetch_array($query_jumlah)){
	   $jumlahx = $data['jumlah'];
	  }
	  ?>
	  {
		  name: '<?php echo $regionx; ?>',
		  data: [<?php echo $jumlahx;?>],
      dataLabels: {
              enabled: true,
              rotation: -90,
              color: '#000000',
              align: 'right',
              format: '{series.name} : {point.y}',
              y: -40, // 10 pixels down from the top
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

<script type="text/javascript">
        $(document).ready(function() {
            var options = {
              credits: {
                        enabled: false
                    },
                chart: {
                  type : 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    },
                    renderTo: 'mygraph',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'STATUS PERANGKAT'
                },
                tooltip: {
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' %';
                    }
                },
                plotOptions: {
                   pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth : 35,
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: 'red',
                            formatter: function()
                            {
                              return '<b>' + this.point.name + '</b>: ' + this.y ;
                            }
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Status Perangkat IT',
                    data: []
                }]
            }

            $.getJSON("datagraph.php", function(json) {
                options.series[0].data = json;
                chart = new Highcharts.Chart(options);
            });

        });
</script>

<div class="panel-body" style="width:500px; margin:5px 0 10px 15px; padding: 15px; position: absolute; right: -5px;">
         <div id ="mygraph" style="min-width: 300px; height: 300px;"></div>
    </div>

    <script type="text/javascript">
            $(document).ready(function() {
                var options = {
                  credits: {
                            enabled: false
                        },
                    chart: {
                      options3d: {
                          enabled: true,
                          alpha: 45,
                          beta: 0
                      },
                        renderTo: 'mygraph2',
                        plotBackgroundColor: null,
                        plotBorderWidth: 0,
                        plotShadow: false
                    },
                    title: {
                        text: 'STATUS JUAL PERANGKAT'
                    },
                    tooltip: {
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' %';
                        }
                    },
                    plotOptions: {
                       pie: {
                         depth : 35,
                          dataLabels: {
                               enabled: true,
                               distance: -50,
                               style: {
                                   fontWeight: 'bold',
                                   color: 'red'
                               },
                               formatter: function()
                               {
                                 return '</b> ' + this.y ;
                               }
                           },
                           startAngle: -90,
                           endAngle: 90,
                           center: ['50%', '75%']
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Status Jual Perangkat',
                        innerSize: '50%',
                        data: []
                    }]
                }

                $.getJSON("datagraph2.php", function(json) {
                    options.series[0].data = json;
                    chart = new Highcharts.Chart(options);
                });

            });
    </script>
    <div class="panel-body" style="width:500px; margin:5px 0 10px 15px; padding: 15px; position: absolute;">
             <div id ="mygraph2" style="min-width: 400px; height: 300px;"></div>
        </div>
<?php
include 'footer.php';

?>
