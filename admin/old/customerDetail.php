<?php
include_once("_connMysql.php");
include_once("check_login.php");
include_once('mycrypt.php');
$mycrypt = new mycrypt;
$isNew = false;
$currentUserID = $_SESSION["userID"];
if(isset($_GET["customerId"])) {
	$customerId = $_GET["customerId"];
}
if(isset($_POST["customerId"])) {	
	$customerId = $_POST["customerId"];
}
$mode="修改";
if($customerId == ""){
	$insert_sql = "INSERT INTO Customers(CreateUserID,UpdateUserID) VALUES ('$currentUserID','$currentUserID')";	
	mysql_query($insert_sql);	
	$customerId = mysql_insert_id();	
	$mode = "新增會員";
    $isNew = true;
}
$query_sql = "SELECT * FROM Customers where CustomerID = $customerId";
$rec = mysql_query($query_sql);
$row = $rec ? mysql_fetch_assoc($rec) : NULL;
if($customerId) {
	$query_pointrecord_sql = "SELECT T.*,(SELECT CodeName FROM RefCommon WHERE Type='ActionType' and TypeCode=T.ActionType) AS ActionType,(SELECT OrderNo FROM Orders WHERE OrderID=T.OrderID) AS OrderNo FROM CustomersPointRecord T where T.CustomerID = $customerId ORDER BY RecordDate";
	$pointrecord_rec = mysql_query($query_pointrecord_sql);
}
//預設每頁筆數
$pageRow_records = 10;
//總筆數
$total_records = mysql_num_rows($pointrecord_rec);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if(!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
$pointrecord_rec = mysql_query($query_pointrecord_sql.' LIMIT '.$start.', '.$pageRow_records);
if($_POST["action"] == "update"){ 
	$identityNo = $_POST["IdentityNo"];
	$chineseName = $_POST["ChineseName"];
	$englishName = $_POST["EnglishName"];
	$nickName = $_POST["NickName"];
	$gender = $_POST["Gender"] == '' ? 1 : $_POST["Gender"];
	$eMail = $_POST["EMail"];
	$passwd = $mycrypt->encrypt($_POST["Passwd"]);
	$sms = $_POST["Sms"] == '' ? 'NULL' : $_POST["Sms"];
	$subscribe = $_POST["Subscribe"] == '' ? 'NULL' : $_POST["Subscribe"];
	$birthday = $_POST["Birthday"] == '' ? 'NULL' : "'".$_POST["Birthday"]."'";
	$mobile = $_POST["Mobile"];
	$homeTel = $_POST["HomeTel"];
	$fax = $_POST["Fax"];
	$address = $_POST["Address"];
    $postalCode = $_POST["PostalCode"];
    $addressCounty = $_POST["AddressCounty"];
    $addressDistrict = $_POST["AddressDistrict"];
	$registerDate = $_POST["RegisterDate"] == '' ? 'NULL' : "'".$_POST["RegisterDate"]."'";
	$updateUserID = $currentUserID;
	$update_sql = "update Customers set 		IdentityNo='$identityNo',
												ChineseName='$chineseName',
												EnglishName='$englishName',
												NickName='$nickName',
												Gender=$gender,
												EMail='$eMail',
												Passwd='$passwd',
												Sms=$sms,
												Subscribe=$subscribe,
												Birthday=$birthday,
												Mobile='$mobile',
												HomeTel='$homeTel',
												Fax='$fax',
                                                PostalCode='$postalCode',
												Address='$address',
												RegisterDate=$registerDate,
												UpdateUserID=$updateUserID,
                                                UpdateDate=NOW(),
                                                AddressCounty='$addressCounty',
                                                AddressDistrict='$addressDistrict',
												NewFlag = 0	
												WHERE CustomerID='$customerId'";
												;
	
	mysql_query($update_sql);
	//echo $update_sql;
	echo "<script>parent.location.href='customers.php'; </script>";	
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
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
    <script src="../js/jquery.twzipcode.js"></script>
    <script type="text/javascript">
        function pageInitial() {			
			var bodyHeight = document.body.clientHeight;
			$("input[type=submit], input[type=button]" ).button();
        }
        function beforeSubmit(){
            showLoading();
            var textFields = ["ChineseName","IdentityNo","Passwd","NickName","Birthday","Mobile","EMail","Address"];
            var textNames = ["中文姓名","身分證字號","密碼","暱稱","出生日期","手機號碼","電子郵件","地址"];
            var selectFieleds = ["AddressCounty","AddressDistrict"];
            var selectNames = ["縣市","鄉鎮市區"];
            for (var i = 0; i < textFields.length; i++) {
                //console.log(textFields[i]+'='+$("#"+textFields[i]).val());
                var txt = document.getElementById(textFields[i]);
                if (txt.value==""){
                    alert("「"+textNames[i] + "」為必填欄位!");
                    txt.focus();
                    stopLoading();
                    return false;
                }
            }
            for (var i = 0; i < selectFieleds.length; i++) {
                if($("."+selectFieleds[i]).prop("selectedIndex") == 0){
                    alert("請選擇「"+selectNames[i] + "」");
                    stopLoading();
                    return false;
                }
            }
            stopLoading();
        }
        $(document).ready(function(){
            $('#twzipcode').twzipcode({
                countyName:"AddressCounty",
                districtName:"AddressDistrict",
                zipcodeName:"PostalCode",
                css:['dropdownlist AddressCounty','dropdownlist AddressDistrict','TextBox'],
                countySel:"<? echo $row["AddressCounty"] ?>",
                districtSel:"<? echo $row["AddressDistrict"] ?>",
                readonly:true
            });
            $(".PostalCode").css("width","auto").css("display","inline");
            $(".AddressCounty").css("width","auto").css("display","inline").css("font-size","14px");
            $(".AddressDistrict").css("width","auto").css("display","inline").css("font-size","14px");
        });
    </script></head>
<body>
    <form name="form1" method="post" action="customerDetail.php" id="form1" enctype="multipart/form-data">
    <div>
        <div id="UpdatePanel1">
            <div class="divDetailTopBar">
                <div id="ToolBar">
                    <div style="float:left;">
                        <span id="LabMessage" class="labMessage"><?echo "【". $mode ."】" . $row["ChineseName"]?></span>
                    </div>
                </div>
            </div>
            <div id="divDetailBody" class="divDetailBody">
				<table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                    <tr>
                    	<td align="center" bgcolor="#e5e5e5">
                            <span  class="red_12">* E-mail</span>
                        </td>
                        <td colspan="3" bgcolor="#FFFFFF">
                            <input name="EMail" id="EMail" type="email" class="TextBox" style="width: 98.7%;"  value="<?echo $row["EMail"]?>"/>
                        </td>
                    	<td align="center" bgcolor="#e5e5e5">
                            <span  class="red_12">* 身分證字號</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="IdentityNo" id="IdentityNo" type="text" class="TextBox" style="width: 95%;" value="<?echo $row["IdentityNo"]?>"/>
                        </td>
                        
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="red_12">* 出生日期</span>
                            <br>
                            <span class="gray_12">(YYYY-MM-DD)</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="Birthday" id="Birthday" type="date" class="TextBox" style="width: 96%;" 
                            value="<?echo $row["Birthday"] ? date('Y-m-d', strtotime($row["Birthday"])) : "" ?>"/>
                        </td>
                    </tr>
					<tr>
						<td align="center" bgcolor="#e5e5e5">
                            <span  class="red_12">* 密碼</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="Passwd" id="Passwd" type="text" class="TextBox" style="width: 98.7%;"  value="<?echo $mycrypt->decrypt($row["Passwd"])?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="red_12">* 手機號碼</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="Mobile" id="Mobile" type="tel" class="TextBox" style="width: 95%;"  value="<?echo $row["Mobile"]?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="b_12">家用電話</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="HomeTel" type="tel" class="TextBox" style="width: 95%;"  value="<?echo $row["HomeTel"]?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="b_12">傳真號碼</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="Fax" type="text" class="TextBox" style="width: 95%;"  value="<?echo $row["Fax"]?>"/>
                        </td>
					</tr>
                    <tr>
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="red_12">* 中文姓名</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="ChineseName" id="ChineseName" type="text" class="TextBox" style="width: 95%;" value="<?echo $row["ChineseName"]?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="DetailLabel">英文姓名</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="EnglishName" type="text" class="TextBox" style="width: 95%;" value="<?echo $row["EnglishName"]?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="red_12">* 暱稱</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="NickName" id="NickName" type="text" class="TextBox" style="width: 95%;" value="<?echo $row["NickName"]?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="b_12">性別</span>
                        </td>
                        <td bgcolor="#FFFFFF">
							<select name="Gender" class="dropdownlist">
								<option value="1" <? if($row["Gender"] === null || $row["Gender"] == 1){ echo 'selected'; } ?>>男</option>
								<option value="0" <? if($row["Gender"] !== null && $row["Gender"] == 0){ echo 'selected'; } ?>>女</option>	
							</select>
                        </td>
                    </tr>
					<tr>
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="b_12">願意接收簡訊(SMS)</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="Sms" type="checkbox" class="TextBox" style="width: 95%;"  value="<?echo $row["Sms"] ? "1" : "0";?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="b_12">願意訂閱電子報(E-mail)</span>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="Subscribe" type="checkbox" class="TextBox" style="width: 95%;"  value="<?echo $row["Subscribe"] ? "1" : "0";?>"/>
                        </td>
                        <td align="center" bgcolor="#e5e5e5">
                            <span  class="red_12">* 通訊地址</span>
                        </td>
                        <td colspan="3" bgcolor="#FFFFFF">
                            <div id="twzipcode"></div><input name="Address" id="Address" type="text" class="TextBox" style="width: 99.5%;"  value="<?echo $row["Address"]?>"/>
                        </td>
					</tr>
					<tr>
                        <table class="TableLine" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" bgcolor="#e5e5e5" style="width: 17%">
                                    <span  class="DetailLabel">加入會員時間</span>
                                </td>
                                <td align="center" bgcolor="#FFFFFF" style="width: 17%">
                                <? if($isNew){ ?>
                                    <span class="b_12">-</span>
                                <? }else{ ?>
                                    <span class="b_12"><? echo date_format(new DateTime($row["CreateDate"]),"Y/m/d") ?></span>
                                    <br>
                                    <span class="b_12"><? echo date_format(new DateTime($row["CreateDate"]),"H:i:s") ?></span>
                                <? } ?>
                                </td>
                                <td align="center" bgcolor="#e5e5e5" style="width: 16.5%">
                                    <span  class="b_12">更新人員</span>
                                </td>
                                <td align="center" bgcolor="#FFFFFF" style="width: 16.5%">
                                <? if($isNew){ ?>
                                    <span class="b_12">-</span>
                                <? }else{ ?>
                                    <? if($row["UpdateUserID"] != NULL){ ?>
                                    <span class="b_12"><? echo getUserName($row["UpdateUserID"])?></span>
                                    <? }else{ ?>
                                    <span class="b_12">-</span>
                                    <? } ?>
                                <? } ?>
                                </td>            
                                <td align="center" bgcolor="#e5e5e5" style="width: 16.5%">
                                    <span  class="DetailLabel">更新時間</span>
                                </td>
                                <td align="center" bgcolor="#FFFFFF" style="width: 16.5%">
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
                            </tr>
                        </table>
					</tr>
                </table>
				<br>
				<tr>
                    <td colspan="6">
                        <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView" style="border-collapse: collapse;">
                            <tr>
                                <th scope="col" style="width: 25%;">
                                    時間
                                </th>
                                <th scope="col" style="width: 25%;">
                                    活動類型
                                </th>
                                <th scope="col" style="width: 25%;">
                                    訂單編號
                                </th>
                                <th scope="col" style="width: 25%;">
                                    本次增點	
                                </th>
                                <th scope="col" style="width: 25%;">
                                    本次扣點
                                </th>
                                <th scope="col" style="width: 25%;">
                                    目前點數
                                </th>
                            </tr>
                            <? while($pointrecord_row = mysql_fetch_assoc($pointrecord_rec)){ ?>
                            <tr>
                                <td align="center">
									<? echo $pointrecord_row["RecordDate"]; ?>
                                </td>
                                <td align="center">
                                    <? echo $pointrecord_row["ActionType"]; ?>
                                </td>
								<td align="center">
                                    <? echo $pointrecord_row["OrderNo"]; ?>
                                </td>
								<td align="center">
                                    <? echo $pointrecord_row["PointPlus"]; ?>
                                </td>
								<td align="center">
                                    <? echo $pointrecord_row["PointDeduct"]; ?>
                                </td>
                                <td align="center">
                                    <? echo $pointrecord_row["PointBalance"]; ?>
                                </td>
                            </tr>
                            <? } ?>
                        </table>
						</br>
                    </td>
                </tr>
				<div class="GridViewFooter">
					<table class="TableNoLine">
						<tr>
							<td>
								<span id="PageControl1_labCount">筆數</span>： <span id="PageControl1_lblTotalCount">
									<? echo $total_records?></span>｜
							</td>
							<td>
								<a href="customerDetail.php?page=1&customerId=<? echo $customerId?>">最前頁｜</a>
							</td>
							<?	
								$prePage = $page-1;
								if ($prePage < 1) {
									$prePage = 1;
								}
							?>
							<td>
								<a href="customerDetail.php?page=<?echo $prePage?>&customerId=<? echo $customerId?>">上頁｜</a>
							</td>
							<?	
								$nextPage = $page+1;
								if ($nextPage > $total_pages) {
									$nextPage = $total_pages;
								}
							?>
							<td>
								<a href="customerDetail.php?page=<?echo $nextPage?>&customerId=<? echo $customerId?>">下頁｜</a>
							</td>
							<td>
								<a href="customerDetail.php?page=<?echo $total_pages?>&customerId=<? echo $customerId?>">最後頁</a>
							</td>
							<td>
								｜<span id="PageControl1_labPage">頁數</span>： <span id="PageControl1_lblCurrentPage">
									<?echo $page?></span>/<span id="PageControl1_lblTotalPage"><?echo $total_pages?></span>
							</td>
							<td>
								<span id="PageControl1_labTotal"></span>
							</td>
						</tr>
					</table>
				</div>
                <div style="width:100%; text-align:center">
                	<p style="height:20px;"></p>
   		      		<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit();" style="font-size:12pt; height:35px" />
            		<input type="hidden" name="customerId" value="<? echo $customerId?>"/>
            		<input type="hidden" name="action" value="update"/>
                    <p style="height:20px;"></p>
            	</div>
				
            </div>
        </div>
		<br/>
    </form>
</body>
</html>
