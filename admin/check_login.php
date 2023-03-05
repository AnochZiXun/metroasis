<?php 
session_start();
//檢查是否經過登入
if(!isset($_SESSION["userID"]) && (!$_SESSION["systemUsersRoleID"])){
	//header("Location: login.php");
	echo "<script>window.parent.location.href = 'login.php';  </script>";
}
?>