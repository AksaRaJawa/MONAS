<?php
include 'config.php';

$result = sqlsrv_query($kon,"SELECT nama_group FROM aset_group GROUP BY id_group", $param, $option);

$rows = array();
while($r = sqlsrv_fetch_array($result)) {
    $grup['data'][] = $r['nama_group'];
    array_push($rows,$grup);
}

print json_encode($rows, JSON_NUMERIC_CHECK);
sqlsrv_close($kon);
?>
