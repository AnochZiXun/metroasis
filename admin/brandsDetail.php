<?php
include_once("_connMysql.php");
include_once("_function.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];
if (isset($_GET["brandId"])) {
	$brandId = $_GET["brandId"];
}
if (isset($_POST["brandId"])) {
	$brandId = $_POST["brandId"];
}
$mode="0";
$modeDesc="修改";
$isNew = false;
if ($brandId == ""){
	$isNew = true;
	$insert_sql = "INSERT INTO Brand(NewFlag, CreateUserID) VALUES (1, '$currentUserID')";
	//echo $insert_sql;
	mysql_query($insert_sql);
	$brandId = mysql_insert_id();
	$modeDesc = "新增品牌";
	$mode = "1";
}else{
	$rec_newFlag = mysql_query("SELECT NewFlag FROM Brand WHERE BrandID = '$brandId'");
	if($rec_newFlag){
		while($row_newFlag=mysql_fetch_assoc($rec_newFlag)){
			if ($row_newFlag["NewFlag"] == "1") $isNew = true;
		}
	}
}
//echo $mode;
if ($_POST["action"] == "update"){ 
	$brandId = $_POST["brandId"];	
	$brandName = $_POST["BrandName"];
	$brandUrl = $_POST["BrandUrl"];
	$brandTitle = $_POST["BrandTitle"];
	$brandDescription = $_POST["ckeditor"];
	$status = $_POST["Status"];
	$update = "UPDATE Brand 
			   SET BrandName='$brandName',
			       BrandTitle='$brandTitle',
				   BrandDescription='$brandDescription', 
				   BrandUrl ='$brandUrl', 
				   Status='$status', ";	
	$NewFlag = getFieldData($brandId,'Brand','BrandID','NewFlag');
	switch($NewFlag){
    	case "0":
    		//$updateDate = date("Y-m-d H:i:s"); 
			$update .= "UpdateUserID = '$currentUserID',UpdateDate=NOW(), ";
    		break;
    	case "1":
    		//$createDate = date("Y-m-d H:i:s"); 
			$update .= "CreateUserID = '$currentUserID',CreateDate=NOW(), ";
    		break;
    }
    $update .= "NewFlag=0 WHERE BrandID='$brandId'";
	//echo $update;
	mysql_query($update);
	//picture upload
    $targetFolder = "/home/metroasis/public_html/images/brand/";
    if (!file_exists($targetFolder)) {
    	@mkdir($targetFolder);
    }
    if ($brandId != ""){
    	$targetFolder = "/home/metroasis/public_html/images/brand/$brandId";
    	if (!file_exists($targetFolder)) {
    		@mkdir($targetFolder);
    	}
    }
    $target_dir = "/home/metroasis/public_html/images/brand/$brandId/";
	$ImagefilePath = "/images/brand/$brandId/";
	$Message ="";
	//198 * 165
	if (isset($_FILES['imgFile1']) && $_FILES['imgFile1']['size'] > 0) {
		$intWidth=198;
		$intHight=165;
		$src = imagecreatefromjpeg($_FILES['imgFile1']['tmp_name']);	
		$src_w = imagesx($src);
		$src_h = imagesy($src);	
		if ($src_w==$intWidth && $src_h==$intHight){
			if (move_uploaded_file($_FILES['imgFile1']['tmp_name'], $target_dir . $_FILES['imgFile1']['name'])) {
				$ImageID1 = $_POST["ImageID1"];
				if ($ImageID1 != ""){
					$insert = "UPDATE ImagesFiles SET ImageFileName = '". $_FILES['imgFile1']['name'] ."' WHERE ImageID = " . $ImageID1;
				}else{
					$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$brandId','brand','','$ImagefilePath','". $_FILES['imgFile1']['name'] ."')";
				}                    
				//echo $insert; 
	            mysql_query($insert);
	        }
        }else{
	    	$Message = "「Logo 圖片」應為 (198 * 165)";
	    }
	}
	
	if (isset($_FILES['imgFile2']) && $_FILES['imgFile2']['size'] > 0) {
		$intWidth=1400;
		//$intHight=498;
		$src = imagecreatefromjpeg($_FILES['imgFile2']['tmp_name']);	
		$src_w = imagesx($src);
		//$src_h = imagesy($src);	
		if ($src_w==$intWidth){
			if (move_uploaded_file($_FILES['imgFile2']['tmp_name'], $target_dir . $_FILES['imgFile2']['name'])) {
				$ImageID2 = $_POST["ImageID2"];
				if ($ImageID2 != ""){
					$insert = "UPDATE ImagesFiles SET ImageFileName = '". $_FILES['imgFile2']['name'] ."' WHERE ImageID = " . $ImageID2;
				}else{
					$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$brandId','brand','banner','$ImagefilePath','". $_FILES['imgFile2']['name'] ."')";
				}                    
				//echo $insert; 
	            mysql_query($insert);
	        }
        }else{
	    	if ($Message == ""){
        		$Message .= "「Banner」寬度應為 (1400)";
        	}else{
        		$Message .= " 及「Banner」寬度應為 (1400)";	
        	}
	    }
	}
	if ($Message != ""){
		echo "<script>alert('". $Message ."');</script>";
		mysql_query("INSERT INTO Brand (`BrandName`, `BrandTitle`, `BrandDescription`, `BrandUrl`, `Status`, `CreateDate`, `CreateUserID`, `UpdateDate`, `UpdateUserID`, `NewFlag`) SELECT `BrandName`, `BrandTitle`, `BrandDescription`, `BrandUrl`, `Status`, `CreateDate`, `CreateUserID`, `UpdateDate`, `UpdateUserID`, 1 AS NewFlag FROM Brand WHERE BrandID = '$brandId' ");
		$brandId4delete = $brandId;
		$brandId = mysql_insert_id();
		mysql_query("DELETE FROM Brand WHERE BrandID = '$brandId4delete'");
		mysql_query("UPDATE ImagesFiles SET ForeignID = '$brandId' WHERE ForeignID = '$brandId4delete' AND ImageFunction = 'brand' AND ImageType = '' ");
	}else{
		echo "<script>parent.location.href='brands.php'; </script>";	
	}
}
$query = "SELECT B.*,S.UserName AS createUserName, S2.UserName AS updateUserName, ";
$query .= "(SELECT concat(ImagePath,ImageFileName) as ImageFile FROM ImagesFiles WHERE ImageFunction = 'brand' AND ImageType ='' AND ForeignID ='$brandId' LIMIT 1) AS ImageFile1, ";
$query .= "(SELECT ImageID FROM ImagesFiles WHERE ImageFunction = 'brand' AND ImageType ='' AND ForeignID ='$brandId' LIMIT 1) AS ImageID1, ";
$query .= "(SELECT concat(ImagePath,ImageFileName) as ImageFile FROM ImagesFiles WHERE ImageFunction = 'brand' AND ImageType ='banner' AND ForeignID ='$brandId' LIMIT 1) AS ImageFile2, ";
$query .= "(SELECT ImageID FROM ImagesFiles WHERE ImageFunction = 'brand' AND ImageType ='banner' AND ForeignID ='$brandId' LIMIT 1) AS ImageID2 ";
$query .= "FROM Brand B ";
$query .= "LEFT JOIN SystemUsers S ON B.CreateUserID = S.UserID ";
$query .= "LEFT JOIN SystemUsers S2 ON B.UpdateUserID = S2.UserID ";
$query .= "WHERE B.brandId = '$brandId' ";
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
            CKEDITOR.replace("ckeditor",{height:250,
				filebrowserUploadUrl: 'upload.php?funcId=brand&keyId=<? echo $brandId ?>&type=Files',
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
			            } ); 
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
        	var brandName = $("#BrandName").val();
        	if(brandName.trim() != ""){
        		if(!checkBrandName(brandName)){
        			alert("品牌名稱不得重複。");
        			$("#BrandName").focus();
					stopLoading();
					return false;
        		}
        	}
        	var textFields = ["BrandName","BrandTitle","BrandUrl"];
        	var textNames = ["品牌名稱","標題","品牌官網",];
        	var imageFields = ["imgFile1","imgFile2"];
        	var imageNames = ["Logo圖片","Banner圖片"];
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
				alert("「品牌簡介」為必填欄位!");
				$("#ckeditor").focus();
				stopLoading();
				return false;
			}
			if(!validateSingleInput(document.getElementById('imgFile1'))){
				stopLoading();
				return false;
			}
			if(!validateSingleInput(document.getElementById('imgFile2'))){
				stopLoading();
				return false;
			}
			if(document.getElementById('imgFile1').files[0].size >= 2097152){
				alert("圖檔大小應小於2MB");
				stopLoading();
				return false;
			}
			if(document.getElementById('imgFile2').files[0].size >= 2097152){
				alert("圖檔大小應小於2MB");
				stopLoading();
				return false;
			}
        }
        function checkBrandName(brandName){
			var result = false;
			$.ajax({
				url: "service_brand.php?action=checkBrandName&BrandId=<? echo $brandId ?>&BrandName="+brandName,
				type: 'GET',
				dataType: "json",
				async: false,
				success: function(data) {
					if (data == true){ 
						result = true;
					}else{
						result = false;
					}
				}, error: function(xhr) {
					alert("STATUS:"+xhr.status);
					result = false
				} 
			});
			return result;
		}
    </script>
</head>
<body>
    <form name="form1" method="post" action="brandsDetail.php" id="form1" enctype="multipart/form-data">
    <div>
        <div id="UpdatePanel1" style="width:100%">
            <div class="divDetailTopBar" style="width: 100%">
                <div id="ToolBar">
                    <div style="float: left;">
                        <span id="LabMessage" class="labMessage"><?echo "&nbsp;&nbsp;【". $modeDesc ."】" . $row["BrandName"]?></span>
                    </div>
                </div>
            </div>
            <div id="divDetailBody" class="divDetailBody" style="padding-top: 0px;">
                <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                    <tr>
                    	<td align="center" bgcolor="#e5e5e5" style="width: 10%">
                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 狀態</span></span>
                        </td>
                        <td align="center" bgcolor="#ffffff" style="width: 10%">
                            <table id="rblStatus" class="RadioButtonList" border="0" style="width: 150px;">
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
                        <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* 品牌名稱</span></span>
                        </td>
						<td align="center"  bgcolor="#ffffff">
							<input name="BrandName" type="text" id="BrandName" class="TextBox" style="width: 95%;"  value="<?echo $row["BrandName"]?>" onkeyup="this.value=this.value.toUpperCase()"/>
                        </td>
                        <td  align="center" bgcolor="#e5e5e5" style="width: 10%">
                            <span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 標題</span></span>
                        </td>
                        <td align="center" bgcolor="#ffffff">
                            <input name="BrandTitle" type="text" id="BrandTitle" class="TextBox" style="width: 95%;" value="<?echo $row["BrandTitle"]?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5" style="width: 10%">
                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* 品牌官網</span></span>
                        </td>
                        <td colspan="3" align="center" bgcolor="#ffffff">
                            <input name="BrandUrl" type="text" id="BrandUrl" class="TextBox" style="width: 95%;"  value="<?echo $row["BrandUrl"]?>"/>
                        </td>
                    </tr>
                    <tr>
                    	<td align="center" bgcolor="#e5e5e5">
                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* Logo圖片<br /></span></span><span class="gray_12">(198 * 165)</span><br>
                            <p style="height:3;"></p>
                            <input type="file" name="imgFile1" id="imgFile1" accept="image/jpg, image/jpeg" onchange="loadFile(event,'image1')" style="width:70px">
                            <p style="height:3;"></p>
                            <? if ($row["ImageID1"] != ""){?>
                            <input type="button" name="ibDelete1" id="ibDelete1" value="刪除" onClick="showLoading();delImage('<? echo $row["ImageID1"]?>','1')" />
                            <? } ?>
                            <p style="height:3;"></p>
                        </td>
                        <td align="center" valign="middle" bgcolor="#ffffff">
                        	<img id="image1" width="178px" height="150px" src="<?echo $row["ImageFile1"]?>" style="board:0px" alt="" />
                            <input name="ImageID1" type="hidden" id="ImageID1" class="TextBox" style="width: 80%;" value="<?echo $row["ImageID1"]?>"/>
                        </td>
						<td align="center" bgcolor="#e5e5e5">
                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* Banner<br />
                            </span><span class="gray_12">(寬度：1400)</span></span><br>
                            <p style="height:3;"></p>
                            <input type="file" name="imgFile2" id="imgFile2" accept="image/*" onchange="loadFile(event,'image2')" style="width:70px">
                            <p style="height:3;"></p>
                            <? if ($row["ImageID2"] != ""){?>
                            <input type="button" name="ibDelete" id="ibDelete2" value="刪除" onClick="showLoading();delImage('<? echo $row["ImageID2"]?>','2')" />
                            <? } ?>
                            <p style="height:3;"></p>
                        </td>
                        <td colspan="7" align="center" bgcolor="#ffffff">
                        	<img id="image2" width="1000px" height="300px" src="<?echo $row["ImageFile2"]?>" style="board:0px" alt=""/>
                            <input name="ImageID2" type="hidden" id="ImageID2" class="TextBox" style="width: 80%;" value="<?echo $row["ImageID2"]?>"/>
                        </td>
					</tr>
                    <tr>
                    	<td align="center" bgcolor="#e5e5e5" style="vertical-align:top">
                        	<br/>
                            <span id="labMemberCode" class="DetailLabel"><span class="Mandatory"><br>* 品牌簡介 <br><span style="font-size:12px; color:#aaaaaa"></span></span>
                            <a target="_blank" href="howToUploadPictureInCkEditor.html"><span class="blue_10"><u>上傳圖片說明</u></span></a>                            
                        </td>
                        <td colspan="9" bgcolor="#ffffff">
                            <textarea name="ckeditor" id="ckeditor"><?echo $row["BrandDescription"]?></textarea>
                        </td>
                    </tr>
					<tr>
			          	<table class="TableLine" cellpadding="0" cellspacing="0" width="100%">
				          	<tr style="height: 35px;">
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
            		<input type="hidden" name="brandId" value="<? echo $brandId?>"/>
            		<input type="hidden" name="action" value="update"/>
                    <p style="height:20px;"></p>
           	  </div>
          </div>
        </div>
        <br/>
    </form>
</body>
</html>
