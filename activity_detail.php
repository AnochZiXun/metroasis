<?php
session_start();
include_once('_connMysql.php');
//檢查是否經過登入
if(!isset($_SESSION["CustomerID"])){
header('location: login.php');
}
$customerId = $_SESSION["CustomerID"];


$activityId = $_GET["activityId"];
$status = $_GET["status"];
$category = $_GET["category"];
$selectCategory = $_GET["selectCategory"];

switch($category){
  case "1":
    $query_activity = "SELECT *, CONCAT(ImagePath, ImageFileName) AS PromotePicture FROM ActivityNight JOIN ImagesFiles ON ImageFunction = 'activityNight' AND ForeignID = ActivityNightID AND ImageType = 'promotePicture' WHERE ActivityNightID = '$activityId' ";
    break;
  case "2":
    $query_activity = "SELECT *, CONCAT(ImagePath, ImageFileName) AS PromotePicture FROM ActivityClass JOIN ImagesFiles ON ImageFunction = 'activityClass' AND ForeignID = ActivityClassID AND ImageType = 'promotePicture' WHERE ActivityClassID = '$activityId' ";
    break;
  default:
    header("Location: activity.php");
    break;
}

$recActivity = mysql_query($query_activity);
$row = mysql_fetch_assoc($recActivity);

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
    <style type="text/css">
        td{
            text-align: left;
        }
    </style>
</head>
<body>
<?php include_once("_include/_head.php"); ?>
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
                    <?
                    switch($category){
                        case "1":
                            include_once("_include/_activity_detail_night.php");
                            break;
                        case "2":
                            include_once("_include/_activity_detail_class.php");
                            break;
                        default:
                            echo "系統資料維護中...";
                            break;
                    }
                    ?>
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