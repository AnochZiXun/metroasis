<?php
include('_connMysql.php');
include('check_login.php');

$productCategoryTableName;
if (isset($_GET["categoryId"])) {
	$categoryId = $_GET["categoryId"];
} 
if (isset($_GET["ProductCategory"])) {
	$productCategory = $_GET["ProductCategory"];
	$parentCategoryId;
	if ("2" == $productCategory) {
		$productCategoryTableName = "ProductCategory2";			
		$parentCategoryId = $_GET["parentCategoryId"];
	} else if ("3" == $productCategory) { 
		$productCategoryTableName = "ProductCategory3";	
		$parentCategoryId = $_GET["parentCategoryId"];
	} else {
		$productCategoryTableName = "ProductCategory1";	
		$parentCategoryId = null;
	} 
} 

$query = "SELECT * FROM $productCategoryTableName where id = '$categoryId'";
//echo "query :　".$query."</br>";
$rec = mysql_query($query);
$row = mysql_fetch_assoc($rec);


if ($_POST["action"] == "update"){ 
	$categoryId = $_POST["CategoryId"];	
	$categorySort = $_POST["CategorySort"];	
	$categoryName = $_POST["CategoryName"];
	$parentCategoryId = $_POST["ParentCategoryId"];	
	$productCategory = $_POST["ProductCategory"];
	$update;
	if ('2' == $productCategory) {
		$productCategoryTableName = "ProductCategory2";	
		$update = "UPDATE $productCategoryTableName SET CategorySort='$categorySort',CategoryName='$categoryName',
				ParentCategoryId='$parentCategoryId' WHERE id = '$categoryId'";			
	} else if ('3' == $productCategory) {
		$productCategoryTableName = "ProductCategory3";	
		$update = "UPDATE $productCategoryTableName SET CategorySort='$categorySort',CategoryName='$categoryName',
				ParentCategoryId='$parentCategoryId' WHERE id = '$categoryId'";			
	} else {
		$productCategoryTableName = "ProductCategory1";
		$update = "UPDATE $productCategoryTableName SET CategorySort='$categorySort',CategoryName='$categoryName' WHERE id = '$categoryId'";		
	}
	
	//echo $update;
	mysql_query($update);
	
	echo "<script>
				parent.location.href = 'productCategory.php?ProductCategory=$productCategory';	
				parent.$.fn.colorbox.close(); 			
		 </script>";	
}

if ($_POST["action"] == "add"){ 	
	$categorySort = $_POST["CategorySort"];	
	$categoryName = $_POST["CategoryName"];
	$parentCategoryId = $_POST["ParentCategoryId"];	
	$productCategory = $_POST["ProductCategory"];	
	$insert;

	if ('2' == $productCategory) {
		$productCategoryTableName = "ProductCategory2";	
		$insert = "INSERT INTO $productCategoryTableName(categorySort,CategoryName,ParentCategoryId) 
					VALUES ('$categorySort','$categoryName','$parentCategoryId')";			
	} else if ('3' == $productCategory) {
		$productCategoryTableName = "ProductCategory3";	
		$insert = "INSERT INTO $productCategoryTableName(categorySort,CategoryName,ParentCategoryId) 
					VALUES ('$categorySort','$categoryName','$parentCategoryId')";			
	} else {
		$productCategoryTableName = "ProductCategory1";
		$insert = "INSERT INTO $productCategoryTableName(categorySort,CategoryName) 
					VALUES ('$categorySort','$categoryName')";	
	}
	
	
	//echo $insert;
	mysql_query($insert);				
   
	//echo "<script> alert('品牌名稱已存在'); </script>";

	echo "<script>
				parent.location.href = 'productCategory.php?ProductCategory=$productCategory';
				parent.$.fn.colorbox.close(); 					
		 </script>";
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
        $(document).ready(function () { PageInitial(); });
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
            $("#HTMLEditor1").cleditor();
            //$(".Attachs").colorbox({ iframe: true, width: "800px", height: "560px", overlayClose: false, escKey: false, href: "attachsupload.php" });
            $("#txtBeginDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true });
            $("#txtEndDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true });
			
			var strLv1Id = $("#lv1").val();
			<?if (!$categoryId && '3' == $productCategory) {?>
			queryCategory(strLv1Id,2);	
			<?}?>
        }
		
		function queryCategory(lvId, lv) {			
			$.ajax({			
				url: 'queryCategory.php?lvId='+lvId+'&lv='+lv,
				type: 'GET',					
				success: function(result) {				
					var optionalList = result.split("＃");
					$("#ParentCategoryId").empty();
					for(var i=0; i<optionalList.length; i++) {
						var optionalStr = optionalList[i];
						//alert(optionalStr);	
						var optional = optionalStr.split("，");
						$("#ParentCategoryId").append($("<option></option>").attr("value", optional[0]).text(optional[1]));
					}					
					
				},
				error: function(xhr) {
					return -1;
					//alert(xhr.responseText);				
				}
			}); 
		}	
	
    </script>
</head>
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
                        <? if (isset($_GET["categoryId"])) {?>	
							<input type="image" name="ibSave" id="ibSave" title="儲存資料" src="images/mountoff.png" onclick="showLoading();" style="border-width: 0px;" />								
							<input type="hidden" name="CategoryId" id="CategoryId" value="<? echo $categoryId?>"/>
							<input type="hidden" name="action" value="update"/>							
						<? } else { ?>							
							<input type="image" name="ibSave" id="ibSave" title="新增" src="images/mountoff.png" onclick="showLoading();" style="border-width: 0px;" />								
							<input type="hidden" name="action" value="add"/>	
						<? } ?>
                    </div>
                </div>
            </div>
            <div id="divDetailBody" class="divDetailBody">
                <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                    <tr>
						<td style="width: 13%" align="center">
                            <span id="Label3" class="DetailLabel">商品類別</span>
                        </td>
                        <td colspan="7">
							<?
							if ('2' == $productCategory) {
								$findLv1 = "select * from ProductCategory1 order by CategorySort";
								$recLv1 = mysql_query($findLv1);
							?>
								<span id="Label3" class="DetailLabel">大分類：</span>
								<select name="ParentCategoryId" id="ParentCategoryId" class="dropdownlist" >
									<? while($rowLv1 = mysql_fetch_assoc($recLv1)){ ?>
										<?if ($rowLv1["id"] == $row["ParentCategoryId"]) {?>
											<option value="<? echo $rowLv1["id"] ?>" selected><?echo $rowLv1["CategoryName"] ?></option>
										<? } else {?>
											<option value="<? echo $rowLv1["id"] ?>" ><?echo $rowLv1["CategoryName"] ?></option>
										<? } ?>
									<? } ?>
								</select>							
							<? } else if ($categoryId && '3' == $productCategory) { 
									$findLv2GropId = "select ParentCategoryId from ProductCategory2 WHERE id = '".$row["ParentCategoryId"]."'";
									//echo "findLv2GropId :　".$findLv2GropId."</br>";				
									$recLv2GropId = mysql_query($findLv2GropId);
									$rowLv2GropId = mysql_fetch_assoc($recLv2GropId);
									$lv2GropId = $rowLv2GropId["ParentCategoryId"];
									//echo "lv2GropId :　".$lv2GropId."</br>";
									$findLv2 = "select * from ProductCategory2 WHERE ParentCategoryId = $lv2GropId order by CategorySort";
									//echo "findLv2 :　".$findLv2."</br>";
									$recLv2 = mysql_query($findLv2);							
							?>
								<span id="Label3" class="DetailLabel">中分類：</span>
								<select name="ParentCategoryId" id="ParentCategoryId" class="dropdownlist" >
									<? while($rowLv2 = mysql_fetch_assoc($recLv2)){ ?>
										<?if ($rowLv2["id"] == $row["ParentCategoryId"]) {?>
											<option value="<? echo $rowLv2["id"] ?>" selected><?echo $rowLv2["CategoryName"] ?></option>
										<? } else {?>                                
											<option value="<? echo $rowLv2["id"] ?>" ><?echo $rowLv2["CategoryName"] ?></option>
										<? } ?>
									<? } ?>
								</select>	
							<? } else if (!$categoryId && '3' == $productCategory) {								
									$findLv1 = "select * from ProductCategory1 order by CategorySort";
									$recLv1 = mysql_query($findLv1);									
							?>
								<span id="Label3" class="DetailLabel">大分類</span>
								<select name="lv1" id="lv1" class="dropdownlist" onchange="queryCategory(this.value, 2)">
									<? while($rowLv1 = mysql_fetch_assoc($recLv1)){ ?>
										<?if ($rowLv1["id"] == $row["ParentCategoryId"]) {?>
											<option value="<? echo $rowLv1["id"] ?>" selected><?echo $rowLv1["CategoryName"] ?></option>
										<? } else {?>
											<option value="<? echo $rowLv1["id"] ?>" ><?echo $rowLv1["CategoryName"] ?></option>
										<? } ?>
									<? } ?>
								</select>
								
								<span id="Label3" class="DetailLabel">中分類：</span>
								<select name="ParentCategoryId" id="ParentCategoryId" class="dropdownlist" >
									<option value="" id="lv2_default" selected>
								</select>
							<? } else { echo "大分類";}?>
					</tr>
					<tr>						
                        <td style="width: 8%" align="center">
                            <span id="Label2" class="DetailLabel">排序</span>
                        </td>
						<td>
                            <input name="CategorySort" type="number" min="1" id="CategorySort" class="TextBox" style="width: 50%;" value="<?echo $row["CategorySort"]?>"/>
                        </td>
						<td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">分類名稱</span>
                        </td>
                        <td>
                            <input name="CategoryName" type="text" id="CategoryName" class="TextBox" style="width: 95%;" value="<?echo $row["CategoryName"]?>"/>
                        </td>
                    </tr>
                </table>
				<input name="ProductCategory" type="hidden" value="<? echo $productCategory ?>"/>
            </div>
        </div>
    </form>

</body>
</html>
