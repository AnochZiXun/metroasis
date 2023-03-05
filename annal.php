<?php
  session_start();
  include_once("_connMysql.php");
  //檢查是否經過登入
  if(!isset($_SESSION["CustomerID"])){
    header('location: login.php');
  }
  $customerId = $_SESSION["CustomerID"];

  $sql_query_activityNight = "SELECT AE.*, A.Batch, A.StartDate AS ActivityDateS, A.EndDate AS ActivityDateE, A.ActivityName, A.Status, (SELECT CodeName FROM RefCommon WHERE Type = 'activityStatus' AND TypeCode = A.Status) AS StatusDesc, (SELECT CodeName FROM RefCommon WHERE Type = 'enrollStatus' AND TypeCode = AE.EnrollStatus) AS EnrollStatusDesc, (SELECT CodeName FROM RefCommon WHERE Type = 'actQualification' AND TypeCode = AE.Qualification) AS QualificationDesc, A.CreateDate AS ActivityCreateDate, (SELECT CodeName FROM RefCommon WHERE Type = 'activityCategory' AND TypeCode = AE.ActType) AS ActTypeName FROM ActivityNight A JOIN ActivityEnrollment AE ON A.ActivityNightID = AE.ActivityID WHERE AE.CustomerID = '$customerId'";

  $sql_query_activityClass = "SELECT AE.*, A.Batch, A.ActivityDate AS ActivityDateS, A.ActivityDate AS ActivityDateE, A.ActivityName, A.Status, (SELECT CodeName FROM RefCommon WHERE Type = 'activityStatus' AND TypeCode = A.Status) AS StatusDesc, (SELECT CodeName FROM RefCommon WHERE Type = 'enrollStatus' AND TypeCode = AE.EnrollStatus) AS EnrollStatusDesc, (SELECT CodeName FROM RefCommon WHERE Type = 'actQualification' AND TypeCode = AE.Qualification) AS QualificationDesc, A.CreateDate AS ActivityCreateDate, (SELECT CodeName FROM RefCommon WHERE Type = 'activityCategory' AND TypeCode = AE.ActType) AS ActTypeName FROM ActivityClass A JOIN ActivityEnrollment AE ON A.ActivityClassID = AE.ActivityID WHERE AE.CustomerID = '$customerId'";

  if (!Empty($_GET["searchText"])) {
    $searchText = $_GET["searchText"];
    $sql_query_activityNight .= " AND A.ActivityName like '%$searchText%' ";
    $sql_query_activityClass .= " AND A.ActivityName like '%$searchText%' ";
  } 
  if (!Empty($_GET["status"])) {
    $status = $_GET["status"];
    $sql_query_activityNight .= " AND A.Status = '$status' ";
    $sql_query_activityClass .= " AND A.Status = '$status' ";
  }
  
  if (!Empty($_GET["enrollStatus"]) || '0' == $_GET["enrollStatus"]) {
    $enrollStatus = $_GET["enrollStatus"];
    $sql_query_activityNight .= " AND AE.EnrollStatus = '$enrollStatus' ";
    $sql_query_activityClass .= " AND AE.EnrollStatus = '$enrollStatus' ";
  } 
  if (!Empty($_GET["activityCategory"])) {
    $activityCategory = $_GET["activityCategory"];
  } 
  switch($activityCategory){
    case "1":
      $sql_queryActivity = $sql_query_activityNight;
      break;
    case "2":
      $sql_queryActivity = $sql_query_activityClass;
      break;
    default:
      $sql_queryActivity = $sql_query_activityNight." UNION ".$sql_query_activityClass;
      break;
  }
  $sql_queryActivity .= " ORDER BY ActivityCreateDate DESC";
  //echo $sql_queryActivity;
  $rec_activity = mysql_query($sql_queryActivity);
  //預設每頁筆數
  $pageRow_records = 10;
  //總筆數
  $total_records = mysql_num_rows($rec_activity);
  //計算總頁數=(總筆數/每頁筆數)後無條件進位。
  $total_pages = ceil($total_records/$pageRow_records); 
  if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
      $page=1; //則在此設定起始頁數
  } else {
      $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
  }
  $start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
  $rec_activity = mysql_query($sql_queryActivity.' LIMIT '.$start.', '.$pageRow_records);
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
<?php include_once("_include/_head.php"); ?>
    <!-- 上方選單end -->
    <div id="CONTENT-2">
        <!-- 第一塊大的區塊 -->
        <div class="row">
            <!-- 左欄區塊 -->
            <div class="row leftBOX">
                <!-- 產品menu -->
                <?php include_once("_include/_productList.php"); ?>
                <!-- 折扣活動 -->
                <?php include_once("_include/_sale.php"); ?>
            </div>
            <!-- 右欄區塊 -->
            <div class="row rightBOX">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item">會員中心</li>
                  <li class="breadcrumb-item active">我的報名</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 我的報名
                </div>
                <!-- 內容開始 -->
                <form action="annal.php" method="GET">
                <div class="frameBOX">
                  <div class="SEARCH">
                    活動類型：
                    <?
                      $findActivityCategory = "SELECT * FROM RefCommon WHERE Type = 'activityCategory' ORDER BY SortNo";
                      $recActivityCategory = mysql_query($findActivityCategory);
                    ?>
                    <select name="activityCategory" class="custom-select">
                    <? while($rowActivityCategory = mysql_fetch_assoc($recActivityCategory)){ ?>
                      <?if ($rowActivityCategory["TypeCode"] == $activityCategory) { ?>
                        <option value="<? echo $rowActivityCategory["TypeCode"] ?>" id="<? echo $rowActivityCategory["TypeCode"] ?>" selected><?echo $rowActivityCategory["CodeName"] ?></option>
                      <? } else {?>
                        <option value="<? echo $rowActivityCategory["TypeCode"] ?>" id="<? echo $rowActivityCategory["TypeCode"] ?>"><?echo $rowActivityCategory["CodeName"] ?></option>
                      <? } ?>
                    <? } ?>
                    </select>
                    &nbsp;
                    活動狀態：
                    <?
                      $findStatus = "SELECT * FROM RefCommon WHERE Type = 'activityStatus' ORDER BY SortNo";
                      $recStatus = mysql_query($findStatus);
                    ?>
                    <select name="status" class="custom-select">
                      <option value="">全部</option>
                    <? while($rowStatus = mysql_fetch_assoc($recStatus)){ ?>
                      <?if ($rowStatus["TypeCode"] == $status) { ?>
                        <option value="<? echo $rowStatus["TypeCode"] ?>" id="<? echo $rowStatus["TypeCode"] ?>" selected><?echo $rowStatus["CodeName"] ?></option>
                      <? } else {?>
                        <option value="<? echo $rowStatus["TypeCode"] ?>" id="<? echo $rowStatus["TypeCode"] ?>"><?echo $rowStatus["CodeName"] ?></option>
                      <? } ?>
                    <? } ?>
                    </select>
                    &nbsp;
                    報名狀態：
                    <?
                        $findEnrollStatus = "SELECT * FROM RefCommon WHERE Type = 'enrollStatus' ORDER BY SortNo";
                        $recEnrollStatus = mysql_query($findEnrollStatus);
                    ?>
                    <select name="enrollStatus" class="custom-select">
                      <option value="">全部</option>
                    <? while($rowEnrollment = mysql_fetch_assoc($recEnrollStatus)){ ?>
                        <?if ($rowEnrollment["TypeCode"] == $enrollStatus) { ?>
                            <option value="<? echo $rowEnrollment["TypeCode"] ?>" id="<? echo $rowEnrollment["TypeCode"] ?>" selected><?echo $rowEnrollment["CodeName"] ?></option>
                        <? } else {?>
                            <option value="<? echo $rowEnrollment["TypeCode"] ?>" id="<? echo $rowEnrollment["TypeCode"] ?>"><?echo $rowEnrollment["CodeName"] ?></option>
                        <? } ?>
                    <? } ?>
                    </select>
                    &nbsp;
                    活動名稱：<input type="text" name="searchText" value="<? echo $searchText?>" placeholder="輸入關鍵字">
                    
                    <input type="submit" class="btn btn-success btn-lg" value="搜尋" style="float: right; margin-top: 1em;"/>
                  </div>
                  </form>

                  <!--<div class="TABLE_BOX">-->
                  <div class="">
                    <table class="table table-hover">
                      <thead class="thead-info">
                        <tr class="secondary">
                          <th>#</th>
                          <th>梯次</th>
                          <th>活動類別</th>
                          <th>活動名稱</th>
                          <th>活動日期</th>
                          <th>活動費用</th>
                          <th>活動狀態</th>
                          <th>報名狀態</th>
                          <th>資格</th>
                          <th>功能</th>
                        </tr>
                      </thead>
                      <tbody>
                        <? while($row=mysql_fetch_assoc($rec_activity)){ ?>
                        <tr>
                          <th scope="row"><span><? echo ++$start;?></span></th>
                          <td><span><? echo $row['ActType']."-".$row['Batch']?></span></td>
                          <td><span><? echo $row['ActTypeName']?></span></td>
                          <td class="colorA"><? echo $row['ActivityName']?></td>
                          <td class="UB"><? echo date("Y-m-d", strtotime($row["ActivityDateS"])).'~'.date("Y-m-d", strtotime($row["ActivityDateE"])); ?></td>
                          <td class="colorB"><? echo $row['TotalAmount']?></td>
                          <td><span class="colorC"><? echo $row['StatusDesc']?></span></td>
                          <td><span class="colorD"><? echo $row['EnrollStatusDesc']?></span></td>
                          <td><span class="colorG"><? echo $row['QualificationDesc']?></span></td>
                          <td>
                            <? if($row['EnrollStatus'] == 0) { ?>
                              <i class="fa fa-pencil-square-o editBtn colorE" modelid="editModal_<? echo $start?>" aria-hidden="true" style="cursor: pointer;"></i>
                            <? } else { ?>
                              <i class="fa fa-pencil-square-o editBtn colorE" aria-hidden="true" onclick="window.location.replace('registration_e.php?enrollId='+<? echo $row['EnrollID']?>+'&actType='+<? echo $row['ActType']?>);" style="cursor: pointer;"></i>
                            <? } ?>
                            <? if($row['Qualification'] != 2) { ?>
                              <i class="fa fa-times-circle colorD" aria-hidden="true" onclick="deleteActivityEnrollment(<? echo $row['EnrollID']?>);" style="cursor: pointer;"></i>
                            <? } ?>
                          </td>
                          
                          <!-- Modal -->
                          <? if($row['EnrollStatus'] == 0) {?>
                            <div class="modal fade" id="editModal_<? echo $start?>" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">請輸入驗證碼</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p><input type="" class="form-control" id="verifyCode" placeholder="請輸入驗證碼"></p>
                                  </div>
                                  <div class="modal-footer" enrollid="<? echo $row['EnrollID']?>">
                                    <button type="button" class="btn btn-success btn-lg reSendBtn">重寄驗證碼</button>
                                    <button type="button" class="btn btn-success btn-lg submitBtn">確定送出</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <? }?>
                        </tr>
                        <? };?>
                      </tbody>
                    </table>
                  </div>
                  <div class="pageBOX">
                    <ul class="pagination">
                      <li><a href="annal.php?page=1<? echo '&searchText='.$searchText.'&status='.$status.'&enrollStatus='.$enrollStatus ?>"><span aria-hidden="true">&laquo;</span></a></li>
                      <? for ($i=0; $i<$total_pages; $i++) {?>
                        <? if ($_GET["page"] == $i+1) {?>
                          <li class="active"><a href="annal.php?page=<? echo $i+1?><? echo '&searchText='.$searchText.'&status='.$status.'&enrollStatus='.$enrollStatus.'&activityCategory='.$activityCategory ?>"><? echo $i+1 ?></a></li>
                        <? } else { ?>
                          <li><a href="annal.php?page=<? echo $i+1?><? echo '&searchText='.$searchText.'&status='.$status.'&enrollStatus='.$enrollStatus.'&activityCategory='.$activityCategory ?>"><? echo $i+1 ?></a></li>
                        <? } ?>
                      <? } ?>
                      <li><a href="annal.php?page=<? echo $total_pages?><? echo '&searchText='.$searchText.'&status='.$status.'&enrollStatus='.$enrollStatus.'&activityCategory='.$activityCategory ?>"><span aria-hidden="true">&raquo;</span></a></li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
 <?php include_once("_include/_footer.php"); ?>
</body>
</html>
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
        
        $(".editBtn").click(function() {
            var modalId = $(this).attr('modelid');
            var $modalId = $('#' + modalId);
            $modalId.modal();
        });
        $(".submitBtn").click(function() {
            var verifyCode = $(this).parent().parent().find('#verifyCode').val();
            doVerifyCode(verifyCode, $(this).parent().attr('enrollid'));
            window.location.replace('annal.php');
        });
        $(".reSendBtn").click(function() {
            if(confirm('要重寄驗證碼嗎?')) {
                var enrollId = $(this).parent().attr('enrollid');
                $.ajax({
                  url: "sendVerifyCodeMail.php",
                  method: "POST",
                  data: {
                      enrollId: enrollId
                  }
                }).done(function(email) {
                    alert('已將驗證碼發送至'+email+'\n(若在收件匣末看到信件，請至垃圾郵件查看\n若五分鐘後未收到信件，請再次重寄驗證碼)');
                }).error(function( jqXHR, textStatus, errorThrown) {
                    alert('重寄驗證碼失敗');
                });
            }
        });
    });
    function doVerifyCode(verifyCode, enrollId) {
        $.ajax({ 
            url: 'doVerifyCode.php?verifyCode='+verifyCode+'&enrollId='+enrollId,
            type: 'GET', 
            async: false,
            success: function(hasRow) { 
                if(true == hasRow) {
                    alert('驗證成功');
                } else {
                    alert('驗證碼驗證失敗。');
                }
            }, 
            error: function(xhr) { 
                alert('系統異常。'); 
            } 
        });
    }
    function deleteActivityEnrollment(enrollId) {
        if(confirm('確定要刪除此活動報名?')){
            $.ajax({ 
                url: 'deleteActivityEnrollment.php',
                type: 'POST',
                async: false,
                data: {
                    enrollId: enrollId
                }, 
                success: function() { 
                    window.location.replace('annal.php');
                }, 
                error: function(xhr) { 
                    alert('系統異常。'); 
                } 
            });
        }
    }
    /*
    if("<?php echo $_GET["alert"]?>" == "editSuccess"){
      alert("修改成功!");
    }
    */
</script>