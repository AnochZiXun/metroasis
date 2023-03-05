<?
include('_connMysql.php');

if(isset($_GET["message"])) {
	
	$message = $_GET["message"];
	echo $message."<br>";
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
	echo $key."<br>";
	echo $iv."<br>";
	//$decryptedTradeInfo = aes_decrypt($message, $key, $iv);	
	//echo $decryptedTradeInfo;
	
	//recordPaymentInformation($decryptedTradeInfo);
}

if(isset($_POST["Status"])) {
	$returnStatus = $_POST["Status"];
	$returnMerchantID = $_POST["MerchantID"];
	$returnTradeInfo = $_POST["TradeInfo"];
	$returnTradeSha = $_POST["TradeSha"];
	
	if($returnStatus == 'SUCCESS') {
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
		
		$decryptedTradeInfoStr = aes_decrypt($returnTradeInfo, $key, $iv);
		

		
		$decryptedTradeInfoObj = json_decode($decryptedTradeInfoStr);
		
		$fileName = $decryptedTradeInfoObj->{'Result'}->{'TradeNo'};
		$myfile = fopen("paymentLog/$fileName.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $decryptedTradeInfoStr);
		fclose($myfile);
		
		recordPaymentInformation($decryptedTradeInfoObj);
		$orderId = $decryptedTradeInfoObj->{'Result'}->{'MerchantOrderNo'};
		$payType = getPayTypeCode($decryptedTradeInfoObj->{'Result'}->{'PaymentType'});
		$payDate = $decryptedTradeInfoObj->{'Result'}->{'PayTime'};
		$update_order_sql = "UPDATE `Orders` SET `PayDate`='$payDate',`PayType`='$payType',`OrderStatus`='2' WHERE OrderID='$orderId'";
		
		/*
		$myfile = fopen("paymentLog/update_order.sql", "w") or die("Unable to open file!");
		$txt = $update_order_sql;
		fwrite($myfile, $txt);
		fclose($myfile);	
		*/		
		
		mysql_query($update_order_sql);
		

		// TODO update order state
	
	} else {
		// TODO
	}
	
}

function getPayTypeCode($payType) {
	if($payType == 'P2GEACC') {
		return '1';
	}
	if($payType == 'CREDIT') {
		return '3';
	}
	if($payType == 'WEBATM') {
		return '4';
	}
	if($payType == 'VACC') {
		return '2';
	}
	if($payType == 'CVS') {
		return '5';
	}
	return;
}

function recordPaymentInformation($decryptedTradeInfo) {
	$result = $decryptedTradeInfo->{'Result'};
	
	$Status = $decryptedTradeInfo->{'Status'};
	$Message = $decryptedTradeInfo->{'Message'};
	$MerchantID = $result->{'MerchantID'};
	$Amt = isset($result->{'Amt'}) ? $result->{'Amt'} : 0;
	$TradeNo = $result->{'TradeNo'};
	$MerchantOrderNo = $result->{'MerchantOrderNo'};
	$PaymentType = $result->{'PaymentType'};
	$PayTime = $result->{'PayTime'};
	$IP = $result->{'IP'};
	$EscrowBank = $result->{'EscrowBank'};
	$RespondCode = $result->{'RespondCode'};
	$Auth = $result->{'Auth'};
	$AuthDate = $result->{'AuthDate'};
	$AuthTime = $result->{'AuthTime'};
	$AuthBank = $result->{'AuthBank'};
	$Card6No = $result->{'Card6No'};
	$Card4No = $result->{'Card4No'};
	$Exp = $result->{'Exp'};
	$Inst = isset($result->{'Inst'}) ? $result->{'Inst'} : 0;
	$InstFirst = isset($result->{'InstFirst'}) ? $result->{'InstFirst'} : 0;
	$InstEach = isset($result->{'InstEach'}) ? $result->{'InstEach'} : 0;
	$ECI = $result->{'ECI'};
	$PayBankCode = $result->{'PayBankCode'};
	$PayerAccount5Code = $result->{'PayerAccount5Code'};
	$PayStore = $result->{'PayStore'};
	$CodeNo = $result->{'CodeNo'};
	
	$insert_sql = "INSERT INTO `PaymentRecord` (`ID`, `Status`, `Message`, `MerchantID`, `Amt`, `TradeNo`, `MerchantOrderNo`, `PaymentType`, `PayTime`, `IP`, `EscrowBank`, `RespondCode`, `Auth`, `AuthDate`, `AuthTime`, `AuthBank`, `Card6No`, `Card4No`, `Exp`, `Inst`, `InstFirst`, `InstEach`, `ECI`, `PayBankCode`, `PayerAccount5Code`, `PayStore`, `CodeNo`) 
				   VALUES (NULL, '$Status', '$Message', '$MerchantID', $Amt, '$TradeNo', '$MerchantOrderNo', '$PaymentType', '$PayTime', '$IP', '$EscrowBank', '$RespondCode', '$Auth', '$AuthDate', '$AuthTime', '$AuthBank', '$Card6No', '$Card4No', '$Exp', $Inst, $InstFirst, $InstEach, '$ECI', '$PayBankCode', '$PayerAccount5Code', '$PayStore', '$CodeNo')";
	/*
	$myfile = fopen("paymentLog/insert.sql", "w") or die("Unable to open file!");
	$txt = $insert_sql;
	fwrite($myfile, $txt);
	fclose($myfile);
	*/
	mysql_query($insert_sql);		   
}

function aes_decrypt($aes_str, $key, $iv) {
	$aes_str = str_replace('','+',$aes_str);
	echo $aes_str."<br>";
	echo hex2bin($aes_str)."<br>";
	echo mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, hex2bin($aes_str), MCRYPT_MODE_CBC, $iv)."<br>";
	$str = strippadding(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, hex2bin($aes_str), MCRYPT_MODE_CBC, $iv));
	return $str;
}

function strippadding($string) {
	$slast = ord(substr($string, -1));
	$slastc = chr($slast);
	$pcheck = substr($string, -$slast);
	if(preg_match("/$slastc{".$slast."}/", $string)) {
		$string = substr($string, 0, strlen($string) - $slast);
		return $string;
	} else {
		return false;
	}
}

?>