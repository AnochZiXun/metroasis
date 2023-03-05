<?php
include_once("_connMysql.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];
$all_RoleMenu = $_SESSION["all_RoleMenu"];
if (isset($_GET["SystemUsersRoleID"])) {
	$systemUsersRoleID = $_GET["SystemUsersRoleID"];	
}
$mode="修改角色";
if ($systemUsersRoleID == ""){	
	$insert = "INSERT INTO `SystemUsersRoles`(`NewFlag`) VALUES ('1')";	
	mysql_query($insert);
	$systemUsersRoleID = mysql_insert_id();
	$mode = "新增角色";	
}
if ($_POST["action"] == "update"){ 
	$systemUsersRoleID = $_POST["SystemUsersRoleID"];
	$systemUsersRoleName = $_POST["SystemUsersRoleName"];	
	$systemUsersRoleDesc = $_POST["SystemUsersRoleDesc"];	
	$update = "UPDATE `SystemUsersRoles` SET 
				`SystemUsersRoleName`='$systemUsersRoleName',`SystemUsersRoleDesc`='$systemUsersRoleDesc', `NewFlag` = 0
					WHERE `SystemUsersRoleID`='$systemUsersRoleID'";	
	mysql_query($update);
	$delete_RolesDetail = "DELETE FROM `SystemUsersRolesDetail` WHERE `SystemUsersRoleID`='$systemUsersRoleID'";
	mysql_query($delete_RolesDetail);
	foreach($all_RoleMenu as $key => $value) {
		if (isset($_POST[$key])) {
			$getMenuIDList[] = $_POST[$key];
			$insert_RolesDetail = "INSERT INTO `SystemUsersRolesDetail`(`SystemUsersRoleID`, `SystemMenuID`) VALUES ('$systemUsersRoleID','$key')";
			//echo $insert_RolesDetail."</br>";
			mysql_query($insert_RolesDetail);
		}
	}	
	//echo print_r($getMenuIDList)."</br>";
	foreach($getMenuIDList as $key => $value) {
		$query_GroupID = "SELECT GroupID FROM `SystemMenus` WHERE MenuID ='$value'";
		//echo $query_GroupID."</br>";
		$rec_GroupID = mysql_query($query_GroupID);		
		while($row_GroupID=mysql_fetch_assoc($rec_GroupID)){	
			$groupIDArray[] = $row_GroupID["GroupID"];		
		}
	}
	//echo print_r($groupIDArray)."</br>";
	$groupIDArray = array_unique($groupIDArray);
	foreach($groupIDArray as $key => $value) {
		$query_MenuID = "SELECT MenuID FROM `SystemMenus` WHERE GroupID ='$value' and RootID = 1";
		$rec_MenuID = mysql_query($query_MenuID);		
		while($row_MenuID=mysql_fetch_assoc($rec_MenuID)){	
			$menuID = $row_MenuID["MenuID"];
			$insert_RolesDetail = "INSERT INTO `SystemUsersRolesDetail`(`SystemUsersRoleID`, `SystemMenuID`) VALUES ('$systemUsersRoleID','$menuID')";
			//echo $insert_RolesDetail."</br>";
			mysql_query($insert_RolesDetail);	
		}
	}
	echo "<script>parent.location.href='systemuserrole.php'; </script>";
}
$query = "SELECT * FROM `SystemUsersRoles` where SystemUsersRoleID = '$systemUsersRoleID'";
$Rec = mysql_query($query);
$row=mysql_fetch_assoc($Rec);
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
    </script>
</head>
<body>
    <form name="form1" method="post" action="" id="form1" enctype="multipart/form-data">
    <div>
        <div id="UpdatePanel1">
            <div class="divDetailTopBar">
                <div id="ToolBar">
                    <div style="float: left;">
                        <span id="LabMessage" class="labMessage"><?echo "【". $mode ."】" . $row["ShortTitle"]?></span>
                    </div>
                </div>
            </div>
            <div id="divDetailBody" class="divDetailBody" align="center">
                <p style="height:6;"></p>
                <table class="TableLine" border="1px" cellpadding="5px" width="30%" bordercolor="#BABAD2">
                    <tr>
                    	<td style="width: 8%"  align="center" bgcolor="#e5e5e5" >
                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 角色名稱</span></span>
                        </td>    
                        <td style="width: 17%" align="center" bgcolor="#ffffff">
                            <input name="SystemUsersRoleName" type="text" id="SystemUsersRoleName" class="TextBox" style="width: 96%;" value="<?echo $row["SystemUsersRoleName"]?>"/>
                        </td>
                    </tr>
                    <tr>
						<td align="center" bgcolor="#e5e5e5">
                            <span id="Label20" class="DetailLabel"><span class="Mandatory">* 角色描述</span></span>
                        </td>    
                        <td align="center" bgcolor="#ffffff">
                            <input name="SystemUsersRoleDesc" type="text" id="SystemUsersRoleDesc" class="TextBox" style="width: 96%;" value="<?echo $row["SystemUsersRoleDesc"]?>"/>
                        </td>
                    </tr>
                </table>
                <p style="height:10px;"></p>
                <table class="TableLine" border="1px" cellpadding="5px" cellspacing="0" width="280" bordercolor="#BABAD2">
					<?php						
						if ($systemUsersRoleID != "") {
							$query_RoleMenu = "SELECT SystemMenuID FROM  `SystemUsersRolesDetail` WHERE `SystemUsersRoleID`='".$row["SystemUsersRoleID"]."'";
							$RecRoleMenu = mysql_query($query_RoleMenu);			
							while($row_RoleMenu=mysql_fetch_assoc($RecRoleMenu)){
								$roleMenuArray[] = $row_RoleMenu["SystemMenuID"];
							}		
						}						
					?>
					<tr>
						<?php 
							$tdCount = 0;	
							foreach($all_RoleMenu as $key => $value)
							{ 
								$tdCount++;
						?>
                                <td style="width: 18%" align="left" bgcolor="#ffffff">
                                    <input id="MenuID" type="checkbox" name="<?echo $key ?>" value="<?echo $key ?>" 
                                            <?php if ( count($roleMenuArray) != 0) { if (in_array($key, $roleMenuArray)) {echo "checked";} }?> />
                                    <span id="Label20" class="DetailLabel"><span class="b_13"><? echo $value; ?></span></span>
                                </td>    
						<?
                        		if ($tdCount % 2 == 0) {echo "</tr><tr>";}
							}
						?>	
					</tr>
                </table>
                <div style="width:100%; text-align:center">
                	<p style="height:20px;"></p>
   		      		<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="showLoading();" style="font-size:12pt; height:35px" class="ui-button ui-widget ui-state-default ui-corner-all ui-state-hover"/>
            		<input type="hidden" name="SystemUsersRoleID" value="<? echo $systemUsersRoleID?>"/>
            		<input type="hidden" name="action" value="update"/>
                    <p style="height:20px;"></p>
            	</div>
            </div>
        </div>
        <br/>
    </form>
</body>
</html>
