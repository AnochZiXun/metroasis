<?php
include_once("_connMysql.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];
$product_sql_Delete = "DELETE FROM News WHERE NewFlag = 1 AND CreateUserID = '$currentUserID'";
mysql_query("UPDATE News SET State = '0' WHERE EndDate <= NOW() ");
mysql_query($product_sql_Delete);
if (isset($_POST["delete"])) {
	$newsId = $_POST["newsId"];
	$deleteSql = "delete from News where NewsID = '$newsId'";
	mysql_query($deleteSql);
	header("Location: news.php");
}
$searchText = (isset($_POST["searchText"]) && $_POST["searchText"] != "") ? $_POST["searchText"] : (isset($_GET["searchText"]) ? $_GET["searchText"] : "");
$query_news  = "SELECT N.*,S.UserName,R.CodeName FROM News N ";
$query_news .= "LEFT JOIN SystemUsers S ON IFNULL(N.UpdateUserID, N.CreateUserID) = S.UserID ";
$query_news .= "LEFT JOIN RefCommon R ON N.Category = R.TypeCode AND R.Type = 'news' WHERE 1 AND N.NewFlag = '0' ";
if (trim($searchText) != "") {
	$query_news .= " AND N.ShortTitle like '%".$searchText."%' ";	
	$searchMod=1;
}
$query_news .= " ORDER BY State, StartDate DESC, EndDate";
$RecNews = mysql_query($query_news);
//預設每頁筆數
$pageRow_records = 10;
//總筆數
$total_records = mysql_num_rows($RecNews);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {	
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
//echo $query_news.' LIMIT '.$start.', '.$pageRow_records;
$RecNews = mysql_query($query_news.' LIMIT '.$start.', '.$pageRow_records);
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
        		$("#iDetail").attr("src","newsDetail.php");	
        	}else{
        		$("#iDetail").attr("src","newsDetail.php?newsId="+intNo);	
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
                        <div id="divDetailBody" class="divDetailBody" style="padding-top: 0px; border: 0px;">
                            <div id="divGridview">
                            	<div style="height:5px;"></div>
    	                        <div style="height: 36px; padding-top: 5px; border-left:1px solid #CCCCCC; border-top:1px solid #CCCCCC; border-right:1px solid #CCCCCC;">
									<form action="news.php" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
									<div style="float: left; height: 25px; padding-top: 6px; font-size:13px">
		                                &nbsp;&nbsp;標題名稱：
									</div>
									<div style="float: left; padding-right: 10px;padding-top: 3px;">
										<input type="text" class="TextBox" name="searchText" style="width:250px" value="<? echo $searchText ?>" />
									</div>
									<div style="float: left; padding-right: 10px;padding-top: 3px;">
										<input name="submitSearch" type="submit" value="查詢"/>
									</div>
									</form>
		                            <div style="float: right;padding-top: 4px;">
		                                <input type="button" name="ibAdd" id="btnAdd" class="add" value=" 新增消息 " onclick="setdetail('')"/>
		                                &nbsp;
		                            </div>
                       			 </div>
                                <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                        style="border-collapse: collapse;">
										<tr>
											<th scope="col" style="width:  3%;">
                                                #
                                            </th>
                                            <th scope="col" style="width:  5%;">
                                                狀態
                                            </th>
                                            <th scope="col" style="width:  9%;">
                                                類型
                                            </th>
                                            <th scope="col" style="width:  9%;">
                                                活動日期
                                            </th>
                                            <th scope="col" style="width: 24%;">
                                                標題
                                            </th>
                                            <th scope="col" style="width:  9%;">
                                                上架日期
                                            </th>
                                            <th scope="col" style="width:  9%;">
                                                下架日期
                                            </th>
											<th scope="col" style="width:  9%;">
                                                更新人員
                                            </th>
                                            <th scope="col" style="width:  9%;">
                                                更新時間
                                            </th>
											<th scope="col" style="width: 14%;">
                                                功能
                                            </th>
                                        </tr>
                                        <?  if ($page > 1) {
                                        		$rowNumber = ($pageRow_records * ($page - 1)) + 1;
                                        	}else{
                                        		$rowNumber = 1;
                                        	}                                        	
                                        	while($row=mysql_fetch_assoc($RecNews)){ ?>
										<tr>
											<td align="center">
                                                <span class="b_12"><? echo $rowNumber ?></span>
                                            </td>
                                            <td align="center">
                                                <? 
                                                    if ($row["State"] == "1"){
                                                        if($row["StartDate"] > date("Y-m-d H:i:s") ){
                                                ?>
                                                            <span class="b_12">預登錄</span>
                                                <?      
                                                        }else if($row["EndDate"] != NULL && $row["EndDate"] <= date("Y-m-d H:i:s")){
                                                ?>
                                                            <img src="images/down_red.png" width="28px" height="28px"/>
                                                <?
                                                        }else{
                                                ?>
                                                            <img src="images/up_green.png" width="28px" height="28px" />
                                                <?
                                                        }
                                                    }else{
                                                ?>
                                                    <img src="images/down_red.png" width="28px" height="28px"/>
                                                <?  } ?>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo setData($row["CodeName"]); ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo setData($row["ActivityDate"]); ?></span>
                                            </td>
                                            <td align="left" style="padding-left:20px;">
                                                <span class="b_12"><? echo setData($row["ShortTitle"]); ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo setData($row["StartDate"]); ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo setData($row["EndDate"]); ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo $row["UserName"]; ?></span>
                                            </td>
                                            <td align="center">
                                            	<span class="b_12">
                                                <? echo date_format(new DateTime($row["UpdateDate"] == NULL ? $row["CreateDate"] : $row["UpdateDate"]),"Y/m/d") ?>
                                                <br>
                                                <? echo date_format(new DateTime($row["UpdateDate"] == NULL ? $row["CreateDate"] : $row["UpdateDate"]),"H:i:s") ?>
                                                </span>
                                            </td>
											<td align="center">
												<input id="btnEdit" name="btnEdit" class="detail"  type="button" value="修改" onclick="setdetail('<?echo $row["NewsID"]?>')" />
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
													<input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) return false;" />
													<input name="newsId" type="hidden" value="<? echo $row["NewsID"]; ?>"/>
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
                                            <span id="PageControl1_labCount">筆數</span>： <span id="PageControl1_lblTotalCount"><? echo $total_records?></span>｜
                                        </td>
                                        <td>
											<a href="news.php?page=1&searchText=<?echo $searchText?>">最前頁｜</a>
                                        </td>
                                        <?	
											$prePage = $page-1;
											if ($prePage < 1)
											{
												$prePage = 1;
											}
										?>
										<td>
											<a href="news.php?page=<?echo $prePage?>&searchText=<?echo $searchText?>">上頁｜</a>
                                        </td>
										<?	
											$nextPage = $page+1;
											if ($nextPage > $total_pages)
											{
												$nextPage = $total_pages;
											}
										?>
                                        <td>
											<a href="news.php?page=<?echo $nextPage?>&searchText=<?echo $searchText?>">下頁｜</a>
                                        </td>
                                        <td>
											<a href="news.php?page=<?echo $total_pages?>&searchText=<?echo $searchText?>">最後頁</a>
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
                                                    <option value="<?php $_SERVER['PHP_SELF']; ?>?page=<?php echo $i; ?>&searchText=<?echo $searchText?>" <?php if($page==$i){echo "selected";} ?>>第 <?php echo $i; ?> 頁</option>
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
