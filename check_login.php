<?php 
session_start();
//檢查是否經過登入
if(!isset($_SESSION["CustomerID"])){
	header("Location: login.php");
}
?>