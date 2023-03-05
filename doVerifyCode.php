<?php 
include('_connMysql.php');

$verifyCode = $_REQUEST["verifyCode"];
$enrollId = $_REQUEST["enrollId"];
$strSql = "SELECT ActivityID FROM ActivityEnrollment WHERE VerifyCode = '$verifyCode' AND EnrollID = '$enrollId'";
$rec = mysql_query($strSql);
if(mysql_num_rows($rec) == 0) {
    echo false;
} else {
    $update = "UPDATE ActivityEnrollment SET EnrollStatus = '1' WHERE VerifyCode = '$verifyCode' AND EnrollID = '$enrollId'";
	mysql_query($update);
    echo true;
}
?>