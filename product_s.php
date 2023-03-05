<!DOCTYPE html>
<?
session_start();
include('_connMysql.php');

$query_product_sql = 'SELECT Products.*,substr(ListProductName,1,17) as ListProductName,format(StockNumber,0) as StockNumber,format(SafetyNumber,0) as SafetyNumber,format(OnStoreNumber,0) as OnStoreNumber,format(ListPrice,0) as ListPrice FROM';
$productTableName = ' Products';
$query_product_sql = "$query_product_sql $productTableName WHERE 1 "
                        ."AND ProductName IS NOT NULL "
                        ."AND unix_timestamp(NOW()) >= unix_timestamp(StartDate) "
                        ."AND unix_timestamp(NOW()) <= unix_timestamp(EndDate) ";

if(isset($_POST["Search"]) || isset($_GET["Search"])) {
	$search = isset($_POST["Search"]) ? trim($_POST["Search"]) : trim($_GET["Search"]);
	//echo $search."</br>";
	$query_product_sql = $query_product_sql." AND `ProductName` like '%$search%' ";
}
if(isset($_GET["ProductCategoryID"])) {
	$productCategoryID = $_GET["ProductCategoryID"];
	$productCategory3 = getCategory('ProductCategory3', $productCategoryID);
	$productCategory2 = getCategory('ProductCategory2', $productCategory3['ParentCategoryId']);
	$productCategory1 = getCategory('ProductCategory1', $productCategory2['ParentCategoryId']);
	$_SESSION["ProductCategory1ID"] = $productCategory1["id"];
	$_SESSION["ProductCategory2ID"] = $productCategory2["id"];
}
if($productCategoryID) {
	$query_product_sql = $query_product_sql." AND ProductCategoryID=$productCategoryID";
}

// TODO startDate endDate
if(isset($_GET["SortType"])) {
	$sortType = $_GET["SortType"];
} else {
	$sortType = '1';
}

if('1' == $sortType) {
	$sortColumn = ' StartDate desc';
} else if('2' == $sortType) {
	$sortColumn = '	UnitPrice';
} else if('3' == $sortType) {
	$sortColumn = ' UnitPrice desc';
} else if('4' == $sortType) {
	// TODO 購買人次高至低
	$sortColumn = ' StartDate desc';
} else if('5' == $sortType) {
	// TODO 評價高至低
	$sortColumn = ' StartDate desc';
}

$orderBy = " order by $sortColumn";
$recProducts = mysql_query($query_product_sql);
$query_product_sql = $query_product_sql.$orderBy;

//預設每頁筆數
$pageRow_records = 8;
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
//echo $query_product_sql;
$recProducts = mysql_query($query_product_sql.' LIMIT '.$start.', '.$pageRow_records);
$empty_records = $total_records%4;


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
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title>城市綠洲戶外生活館</title>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Dropdown Hover CSS -->
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap-dropdownhover.min.css" rel="stylesheet">    
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/slides.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/style_forBS.css" rel="stylesheet">
    <!--bootstrap-->
    <link href="css/style_forDIY.css" rel="stylesheet">
    <!--bootstrap-->
    <link rel="stylesheet" media="screen,projection" href="css/ui.totop.css" />
    <link href="css/flexslider.css" type="text/css" rel="stylesheet" />
    <script src="js/menu.js"></script>
    <!-- menu下拉 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="js/flycan.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <!-- Bootstrap Dropdown Hover JS -->
    <script src="js/bootstrap-dropdownhover.min.js"></script>
    <style>
        .span1{
            color: #d33f3f;
            font-size: 18px;
            font-weight: bold;
            line-height: 24px;
            float: right;
            position: relative;
            padding: 0px 10px 0px 0px;
        }
        .span2 {    
            color: #8f8f8f;
            font-size: 13px;
            line-height: 24px;
            float: right;
            position: relative;
            padding: 0px 2px 0px 0px;
            text-decoration: line-through;
        }
    </style>

</head>
<body>
<?php include("_include/_head.php"); ?>
    <!-- 上方選單end -->
    <div id="CONTENT-2">
        <!-- 第一塊大的區塊 -->
        <div class="row">
            <!-- 左欄區塊 -->
            <div class="row leftBOX">
                <!-- 產品menu -->
                <?php include("_include/_productList.php"); ?>
                <!-- 折扣活動 -->
                <?php include("_include/_sale.php"); ?>
            </div>
            <!-- 右欄區塊 -->
            <div class="row rightBOX">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item"><?echo $search?></li>                
                </ol>
                <!-- 標題 -->
				<form name="form1" method="get" action="product_s.php" id="form1">
				<input type="hidden" name="ProductCategoryID" value="<?echo $productCategoryID?>" />
				<input type="hidden" name="SortType" value="<?echo $sortType?>" />
				<input type="hidden" name="Search" value="<?echo $search?>" />
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> <?echo $productCategory3["CategoryName"]?>
                    <div class="FloatR"><i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-arrows-v" aria-hidden="true"></i> 排序：
                        <select name="SortType" class="custom-select" onchange="this.form.submit();">
                          <option <?if('1'==$sortType){?>selected<?}?> value="1">最新上架</option>
                          <option <?if('2'==$sortType){?>selected<?}?> value="2">價格低到高</option>
                          <option <?if('3'==$sortType){?>selected<?}?> value="3">價格高到低</option>
                          <!--<option value="4">購買人次高至低</option>
                          <option value="5">評價高至低</option>-->
                        </select>
                    </div>
                </div>
				</form>
                <!-- 內容開始 -->
                <div class="frameBOX">
				<? while($row=mysql_fetch_assoc($recProducts)){ ?>
                    <div class="col-lg-12 col-xs-6 ex01">
                        <a href="product_detail.php<?echo '?ProductID='.$row["ProductID"].'&ProductCategoryID='.$productCategoryID.'&SortType='.$sortType?>" title="<?echo $row["ProductName"];?>">
                            <?php 
                                    $query_ImagesFIles = "SELECT ImagePath , ImageFileName FROM `ImagesFiles` WHERE ForeignID = '" . $row["ProductID"] . "' AND ImageFunction = 'products' AND ImageType = 'detail' ORDER BY ImageFileName LIMIT 1";
                                    $RecImages = mysql_query($query_ImagesFIles);
                                    $row_Images=mysql_fetch_assoc($RecImages)
                            ?>
                            <img src="<?php echo $row_Images["ImagePath"] . $row_Images["ImageFileName"]?>" class="img-responsive">

                            <p style="font-size: 15px; margin-top: 0px; line-height: 25px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?echo $row["ProductName"];?></p>
                        </a>
                        
                        <span class="span1">$<?echo $row["UnitPrice"];?></span><span class="span2">$<?echo $row["ListPrice"];?></span>
                        
                    </div>
				<?}?>
                    <div class="pageBOX">
                      <ul class="pagination">
                        <li><a href="product_s.php?page=1<?echo '&Search='.$search.'&ProductCategoryID='.$productCategoryID.'&SortType='.$sortType?>"><span aria-hidden="true">&laquo;</span></a></li>
                        <? for ($i=0; $i<$total_pages; $i++) {?>
                          <? if ($_GET["page"] == $i+1) {?>
                            <li class="active"><a href="product_s.php?page=<? echo $i+1?><?echo '&Search='.$search.'&ProductCategoryID='.$productCategoryID.'&SortType='.$sortType?>"><? echo $i+1 ?></a></li>
                          <? } else { ?>
                            <li><a href="product_s.php?page=<? echo $i+1?><?echo '&Search='.$search.'&ProductCategoryID='.$productCategoryID.'&SortType='.$sortType?>"><? echo $i+1 ?></a></li>
                          <? } ?>
                        <? } ?>
                        <li><a href="product_s.php?page=<? echo $total_pages==0?1:$total_pages;?><?echo '&Search='.$search.'&ProductCategoryID='.$productCategoryID.'&SortType='.$sortType?>"><span aria-hidden="true">&raquo;</span></a></li>
                      </ul>
                    </div>
                  </div>
            </div>
        </div>
    </div>
 <?php include("_include/_footer.php"); ?>
    <!-- easing plugin ( optional ) -->
    <script src="js-top/easing.js" type="text/javascript"></script>
    <!-- UItoTop plugin -->
    <script src="js-top/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- Starting the plugin -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */
            
            $().UItoTop({ easingType: 'easeOutQuart' });
            
        });
    </script>
</body>
</html>