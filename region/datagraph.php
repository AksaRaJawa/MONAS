<?php
include 'config.php';
?>


<?php
$result = sqlsrv_query($kon,"SELECT status_perangkat, COUNT(*) AS jumlah FROM perangkat_it WHERE nama_region = '".$uu['nama_region']."' GROUP BY status_perangkat", $param, $option);

$rows = array();
while($r = sqlsrv_fetch_array($result)) {
    $row[0] = $r[0];
    $row[1] = $r[1];
    array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);
sqlsrv_close($kon);
?>
