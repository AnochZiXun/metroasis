<?php
include_once("_connMysql.php");
include_once("check_login.php");
include_once('mycrypt.php');
$mycrypt = new mycrypt;
$currentUserID = $_SESSION["userID"];
$states_Def = "ON";
if (isset($_GET["userID"])) {
	$userID = $_GET["userID"];
	$states_Def ="OFF";
} 
$mode="修改帳號";
if ($userID == ""){	
	$insert = "INSERT INTO `SystemUsers`(`NewFlag`,`CreateUserID`) VALUES (1,'$currentUserID')";				
	mysql_query($insert);
	$userID = mysql_insert_id();
	$mode = "新增帳號";	
}
if ($_POST["action"] == "update"){
    $systemusersrole = $_POST["SystemUsersRole"];
    $adminRoleLevel = '1';
    $rec_adminCheck = mysql_query("SELECT * FROM SystemUsers a JOIN SystemUsersRoles b on a.SystemUsersRoleID = b.SystemUsersRoleID WHERE b.RoleLevel = '$adminRoleLevel' AND a.UserID != '$userID'");#理應只有一人
    $count_adminCheck = $rec_adminCheck ? mysql_num_rows($rec_adminCheck) : 0 ;
    $adminRoleId = "";
    $rec_adminRoleId = mysql_query("SELECT SystemUsersRoleID FROM SystemUsersRoles WHERE RoleLevel = '$adminRoleLevel' LIMIT 1 ");#理應只有一筆
    if($rec_adminRoleId){
        while($row_adminRoleId = mysql_fetch_assoc($rec_adminRoleId)){
            $adminRoleId = $row_adminRoleId["SystemUsersRoleID"];
        }
    }
    if($count_adminCheck > 0 && $systemusersrole == $adminRoleId){
        echo "<script>alert('系統管理員是神聖且唯一的!  您慢了一步!');</script>";
    }else{
        $userID = $_POST["userID"]; 
        $userName = $_POST["UserName"];
        $passwd = $mycrypt->encrypt($_POST["Passwd"]);
        $email = $_POST["Email"];
        $status = $_POST["Status"];
        $systemusersrole = $_POST["SystemUsersRole"];
        $update = "UPDATE `SystemUsers` SET `UserName`='$userName',`Passwd`='$passwd',`Email`='$email',`Status`='$status',`SystemUsersRoleID`='$systemusersrole',`NewFlag` = 0 WHERE userID='$userID'";     
        mysql_query($update);
        echo "<script>parent.location.href='systemusers.php'; </script>";
    }
}
$query = "SELECT * FROM `SystemUsers` where userID = '$userID'";
$RecNews = mysql_query($query);
$row=mysql_fetch_assoc($RecNews);
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
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
    <script type="text/javascript" charset="UTF-8" src="js/strength.js"></script>
    <script type="text/javascript" charset="UTF-8">
        function pageInitial() {
            var bodyHeight = document.body.clientHeight;
            //$("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 50) + "px");
            
            $("#txtBeginDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true });
            $("#txtEndDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true });
            $("input[type=submit], input[type=button]" ).button();

            $('#Passwd').strength({
                strengthClass: 'strength',
                strengthMeterClass: 'strength_meter',
                strengthButtonClass: 'button_strength',
                strengthButtonText: '<i class="fa fa-eye" aria-hidden="true" style="padding-left: 5px; font-size: 14px; color: black"></i>',
                strengthButtonTextToggle: '<i class="fa fa-eye-slash" aria-hidden="true" style="padding-left: 5px; font-size: 14px; color: black"></i>'
            });
        }
        $(document).ready(function(){
            $('input[type="text"][data-password="Passwd"]').val($('#Passwd').val()); 
        });

        function beforeSubmit(){
            showLoading();
            var textFields = ["UserName","Passwd","Email"];
            var textNames = ["帳號","密碼","E-mail",];
            for (var i = 0; i < textFields.length; i++) {
                //console.log(textFields[i]+'='+$("#"+textFields[i]).val());
                var txt = document.getElementById(textFields[i]);
                if (txt.value==""){
                    alert("「"+textNames[i] + "」為必填欄位!");
                    txt.focus();
                    stopLoading();
                    return false;
                }
            }

            var usernameDuplicateCheck = false;
            var emailDuplicateCheck = false;

            $.ajax({
                url: "service_common.php?action=simpleDuplicateCheck&table=SystemUsers&column=UserName&value="+$("#UserName").val()+"&idColumn=UserID&id=<?echo $userID?>",
                type: 'GET',
                dataType: "json",
                async: false,
                success: function(result) {
                    if (result){ 
                        usernameDuplicateCheck = true;
                    }else{
                        usernameDuplicateCheck = false;
                    }
                }, error: function(xhr) {
                    alert("STATUS:"+xhr.status);
                    usernameDuplicateCheck = false
                } 
            });

            if(!usernameDuplicateCheck) {alert("此帳號已存在!"); stopLoading(); return false;}

            $.ajax({
                url: "service_common.php?action=simpleDuplicateCheck&table=SystemUsers&column=Email&value="+$("#Email").val()+"&idColumn=UserID&id=<?echo $userID?>",
                type: 'GET',
                dataType: "json",
                async: false,
                success: function(result) {
                    if (result){ 
                        emailDuplicateCheck = true;
                    }else{
                        emailDuplicateCheck = false;
                    }
                }, error: function(xhr) {
                    alert("STATUS:"+xhr.status);
                    emailDuplicateCheck = false
                } 
            });

            if(!emailDuplicateCheck) {alert("此Email已存在!"); stopLoading(); return false;}
        }

    </script>
    <style type="text/css">

    </style>
</head>
<body>
    <form name="form1" method="post" action="" id="form1" enctype="multipart/form-data">
    <div>
        <div id="UpdatePanel1">
            <div class="divDetailTopBar">
                <div id="ToolBar">
                    <div style="float: left;">
                        <span id="LabMessage" class="labMessage"><?echo "【". $mode ."】" . $row["ShortTitle"]?></span>
                    </div>
                </div>
            </div>
            <div id="divDetailBody" class="divDetailBody">
            	<div style="height:20px;"></div>
                <table class="TableLine" border="1px" cellpadding="5px" width="60%" bordercolor="#BABAD2" align="center">
                    <tr>
               	  		<td width="8%" style="height:36px;" align="center" bgcolor="#e5e5e5">
                            <span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 狀態</span></span>
                        </td>
                  		<td width="10%" align="center" bgcolor="#ffffff">
                            <table id="rblStatus" class="RadioButtonList" border="0" style="width: 120px;">
                                <tr>
                                    <td>
                                        <input id="State_1" type="radio" name="Status" value="1" <?php if ($states_Def == "ON" || $row["Status"] == "1") {echo "checked";}?>/>
										<label for="rblStatus_1">開啟</label>
                                    </td>
                                    <td>
                                        <input id="State_0" type="radio" name="Status" value="0"  <?php if ($row["Status"] == "0") {echo "checked";}?> />
										<label for="rblStatus_0">關閉</label>
                                    </td>
                                </tr>
                            </table>
                        </td>
                  		<td width="8%" align="center" bgcolor="#e5e5e5">
                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 帳號</span></span>
                        </td>    
                  		<td width="13%" align="center" bgcolor="#ffffff">
                            <input name="UserName" type="text" id="UserName" class="TextBox" style="width: 90%;" value="<?echo $row["UserName"]?>"/>
                        </td>
				 		 <td width="8%" align="center" bgcolor="#e5e5e5">
                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 密碼</span></span>
                        </td>    
                        <td width="17%" align="center" bgcolor="#ffffff" style="height: 45px">
                            <input name="Passwd" type="password" id="Passwd" class="TextBox" style="width: 60%;" value="<?echo $row["Passwd"] != NULL ? $mycrypt->decrypt($row["Passwd"]) : $row["Passwd"] ?>"/>
                        </td>
                    </tr>
                    <tr>
				 		<td style="height:36px;" align="center" bgcolor="#e5e5e5">
                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 角色</span></span>
                        </td>    
                  		<td align="center" bgcolor="#ffffff">
							<?php 
									$query_Roles = "SELECT * FROM `SystemUsersRoles` WHERE SystemUsersRoleID NOT IN (SELECT b.SystemUsersRoleID FROM SystemUsers a join SystemUsersRoles b ON a.SystemUsersRoleID = b.SystemUsersRoleID WHERE RoleLevel = '1' AND a.UserID != '$userID')";
									$RecRoles = mysql_query($query_Roles);
							 ?>
							<select name="SystemUsersRole" id="SystemUsersRole" class="dropdownlist">
							<?php while($row_Roles=mysql_fetch_assoc($RecRoles)){ ?>
								<option value="<?echo $row_Roles["SystemUsersRoleID"]?>" <?php if ($row_Roles["SystemUsersRoleID"] == $row["SystemUsersRoleID"]) { echo "selected";}?>>
											<?echo $row_Roles["SystemUsersRoleName"]?>
								</option>
							 <? } ?>
							</select>
                        </td>
                        <td align="center" bgcolor="#e5e5e5">
                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* E-mail</span></span>
                        </td>    
                  		<td colspan="3" align="center" bgcolor="#ffffff">
                            <input name="Email" type="text" id="Email" class="TextBox" style="width: 96%;" value="<?echo $row["Email"]?>"/>
                        </td>
                    </tr>
                </table>
                <div style="width:100%; text-align:center">
                	<p style="height:20px;"></p>
   		      		<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit();" style="font-size:12pt; height:35px" class="ui-button ui-widget ui-state-default ui-corner-all ui-state-hover" />
            		<input type="hidden" name="userID" value="<? echo $userID?>"/>
            		<input type="hidden" name="action" value="update"/>
                    <p style="height:20px;"></p>
            	</div>
            </div>
        </div>
        <br/>
    </form>
</body>
</html>
