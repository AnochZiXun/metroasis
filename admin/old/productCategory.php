<?php
include('_connMysql.php');
include('check_login.php');

$query_productCategory = 'SELECT * FROM ';
$orderBy = ' order by CategorySort';
$productCategoryTableName = "ProductCategory1";
//search ProductCategory table 
if (isset($_POST["ProductCategory"]) || isset($_GET["ProductCategory"])) {	
	$productCategory = trim($_POST["ProductCategory"]) ? trim($_POST["ProductCategory"]) : trim($_GET["ProductCategory"]) ;	
	if ('2' == $productCategory) {
		$productCategoryTableName = "ProductCategory2";	
		$orderBy = ' order by ParentCategoryId, CategorySort';
	} else if ('3' == $productCategory) {
		$productCategoryTableName = "ProductCategory3";
		$orderBy = ' order by ParentCategoryId, CategorySort';
	} 
} 

$query_productCategory = $query_productCategory." ".$productCategoryTableName." ProductCategory1 WHERE 1=1";	
$recProductCategory = mysql_query($query_productCategory);
$query_productCategory = $query_productCategory.$orderBy;
//delete
if (isset($_POST["delete"])) {
	$categoryId = $_POST["categoryId"];
	$productCategory = $_POST["ProductCategory"];
	$deleteSql = "delete from $productCategoryTableName where id = '$categoryId'";
	//echo $deleteSql;
	mysql_query($deleteSql);	
	header("Location: productCategory.php?ProductCategory=$productCategory");
}


//預設每頁筆數
$pageRow_records = 20;
//總筆數
$total_records = mysql_num_rows($recProductCategory);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
//echo $query_productCategory.' LIMIT '.$start.', '.$pageRow_records;
$recProductCategory = mysql_query($query_productCategory.' LIMIT '.$start.', '.$pageRow_records);

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
            $(".detail").colorbox({ iframe: true, width: "50%", height: "30%", overlayClose: false, escKey: false });
            $(".add").colorbox({ iframe: true, width: "50%", height: "30%", overlayClose: false, escKey: false, href: "productCategoryDetail.php?ProductCategory=<? echo $productCategory; ?>"});
			$("input[type=submit], button" ).button();
        }
		
    </script>
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
                            
							<form action="productCategory.php" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
								<div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
									商品分類：
								</div>
								<div style="float: left; padding-right: 20px;padding-top: 3px;">
									<select name="ProductCategory" id="ProductCategory" style="width: 120%;" class="dropdownlist">
										<option value="1" <? if (isset($productCategory) && $productCategory == "1") { echo "selected='selected'";} else {echo "selected='selected'";} ?> >大分類</option>
										<option value="2" <? if (isset($productCategory) && $productCategory == "2") { echo "selected='selected'";} ?> >中分類</option>
										<option value="3" <? if (isset($productCategory) && $productCategory == "3") { echo "selected='selected'";} ?> >小分類</option>
									</select>
								</div>
								<div style="float: left; padding-right: 10px;padding-top: 3px;">
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
                                            <th scope="col" style="width: 25%;">
                                                排序
                                            </th>
                                            <th scope="col" style="width: 25%;">
                                                分類
                                            </th>
                                            <th scope="col" style="width: 25%;">
                                                分類名稱
                                            </th>
											<th scope="col" style="width: 25%;" colspan="2">
                                                功能
                                            </th>
                                        </tr>
                                        <? while($row=mysql_fetch_assoc($recProductCategory)){ ?>
										<tr>
                                            <td align="center">
                                                <? echo $row["CategorySort"]; ?>
                                            </td>
                                            <td align="center">
												<? 
													if ("ProductCategory2" == $productCategoryTableName) { 
														echo "中分類";
													} else if ("ProductCategory3" == $productCategoryTableName) { 
														echo "小分類";
													} else {
														echo "大分類";
													} 
												 ?> 
                                            </td>
											 <td align="center">
												 <? echo $row["CategoryName"]; ?>
                                            </td>
                                            <td align="center">
												<? 
													$parentCategoryId;
													if ("ProductCategory2" == $productCategoryTableName) { 
														$parentCategoryId = $row["ParentCategoryId"];
													} else if ("ProductCategory3" == $productCategoryTableName) { 
														$parentCategoryId = $row["ParentCategoryId"];
													} else {
														$parentCategoryId = null;
													} 
												 ?> 
                                                <a id="gvGridView_ctl02_hlContents" class="detail" href="productCategoryDetail.php?categoryId=<? echo $row["id"]; ?>&ProductCategory=<? echo $productCategory; ?>&parentCategoryId=<? echo $parentCategoryId; ?>">
                                                    內容設定
												</a>
                                            </td>
											<td align="center">
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
													<input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) return false;"/>
													<input name="categoryId" type="hidden" value="<? echo $row["id"]; ?>"/>
													<input name="ProductCategory" type="hidden" value="<? echo $productCategory; ?>"/>
													<input name="action" type="hidden" value="delete"/>
												</form>
                                            </td>
                                        </tr>
										<? } ?>
                                    </table>
                                    <br/>
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
											<a href="productCategory.php?page=1&ProductCategory=<? echo $productCategory; ?>">最前頁｜</a>
                                        </td>
                                        <?	
											$prePage = $page-1;
											if ($prePage < 1) {
												$prePage = 1;
											}
										?>
										<td>
											<a href="productCategory.php?page=<?echo $prePage?>&ProductCategory=<? echo $productCategory; ?>">上頁｜</a>
                                        </td>
										<?	
											$nextPage = $page+1;
											if ($nextPage > $total_pages) {
												$nextPage = $total_pages;
											}
										?>
                                        <td>
											<a href="productCategory.php?page=<?echo $nextPage?>&ProductCategory=<? echo $productCategory; ?>">下頁｜</a>
                                        </td>
                                        <td>
											<a href="productCategory.php?page=<?echo $total_pages?>&ProductCategory=<? echo $productCategory; ?>">最後頁</a>
                                        </td>
                                        <td>
                                            ｜<span id="PageControl1_labPage">頁數</span>： <span id="PageControl1_lblCurrentPage">
                                                <?echo $page?></span>/<span id="PageControl1_lblTotalPage"><?echo $total_pages?></span>
                                        </td>
                                        <!--<td>
                                            ｜<span id="PageControl1_labJump">轉至</span>
                                            <select name="PageControl1$ddlPages" onchange="javascript:setTimeout(&#39;__doPostBack(\&#39;PageControl1$ddlPages\&#39;,\&#39;\&#39;)&#39;, 0)"
                                                id="PageControl1_ddlPages" class="dropdownlist">
                                                <? for($i=1 ; $i<=$total_pages ; $i++){ ?>
												<option  value="<?echo $i?>"><?echo $i?></option>
												<? } ?>	
                                            </select>
                                        </td>-->
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
