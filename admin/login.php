<?php
session_start();
include('_connMysql.php');
include_once("css/EricChang.css");
include_once('mycrypt.php');
$mycrypt = new mycrypt;

//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["userID"]);
	unset($_SESSION["systemUsersRoleID"]);
	unset($_SESSION["roleMenu"]);
	unset($_SESSION["all_RoleMenu"]);
}

//檢查是否經過登入，若有登入則重新導向
if (isset($_SESSION["userID"]) && $_SESSION["systemUsersRoleID"]){	
	echo "登入</br>";
    header("Location: home.php");
}

//執行會員登入
if(isset($_POST["txtAccountID"]) && $_POST["txtAccountID"] != '' && isset($_POST["txtPassword"]) && $_POST["txtPassword"] != ''){  
    //登入會員資料
	
    $query_RecLogin = "SELECT * FROM  `SystemUsers` WHERE `UserName`='".$_POST["txtAccountID"]."' AND `Passwd`='".$mycrypt->encrypt($_POST["txtPassword"])."' AND `Status` = '1'";
    $RecLogin = mysql_query($query_RecLogin);
	
    //取出帳號密碼的值
    $row_RecLogin=mysql_fetch_assoc($RecLogin); 
    $userID = $row_RecLogin["UserID"];    
    $userName = $row_RecLogin["UserName"];
	$passwd = $mycrypt->decrypt($row_RecLogin["Passwd"]);	
	$systemUsersRoleID = $row_RecLogin["SystemUsersRoleID"];
    //比對密碼，若登入成功則呈現登入狀態
    if($_POST["txtPassword"]==$passwd){  
		//取得功能權限
		$query_RoleMenu = "SELECT SystemMenuID FROM  `v_SystemUserRoleDetail` WHERE `SystemUsersRoleID`='$systemUsersRoleID' AND `MenuUrl` <> ''";
		$RecRoleMenu = mysql_query($query_RoleMenu);			
		while($row_RoleMenu=mysql_fetch_assoc($RecRoleMenu)){
			$roleMenuArray[] = $row_RoleMenu["SystemMenuID"];
		}
		//取得全部功能權限
		$query_AllRoleDetail = "SELECT * FROM `SystemMenus` where `MenuUrl` <> '' ORDER BY SortNo";
		$rec_AllRoleDetail = mysql_query($query_AllRoleDetail);
		
		while($row_AllRoleDetail=mysql_fetch_assoc($rec_AllRoleDetail)){		
			$allRoleMenuArray[$row_AllRoleDetail["MenuID"]] = $row_AllRoleDetail["MenuName"];		
		}
        //設定登入者        
        $_SESSION["userID"]=$userID; 
        $_SESSION["userName"]=$userName;      
		$_SESSION["systemUsersRoleID"]=$systemUsersRoleID;
		$_SESSION["roleMenu"]=$roleMenuArray;
		$_SESSION["all_RoleMenu"]=$allRoleMenuArray;
		
        header("Location: home.php");   
    }else{
        header("Location: login.php?errMsg=1");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="LoginHead">
    <title>城市綠洲-後台管理系統 </title>
    <meta http-equiv="X-UA-Compatible" content="IE=9, IE=8, chrome=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/logo.png" />
    <link rel="icon" type="image/ico" href="images/favicon_16x16.ico" />
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <link href="Css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
    <script src="js/jquery-1.7.2.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.core.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.button.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {

        });

        function pageLoad() {
            var isAsyncPostback = Sys.WebForms.PageRequestManager.getInstance().get_isInAsyncPostBack();
            if (isAsyncPostback) {

            }
        }
    </script>
<style type="text/css">
body {
	background-image: url(images/bg.jpg);
}
</style>
</head>
<body>
<p style="height:88"></p>
    <div class="Body">
        <div align="center">
            <div style="width: 480px;" align="left">
                <div class="BodyDiv">
                    <form name="ctl00" method="post" action="" id="ctl00">
                    <div>
                        <div id="UpdatePanel1">
                            <div align="center">
                       		  <p style="height:2"></p>
                                    <img src="images/backend_name.png" />
                                <div align="center">
                                    <p style="height:5"></p>
                                    <table>
                                        <tbody>
											<?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
									  <div class="errDiv" align="center"> 登入帳號或密碼錯誤！</div>
											<?php } ?>
                                            <tr>
                                                <td colspan="2" style="font-size: 15px; color: #454545; font-weight: bold; margin-top: 25px;" align="center">
                                                    <span class="b_14">登入帳號：</span>
                                                    <input name="txtAccountID" type="text" maxlength="250" id="txtAccountID" class="login_input"
                                                        style="width: 200px;" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="font-size: 15px; color: #454545; font-weight: bold; margin-top: 25px;" align="center">
                                                    <span class="b_14">登入密碼：</span>
                                                    <input name="txtPassword" type="password" maxlength="250" id="txtPassword" class="login_input"
                                                        style="width: 200px;" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="center">
                                                    <div style="margin-top: 30px;">
                                                        <input type="submit" name="btnLogin" value="登入" id="btnLogin" class="GreenSubmit" />
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="left">
                                                    <p style="height:20;"></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div align="center">
    <p style="height:88"></p>
    <table cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td width="49%" align="right">
            <img src="images/Carry_logo.png" alt="" width="238" height="58" border="0" />
        </td>
        <td width="2%"><!----></td>
        <td width="49%" align="left">
            <span class="b_14">■&nbsp;&nbsp;服務時間：每週一至週五 10:00 - 18:00</span>
            <br>
            <span class="b_14">■&nbsp;&nbsp;客服專線：0911-288512 (張先生)</span>
        </td>
      </tr>
    </table>
    </div>
</body>
</html>
