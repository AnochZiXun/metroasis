<?php
include_once("_connMysql.php");
include_once("check_login.php");
if(isset($_GET["orderId"])) {
	$orderId = $_GET["orderId"];
}
if (isset($_POST["orderId"])) {
	$orderId = $_POST["orderId"];
}
$mode="修改";
$currentUserID = $_SESSION["userID"];
if($_POST["action"] == "update")
{ 
	$orderStatus = $_POST["OrderStatus"];
	$deliverStatus = $_POST["DeliverStatus"];
	$update_sql = "update Orders set  	OrderStatus='$orderStatus',
										DeliverStatus='$deliverStatus',
										UpdateUserID=$currentUserID
										WHERE OrderId='$orderId'";
	
	mysql_query($update_sql);
	//echo $update_sql;
	echo "<script>parent.location.href='orders.php'; </script>";	
}
$tableName_main = 'Orders';
$tableName_detail = 'OrdersDetail';
$query_sql = "SELECT Orders.*,
(select CodeName from RefCommon where Type = 'ReceiverWay' and TypeCode = Orders.ReceiverWay) as ReceiverWayName, 
(select CodeName from RefCommon where Type = 'ReceiverStore' and TypeCode = Orders.ReceiverStore) as ReceiverStoreName, 
(select CodeName from RefCommon where Type = 'PayType' and TypeCode = Orders.PayType) as PayTypeName,
(select CustomerNo from Customers where CustomerID = Orders.CustomerID) as CustomerNo,
format(SaleAmount,0) as SaleAmount,format(DiscountAmount,0) as DiscountAmount,format(Tax,0) as Tax,format(ExpressFee,0) as ExpressFee,format(TotalAmount,0) as TotalAmount
FROM $tableName_main where OrderID = $orderId";
$query_detail_sql = "SELECT OrdersDetail.*, 
(select ProductNo from Products where ProductID = OrdersDetail.ProductID) as ProductNo,
(select ProductName from Products where ProductID = OrdersDetail.ProductID) as ProductName,
format(ListPrice,0) as ListPrice,format(UnitPrice,0) as UnitPrice,format(DisountPrice,0) as DisountPrice,format(SubTotal,0) as SubTotal,format(Point,0) as Point
FROM $tableName_detail where OrderID = $orderId";
$rec = mysql_query($query_sql);
$row = $rec ? mysql_fetch_assoc($rec) : NULL;
$rec_detail = mysql_query($query_detail_sql);
//$row_detail = $rec_detail ? mysql_fetch_assoc($rec_detail) : NULL;
//訂單明細總筆數
$total_records = mysql_num_rows($rec_detail);
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
    <script type="text/javascript" charset="UTF-8" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
        function pageInitial() {
			var bodyHeight = document.body.clientHeight;
			//$("#txtEndDate").datepicker({ dateFormat: 'yy/mm/dd', changeYear: true, changeMonth: true });
            $("input[type=submit], input[type=button]" ).button();	
        }
    </script>
</head>
<body>
    <form name="form1" method="post" action="ordersDetail.php" id="form1" enctype="multipart/form-data">
    <div>
        <div id="UpdatePanel1">
            <div class="divDetailTopBar">
                <div id="ToolBar">
                    <div style="float: left;>
                        <span id="LabMessage" class="labMessage"><?echo "【". $mode ."】" . $row["OrderNo"] ?></span>
                    </div>
                </div>
            </div>
            <div id="divDetailBody" class="divDetailBody">
				<table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
				    <tr>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">會員編號</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["CustomerNo"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">訂單編號</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["OrderNo"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">訂單日期</span>
                        </td>
                        <td bgcolor="#ffffff" colspan="3" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["OrderDate"]?></span>
                        </td>
                    </tr>
                    <tr>
						<td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">付款日期</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["PayDate"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span  class="DetailLabel">付款方式</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["PayTypeName"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">確認日期</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ConfirmDate"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span  class="DetailLabel">確認人員</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
                            <span style="font-size: 10pt;"><?echo getUserName($row["ConfirmUserID"])?></span>
                        </td>
                    </tr>
					<tr>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span  class="DetailLabel">配送日期</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["DeliverDate"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">貨運編號</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ExpressNo"]?></span>
                        </td>
						<td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span  class="DetailLabel">退貨日期</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["RefundDate"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span  class="DetailLabel">退貨人員</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
                            <span style="font-size: 10pt;"><?echo getUserName($row["RefundUserID"])?></span>
                        </td>
					</tr>
					<tr>
						<td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">銷售金額</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["SaleAmount"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">折扣</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["DiscountAmount"]?></span>
                        </td>
						<td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">稅</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["Tax"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">運費</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ExpressFee"]?></span>
                        </td>
					</tr>
					<tr>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">總價</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["TotalAmount"]?></span>
                        </td>
                         <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span  class="DetailLabel">發票號碼</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["InvoiceNo"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">訂單狀態</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<select name="OrderStatus" id="OrderStatus" class="dropdownlist">
								<?
									$findOrderStatus = "SELECT * FROM RefCommon WHERE Type = 'OrderStatus' AND TypeCode <> 0 ORDER BY SortNo";
									$recOrderStatus = mysql_query($findOrderStatus);
								?>
								<option value="-1" id="0" selected><? echo "---------" ?></option>
								<? while($rowOrderStatus = mysql_fetch_assoc($recOrderStatus)){ ?>
									<?if ($rowOrderStatus["TypeCode"] == $row["OrderStatus"]) { ?>
										<option value="<? echo $rowOrderStatus["TypeCode"] ?>" id="<? echo $rowOrderStatus["TypeCode"] ?>" selected><?echo $rowOrderStatus["CodeName"] ?></option>
									<? } else {?>
										<option value="<? echo $rowOrderStatus["TypeCode"] ?>" id="<? echo $rowOrderStatus["TypeCode"] ?>"><?echo $rowOrderStatus["CodeName"] ?></option>
									<? } ?>
								<? } ?>
							</select>
                            <!-- <span style="font-size: 10pt;"><?echo getRefCommon("OrderStatus", $row["OrderStatus"])?></span> -->
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">送貨狀態</span>
                        </td>
                        <td  bgcolor="#ffffff" colspan="3" style="width: 15%">
							<select name="DeliverStatus" id="DeliverStatus" class="dropdownlist">
								<?
									$findDeliverStatus = "SELECT * FROM RefCommon WHERE Type = 'DeliverStatus' AND TypeCode <> 0 ORDER BY SortNo";
									$recDeliverStatus = mysql_query($findDeliverStatus);
								?>
								<option value="-1" id="0" selected><? echo "---------" ?></option>
								<? while($rowDeliverStatus = mysql_fetch_assoc($recDeliverStatus)){ ?>
									<?if ($rowDeliverStatus["TypeCode"] == $row["DeliverStatus"]) { ?>
										<option value="<? echo $rowDeliverStatus["TypeCode"] ?>" id="<? echo $rowDeliverStatus["TypeCode"] ?>" selected><?echo $rowDeliverStatus["CodeName"] ?></option>
									<? } else {?>
										<option value="<? echo $rowDeliverStatus["TypeCode"] ?>" id="<? echo $rowDeliverStatus["TypeCode"] ?>"><?echo $rowDeliverStatus["CodeName"] ?></option>
									<? } ?>
								<? } ?>
							</select>
                            <!--<span style="font-size: 10pt;"><?echo getRefCommon("DeliverStatus", $row["DeliverStatus"])?></span> -->
                        </td>
					</tr>
					<tr>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">收件者姓名</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ReceiverName"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">收件者手機號碼</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ReceiverMobile"]?></span>
                        </td>
						<td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">收件者市內電話</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ReceiverLandline"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">收件者電子信箱</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ReceiverEMail"]?></span>
                        </td>
					</tr>
					<tr>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">收件方式</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ReceiverWayName"]?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">到貨門市</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ReceiverStoreName"]?></span>
                        </td>
						<td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">收件者地址</span>
                        </td>
                        <td bgcolor="#ffffff" colspan="3" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ReceiverAddress"]?></span>
                        </td>
					</tr>
					<tr>
						<td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">收件備註</span>
                        </td>
                        <td bgcolor="#ffffff" colspan="7" style="width: 15%">
							<span style="font-size: 10pt;"><?echo $row["ReceiverMemo"]?></span>
                        </td>
					</tr>
					<tr>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span  class="DetailLabel">建立時間</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
                            <span style="font-size: 10pt;"><?echo $row["CreateDate"]?></span>
                        </td>
						<td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">建立人員</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
                            <span style="font-size: 10pt;"><?echo getUserName($row["CreateUserID"])?></span>
                        </td>
                        <td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span  class="DetailLabel">更新時間</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
                            <span style="font-size: 10pt;"><?echo $row["UpdateDate"]?></span>
                        </td>
						<td bgcolor="#e5e5e5" style="width: 10%" align="center">
                            <span class="DetailLabel">異動人員</span>
                        </td>
                        <td bgcolor="#ffffff" style="width: 15%">
                            <span style="font-size: 10pt;"><?echo getUserName($row["UpdateUserID"])?></span>
                        </td>
					</tr>
                </table>
				<br>
                <table class="GridView" cellspacing="0" cellpadding="5" rules="all" border="1" id="gvGridView" style="border-collapse: collapse;">
                    <tr>
                        <th scope="col" style="width: 5%;">
                            商品編號
                        </th>
                        <th scope="col" style="width: 25%;">
                            商品名稱
                        </th>
						<!--
                        <th scope="col" style="width: 25%;">
                            條碼
                        </th>-->
                        <th scope="col" style="width: 5%;">
                            訂價
                        </th>
                        <th scope="col" style="width: 5%;">
                            單價
                        </th>
                        <th scope="col" style="width: 5%;">
                            折扣價
                        </th>
                        <th scope="col" style="width: 5%;">
                            數量
                        </th>
                        <th scope="col" style="width: 5%;">
                            小記
                        </th>
                        <th scope="col" style="width: 5%;">
                            點數
                        </th>
                    </tr>
                    <? 
					$totalCount = 0;
					while($orderDetailRow = mysql_fetch_assoc($rec_detail))
					{ 
						$totalCount = $totalCount + $orderDetailRow["Quantity"];
					?>
                    <tr>
                        <td align="center">
							<? echo $orderDetailRow["ProductNo"]; ?>
                        </td>
                        <td align="center">
                            <? echo $orderDetailRow["ProductName"]; ?>
                        </td>
						<!--
                        <td align="center">
                            <? echo $orderDetailRow["BarCode"]; ?>
                        </td>-->
						<td align="center">
                            <? echo $orderDetailRow["ListPrice"]; ?>
                        </td>
						<td align="center">
                            <? echo $orderDetailRow["UnitPrice"]; ?>
                        </td>
						<td align="center">
                            <? echo $orderDetailRow["DisountPrice"]; ?>
                        </td>
                        <td align="center">
                            <? echo $orderDetailRow["Quantity"]; ?>
                        </td>
                        <td align="center">
                            <? echo $orderDetailRow["SubTotal"]; ?>
                        </td>
						
						<td align="center">
                            <? echo $orderDetailRow["Point"]; ?>
                        </td>
                    </tr>
                    <? } ?>
					<? if($total_records > 0) { ?>
                    <tr>
                        <td align="center">
							總計
                        </td>
                        <td align="center" colspan="4">
                        </td>
                        <td align="center">
                            <? echo $totalCount; ?>
                        </td>
                        <td align="center">
                            <? echo $row["TotalAmount"]; ?>
                        </td>
                        <td align="center">
                        </td>
                    </tr>				
					<?}?>
                </table>
				<div style="width:100%; text-align:center">
					<p style="height:20px;"></p>
					<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="showLoading();" style="font-size:12pt; height:35px" />
					<input type="hidden" name="orderId" value="<? echo $orderId?>"/>
					<input type="hidden" name="action" value="update"/>
					<p style="height:20px;"></p>
				</div>
            </div>
        </div>
    </form>
</body>
</html>
