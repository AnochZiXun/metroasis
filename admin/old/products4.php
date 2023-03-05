<?php
include_once('_connMysql.php');
include_once('check_login.php');
include_once("css/EricChang.css");
$currentUserID = $_SESSION["userID"];
$product_sql_Delete = "DELETE FROM Products WHERE ProductNo IS NULL AND ProductName IS NULL";
mysql_query($product_sql_Delete);
if($_POST["action"] == "update"){ 
	$barCode = $_POST["barCode"];
	$stockNumber = $_POST["StockNumber"];
	$productId = $_POST["productID"];
	foreach($productId as $key => $productId) {
		if ($stockNumber == ""){
			$stockNumber = 0;
		}
		$update_sql = "UPDATE ProductBarCode SET StockNumber = '$stockNumber[$key]' WHERE productID = $productId AND BarCode='$barCode[$key]'";	
	    //echo $update_sql;
		mysql_query($update_sql);
	}
	
}
$query_product_sql = "SELECT P.ProductID, P.ProductNo, P.ProductCategoryID, P.BrandID, P.ProductName,format(P.UnitPrice,0) as UnitPrice,format(P.ListPrice,0) as ListPrice,Status, P.UpdateDate,(SELECT ImageFileName FROM `ImagesFiles` WHERE `ImageFunction` = 'products' AND `ImageType` = 'detail' AND `ForeignID` = P.ProductID LIMIT 1) AS ImageFileName ";
$productTableName = "FROM Products P";
$query_product_sql = "$query_product_sql $productTableName WHERE 1";
//$orderBy = ' order by P.StartDate desc';
$orderBy = '';

//當前USER複製的商品
$condition1 = "AND Status = 3 AND CreateUserID = $currentUserID ORDER BY UpdateDate DESC";
//其他USER複製的商品
$condition2 = "AND Status = 3 AND CreateUserID != $currentUserID ORDER BY UpdateDate DESC";
//已上架 且 目前庫存量<=最低庫存量 的商品
$condition3 = "AND Status = 1 AND (SELECT COUNT(*) FROM ProductBarCode WHERE ProductID = P.ProductID AND 	
                 StockNumber <= SafetyNumber) > 0 ORDER BY UpdateDate DESC";
//已下架的商品
$condition4 = "AND Status = 0 ORDER BY UpdateDate DESC";
//已上架 且 庫存充足 的商品
$condition5 = "AND Status = 1 AND (SELECT COUNT(*) FROM ProductBarCode WHERE ProductID = P.ProductID AND 	
                 StockNumber <= SafetyNumber) = 0 ORDER BY UpdateDate DESC";

$query_product_sql = "SELECT * FROM (". "($query_product_sql $condition1)". "UNION".
"($query_product_sql $condition2)". "UNION".
"($query_product_sql $condition3)". "UNION".
"($query_product_sql $condition4)". "UNION".
"($query_product_sql $condition5)".
") AS P WHERE 1 ";

if(isset($_POST["status"])){
	$status = $_POST["status"];
	if($status == '1' || $status == '0') {
		$query_product_sql =$query_product_sql . ' and P.Status = '. $status;
	}
}
if(isset($_POST["productCategory1"])){
	$productCategory1 = $_POST["productCategory1"];
	if($productCategory1) {
		$query_product_sql =$query_product_sql . " and P.ProductCategoryID in (SELECT P3.id FROM ProductCategory1 P1, ProductCategory2 P2, ProductCategory3 P3 WHERE P1.id = '$productCategory1' and P2.ParentCategoryId = P1.id and P3.ParentCategoryId = P2.id)";
	}
}
if (isset($_POST["searchField"])){
	$searchField = $_POST["searchField"];
	if (isset($_POST["searchKey"])){ 
		$searchKey = trim($_POST["searchKey"]) ;
		if ($searchKey != "" ){
			switch($searchField)
			{
				case "ProductName":   
				$query_product_sql = $query_product_sql.' and P.ProductName like "%'.$searchKey.'%" ';
				break;
				case "BarCode":
				$query_product_sql = $query_product_sql.' and P.ProductID IN (SELECT ProductID FROM ProductBarCode WHERE BarCode LIKE "%'.$searchKey.'%") ';
				break;    
			}
		} 
	}
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
$query_product_sql = $query_product_sql.$orderBy;
//delete
if($_POST["action"] == "delete") {
	$productId = $_POST["ProductId"];
	$productNo = $_POST["ProductNo"];
	
	$delete_barcode_sql = "delete from ProductBarCode where ProductNo='$productNo'";
	mysql_query($delete_barcode_sql);
	$deleteSql = "delete from Products where ProductID = '$productId'";
	mysql_query($deleteSql);	
	header("Location: products5.php");
}
//copy
if($_POST["action"] == "copy") {
	$productId = $_POST["ProductId"];
	$productNo = $_POST["ProductNo"];
	$copy_sql = "insert into Products (ProductNo, BarCode, SortNo, BrandID, ProductCategoryID, ProductName, ListProductName, Color, Size, ProductFeather, StockNumber, SafetyNumber, OnStoreNumber, SaleNumber, MaxPurchaseNumber, Status, ProductDescription, ProductSale, ProductRefund, RepairService, Exclusion, ECPlatform, DeliverExpress, TakeFromStore, CreateUserID) 
	SELECT ProductNo, BarCode, SortNo, BrandID, ProductCategoryID, ProductName, ListProductName, Color, Size, ProductFeather, StockNumber, SafetyNumber, OnStoreNumber, SaleNumber, MaxPurchaseNumber, 3, 	  ProductDescription, ProductSale, ProductRefund, RepairService, Exclusion, ECPlatform, DeliverExpress, TakeFromStore, '$currentUserID' 
	from Products where ProductID = $productId";
	mysql_query($copy_sql);
	$copy_productId = mysql_insert_id();							
	$copy_barcode_sql = "INSERT INTO ProductBarCode(ProductID,       ProductNo, Color, Size, StockNumber, SafetyNumber, MaxPurchaseNumber) 
	SELECT $copy_productId, ProductNo, Color, Size, StockNumber, SafetyNumber, MaxPurchaseNumber 
	FROM ProductBarCode WHERE ProductID = $productId";
	mysql_query($copy_barcode_sql);
	//header("Status: 301 Moved Permanently");
	header("Location: products5.php?action=afterCopy");
}

//複製的商品數量
$sql_copyItemNumber = "select * from Products where Status = '3'";
$recCopyItemNumber = mysql_query($sql_copyItemNumber);
$copyItemNo = $recCopyItemNumber ? mysql_num_rows($recCopyItemNumber) : 0;

//預設每頁筆數
$pageRow_records = 10;
//總筆數
$total_records = $recProducts ? mysql_num_rows($recProducts) : 0;
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if(!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
 } else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
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
		}
		var isClickEditBtn = false;
		function transfer2Detail(productId){
			isClickEditBtn = true;
			var status = $("#status").val();
			var searchField = $("#searchField").val();
			var searchKey = $("#searchKey").val();
			location.href='productDetail5.php?productId=' + productId + "&status=" + status + "&searchField=" + searchField + "&searchKey="+searchKey	;
		}
		$(window).load(function(){
			$(".trProductDetail").css("background-color", "#ffffff");
			$(".safetyNumber").css("background-color", "#f2e6e6");
			$(".stockNumber").css("background-color", "#f2e6e6");
			$(".trProductDetail").each(function(i, obj){
        		if(parseInt($(this).find("#stockNumber").val()) <= parseInt($(this).find("#safetyNumber").html())){
        			//$(this).css("background-color","red");
        			$(this).css("background-color", "#f3d0d0");
        		}
        	});
        	$(".TableNoLine").css("font-size","10pt");

        	$(".productStatus").each(function(){
        		if($(this).val() == "3"){
        			$(this).closest("tr").css("background-color","#ffffd3");
        		}
        	});

		});

		/*
		function isIE() { 
			return ((navigator.appName == 'Microsoft Internet Explorer') || ((navigator.appName == 'Netscape') && (new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})").exec(navigator.userAgent) != null))); 
		}
		*/

		function deleteUnsavedCopyItem(){
			$.ajax({
				url: "service_products.php?action=deleteUnsavedCopyItem&CreateUserID=<? echo $currentUserID ?>",
				type: 'GET',
				async: false,
				success: function(result) {
					
				}, error: function(xhr) { 
					
				} 
			});
		}

		var isClickCopyBtn = false;

		function clickCopyBtn(){
			if (!confirm('確認複製此筆資料?')){ 
				return false
			}else{
				isClickCopyBtn = true;
			}
		}

		var unloadEvent = function(e){
			var action = "<? echo trim($_GET["action"]) ?>";
			if(isClickCopyBtn || (action == "afterCopy" && isClickEditBtn) ){
				//do nothing
			}else{
				deleteUnsavedCopyItem();
			}
		}

		window.addEventListener("unload", unloadEvent);
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
			<div id="divWork" style="float: left; width: 90%">
				<div class="divWorkArea" style="height:auto; margin-bottom: 100px">
					<div id="UpdatePanel1">
						<div class="SeachBar" style="height: 25px; padding-top: 5px">

							<form action="" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
								<div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
									商品狀態：
								</div>
								<div style="float: left; padding-right: 20px;padding-top: 3px;">
									<select name="status" id="status" style="width: 120%;" class="dropdownlist">
										<!--<option value="" selected="selected"></option>-->
										<option value="1" selected="selected">上架</option>
										<option value="0">下架</option>
									</select>
								</div>
								<div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
									商品類別：
								</div>
								<div style="float: left; padding-right: 30px;padding-top: 3px;">
									<select name="productCategory1" id="productCategory1" style="width: 120%;" class="dropdownlist">
										<option value="" selected="selected">---------</option>
										<?	
										$query_productCategory1_sql = "SELECT id ,CategoryName FROM `ProductCategory1` ORDER BY `CategorySort` ASC";
										$recProductCategory1 = mysql_query($query_productCategory1_sql);
										$recProductCategory1RowNums=mysql_num_rows($recProductCategory1);
										if ($recProductCategory1RowNums > 0)
										{
											while($productCategory1ForSearch=mysql_fetch_assoc($recProductCategory1)){
												?>
												<option value="<?echo $productCategory1ForSearch["id"]?>"><?echo $productCategory1ForSearch["CategoryName"]?></option>
												<?	}}?>
											</select>
										</div>


										<div style="float: left; padding-right: 20px;padding-top: 3px;">
											<select name="searchField" id="searchField" style="width: 120%;" class="dropdownlist">
												<option value="ProductName" selected="selected">商品名稱</option>
												<option value="BarCode">商品條碼</option>
											</select>
										</div>
										<div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
											輸入關鍵字：
										</div>
										<div style="float: left; padding-right: 10px;padding-top: 3px;">
											<input type="text" class="TextBox" id="searchKey" name="searchKey" style="width:250px" value="<? echo $searchKey?>">
										</div>
										<div style="float: left; padding-right: 10px;padding-top: 3px;">
											<input name="submitSearch" type="submit" value="查詢"/>
										</div>
									</form>

									<div style="float: right">
										<input type="button" name="ibAdd" id="ibAdd"  value=" 新增商品 " onClick="javascript:location.href='productDetail5.php'"/>
									</div>
								</div>
								<div id="divDetailBody" class="divDetailBody">
									<div id="divGridview" style="overflow: auto">
										<div>
											<table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
											style="border-collapse: collapse;">
											<tr>
												<th scope="col" style="width: 3%;"><input name="chkAll" type="checkbox" class="checkbox" value="0"></th>
												<th scope="col" style="width: 3%;">#</th>
												<th scope="col" style="width: 5%;">狀態</th>
												<th scope="col" style="width: 7%;">商品圖</th>
												<th scope="col" style="width: 7%;">商品編號</th>
												<th scope="col" style="width: 25%;">品牌 / 分類 / 名稱</th>
												<th scope="col" style="width: 10%;"><s>市價</s> / 會員價</th>
												<th scope="col" style="width: 30%;">條碼 / 顏色 / 尺寸 / 最高可購量 / 最低庫存量 / 目前庫存量</th>
												<th scope="col" style="width: 9%;">更新日期</th>
												<th scope="col" style="width: 7%;">功能</th>
											</tr>
											<? 
											$rowCount = 1;
											if($recProducts){
												while($row=mysql_fetch_assoc($recProducts)){ ?>
												<tr>
													<td align="center">
														<input name="chkProduct" type="checkbox" class="checkbox" style="width: 95%;" value="0">
													</td>
													<td align="center">
														<? if( ($start - $copyItemNo + $rowCount) >= 1 ) { ?>
															<span class="b_12"><? echo $start - $copyItemNo + $rowCount ?></span>
														<? }else{ ?>
															<span class="b_12">-</span>
														<? } ?>

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
														<span class="b_12"><? echo $row["ProductNo"] ?></span>
													</td>
													<td align="left" valign="top">
														<? 
														$query_brandName_sql = "SELECT BrandName FROM Brand WHERE BrandID = '" . $row["BrandID"] . "'";
														$query_brandName_sql_result = mysql_query($query_brandName_sql);
														$row_brandName=mysql_fetch_assoc($query_brandName_sql_result);  
														$brandName = $row_brandName["BrandName"];
														echo "<span class='green_14'><b>".$brandName."</b></span>";
														echo "<br/>";
														?>

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
														<span class="light_gray_12">NT$ <s><? echo $row["ListPrice"]; ?></s><br></span><span class="b_12">NT$ <? echo $row["UnitPrice"]; ?></span>
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
																			<td style="width:20%"><span class="b_12"><? echo $rowPB["BarCode"]; ?></span></td>
																			<td style="width:20%"><span class="b_12"><? echo $rowPB["Color"]; ?></span></td>
																			<td style="width:15%"><span class="b_12"><? echo $rowPB["Size"]; ?></span></td>
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
																				<input name="btnSaveStockNumber" type="submit" value="儲存"/>
																				<input type="hidden" name="action" value="update"/>
																			</td>
																		</tr>
																		<? } ?>	
																	</table>
																</form>
															</td>
															<td align="center">
																<span class="b_12"><? $UpdateDate = date_create($row["UpdateDate"]); echo date_format($UpdateDate,"Y/m/d") . "<br />" . date_format($UpdateDate,"H:i:s"); ?></span>
															</td>
															<td align="center">
																<input name="btnEdit" type="button" value="修改" onclick="transfer2Detail('<?echo $row["ProductID"]?>')"/>

																<!--<input name="btnCopy" type="button" value="複製" /><br/>-->
																<form action="" method="POST" enctype="multipart/form-data" id="copy" name="copy">
																	<input name="copy" class="copy" type="submit" value="複製" OnClick="clickCopyBtn()" style="float:top;margin-top:6px;"/>
																	<input name="ProductId" type="hidden" value="<? echo $row["ProductID"]; ?>"/>
																	<input name="ProductNo" type="hidden" value="<? echo $row["ProductNo"]; ?>"/>
																	<input name="action" type="hidden" value="copy"/>
																</form>

																<form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
																	<input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) return false;" style="float:top;margin-top:6px;"/>
																	<input name="ProductId" type="hidden" value="<? echo $row["ProductID"]; ?>"/>
																	<input name="ProductNo" type="hidden" value="<? echo $row["ProductNo"]; ?>"/>
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
												<table class="TableNoLine">
													<tr>
														<td>
															<span id="PageControl1_labCount">筆數</span>： <span id="PageControl1_lblTotalCount">
															<? echo $total_records?></span>｜
														</td>
														<td>
															<a href="products5.php?page=1">最前頁｜</a>
														</td>
														<?	
														$prePage = $page-1;
														if ($prePage < 1) {
															$prePage = 1;
														}
														?>
														<td>
															<a href="products5.php?page=<?echo $prePage?>">上頁｜</a>
														</td>
														<?	
														$nextPage = $page+1;
														if ($nextPage > $total_pages) {
															$nextPage = $total_pages;
														}
														?>
														<td>
															<a href="products5.php?page=<?echo $nextPage?>">下頁｜</a>
														</td>
														<td>
															<a href="products5.php?page=<?echo $total_pages?>">最後頁</a>
														</td>
														<td>
															｜<span id="PageControl1_labPage">頁數</span>： <span id="PageControl1_lblCurrentPage">
															<?echo $page?></span>/<span id="PageControl1_lblTotalPage"><?echo $total_pages?></span>
														</td>
														<td>
															<span id="PageControl1_labTotal"></span>
														</td>
													</tr>
												</table>
											</div>
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
