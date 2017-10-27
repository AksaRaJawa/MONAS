<?php
include 'header.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);

?>
<div style="margin-top:10px;background-color:#9370DB;width:100%;display:block;float:left; color:#FFF; font-family:Lucida Sans; font-weight:bold; font-size:24px; text-align:center; margin-bottom:20px;">
SELAMAT DATANG : <?=$uu['nama_lengkap']?> <br />
==================================<br />
MOBILE DISTRIBUTION (MODIS) TOOLS -- SNS
</div>
<div style="font-family:Lucida Sans;  font-weight:bold; font-size:16px;">
    Hak Akses Anda : USER REGION
	<h4><?=$uu['nama_region'] ?></h4>
</div>
<?php
$jumlah_recordx=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan
		WHERE a.nama_region = '".$uu['nama_region']."' AND c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan NOT IN (select nik_karyawan from asset) ", $param, $option);
$jumx=sqlsrv_fetch_array($jumlah_recordx);
$jumlah_recordxs=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan
		WHERE a.nama_region = '".$uu['nama_region']."' AND c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan IN (select nik_karyawan from asset) ", $param, $option);
$jumxs=sqlsrv_fetch_array($jumlah_recordxs);
$jumlah_record1=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
        LEFT JOIN karyawan c ON a.nik_karyawan = c.nik_karyawan
		WHERE a.nama_region = '".$uu['nama_region']."' AND a.status_device ='Backup'  ", $param, $option);
$jum1=sqlsrv_fetch_array($jumlah_record1);
$jumlah_record2=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset
		WHERE nama_region = '".$uu['nama_region']."' ", $param, $option);
$jum2=sqlsrv_fetch_array($jumlah_record2);
?>
<div>
<h4><span class="glyphicon glyphicon-book"></span>  SALESMAN YANG BELUM MEMAKAI ASET MODIS <?=$uu['nama_region']?></h4>
</div>
<div class="form-panel" style="padding-bottom:25px;">
<table class="table table-hover table-nomargin table-bordered">
	 <thead style="color:white;background:#A9A9A9;">
	<tr>
		<th class="text-center">NAMA DEPO</th>
		<th class="text-center">SUDAH PAKAI MODIS</th>
		<th class="text-center">BELUM PAKAI MODIS</th>
		<th class="text-center">JUMLAH MODIS BACKUP</th>
		<th class="text-center">TOTAL MODIS</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$brgx=sqlsrv_query($kon, "select * from depo where nama_region = '".$uu['nama_region']."'");
	    $nox=1;
	    while($bx=sqlsrv_fetch_array($brgx)){
		$bsqlx=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan
		WHERE a.id_depo = '".$bx['id_depo']."' AND c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan NOT IN (select nik_karyawan from asset)", $param, $option);
		$bsqlxs=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from karyawan a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan
		WHERE a.id_depo = '".$bx['id_depo']."' AND c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan IN (select nik_karyawan from asset)", $param, $option);
		$bsqlx1=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
        LEFT JOIN karyawan c ON a.nik_karyawan = c.nik_karyawan
		WHERE a.id_depo = '".$bx['id_depo']."' AND a.status_device ='Backup' ", $param, $option);
		$brgt=sqlsrv_query($kon, "SELECT COUNT(*) AS jumlah from asset
		WHERE id_depo = '".$bx['id_depo']."'");
		while($bxz=sqlsrv_fetch_array($bsqlx)AND$bxzs=sqlsrv_fetch_array($bsqlxs)AND$bxz1=sqlsrv_fetch_array($bsqlx1)AND$brt=sqlsrv_fetch_array($brgt))
			{
		?>
		<tr  style="color:black" >
			<td><?php echo $bx['nama_depo'] ?></td>
			<td class="text-center"><?php echo $bxzs['jumlah'] ?>
			<a class="DetailInfox" data-toggle="modal" data-target="#detailinfox" data-whatever="<?=$bx['id_depo']?>">Lihat Detail</a>
			</td>
			<td class="text-center">
			<?php echo $bxz['jumlah'] ?>
			<a class="DetailInfo" data-toggle="modal" data-target="#detailinfo" data-whatever="<?=$bx['id_depo']?>">Lihat Detail</a>
			</td class="text-center">
			<td class="text-center"><?php echo $bxz1['jumlah'] ?>
			<a class="DetailInfo1" data-toggle="modal" data-target="#detailinfo1" data-whatever="<?=$bx['id_depo']?>">Lihat Detail</a>
			</td>
			<td class="text-center"><?php echo $brt['jumlah'] ?>
			<a class="DetailInfo2" data-toggle="modal" data-target="#detailinfo2" data-whatever="<?=$bx['id_depo']?>">Lihat Detail</a>
			</td>
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
			<td style="width:185px" class="text-center">Total</td>
			<td style="width:170px" class="text-center"><?php echo $jumxs['jumlah']; ?></td>
			<td style="width:170px" class="text-center"><?php echo $jumx['jumlah']; ?></td>
			<td style="width:195px" class="text-center"><?php echo $jum1['jumlah']; ?></td>
			<td style="width:215px" class="text-center"><?php echo $jum2['jumlah']; ?></td>
		</tr>
	</table>
</div>
<div id="detailinfox" class="modal fade" aria-hidden="true" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			    </div>
		</div>
</div>
<div id="detailinfo" class="modal fade" aria-hidden="true" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			    </div>
		</div>
</div>
<div id="detailinfo1" class="modal fade" aria-hidden="true" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			    </div>
		</div>
</div>
<div id="detailinfo2" class="modal fade" aria-hidden="true" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			    </div>
		</div>
</div>
</div>
<script>
	$('.DetailInfox').click(function(){
		var DetailInfox=$(this).attr('data-whatever');
		$.ajax({url:"detailsdh.php?DetailInfox="+DetailInfox, cache:false, success:function(result){
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
	$('.DetailInfo1').click(function(){
		var DetailInfo1=$(this).attr('data-whatever');
		$.ajax({url:"detailbackup.php?DetailInfo1="+DetailInfo1, cache:false, success:function(result){
			$(".modal-content").html(result);
		}});
	});
</script>
<script>
	$('.DetailInfo2').click(function(){
		var DetailInfo2=$(this).attr('data-whatever');
		$.ajax({url:"detailvalidasi.php?DetailInfo2="+DetailInfo2, cache:false, success:function(result){
			$(".modal-content").html(result);
		}});
	});
</script>
<?php
include 'footer.php';

?>
