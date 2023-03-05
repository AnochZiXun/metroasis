<?php
include_once("_connMysql.php");
include_once("_function.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];
$page = $_GET["page"];
$isNew = false;
if(isset($_GET["activityClassID"])){
    $activityClassID = $_GET["activityClassID"];
    $rec_newFlag = mysql_query("SELECT NewFlag FROM ActivityClass WHERE ActivityClassID = '$activityClassID'");
    if($rec_newFlag){
        while($row_newFlag = mysql_fetch_assoc($rec_newFlag)){
            if ($row_newFlag["NewFlag"] == "1") $isNew = true;
        }
    }
}else{
    if($_POST["action"] != "update"){
        mysql_query("DELETE FROM ActivityClass WHERE NewFlag = 1 AND CreateUserID = '$currentUserID'");
        $maxBatch = 1;
        $rec_maxBatch = mysql_query("SELECT MAX(Batch)+1 AS MaxBatch FROM ActivityClass");
        if($rec_maxBatch){
            $row_maxBatch = mysql_fetch_assoc($rec_maxBatch);
            $maxBatch = $row_maxBatch["MaxBatch"];
        }
        mysql_query("INSERT INTO ActivityClass(NewFlag, CreateUserID, Batch) VALUES ('1', '$currentUserID', '$maxBatch')");
        $activityClassID = mysql_insert_id();
        $isNew = true;
    }
}
if ($_POST["action"] == "update"){ 
    $activityClassID = $_POST["ActivityClassID"];
    $batch = $_POST["Batch"];
    $activityName = $_POST["ActivityName"];
    $activityDate = empty($_POST["ActivityDate"]) ? 'NULL' : $_POST["ActivityDate"];
    $sessionA = $_POST["SessionA"];
    $sessionB = $_POST["SessionB"];
    $sessionC = $_POST["SessionC"];
    $venue = $_POST["Venue"];
    $quota = $_POST["Quota"];
    $gatheringTime = $_POST["GatheringTime"];
    $waitingNumber = $_POST["WaitingNumber"];
    $cost = $_POST["Cost"];
    $status = $_POST["Status"];
    $visibility = $_POST["Visibility"];
    $content = $_POST["ckeditor"];
    $sql_update = "UPDATE ActivityClass SET
                    Batch = '$batch',
                    ActivityName = '$activityName',
                    ActivityDate = '$activityDate',
                    SessionA = '$sessionA',
                    SessionB = '$sessionB',
                    SessionC = '$sessionC',
                    Venue = '$venue',
                    Quota = '$quota',
                    GatheringTime = '$gatheringTime',
                    WaitingNumber = '$waitingNumber',
                    Cost = '$cost',
                    Status = '$status',
                    Visibility = '$visibility',
                    Content = '$content',
                    NewFlag = '0', ";
    if($isNew){
        $sql_update .= "CreateUserID = '$currentUserID', CreateDate = NOW() ";
    }else{
        $sql_update .= "UpdateUserID = '$currentUserID', UpdateDate = NOW() ";
    }
    $sql_update .= "WHERE ActivityClassID = '$activityClassID'";
    //echo $sql_update;
    mysql_query($sql_update);
    #picture upload
    $targetFolder = "/home/metroasis/public_html/images/activityClass/";
    if (!file_exists($targetFolder)) {
        @mkdir($targetFolder);
    }
    if ($activityClassID != ""){
        $targetFolder = "/home/metroasis/public_html/images/activityClass/$activityClassID";
        if (!file_exists($targetFolder)) {
            @mkdir($targetFolder);
        }
    }
    $target_dir = "/home/metroasis/public_html/images/activityClass/$activityClassID/";
    $ImagefilePath = "/images/activityClass/$activityClassID/";
    $Message ="";
    if (isset($_FILES['imgFile1']) && $_FILES['imgFile1']['size'] > 0) {
        if (move_uploaded_file($_FILES['imgFile1']['tmp_name'], $target_dir . $_FILES['imgFile1']['name'])) {
            $ImageID1 = $_POST["ImageID1"];
            if ($ImageID1 != ""){
                $insert = "UPDATE ImagesFiles SET ImageFileName = '". $_FILES['imgFile1']['name'] ."' WHERE ImageID = " . $ImageID1;
            }else{
                $insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$activityClassID','activityClass','promotePicture','$ImagefilePath','". $_FILES['imgFile1']['name'] ."')";
            }                    
            //echo $insert;
            mysql_query($insert);
        }
    }else{
        $rec_image = mysql_query("SELECT COUNT(*) AS COUNT FROM ImagesFiles WHERE ForeignID = '$activityClassID'");
        $count_image = 0;
        if($rec_image){
            $row_image = mysql_fetch_assoc($rec_image);
            $count_image = $row_image["COUNT"];
        }
        if($count_image = 0){
            $Message = "請選擇圖片";
        }
    }
    if ($Message != ""){
        echo "<script>alert('". $Message ."');</script>";
    }else{
        echo "<script>parent.location.href='activity_class.php'; </script>";
    }
}
function getUserName($userID) {
    $query_userName_sql = "SELECT UserName FROM SystemUsers WHERE UserID=$userID and Status = 1";
    $query_userName_sql_result = mysql_query($query_userName_sql);
    if($query_userName_sql_result) {
        $row_userInfo=mysql_fetch_assoc($query_userName_sql_result);   
        $currentUserName = $row_userInfo["UserName"];
        return $currentUserName;        
    } else {
        return NULL;
    }
}
$rec_activity = mysql_query("SELECT *, (SELECT CONCAT(ImagePath, ImageFileName) FROM ImagesFiles WHERE ImageFunction = 'activityClass' AND ImageType = 'promotePicture' AND ForeignID = A.ActivityClassID LIMIT 1) AS ImageFile, (SELECT ImageID FROM ImagesFiles WHERE ImageFunction = 'activityClass' AND ImageType = 'promotePicture' AND ForeignID = A.ActivityClassID LIMIT 1) AS ImageID FROM ActivityClass A WHERE ActivityClassID = '$activityClassID'");
$row = mysql_fetch_assoc($rec_activity);
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
    <script type="text/javascript" charset="UTF-8" src="js/validateInputFile.js"></script>
    <script type="text/javascript">
        function pageInitial() {
            $(document).find(".orange_18_de5106").html("❖ 熊鷹戶外學堂");
            CKEDITOR.replace("ckeditor",{height:500,
                filebrowserUploadUrl: 'upload.php?funcId=activityClass&keyId=<? echo $activityClassID ?>&type=Files',
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
        var loadFile = function(event,targetId) {
            var $file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function(){
                $("#"+targetId).attr('src',reader.result);
            };
            showLoading();
            if(!isFileSizeOk($file,2097152)){
                alert($file["name"].replace(/.*[\/\\]/, '')+"單一檔案大小應小於2MB");
                $("#imgFile1").val("");
            }else{
                reader.readAsDataURL(event.target.files[0]);
            }
            stopLoading();
        };
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
        function beforeSubmit(){
            showLoading();
            var textFields = ["ActivityName","ActivityDate","SessionA","Venue","GatheringTime","Quota","WaitingNumber","Cost"];
            var textNames = ["活動名稱","活動日期","課程時間(A)","集合地點","集合時間","名額限制","可候補名額","活動費用"];
            var imageFields = ["imgFile1"];
            var imageNames = ["活動圖"];
            for (var i = 0; i < textFields.length; i++) {
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
                    if (imgFile == "")  {
                        alert("「"+imageNames[i] + "」為必填欄位!");
                        stopLoading();
                        return false;
                    }
                }
            }
            var content=CKEDITOR.instances.ckeditor.getData();
            if(content==""){
                alert("「活動內容」為必填欄位!");
                $("#ckeditor").focus();
                stopLoading();
                return false;
            }
            if(!validateSingleInput(document.getElementById('imgFile1'))){
                stopLoading();
                $("#imgFile1").val("");
                return false;
            }
            if(document.getElementById('imgFile1').files[0].size >= 2097152){
                alert("圖檔大小應小於2MB");
                stopLoading();
                $("#imgFile1").val("");
                return false;
            }
            stopLoading();
        }
        function isFileSizeOk(file,size){
            return file.size >= size ? false : true;
        }
    </script>
</head>
<body>
    <div id="divBody" style="width:1600px; margin: 0 auto;">
        <!-- 加上方選單 -->
        <?php include_once("_nav.php"); ?>
        <div style="overflow: hidden;">
            <!-- 加左方選單 -->
            <?php include_once("left_nav.php"); ?>
            <div id="divWork" style="float: left; width: 90%">
                <div style="height:10px;"></div>
                <div style="padding-left: 5px;">
                    <form method="post" action="activity_class.php">
                        <div style="height:10px;"></div>
                        <input type="submit" id="ibGo2List"  value="回列表"/>
                        <div style="height:5px;"></div>
                    </form>
                </div>
                <div class="divWorkArea" style="height:auto; margin-bottom: 100px;">
                	<form name="form1" method="post" action="activityDetail_class.php" id="form1" enctype="multipart/form-data">
                		<div id="UpdatePanel1" style="width:100%">
                			<div class="divDetailTopBar" style="width:100%">
                                <div id="ToolBar">
                                    <div style="float: left;">
                                        <? if($isNew){ ?>
                                            <span id="LabMessage" class="labMessage"><?echo "&nbsp;&nbsp;【". "新增 - 熊鷹戶外學堂" ."】" ?></span>
                                        <? }else{ ?>
                                            <span id="LabMessage" class="labMessage"><?echo "&nbsp;&nbsp;【". "修改 - 熊鷹戶外學堂" ."】" ?></span>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                            <div id="divDetailBody" class="divDetailBody" style="padding-top: 0px;">
                            	<table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                            		<tr>
                                    	<td style="width: 8%" align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 梯次　　</span></span>
                                        </td>
                                        <td style="width:17%" align="left" bgcolor="#ffffff">
                                            <span class="gray_12">2-<?echo $row["Batch"] ?></span>
                                            <input type="hidden" name="Batch" id="Batch" style="width: 5%;" value="<?echo $row["Batch"] ?>"/>
                                        </td>
                                        <td style="width: 8%" align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 活動狀態</span></span>
                                        </td>
                                        <td style="width:17%" align="left" bgcolor="#ffffff">
                                            <table class="RadioButtonList" border="0">
                                                <tr>
                                                    <td>
                                                        <input type="radio" name="Visibility" value="0" <?if($row["Visibility"]=="0") echo "checked"?>/>
                                                        <label for="rblStatus_1">隱藏</label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="Visibility" value="1" <?if($row["Visibility"]=="1") echo "checked"?>/>
                                                        <label for="rblStatus_1">公開&nbsp;&nbsp;</label>
                                                    </td>   
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width: 8%"  align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 報名狀態</span></span>
                                        </td>
                                        <td colspan="3" style="width: 32%" align="left" bgcolor="#ffffff">
                                            <table class="RadioButtonList" border="0">
                                                <tr>
                                                    <td>
                                                        <input type="radio" name="Status" value="0" <?if($row["Status"]=="0") echo "checked"?>/>
                                                        <label for="rblStatus_1">準備中</label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="Status" value="1" <?if($row["Status"]=="1") echo "checked"?>/>
                                                        <label for="rblStatus_1">開放報名</label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="Status" value="2" <?if($row["Status"]=="2") echo "checked"?>/>
                                                        <label for="rblStatus_1">已截止&nbsp;&nbsp;</label>
                                                    </td>     
                                                </tr>
                                            </table>
                                        </td>
                            		</tr>
                                    <tr>
                                        <td align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 活動名稱</span></span>
                                        </td>
                                        <td align="left" bgcolor="#ffffff">
                                            <input type="text" name="ActivityName" id="ActivityName"  class="TextBox" style="width: 95%;" value="<?echo $row["ActivityName"] ?>"/>
                                        </td>
                                        <td align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 活動日期</span></span>
                                            <br>
                                            <span class="gray_12">(YYYY-MM-DD)</span>                            
                                        </td>
                                        <td align="left" bgcolor="#ffffff">
                                            <input type="date" name="ActivityDate" id="ActivityDate" class="TextBox" style="width: 120px;"  value="<?echo $row["ActivityDate"]?>"/>
                                        </td>
                                        <td align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 集合時間</span></span>
                                        </td>
                                        <td width="17%" align="left" bgcolor="#ffffff">
                                            <input type="text" name="GatheringTime" id="GatheringTime"  class="TextBox" style="width: 95%;" value="<?echo $row["GatheringTime"] ?>"/>
                                        </td>
                                        <td width="8%" align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 集合地點</span></span>
                                        </td>
                                        <td width="17%" align="left" bgcolor="#ffffff">
                                            <input type="text" name="Venue" id="Venue"  class="TextBox" style="width: 95%;" value="<?echo $row["Venue"] ?>"/>
                                        </td>
                                    </tr>                    
                                    <tr>
                                        <td align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 總報名數</span></span>
                                        </td>
                                        <td align="left" bgcolor="#ffffff">
                                            <input type="number" name="Quota" id="Quota"  class="TextBox" style="width: 50px;" value="<?echo $row["Quota"] ?>" min="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
                                            <span class="b_12">位</span>
                                        </td>
                                        <td align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 候補人數</span></span>
                                        </td>
                                        <td colspan="5" align="left" bgcolor="#ffffff">
                                            <input type="number" name="WaitingNumber" id="WaitingNumber"  class="TextBox" style="width: 50px;" value="<?echo $row["WaitingNumber"] ?>" min="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
                                        	<span class="b_12">位</span>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 課程時間</span></span>
                                            <br>
                                            <span class="gray_12">(YYYY-MM-DD)</span>                            
                                        </td>
                                        <td colspan="7" align="left" bgcolor="#ffffff">
                                            <div>
                                                <span>(A)時段：</span>
                                                <input type="text" name="SessionA" id="SessionA" class="TextBox" style="width:50%;"  value="<?echo $row["SessionA"] ?>"/>
                                            </div>
                                            <div>
                                                <span>(B)時段：</span>
                                                <input type="text" name="SessionB" id="SessionB" class="TextBox" style="width:50%; margin-top: 2px;"  value="<?echo $row["SessionB"] ?>"/>
                                            </div>
                                            <div>
                                                <span>(C)時段：</span>
                                                <input type="text" name="SessionC" id="SessionC" class="TextBox" style="width:50%; margin-top: 2px;"  value="<?echo $row["SessionC"] ?>"/>
                                        	</div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td align="center" bgcolor="#e5e5e5">
                                        	<p style="height:4;"></p>
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 活動圖　</span></span>
                                            <p style="height:4;"></p>
                                            <span class="gray_12">建議尺寸<br>1040 * 1040</span>
                                            <br>
                                            <p style="height:3;"></p>
                                            <input type="file" name="imgFile1" id="imgFile1" accept="image/jpg, image/jpeg" onchange="loadFile(event,'image1')" style="width:70px">
                                            <p style="height:3;"></p>
                                            <? if ($row["ImageID"] != ""){?>
                                            <input type="button" name="ibDelete" id="ibDelete" value="刪除" onClick="showLoading();delImage('<? echo $row["ImageID"]?>')" />
                                            <? } ?>
                                        </td>
                                        <td colspan="7" align="left" bgcolor="#ffffff">
                                            <img id="image1" width="400px" height="400px" src="<?echo $row["ImageFile"]?>" style="board:0px" alt="尚未選擇圖片"/>
                                            <input name="ImageID1" type="hidden" id="ImageID1" class="TextBox" style="width: 80%;" placeholder="" value="<?echo $row["ImageID"]?>"/>
                                        </td>
                            		</tr>
                                    <tr>
                                        <td align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 活動費用</span></span>
                                        </td>
                                        <td colspan="7" align="left" bgcolor="#ffffff">
                                            <!--
                                            <textarea name="Cost" id="Cost" class="TextBox" rows="5" style="width: 99%;"><? echo $row["Cost"] ?></textarea>
                                            -->
                                            <input type="number" name="Cost" id="Cost" class="TextBox" style="width: 50px;" value="<?echo $row["Cost"] ?>" min="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td align="center" bgcolor="#e5e5e5">
                                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 活動內容</span></span>
                                        </td>
                                        <td colspan="7" align="center" bgcolor="#ffffff">
                                            <textarea name="ckeditor" id="ckeditor"><? echo $row["Content"] ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
            								<table class="TableLine" cellpadding="0" cellspacing="0" width="100%">
                                                <tr style="height: 35px;">
                                                    <td align="center" bgcolor="#e5e5e5" style="width: 12.5%">
                                                        <span class="DetailLabel">建立人員</span>
                                                    </td>
                                                    <td align="center" bgcolor="#FFFFFF" style="width: 12.5%">
                                                        <span class="b_12"><?echo $isNew ? "-" : getUserName($row["CreateUserID"]) ?></span>
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
                                                            <? if($row["UpdateUserID"] != NULL){ ?>
                                                            <span class="b_12"><? echo getUserName($row["UpdateUserID"]) ?></span>
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
                                    <input type="hidden" name="ActivityClassID" value="<? echo $activityClassID ?>"/>
                                    <input type="hidden" name="action" value="update"/>
                                    <p style="height:20px;"></p>
                                </div>
                            </div>
                		</div>
                	</form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>