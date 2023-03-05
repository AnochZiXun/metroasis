<?php
include_once("_connMysql.php");
include_once("check_login.php");
include_once("_function.php");
switch ($_POST["action"]) {
    case "updatePromotionalActivity":
		$activityName = $_POST["activityName"];
		$area = $_POST["area"];
		$validFlag = $_POST["validFlag"];
		for($i = 0 ; $i < count($area) ; $i ++){
			$flag = "0";
			for($j = 0 ; $j < count($validFlag) ; $j ++){
				if($validFlag[$j] == $area[$i]){
					$flag = "1";
					break;
				}
			}
			$sql_updatePromotionalActivity = "INSERT INTO PromotionalActivity (ActivityName, Area, ValidFlag) VALUES ('$activityName[$i]', '$area[$i]', '$flag') ON DUPLICATE KEY UPDATE ActivityName = '$activityName[$i]', ValidFlag = '$flag' ;";
			//echo $sql_updatePromotionalActivity;
			mysql_query($sql_updatePromotionalActivity);
		}
    	break;
    case "updateEcPlatform":
        $additionalAction = $_POST["additionalAction"];
    	$ctlID = $_POST["ctlID"];
    	$ckName = $_POST["ckName"];
    	$validFlag = $_POST["validFlag"];
        $ctlID2 = $_POST["ctlID2"];
        $ckName2 = $_POST["ckName2"];
        $validFlag2 = $_POST["validFlag2"];
        switch($additionalAction){
            case "updateProduct":
                #更新範本
                $jsonStr = "[";
                for($i = 0 ; $i < count($ctlID) ; $i ++){
                    $flag = "0";
                    for($j = 0 ; $j < count($validFlag) ; $j ++){
                        if($validFlag[$j] == $ctlID[$i]){
                            $flag = "1";
                            break;
                        }
                    }
                    if ($jsonStr == "["){
                        $jsonStr .= '{"name":"'.$ctlID[$i].'","value":"'.$ckName[$i].'","validFlag":"'.$flag.'"}';
                    }else{
                        $jsonStr .= ',{"name":"'.$ctlID[$i].'","value":"'.$ckName[$i].'","validFlag":"'.$flag.'"}';
                    }
                }
                $jsonStr .= "]";
                $sql_updateEcplatform = "UPDATE RefCommonConfig SET ConfigContent = '$jsonStr' WHERE ConfigName = 'ECPlatform'";
                mysql_query($sql_updateEcplatform);
                #更新商品
                $sql_queryProduct = "SELECT ProductID, ECPlatform FROM Products";
                $rec_queryProduct = mysql_query($sql_queryProduct);
                if($rec_queryProduct){
                    while($row_Product = mysql_fetch_assoc($rec_queryProduct)){
                        $ProductId = $row_Product["ProductID"];
                        $productEcPlatformArr = json_decode($row_Product["ECPlatform"]);
                        $jsonStr = "[";
                        foreach($productEcPlatformArr as $productEcPlatform){
                            $productEcPlatformName = $productEcPlatform->name;
                            $productEcPlatformValue = $productEcPlatform->value;
                            $productEcPlatformValidFlag = $productEcPlatform->validFlag;
                            $productEcPlatformCtlId = $productEcPlatform->ctlID;
                            for($i = 0 ; $i < count($ctlID) ; $i ++){
                                if($productEcPlatformCtlId != $ctlID[$i]) continue;
                                $flag = "0";
                                for($j = 0 ; $j < count($validFlag) ; $j ++){
                                    if($validFlag[$j] == $ctlID[$i]){
                                        $flag = "1";
                                        break;
                                    }
                                }
                                $value4update = trim($ckName[$i]) == "" ? "0" : ($productEcPlatformValue == "" ? "0" : $productEcPlatformValue);
                                if ($jsonStr == "["){
                                    $jsonStr .= '{"name":"'.$ckName[$i].'","value":"'.$value4update.'","validFlag":"'.$flag.'","ctlID":"'.$productEcPlatformCtlId.'"}';
                                }else{
                                    $jsonStr .= ',{"name":"'.$ckName[$i].'","value":"'.$value4update.'","validFlag":"'.$flag.'","ctlID":"'.$productEcPlatformCtlId.'"}';
                                }
                            }
                        }
                        $jsonStr .= "]";
                        $sql_update = "UPDATE Products SET ECPlatform = '$jsonStr' WHERE ProductID = '$ProductId'";
                        mysql_query($sql_update);
                    }
                }
                break;
            case "exchange":
                #更新範本
                $select1Id = $_POST["select1"];
                $select2Id = $_POST["select2"];
                $exchangeName1 = "";
                $exchangeName2 = "";
                $exchangeValue1 = "0";
                $exchangeValue2 = "0";
                $exchangeFlag1 = "0";
                $exchangeFlag2 = "0";
                for($i = 0 ; $i < count($ctlID2) ; $i ++){
                    if($select1Id == $ctlID2[$i]){
                        $exchangeName1 = $ckName2[$i];
                        $exchangeFlag1 = $validFlag2[$i] == $ctlID2[$i] ? "1" : "0";
                    }
                    if($select2Id == $ctlID2[$i]){
                        $exchangeName2 = $ckName2[$i];
                        $exchangeFlag2 = $validFlag2[$i] == $ctlID2[$i] ? "1" : "0";
                    }
                }
                $jsonStr = "[";
                for($i = 0 ; $i < count($ctlID2) ; $i ++){
                    $name = $ckName2[$i];
                    $flag = "0";
                    for($j = 0 ; $j < count($validFlag2) ; $j ++){
                        if($validFlag2[$j] == $ctlID2[$i]){
                            $flag = "1";
                            break;
                        }
                    }
                    if($ctlID2[$i] == $select1Id){
                        $name = $exchangeName2;
                        $flag = $exchangeFlag2;
                    }else if($ctlID2[$i] == $select2Id){
                        $name = $exchangeName1;
                        $flag = $exchangeFlag1;
                    }
                    if ($jsonStr == "["){
                        $jsonStr .= '{"name":"'.$ctlID2[$i].'","value":"'.$name.'","validFlag":"'.$flag.'"}';
                    }else{
                        $jsonStr .= ',{"name":"'.$ctlID2[$i].'","value":"'.$name.'","validFlag":"'.$flag.'"}';
                    }
                }
                $jsonStr .= "]";
                $sql_updateDeliveryMethod = "UPDATE RefCommonConfig SET ConfigContent = '$jsonStr' WHERE ConfigName = 'ECPlatform'";
                mysql_query($sql_updateDeliveryMethod);
                #更新商品
                $sql_queryProduct = "SELECT ProductID, ECPlatform FROM Products";
                $rec_queryProduct = mysql_query($sql_queryProduct);
                if($rec_queryProduct){
                    while($row_Product = mysql_fetch_assoc($rec_queryProduct)){
                        $ProductId = $row_Product["ProductID"];
                        $productEcPlatformArr = json_decode($row_Product["ECPlatform"]);
                        $jsonStr = "[";
                        foreach($productEcPlatformArr as $productEcPlatform){
                            $productEcPlatformName = $productEcPlatform->name;
                            $productEcPlatformValue = $productEcPlatform->value;
                            $productEcPlatformValidFlag = $productEcPlatform->validFlag;
                            $productEcPlatformCtlId = $productEcPlatform->ctlID;
                            for($i = 0 ; $i < count($ctlID2) ; $i ++){
                                if($productEcPlatformCtlId != $ctlID2[$i]) continue;
                                $name = $ckName2[$i];
                                $flag = "0";
                                for($j = 0 ; $j < count($validFlag) ; $j ++){
                                    if($validFlag2[$j] == $ctlID2[$i]){
                                        $flag = "1";
                                        break;
                                    }
                                }
                                $value = trim($ckName2[$i]) == "" ? "0" : $productEcPlatformValue;
                                $sql_queryProductById = "SELECT ProductID, ECPlatform FROM Products WHERE ProductID = '$ProductId'";
                                $rec_queryProductById = mysql_query($sql_queryProductById);
                                if($rec_queryProductById){
                                    while($row_ProductById = mysql_fetch_assoc($rec_queryProductById)){
                                        $productEcPlatformArr2 = json_decode($row_ProductById["ECPlatform"]);
                                        foreach($productEcPlatformArr2 as $productEcPlatform2){
                                            if($productEcPlatform2->ctlID == $select1Id){
                                                $exchangeValue1 = $productEcPlatform2->value;
                                            }
                                            if($productEcPlatform2->ctlID == $select2Id){
                                                $exchangeValue2 = $productEcPlatform2->value;
                                            }
                                        }
                                    }
                                }
                                if($ctlID2[$i] == $select1Id){
                                    $name = $exchangeName2;
                                    $flag = $exchangeFlag2;
                                    $value = $exchangeValue2;
                                }else if($ctlID2[$i] == $select2Id){
                                    $name = $exchangeName1;
                                    $flag = $exchangeFlag1;
                                    $value = $exchangeValue1;
                                }
                                if ($jsonStr == "["){
                                    $jsonStr .= '{"name":"'.$name.'","value":"'.$value.'","validFlag":"'.$flag.'","ctlID":"'.$productEcPlatformCtlId.'"}';
                                }else{
                                    $jsonStr .= ',{"name":"'.$name.'","value":"'.$value.'","validFlag":"'.$flag.'","ctlID":"'.$productEcPlatformCtlId.'"}';
                                }
                            }
                        }
                        $jsonStr .= "]";
                        $sql_update = "UPDATE Products SET ECPlatform = '$jsonStr' WHERE ProductID = '$ProductId'";
                        mysql_query($sql_update);
                    }
                }
                break;
            default:
                break;
        }
    	break;
    case "updateDeliveryMethod":
        $additionalAction = $_POST["additionalAction"];
    	$deliveryMethodId = $_POST["deliveryMethodId"];
    	$deliveryMethodName = $_POST["deliveryMethodName"];
    	$validFlag = $_POST["validFlag"];
        $deliveryMethodId2 = $_POST["deliveryMethodId2"];
        $deliveryMethodName2 = $_POST["deliveryMethodName2"];
        $validFlag2 = $_POST["validFlag2"];
        switch($additionalAction){
            case "updateProduct":
                #更新範本
                $jsonStr = "[";
                for($i = 0 ; $i < count($deliveryMethodId) ; $i ++){
                    $flag = "0";
                    for($j = 0 ; $j < count($validFlag) ; $j ++){
                        if($validFlag[$j] == $deliveryMethodId[$i]){
                            $flag = "1";
                            break;
                        }
                    }
                    if ($jsonStr == "["){
                        $jsonStr .= '{"name":"'.$deliveryMethodId[$i].'","value":"'.$deliveryMethodName[$i].'","validFlag":"'.$flag.'"}';
                    }else{
                        $jsonStr .= ',{"name":"'.$deliveryMethodId[$i].'","value":"'.$deliveryMethodName[$i].'","validFlag":"'.$flag.'"}';
                    }
                }
                $jsonStr .= "]";
                $sql_updateDeliveryMethod = "UPDATE RefCommonConfig SET ConfigContent = '$jsonStr' WHERE ConfigName = 'DeliveryMethod'";
                mysql_query($sql_updateDeliveryMethod);
                #更新商品
                $sql_queryProduct = "SELECT ProductID, DeliveryMethod FROM Products";
                $rec_queryProduct = mysql_query($sql_queryProduct);
                if($rec_queryProduct){
                    while($row_Product = mysql_fetch_assoc($rec_queryProduct)){
                        $ProductId = $row_Product["ProductID"];
                        $productDeliveryMethodArr = json_decode($row_Product["DeliveryMethod"]);
                        $jsonStr = "[";
                        foreach($productDeliveryMethodArr as $productDeliveryMethod){
                            $productDeliveryMethodName = $productDeliveryMethod->name;
                            $productDeliveryMethodValue = $productDeliveryMethod->value;
                            $productDeliveryMethodValidFlag = $productDeliveryMethod->validFlag;
                            $productDeliveryMethodId = $productDeliveryMethod->deliveryMethodId;
                            for($i = 0 ; $i < count($deliveryMethodId) ; $i ++){
                                if($productDeliveryMethodId != $deliveryMethodId[$i]) continue;
                                $flag = "0";
                                for($j = 0 ; $j < count($validFlag) ; $j ++){
                                    if($validFlag[$j] == $deliveryMethodId[$i]){
                                        $flag = "1";
                                        break;
                                    }
                                }
                                $value4update = trim($deliveryMethodName[$i]) == "" ? "0" : ($productDeliveryMethodValue == "" ? "0" : $productDeliveryMethodValue);
                                if ($jsonStr == "["){
                                    $jsonStr .= '{"name":"'.$deliveryMethodName[$i].'","value":"'.$value4update.'","validFlag":"'.$flag.'","deliveryMethodId":"'.$productDeliveryMethodId.'"}';
                                }else{
                                    $jsonStr .= ',{"name":"'.$deliveryMethodName[$i].'","value":"'.$value4update.'","validFlag":"'.$flag.'","deliveryMethodId":"'.$productDeliveryMethodId.'"}';
                                }
                            }
                        }
                        $jsonStr .= "]";
                        $sql_update = "UPDATE Products SET DeliveryMethod = '$jsonStr' WHERE ProductID = '$ProductId'";
                        mysql_query($sql_update);
                    }
                }
                break;
            case "exchange":
                #更新範本
                $select1Id = $_POST["select1"];
                $select2Id = $_POST["select2"];
                $exchangeName1 = "";
                $exchangeName2 = "";
                $exchangeValue1 = "0";
                $exchangeValue2 = "0";
                $exchangeFlag1 = "0";
                $exchangeFlag2 = "0";
                for($i = 0 ; $i < count($deliveryMethodId2) ; $i ++){
                    if($select1Id == $deliveryMethodId2[$i]){
                        $exchangeName1 = $deliveryMethodName2[$i];
                        $exchangeFlag1 = $validFlag2[$i] == $deliveryMethodId2[$i] ? "1" : "0";
                    }
                    if($select2Id == $deliveryMethodId2[$i]){
                        $exchangeName2 = $deliveryMethodName2[$i];
                        $exchangeFlag2 = $validFlag2[$i] == $deliveryMethodId2[$i] ? "1" : "0";
                    }
                }
                $jsonStr = "[";
                for($i = 0 ; $i < count($deliveryMethodId2) ; $i ++){
                    $name = $deliveryMethodName2[$i];
                    $flag = "0";
                    for($j = 0 ; $j < count($validFlag2) ; $j ++){
                        if($validFlag2[$j] == $deliveryMethodId2[$i]){
                            $flag = "1";
                            break;
                        }
                    }
                    if($deliveryMethodId2[$i] == $select1Id){
                        $name = $exchangeName2;
                        $flag = $exchangeFlag2;
                    }else if($deliveryMethodId2[$i] == $select2Id){
                        $name = $exchangeName1;
                        $flag = $exchangeFlag1;
                    }
                    if ($jsonStr == "["){
                        $jsonStr .= '{"name":"'.$deliveryMethodId2[$i].'","value":"'.$name.'","validFlag":"'.$flag.'"}';
                    }else{
                        $jsonStr .= ',{"name":"'.$deliveryMethodId2[$i].'","value":"'.$name.'","validFlag":"'.$flag.'"}';
                    }
                }
                $jsonStr .= "]";
                $sql_updateDeliveryMethod = "UPDATE RefCommonConfig SET ConfigContent = '$jsonStr' WHERE ConfigName = 'DeliveryMethod'";
                mysql_query($sql_updateDeliveryMethod);
                #更新商品
                $sql_queryProduct = "SELECT ProductID, DeliveryMethod FROM Products";
                $rec_queryProduct = mysql_query($sql_queryProduct);
                if($rec_queryProduct){
                    while($row_Product = mysql_fetch_assoc($rec_queryProduct)){
                        $ProductId = $row_Product["ProductID"];
                        $productDeliveryMethodArr = json_decode($row_Product["DeliveryMethod"]);
                        $jsonStr = "[";
                        foreach($productDeliveryMethodArr as $productDeliveryMethod){
                            $productDeliveryMethodName = $productDeliveryMethod->name;
                            $productDeliveryMethodValue = $productDeliveryMethod->value;
                            $productDeliveryMethodValidFlag = $productDeliveryMethod->validFlag;
                            $productDeliveryMethodId = $productDeliveryMethod->deliveryMethodId;
                            for($i = 0 ; $i < count($deliveryMethodId2) ; $i ++){
                                if($productDeliveryMethodId != $deliveryMethodId2[$i]) continue;
                                $name = $deliveryMethodName2[$i];
                                $flag = "0";
                                for($j = 0 ; $j < count($validFlag2) ; $j ++){
                                    if($validFlag2[$j] == $deliveryMethodId2[$i]){
                                        $flag = "1";
                                        break;
                                    }
                                }
                                $value = trim($deliveryMethodName2[$i]) == "" ? "0" : $productDeliveryMethodValue;
                                $sql_queryProductById = "SELECT ProductID, DeliveryMethod FROM Products WHERE ProductID = '$ProductId'";
                                $rec_queryProductById = mysql_query($sql_queryProductById);
                                if($rec_queryProductById){
                                    while($row_ProductById = mysql_fetch_assoc($rec_queryProductById)){
                                        $productDeliveryMethodArr2 = json_decode($row_ProductById["DeliveryMethod"]);
                                        foreach($productDeliveryMethodArr2 as $productDeliveryMethod2){
                                            if($productDeliveryMethod2->deliveryMethodId == $select1Id){
                                                $exchangeValue1 = $productDeliveryMethod2->value;
                                            }
                                            if($productDeliveryMethod2->deliveryMethodId == $select2Id){
                                                $exchangeValue2 = $productDeliveryMethod2->value;
                                            }
                                        }
                                    }
                                }
                                if($deliveryMethodId2[$i] == $select1Id){
                                    $name = $exchangeName2;
                                    $flag = $exchangeFlag2;
                                    $value = $exchangeValue2;
                                }else if($deliveryMethodId2[$i] == $select2Id){
                                    $name = $exchangeName1;
                                    $flag = $exchangeFlag1;
                                    $value = $exchangeValue1;
                                }
                                if ($jsonStr == "["){
                                    $jsonStr .= '{"name":"'.$name.'","value":"'.$value.'","validFlag":"'.$flag.'","deliveryMethodId":"'.$productDeliveryMethodId.'"}';
                                }else{
                                    $jsonStr .= ',{"name":"'.$name.'","value":"'.$value.'","validFlag":"'.$flag.'","deliveryMethodId":"'.$productDeliveryMethodId.'"}';
                                }
                            }
                        }
                        $jsonStr .= "]";
                        $sql_update = "UPDATE Products SET DeliveryMethod = '$jsonStr' WHERE ProductID = '$ProductId'";
                        mysql_query($sql_update);
                    }
                }
                break;
            default:
                break;
        }
    	break;
    default:
    	break;
}
#上架商城資訊查詢
$config_ECPlatform_sql = "SELECT ConfigContent FROM RefCommonConfig WHERE ConfigName = 'ECPlatform'";
$recConfig = mysql_query($config_ECPlatform_sql);
$rowConfig = mysql_fetch_assoc($recConfig);
$ECPlatform_Template = $rowConfig["ConfigContent"];
$ecPlatformAry = json_decode($ECPlatform_Template);
#配送方式資訊查詢
$config_deliveryMethod_sql = "SELECT ConfigContent FROM RefCommonConfig WHERE ConfigName = 'DeliveryMethod'";
$rec_deliveryMethod = mysql_query($config_deliveryMethod_sql);
$row_deliveryMethod = mysql_fetch_assoc($rec_deliveryMethod);
$deliveryMethod_template = $row_deliveryMethod["ConfigContent"];
$deliveryMethodAry = json_decode($deliveryMethod_template);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>城市綠洲-後台管理系統</title>
    <meta http-equiv="X-UA-Compatible" content="IE=11, IE=9, IE=8, chrome=10" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="icon" type="image/ico" href="images/favicon_16x16.ico" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link href="css/colorbox.css" type="text/css" rel="stylesheet" />
    <link href="css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
    <link href="css/jquery.treeview.css" rel="stylesheet" />
    <link href="css/checkbox.css" type="text/css" rel="stylesheet" />
	<link href="css/EricChang.css" type="text/css" rel="stylesheet" />
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">@Charset "UTF-8";
	td:first-child{
	  border-top-left-radius: 15px;
	  border-bottom-left-radius: 15px;
	}
	td:last-child{
	  border-top-right-radius: 15px;
	  border-bottom-right-radius: 15px;
	}
	</style>
    <script type="text/javascript" charset="UTF-8" src="js/jquery-1.7.2.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.button.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.tabs.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.progressbar.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.accordion.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.colorbox.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.maskedinput-1.3.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.blockUI.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.treeview.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
    <script type="text/javascript" charset="UTF-8">	
        var isTab2TransloctionBtnOn = false;
        var isTab3TransloctionBtnOn = false;
    	function pageInitial(){
    		$(document).find(".orange_18_de5106").html("❖ 商品設定");
            $("#tabs").tabs();
            switch("<? echo $_POST["action"] ?>"){
            	case "updatePromotionalActivity":
            		$("#tabsul a[href='#tabs-1']").trigger("click");
            		break;
            	case "updateEcPlatform":
            		$("#tabsul a[href='#tabs-3']").trigger("click");
            		break;
            	case "updateDeliveryMethod":
            		$("#tabsul a[href='#tabs-2']").trigger("click");
            		break;
            	default:
            		break;
            }
    	}
    	function beforeSubmit(){
    		return true;
    	}
        function beforeSubmit2(){
            if(isTab2TransloctionBtnOn && ($("#tab2_select1").val() == "" || $("#tab2_select2").val() == "")){
                alert("不選擇兩個要對調的傢伙是無法儲存的哦！ 啾咪");
                return false;
            }
            return true;
        }
        function beforeSubmit3(){
            if(isTab3TransloctionBtnOn && ($("#tab3_select1").val() == "" || $("#tab3_select2").val() == "")){
                alert("不選擇兩個要對調的傢伙是無法儲存的哦！ 啾咪");
                return false;
            }
            return true;
        }
    	function handleCheckBox($this){
    		var jQueryObj = jQuery($this);
    		if($this.checked == true){
    			if(jQueryObj.parent().find(":text").val() == ""){
    				return false;
    			}
    		}
    	}
        function handleCheckBox2($this){
            var jQueryObj = jQuery($this);
            if($this.checked == true){
                if(jQueryObj.parent().find(":text[id='deliveryMethodName']").val() == ""){
                    return false;
                }
            }
        }
        function handleCheckBox3($this){
            var jQueryObj = jQuery($this);
            if($this.checked == true){
                if(jQueryObj.parent().find(":text[id='ckName']").val() == ""){
                    return false;
                }
            }
        }
        function clickBtnTranslocation2(){
            isTab2TransloctionBtnOn = true;
            $("#tabs-2").find("#additionalAction").val("exchange");
            $("#tabs-2").find("#ibSave").trigger("click");
        }
        function clickBtnTranslocation3(){
            isTab3TransloctionBtnOn = true;
            $("#tabs-3").find("#additionalAction").val("exchange");
            $("#tabs-3").find("#ibSave").trigger("click");
        }
    	function handleInputText($this){
    		var jQueryObj = jQuery($this);
    		if(jQueryObj.val().trim() == ""){
    			jQueryObj.parent().find(":checkbox[id='validFlag']").attr("checked",false);
    		}
    	}
        function onchangeTab2Select1(){
            var select1Value = $("#tab2_select1").val();
            $("#tab2_select2").children().each(function(){
                $(this).removeAttr("disabled");
                $(this).css("background-color","white");
                if($(this).val() == select1Value && $(this).val() != ""){
                    $(this).attr("disabled","true");
                    $(this).css("background-color","#E3E3E3");
                }
            });
        }
        function onchangeTab3Select1(){
            var select1Value = $("#tab3_select1").val();
            $("#tab3_select2").children().each(function(){
                $(this).removeAttr("disabled");
                $(this).css("background-color","white");
                if($(this).val() == select1Value && $(this).val() != ""){
                    $(this).attr("disabled","true");
                    $(this).css("background-color","#E3E3E3");
                }
            });
        }
        function onchangeTab2Select2(){
            var select2Value = $("#tab2_select2").val();
            $("#tab2_select1").children().each(function(){
                $(this).removeAttr("disabled");
                $(this).css("background-color","white");
                if($(this).val() == select2Value && $(this).val() != ""){
                    $(this).attr("disabled","true");
                    $(this).css("background-color","#E3E3E3");
                }
            });
        }
        function onchangeTab3Select2(){
            var select2Value = $("#tab3_select2").val();
            $("#tab3_select1").children().each(function(){
                $(this).removeAttr("disabled");
                $(this).css("background-color","white");
                if($(this).val() == select2Value && $(this).val() != ""){
                    $(this).attr("disabled","true");
                    $(this).css("background-color","#E3E3E3");
                }
            });
        }
        $(window).load(function(){
            $("#tabs-2").find(":checkbox").each(function(){
                if($(this).parent().find(":text").val().trim() != ""){
                    $(this).attr("hasValue","true");
                }
            });
            $("#tabs-3").find(":checkbox").each(function(){
                if($(this).parent().find(":text").val().trim() != ""){
                    $(this).attr("hasValue","true");
                }
            });
            $("#tabs-2").find(":text[id='deliveryMethodName2']").each(function(){
                if($(this).val().trim() != ""){
                    var deliveryMethodId = $(this).parent().find("#deliveryMethodId").val();
                    var serialNo = $(this).parent().find("#serialNo").html();
                    var optionStr = "<option value='" + deliveryMethodId + "'>"+ serialNo+ " " + $(this).val() + "</option>";
                    $("#tab2_select1").append(optionStr);
                    $("#tab2_select2").append(optionStr);
                }
            });   
            $("#tabs-3").find(":text[id='ckName2']").each(function(){
                if($(this).val().trim() != ""){
                    var ctlId = $(this).parent().find("#ctlID").val();
                    var serialNo = $(this).parent().find("#serialNo").html();
                    var optionStr = "<option value='" + ctlId + "'>"+ serialNo+ " " + $(this).val() + "</option>";
                    $("#tab3_select1").append(optionStr);
                    $("#tab3_select2").append(optionStr);
                }
            });            
        });
    </script>
</head>
<body>
	<div id="divBody" style="width:1600px; margin: 0 auto; ">
		<!-- 加上方選單 -->
		<?php include("_nav.php"); ?>
		<div style="overflow: hidden;">
			<!-- 加左方選單 -->
			<?php include("left_nav.php"); ?>
			<div id="divWork" style="float: left; width: 90%">
				<div class="divWorkArea" style="height:auto; margin-bottom: 100px">
					<div id="UpdatePanel1">
						<div id="divDetailBody" class="divDetailBody" style="padding-top: 0px; padding-bottom: 0px;">
							<div id="tabs" style="padding-top: 0px; padding-left: 0px; padding-right: 0px;">
								<ul id="tabsul" style="border-radius: 0px;">                                 
                                    <li id="tab1"><a id="tab1-a" href="#tabs-1"><b>前台</b> - 促銷商品頁籤</a></li>
									<li id="tab2"><a id="tab2-a" href="#tabs-2"><b>後台</b> - 商品型錄(配送方式)</a></li>
                                    <li id="tab3"><a id="tab3-a" href="#tabs-3"><b>後台</b> - 商品型錄(已上架商城)</a></li>
                            	</ul>
                                <!--促銷頁籤設定-->
                                <div id="tabs-1">
                                	<form name="Form" method="post" action="" id="Form">
	                                	<div>	
                                        	<div style="height:20px;"></div>
                                            <table cellpadding="0" cellspacing="0" align="center" width="100%">
                                           		<tr>
		                                			<td align="left">
                                                		<span class="orange_14_de5106">☑ 前台顯示：促銷商品頁籤</span>
		                                			</td>
                                           		</tr>
                                            </table>
                                            <div style="height:20px;"></div>
                                            <table class="GridView" cellspacing="0" cellpadding="2" rules="all" border="1" id="gvGridView" style="border-collapse: collapse;" align="center">
												<? $areaArr = array("A","B","C","D","E","F","G","H","I","J"); ?>
		                                		<tr>
		                                		<? for($i = 0 ; $i < count($areaArr) ; $i ++ ){ ?>
		                                			<th scope="col" style="width: 10%;"><? echo $areaArr[$i] ?>區</th>
		                                		<? } ?>
		                                		</tr>
		                                		<tr>
		                                		<? 
		                                			for($i = 0 ; $i < count($areaArr) ; $i ++ ){
		                                				$sql_queryPromotionalActivity = "SELECT Area, ActivityName, ValidFlag FROM PromotionalActivity WHERE Area = '$areaArr[$i]'";
		                                				$rec_queryPromotionalActivity = mysql_query($sql_queryPromotionalActivity);
		                                				//echo $sql_queryPromotionalActivity;
		                                				if($rec_queryPromotionalActivity){ 
		                                					while($row = mysql_fetch_assoc($rec_queryPromotionalActivity)){
		                                		?>
		                                			<td>
		                                		<? 				if($row["ValidFlag"] == "1"){
		                                		?>
		                                				<input type="checkbox" name="validFlag[]" value="<? echo $areaArr[$i] ?>" checked="true" onclick="return handleCheckBox(this);"/>
		                                		<?				}else{
		                                		?>
		                                				<input type="checkbox" name="validFlag[]" value="<? echo $areaArr[$i] ?>" onclick="return handleCheckBox(this);"/>
		                                		<?              }
		                                		?>
		                                				<input type="text" id="activityName" name="activityName[]" style="width: 75%" value="<? echo $row["ActivityName"] ?>" onchange="handleInputText(this);"/>
		                                				<input type="hidden" name="area[]" value="<? echo $areaArr[$i] ?>">
	    	                            			</td>
		                                		<?			}
		                                				}else{
		                                		?>
		                                			<td>
		                                				<input type="checkbox" name="validFlag[]" value="<? echo $areaArr[$i] ?>"/>
		                                				<input type="text" id="activityName" name="activityName[]" style="width: 75%" onchange="handleInputText(this);"/>
		                                				<input type="hidden" name="area[]" value="<? echo $areaArr[$i] ?>">
		                                			</td>
		                                		<?		}
		                                			}
		                                		?>
		                                		</tr>
	                                		</table>
	                                	</div>
                                        <div style="height:30px;"></div>
	                                	<div style="width:100%; text-align:center;">
	                                		<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit();" style="font-size:12pt; height:35px" class="ui-button ui-widget ui-state-default ui-corner-all"/>
	                                		<input type="hidden" name="action" value="updatePromotionalActivity"/>
	                                	</div>
                                        <div style="height:10px;"></div>
                                	</form>
                                </div>
                                <!--配送方式設定-->
                                <div id="tabs-2" align="left">
                                	<form name="Form" method="post" action="" id="Form">
                                    	<div style="height:10px;"></div>
                                        <table class="" cellspacing="0" cellpadding="10" border="0" align="center" width="100%">
                                			<tr>
                                                <td align="left">
                                                    <span class="orange_14_de5106">☑ 後台顯示：商品型錄﹝配送方式﹞</span>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="" cellspacing="0" cellpadding="10" border="0" align="center">
                                            <tr>
                                			<?
                                				$deliveryMethodCount = 1;
                                				foreach($deliveryMethodAry as $array)
												{
                                					$deliveryMethodId = $array->name;
                                					$deliveryMethodName = $array->value;
                                					$validFlag = $array->validFlag;
                                			?>
												<td>
                                                	<span class="green_12" id="serialNo">#<? echo $deliveryMethodCount < 10 ? "0".$deliveryMethodCount : $deliveryMethodCount ?></span>
											<?		if($validFlag == "1"){ ?>
														<input type="checkbox" id="validFlag" name="validFlag[]" value="<? echo $deliveryMethodId ?>" checked="true" onclick="return handleCheckBox2(this);"/>
                                                        <input type="checkbox" name="validFlag2[]" value="<? echo $deliveryMethodId ?>" checked="true" onclick="return handleCheckBox2(this);" style="display: none;"/>
											<?		}else{ ?>
														<input type="checkbox" id="validFlag" name="validFlag[]" value="<? echo $deliveryMethodId ?>" onclick="return handleCheckBox2(this);"/>
                                                        <input type="checkbox" name="validFlag2[]" value="<? echo $deliveryMethodId ?>" onclick="return handleCheckBox2(this);" style="display: none;"/>
											<?		} ?>
		                            				<input type="text" id="deliveryMethodName" name="deliveryMethodName[]" style="width: 60%;" value="<? echo $deliveryMethodName ?>" class="b_12" onchange="handleInputText(this);" />
		                            				<input type="hidden" id="deliveryMethodId" name="deliveryMethodId[]" value="<? echo $deliveryMethodId ?>">
                                                    <input type="text" id="deliveryMethodName2" name="deliveryMethodName2[]" style="width: 60%; display: none;" value="<? echo $deliveryMethodName ?>" class="b_12" onchange="handleInputText(this);"/>
                                                    <input type="hidden" id="deliveryMethodId2" name="deliveryMethodId2[]" value="<? echo $deliveryMethodId ?>"/>
												</td>
											<?			
													$deliveryMethodCount += 1;
											?>
											<?
												}
												#最多補到6格
												if($deliveryMethodCount < 7)
												{
													for($i = $deliveryMethodCount ; $i < 7 ; $i ++)
													{
											?>
												<td>
													<span class="green_12" id="serialNo">#<? echo $deliveryMethodCount < 10 ? "0".$deliveryMethodCount : $deliveryMethodCount ?></span>
                                                    <input type="checkbox" id="validFlag" name="validFlag[]" value="<? echo $deliveryMethodId ?>" onclick="return handleCheckBox2(this);"/>
													<input type="text" id="deliveryMethodName" name="deliveryMethodName[]" style="width: 60%" value="" class="b_12" onchange="handleInputText2(this);" />
		                            				<input type="hidden" id="deliveryMethodId" name="deliveryMethodId[]" value="delivery<? echo $deliveryMethodCount ?>">
                                                    <input type="checkbox" name="validFlag2[]" value="<? echo $deliveryMethodId ?>" onclick="return handleCheckBox2(this);" style="display: none;"/>
                                                    <input type="text" id="deliveryMethodName2" name="deliveryMethodName2[]" style="width: 60%; display: none;" value="" class="b_12" onchange="handleInputText(this);" />
                                                    <input type="hidden" id="deliveryMethodId2" name="deliveryMethodId2[]" value="delivery<? echo $deliveryMethodCount ?>" style="display: none;"/>
		                            			</td>
											<?			$deliveryMethodCount += 1;
													}
												}
											?>
                                			</tr>
                                		</table>
                            			<div style="height:30px;"></div>
                                            <div style="width:100%; text-align:center;">
                                                <input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit2();" 
                                                	   style="font-size:12pt; height:35px" class="ui-button ui-widget ui-state-default ui-corner-all" />
                                                <input type="hidden" name="action" value="updateDeliveryMethod"/>
                                                <input type="hidden" id="additionalAction" name="additionalAction" value="updateProduct"/>
                                            </div>
                                        <div style="height:30px;"></div>
                                        
                                        <hr>
                                        
                                        <div style="height:30px;"></div>
                                        <table class="" cellspacing="0" cellpadding="10" border="0" align="center" width="450">
                                            <tr>
                                                <td align="center">
                                                    <span class="orange_14_de5106">易位調整</span></td>
                                            </tr>
                                        </table>
                                        <table class="" cellspacing="0" cellpadding="10" border="0" align="center">
                                            <tr>
                                                <td align="center" bgcolor="#e3e6f9" height="46" width="450">
                                                	<table cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td align="right">
                                                            <select id="tab2_select1" name="select1" class="dropdownlist" onchange="onchangeTab2Select1()" >
                                                                <option value="">------</option>
                                                            </select>
                                                        </td>
                                                        <td align="center" width="80">
                                                            <i id="exchangeIcon" class="fa fa-exchange" aria-hidden="true" style="font-size: 22px;"></i>
                                                        </td>
                                                        <td align="left">
                                                            <select id="tab2_select2" name="select2" class="dropdownlist" onchange="onchangeTab2Select2()" >
                                                                <option value="">------</option>
                                                            </select>
                                                        </td>
                                                      </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td align="center" height="80">
                                                	<input type="button" class="ui-button ui-widget ui-state-default ui-corner-all" id="btnTranslocation2" 
                                                    	   style="font-size:12pt; height:35px" value="儲存" onclick="clickBtnTranslocation2()"/>
                                                </td>
                                            </tr>
                                        </table>
                                   		<div style="height:10px;"></div>
                                	</form>
                                </div>
                                <!--上架商城設定-->
                                <div id="tabs-3" align="center">
                                	<form name="Form" method="post" action="" id="Form">
                                        <div style="height:10px;"></div>
		                                <table class="" cellspacing="0" cellpadding="10" border="0" width="100%">
                                            <tr>
												<td align="left">
                                                    <span class="orange_14_de5106">☑ 後台顯示：商品型錄﹝已上架商城﹞</span>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="" cellspacing="0" cellpadding="10" border="0">
											<tr>
			                                <?	$ecPlatformCount = 1;
				                                foreach($ecPlatformAry as $array)
												{
														$ctlID = $array->name;
														$ckName = $array->value;
														$validFlag = $array->validFlag;
											?>
												<td>
                                                	<span class="green_12" id="serialNo">#<? echo $ecPlatformCount < 10 ? "0".$ecPlatformCount : $ecPlatformCount ?></span>
											<?		if($validFlag == "1"){ ?>
														<input type="checkbox" id="validFlag" name="validFlag[]" value="<? echo $ctlID ?>" checked="true" onclick="return handleCheckBox3(this);"/>
                                                        <input type="checkbox" name="validFlag2[]" value="<? echo $ctlID ?>" checked="true" onclick="return handleCheckBox3(this);" style="display: none;"/>
											<?		}else{ ?>
														<input type="checkbox" id="validFlag" name="validFlag[]" value="<? echo $ctlID ?>" onclick="return handleCheckBox3(this);"/>
                                                        <input type="checkbox" name="validFlag2[]" value="<? echo $ctlID ?>" onclick="return handleCheckBox3(this);" style="display: none;"/>
											<?		} ?>
		                            				<input type="text" id="ckName" name="ckName[]" style="width: 60%;" value="<? echo $ckName ?>" class="b_12" onchange="handleInputText(this);" />
		                            				<input type="hidden" id="ctlID" name="ctlID[]" value="<? echo $ctlID ?>"/>
                                                    <input type="text" id="ckName2" name="ckName2[]" style="width: 60%;display: none;" value="<? echo $ckName ?>" class="b_12" onchange="handleInputText(this);"/>
                                                    <input type="hidden" id="ctlID2" name="ctlID2[]" value="<? echo $ctlID ?>" />
												</td>
											<?			
													$ecPlatformCount += 1;
													#5個換行
													if( ($ecPlatformCount - 1) % 5 == 0)
													{
											?>
											</tr>
											<tr>
											<?
													}
												}
												$ecPlatformTotal = $ecPlatformCount;
												#最多補到20格
												if($ecPlatformTotal % 5 != 0 && count($ecPlatformAry) < 20){
													for($i = ($ecPlatformTotal % 5) ; $i < 6 ; $i ++){
											?>
												<td>
													<span class="green_12" id="serialNo">#<? echo $ecPlatformCount < 10 ? "0".$ecPlatformCount : $ecPlatformCount ?></span>
                                                    <input type="checkbox" id="validFlag" name="validFlag[]" value="<? echo $ctlID ?>" onclick="return handleCheckBox3(this);"/>
													<input type="text" id="ckName" name="ckName[]" style="width: 60%" value="" class="b_12 show" onchange="handleInputText(this);" />
		                            				<input type="hidden" id="ctlID" name="ctlID[]" value="ckEStore<? echo $ecPlatformCount ?>"/>
                                                    <input type="checkbox" name="validFlag2[]" value="<? echo $ctlID ?>" onclick="return handleCheckBox3(this);" style="display: none;"/>
                                                    <input type="text" id="ckName2" name="ckName2[]" style="width: 60%; display: none;" value="" class="b_12" onchange="handleInputText(this);"/>
                                                    <input type="hidden" id="ctlID2" name="ctlID2[]" value="ckEStore<? echo $ecPlatformCount ?>"/>
		                            			</td>
											<?			$ecPlatformCount += 1;
													}
												}
											?>
			                            </table>
                                        <div style="height:30px;"></div>
    	                                	<div style="width:100%; text-align:center;">
	                                		<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit3();" style="font-size:12pt; height:35px" 
                                            	   class="ui-button ui-widget ui-state-default ui-corner-all" />
	                                		<input type="hidden" name="action" value="updateEcPlatform"/>
                                            <input type="hidden" id="additionalAction" name="additionalAction" value="updateProduct"/>
	                                		</div>
                                        <div style="height:30px;"></div>
                                        
                                        <hr>
                                        
                                        <div style="height:30px;"></div>
                                        <table class="" cellspacing="0" cellpadding="10" border="0" align="center" width="450">
                                            <tr>
                                                <td align="center">
                                                    <span class="orange_14_de5106">易位調整</span></td>
                                            </tr>
                                        </table>
                                        <table class="" cellspacing="0" cellpadding="10" border="0" align="center">
                                            <tr>
                                                <td align="center" bgcolor="#f1e3f9" height="46" width="450">
                                                	<table cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td align="right">
                                                            <select id="tab3_select1" name="select1" class="dropdownlist" onchange="onchangeTab3Select1()">
                                                                <option value="">------</option>
                                                            </select>
                                                        </td>
                                                        <td align="center" width="80">
                                                            <i id="exchangeIcon" class="fa fa-exchange" aria-hidden="true" style="font-size: 22px;"></i>
                                                        </td>
                                                        <td align="left">
                                                            <select id="tab3_select2" name="select2" class="dropdownlist" onchange="onchangeTab3Select2()">
                                                        		<option value="">------</option>
                                                    		</select>
                                                        </td>
                                                      </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td align="center" height="80">
                                                	<input type="button" class="ui-button ui-widget ui-state-default ui-corner-all" id="btnTranslocation3" style="font-size:12pt; height:35px" value="儲存" onclick="clickBtnTranslocation3()"/>
                                                </td>
                                            </tr>
                                        </table>
                                        <div style="height:10px;"></div>
		                            </form>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>