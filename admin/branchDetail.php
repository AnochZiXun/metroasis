<?php
include_once("_connMysql.php");
include_once("_function.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];
if (isset($_GET["branchId"])) {
	$branchId = $_GET["branchId"];
}
if (isset($_POST["branchId"])) {
	$branchId = $_POST["branchId"];
} 
$mode="0";
$modeDesc="修改";
$isNew = false;
if ($branchId == ""){
	$isNew = true;
	$insert_sql = "INSERT INTO Branch(NewFlag, CreateUserID) VALUES (1, '$currentUserID')";
	//echo $insert_sql;
	mysql_query($insert_sql);
	$branchId = mysql_insert_id();
	$modeDesc = "新增門市";
	$mode = "1";
}else{
	$rec_newFlag = mysql_query("SELECT NewFlag FROM Branch WHERE BranchID = '$branchId'");
	if($rec_newFlag){
		while($row_newFlag=mysql_fetch_assoc($rec_newFlag)){
			if ($row_newFlag["NewFlag"] == "1") $isNew = true;
		}
	}
}
if ($_POST["action"] == "update"){ 
	$branchId = $_POST["branchId"];	
	$branchName = $_POST["BranchName"];
	$branchAddress = $_POST["BranchAddress"];
	$branchPhoneNo = $_POST["BranchPhoneNo"];
	$branchPhoto =$_POST["ImageID1"];
	$branchDescription = $_POST["ckeditor"];
	$district = $_POST["District"];
	$status = $_POST["Status"];
	$latLng = getLatLng($branchAddress);
	$lat = $latLng[0];
	$lng = $latLng[1];
	$update = "UPDATE Branch SET BranchName='$branchName',BranchAddress='$branchAddress',
				BranchPhoneNo='$branchPhoneNo',BranchPhoto='$branchPhoto',
				BranchDescription='$branchDescription', District='$district', Status='$status'
				, Lat='$lat', Lng='$lng', ";	
	//$NewFlag = getFieldData($branchId,'Branch','BranchID','NewFlag');
	switch($isNew){
    	case false:
    		//$updateDate = date("Y-m-d H:i:s"); 
			$update .= "UpdateUserID = '$currentUserID',UpdateDate=NOW(), ";
    		break;
    	case true:
    		//$createDate = date("Y-m-d H:i:s"); 
			$update .= "CreateUserID = '$currentUserID',CreateDate=NOW(), ";
    		break;
  }
  $update .= "NewFlag = 0 WHERE BranchID = '$branchId' ";			
	//echo $update;
	mysql_query($update);
	//picture upload
  $targetFolder = "/home/metroasis/public_html/images/branch/";
  if (!file_exists($targetFolder)) {
  	@mkdir($targetFolder);
  }
  if ($branchId != ""){
    $targetFolder = "/home/metroasis/public_html/images/branch/$branchId";
   	if (!file_exists($targetFolder)) {
    	@mkdir($targetFolder);
    }
  }
  $target_dir = "/home/metroasis/public_html/images/branch/$branchId/";
	$ImagefilePath = "/images/branch/$branchId/";
	$Message ="";
	//500 * 350
	if (isset($_FILES['imgFile1']) && $_FILES['imgFile1']['size'] > 0) {
		$intWidth = 500;
		$intHight = 350;
		$src = imagecreatefromjpeg($_FILES['imgFile1']['tmp_name']);	
		$src_w = imagesx($src);
		$src_h = imagesy($src);	
		if ($src_w==$intWidth && $src_h==$intHight){
			if (move_uploaded_file($_FILES['imgFile1']['tmp_name'], $target_dir . $_FILES['imgFile1']['name'])) {
				$ImageID1 = $_POST["ImageID1"];
				if ($ImageID1 != ""){
					$insert = "UPDATE ImagesFiles SET ImageFileName = '". $_FILES['imgFile1']['name'] ."' WHERE ImageID = " . $ImageID1;
				}else{
					$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$branchId','branch','','$ImagefilePath','". $_FILES['imgFile1']['name'] ."')";
				}                    
				//echo $insert; 
	      mysql_query($insert);
	    }
    }else{
	    	$Message = "「門市據點 圖片」應為 (500 * 350)";
	  }
	}
	if ($Message != ""){
		echo "<script>alert('". $Message ."');</script>";
		mysql_query("INSERT INTO Branch (`BranchName`, `BranchAddress`, `BranchPhoneNo`, `BranchPhoto`, `BranchPhotoPath`, `District`, `BranchDescription`, `Lat`, `Lng`, `CreateDate`, `CreateUserID`, `UpdateDate`, `UpdateUserID`, `NewFlag`, CreateUserID, CreateDate, UpdateUserID, UpdateDate) SELECT `BranchName`, `BranchAddress`, `BranchPhoneNo`, `BranchPhoto`, `BranchPhotoPath`, `District`, `BranchDescription`, `Lat`, `Lng`, `CreateDate`, `CreateUserID`, `UpdateDate`, `UpdateUserID`, 1 AS NewFlag, CreateUserID, CreateDate, UpdateUserID, UpdateDate FROM Branch WHERE BranchID = '$branchId' ");
		$branchId4delete = $branchId;
		$branchId = mysql_insert_id();
		mysql_query("DELETE FROM Branch WHERE BranchID = '$branchId4delete'");
	}else{
		echo "<script>parent.location.href='branchs.php'; </script>";	
	}
}
$query = "SELECT B.*,S.UserName AS createUserName, S2.UserName AS updateUserName, ";
$query .= "(SELECT concat(ImagePath,ImageFileName) as ImageFile FROM ImagesFiles WHERE ImageFunction = 'branch' AND ImageType ='' AND ForeignID ='$branchId' LIMIT 1) AS ImageFile1, ";
$query .= "(SELECT ImageID FROM ImagesFiles WHERE ImageFunction = 'branch' AND ImageType ='' AND ForeignID ='$branchId' LIMIT 1) AS ImageID1 ";
$query .= "FROM Branch B ";
$query .= "LEFT JOIN SystemUsers S ON B.CreateUserID = S.UserID ";
$query .= "LEFT JOIN SystemUsers S2 ON B.UpdateUserID = S2.UserID ";
$query .= "WHERE B.branchId = '$branchId' ";
//echo $query;
$RecNews = mysql_query($query);
$row=mysql_fetch_assoc($RecNews);
function setData($rowData){
	if (empty($rowData) || is_null($rowData)){
	 return "-";
	}else{
		return $rowData;
	}
}
//$query = "SELECT * FROM Branch where branchId = '$branchId'";
//$RecBranches = mysql_query($query);
//$row=mysql_fetch_assoc($RecBranches);
//TODO: 看要不要把門市名稱檢查搬上去, 然後刪除這個IF
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
	<link rel="shortcut icon" href="images/logo.png" />
  <link rel="icon" type="image/ico" href="images/favicon_16x16.ico" />
  <link href="css/main.css" type="text/css" rel="stylesheet" />
  <link href="css/colorbox.css" type="text/css" rel="stylesheet" />
  <link href="css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
  <link href="css/jquery.cleditor.css" type="text/css" rel="stylesheet" />
  <link href="css/jquery.treeview.css" rel="stylesheet" />
  <link href="css/flexslider.css" type="text/css" rel="stylesheet" />
  <link href="css/EricChang.css" type="text/css" rel="stylesheet" />
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
  <script type="text/javascript" charset="UTF-8" src="js/validateInputFile.js"></script>
  <script type="text/javascript" charset="UTF-8">
  	function pageInitial() {
    	var bodyHeight = document.body.clientHeight;
      CKEDITOR.replace("ckeditor",{height:320,
			filebrowserUploadUrl: 'upload.php?funcId=branch&keyId=<? echo $branchId ?>&type=Files',
				on: {
					instanceReady: function() {
				  	this.dataProcessor.htmlFilter.addRules( {
				    	elements: {
				      	img: function( el ) {
				        	// Add an attribute.
				          if ( !el.attributes.alt )
				          // Add some class.
				          el.addClass( 'img-responsive' );
				        }
				      }
				    }); 
				  }
				}
			});
      $("#txtBeginDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true });
      $("#txtEndDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true }); 
      $("input[type=submit], input[type=button]" ).button();
    }
    function delImage(imgId,imgNo){
			console.log('deleteimage.php?imgid='+ imgId);
			$.ajax({
				url: 'deleteimage.php?imgid='+ imgId,
				type: 'GET',
				async: false,
				success: function(result) {
					console.log(result);
					if (result =="1"){
						$("#image"+imgNo).attr("src","");
						$("#ImageID"+imgNo).val("");
						$("#ibDelete"+imgNo).hide();
					}
					if (result =="-1"){
						alert('刪除失敗，請重試。'); 	
					}
					stopLoading();
				}, error: function(xhr) { 
					console.log(xhr);
					stopLoading();
					alert('刪除失敗，請重試。'); 
				} 
			});
		}
    var loadFile = function(event,targetId) {
	    var reader = new FileReader();
	    reader.onload = function(){
		    var output = document.getElementById(targetId);
		    output.src = reader.result;
		    //var x = document.getElementById(targetId);
		    //x.src = reader.result;
	    };
	    reader.readAsDataURL(event.target.files[0]);
    };
    function beforeSubmit(){
    	showLoading();
    	var textFields = ["BranchName","BranchPhoneNo","BranchAddress"];
    	var textNames = ["門市名稱","門市電話","門市地址"];
    	var imageFields = ["imgFile1"];
    	var imageNames = ["門市照片"];
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
		for (var i = 0; i < imageFields.length; i++) {
			var imgFile = document.getElementById(imageFields[i]).value;
			var imageId = document.getElementById("ImageID"+(i+1)).value;
			if (imageId == ""){
				if (imgFile == "")	{
					alert("「"+imageNames[i] + "」為必填欄位!");
					stopLoading();
					return false;
				}
			}
		}
		var content=CKEDITOR.instances.ckeditor.getData();
		if (content=="")
		{
			alert("「門市簡介」為必填欄位!");
			$("#ckeditor").focus();
			stopLoading();
			return false;
		}
		if(!validateSingleInput(document.getElementById('imgFile1'))){
			stopLoading();
			return false;
		}
		if(document.getElementById('imgFile1').files[0].size >= 2097152){
			alert("圖檔大小應小於2MB");
			stopLoading();
			return false;
		}
    }
  </script>
</head>
<body>
	<form name="form1" method="post" action="branchDetail.php" id="form1" enctype="multipart/form-data">
	  <div id="UpdatePanel1" style="width:100%">
	  	<div class="divDetailTopBar" style="width:100%">
          <div id="ToolBar">
              <div style="float: left;">
                  <span id="LabMessage" class="labMessage"><?echo "&nbsp;&nbsp;【". $modeDesc ."】" . $row["BranchName"]?></span>
              </div>
          </div>
      </div>
	  	<div id="divDetailBody" class="divDetailBody" style="padding-top: 0px;">
 		<table class="TableLine" cellpadding="0" cellspacing="0" width="100%">
      	  <tr>
            <td width="10%" align="center" bgcolor="#e5e5e5">
                <span class="red_12">* 狀態</span>
            </td>
            <td width="15%" align="left" bgcolor="#ffffff" style="padding-left:10px;">
                            <table id="rblStatus" class="RadioButtonList" border="0" style="width: 120px;">
                                <tr>
									<?
										$checked_1 = '';
										$checked_0 = '';
										if ($row["Status"] == 1) {
											$checked_1 = 'checked';
										} else {
											$checked_0 = 'checked';
										}
									?>
                                    <td>
                                        <input id="State_1" type="radio" name="Status" value="1" <?echo $checked_1?> />
										<label for="rblStatus_1">上架</label>
                                    </td>
                                    <td>
                                        <input id="State_0" type="radio" name="Status" value="0" <?echo $checked_0?> />
										<label for="rblStatus_0">下架</label>
                                    </td>
                                </tr>
                            </table>
                        </td>
            <td width="10%" style="height:42px;" align="center" bgcolor="#e5e5e5">
                <span class="red_12">* 地區</span>
            </td>
            <td width="65%" colspan="3" align="left" style="padding-left:10px;">
							<table id="District" class="RadioButtonList" border="0" style="width:30%;" bgcolor="#ffffff">
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
											<input id="District_1" type="radio" name="District" value="1" <? echo $District_1; ?> />
											<label for="rblDistrict_1">北區</label>
										</td>
										<td>
											<input id="District_2" type="radio" name="District" value="2" <? echo $District_2; ?> />
											<label for="rblDistrict_2">桃竹苗區</label>
										</td>
										<td>
											<input id="District_3" type="radio" name="District" value="3" <? echo $District_3; ?> />
											<label for="rblDistrict_3">中南區</label>
										</td>
									</tr>
								</tbody>
							</table>
            </td>
          </tr>
      	  <tr height="43">
            <td align="center" bgcolor="#e5e5e5">
            	<span class="red_12">* 門市名稱</span>
            </td>
            <td align="center" bgcolor="#ffffff">
              <input name="BranchName" type="text" id="BranchName" class="TextBox" style="width: 90%;" value="<?echo $row["BranchName"]?>"/>
            </td>
            <td align="center" bgcolor="#e5e5e5">
              <span class="red_12">* 門市電話</span>
            </td>
            <td width="20%" align="center" bgcolor="#ffffff">
                <input name="BranchPhoneNo" type="text" id="BranchPhoneNo" class="TextBox" style="width: 90%;" value="<?echo $row["BranchPhoneNo"]?>"/>
            </td>
            <td width="10%" align="center" bgcolor="#e5e5e5">
              <span class="red_12">* 門市地址</span>
            </td>
            <td width="30%" align="center" bgcolor="#ffffff">
                <input name="BranchAddress" type="text" id="BranchAddress" class="TextBox" style="width: 90%;" value="<?echo $row["BranchAddress"]?>"/>
            </td>
          </tr>
          <tr>
          	<td align="center" style="height:200px;" bgcolor="#e5e5e5">
              <span class="red_12">* 門市照片<br /></span><span class="gray_12">(500 * 350)</span><br>
              <p style="height:3;"></p>
              <input type="file" name="imgFile1" id="imgFile1" accept="image/jpg, image/jpeg" onchange="loadFile(event,'image1')" style="width:70px">
              <p style="height:3;"></p>
              <? if ($row["ImageID1"] != ""){?>
              <input type="button" name="ibDelete1" id="ibDelete1" value="刪除" onClick="showLoading();delImage('<? echo $row["ImageID1"]?>','1')" />
              <? } ?>
              <p style="height:3;"></p>
            </td>
            <td colspan="5" bgcolor="#ffffff">
            	<img id="image1" width="178px" height="150px" src="<?echo $row["ImageFile1"]?>" style="board:0px" />
                <input name="ImageID1" type="hidden" id="ImageID1" class="TextBox" style="width: 80%;" value="<?echo $row["ImageID1"]?>"/>
            </td>
          </tr>
          <tr>
          	<td align="center" bgcolor="#e5e5e5" style="vertical-align:top">
              <br/>
			  <span class="red_12"><br>* 門市簡介 <br></span>
                <a target="_blank" href="howToUploadPictureInCkEditor.html"><span class="blue_10"><u>上傳圖片說明</u></span></a>
            </td>
              <td colspan="5" bgcolor="#ffffff">
                  <textarea name="ckeditor" id="ckeditor"><? echo $row["BranchDescription"]; ?></textarea>
              </td>
          </tr>
          <tr>
          	<table class="TableLine" cellpadding="0" cellspacing="0" width="100%">
	          	<tr style="height: 43px;">
					<td align="center" bgcolor="#e5e5e5" style="width: 12.5%">
		                <span class="DetailLabel">建立人員</span>
		            </td>
		            <td align="center" bgcolor="#FFFFFF" style="width: 12.5%">
		                <span class="b_12"><?echo $isNew ? "-" : $row["createUserName"]?></span>
		            </td>
		            <td align="center" bgcolor="#e5e5e5" style="width: 12.5%">
		                <span  class="DetailLabel">建立時間</span>
	            	</td>
		            <td align="center" bgcolor="#FFFFFF" style="width: 12.5%">
						<? if($isNew){ ?>
							<span class="b_12">-</span>
						<? }else{ ?>
							<span class="b_12"><? echo date_format(new DateTime($row["CreateDate"]),"Y/m/d") ?></span>
							<br>
							<span class="b_12"><? echo date_format(new DateTime($row["CreateDate"]),"H:i:s") ?></span>
						<? } ?>
		         	</td>
					<td align="center" bgcolor="#e5e5e5" style="width: 12.5%">
		                <span class="DetailLabel">更新人員</span>
	           		</td>
		            <td align="center" bgcolor="#FFFFFF" style="width: 12.5%">
		                <? if($isNew){ ?>
							<span class="b_12">-</span>
						<? }else{ ?>
							<? if($row["updateUserName"] != NULL){ ?>
							<span class="b_12"><? echo $row["updateUserName"]?></span>
							<? }else{ ?>
							<span class="b_12">-</span>
							<? } ?>
						<? } ?>
		            </td>
		            <td align="center" bgcolor="#e5e5e5" style="width: 12.5%">
		                <span  class="DetailLabel">更新時間</span>
	            	</td>
		            <td align="center" bgcolor="#FFFFFF" style="width: 12.5%">
						<? if($isNew){ ?>
							<span class="b_12">-</span>
						<? }else{ ?>
							<? if($row["UpdateDate"] != NULL){ ?>
							<span class="b_12"><? echo date_format(new DateTime($row["UpdateDate"]),"Y/m/d") ?></span>
							<br>
							<span class="b_12"><? echo date_format(new DateTime($row["UpdateDate"]),"H:i:s") ?></span>
							<? }else{ ?>
							<span class="b_12">-</span>
							<? } ?>
						<? } ?>
		            </td>
	          	</tr>
         	 </table>
          </tr>
        </table>
        <div style="width:100%; text-align:center">
   	    <p style="height:20px;"></p>
      		<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit();" style="font-size:12pt; height:35px" />
      		<input type="hidden" name="branchId" value="<? echo $branchId?>"/>
      		<input type="hidden" name="action" value="update"/>
          <p style="height:20px;"></p>
      	</div>
	  	</div>
		</div>
	</form>
</body>
</html>
