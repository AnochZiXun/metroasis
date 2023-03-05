<?
session_start();
include('_connMysql.php');

if(!isset($_SESSION["CustomerID"])){
	header("Location: login.php");
}

if(isset($_POST["updateBasketObj"])) {
	foreach($_POST["updateBasketObj"] as $key => $value) {
		//echo 'Your key is: '.$key.' and the value of the key is:'.$value.'<br>';
		updateBasketItemQuantity($key, $value);
	}
	//echo "update success";
}

function updateBasketItemQuantity($basketID,$quantity) {
	$update_order_basket_sql = "UPDATE `OrderBaskets` SET `Quantity`=$quantity WHERE BasketID='$basketID'";
	//echo "updated sql:".$update_order_basket_sql."<br>";
	$result = mysql_query($update_order_basket_sql);
	$updateRow = mysql_affected_rows();
	//echo "updated row:".$updateRow."<br>";
}

?>