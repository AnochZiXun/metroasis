<?php
include_once("_connMysql.php");
include_once("check_login.php");

$query_order_sql = 'SELECT Orders.*, format(TotalAmount,0) as TotalAmount, (SELECT ChineseName FROM Customers WHERE CustomerID = Orders.CustomerID) ChineseName FROM';
$orderTableName = ' Orders';
$query_order_sql = "$query_order_sql $orderTableName WHERE 1";
$orderBy = ' order by OrderID desc';
if(isset($_POST["OrderNo"]) || isset($_POST["CustomerName"]) || isset($_POST["OrderStatus"]) || isset($_POST["DeliverStatus"])) {
    $orderNo = trim($_POST["OrderNo"]);
	$customerName = trim($_POST["CustomerName"]);
	$orderStatus = trim($_POST["OrderStatus"]);
	$deliverStatus = trim($_POST["DeliverStatus"]);
    $query_order_sql = $orderNo ? $query_order_sql.' and OrderNo like "%'.$orderNo.'%" ' : $query_order_sql;  
	$query_order_sql = $customerName ? $query_order_sql.' and CustomerID in (SELECT CustomerID FROM Customers WHERE ChineseName like "%'.$customerName.'%")' : $query_order_sql;  
	$query_order_sql = $orderStatus ? $query_order_sql.' and OrderStatus = '.$orderStatus : $query_order_sql;  
	$query_order_sql = $deliverStatus ? $query_order_sql.' and DeliverStatus = '.$deliverStatus : $query_order_sql;  
	
	//echo $query_order_sql;
}
$recOrders = mysql_query($query_order_sql);
$query_order_sql = $query_order_sql.$orderBy;

function getRefCommon($type, $code) {
	$order_status_sql = "SELECT * FROM RefCommon WHERE Type='$type'";
	if($code) {
		$order_status_sql = $order_status_sql." and TypeCode='$code'";
	}
	$rec_status = mysql_query($order_status_sql);
	if($rec_status) {
		$row_status = mysql_fetch_assoc($rec_status);
		return $row_status["CodeName"];
	} else {
		return $code;
	}
}

//預設每頁筆數
$pageRow_records = 20;
//總筆數
$total_records = mysql_num_rows($recOrders);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if(!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
$recOrders = mysql_query($query_order_sql.' LIMIT '.$start.', '.$pageRow_records);

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
            //$("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 105) + "px");
            //$(".detail").colorbox({ iframe: true, width: "100%", height: "100%", overlayClose: false, escKey: false, 
			//						onClosed: function () { location.href="orders.php"; } });
			$("#divWork").attr("style", "float: left; width: 90%;");
			$("input[type=submit], input[type=button]" ).button();
        }
		 function setdetail(intNo){
        	if (intNo ==""){
        		$("#iDetail").attr("src","ordersDetail.php");	
        	}else{
        		$("#iDetail").attr("src","ordersDetail.php?orderId="+intNo);	
        	}
        	$('#divWork').animate({scrollTop: $("#divDetail").offset().top - 50}, 'slow');
        }
    </script>
</head>
<body>
    <div id="divBody" style="width:1600px; margin: 0 auto; ">
		<!-- 加上方選單 -->
		<?php include_once("_nav.php"); ?>
        <div style="=">
			<!-- 加左方選單 -->
			<?php include_once("left_nav.php"); ?>
            <div id="divWork">
                <div class="divWorkArea">
                    <div id="UpdatePanel1">
                        <div style="height:5px;"></div>
    	                    <div style="height: 36px; padding-top: 5px; border-left:1px solid #CCCCCC; border-top:1px solid #CCCCCC; border-right:1px solid #CCCCCC; background-color:#FFF;">
							<form action="" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
								<div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
									&nbsp;&nbsp;訂單編號：
								</div>
								<div style="float: left; padding-right: 10px;padding-top: 3px;">
									<input type="text" class="TextBox" name="OrderNo" style="width:120px">
								</div>
								<div style="float: left; height:25px; padding-top:5px; padding-left:20px; font-size:13px">
									客戶姓名：
								</div>
								<div style="float: left; padding-right: 10px;padding-top: 3px;">
									<input type="text" class="TextBox" name="CustomerName" style="width:60px">
								</div>
								<div style="float: left; height:25px; padding-top:5px; padding-left:20px; font-size:13px">
									狀態：
								</div>
								<div style="float: left; padding-right: 20px;padding-top: 3px;">
									<select name="OrderStatus" class="dropdownlist">
										<?
											$findOrderStatus = "SELECT * FROM RefCommon WHERE Type = 'OrderStatus' AND TypeCode <> 0 ORDER BY SortNo";
											$recOrderStatus = mysql_query($findOrderStatus);
										?>
										<option value="" id="0" selected><? echo "---------" ?></option>
										<? while($rowOrderStatus = mysql_fetch_assoc($recOrderStatus)){ ?>
											<option value="<? echo $rowOrderStatus["TypeCode"] ?>" id="<? echo $rowOrderStatus["TypeCode"] ?>"><?echo $rowOrderStatus["CodeName"] ?></option>
										<? } ?>
									</select>
								</div>
								<div style="float: left; height:25px; padding-top:5px; padding-left:20px; font-size:13px">
									送貨狀態：
								</div>
								<div style="float: left; padding-right: 20px;padding-top: 3px;">
									<select name="DeliverStatus" class="dropdownlist">
										<?
											$findDeliverStatus = "SELECT * FROM RefCommon WHERE Type = 'DeliverStatus' AND TypeCode <> 0 ORDER BY SortNo";
											$recDeliverStatus = mysql_query($findDeliverStatus);
										?>
										<option value="" id="0" selected><? echo "---------" ?></option>
										<? while($rowDeliverStatus = mysql_fetch_assoc($recDeliverStatus)){ ?>
											<option value="<? echo $rowDeliverStatus["TypeCode"] ?>" id="<? echo $rowDeliverStatus["TypeCode"] ?>"><?echo $rowDeliverStatus["CodeName"] ?></option>
										<? } ?>
									</select>
								</div>
                                <div style="float: left; padding-top:5px; padding-left:20px; padding-top:3px; font-size:13px">
									<input name="submitSearch" type="submit" value="查詢"/>
								</div>
							</form>
    	                    </div>
                        <div id="divDetailBody">
                            <div id="divGridview">
                                <div>
                                    <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView"
                                        style="border-collapse: collapse;">
										<tr>
											<th scope="col" style="width: 3%;">#</th>
											<th scope="col" style="width: 7%;">狀態</th>
											<th scope="col" style="width: 7%;">出貨狀態</th>
                                            <th scope="col" style="width: 10%;">訂單編號</th>
                                            <th scope="col" style="width: 13%;">訂單日</th>
											<th scope="col" style="width: 10%;">客戶姓名</th>
                                            <th scope="col" style="width: 10%;">訂單金額</th>
											<th scope="col" style="width: 15%;">付款日</th>
											<th scope="col" style="width: 15%;">出貨日</th>
											<th scope="col" style="width: 10%;">功能</th>
											<!--
											<th scope="col" style="width: 25%;" colspan="2">處理</th>
											-->
                                        </tr>
										<?  if ($page > 1) {
                                        		$rowNumber = ($pageRow_records * ($page - 1)) + 1;
                                        	}else{
                                        		$rowNumber = 1;
                                        	}                                        	
                                        	while($row=mysql_fetch_assoc($recOrders)){ ?>
										<tr>
											<td align="center">
                                                <span class="b_12"><? echo $rowNumber ?></span>
                                            </td>
											<td align="center">
												<span class="b_12"><? echo getRefCommon("OrderStatus", $row["OrderStatus"]); ?></span>
                                            </td>
											<td align="center">
												<span class="b_12"><? echo getRefCommon("DeliverStatus", $row["DeliverStatus"]); ?></span>
                                            </td>
                                            <td align="center">
												<span class="b_12"><? echo $row["OrderNo"]; ?></span>
                                            </td>
                                            <td align="center">
												<span class="b_12"><? echo setData($row["OrderDate"]); ?></span>
                                            </td>
                                            <td align="center">
												<span class="b_12"><? echo setData($row["ChineseName"]); ?></span>
                                            </td>
											<td align="left" style="padding-left:30px;">
												 <span class="b_12">NT$ <? echo setData($row["TotalAmount"]); ?></span>
                                            </td>
                                            <td align="center">
												<span class="b_12"><? echo setData($row["PayDate"]); ?></span>
                                            </td>
                                            <td align="center">
												<span class="b_12"><? echo setData($row["DeliverDate"]); ?></span>
                                            </td>   
											<td align="center">
												<input id="btnEdit" name="btnEdit" class="detail"  type="button" value="修改" onclick="setdetail('<?echo $row["OrderID"]?>')" />
                                            </td>
											<!--
                                            <td align="center">
                                                <a id="gvGridView_ctl02_hlContents" class="detail" href="ordersDetail.php?orderId=<? echo $row["OrderID"]; ?>">
                                                    內容設定
												</a>
                                            </td>
											<td align="center">
                                                <form action="" method="POST" enctype="multipart/form-data" id="delete" name="delete">
													<input name="delete" type="submit" value="刪除"/>
													<input name="OrderID" type="hidden" value="<? echo $row["OrderID"]; ?>"/>
													<input name="action" type="hidden" value="delete"/>
												</form>
                                            </td>
											-->
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
											<a href="customers.php?page=1">最前頁｜</a>
                                        </td>
                                        <?	
											$prePage = $page-1;
											if ($prePage < 1) {
												$prePage = 1;
											}
										?>
										<td>
											<a href="customers.php?page=<?echo $prePage?>">上頁｜</a>
                                        </td>
										<?	
											$nextPage = $page+1;
											if ($nextPage > $total_pages) {
												$nextPage = $total_pages;
											}
										?>
                                        <td>
											<a href="customers.php?page=<?echo $nextPage?>">下頁｜</a>
                                        </td>
                                        <td>
											<a href="customers.php?page=<?echo $total_pages?>">最後頁</a>
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
	                    	<iframe id="iDetail" src="" width="100%" height="1050" frameborder="0" scrolling="no"></iframe>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
