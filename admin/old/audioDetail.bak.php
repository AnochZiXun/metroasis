<?php
include('_connMysql.php');
include('check_login.php');

if (isset($_GET["audioId"])) {
	$audioId = $_GET["audioId"];
} 

$query = "SELECT * FROM Audio where AudioID = '$audioId'";
$RecAudio = mysql_query($query);
$row=mysql_fetch_assoc($RecAudio);

if ($_POST["action"] == "update"){ 
	$audioId = $_POST["AudioId"];	
	
	$category = $_POST["Category"];
	$startDate = $_POST["StartDate"];
	$endDate = empty($_POST["EndDate"]) ? 'NULL' : "'".$_POST["EndDate"]."'";
	$state = $_POST["State"];
	
	$shortTitle = $_POST["ShortTitle"];
	$image = $_POST["Image"];
	
	$title = $_POST["Title"];
	$shortContent = $_POST["ShortContent"];
	$YoutubeUrl = $_POST["YoutubeUrl"];
	
	$createDate = $_POST["CreateDate"];
	$createUserID = $_POST["CreateUserID"];
	$updateDate = $_POST["UpdateDate"];
	$updateUserID = $_POST["UpdateUserID"];
	
	$title = $_POST["Title"];
	$content = $_POST["HTMLEditor1"];
		
	$update = "UPDATE Audio SET 
				Category = '$category', StartDate='$startDate',EndDate='$endDate',State=$state,
				ShortTitle='$shortTitle',Image='$image',
				ShortContent='$shortContent',
				CreateDate='$createDate',CreateUserID='$createUserID',UpdateDate='$updateDate',UpdateUserID='$updateUserID',
				Title='$title',Content='$content',
				YoutubeUrl = '$YoutubeUrl'
				WHERE AudioID='$audioId'";	
	//echo $update;
	mysql_query($update);
	
	echo "<script>parent.$.fn.colorbox.close(); </script>";	
}

if ($_POST["action"] == "add"){ 
	$category = $_POST["Category"];
	$startDate = $_POST["StartDate"];
	$endDate = $_POST["EndDate"];
	$state = $_POST["State"];
	
	$shortTitle = $_POST["ShortTitle"];
	$image = $_POST["Image"];
	
	$shortContent = $_POST["ShortContent"];
	$YoutubeUrl = $_POST["YoutubeUrl"];
	$createDate = $_POST["CreateDate"];
	$createUserID = $_POST["CreateUserID"];
	$updateDate = $_POST["UpdateDate"];
	$updateUserID = $_POST["UpdateUserID"];
	
	$title = $_POST["Title"];
	$content = $_POST["HTMLEditor1"];
		
	$insert = "INSERT INTO Audio (Title, ShortTitle, Content, ShortContent, StartDate, EndDate, CreateDate, UpdateDate, CreateUserID, UpdateUserID, State, Category, Image, YoutubeUrl)  
				VALUES ('$title','$shortTitle','$content','$shortContent','$startDate','$endDate','$createDate','$updateDate','$createUserID','$updateUserID','$state','$category','$image', '$YoutubeUrl')";	
	//echo $insert;
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
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" charset="UTF-8">
        function pageInitial() {
            var bodyHeight = document.body.clientHeight;
            $("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 50) + "px");
            $.cleditor.defaultOptions.height = bodyHeight - 300;
            $("#HTMLEditor1").cleditor();
            $(".Attachs").colorbox({ iframe: true, width: "800px", height: "560px", overlayClose: false, escKey: false, href: "attachsupload.php?KeyID=<?echo $audioId?>&Folder=audio&FunID=audio" });
            $("#txtBeginDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true });
            $("#txtEndDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true });
        }
    </script>
</head>
<body>

    <form name="form1" method="post" action="audioDetail.php" id="form1">
    <div>
        <div id="UpdatePanel1">
            <div class="divDetailTopBar">
                <div id="ToolBar">
                    <div style="float: left; padding-right: 10px">
                        <span id="LabMessage" style="color: Red; font-size: 11pt; font-weight: bold;"></span>
                    </div>
                    <div style="float: right; padding-right: 10px">
                        <? if (isset($_GET["audioId"])) {?>
						
						<input type="image" name="ibSave" id="ibSave" title="儲存資料" src="images/mountoff.png"
                            onclick="showLoading();" style="border-width: 0px;" />
							
						<input type="hidden" name="AudioId" id="AudioId" value="<? echo $audioId?>"/>
						<input type="hidden" name="action" value="update"/>	
						
						<? } else { ?>
						
						<input type="image" name="ibSave" id="ibSave" title="新增" src="images/mountoff.png"
                            onclick="showLoading();" style="border-width: 0px;" />
							
						<input type="hidden" name="action" value="add"/>	
						
						<? } ?>
                    </div>
                    <div style="float: right; width: 20px; color: #FFFFFF; text-align: center">
                        |</div>
                    <div style="float: right">
                        <input type="image" name="ibAttachs" id="ibAttachs" title="上傳圖片" class="Attachs"
                            href="javascript:alert(&#39;請先存檔後再上傳圖片! &#39;);return false;" src="images/attach.png"
                            style="border-width: 0px;" /></div>
                </div>
            </div>
            <div id="divDetailBody" class="divDetailBody">
                <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                    <tr>
                        <td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">分類</span>
                        </td>
						<td>
							<?
								$findCategory = "SELECT * FROM RefCommon WHERE Type = 'audio'";
								$recCategory = mysql_query($findCategory);
							?>
							<select name="Category" id="Category" class="dropdownlist">
							<? while($rowCategory = mysql_fetch_assoc($recCategory)){ ?>
								<?if ($rowCategory["TypeCode"] == $row["Category"]) { ?>
									<option value="<? echo $rowCategory["TypeCode"] ?>" id="<? echo $rowCategory["TypeCode"] ?>" selected><?echo $rowCategory["CodeName"] ?></option>
								<? } else {?>
									<option value="<? echo $rowCategory["TypeCode"] ?>" id="<? echo $rowCategory["TypeCode"] ?>"><?echo $rowCategory["CodeName"] ?></option>
								<? } ?>
							<? } ?>
							</select>
                        </td>
						<td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">開始日期</span>
                        </td>
                        <td>
                            <input name="StartDate" type="date" id="StartDate" class="TextBox" style="width: 95%;" value="<?echo $row["StartDate"]?>"/>
                        </td>
                        <td style="width: 13%" align="center">
                            <span id="Label3" class="DetailLabel">結束日期</span>
                        </td>
                        <td>
                            <input name="EndDate" type="date" id="EndDate" class="TextBox" style="width: 95%;"  value="<?echo $row["EndDate"]?>"/>
                        </td>
                        <td style="width: 13%" align="center">
                            <span id="Label20" class="DetailLabel">狀態</span>
                        </td>
                        <td>
                            <table id="rblStatus" class="RadioButtonList" border="0" style="width: 110px;">
                                <tr>
									<?
										$checked_1 = '';
										$checked_0 = '';
										if ($row["State"] == 1) {
											$checked_1 = 'checked';
										} else {
											$checked_0 = 'checked';
										}
									?>
                                    <td>
                                        <input id="State_1" type="radio" name="State" value="1" <?echo $checked_1?> />
										<label for="rblStatus_1">上架</label>
                                    </td>
                                    <td>
                                        <input id="State_0" type="radio" name="State" value="0" <?echo $checked_0?> />
										<label for="rblStatus_0">下架</label>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
					<tr>
                        <td style="width: 10%" align="center">
                            <span id="labMemberCode" class="DetailLabel">列表標題</span>
                        </td>
                        <td colspan="5">
                            <input name="ShortTitle" type="text" id="ShortTitle" class="TextBox" style="width: 90%;" value="<?echo $row["ShortTitle"]?>"/>
                        </td>
						<td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">列表圖</span>
                        </td>
                        <td>
                            <input name="Image" type="text" id="Image" class="TextBox" style="width: 95%;" 
								placeholder="audio.jpg" value="<?echo $row["Image"]?>"/>
                        </td>
					</tr>
					<tr>
                        <td style="width: 10%" align="center">
                            <span id="labMemberCode" class="DetailLabel">列表Youtube</span>
                        </td>
                        <td colspan="7">
                            <input name="YoutubeUrl" type="text" id="YoutubeUrl" class="TextBox" style="width: 90%;" value="<?echo $row["YoutubeUrl"]?>"/>
                        </td>
					</tr>
					<tr>
                        <td style="width: 10%" align="center">
                            <span id="labMemberCode" class="DetailLabel">列表內文</span>
                        </td>
                        <td colspan="7">
                            <input name="ShortContent" type="text" id="ShortContent" class="TextBox" style="width: 90%;" value="<?echo $row["ShortContent"]?>"/>
                        </td>
					</tr>
					
                    <tr>
                        <td style="width: 10%" align="center">
                            <span id="labMemberCode" class="DetailLabel">標題</span>
                        </td>
                        <td colspan="7">
                            <input name="Title" type="text" id="Title" class="TextBox" style="width: 90%;" value="<?echo $row["Title"]?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 10%" align="center">
                            <span id="labMemberCode" class="DetailLabel">建立人員</span>
                        </td>
						<?
							$c_findUser = "select UserName from SystemUsers where UserID = '".$row["CreateUserID"]."'";
							$c_record = mysql_query($c_findUser);
							$c_result = mysql_fetch_assoc($c_record)
						?>
                        <td>
							<? if (empty($row["CreateUserID"])) {
								$c_findUser = "select UserName from SystemUsers where UserID = '".$_SESSION["userID"]."'";
								$c_record = mysql_query($c_findUser);
								$c_result = mysql_fetch_assoc($c_record);?>
                            <input name="CreateUserName" type="text" id="CreateUserName" class="TextBox" style="width: 95%;" value="<?echo $c_result["UserName"]?>" disabled="true"/>
							<input type="hidden" name="CreateUserID" id="CreateUserID" value="<? echo $_SESSION["userID"]?>"/>
							<? } else {
								$c_findUser = "select UserName from SystemUsers where UserID = '".$row["CreateUserID"]."'";
								$c_record = mysql_query($c_findUser);
								$c_result = mysql_fetch_assoc($c_record);?>
							<input name="CreateUserName" type="text" id="CreateUserName" class="TextBox" style="width: 95%;" value="<?echo $c_result["UserName"]?>" disabled="true"/>
							<input type="hidden" name="CreateUserID" id="CreateUserID" value="<? echo $row["CreateUserID"]?>"/>
							<? } ?>
						</td>
						<td style="width: 13%" align="center">
                            <span id="Label3" class="DetailLabel">建立日期</span>
                        </td>
                        <td>
							<? if (empty($row["CreateDate"])) { ?>
                            <input name="CreateDate_d" type="text" id="CreateDate_d" class="TextBox" style="width: 95%;"  value="<?echo date("Y-m-d")?>" disabled="true"/>
							<input name="CreateDate" type="hidden" id="CreateDate" class="TextBox" style="width: 95%;"  value="<?echo date("Y-m-d")?>"/>
							<? } else { ?>
							<input name="CreateDate_d" type="text" id="CreateDate_d" class="TextBox" style="width: 95%;"  value="<?echo $row["CreateDate"]?>" disabled="true"/>
							<input name="CreateDate" type="hidden" id="CreateDate" class="TextBox" style="width: 95%;"  value="<?echo $row["CreateDate"]?>"/>
							<? } ?>
                        </td>
						 <td style="width: 13%" align="center">
                            <span id="Label3" class="DetailLabel">異動人員</span>
                        </td>
                        <td>
                            <? if (empty($row["UpdateUserID"])) {
								$u_findUser = "select UserName from SystemUsers where UserID = '".$_SESSION["userID"]."'";
								$u_record = mysql_query($u_findUser);
								$u_result = mysql_fetch_assoc($u_record);?>
							<input name="UpdateUserName" type="text" id="UpdateUserName" class="TextBox" style="width: 95%;"  value="<?echo $u_result["UserName"]?>" disabled="true"/>
							<input type="hidden" name="UpdateUserID" id="UpdateUserID" value="<? echo $_SESSION["userID"]?>"/>
							<? } else {
								$u_findUser = "select UserName from SystemUsers where UserID = '".$row["UpdateUserID"]."'";
								$u_record = mysql_query($u_findUser);
								$u_result = mysql_fetch_assoc($u_record);?>
							<input name="UpdateUserName" type="text" id="UpdateUserName" class="TextBox" style="width: 95%;"  value="<?echo $u_result["UserName"]?>" disabled="true"/>
							<input type="hidden" name="UpdateUserID" id="UpdateUserID" value="<? echo $_SESSION["userID"]?>"/>
							<? } ?>
						</td>
						<td style="width: 10%" align="center">
                            <span id="labMemberCode" class="DetailLabel">異動日期</span>
                        </td>
                        <td>
                            <? if (empty($row["UpdateDate"])) { ?>
							<input name="UpdateDate_d" type="text" id="UpdateDate_d" class="TextBox" style="width: 95%;" value="<?echo date("Y-m-d")?>" disabled="true"/>
							<input name="UpdateDate" type="hidden" id="UpdateDate" class="TextBox" style="width: 95%;" value="<?echo date("Y-m-d")?>"/>
							<? } else { ?>
							<input name="UpdateDate_d" type="text" id="UpdateDate_d" class="TextBox" style="width: 95%;" value="<?echo $row["UpdateDate"]?>" disabled="true"/>
							<input name="UpdateDate" type="hidden" id="UpdateDate" class="TextBox" style="width: 95%;" value="<?echo date("Y-m-d")?>"/>
							<? } ?>
						</td>
                    </tr>
                    <tr>
                        <td colspan="8" >
                            <span id="LabImagePath" style="color: Red; font-size: 10pt;">圖片路徑：http://<?echo $_SERVER['HTTP_HOST']?>/images/audio/<?echo $audioId?>/</span>
                            <textarea name="HTMLEditor1" id="HTMLEditor1" rows="2" cols="2"><?echo $row["Content"]?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

</body>
</html>
