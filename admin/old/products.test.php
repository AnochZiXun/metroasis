<?php
include_once("_connMysql.php");
include_once("check_login.php");
include_once("_productcategorys.php");
include_once("css/EricChang.css");
$currentUserID = $_SESSION["userID"];
$status = isset($_POST["status"]) ? $_POST["status"] : (isset($_GET["status"]) ? $_GET["status"] : "");
$productCategory1 = isset($_POST["ProductCategory1"]) ? $_POST["ProductCategory1"] : (isset($_GET["ProductCategory1"]) ? $_GET["ProductCategory1"] : "-1");
$productCategory2 = isset($_POST["ProductCategory2"]) ? $_POST["ProductCategory2"] : (isset($_GET["ProductCategory2"]) ? $_GET["ProductCategory2"] : "-1");
$productCategory3 = isset($_POST["ProductCategory3"]) ? $_POST["ProductCategory3"] : (isset($_GET["ProductCategory3"]) ? $_GET["ProductCategory3"] : "-1");
$searchBarCode = isset($_POST["searchBarCode"]) ? $_POST["searchBarCode"] : (isset($_GET["searchBarCode"]) ? $_GET["searchBarCode"] : "");
$searchKey = isset($_POST["searchKey"]) ? $_POST["searchKey"] : (isset($_GET["searchKey"]) ? $_GET["searchKey"] : "");
$searchStartDateFrom = isset($_POST["searchStartDateFrom"]) ? $_POST["searchStartDateFrom"] : (isset($_GET["searchStartDateFrom"]) ? $_GET["searchStartDateFrom"] : "");
$searchStartDateTo = isset($_POST["searchStartDateTo"]) ? $_POST["searchStartDateTo"] : (isset($_GET["searchStartDateTo"]) ? $_GET["searchStartDateTo"] : "");
$searchUnitPriceFrom = isset($_POST["searchUnitPriceFrom"]) ? $_POST["searchUnitPriceFrom"] : (isset($_GET["searchUnitPriceFrom"]) ? $_GET["searchUnitPriceFrom"] : "");
$searchUnitPriceTo = isset($_POST["searchUnitPriceTo"]) ? $_POST["searchUnitPriceTo"] : (isset($_GET["searchUnitPriceTo"]) ? $_GET["searchUnitPriceTo"] : "");
$searchStockNumber = isset($_POST["searchStockNumber"]) ? $_POST["searchStockNumber"] : (isset($_GET["searchStockNumber"]) ? $_GET["searchStockNumber"] : "");
$searchBrand = isset($_POST["searchBrand"]) ? $_POST["searchBrand"] : (isset($_GET["searchBrand"]) ? $_GET["searchBrand"] : "-1");
$promotionalActivityArea = isset($_POST["promotionalActivityArea"]) ? $_POST["promotionalActivityArea"] : (isset($_GET["promotionalActivityArea"]) ? $_GET["promotionalActivityArea"] : "-1");
$product_sql_Delete = "DELETE FROM Products WHERE ProductName IS NULL";
mysql_query($product_sql_Delete);
if($_POST["action"] == "update"){ 
	$barCode = $_POST["barCode"];
	$stockNumber = $_POST["StockNumber"];
	$productId = $_POST["productID"];
	foreach($productId as $key => $productId) {
		if ($stockNumber == ""){
			$stockNumber = 0;
		}
		$sql_update_productBarCode = "UPDATE Products SET UpdateDate = NOW() WHERE ProductID = $productId";
		mysql_query($sql_update_productBarCode);
		$sql_update_productBarCode = "UPDATE ProductBarCode SET StockNumber = '$stockNumber[$key]' WHERE productID = $productId AND BarCode='$barCode[$key]'";	
	    //echo $update_sql;
		mysql_query($sql_update_productBarCode);
	}
}
$query_product_sql = "SELECT P.ProductID, P.SortNo, P.ProductCategoryID, P.BrandID, P.ProductName,IFNULL(P.UnitPrice, 0) as UnitPrice,IFNULL(P.ListPrice, 0) as ListPrice,Status, P.CreateDate, P.UpdateDate, (SELECT ImageFileName FROM `ImagesFiles` WHERE `ImageFunction` = 'products' AND `ImageType` = 'detail' AND `ForeignID` = P.ProductID ORDER BY ImageFileName DESC  LIMIT 1) AS ImageFileName ";
$productTableName = "FROM Products P";
$query_product_sql = "$query_product_sql $productTableName WHERE 1";
//$orderBy = ' order by P.StartDate desc';
$orderBy = "ORDER BY obov, UpdateDate DESC";
$sql_lastestUpdateProduct = "SELECT IFNULL(ProductID,'-') AS ProductID FROM Products WHERE UpdateUserID = $currentUserID AND UpdateDate IS NOT NULL ORDER BY UpdateDate DESC LIMIT 1";
$rec_lastestUpdateProduct = mysql_query($sql_lastestUpdateProduct);
$row_lastestUpdateProduct = mysql_fetch_assoc($rec_lastestUpdateProduct);
$lastestUpdateProductId = $row_lastestUpdateProduct["ProductID"];
//複製的商品
$sql_copyProduct = $query_product_sql. " AND Status = 3 AND CreateUserID = $currentUserID";
$recCopyProduct = mysql_query($sql_copyProduct);
$countCopyProduct = $recCopyProduct ? mysql_num_rows($recCopyProduct) : 0;
//最新一筆該USER更新過的商品
$condition1 = "AND ProductID = '$lastestUpdateProductId'";
//必填欄位為空的商品(以防萬一)
$condition2 = "AND ProductID != '$lastestUpdateProductId' AND Status != '3' AND (BrandID IS NULL OR ProductName IS NULL OR Status IS NULL OR StartDate IS NULL OR UnitPrice IS NULL OR ProductID NOT IN (SELECT DISTINCT a.ProductID FROM Products a JOIN ProductsCategorys b ON a.ProductID = b.ProductID) OR ProductID NOT IN (SELECT DISTINCT a.ProductID FROM Products a JOIN ProductBarCode b ON a.ProductID = b.ProductID) OR ProductID NOT IN (SELECT DISTINCT a.ProductID FROM Products a JOIN ImagesFiles b ON a.ProductID = b.ForeignID AND b.ImageFunction = 'products') ) ";
$whereIsTheEndOfThisProject = "AND (BrandID IS NOT NULL AND ProductName IS NOT NULL AND Status IS NOT NULL AND StartDate IS NOT NULL AND UnitPrice IS NOT NULL AND ProductID IN (SELECT DISTINCT a.ProductID FROM Products a JOIN ProductsCategorys b ON a.ProductID = b.ProductID) AND ProductID IN (SELECT DISTINCT a.ProductID FROM Products a JOIN ProductBarCode b ON a.ProductID = b.ProductID) AND ProductID IN (SELECT DISTINCT a.ProductID FROM Products a JOIN ImagesFiles b ON a.ProductID = b.ForeignID AND b.ImageFunction = 'products') ) ";
//已上架 且 目前庫存量<=最低庫存量 的商品, 且必填欄位不能為空...
$condition3 = "AND ProductID != '$lastestUpdateProductId' AND Status = 1 AND (SELECT COUNT(*) FROM ProductBarCode WHERE ProductID = P.ProductID AND StockNumber <= SafetyNumber) > 0 ". $whereIsTheEndOfThisProject;
//已下架的商品, 且必填欄位不能為空...
$condition4 = "AND ProductID != '$lastestUpdateProductId' AND Status = 0 ". $whereIsTheEndOfThisProject;
//已上架 且 庫存充足 的商品, 且必填欄位不能為空...
$condition5 = "AND ProductID != '$lastestUpdateProductId' AND Status = 1 AND (SELECT COUNT(*) FROM ProductBarCode WHERE ProductID = P.ProductID AND StockNumber <= SafetyNumber) = 0 ". $whereIsTheEndOfThisProject;
$query_product_sql = "P.ProductID, P.SortNo, P.ProductCategoryID, P.BrandID, P.ProductName,IFNULL(P.UnitPrice, 0) as UnitPrice,IFNULL(P.ListPrice, 0) as ListPrice,Status, P.CreateDate, P.UpdateDate,(SELECT ImageFileName FROM ImagesFiles WHERE ImageFunction = 'products' AND ImageType = 'detail' AND ForeignID = P.ProductID LIMIT 1) AS ImageFileName, P.StartDate FROM Products P WHERE 1";
$query_product_sql = "SELECT * FROM (". 
"(SELECT 1 AS obov, $query_product_sql $condition1)". "UNION".
"(SELECT 2 AS obov, $query_product_sql $condition2)". "UNION".
"(SELECT 3 AS obov, $query_product_sql $condition3)". "UNION".
"(SELECT 4 AS obov, $query_product_sql $condition4)". "UNION".
"(SELECT 5 AS obov, $query_product_sql $condition5)". 
") AS P WHERE 1 ";
if(isset($_POST["status"])){
	if($status == '1' || $status == '0') {
		$query_product_sql =$query_product_sql . ' and P.Status = '. $status;
	}
}
if($productCategory1 != "-1") {
	$query_product_sql =$query_product_sql . " and P.ProductID in (SELECT P.ProductID FROM ProductsCategorys WHERE ProductID = P.ProductID and CategoryID IN (SELECT P3.id FROM ProductCategory1 P1, ProductCategory2 P2, ProductCategory3 P3 WHERE P1.id = '$productCategory1' and P2.ParentCategoryId = P1.id and P3.ParentCategoryId = P2.id)) ";
}
if($productCategory2 != "-1") {
	$query_product_sql =$query_product_sql . " and P.ProductID in (SELECT P.ProductID FROM ProductsCategorys WHERE ProductID = P.ProductID and CategoryID IN (SELECT P3.id FROM ProductCategory1 P1, ProductCategory2 P2, ProductCategory3 P3 WHERE P1.id = '$productCategory1' and P2.id = '$productCategory2' and P3.ParentCategoryId = P2.id)) ";
}
if($productCategory3 != "-1") {
	$query_product_sql =$query_product_sql . " and P.ProductID in (SELECT P.ProductID FROM ProductsCategorys WHERE ProductID = P.ProductID and CategoryID IN (SELECT P3.id FROM ProductCategory1 P1, ProductCategory2 P2, ProductCategory3 P3 WHERE P1.id = '$productCategory1' and P2.id = '$productCategory2' and P3.id = '$productCategory3')) ";
}
if($searchBarCode != ""){
	$query_product_sql = $query_product_sql.' and P.ProductID IN (SELECT ProductID FROM ProductBarCode WHERE BarCode LIKE "%'.$searchBarCode.'%") ';
}
if(trim($searchKey," ") != ""){
	$query_product_sql = $query_product_sql.' and P.ProductName like "%'.$searchKey.'%" ';
}
if($searchStartDateFrom != ""){
	$query_product_sql = $query_product_sql.' and P.StartDate >= "'.$searchStartDateFrom.'" ';
}
if($searchStartDateTo != ""){
	$query_product_sql = $query_product_sql.' and P.StartDate <= "'.$searchStartDateTo.'" ';
}
if($searchUnitPriceFrom != ""){
	$query_product_sql = $query_product_sql.' and P.UnitPrice >= '.$searchUnitPriceFrom.' ';
}
if($searchUnitPriceTo != ""){
	$query_product_sql = $query_product_sql.' and P.UnitPrice <= '.$searchUnitPriceTo.' ';
}
if($searchStockNumber != ""){
	$query_product_sql = $query_product_sql." and P.ProductID IN (SELECT ProductID FROM ProductBarCode WHERE StockNumber < $searchStockNumber)";
}
if($searchBrand != "-1"){
	$query_product_sql =$query_product_sql ." and P.BrandID = '$searchBrand' ";
}
if($promotionalActivityArea != "-1"){
	$query_product_sql = $query_product_sql." and P.SortNo IS NOT NULL and LEFT(P.SortNo,1) = '$promotionalActivityArea' order by CONVERT(LEFT(SortNo,1), char(1)),CONVERT(SUBSTRING(SortNo,2,3),UNSIGNED INTEGER)";
}
/*
if(isset($_POST["ProductNo"]) or isset($_POST["searchKey"])) {
    $productNo = trim($_POST["ProductNo"]);
	$productName = trim($_POST["ProductName"]);
    $query_product_sql = $productNo ? $query_product_sql.' and ProductNo like "%'.$productNo.'%" ' : $query_product_sql;  
	$query_product_sql = $productName ? $query_product_sql.' and ProductName like "%'.$productName.'%" ' : $query_product_sql;
}
*/
//echo $query_product_sql;
$recProducts = mysql_query($query_product_sql);
$query_product_sql = $query_product_sql;
//delete
if($_POST["action"] == "delete") {
	$productId = $_POST["ProductId"];
	$delete_barcode_sql = "delete from ProductBarCode where ProductID='$productId'";
	mysql_query($delete_barcode_sql);
	$deleteSql = "delete from Products where ProductID = '$productId'";
	mysql_query($deleteSql);	
	header("Location: products5.php");
}
//copy
if($_POST["action"] == "copy") {
	//先刪除已存在的複製商品
	$sql_deleteCopyProduct = "DELETE FROM Products WHERE Status = '3' AND CreateUserID = $currentUserID";
	mysql_query($sql_deleteCopyProduct);
	$productId = $_POST["ProductId"];
	$copy_sql = "insert into Products (BarCode, BrandID, ProductCategoryID, ProductName, ListProductName, Color, Size, ProductFeather, StockNumber, SafetyNumber, OnStoreNumber, SaleNumber, MaxPurchaseNumber, Status, ProductDescription, ProductSale, ProductRefund, RepairService, Exclusion, ECPlatform, DeliverExpress, TakeFromStore, CreateUserID) 
	SELECT BarCode, BrandID, ProductCategoryID, ProductName, ListProductName, Color, Size, ProductFeather, StockNumber, SafetyNumber, OnStoreNumber, SaleNumber, MaxPurchaseNumber, 3, 	  ProductDescription, ProductSale, ProductRefund, RepairService, Exclusion, ECPlatform, DeliverExpress, TakeFromStore, '$currentUserID' 
	from Products where ProductID = $productId";
	mysql_query($copy_sql);
	$copy_productId = mysql_insert_id();							
	$copy_barcode_sql = "INSERT INTO ProductBarCode(ProductID, Color, Size, StockNumber, SafetyNumber, MaxPurchaseNumber) 
	SELECT $copy_productId, Color, Size, StockNumber, SafetyNumber, MaxPurchaseNumber 
	FROM ProductBarCode WHERE ProductID = $productId";
	mysql_query($copy_barcode_sql);
	$copy_productCategory_sql = "INSERT INTO ProductsCategorys(ProductID, CategoryID) SELECT $copy_productId, CategoryID FROM ProductsCategorys WHERE ProductID = $productId";
	mysql_query($copy_productCategory_sql);
	header("Location: products5.php?action=afterCopy");
}
//預設每頁筆數
$pageRow_records = 10;
//總筆數
$total_records = $recProducts ? mysql_num_rows($recProducts) : 0;
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if(!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
 }else {
 	if($promotionalActivityArea != "-1"){
     	$page=1;
 	}else{
 		$page = intval($_GET["page"]); //確認頁數只能夠是數值資料
 	}
 }
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
//echo $query_product_sql;
$recProducts = mysql_query($query_product_sql.' LIMIT '.$start.', '.$pageRow_records);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="MainMasterHead">
	<title>城市綠洲-商品型錄</title>
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
	<script type="text/javascript" charset="UTF-8" src="js/jquery-1.7.2.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.button.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.tabs.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.progressbar.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.accordion.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/jquery.colorbox.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/fullcalendar.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/jquery.maskedinput-1.3.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/jquery.blockUI.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/jquery.cookie.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/jquery.treeview.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" charset="UTF-8">		
		function pageInitial(){
			var bodyHeight = document.body.clientHeight;
			//$("#divDetailBody").attr("style", "height:" + (bodyHeight - 105) + "px");
			$(".detail").colorbox({ iframe: true, width: "100%", height: "100%", overlayClose: false, escKey: false, 
				onClosed: function () { location.href="products.php"; } });
			$(".add").colorbox({ iframe: true, width: "100%", height: "100%", overlayClose: false, escKey: false, 
				href: "productDetail.php",
				onClosed: function () { location.href="products.php"; }	});
			$("input[type=submit], input[type=button]" ).button();
			ProductCagegory1_Initialize('ProductCategory1');
			$("#ProductCategory1").prop("selectedIndex", 0);
			$("#ProductCategory2").append(new Option("------","-1"));
			$("#ProductCategory3").append(new Option("------","-1"));
		}
		function transfer2Detail(productId, productStatus, $this){
			var serialNo = $("#"+$this.id).closest("tr").find("#serialNo").html();
			var status = $("#status").val();
			var searchBarCode = $("#searchBarCode").val();
			var searchKey = $("#searchKey").val();
			var productCategory1 = $("#ProductCategory1").val();
			var productCategory2 = $("#ProductCategory2").val();
			var productCategory3 = $("#ProductCategory3").val();
			var searchStartDateFrom = $("#searchStartDateFrom").val();
			var searchStartDateTo = $("#searchStartDateTo").val();
			var searchUnitPriceFrom = $("#searchUnitPriceFrom").val();
			var searchUnitPriceTo = $("#searchUnitPriceTo").val();
			var searchStockNumber = $("#searchStockNumber").val();
			var searchBrand = $("#searchBrand").val();
			var promotionalActivityArea = $("#showPromotionalActivity").val();
			var page = <? echo $page ?>;
			location.href = "productDetail5.php?productId=" + productId + "&status=" + status + "&searchBarCode=" + searchBarCode + "&searchKey=" + searchKey + "&productCategory1=" + productCategory1 +"&serialNo=" + serialNo + "&productStatus=" + productStatus + "&page=" + page + "&productCategory2=" + productCategory2 + "&productCategory3=" + productCategory3 + "&searchStartDateFrom=" + searchStartDateFrom + "&searchStartDateTo=" + searchStartDateTo + "&searchUnitPriceFrom=" + searchUnitPriceFrom + "&searchUnitPriceTo=" + searchUnitPriceTo+ "&searchStockNumber=" + searchStockNumber +"&searchBrand=" + searchBrand + "&promotionalActivityArea=" + promotionalActivityArea;
		}
		function checkBeforeCopy(){
			//檢查有無已複製, 未編輯的商品
			var result = false;
			$.ajax({
				url: "service_products.php?action=checkBeforeCopy&CreateUserID=<? echo $currentUserID ?>",
				type: 'GET',
				dataType: "json",
				async: false,
				success: function(data) {
					if(data == true){
						if (confirm('確認複製此商品？')){ 
							result = true;
						}else{
							result = false;
						}
					}else{
						if (confirm('是否取代現有複製商品？')){ 
							result = true;
						}else{
							result = false;
						}
					}
				}, error: function(xhr) {
					alert("STATUS:"+xhr.status);
					result = false
				} 
			});
			return result;
		}
		function onChangeProductCategory1(){
			ProductCagegory1_SelectOnChange($("#ProductCategory1").val(),'ProductCategory2','ProductCategory3');
			$("#ProductCategory2").find("option").first().html("全部");
			$("#ProductCategory3").find("option").first().html("全部");
		}
		function onChangeProductCategory2(){
			ProductCagegory2_SelectOnChange($("#ProductCategory2").val(),'ProductCategory3')
			$("#ProductCategory3").find("option").first().html("全部");
		}
		function resetSearchForm(){
			$(".resetSelect").each(function(){
				$(this).prop("selectedIndex", 0);
			});
			$(".resetText").each(function(){
				$(this).val("");
			});
			$(".resetDate").each(function(){
				$(this).val("");
			});
			$("#ProductCategory2").html("");
			$("#ProductCategory2").append(new Option("全部","-1"));
			$("#ProductCategory3").html("");
			$("#ProductCategory3").append(new Option("全部","-1"));
			
			//document.getElementById("startSearch").reset();
		}
		function submitSearchForm(){
			$("#startSearch").submit();
		}
		function resetCategorySelect(){
			$("#showPromotionalActivity").prop("selectedIndex", 0);
		}
		function showPromotionalActivity(){
			resetSearchForm();
			var promotionalActivityArea = $("#showPromotionalActivity").val();
			$("#promotionalActivityArea").val(promotionalActivityArea);
			
			$("#startSearch").submit();
		}
		$(window).load(function(){
			$(".trProductDetail").css("background-color", "#ffffff");
			$(".safetyNumber").css("background-color", "#f2e6e6");
			$(".stockNumber").css("background-color", "#f2e6e6");
			$(".trProductDetail").each(function(i, obj){
				if(parseInt($(this).find("#stockNumber").val()) <= parseInt($(this).find("#safetyNumber").html())){
        			$(this).css("background-color", "#fadcdc");
        		}
        	});
			$(".TableNoLine").css("font-size","10pt");
			$(".productStatus").each(function(){
				if($(this).val() == "3"){
					$(this).closest("tr").css("background-color","#ffffd3");
				}
			});
			$(".trCopyProductBarCode").each(function(){
					$(this).css("background-color","#ffffd3");
			});
			if("update" == "<? echo $_POST["action"] ?>"){
				$(".btnSaveStockNumber").first().before("<span class='red_12'>更新成功  </span>");
			}
			$("#status").find("option").each(function(){
				if($(this).val() == "<? echo $status ?>"){
					$(this).attr("selected","true");
				}
			});
			$("#ProductCategory1").find("option").each(function(){
				if($(this).val() == "<? echo $productCategory1 ?>"){
					$(this).attr("selected","true");
				}
			});
			if("<? echo $productCategory1 ?>" != "-1"){
				$("#ProductCategory2").html("");
				ProductCagegory2_Initialize('ProductCategory1','ProductCategory2');
			}
			$("#ProductCategory2").find("option").each(function(){
				if($(this).val() == "<? echo $productCategory2 ?>"){
					$(this).attr("selected","true");
				}
			});
			if("<? echo $productCategory2 ?>" != "-1"){
				$("#ProductCategory3").html("");
				ProductCagegory3_Initialize('ProductCategory2','ProductCategory3');
			}
			$("#ProductCategory3").find("option").each(function(){
				if($(this).val() == "<? echo $productCategory3 ?>"){
					$(this).attr("selected","true");
				}
			});
			$("#ProductCategory1").find("option").first().html("全部");
			$("#ProductCategory2").find("option").first().html("全部");
			$("#ProductCategory3").find("option").first().html("全部");
			$("#searchBrand").find("option").each(function(){
				if($(this).val() == "<? echo $searchBrand ?>"){
					$(this).attr("selected","true");
				}
			});
			$("#showPromotionalActivity").find("option").each(function(){
				if($(this).val() == "<? echo $promotionalActivityArea ?>"){
					$(this).attr("selected","true");
				}
			});
		});
	</script>
	<style>
		.TextBoxNum
		{
			font-family: Verdana, Book Antiqua;
			border:1px solid #999;
			padding:3px;
			border-radius:4px;
			font-size:10px;
			font-weight:400;
			color:#333;
			text-align:center; 
			width:50px;
		}
		.Mandatory
		{
			color:Red;
		}
	</style>
</head>
<body>
	<div id="divBody" style="width:1600px; margin: 0 auto; ">
		<!-- 加上方選單 -->
		<?php include("_nav.php"); ?>
		<div style="overflow: hidden;">
			<!-- 加左方選單 -->
			<?php include("left_nav.php"); ?>
			<div id="divWork" style="float: left; width: 89%">
				<div class="divWorkArea" style="height:auto; margin-bottom: 100px">
					<div id="UpdatePanel1">
						<!-- 複製商品區 -->
						<? if($countCopyProduct > 0){ ?>
						<div style="overflow: auto">
							<div><br>
								<table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" style="border-collapse: collapse;">
									<tr>
										<th scope="col" style="width: 3%;"><input name="chkAll" type="checkbox" class="checkbox" value="0" disabled="true"></th>
										<th scope="col" style="width: 3%;">#</th>
										<th scope="col" style="width: 5%;">狀態</th>
										<th scope="col" style="width: 7%;">商品圖</th>
                                        <th scope="col" style="width: 8%;">品牌</th>
										<th scope="col" style="width: 25%;">前台展示位置 / 分類 / 名稱</th>
										<th scope="col" style="width: 10%;"><s>市價</s> / 會員價</th>
										<th scope="col" style="width: 30%;">條碼 / 顏色 / 尺寸 / 最高可購量 / 最低庫存量 / 目前庫存量</th>
										<th scope="col" style="width: 9%;">更新時間</th>
										<th scope="col" style="width: 6%;">功能</th>
									</tr>
									<? 
									if($recCopyProduct){
										while($rowCopyProduct=mysql_fetch_assoc($recCopyProduct)){ ?>
										<tr>
											<td align="center">
												<input name="chkProduct" type="checkbox" class="checkbox" value="0" disabled="true">
											</td>
											<td align="center">
												<span class="b_12" id="serialNo">-</span>
											</td>
											<td align="center">
												<span class="b_12">-</span>
												<input class="productStatus" type="hidden" value="<? echo $rowCopyProduct["Status"]; ?>"/>
											</td>
											<td align="center">
												<? if ($rowCopyProduct["ImageFileName"] !="") {?>
												<img src="/images/products/<?echo $rowCopyProduct["ProductID"]?>/<?echo $rowCopyProduct["ImageFileName"]?>" width="64px" height="64px" /> 
												<? }else{ ?>
													<span class="b_12">-</span>
												<? } ?>
											</td>
                                            <td align="center">
                                            	<? 
												$query_brandName_sql = "SELECT BrandName FROM Brand WHERE BrandID = '" . $rowCopyProduct["BrandID"] . "'";
												$query_brandName_sql_result = mysql_query($query_brandName_sql);
												$row_brandName=mysql_fetch_assoc($query_brandName_sql_result);  
												$brandName = $row_brandName["BrandName"];
												echo "<span class='b_12'>".$brandName."</span>";
												echo "<br/>";
												?>
											</td>
											<td align="left" valign="top">
												<span class="blue_14"><b><? echo $rowCopyProduct["SortNo"] ? $rowCopyProduct["SortNo"] : "-" ?></b></span><br>
												<? $query_pc_sql = "SELECT concat('∎ ',vP.P1CategoryName,' > ',vP.P2CategoryName,' > ',vP.P3CategoryName) AS CategoryName FROM ProductsCategorys PC INNER JOIN v_ProductCategory vP ON PC.CategoryID = vP.P3id WHERE PC.ProductID ='". $rowCopyProduct["ProductID"] . "'";
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
												<? echo $rowCopyProduct["ProductName"]; ?>
											</td>
											<td align="center">
												<span class="light_gray_12"><s>NT$ -</s><br></span><span class="b_12">NT$ -</span>
											</td>
											<td align="center" valign="center">
														<?	$query_pb_sql = "SELECT * FROM ProductBarCode WHERE ProductID ='". $rowCopyProduct["ProductID"] . "'";
														$recPB = mysql_query($query_pb_sql);
														$rowNums=mysql_num_rows($recPB);
														if ($rowNums > 0) {
														?>
													<table class="TableLine" cellpadding="0" cellspacing="0" width="100%">
														<?	while($rowPB=mysql_fetch_assoc($recPB)){
														?>
															<tr class="trProductDetail trCopyProductBarCode">
																<td style="width:20%; text-align:center;"><span class="b_12">-<? echo $rowPB["BarCode"]; ?></span></td>
																<td style="width:20%"><span class="b_12"><? echo $rowPB["Color"]; ?></span></td>
																<td style="width:15%; text-align:center;"><span class="b_12"><? echo $rowPB["Size"]; ?></span></td>
																<td style="width:15%" align="right"><span class="b_12"><? echo $rowPB["MaxPurchaseNumber"]; ?></span></td>
																<td style="width:15%" id="safetyNumber" align="right"><? echo $rowPB["SafetyNumber"]; ?></td>
																<td style="width:15%" align="right">
																	<span class="b_12"><? echo $rowPB["StockNumber"]; ?></span>
																</td>
															</tr>
														<? } ?>
													</table>
													<? }else{ ?>	
														<span class="b_12">-</span>
													<? } ?>
											</td>		
											<td align="center">
												<span class="b_12">-</span>
											</td>
											<td align="center">
												<input name="btnEdit" id="etnEdit" type="button" value="修改" onclick="transfer2Detail('<?echo $rowCopyProduct["ProductID"]?>', '<?echo $rowCopyProduct["Status"]?>',this)"/>
												<form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
													<input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) return false;" style="float:top;margin-top:6px;"/>
													<input name="ProductId" type="hidden" value="<? echo $rowCopyProduct["ProductID"]; ?>"/>
													<input name="action" type="hidden" value="delete"/>
												</form>
											</td>
										</tr>
									<? } } ?>		
								</table><br>
							</div>
						</div>			
						<? } ?>	
						<!-- 複製商品區 -->
									<div class="SeachBar divDetailBody" style="height: fit-content; padding-top: 1px; padding-bottom: 1px;">
										<form action="" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
										<table cellspacing="0" cellpadding="0" border="0" width="100%">
										  <tr>
                                            <td height="180" valign="top" style="background-color:#ebeffa; padding-top:10px">
                                            	<table cellpadding="0" cellspacing="0" width="96%" align="center">
                                                  <tr>
                                                    <td height="5" colspan="10" bgcolor="#ebeffa"></td>
                                                  </tr>
                                                  <tr>
                                                    <td height="5" colspan="10" bgcolor="#ebeffa"></td>
                                                  </tr>
                                                  <tr>
                                                    <td width="6%" height="40" align="right" valign="middle" bgcolor="#ebeffa"><span class="b_13">狀態：</span></td>
                                                    <td width="14%" align="left" valign="middle" bgcolor="#ebeffa">
                                                      <select name="status" id="status" style="width: 60px" class="dropdownlist resetSelect">
                                                            <!--<option value="" selected="selected"></option>-->
                                                            <option value="-1" selected="true">全部</option>
                                                            <option value="1" >上架</option>
                                                            <option value="0">下架</option>
                                                      </select>
                                                    </td>
                                                    <td width="5%" height="40" align="right" valign="middle" bgcolor="#ebeffa">
                                                  		<span class="b_13">商品品牌：</span>
                                                  	</td>
                                                  	<td width="18%" align="left" valign="middle" bgcolor="#ebeffa">
                                                    	<select name="searchBrand" id="searchBrand" class="dropdownlist resetSelect">
														<option value="-1">全部</option>
														<?	
														$query_productBrand_sql = "SELECT BrandID, BrandName FROM Brand";
														$rec_productBrand = mysql_query($query_productBrand_sql);
														$rowNums_productBrand = mysql_num_rows($rec_productBrand);
														if ($rowNums_productBrand > 0)
														{
															while($productBrand=mysql_fetch_assoc($rec_productBrand)){
																?>
																<option value="<?echo $productBrand["BrandID"]?>"><?echo $productBrand["BrandName"]?></option>
														<?	} } ?>
														</select>
                                                    </td>
                                                    <td width="5%"  align="right" valign="middle" bgcolor="#ebeffa"><span class="b_13">分類：</span></td>
                                             		<td width="20%" align="left" valign="middle" bgcolor="#ebeffa">
                                                        <select name="ProductCategory1" id="ProductCategory1" class="dropdownlist resetSelect" onChange="onChangeProductCategory1()">
                                                      </select>
                                                        <select name="ProductCategory2" id="ProductCategory2" class="dropdownlist resetSelect" onChange="onChangeProductCategory2()">
                                                        </select>
                                                        <select name="ProductCategory3" id="ProductCategory3" class="dropdownlist resetSelect">
                                                        </select>
                                                    </td>
                                                    <td width="6%"  align="right" valign="middle" bgcolor="#ebeffa"><span class="b_13">條碼：</span></td>
                                                    <td width="10%" align="left" valign="middle" bgcolor="#ebeffa">
							  							<input type="text" class="TextBox resetText" id="searchBarCode" name="searchBarCode" style="width:80px" 
                                                        	   value="<? echo $searchBarCode ?>" maxlength="8" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
                                                    </td>
                                                    <td width="8%"  align="right" valign="middle" bgcolor="#ebeffa"><span class="b_13">目前庫存量：&nbsp;<&nbsp;&nbsp;</span></td>
													<td width="8%" align="left" valign="middle" bgcolor="#ebeffa">
							  							<input type="text" class="TextBox resetText" id="searchStockNumber" name="searchStockNumber" style="width:40px" 
                                                        	   value="<? echo $searchStockNumber ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td height="5" colspan="10" bgcolor="#ebeffa"></td>
                                                  </tr>
                                                  <tr>
                                                    <td height="40" align="right" valign="middle" bgcolor="#ebeffa"><span class="b_13">商品名稱：</span></td>
                                                    <td align="left" valign="middle" bgcolor="#ebeffa">
                                                    	<input type="text" class="TextBox resetText" id="searchKey" name="searchKey" style="width:150px" value="<? echo $searchKey ?>">
													</td>
                                                    <td align="right" valign="middle" bgcolor="#ebeffa"><span class="b_13">會員價：</span></td>
                                                    <td align="left" valign="middle" bgcolor="#ebeffa">
                                                    	<span class="b_12">NT$ </span>
													  <input type="text" class="TextBox resetText" id="searchUnitPriceFrom" name="searchUnitPriceFrom" style="width:60px" 
                                                        	   value="<? echo $searchUnitPriceFrom ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
														<span class="b_12">&nbsp;~&nbsp;&nbsp;NT$ </span>
														<input type="text" class="TextBox resetText" id="searchUnitPriceTo" name="searchUnitPriceTo" style="width:60px" 
                                                        	   value="<? echo $searchUnitPriceTo ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
                                            		</td>
                                                    <td align="right" valign="middle" bgcolor="#ebeffa"><span class="b_13">上架日期：</span></td>
                                      				<td colspan="5" align="left" valign="middle" bgcolor="#ebeffa">
                                       					<input name="searchStartDateFrom" id="searchStartDateFrom" type="date" style="width:130px" 
                                                               class="TextBox resetDate" value="<?echo $searchStartDateFrom ? date("Y-m-d", strtotime($searchStartDateFrom)) : "";?>"/>
                                                    	<span class="b_13">&nbsp;~&nbsp;</span>
														<input name="searchStartDateTo" id="searchStartDateTo" type="date" style="width:130px"
                                                        	   class="TextBox resetDate" value="<?echo $searchStartDateTo ? date("Y-m-d", strtotime($searchStartDateTo)) : "";?>"/>	
                                                        <span class="gray_10">(YYYY/MM/DD)</span>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td height="5" colspan="10" bgcolor="#ebeffa"></td>
                                                  </tr>
                                                  <tr>
                                                    <td colspan="10" height="50" align="center" valign="bottom">
                                                    	<input type="button" id="resetBtn" onClick="resetSearchForm();resetCategorySelect();submitSearchForm();" value="重設" 
                                                        	   class="ui-button ui-widget ui-state-default ui-corner-all"/>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    	<input name="submitSearch" type="submit" value="查詢"/>
                                                    	<input type="hidden" name="promotionalActivityArea" id="promotionalActivityArea" value="-1"/>
                                                    </td>
                                                  </tr>
                                                </table>
											</td>
                                          </tr>
										</table>
										</form>
									</div>
										<table cellpadding="0" cellspacing="0" width="100%">
                                          <tr>
                                          	<td align="left" height="50" valign="bottom" style="padding-bottom:5;">
                                          		<span class="b_13">檢視前台展示商品：</span>
                                           		 <select id="showPromotionalActivity" class="dropdownlist" onChange="showPromotionalActivity()">
													<option value="-1">------</option>
                                          			<?	
														$sql_query_promotionActivity = "SELECT Area, ActivityName FROM PromotionalActivity WHERE ValidFlag = '1' ORDER BY Area ";
														$rec_promotionActivity = mysql_query($sql_query_promotionActivity);
														$rowNums_rec_promotionActivity = mysql_num_rows($rec_promotionActivity);
														if ($rowNums_rec_promotionActivity > 0)
														{
															while($promotionActivity=mysql_fetch_assoc($rec_promotionActivity))
															{
													?>
																<option value="<?echo $promotionActivity["Area"]?>"><?echo $promotionActivity["ActivityName"]?></option>
													<?		} 
														} 
													?>
                                          		</select>
                                          	</td>
                                            <td align="right" height="50" valign="bottom" style="padding-bottom:5;">
                                            	<input type="button" name="ibAdd" id="ibAdd"  value=" 新增商品 " onClick="javascript:location.href='productDetail5.php?page=<?echo $page?>&status=<?echo $status?>&productCategory1=<?echo $productCategory1?>&searchBarCode=<?echo $searchBarCode?>&searchKey=<?echo $searchKey?>&productCategory2=<?echo $productCategory2?>&productCategory3=<?echo $productCategory3?>&searchStartDateFrom=<?echo $searchStartDateFrom?>&searchStartDateTo=<?echo $searchStartDateTo?>&searchUnitPriceFrom=<?echo $searchUnitPriceFrom?>&searchUnitPriceTo=<?echo $searchUnitPriceTo?>&searchStockNumber=<?echo $searchStockNumber?>&searchBrand=<?echo $searchBrand?>'"/>
                                            </td>
                                          </tr>
                                        </table>
											<div id="divDetailBody" class="divDetailBody" style="padding-top: 0px; padding-bottom: 0px;">
												<div id="divGridview" style="overflow: auto">
													<div>
														<table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
														style="border-collapse: collapse;">
														<tr>
															<th scope="col" style="width: 3%;"><input name="chkAll" type="checkbox" class="checkbox" value="0"></th>
															<th scope="col" style="width: 3%;">#</th>
															<th scope="col" style="width: 5%;">狀態</th>
															<th scope="col" style="width: 7%;">商品圖</th>
                                                            <th scope="col" style="width: 8%;">品牌</th>
															<th scope="col" style="width: 25%;">前台展示位置 / 分類 / 名稱</th>
															<th scope="col" style="width: 10%;"><s>市價</s> / 會員價</th>
															<th scope="col" style="width: 30%;">條碼 / 顏色 / 尺寸 / 最高可購量 / 最低庫存量 / 目前庫存量</th>
															<th scope="col" style="width: 9%;">更新時間</th>
															<th scope="col" style="width: 6%;">功能</th>
														</tr>
														<? 
														$rowCount = 1;
														if($recProducts){
															while($row=mysql_fetch_assoc($recProducts)){ ?>
															<tr>
																<td align="center">
																	<input name="chkProduct" type="checkbox" class="checkbox" value="0">
																</td>
																<td align="center">
																	<span class="b_13" id="serialNo"><? echo $start + $rowCount ?></span>
																</td>
																<td align="center">
																	<? if ($row["Status"] == "1"){?>
																	<img src="images/up_green.png" width="28px" height="28px" />
																	<?}else{?>
																	<img src="images/down_red.png" width="28px" height="28px"/>
																	<?}?>
																	<input class="productStatus" type="hidden" value="<? echo $row["Status"]; ?>"/>
																</td>
																<td align="center">
																	<? if ($row["ImageFileName"] !="") {?>
																	<img src="/images/products/<?echo $row["ProductID"]?>/<?echo $row["ImageFileName"]?>" width="64px" height="64px" /> 
																	<? }?>
																</td>
																<td align="center">
																	<? 
																	$query_brandName_sql = "SELECT BrandName FROM Brand WHERE BrandID = '" . $row["BrandID"] . "'";
																	$query_brandName_sql_result = mysql_query($query_brandName_sql);
																	$row_brandName=mysql_fetch_assoc($query_brandName_sql_result);  
																	$brandName = $row_brandName["BrandName"];
																	echo "<span class='b_12'>".$brandName."</span>";
																	echo "<br/>";
																	?>
																</td>
																<td align="left" valign="top">
																	<span class="blue_14"><b><? echo $row["SortNo"] ? $row["SortNo"] : "" ?></b></span><br>
																	<? $query_pc_sql = "SELECT concat('∎ ',vP.P1CategoryName,' > ',vP.P2CategoryName,' > ',vP.P3CategoryName) AS CategoryName FROM ProductsCategorys PC INNER JOIN v_ProductCategory vP ON PC.CategoryID = vP.P3id WHERE PC.ProductID ='". $row["ProductID"] . "'";
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
																	<? echo $row["ProductName"]; ?>
																</td>
																<td align="center">
																	<span class="light_gray_12"><s>NT$ <? echo $row["ListPrice"]; ?></s><br></span><span class="b_12">NT$ <? echo $row["UnitPrice"]; ?></span>
																</td>
																<td align="left" valign="top">
																	<form action="" method="POST" enctype="multipart/form-data" id="saveBarCode" name="saveBarCode">
																		<table class="TableLine" cellpadding="0" cellspacing="0" width="100%">
																			<?	$query_pb_sql = "SELECT * FROM ProductBarCode WHERE ProductID ='". $row["ProductID"] . "'";
																			$recPB = mysql_query($query_pb_sql);
																			$rowNums=mysql_num_rows($recPB);
																			if ($rowNums > 0)
																			{
																				while($rowPB=mysql_fetch_assoc($recPB)){
																					?>
																					<tr class="trProductDetail">
																						<td style="width:20%; text-align:center;"><span class="b_12"><? echo $rowPB["BarCode"]; ?></span></td>
																						<td style="width:20%"><span class="b_12"><? echo $rowPB["Color"]; ?></span></td>
																						<td style="width:15%;  text-align:center;"><span class="b_12"><? echo $rowPB["Size"]; ?></span></td>
																						<td style="width:15%" align="right"><span class="b_12"><? echo $rowPB["MaxPurchaseNumber"]; ?></span></td>
																						<td style="width:15%" id="safetyNumber" align="right"><? echo $rowPB["SafetyNumber"]; ?></td>
																						<td style="width:15%">
																							<input type="hidden" name="productID[]" value="<? echo $rowPB["ProductID"]; ?>"/>
																							<input type="hidden" name="barCode[]" value="<? echo $rowPB["BarCode"]; ?>"/>
																							<input name="StockNumber[]" type="text" class="TextBoxNum" id="stockNumber" value="<?echo $rowPB["StockNumber"]?>" onfocus="$(this).select();" />
																						</td>
																					</tr>
																					<? } ?>
																					<tr class="trProductDetail">
																						<td colspan="6" style="text-align:right">
																							<input name="btnSaveStockNumber" class="btnSaveStockNumber" type="submit" value="儲存"/>
																							<input type="hidden" name="action" value="update"/>
																						</td>
																					</tr>
																					<? } ?>	
																				</table>
																			</form>
																		</td>
																		<td align="center">
																		<?if($row["UpdateDate"] != NULL && $row["UpdateDate"] != ""){
																		?>
																			<span class="b_12"><? $UpdateDate = date_create($row["UpdateDate"]); echo date_format($UpdateDate,"Y/m/d") . "<br />" . date_format($UpdateDate,"H:i:s"); ?></span>
																		<? }else{ ?>
																			<span class="b_12"><? $CreateDate = date_create($row["CreateDate"]); echo date_format($CreateDate,"Y/m/d") . "<br />" . date_format($CreateDate,"H:i:s"); ?></span>
																		<? } ?>
																		</td>
																		<td align="center">
																			<input name="btnEdit" id="etnEdit<? echo $start + $rowCount ?>" type="button" value="修改" onclick="transfer2Detail('<?echo $row["ProductID"]?>', '<?echo $row["ProductStatus"]?>' ,this)"/>
																			<!--<input name="btnCopy" type="button" value="複製" /><br/>-->
																			<form action="" method="POST" enctype="multipart/form-data" id="copy" name="copy">
																				<input name="copy" class="copy" type="submit" value="複製" OnClick="return checkBeforeCopy();" style="float:top;margin-top:6px;"/>
																				<input name="ProductId" type="hidden" value="<? echo $row["ProductID"]; ?>"/>
																				<input name="action" type="hidden" value="copy"/>
																			</form>
																			<form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
																				<input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) return false;" style="float:top;margin-top:6px;"/>
																				<input name="ProductId" type="hidden" value="<? echo $row["ProductID"]; ?>"/>
																				<input name="action" type="hidden" value="delete"/>
																			</form>
																		</td>
																	</tr>
																	<? $rowCount = $rowCount + 1; } }?>
																</table>
																<br/><br/><br/>
															</div>
														</div>
														<div class="GridViewFooter">
															<table class="TableNoLine" style="margin-left: 10px; margin-top: 6px;">
																<tr>
																	<td>
                                                                    	<span id="PageControl1_labCount">筆數</span>： <span id="PageControl1_lblTotalCount"><? echo $total_records?></span>｜
																	</td>
																	<td>
																		<a href="products5.php?page=1&status=<?echo $status?>&productCategory1=<?echo $productCategory1?>&searchBarCode=<?echo $searchBarCode?>&searchKey=<?echo $searchKey?>&productCategory2=<?echo $productCategory2?>&productCategory3=<?echo $productCategory3?>&searchStartDateFrom=<?echo $searchStartDateFrom?>&searchStartDateTo=<?echo $searchStartDateTo?>&searchUnitPriceFrom=<?echo $searchUnitPriceFrom?>&searchUnitPriceTo=<?echo $searchUnitPriceTo?>&searchStockNumber=<?echo $searchStockNumber?>&searchBrand=<?echo $searchBrand?>&promotionalActivityArea=<?echo $promotionalActivityArea?>">最前頁｜</a>
																	</td>
																	<?	
																	$prePage = $page-1;
																	if ($prePage < 1)
																	{
																		$prePage = 1;
																	}
																	?>
																	<td>
																		<a href="products5.php?page=<?echo $prePage?>&status=<?echo $status?>&productCategory1=<?echo $productCategory1?>&searchBarCode=<?echo $searchBarCode?>&searchKey=<?echo $searchKey?>&productCategory2=<?echo $productCategory2?>&productCategory3=<?echo $productCategory3?>&searchStartDateFrom=<?echo $searchStartDateFrom?>&searchStartDateTo=<?echo $searchStartDateTo?>&searchUnitPriceFrom=<?echo $searchUnitPriceFrom?>&searchUnitPriceTo=<?echo $searchUnitPriceTo?>&searchStockNumber=<?echo $searchStockNumber?>&searchBrand=<?echo $searchBrand?>&promotionalActivityArea=<?echo $promotionalActivityArea?>">上頁｜</a>
																	</td>
																	<?	
																	$nextPage = $page+1;
																	if ($nextPage > $total_pages)
																	{
																		$nextPage = $total_pages;
																	}
																	?>
																	<td>
																		<a href="products5.php?page=<?echo $nextPage?>&status=<?echo $status?>&productCategory1=<?echo $productCategory1?>&searchBarCode=<?echo $searchBarCode?>&searchKey=<?echo $searchKey?>&productCategory2=<?echo $productCategory2?>&productCategory3=<?echo $productCategory3?>&searchStartDateFrom=<?echo $searchStartDateFrom?>&searchStartDateTo=<?echo $searchStartDateTo?>&searchUnitPriceFrom=<?echo $searchUnitPriceFrom?>&searchUnitPriceTo=<?echo $searchUnitPriceTo?>&searchStockNumber=<?echo $searchStockNumber?>&searchBrand=<?echo $searchBrand?>&promotionalActivityArea=<?echo $promotionalActivityArea?>">下頁｜</a>
																	</td>
																	<td>
																		<a href="products5.php?page=<?echo $total_pages?>&status=<?echo $status?>&productCategory1=<?echo $productCategory1?>&searchBarCode=<?echo $searchBarCode?>&searchKey=<?echo $searchKey?>&productCategory2=<?echo $productCategory2?>&productCategory3=<?echo $productCategory3?>&searchStartDateFrom=<?echo $searchStartDateFrom?>&searchStartDateTo=<?echo $searchStartDateTo?>&searchUnitPriceFrom=<?echo $searchUnitPriceFrom?>&searchUnitPriceTo=<?echo $searchUnitPriceTo?>&searchStockNumber=<?echo $searchStockNumber?>&searchBrand=<?echo $searchBrand?>&promotionalActivityArea=<?echo $promotionalActivityArea?>">最後頁</a>
																	</td>
																	<td>
																		｜<span id="PageControl1_labPage">頁數</span>： <span id="PageControl1_lblCurrentPage">
																		<?echo $page?></span>/<span id="PageControl1_lblTotalPage"><?echo $total_pages?></span>
																	</td>
																	<td>
																		<span id="PageControl1_labTotal"></span>
																	</td>
																	<td width="40"><!----></td>
                                                                    <td>
                                                                        <select onChange="location = this.options[this.selectedIndex].value;">
                                                                          <?php
                                                                            for($i=1 ; $i<$total_pages+1 ; $i++)
                                                                            {
                                                                          ?>
                                                                              <option value="<?php $_SERVER['PHP_SELF']; ?>?page=<?php echo $i; ?>&status=<?echo $status?>&productCategory1=<?echo $productCategory1?>&searchBarCode=<?echo $searchBarCode?>&searchKey=<?echo $searchKey?>&productCategory2=<?echo $productCategory2?>&productCategory3=<?echo $productCategory3?>&searchStartDateFrom=<?echo $searchStartDateFrom?>&searchStartDateTo=<?echo $searchStartDateTo?>&searchUnitPriceFrom=<?echo $searchUnitPriceFrom?>&searchUnitPriceTo=<?echo $searchUnitPriceTo?>&searchStockNumber=<?echo $searchStockNumber?>&searchBrand=<?echo $searchBrand?>&promotionalActivityArea=<?echo $promotionalActivityArea?>" <?php if($page==$i){echo "selected";} ?>>第 <?php echo $i; ?> 頁</option>
                                                                          <?php
                                                                            }
                                                                          ?>
                                                                        </select>
                                                                    </td>
															</table>
														</div>
                                                        <p style="height:10;"></p>
														<div style="display: none">
															<input type="submit" name="btnReload" value="btnReload" id="btnReload" />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</body>
							</html>