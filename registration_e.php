<?
session_start();
include('_connMysql.php');
    //檢查是否經過登入
if(!isset($_SESSION["CustomerID"])){
  header("Location: login.php");
}
$enrollId = empty($_GET['enrollId']) ? $_POST['enrollId'] : $_GET['enrollId'];
$actType = empty($_GET['actType']) ? $_POST['actType'] : $_GET['actType'];
$customerId = $_SESSION["CustomerID"];

switch($actType){
  case "1":
    $query_activity = "SELECT AE.*,A.Batch, A.Cost, A.StartDate AS ActivityDateS, A.EndDate AS ActivityDateE, A.ActivityName, A.Status, (SELECT CodeName FROM RefCommon WHERE Type = 'activityStatus' AND TypeCode = A.Status) AS StatusDesc, (SELECT CodeName FROM RefCommon WHERE Type = 'enrollStatus' AND TypeCode = AE.EnrollStatus) AS EnrollStatusDesc, (SELECT CodeName FROM RefCommon WHERE Type = 'actQualification' AND TypeCode = AE.Qualification) AS QualificationDesc FROM ActivityNight A, ActivityEnrollment AE WHERE AE.CustomerID = '$customerId' AND AE.EnrollStatus != '0' AND AE.EnrollID = '$enrollId' AND A.ActivityNightID = AE.ActivityID";
    break;
  case "2":
    $query_activity = "SELECT AE.*,A.Batch, A.Cost, A.ActivityDate AS ActivityDateS, A.ActivityDate AS ActivityDateE, A.ActivityName, A.Status, (SELECT CodeName FROM RefCommon WHERE Type = 'activityStatus' AND TypeCode = A.Status) AS StatusDesc, (SELECT CodeName FROM RefCommon WHERE Type = 'enrollStatus' AND TypeCode = AE.EnrollStatus) AS EnrollStatusDesc, (SELECT CodeName FROM RefCommon WHERE Type = 'actQualification' AND TypeCode = AE.Qualification) AS QualificationDesc, SessionA, SessionB, SessionC FROM ActivityClass A, ActivityEnrollment AE WHERE AE.CustomerID = '$customerId' AND AE.EnrollStatus != '0' AND AE.EnrollID = '$enrollId' AND A.ActivityClassID = AE.ActivityID";
    break;
  default:
    header("Location: annal.php");  
    break;
}
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
  #報名者
  $fullName = $_POST["fullName"];	
  $gender = $_POST["gender"];	
  $identityNo = $_POST["identityNo"];	
  $mobile = $_POST["mobile"];	
  $landLine = $_POST["landLine"];	
  $eMail = $_POST["eMail"];	
  $birthday = empty($_POST["birthday"]) ? 'NULL' : "'".$_POST["birthday"]."'";
  $contactAddress = $_POST["contactAddress"];
  $reMark = $_POST["reMark"];

  #活動費用
  $totalAmount = intval($row["TotalAmount"]);
  #活動費用+新增租借單品費用
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
  #活動費用-刪除的租借單品費用
  for($i = 0 ; $i < count($_POST["delActRentItemDetailID"]) ; $i++){
    $delActRentItemDetailID = $_POST["delActRentItemDetailID"][$i];
    $rec_delRentItemDetail = mysql_query("SELECT * FROM ActRentItemDetail WHERE ID = '$delActRentItemDetailID'");
    $row_delRentItemDetail = mysql_fetch_assoc($rec_delRentItemDetail);
    $totalAmount = $totalAmount - intval($row_delRentItemDetail["BackupItemCost"]);
  }

  $update = "UPDATE ActivityEnrollment SET 
  TotalAmount='$totalAmount', FullName='$fullName', Gender='$gender',
  IdentityNo='$identityNo', Mobile='$mobile', LandLine='$landLine',
  EMail='$eMail', Birthday=$birthday, ContactAddress='$contactAddress', ReMark='$reMark'
  WHERE EnrollID='$enrollId' AND CustomerID = '$customerId'";	
  mysql_query($update);
  #新增同行人員
  for($i = 0 ; $i < count($_POST["companionFullName"]) ; $i++){
    $fullName_s = $_POST["companionFullName"][$i]; 
    $newIdentityNo = $_POST["companionIdentityNo"][$i];
    $gender = $_POST["companionGender"][$i]; 
    $birthday = $_POST["companionBirthday"][$i]; 
    $insert = "INSERT INTO ActivityEnrollmentDetail (EnrollID, FullName, IdentityNo, Gender, Birthday) 
    VALUES ('$enrollId', '$fullName_s', '$newIdentityNo', '$gender', '$birthday')";
    mysql_query($insert);
  }
  #刪除同行人員
  for($i = 0 ; $i < count($_POST["delEnrollDetailID"]) ; $i++){
    $delEnrollDetailID = $_POST["delEnrollDetailID"][$i];
    $delete = "DELETE FROM ActivityEnrollmentDetail WHERE EnrollDetailID = '$delEnrollDetailID' AND EnrollID = '$enrollId'";
    mysql_query($delete);
  }
  #新增租借單品
  for($i = 0 ; $i < count($_POST["rentItemSpecID"]) ; $i++){
    $rentItemSpecID = $_POST["rentItemSpecID"][$i];
    $quantity = $_POST["quantity"][$i];
    $backupItemDescription = $_POST["backupItemDescription"][$i];
    $backupItemCost = $_POST["backupItemCost"][$i];
    $insert = "INSERT INTO ActRentItemDetail (ActEnrollID, RentItemSpecID, Quantity, BackupItemDescription, BackupItemCost) VALUES ('$enrollId', '$rentItemSpecID', '$quantity', '$backupItemDescription', '$backupItemCost')";
    mysql_query($insert);
  } 
  #刪除租借單品
  for($i = 0 ; $i < count($_POST["delActRentItemDetailID"]) ; $i++){
    $delActRentItemDetailID = $_POST["delActRentItemDetailID"][$i];
    $delete = "DELETE FROM ActRentItemDetail WHERE ID = '$delActRentItemDetailID' AND ActEnrollID = '$enrollId'";
    mysql_query($delete);
  }

  header("Location: annal.php?alert=editSuccess");
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
  <style type="text/css">
    td{
        text-align: left;
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
                  <th>資格</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="colorA"><? echo $row['ActivityName']?></td>
                  <td><? echo $row['ActType'].'-'.$row['Batch']?></td>
                  <td class="UB"><? echo date("Y-m-d", strtotime($row["ActivityDateS"])).'~'.date("Y-m-d", strtotime($row["ActivityDateE"])); ?></td>
                  <td class="colorB" id="actCost"><? echo $row['TotalAmount']?>
                    <input type="hidden" id="activityCost" value="<? echo $row['Cost']?>" /> 
                  </td>
                  <td class="colorD"><? echo $row['EnrollStatusDesc']?></td>
                  <td class="UB"><? echo $row["QualificationDesc"]?></td>
                </tr>
              </tbody>
            </table>
            <hr>
            <form action="registration_e.php" method="POST">
              <div class="registrationH1">匯款帳號後五碼：
                <input type="" name="bankAcctLast5" value="<? echo $row['BankAcctLast5']?>" maxlength="5" style="height: 30px; margin-right: 10px;" placeholder="<?php if($row['Qualification'] == '0'){ echo '候補狀態請勿匯款'; }?>" <?php if($row['Qualification'] == '0'){ echo 'disabled'; } ?> oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                <?php
                if($row['Qualification'] == '1'){
                ?>
                <button type="submit" class="btn btn-success btn-lg">確定送出</button>
                <?php
                }
                ?>
              </div>
              <input type="hidden" name="enrollId" value="<?echo $enrollId?>" />
              <input type="hidden" name="action" value="updateBankAcctLast5" />
              <input type="hidden" name="actType" value="<? echo $row['ActType']?>" />
            </form>
            <div class="registrationH2"><i class="fa fa-user" aria-hidden="true"></i> 主要聯絡人資料</div>
            <form action="registration_e.php" method="POST">
              <div class="login-page">      
                <div class="registrationFORM">
                  <input name="enrollId" type="hidden" value="<? echo $enrollId; ?>"/>
                  <input name="action" type="hidden" value="update"/>
                  <input type="hidden" name="actType" value="<? echo $row['ActType']?>" />
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
                      <label for="inputEmail3" class="col-sm-4 form-control-label">備註 </label>
                      <div class="col-sm-8">
                        <input type="" class="form-control" id="inputEmail3" name="reMark" value="<? echo $row['ReMark']?>" placeholder="">
                      </div>
                    </div>
                    <?php
                    if($actType == "2"){
                    ?>
                    <div class="form-box">
                      <label class="col-sm-4 form-control-label">行前訓練課程 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                      <div class="col-sm-8">
                        <select class="form-control dropdownlist" name="session" required="required">
                          <option value="">請選擇</option>
                          <?php 
                          if(trim($row["SessionA"]) != ""){
                          ?>
                            <option value="A" <?php if($row["Session"] == "A"){ echo "selected"; }?>><?php echo $row["SessionA"] ?></option>
                          <?php 
                          } ?>
                          <?php 
                          if(trim($row["SessionB"]) != ""){
                          ?>
                            <option value="B" <?php if($row["Session"] == "B"){ echo "selected"; }?>><?php echo $row["SessionB"] ?></option>
                          <?php 
                          } ?>
                          <?php 
                          if(trim($row["SessionC"]) != ""){
                          ?>
                            <option value="C" <?php if($row["Session"] == "C"){ echo "selected"; }?>><?php echo $row["SessionC"] ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div>    
                    </div>                  
                    <?php
                    } ?>

                    <?php
                    $rec_rentItem = mysql_query("SELECT * FROM ActRentItemSetting A JOIN RentItem B ON A.RentItemID = B.ID WHERE A.ActType = '$actType' ORDER BY B.OrderNo");
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
                              <?php
                              if($row["EnrollStatus"] != "2"){
                              ?>
                                <span style="padding-left: 1em;">
                                  <i class="fa fa-plus-circle addRentItem" aria-hidden="true" style="cursor: pointer;"></i>
                                </span>
                              <?php
                              }
                              ?>
                            </td>
                          </tr>
                    <?php
                      }
                    ?>
                      </table>
                      <span>&nbsp;已租借項目</span>
                      <?php
                      $rec_actRentItemDetail = mysql_query("SELECT *,A.ID AS ActRentItemDetailID FROM ActRentItemDetail A JOIN RentItemSpec RIS ON A.RentItemSpecID = RIS.ID JOIN RentItem RI ON RIS.RentItemID = RI.ID  WHERE ActEnrollID = '$enrollId'");
                      ?>
                      <table class="table" id="rentItemTable" style="margin: 0;">
                        <tr id="tr_noRentItem">
                          <td style="border: 0;">
                            <label class='form-control-label' style='width: 40%; padding-left: 1em;'>無</label>    
                          </td>
                        </tr>
                        <?php if($rec_actRentItemDetail){
                          while($row_actRentItemDetail = mysql_fetch_assoc($rec_actRentItemDetail)){
                        ?>
                        <tr>
                          <td style='border: 0;'>
                            <label class='form-control-label' style='width: 40%; padding-left: 1em;'><?php echo $row_actRentItemDetail["ItemName"] ?>:&nbsp;<?php echo $row_actRentItemDetail["BackupItemDescription"] ?> x <?php echo $row_actRentItemDetail["Quantity"] ?>&nbsp;&nbsp;NT$ <?php echo intval($row_actRentItemDetail["Quantity"])*intval($row_actRentItemDetail["BackupItemCost"]) ?>&nbsp;</label>
                            <?php
                            if($row["EnrollStatus"] != "2"){
                            ?>
                              <span style='padding-left: 1em;'>
                                <i class='fa fa-times-circle removeRentItem' aria-hidden='true' style='cursor: pointer; color: red;''></i>
                              </span>
                            <?php
                            }
                            ?>                            
                            <input type="hidden" id="actRentItemDetailID" value="<?php echo $row_actRentItemDetail["ActRentItemDetailID"] ?>" />
                            <input type="hidden" class="itemCost" value="<?php echo intval($row_actRentItemDetail["Quantity"])*intval($row_actRentItemDetail["BackupItemCost"]) ?>" />
                        </td>
                        </tr>
                        <?php
                          }
                        }?>
                      </table>
                      <input type="hidden" name="delActRentItemDetailID[]" id="delActRentItemDetailID" value="" />
                    </div>
                    <?php  
                    } ?>

                  </div>
                </div>  
              </div>




              <?php
              if($actType == "1"){
              ?>
              <div class="registrationH3"><i class="fa fa-users" aria-hidden="true"></i> 同行人員資料</div>
              <div class="login-page">
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
                
                <div class="registrationFORM" id="companionForm">
                  <input type="hidden" name="delEnrollDetailID[]" id="delEnrollDetailID" value="" />
                  <? $index = 0; while($detailRow = mysql_fetch_assoc($RecEnrollmentDetail)) { ?>
                    <div class="col-lg-12 companion" style="margin-top: 8px; margin-bottom: 8px; border-style: dashed; border-color: gray;border-width: 2px;">
                      <input type="hidden" id="delEnrollDetailID" value="<? echo $detailRow['EnrollDetailID']?>" />
                      <i class="fa fa-times removeCompanion" aria-hidden="true" style="float: right; color: red; cursor: pointer;"></i>
                      <div class="form-box">
                        <label for="inputEmail3" class="col-sm-4 form-control-label">姓名 <i class="fa fa-star" aria-hidden="true"></i> </label>
                        <div class="col-sm-8">
                          <input type="" class="form-control" id="inputEmail3" value="<? echo $detailRow['FullName']?>" placeholder="請填寫真實姓名" required="required" readonly />
                        </div>
                      </div>
                      <div class="form-box">
                        <label for="inputEmail3" class="col-sm-4 form-control-label">性別 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                        <div class="col-sm-8">
                          <?
                          $findGender = "SELECT * FROM RefCommon WHERE Type = 'gender' ORDER BY TypeCode ASC";
                          $recGender = mysql_query($findGender);
                          ?>
                          <select class="form-control dropdownlist" id="inputEmail3" required="required" disabled>
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
                          <input type="" class="form-control" id="inputEmail3" value="<? echo $detailRow['IdentityNo']?>" placeholder=" 活動使用 - 旅遊平安險" required="required" readonly/>
                        </div>
                      </div>
                      <div class="form-box">
                        <label for="inputEmail3" class="col-sm-4 form-control-label">出生日期 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                        <div class="col-sm-8">
                          <input type="date" value="<?echo date("Y-m-d", strtotime($detailRow["Birthday"]))?>" class="form-control" required="required" readonly />
                        </div>
                      </div>
                    </div>
                <? }?>
                  <div class="form-box">
                    <div class="col-sm-8">
                      <input type="button" id="addCompanion" class="form-control" style="padding:0;" value="新增同行人員" />
                    </div>
                  </div> 
                </div>  
              </div>
              <?php
              } ?>          


              <div style="margin:10px auto;">
                <!--
                <ul class="pagination">
                  <li><a href="annal.php"><span aria-hidden="true">&laquo; 回上一頁</span></a></li>
                  <li class="active"><a href="annal.php" style="cursor: pointer;">回我的報名</a></li>
                </ul>
                -->
                <a href="annal.php"><button style="float: left; width: 30%; margin: 20px 0; padding: 10px 30px;" class="btn btn-success btn-lg"> 回我的報名</button></a>
                <input type="submit" style="float: right; width: 30%; margin: 20px 0; padding: 10px 30px;" class="btn btn-success btn-lg" value="確定修改送出"/>
                <span id="totalCostDesc" style="float: right; color: red; padding: 10px 30px;margin: 20px 0;">NT$ </span>
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
    settingRemoveItemIcon();
    $("#totalCostDesc").html("NT$ " + parseInt($("#actCost").html()));
  });
  var activityId = "<?php echo $row["ActivityID"] ?>";
  var $companionDiv = $('#companionDiv').clone();
  var addCompanion = function() {
    var $clone = $companionDiv.clone();
    $clone.css("display","");
    $clone.find(':input').attr('required', 'required');
    $clone.find('select').attr('required', 'required');
    $('#companionForm').append($clone);
  };

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
    tr += "NT$ " + quantity*backupItemCost + "&nbsp;</label>";
    tr += "   <span style='padding-left: 1em;'><i class='fa fa-times-circle removeRentItem' aria-hidden='true' style='cursor: pointer; color: red;''></i></span>";
    tr += "<input type='hidden' name='rentItemSpecID[]' value='"+rentItemSpecID+"' />";
    tr += "<input type='hidden' name='quantity[]' value='"+quantity+"' />";
    tr += "<input type='hidden' name='backupItemDescription[]' value='"+backupItemDescription+"' />";
    tr += "<input type='hidden' name='backupItemCost[]' class='itemCost' value='"+quantity*backupItemCost+"' />";
    tr += " </td>";
    tr += "</tr>";
    $("#rentItemTable").append(tr);
    settingRemoveItemIcon();
    settlement();
    showTrNoRentItem();
  });

  function settingRemoveItemIcon(){
    $(".removeRentItem").click(function(){
      var delActRentItemDetailID = $(this).parent().parent().find("#actRentItemDetailID").val();
      $("#delActRentItemDetailID").after("<input type='hidden' name='delActRentItemDetailID[]' value='"+delActRentItemDetailID+"'/>");
      $(this).closest("tr").remove();
      settlement();
      showTrNoRentItem();
    });
  }

  function settlement(){
    var actCost = parseInt($("#activityCost").val());
    var rentItemCost = 0;
    $(".itemCost").each(function(){
      rentItemCost += parseInt($(this).val());
    });
    $("#totalCostDesc").html("NT$ " + (actCost + rentItemCost));
  }
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
      var delEnrollDetailID = $(this).parent().find("#delEnrollDetailID").val();
      $("#delEnrollDetailID").after("<input type='hidden' name='delEnrollDetailID[]' value='"+delEnrollDetailID+"'/>");
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
  function showTrNoRentItem(){
    if($("#rentItemTable tr").length == 1){
      $("#tr_noRentItem").show();
    }else{
      $("#tr_noRentItem").hide();
    }
  }
</script>
