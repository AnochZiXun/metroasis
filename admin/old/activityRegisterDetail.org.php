<?php
include('_connMysql.php');
include('check_login.php');

$currentUserID = $_SESSION["userID"];

if (isset($_GET["enrollId"])) {
	$enrollId = $_GET["enrollId"];
}

if (isset($_POST["enrollId"])) {
	$enrollId = $_POST["enrollId"];
}

$mode="修改";
if ($enrollId == ""){
	$createUserID = $currentUserID;
	$updateUserID = $currentUserID;
	$insert_sql = "INSERT INTO ActivityEnrollment(CreateUserID,UpdateUserID) VALUES ('$updateUserID','$updateUserID')";
	mysql_query($insert_sql);
	$enrollId = mysql_insert_id();
	$mode = "新增活動報名";
}

$query = "SELECT * FROM ActivityEnrollment where EnrollID = '$enrollId'";
$RecEnrollment = mysql_query($query);
$enrollmentRow=mysql_fetch_assoc($RecEnrollment);

$query = "SELECT * FROM ActivityEnrollmentDetail where EnrollID = '$enrollId' ORDER BY EnrollDetailID ASC";
$RecEnrollmentDetail = mysql_query($query);

$sql = "SELECT ListSubject FROM Activitys WHERE ActivityID=".$enrollmentRow["ActivityID"];
$activityRec = mysql_query($sql);
$listSubject = mysql_fetch_assoc($activityRec)['ListSubject'];

if ($_POST["action"] == "update"){ 
    // 活動報名
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
    $totalAmount = '' == $_POST["totalAmount"] ? 0 : $_POST["totalAmount"];
    $bankAcctLast5 = $_POST["bankAcctLast5"];
    $customerId = '' == $_POST["customerId"] ? 0 : $_POST["customerId"];
    $enrollStatus = '' == $_POST["enrollStatus"] ? 0 : $_POST["enrollStatus"];
    $reMark = $_POST["reMark"];
    $updateUserId = $_POST["UpdateUserID"];
    $updateDate = date("Y-m-d H:i:s"); 
		
	$update = "UPDATE ActivityEnrollment SET 
				EnrollID = '$enrollId', Echelon='$echelon', FullName='$fullName', Gender='$gender',
				IdentityNo='$identityNo', Mobile='$mobile', LandLine='$landLine',
				EMail='$eMail', Birthday=$birthday, ContactAddress='$contactAddress', TentID='$tentId',
                TotalAmount='$totalAmount', BankAcctLast5='$bankAcctLast5', CustomerId='$customerId', EnrollStatus='$enrollStatus',
                ReMark='$reMark', UpdateUserID='$updateUserId', UpdateDate = '$updateDate' 
				WHERE EnrollID='$enrollId'";	
	mysql_query($update);

    // 同行人員
    $tempSql = "";
    $enrollId = $_POST["enrollId"];
    $sIdentityNo = $_POST["sIdentityNo"];
    $sFullName = $_POST["sFullName"];	
    $sGender = $_POST["sGender"];	
    $sBirthday = $_POST["sBirthday"];
		
	$insertEnrollmentDetailSql = "INSERT INTO ActivityEnrollmentDetail (EnrollID, FullName, IdentityNo, Gender, Birthday) VALUES ";
    
    if (!empty($sIdentityNo)){
		foreach($sIdentityNo as $key => $sIdentityNo) {
            $birth = empty($sBirthday[$key]) ? 'NULL' : "'".$sBirthday[$key]."'";
		    if ($tempSql == ""){
		        $tempSql .= "('$enrollId', '$sFullName[$key]', '$sIdentityNo', '$sGender[$key]', $birth)";
		    }else{
		        $tempSql .= ",('$enrollId', '$sFullName[$key]', '$sIdentityNo', '$sGender[$key]', $birth)";
		    }
	    }
	}

    if ($tempSql != ""){
    	$enrollId = $_POST["enrollId"];
        $deleteSql = "delete from ActivityEnrollmentDetail where EnrollID = '$enrollId'";
        mysql_query($deleteSql);
		
	    $insertEnrollmentDetailSql = $insertEnrollmentDetailSql . $tempSql . ";";
	    mysql_query($insertEnrollmentDetailSql);
    }
	
	echo "<script>parent.location.href='activityregister.php'; </script>";	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>城市綠洲-後台管理系統</title>
    <meta http-equiv="X-UA-Compatible" content="IE=11, IE=9, IE=8, chrome=10" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="icon" type="image/ico" href="images/favicon_16x16.ico" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link href="css/colorbox.css" type="text/css" rel="stylesheet" />
    <link href="css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
    <link href="css/jquery.cleditor.css" type="text/css" rel="stylesheet" />
    <link href="css/jquery.treeview.css" rel="stylesheet" />
    <link href="css/flexslider.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" charset="UTF-8" src="js/jquery-1.7.2.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.button.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.datepicker.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.tabs.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.progressbar.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.accordion.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.colorbox.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/fullcalendar.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.maskedinput-1.3.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.blockUI.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.treeview.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" charset="UTF-8">
        function pageInitial() {
            var bodyHeight = document.body.clientHeight;
            $("#divWork").attr("style", "float: left; width: 90%;");
			$("input[type=submit], input[type=button]" ).button();
        }

        function delEnrollmentDetail(row) {
            $(row).closest('tr').remove();
        }

        function addEnrollmentDetail() {
            var $enrollmentBetailTable = $('#enrollmentBetailTable');
            var limit = checkCompanionCount();
            var index = $enrollmentBetailTable.find('tr').length - 1;
            if(limit && (index >= limit)) {
                alert('此活動同行人員上限為'+limit+'人');
                return;
            }
            $enrollmentBetailTable.append('<tr><td colspan="1" align="center"><input class="TextBox sFullName" name="sFullName[]" type="text" /></td><td colspan="1" align="center"><input class="TextBox sIdentityNo" name="sIdentityNo[]" type="text" /></td><td colspan="1" align="center"><select name="sGender[]" class="TextBox dropdownlist sGender"><option value="1" selected>男</option><option value="2" >女</option></select></td><td colspan="2" align="center"><input class="TextBox sBirthday" name="sBirthday[]" type="date" /></td><td colspan="2" align="center"><input type="button" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false" value="刪除" onClick="delEnrollmentDetail(this);" /></td></tr>');
        };

        var checkCompanionCount = function() {
            var result;
            $.ajax({ 
                url: '../checkCompanionLimit.php',
                type: 'POST',
                async: false,
                data: {
                    activityId: $('#activityId').val()
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

        var beforeSubmit = function() {
            showLoading();
            if(!$('input[name=fullName]').val()) {
                alert("「姓名」為必填欄位!");
				$("input[name=fullName").focus();
				stopLoading();
				return false;
            }

            if(!$('select[name=gender]').val()) {
                alert("「性別」為必填欄位!");
				$("select[name=gender").focus();
				stopLoading();
				return false;
            }

            if(!$('input[name=mobile]').val()) {
                alert("「行動電話」為必填欄位!");
				$("input[name=mobile").focus();
				stopLoading();
				return false;
            }

            if(!$('input[name=eMail]').val()) {
                alert("「電子郵件」為必填欄位!");
				$("input[name=eMail").focus();
				stopLoading();
				return false;
            }

            var flag = true;
            $('.sFullName').each(function() {
                if(!$(this).val()) {
                    alert("「姓名」為必填欄位!");
                    $(this).focus();
                    stopLoading();
                    return flag = false;
                }
            });
            if(!flag) {return false;}

            $('.sIdentityNo').each(function() {
                if(!$(this).val()) {
                    alert("「身份證號碼」為必填欄位!");
                    $(this).focus();
                    stopLoading();
                    return flag = false;
                }
            });
            if(!flag) {return false;}

            $('.sGender').each(function() {
                if(!$(this).val()) {
                    alert("「性別」為必填欄位!");
                    $(this).focus();
                    stopLoading();
                    return flag = false;
                }
            });
            if(!flag) {return false;}

            $('.sBirthday').each(function() {
                if(!$(this).val()) {
                    alert("「生日」為必填欄位!");
                    $(this).focus();
                    stopLoading();
                    return flag = false;
                }
            });
            if(!flag) {return false;}

            return true;
        }
    </script>
</head>
<body>
    <div id="UpdatePanel1">
        <form name="form1" method="post" action="activityRegisterDetail.php" id="form1">
        <div class="divDetailTopBar">
            <div id="ToolBar">
                <div style="float: left; padding-right: 10px">
                    <span id="LabMessage" class="labMessage"><?echo "【". $mode ."】" . $listSubject . ' ' . $enrollmentRow["FullName"]?></span>
                </div>
            </div>
            <input type="hidden" name="enrollId" id="enrollId" value="<? echo $enrollId?>"/>
            <input type="hidden" name="activityId" id="activityId" value="<? echo $enrollmentRow["ActivityID"]?>"/>
             
        </div>
        <div id="divDetailBody" class="divDetailBody">
            <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                <tr>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">活動名稱</span>
                    </td>
                    <td align="left" bgcolor="#ffffff">
                        <? echo $listSubject ?>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">梯次</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="echelon" type="number" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["Echelon"]?>"/>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel"><span class="Mandatory">* 姓名</span></span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="fullName" type="text" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["FullName"]?>"/>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel"><span class="Mandatory">* 性別</span></span>
                    </td>
                    <td bgcolor="#ffffff">
                        <?
                            $findGender = "SELECT * FROM RefCommon WHERE Type = 'gender'";
                            $recGender = mysql_query($findGender);
                        ?>
                        <select name="gender" class="dropdownlist">
                        <? while($rowGender = mysql_fetch_assoc($recGender)){ ?>
                            <?if ($rowGender["TypeCode"] == $enrollmentRow["Gender"]) { ?>
                                <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>" selected><?echo $rowGender["CodeName"] ?></option>
                            <? } else {?>
                                <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>"><?echo $rowGender["CodeName"] ?></option>
                            <? } ?>
                        <? } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">身分證</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="identityNo" type="text" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["IdentityNo"]?>"/>
                    </td>
                    <td style="width: 10%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel"><span class="Mandatory">* 行動電話</span></span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="mobile" type="text" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["Mobile"]?>"/>
                    </td>
                    <td style="width: 10%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">室內電話</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="landLine" type="text" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["LandLine"]?>"/>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel"><span class="Mandatory">* 電子郵件</span></span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="eMail" type="text" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["EMail"]?>"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">出生日期</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="birthday" type="date" class="TextBox" style="width: 90%;" value="<?echo date("Y-m-d", strtotime($enrollmentRow["Birthday"]))?>"/>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">帳蓬</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="tentId" type="number" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["TentID"]?>"/>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">活動費用</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="totalAmount" type="number" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["TotalAmount"]?>"/>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">匯款帳號後5碼</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="bankAcctLast5" type="text" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["BankAcctLast5"]?>"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">驗證碼</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="verifyCode" type="text" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["VerifyCode"]?>"/>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">客戶編號</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <input name="customerId" type="number" class="TextBox" style="width: 90%;" value="<?echo $enrollmentRow["CustomerID"]?>"/>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">報名狀態</span>
                    </td>
                    <td colspan="3" bgcolor="#ffffff">
                        <?
                            $findEnrollStatus = "SELECT * FROM RefCommon WHERE Type = 'enrollStatus'";
                            $recEnrollStatus = mysql_query($findEnrollStatus);
                        ?>
                        <select name="enrollStatus" class="dropdownlist">
                        <? while($rowEnrollment = mysql_fetch_assoc($recEnrollStatus)){ ?>
                            <?if ($rowEnrollment["TypeCode"] == $enrollmentRow["EnrollStatus"]) { ?>
                                <option value="<? echo $rowEnrollment["TypeCode"] ?>" id="<? echo $rowEnrollment["TypeCode"] ?>" selected><?echo $rowEnrollment["CodeName"] ?></option>
                            <? } else {?>
                                <option value="<? echo $rowEnrollment["TypeCode"] ?>" id="<? echo $rowEnrollment["TypeCode"] ?>"><?echo $rowEnrollment["CodeName"] ?></option>
                            <? } ?>
                        <? } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">連絡地址</span>
                    </td>
                    <td colspan="3" bgcolor="#ffffff">
                        <input name="contactAddress" type="text" class="TextBox" style="width: 96.7%;" value="<?echo $enrollmentRow["ContactAddress"]?>"/>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">注意事項</span>
                    </td>
                    <td colspan="3" bgcolor="#ffffff">
                        <input name="reMark" type="text" class="TextBox" style="width: 96.7%;" value="<?echo $enrollmentRow["ReMark"]?>"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span class="DetailLabel">同行人員</span>
                    </td>
                    <td colspan="7" bgcolor="#ffffff">
                        <div style="float: left;padding-top: 4px; padding-bottom: 6px;">
                            <input type="button" name="ibAdd" id="addEnrollmentDetailBtn" value=" 新增同行人員 " onClick="addEnrollmentDetail();" />
                        </div>
                        <table id="enrollmentBetailTable" class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView" style="border-collapse: collapse;">
                            <tr>
                                </td>
                                <th colspan="1">
                                    <span class="Mandatory">* 姓名</span>
                                </th>
                                <th colspan="1">
                                    <span class="Mandatory">* 身份證號碼</span>
                                </th>
                                <th colspan="1">
                                    <span class="Mandatory">* 性別</span>
                                </th>
                                <th colspan="2">
                                    <span class="Mandatory">* 生日</span>
                                </th>
                                <th colspan="2">
                                    功能
                                </th>
                            </tr>
                            <?
                                if(mysql_num_rows($RecEnrollmentDetail) == 0) {
                            ?>
                                <tr>
                                    <td colspan="1" align="center">
                                        <input class="TextBox sFullName" name="sFullName[]" type="text" />
                                    </td>
                                    <td colspan="1" align="center">
                                        <input class="TextBox sIdentityNo" name="sIdentityNo[]" type="text" />
                                    </td>
                                    <td colspan="1" align="center">
                                        <?
                                            $findGender = "SELECT * FROM RefCommon WHERE Type = 'gender' ORDER BY TypeCode ASC";
                                            $recGender = mysql_query($findGender);
                                        ?>
                                        <select name="sGender[]" class="TextBox dropdownlist sGender">
                                            <? while($rowGender = mysql_fetch_assoc($recGender)){ ?>
                                                <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>"><?echo $rowGender["CodeName"] ?></option>
                                            <? } ?>
                                        </select>
                                    </td>
                                    <td colspan="2" align="center">
                                        <input class="TextBox sBirthday" name="sBirthday[]" type="date" />
                                    </td>
                                    <td colspan="2" align="center">
                                        <input type="button" value="刪除" onClick="delEnrollmentDetail(this);" />
                                    </td>
                                </tr>
                            <?
                                } else {
                            ?>
                            <? $rowNumber=1;while($enrollmentDetailRow = mysql_fetch_assoc($RecEnrollmentDetail)){ ?>
                            <tr>
                                <td colspan="1" align="center">
                                    <input class="TextBox sFullName" name="sFullName[]" type="text" value="<? echo $enrollmentDetailRow["FullName"];?>" />
                                </td>
                                <td colspan="1" align="center">
                                    <input class="TextBox sIdentityNo" name="sIdentityNo[]" type="text" value="<? echo $enrollmentDetailRow["IdentityNo"];?>" />
                                </td>
                                <td colspan="1" align="center">
                                    <?
                                        $findGender = "SELECT * FROM RefCommon WHERE Type = 'gender' ORDER BY TypeCode ASC";
                                        $recGender = mysql_query($findGender);
                                    ?>
                                    <select name="sGender[]" class="TextBox dropdownlist sGender">
                                    <? while($rowGender = mysql_fetch_assoc($recGender)){ ?>
                                        <?if ($rowGender["TypeCode"] == $enrollmentDetailRow["Gender"]) { ?>
                                            <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>" selected><?echo $rowGender["CodeName"] ?></option>
                                        <? } else {?>
                                            <option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>"><?echo $rowGender["CodeName"] ?></option>
                                        <? } ?>
                                    <? } ?>
                                    </select>
                                </td>
                                <td colspan="2" align="center">
                                    <input class="TextBox sBirthday" name="sBirthday[]" type="date" value="<? echo $enrollmentDetailRow["Birthday"];?>" />
                                </td>
                                <td colspan="2" align="center">
                                    <input type="button" value="刪除" onClick="delEnrollmentDetail(this);" />
                                </td>
                            </tr>
                            <? 
                                    $rowNumber = $rowNumber +1;} 
                                }
                            ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%" align="center" bgcolor="#e5e5e5">
                        <span id="labMemberCode" class="DetailLabel">建立人員</span>
                    </td>
                    <?
                        $c_findUser = "select UserName from SystemUsers where UserID = '".$enrollmentRow["CreateUserID"]."'";
                        $c_record = mysql_query($c_findUser);
                        $c_result = mysql_fetch_assoc($c_record)
                    ?>
                    <td bgcolor="#ffffff">
                        <? if (empty($enrollmentRow["CreateUserID"])) {
                            $c_findUser = "select UserName from SystemUsers where UserID = '".$_SESSION["userID"]."'";
                            $c_record = mysql_query($c_findUser);
                            $c_result = mysql_fetch_assoc($c_record);?>
                        <? echo $c_result["UserName"]?>
                        <input type="hidden" name="CreateUserID" id="createUserID" value="<? echo $_SESSION["userID"]?>"/>
                        <? } else {
                            $c_findUser = "select UserName from SystemUsers where UserID = '".$enrollmentRow["CreateUserID"]."'";
                            $c_record = mysql_query($c_findUser);
                            $c_result = mysql_fetch_assoc($c_record);?>
                        <? echo $c_result["UserName"]?>
                        <? } ?>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span id="Label3" class="DetailLabel">建立日期</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <?
                            if (empty($enrollmentRow["CreateDate"])) {
                                echo date("Y-m-d H:i:s");
                            } else {
                                echo $enrollmentRow["CreateDate"];
                            }
                        ?>
                    </td>
                    <td style="width: 5%" align="center" bgcolor="#e5e5e5">
                        <span id="Label3" class="DetailLabel">異動人員</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <? if (empty($enrollmentRow["UpdateUserID"])) {
                            $u_findUser = "select UserName from SystemUsers where UserID = '".$_SESSION["userID"]."'";
                            $u_record = mysql_query($u_findUser);
                            $u_result = mysql_fetch_assoc($u_record);?>
                        <input type="hidden" name="UpdateUserID" id="UpdateUserID" value="<? echo $_SESSION["userID"]?>"/>
                        <? } else {
                            $u_findUser = "select UserName from SystemUsers where UserID = '".$enrollmentRow["UpdateUserID"]."'";
                            $u_record = mysql_query($u_findUser);
                            $u_result = mysql_fetch_assoc($u_record);?>
                        <? echo $u_result["UserName"]?>
                        <input type="hidden" name="UpdateUserID" id="UpdateUserID" value="<? echo $_SESSION["userID"]?>"/>
                        <? } ?>
                    </td>
                    <td style="width: 10%" align="center" bgcolor="#e5e5e5">
                        <span id="labMemberCode" class="DetailLabel">異動日期</span>
                    </td>
                    <td bgcolor="#ffffff">
                        <? if (empty($enrollmentRow["UpdateDate"])) { ?>
                        <? } else { ?>
                        <?echo $enrollmentRow["UpdateDate"]?>
                        <? } ?>
                    </td>
                </tr>
            </table>
            <div style="width:100%; text-align:center">
                <p style="height:20px;"></p>
                <input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit();" style="font-size:12pt; height:35px" />
                <input type="hidden" name="enrollId" value="<? echo $enrollId?>"/>
                <input type="hidden" name="action" value="update"/>
                <p style="height:20px;"></p>
            </div>
        </div>
        </form>
    </div>
</body>
</html>