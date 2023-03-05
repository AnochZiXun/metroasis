<?
    include('_connMysql.php');
    include('check_login.php');
	$customerID = $_SESSION["CustomerID"];
	
	if($_POST['action'] == 'add') {
		//echo "<script>alert('create order');</script>";
		$receiverName = $_POST['receiverName']; 
		$receiverMobile = $_POST['receiverMobile'];
		$receiverEMail = $_POST['receiverEMail'];
		$receiverAddress = $_POST['receiverAddress'];
		$saleAmount = $_POST['saleAmount'];
		$deliverStatus = '3';
		$orderStatus = '1';
		$receiverMemo = Empty($_POST['receiverMemo']) ? 'NULL' : "'".$_POST['receiverMemo']."'";
		$receiverWay = $_POST['receiverWay'];
		$receiverStore = 'NULL';
		if($receiverWay == 2) {
		  $receiverStore = "'".$_POST['receiverStore']."'";
		}
		$receiverLandline = Empty($_POST['receiverLandline']) ? 'NULL' : "'".$_POST['receiverLandline']."'";

		$sysDateYM = date("Ym");
		$RecPreOrderNo = mysql_query("SELECT OrderNo FROM Orders WHERE OrderNo like '$sysDateYM%' ORDER BY OrderNo DESC");
		if(mysql_num_rows($RecPreOrderNo) > 0) {
		$preOrderNo = mysql_result($RecPreOrderNo, 0);
		$orderNo = $preOrderNo + 1;
		} else {
		$orderNo = $sysDateYM.'0001';
		}

		$discountAmount = 600;
		$expressFee = 100;
		$summary = $saleAmount - $discountAmount + $expressFee;
		$insert = "INSERT INTO Orders(OrderNo, CustomerID, SaleAmount, DiscountAmount, ExpressFee, TotalAmount, ReceiverAddress, 
									ReceiverName, ReceiverMobile, ReceiverEMail, ReceiverMemo, ReceiverWay, ReceiverStore, ReceiverLandline, OrderStatus, DeliverStatus)
				  Values('$orderNo', '$customerID', $saleAmount, $discountAmount, $expressFee, $summary, '$receiverAddress', 
						  '$receiverName', '$receiverMobile', '$receiverEMail', $receiverMemo, '$receiverWay', $receiverStore, $receiverLandline, '$orderStatus', '$deliverStatus')";
		mysql_query($insert);

		$orderId = mysql_insert_id();
		if(isset($orderId)) {
			$recKey = mysql_query("SELECT ConfigContent FROM `RefCommonConfig` WHERE `ConfigName` = 'HASH_KEY'");
			if(mysql_num_rows($recKey) > 0) {
				$key = mysql_result($recKey, 0);
			}
			$recIV = mysql_query("SELECT ConfigContent FROM `RefCommonConfig` WHERE `ConfigName` = 'HASH_IV'");
			if(mysql_num_rows($recIV) > 0) {
				$iv = mysql_result($recIV, 0);
			}		
			$recMerchantID = mysql_query("SELECT ConfigContent FROM `RefCommonConfig` WHERE `ConfigName` = 'MerchantID'");
			if(mysql_num_rows($recMerchantID) > 0) {
				$merchantID = mysql_result($recMerchantID, 0);
			}			
			$pay2go_version = '1.0';
			$tradeInfo = getEncryptedTradeInfo($orderId, $key, $iv, $merchantID, $pay2go_version, $summary);
			$sha256TradeInfo = getSHA256EncryptedTradeInfo($tradeInfo, $key, $iv);
			//echo "<script>console.log('$tradeInfo');</script>";
			//echo "<script>console.log('$sha256TradeInfo');</script>";			
		} else {
			echo "<script>alert('建立訂單失敗!');</script>";
		}

	}
	
	function getEncryptedTradeInfo($orderId, $key, $iv, $merchantID, $pay2go_version, $amt) {
		//echo "<script>alert('encrypting...');</script>";
		$langType = 'zh-tw';
		$timeStamp = time();
		$tradeLimit = '60';
		$langType = 'zh-tw';
		$langType = 'zh-tw';
		$data = array(
			'MerchantID' => $merchantID,
			'TimeStamp' => $timeStamp,
			'Version' => $pay2go_version,
			'LangType' => $langType,
			'MerchantOrderNo' => $orderId,
			'Amt' => $amt,
			'ItemDesc' => 'UnitTest',
			//'TradeLimit' => $tradeLimit,
			'CustomerURL' => '',
			'ClientBackURL' => '',
			'CREDIT' => 1,
			'InstFlag' => 3,
			'WEBATM' => 1,
			'VACC' => 1,
			'CVS' => 1
		);

		$encrypt_message = create_mpg_aes_encrypt($data, $key, $iv);
		return $encrypt_message;
	}
	
	function create_mpg_aes_encrypt($data, $key, $iv){
		$return_str='';
		if(!empty($data)){
			$return_str = http_build_query($data);
			//echo "<script>console.log('$return_str');</script>";
		}
		return trim(bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, addpadding($return_str), MCRYPT_MODE_CBC, $iv)));
	}
	
	function getSHA256EncryptedTradeInfo($tradeInfo, $key, $iv) {
		$return_str = "HashKey=$key&$tradeInfo&HashIV=$iv";
		//echo "<script>console.log('$return_str');</script>";
		return strtoupper(hash("sha256", $return_str));
	}
	
	function addpadding($string, $blocksize = 32){
		$len = strlen($string);
		$pad = $blocksize - ($len % $blocksize);
		$string .= str_repeat(chr($pad), $pad);
		return $string;
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/crypto-js/crypto-js.js"></script>
	<script type="text/javascript" src="js/convert-js/convert_bin_hex.js"></script>
</head>
<body>
	<form id="form" action="https://cpayment.pay2go.com/MPG/mpg_gateway" method="POST">
		<input type="hidden" name="MerchantID" value="<?echo $merchantID?>"/>
		<input type="hidden" name="Version" value="<?echo $pay2go_version?>"/>
		<input type="hidden" name="TradeInfo" value="<?echo $tradeInfo?>"/>
		<input type="hidden" name="TradeSha" value="<?echo $sha256TradeInfo?>"/>
	</form>
	
	<!-- <form id="form" action="https://cpayment.pay2go.com/MPG/mpg_gateway" method="POST"/> -->
	<!-- <form id="form" action="https://payment.pay2go.com/MPG/mpg_gateway" method="POST"/> -->
    <!-- easing plugin ( optional ) -->
    <script src="js-top/easing.js" type="text/javascript"></script>
    <!-- UItoTop plugin -->
    <script src="js-top/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- Starting the plugin -->
    <script type="text/javascript">
        $(document).ready(function() {  
			pay2gogogo();
        });

		function pay2gogogo() {
			$('#form').submit();
		}
    </script>
</body>
</html>