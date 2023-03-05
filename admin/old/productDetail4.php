<?php
include('_connMysql.php');
include('check_login.php');

$currentUserID = $_SESSION["userID"];
$config_ECPlatform_sql = "SELECT ConfigContent FROM RefCommonConfig WHERE ConfigName = 'ECPlatform'";
$recConfig = mysql_query($config_ECPlatform_sql);
$rowConfig = mysql_fetch_assoc($recConfig);
$ECPlatform_Template = $rowConfig["ConfigContent"];

if(isset($_GET["productId"])) {
	$productId = $_GET["productId"];
}else{
	$createUserID = $currentUserID;
	$updateUserID = $currentUserID;
	$ecPlatformAry = json_decode($ECPlatform_Template);
	$Json = "[";
	foreach($ecPlatformAry as $array)
    {
    	$ctlID = $array->name;
    	$ckName = $array->value;
    	if (isset($_POST[$ctlID])){
    		$ckValue = "1";
    	}else{
    		$ckValue = "0";	
    	}
    	
    	if ($Json == "["){
			$Json .= '{"name":"'.$ckName.'","value":"'.$ckValue.'"}';
		}else{
			$Json .= ',{"name":"'.$ckName.'","value":"'.$ckValue.'"}';
		}
	}
	$Json .= "]";
	$ecPlatform = $Json;
	$insert_products_sql = "INSERT INTO Products(ECPlatform,CreateUserID,UpdateUserID) VALUES ('$ecPlatform',$updateUserID,$updateUserID)";
	//echo $insert_products_sql;
	mysql_query($insert_products_sql);
	
	$productId = mysql_insert_id();
}

if(isset($_GET["readOnly"])) {
	$readOnly = $_GET["readOnly"];
}

$status = $_GET["status"];
$searchField = $_GET["searchField"];
$searchKey = $_GET["searchKey"];




if($_POST["action"] == "update"){ 
	$productNo = $_POST["ProductNo"];
	$productName = $_POST["ProductName"];
	$brandID = $_POST["BrandID"] == '' ? NULL : $_POST["BrandID"];	
	$status = $_POST["Status"];
	$startDate = $_POST["StartDate"] == '' ? 'NULL' : "'".$_POST["StartDate"]."'";
	$endDate = $_POST["EndDate"] == '' ? 'NULL' : "'".$_POST["EndDate"]."'";
	$listPrice = $_POST["ListPrice"] == '' ? 0 : $_POST["ListPrice"];
	$unitPrice = $_POST["UnitPrice"] == '' ? 0 : $_POST["UnitPrice"];
	$sortNo = $_POST["SortNo"] == '' ? 0 : $_POST["SortNo"];
	$productFeather = $_POST["ProductFeather"];
	$youtubeUrl = $_POST["YoutubeUrl"];
	//$youtubeUrl = str_replace('"',"'",$youtubeUrl);
	$productDescription = $_POST["ProductDescription"];
	$chkDeliverExpress = $_POST["chkDeliverExpress"] == '' ? 0 : $_POST["chkDeliverExpress"];
	$chkTakeFromStore = $_POST["chkTakeFromStore"] == '' ? 0 : $_POST["chkTakeFromStore"];
	
	$ecPlatformAry = json_decode($ECPlatform_Template);
	$Json = "[";
	foreach($ecPlatformAry as $array)
    {
    	$ctlID = $array->name;
    	$ckName = $array->value;
    	if (isset($_POST[$ctlID])){
    		$ckValue = "1";
    	}else{
    		$ckValue = "0";	
    	}
    	
    	if ($Json == "["){
			$Json .= '{"name":"'.$ckName.'","value":"'.$ckValue.'"}';
		}else{
			$Json .= ',{"name":"'.$ckName.'","value":"'.$ckValue.'"}';
		}
	}
	$Json .= "]";
	$ecPlatform = $Json;
	//echo $ecPlatform;
	
	$stockNumber = $_POST["StockNumber"] == '' ? 0 : $_POST["StockNumber"];
	$safetyNumber = $_POST["SafetyNumber"] == '' ? 0 : $_POST["SafetyNumber"];
	$onStoreNumber = $_POST["OnStoreNumber"] == '' ? 0 : $_POST["OnStoreNumber"];
	$saleNumber = $_POST["SaleNumber"] == '' ? 0 : $_POST["SaleNumber"];
	$maxPurchaseNumber = $_POST["MaxPurchaseNumber"] == '' ? 0 : $_POST["MaxPurchaseNumber"];
	
	$updateUserID = $currentUserID;
	
	//products table update
	$update_products_sql = "update Products set ProductNo='$productNo',
												ProductName='$productName',
												BrandID=$brandID,
												Status=$status,
												StartDate=$startDate,
												EndDate=$endDate,
												ListPrice=$listPrice,
												UnitPrice=$unitPrice,
												SortNo=$sortNo,
												ProductFeather='$productFeather',
												YoutubeUrl = '$youtubeUrl',
												ProductDescription='$productDescription',
												DeliverExpress = '$chkDeliverExpress',
												TakeFromStore = '$chkTakeFromStore',
												ECPlatform = '$ecPlatform',
												UpdateUserID=$updateUserID
												where ProductID=$productId";
	
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
	
	$ProductBarCode_Sql = "INSERT INTO ProductBarCode (ProductID, ProductNo, BarCode, Color, Size, StockNumber, SafetyNumber, MaxPurchaseNumber) VALUES ";
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
		        $values_Sql .= "('$productId','$productNo','$BarCode[$key]','$Color','$Size[$key]','$StockNumber[$key]','$SafetyNumber[$key]','$MaxPurchaseNumber[$key]')";
		    }else{
		        $values_Sql .= ",('$productId','$productNo','$BarCode[$key]','$Color','$Size[$key]','$StockNumber[$key]','$SafetyNumber[$key]','$MaxPurchaseNumber[$key]')";
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
	
	if (isset($_FILES['imgFile'])) {
	    //$ImageFile_Sql_Delete = "DELETE FROM ImagesFiles WHERE ForeignID = '$productId' AND ImageFunction='products' AND ImageType='detail'";
	    //mysql_query($ImageFile_Sql_Delete);
	    $ImageID = $_POST["ImageID"];
        $myFile = $_FILES['imgFile'];
        $fileCount = count($myFile["name"]);

        for ($i = 0; $i < $fileCount; $i++) {
            if ($myFile["name"][$i] != ""){
				//echo $ImageID[i];
                if (move_uploaded_file($_FILES['imgFile']['tmp_name'][$i], $target_dir . $myFile["name"][$i])) {
					if ($ImageID[i] != ""){
						$insert = "UPDATE ImagesFiles SET ImageFileName = '". $myFile["name"][$i] ."' WHERE ImageID = " . $ImageID[i];
					}else{
						$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$productId','products','detail','$ImagefilePath','". $myFile["name"][$i] ."')";
					}                    
					//echo $insert; 
                    mysql_query($insert);
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
	//header("Location: productDetail2.php?productId=$productId");
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


$tableName = 'Products';
$query_products_sql = "SELECT * FROM $tableName where ProductID = $productId";
$rec = mysql_query($query_products_sql);
$row = $rec ? mysql_fetch_assoc($rec) : NULL;

$barCode_sql = "SELECT vP.* FROM v_ProductCategory vP INNER JOIN ProductsCategorys PC ON vP.P3id = PC.CategoryID WHERE PC.ProductID = '".$row["ProductNo"]."' order by Pkey";
$barCode_sql_result = mysql_query($barCode_sql);

if($row) {
    $currentBrand = getBrand($row['BrandID']);
}


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
    <script type="text/javascript" charset="UTF-8" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
    <script type="text/javascript" charset="UTF-8">		
        function pageInitial(){
            var bodyHeight = document.body.clientHeight;
			var bodyWidth = document.body.clientWidth;
            $("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 100) + "px;width:99.3%");
			CKEDITOR.replace("editor",{height:'300',
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
			showProductCategory('ProductCategory2', $("#ProductCategory1").val());
			showProductCategory('ProductCategory3', $("#ProductCategory2").val());
			$("input[type=submit],input[type=button]").button();
			
        }
        
        var loadFile = function(event,targetId) {
                var reader = new FileReader();
                reader.onload = function(){
                  //var output = document.getElementById('output');
                  //output.src = reader.result;
                  $("#"+targetId).attr('src',reader.result);
                };
                reader.readAsDataURL(event.target.files[0]);
              };
        
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
		
		function addTableRow(strTable){
		    if (strTable =="tbProductsCategorys"){
    		    var strElements = $('#tbProductsCategorys tr');
                var intLoop = strElements.length;
    		    var rowCount = $('#tbProductsCategorys tr').length;
    		    var strProductCategory1 = $("#ProductCategory1 option:selected").text();
    		    var strProductCategory2 = $("#ProductCategory2 option:selected").text();
    		    var strProductCategory3 = $("#ProductCategory3 option:selected").text();
    		    var strValue = $("#ProductCategory3 option:selected").val();
    		    var strExistValue = "";
    		    var intExist = 0;
    		    for (var i = 1; i <= intLoop; i++) {
    		        strExistValue = $("#ProductCategory3_"+i.toString()).val();
    		        if ($("#ProductCategory3 option:selected").val() == strExistValue){
    		            intExist = intExist + 1;
    		        }
    		    }
    		    if (intExist==0){
    		        var strTemplate = "<tr id='trPC"+rowCount+"'><td>"+strProductCategory1+"</td><td>"+strProductCategory2+"</td><td>"+strProductCategory3+"<input id='ProductCategory3_"+ rowCount +"' name='ProductCategory3[]' type='hidden' value='"+strValue+"'/></td><td style='text-align:center'><input name='btnProductsCategoryDelete' type='button' value='刪除' onClick='delTableRow(this);' class='ui-button ui-widget ui-state-default ui-corner-all'/></td></tr>";
    		        $("#tbProductsCategorys").append(strTemplate);
    		    }else{
    		        alert("重複選擇了相同的分類!");   
    		    }
    		}
    		
    		if (strTable =="tbProductBarCode"){
    		    var rowCount = $('#tbProductBarCode tr').length;
    		    var strTemplate = "<tr id='trBC"+rowCount+"'><td style='text-align:center'><input id='txtColor_"+ rowCount +"' class='TextBoxNum' name='txtColor[]' type='text' value=''/></td><td style='text-align:center'><input id='txtSize_"+ rowCount +"' class='TextBoxNum' name='txtSize[]' type='text' value=''/></td><td style='text-align:center'><input id='txtStockNumber_"+ rowCount +"' class='TextBoxNum' name='txtStockNumber[]' type='text' value=''/></td><td style='text-align:center'><input id='txtSafetyNumber_"+ rowCount +"' class='TextBoxNum' name='txtSafetyNumber[]' type='text' value='1'/></td><td style='text-align:center'><input id='txtBarCode_"+ rowCount +"' class='TextBoxNum' name='txtBarCode[]' type='text' value=''/></td><td style='text-align:center'><input id='txtMaxPurchaseNumber_"+ rowCount +"' class='TextBoxNum' name='txtMaxPurchaseNumber[]' type='text' value='3'/></td><td style='text-align:center'><input name='btnBarCodeDelete' type='button' value='刪除' onClick='delTableRow(this);' class='ui-button ui-widget ui-state-default ui-corner-all'/></td></tr>";
    		    $("#tbProductBarCode").append(strTemplate);
    		}   
		}
		
		
		function delTableRow(row){
		    $(row).closest("tr").remove();
		}
		
		function delTableAllRow(strTable){
		    $("#"+strTable).find("tr:gt(0)").remove();
		}
		
		function delImage(num,imgId){
			console.log('deleteimage.php?imgid='+ imgId);
			$.ajax({
				url: 'deleteimage.php?imgid='+ imgId,
				type: 'GET',
				async: false,
				success: function(result) {
					console.log(result);
					if (result =="1"){
						$("#image" + num).attr("src","");
						$("#imageID" + num).val("");
						$("#ibDelete" + num).hide();
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
		    
		}
		
		function checkMandatory(){
		    var strProductNo = $("#ProductNo")   
		}
		
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
    </style>
</head>
<body>

    <div id="divBody" style="width:1600px; margin: 0 auto; ">
		<!-- 加上方選單 -->
		<?php include("_nav.php"); ?>
        <div style="overflow: hidden;">
			<!-- 加左方選單 -->
			<?php include("left_nav.php"); ?>
            <div id="divWork" style="float: left; width: 87%">
                <div class="divWorkArea">
                    <div id="UpdatePanel1">
                        <div class="SeachBar" style="height: 25px; padding-top: 5px">
                            <div style="float: left; padding-right: 10px">
                                <span id="LabMessage" style="color: Red; font-size: 11pt; font-weight: bold;"></span>
                                <form method="post" action="products4.php" >
                                	<input type="submit" id="ibGo2List"  value="回列表頁"/>
                                	<input name="status" type="hidden" value="<? echo $status?>" />
                                	<input name="searchField" type="hidden" value="<? echo $searchField?>" />
                                	<input name="searchKey" type="hidden" value="<? echo $searchKey?>" />
                            	</form>
                            </div>
                            <div style="float: right; padding-right: 10px">
                                
                            </div>
                        </div>
                        
<form name="form1" method="post" action="" id="form1" enctype="multipart/form-data">                        
                        <div id="divDetailBody" class="divDetailBody">
                            <!--<div id="divDetail" style="overflow: auto">-->
                          <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
        				    <tr>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span class="Mandatory">＊商品編號</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <input id="ProductNo" name="ProductNo" style="width: 95%;" type="text" class="TextBox" value="<?echo $row["ProductNo"]?>"/>
                                </td>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span class="Mandatory">＊商品名稱</span>
                                </td>
                                <td colspan="5" bgcolor="#FFFFFF">
                                    <input id="ProductName" name="ProductName" type="text" class="TextBox" style="width:99%" value="<?echo $row["ProductName"]?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span  class="DetailLabel">商品品牌</span>
                                </td>
                                <td bgcolor="#FFFFFF">
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
								<td align="center" bgcolor="#e5e5e5" style="width: 13%">
                                    <span class="DetailLabel">狀態</span>
                                </td>
                                <td bgcolor="#FFFFFF">
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
                                            </td>
                                        </tr>
                                    </table>
                                </td>
        						<td align="center" bgcolor="#e5e5e5" style="width: 13%">
                                    <span class="Mandatory">＊上架日期</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <input name="StartDate" type="date" style="width:95%" class="TextBox" value="<?echo $row["StartDate"] ? date("Y-m-d", strtotime($row["StartDate"])) : NULL;?>"/>
                                </td>
                                <td align="center" bgcolor="#e5e5e5" style="width: 13%">
                                    下架日期
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <input name="EndDate" type="date" style="width:95%" class="TextBox"  value="<?echo $row["EndDate"] ? date("Y-m-d", strtotime($row["EndDate"])) : NULL;?>"/>
                                </td>
                            </tr>
        					<tr>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span class="Mandatory">＊市價</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <input name="ListPrice" style="width:95%" type="number" class="TextBox" value="<?echo $row["ListPrice"]?>"/>
                                </td>
        						<td align="center" bgcolor="#e5e5e5" style="width: 13%">
                                    <span class="Mandatory">＊網路價</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <input name="UnitPrice" style="width:95%" type="number" class="TextBox"  value="<?echo $row["UnitPrice"]?>"/>
                                </td>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span class="Mandatory">＊網路價再確認</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <input name="MemberPrice" style="width:95%" type="number" class="TextBox" value="<?echo $row["MemberPrice"]?>"/>
                                </td>
								<td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span  class="DetailLabel">順序編號</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <input name="SortNo" style="width:95%" type="number" class="TextBox" value="<?echo $row["SortNo"]?>"/>
                                </td>
                                
        					</tr>
        					<?if(isset($productId)){?>
        					<tr>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span  class="DetailLabel">建立時間</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <span style="font-size: 10pt;"><?echo $row["CreateDate"]?></span>
                              </td>
        						<td align="center" bgcolor="#e5e5e5" style="width: 13%">
                                    <span class="DetailLabel">建立人員</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <span style="font-size: 10pt;"><?echo getUserName($row["CreateUserID"])?></span>
                                </td>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span  class="DetailLabel">更新時間</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <span style="font-size: 10pt;"><?echo $row["UpdateDate"]?></span>
                                </td>
        						<td align="center" bgcolor="#e5e5e5" style="width: 13%">
                                    <span class="DetailLabel">異動人員</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <span style="font-size: 10pt;"><?echo getUserName($row["UpdateUserID"])?></span>
                                </td>
        					</tr>
        					<?}?>
							<tr>
								<td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span  class="DetailLabel">已上架商城</span>
                                </td>
                                <td colspan="7" bgcolor="#FFFFFF">
                                	<?  $rowCount = 1;
                                		$ecPlatform = json_decode($row["ECPlatform"]);
										foreach($ecPlatform as $array)
									    {
									    	if ($array->value == "1"){
									    		$ecValue="1";
									    		$ecCheck = "checked";
									    	}else{
									    		$ecValue="0";
									    		$ecCheck = "";
									    	}
									?>
								  <input type="checkbox" id="ckEStore<? echo $rowCount ?>" name="ckEStore<? echo $rowCount ?>" class="regular-checkbox" value="<? echo $ecValue ?>" <? echo $ecCheck ?> /><label for="ckEStore<? echo $rowCount ?>"><? echo $array->name ?></label>
									<? $rowCount = $rowCount +1;}?>
                                </td>
							</tr>
        					<td bgcolor="#FFFFFF"><tr>
        					    <td style="width: 10%" align="center" bgcolor="#e5e5e5"><span class="Mandatory">＊商品分類</span></td>
                                <td colspan="7" >
                                    <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
        				                <tr>
        				                    <td>
        				                        <?
                    								$category1_sql = "SELECT * FROM ProductCategory1 WHERE 1 ORDER BY CategorySort";
                    								$category1_result = mysql_query($category1_sql);
                    								//$category2_sql = "SELECT * FROM ProductCategory2 WHERE 1";
                    								//$category2_result = mysql_query($category2_sql);
                    								//$category3_sql = "SELECT * FROM ProductCategory3 WHERE 1";
                    								//$category3_result = mysql_query($category3_sql);
                    							?>
                    							<select onChange="showProductCategory('<?echo "ProductCategory2" ?>',this.value)"  name="ProductCategory1" id="ProductCategory1" class="dropdownlist">
                    								<? while($category1 = mysql_fetch_assoc($category1_result)){ ?>
                    									<option value="<? echo $category1["id"] ?>" ><?echo $category1["CategoryName"] ?></option>	
                    								<?}?>
                    							</select>
                    							<select onChange="showProductCategory('<?echo "ProductCategory3" ?>',this.value)"  name="ProductCategory2" id="ProductCategory2" class="dropdownlist" >
                    							</select>
                    							<select name="ProductCategory3" id="ProductCategory3" class="dropdownlist" >
                    							</select>
                    							<input name="btnAddCategory" type="button" style="padding-top: 5px;" value="新增分類" onclick="addTableRow('tbProductsCategorys')" />
        				                    </td>
        				                </tr>
        				                <tr>
        				                    <td>
        				                        <table id="tbProductsCategorys" class="TableLine" border="1px" cellpadding="5px" width="500px" bordercolor="#BABAD2">   
        				                            <tr>
        				                                <th style="background-color:#D9D9D9">大分類</th>
        				                                <th style="background-color:#D9D9D9">中分類</th>
        				                                <th style="background-color:#D9D9D9">小分類</th>
        				                                <th style="background-color:#D9D9D9"><input name="btnDelAllRow" type="button" value="全部刪除" onclick="delTableAllRow('tbProductsCategorys');" /></th>
                                                        <?  $BarCode_sql_result = "SELECT * FROM ProductsCategorys PC INNER JOIN v_ProductCategory vP ON PC.CategoryID = vP.P3id WHERE PC.ProductID ='".$row["ProductID"]."'";
                                                            $recBarCode = mysql_query($BarCode_sql_result);
                                                            $rowCount = "1";
                                                            while($BarCodeRow = mysql_fetch_assoc($recBarCode)) {
													    ?>
															<tr id="trPC<? echo $rowCount?>">
                                                                <td><? echo $BarCodeRow["P1CategoryName"]?></td>
                                                                <td><? echo $BarCodeRow["P2CategoryName"]?></td>
                                                                <td>
                                                                    <? echo $BarCodeRow["P3CategoryName"]?>
                                                                    <input id="ProductCategory3_<? echo $rowCount ?>" name="ProductCategory3[]" type="hidden" value="<? echo $BarCodeRow["CategoryID"]?>"/>
                                                                </td>
                                                                <td style="text-align:center"><input name="btnProductsCategoryDelete" type="button" value="刪除" onClick="delTableRow(this);"/></td>
                                                            </tr>
														<? $rowCount = $rowCount + 1;
														}?>
        				                            </tr>
        				                            
        				                        </table>
        				                    </td>
        				                </tr>
        				            </table>
                                </td>
                            <td bgcolor="#FFFFFF"></tr>
                            <td bgcolor="#FFFFFF"><tr>
        					    <td style="width: 10%" align="center" bgcolor="#e5e5e5"><span class="Mandatory">＊商品規格</span></td>
                                <td colspan="7" >
                                    <input name="btnAddCategory" type="button" value="新增規格" onclick="addTableRow('tbProductBarCode')" /><br/>
                                    <table id="tbProductBarCode" class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
        				                <tr>
        				                    <th style="background-color:#D9D9D9; width:15%">規格1</th>
        				                    <th style="background-color:#D9D9D9; width:15%">規格2</th>
        				                    <th style="background-color:#D9D9D9; width:15%">庫存量</th>
        				                    <th style="background-color:#D9D9D9; width:15%">安全庫存量</th>
        				                    <th style="background-color:#D9D9D9; width:15%">商品條碼</th>
        				                    <th style="background-color:#D9D9D9; width:15%">最高購買數量</th>
        				                    <th style="background-color:#D9D9D9; width:10%"><input name="btnDelAllRow" type="button" value="全部刪除" onclick="delTableAllRow('tbProductBarCode');" /></th>
        				                    <?  $BarCode_sql_result = "SELECT * FROM ProductBarCode WHERE ProductID = '".$row["ProductID"] ."'";
                                                $recBarCode= mysql_query($BarCode_sql_result);
                                                $rowCount = "1";
                                                while($BarCodeRow = mysql_fetch_assoc($recBarCode)) {
										    ?>
												<tr id="trBC<? echo $rowCount?>">
                                                    <td style="text-align:center"><input id="txtColor_<? echo $rowCount?>" class="TextBoxNum" name="txtColor[]" type="text" value="<? echo $BarCodeRow["Color"] ?>" /></td>
                                                    <td style="text-align:center"><input id="txtSize_<? echo $rowCount?>" class="TextBoxNum" name="txtSize[]" type="text" value="<? echo $BarCodeRow["Size"] ?>" /></td>
                                                    <td style="text-align:center"><input id="txtStockNumber_<? echo $rowCount?>" class="TextBoxNum" name="txtStockNumber[]" type="text" value="<? echo $BarCodeRow["StockNumber"] ?>" /></td>
                                                    <td style="text-align:center"><input id="txtSafetyNumber_<? echo $rowCount?>" class="TextBoxNum" name="txtSafetyNumber[]" type="text" value="<? echo $BarCodeRow["SafetyNumber"] ?>" /></td>
                                                    <td style="text-align:center"><input id="txtBarCode_"+ <? echo $rowCount?>" class="TextBoxNum" name="txtBarCode[]" type="text" value="<? echo $BarCodeRow["BarCode"] ?>" /></td>
                                                    <td style="text-align:center"><input id="txtMaxPurchaseNumber_<? echo $rowCount?>" class="TextBoxNum" name="txtMaxPurchaseNumber[]" type="text" value="<? echo $BarCodeRow["MaxPurchaseNumber"] ?>" /></td>
                                                    <td style="text-align:center"><input name="btnBarCodeDelete" type="button" value="刪除" onClick="delTableRow(this);"/></td>
                                                </tr>
											<? $rowCount = $rowCount + 1;
											}?>
        				                </tr>
        				            </table>
        				            <br/>
        				        </td>
        				    <td bgcolor="#FFFFFF"></tr>
        				    <tr>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span  class="DetailLabel">配送方式設定</span>
                                </td>
                                <td colspan="7" bgcolor="#FFFFFF" >
									<?
										$chkDeliverExpress = '';
										$chkTakeFromStore = '';
										if ($row["DeliverExpress"] == 1) {
											$chkDeliverExpress = 'checked="true"';
										} 
										
										if ($row["TakeFromStore"] == 1) {
											$chkTakeFromStore = 'checked="true"';
										}
									?>
                                    <input type="checkbox" id="chkDeliverExpress" name="chkDeliverExpress" class="regular-checkbox" value="1" <? echo $chkDeliverExpress?>  /><label for="chkDeliverExpress">貨運宅配</label>
                                    <input type="checkbox" id="chkTakeFromStore" name="chkTakeFromStore" class="regular-checkbox" value="1" <? echo $chkTakeFromStore?>  /><label for="chkTakeFromStore">門市取貨</label></td>
                                </td>
        					</tr>
        					<tr>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span class="Mandatory">＊商品圖</span>
                                </td>
                                <td colspan="7" >
                                    <table id="tbImage" class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
        				                <tr>
        				                    <?  $Image_sql_result = "SELECT concat(ImagePath,ImageFileName) as ImageFile, ImageID FROM ImagesFiles WHERE ImageFunction = 'products' AND ImageType ='detail' AND ForeignID ='".$row["ProductID"] . "' ORDER BY ImageID";
                                                $recImage = mysql_query($Image_sql_result);
                                                $rowCount = "1";
                                                while($ImageRow = mysql_fetch_assoc($recImage)) {
										    ?>
												<th style="background-color:#D9D9D9; width:16%; height:100px;">
													<img id="image<? echo $rowCount?>" width="100px" height="100px" src="<? echo $ImageRow["ImageFile"]?>" />
													<input id="imageID<? echo $rowCount?>" type="hidden" name="ImageID[]" value="<? echo $ImageRow["ImageID"]?>"/>
												</th>
											<?  $rowCount = $rowCount + 1; 
											    }
											    
											    if ($rowCount < 6){
											        for ($x = $rowCount; $x <=6; $x++){
											?>
                                                        <th style="background-color:#D9D9D9; width:16%; height:100px;"><img id="image<? echo $x?>" width="100px" height="100px" /></th>                                           
                                            <?
                                                    }
                                                }
											?>
        				                </tr>
        				                <tr>
											<? 	$Image_sql_result2 = "SELECT concat(ImagePath,ImageFileName) as ImageFile, ImageID FROM ImagesFiles WHERE ImageFunction = 'products' AND ImageType ='detail' AND ForeignID ='".$row["ProductID"] . "' ORDER BY ImageID";
                                                $recImage2 = mysql_query($Image_sql_result2);
												$rowCount = 1;
												while($ImageRow2 = mysql_fetch_assoc($recImage2)) { 
											?>
        				                    <td bgcolor="#FFFFFF">
        				                    	<input type="file" name="imgFile[]" id="imgFile1" accept="image/*" onchange="loadFile(event,'image<?echo $rowCount?>')" style="width:70px">
        				                    	<input type="button" name="ibDelete[]" id="ibDelete<?echo $rowCount?>" value="刪除" onClick="showLoading();delImage('<?echo $rowCount?>','<? echo $ImageRow2["ImageID"]?>')" />
        				                    </td>
        				                    <?  $rowCount = $rowCount + 1; 
											    }
											    
											    if ($rowCount < 6){
											        for ($x = $rowCount; $x <=6; $x++){
											?>
								  <td bgcolor="#FFFFFF">
                                                        <input type="file" name="imgFile[]" id="imgFile1" accept="image/*" onchange="loadFile(event,'image<?echo $x?>')" style="width:70px"> 
                                            </td>                                      
                                            <?
                                                    }
                                                }
											?>
        				                </tr>
        				            </table>
        				            <br/>
                                </td>
        					</tr>
                            <tr>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span  class="DetailLabel">商品特色</span>
                                </td>
                                <td colspan="7" bgcolor="#FFFFFF" >
                                    <textarea name="ProductFeather" id="ProductFeather" style="width:80%" class="TextBox" rows="10" cols="100"><?echo $row["ProductFeather"]?></textarea>
                                </td>
        					</tr>
							<tr>
                                <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                                    <span  class="DetailLabel">Youtube連結</span>
                                </td>
                                <td colspan="7" bgcolor="#FFFFFF" >
                                    <textarea name="YoutubeUrl" type="text" class="TextBox" style="width:80%"/><?echo $row["YoutubeUrl"]?></textarea>
                                </td>
        					</tr>
                            <tr>
                                <td colspan="8" bgcolor="#FFFFFF" >
                                    <span style="font-size: 10pt;">詳細說明</span>
									<textarea name="ProductDescription" id="editor" rows="10" cols="100"><?echo $row["ProductDescription"]?></textarea>
                                </td>
                            </tr>
                            </table>
      <br /><br />
                            <div style="width:100%; text-align:center">
                            <? if (isset($productId)) {?>	
                        		<input type="submit" name="ibSave" id="ibSave"  value=" 儲存資料 " onClick="showLoading();" style="font-size:12pt; height:35px" />
                        		<input type="hidden" name="action" value="update"/>
                        	<? } else { ?>							
                        		<input type="submit" name="ibSave" id="ibSave"  value=" 儲存資料 " onClick="showLoading();" style="font-size:12pt; height:35px" />
                        		<input type="hidden" name="action" value="add"/>	
                        	<? } ?>
                        	</div>
                        	<br />
                        	<br />
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <input id="productID" name="productID" type="hidden" value="<? echo $productID?>"/>
</form>
</body>
</html>
