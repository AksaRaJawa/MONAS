<?php 
include 'config.php';
$uname=$_GET['id'];
sqlsrv_query($kon, "delete from [user] where uname='$uname'");
header("location:user.php");

?>