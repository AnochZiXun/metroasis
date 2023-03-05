<?php

include_once("_connMysql.php");

include_once("_function.php");

include_once("check_login.php");

$currentUserID = $_SESSION["userID"];

if (isset($_GET["newsId"])) {

	$newsId = $_GET["newsId"];

}

if (isset($_POST["newsId"])) {

	$newsId = $_POST["newsId"];

}

$mode="0";

$modeDesc="修改";

$isNew = false;

if ($newsId == ""){

	$isNew = true;

	$insert_sql = "INSERT INTO News(NewFlag, CreateUserID) VALUES(1, '$currentUserID')";

	//echo $insert_sql;

	mysql_query($insert_sql);

	$newsId = mysql_insert_id();

	$modeDesc = "新增消息";

	$mode = "1";

}else{

	$rec_newFlag = mysql_query("SELECT NewFlag FROM News WHERE NewsID = '$newsId'");

	if($rec_newFlag){

		while($row_newFlag=mysql_fetch_assoc($rec_newFlag)){

			if ($row_newFlag["NewFlag"] == "1") $isNew = true;

		}

	}

}

//echo $newsId;

if ($_POST["action"] == "update"){ 

	$newsId = $_POST["newsId"];	

	$category = $_POST["Category"];

	$startDate = empty($_POST["StartDate"]) ? 'NULL' : "'".$_POST["StartDate"]."'";

	$endDate = empty($_POST["EndDate"]) ? 'NULL' : "'".$_POST["EndDate"]."'";

	$state = $_POST["State"];

	$shortTitle = $_POST["ShortTitle"];

	$shortContent = $_POST["ShortContent"];

	$activityDate = empty($_POST["ActivityDate"]) ? 'NULL' : "'".$_POST["ActivityDate"]."'";

	//$title = $_POST["Title"];

	$content = $_POST["ckeditor"];

	$update = "UPDATE News SET 

				Category = '$category', 

				StartDate=$startDate,

				EndDate=$endDate,

				State=$state,

				ShortTitle='$shortTitle',

				ShortContent='$shortContent',

				ActivityDate=$activityDate,

				Content='$content', ";

	$NewFlag = getFieldData($newsId,'News','NewsID','NewFlag');

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

	$update .= "NewFlag=0 WHERE NewsID='$newsId'";

	//echo $update;

	mysql_query($update);

	//picture upload

    $targetFolder = "/home/metroasis/public_html/images/news/";

    if (!file_exists($targetFolder)) {

    	@mkdir($targetFolder);

    }

    if ($newsId != ""){

    	$targetFolder = "/home/metroasis/public_html/images/news/$newsId";

    	if (!file_exists($targetFolder)) {

    		@mkdir($targetFolder);

    	}

    }

    $target_dir = "/home/metroasis/public_html/images/news/$newsId/";

	$ImagefilePath = "/images/news/$newsId/";

	$Message ="";

	//500 * 333

	if (isset($_FILES['imgFile1']) && $_FILES['imgFile1']['size'] > 0) {

		$intWidth=500;

		$intHight=333;

		$src = imagecreatefromjpeg($_FILES['imgFile1']['tmp_name']);

		$src_w = imagesx($src);

		$src_h = imagesy($src);	

		if ($src_w==$intWidth && $src_h==$intHight){

			if (move_uploaded_file($_FILES['imgFile1']['tmp_name'], $target_dir . $_FILES['imgFile1']['name'])) {

				$ImageID1 = $_POST["ImageID1"];

				if ($ImageID1 != ""){

					$insert = "UPDATE ImagesFiles SET ImageFileName = '". $_FILES['imgFile1']['name'] ."' WHERE ImageID = " . $ImageID1;

				}else{

					$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$newsId','news','detail','$ImagefilePath','". $_FILES['imgFile1']['name'] ."')";

				}                    

				//echo $insert;

	            mysql_query($insert);

	        }

        } else {

	    	$Message = "「最新消息 圖片」應為 (500 * 333)";

	    }

	}

	if ($Message != ""){

		echo "<script>alert('". $Message ."');</script>";

		mysql_query("INSERT INTO News (`Title`, `ShortTitle`, `Content`, `ShortContent`, `ActivityDate`, `StartDate`, `EndDate`, `State`, `Category`, `NewFlag`, CreateUserID, CreateDate, UpdateUserID, UpdateDate) SELECT `Title`, `ShortTitle`, `Content`, `ShortContent`, `ActivityDate`, `StartDate`, `EndDate`, `State`, `Category`, 1 AS NewFlag, CreateUserID, CreateDate, UpdateUserID, UpdateDate FROM News WHERE NewsID = '$newsId' ");

		$newsId4delete = $newsId;

		$newsId = mysql_insert_id();

		mysql_query("DELETE FROM News WHERE NewsID = '$newsId4delete'");

	}else{

		echo "<script>parent.location.href='news.php'; </script>";

	}

}

$query  = "SELECT N.*,S.UserName AS createUserName, S2.UserName AS updateUserName, ";

$query .= "(SELECT concat(ImagePath,ImageFileName) as ImageFile FROM ImagesFiles WHERE ImageFunction = 'news' AND ForeignID ='$newsId' LIMIT 1) AS ImageFile, ";

$query .= "(SELECT ImageID FROM ImagesFiles WHERE ImageFunction = 'news' AND ForeignID ='$newsId' LIMIT 1) AS ImageID ";

$query .= "FROM News N ";

$query .= "LEFT JOIN SystemUsers S ON N.CreateUserID = S.UserID ";

$query .= "LEFT JOIN SystemUsers S2 ON N.UpdateUserID = S2.UserID ";

$query .= "WHERE N.NewsID = '$newsId' ";

//echo $query;

$RecNews = mysql_query($query);

$row=mysql_fetch_assoc($RecNews);

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

    <script type="text/javascript" charset="UTF-8" src="js/validateInputFile.js"></script>

    <script type="text/javascript" charset="UTF-8">

        function pageInitial() {

            //$("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 50) + "px");

            CKEDITOR.replace("ckeditor",{height:500,

				//filebrowserBrowseUrl: '/browser/browse.php?type=Files',

				filebrowserUploadUrl: 'upload.php?funcId=news&keyId=<? echo $newsId ?>&type=Files',

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

						$("#ImageID1").val("");

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

        	var textFields = ["ActivityDate","StartDate","ShortTitle","ShortContent"];

        	var textNames = ["活動日期","上架日期","標題","短文"];

        	var imageFields = ["imgFile1"];

        	var imageNames = ["圖片"];

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

				alert("「詳細內容」為必填欄位!");

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

    <form name="form1" method="post" action="newsDetail.php" id="form1" enctype="multipart/form-data">

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

                    	<td style="width: 8%"  align="center" bgcolor="#e5e5e5">

                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 狀態</span></span>

                        </td>

                        <td style="width: 12%" align="center" bgcolor="#ffffff">

                            <table id="rblStatus" class="RadioButtonList" border="0" style="width:95%;">

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

                        <td style="width: 8%"  align="center" bgcolor="#e5e5e5">

                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* 類型</span></span>

                        </td>

						<td style="width: 12%" align="center" bgcolor="#ffffff">

							<?

								$findCategory = "SELECT * FROM RefCommon WHERE Type = 'news' AND TypeCode <> 0 ORDER BY SortNo";

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

                        <td style="width: 8%"  align="center" bgcolor="#e5e5e5">

                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* 活動日期</span></span>

                            <br>

                            <span class="gray_12">(YYYY-MM-DD)</span>

                        </td>

                        <td style="width: 12%" align="center" bgcolor="#ffffff">

                            <input name="ActivityDate" type="date" id="ActivityDate" class="TextBox" style="width: 95%;"  value="<?echo $row["ActivityDate"]?>"/>

                        </td>

						<td style="width: 8%"  align="center" bgcolor="#e5e5e5">

                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* 上架日期</span></span>

                            <br>

                            <span class="gray_12">(YYYY-MM-DD)</span>

                        </td>

                        <td style="width: 12%" align="center" bgcolor="#ffffff">

                            <input name="StartDate" id="StartDate" type="date" style="width:95%" class="TextBox" value="<?echo $row["StartDate"] ? date("Y-m-d", strtotime($row["StartDate"])) : date('Y-m-d');?>"/>

                        </td>

                        <td style="width: 8%"  align="center" bgcolor="#e5e5e5">

                            <span id="Label3" class="DetailLabel">下架日期</span>

                            <br>

                            <span class="gray_12">(YYYY-MM-DD)</span>

                        </td>

                        <td style="width: 12%" align="center" bgcolor="#ffffff">

                            <input name="EndDate" type="date" id="EndDate" class="TextBox" style="width: 95%;"  value="<?echo $row["EndDate"] ? date("Y-m-d", strtotime($row["EndDate"])) : "" ?>"/>

                        </td>

                    </tr>

					<tr>

                        <td  align="center" bgcolor="#e5e5e5">

                            <span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 標題</span></span>

                        </td>

                        <td colspan="3" align="center" bgcolor="#ffffff">

                            <input name="ShortTitle" type="text" id="ShortTitle" class="TextBox" style="width: 98%;" value="<?echo $row["ShortTitle"]?>"/>

                        </td>

                        <td align="center" bgcolor="#e5e5e5">

                            <span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 短文說明</span></span>

                        </td>

                        <td colspan="5" align="center" bgcolor="#ffffff">

                            <input name="ShortContent" type="text" id="ShortContent" class="TextBox" style="width: 99%;" value="<?echo $row["ShortContent"]?>"/>

                        </td>

					</tr>

                    <tr>

						<td align="center" bgcolor="#e5e5e5">

                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* 圖片</span></span><br>

                            <span class="gray_12">(500 * 333)</span><br>

                            <p style="height:3;"></p>

                            <input type="file" name="imgFile1" id="imgFile1" accept="image/jpg, image/jpeg" onchange="loadFile(event,'image1')" style="width:70px">

                            <p style="height:3;"></p>

                            <? if ($row["ImageID"] != ""){?>

                            <input type="button" name="ibDelete" id="ibDelete" value="刪除" onClick="showLoading();delImage('<? echo $row["ImageID"]?>')" />

                            <? } ?>

                            <p style="height:3;"></p>

                        </td>

                        <td colspan="9" bgcolor="#ffffff">

                        	<img id="image1" width="100px" height="100px" src="<?echo $row["ImageFile"]?>" style="board:0px" />

                            <input name="ImageID1" type="hidden" id="ImageID1" class="TextBox" style="width: 80%;" placeholder="news.jpg" value="<?echo $row["ImageID"]?>"/>

                        </td>

					</tr>

                    <tr>

                    	<td align="center" bgcolor="#e5e5e5" style="vertical-align:top">

                        	<br/>

                            <span id="labMemberCode" class="DetailLabel"><span class="Mandatory"><br>* 詳細內容</span></span>

                            <br>

                            <a target="_blank" href="howToUploadPictureInCkEditor.html"><span class="blue_10"><u>上傳圖片說明</u></span></a>

                        </td>

                        <td colspan="9" align="center" bgcolor="#ffffff">

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

            		<input type="hidden" name="newsId" value="<? echo $newsId?>"/>

            		<input type="hidden" name="action" value="update"/>

                    <p style="height:20px;"></p>

            	</div>

            </div>

        </div>

        <br/>

    </form>

</body>

</html>

