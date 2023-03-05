<?php
  session_start();
  include_once("_connMysql.php");
  //檢查是否經過登入
  if(!isset($_SESSION["CustomerID"])){
    header('location: login.php');
  }
  $customerId = $_SESSION["CustomerID"];
  $query_activitys = "SELECT AE.*, A.ActivityDateS, A.ActivityDateE, A.ContentSbuject, A.Status, (SELECT CodeName FROM RefCommon WHERE Type = 'activityStatus' AND TypeCode = A.Status) AS StatusDesc, (SELECT CodeName FROM RefCommon WHERE Type = 'enrollStatus' AND TypeCode = AE.EnrollStatus) AS EnrollStatusDesc FROM Activitys A, ActivityEnrollment AE WHERE AE.CustomerID = '$customerId' AND A.ActivityID = AE.ActivityID";
  if (!Empty($_GET["searchText"])) {
    $searchText = $_GET["searchText"];
    $query_activitys .= " AND A.ContentSbuject like '%$searchText%' ";
  } 
  if (!Empty($_GET["status"])) {
    $status = $_GET["status"];
    $query_activitys .= " AND A.Status = '$status' ";
  }
  
  if (!Empty($_GET["enrollStatus"]) || '0' == $_GET["enrollStatus"]) {
    $enrollStatus = $_GET["enrollStatus"];
    $query_activitys .= " AND AE.EnrollStatus = '$enrollStatus' ";
  } 
  $query_activitys .= " ORDER BY A.CreateDate DESC";
  $RecActivitys = mysql_query($query_activitys);
  //預設每頁筆數
  $pageRow_records = 10;
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
  $RecActivitys = mysql_query($query_activitys.' LIMIT '.$start.', '.$pageRow_records);
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
                    活動名稱：<input type="text" name="searchText" value="<? echo $searchText?>" placeholder="輸入關鍵字">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    活動狀態：
                    <?
                      $findStatus = "SELECT * FROM RefCommon WHERE Type = 'activityStatus'";
                      $recStatus = mysql_query($findStatus);
                    ?>
                    <select name="status" class="custom-select">
                      <option value="">所有狀態</option>
                    <? while($rowStatus = mysql_fetch_assoc($recStatus)){ ?>
                      <?if ($rowStatus["TypeCode"] == $status) { ?>
                        <option value="<? echo $rowStatus["TypeCode"] ?>" id="<? echo $rowStatus["TypeCode"] ?>" selected><?echo $rowStatus["CodeName"] ?></option>
                      <? } else {?>
                        <option value="<? echo $rowStatus["TypeCode"] ?>" id="<? echo $rowStatus["TypeCode"] ?>"><?echo $rowStatus["CodeName"] ?></option>
                      <? } ?>
                    <? } ?>
                    </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    報名狀態：
                    <?
                        $findEnrollStatus = "SELECT * FROM RefCommon WHERE Type = 'enrollStatus'";
                        $recEnrollStatus = mysql_query($findEnrollStatus);
                    ?>
                    <select name="enrollStatus" class="custom-select">
                      <option value="">所有狀態</option>
                    <? while($rowEnrollment = mysql_fetch_assoc($recEnrollStatus)){ ?>
                        <?if ($rowEnrollment["TypeCode"] == $enrollStatus) { ?>
                            <option value="<? echo $rowEnrollment["TypeCode"] ?>" id="<? echo $rowEnrollment["TypeCode"] ?>" selected><?echo $rowEnrollment["CodeName"] ?></option>
                        <? } else {?>
                            <option value="<? echo $rowEnrollment["TypeCode"] ?>" id="<? echo $rowEnrollment["TypeCode"] ?>"><?echo $rowEnrollment["CodeName"] ?></option>
                        <? } ?>
                    <? } ?>
                    </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" class="btn btn-success btn-lg" value="搜尋" />
                  </div>
                  </form>
                  <div class="TABLE_BOX">
                    <table class="table table-hover">
                      <thead class="thead-info">
                        <tr class="secondary">
                          <th>#</th>
                          <th>梯次</th>
                          <th>活動名稱</th>
                          <th>活動日期</th>
                          <th>活動費用</th>
                          <th>活動狀態</th>
                          <th>報名狀態</th>
                          <th>修改</th>
                          <th>取消</th>
                        </tr>
                      </thead>
                      <tbody>
                        <? while($row=mysql_fetch_assoc($RecActivitys)){ ?>
                        <tr>
                          <th scope="row"><? echo ++$start;?></th>
                          <td><? echo $row['Echelon']?></td>
                          <td class="colorA"><? echo $row['ContentSbuject']?></td>
                          <td class="UB"><? echo date("Y-m-d", strtotime($row["ActivityDateS"])).'~'.date("Y-m-d", strtotime($row["ActivityDateE"])); ?></td>
                          <td class="colorB"><? echo $row['TotalAmount']?></td>
                          <td><span class="colorC"><? echo $row['StatusDesc']?></span></td>
                          <td><span class="colorD"><? echo $row['EnrollStatusDesc']?></span></td>
                          <? if($row['EnrollStatus'] == 0) { ?>
                            <td class="colorE"><i class="fa fa-plus-circle editBtn" modelid="editModal_<? echo $start?>" aria-hidden="true"></i></td>
                          <? } else { ?>
                            <td class="colorE"><i class="fa fa-plus-circle editBtn" aria-hidden="true" onclick="window.location.replace('registration_e.php?enrollId='+<? echo $row['EnrollID']?>);"></i></td>
                          <? } ?>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true" onclick="deleteActivityEnrollment(<? echo $row['EnrollID']?>);"></i></td>
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
                  <div class="TABLE_BOX_mobile">
                      <div class="tableMO">
                          <p>#1</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>  
                        <!-- Modal -->
                          <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">請輸入驗證碼</h4>
                                </div>
                                <div class="modal-body">
                                  <p><input type="" class="form-control" id="inputEmail3" placeholder="請輸入驗證碼"></p>
                                </div>
                                <div class="modal-footer">
                                  <a href="registration_e.php"><button type="button" class="btn btn-success btn-lg">確定送出</button></a>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        <script>
                        $(document).ready(function(){
                            $("#myBtn").click(function(){
                                $("#myModal").modal();
                            });
                        });
                        </script>                        
                      <div class="tableMO">
                          <p>#2</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>                     
                      <div class="tableMO">
                          <p>#3</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>                     
                      <div class="tableMO">
                          <p>#4</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>                     
                      <div class="tableMO">
                          <p>#5</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>                     
                      <div class="tableMO">
                          <p>#6</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>                     
                  </div>
                  <div class="pageBOX">
                    <ul class="pagination">
                      <li><a href="annal.php?page=1<? echo '&searchText='.$searchText.'&status='.$status.'&enrollStatus='.$enrollStatus ?>"><span aria-hidden="true">&laquo;</span></a></li>
                      <? for ($i=0; $i<$total_pages; $i++) {?>
                        <? if ($_GET["page"] == $i+1) {?>
                          <li class="active"><a href="annal.php?page=<? echo $i+1?><? echo '&searchText='.$searchText.'&status='.$status.'&enrollStatus='.$enrollStatus ?>"><? echo $i+1 ?></a></li>
                        <? } else { ?>
                          <li><a href="annal.php?page=<? echo $i+1?><? echo '&searchText='.$searchText.'&status='.$status.'&enrollStatus='.$enrollStatus ?>"><? echo $i+1 ?></a></li>
                        <? } ?>
                      <? } ?>
                      <li><a href="annal.php?page=<? echo $total_pages?><? echo '&searchText='.$searchText.'&status='.$status.'&enrollStatus='.$enrollStatus ?>"><span aria-hidden="true">&raquo;</span></a></li>
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
</script>