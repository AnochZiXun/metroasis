<?php
include_once("_connMysql.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];
$config_ECPlatform_sql = "SELECT ConfigContent FROM RefCommonConfig WHERE ConfigName = 'ECPlatform'";
$recConfig = mysql_query($config_ECPlatform_sql);
$rowConfig = mysql_fetch_assoc($recConfig);
$ECPlatform_Template = $rowConfig["ConfigContent"];
$config_deliveryMethod_sql = "SELECT ConfigContent FROM RefCommonConfig WHERE ConfigName = 'DeliveryMethod'";
$rec_deliveryMethod = mysql_query($config_deliveryMethod_sql);
$row_deliveryMethod = mysql_fetch_assoc($rec_deliveryMethod);
$deliveryMethod_template = $row_deliveryMethod["ConfigContent"];
$productStatus = $_GET["productStatus"];
$page = $_GET["page"];
$isNew = false;
$statusForBackToList = $_GET["status"];
$productCategory1ForBackToList = isset($_GET["productCategory1"]) && $_GET["productCategory1"]!='' ? $_GET["productCategory1"] : "-1";
$productCategory2ForBackToList = isset($_GET["productCategory2"]) ? $_GET["productCategory2"] : "-1";
$productCategory3ForBackToList = isset($_GET["productCategory3"]) ? $_GET["productCategory3"] : "-1";
$searchBarCodeForBackToList = isset($_GET["searchBarCode"]) ? $_GET["searchBarCode"] : "";
$searchKeyForBackToList = isset($_GET["searchKey"]) ? $_GET["searchKey"] : "";
$searchStartDateFrom  = isset($_GET["searchStartDateFrom"]) ? $_GET["searchStartDateFrom"] : "";
$searchStartDateTo = isset($_GET["searchStartDateTo"]) ? $_GET["searchStartDateTo"] : "";
$searchUnitPriceFrom = isset($_GET["searchUnitPriceFrom"]) ? $_GET["searchUnitPriceFrom"] : "";
$searchUnitPriceTo = isset($_GET["searchUnitPriceTo"]) ? $_GET["searchUnitPriceTo"] : "";
$searchStockNumber = isset($_GET["searchStockNumber"]) ? $_GET["searchStockNumber"] : "";
$searchBrand = isset($_GET["searchBrand"]) ? $_GET["searchBrand"] : "-1";
$promotionalActivityArea = isset($_GET["promotionalActivityArea"]) ? $_GET["promotionalActivityArea"] : "-1";
if(isset($_GET["productId"])) {
	$productId = $_GET["productId"];
	//查詢修改商品
	$query_product_sql = "SELECT P.ProductID, P.SortNo, PA.ActivityName, P.ProductCategoryID, P.BrandID, P.ProductName,format(P.UnitPrice,0) as UnitPrice,format(P.ListPrice,0) as ListPrice,Status, P.UpdateDate,(SELECT ImageFileName FROM `ImagesFiles` WHERE `ImageFunction` = 'products' AND `ImageType` = 'detail' AND `ForeignID` = P.ProductID LIMIT 1) AS ImageFileName, P.NewFlag, P.StartDate, P.EndDate ";
	$productTableName = "FROM Products P LEFT JOIN PromotionalActivity PA ON P.SortNo like CONCAT(PA.Area,'%') ";
	$query_product_sql = "$query_product_sql $productTableName WHERE 1 AND ProductID = $productId";
	$recProducts = mysql_query($query_product_sql);
	if($recProducts){
		while($rowProduct=mysql_fetch_assoc($recProducts)){
			if ($rowProduct["NewFlag"] == "1") $isNew = true;
		}
	}
}else{
	$createUserID = $currentUserID;
	$updateUserID = $currentUserID;
	$ecPlatformAry = json_decode($ECPlatform_Template);
	$Json = "[";
	foreach($ecPlatformAry as $array)
	{
		$ctlID = $array->name;
		$ckName = $array->value;
		$validFlag = $array->validFlag;
		if (isset($_POST[$ctlID])){
			$ckValue = "1";
		}else{
			$ckValue = "0";	
		}
		if ($Json == "["){
			$Json .= '{"name":"'.$ckName.'","value":"'.$ckValue.'","validFlag":"'.$validFlag.'","ctlID":"'.$ctlID.'"}';
		}else{
			$Json .= ',{"name":"'.$ckName.'","value":"'.$ckValue.'","validFlag":"'.$validFlag.'","ctlID":"'.$ctlID.'"}';
		}
	}
	$Json .= "]";
	//echo $Json;
	$ecPlatform = $Json;
	$deliveryMethodAry = json_decode($deliveryMethod_template);
	$Json = "[";
	foreach($deliveryMethodAry as $array)
	{
		$deliveryMethodId = $array->name;
		$deliveryMethodName = $array->value;
		$validFlag = $array->validFlag;
		if (isset($_POST[$deliveryMethodId])){
			$ckValue = "1";
		}else{
			$ckValue = "0";	
		}
		if ($Json == "["){
			$Json .= '{"name":"'.$deliveryMethodName.'","value":"'.$ckValue.'","validFlag":"'.$validFlag.'","deliveryMethodId":"'.$deliveryMethodId.'"}';
		}else{
			$Json .= ',{"name":"'.$deliveryMethodName.'","value":"'.$ckValue.'","validFlag":"'.$validFlag.'","deliveryMethodId":"'.$deliveryMethodId.'"}';
		}
	}
	$Json .= "]";
	//echo $Json;
	$deliveryMethod = $Json;
	$insert_products_sql = "INSERT INTO Products(ECPlatform,DeliveryMethod,CreateUserID) 
								VALUES ('$ecPlatform','$deliveryMethod','$currentUserID')";
	//echo $insert_products_sql;
	mysql_query($insert_products_sql);
	$productId = mysql_insert_id();
	$isNew = true;
}
if(isset($_GET["readOnly"])) {
	$readOnly = $_GET["readOnly"];
}
if($_POST["action"] == "update"){ 
	$productName = $_POST["ProductName"];
	$brandID = $_POST["BrandID"] == '' ? 'NULL' : $_POST["BrandID"];	
	$status = $_POST["Status"];
	$startDate = $_POST["StartDate"] == '' ? 'NULL' : "'".$_POST["StartDate"]."'";
	$startDate = str_replace("/", "-", $startDate);
	$endDate = $_POST["EndDate"] == '' ? 'NULL' : "'".$_POST["EndDate"]."'";
	$endDate = str_replace("/", "-", $endDate);
	$listPrice = $_POST["ListPrice"] == '' ? 0 : $_POST["ListPrice"];
	$unitPrice = $_POST["UnitPrice"] == '' ? 0 : $_POST["UnitPrice"];
	$sortNoLeft = $_POST["SortNoLeft"];
	$sortNoRight = $_POST["SortNoRight"];
	$sortNo = NULL;
	if(strlen($sortNoLeft) > 0 && strlen($sortNoRight) > 0 ){
		$sortNo = $sortNoLeft.$sortNoRight;
	}
	$productFeather = $_POST["ProductFeather"];
	$youtubeUrl = $_POST["YoutubeUrl"];
	//$youtubeUrl = str_replace('"',"'",$youtubeUrl);
	$productDescription = $_POST["ProductDescription"];
	//$chkDeliverExpress = $_POST["chkDeliverExpress"] == '' ? 0 : $_POST["chkDeliverExpress"];
	//$chkTakeFromStore = $_POST["chkTakeFromStore"] == '' ? 0 : $_POST["chkTakeFromStore"];
	$ecPlatformAry = json_decode($ECPlatform_Template);
	$Json = "[";
	foreach($ecPlatformAry as $array)
	{
		$ctlID = $array->name;
		$ckName = $array->value;
		$validFlag = $array->validFlag;
		if (isset($_POST[$ctlID])){
			$ckValue = "1";
		}else{
			$ckValue = "0";	
		}
		if ($Json == "["){
			$Json .= '{"name":"'.$ckName.'","value":"'.$ckValue.'","validFlag":"'.$validFlag.'","ctlID":"'.$ctlID.'"}';
		}else{
			$Json .= ',{"name":"'.$ckName.'","value":"'.$ckValue.'","validFlag":"'.$validFlag.'","ctlID":"'.$ctlID.'"}';
		}
	}
	$Json .= "]";
	$ecPlatform = $Json;
	$deliveryMethodAry = json_decode($deliveryMethod_template);
	$Json = "[";
	foreach($deliveryMethodAry as $array)
	{
		$deliveryMethodId = $array->name;
		$deliveryMethodName = $array->value;
		$validFlag = $array->validFlag;
		if (isset($_POST[$deliveryMethodId])){
			$ckValue = "1";
		}else{
			$ckValue = "0";	
		}
		if ($Json == "["){
			$Json .= '{"name":"'.$deliveryMethodName.'","value":"'.$ckValue.'","validFlag":"'.$validFlag.'","deliveryMethodId":"'.$deliveryMethodId.'"}';
		}else{
			$Json .= ',{"name":"'.$deliveryMethodName.'","value":"'.$ckValue.'","validFlag":"'.$validFlag.'","deliveryMethodId":"'.$deliveryMethodId.'"}';
		}
	}
	$Json .= "]";
	$deliveryMethod = $Json;
	//echo $ecPlatform;
	$stockNumber = $_POST["StockNumber"] == '' ? 0 : $_POST["StockNumber"];
	$safetyNumber = $_POST["SafetyNumber"] == '' ? 0 : $_POST["SafetyNumber"];
	$onStoreNumber = $_POST["OnStoreNumber"] == '' ? 0 : $_POST["OnStoreNumber"];
	$saleNumber = $_POST["SaleNumber"] == '' ? 0 : $_POST["SaleNumber"];
	$maxPurchaseNumber = $_POST["MaxPurchaseNumber"] == '' ? 0 : $_POST["MaxPurchaseNumber"];
	$updateUserID = $currentUserID;
	//將重複的前台展示位置編號清空
	$sql_clearSameSortNo = "UPDATE Products SET SortNo = NULL WHERE SortNo = '$sortNo'";
	//echo $sql_clearSameSortNo;
	mysql_query($sql_clearSameSortNo);
	//products table update
	$update_products_sql = "update Products set 
	ProductName='$productName',
	BrandID=$brandID,
	Status=$status,
	StartDate=$startDate,
	EndDate=$endDate,
	ListPrice=$listPrice,
	UnitPrice=$unitPrice,";
	if($sortNo == NULL){
		$update_products_sql .= "SortNo=NULL,";
	}else{
		$update_products_sql .= "SortNo='$sortNo',";
	}
	$update_products_sql .="ProductFeather='$productFeather',
	YoutubeUrl = '$youtubeUrl',
	ProductDescription='$productDescription',
	ECPlatform = '$ecPlatform',
	DeliveryMethod = '$deliveryMethod',
	NewFlag = 0, "	;
	if($isNew || $productStatus == "3"){
		$update_products_sql .= "CreateUserID = $currentUserID, CreateDate = NOW() ";
	}else{
		$update_products_sql .= "UpdateUserID = $currentUserID, UpdateDate = NOW() ";
	}
	$update_products_sql .= "where ProductID=$productId ";
	//echo $update_products_sql;
	mysql_query($update_products_sql);
	//ProductsCategorys table update
	$ProductsCategorys_Sql = "INSERT INTO ProductsCategorys (ProductID, CategoryID) VALUES ";
	$values_Sql = "";
	$ProductCategory = $_POST["ProductCategory3"];
	if (!empty($_POST["ProductCategory3"])){
		foreach($ProductCategory as $CategoryID) {
			if ($values_Sql == ""){
				$values_Sql .= "('$productId','$CategoryID')";
			}else{
				$values_Sql .= ",('$productId','$CategoryID')";   
			}
		}
	}
	if ($values_Sql != ""){
		$ProductsCategorys_Sql_Delete = "DELETE FROM ProductsCategorys WHERE ProductID = '$productId'";
		mysql_query($ProductsCategorys_Sql_Delete);
		$ProductsCategorys_Sql = $ProductsCategorys_Sql . $values_Sql . ";";
	    //echo $ProductsCategorys_Sql;
		mysql_query($ProductsCategorys_Sql);
	}
	//ProductBarCode table update
	$ProductBarCode_Sql = "INSERT INTO ProductBarCode (ProductID, BarCode, Color, Size, StockNumber, SafetyNumber, MaxPurchaseNumber) VALUES";
	$values_Sql = "";
	$Color = $_POST["txtColor"] ;
	$Size = $_POST["txtSize"];
	$StockNumber = $_POST["txtStockNumber"];
	$SafetyNumber = $_POST["txtSafetyNumber"];
	$BarCode = $_POST["txtBarCode"];
	$MaxPurchaseNumber = $_POST["txtMaxPurchaseNumber"];
	if (!empty($_POST["txtColor"])){
		foreach($Color as $key => $Color) {
			if ($values_Sql == ""){
				$values_Sql .= "('$productId','$BarCode[$key]','$Color','$Size[$key]','$StockNumber[$key]','$SafetyNumber[$key]','$MaxPurchaseNumber[$key]')";
			}else{
				$values_Sql .= ",('$productId','$BarCode[$key]','$Color','$Size[$key]','$StockNumber[$key]','$SafetyNumber[$key]','$MaxPurchaseNumber[$key]')";
			}
		}
	}
	if ($values_Sql != ""){
		$ProductBarCode_Sql_Delete = "DELETE FROM ProductBarCode WHERE ProductID = '$productId'";
		mysql_query($ProductBarCode_Sql_Delete);
		$ProductBarCode_Sql = $ProductBarCode_Sql . $values_Sql . ";";
	    //echo $ProductBarCode_Sql ;
		mysql_query($ProductBarCode_Sql);
	}
    //picture upload
	$targetFolder = "/home/metroasis/public_html/images/products/";
	if (!file_exists($targetFolder)) {
		@mkdir($targetFolder);
	}
	if ($productId != ""){
		$targetFolder = "/home/metroasis/public_html/images/products/$productId";
		if (!file_exists($targetFolder)) {
			@mkdir($targetFolder);
		}
	}
	$target_dir = "/home/metroasis/public_html/images/products/$productId/";
	$ImagefilePath = "/images/products/$productId/";
	$imageArr = array();
	if (isset($_FILES['imgFile'])) {
	    //$ImageFile_Sql_Delete = "DELETE FROM ImagesFiles WHERE ForeignID = '$productId' AND ImageFunction='products' AND ImageType='detail'";
	    //mysql_query($ImageFile_Sql_Delete);
	    $imgName = $_POST["imgName"];
		$ImageID = $_POST["ImageID"];
		$myFile = $_FILES['imgFile'];
		$fileCount = count($myFile["name"]);
		$intWidth = 750;
		$intHight = 750;
		$message = "圖片尺寸不符: ";
		//圖片檢查
		for ($i = 0; $i < $fileCount; $i++) {
			if ($myFile["name"][$i] != ""){
				//echo $ImageID[i];
				$src = imagecreatefromjpeg($myFile['tmp_name'][$i]);
				$src_w = imagesx($src);
				$src_h = imagesy($src);
				if($src_w != $intWidth || $src_h != $intHight){
					$message .= $myFile["name"][$i]. " , ";
				}
			}
		}
		if($message != "圖片尺寸不符: "){
			echo "<script>alert('". $message ."');</script>";
			mysql_query("INSERT INTO Products (`ProductNo`, `BarCode`, `SortNo`, `BrandID`, `ProductCategoryID`, `ProductName`, `ListProductName`, `Color`, `Size`, `ListPrice`, `UnitPrice`, `MemberPrice`, `ProductFeather`, `StockNumber`, `SafetyNumber`, `OnStoreNumber`, `SaleNumber`, `MaxPurchaseNumber`, `Status`, `StartDate`, `EndDate`, `ProductDescription`, `ProductSale`, `ProductRefund`, `RepairService`, `Exclusion`, `ECPlatform`, `YoutubeUrl`, `DeliverExpress`, `TakeFromStore`, `DeliveryMethod`, NewFlag, CreateUserID, CreateDate, UpdateUserID, UpdateDate) SELECT `ProductNo`, `BarCode`, `SortNo`, `BrandID`, `ProductCategoryID`, `ProductName`, `ListProductName`, `Color`, `Size`, `ListPrice`, `UnitPrice`, `MemberPrice`, `ProductFeather`, `StockNumber`, `SafetyNumber`, `OnStoreNumber`, `SaleNumber`, `MaxPurchaseNumber`, `Status`, `StartDate`, `EndDate`, `ProductDescription`, `ProductSale`, `ProductRefund`, `RepairService`, `Exclusion`, `ECPlatform`, `YoutubeUrl`, `DeliverExpress`, `TakeFromStore`, `DeliveryMethod`, 1 AS NewFlag, CreateUserID, CreateDate, UpdateUserID, UpdateDate FROM Products WHERE ProductID = '$productId' ");
			$productId4delete = $productId;
			$productId = mysql_insert_id();
			mysql_query("DELETE FROM Products WHERE ProductID = '$productId4delete'");
			mysql_query("INSERT INTO ProductsCategorys (ProductID, CategoryID) SELECT '$productId', CategoryID FROM ProductsCategorys WHERE ProductID = '$productId4delete'");
			mysql_query("DELETE FROM ProductsCategorys WHERE ProductID = '$productId4delete'");
			
			$rec_barCode = mysql_query("SELECT * FROM ProductBarCode WHERE ProductID = '$productId4delete'");
			mysql_query("DELETE FROM ProductBarCode WHERE ProductID = '$productId4delete'");
			if ($rec_barCode){
				while($row_barCode=mysql_fetch_assoc($rec_barCode)){
					$copy_productNo = $row_barCode["ProductNo"];
					$copy_barCode = $row_barCode["BarCode"];
					$copy_color = $row_barCode["Color"];
					$copy_size = $row_barCode["Size"];
					$copy_stockNumber = $row_barCode["StockNumber"];
					$copy_safetyNumber = $row_barCode["SafetyNumber"];
					$copy_maxPurchaseNumber = $row_barCode["MaxPurchaseNumber"];
					mysql_query("INSERT INTO ProductBarCode (`ProductID`, `ProductNo`, `BarCode`, `Color`, `Size`, `StockNumber`, `SafetyNumber`, `MaxPurchaseNumber`) VALUES('$productId', '$copy_productNo', '$copy_barCode', '$copy_color', '$copy_size', '$copy_stockNumber', '$copy_safetyNumber', '$copy_maxPurchaseNumber')");
				}
			}
		}
		
        # 圖片上傳
		for ($i = 0; $i < $fileCount; $i++) {
			if ($myFile["name"][$i] != ""){
				if($message == "圖片尺寸不符: "){
					if(in_array($myFile["name"][$i], $imgName) && !in_array($myFile["name"][$i], $imageArr)){
						if (move_uploaded_file($myFile['tmp_name'][$i], $target_dir . $myFile["name"][$i])) {
						//if ($ImageID[$i] != ""){
						//	$insert = "UPDATE ImagesFiles SET ImageFileName = '". $myFile["name"][$i] ."' WHERE ImageID = " . $ImageID[$i];
						//}else{
						$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$productId','products','detail','$ImagefilePath','". $myFile["name"][$i] ."')";
						//}                    
						//echo $insert; 
						mysql_query($insert);
						array_push($imageArr, $myFile["name"][$i]);
						} else {
							switch($i){
								case 0:
								$file1Result = "發生錯誤!請重試";
								break;
								case 1:
								$file2Result = "發生錯誤!請重試";
								break;
								case 2:
								$file3Result = "發生錯誤!請重試";
								break;
								case 3:
								$file4Result = "發生錯誤!請重試";
								break;
								case 4:
								$file5Result = "發生錯誤!請重試";
								break;
								case 5:
								$file6Result = "發生錯誤!請重試";
								break;
							}
						}	
					}
					
				}
			}
		}
	}
	//header("Location: productDetail.php?productId=$productId");
	$url = "Location: products.php?status=".$statusForBackToList;
	if($searchBarCode != ""){
		$url .= "&searchBarCode=".$searchBarCodeForBackToList;
	}if($searchKey != ""){
		$url .= "&searchKey=".$searchKeyForBackToList;
	}
	if($searchStartDateFrom != ""){
		$url .= "&searchStartDateFrom=".$searchStartDateFrom;
	}
	if($searchStartDateTo != ""){
		$url .= "&searchStartDateTo=".$searchStartDateTo;
	}
	if($searchUnitPriceFrom != ""){
		$url .= "&searchUnitPriceFrom=".$searchUnitPriceFrom;
	}
	if($searchUnitPriceTo != ""){
		$url .= "&searchUnitPriceTo=".$searchUnitPriceTo;
	}
	if($searchStockNumber != ""){
		$url .= "&searchStockNumber=".$searchStockNumber;
	}
	if($productCategory1ForBackToList != "-1"){
		$url .= "&ProductCategory1=".$productCategory1ForBackToList;
	}
	if($productCategory2ForBackToList != "-1"){
		$url .= "&ProductCategory2=".$productCategory2ForBackToList;
	}
	if($productCategory3ForBackToList != "-1"){
		$url .= "&ProductCategory3=".$productCategory3ForBackToList;
	}
	if($searchBrand != "-1"){
		$url .= "&searchBrand=".$searchBrand;
	}
	if($promotionalActivityArea != "-1"){
		$url .= "&promotionalActivityArea=".$promotionalActivityArea;
	}
	//echo $url;
	if($message == "圖片尺寸不符: "){
		header($url);
	}
	$_SESSION["lastestUpdateProductId"] = $productId;
}
function getUserName($userID) {
	$query_userName_sql = "SELECT UserName FROM SystemUsers WHERE UserID=$userID and Status = 1";
	$query_userName_sql_result = mysql_query($query_userName_sql);
	if($query_userName_sql_result) {
		$row_userInfo=mysql_fetch_assoc($query_userName_sql_result);   
		$currentUserName = $row_userInfo["UserName"];
		return $currentUserName;		
	} else {
		return NULL;
	}
}
function getBrand($brandID) {
	$query_brand_sql = "SELECT * FROM Brand WHERE BrandID=$brandID";
	$query_brand_sql_result = mysql_query($query_brand_sql);
	if($query_brand_sql_result) {
		$row_brand=mysql_fetch_assoc($query_brand_sql_result);   
		return $row_brand;		
	} else {
		return NULL;
	}
}
function getCategory($tableName, $id) {
	$query_parent_sql = "select * from $tableName where id=$id order by CategorySort";
	$query_parent_sql_result = mysql_query($query_parent_sql);
	if($query_parent_sql_result) {
		$query_parent=mysql_fetch_assoc($query_parent_sql_result);   
		return $query_parent;		
	} else {
		return NULL;
	}
}
$tableName = 'Products';
$query_products_sql = "SELECT * FROM $tableName where ProductID = $productId";
$rec = mysql_query($query_products_sql);
$row = $rec ? mysql_fetch_assoc($rec) : NULL;
$barCode_sql = "SELECT vP.* FROM v_ProductCategory vP INNER JOIN ProductsCategorys PC ON vP.P3id = PC.CategoryID WHERE PC.ProductID = '".$row["ProductID"]."' order by Pkey";
$barCode_sql_result = mysql_query($barCode_sql);
if($row) {
	$currentBrand = getBrand($row['BrandID']);
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
<head id="MainMasterHead">
	<title>城市綠洲-後台管理系統</title>
	<meta http-equiv="X-UA-Compatible" content="IE=11, IE=9, IE=8, chrome=10" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="images/logo.png" />
	<link rel="icon" type="image/ico" href="images/favicon_16x16.ico" />
	<link href="css/main.css" type="text/css" rel="stylesheet" />
	<link href="css/colorbox.css" type="text/css" rel="stylesheet" />
	<link href="css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
	<link href="css/jquery.cleditor.css" type="text/css" rel="stylesheet" />
	<link href="css/jquery.treeview.css" rel="stylesheet" />
	<link href="css/flexslider.css" type="text/css" rel="stylesheet" />
	<link href="css/checkbox.css" type="text/css" rel="stylesheet" />
	<link href="css/EricChang.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" charset="UTF-8" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.button.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/jquery.colorbox.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/jquery.blockUI.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/jquery.treeview.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/validateInputFile.js"></script>
	<script type="text/javascript" charset="UTF-8">
		var uploadFiles = [];
		var uploadCount = 1;
		function pageInitial(){
			<? if($isNew){ ?>
				$(document).find(".orange_18_de5106").html("❖ 商品新增");
			<? }else{ ?>
				$(document).find(".orange_18_de5106").html("❖ 商品修改");
			<? } ?>
			//var bodyHeight = document.body.clientHeight;
			//var bodyWidth = document.body.clientWidth;
			//$("#divDetailBody").attr("style", "width:99.3%");
			CKEDITOR.replace("ckeditor",{height:'300',
				//filebrowserBrowseUrl: '/browser/browse.php?type=Files',
				filebrowserUploadUrl: 'upload.php?funcId=products&keyId=<? echo $productId ?>&type=Files',
				on: {
					instanceReady: function() {
						this.dataProcessor.htmlFilter.addRules( {
							elements: {
								img: function( el ) {
			                        // Add an attribute.
			                        if ( !el.attributes.alt )
			                        // Add some class.
			                    el.addClass( 'img-responsive' );
			                }
			            }
			        } );            
					}
				}
			});
			//showProductCategory('ProductCategory2', $("#ProductCategory1").val());
			//showProductCategory('ProductCategory3', $("#ProductCategory2").val());
			$("input[type=submit],input[type=button]").button();
			ProductCagegory1_Initialize('ProductCategory1');
			//ProductCagegory2_Initialize('ProductCategory1','ProductCategory2');
			//ProductCagegory3_Initialize('ProductCategory2','ProductCategory3');
			$("#ProductCategory2").append(new Option("------","-1"));
			$("#ProductCategory3").append(new Option("------","-1"));
		}
		var loadFile = function(event,thisUploadFileBtn){
			var uplaodFileBtn = jQuery(thisUploadFileBtn);
        	
    		var $file = document.getElementById("imgFile"+uploadCount);
			if(!validateMultipleInput($file)){
				uploadCount += 1;
				uplaodFileBtn.after(uplaodFileBtn.clone().attr("id","imgFile"+uploadCount));
				uplaodFileBtn.remove();
				return;
			}
			var invalidFileName = "";
			for(var i = 0 ; i < $file.files.length ; i++){
				if($file.files[i].size >= 2097152){
					invalidFileName += $file.files[i]["name"] + "\n";
				}
			}
			if(invalidFileName != ""){
				alert(invalidFileName+"單一檔案大小應小於2MB");
				uploadCount += 1;
				uplaodFileBtn.after(uplaodFileBtn.clone().attr("id","imgFile"+uploadCount));
				uplaodFileBtn.remove();
				return;
			}
    		//上傳的圖片張數
    		//var uploadImgCount = 0;
    		var uploadImgCount = $file.files.length;
    		
    		//取可用的ImgNo
    		var arrAvailableImgNo = [];
    		$(".imgs").each(function(i, obj){
    			if($(this).attr("src") == undefined || $(this).attr("src") == ""){
    				arrAvailableImgNo.push(i);
    			}
    		});
    		//顯示圖片
    		var showImgCount = 0;
    		if(arrAvailableImgNo.length > 0){
    			$(".imgs").each(function(i, obj){
    				if($.inArray(i, arrAvailableImgNo) != -1){
    					var $thisImg = $(this);
						
			            var reader = new FileReader();
			            reader.onload = function(){
			            	$thisImg.attr('src',reader.result);
			            };
			            reader.readAsDataURL($file.files[showImgCount]);
			            
		                //添加刪除按鈕
		                $thisImg.after("<br/><input type='button' name='ibDelete[]' class='imgCount ui-button ui-widget ui-state-default ui-corner-all' id='ibDelete"+(i+1)+"' value='刪除' onClick=\"delImage(this,'')\" role='button' aria-disabled='false' style='margin-top: 5px;' /><input type='hidden' id='imageName' name='imgName[]' value='"+ $file.files[showImgCount]["name"] +"'/>");
		                showImgCount += 1;
		                if(showImgCount == uploadImgCount){
		                	return false;
		                }
		            }
		        });
    		}
			//處理超過預設張數的圖片
			var maxI = $(".imgs").length;
			if(showImgCount < uploadImgCount){
				for(var i = showImgCount ; i < uploadImgCount ; i++ ){
					maxI += 1;
					var thElement = document.createElement("th");
					thElement.setAttribute("class","thImg");
					thElement.setAttribute("style","background-color:#D9D9D9; width:16%; height:100px;");
					var imgElement = document.createElement("img");
					imgElement.setAttribute("class","imgs");
					imgElement.setAttribute("id","image"+maxI);
					imgElement.setAttribute("width","100%");
					//imgElement.setAttribute("height","100px");
					imgElement.setAttribute("giveMeImg","yes");
					thElement.appendChild(imgElement);
					var brElement = document.createElement("br");
					thElement.appendChild(brElement);
					var inputElement = document.createElement("input");
					inputElement.setAttribute("type","button");
					inputElement.setAttribute("name","ibDelete[]");
					inputElement.setAttribute("id","ibDelete"+maxI);
					inputElement.setAttribute("value","刪除");
					inputElement.setAttribute("onClick","delImage(this,'')");
					inputElement.setAttribute("class","ui-button ui-widget ui-state-default ui-corner-all");
					inputElement.setAttribute("role","button");
					inputElement.setAttribute("aria-disabled","false");
					inputElement.setAttribute("style","margin-top: 5px;");
					thElement.appendChild(inputElement);
					inputElement = document.createElement("input");
					inputElement.setAttribute("type","hidden");
					inputElement.setAttribute("name","imageName[]");
					inputElement.setAttribute("value",$file.files[i]["name"]);
					thElement.appendChild(inputElement);
					$(".thImg").last().after(thElement);
				}
			}
			if(showImgCount < uploadImgCount){
				for(var i = showImgCount ; i < uploadImgCount ; i++ ){
					$(".imgs").each(function(){
						var $thisImg = $(this);
						if($thisImg.attr("giveMeImg") == "yes"){
							var reader = new FileReader();
				            reader.onload = function () {
				                $thisImg.attr('src',reader.result);
				             }
							reader.readAsDataURL($file.files[i]);
							$(this).attr("giveMeImg","no");
							return false;
						}
					});
				}
			}
			uploadCount += 1;
			uplaodFileBtn.after(uplaodFileBtn.clone().attr("id","imgFile"+uploadCount));
			uplaodFileBtn.css("display","none");
		}
		function addTableRow(strTable){
			if (strTable =="tbProductsCategorys"){
				var strElements = $('#tbProductsCategorys tr');
				var intLoop = strElements.length;
				var rowCount = $('#tbProductsCategorys tr').length;
				var strProductCategory1 = $("#ProductCategory1 option:selected").text();
				var strProductCategory2 = $("#ProductCategory2 option:selected").text();
				var strProductCategory3 = $("#ProductCategory3 option:selected").text();
				var valProductCategory1 = $("#ProductCategory1 option:selected").val();
				var valProductCategory2 = $("#ProductCategory2 option:selected").val();
				var valProductCategory3 = $("#ProductCategory3 option:selected").val();
				var strValue = $("#ProductCategory3 option:selected").val();
				var strExistValue = "";
				var intExist = 0;
				if(valProductCategory1 == "-1" || valProductCategory2 == "-1" || valProductCategory3 == "-1"){
					alert("請確實選擇分類！");
					return;
				}
				for (var i = 1; i <= intLoop; i++) {
					strExistValue = $("#ProductCategory3_"+i.toString()).val();
					if ($("#ProductCategory3 option:selected").val() == strExistValue){
						intExist = intExist + 1;
					}
				}
				if (intExist==0){
					var strTemplate = "<tr id='trPC"+rowCount+"'><td class='productCategorySerialNo' style='text-align:center'></td><td>"+strProductCategory1+"</td><td>"+strProductCategory2+"</td><td>"+strProductCategory3+"<input id='ProductCategory3_"+ rowCount +"' name='ProductCategory3[]' type='hidden' value='"+strValue+"'/></td><td style='text-align:center'><input name='btnProductsCategoryDelete' type='button' value='刪除' onClick='delTableRow(this,\"\");' class='ui-button ui-widget ui-state-default ui-corner-all'/></td></tr>";
					$("#tbProductsCategorys").append(strTemplate);
				}else{
					alert("重複選擇了相同的分類！");   
				}
			}
			if (strTable =="tbProductBarCode"){
				var rowCount = $('#tbProductBarCode tr').length;
				var strTemplate = "<tr id='trBC"+rowCount+"'><td class='productBarCodeSerialNo' style='text-align:center'></td><td style='text-align:center'><input id='txtBarCode_"+ rowCount +"' class='TextBoxNum inputBarCode mustHaveAValue' name='txtBarCode[]' type='text' value='' maxlength='8' oninput='this.value=this.value.replace(/[^0-9]/g,\"\");' pkey=''/></td><td style='text-align:center'><input id='txtColor_"+ rowCount +"' class='TextBoxNum' name='txtColor[]' type='text' value=''/></td><td style='text-align:center'><input id='txtSize_"+ rowCount +"' class='TextBoxNum' name='txtSize[]' type='text' value=''/></td><td style='text-align:center'><input id='txtStockNumber_"+ rowCount +"' class='TextBoxNum mustHaveAValue' name='txtStockNumber[]' type='text' oninput='this.value=this.value.replace(/[^0-9]/g,\"\");'/></td><td style='text-align:center'><input id='txtSafetyNumber_"+ rowCount +"' class='TextBoxNum mustHaveAValue' name='txtSafetyNumber[]' type='text' value='' oninput='this.value=this.value.replace(/[^0-9]/g,\"\");'/></td><td style='text-align:center'><input id='txtMaxPurchaseNumber_"+ rowCount +"' class='TextBoxNum mustHaveAValue' name='txtMaxPurchaseNumber[]' type='text' oninput='this.value=this.value.replace(/[^0-9]/g,\"\");'/></td><td style='text-align:center'><input name='btnBarCodeDelete' type='button' value='刪除' onClick='delTableRow(this,\"delProductBarCodeTableRow\");' class='ui-button ui-widget ui-state-default ui-corner-all'/></td></tr>";
				$("#tbProductBarCode").append(strTemplate);
			}
			refreshSerialNo();
		}
		var delProductBarCodePkey = [];
		function delTableRow(row,action){
			if(action == "delProductBarCodeTableRow"){
				delProductBarCodePkey.push($(row).closest("tr").find(".inputBarCode").attr("pkey"));
			}
			$(row).closest("tr").remove();
			refreshSerialNo();
		}
		function delTableAllRow(strTable,action){
			if(action == "delProductBarCodeTableAllRow"){
				$(".inputBarCode").each(function(){
					delProductBarCodePkey.push($(this).attr("pkey"));
				});
				$("#"+strTable).find("tr:gt(0)").remove();
			}
			$("#"+strTable).find("tr:gt(0)").remove();
		}
		function delImage(thisDelBtn,imgId){
			var jqueryObjDelBtn = jQuery(thisDelBtn);
			
			if(imgId == ""){
				jqueryObjDelBtn.parent().find("img[id^='image']").attr("src","");
				jqueryObjDelBtn.parent().find("img[id^='image']").next("br").remove();
				jqueryObjDelBtn.parent().find("input[id='imageName']").remove();
				jqueryObjDelBtn.remove();
				
				return;
			}
			console.log('deleteimage.php?imgid='+ imgId);
			$.ajax({
				url: 'deleteimage.php?imgid='+ imgId,
				type: 'GET',
				async: false,
				success: function(result) {
					console.log(result);
					if (result =="1"){
						jqueryObjDelBtn.parent().find("img[id^='image']").attr("src","");
						jqueryObjDelBtn.parent().find("img[id^='image']").next("br").remove();
						jqueryObjDelBtn.parent().find("input[id^='imageID']").remove();
						jqueryObjDelBtn.remove();
					}
					if (result =="-1"){
						alert('刪除失敗，請重試。'); 	
					}
					stopLoading();
				}, error: function(xhr) { 
					console.log(xhr);
					stopLoading();
					alert('刪除失敗，請重試。'); 
				} 
			});
		}
		function beforeSubmit(){
		    //checkProdutsCategorys(); 
		    showLoading();
		    var textFields = ["ProductName","StartDate","UnitPrice","MemberPrice"];
		    var textNames = ["商品名稱","上架日期","會員價","會員價再確認"];
	    	//var imageFields = ["imgFile1"];
	    	//var imageNames = ["門市照片"];
	    	var trFields = ["productCategorySerialNo","productBarCodeSerialNo"];
	    	var trNames = ["商品分類","商品規格"];
	    	var selectFieleds = ["BrandID"];
	    	var selectNames = ["商品品牌"];
	    	if( ($("#SortNoLeft").prop("selectedIndex") == 0 && $("#SortNoRight").prop("selectedIndex") != 0 )
	    		|| ($("#SortNoLeft").prop("selectedIndex") != 0 && $("#SortNoRight").prop("selectedIndex") == 0) ){
	    		alert("請確認前台展示位置資訊!");
	    		stopLoading();
	    		return false;
	    	}
	    	for (var i = 0; i < selectFieleds.length; i++) {
	    		if($("#"+selectFieleds[i]).val() == "-1"){
	    			alert("請選擇「"+selectNames[i] + "」");
	    			stopLoading();
	    			return false;
	    		}
	    	}
	    	for (var i = 0; i < textFields.length; i++) {
	    		//console.log(textFields[i]+'='+$("#"+textFields[i]).val());
	    		var txt = document.getElementById(textFields[i]);
	    		if (txt.value==""){
	    			alert("請填入「"+textNames[i] + "」");
	    			txt.focus();
	    			stopLoading();
	    			return false;
	    		}
	    	}
	    	for (var i = 0; i < trFields.length; i++) {
	    		//console.log(textFields[i]+'='+$("#"+textFields[i]).val());
	    		if(!$("."+trFields[i]).length){
	    			alert("請填入「"+trNames[i] + "」");
	    			stopLoading();
	    			return false;
	    		}
	    	}
	    	if(!checkProductName()){
	    		alert("商品名稱重複！");
	    		stopLoading();
	    		return false;
	    	}
	    	if(!checkPrice()){
	    		alert("會員價比對結果錯誤，請重新確認！");
	    		stopLoading();
	    		return false;
	    	}
	    	var isBarCodeLenghValid = true;
	    	$(".inputBarCode").each(function(){
	    		if($(this).val().length < 8){
					$(this).css("border-color","red");
					isBarCodeLenghValid = false;
	    		}else{
	    			$(this).css("border-color","");
	    		}
	    	});
	    	if(!isBarCodeLenghValid){
	    		alert("商品條碼必須是8碼數字！");
	    		stopLoading();
		    	return false;
	    	}
	    	var isProductSpecificationOk = true;
	    	$(".mustHaveAValue").each(function(){
	    		if($(this).val() == ""){
	    			$(this).css("border-color","red");
	    			isProductSpecificationOk = false;
	    		}else{
	    			$(this).css("border-color","");
	    		}
	    	});
	    	if(!isProductSpecificationOk){
	    		alert("請確實輸入商品規格的必填欄位！");
	    		stopLoading();
	    		return false;
	    	}
	    	var inputBarCode = [];
	    	var isBarCodeValid = false;
	    	var delPkeyStr = "";
	    	for(var i = 0 ; i < delProductBarCodePkey.length ; i++){
	    		delPkeyStr += delProductBarCodePkey[i] + ",";
	    	}
	    	if(delPkeyStr.length > 0){
	    		delPkeyStr = delPkeyStr.substring(0, delPkeyStr.lastIndexOf(","));
	    	}else{
	    		delPkeyStr = "''";
	    	}
	    	$(".inputBarCode").each(function(){
	    		inputBarCode.push($(this).val());
	    		isBarCodeValid = false;
		    	$.ajax({
		    		type: "GET",
		    		url: "service_productDetail.php?action=checkProductBarCode&BarCode=" + $(this).val() + "&Pkey=" + $(this).attr("pkey") + "&DelPkeyStr=" + delPkeyStr,
		    		dataType: "json",
		    		async: false,
		    		success: function(data) {
	                	isBarCodeValid = data;
	                },
	                error: function(jqXHR) {
	                    //alert("發生錯誤: " + jqXHR.status);
	                }
	            });
	            if(!isBarCodeValid){
	            	$(this).css("border-color","red");
	            }else{
	            	$(this).css("border-color","");
	            }
	    	});
	    	if(!isBarCodeValid){
	    		alert("商品條碼已存在！");
	    		stopLoading();
	    		return false;
	    	}
	    	var counts = {};
	    	for(var i = 0 ; i < inputBarCode.length ; i++){
	    		counts[inputBarCode[i]] = (counts[inputBarCode[i]] || 0) + 1;
	    	}	    	
	    	var isBarCodeDuplicate = false;
	    	$(".inputBarCode").each(function(){
	    		if(counts[$(this).val()] > 1){
	    			$(this).css("border-color","red");
	    			isBarCodeDuplicate = true;
	    		}else{
	    			$(this).css("border-color","");
	    		}
	    	});
	    	if(isBarCodeDuplicate){
	    		alert("商品條碼重複！");
	    		stopLoading();
	    		return false;
	    	}
	    	if($(".imgCount").length == 0){
	    		alert("至少要上傳一張商品圖！");
	    		stopLoading();
	    		return false;
	    	}
	    }
	    function checkProductName(){
	    	var result = false;
	    	$.ajax({
	    		type: "GET",
	    		url: "service_productDetail.php?action=checkProductName&ProductId=<? echo $productId ?>" + 
	    		"&ProductName=" + $("#ProductName").val(),
	    		dataType: "json",
	    		async: false,
	    		success: function(data) {
                	//alert(data);
                	result = data;
                },
                error: function(jqXHR) {
                    //alert("發生錯誤: " + jqXHR.status);
                }
            });
	    	return result;
	    }
	    function refreshSerialNo(){
	    	$(".productCategorySerialNo").each(function(i, obj){
	    		$(this).html(i+1);
	    	});
	    	$(".productBarCodeSerialNo").each(function(i, obj){
	    		$(this).html(i+1);
	    	});
	    }
	    function checkPrice(){
	    	return $("#UnitPrice").val() == $("#MemberPrice").val();
	    }
		$(window).load(function(){
			$(".productStatus").each(function(){
				if($(this).val() == "3"){
					$(this).closest("tr").css("background-color","#ffffdd");
				}
			});
			$(".trProductBarCode").each(function(){
				if($(this).attr("productStatus") == "3"){
					$(this).css("background-color","#ffffdd");
				}
			});
			$("#ProductCategory1").prop( "selectedIndex", 0 );
		});
	</script>
	<style>
		.TextBoxNum
		{
			font-family: Verdana, Book Antiqua;
			border:1px solid #999;
			padding:3px;
			border-radius:4px;
			font-size:12px;
			font-weight:400;
			color:#333;  
			text-align:center; 
			width:100px;
		}
		.Mandatory
		{
			color:Red;
		}
		#tbProductsCategorys, #tbProductBarCode
		{
			font-size: 12px;
		}
	</style>
</head>
<body>
	<div id="divBody" style="width:1600px; margin: 0 auto; ">
		<!-- 加上方選單 -->
		<?php include_once("_nav.php"); ?>
		<div style="overflow: hidden;">
			<!-- 加左方選單 -->
			<?php include_once("left_nav.php"); ?>
			<div id="divWork" style="float: left; width: 90%">
				<div style="padding-left: 5px;">
					<form method="post" action="products.php?page=<? echo $page ?>" >
										<div style="height:10px;"></div>
	                                    <input type="submit" id="ibGo2List"  value="回商品列表"/>
	                                    <div style="height:5px;"></div>
										<input name="status" type="hidden" value="<? echo $statusForBackToList ?>" />
										<input name="ProductCategory1" type="hidden" value="<? echo $productCategory1ForBackToList ?>" />
										<input name="ProductCategory2" type="hidden" value="<? echo $productCategory2ForBackToList ?>" />
										<input name="ProductCategory3" type="hidden" value="<? echo $productCategory3ForBackToList ?>" />
										<input name="searchBarCode" type="hidden" value="<? echo $searchBarCodeForBackToList ?>" />
										<input name="searchKey" type="hidden" value="<? echo $searchKeyForBackToList ?>" />
										<input name="searchStartDateFrom" type="hidden" value="<? echo $searchStartDateFrom ?>" />
										<input name="searchStartDateTo" type="hidden" value="<? echo $searchStartDateTo ?>" />
										<input name="searchUnitPriceFrom" type="hidden" value="<? echo $searchUnitPriceFrom ?>" />
										<input name="searchUnitPriceTo" type="hidden" value="<? echo $searchUnitPriceTo ?>" />
										<input name="searchStockNumber" type="hidden" value="<? echo $searchStockNumber ?>" />
										<input name="searchBrand" type="hidden" value="<? echo $searchBrand ?>" />
										<input name="promotionalActivityArea" type="hidden" value="<? echo $promotionalActivityArea ?>" />
					</form>
					<!-- 修改商品資訊 -->
						<? if($isNew){ ?>
							<div id="productInfo" style="display: none;">
						<?	}else{ ?>
							<div id="productInfo">
						<?	} ?>
							<table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
							style="border-collapse: collapse;">
							<tr>
								<th scope="col" style="width: 3%;"><input name="chkAll" type="checkbox" class="checkbox" value="0" disabled="true"></th>
								<th scope="col" style="width: 3%;">#</th>
								<th scope="col" style="width: 5%;">狀態</th>
								<th scope="col" style="width: 7%;">商品圖</th>
                                <th scope="col" style="width: 7%;">品牌</th>
								<th scope="col" style="width: 25%;">前台展示位置 / 分類 / 名稱</th>
								<th scope="col" style="width: 10%;"><s>市價</s> / 會員價</th>
								<th scope="col" style="width: 30%;">條碼 / 顏色 / 尺寸 / 最高可購量 / 最低庫存量 / 目前庫存量</th>
								<th scope="col" style="width: 9%;">更新時間</th>
							</tr>
							<? 
							$rowCount = 1;
							$recProducts = mysql_query($query_product_sql);
							if($recProducts){
								while($rowRecProduct=mysql_fetch_assoc($recProducts)){ ?>
								<tr>
									<td align="center">
										<input name="chkProduct" type="checkbox" class="checkbox" value="0" disabled="true">
									</td>
									<td align="center">
										<span class="b_12"><? echo $_GET["serialNo"] ?></span>
									</td>
									<td align="center">
										<? if($rowRecProduct["Status"] == "3"){ ?>
											<span class="b_12">-</span>
										<? }else{ 
												if ($rowRecProduct["Status"] == "1"){
													if($rowRecProduct["StartDate"] > date("Y-m-d H:i:s") ){
										?>
														<span class="b_12">預登錄</span>
										<?		
													}else if($rowRecProduct["EndDate"] != NULL && $rowRecProduct["EndDate"] <= date("Y-m-d H:i:s")){
										?>
														<img src="images/down_red.png" width="28px" height="28px"/>
										<?
													}else{
										?>
														<img src="images/up_green.png" width="28px" height="28px" />
										<?
													}
												}else{
										?>
													<img src="images/down_red.png" width="28px" height="28px"/>
										<?		}	
											} ?>
										<input class="productStatus" type="hidden" value="<? echo $rowRecProduct["Status"]; ?>"/>
									</td>
									<td align="center">
										<? if ($rowRecProduct["ImageFileName"] !="") {?>
										<img src="/images/products/<?echo $rowRecProduct["ProductID"]?>/<?echo $rowRecProduct["ImageFileName"]?>" width="64px" height="64px" /> 
										<? }else{ ?>
											<span class="b_12">-</span>
										<? } ?>
									</td>
                                    <td align="center">
                                    	<? 
										$query_brandName_sql = "SELECT BrandName FROM Brand WHERE BrandID = '" . $rowRecProduct["BrandID"] . "'";
										$query_brandName_sql_result = mysql_query($query_brandName_sql);
										$row_brandName=mysql_fetch_assoc($query_brandName_sql_result);  
										$brandName = $row_brandName["BrandName"];
										echo "<span class='b_12'>".$brandName."</span>";
										echo "<br/>";
										?>
									</td>
									<td align="left" valign="top">
										<span class="blue_14"><b><? echo $rowRecProduct["SortNo"] ? $rowRecProduct["ActivityName"].substr($rowRecProduct["SortNo"],1,2) : "-" ?></b></span>
                                        <br/>
										<? $query_pc_sql = "SELECT concat('∎ ',vP.P1CategoryName,' > ',vP.P2CategoryName,' > ',vP.P3CategoryName) AS CategoryName FROM ProductsCategorys PC INNER JOIN v_ProductCategory vP ON PC.CategoryID = vP.P3id WHERE PC.ProductID ='". $rowRecProduct["ProductID"] . "'";
										$recPC = mysql_query($query_pc_sql);
										$PC = "";
										while($rowPC=mysql_fetch_assoc($recPC)){
											if ($PC ==""){
												$PC.= $rowPC["CategoryName"] . "<br/>";
											}else{
												$PC.= $rowPC["CategoryName"] . "<br/>";
											}
										}
										echo "<span class='green_12' style='line-height:180%'>".$PC."</span>";
										?>
										<? echo $rowRecProduct["ProductName"]; ?>
									</td>
									<td align="center">
										<? if($rowRecProduct["Status"] == "3"){ ?>
										<span class="light_gray_12">NT$ -<br></span>
										<span class="b_12">NT$ -</span>
										<? }else{ ?>
										<span class="light_gray_12"><s>NT$ <? echo $rowRecProduct["ListPrice"]; ?></s><br></span>
										<span class="b_12">NT$ <? echo $rowRecProduct["UnitPrice"]; ?></span>
										<? } ?>
									</td>
									<td align="center" valign="center">
												<?	$query_pb_sql = "SELECT * FROM ProductBarCode WHERE ProductID ='". $rowRecProduct["ProductID"] . "'";
												$recPB = mysql_query($query_pb_sql);
												$rowNums=mysql_num_rows($recPB);
												if ($rowNums > 0)
												{
													while($rowPB=mysql_fetch_assoc($recPB)){
														?>
													<table class="TableLine" cellpadding="0" cellspacing="0" width="100%">
														<tr class="trProductDetail trProductBarCode" productStatus="<? echo $rowRecProduct["Status"] ?>">
															<td style="width:20%; text-align:center;"><span class="b_12"><? echo $rowPB["BarCode"]; ?></span></td>
															<td style="width:20%"><span class="b_12"><? echo $rowPB["Color"]; ?></span></td>
															<td style="width:15%; text-align:center;"><span class="b_12"><? echo $rowPB["Size"]; ?></span></td>
															<td style="width:15%" align="right"><span class="b_12"><? echo $rowPB["MaxPurchaseNumber"]; ?></span></td>
															<td style="width:15%" id="safetyNumber" align="right"><? echo $rowPB["SafetyNumber"]; ?></td>
															<td style="width:15%" id="safetyNumber" align="right"><? echo $rowPB["StockNumber"]; ?></td>
														</tr>
													</table>
													<? } }else{ ?>
														<span class="b_12">-</span>
													<? } ?>
											</td>
											<td align="center">
												<? if($rowRecProduct["Status"] == "3"){ ?>
													<span class="b_12">-</span>
												<? }else{ 
													if($row["UpdateDate"] != NULL && $row["UpdateDate"] != ""){
												?>
													<span class="b_12"><? $UpdateDate = date_create($row["UpdateDate"]); echo date_format($UpdateDate,"Y/m/d") . "<br />" . date_format($UpdateDate,"H:i:s"); ?></span>
												<? }else{ ?>
													<span class="b_12">-</span>
												<? } } ?>
											</td>
										</tr>
										<? $rowCount = $rowCount + 1; } }?>
							</table>
						</div>
					<!-- 修改商品資訊 -->
				</div>
                <div style="height:10px;"></div>
				<div class="divWorkArea" style="height:auto; margin-bottom: 100px;">
					<div id="UpdatePanel1">
						<form name="form1" method="post" action="" id="form1" enctype="multipart/form-data">
							<div id="divDetailBody" class="divDetailBody" style="width:100%;padding-top:0px">
								<!--<div id="divDetail" style="overflow: auto">-->
								<table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
									<tr>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span class="Mandatory">＊狀態</span>
										</td>
										<td align="center" bgcolor="#FFFFFF" style="width: 9%">
											<table class="RadioButtonList" border="0" >
												<tr>
													<?
													$checked_0 = '';
													$checked_1 = '';
													if ($row["Status"] == 0) {
														$checked_0 = 'checked';
													} else {
														$checked_1 = 'checked';
													}
													?>
													<td>
														<input type="radio" name="Status" value="1" <?echo $checked_1?> />
														<label for="rblStatus_1">上架</label>
													</td>
													<td>
														<input type="radio" name="Status" value="0" <?echo $checked_0?> />
														<label for="rblStatus_0">下架</label>
														<span>&nbsp</span>
													</td>
												</tr>
											</table>
										</td>
										<td align="center" bgcolor="#e5e5e5" style="width: 6%">
											<span  class="DetailLabel">前台展示位置</span>
											<!--<br>
											<span class="gray_12">(第一碼A-J, 第二碼1-8)</span>-->
										</td>
										<td align="center" bgcolor="#FFFFFF" style="width: 10%">
											<!--<input name="SortNo" style="width:95%" type="text" id="sortNo" class="TextBox" value="<?echo $row["SortNo"]?>" maxlength="2" onkeyup="this.value=this.value.toUpperCase()"/>-->
											<select name="SortNoLeft" id="SortNoLeft" class="dropdownlist" style="width: 60%">
												<option value="">------</option>
											<? 
											$rec_promotionalActivity = mysql_query("SELECT Area, ActivityName FROM PromotionalActivity WHERE ValidFlag = '1' ");
											if($rec_promotionalActivity){
												while($row_promotionalActivity = mysql_fetch_assoc($rec_promotionalActivity)){
													if(substr($row["SortNo"],0,1) == $row_promotionalActivity["Area"]){
											?>
												<option value="<? echo $row_promotionalActivity["Area"] ?>" selected="true"><? echo $row_promotionalActivity["ActivityName"] ?></option>
											<?
													}else{
											?>
												<option value="<? echo $row_promotionalActivity["Area"] ?>"><? echo $row_promotionalActivity["ActivityName"] ?></option>
											<?
													}
												}
											}
											?>
											</select>
											<select name="SortNoRight" id="SortNoRight" class="dropdownlist" style="width: 30%">
												<option value="-1">------</option>
											<? 
												for($i = 1 ; $i <= 8 ; $i ++){
													if(substr($row["SortNo"],1) == $i){
											?>
												<option value="<? echo $i ?>" selected="true"><? echo $i ?></option>
											<?
													}else{
											?>
												<option value="<? echo $i ?>"><? echo $i ?></option>
											<?
													}
												}
											?>
											</select>
										</td>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span  class="Mandatory">＊商品品牌</span>
										</td>
										<td align="center" bgcolor="#FFFFFF">
											<?
											$brand_sql = "SELECT * FROM Brand WHERE 1";
											$brand_sql_result = mysql_query($brand_sql);
											?>
											<select name="BrandID" id="BrandID" class="dropdownlist">
												<option value="-1">------</option>
												<? while($brand = mysql_fetch_assoc($brand_sql_result)){ ?>
												<?if($currentBrand && $currentBrand["BrandID"] == $brand["BrandID"]) { ?>
												<option value="<? echo $brand["BrandID"] ?>" selected="true"><?echo $brand["BrandName"] ?></option>
												<?} else {?>
												<option value="<? echo $brand["BrandID"] ?>" ><?echo $brand["BrandName"] ?></option>	
												<?}}?>
											</select>
										</td>
										<td align="center" bgcolor="#e5e5e5" style="width: 13%">
											<span class="Mandatory">＊上架日期</span>
											<br>
											<span class="gray_12">(YYYY-MM-DD)</span>
										</td>
										<td align="center" bgcolor="#FFFFFF" style="width: 7%">
											<input name="StartDate" id="StartDate" type="date" style="width:95%" class="TextBox" value="<?echo $row["StartDate"] ? date("Y-m-d", strtotime($row["StartDate"])) : date('Y-m-d');?>"/>
										</td>
										<td align="center" bgcolor="#e5e5e5" style="width: 13%">
											<span>下架日期</span>
											<br>
											<span class="gray_12">(YYYY-MM-DD)</span>
										</td>
										<td align="center" bgcolor="#FFFFFF" style="width: 7%">
											<input name="EndDate" type="date" style="width:95%" class="TextBox"  value="<?echo $row["EndDate"] ? date("Y-m-d", strtotime($row["EndDate"])) : NULL;?>"/>
										</td>
									</tr>
									<tr>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span class="Mandatory">＊商品名稱</span>
										</td>
										<td align="center" colspan="3" bgcolor="#FFFFFF">
											<input id="ProductName" name="ProductName" type="text" class="TextBox" style="width:98%" value="<?echo $row["ProductName"]?>"/>
										</td>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span><s>市價</s></span>
										</td>
										<td align="center" bgcolor="#FFFFFF">
											<input name="ListPrice" style="width:95%" type="number" class="TextBox" value="<?echo $row["ListPrice"]?>"/>
										</td>
										<td align="center" bgcolor="#e5e5e5" style="width: 13%">
											<span class="Mandatory">＊會員價</span>
										</td>
										<td align="center" bgcolor="#FFFFFF">
											<input name="UnitPrice" id="UnitPrice" style="width:95%" type="number" class="TextBox"  value="<?echo $row["UnitPrice"]?>"/>
										</td>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span class="Mandatory">＊會員價再確認</span>
										</td>
										<td align="center" bgcolor="#FFFFFF">
											<input name="MemberPrice" id="MemberPrice" style="width:95%" type="number" class="TextBox" value="<?echo $row["MemberPrice"]?>"/>
										</td>
									</tr>
									<tr>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span  class="DetailLabel">配送方式</span>
										</td>
										<td align="left" colspan="3" bgcolor="#FFFFFF" >
											<?  
											$deliveryMethodArr = json_decode($row["DeliveryMethod"]);
											foreach($deliveryMethodArr as $array){
												$deliveryMethodId = $array->deliveryMethodId;
												$validFlag = "0";
												foreach($deliveryMethodAry as $checkArray){
													if($deliveryMethodId == $checkArray->name){
														$validFlag = $checkArray->validFlag;
														break;
													}
												}
												if($validFlag == "1"){
													if ($array->value == "1"){
														$ecValue="1";
														$ecCheck = "checked";
													}else{
														$ecValue="0";
														$ecCheck = "";
													}
												?>
												<input type="checkbox" id="<? echo $deliveryMethodId ?>" name="<? echo $deliveryMethodId ?>" class="regular-checkbox" value="<? echo $ecValue ?>" <? echo $ecCheck ?> /><label for="<? echo $deliveryMethodId ?>"><? echo $array->name ?></label>
											<? }
											}?>
										</td>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span class="DetailLabel">YouTube連結</span>
										</td>
										<td align="center" colspan="5" bgcolor="#FFFFFF" >
											<input name="YoutubeUrl" style="width: 99%;" type="text" class="TextBox" value="<?echo $row["YoutubeUrl"]?>"/>
										</td>
									</tr>
									<tr>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span  class="DetailLabel">已上架商城</span>
										</td>
										<td align="left" colspan="9" bgcolor="#FFFFFF">
											<?  
											$ecPlatform = json_decode($row["ECPlatform"]);
											foreach($ecPlatform as $array){
												$ctlID = $array->ctlID;
												$validFlag = "0";
												foreach($ecPlatformAry as $checkArray){
													if($ctlID == $checkArray->name){
														$validFlag = $checkArray->validFlag;
														break;
													}
												}
												if($validFlag == "1"){
													if ($array->value == "1"){
														$ecValue="1";
														$ecCheck = "checked";
													}else{
														$ecValue="0";
														$ecCheck = "";
													}
												?>
												<input type="checkbox" id="<? echo $ctlID ?>" name="<? echo $ctlID ?>" class="regular-checkbox" value="<? echo $ecValue ?>" <? echo $ecCheck ?> /><label for="<? echo $ctlID ?>"><? echo $array->name ?></label>
											<? }
											}?>
										</td>
									</tr>
									<tr>
										<td style="width: 10%" align="center" bgcolor="#e5e5e5"><span class="Mandatory">＊商品分類</span></td>
										<td colspan="9">
											<table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
												<tr>
													<td>
														<select name="ProductCategory1" id="ProductCategory1" class="dropdownlist" onChange="ProductCagegory1_SelectOnChange(this.value,'ProductCategory2','ProductCategory3')">
														</select>
														<select name="ProductCategory2" id="ProductCategory2" class="dropdownlist" onChange="ProductCagegory2_SelectOnChange(this.value,'ProductCategory3')">
														</select>
														<select name="ProductCategory3" id="ProductCategory3" class="dropdownlist">
														</select>
														<input name="btnAddCategory" type="button" style="padding-top: 5px;" value="新增分類" onclick="addTableRow('tbProductsCategorys')" />
													</td>
												</tr>
												<tr>
													<td>
														<table id="tbProductsCategorys" class="TableLine" border="1px" cellpadding="5px" width="500px" bordercolor="#BABAD2">   
															<tr>
																<th style="background-color:#D9D9D9">#</th>
																<th style="background-color:#D9D9D9">大分類</th>
																<th style="background-color:#D9D9D9">中分類</th>
																<th style="background-color:#D9D9D9">小分類</th>
																<th style="background-color:#D9D9D9">
                                                                	<input name="btnDelAllRow" type="button" value="全部刪除" onclick="delTableAllRow('tbProductsCategorys','');" />
                                                                </th>
                                                            </tr>
																<?  $BarCode_sql_result = "SELECT * FROM ProductsCategorys PC INNER JOIN v_ProductCategory vP ON PC.CategoryID = vP.P3id WHERE PC.ProductID ='".$row["ProductID"]."'";
																$recBarCode = mysql_query($BarCode_sql_result);
																$rowCount = "1";
																while($BarCodeRow = mysql_fetch_assoc($recBarCode))
																{
																	?>
																	<tr id="trPC<? echo $rowCount?>">
																		<td style="text-align:center"class="productCategorySerialNo"><? echo $rowCount?></td>
																		<td style="text-align:center"><? echo $BarCodeRow["P1CategoryName"]?></td>
																		<td style="text-align:center"><? echo $BarCodeRow["P2CategoryName"]?></td>
																		<td style="text-align:center"><? echo $BarCodeRow["P3CategoryName"]?>
																		<input id="ProductCategory3_<? echo $rowCount ?>" name="ProductCategory3[]" type="hidden" value="<? echo $BarCodeRow["CategoryID"]?>"/>
																		</td>
																		<td style="text-align:center"><input name="btnProductsCategoryDelete" type="button" value="刪除" onClick="delTableRow(this,'');"/></td>
																	</tr>
																	<? $rowCount = $rowCount + 1;
																}
																?>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td style="width: 10%" align="center" bgcolor="#e5e5e5"><span class="Mandatory">＊商品規格</span></td>
										<td colspan="9" >
											<input name="btnAddCategory" type="button" value="新增規格" style="margin-bottom: 5px;" onclick="addTableRow('tbProductBarCode')" /><br>
											<table id="tbProductBarCode" class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
												<tr>
													<th style="background-color:#D9D9D9; width:5%">#</th>
													<th style="background-color:#D9D9D9; width:15%"><span class="Mandatory">＊條碼</span></th>
													<th style="background-color:#D9D9D9; width:15%">顏色</th>
													<th style="background-color:#D9D9D9; width:15%">尺寸</th>
													<th style="background-color:#D9D9D9; width:15%"><span class="Mandatory">＊目前庫存量</span></th>
													<th style="background-color:#D9D9D9; width:15%"><span class="Mandatory">＊最低庫存量</span></th>
													<th style="background-color:#D9D9D9; width:15%"><span class="Mandatory">＊最高購買數量</span></th>
													<th style="background-color:#D9D9D9; width:10%">
                                                    	<input name="btnDelAllRow" type="button" value="全部刪除" onclick="delTableAllRow('tbProductBarCode','delProductBarCodeTableAllRow');" />
                                                    </th>
												</tr>
													<?  $BarCode_sql_result = "SELECT * FROM ProductBarCode WHERE ProductID = '".$row["ProductID"] ."'";
													$recBarCode= mysql_query($BarCode_sql_result);
													$rowCount = "1";
													while($BarCodeRow = mysql_fetch_assoc($recBarCode)) {
														?>
														<tr id="trBC<? echo $rowCount?>">
															<td class='productBarCodeSerialNo' style='text-align:center'><? echo $rowCount?></td>
															<td style="text-align:center">
                                                            <input id="txtBarCode_<? echo $rowCount?>" class="TextBoxNum inputBarCode mustHaveAValue" name="txtBarCode[]" type="text" value="<? echo $BarCodeRow["BarCode"] ?>" maxlength="8" oninput="this.value=this.value.replace(/[^0-9]/g,'');" pkey="<? echo $BarCodeRow["Pkey"] ?>"/>
                                                            </td>
															<td style="text-align:center"><input id="txtColor_<? echo $rowCount?>" class="TextBoxNum" name="txtColor[]" type="text" value="<? echo $BarCodeRow["Color"] ?>" /></td>
															<td style="text-align:center"><input id="txtSize_<? echo $rowCount?>" class="TextBoxNum" name="txtSize[]" type="text" value="<? echo $BarCodeRow["Size"] ?>" /></td>
															<td style="text-align:center"><input id="txtStockNumber_<? echo $rowCount?>" class="TextBoxNum mustHaveAValue" name="txtStockNumber[]" type="text" value="<? echo $BarCodeRow["StockNumber"] ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/></td>
															<td style="text-align:center"><input id="txtSafetyNumber_<? echo $rowCount?>" class="TextBoxNum mustHaveAValue" name="txtSafetyNumber[]" type="text" value="<? echo $BarCodeRow["SafetyNumber"] ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/></td>
															<td style="text-align:center"><input id="txtMaxPurchaseNumber_<? echo $rowCount?>" class="TextBoxNum mustHaveAValue" name="txtMaxPurchaseNumber[]" type="text" value="<? echo $BarCodeRow["MaxPurchaseNumber"] ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/></td>
															<td style="text-align:center"><input name="btnBarCodeDelete" type="button" value="刪除" onClick="delTableRow(this,'delProductBarCodeTableRow');"/></td>
														</tr>
														<? $rowCount = $rowCount + 1;
													}?>
											</table>
											<br/>
										</td>
									</tr>
									<tr>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span class="Mandatory">＊商品圖</span>
											<br>
											<span class="gray_12">(750 * 750)</span>
											<br>
                                            <br>
											<input type="file" name="imgFile[]" id="imgFile1" accept="image/jpg, image/jpeg" onchange="loadFile(event, this)" style="width:70px" multiple>
										</td>
										<td colspan="9" >
											<div style="overflow-x: scroll;">
											<table id="tbImage" class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2" style="table-layout: fixed">
												<tr>
													<?  $Image_sql_result = "SELECT concat(ImagePath,ImageFileName) as ImageFile, ImageID FROM ImagesFiles WHERE ImageFunction = 'products' AND ImageType ='detail' AND ForeignID ='".$row["ProductID"] . "' ORDER BY ImageID";
													$recImage = mysql_query($Image_sql_result);
													$rowCount = "1";
													while($ImageRow = mysql_fetch_assoc($recImage)) {
														?>
														<th class="thImg" style="background-color:#D9D9D9; width:16%; height:100px;">
															<img id="image<? echo $rowCount?>" class="imgs" width="100%" src="<? echo $ImageRow["ImageFile"]?>" />
															<input class="imgID" id="imageID<? echo $rowCount?>" type="hidden" name="ImageID[]" value="<? echo $ImageRow["ImageID"]?>"/>
															<br/>
															<input type="button" name="ibDelete[]" class="imgCount" id="ibDelete<?echo $rowCount?>" value="刪除" onClick="showLoading();delImage(this,'<? echo $ImageRow["ImageID"]?>')" />
														</th>
														<?  $rowCount = $rowCount + 1; 
													}
													if ($rowCount < 6){
														for ($x = $rowCount; $x <=6; $x++){
															?>
															<th class="thImg" style="background-color:#D9D9D9; width:16%; height:100px;">
																<img class="imgs" id="image<? echo $x?>" width="100%"/>
															</th>                                           
															<?
														}
													}
													?>
												</tr>
											</table>
											</div>
											<br/>
										</td>
									</tr>
									<tr>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span  class="DetailLabel">商品特色</span>
										</td>
										<td colspan="9" bgcolor="#FFFFFF" >
											<textarea name="ProductFeather" id="ProductFeather" style="width:100%; padding: 0px" class="TextBox" rows="10" cols="100"><?echo $row["ProductFeather"]?></textarea>
										</td>
									</tr>
									<tr>
										<td align="center" bgcolor="#e5e5e5" style="width: 10%">
											<span style="font-size: 10pt;">詳細說明</span>
				                            <br>
                            				<a target="_blank" href="howToUploadPictureInCkEditor.html"><span class="blue_10"><u>上傳圖片說明</u></span></a>
										</td>
										<td colspan="9">
											<textarea name="ProductDescription" id="ckeditor" rows="10" cols="100"><?echo $row["ProductDescription"]?></textarea>
										</td>
									</tr>
									<tr>
										<table class="TableLine" cellpadding="0" cellspacing="0" width="100%">
											<tr style="height: 35px;">
												<td align="center" bgcolor="#e5e5e5" style="width: 12.5%; height:40px">
													<span class="DetailLabel">建立人員</span>
												</td>
												<td align="center" bgcolor="#FFFFFF" style="width: 12.5%; text-align: center;">
													<? if($isNew || $productStatus == "3"){ ?>
														<span class="b_12">-</span>
													<? }else{ ?>
														<span class="b_12"><? echo getUserName($row["CreateUserID"])?></span>
													<? } ?>
												</td>
												<td align="center" bgcolor="#e5e5e5" style="width: 12.5%">
													<span  class="DetailLabel">建立時間</span>
												</td>
												<td align="center" bgcolor="#FFFFFF" style="width: 12.5%; text-align: center;">
													<? if($isNew || $productStatus == "3"){ ?>
														<span class="b_12">-</span>
													<? }else{ ?>
														<span class="b_12"><? echo date_format(new DateTime($row["CreateDate"]),"Y/m/d") ?></span>
														<br>
														<span class="b_12"><? echo date_format(new DateTime($row["CreateDate"]),"H:i:s") ?></span>
													<? } ?>
												</td>
												<td align="center" bgcolor="#e5e5e5" style="width: 12.5%">
													<span class="DetailLabel">更新人員</span>
												</td>
												<td align="center" bgcolor="#FFFFFF" style="width: 12.5%; text-align: center;">
													<? if($isNew || $productStatus == "3"){ ?>
														<span class="b_12">-</span>
													<? }else{ ?>
														<? if($row["UpdateUserID"] != NULL){ ?>
														<span class="b_12"><? echo getUserName($row["UpdateUserID"])?></span>
														<? }else{ ?>
														<span class="b_12">-</span>
														<? } ?>
													<? } ?>
												</td>
												<td align="center" bgcolor="#e5e5e5" style="width: 12.5%">
													<span  class="DetailLabel">更新時間</span>
												</td>
												<td align="center" bgcolor="#FFFFFF" style="width: 12.5%; text-align: center;">
													<? if($isNew || $productStatus == "3"){ ?>
														<span class="b_12">-</span>
													<? }else{ ?>
														<? if($row["UpdateDate"] != NULL){ ?>
														<span class="b_12"><? echo date_format(new DateTime($row["UpdateDate"]),"Y/m/d") ?></span>
														<br>
														<span class="b_12"><? echo date_format(new DateTime($row["UpdateDate"]),"H:i:s") ?></span>
														<? }else{ ?>
															<span class="b_12">-</span>
														<? } ?>
													<? } ?>
												</td>
											</tr>
										</table>
									</tr>
								</table>
								<br /><br />
								<div style="width:100%; text-align:center">
									<? if (!$isNew && $productStatus != "3") {?>	
									<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit();" style="font-size:12pt; height:35px" />
									<input type="hidden" name="action" value="update"/>
									<? } else { ?>							
									<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit();" style="font-size:12pt; height:35px" />
									<input type="hidden" name="action" value="update"/>	
									<? } ?>
								</div>
								<br />
								<br />
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input id="productID" name="productID" type="hidden" value="<? echo $productID?>"/>
	</body>
	</html>
<? include_once('_productcategorys.php'); ?>				