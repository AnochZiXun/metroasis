<?php
include_once("_connMysql.php");
include_once("check_login.php");

if (isset($_POST["delete"])) {
    $enrollId = $_POST["enrollId"];
    $deleteSql = "delete from ActivityEnrollment where EnrollID = '$enrollId'";
    mysql_query($deleteSql);
    $deleteSql = "delete from ActivityEnrollmentDetail where EnrollID = '$enrollId'";
    mysql_query($deleteSql);
    
    header("Location: activityregister.php");
}

$query_activityEnrollment = 'SELECT * FROM Activitys A, ActivityEnrollment B WHERE A.ActivityID = B.ActivityID ';
if (!empty($_POST["searchText"])) {
    $searchText = trim($_POST["searchText"]);
    $query_activityEnrollment = $query_activityEnrollment.' AND A.ContentSbuject like "%'.$searchText.'%" ';  
}

if (!empty($_POST["searchName"])) {
    $searchName = trim($_POST["searchName"]);
    $query_activityEnrollment = $query_activityEnrollment.' AND B.FullName like "%'.$searchName.'%" ';  
}

if (!empty($_POST["searchBank"])) {
    $searchBank = trim($_POST["searchBank"]);
    $query_activityEnrollment = $query_activityEnrollment.' AND B.BankAcctLast5 like "%'.$searchBank.'%" ';  
}
 
$RecActivityEnrollment = mysql_query($query_activityEnrollment);

//預設每頁筆數
$pageRow_records = 20;
//總筆數
$total_records = mysql_num_rows($RecActivityEnrollment);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
//echo $query_activityEnrollment.' LIMIT '.$start.', '.$pageRow_records;
$RecActivityEnrollment = mysql_query($query_activityEnrollment.' LIMIT '.$start.', '.$pageRow_records);

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
            $("#divWork").attr("style", "float: left; width: 90%;");
			$("input[type=submit], input[type=button]" ).button();
        }
        
        function setdetail(enrollId){
        	if (enrollId ==""){
        		$("#iDetail").attr("src","activityRegisterDetail.php");	
        	}else{
        		$("#iDetail").attr("src","activityRegisterDetail.php?enrollId="+enrollId);	
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
            <div id="divWork" style="float: left; width: 87%">
                <div class="divWorkArea">
                    <div id="UpdatePanel1">
                        	<div style="height:5px;"></div>
                        <div style="height: 36px; padding-top: 5px; border-left:1px solid #CCCCCC; border-top:1px solid #CCCCCC; border-right:1px solid #CCCCCC; background-color:#FFF;">
                            <form action="" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
                                <div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
                                    &nbsp;&nbsp;活動名稱：
                                </div>
                                <div style="float: left; padding-right: 10px;padding-top: 3px;">
                                    <input type="text" class="TextBox" name="searchText" style="width:250px" value="<? echo $searchText;?>" />
                                </div>
                                <div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
                                    姓名：
                                </div>
                                <div style="float: left; padding-right: 10px;padding-top: 3px;">
                                    <input type="text" class="TextBox" name="searchName" style="width:80px"  value="<? echo $searchName;?>" />
                                </div>
                                <div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
                                    匯款帳號：
                                </div>
                                <div style="float: left; padding-right: 10px;padding-top: 3px;">
                                    <input type="text" class="TextBox" name="searchBank" style="width:80px"  value="<? echo $searchBank;?>" />
                                </div>
                                <div style="float: left; padding-right: 10px;padding-top: 3px;">
                                    <input name="submitSearch" type="submit" value="查詢"/>
                                </div>
                            </form>
                        </div>
                        <div id="divDetailBody">
                            <div id="divGridview" style="overflow: auto">
                                <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                        style="border-collapse: collapse;">
                                        <tr>
                                            <th scope="col" style="width: 2%;">
                                                #
                                            </th>
                                            <th scope="col" style="width: 5%;">
                                                報名狀態
                                            </th>
                                            <th scope="col" style="width: 7%;">
                                                活動類型
                                            </th>
                                            <th scope="col" style="width: 15%;">
                                                活動名稱
                                            </th>
                                            <th scope="col" style="width: 6%;">
                                                姓名
                                            </th>
                                            <th scope="col" style="width: 8%;">
                                                匯款帳號(後5碼)
                                            </th>
                                            <th scope="col" style="width: 7%;">
                                                活動費用
                                            </th>
                                            <th scope="col" style="width: 6%;">
                                                報名時間
                                            </th>
                                            <th scope="col" style="width: 10%;">
                                                功能
                                            </th>
                                        </tr>
                                        <? 
                                            if ($page > 1) {
                                        		$rowNumber = ($pageRow_records * ($page - 1)) + 1;
                                        	}else{
                                        		$rowNumber = 1;
                                        	}
                                            while($row=mysql_fetch_assoc($RecActivityEnrollment)){
                                        ?>
                                        <tr>
                                            <td align="center">
                                                <span class="b_12"><? echo $rowNumber ?></span>
                                            </td>
                                            <?
                                                $sql = "SELECT R.CodeName FROM ActivityEnrollment A LEFT JOIN RefCommon R ON A.EnrollStatus = R.TypeCode 
                                                        AND R.Type = 'enrollStatus' AND A.EnrollID=".$row["EnrollID"];
                                                $record = mysql_query($sql);
                                                $result = mysql_fetch_assoc($record);
                                            ?>
                                            <td align="center">
                                                <span class="b_12"><? echo $result["CodeName"]; ?></span>
                                            </td>
                                            <?
                                                $sql = "SELECT R.CodeName FROM Activitys A LEFT JOIN RefCommon R ON A.Category = R.TypeCode 
                                                        AND R.Type = 'activityCategory' AND A.ActivityID=".$row["ActivityID"];
                                                $record = mysql_query($sql);
                                                $result = mysql_fetch_assoc($record);
                                            ?>
                                            <td align="left" style="padding-left:30px;">
                                                <span class="b_12"><? echo $result["CodeName"]; ?></span>
                                            </td>
                                            <?
                                                $sql = "SELECT ContentSbuject FROM Activitys WHERE ActivityID=".$row["ActivityID"];
                                                $record = mysql_query($sql);
                                                $result = mysql_fetch_assoc($record);
                                            ?>
                                            <td align="left" style="padding-left:20px;">
                                                <span class="b_12"><? echo $result["ContentSbuject"]; ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo $row["FullName"]; ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="orange_13_de5106"><b><? echo $row["BankAcctLast5"]; ?></b></span>
                                            </td>
                                            <td align="left" style="padding-left:30px;">
                                                <span class="b_12">NT$ <? echo number_format($row["TotalAmount"]); ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo date("Y-m-d", strtotime($row["CreateDate"])); ?></span>
                                            </td>
                                            <td align="center">
                                                <input id="btnEdit" name="btnEdit" class="detail"  type="button" value="修改" onclick="setdetail('<?echo $row["EnrollID"]?>')" />
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
                                                    <input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) {return false;}"/>
                                                    <input name="enrollId" type="hidden" value="<? echo $row["EnrollID"]; ?>"/>
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
                                            <a href="activityregister.php?page=1">最前頁｜</a>
                                        </td>
                                        <?  
                                            $prePage = $page-1;
                                            if ($prePage < 1) {
                                                $prePage = 1;
                                            }
                                        ?>
                                        <td>
                                            <a href="activityregister.php?page=<?echo $prePage?>">上頁｜</a>
                                        </td>
                                        <?  
                                            $nextPage = $page+1;
                                            if ($nextPage > $total_pages) {
                                                $nextPage = $total_pages;
                                            }
                                        ?>
                                        <td>
                                            <a href="activityregister.php?page=<?echo $nextPage?>">下頁｜</a>
                                        </td>
                                        <td>
                                            <a href="activityregister.php?page=<?echo $total_pages?>">最後頁</a>
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
	                    	<iframe id="iDetail" src="" width="100%" height="1000" frameborder="0" scrolling="no"></iframe>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>