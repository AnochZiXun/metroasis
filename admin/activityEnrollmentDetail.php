<?php
include('_connMysql.php');
include('check_login.php');

$enrollId = $_GET["enrollId"];

$mode="新增同行人員";
if (isset($_GET["enrollDetailId"])) {
    $mode = "修改";
    $enrollDetailId = $_GET["enrollDetailId"];
    $query = "SELECT * FROM ActivityEnrollmentDetail where EnrollDetailID = '$enrollDetailId'";
    $RecEnrollmentDetail = mysql_query($query);
    $enrollmentDetailRow=mysql_fetch_assoc($RecEnrollmentDetail);
}

if ($_POST["action"] == "update"){ 
    $enrollDetailId = $_POST["enrollDetailId"];
    $oldIdentityNo = $_POST["oldIdentityNo"];
    $newIdentityNo = $_POST["newIdentityNo"];
    $fullName = $_POST["fullName"];	
    $gender = $_POST["gender"];	
    $birthday = empty($_POST["birthday"]) ? 'NULL' : "'".$_POST["birthday"]."'";

	$update = "UPDATE ActivityEnrollmentDetail SET 
				FullName='$fullName', Gender='$gender', IdentityNo='$newIdentityNo', Birthday=$birthday 
                WHERE EnrollDetailID='$enrollDetailId'";
	mysql_query($update);
	
	echo "<script>parent.$.fn.colorbox.close(); </script>";	
}

if ($_POST["action"] == "add"){ 
	$enrollId = $_POST["enrollId"];
    $newIdentityNo = $_POST["newIdentityNo"];
    $fullName = $_POST["fullName"];	
    $gender = $_POST["gender"];	
    $birthday = empty($_POST["birthday"]) ? 'NULL' : "'".$_POST["birthday"]."'";
		
	$insert = "INSERT INTO ActivityEnrollmentDetail (EnrollID, FullName, IdentityNo, Gender, Birthday) 
				VALUES ('$enrollId', '$fullName', '$newIdentityNo', '$gender', $birthday)";
	mysql_query($insert);
	
	echo "<script>parent.$.fn.colorbox.close(); </script>";	
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
            $("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 50) + "px");
            $.cleditor.defaultOptions.height = bodyHeight - 270;
        }
    </script>
</head>
<body>
    <form name="form1" method="post" action="activityEnrollmentDetail.php" id="form1">
    <div>
        <div id="UpdatePanel1">
            <div class="divDetailTopBar">
                <div id="ToolBar">
                    <div style="float: left; padding-right: 10px">
                        <div style="float: left; padding-right: 10px">
                            <span id="LabMessage" class="labMessage"><?echo "【". $mode ."】" . $enrollmentDetailRow["FullName"]?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="divDetailBody" class="divDetailBody">
                <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                    <tr>
                        <td style="width: 10%" align="center">
                            <span class="DetailLabel">姓名</span>
                        </td>
                        <td>
                            <input name="fullName" type="text" class="TextBox" style="width: 90%;" value="<?echo $enrollmentDetailRow["FullName"]?>"/>
                        </td>
                        <td style="width: 10%" align="center">
                            <span class="DetailLabel">身份證號碼</span>
                        </td>
                        <td>
                            <input name="newIdentityNo" type="text" class="TextBox" style="width: 90%;" value="<?echo $enrollmentDetailRow["IdentityNo"]?>"/>
                        </td>
                        <td style="width: 10%" align="center">
                            <span class="DetailLabel">性別</span>
                        </td>
                        <td>
							<?
								$findGender = "SELECT * FROM RefCommon WHERE Type = 'gender' ORDER BY TypeCode ASC";
								$recGender = mysql_query($findGender);
							?>
							<select name="gender" class="dropdownlist">
							<? while($rowGender = mysql_fetch_assoc($recGender)){ ?>
								<?if ($rowGender["TypeCode"] == $enrollmentDetailRow["Gender"]) { ?>
									<option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>" selected><?echo $rowGender["CodeName"] ?></option>
								<? } else {?>
									<option value="<? echo $rowGender["TypeCode"] ?>" id="<? echo $rowGender["TypeCode"] ?>"><?echo $rowGender["CodeName"] ?></option>
								<? } ?>
							<? } ?>
							</select>
                        </td>
                        <td style="width: 10%" align="center">
                            <span class="DetailLabel">出生日期</span>
                        </td>
                        <td>
                            <input name="birthday" type="date" class="TextBox" style="width: 95%;" value="<? echo isset($enrollmentDetailRow["Birthday"]) ? date("Y-m-d", strtotime($enrollmentDetailRow["Birthday"])) : date("Y-m-d")?>"/>
                        </td>
                    </tr>
                </table>
                <div style="width:100%; text-align:center">
                    <? if (isset($_GET["enrollDetailId"])) {?>
						<p style="height:20px;"></p>
                        <input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="showLoading();" style="font-size:12pt; height:35px" />
						<input type="hidden" name="enrollDetailId" id="enrollDetailId" value="<? echo $enrollDetailId?>"/>
                        <input type="hidden" name="oldIdentityNo" id="oldIdentityNo" value="<? echo $identityNo?>"/>
						<input type="hidden" name="action" value="update"/>	
                        <p style="height:20px;"></p>
                    <? } else { ?>
						<p style="height:20px;"></p>
                        <input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="showLoading();" style="font-size:12pt; height:35px" />
                        <input type="hidden" name="enrollId" id="enrollId" value="<? echo $enrollId?>"/>
						<input type="hidden" name="action" value="add"/>	
                        <p style="height:20px;"></p>	
                    <? } ?>
                </div>
            </div>
        </div>
    </form>
</body>
</html>