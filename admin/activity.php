<?php
include_once("_connMysql.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];
$product_sql_Delete = "DELETE FROM Activitys WHERE NewFlag = 1 AND CreateUserID = '$currentUserID'";
mysql_query($product_sql_Delete);
if (isset($_POST["delete"])) {
    $activityId = $_POST["activityId"];
    $deleteSql = "delete from Activitys where ActivityID = '$activityId'";
    mysql_query($deleteSql);
    header("Location: activity.php");
}
$query_activitys = 'SELECT A.*,S.UserName,R1.CodeName AS activityStatus, R2.CodeName AS activityCategory FROM Activitys A ';
$query_activitys .= "LEFT JOIN SystemUsers S ON A.updateUserId = S.UserID ";
$query_activitys .= "LEFT JOIN RefCommon R1 ON A.Status = R1.TypeCode AND R1.Type = 'activityStatus' ";
$query_activitys .= "LEFT JOIN RefCommon R2 ON A.Category = R2.TypeCode AND R2.Type = 'activityCategory' WHERE A.NewFlag = '0' ";
if (isset($_POST["searchText"])) {
    $key = trim($_POST["searchText"]);
    $query_activitys = $query_activitys.' AND A.ListSubject like "%'.$key.'%" ';  
}
//echo  $query_activitys;
$RecActivitys = mysql_query($query_activitys);
//預設每頁筆數
$pageRow_records = 10;
//總筆數
$total_records = mysql_num_rows($RecActivitys);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
//echo $query_activitys.' LIMIT '.$start.', '.$pageRow_records;
$RecActivitys = mysql_query($query_activitys.' LIMIT '.$start.', '.$pageRow_records);
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
        function setdetail(activityId){
        	if (activityId ==""){
        		$("#iDetail").attr("src","activityDetail.php");	
        	}else{
        		$("#iDetail").attr("src","activityDetail.php?activityId="+activityId);	
        	}
        	$('#divWork').animate({scrollTop: $("#divDetail").offset().top - 50}, 'slow');
        }
    </script>
</head>
<body>
    <div id="divBody" style="width:1600px; margin: 0 auto; ">
        <!-- 加上方選單 -->
        <?php include_once("_nav.php"); ?>
        <div style="overflow: hidden;">
            <!-- 加左方選單 -->
            <?php include_once("left_nav.php"); ?>
            <div id="divWork" style="float: left; width: 90%;">
                <div class="divWorkArea">
                    <div id="UpdatePanel1">
                          <div style="height:5px;"></div>
    	                  <div style="height: 36px; padding-top: 5px; border-left:1px solid #CCCCCC; border-top:1px solid #CCCCCC; border-right:1px solid #CCCCCC; background-color:#FFF;">
                            <form action="" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
							<div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
                                &nbsp;&nbsp;活動標題：
							</div>
							<div style="float: left; padding-right: 10px;padding-top: 3px;">
								<input type="text" class="TextBox" name="searchText" style="width:250px" value="<? echo $searchText ?>" />
							</div>
							<div style="float: left; padding-right: 10px;padding-top: 3px;">
								<input name="submitSearch" type="submit" value="查詢"/>
							</div>
							</form>
                            <div style="float: right;padding-top: 4px;">
                                <input type="button" name="ibAdd" id="btnAdd" class="add" value=" 新增活動 " onclick="setdetail('')"/>
                                &nbsp;&nbsp;
                            </div>
                        </div>
                        <div id="divDetailBody">
                            <div id="divGridview" style="overflow: auto">
                                <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                        style="border-collapse: collapse;">
                                        <tr>
                                            <th scope="col" style="width: 3%;">
                                                #
                                            </th>
                                            <th scope="col" style="width: 6%;">
                                                狀態
                                            </th>
                                            <th scope="col" style="width: 9%;">
                                                活動類型
                                            </th>
                                            <th scope="col" style="width: 13%;">
                                                活動日期
                                            </th>
                                            <th scope="col" style="width: 29%;">
                                                活動標題
                                            </th>
                                            <th scope="col" style="width: 10%;">
                                                活動地點
                                            </th>
                                            <th scope="col" style="width: 8%;">
                                                更新日期
                                            </th>
                                            <th scope="col" style="width: 8%;">
                                                更新人員
                                            </th>
                                            <th scope="col" style="width: 12%;">
                                                功能
                                            </th>
                                        </tr>
                                        <? 
                                            if ($page > 1) {
                                        		$rowNumber = ($pageRow_records * ($page - 1)) + 1;
                                        	}else{
                                        		$rowNumber = 1;
                                        	}      
                                            while($row=mysql_fetch_assoc($RecActivitys)){ 
                                        ?>
                                        <tr>
                                            <td align="center">
                                                <span class="b_12"><? echo $rowNumber ?></span>
                                            </td>
                                            <td align="center">
												<span class="b_12"><? echo $row["activityStatus"]?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo $row["activityCategory"]; ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo date("Y-m-d", strtotime($row["ActivityDateS"])).' ~ '.date("Y-m-d", strtotime($row["ActivityDateE"])); ?></span>
                                            </td>
                                            <td align="left" style="padding-left:20px;">
                                                <span class="b_12"><? echo $row["ListSubject"]; ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo $row["ActivityPlace"]; ?></span>
                                            </td>
                                            <td align="center">
                                            	<span class="b_12">
                                                <? echo date_format(new DateTime($row["UpdateDate"] == NULL ? $row["CreateDate"] : $row["UpdateDate"]),"Y/m/d") ?>
                                                <br>
                                                <? echo date_format(new DateTime($row["UpdateDate"] == NULL ? $row["CreateDate"] : $row["UpdateDate"]),"H:i:s") ?>
                                                </span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo $row["UserName"]; ?></span>
                                            </td>
                                            <td align="center">
                                                <input id="btnEdit" name="btnEdit" class="detail"  type="button" value="修改" onclick="setdetail('<?echo $row["ActivityID"]?>')" />
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
                                                    <input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) {return false;} else {return delActivity(<? echo $row["ActivityID"];?>);}"/>
                                                    <input name="activityId" type="hidden" value="<? echo $row["ActivityID"]; ?>"/>
                                                    <input name="action" type="hidden" value="delete"/>
                                                </form>
                                            </td>
                                        </tr>
                                        <? $rowNumber = $rowNumber + 1; } ?>
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
                                            <a href="activity.php?page=1">最前頁｜</a>
                                        </td>
                                        <?  
                                            $prePage = $page-1;
                                            if ($prePage < 1) {
                                                $prePage = 1;
                                            }
                                        ?>
                                        <td>
                                            <a href="activity.php?page=<?echo $prePage?>">上頁｜</a>
                                        </td>
                                        <?  
                                            $nextPage = $page+1;
                                            if ($nextPage > $total_pages) {
                                                $nextPage = $total_pages;
                                            }
                                        ?>
                                        <td>
                                            <a href="activity.php?page=<?echo $nextPage?>">下頁｜</a>
                                        </td>
                                        <td>
                                            <a href="activity.php?page=<?echo $total_pages?>">最後頁</a>
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
                            <p style="height:10;"></p>
                            <div style="display: none">
                                <input type="submit" name="btnReload" value="btnReload" id="btnReload" />
                            </div>
                        </div>
                        <br/>
                        <div id="divDetail">
	                    	<iframe id="iDetail" src="" width="100%" height="2800" frameborder="0" scrolling="no"></iframe>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function delActivity(activityId) {
        var isDel = true;
        $.ajax({ 
            url: 'queryActivityEnrollment.php?activityId='+activityId,
            type: 'GET', 
            async: false,
            success: function(hasRow) { 
                if(true == hasRow) {
                    alert('此活動還有報名者，無法刪除。');
                    isDel = false;
                }
            }, error: function(xhr) { 
                alert('系統異常。'); 
            } 
        });
        return isDel;
    }
</script>