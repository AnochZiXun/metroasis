<?php
include_once("_connMysql.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];

$rec_adminUserID = mysql_query("SELECT UserID FROM SystemUsers WHERE SystemUsersRoleID = (SELECT SystemUsersRoleID FROM SystemUsersRoles WHERE RoleLevel = '1') ");
$adminUserID = "";
if($rec_adminUserID){
    $row_adminUserID = mysql_fetch_assoc($rec_adminUserID);
    $adminUserID = $row_adminUserID["UserID"];
}

$SystemUsers_sql_Delete = "DELETE FROM SystemUsers WHERE NewFlag = 1 AND CreateUserID = '$currentUserID'";
mysql_query($SystemUsers_sql_Delete);
if (isset($_POST["delete"])) {
	$userID = $_POST["UserID"];
    if($userID == $adminUserID){
        echo "<script>alert('Administrator is IMMORTAL!!!')</script>";
    }else{
        $deleteSql = "delete from `SystemUsers` where UserID = $userID";
    mysql_query($deleteSql);
    header("Location: systemusers.php");
    }
}
$query_SystemUsers = 'SELECT * FROM `SystemUsers`';
$rec_SystemUsers = mysql_query($query_SystemUsers);
//預設每頁筆數
$pageRow_records = 20;
//總筆數
$total_records = mysql_num_rows($rec_SystemUsers);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
//echo $query_news.' LIMIT '.$start.', '.$pageRow_records;
$RecSystemUsers = mysql_query($query_SystemUsers.' LIMIT '.$start.', '.$pageRow_records);
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
<head id="MainMasterHead">
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
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
        function pageInitial(){
            var bodyHeight = document.body.clientHeight;
            $("input[type=submit], input[type=button]" ).button();
        }
        
        function setdetail(intNo){
        	if (intNo ==""){
        		$("#iDetail").attr("src","systemusersDetail.php");	
        	}else{
        		$("#iDetail").attr("src","systemusersDetail.php?userID="+intNo);	
        	}
        	$('#divWork').animate({scrollTop: $("#divDetail").offset().top - 50}, 'slow');
        }
        
        var adminUserID = "<? echo $adminUserID ?>";
        var currentUserID = "<? echo $currentUserID ?>";
        function beforeClickEdit($this){
            var thisUserID = jQuery($this).parent().find("#UserID").val();
            if(currentUserID == adminUserID){
                return true;
            }else if(currentUserID != adminUserID && currentUserID == thisUserID){
                return true;
            }else{
                alert("您只能修改自己的帳號!");
                return false;
            }
        }
        function beforeClickDelete($this){
            var thisUserID = jQuery($this).parent().find("#UserID").val();
            if(currentUserID == adminUserID && currentUserID == thisUserID){
                alert("神聖且偉大的系統管理者是不朽的!");
                return false;
                
            }else if(currentUserID == adminUserID){
                return true;
            }else{
                alert("只有神聖且偉大的系統管理者才能刪除帳號!");
                return false;
            }
        }
    </script>
</head>
<body>
    <div id="divBody" style="width:1600px; margin: 0 auto; ">
		<!-- 加上方選單 -->
		<?php include_once("_nav.php"); ?>
        <div style="">
			<!-- 加左方選單 -->
			<?php include_once("left_nav.php"); ?>
            <div id="divWork" style="float: left; width: 90%;">
                <div class="divWorkArea">
                    <div id="UpdatePanel1">
                    			<div style="height:10px;"></div>
                                <div align="right">
                                	<input type="button" name="ibAdd" id="btnAdd" class="add" value=" 新增帳號" onclick="setdetail('')"/>
                                </div>
                                <div style="height:10px;"></div>
                        <div id="divDetailBody">
                            <div id="divGridview">
                                <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                        style="border-collapse: collapse;">
										<tr>
											<th scope="col" style="width: 3%;">
                                                #
                                            </th>
                                            <th scope="col" style="width: 5%;">
                                                狀態
                                            </th>
                                            <th scope="col" style="width: 10%;">
                                                帳號
                                            </th>
                                            <th scope="col" style="width: 10%;">
                                                密碼
                                            </th>
                                            <th scope="col" style="width: 27%;">
                                                E-mail
                                            </th>
                                            <th scope="col" style="width: 12%;">
                                                角色
                                            </th>
											<th scope="col" style="width: 18%;">
                                                功能
                                            </th>											
                                        </tr>
                                        <?  if ($page > 1) {
                                        		$rowNumber = ($pageRow_records * ($page - 1)) + 1;
                                        	}else{
                                        		$rowNumber = 1;
                                        	}                                        	
                                        	while($row=mysql_fetch_assoc($RecSystemUsers)){ ?>
										<tr>
											<td align="center">
                                                <span class="b_12"><? echo $rowNumber ?></span>
                                            </td>
                                            <td align="center">
                                            	<? if ($row["Status"] =="1"){ ?>
                                                	<img src="images/up_green.png" width="28px" height="28px" />
                                                <? }else{ ?>
                                                	<img src="images/down_red.png" width="28px" height="28px"/>
                                                <? } ?>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo $row["UserName"]; ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo "********"; ?></span>
                                            </td>
                                            <td align="left" style="padding-left:20px;">
                                            	<span class="b_12"><? echo $row["Email"]; ?></span>
                                            </td>
											<?php 
												$query_Roles = "SELECT * FROM `SystemUsersRoles` WHERE `SystemUsersRoleID`='".$row["SystemUsersRoleID"]."'";											
												$row_Roles=mysql_fetch_assoc(mysql_query($query_Roles)); 
											?>
                                            <td align="center">
                                            	<span class="b_12"><? echo $row_Roles["SystemUsersRoleName"]; ?></span>
                                            </td>
											<td align="center">
												<input id="btnEdit" name="btnEdit" class="detail"  type="button" value="修改" onclick="if(beforeClickEdit(this)) setdetail('<?echo $row["UserID"]?>')" />
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
													<input name="delete" type="submit" value="刪除" OnClick="if(beforeClickDelete(this)){ if (!confirm('確認刪除此筆資料?')) return false; }else{ return false; }" />
													<input name="UserID" id="UserID" type="hidden" value="<? echo $row["UserID"]; ?>"/>
													<input name="action" type="hidden" value="delete"/>
												</form>
                                            </td>
                                        </tr>
										<? $rowNumber = $rowNumber + 1;} ?>
                                    </table>
                                    <br/>
                                </div>
                            </div>
							<div class="GridViewFooter" align="center">
                                <table class="TableNoLine">
                                    <tr>
                                        <td>
                                            <span id="PageControl1_labCount">筆數</span>： <span id="PageControl1_lblTotalCount">
                                                <? echo $total_records?></span>｜
                                        </td>
                                        <td>
											<a href="systemusers.php?page=1">最前頁｜</a>
                                        </td>
                                        <?	
											$prePage = $page-1;
											if ($prePage < 1) {
												$prePage = 1;
											}
										?>
										<td>
											<a href="systemusers.php?page=<?echo $prePage?>">上頁｜</a>
                                        </td>
										<?	
											$nextPage = $page+1;
											if ($nextPage > $total_pages) {
												$nextPage = $total_pages;
											}
										?>
                                        <td>
											<a href="systemusers.php?page=<?echo $nextPage?>">下頁｜</a>
                                        </td>
                                        <td>
											<a href="systemusers.php?page=<?echo $total_pages?>">最後頁</a>
                                        </td>
                                        <td>
                                            ｜<span id="PageControl1_labPage">頁數</span>： <span id="PageControl1_lblCurrentPage">
                                                <?echo $page?></span>/<span id="PageControl1_lblTotalPage"><?echo $total_pages?></span>
                                        </td>
                                        <td>
                                            <span id="PageControl1_labTotal"></span>
                                        </td>
                                        <td width="30"><!----></td>
                                        <td>
                                            <select onChange="location = this.options[this.selectedIndex].value;">
                                              <?php
                                                for($i=1 ; $i<$total_pages+1 ; $i++)
                                                {
                                              ?>
                                                    <option value="<?php $_SERVER['PHP_SELF']; ?>?page=<?php echo $i; ?>" <?php if($page==$i){echo "selected";} ?>>第 <?php echo $i; ?> 頁</option>
                                              <?php
                                                }
                                              ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div style="height:35px;"></div>
                        
                        <div id="divDetail">
	                    	<iframe id="iDetail" src="" width="100%" height="1050" frameborder="0" scrolling="no"></iframe>
	                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
