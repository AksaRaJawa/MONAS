<?php
include "config.php";
$id = $_GET['DetailDuplikasi'];
?>
<?php
$depo = sqlsrv_query($kon, "select * from depo where nama_region = '".$id."'");
$dp = sqlsrv_fetch_array($depo);

?>
                <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Salesman Kepemilikan 2 Modis/Lebih <?=$id?>
				</div>
				<div class="modal-body">
	<div class="form-panel" style="padding-bottom:25px;">
	<table class="table table-hover table-nomargin table-bordered">
	<thead style="color:white;background:#A9A9A9;">
	<tr>
		<th class="text-center">NO</th>
		<th>NIK</th>
    <th>Nama Salesman</th>
    <th>DEPO</th>
		<th>JUMLAH MODIS</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$bsqlx=sqlsrv_query($kon, "SELECT
    	a.nik_karyawan, c.nama_karyawan, b.nama_depo, COUNT(a.nik_karyawan) AS jumlah_modis
    FROM
    	asset a
    LEFT JOIN depo b ON a.id_depo = b.id_depo
    LEFT JOIN karyawan c ON a.nik_karyawan = c.nik_karyawan
		WHERE a.nik_karyawan !=' ' AND a.nama_region = '".$id."'
    GROUP BY
    a.nik_karyawan, c.nama_karyawan, b.nama_depo
    HAVING
	  COUNT (a.nik_karyawan) > 1", $param, $option);
    $nox=1;
		while($bxz=sqlsrv_fetch_array($bsqlx))
			{
		?>
		<tr  style="color:black" >
			<td class="text-center"><?php echo $nox++ ?></td>
			<td><?php echo $bxz['nik_karyawan'] ?></td>
			<td><?php echo $bxz['nama_karyawan'] ?></td>
      <td><?php echo $bxz['nama_depo'] ?></td>
      <td><?php echo $bxz['jumlah_modis'] ?></td>
		</tr>
		<?php
	}

	?>
	</tbody>
    </table>
	</div>
			    </div>
