<?php 
include('_connMysql.php');

$activityId = $_REQUEST["activityId"];
$strSql = "SELECT VehicleOccupancy FROM ActivityNight WHERE ActivityNightID = '$activityId'";
$rec = mysql_query($strSql);
$row = mysql_fetch_assoc($rec);
echo $row['VehicleOccupancy'];
?>