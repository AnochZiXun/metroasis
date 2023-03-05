<?php
include('_connMysql.php');
include('check_login.php');

$page = $_GET["page"];
$type = $_GET["type"];
$ctlName = $_GET["ctlname"];
$foreignID = $_GET["foreignid"];

if (isset($_POST["delete"])) {
	$imageId = $_POST["ImageID"];
	$deleteSql = "delete from ImagesFiles where ImageID = '$imageId'";
	mysql_query($deleteSql);
	/*
	if(file_exists('檔案名稱.jpg')){
        echo"檔案為jpeg檔" 
        unlink('檔案名稱.jpg');//將檔案刪除
    }else if(file_exists('檔案名稱.png')){
        echo"檔案為png檔" 
        unlink('檔案名稱.png');
    }else{
        echo"jpeg或png檔均不存在"
    }
    */
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
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
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
		function pageInitial(){
			$("input[type=submit], button" ).button();
        }
        
        function setDeleteID(strID){
        	
        }
	</script>
</head>
<body>

	<!--<div id="ToolBar" class="divDetailTopBar"></div>-->
	<div style="border:0px solid #CCCCCC;height:470px;overflow:auto;">
	<table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"style="border-collapse: collapse;">
        <tr>
            <th scope="col" style="width: 20%;">頁面</th>
            <th scope="col" style="width: 20%;">類型</th>
            <th scope="col" style="width: 40%;">檔名</th>
            <th scope="col" style="width: 20%;">刪除</th>
        </tr>
        <? 	$query = "SELECT * FROM ImagesFiles WHERE ForeignID = '$foreignID' AND ImageFunction = '$page' AND ImageType = '$type'";
			$RecImages = mysql_query($query);
        	while($row = mysql_fetch_assoc($RecImages)){ 
        ?>
        <tr>
            <td align="center">
                <?	switch($row["ImageFunction"])
                {
                	case "news":
                		echo "最新消息";
                		break;
                	case "products":
                		echo "商品型錄";
                		break;
                	case "knowledges":
                		echo "知識分享";
                		break;
                	case "activitys":
                		echo "活動管理";
                		break;
                	case "activityhighlight":
                		echo "活動花絮";
                		break;
					case "branch":
                		echo "門市據點";
                		break;
					case "brand":
                		echo "品牌一覽";
                		break;
                }
                ?>
            </td>
            <td align="center">
                <? echo $row["ImageType"] ?>
            </td>
            <td align="center">
                <a id="FileName" href="javascript:parent.SetMutiReturnValue('<? echo $ctlName ?>','<? echo $row["ImageFileName"] ?>'); parent.$.fn.colorbox.close();">
                    <? echo $row["ImageFileName"] ?>
                </a>
            </td>
            <td align="center">
            	<form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
	            	<input type="hidden" name="ImageID" id="ImageID" value="<? echo $row["ImageID"] ?>"/>
	            	<input type="hidden" name="page" id="page" value="<? echo $page ?>"/>
	            	<input type="hidden" name="type" id="type" value="<? echo $type ?>"/>
	            	<input type="hidden" name="ctlname" id="ctlname" value="<? echo $ctlName ?>"/>
	            	<input type="hidden" name="foreignid" id="foreignid" value="<? echo $foreignID ?>"/>
	                <input name="delete" type="submit" value="刪除" onclick="if (!confirm('確認刪除此筆資料?')) return false;">
                </form>
            </td>
        </tr>
        <? } ?>
    </table>
	</div>

</body>
</html>