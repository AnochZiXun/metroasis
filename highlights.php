<?php
include('_connMysql.php');
//include('check_login.php');

$query_Activityhighlight = "SELECT A.*,I.ImageFile FROM `Activityhighlight` A LEFT JOIN (SELECT concat(ImagePath,ImageFileName) as ImageFile,ForeignID FROM ImagesFiles WHERE ImageFunction = 'activityhighlight' AND ImageType ='detail') I ON A.ActivityhighlightID = I.ForeignID WHERE State=1 AND StartDate <= sysdate() AND IFNULL(EndDate,STR_TO_DATE('9999/12/31', '%Y/%m/%d')) >= sysdate()";

if (isset($_GET["Category"]) && $_GET["Category"] != 0){ 
	$Category = $_GET["Category"];	
	$query_Activityhighlight = $query_Activityhighlight.' and Category = '.$Category;	
}
//echo $query_Activityhighlight;
$RecActivityhighlight = mysql_query($query_Activityhighlight);


//預設每頁筆數
$pageRow_records = 8;
//總筆數
$total_records = mysql_num_rows($RecActivityhighlight);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
//echo $query_Activityhighlight.' LIMIT '.$start.', '.$pageRow_records;
$RecActivityhighlight = mysql_query($query_Activityhighlight.' LIMIT '.$start.', '.$pageRow_records);
?>
<!DOCTYPE html>
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
                  <li class="breadcrumb-item"><a href="highlights.php?page=1&Category=1">活動消息</a></li>
                  <li class="breadcrumb-item active">活動花絮</li>
                </ol>
                 <!-- 標題 -->
                <form action="" method="GET" enctype="multipart/form-data" id="startSearch" name="startSearch">
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 活動花絮
                    <div class="FloatR"><i class="fa fa-leaf" aria-hidden="true"></i> 類型：
                        <?
							$findCategory = "SELECT * FROM RefCommon WHERE Type = 'activityhighlight' ORDER BY SortNo";
							$recCategory = mysql_query($findCategory);
						?>
						<select class="custom-select" name="Category" id="Category" onChange="formSubmit()">
                          <? while($rowCategory = mysql_fetch_assoc($recCategory)){ ?>
							<?if ($rowCategory["TypeCode"] == $_GET["Category"]) { ?>
								<option value="<? echo $rowCategory["TypeCode"] ?>" id="<? echo $rowCategory["TypeCode"] ?>" selected><?echo $rowCategory["CodeName"] ?></option>
							<? } else {?>
								<option value="<? echo $rowCategory["TypeCode"] ?>" id="<? echo $rowCategory["TypeCode"] ?>"><?echo $rowCategory["CodeName"] ?></option>
							<? } ?>
						  <? } ?>
                        </select>
                    </div>
                </div>
				<input type="hidden" name="page" id="page" value="1"/>
				</form>
                <!-- 內容開始 -->
                <div class="frameBOX">
                    <? while($row=mysql_fetch_assoc($RecActivityhighlight)){ ?>
					<div class="newsPageList row">
                        <div class="col-lg-4 col-sm-6">
                           <img src="<? echo $row["ImageFile"];?>" class="img-responsive">
                        </div>
                        <div class="col-lg-8 col-sm-6">
						<?
							$findCategoryName = "SELECT * FROM RefCommon WHERE Type = 'activityhighlight' AND TypeCode = ".$row["Category"];
							$RecCategoryName = mysql_query($findCategoryName);
							$ResCategoryName = mysql_fetch_assoc($RecCategoryName);
						?>
                           <p class="textA"><? echo $ResCategoryName["CodeName"]; ?></p><br><br>
                           <p class="textB"><? echo $row["ShortTitle"]; ?></p>
                           <p class="textC"><i class="fa fa-calendar" aria-hidden="true"></i> 日期：<? echo $row["ActivityDate"]; ?></p>
                           <p class="textD"><? echo $row["ShortContent"]; ?></p>
                           <a href="highlights_detail.php?ActivityhighlightID=<? echo $row["ActivityhighlightID"];?>&Category=<? echo $row["Category"];?>"><button type="button" class="btn btn-success btn-lg" style="margin-top: 5px;">詳情內容</button></a>
                        </div>
                    </div>
					<? } ?>
					
                    <div class="pageBOX">
                      <ul class="pagination">
                        <li><a href="highlights.php?page=1&Category=<? echo $_GET["Category"] ?>"><span aria-hidden="true">&laquo;</span></a></li>
                        <? for ($i=0; $i<$total_pages; $i++) {?>
							<? if ($_GET["page"] == $i+1) {?>
								<li class="active"><a href="highlights.php?page=<?echo $i+1 ?>&Category=<? echo $_GET["Category"] ?>"><? echo $i+1 ?></a></li>
							<? } else { ?>
								<li><a href="highlights.php?page=<?echo $i+1 ?>&Category=<? echo $_GET["Category"] ?>"><? echo $i+1 ?></a></li>
							<? } ?>
						<? } ?>
                        <li><a href="highlights.php?page=<? echo $total_pages?>&Category=<? echo $_GET["Category"] ?>"><span aria-hidden="true">&raquo;</span></a></li>
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
		
		function formSubmit() {
			document.getElementById("startSearch").submit()
		}
    </script>
</body>
</html>