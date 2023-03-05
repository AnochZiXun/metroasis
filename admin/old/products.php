<?php
include('_connMysql.php');
include('check_login.php');

$query_product_sql = 'SELECT ProductID, ProductNo,ProductName,format(StockNumber,0) as StockNumber,format(SafetyNumber,0) as SafetyNumber,format(OnStoreNumber,0) as OnStoreNumber,format(ListPrice,0) as ListPrice,Status FROM';
$productTableName = ' Products';
$query_product_sql = "$query_product_sql $productTableName WHERE 1";
$orderBy = ' order by productId desc';
if(isset($_POST["ProductNo"]) or isset($_POST["ProductName"])) {
    $productNo = trim($_POST["ProductNo"]);
	$productName = trim($_POST["ProductName"]);
    $query_product_sql = $productNo ? $query_product_sql.' and ProductNo like "%'.$productNo.'%" ' : $query_product_sql;  
	$query_product_sql = $productName ? $query_product_sql.' and ProductName like "%'.$productName.'%" ' : $query_product_sql;  
}
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
$pageRow_records = 20;
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
			$("input[type=submit], button" ).button();
        }
		
    </script>
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
								<div style="float: left; height: 25px; padding-top: 5px; font-size: 10pt;
									">
									商品號碼：
								</div>
								<div style="float: left; padding-right: 10px;">
									<input type="text" class="TextBox" name="ProductNo" placeholder="Search.." style="width:250px">
								</div>
								<div style="float: left; height: 25px; padding-top: 5px; font-size: 10pt;
									">
									商品名稱：
								</div>
								<div style="float: left; padding-right: 10px;">
									<input type="text" class="TextBox" name="ProductName" placeholder="Search.." style="width:250px">
								</div>
								<div style="float: left; padding-left: 10px;">
									<input name="submitSearch" type="submit" value="查詢"/>
								</div>
							</form>
							
                            <div style="float: right">
								<img src="images/addoff.png" id="Img1" class="add" style="cursor: pointer"
                                    onmousemove="this.src=&#39;images/addon.png&#39;" onmouseout="this.src=&#39;images/addoff.png&#39;"
                                    title="新增" alt="Add" />
                            </div>
                        </div>
                        <div id="divDetailBody" class="divDetailBody">
                            <div id="divGridview" style="overflow: auto">
                                <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                        style="border-collapse: collapse;">
										<tr>
                                            <th scope="col" style="width: 20%;">商品號碼</th>
                                            <th scope="col" style="width: 60%;">商品名稱</th>
                                            <th scope="col" style="width: 20%;">庫存量</th>
											<th scope="col" style="width: 20%;">安全存量</th>
											<th scope="col" style="width: 20%;">門市存量</th>
											<th scope="col" style="width: 20%;">牌價</th>
											<th scope="col" style="width: 10%;">狀態</th>
											<th scope="col" style="width: 25%;" colspan="2">處理</th>
                                        </tr>
                                        <? while($row=mysql_fetch_assoc($recProducts)){ ?>
										<tr>
                                            <td align="center">
                                                <? echo $row["ProductNo"]; ?>
                                            </td>
                                            <td align="center">
												<? echo $row["ProductName"]; ?>
                                            </td>
											 <td align="center">
												 <? echo $row["StockNumber"]; ?>
                                            </td>
                                            <td align="center">
												<? echo $row["SafetyNumber"]; ?>
                                            </td>
                                            <td align="center">
												<? echo $row["OnStoreNumber"]; ?>
                                            </td>
                                            <td align="center">
												<? echo $row["ListPrice"]; ?>
                                            </td>
                                            <td align="center">
												<? echo $row["Status"] == 1 ? "上架" : "下架"; ?>
                                            </td>
                                            <td align="center">
                                                <a id="gvGridView_ctl02_hlContents" class="detail" href="productDetail.php?productId=<? echo $row["ProductID"]; ?>">
                                                    內容設定
												</a>
                                            </td>
											<td align="center">
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
													<input name="delete" type="submit" value="刪除"/>
													<input name="ProductId" type="hidden" value="<? echo $row["ProductID"]; ?>"/>
													<input name="ProductNo" type="hidden" value="<? echo $row["ProductNo"]; ?>"/>
													<input name="action" type="hidden" value="delete"/>
												</form>
                                            </td>
                                        </tr>
										<? } ?>
                                    </table>
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
											<a href="products.php?page=1">最前頁｜</a>
                                        </td>
                                        <?	
											$prePage = $page-1;
											if ($prePage < 1) {
												$prePage = 1;
											}
										?>
										<td>
											<a href="products.php?page=<?echo $prePage?>">上頁｜</a>
                                        </td>
										<?	
											$nextPage = $page+1;
											if ($nextPage > $total_pages) {
												$nextPage = $total_pages;
											}
										?>
                                        <td>
											<a href="products.php?page=<?echo $nextPage?>">下頁｜</a>
                                        </td>
                                        <td>
											<a href="products.php?page=<?echo $total_pages?>">最後頁</a>
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
