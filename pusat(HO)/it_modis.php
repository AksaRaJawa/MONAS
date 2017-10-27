<?php
include 'header.php';
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
<div style="margin-top:10px;background-color:#9370DB;width:100%;display:block;float:left; color:#FFF; font-family:Lucida Sans; font-weight:bold; font-size:24px; text-align:center; margin-bottom:20px;">
SELAMAT DATANG : <?=$uu['nama_lengkap']?> <br />
==================================<br />
MOBILE DISTRIBUTION (MODIS) TOOLS -- SNS
</div>
<div style="font-family:Lucida Sans;  font-weight:bold; font-size:16px;">
    Hak Akses Anda : HEAD OFFICE -- SNS
</div>
<?php
$jumlah_record=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset ", $param, $option);
$jum=sqlsrv_fetch_array($jumlah_record);
?>
<br/>

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
                    text: 'JUMLAH ASET MODIS SEMUA MERK : <?=$jum['jumlah']?> Unit'
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
                              return '<b>' + this.point.name + '</b> : ' + this.y ;
                            }
                        },
                        showInLegend: true
                    }
                },
                series: [{

                    type: 'pie',
                    name: 'Merk',
                    data: []
                }]
            }

            $.getJSON("datagraph_modis.php", function(json) {
                options.series[0].data = json;
                chart = new Highcharts.Chart(options);
            });

        });
</script>

<div class="panel-body" style="width:500px;">
         <div id ="mygraph" style="min-width: 900px; height: 400px;"></div>
    </div>


<?php
$jumlah_recordx=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan
		WHERE c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan NOT IN (select nik_karyawan from asset) ", $param, $option);
$jumx=sqlsrv_fetch_array($jumlah_recordx);
$jumlah_recordxs=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan
		WHERE c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan IN (select nik_karyawan from asset) ", $param, $option);
$jumxs=sqlsrv_fetch_array($jumlah_recordxs);
$jumlah_record1=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
        LEFT JOIN karyawan c ON a.nik_karyawan = c.nik_karyawan
		WHERE a.status_device ='Backup'  ", $param, $option);
$jum1=sqlsrv_fetch_array($jumlah_record1);
?>

<div>
<h4><span class="glyphicon glyphicon-book"></span>  SALESMAN YANG BELUM MEMAKAI ASET MODIS</h4>
</div>
<form action="tarikan_dashboard.php" method="post">
	<div></div>
    <div><input type="submit" value="Export ke Excel" class="btn btn-primary pull-right"></div>
</form>
<br/>
<br/>
<div class="form-panel" style="padding-bottom:25px;">
<table class="table table-hover table-nomargin table-bordered">
	 <thead style="color:white;background:#A9A9A9;">
	<tr>
		<th >REGION</th>
		<th class="text-center">SUDAH PAKAI MODIS</th>
		<th class="text-center">BELUM PAKAI MODIS</th>
		<th class="text-center">JUMLAH MODIS BACKUP</th>
    <th class="text-center">SALESMAN YG MEMILIKI 2 MODIS/LEBIH</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$brgx=sqlsrv_query($kon, "select DISTINCT nama_region from depo");
	    $nox=1;
	    while($bx=sqlsrv_fetch_array($brgx)){
		$bsqlx=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan
		WHERE a.nama_region = '".$bx['nama_region']."' AND c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan NOT IN (select nik_karyawan from asset)", $param, $option);
		$bsqlxs=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan
		WHERE a.nama_region = '".$bx['nama_region']."' AND c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan IN (select nik_karyawan from asset)", $param, $option);
		$bsqlx1=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
        LEFT JOIN karyawan c ON a.nik_karyawan = c.nik_karyawan
		WHERE a.nama_region = '".$bx['nama_region']."' AND a.status_device ='Backup' ", $param, $option);

		while($bxz=sqlsrv_fetch_array($bsqlx)AND$bxzs=sqlsrv_fetch_array($bsqlxs)AND$bxz1=sqlsrv_fetch_array($bsqlx1))
			{
		?>
		<tr  style="color:black" >
			<td>
			<a class="DetailDepo" data-toggle="modal" data-target="#detaildepo" data-whatever="<?=$bx['nama_region']?>"><?php echo $bx['nama_region'] ?></a>
			</td>
			<td class="text-center"><?php echo $bxzs['jumlah'] ?></td>
			<td class="text-center"><a class="DetailInfo" data-toggle="modal" data-target="#detailinfo" data-whatever="<?=$bx['nama_region']?>"><?php echo $bxz['jumlah'] ?></a></td>
      <td class="text-center"><?php echo $bxz1['jumlah'] ?></td>
      <td class="text-center"><a class="DetailDuplikasi" data-toggle="modal" data-target="#detailduplikasi" data-whatever="<?=$bx['nama_region']?>">Detail</a></td>
		</tr>
		<?php
	}
		}
	?>
	</tbody>
</table>
<div class="form-panel">
	<table class="table">
		<tr>
			<td style="width:105px" class="text-center">Total</td>
			<td style="width:140px" class="text-center"><?php echo $jumxs['jumlah']; ?></td>
			<td style="width:110px" class="text-center"><?php echo $jumx['jumlah']; ?></td>
			<td style="width:155px" class="text-center"><?php echo $jum1['jumlah']; ?></td>
      <td style="width:185px" class="text-center"></td>
		</tr>
	</table>
</div>
</div>

    <div id="detaildepo" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">

	    </div>
		</div>
	</div>

	<div id="detailinfo" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">

	    </div>
		</div>
	</div>

  <div id="detailduplikasi" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">

	    </div>
		</div>
	</div>

	<script>
	$('.DetailDepo').click(function(){
		var DetailDepo=$(this).attr('data-whatever');
		$.ajax({url:"detaildepo.php?DetailDepo="+DetailDepo, cache:false, success:function(result){
			$(".modal-content").html(result);
		}});
	});
    </script>

	<script>
	$('.DetailInfo').click(function(){
		var DetailInfo=$(this).attr('data-whatever');
		$.ajax({url:"detail.php?DetailInfo="+DetailInfo, cache:false, success:function(result){
			$(".modal-content").html(result);
		}});
	});
    </script>

    <script>
  	$('.DetailDuplikasi').click(function(){
  		var DetailDuplikasi=$(this).attr('data-whatever');
  		$.ajax({url:"detailduplikasi.php?DetailDuplikasi="+DetailDuplikasi, cache:false, success:function(result){
  			$(".modal-content").html(result);
  		}});
  	});
      </script>

<?php
include 'footer.php';

?>
