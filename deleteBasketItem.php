<?
session_start();
include('_connMysql.php');

if(!isset($_SESSION["CustomerID"])){
	header("Location: login.php");
}
if(isset($_POST["CustomerID"])) {
	$barCode = $_POST["BarCode"];
	$customerID = $_POST["CustomerID"];
	
	$delete_order_basket_sql = "DELETE FROM `OrderBaskets` WHERE CustomerID='$customerID'";
	if(isset($barCode)) {
		$delete_order_basket_sql .= "AND BarCode='$barCode'";
	}
	
	$result = mysql_query($delete_order_basket_sql);
	$deleteRow = mysql_affected_rows();
	
	
	echo $deleteRow;
}



?>