<?

if(isset($_POST["MerchantID"],$_POST["Version"],$_POST["TradeInfo"],$_POST["TradeSha"])) {
	echo $_POST["MerchantID"]."<br>";
	echo $_POST["Version"]."<br>";
	echo json_encode($_POST["TradeInfo"])."<br>";
	echo json_encode($_POST["TradeSha"])."<br>";
}

?>