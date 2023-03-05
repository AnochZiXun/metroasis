<?php
include('_connMysql.php');
include('check_login.php');


if (isset($_POST["delete"])) {
	$newsId = $_POST["newsId"];
	$deleteSql = "delete from News where NewsID = '$newsId'";
	mysql_query($deleteSql);
	
	header("Location: news.php");
}


$query_news = "SELECT N.*,S.UserName,R.CodeName FROM News N ";
$query_news .= "LEFT JOIN SystemUsers S ON N.updateUserId = S.UserID ";
$query_news .= "LEFT JOIN RefCommon R ON N.Category = R.TypeCode AND R.Type = 'news'";

if (isset($_POST["searchText"])) {
	$searchText = trim($_POST["searchText"]);
	$query_news .= ' WHERE N.ShortTitle like "%'.$key.'%" ';	
}
$query_news .= " ORDER BY CreateDate DESC";
$RecNews = mysql_query($query_news);

//預設每頁筆數
$pageRow_records = 9;
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
            $("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 105) + "px");
            $(".detail").colorbox({ iframe: true, width: "100%", height: "100%", overlayClose: false, escKey: false, 
									onClosed: function () { location.href="news.php"; } });
            $(".add").colorbox({ iframe: true, width: "100%", height: "100%", overlayClose: false, escKey: false, href: "newsDetail.php", 
									onClosed: function () { location.href="news.php"; } });
			$("input[type=submit], input[type=button]" ).button();
        }
	
    </script>
</head>
<body>

    <div id="divBody">
		<!-- 加上方選單 -->
		<?php include("_nav.php"); ?>
        <div style="overflow: hidden;">
			<!-- 加左方選單 -->
			<?php include("left_nav.php"); ?>
            <div id="divWork" style="float: left; width: 88%">
                <div class="divWorkArea">
                    <div id="UpdatePanel1">
                        <div class="SeachBar" style="height: 30px; padding-top: 5px">
                            
							<form action="" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
							<!--<input name="action" type="hidden" value="search">-->
							<!--<div style="float: left; height: 25px; margin-left: 25px; padding-top: 5px; font-size: 10pt;
                                ">
                                狀態：
							</div>
                            <div style="float: left; padding-right: 10px; padding-top: 5px;">
                                <select name="state" id="state" class="dropdownlist">
                                    <option selected="selected" value="1">上架</option>
                                    <option value="0">下架</option>
                                </select>
                            </div>-->
							<div style="float: left; height: 25px; padding-top: 3px; font-size:11pt">
                                標題名稱：
							</div>
							<div style="float: left; padding-right: 10px;padding-top: 3px;">
								<input type="text" class="TextBox" name="searchText" style="width:250px" value="<? echo $searchText ?>" />
							</div>
							<div style="float: left; padding-right: 10px;">
								<input name="submitSearch" type="submit" value="查詢"/>
							</div>
							</form>
							
                            <div style="float: right">
                                <input type="button" name="ibAdd" id="btnAdd" class="add" value=" 新增消息 "/>
                            </div>
                        </div>
                        <div id="divDetailBody" class="divDetailBody">
                            <div id="divGridview" style="overflow: auto">
                                <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                        style="border-collapse: collapse;">
										<tr>
                                            <th scope="col" style="width: 10%;">
                                                分類
                                            </th>
                                            <th scope="col" style="width: 10%;">
                                                活動日期
                                            </th>
                                            <th scope="col" style="width: 40%;">
                                                列表標題
                                            </th>
                                            <th scope="col" style="width: 10%;">
                                                開始日期
                                            </th>
                                            <th scope="col" style="width: 10%;">
                                                結束日期
                                            </th>
											<th scope="col" style="width: 10%;">
                                                更新人員
                                            </th>
											<th scope="col" style="width: 10%;">
                                                處理
                                            </th>
                                        </tr>
                                        <? while($row=mysql_fetch_assoc($RecNews)){ ?>
										<tr>
                                            <td align="center">
                                                <? echo $row["CodeName"]; ?>
                                            </td>
                                            <td align="center">
                                                <? echo $row["ActivityDate"]; ?>
                                            </td>
                                            <td align="left">
                                                <? echo $row["ShortTitle"]; ?>
                                            </td>
                                            <td align="center">
                                                <? echo $row["StartDate"]; ?>
                                            </td>
                                            <td align="center">
                                                <? echo $row["EndDate"]; ?>
                                            </td>
                                            <td align="center">
                                                <? echo $row["UserName"]; ?>
                                            </td>
											<td align="center">
												<input id="btnEdit" name="btnEdit" class="detail"  type="button" value="編輯" href="newsDetail.php?newsId=<?echo $row["NewsID"]?>" /><br/>
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
													<input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) return false;"/>
													<input name="newsId" type="hidden" value="<? echo $row["NewsID"]; ?>"/>
													<input name="action" type="hidden" value="delete"/>
												</form>
                                            </td>
                                        </tr>
										<? } ?>
                                    </table>
                                    <br/><br/><br/>
                                </div>
                            </div>
							
                            <div class="GridViewFooter">
                                <table class="TableNoLine">
                                    <tr>
                                        <td>
                                            <span id="PageControl1_labCount">筆數</span>： <span id="PageControl1_lblTotalCount">
                                                <? echo $total_records?></span>｜
                                        </td>
                                        <td>
											<a href="news.php?page=1">最前頁｜</a>
                                        </td>
                                        <?	
											$prePage = $page-1;
											if ($prePage < 1) {
												$prePage = 1;
											}
										?>
										<td>
											<a href="news.php?page=<?echo $prePage?>">上頁｜</a>
                                        </td>
										<?	
											$nextPage = $page+1;
											if ($nextPage > $total_pages) {
												$nextPage = $total_pages;
											}
										?>
                                        <td>
											<a href="news.php?page=<?echo $nextPage?>">下頁｜</a>
                                        </td>
                                        <td>
											<a href="news.php?page=<?echo $total_pages?>">最後頁</a>
                                        </td>
                                        <td>
                                            ｜<span id="PageControl1_labPage">頁數</span>： <span id="PageControl1_lblCurrentPage">
                                                <?echo $page?></span>/<span id="PageControl1_lblTotalPage"><?echo $total_pages?></span>
                                        </td>
                                        <!--<td>
                                            ｜<span id="PageControl1_labJump">轉至</span>
                                            <select name="PageControl1$ddlPages" onchange="javascript:setTimeout(&#39;__doPostBack(\&#39;PageControl1$ddlPages\&#39;,\&#39;\&#39;)&#39;, 0)"
                                                id="PageControl1_ddlPages" class="dropdownlist">
                                                <? for($i=1 ; $i<=$total_pages ; $i++){ ?>
												<option  value="<?echo $i?>"><?echo $i?></option>
												<? } ?>	
                                            </select>
                                        </td>-->
                                        <td>
                                            <span id="PageControl1_labTotal"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div style="display: none">
                                <input type="submit" name="btnReload" value="btnReload" id="btnReload" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
