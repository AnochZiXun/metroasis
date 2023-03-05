<?php
include('_connMysql.php');
include('check_login.php');

$query_product_sql = "SELECT P.ProductID, P.ProductNo,P.ProductName,format(P.UnitPrice,0) as UnitPrice,format(P.ListPrice,0) as ListPrice,Status, P.UpdateDate,(SELECT ImageFileName FROM `ImagesFiles` WHERE `ImageFunction` = 'products' AND `ImageType` = 'detail' AND `ForeignID` = P.ProductID LIMIT 1) AS ImageFileName ";
$productTableName = "FROM Products P ";
$query_product_sql = "$query_product_sql $productTableName WHERE 1";
$orderBy = ' order by P.ProductNo desc';

if(isset($_POST["Status"])){
    $Status = $_POST["Status"];
    $query_product_sql = $Status ? $query_product_sql . ' and P.Status = '. $Status : $query_product_sql ;
}

if (isset($_POST["SearchField"])){
    $searchField = $_POST["SearchField"];
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
$recProducts = mysql_query($query_product_sql);
$query_product_sql = $query_product_sql.$orderBy;
//delete
if(isset($_POST["delete"])) {
	$productId = $_POST["ProductId"];
	$productNo = $_POST["ProductNo"];
	
	$delete_barcode_sql = "delete from ProductBarCode where ProductNo='$productNo'";
	mysql_query($delete_barcode_sql);
	$deleteSql = "delete from $productTableName where productId = '$productId'";
	mysql_query($deleteSql);	
	header("Location: products.php");
}

//預設每頁筆數
$pageRow_records = 10;
//總筆數
$total_records = mysql_num_rows($recProducts);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if(!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
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
            $("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 105) + "px");
            $(".detail").colorbox({ iframe: true, width: "100%", height: "100%", overlayClose: false, escKey: false, 
									onClosed: function () { location.href="products.php"; } });
            $(".add").colorbox({ iframe: true, width: "100%", height: "100%", overlayClose: false, escKey: false, 
									href: "productDetail.php",
									onClosed: function () { location.href="products.php"; }	});
			$("input[type=submit], input[type=button]" ).button();
        }
		
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
    <div id="divBody">
		<!-- 加上方選單 -->
		<?php include("_nav.php"); ?>
        <div style="overflow: hidden;">
			<!-- 加左方選單 -->
			<?php include("left_nav.php"); ?>
            <div id="divWork" style="float: left; width: 87%">
                <div class="divWorkArea">
                    <div id="UpdatePanel1">
                        <div class="SeachBar" style="height: 25px; padding-top: 5px">
                            
							<form action="" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
								<div style="float: left; height: 25px; font-size: 10pt;">
									商品狀態：
								</div>
								<div style="float: left; padding-right: 10px;">
									<select name="Status" id="Status" style="width: 120%;" class="dropdownlist">
										<option value="1" selected="selected">上架</option>
										<option value="2">下架</option>
									</select>
								</div>
								<div style="float: left; padding-left: 10px;">
									<select name="SearchField" id="SearchField" style="width: 120%;" class="dropdownlist">
										<option value="ProductName" selected="selected">商品名稱</option>
										<option value="BarCode">商品條碼</option>
									</select>
								</div>
								<div style="float: left; height: 25px; font-size: 10pt;; padding-left: 20px; color:Red">
									輸入關鍵字：
								</div>
								<div style="float: left; padding-right: 10px;">
									<input type="text" class="TextBox" name="searchKey" placeholder="Search.." style="width:250px" value="<? echo $searchKey?>">
								</div>
								<div style="float: left; padding-left: 10px;">
									<input name="submitSearch" type="submit" value="查詢"/>
								</div>
							</form>
							
                            <div style="float: right">
								<input type="button" name="ibAdd" id="ibAdd"  value=" 新增商品 " onClick="javascript:location.href='productDetail3.php?productId='"/>
                            </div>
                        </div>
                        <div id="divDetailBody" class="divDetailBody">
                            <div id="divGridview" style="overflow: auto">
                                <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                        style="border-collapse: collapse;">
										<tr>
                                            <th scope="col" style="width: 3%;">全選</th>
                                            <th scope="col" style="width: 5%;">狀態</th>
											<th scope="col" style="width: 7%;">商品圖</th>
											<th scope="col" style="width: 39%;">商品分類 / 商品名稱</th>
											<th scope="col" style="width: 5%;">網路價</th>
											<th scope="col" style="width: 5%;">市價</th>
											<th scope="col" style="width: 20%;">顏色/尺寸/庫存量</th>
											<th scope="col" style="width: 9%;">更新日期</th>
											<th scope="col" style="width: 7%;">管理</th>
                                        </tr>
                                        <? while($row=mysql_fetch_assoc($recProducts)){ ?>
										<tr>
                                            <td align="center">
                                                <input name="chkProduct" type="checkbox" class="checkbox" style="width: 95%;" value="0">
                                            </td>
                                            <td align="center">
												<? echo $row["Status"] == 1 ? "上架" : "下架"; ?>
                                            </td>
											<td align="center">
											    <? if ($row["ImageFileName"] !="") {?>
												<img src="/images/products/<?echo $row["ProductID"]?>/<?echo $row["ImageFileName"]?>" width="64px" height="64px" /> 
												<? }?>
                                            </td>
                                            <td align="left">
												<? $query_pc_sql = "SELECT concat('．',vP.P1CategoryName,' > ',vP.P2CategoryName,' > ',vP.P3CategoryName) AS CategoryName FROM ProductsCategorys PC INNER JOIN v_ProductCategory vP ON PC.CategoryID = vP.P3id WHERE PC.ProductID ='". $row["ProductID"] . "'";
												   $recPC = mysql_query($query_pc_sql);
												   $PC = "";
												   while($rowPC=mysql_fetch_assoc($recPC)){
												       if ($PC ==""){
												           $PC.= $rowPC["CategoryName"] . "<br/>";
												       }else{
												           $PC.= $rowPC["CategoryName"] . "<br/>";
												       }
												   }
												   echo $PC;
												   echo "---------------------------------------------------<br />";
												?>
												<? echo $row["ProductName"]; ?>
                                            </td>
                                            <td align="center">
												<? echo $row["UnitPrice"]; ?>
                                            </td>
                                            <td align="center">
												<? echo $row["ListPrice"]; ?>
                                            </td>
                                            <td align="left">
												<table class="TableLine" border="0px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
												
												<?	$query_pb_sql = "SELECT * FROM ProductBarCode WHERE ProductID ='". $row["ProductID"] . "'";
													$recPB = mysql_query($query_pb_sql);
													$rowNums=mysql_num_rows($recPB);
													if ($rowNums > 0)
													{
														while($rowPB=mysql_fetch_assoc($recPB)){
												?>
												<tr>
													<td style="width:45%"><? echo $rowPB["Color"]; ?></td>
													<td style="width:45%"><? echo $rowPB["Size"]; ?></td>
													<td style="width:10%"><input name="StockNumber" type="text" class="TextBoxNum" value="<?echo $rowPB["StockNumber"]?>" onfocus="$(this).select();" /></td>
												</tr>
												<?		}?>
												<tr><td colspan="3" style="text-align:right"><input name="btnSaveStockNumber" type="button" value="儲存"/></td></tr>
												<?}?>	
												</table>
                                            </td>
                                            <td align="center">
												<? $UpdateDate = date_create($row["UpdateDate"]); echo date_format($UpdateDate,"Y/m/d") . "<br />" . date_format($UpdateDate,"H:i:s"); ?>
                                            </td>
                                            <td align="center">
                                                <input name="btnEdit" type="button" value="編輯" onclick="javascript:location.href='productDetail3.php?productId=<?echo $row["ProductID"]?>'"/><br/>
                                                <input name="btnCopy" type="button" value="複製"/><br/>
                                            </td>
                                        </tr>
										<? } ?>
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
											<a href="products3.php?page=1">最前頁｜</a>
                                        </td>
                                        <?	
											$prePage = $page-1;
											if ($prePage < 1) {
												$prePage = 1;
											}
										?>
										<td>
											<a href="products3.php?page=<?echo $prePage?>">上頁｜</a>
                                        </td>
										<?	
											$nextPage = $page+1;
											if ($nextPage > $total_pages) {
												$nextPage = $total_pages;
											}
										?>
                                        <td>
											<a href="products3.php?page=<?echo $nextPage?>">下頁｜</a>
                                        </td>
                                        <td>
											<a href="products3.php?page=<?echo $total_pages?>">最後頁</a>
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
