<?php
include('_connMysql.php');
include('check_login.php');

if (isset($_GET["branchId"])) {
	$branchId = $_GET["branchId"];
} 

$query = "SELECT * FROM Branch where BranchId = '$branchId'";
$RecBranches = mysql_query($query);
$row=mysql_fetch_assoc($RecBranches);

if ($_POST["action"] == "update"){ 
	$branchId = $_POST["BranchId"];	
	$branchName = $_POST["BranchName"];
	$branchAddress = $_POST["BranchAddress"];
	$branchPhoneNo = $_POST["BranchPhoneNo"];
	$branchPhoto =$_POST["BranchPhoto"];
	$branchDescription = $_POST["BranchDescription"];
	$district = $_POST["District"];
	
	$latLng = getLatLng($branchAddress);
	$lat = $latLng[0];
	$lng = $latLng[1];
	
	$update = "UPDATE Branch SET BranchName='$branchName',BranchAddress='$branchAddress',
				BranchPhoneNo='$branchPhoneNo',BranchPhoto='$branchPhoto',
				BranchDescription='$branchDescription', District='$district'
				, Lat='$lat', Lng='$lng'
				WHERE BranchId = '$branchId'";	
	//echo $update;
	mysql_query($update);
	
	echo "<script>parent.$.fn.colorbox.close(); </script>";	
}

if ($_POST["action"] == "add"){ 
	$branchName = $_POST["BranchName"];
	$branchAddress = $_POST["BranchAddress"];
	$branchPhoneNo = $_POST["BranchPhoneNo"];
	$branchPhoto = $_POST["BranchPhoto"];
	$branchDescription = $_POST["BranchDescription"];
	$district = $_POST["District"];
	
	$check = mysql_query("select count(*) from Branch where BranchName = '$branchName'");
	$checkRow=mysql_fetch_array($check);
	if($checkRow[0] == 0){
		$latLng = getLatLng($branchAddress);
		$lat = $latLng[0];
		$lng = $latLng[1];
		$insert = "INSERT INTO Branch(BranchName,BranchAddress,BranchPhoneNo,BranchPhoto,BranchDescription,District,Lat,Lng) 
					VALUES ('$branchName','$branchAddress','$branchPhoneNo','$branchPhoto','$branchDescription','$district','$lat','$lng')";	
		//echo $insert;
		mysql_query($insert);			
    } else {
		echo "<script> alert('門市名稱已存在'); </script>";
	}
	echo "<script>parent.$.fn.colorbox.close(); </script>";	
}

function getLatLng($addr_str){
	if (strlen($addr_str) == 0 ) {
		$addr_str = "台北市中山區中山北路一段21號1樓";
	}
	$addr_str_encode = urlencode($addr_str);
	$url = "http://maps.googleapis.com/maps/api/geocode/json"
	."?sensor=true&language=zh-TW&region=tw&address=".$addr_str_encode;
	$geo = file_get_contents($url);
	$geo = json_decode($geo,true);
	$geo_status = $geo['status'];
	if($geo_status=="OVER_QUERY_LIMIT"){ die("OVER_QUERY_LIMIT"); }
	if($geo_status!="OK") continue;
	//$geo_lat = $geo['results'][0]['geometry']['location']['lat'];
	//$geo_lng = $geo['results'][0]['geometry']['location']['lng'];
	return array($geo['results'][0]['geometry']['location']['lat'], $geo_lng = $geo['results'][0]['geometry']['location']['lng']);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=11, IE=9, IE=8, chrome=10" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/colorbox.css" type="text/css" rel="stylesheet" />
    <link href="Css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
    <link href="css/jquery.cleditor.css" type="text/css" rel="stylesheet" />
    <script src="js/jquery-1.7.2.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.core.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
    <script src="js/jquery.colorbox.js" type="text/javascript"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.blockUI.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.advancedtable.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () { PageInitial(); });
        $(window).resize(function () { PageInitial(); });
        function pageLoad() {
            var isAsyncPostback = Sys.WebForms.PageRequestManager.getInstance().get_isInAsyncPostBack();
            if (isAsyncPostback) {
                $(document).ready(function () {
                    PageInitial();
                });
            }
        }

        function PageInitial() {
            var bodyHeight = document.body.clientHeight;
            $("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 50) + "px");
            $.cleditor.defaultOptions.height = bodyHeight - 190;
            $("#HTMLEditor1").cleditor();
            $(".Attachs").colorbox({ iframe: true, width: "800px", height: "560px", overlayClose: false, escKey: false, href: "attachsupload.php?KeyID=<?echo $branchId?>&Folder=branchs&FunID=branch" });
			$("#browseImage").colorbox({ iframe: true, width: "800px", height: "560px", overlayClose: false, escKey: false, href: function(){
										  var strType = "";//$(this).attr("name"); *new沒有分type
										  return 'imagelists.php?page=branch&type='+strType+"&ctlname=BranchPhoto&foreignid=<?echo $branchId?>";
										}});
            $("#txtBeginDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true });
            $("#txtEndDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true });
        }
		
		function SetMutiReturnValue(strCtlName, strValue) {
			$("#"+strCtlName).val(strValue);
			
		}
    </script>
</head>
<body>

    <form name="form1" method="post" action="branchDetail.php" id="form1">
    <div>
        <div id="UpdatePanel1">
            <div class="divDetailTopBar">
                <div id="ToolBar">
                    <div style="float: left; padding-right: 10px">
                        <span id="LabMessage" style="color: Red; font-size: 11pt; font-weight: bold;"></span>
                    </div>
                    <div style="float: right; padding-right: 10px">
                        <? if (isset($_GET["branchId"])) {?>
						
						<input type="image" name="ibSave" id="ibSave" title="儲存資料" src="images/mountoff.png"
                            onclick="showLoading();" style="border-width: 0px;" />
							
						<input type="hidden" name="BranchId" id="BranchId" value="<? echo $branchId?>"/>
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
                            <span id="Label2" class="DetailLabel">門市名稱</span>
                        </td>
                        <td>
                            <input name="BranchName" type="text" id="BranchName" class="TextBox" style="width: 95%;" value="<?echo $row["BranchName"]?>"/>
                        </td>
						<td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">門市電話</span>
                        </td>
                        <td>
                            <input name="BranchPhoneNo" type="text" id="BranchPhoneNo" class="TextBox" style="width: 95%;" 
								placeholder="02-3345678" value="<?echo $row["BranchPhoneNo"]?>"/>
                        </td>
                        <td style="width: 13%" align="center">
                            <span id="Label3" class="DetailLabel">地區</span>
                        </td>
                        <td>
							<table id="District" class="RadioButtonList" border="0" style="width: 250px;">
                                <tbody>
									<tr>
										<?
											$District_1 = '';
											$District_2 = '';
											$District_3 = '';
											if ($row["District"] == 3) {
												$District_3 = 'checked';
											} else if($row["District"] == 2) {
												$District_2 = 'checked';
											} else {
												$District_1 = 'checked';
											}
										?>
										<td>
											<input id="District_1" type="radio" name="District" value="1" <?echo $District_1?> />
											<label for="rblDistrict_1">北區</label>
										</td>
										<td>
											<input id="District_2" type="radio" name="District" value="2" <?echo $District_2?> />
											<label for="rblDistrict_2">桃竹苗區</label>
										</td>
										<td>
											<input id="District_3" type="radio" name="District" value="3" <?echo $District_3?> />
											<label for="rblDistrict_3">中南區</label>
										</td>
									</tr>
								</tbody>
							</table>
                        </td>
                    </tr>
					<tr>
						<td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">門市照片</span>
                        </td>
                        <td>
                            <input name="BranchPhoto" type="text" id="BranchPhoto" class="TextBox" style="width: 80%;" value="<?echo $row["BranchPhoto"]?>"/>
							<input name="list" id="browseImage" type="image" src="images/image-off.png" title="選擇列表圖片" />
                        </td>
						<td style="width: 13%" align="center">
                            <span id="Label2" class="DetailLabel">門市地址</span>
                        </td>
						<td>
							<input name="BranchAddress" type="text" id="BranchAddress" class="TextBox" style="width: 95%;" 
								placeholder="新北市板橋區重慶路274巷8號" value="<?echo $row["BranchAddress"]?>"/>
						</td>
                    </tr>
					<tr>
                        <td style="width: 13%; padding-left: 2%;" align="left" colspan="8">
                            <span id="Label2" class="DetailLabel">門市簡介</span>
                        </td>
					</tr>	
                    <tr>
                        <td colspan="8">
                            <span id="LabImagePath" style="color: Red; font-size: 10pt;">圖片路徑：http://<?echo $_SERVER['HTTP_HOST']?>/images/branch/<?echo $branchId?>/description/</span>
                            <textarea name="BranchDescription" id="HTMLEditor1" rows="2" cols="2"><?echo $row["BranchDescription"]?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

</body>
</html>
