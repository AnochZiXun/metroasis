<?php
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>';
session_start();
include('_connMysql.php');

//檢查是否經過登入
if(!isset($_SESSION["CustomerID"])){
	header("Location: login.php");
}

if (!Empty($_GET["activityId"])) {
  $activityId = $_GET["activityId"];
} 

if (!Empty($_POST["activityId"])) {
  $activityId = $_POST["activityId"];
} 

$query_activitys = "SELECT * FROM Activitys WHERE ActivityID = '$activityId'";
$RecActivitys = mysql_query($query_activitys);
if (mysql_num_rows($RecActivitys) == 0) {
  header("Location: activity.php");
}
$row = mysql_fetch_assoc($RecActivitys);

if ($_POST["action"] == "add") { 
  $echelon = empty($_POST["echelon"]) ? 'NULL' : $_POST["echelon"];
  $fullName = $_POST["fullName"];	
  $gender = $_POST["gender"];	
  $identityNo = empty($_POST["identityNo"]) ? 'NULL' : "'".$_POST["identityNo"]."'";
  $mobile = $_POST["mobile"];	
  $landLine = empty($_POST["landLine"]) ? 'NULL' : "'".$_POST["landLine"]."'";
  $eMail = $_POST["eMail"];	
  $birthday = $_POST["birthday"];
  $contactAddress = empty($_POST["contactAddress"]) ? 'NULL' : "'".$_POST["contactAddress"]."'";
  $tentId = $_POST["tentId"];
  $verifyCode = substr(md5(rand()) ,0, 6);
  $customerId = $_SESSION["CustomerID"];
  $enrollStatus = 0;
  $reMark = empty($_POST["reMark"]) ? 'NULL' : "'".$_POST["reMark"]."'";
  
  $insert = "INSERT INTO ActivityEnrollment (ActivityID, Echelon, FullName, Gender, IdentityNo, Mobile, LandLine, EMail, Birthday, ContactAddress, TentID, VerifyCode, CustomerId, EnrollStatus, ReMark) 
  VALUES ('$activityId', $echelon, '$fullName', $gender, $identityNo, '$mobile', $landLine, '$eMail', '$birthday', $contactAddress, $tentId, '$verifyCode', $customerId, $enrollStatus, $reMark)";
  mysql_query($insert);

  $enrollId = mysql_insert_id();
  
  $index = 0;
  while(1) {
    if(empty($_POST["fullName_".$index])) {
        break;
    }
    
    $fullName_s = $_POST["fullName_$index"];	
    $newIdentityNo = $_POST["identityNo_$index"];
    $gender = $_POST["gender_".$index];	
    $birthday = $_POST["birthday_".$index];	
      
    $insert = "INSERT INTO ActivityEnrollmentDetail (EnrollID, FullName, IdentityNo, Gender, Birthday) 
          VALUES ('$enrollId', '$fullName_s', '$newIdentityNo', '$gender', '$birthday')";
    mysql_query($insert);
    $index++;
  }

  echo '
    <script>
      $.ajax({
        url: "sendVerifyCodeMail.php",
        method: "POST",
        data: {
            enrollId: '.$enrollId.'
        }
      }).done(function(){
      }).error(function(a,b,c){
        console.info(a);
        console.info(b);
        console.info(c);
      });
    </script>
  ';

  header("Location: annal.php");
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
    <script src="js/flycan.js"></script>
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
                  <li class="breadcrumb-item active">活動報名表</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 活動報名表
                </div>
                <!-- 內容開始 -->
                <form action="registration.php" method="POST">
                <div class="frameBOX">
                  <div class="activityDetailBOX">
                    <h2><? echo $row['ContentSbuject']?></h2>
                    <p><i class="fa fa-clock-o" aria-hidden="true"></i><span> 活動時間：</span><? echo date("Y-m-d", strtotime($row["ActivityDateS"])).' ~ '.date("Y-m-d", strtotime($row["ActivityDateE"])); ?></p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i><span> 活動地點：</span><? echo $row['ActivityPlace']?></p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i><span> 活動地址：</span><? echo $row['ActivityAddress']?></p>
                    <hr>
                    <div class="registrationH1">請填寫以下主要聯絡人資料，完成之後您將會收到一封驗證信件。</div>
                    <div class="registrationH2"><i class="fa fa-user" aria-hidden="true"></i> 主要聯絡人資料</div>
                  <div class="login-page">      
                    <div class="registrationFORM">
                      <input name="activityId" type="hidden" value="<? echo $activityId; ?>"/>
                      <div class="col-lg-12">
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">姓名 <i class="fa fa-star" aria-hidden="true"></i> </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" id="inputEmail3" name="fullName" placeholder="請填寫真實姓名" required="required">
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">性別 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <?
                                $findGender = "SELECT * FROM RefCommon WHERE Type = 'gender' ORDER BY TypeCode ASC";
                                $recGender = mysql_query($findGender);
                            ?>
                            <select class="form-control dropdownlist" id="inputEmail3" name="gender" required="required">
                            <? while($rowGender = mysql_fetch_assoc($recGender)){ ?>
                                <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>"><?echo $rowGender["CodeName"] ?></option>
                            <? } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">身份號碼 </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" id="inputEmail3" name="identityNo" placeholder=" 活動使用 - 旅遊平安險">
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label"> 手機 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" id="inputEmail3" name="mobile" placeholder="例如：0988123456" required="required">
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">市話 </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" id="inputEmail3" name="landLine" placeholder="例如：02-12345678#999(分機在#後)">
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">電子郵件 <i class="fa fa-star" aria-hidden="true"></i> </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" id="inputEmail3" name="eMail" placeholder="abc12Q234@gmail.com" required="required">
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">出生日期 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <input name="birthday" type="date" name="birthday" class="form-control" required="required" />
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">地址 </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" name="contactAddress" id="inputEmail3" placeholder="">
                        </label>
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">行前訓練課程日 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <label class="custom-control custom-radio">
                              <input id="radio1" name="radio" type="radio" class="custom-control-input">
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">2017/05/26</span>
                            </label>
                            <label class="custom-control custom-radio">
                              <input id="radio2" name="radio" type="radio" class="custom-control-input">
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">2017/06/10</span>
                            </label>
                            <label class="custom-control custom-radio">
                              <input id="radio2" name="radio" type="radio" class="custom-control-input">
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">2017/06/20</span>
                            </label>
                        </label>
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">使用ADISI帳篷 <i class="fa fa-star" aria-hidden="true"></i> </label>
                          <div class="col-sm-8">
                            <select name="tentId" class="custom-select" required="required">
                              <option value="0" selected>經典溫馨系列</option>
                              <option value="1">經典溫馨系列</option>
                              <option value="2">經典溫馨系列</option>
                              <option value="3">經典溫馨系列</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">備註 </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" id="inputEmail3" name="reMark" placeholder="">
                          </div>
                        </div>
                      </div>
                    </div>  
                  </div>

                  <div class="registrationH3"><i class="fa fa-users" aria-hidden="true"></i> 同行人員資料</div>
                  <div class="login-page">      
                    <div class="registrationFORM" id="companionForm">
                      <div class="col-lg-12" id="companionDiv" style="margin-top:8px;margin-bottom:8px;">
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">姓名 <i class="fa fa-star" aria-hidden="true"></i> </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" id="inputEmail3" name="fullName_0" placeholder="請填寫真實姓名" required="required">
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">性別 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <?
                                $findGender = "SELECT * FROM RefCommon WHERE Type = 'gender' ORDER BY TypeCode ASC";
                                $recGender = mysql_query($findGender);
                            ?>
                            <select class="form-control dropdownlist" id="inputEmail3" name="gender_0" required="required">
                            <? while($rowGender = mysql_fetch_assoc($recGender)){ ?>
                                <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>"><?echo $rowGender["CodeName"] ?></option>
                            <? } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">身份號碼  <i class="fa fa-star" aria-hidden="true"></i></label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" id="inputEmail3" name="identityNo_0" placeholder=" 活動使用 - 旅遊平安險" required="required" />
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">出生日期 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <input type="date" name="birthday_0" class="form-control" required="required" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-box">
                      <div class="col-sm-8">
                        <input type="button" id="addCompanion" class="form-control" style="padding:0;" value="新增同行人員" />
                      </div>
                    </div>  
                  </div>
                  <div class="registrationH4">
                    <i class="fa fa-star" aria-hidden="true"></i> 注意事項<br>
                    <p>自105年起，參加「熊鷹之夜」者，限定使用ADISI帳篷</p>
                    <p>1.報名前請務必詳閱簡章「必須裝備項目」。</p>
                    <p>2.報名前請務必詳閱「退費規定」。</p>
                  </div>

                  </div>
                    <div style="margin:10px auto;">
                      <ul class="pagination">
                        <li><a href="activity_detail.php"><span aria-hidden="true">&laquo; 回上一頁</span></a></li>
                        <li class="active"><a href="activity.php">回列表</a></li>
                      </ul>
                       <input type="submit" style="float: right; width: 30%; margin: 20px 0; padding: 10px 30px;" type="button" class="btn btn-success btn-lg" value="送出報名表" />
                       <input type="hidden" name="action" value="add" />
                    </div>
                  </div>
                </form>
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
            $().UItoTop({ easingType: 'easeOutQuart' });
        });

        var activityId = $('input[name=activityId]').val();
        var $companionDiv = $('#companionDiv').clone();
        var index = 1;
        var addCompanion = function() {
            var newIndex = index++;
            var $clone = $companionDiv.clone();
            $clone.find('input[name=fullName_0]').attr('name', 'fullName_'+newIndex);
            $clone.find('select[name=gender_0]').attr('name', 'gender_'+newIndex);
            $clone.find('input[name=identityNo_0]').attr('name', 'identityNo_'+newIndex);
            $clone.find('input[name=birthday_0]').attr('name', 'birthday_'+newIndex);
            $('#companionForm').append($clone);
        };

        var checkCompanionCount = function() {
            var result;
            $.ajax({ 
                url: 'checkCompanionLimit.php',
                type: 'POST',
                async: false,
                data: {
                    activityId: activityId
                }, 
                success: function(data) { 
                    result = data;
                }, 
                error: function(xhr) { 
                    alert('系統異常。'); 
                } 
            });
            return result;
        }

        $('#addCompanion').bind('click', function() {
            var limit = checkCompanionCount();
            if(limit && index >= limit) {
              alert('此活動同行人員上限為'+limit+'人');
              return;
            }
            addCompanion();
        });
    </script>
</body>
</html>