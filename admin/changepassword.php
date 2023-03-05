<?php
include('_connMysql.php');
include('check_login.php');
$msg_Code = '0';
if(isset($_POST["action"])&&($_POST["action"]=="change_P")){
	$query_orig_Password = "SELECT * FROM  `SystemUsers` WHERE `UserID`='".$_SESSION["userID"]."'";	    
    $row_orig_Password = mysql_fetch_assoc(mysql_query($query_orig_Password)); 
	$orig_passwd = $row_orig_Password["Passwd"];
	
	if ($orig_passwd==$_POST["txtOriginalPassword"]) {
		$update_Password = "update `SystemUsers` SET Passwd = '".$_POST["txtConfirmPassword"]."' WHERE UserID = '".$_SESSION["userID"]."'";
		mysql_query($update_Password);
		$msg_Code = '2';		
	} else {	
		$msg_Code = '1';		
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1"><title>Change Password</title>
	<meta http-equiv="X-UA-Compatible" content="IE=11, IE=9, IE=8, chrome=10" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
	<link href="css/colorbox.css" type="text/css" rel="stylesheet" />
	<link href="Css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
	<script src="js/jquery-1.7.2.js" type="text/javascript"></script>
	<script src="js/ui/jquery.ui.core.js" type="text/javascript"></script>
	<script src="js/ui/jquery.ui.widget.js" type="text/javascript"></script>
	<script src="js/ui/jquery.ui.button.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.tabs.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.dialog.js" type="text/javascript"></script>
    <script src="js/jquery.colorbox.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {

        });

        function pageLoad() {
            var isAsyncPostback = Sys.WebForms.PageRequestManager.getInstance().get_isInAsyncPostBack();
            if (isAsyncPostback) {
                $(document).ready(function () {

                });
            }
        }

        function CheckPassword() {
            if ($("#txtOriginalPassword").val() == "") {
                alert("Please input your original password.");
                return false;
            }

            if ($("#txtNewPassword").val() == "") {
                alert("Please input your New password.");
                return false;
            }

            if ($("#txtConfirmPassword").val() == "") {
                alert("Please input your Confirm password.");
                return false;
            }
            if ($("#txtNewPassword").val() != $("#txtConfirmPassword").val()) {
                alert("NewPassword and ConfirmPassword is different!!please check!");
                return false;
            }
			
			if ($("#txtOriginalPassword").val() == $("#txtConfirmPassword").val()) {
                alert("OriginalPassword and ConfirmPassword is the same!!please check!");
                return false;
            }
			
			document.getElementById('form1').submit();

        }
    </script>
    <style type="text/css">
        #ToolBar
        {
            font-weight: 700;
        }
    </style>
</head>
<body>
    <form name="form1" method="post" action="changepassword.php" id="form1">
    <div id="UpdatePanel1">
    <div class="divDetailTopBar">
        <div id="ToolBar">
        <table class="TableNoLine" width="100%">
            <tr>
                <td ></td>
                <td style="width:25px">
                    <input type="image" name="ibSave" id="ibSave" title="click to save data" src="images/mountoff.png" onclick="return CheckPassword();" style="border-width:0px;" />
                </td>
                <td style="width:5px"></td>
            </tr>
        </table>
        </div>
    </div>
    <div class="divDetailBody">
        <table class="TableLine" border="1px" cellpadding="5px" width="100%"  bordercolor="#BABAD2" >
			<?php if($msg_Code == "1"){?>
					<div class="errDiv" align="center"> 原始密碼不符！</div>
			<? } ?>
			<?php if($msg_Code == "2"){?>
					<div class="errDiv" align="center"> 修改成功！</div>
			<? } ?>
            <tr>
                <td style="width:20%"><span id="Label1">原始密碼</span></td>
                <td style="width:30%"><input name="txtOriginalPassword" type="password" id="txtOriginalPassword" class="TextBox" style="width:180px;" /></td>
            </tr>
            <tr>
                <td style="width:20%"><span id="Label2">更新密碼</span></td>
                <td style="width:30%"><input name="txtNewPassword" type="password" id="txtNewPassword" class="TextBox" style="width:180px;" /></td>
            </tr>
            <tr>
                <td style="width:20%"><span id="Label3">確認密碼</span></td>
                <td style="width:30%"><input name="txtConfirmPassword" type="password" id="txtConfirmPassword" class="TextBox" style="width:180px;" />
                </td>
            </tr>
        </table>		
		<input name="action" type="hidden" id="action" value="change_P" />
    </div>
    
</div>
    </form>
</body>
</html>

    


