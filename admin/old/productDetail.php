<?php
include('_connMysql.php');
include('check_login.php');

if(isset($_GET["productId"])) {
	$productId = $_GET["productId"];
}
if(isset($_GET["readOnly"])) {
	$readOnly = $_GET["readOnly"];
}

$currentUserID = $_SESSION["userID"];
$tableName = 'Products';
$query_products_sql = "SELECT * FROM $tableName where ProductID = $productId";
$rec = mysql_query($query_products_sql);
$row = $rec ? mysql_fetch_assoc($rec) : NULL;

$barCode_sql = "SELECT * FROM ProductBarCode WHERE ProductNo = '".$row["ProductNo"]."' order by Pkey";
$barCode_sql_result = mysql_query($barCode_sql);
$barCode_str = "";
$barCode_color = "";
$barCode_size = "";
while($orderDetailRow = mysql_fetch_assoc($barCode_sql_result)) {
	$barCode_str = ($barCode_str ? $barCode_str."," : $barCode_str).$orderDetailRow["BarCode"];
	$barCode_color = ($barCode_color ? $barCode_color."," : $barCode_color).$orderDetailRow["Color"];
	$barCode_size = ($barCode_size ? $barCode_size."," : $barCode_size).$orderDetailRow["Size"];
}

if($row) {
	$productCategory3 = getCategory('ProductCategory3', $row['ProductCategoryID']);
	$productCategory2 = getCategory('ProductCategory2', $productCategory3['ParentCategoryId']);
	$productCategory1 = getCategory('ProductCategory1', $productCategory2['ParentCategoryId']);
	$currentBrand = getBrand($row['BrandID']);
}

if($_POST["action"] == "update"){ 
	$productNo = $_POST["ProductNo"];
	$sortNo = $_POST["SortNo"] == '' ? 0 : $_POST["SortNo"];
	$brandID = $_POST["BrandID"] == '' ? NULL : $_POST["BrandID"];	
	$productCategoryID = $_POST["ProductCategory3"];
	$productName = $_POST["ProductName"];
	$listProductName = $_POST["ListProductName"];
	$listPrice = $_POST["ListPrice"] == '' ? 0 : $_POST["ListPrice"];
	$unitPrice = $_POST["UnitPrice"] == '' ? 0 : $_POST["UnitPrice"];
	$memberPrice = $_POST["MemberPrice"] == '' ? 0 : $_POST["MemberPrice"];
	$productFeather = $_POST["ProductFeather"];
	$stockNumber = $_POST["StockNumber"] == '' ? 0 : $_POST["StockNumber"];
	$safetyNumber = $_POST["SafetyNumber"] == '' ? 0 : $_POST["SafetyNumber"];
	$onStoreNumber = $_POST["OnStoreNumber"] == '' ? 0 : $_POST["OnStoreNumber"];
	$saleNumber = $_POST["SaleNumber"] == '' ? 0 : $_POST["SaleNumber"];
	$maxPurchaseNumber = $_POST["MaxPurchaseNumber"] == '' ? 0 : $_POST["MaxPurchaseNumber"];
	$status = $_POST["Status"];
	$startDate = $_POST["StartDate"] == '' ? 'NULL' : "'".$_POST["StartDate"]."'";
	$endDate = $_POST["EndDate"] == '' ? 'NULL' : "'".$_POST["EndDate"]."'";
	$productDescription = $_POST["ProductDescription"];
	$productSale = $_POST["ProductSale"];
	$productRefund = $_POST["ProductRefund"];
	$repairService = $_POST["RepairService"];
	$exclusion = $_POST["Exclusion"];
	$ecPlatform = $_POST["ECPlatform"];
	$updateUserID = $currentUserID;
	$update_products_sql = "update Products set ProductNo='$productNo',
												SortNo=$sortNo,
												BrandID=$brandID,
												ProductCategoryID=$productCategoryID,
												ProductName='$productName',
												ListProductName='$listProductName',
												ListPrice=$listPrice,
												UnitPrice=$unitPrice,
												MemberPrice=$memberPrice,
												ProductFeather='$productFeather',
												StockNumber=$stockNumber,
												SafetyNumber=$safetyNumber,
												OnStoreNumber=$onStoreNumber,
												SaleNumber=$saleNumber,
												MaxPurchaseNumber=$maxPurchaseNumber,
												Status=$status,
												StartDate=$startDate,
												EndDate=$endDate,
												ProductDescription='$productDescription',
												ProductSale='$productSale',
												ProductRefund='$productRefund',
												RepairService='$repairService',
												Exclusion='$exclusion',
												ECPlatform='$ecPlatform',
												UpdateUserID=$updateUserID
												where ProductID=$productId";
	
	mysql_query($update_products_sql);
	cleanAndInsertBarCode();
	echo "<script>
				parent.location.href = 'products.php';	
				parent.$.fn.colorbox.close(); 			
		 </script>";
}

if($_POST["action"] == "add"){ 	
	$productNo = $_POST["ProductNo"];
	$sortNo = $_POST["SortNo"] == '' ? 0 : $_POST["SortNo"];
	$brandID = $_POST["BrandID"] == '' ? NULL : $_POST["BrandID"];	
	$productCategoryID = $_POST["ProductCategory3"];
	$productName = $_POST["ProductName"];
	$listProductName = $_POST["ListProductName"];
	$listPrice = $_POST["ListPrice"] == '' ? 0 : $_POST["ListPrice"];
	$unitPrice = $_POST["UnitPrice"] == '' ? 0 : $_POST["UnitPrice"];
	$memberPrice = $_POST["MemberPrice"] == '' ? 0 : $_POST["MemberPrice"];
	$productFeather = $_POST["ProductFeather"];
	$stockNumber = $_POST["StockNumber"] == '' ? 0 : $_POST["StockNumber"];
	$safetyNumber = $_POST["SafetyNumber"] == '' ? 0 : $_POST["SafetyNumber"];
	$onStoreNumber = $_POST["OnStoreNumber"] == '' ? 0 : $_POST["OnStoreNumber"];
	$saleNumber = $_POST["SaleNumber"] == '' ? 0 : $_POST["SaleNumber"];
	$maxPurchaseNumber = $_POST["MaxPurchaseNumber"] == '' ? 0 : $_POST["MaxPurchaseNumber"];
	$status = $_POST["Status"];
	$startDate = $_POST["StartDate"] == '' ? 'NULL' : "'".$_POST["StartDate"]."'";
	$endDate = $_POST["EndDate"] == '' ? 'NULL' : "'".$_POST["EndDate"]."'";
	$productDescription = $_POST["ProductDescription"];
	$productSale = $_POST["ProductSale"];
	$productRefund = $_POST["ProductRefund"];
	$repairService = $_POST["RepairService"];
	$exclusion = $_POST["Exclusion"];
	$ecPlatform = $_POST["ECPlatform"];
	$createUserID = $currentUserID;
	$updateUserID = $currentUserID;
	$insert_products_sql = "INSERT INTO Products(
ProductNo,
BarCode,
SortNo,
BrandID,
ProductCategoryID,
ProductName,
ListProductName,
Color,
Size,
ListPrice,
UnitPrice,
MemberPrice,
ProductFeather,
StockNumber,
SafetyNumber,
OnStoreNumber,
SaleNumber,
MaxPurchaseNumber,
Status,
StartDate,
EndDate,
ProductDescription,
ProductSale,
ProductRefund,
RepairService,
Exclusion,
ECPlatform,
CreateUserID,
UpdateUserID) VALUES ('$productNo',
					  '',
					  $sortNo,
					  $brandID,
					  $productCategoryID,
					  '$productName',
					  '$listProductName',
					  '',
					  '',
					  $listPrice,
					  $unitPrice,
					  $memberPrice,
					  '$productFeather',
					  $stockNumber,
					  $safetyNumber,
					  $onStoreNumber,
					  $saleNumber,
					  $maxPurchaseNumber,
					  $status,
					  $startDate,
					  $endDate,
					  '$productDescription',
					  '$productSale',
					  '$productRefund',
					  '$repairService',
					  '$exclusion',
					  '$ecPlatform',
					  $createUserID,
					  $updateUserID)";
	mysql_query($insert_products_sql);
	cleanAndInsertBarCode();	
	echo "<script>
				parent.location.href = 'products.php';
				parent.$.fn.colorbox.close(); 					
		 </script>";
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
	$query_brand_sql = "SELECT * FROM Brand WHERE BrandID=$brandID and Status = 1";
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

function cleanAndInsertBarCode() {
	$productNo = $_POST["ProductNo"];
	$delete_barcode_sql = "delete from ProductBarCode where ProductNo='$productNo'";
	mysql_query($delete_barcode_sql);
	
	$barCodeList = explode(",",$_POST["BarCode"]);
	$colorList = explode(",",$_POST["Color"]);
	$sizeList = explode(",",$_POST["Size"]);
	foreach($barCodeList as $key => $value) {
		$barCode = $barCodeList[$key];
		$color = $colorList[$key];
		$size = $sizeList[$key];
		$insert_barcode_sql = "INSERT INTO ProductBarCode(ProductNo,BarCode,Color,Size) VALUES('$productNo','$barCode','$color','$size')";
		mysql_query($insert_barcode_sql);	
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=11, IE=9, IE=8, chrome=10" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/colorbox.css" type="text/css" rel="stylesheet" />
    <link href="Css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
    <link href="css/jquery.cleditor.css" type="text/css" rel="stylesheet" />
    <script src="js/jquery-1.7.2.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.core.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
    <script src="js/jquery.colorbox.js" type="text/javascript"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.blockUI.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.advancedtable.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () { 
			PageInitial(); 
			if($("#ProductCategory3").length == 0) {
				showProductCategory('ProductCategory2', $("#ProductCategory1").val());
				showProductCategory('ProductCategory3', $("#ProductCategory2").val());
			}
		});
        $(window).resize(function () { PageInitial(); });
        function pageLoad() {
            var isAsyncPostback = Sys.WebForms.PageRequestManager.getInstance().get_isInAsyncPostBack();
            if (isAsyncPostback) {
                $(document).ready(function () {
                    PageInitial();
                });
            }
        }

        function PageInitial() {
            var bodyHeight = document.body.clientHeight;
            $("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 50) + "px");
            $.cleditor.defaultOptions.height = bodyHeight - 190;
            $(".HTMLEditor").cleditor();	
            $(".Attachs").colorbox({ iframe: true, width: "800px", height: "560px", overlayClose: false, escKey: false, href: "attachsupload.php?KeyID=<?echo $productId?>&Folder=products&FunID=products" });			
			if ("<?echo $productId?>" == "")
			{
				$("#ibAttachs").attr("OnClick","javascript:alert('請先存檔後再上傳圖片!'); return false;");
				$("#ibAttachs").attr("class","");
			}
        }
		function showProductCategory(tableName, parentCategoryId, categoryId) {
			$.ajax({
				url: 'getProductCategory.php?tableName='+tableName+'&parentCategoryId='+parentCategoryId+'&categoryId='+categoryId, 
				type: 'GET',
				async: false,
				success: function(categoryJsonStr) {
					console.log(categoryJsonStr);
					var categoryObj = JSON.parse(categoryJsonStr);
					console.log(categoryObj['Category']);
					if ('ProductCategory2'==tableName) {
						$('#ProductCategory2').empty();
						$('#ProductCategory3').empty();
					}
					if ('ProductCategory3'==tableName) {
						$('#ProductCategory3').empty();
					}
					var count = 0;
					categoryObj['Category'].forEach(function(category){
						if ('ProductCategory2'==tableName) {
							$('#ProductCategory2').append(new Option(category['CategoryName'], category['id'],0==count,0==count));
						}
						if ('ProductCategory3'==tableName) {
							$('#ProductCategory3').append(new Option(category['CategoryName'], category['id'],0==count,0==count));
						}						
						count++;
					});
					if ('ProductCategory2'==tableName) {
						showProductCategory('ProductCategory3', $("#ProductCategory2").val());
					}
					
					//options[options.length] = new Option('Foo', 'foo', true, true);
				}, error: function(xhr) { 
					alert('系統異常。'); 
				} 
			});
		}
    </script></head>
<body>
    <form name="form1" method="post" action="" id="form1">
    <div>
        <div id="UpdatePanel1">
            <div class="divDetailTopBar">
                <div id="ToolBar">
                    <div style="float: left; padding-right: 10px">
                        <span id="LabMessage" style="color: Red; font-size: 11pt; font-weight: bold;"></span>
                    </div>
                    <div style="float: right; padding-right: 10px">
                        <? if (isset($productId)) {?>	
							<input type="image" name="ibSave" id="ibSave" title="儲存資料" src="images/mountoff.png" onclick="showLoading();" style="border-width: 0px;" />								
							<input type="hidden" name="action" value="update"/>							
						<? } else { ?>							
							<input type="image" name="ibSave" id="ibSave" title="新增" src="images/mountoff.png" onclick="showLoading();" style="border-width: 0px;" />								
							<input type="hidden" name="action" value="add"/>	
						<? } ?>
                    </div>
                    <div style="float: right; width: 20px; color: #FFFFFF; text-align: center">
                        |</div>
                    <div style="float: right">
                        <input type="image" name="ibAttachs" id="ibAttachs" title="上傳圖片" class="Attachs" src="images/attach.png"
                            style="border-width: 0px;" /></div>
                </div>
            </div>
            <div id="divDetailBody" class="divDetailBody">
				<!--<tr>
                    <td colspan="8">
                        <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView" style="border-collapse: collapse;">
                            <tr>
                                <th scope="col" style="width: 25%;">
                                    商品型號
                                </th>
                                <th scope="col" style="width: 25%;">
                                    商品條碼
                                </th>
                                <th scope="col" style="width: 25%;">
                                    尺寸
                                </th>
                                <th scope="col" style="width: 25%;">
                                    顏色
                                </th>
                            </tr>
                            <? while($barCodeRow = mysql_fetch_assoc($barCode_sql_result)){ ?>
                            <tr>
                                <td align="center">
									<? echo $barCodeRow["ProductNo"]; ?>
                                </td>
								<td align="center">
                                    <? echo $barCodeRow["BarCode"]; ?>
                                </td>
								<td align="center">
                                    <? echo $barCodeRow["Size"]; ?>
                                </td>
								<td align="center">
                                    <? echo $barCodeRow["Color"]; ?>
                                </td>
                            </tr>
                            <? } ?>
                        </table>
                    </td>
                </tr>
				<br> -->
				<table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">

				    <tr>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">商品號碼</span>
                        </td>
                        <td>
                            <input name="ProductNo" type="text" class="TextBox" style="width: 95%;" value="<?echo $row["ProductNo"]?>"/>
                        </td>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">商品名稱</span>
                        </td>
                        <td>
                            <input name="ProductName" type="text" class="TextBox" style="width: 95%;" value="<?echo $row["ProductName"]?>"/>
                        </td>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">列表商品名</span>
                        </td>
                        <td colspan="3">
                            <input name="ListProductName" type="text" class="TextBox" style="width: 98%;" value="<?echo $row["ListProductName"]?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 13%" align="center">
                            <span class="DetailLabel">分類</span>
                        </td>
						<td colspan="3">
							<?
								$category1_sql = "SELECT * FROM ProductCategory1 WHERE 1";
								$category1_result = mysql_query($category1_sql);
								$category2_sql = "SELECT * FROM ProductCategory2 WHERE 1";
								$category2_result = mysql_query($category2_sql);
								$category3_sql = "SELECT * FROM ProductCategory3 WHERE 1";
								$category3_result = mysql_query($category3_sql);
							?>
							<select onChange="showProductCategory('<?echo "ProductCategory2" ?>',this.value)"  name="ProductCategory1" id="ProductCategory1" class="dropdownlist">
								<? while($category1 = mysql_fetch_assoc($category1_result)){ ?>
								<?if($productCategory1 && $productCategory1["id"] == $category1["id"]) { ?>
									<option value="<? echo $category1["id"] ?>" selected><?echo $category1["CategoryName"] ?></option>
								<?} else {?>
									<option value="<? echo $category1["id"] ?>" ><?echo $category1["CategoryName"] ?></option>	
								<?}}?>
							</select>
							<select onChange="showProductCategory('<?echo "ProductCategory3" ?>',this.value)"  name="ProductCategory2" id="ProductCategory2" class="dropdownlist" >
								<? while($category2 = mysql_fetch_assoc($category2_result)){ ?>
								<?if($productCategory2 && $productCategory2["id"] == $category2["id"]) { ?>
									<option value="<? echo $category2["id"] ?>" selected><?echo $category2["CategoryName"] ?></option>
								<?} else {?>
									<option value="<? echo $category2["id"] ?>" ><?echo $category2["CategoryName"] ?></option>	
								<?}}?>
							</select>
							<select name="ProductCategory3" id="ProductCategory3" class="dropdownlist" >
								<? while($category3 = mysql_fetch_assoc($category3_result)){ ?>
								<?if($productCategory3 && $productCategory3["id"] == $category3["id"]) { ?>
									<option value="<? echo $category3["id"] ?>" selected><?echo $category3["CategoryName"] ?></option>
								<?} else {?>
									<option value="<? echo $category3["id"] ?>" ><?echo $category3["CategoryName"] ?></option>	
								<?}}?>
							</select>
							
                        </td>
						<td style="width: 13%" align="center">
                            <span class="DetailLabel">上架日期</span>
                        </td>
                        <td>
                            <input name="StartDate" type="date" class="TextBox" style="width: 95%;" value="<?echo $row["StartDate"] ? date("Y-m-d", strtotime($row["StartDate"])) : NULL;?>"/>
                        </td>
                        <td style="width: 13%" align="center">
                            <span class="DetailLabel">下架日期</span>
                        </td>
                        <td>
                            <input name="EndDate" type="date" class="TextBox" style="width: 95%;"  value="<?echo $row["EndDate"] ? date("Y-m-d", strtotime($row["EndDate"])) : NULL;?>"/>
                        </td>
                    </tr>
					<tr>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">商品品牌</span>
                        </td>
                        <td>
							<?
								$brand_sql = "SELECT * FROM Brand WHERE 1";
								$brand_sql_result = mysql_query($brand_sql);
							?>
							<select name="BrandID" class="dropdownlist">
								<? while($brand = mysql_fetch_assoc($brand_sql_result)){ ?>
								<?if($currentBrand && $currentBrand["BrandID"] == $brand["BrandID"]) { ?>
									<option value="<? echo $brand["BrandID"] ?>" selected><?echo $brand["BrandName"] ?></option>
								<?} else {?>
									<option value="<? echo $brand["BrandID"] ?>" ><?echo $brand["BrandName"] ?></option>	
								<?}}?>
							</select>
                        </td>
					    <td style="width: 13%" align="center">
                            <span class="DetailLabel">狀態</span>
                        </td>
                        <td>
                            <table class="RadioButtonList" border="0" style="width: 110px;">
                                <tr>
									<?
										$checked_1 = '';
										$checked_0 = '';
										if ($row["Status"] == 1) {
											$checked_1 = 'checked';
										} else {
											$checked_0 = 'checked';
										}
									?>
                                    <td>
                                        <input type="radio" name="Status" value="1" <?echo $checked_1?> />
										<label for="rblStatus_1">上架</label>
                                    </td>
                                    <td>
                                        <input type="radio" name="Status" value="0" <?echo $checked_0?> />
										<label for="rblStatus_0">下架</label>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">順序編號</span>
                        </td>
                        <td>
                            <input name="SortNo" type="number" class="TextBox" style="width: 95%;" value="<?echo $row["SortNo"]?>"/>
                        </td>
						<td style="width: 13%" align="center">
                            <span class="DetailLabel">最高購買數</span>
                        </td>
                        <td>
                            <input name="MaxPurchaseNumber" type="number" class="TextBox" style="width: 95%;"  value="<?echo $row["MaxPurchaseNumber"]?>"/>
                        </td>
					</tr>

					<tr>
					    <td style="width: 10%" align="center">
                            <span  class="DetailLabel">條碼</span>
                        </td>
                        <td colspan="7" >
							
                            <input name="BarCode" type="text" class="TextBox" style="width: 99%;" value="<? echo $barCode_str?>"/>
                        </td>
					</tr>
					<tr>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">商品特色</span>
                        </td>
                        <td colspan="7" >
                            <input name="ProductFeather" type="text" class="TextBox" style="width: 99%;" value="<?echo $row["ProductFeather"]?>"/>
                        </td>
					</tr>
					<tr>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">顏色</span>
                        </td>
                        <td colspan="7" >
                            <input name="Color" type="text" class="TextBox" style="width: 99%;" value="<? echo $barCode_color?>"/>
                        </td>
					</tr>
					<tr>
						<td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">尺寸</span>
                        </td>
                        <td colspan="7" >
                            <input name="Size" type="text" class="TextBox" style="width: 99%;"  value="<? echo $barCode_size?>"/>
                        </td>
					</tr>
					<tr>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">庫存量</span>
                        </td>
                        <td>
                            <input name="StockNumber" type="number" class="TextBox" style="width: 95%;" value="<?echo $row["StockNumber"]?>"/>
                        </td>
						<td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">安全存量</span>
                        </td>
                        <td>
                            <input name="SafetyNumber" type="number" class="TextBox" style="width: 95%;"  value="<?echo $row["SafetyNumber"]?>"/>
                        </td>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">門市數量</span>
                        </td>
                        <td>
                            <input name="OnStoreNumber" type="number" class="TextBox" style="width: 95%;" value="<?echo $row["OnStoreNumber"]?>"/>
                        </td>
						<td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">上架數量</span>
                        </td>
                        <td>
                            <input name="SaleNumber" type="number" class="TextBox" style="width: 95%;"  value="<?echo $row["SaleNumber"]?>"/>
                        </td>
					</tr>
					<tr>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">牌價</span>
                        </td>
                        <td>
                            <input name="ListPrice" type="number" class="TextBox" style="width: 95%;" value="<?echo $row["ListPrice"]?>"/>
                        </td>
						<td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">單價</span>
                        </td>
                        <td>
                            <input name="UnitPrice" type="number" class="TextBox" style="width: 95%;"  value="<?echo $row["UnitPrice"]?>"/>
                        </td>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">會員價</span>
                        </td>
                        <td>
                            <input name="MemberPrice" type="number" class="TextBox" style="width: 95%;" value="<?echo $row["MemberPrice"]?>"/>
                        </td>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">已上架商城</span>
                        </td>
                        <td>
                            <input name="ECPlatform" type="text" class="TextBox" style="width: 95%;" value="<?echo $row["ECPlatform"]?>"/>
                        </td>
					</tr>
					<?if(isset($productId)){?>
					<tr>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">建立時間</span>
                        </td>
                        <td>
                            <span style="font-size: 10pt;"><?echo $row["CreateDate"]?></span>
                        </td>
						<td style="width: 13%" align="center">
                            <span class="DetailLabel">建立人員</span>
                        </td>
                        <td>
                            <span style="font-size: 10pt;"><?echo getUserName($row["CreateUserID"])?></span>
                        </td>
                        <td style="width: 10%" align="center">
                            <span  class="DetailLabel">更新時間</span>
                        </td>
                        <td>
                            <span style="font-size: 10pt;"><?echo $row["UpdateDate"]?></span>
                        </td>
						<td style="width: 13%" align="center">
                            <span class="DetailLabel">異動人員</span>
                        </td>
                        <td>
                            <span style="font-size: 10pt;"><?echo getUserName($row["UpdateUserID"])?></span>
                        </td>
					</tr>
					<?}?>
                    <tr>
                        <td colspan="8" >
                            <span style="font-size: 10pt;">詳細說明</span>
                            <textarea name="ProductDescription" class="HTMLEditor" rows="2" cols="2"><?echo $row["ProductDescription"]?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" >
                            <span style="font-size: 10pt;">商品銷售</span>
                            <textarea name="ProductSale" class="HTMLEditor" rows="2" cols="2"><?echo $row["ProductSale"]?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" >
                            <span style="font-size: 10pt;">商品退換</span>
                            <textarea name="ProductRefund" class="HTMLEditor" rows="2" cols="2"><?echo $row["ProductRefund"]?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" >
                            <span style="font-size: 10pt;">送修服務</span>
                            <textarea name="RepairService" class="HTMLEditor" rows="2" cols="2"><?echo $row["RepairService"]?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" >
                            <span style="font-size: 10pt;">除外責任</span>
                            <textarea name="Exclusion" class="HTMLEditor" rows="2" cols="2"><?echo $row["Exclusion"]?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

</body>
</html>
