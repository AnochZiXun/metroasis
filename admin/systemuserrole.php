<?php
include_once("_connMysql.php");
include_once("check_login.php");
$SystemUsersRoles_sql_Delete = "DELETE FROM `SystemUsersRoles` WHERE NewFlag = 1";
mysql_query($SystemUsersRoles_sql_Delete);
if (isset($_POST["delete"])) {
	$systemUsersRoleID = $_POST["SystemUsersRoleID"];
    if($systemUsersRoleID == "1"){
	   echo "<script>alert('Administrator is IMMORTAL!!!')</script>";
    }else{
        $rec_isAnyonePlayThisRole = mysql_query("SELECT * FROM SystemUsers WHERE SystemUsersRoleID = '$systemUsersRoleID'");
        $count_isAnyonePlayThisRole = $rec_isAnyonePlayThisRole ? mysql_num_rows($rec_isAnyonePlayThisRole) : 0 ;
        if($count_isAnyonePlayThisRole > 0){
            echo "<script>alert('使用中的角色無法刪除!')</script>";
        }else{
            $deleteSql = "DELETE FROM SystemUsersRoles WHERE `SystemUsersRoleID` = $systemUsersRoleID";
            mysql_query($deleteSql);    
            $delete_RolesDetail = "DELETE FROM `SystemUsersRolesDetail` WHERE `SystemUsersRoleID`=$systemUsersRoleID";  
            mysql_query($delete_RolesDetail);
            header("Location: systemuserrole.php");
        }
    }
}
$query_UsersRoles = 'SELECT * FROM `SystemUsersRoles` ORDER BY SystemUsersRoleID';
$Rec_UsersRoles = mysql_query($query_UsersRoles);
//預設每頁筆數
$pageRow_records = 5;
//總筆數
$total_records = mysql_num_rows($Rec_UsersRoles);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
//echo $query_news.' LIMIT '.$start.', '.$pageRow_records;
$RecSystemUsers = mysql_query($query_UsersRoles.' LIMIT '.$start.', '.$pageRow_records);
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
        		$("#iDetail").attr("src","systemuserroleDetail.php");	
        	}else{
        		$("#iDetail").attr("src","systemuserroleDetail.php?SystemUsersRoleID="+intNo);	
        	}
        	$('#divWork').animate({scrollTop: $("#divDetail").offset().top - 50}, 'slow');
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
                                	<input type="button" name="ibAdd" id="btnAdd" class="add" value=" 新增角色" onclick="setdetail('')"/>
                                </div>
                                <div style="height:10px;"></div>
                        <div id="divDetailBody">
                            <div id="divGridview">
                                <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                        style="border-collapse: collapse;">
										<tr>
											<th scope="col" style="width: 4%;">
                                                #
                                            </th>
                                            <th scope="col" style="width: 32%;">
                                                角色名稱
                                            </th>
                                            <th scope="col" style="width: 32%;">
                                                角色描述
                                            </th>                                          
											<th scope="col" style="width: 32%;">
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
                                                <span class="b_12"><? echo $row["SystemUsersRoleName"]; ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo $row["SystemUsersRoleDesc"]; ?></span>
                                            </td>                                           
											<td align="center">
												<input id="btnEdit" name="btnEdit" class="detail"  type="button" value="修改" onclick="setdetail('<?echo $row["SystemUsersRoleID"]?>')" />
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
													<input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) return false;" />
													<input name="SystemUsersRoleID" type="hidden" value="<? echo $row["SystemUsersRoleID"]; ?>"/>
													<input name="action" type="hidden" value="delete"/>
												</form>
                                            </td>
                                        </tr>
										<? $rowNumber = $rowNumber + 1;} ?>
                                    </table>
                                </div>
                                <p style="height:10;"></p>
                            </div>
                            <br/>
							<div class="GridViewFooter" align="center">
                                <table class="TableNoLine">
                                    <tr>
                                        <td>
                                            <span id="PageControl1_labCount">筆數</span>： <span id="PageControl1_lblTotalCount">
                                                <? echo $total_records?></span>｜
                                        </td>
                                        <td>
											<a href="systemuserrole.php?page=1">最前頁｜</a>
                                        </td>
                                        <?	
											$prePage = $page-1;
											if ($prePage < 1) {
												$prePage = 1;
											}
										?>
										<td>
											<a href="systemuserrole.php?page=<?echo $prePage?>">上頁｜</a>
                                        </td>
										<?	
											$nextPage = $page+1;
											if ($nextPage > $total_pages) {
												$nextPage = $total_pages;
											}
										?>
                                        <td>
											<a href="systemuserrole.php?page=<?echo $nextPage?>">下頁｜</a>
                                        </td>
                                        <td>
											<a href="systemuserrole.php?page=<?echo $total_pages?>">最後頁</a>
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
