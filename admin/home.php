<?php
include('_connMysql.php');
include('check_login.php');


$query = "SELECT * FROM Aboutus";
$row=mysql_fetch_assoc(mysql_query($query));

if ($_POST["action"] == "update"){ 
	$aboutusBanner = $_POST["AboutusBanner"];	
	$aboutusBannerPath = $_POST["AboutusBannerPath"];
	$aboutusHtml = $_POST["AboutusHtml"];
	
	$update = "UPDATE Aboutus SET AboutusHtml='$aboutusHtml'";	
	//echo $update;
	mysql_query($update);
	
	echo "<script>location.href=''</script>";
	//echo "<script>parent.$.fn.colorbox.close(); </script>";	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="MainMasterHead">
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
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.advancedtable.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
    <script type="text/javascript" charset="UTF-8">		
        function pageInitial() {
			var bodyHeight = document.body.clientHeight;
			$.cleditor.defaultOptions.height = bodyHeight - 210;
			$("#HTMLEditor1").cleditor();
			//$(".Attachs").colorbox({ iframe: true, width: "800px", height: "560px", overlayClose: false, escKey: false, href: "attachsupload.php"});
            $("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 130) + "px");
			$(".Attachs").colorbox({ iframe: true, width: "800px", height: "560px", overlayClose: false, escKey: false, href: "attachsupload.php?KeyID=&Folder=aboutus&FunID=aboutus" });
        }
    </script>
</head>
<body>
        <div id="divBody" style="width:1600px; margin: 0 auto; ">
            <!-- 加上方選單 -->
            <?php include("_nav.php"); ?>
            <div style="overflow: hidden;">
                <!-- 加左方選單 -->
                <?php include("left_nav.php"); ?>
                <div id="divWork" style="float: left; width: 90%">
                    <div class="divWorkArea" align="center">
                    	<table cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                            <td height="150"><!----></td>
                          </tr>
                          <tr>
                            <td align="center">
                                <img src="images/backend_name_BIG.png" />
                            </td>
                          </tr>
                        </table>
                        <table cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                            <td height="100" colspan="3"><!----></td>
                          </tr>
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
                </div>
            </div>
        </div>
</body>
</html>
