<?php
include_once("_connMysql.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];
//$product_sql_Delete = "DELETE FROM Customers WHERE NewFlag = 1 AND CreateUserID = '$currentUserID'";
mysql_query($product_sql_Delete);
$query_customer_sql = "SELECT * FROM Customers WHERE 1 AND NewFlag = '0'";
$orderBy = ' order by CreateDate desc';
$identityNo = (isset($_POST["IdentityNo"]) && $_POST["IdentityNo"] != "") ? $_POST["IdentityNo"] : (isset($_GET["IdentityNo"]) ? $_GET["IdentityNo"] : "");
$chineseName = (isset($_POST["ChineseName"]) && $_POST["ChineseName"] != "") ? $_POST["ChineseName"] : (isset($_GET["ChineseName"]) ? $_GET["ChineseName"] : "");
$mobile = (isset($_POST["Mobile"]) && $_POST["Mobile"] != "") ? $_POST["Mobile"] : (isset($_GET["Mobile"]) ? $_GET["Mobile"] : "");
if(trim($identityNo) != ""){
	$query_customer_sql = $identityNo ? $query_customer_sql.' and IdentityNo like "%'.trim($identityNo).'%" ' : $query_customer_sql;
}
if(trim($chineseName) != ""){
	$query_customer_sql = $chineseName ? $query_customer_sql.' and ChineseName like "%'.trim($chineseName).'%" ' : $query_customer_sql; 
}
if(trim($mobile) != ""){
	$query_customer_sql = $mobile ? $query_customer_sql.' and Mobile like "%'.trim($mobile).'%" ' : $query_customer_sql;
}
$recCustomers = mysql_query($query_customer_sql);
$query_customer_sql = $query_customer_sql.$orderBy;
//delete
if(isset($_POST["delete"])) {
	$customerID = $_POST["customerId"];
	$deleteSql = "delete from Customers where CustomerID = '$customerID'";
	//echo $deleteSql;
	mysql_query($deleteSql);	
	header("Location: customers.php");
}
//預設每頁筆數
$pageRow_records = 20;
//總筆數
$total_records = mysql_num_rows($recCustomers);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if(!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
$recCustomers = mysql_query($query_customer_sql.' LIMIT '.$start.', '.$pageRow_records);
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
    <script type="text/javascript" charset="UTF-8">		
        function pageInitial(){
            var bodyHeight = document.body.clientHeight;
            $("#divWork").attr("style", "float: left; width: 90%;");
			$("input[type=submit], input[type=button]" ).button();
        }
		function setdetail(intNo){        	
			if (intNo ==""){	$("#iDetail").attr("src","customerDetail.php");						}
			else{        		$("#iDetail").attr("src","customerDetail.php?customerId="+intNo);	}
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
            <div id="divWork">
                <div class="divWorkArea">
                    <div id="UpdatePanel1">
                    	<div id="divGridview">
                            <div style="height:5px;"></div>
    	                    <div style="height: 36px; padding-top: 5px; border-left:1px solid #CCCCCC; border-top:1px solid #CCCCCC; border-right:1px solid #CCCCCC; background-color:#FFF;">
							<form action="" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
								<div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
									&nbsp;&nbsp;身分證字號：
								</div>
								<div style="float: left; padding-right:10px; padding-top: 3px;">
									<input type="text" class="TextBox" name="IdentityNo" style="width:120px" value="<? echo $identityNo ?>">
								</div>
								<div style="float: left; height: 25px; padding-top:5px; padding-left:30px; font-size:13px">
									會員姓名：
								</div>
								<div style="float: left; padding-right:10px; padding-top: 3px;">
									<input type="text" class="TextBox" name="ChineseName" style="width:120px" value="<? echo $chineseName ?>">
								</div>
								<div style="float: left; height: 25px; padding-top:5px; padding-left:30px; font-size:13px">
									行動電話：
								</div>
								<div style="float: left; padding-right:10px; padding-top: 3px;">
									<input type="text" class="TextBox" name="Mobile" style="width:120px" value="<? echo $mobile ?>">
								</div>
								<div style="float: left; padding-right:10px; padding-left:30px; padding-top:3px;">
									<input name="submitSearch" type="submit" value="查詢"/>
								</div>
							</form>
                                <!--
                                <div style="float: right;padding-top: 4px;">                                
                                    <input type="button" name="ibAdd" id="btnAdd" class="add" value=" 新增會員 " onclick="setdetail('')"/>
                                    &nbsp;&nbsp;                         
                                </div>
                                -->
                            </div>
                        </div>
                        <div id="divDetailBody">
                            <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                        style="border-collapse: collapse;">
										<tr>
											<th scope="col" style="width: 3%;">#</th>
                                            <th scope="col" style="width: 9%;">身分證字號</th>
                                            <th scope="col" style="width: 8%;">會員姓名</th>
											<th scope="col" style="width: 9%;">行動電話</th>
                                            <th scope="col" style="width: 9%;">出生日期</th>
											<th scope="col" style="width: 5%;">性別</th>
											<th scope="col" style="width: 30%;">E-mail</th>
											<th scope="col" style="width: 12%;">加入會員時間</th>
											<th scope="col" style="width: 15%;">功能</th>
                                        </tr>
                                        <?  if ($page > 1) {
                                        		$rowNumber = ($pageRow_records * ($page - 1)) + 1;
                                        	}else{
                                        		$rowNumber = 1;
                                        	}  
											while($row=mysql_fetch_assoc($recCustomers)){ ?>
										<tr>
											<td align="center">
                                                <span class="b_12"><? echo $rowNumber ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo setData($row["IdentityNo"]); ?></span>
                                            </td>
                                            <td align="center">
												<span class="b_12"><? echo setData($row["ChineseName"]); ?></span>
                                            </td>
                                            <td align="center">
												<span class="b_12"><? echo setData($row["Mobile"]); ?></span>
                                            </td>
											 <td align="center">
												<span class="b_12"><? echo setData($row["Birthday"]); ?></span>
                                            </td>
                                            <td align="center">
												<span class="b_12"><? echo setData(($row["Gender"] == 1 ? '男':'女')); ?></span>
                                            </td>
                                            <td align="left" style="padding-left:20px;">
												<span class="b_12"><? echo setData($row["EMail"]); ?></span>
                                            </td>
                                            <td align="center">
												<span class="b_12"><? echo setData($row["RegisterDate"]); ?></span>
                                            </td>
											<td align="center">
												<input id="btnEdit" name="btnEdit" class="detail"  type="button" value="修改" onclick="setdetail('<?echo $row["CustomerID"]?>')" />
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
													<input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) return false;" />
													<input name="customerId" type="hidden" value="<? echo $row["CustomerID"]; ?>"/>
													<input name="action" type="hidden" value="delete"/>
												</form>
                                            </td>
                                        </tr>
										<? $rowNumber = $rowNumber + 1;} ?>
                                    </table>
                                    <br/>
                            </div>
                            <div class="GridViewFooter" align="center">
                                <table class="TableNoLine">
                                    <tr>
                                        <td>
                                            <span id="PageControl1_labCount">筆數</span>： <span id="PageControl1_lblTotalCount">
                                                <? echo $total_records?></span>｜
                                        </td>
                                        <td>
											<a href="customers.php?page=1&IdentityNo=<?echo $identityNo?>&ChineseName=<?echo $chineseName?>&Mobile=<?echo $mobile?>">最前頁｜</a>
                                        </td>
                                        <?	
											$prePage = $page-1;
											if ($prePage < 1) {
												$prePage = 1;
											}
										?>
										<td>
											<a href="customers.php?page=<?echo $prePage?>&IdentityNo=<?echo $identityNo?>&ChineseName=<?echo $chineseName?>&Mobile=<?echo $mobile?>">上頁｜</a>
                                        </td>
										<?	
											$nextPage = $page+1;
											if ($nextPage > $total_pages) {
												$nextPage = $total_pages;
											}
										?>
                                        <td>
											<a href="customers.php?page=<?echo $nextPage?>&IdentityNo=<?echo $identityNo?>&ChineseName=<?echo $chineseName?>&Mobile=<?echo $mobile?>">下頁｜</a>
                                        </td>
                                        <td>
											<a href="customers.php?page=<?echo $total_pages?>&IdentityNo=<?echo $identityNo?>&ChineseName=<?echo $chineseName?>&Mobile=<?echo $mobile?>">最後頁</a>
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
                                                    <option value="<?php $_SERVER['PHP_SELF']; ?>?page=<?php echo $i; ?>&IdentityNo=<?echo $identityNo?>&ChineseName=<?echo $chineseName?>&Mobile=<?echo $mobile?>" <?php if($page==$i){echo "selected";} ?>>第 <?php echo $i; ?> 頁</option>
                                              <?php
                                                }
                                              ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <p style="height:10;"></p>
                        </div>
                        <br/>
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
