<?php
include 'config.php';

$result = sqlsrv_query($kon,"SELECT nama_merk, COUNT(*) AS jumlah FROM asset GROUP BY nama_merk", $param, $option);

$rows = array();
while($r = sqlsrv_fetch_array($result)) {
    $row[0] = $r[0];
    $row[1] = $r[1];
    array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);
sqlsrv_close($kon);
?>
