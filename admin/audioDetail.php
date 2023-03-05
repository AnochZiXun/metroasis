<?php
include_once("_connMysql.php");
include_once("_function.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];
if (isset($_GET["audioId"])) {
	$audioId = $_GET["audioId"];
}
if (isset($_POST["audioId"])) {
	$audioId = $_POST["audioId"];
}
$mode="0";
$modeDesc="修改";
$isNew = false;
if ($audioId == ""){
	$isNew = true;
	$insert_sql = "INSERT INTO Audio(NewFlag, CreateUserID) VALUES(1, '$currentUserID')";
	//echo $insert_sql;
	mysql_query($insert_sql);
	$audioId = mysql_insert_id();
	$modeDesc = "新增影音內容";
	$mode = "1";
}
//echo $audioId;
if ($_POST["action"] == "update"){ 
	$audioId = $_POST["audioId"];	
	$category = $_POST["Category"];
	$startDate = empty($_POST["StartDate"]) ? 'NULL' : "'".$_POST["StartDate"]."'";
	$endDate = empty($_POST["EndDate"]) ? 'NULL' : "'".$_POST["EndDate"]."'";
	$state = $_POST["State"];
	$shortTitle = $_POST["ShortTitle"];
	$shortContent = $_POST["ShortContent"];
	$youtubeUrl = $_POST["YoutubeUrl"];
	$updateDate = $_POST["UpdateDate"];
	$updateUserID = $currentUserID;
	$content = $_POST["ckeditor"];
	$update = "UPDATE Audio SET 
				   Category = '$category', 
				   StartDate=$startDate,
				   EndDate=$endDate,
				   State=$state,
				   ShortTitle='$shortTitle',
				   ShortContent='$shortContent',
				   UpdateUserID='$updateUserID',
				   Title='$title',
				   Content='$content',
				   YoutubeUrl = '$youtubeUrl', ";
	$NewFlag = getFieldData($audioId,'Audio','AudioID','NewFlag');
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
	$update .= "NewFlag=0 WHERE AudioID='$audioId'";
	//echo $update;
	mysql_query($update);
	echo "<script>parent.location.href='audio.php'; </script>";	
}
$query = "SELECT A.*,S.UserName AS createUserName, S2.UserName AS updateUserName,  ";
$query .= "(SELECT concat(ImagePath,ImageFileName) as ImageFile FROM ImagesFiles WHERE ImageFunction = 'audio' AND ImageType ='detail' AND ForeignID ='$audioId' LIMIT 1) AS ImageFile,  ";
$query .= "(SELECT ImageID FROM ImagesFiles WHERE ImageFunction = 'audio' AND ImageType ='detail' AND ForeignID ='$audioId' LIMIT 1) AS ImageID  ";
$query .= "FROM Audio A  ";
$query .= "LEFT JOIN SystemUsers S ON A.CreateUserID = S.UserID  ";
$query .= "LEFT JOIN SystemUsers S2 ON A.UpdateUserID = S2.UserID  ";
$query .= "WHERE A.AudioID = '$audioId' ";
//echo $query;
$Recaudio = mysql_query($query);
$row=mysql_fetch_assoc($Recaudio);
flush();
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
    <script type="text/javascript" charset="UTF-8">
        function pageInitial() {
            var bodyHeight = document.body.clientHeight;
            //$("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 50) + "px");
            CKEDITOR.replace("ckeditor",{height:500,
				//filebrowserBrowseUrl: '/browser/browse.php?type=Files',
				filebrowserUploadUrl: 'upload.php?funcId=audio&keyId=<? echo $audioId ?>&type=Files',
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
        function delImage(imgId){
			console.log('deleteimage.php?imgid='+ imgId);
			$.ajax({
				url: 'deleteimage.php?imgid='+ imgId,
				type: 'GET',
				async: false,
				success: function(result) {
					console.log(result);
					if (result =="1"){
						$("#image1").attr("src","");
						$("#ImageID").val("");
						$("#ibDelete").hide();
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
                  //var output = document.getElementById('output');
                  //output.src = reader.result;
                  $("#"+targetId).attr('src',reader.result);
                };
                reader.readAsDataURL(event.target.files[0]);
              };
		function beforeSubmit(){
        	showLoading();
        	var textFields = ["StartDate","ShortTitle","YoutubeUrl","ShortContent"];
        	var textNames = ["上架日期","標題","Youtube","短文"];
        	var selectFieleds = ["Category"];
        	var selectNames = ["類型"];
			for (var i = 0; i < selectFieleds.length; i++) {
				if($("#"+selectFieleds[i]).val() == "-1"){
					alert("「"+selectNames[i] + "」為必選欄位!");
					stopLoading();
					return false;
				}
			}
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

			if(!$("#YoutubeUrl").val().includes("/embed/")){
				alert("YouTube網址不正確!\n請使用嵌入的網址!");
				stopLoading();
				return false;
			}

			var content=CKEDITOR.instances.ckeditor.getData();
			if (content=="")
			{
				alert("「詳細內容」為必填欄位!");
				$("#ckeditor").focus();
				stopLoading();
				return false;
			}
        }
    </script>
</head>
<body>
    <form name="form1" method="post" action="audioDetail.php" id="form1" enctype="multipart/form-data">
    <div>
        <div id="UpdatePanel1" style="width:100%">
            <div class="divDetailTopBar" style="width:100%">
                <div id="ToolBar">
                    <div style="float: left;">
                        <span id="LabMessage" class="labMessage"><?echo "&nbsp;&nbsp;【". $modeDesc ."】" . $row["ShortTitle"]?></span>
                    </div>
                </div>
            </div>
            <div id="divDetailBody" class="divDetailBody" style="padding-top: 0px;">
                <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                    <tr>
                    	<td align="center" bgcolor="#e5e5e5" style="width: 8%">
                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 狀態</span></span>
                        </td>
                        <td align="center" style="width: 10%">
                          <table id="rblStatus" class="RadioButtonList" border="0" style="width: 150px;">
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
                        <td style="width: 8%" align="center" bgcolor="#e5e5e5">
                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* 類型</span></span>
                        </td>
						<td align="center" style="width: 10%">
							<?
								$findCategory = "SELECT * FROM RefCommon WHERE Type = 'audio' AND TypeCode <> 0 ORDER BY SortNo";
								$recCategory = mysql_query($findCategory);
							?>
							<select name="Category" id="Category" class="dropdownlist">
								<option value="-1" id="0" selected><? echo "---------" ?></option>
							<? while($rowCategory = mysql_fetch_assoc($recCategory)){ ?>
								<?if ($rowCategory["TypeCode"] == $row["Category"]) { ?>
									<option value="<? echo $rowCategory["TypeCode"] ?>" id="<? echo $rowCategory["TypeCode"] ?>" selected><?echo $rowCategory["CodeName"] ?></option>
								<? } else {?>
									<option value="<? echo $rowCategory["TypeCode"] ?>" id="<? echo $rowCategory["TypeCode"] ?>"><?echo $rowCategory["CodeName"] ?></option>
								<? } ?>
							<? } ?>
							</select>
                        </td>
						<td align="center" bgcolor="#e5e5e5" style="width: 8%">
                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* 上架日期</span></span>
                            <br>
                            <span class="gray_12">(YYYY-MM-DD)</span>
                        </td>
                        <td align="center" style="width: 14%">
                            <input name="StartDate" id="StartDate" type="date" style="width:95%" class="TextBox" value="<?echo $row["StartDate"] ? date("Y-m-d", strtotime($row["StartDate"])) : date('Y-m-d');?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5" style="width: 8%">
                            <span id="Label3" class="DetailLabel">下架日期</span>
                            <br>
                            <span class="gray_12">(YYYY-MM-DD)</span>
                        </td>
                        <td colspan="3" align="center" style="width: 14%">
                            <input name="EndDate" type="date" id="EndDate" class="TextBox" style="width: 95%;"  value="<?echo $row["EndDate"]?>"/>
                        </td>
                    </tr>
					<tr>
                        <td  align="center" bgcolor="#e5e5e5">
                            <span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 標題</span></span>
                        </td>
                        <td colspan="3" align="center">
                            <input name="ShortTitle" type="text" id="ShortTitle" class="TextBox" style="width: 98%;" value="<?echo $row["ShortTitle"]?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5">
							<span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* YouTube</span></span>
						</td>
                        <td colspan="5" align="center">
							<input name="YoutubeUrl" type="text" id="YoutubeUrl" class="TextBox" style="width: 98%;" value="<?echo $row["YoutubeUrl"]?>"/>
						</td>
					</tr>
					<tr>
                        <td align="center" bgcolor="#e5e5e5">
							<span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 短文</span></span>
						</td>
                        <td colspan="9" align="center">
							<input name="ShortContent" type="text" id="ShortContent" class="TextBox" style="width: 99%;" value="<?echo $row["ShortContent"]?>"/>
						</td>
					</tr>
                    <tr>
                    	<td align="center" bgcolor="#e5e5e5" style="vertical-align:top">
                            <span id="labMemberCode" class="DetailLabel"><span class="Mandatory"><br>* 詳細內容</span>
                        </td>
                        <td colspan="9" align="center" >
                            <textarea name="ckeditor" id="ckeditor"><?echo $row["Content"]?></textarea>
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
            		<input type="hidden" name="audioId" value="<? echo $audioId?>"/>
            		<input type="hidden" name="action" value="update"/>
                    <p style="height:20px;"></p>
            	</div>
            </div>
        </div>
        <br/>
    </form>
</body>
</html>
