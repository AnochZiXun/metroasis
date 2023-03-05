<!DOCTYPE html>
<?
session_start();
include_once("_connMysql.php");
include_once("check_login.php");
$currentUserID = $_SESSION["CustomerID"];#CustomerID
if(isset($_GET["OrderNo"])) {
	$orderNo = $_GET["OrderNo"];
	$orderDateStart = $_GET["OrderDateStart"];
	$orderDateEnd = $_GET["OrderDateEnd"];
  $orderStatus = $_GET["OrderStatus"];
  $deliverStatus = $_GET["DeliverStatus"];
}
//if(isset($_SESSION["CustomerID"])) {
	
	$query_order_sql = "SELECT Orders.*, format(TotalAmount,0) as TotalAmount, (SELECT CodeName FROM RefCommon WHERE Type='OrderStatus' and TypeCode=Orders.OrderStatus) as OrderStatusName,(SELECT CodeName FROM RefCommon WHERE Type='DeliverStatus' and TypeCode=Orders.DeliverStatus) as DeliverStatusName FROM";
	$orderTableName = ' Orders';
	$query_order_sql = "$query_order_sql $orderTableName WHERE 1 AND CustomerID = '$currentUserID'";
	
	if($orderNo) {
		$query_order_sql = $query_order_sql." and OrderNo like '%$orderNo%'";
	}
	if($orderDateStart) {
		$query_order_sql = $query_order_sql." and OrderDate >= '$orderDateStart'";
	}
	if($orderDateEnd) {
		$query_order_sql = $query_order_sql." and OrderDate <= '$orderDateEnd'";
	}
  if($orderStatus && $orderStatus != "") {
    $query_order_sql = $query_order_sql." and OrderStatus = '$orderStatus'";
  }
  if($deliverStatus && $deliverStatus != "") {
    $query_order_sql = $query_order_sql." and DeliverStatus = '$deliverStatus'";
  }
	
	$orderBy = ' order by OrderID desc';
	$recOrders = mysql_query($query_order_sql);
	$query_order_sql = $query_order_sql.$orderBy;
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

  $rec_orderStatus = mysql_query("SELECT * FROM RefCommon WHERE Type='OrderStatus'");
  $rec_deliverStatus = mysql_query("SELECT * FROM RefCommon WHERE Type='DeliverStatus'");

//}
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title>城市綠洲戶外生活館</title>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Dropdown Hover CSS -->
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap-dropdownhover.min.css" rel="stylesheet"> 
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/slides.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/style_forBS.css" rel="stylesheet">
    <!--bootstrap-->
    <link href="css/style_forDIY.css" rel="stylesheet">
    <!--bootstrap-->
    <link rel="stylesheet" media="screen,projection" href="css/ui.totop.css" />
    <link href="css/flexslider.css" type="text/css" rel="stylesheet" />
    <script src="js/menu.js"></script>
    <!-- menu下拉 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="js/flycan.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <!-- Bootstrap Dropdown Hover JS -->
    <script src="js/bootstrap-dropdownhover.min.js"></script>      
</head>
<body>
<?php include_once("_include/_head.php"); ?>
    <!-- 上方選單end -->
    <div id="CONTENT-2">
        <!-- 第一塊大的區塊 -->
        <div class="row">
            <!-- 左欄區塊 -->
            <div class="row leftBOX">
                <!-- 產品menu -->
                <?php include_once("_include/_productList.php"); ?>
                <!-- 折扣活動 -->
                <?php include_once("_include/_sale.php"); ?>
            </div>
            <!-- 右欄區塊 -->
            <div class="row rightBOX">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item">會員中心</li>
                  <li class="breadcrumb-item active">我的訂單</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 我的訂單
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
				<form method="GET" enctype="multipart/form-data">
                  <div class="SEARCH" align="center">
                    訂購日期：<input type="date" name="OrderDateStart" value="<?echo $orderDateStart;?>" style="height:26px;" placeholder="選擇日期">　~　<input type="date" name="OrderDateEnd" value="<?echo $orderDateEnd;?>" style="height:26px;"  placeholder="選擇日期">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    訂單編號：<input type="text" name="OrderNo" value="<?echo $orderNo?>" style="height:26px;" placeholder="輸入訂單編號">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <br>
                    付款狀態：
                    <select name="OrderStatus">
                      <option value="">------</option>
                      <? if($rec_orderStatus){
                          while($row_orderStatus=mysql_fetch_assoc($rec_orderStatus)){
                      ?>
                          <option value="<?echo $row_orderStatus["TypeCode"]?>" <?if($row_orderStatus["TypeCode"] == $orderStatus) {echo "selected";}?> ><?echo $row_orderStatus["CodeName"]?></option>
                      <?
                          }
                         }
                      ?>
                    </select>
                    出貨狀態：
                    <select name="DeliverStatus">
                      <option value="">------</option>
                      <? if($rec_deliverStatus){
                          while($row_deliverStatus=mysql_fetch_assoc($rec_deliverStatus)){
                      ?>
                          <option value="<?echo $row_deliverStatus["TypeCode"]?>" <?if($row_deliverStatus["TypeCode"] == $deliverStatus) {echo "selected";}?>><?echo $row_deliverStatus["CodeName"]?></option>
                      <?
                          }
                         }
                      ?>
                    </select>                    
                    <button type="submit" class="btn btn-success btn-lg">搜尋</button>
                  </div>
				</form>
				<form method="GET" enctype="multipart/form-data">
                  <div class="pointSEARCH" align="center">
                    訂購日期：<input type="date" name="OrderDateStart" value="<?echo $orderDateStart;?>" style="height:26px;" placeholder="選擇日期">　~　<input type="date" name="OrderDateEnd" value="<?echo $orderDateEnd;?>" style="height:26px;" placeholder="選擇日期">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    訂單編號：<input type="text" name="OrderNo" value="<?echo $orderNo?>" style="height:26px;" placeholder="輸入訂單編號">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <br>
                    付款狀態：
                    <select name="OrderStatus">
                      <option value="">------</option>
                      <? if($rec_orderStatus){
                          while($row_orderStatus=mysql_fetch_assoc($rec_orderStatus)){
                      ?>
                          <option value="<?echo $row_orderStatus["TypeCode"]?>" <?if($row_orderStatus["TypeCode"] == $orderStatus) {echo "selected";}?> ><?echo $row_orderStatus["CodeName"]?></option>
                      <?
                          }
                         }
                      ?>
                    </select>
                    出貨狀態：
                    <select name="DeliverStatus">
                      <option value="">------</option>
                      <? if($rec_deliverStatus){
                          while($row_deliverStatus=mysql_fetch_assoc($rec_deliverStatus)){
                      ?>
                          <option value="<?echo $row_deliverStatus["TypeCode"]?>" <?if($row_deliverStatus["TypeCode"] == $deliverStatus) {echo "selected";}?> ><?echo $row_deliverStatus["CodeName"]?></option>
                      <?
                          }
                         }
                      ?>
                    </select>    
                    <button type="submit" class="btn btn-success btn-lg">搜尋</button>
                  </div>
				  </form>
                  <div class="TABLE_BOX">
                    <table class="table table-hover">
                      <thead class="thead-info">
                        <tr class="secondary">
                          <th>#</th>
                          <th>訂單編號</th>
                          <th>訂單日期</th>
                          <th>付款狀態</th>
                          <th>出貨狀態</th>
                          <th>訂單金額</th>
                          <th>明細資料</th>
                          <!--<th>取消訂單</th>-->
                        </tr>
                      </thead>
                      <tbody>
					  <? if($recOrders){
					  while($row=mysql_fetch_assoc($recOrders)){ ?>
                        <tr>
                          <th scope="row"><?echo $row["OrderID"]?></th>
                          <td class="colorA"><?echo $row["OrderNo"]?></td>
                          <td class="UB"><?echo $row["OrderDate"]?></td>
                          <td><span class="<?echo $row["OrderStatus"] == '1'? 'colorD' : 'colorC'?>"><?echo $row["OrderStatusName"]?></span></td>
                          <td><span class="<?echo $row["DeliverStatus"] == '3'? 'colorD' : 'colorC'?>"><?echo $row["DeliverStatusName"]?></span></td>
                          <td class="colorB">NT$ <?echo $row["TotalAmount"]?></td>
                          <td><a class="colorE" href="order_detail.php<?echo '?OrderID='.$row["OrderID"]?>"><i class="fa fa-list-ul" aria-hidden="true"></i></a></td>
                        </tr>
					  <?}}?>
                      </tbody>
                    </table>
                  </div>
                  <div class="TABLE_BOX_mobile">
				  <? if($recOrders){
					  while($row=mysql_fetch_assoc($recOrders)){ ?>
                      <div class="tableMO">
                          <p>#<?echo $row["OrderID"]?></p>
                          <p class="colorA">訂單編號：<?echo $row["OrderNo"]?></p>
                          <p>活動日期：<?echo $row["OrderDate"]?></p>
                          <p>付款狀態：<span class="<?echo $row["OrderStatus"] == '1'? 'colorD' : 'colorC'?>"><?echo $row["OrderStatusName"]?></span></p>
                          <p>出貨狀態：<span class="<?echo $row["DeliverStatus"] == '3'? 'colorD' : 'colorC'?>"><?echo $row["DeliverStatusName"]?></span></p>
                          <p>訂單金額：<span class="colorB"><?echo $row["TotalAmount"]?></span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-list-ul" aria-hidden="true"></i> 明細資料</button>
                      </div>   
                    <?}}?> 
                  </div>
                    <div class="pageBOX">
                      <ul class="pagination">
                        <li><a href="order.php?page=1<?echo '&OrderNo='.$orderNo.'&OrderDateStart='.$orderDateStart.'&OrderDateEnd='.$orderDateEnd.'&OrderStatus='.$orderStatus.'&DeliverStatus='.$deliverStatus?>"><span aria-hidden="true">&laquo;</span></a></li>
                        <? for ($i=0; $i<$total_pages; $i++) {?>
                          <? if ($_GET["page"] == $i+1) {?>
                            <li class="active"><a href="order.php?page=<? echo $i+1?><?echo '&OrderNo='.$orderNo.'&OrderDateStart='.$orderDateStart.'&OrderDateEnd='.$orderDateEnd.'&OrderStatus='.$orderStatus.'&DeliverStatus='.$deliverStatus?>"><? echo $i+1 ?></a></li>
                          <? } else { ?>
                            <li><a href="order.php?page=<? echo $i+1?><?echo '&OrderNo='.$orderNo.'&OrderDateStart='.$orderDateStart.'&OrderDateEnd='.$orderDateEnd.'&OrderStatus='.$orderStatus.'&DeliverStatus='.$deliverStatus?>"><? echo $i+1 ?></a></li>
                          <? } ?>
                        <? } ?>
                        <li><a href="order.php?page=<? echo $total_pages;?><?echo '&OrderNo='.$orderNo.'&OrderDateStart='.$orderDateStart.'&OrderDateEnd='.$orderDateEnd.'&OrderStatus='.$orderStatus.'&DeliverStatus='.$deliverStatus?>"><span aria-hidden="true">&raquo;</span></a></li>
                      </ul>
                    </div>
					<!--
                    <div class="pageBOX">
                      <ul class="pagination">
                        <li><a href="#"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><span aria-hidden="true">&raquo;</span></a></li>
                      </ul>
                    </div>
                   -->
                </div>
            </div>
        </div>
    </div>
 <?php include_once("_include/_footer.php"); ?>
    <!-- easing plugin ( optional ) -->
    <script src="js-top/easing.js" type="text/javascript"></script>
    <!-- UItoTop plugin -->
    <script src="js-top/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- Starting the plugin -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */
            
            $().UItoTop({ easingType: 'easeOutQuart' });
            
        });
    </script>
</body>
</html>