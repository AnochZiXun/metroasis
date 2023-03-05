<?php
session_start();
include('_connMysql.php');

$query_activitys = 'SELECT * FROM Activitys WHERE 1=1 ';
if (!Empty($_GET["status"])) {
	$status = $_GET["status"];
    $query_activitys .= "AND Status = '$status' ";
} 

if (!Empty($_GET["category"])) {
	$category = $_GET["category"];
    $query_activitys .= "AND Category = '$category' ";
} 

if (!Empty($_GET["rowNo"]) || $_GET["rowNo"] == 0) {
	$rowNo = $_GET["rowNo"];
} else {
    header("Location: activity.php?page=1&status=$status&category=$category");
}

$query_activitys.= " ORDER BY ActivityDateS DESC";
$RecActivitys = mysql_query($query_activitys);
$count = mysql_num_rows($RecActivitys);
if ($rowNo == $count) {
    header("Location: activity.php?page=1&status=$status&category=$category");
}

$RecActivitys = mysql_query($query_activitys.' LIMIT '.$rowNo.', 1');
$currentRow=mysql_fetch_assoc($RecActivitys);

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
                  <li class="breadcrumb-item"><a href="activity.php">活動報名</a></li>
                  <li class="breadcrumb-item active">活動介紹</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 活動介紹
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
                  <div class="activityDetailBOX">
                    <object data="<? echo $currentRow['ContentBanner']?>" type="image/png" class="img-responsive">
                        <img src="images/no_image.jpg" class="img-responsive">
                    </object>
                    <h2><? echo $currentRow['ContentSbuject']?></h2>
                    <?
                        $sql = "SELECT R.CodeName FROM Activitys A LEFT JOIN RefCommon R ON A.Category = R.TypeCode 
                                AND R.Type = 'activityCategory' AND A.ActivityID=".$currentRow['ActivityID'];
                        $record = mysql_query($sql);
                        $result = mysql_fetch_assoc($record);
                    ?>
                    <p style="width:106px; height:22px; line-height: 22px; background-color: #ff8c3f; border-radius:5px; font-size: 11px; color: #fff; margin: 10px 0; text-align: center;">
                        <? echo $result["CodeName"]?>
                    </p>
                    <p><i class="fa fa-clock-o" aria-hidden="true" style="margin: 0 5px 0 0;"></i><span>活動時間：</span><? echo date("Y-m-d", strtotime($currentRow["ActivityDateS"])).' ~ '.date("Y-m-d", strtotime($currentRow["ActivityDateE"])); ?></p>
                    <p><i class="fa fa-map-marker" aria-hidden="true" style="margin: 0 7px 0 2px;"></i><span>活動地點：</span><? echo $currentRow['ActivityPlace']?></p>
                    <p><i class="fa fa-map-marker" aria-hidden="true" style="margin: 0 7px 0 2px;"></i><span>活動地址：</span><? echo $currentRow['ActivityAddress']?></p>
                    <hr>
                    <p><span><i class="fa fa-star" aria-hidden="true"></i> 活動主旨</span></p>
                    <p><? echo $currentRow['ActivitySubject']?></p>
                    <br><br>
                    <p><span><i class="fa fa-star" aria-hidden="true"></i> 活動說明</span></p>
                      <? echo $currentRow['ActivityDescription']?>
                    <p><span><i class="fa fa-star" aria-hidden="true"></i> 注意事項</span></p>
                      <? echo $currentRow['ActivityInformation']?>
                    <p><span><i class="fa fa-star" aria-hidden="true"></i> 參加辦法</span></p>
                      <? echo $currentRow['JoinWay']?>
                    <p><span><i class="fa fa-star" aria-hidden="true"></i> 匯款資料</span></p>
                      <? echo $currentRow['BankInfomation']?>
                    <p><span><i class="fa fa-star" aria-hidden="true"></i> 缺席退費</span></p>
                      <? echo $currentRow['AbsentRefund']?>
                  </div>
                    <div style="margin:10px auto;">
                      <ul class="pagination">
                        <? if(($rowNo-1) >= 0) {?>
                            <li><a href="activity_detail.php?rowNo=<? echo ($rowNo-1).'&status='.$status.'&category='.$category?>"><span aria-hidden="true">&laquo; 上一則</span></a></li>
                        <? }?>
                        <li class="active"><a href="activity.php?page=1<? echo '&status='.$status.'&category='.$category?>">回活動報名</a></li>
                        <? if(($rowNo+1) < $count) {?>
                            <li><a href="activity_detail.php?rowNo=<? echo ($rowNo+1).'&status='.$status.'&category='.$category?>"><span aria-hidden="true">下一則 &raquo;</span></a></li>
                        <? }?>
                      </ul>
                       <a href="registration.php?activityId=<? echo $currentRow['ActivityID']?>"><button style="float: right; width: 30%; margin: 20px 0; padding: 10px 30px; font-size: 16px;" type="button" class="btn btn-success btn-lg">我要報名</button></a>
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