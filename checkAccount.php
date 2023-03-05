<?php 
include('_connMysql.php');

if(isset($_GET["EMail"])) {	
	$email = $_GET["EMail"];
	$sql = "select * from Customers where EMail = '$email'";
	$msg = "此帳號已經被使用！請重新輸入！";
}

if(isset($_GET["IdentityNo"])) {
	$IdentityNo = $_GET["IdentityNo"];		
	$sql = "select * from Customers where IdentityNo = '$IdentityNo'";	
	$msg = "此身分證字號已經被註冊！請重新輸入！";
}

$record = mysql_query($sql);
$totalRecords = mysql_num_rows($record);

if ($totalRecords > 0) {
	echo $msg;
}

?>