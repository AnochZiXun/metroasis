<?php 
include_once("_connMysql.php");
include_once("check_login.php");

$activityId = $_REQUEST["activityId"];
$strSql = "SELECT ActivityID FROM ActivityEnrollment WHERE ActivityID = '$activityId'";
$rec = mysql_query($strSql);
if(mysql_num_rows($rec) == 0) {
    echo false;
} else {
    echo true;
}
?>