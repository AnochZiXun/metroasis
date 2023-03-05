<?php
include_once("_connMysql.php");
include_once("_function.php");
include_once("check_login.php");
$currentUserID = $_SESSION["userID"];
$actType = '2';
mysql_query("DELETE FROM ActivityClass WHERE NewFlag = 1 AND CreateUserID = '$currentUserID'");
mysql_query("UPDATE ActivityClass SET Visibility = '0' WHERE ActivityDate <= NOW() ");
if (isset($_POST["delete"])) {
    $activityClassID = $_POST["ActivityClassID"];
    $rec_deathNote = mysql_query("SELECT CONCAT('Batch:', Batch, ' / Killer:', '$currentUserID', ' / Time:', NOW() ) AS DeathNote FROM ActivityClass WHERE ActivityClassID = '$activityClassID'");
    $deathNote = "unknown";
    if($rec_deathNote){
        $row_deathNote = mysql_fetch_assoc($rec_deathNote);
        $deathNote = $row_deathNote["DeathNote"];
    }
    mysql_query("UPDATE ActivityClass SET Batch='0' ,ValidFlag = '0', DeathNote = '$deathNote' WHERE ActivityClassID = '$activityClassID'");
    header("Location: activity_class.php");
}
$query_activityClass  = "SELECT A.*,S.UserName,(SELECT CONCAT(ImagePath, ImageFileName) FROM ImagesFiles WHERE ImageFunction = 'activityClass' AND ImageType = 'promotePicture' AND ForeignID = A.ActivityClassID LIMIT 1) AS ImageFile FROM ActivityClass A ";
$query_activityClass .= "LEFT JOIN SystemUsers S ON IFNULL(A.UpdateUserID, A.CreateUserID) = S.UserID WHERE 1 AND A.NewFlag = '0'";
$query_activityClass .= " ORDER BY Status ASC, ActivityDate DESC, Batch DESC";
//echo $query_activityClass;
$recActivity = mysql_query($query_activityClass);
//預設每頁筆數
$pageRow_records = 10;
//總筆數
$total_records = $recActivity ? mysql_num_rows($recActivity) : 0;
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {    
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
$recActivity = mysql_query($query_activityClass.' LIMIT '.$start.', '.$pageRow_records);
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
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
        function pageInitial(){
            var bodyHeight = document.body.clientHeight;
            $("input[type=submit], input[type=button]" ).button();
        }
        function setdetail(intNo){
            if (intNo ==""){
                $("#iDetail").attr("src","activityDetail_class.php"); 
            }else{
                $("#iDetail").attr("src","activityDetail_class.php?activityClassID="+intNo);   
            }
            //$('#divWork').animate({scrollTop: $("#divDetail").offset().top - 50}, 'slow');
        }
        function transfer2Detail(activityClassID, $this){
            var page = <? echo $page ?>;
            location.href = "activityDetail_class.php?page=" + page + "&activityClassID=" + activityClassID;
        }
        $(document).ready(function(){
            var x = 10;
            var y = 20;
            $(".thumbnail").mouseover(function(e){
                var biggerIsBetter = jQuery(this).clone();
                biggerIsBetter.attr("id", "biggerIsBetter");
                biggerIsBetter.attr("style","");
                $("body").append(biggerIsBetter);
                $("#biggerIsBetter").css({"position": "absolute" ,
                    "top": (e.pageY+y) + "px", 
                    "left": (e.pageX+x)  + "px", 
                    "max-width": "400px", 
                    "width": "expression(this.width > 400 ? '400px' : this.width)"}).show("fast");
            }).mouseout(function(){
                $("#biggerIsBetter").remove();
            }).mousemove(function(e){
                $("#biggerIsBetter").css({"position": "absolute", 
                    "top": (e.pageY+y) + "px", 
                    "left": (e.pageX+x)  + "px", 
                    "max-width": "400px", 
                    "width": "expression(this.width > 400 ? '400px' : this.width)"});
            });
        });        
    </script>
</head>
<body>
    <div id="divBody" style="width:1600px; margin: 0 auto;">
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
                                <div style="height: 36px; padding-top: 5px; border-left:0px solid #CCCCCC; border-top:0px solid #CCCCCC; border-right:0px solid #CCCCCC;">
                                    <div style="float: right;padding-top: 4px;">
                                        <input type="button" name="ibAdd" id="btnAdd" class="add" value=" 新增活動" onclick="javascript:location.href='activityDetail_class.php'"/>
                                        &nbsp;
                                    </div>
                                </div>
                                <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                            style="border-collapse: collapse;">
                                        <tr>
                                            <th scope="col" style="width: 2%">
                                                <span class="w_12">#</span>
                                            </th>
                                            <th scope="col" style="width: 3%">
                                                <span class="w_12">梯次</span>
                                            </th>
                                            <th scope="col" style="width: 4%">
                                                <span class="w_12">活動狀態</span>
                                            </th>
                                            <th scope="col" style="width: 4%">
                                                <span class="w_12">報名狀態</span>
                                            </th>                                                                                
                                            <th scope="col" style="width: 5%">
                                                <span class="w_12">活動圖</span>
                                            </th>
                                            <th scope="col" style="width: 8%">
                                                <span class="w_12">活動名稱</span>
                                            </th>
                                            <th scope="col" style="width: 8%">
                                                <span class="w_12">活動日期</span>
                                            </th>
                                            <th scope="col" style="width: 8%">
                                                <span class="w_12">集合時間</span>
                                            </th>
                                            <th scope="col" style="width: 8%">
                                                <span class="w_12">集合地點</span>
                                            </th>
                                            <th scope="col" colspan="3" style="width: 11%; padding:0px">
                                                <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <tr>
                                                        <th align="center" colspan="3">
                                                            <span class="w_12">名額</span>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th align="center" style="width: 33%">
                                                            <span class="w_12">總數</span>
                                                        </th>
                                                        <th align="center" style="width: 34%">
                                                            <span class="w_12">報名</span>
                                                        </th>
                                                        <th align="center" style="width: 33%">
                                                            <span class="w_12">候補</span>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th scope="col" style="width: 5%">
                                                <span class="w_12">活動費用</span>
                                            </th>
                                            <th scope="col" style="width: 5%">
                                                <span class="w_12">報名表</span>
                                            </th>
                                            <th scope="col" style="width: 6%">
                                                <span class="w_12">更新人員</span>
                                            </th>
                                            <th scope="col" style="width: 6%">
                                                <span class="w_12">更新時間</span>
                                            </th>
                                            <th scope="col" style="width: 5%">
                                                <span class="w_12">功能</span>
                                            </th>
                                        </tr>
                                        <?  if ($page > 1) {
                                                $rowNumber = ($pageRow_records * ($page - 1)) + 1;
                                            }else{
                                                $rowNumber = 1;
                                            }
                                            if($recActivity){                                           
                                                while($row=mysql_fetch_assoc($recActivity)){ 
                                        ?>
                                        <tr>
                                            <td align="center">
                                                <span class="b_12"><? echo $rowNumber ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12">2-<? echo setData($row["Batch"]); ?></span>
                                            </td>
                                            <td align="center">
                                                <? 
                                                    if ($row["Visibility"] == "1"){
                                                        if($row["ActivityDate"] > date("Y-m-d") ){
                                                ?>
                                                            <img src="images/up_green.png" width="28px" height="28px" />
                                                <?      
                                                        }else{
                                                ?>
                                                            <img src="images/down_red.png" width="28px" height="28px"/>
                                                <?
                                                        }
                                                    }else{
                                                ?>
                                                    <img src="images/down_red.png" width="28px" height="28px"/>
                                                <?  } ?>
                                            </td>
                                            <td align="center">
                                                <?  switch($row["Status"]){
                                                        case "0":
                                                ?>
                                                            <span class="gray_12">準備中</span>
                                                <?          break;
                                                        case "1":
                                                ?>
                                                            <span class="green_12">開放報名</span>
                                                <?
                                                            break;
                                                        case "2":
                                                ?>
                                                            <span class="red_12">已截止</span>
                                                <?
                                                            break;
                                                        default:
                                                ?>
                                                            <span class="b_12">Exception</span>
                                                <?
                                                            break;
                                                    }
                                                ?>
                                            </td>      
                                            <td align="center">
                                                <img class="thumbnail" src="<?echo $row["ImageFile"]?>" border="0" style="display:block; width: 100%; height: auto;">
                                            </td> 
                                            <td align="left">
                                                <span class="b_12"><? echo setData($row["ActivityName"]); ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo setData($row["ActivityDate"]); ?></span>
                                            </td>                                                                                          
                                            <td align="left">
                                                <span class="b_12"><? echo setData($row["GatheringTime"]); ?></span>
                                            </td>
                                            <td align="left">
                                                <span class="b_12"><? echo setData($row["Venue"]); ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo setData($row["Quota"]); ?></span>
                                            </td>
                                            <?php
                                            $activityID = $row["ActivityClassID"];
                                            $rec_countApplicant = mysql_query("SELECT COUNT(*) AS Count FROM ActivityEnrollment WHERE ActType = '1' AND ActivityID = '$activityID' AND Qualification = '1' ");
                                            $row_countApplicant = mysql_fetch_array($rec_countApplicant);
                                            ?> 
                                            <td align="center">
                                                <span class="b_12"><? echo $row_countApplicant["Count"] ?> / <? echo $row["Quota"] ?></span>
                                            </td>
                                            <?php
                                            $rec_countWaitingNumber = mysql_query("SELECT COUNT(*) AS Count FROM ActivityEnrollment WHERE ActType = '1' AND ActivityID = '$activityID' AND Qualification = '0' ");
                                            $row_countWaitingNumber = mysql_fetch_array($rec_countWaitingNumber);
                                            ?> 
                                            <td align="center">
                                                <span class="b_12"><? echo $row_countWaitingNumber["Count"] ?> / <? echo $row["WaitingNumber"] ?></span>
                                            </td>
                                            <td align="center">
                                                <span class="b_12"><? echo setData($row["Cost"]); ?></span>
                                            </td>                                            
                                            <!--
                                            <td align="left" valign="top" style="padding-left:5px;">
                                                <pre class="b_12" style="word-wrap: break-word; white-space: pre-wrap;"><? echo setData($row["Cost"]); ?></pre>
                                            </td>
                                            -->
                                            <td align="center">
                                                <input type="button" value="清單" onclick="javascript:location.href='activityRegister.php?actType=<?php echo $actType?>&activityID=<?php echo $row["ActivityClassID"]?>'"/>
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
                                                <input name="btnEdit" id="etnEdit<? echo $start + $rowCount ?>" type="button" value="修改" onclick="transfer2Detail('<?echo $row["ActivityClassID"]?>',this)"/>
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
                                                    <!--TODO: 尚未結束, 且已有人報名的活動不能刪除-->
                                                    <input name="delete" type="submit" value="刪除" OnClick="if (!confirm('確認刪除此筆資料?')) return false;" style="float:top;margin-top:6px;"/>
                                                    <input name="ActivityClassID" type="hidden" value="<? echo $row["ActivityClassID"]; ?>"/>
                                                    <input name="action" type="hidden" value="delete"/>
                                                </form>                                         
                                            </td>                                            
                                        </tr>
                                        <? $rowNumber = $rowNumber + 1; } } ?>
                                    </table>
                                    <br>
                                </div>
                            </div>
                            <div class="GridViewFooter" align="center">
                                <table class="TableNoLine">
                                    <tr>
                                        <td>
                                            <span id="PageControl1_labCount">筆數</span>： <span id="PageControl1_lblTotalCount"><? echo $total_records?></span>｜
                                        </td>
                                        <td>
                                            <a href="activityClass.php?page=1">最前頁｜</a>
                                        </td>
                                        <?  
                                            $prePage = $page-1;
                                            if ($prePage < 1)
                                            {
                                                $prePage = 1;
                                            }
                                        ?>
                                        <td>
                                            <a href="activityClass.php?page=<?echo $prePage?>">上頁｜</a>
                                        </td>
                                        <?  
                                            $nextPage = $page+1;
                                            if ($nextPage > $total_pages)
                                            {
                                                $nextPage = $total_pages;
                                            }
                                        ?>
                                        <td>
                                            <a href="activityClass.php?page=<?echo $nextPage?>">下頁｜</a>
                                        </td>
                                        <td>
                                            <a href="activityClass.php?page=<?echo $total_pages?>">最後頁</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>