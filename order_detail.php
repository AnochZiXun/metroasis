<!DOCTYPE html>
<?
session_start();
include_once("_connMysql.php");
if(isset($_GET["OrderID"])) {
	$orderId = $_GET["OrderID"];
}
$customerId = $_SESSION["CustomerID"];
$tableName_main = 'Orders';
$tableName_detail = 'OrdersDetail';
$query_sql = "SELECT Orders.*, (select CodeName from RefCommon where Type = 'ReceiverWay' and TypeCode = Orders.ReceiverWay) as ReceiverWayName, (select CodeName from RefCommon where Type = 'ReceiverStore' and TypeCode = Orders.ReceiverStore) as ReceiverStoreName ,DATE_FORMAT(OrderDate,'%Y/%m/%d') as OrderDate,(SELECT CodeName FROM RefCommon WHERE Type='OrderStatus' and TypeCode=Orders.OrderStatus) as OrderStatusName,(SELECT CodeName FROM RefCommon WHERE Type='DeliverStatus' and TypeCode=Orders.DeliverStatus) as DeliverStatusName FROM $tableName_main where OrderID = $orderId";
$query_detail_sql = "SELECT OrdersDetail.*,(SELECT ListProductName FROM Products WHERE ProductID=OrdersDetail.ProductID) as ListProductName, (SELECT ProductNo FROM Products WHERE ProductID=OrdersDetail.ProductID) as ProductNo FROM $tableName_detail where OrderID = $orderId";
$rec = mysql_query($query_sql);
$row = $rec ? mysql_fetch_assoc($rec) : NULL;
$rec_detail = mysql_query($query_detail_sql);
//$row_detail = $rec_detail ? mysql_fetch_assoc($rec_detail) : NULL;
//訂單明細總筆數
$total_records = mysql_num_rows($rec_detail);
$total_amount = 0;
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
                    <div class="FloatR"></div>
                </div>
                <!-- 內容開始 -->
                <div class="orderDetailFOX">
                    <div class="orderDetailTITLE">
                      <div class="col-md-3 col-sm-12">訂單編號：<span><?echo $row["OrderNo"]?></span></div>
                      <div class="col-md-3 col-sm-12">訂購日期：<span><?echo $row["OrderDate"]?></span></div>
                      <div class="col-md-3 col-sm-12">付款狀態：<span><?echo $row["OrderStatusName"]?></span></div>
                      <div class="col-md-3 col-sm-12">出貨狀態：<span><?echo $row["DeliverStatusName"]?></span></div>
                    </div>
                  <div class="frameBOX">
                    <div class="TABLE_BOX" style="border:0px;">
                      <table class="table table-hover">
                        <thead class="thead-info">
                          <tr class="secondary">
                            <th>圖片</th>
                            <th>商品名稱</th>
                            <th>規格/尺寸</th>
                            <th>單價</th>
                            <th>數量</th>
                            <th>小計</th>
                          </tr>
                        </thead>
                        <tbody>
						<? if($rec_detail){
					  while($row_detail=mysql_fetch_assoc($rec_detail)){ 
					  $total_amount = $total_amount + $row_detail["SubTotal"];?>
                          <tr>
                            <th scope="row"><img src="images/productIMG/product01.jpg" class="img-responsive img50"></th>
                            <td class="colorA UB"><?echo $row_detail["ListProductName"]?><br><p class="colorF">商品編號：<?echo $row_detail["ProductNo"]?></p></td>
                            <td><?
							$barCode = $row_detail["BarCode"];
							$query_barcode_sql = "SELECT * FROM ProductBarCode where BarCode = $barCode";
							$rec_barcode = mysql_query($query_barcode_sql);
							$row_barcode = $rec_barcode ? mysql_fetch_assoc($rec_barcode) : NULL;
							echo $row_barcode["Color"]."/".$row_barcode["Size"]; ?></td>
                            <td>$<? echo $row_detail["UnitPrice"]; ?></td>
                            <td><? echo $row_detail["Quantity"]; ?></td>
                            <td>$<?echo $row_detail["SubTotal"]?></td>
                          </tr>
						<?}}?>
                        </tbody>
                      </table>
                    </div>
                    <div class="TABLE_BOX_mobile">
                        <div class="tableMO">
                          <div class="tableMO_A">
                            <p><img src="images/productIMG/product01.jpg" class="img-responsive"></p>
                          </div>
                          <div class="tableMO_B">
                            <p class="colorA"><?echo $row_detail["ListProductName"]?></p>
                            <p>商品編號：<?echo $row_detail["ProductNo"]?></p>
                            <p>規格/尺寸：<span class="colorB"><?echo $row_barcode["Color"]."/".$row_barcode["Size"]; ?></span></p>
                            <p>單價：<span class="colorC">$<? echo $row_detail["UnitPrice"]; ?></span></p>
                            <p>數量：<? echo $row_detail["Quantity"]; ?></p>
                            <p>小計：<span class="colorD">$<?echo $row_detail["SubTotal"]?></span></p>
                          </div>
                        </div>   
                    </div>
                      <div class="row">
                          <div class="registrationH2 numberBOX2">收件人資料</div>
                          <div class="login-page">      
                              <div class="col-lg-12">
                                <form>
                                  <div class="form-box">
                                    <label for="inputEmail3" class="col-sm-4 form-control-label">姓名</label>
                                    <div class="col-sm-8">
										<span><?echo $row["ReceiverName"]?></span>
                                      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="">-->
                                    </div>
                                  </div>
                                  <div class="form-box">
                                    <label for="inputEmail3" class="col-sm-4 form-control-label">手機</label>
                                    <div class="col-sm-8">
									<?echo $row["ReceiverMobile"]?>
                                      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="商品送達門市時會以簡訊通知取貨">-->
                                    </div>
                                  </div>
                                  <div class="form-box">
                                    <label for="inputEmail3" class="col-sm-4 form-control-label">市話</label>
                                    <div class="col-sm-8">
									<?echo $row["ReceiverLandline"]?>
                                      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="">-->
                                    </div>
                                  </div>
                                  <div class="form-box">
                                    <label for="inputEmail3" class="col-sm-4 form-control-label">電子郵件</label>
                                    <div class="col-sm-8">
									<?echo $row["ReceiverEMail"]?>
                                      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="商品送達門市時會以電子郵件通知取貨">-->
                                    </div>
                                  </div>
                                  <div class="form-box">
                                    <label for="inputEmail3" class="col-sm-4 form-control-label">送貨地址</label>
                                    <div class="col-sm-8">
									<?echo $row["ReceiverAddress"]?>
                                      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="">-->
                                    </div>
                                  </div>
                                  <div class="form-box">
                                    <label for="inputEmail3" class="col-sm-4 form-control-label">備註</label>
                                    <div class="col-sm-8">
									<?echo $row["ReceiverMemo"]?>
                                      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="">-->
                                    </div>
                                  </div>
                                </form>
                          </div>
                      </div>
                      <div class="row">
                          <div class="registrationH3 numberBOX2">運送方式</div>
                          <div class="form-check" style="padding-left: 20px;">
                            <label class="form-check-label">
                              <?
							  if($row["ReceiverWay"] == '1') {
								  echo $row["ReceiverWayName"];
							  } 
							  if($row["ReceiverWay"] == '2') {
								  echo $row["ReceiverWayName"].' ',$row["ReceiverStoreName"];
							  }?>
                            </label>
                          </div>
                          <div class="row numberBOX8">
                            <p class="colorC">總金額 <span>$<?echo $total_amount?></span></p>
                            <p style="font-size: 16px;">(再湊$300免運)　　　
								<span style="font-size: 16px;">運費　　　+$<?$deliverAmount=100;$total_amount = $total_amount + $deliverAmount;echo $deliverAmount;?></span>
							</p>
                            <div class="numberHR"></div>
                            <p class="colorD">(折扣)　　<span>-$<?echo $row["DiscountAmount"]?></span></p>
                            <p class="colorB">折扣後　<span class="numberB">$<?
							echo $total_amount - $row["DiscountAmount"]?></span></p>
                            <p>(含運費)</p>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
                    <div style="margin:10px auto;" align="center">
                      <ul class="pagination">
                        <li><a href="order.php"><span aria-hidden="true">回上頁</span></a></li>
                      </ul>
                       <!--<a href="#"><button style="float: right; margin: 20px 0; padding: 10px 30px;" type="button" class="btn btn-success btn-lg">確定修改送出</button></a>-->
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