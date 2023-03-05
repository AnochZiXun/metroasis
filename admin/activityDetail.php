<?php

include('_connMysql.php');

//include('_function.php');

include('check_login.php');



$currentUserID = $_SESSION["userID"];



if (isset($_GET["activityId"])) {

	$activityId = $_GET["activityId"];

}



if (isset($_POST["activityId"])) {

	$activityId = $_POST["activityId"];

}



$mode="0";

$modeDesc = "修改";

if ($activityId == ""){

	$insert_sql = "INSERT INTO Activitys(Status, CreateUserID) VALUES (0, '$currentUserID')";

	mysql_query($insert_sql);

	$activityId = mysql_insert_id();

	

	$mode = "1";

	$modeDesc = "新增活動";

}



//echo $activityId;



if ($_POST["action"] == "update"){ 

    $activityDateS = empty($_POST["activityDateS"]) ? 'NULL' : "'".$_POST["activityDateS"]."'";

    $activityDateE = empty($_POST["activityDateE"]) ? 'NULL' : "'".$_POST["activityDateE"]."'";

    $activityPlace = $_POST["activityPlace"];	

    $activityAddress = $_POST["activityAddress"];	

    $activitySubject = $_POST["activitySubject"];	

    $activityDescription = $_POST["activityDescription"];	

    $activityInformation = $_POST["activityInformation"];	

    $joinWay = $_POST["joinWay"];	

    $bankInformation = $_POST["bankInformation"];	

    $absentRefund = $_POST["absentRefund"];

    $contentBanner = $_POST["contentBanner"];

    $contentSbuject = $_POST["contentSbuject"];

    $companionLimit = empty($_POST["companionLimit"]) ? 'NULL' : "'".$_POST["companionLimit"]."'";

    $listPicture = $_POST["listPicture"];

    $listSubject = $_POST["listSubject"];

    $listDescription = $_POST["listDescription"];

    $likes = '' == $_POST["likes"] ? 0 : $_POST["likes"];

    $category = $_POST["category"];

    $status = $_POST["status"];	

    

   

    

	$updateUserID = $currentUserID;

		

	$update = "UPDATE Activitys SET 

				ActivityDateS = $activityDateS, 

				ActivityDateE=$activityDateE, 

				ActivityPlace='$activityPlace', 

				ActivityAddress='$activityAddress',

				ActivitySubject='$activitySubject', 

				ActivityDescription='$activityDescription', 

				ActivityInformation='$activityInformation',

				JoinWay='$joinWay', 

				BankInformation='$bankInformation', 

				AbsentRefund='$absentRefund', 

				ContentBanner='$contentBanner',

                ContentSbuject='$contentSbuject', 

                CompanionLimit=$companionLimit, 

                ListPicture='$listPicture', 

                ListSubject='$listSubject', 

                ListDescription='$listDescription',

                Likes='$likes', 

                Category='$category', 

                Status='$status', ";



    switch ($mode){

    	case "0":

    		$updateDate = date("Y-m-d H:i:s"); 

			$update .= "updateUserID = $currentUserID,UpdateDate='$updateDate', ";

    		break;

    	case "1":

    		$createDate = date("Y-m-d H:i:s"); 

			$update .= "CreateUserID = $currentUserID,CreateDate='$createDate', ";

    		break;

    }

    

    $update .= "NewFlag=0 WHERE ActivityID='$activityId'";

    			  

	//echo $update;

	mysql_query($update);

	

	//picture upload

    $targetFolder = "/home/metroasis/public_html/images/activitys/";

    if (!file_exists($targetFolder)) {

    	@mkdir($targetFolder);

    }

    

    if ($activityId != ""){

    	$targetFolder = "/home/metroasis/public_html/images/activitys/$activityId";

    	if (!file_exists($targetFolder)) {

    		@mkdir($targetFolder);

    	}

    }

    

    $target_dir = "/home/metroasis/public_html/images/activitys/$activityId/";

	$ImagefilePath = "/images/activitys/$activityId/";

	

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

					$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$activityId','activitys','detail','$ImagefilePath','". $_FILES['imgFile1']['name'] ."')";

				}                    

				//echo $insert; 

	            mysql_query($insert);

	        }

	    }else{

	    	$Message = "「圖片」應為 (500 * 333)";

	    }

		

	}

	

	//1038*568

	if (isset($_FILES['imgFile2']) && $_FILES['imgFile2']['size'] > 0) {

		$intWidth=1038;

		$intHight=568;

		$src = imagecreatefromjpeg($_FILES['imgFile2']['tmp_name']);	

		$src_w = imagesx($src);

		$src_h = imagesy($src);	

	

		if ($src_w==$intWidth && $src_h==$intHight){

			if (move_uploaded_file($_FILES['imgFile2']['tmp_name'], $target_dir . $_FILES['imgFile2']['name'])) {

				$ImageID2 = $_POST["ImageID2"];

				if ($ImageID2 != ""){

					$insert = "UPDATE ImagesFiles SET ImageFileName = '". $_FILES['imgFile2']['name'] ."' WHERE ImageID = " . $ImageID2;

				}else{

					$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$activityId','activitys','banner','$ImagefilePath','". $_FILES['imgFile2']['name'] ."')";

				}                    

				//echo $insert; 

	            mysql_query($insert);

	        }

        }else{

        	if ($Message == ""){

        		$Message .= "「Banner」應為 (1038 * 568)";

        	}else{

        		$Message .= " 及「Banner」應為 (1038 * 568)";	

        	}

        	

        }

	}

	

	if ($Message != ""){

		//echo $Message ;

		echo "<script>alert('". $Message ."');</script>";	

	}else{

		echo "<script>parent.location.href='activity.php'; </script>";	

	}

    

}



$query = "SELECT A.*,S.UserName AS createUserName, S2.UserName AS updateUserName, ";

$query .= "(SELECT concat(ImagePath,ImageFileName) as ImageFile FROM ImagesFiles WHERE ImageFunction = 'activitys' AND ImageType ='detail' AND ForeignID ='$activityId' LIMIT 1) AS ImageFile1, ";

$query .= "(SELECT ImageID FROM ImagesFiles WHERE ImageFunction = 'activitys' AND ImageType ='detail' AND ForeignID ='$activityId' LIMIT 1) AS ImageID1, ";

$query .= "(SELECT concat(ImagePath,ImageFileName) as ImageFile FROM ImagesFiles WHERE ImageFunction = 'activitys' AND ImageType ='banner' AND ForeignID ='$activityId' LIMIT 1) AS ImageFile2, ";

$query .= "(SELECT ImageID FROM ImagesFiles WHERE ImageFunction = 'activitys' AND ImageType ='banner' AND ForeignID ='$activityId' LIMIT 1) AS ImageID2 ";

$query .= "FROM Activitys A  ";

$query .= "LEFT JOIN SystemUsers S ON A.CreateUserID = S.UserID ";

$query .= "LEFT JOIN SystemUsers S2 ON A.UpdateUserID = S2.UserID ";

$query .= "WHERE A.ActivityID = '$activityId' ";



//echo $query;



$RecActivitys = mysql_query($query);

$row=mysql_fetch_assoc($RecActivitys);

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

    <script type="text/javascript" charset="UTF-8" src="js/ckeditor/ckeditor.js"></script>

    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>

    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>

    <script type="text/javascript" charset="UTF-8">

        function pageInitial() {

            var bodyHeight = document.body.clientHeight;

            $.each(['activitySubject', 'activityDescription', 'activityInformation', 'joinWay', 'bankInformation', 'absentRefund'], function(i, val) {

                CKEDITOR.replace(val, {height:250, 

				filebrowserUploadUrl: 'upload.php?funcId=activitys&keyId=<? echo $activityId ?>&type=Files',

                    on: {

                        instanceReady: function() {

                            this.dataProcessor.htmlFilter.addRules( {

                                elements: {

                                    img: function( el ) {

                                        if ( !el.attributes.alt )

                                        el.addClass( 'img-responsive' );

                                    }

                                }

                            } );            

                        }

                    }

                });

            });

            

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

                  //var output = document.getElementById('output');

                  //output.src = reader.result;

                  $("#"+targetId).attr('src',reader.result);

                };

                reader.readAsDataURL(event.target.files[0]);

              };

        

        function beforeSubmit(){

        	showLoading();

        	var textFields = ["activityDateS","activityDateE","activityPlace","activityAddress","listSubject","listDescription","contentSbuject","activitySubject","activityDescription","activityInformation","joinWay","bankInformation","absentRefund"];

        	var textNames = ["活動開始日","活動結束日","活動地點","活動地址","列表主旨","列表描述","內文主旨","活動主旨","活動說明","注意事項"," 參加辦法","匯款資料","缺席退費"];

        	var imageFields = ["imgFile1","imgFile2"];

        	var imageNames = ["圖片","Banner"];

        	var selectFields = ["status","category"];

        	var selectNames = ["狀態","分類"];

        	

        	for (var i = 0; i < textFields.length; i++) {

        		console.log(textFields[i]+"="+$("#"+textFields[i]).val());

				if ($("#"+textFields[i]).val()==""){

					alert("「"+textNames[i] + "」為必填欄位!");

					$("#"+textFields[i]).focus();

					stopLoading();

					return false;

				}

			}

			

			for (var i = 0; i < imageFields.length; i++) {

				var imgFile = $("#"+imageFields[i]).val();

				var imageId = $("#ImageID"+(i+1)).val();

				//console.log("imgFile="+imgFile+" imageId="+imageId);

				if (imageId == ""){

					if (imgFile == "")	{

						alert("「"+imageNames[i] + "」為必填欄位!");

						stopLoading();

						return false;

					}

				}

			}

			

			for (var i = 0; i < selectFields.length; i++) {

				console.log(selectFields+"="+$("#"+selectFields[i]).val());

				if ($("#"+selectFields[i]).val()=="-1"){

					alert("請選擇「"+selectNames[i] + "」欄位!");

					$("#"+selectNames[i]).focus();

					stopLoading();

					return false;

				}

			}

        }

    </script>

</head>

<body>

    <form name="form1" method="post" action="activityDetail.php" id="form1" enctype="multipart/form-data">

    <div>

        <div id="UpdatePanel1">

            <div class="divDetailTopBar">

                <div id="ToolBar">

                    <div style="float: left; padding-right: 10px">

                        <span id="LabMessage" class="labMessage"><?echo "【". $modeDesc ."】" . $row["ListSubject"]?></span>

                    </div>

                </div>

            </div>

            <div id="divDetailBody" class="divDetailBody">

                <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">

                    <tr>

                    	<td align="center" bgcolor="#e5e5e5" style="width: 10%">

                            <span class="DetailLabel"><span class="Mandatory">* 狀態</span></span>

                        </td>

                        <td bgcolor="#FFFFFF" style="width:15%">

							<?

								$findStatus = "SELECT * FROM RefCommon WHERE Type = 'activityStatus' AND TypeCode <> 0 ORDER BY SortNo";

								$recStatus = mysql_query($findStatus);

							?>

							<select id="status" id="status" name="status" class="dropdownlist">

								<option value="-1" id="0" selected><? echo "---------" ?></option>

							<? while($rowStatus = mysql_fetch_assoc($recStatus)){ ?>

								<?if ($rowStatus["TypeCode"] == $row["Status"]) { ?>

									<option value="<? echo $rowStatus["TypeCode"] ?>" id="<? echo $rowStatus["TypeCode"] ?>" selected><?echo $rowStatus["CodeName"] ?></option>

								<? } else {?>

									<option value="<? echo $rowStatus["TypeCode"] ?>" id="<? echo $rowStatus["TypeCode"] ?>"><?echo $rowStatus["CodeName"] ?></option>

								<? } ?>

							<? } ?>

							</select>

                        </td>

                        <td align="center" bgcolor="#e5e5e5" style="width: 10%">

                            <span class="DetailLabel"><span class="Mandatory">* 分類</span></span>

                        </td>

						<td bgcolor="#FFFFFF"  style="width:15%">

							<?

								$findCategory = "SELECT * FROM RefCommon WHERE Type = 'activityCategory' AND TypeCode <> 0 ORDER BY SortNo";

								$recCategory = mysql_query($findCategory);

							?>

							<select id="category" name="category" class="dropdownlist">

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

						<td align="center" bgcolor="#e5e5e5" style="width: 10%">

                            <span class="DetailLabel"><span class="Mandatory">* 活動開始日</span></span>

                        </td>

                        <td bgcolor="#FFFFFF"  style="width:15%">

                            <? if (isset($row["ActivityDateS"])) {?>

                                <input id="activityDateS" name="activityDateS" type="date" class="TextBox" style="width: 95%;" value="<?echo date("Y-m-d", strtotime($row["ActivityDateS"]))?>"/>

                            <? } else {?>

                                <input id="activityDateS" name="activityDateS" type="date" class="TextBox" style="width: 95%;" value="<?echo date("Y-m-d")?>"/>

                            <? }?>

                        </td>

                        <td align="center" bgcolor="#e5e5e5" style="width: 10%">

                            <span class="DetailLabel"><span class="Mandatory">* 活動結束日</span></span>

                        </td>

                        <td bgcolor="#FFFFFF"  style="width:15%">

                            <? if (isset($row["ActivityDateE"])) {?>

                                <input id="activityDateE" name="activityDateE" type="date" class="TextBox" style="width: 95%;" value="<?echo date("Y-m-d", strtotime($row["ActivityDateE"]))?>"/>

                            <? } else {?>

                                <input id="activityDateE" name="activityDateE" type="date" class="TextBox" style="width: 95%;" value="<?echo date("Y-m-d")?>"/>

                            <? }?>

                        </td>

                        

                        

                    </tr>

					<tr>

                        <td align="center" bgcolor="#e5e5e5">

                            <span class="DetailLabel"><span class="Mandatory">* 活動地點</span></span>

                        </td>

                        <td colspan="3" bgcolor="#FFFFFF">

                            <input id="activityPlace" name="activityPlace" type="text" class="TextBox" style="width: 98%;" value="<?echo $row["ActivityPlace"]?>"/>

                        </td>

                        <td align="center" bgcolor="#e5e5e5">

                            <span class="DetailLabel"><span class="Mandatory">* 活動地址</span></span>

                        </td>

                        <td colspan="3" bgcolor="#FFFFFF">

                            <input id="activityAddress" name="activityAddress" type="text" class="TextBox" style="width: 98%;" value="<?echo $row["ActivityAddress"]?>"/>

                        </td>

					</tr>

                    <tr>

                        <td align="center" bgcolor="#e5e5e5">

                            <span class="DetailLabel"><span class="Mandatory">* 列表主旨</span></span>

                        </td>

                        <td colspan="3" bgcolor="#FFFFFF">

                            <input id="listSubject" name="listSubject" type="text" class="TextBox" maxlength="20" style="width: 98%;" value="<?echo $row["ListSubject"]?>"/>

                        </td>

                        <td align="center" bgcolor="#e5e5e5">

                            <span class="DetailLabel"><span class="Mandatory">* 內文主旨</span></span>

                        </td>

                        <td colspan="3" bgcolor="#FFFFFF">

                            <input id="contentSbuject" name="contentSbuject" type="text" class="TextBox" style="width: 98%;" value="<?echo $row["ContentSbuject"]?>"/>

                        </td>

					</tr>

                    <tr>

                        <td align="center" bgcolor="#e5e5e5">

                            <span class="DetailLabel"><span class="Mandatory">* 列表描述</span></span>

                        </td>

                        <td colspan="7" bgcolor="#FFFFFF">

                            <input id="listDescription" name="listDescription" type="text" class="TextBox" style="width: 99%;" value="<?echo $row["ListDescription"]?>"/>

                        </td>

					</tr>

					<tr>

                        

                        <td align="center" bgcolor="#e5e5e5">

                            <span class="DetailLabel">like數量</span>

                        </td>

                        <td bgcolor="#FFFFFF">

                            <input id="likes" name="likes" type="number" class="TextBox" style="width: 90%;" value="<?echo $row["Likes"]?>"/>

                        </td>

                        <td align="center" bgcolor="#e5e5e5">

                            <span class="DetailLabel">同行人數上限</span>

                        </td>

                        <td bgcolor="#FFFFFF">

                            <input id="companionLimit" name="companionLimit" type="number" class="TextBox" style="width: 95%;" value="<?echo $row["CompanionLimit"]?>"/>

                        </td>

                        <td align="center" bgcolor="#e5e5e5">

                            

                        </td>

                        <td bgcolor="#FFFFFF" colspan="3">

                            

                        </td>

                    </tr>

                    <tr>

						<td align="center" bgcolor="#e5e5e5">

                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* 圖片</span><br/><span style="color:#333333;font-size:12px">(500 * 333)</span></span><br>

                            <p style="height:3;"></p>

                            <input type="file" name="imgFile1" id="imgFile1" accept="image/*" onchange="loadFile(event,'image1')" style="width:70px">

                            <p style="height:3;"></p>

                            <? if ($row["ImageID1"] != ""){?>

                            <input type="button" name="ibDelete1" id="ibDelete1" value="刪除" onClick="showLoading();delImage('<? echo $row["ImageID1"]?>','1')" />

                            <? } ?>

                            <p style="height:3;"></p>

                        </td>

                        <td bgcolor="#ffffff">

                        	<img id="image1" width="178px" height="150px" src="<?echo $row["ImageFile1"]?>" style="board:0px" />

                            <input name="ImageID1" type="hidden" id="ImageID1" class="TextBox" style="width: 80%;" value="<?echo $row["ImageID1"]?>"/>

                        </td>

						<td align="center" bgcolor="#e5e5e5">

                            <span id="Label2" class="DetailLabel"><span class="Mandatory">* Banner</span><br/><span style="color:#333333;font-size:12px">(1038 * 568)</span></span><br>

                            <p style="height:3;"></p>

                            <input type="file" name="imgFile2" id="imgFile2" accept="image/*" onchange="loadFile(event,'image2')" style="width:70px">

                            <p style="height:3;"></p>

                            <? if ($row["ImageID2"] != ""){?>

                            <input type="button" name="ibDelete" id="ibDelete2" value="刪除" onClick="showLoading();delImage('<? echo $row["ImageID2"]?>','2')" />

                            <? } ?>

                            <p style="height:3;"></p>

                        </td>

                        <td colspan="6" bgcolor="#ffffff">

                        	<img id="image2" width="900px" height="300px" src="<?echo $row["ImageFile2"]?>" style="board:0px" />

                            <input name="ImageID2" type="hidden" id="ImageID2" class="TextBox" style="width: 80%;" value="<?echo $row["ImageID2"]?>"/>

                        </td>

					</tr>

                    

                    

                    <tr>

                    	<td align="center" bgcolor="#e5e5e5">

                    		<span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 活動主旨</span></span>

                    	</td>

                        <td colspan="9" bgcolor="#FFFFFF" >

                            <textarea id="activitySubject" name="activitySubject"><?echo $row["ActivitySubject"]?></textarea>

                        </td>

                    </tr>

                    <tr>

                    	<td align="center" bgcolor="#e5e5e5">

                    		<span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 活動說明</span></span>

                    	</td>

                        <td colspan="9" bgcolor="#FFFFFF" >

                            <textarea id="activityDescription" name="activityDescription"><?echo $row["ActivityDescription"]?></textarea>

                        </td>

                    </tr>

                    <tr>

                    	<td align="center" bgcolor="#e5e5e5">

                    		<span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 注意事項</span></span>

                    	</td>

                        <td colspan="9" bgcolor="#FFFFFF" >

                            <textarea id="activityInformation" name="activityInformation"><?echo $row["ActivityInformation"]?></textarea>

                        </td>

                    </tr>

                    <tr>

                    	<td align="center" bgcolor="#e5e5e5">

                    		<span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 參加辦法</span></span>

                    	</td>

                        <td colspan="9" bgcolor="#FFFFFF" >

                            <textarea id="joinWay" name="joinWay"><?echo $row["JoinWay"]?></textarea>

                        </td>

                    </tr>

                    <tr>

                    	<td align="center" bgcolor="#e5e5e5">

                    		<span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 匯款資料</span></span>

                    	</td>

                        <td colspan="9" bgcolor="#FFFFFF" >

                            <textarea id="bankInformation" name="bankInformation"><?echo $row["BankInformation"]?></textarea>

                        </td>

                    </tr>

                    <tr>

                    	<td align="center" bgcolor="#e5e5e5">

                    		<span id="labMemberCode" class="DetailLabel"><span class="Mandatory">* 缺席退費</span></span>

                    	</td>

                        <td colspan="9" bgcolor="#FFFFFF" >

                            <textarea id="absentRefund" name="absentRefund"><?echo $row["AbsentRefund"]?></textarea>

                        </td>

                    </tr>

                    <tr>

                        <td align="center" bgcolor="#e5e5e5">

                            <span id="labMemberCode" class="DetailLabel">建立人員</span>

                        </td>

                      <td bgcolor="#FFFFFF">

							<? echo $row["createUserName"] ?>

						</td>

						<td align="center" bgcolor="#e5e5e5">

                            <span id="Label3" class="DetailLabel">建立日期</span>

                        </td>

                        <td bgcolor="#FFFFFF">

							<? echo $row["CreateDate"]?>

                        </td>

						 <td align="center" bgcolor="#e5e5e5">

                            <span id="Label3" class="DetailLabel">異動人員</span>

                        </td>

                        <td bgcolor="#FFFFFF">

                            <? echo $row["updateUserName"]  ?>

						</td>

						<td align="center" bgcolor="#e5e5e5">

                            <span id="labMemberCode" class="DetailLabel">異動日期</span>

                        </td>

                        <td colspan="3" bgcolor="#FFFFFF">

                            <? echo $row["UpdateDate"]  ?>

						</td>

                    </tr>

                </table>

                <div style="width:100%; text-align:center">

                    <p style="height:20px;"></p>

   		      		<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit();" style="font-size:12pt; height:35px" />

            		<input type="hidden" name="activityId" value="<? echo $activityId?>"/>

            		<input type="hidden" name="action" value="update"/>

                    <p style="height:20px;"></p>

            	</div>

            </div>

        </div>

    </form>

</body>

</html>

