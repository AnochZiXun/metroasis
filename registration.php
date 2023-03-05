<?php
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>';
session_start();
include_once("_connMysql.php");
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
if (!Empty($_GET["category"])) {
  $category = $_GET["category"];
} 
if (!Empty($_POST["category"])) {
  $category = $_POST["category"];
} 
switch($category){
  case "1":
    $query_activity = "SELECT * FROM ActivityNight WHERE ActivityNightID = '$activityId' ";
    break;
  case "2":
    $query_activity = "SELECT * FROM ActivityClass WHERE ActivityClassID = '$activityId' ";
    break;
  default:
    break;
}
$recActivity = mysql_query($query_activity);
if (mysql_num_rows($recActivity) == 0) {
  header("Location: activity.php");
}
$row = mysql_fetch_assoc($recActivity);
if ($_POST["action"] == "add") { 
  $fullName = $_POST["fullName"];	
  $gender = $_POST["gender"];	
  $identityNo = empty($_POST["identityNo"]) ? 'NULL' : "'".$_POST["identityNo"]."'";
  $mobile = $_POST["mobile"];	
  $landLine = empty($_POST["landLine"]) ? 'NULL' : "'".$_POST["landLine"]."'";
  $eMail = $_POST["eMail"];	
  $birthday = $_POST["birthday"];
  $contactAddress = empty($_POST["contactAddress"]) ? 'NULL' : "'".$_POST["contactAddress"]."'";
  $verifyCode = substr(md5(rand()) ,0, 6);
  $customerId = $_SESSION["CustomerID"];
  $enrollStatus = 0;
  $reMark = empty($_POST["reMark"]) ? 'NULL' : "'".$_POST["reMark"]."'";
  $session = empty($_POST["session"]) ? 'NULL' : "'".$_POST["session"]."'";
  $totalAmount = intval($row["Cost"]);
  for($i = 0 ; $i < count($_POST["rentItemSpecID"]) ; $i++){
    $rentItemSpecID = $_POST["rentItemSpecID"][$i];
    $quantity = intval($_POST["quantity"][$i]);
    $rec_itemCost = mysql_query("SELECT ItemCost FROM RentItemSpec WHERE ID = '$rentItemSpecID'");
    if($rec_itemCost){
      $row_itemCost = mysql_fetch_assoc($rec_itemCost);
      $itemCost = intval($row_itemCost["ItemCost"]);
      $totalAmount = $totalAmount + ($itemCost * $quantity);
    }
  }
  $quota = intval($row["Quota"]);#活動設定名額
  $waitingNumber = intval($row["WaitingNumber"]);#活動設定候補名額
  $rec_applicantNumber = mysql_query("SELECT COUNT(*) AS ApplicantNumber FROM ActivityEnrollment WHERE ActivityID = '$activityId' AND ActType = '$category'");
  $row_applicantNumber = mysql_fetch_assoc($rec_applicantNumber);
  $applicantNumber = intval($row_applicantNumber["ApplicantNumber"]);#目前報名人數  
  if($applicantNumber < $quota){  
    $qualification = 1;#正取
  }else if( ($applicantNumber >= $quota) && ($applicantNumber < ($quota + $waitingNumber)) ){
    $qualification = 0;#候補
  }else{
    $qualification = -1;#額滿
  }
  if($qualification != -1){
    $insert = "INSERT INTO ActivityEnrollment (ActivityID, FullName, Gender, IdentityNo, Mobile, LandLine, EMail, Birthday, ContactAddress, VerifyCode, CustomerId, EnrollStatus, ReMark, Session, TotalAmount, ActType, Qualification) 
      VALUES ('$activityId', '$fullName', $gender, $identityNo, '$mobile', $landLine, '$eMail', '$birthday', $contactAddress, '$verifyCode', $customerId, $enrollStatus, $reMark, $session, $totalAmount, $category, '$qualification')";
    mysql_query($insert);
    $enrollId = mysql_insert_id();
    for($i = 0 ; $i < count($_POST["companionFullName"]) ; $i++){
      $fullName_s = $_POST["companionFullName"][$i]; 
      $newIdentityNo = $_POST["companionIdentityNo"][$i];
      $gender = $_POST["companionGender"][$i]; 
      $birthday = $_POST["companionBirthday"][$i]; 
      $insert = "INSERT INTO ActivityEnrollmentDetail (EnrollID, FullName, IdentityNo, Gender, Birthday) 
      VALUES ('$enrollId', '$fullName_s', '$newIdentityNo', '$gender', '$birthday')";
      mysql_query($insert);
    }
    for($i = 0 ; $i < count($_POST["rentItemSpecID"]) ; $i++){
      $rentItemSpecID = $_POST["rentItemSpecID"][$i];
      $quantity = $_POST["quantity"][$i];
      $backupItemDescription = $_POST["backupItemDescription"][$i];
      $backupItemCost = $_POST["backupItemCost"][$i];
      $insert = "INSERT INTO ActRentItemDetail (ActEnrollID, RentItemSpecID, Quantity, BackupItemDescription, BackupItemCost) VALUES ('$enrollId', '$rentItemSpecID', '$quantity', '$backupItemDescription', '$backupItemCost')";
      mysql_query($insert);
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
  }else{
    header("Location: activity.php?alert=YouAreTooLate");
  }
}
$customerID = $_SESSION["CustomerID"];
$rec_customer = mysql_query("SELECT * FROM Customers WHERE CustomerID = '$customerID'");
$row_customer = mysql_fetch_assoc($rec_customer);
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
      <script src="js/menu.js"></script>
      <!-- menu下拉 -->
      <script src="js/flycan.js"></script>
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
            <?php include_once("_include/_productList.php"); ?>
            <!-- 折扣活動 -->
            <?php include_once("_include/_sale.php"); ?>
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
                  <?php 
                  switch($category){
                    case "1":
                      include_once("_include/_registration_night.php");
                      break;
                    case "2":
                      include_once("_include/_registration_class.php");
                      break;
                    default:
                      break;
                  }?>
                  <hr>
                  <!--<div class="registrationH1">請填寫以下主要聯絡人資料，完成之後您將會收到一封驗證信件。</div>-->
                  <div class="registrationH2"><i class="fa fa-user" aria-hidden="true"></i> 主要聯絡人資料
                      <span style="color: black; font-size: 14px;">(</span>
                      <input type="checkbox" id="whyUserAlwaysLazy" style="width: 12px; height: 12px; margin-left: 1px;">
                      <span style="color: black; font-size: 14px;">同會員資料)</span>
                  </div>
                  <div class="login-page">      
                    <div class="registrationFORM">
                      <input name="activityId" type="hidden" value="<? echo $activityId; ?>"/>
                      <div class="col-lg-12">
                        <div class="form-box">
                          <label class="col-sm-4 form-control-label">姓名 <i class="fa fa-star" aria-hidden="true"></i> </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" name="fullName" placeholder="請填寫真實姓名" required="required">
                          </div>
                        </div>
                        <div class="form-box">
                          <label class="col-sm-4 form-control-label">性別 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <?
                            $findGender = "SELECT * FROM RefCommon WHERE Type = 'gender' ORDER BY TypeCode ASC";
                            $recGender = mysql_query($findGender);
                            ?>
                            <select class="form-control dropdownlist" name="gender" id="gender" required="required">
                              <option value="">請選擇</option>
                              <? while($rowGender = mysql_fetch_assoc($recGender)){ ?>
                              <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>"><?echo $rowGender["CodeName"] ?></option>
                              <? } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-box">
                          <label class="col-sm-4 form-control-label">身份號碼 </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" name="identityNo" placeholder=" 活動使用 - 旅遊平安險">
                          </div>
                        </div>
                        <div class="form-box">
                          <label class="col-sm-4 form-control-label"> 手機 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" name="mobile" placeholder="例如：0988123456" required="required">
                          </div>
                        </div>
                        <div class="form-box">
                          <label class="col-sm-4 form-control-label">市話 </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" name="landLine" placeholder="例如：02-12345678#999(分機在#後)">
                          </div>
                        </div>
                        <div class="form-box">
                          <label class="col-sm-4 form-control-label">電子郵件 <i class="fa fa-star" aria-hidden="true"></i> </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" name="eMail" placeholder="metroasis@metroasis.com" required="required">
                          </div>
                        </div>
                        <div class="form-box">
                          <label class="col-sm-4 form-control-label">出生日期 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <input type="date" class="form-control" name="birthday" required="required" />
                          </div>
                        </div>
                        <div class="form-box">
                          <label class="col-sm-4 form-control-label">地址 </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" name="contactAddress" placeholder="">
                          </div>
                        </div>
                        <?php
                        if($category == "2"){
                        ?>
                        <div class="form-box">
                          <label class="col-sm-4 form-control-label">行前訓練課程 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <select class="form-control dropdownlist" name="session" required="required">
                              <option value="">請選擇</option>
                              <?php 
                              if(trim($row["SessionA"]) != ""){
                              ?>
                                <option value="A"><?php echo $row["SessionA"] ?></option>
                              <?php 
                              } ?>
                              <?php 
                              if(trim($row["SessionB"]) != ""){
                              ?>
                                <option value="B"><?php echo $row["SessionB"] ?></option>
                              <?php 
                              } ?>
                              <?php 
                              if(trim($row["SessionC"]) != ""){
                              ?>
                                <option value="C"><?php echo $row["SessionC"] ?></option>
                              <?php 
                              } ?>
                            </select>
                          </div>    
                        </div>                  
                        <?php
                        } ?>
                        <div class="form-box">
                          <label class="col-sm-4 form-control-label">備註 </label>
                          <div class="col-sm-8">
                            <input type="" class="form-control" name="reMark" placeholder="">
                          </div>
                        </div>
                        <?php
                        $rec_rentItem = mysql_query("SELECT * FROM ActRentItemSetting A JOIN RentItem B ON A.RentItemID = B.ID WHERE A.ActType = '$category' ORDER BY B.OrderNo");
                        if($rec_rentItem){
                        ?>
                          <div class="form-box" style="border-color: green; border-style: solid; border-width: 1px;">
                            <span>&nbsp;單品租借</span>
                            <table class="table" style="margin: 0;">
                        <?php
                          while($row_rentItem = mysql_fetch_assoc($rec_rentItem)){
                            $rentItemID = $row_rentItem["RentItemID"];
                            $rec_itemSpec = mysql_query("SELECT * FROM RentItemSpec WHERE RentItemID = $rentItemID ORDER BY OrderNo");
                        ?>
                          <tr>
                            <td style="text-align: right; vertical-align: middle; border: 0;">
                              <label class="form-control-label" id="itemName"><?php echo $row_rentItem["ItemName"] ?></label>
                            </td>
                            <td style="border: 0;">
                              <select class="form-control dropdownlist" id="rentItemSelect" style="width: 50%; display: inline;">
                                <?php
                                while($row_itemSpec = mysql_fetch_assoc($rec_itemSpec)){
                                ?>
                                  <option value="<?php echo $row_itemSpec["ID"]?>" itemCost="<?php echo $row_itemSpec["ItemCost"]?>" itemDescription="<?php echo $row_itemSpec["ItemDescription"]?>"><?php echo $row_itemSpec["ItemDescription"]?> / NT$ <?php echo $row_itemSpec["ItemCost"]?></option>
                                <?php
                                } ?>
                              </select>
                              <label class="form-control-label" style="padding-left: 1em;">數量:</label>
                              <select class="form-control dropdownlist" id="quantitySelect" style="width: 10%; display: inline;">
                                <?php
                                  for($i = 1 ; $i <=10 ; $i ++){
                                ?>
                                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php
                                  }
                                ?>
                              </select>
                              <span style="padding-left: 1em;"><i class="fa fa-plus-circle addRentItem" aria-hidden="true" style="cursor: pointer;"></i></span>
                            </td>
                          </tr>
                        <?php
                          }
                        ?>
                          </table>
                          <span>&nbsp;已租借項目</span>
                          <table class="table" id="rentItemTable" style="margin: 0;">
                            <tr id="tr_noRentItem">
                              <td style="border: 0;">
                                <label class='form-control-label' style='width: 40%; padding-left: 1em;'>無</label>    
                              </td>
                            </tr>
                          </table>
                        </div>
                      <?php  
                      } ?>
                    </div>
                  </div>
                </div>  
              </div>
              <?php
              if($category == "1"){
              ?>
                <div class="registrationH3"><i class="fa fa-users" aria-hidden="true"></i> 同行人員資料</div>
                <div class="login-page">
                  <div class="registrationFORM" id="companionForm">
                    <div class="col-lg-12 companion" id="companionDiv" style="margin-top: 8px; margin-bottom: 8px; border-style: dashed; border-color: gray;border-width: 2px; display: none;">
                      <i class="fa fa-times removeCompanion" aria-hidden="true" style="float: right; color: red; cursor: pointer;"></i>
                      <div class="form-box" style="margin-top: 5px;">
                        <label class="col-sm-4 form-control-label">姓名 <i class="fa fa-star" aria-hidden="true"></i> </label>
                        <div class="col-sm-8">
                          <input type="" class="form-control" name="companionFullName[]" placeholder="請填寫真實姓名">
                        </div>
                      </div>
                      <div class="form-box">
                        <label class="col-sm-4 form-control-label">性別 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                        <div class="col-sm-8">
                          <?
                          $findGender = "SELECT * FROM RefCommon WHERE Type = 'gender' ORDER BY TypeCode ASC";
                          $recGender = mysql_query($findGender);
                          ?>
                          <select class="form-control dropdownlist" name="companionGender[]">
                            <? while($rowGender = mysql_fetch_assoc($recGender)){ ?>
                            <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>"><?echo $rowGender["CodeName"] ?></option>
                            <? } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-box">
                        <label class="col-sm-4 form-control-label">身份號碼  <i class="fa fa-star" aria-hidden="true"></i></label>
                        <div class="col-sm-8">
                          <input type="" class="form-control" name="companionIdentityNo[]" placeholder=" 活動使用 - 旅遊平安險"/>
                        </div>
                      </div>
                      <div class="form-box">
                        <label class="col-sm-4 form-control-label">出生日期 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                        <div class="col-sm-8">
                          <input type="date" name="companionBirthday[]" class="form-control" />
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
                  <p>1.自105年起，參加「熊鷹之夜」者，限定使用ADISI帳篷</p>
                  <p>2.報名前請務必詳閱簡章「必須裝備項目」。</p>
                  <p>3.報名前請務必詳閱簡章「退費規定」。</p>
                  <p>簡章
                    <i class="fa fa-plus-square-o" id="openDetailSpan" aria-hidden="true" style="cursor: pointer; color: blue;"></i>
                    <i class="fa fa-minus-square-o" id="closeDetailSpan" aria-hidden="true" style="cursor: pointer; display: none; color: blue;"></i>
                  </p>
                  <div style="border-color: gray; border-style: solid; border-width: 1px;">
                    <span id="activityDetail" style="display: none"><? echo $row['Content'] ?></span>
                  </div>
                </div>
              <?php
              } ?>
            </div>
            <div style="margin:10px auto;">
              <ul class="pagination">
                <li><a href="activity_detail.php"><span aria-hidden="true">&laquo; 回上一頁</span></a></li>
                <li class="active"><a href="activity.php">回列表</a></li>
              </ul>
              <input type="submit" style="float:right; width:30%; margin:20px 0; padding:10px 30px;" class="btn btn-success btn-lg" value="送出報名表" />
              <input type="hidden" name="action" value="add" />
              <span id="totalCostDesc" style="float: right; color: red; padding: 10px 30px;margin: 20px 0;">NT$ </span>
              <input type="hidden" name="category" value="<?php echo $category ?>" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include_once("_include/_footer.php"); ?>
  <!-- easing plugin ( optional ) -->
  <script src="js-top/easing.js" type="text/javascript"></script>
  <!-- UItoTop plugin -->
  <script src="js-top/jquery.ui.totop.js" type="text/javascript"></script>
  <!-- Starting the plugin -->
  <script type="text/javascript">
    $(document).ready(function() {
      $().UItoTop({ easingType: 'easeOutQuart' });
      settlement();
    });
    var activityId = $('input[name=activityId]').val();
    var $companionDiv = $('#companionDiv').clone();
    var addCompanion = function() {
      var $clone = $companionDiv.clone();
      $clone.css("display","");
      $clone.find(':input').attr('required', 'required');
      $clone.find('select').attr('required', 'required');
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
    function setupRemoveCompanionIcon(){
      $(".removeCompanion").click(function(){
        $(this).parent().remove();
      });
    }
    $('#addCompanion').bind('click', function() {
      var limit = checkCompanionCount();
      if(limit && $(".companion").length >= limit) {
        alert('此活動同行人員上限為'+(limit-1)+'人');
        return;
      }
      addCompanion();
      setupRemoveCompanionIcon();
    });
    setupRemoveCompanionIcon();
    $("#openDetailSpan").click(function(){
      $("#activityDetail").slideDown();
      $(this).hide();
      $("#closeDetailSpan").show();
    });
    $("#closeDetailSpan").click(function(){
      $("#activityDetail").hide();
      $(this).hide();
      $("#openDetailSpan").show();
    });
    $("#whyUserAlwaysLazy").click(function(){
      if($(this).prop("checked")){
        $("input[name='fullName']").val("<?php echo $row_customer["ChineseName"] ?>");
        $("input[name='identityNo']").val("<?php echo $row_customer["IdentityNo"] ?>");
        $("input[name='mobile']").val("<?php echo $row_customer["Mobile"] ?>");
        $("input[name='landLine']").val("<?php echo $row_customer["HomeTel"] ?>");
        $("input[name='eMail']").val("<?php echo $row_customer["EMail"] ?>");
        $("input[name='contactAddress']").val("<?php echo $row_customer["PostalCode"].$row_customer["AddressCounty"].$row_customer["AddressDistrict"].$row_customer["Address"] ?>");
        $("#gender").val("<?php echo $row_customer["Gender"] ?>");
        $("input[name='birthday']").val("<?php echo $row_customer["Birthday"] ?>");
      }else{
        $("input[name='fullName']").val("");
        $("input[name='identityNo']").val("");
        $("input[name='mobile']").val("");
        $("input[name='landLine']").val("");
        $("input[name='eMail']").val("");
        $("input[name='contactAddress']").val("");
        $("#gender").val("");
        $("input[name='birthday']").val("");
      }
    });
    $(".addRentItem").click(function(){
      var itemName = $(this).parent().parent().parent().find("#itemName").html();;
      var rentItemSelect = $(this).parent().parent().find("#rentItemSelect");
      var quantitySelect = $(this).parent().parent().find("#quantitySelect");
      var rentItemSpecID = rentItemSelect.val();
      var backupItemDescription = rentItemSelect.find("option:selected").attr("itemDescription");
      var backupItemCost = rentItemSelect.find("option:selected").attr("itemCost");
      var quantity = quantitySelect.val();
      var tr = "";
      tr += "<tr>";
      tr += " <td style='border: 0;'><label class='form-control-label' style='width: 40%; padding-left: 1em;'>";
      tr += itemName + ":&nbsp;" + backupItemDescription + " x " + quantity + "&nbsp;&nbsp;";
      tr += "NT$ " + quantity*backupItemCost + "&nbsp;&nbsp;</label>";
      tr += "   <span style='padding-left: 1em;'><i class='fa fa-times-circle removeRentItem' aria-hidden='true' style='cursor: pointer; color: red;''></i></span>";
      tr += "<input type='hidden' name='rentItemSpecID[]' value='"+rentItemSpecID+"' />";
      tr += "<input type='hidden' name='quantity[]' value='"+quantity+"' />";
      tr += "<input type='hidden' name='backupItemDescription[]' value='"+backupItemDescription+"' />";
      tr += "<input type='hidden' name='backupItemCost[]' class='itemCost' value='"+quantity*backupItemCost+"' />";
      tr += " </td>";
      tr += "</tr>";
      $("#rentItemTable").append(tr);
      settlement();
      showTrNoRentItem()
      $(".removeRentItem").click(function(){
        $(this).closest("tr").remove();
        settlement();
        showTrNoRentItem()
      });
    });
    function settlement(){
      var actCost = parseInt($("#actCost").html());
      var rentItemCost = 0;
      $(".itemCost").each(function(){
        rentItemCost += parseInt($(this).val());
      });
      $("#totalCostDesc").html("NT$ " + (actCost + rentItemCost));
    }
    function showTrNoRentItem(){
      if($("#rentItemTable tr").length == 1){
        $("#tr_noRentItem").show();
      }else{
        $("#tr_noRentItem").hide();
      }
    }
  </script>
</body>
</html>