<?
session_start();
include('_connMysql.php');
    //檢查是否經過登入
if(!isset($_SESSION["CustomerID"])){
  header("Location: login.php");
}
$enrollId = empty($_GET['enrollId']) ? $_POST['enrollId'] : $_GET['enrollId'];
$customerId = $_SESSION["CustomerID"];
    //$enrollId = "3";
    //$customerId = "123456";

$query_activity = "SELECT AE.*, A.ActivityDateS, A.ActivityDateE, A.ContentSbuject, A.Status, (SELECT CodeName FROM RefCommon WHERE Type = 'activityStatus' AND TypeCode = A.Status) AS StatusDesc, (SELECT CodeName FROM RefCommon WHERE Type = 'enrollStatus' AND TypeCode = AE.EnrollStatus) AS EnrollStatusDesc FROM Activitys A, ActivityEnrollment AE WHERE AE.CustomerID = '$customerId' AND AE.EnrollStatus != '0' AND AE.EnrollID = '$enrollId' AND A.ActivityID = AE.ActivityID";
$RecActivity = mysql_query($query_activity);
if(mysql_num_rows($RecActivity) == 0) {
  header("Location: annal.php");
}
$row = mysql_fetch_assoc($RecActivity);
$query_enrollmentDetail = "SELECT * FROM ActivityEnrollmentDetail WHERE EnrollID = '$enrollId' ORDER BY EnrollDetailID ASC";
$RecEnrollmentDetail = mysql_query($query_enrollmentDetail);
if($_POST['action'] == 'updateBankAcctLast5') {
  $bankAcctLast5 = $_POST["bankAcctLast5"];
  $updateSql = "UPDATE ActivityEnrollment SET BankAcctLast5 = '$bankAcctLast5' WHERE EnrollID = '$enrollId' AND CustomerID = '$customerId'";
  mysql_query($updateSql);
  header("Location: annal.php");
}
if($_POST['action'] == 'update') {
        // 報名者
  $echelon = '' == $_POST["echelon"] ? 0 : $_POST["echelon"];
  $fullName = $_POST["fullName"];	
  $gender = $_POST["gender"];	
  $identityNo = $_POST["identityNo"];	
  $mobile = $_POST["mobile"];	
  $landLine = $_POST["landLine"];	
  $eMail = $_POST["eMail"];	
  $birthday = empty($_POST["birthday"]) ? 'NULL' : "'".$_POST["birthday"]."'";
  $contactAddress = $_POST["contactAddress"];
  $tentId = '' == $_POST["tentId"] ? 0 : $_POST["tentId"];
  $reMark = $_POST["reMark"];

  $update = "UPDATE ActivityEnrollment SET 
  Echelon='$echelon', FullName='$fullName', Gender='$gender',
  IdentityNo='$identityNo', Mobile='$mobile', LandLine='$landLine',
  EMail='$eMail', Birthday=$birthday, ContactAddress='$contactAddress', TentID='$tentId',
  ReMark='$reMark' 
  WHERE EnrollID='$enrollId' AND CustomerID = '$customerId'";	
  mysql_query($update);
        // 同行人員
  $index = 0;
  while(isset($_POST['fullName_'.$index])) {
    $enrollDetailId = $_POST["enrollDetailId_".$index];
    $newIdentityNo = $_POST["identityNo_".$index];
    $fullName = $_POST["fullName_".$index];	
    $gender = $_POST["gender_".$index];	
    $birthday = empty($_POST["birthday_".$index]) ? 'NULL' : "'".$_POST["birthday_".$index]."'";
    $update = "UPDATE ActivityEnrollmentDetail SET 
    FullName='$fullName', Gender='$gender', IdentityNo='$newIdentityNo', Birthday=$birthday 
    WHERE EnrollDetailID='$enrollDetailId' and EnrollID = '$enrollId'";
    mysql_query($update);
    $index++;
  }
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
          <li class="breadcrumb-item active">活動報名表</li>
          <li class="breadcrumb-item active">修改報名表</li>
        </ol>
        <!-- 標題 -->
        <div class="alert alert-info" role="alert">
          <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 修改報名表
        </div>
        <!-- 內容開始 -->
        <div class="frameBOX">
          <div class="activityDetailBOX">
            <table class="table table-hover">
              <thead class="thead-info">
                <tr class="secondary">
                  <th>活動名稱</th>
                  <th>梯次</th>
                  <th>活動日期</th>
                  <th>活動費用</th>
                  <th>報名狀態</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="colorA"><? echo $row['ContentSbuject']?></td>
                  <td><? echo $row['Echelon']?></td>
                  <td class="UB"><? echo date("Y-m-d", strtotime($row["ActivityDateS"])).'~'.date("Y-m-d", strtotime($row["ActivityDateE"])); ?></td>
                  <td class="colorB"><? echo $row['TotalAmount']?></td>
                  <td class="colorD"><? echo $row['EnrollStatusDesc']?></td>
                </tr>
              </tbody>
            </table>
            <hr>
            <form action="registration_e.php" method="POST">
              <div class="registrationH1">匯款帳號後五碼：<input type="" name="bankAcctLast5" value="<? echo $row['BankAcctLast5']?>" maxlength="5" style="height: 30px; margin-right: 10px;" placeholder=""><button type="submit" class="btn btn-success btn-lg">確定送出</button></div>
              <input type="hidden" name="enrollId" value="<?echo $enrollId?>" />
              <input type="hidden" name="action" value="updateBankAcctLast5" />
            </form>
            <div class="registrationH2"><i class="fa fa-user" aria-hidden="true"></i> 主要聯絡人資料</div>
            <form action="registration_e.php" method="POST">
              <div class="login-page">      
                <div class="registrationFORM">
                  <input name="enrollId" type="hidden" value="<? echo $enrollId; ?>"/>
                  <input name="action" type="hidden" value="update"/>
                  <div class="col-lg-12">
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label">姓名 <i class="fa fa-star" aria-hidden="true"></i> </label>
                      <div class="col-sm-8">
                        <input type="" class="form-control" id="inputEmail3" name="fullName" value="<? echo $row['FullName']?>" placeholder="請填寫真實姓名" required="required" />
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
                          <? while($rowGender = mysql_fetch_assoc($recGender)) {
                            if($row['Gender'] == $rowGender["TypeCode"] ) { ?>
                            <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>" selected><?echo $rowGender["CodeName"] ?></option>
                            <? } else {?>
                            <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>"><?echo $rowGender["CodeName"] ?></option>
                            <? }
                          } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label">身份號碼 </label>
                      <div class="col-sm-8">
                        <input type="" class="form-control" id="inputEmail3" name="identityNo" value="<? echo $row['IdentityNo']?>" placeholder=" 活動使用 - 旅遊平安險">
                      </div>
                    </div>
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label"> 手機 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                      <div class="col-sm-8">
                        <input type="" class="form-control" id="inputEmail3" name="mobile" value="<? echo $row['Mobile']?>" placeholder="例如：0988123456" required="required">
                      </div>
                    </div>
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label">市話 </label>
                      <div class="col-sm-8">
                        <input type="" class="form-control" id="inputEmail3" name="landLine" value="<? echo $row['LandLine']?>" placeholder="例如：02-12345678#999(分機在#後)">
                      </div>
                    </div>
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label">電子郵件 <i class="fa fa-star" aria-hidden="true"></i> </label>
                      <div class="col-sm-8">
                        <input type="" class="form-control" id="inputEmail3" name="eMail" value="<? echo $row['EMail']?>" placeholder="abc12Q234@gmail.com" required="required">
                      </div>
                    </div>
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label">出生日期 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                      <div class="col-sm-8">
                        <input name="birthday" type="date" class="form-control" value="<?echo date("Y-m-d", strtotime($row["Birthday"]))?>" required="required" />
                      </div>
                    </div>
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label">地址 </label>
                      <div class="col-sm-8">
                        <input type="" class="form-control" name="contactAddress" id="inputEmail3" value="<? echo $row['ContactAddress']?>" placeholder="">
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
                    <input type="" class="form-control" id="inputEmail3" name="reMark" value="<? echo $row['ReMark']?>" placeholder="">
                  </div>
                   </div>
                  </div>
                </div>  
              </div>
              <div class="registrationH3"><i class="fa fa-users" aria-hidden="true"></i> 同行人員資料</div>
              <div class="login-page">      
                <? $index = 0; while($detailRow = mysql_fetch_assoc($RecEnrollmentDetail)) { ?>
                <div class="registrationFORM">
                  <input type="hidden" name="enrollDetailId_<? echo $index?>" value="<? echo $detailRow['EnrollDetailID']?>" />
                  <div class="col-lg-12">
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label">姓名 <i class="fa fa-star" aria-hidden="true"></i> </label>
                      <div class="col-sm-8">
                        <input type="" class="form-control" id="inputEmail3" name="fullName_<? echo $index?>" value="<? echo $detailRow['FullName']?>" placeholder="請填寫真實姓名" required="required">
                      </div>
                    </div>
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label">性別 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                      <div class="col-sm-8">
                        <?
                        $findGender = "SELECT * FROM RefCommon WHERE Type = 'gender' ORDER BY TypeCode ASC";
                        $recGender = mysql_query($findGender);
                        ?>
                        <select class="form-control dropdownlist" id="inputEmail3" name="gender_<? echo $index?>" required="required">
                          <? while($rowGender = mysql_fetch_assoc($recGender)) {
                            if($detailRow['Gender'] == $rowGender["TypeCode"] ){ ?>
                            <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>" selected><?echo $rowGender["CodeName"] ?></option>
                            <? } else {?>
                            <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>"><?echo $rowGender["CodeName"] ?></option>
                            <? }
                          } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label">身份號碼  <i class="fa fa-star" aria-hidden="true"></i></label>
                      <div class="col-sm-8">
                        <input type="" class="form-control" id="inputEmail3" name="identityNo_<? echo $index?>" value="<? echo $detailRow['IdentityNo']?>" placeholder=" 活動使用 - 旅遊平安險" required="required" />
                      </div>
                    </div>
                    <div class="form-box">
                      <label for="inputEmail3" class="col-sm-4 form-control-label">出生日期 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                      <div class="col-sm-8">
                        <input type="date" name="birthday_<? echo $index?>" value="<?echo date("Y-m-d", strtotime($detailRow["Birthday"]))?>" class="form-control" required="required" />
                      </div>
                    </div>
                  </div>
                </div>  
                <? $index++;}?>
              </div>
          
              <div style="margin:10px auto;">
                <ul class="pagination">
                  <li><a href="annal.php"><span aria-hidden="true">&laquo; 回上一頁</span></a></li>
                  <li class="active"><a href="activity.php">回列表</a></li>
                </ul>
                <input type="submit" style="float: right; width: 30%; margin: 20px 0; padding: 10px 30px;" class="btn btn-success btn-lg" value="確定修改送出"/>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("_include/_footer.php"); ?>
</body>
</html>
<!-- easing plugin ( optional ) -->
<script src="js-top/easing.js" type="text/javascript"></script>
<!-- UItoTop plugin -->
<script src="js-top/jquery.ui.totop.js" type="text/javascript"></script>
<!-- Starting the plugin -->
<script type="text/javascript">
  $(document).ready(function() {
    $().UItoTop({ easingType: 'easeOutQuart' });
  });
</script>
