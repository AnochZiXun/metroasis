<?php
session_start();
include_once('_connMysql.php');
$sql_query_activityNight = "SELECT ActivityNightID AS ActivityID, Batch, ActivityName, StartDate, EndDate, Status, Likes, 1 AS Category, CONCAT(ImagePath, ImageFileName) AS ListPicture FROM ActivityNight JOIN ImagesFiles ON ImageFunction = 'activityNight' AND ForeignID = ActivityNightID AND ImageType = 'promotePicture' WHERE Visibility = '1'";
$sql_query_activityClass = "SELECT ActivityClassID AS ActivityID, Batch, ActivityName, ActivityDate AS StartDate, ActivityDate AS EndDate, Status, Likes, 2 AS Category, CONCAT(ImagePath, ImageFileName) AS ListPicture FROM ActivityClass JOIN ImagesFiles ON ImageFunction = 'activityClass' AND ForeignID = ActivityClassID AND ImageType = 'promotePicture' WHERE Visibility = '1'";
$status = $_GET["status"];
$category = $_GET["selectCategory"];
if ($status != "") {
  $sql_query_activityNight .= "AND Status = '$status' ";
  $sql_query_activityClass .= "AND Status = '$status' ";
}
switch($category){
  case "1":
    $sql_queryActivity = $sql_query_activityNight." ORDER BY StartDate DESC";
    break;
  case "2":
    $sql_queryActivity = $sql_query_activityClass." ORDER BY StartDate DESC";
    break;
  default:
    $sql_queryActivity = $sql_query_activityNight." UNION ".$sql_query_activityClass." ORDER BY StartDate DESC";
    break;
}
//echo $sql_queryActivity;
$RecActivitys = mysql_query($sql_queryActivity);
//預設每頁筆數
$pageRow_records = 12;
//總筆數
$total_records = mysql_num_rows($RecActivitys);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
//echo $query_activitys.' LIMIT '.$start.', '.$pageRow_records;
$RecActivitys = mysql_query($sql_queryActivity.' LIMIT '.$start.', '.$pageRow_records);
function getChineseWeekday($datetime) {
    $weekday = date('w', strtotime($datetime));
    return ['日', '一', '二', '三', '四', '五', '六'][$weekday];
}

$alert = $_GET["alert"];
if($alert == "YouAreTooLate"){
  echo "<script>alert('報名已額滿!');</script>";
}

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
    <style>
      #hr { 
          margin: 10px 0;
          border-bottom-style: solid;
          border-color: #d9d9d9;
          border-width: 2px;
      } 
      .enrollBTN {
        float: right;
        margin-top: 12px;
        margin-right: 5px;
      }
      .enrollBTN button {
        width: 75px;
        height: 30px;
        text-align: center;
        padding: 0px;
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
                  <li class="breadcrumb-item active">活動報名</li>
                </ol>
                <!-- 標題 -->
                <form name="form1" method="get" action="activity.php" id="form1">
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 活動報名
                    <div class="FloatR"><i class="fa fa-bell" aria-hidden="true"></i> 狀態：
                        <?
                          $findStatus = "SELECT * FROM RefCommon WHERE Type = 'activityStatus' ORDER BY SortNo";
                          $recStatus = mysql_query($findStatus);
                        ?>
                        <select name="status" class="custom-select" onchange="this.form.submit();">
                        <option value="">全部</option>
                        <? while($rowStatus = mysql_fetch_assoc($recStatus)){ echo $rowStatus["TypeCode"];echo $status;?>
                          <?if ($rowStatus["TypeCode"] == $status) { ?>
                            <option value="<? echo $rowStatus["TypeCode"] ?>" selected><?echo $rowStatus["CodeName"] ?></option>
                          <? } else {?>
                            <option value="<? echo $rowStatus["TypeCode"] ?>"><?echo $rowStatus["CodeName"] ?></option>
                          <? } ?>
                        <? } ?>
                        </select>
                        &nbsp;&nbsp;
                        <i class="fa fa-leaf" aria-hidden="true"></i> 類型：
                          <?
                            $findCategory = "SELECT * FROM RefCommon WHERE Type = 'activityCategory' ORDER BY SortNo";
                            $recCategory = mysql_query($findCategory);
                          ?>
                        <select name="selectCategory" class="custom-select" onchange="this.form.submit();">
                          <? while($rowCategory = mysql_fetch_assoc($recCategory)){ ?>
                            <?if ($rowCategory["TypeCode"] == $category) { ?>
                              <option value="<? echo $rowCategory["TypeCode"] ?>" selected><?echo $rowCategory["CodeName"] ?></option>
                            <? } else {?>
                              <option value="<? echo $rowCategory["TypeCode"] ?>"><?echo $rowCategory["CodeName"] ?></option>
                            <? } ?>
                          <? } ?>
                        </select>
                    </div>
                </div>
                </form>
                <!-- 內容開始 -->
                <div class="frameBOX">
                    <? $count=0;while($row=mysql_fetch_assoc($RecActivitys)){ $count++;?>
                    <div class="col-lg-4 col-sm-12 activityPageList">
                      <div>
                        <a class="enrollImg" href="activity_detail.php?activityId=<? echo $row["ActivityID"] ?>&category=<? echo $row["Category"]  ?>&status=<? echo $row["Status"] ?>&selectCategory=<? echo $category ?>">
                          <object data="<? echo $row["ListPicture"] ?>" type="image/png" class="img-responsive" style="width: 400px; height: 250px;">
                            <img src="images/no_image.jpg" class="img-responsive">
                          </object>
                        </a>
                          <?
                              $sql = "SELECT CodeName FROM RefCommon R WHERE Type = 'activityCategory' AND TypeCode=".$row["Category"];
                              $record = mysql_query($sql);
                              $result = mysql_fetch_assoc($record);
                          ?>
                        <p class="textA"><? echo $result["CodeName"]?></p>
                        <div style="margin-left: 5px;">
                          <a href="activity_detail.php?activityId=<? echo $row["ActivityID"] ?>&category=<? echo $row["Category"] ?>&status=<? echo $status ?>&selectCategory=<? echo $category ?>"><p class="textB"><? echo$row["ActivityName"]?></p></a>
                          <p class="textC"><i class="fa fa-calendar" aria-hidden="true"></i> <? echo date("Y-m-d(", strtotime($row["StartDate"])).getChineseWeekday($row["StartDate"]).') ~ '.date("Y-m-d(", strtotime($row["EndDate"])).getChineseWeekday($row["EndDate"]).')'; ?></p>
                        </div>
                       </div>
                       <div class="btns">
                        <div class="loveBTN" activityId="<? echo $row["ActivityID"]?>" category="<? echo $row["Category"] ?>">
                          <a>
                            <div class="btn-sm btn-secondary fa-stack" style="line-height: 19px; float: left;">
                              <i class="fa fa-heart-o fa-stack-1x"></i>
                            </div>
                            <div style="margin-top: 3px; margin-right: 4px; float: right;"><font><i><? echo $row["Likes"]?></i> 人喜歡</font></div>
                          </a> 
                        </div>
                        <div class="enrollBTN">
                          <? if('1' == $row["Status"]) { ?>
                            <a href="activity_detail.php?activityId=<? echo $row["ActivityID"] ?>&category=<? echo $row["Category"] ?>&status=<? echo $status ?>&selectCategory=<? echo $category ?>"><button type="button" class="btn btn-success btn-lg">活動詳情</button></a>
                          <? } else {?>
                            <button type="button" class="btn btn-lg" disabled>活動詳情</button>
                          <? }?>
                        </div>
                        </div>
                    </div>
                    <?
                      if($count % 3 == 0) {
                        //echo '<div class="col-lg-12" id="hr"></div>';
                      }
                    ?>
                    <? $start++;}?>
                  </div>
                    <div class="pageBOX">
                      <ul class="pagination">
                        <li><a href="activity.php?page=1<? echo '&status='.$status.'&category='.$category ?>"><span aria-hidden="true">&laquo;</span></a></li>
                        <? for ($i=0; $i<$total_pages; $i++) {?>
                          <? if (Empty($_GET["page"]) && $i == 0 || $_GET["page"] == $i+1) {?>
                            <li class="active"><a href="activity.php?page=<? echo $i+1?><? echo '&status='.$status.'&category='.$category ?>"><? echo $i+1 ?></a></li>
                          <? } else { ?>
                            <li><a href="activity.php?page=<? echo $i+1?><? echo '&status='.$status.'&category='.$category ?>"><? echo $i+1 ?></a></li>
                          <? } ?>
                        <? } ?>
                        <li><a href="activity.php?page=<? echo $total_pages.'&status='.$status.'&category='.$category ?>"><span aria-hidden="true">&raquo;</span></a></li>
                      </ul>
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
        $('.enrollImg').click(function() {
            location.href=$(this).attr('href');
        });
        $('.loveBTN').click(function() {
            var activityId = $(this).attr('activityId');
            var category = $(this).attr('category');
            var $loveBtn = $(this);
            $loveBtn.off('click');
            $.ajax({
                method: 'POST',
                url: 'likeActivity.php',
                data: {activityId: activityId, category: category},
            }).done(function(result) {
                if(result == 'login') {
                  location.href = 'login.php';
                } else {
                  $loveBtn.find('font i').text(result);
                }
            });
        });
    </script>
</body>
</html>