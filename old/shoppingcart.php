<!DOCTYPE html>
<?php
	include_once("_connMysql.php");
	include_once("check_login.php");
	
	if(!isset($_SESSION["CustomerID"])){
		header("Location: login.php");
	}
	
	$customerID = $_SESSION["CustomerID"];
	
	$query_OrderBaskets = "SELECT OB.BasketID, OB.BarCode, OB.ProductID, OB.Quantity, OB.UnitPrice, 
								PB.Color, PB.ProductNo, PB.Size, 
								P.ProductName
								FROM `OrderBaskets` OB,`ProductBarCode` PB, `Products` P WHERE 1=1 
								AND OB.BarCode = PB.BarCode AND OB.ProductID = P.ProductID  
								AND OB.`CustomerID` = '$customerID'";
	$rec = mysql_query($query_OrderBaskets);
    $summary = 0;
    while($rows=mysql_fetch_assoc($rec)){ 
      $summary += $rows["UnitPrice"] * $rows["Quantity"];
    }
	mysql_data_seek($rec, 0);
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
	<script src="js/qtyplus.js"></script>
</head>
<body>
<?php include_once("_include/_head.php"); ?>
	<input type="hidden" id="customerID" value="<?echo $customerID;?>" />
    <!-- 上方選單end -->
    <div id="CONTENT-2">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item active">購物車</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 購物車 / 確認訂購明細
                </div>
        <!-- 第一塊大的區塊 -->
        <div class="row shoppingcartTOP">
            <div class="col"><div class="tobBOX colorA">1</div><p class="colorWa m40">確認訂購明細 <i class="fa fa-chevron-right" aria-hidden="true"></i> </p>
            </div>
            <div class="col"><div class="tobBOX colorB">2</div><p class="colorWb m40">填寫資料與運送方式 <i class="fa fa-chevron-right" aria-hidden="true"></i> </p>
            </div>
            <div class="col"><div class="tobBOX colorB">3</div><p class="colorWb m10">付款完成訂購</p>
            </div>
        </div>
        <div class="row" style="margin: 0 0 30px 0;">
            <div class="frameBOX">
                <div class="TABLE_BOX">
                    <table class="table table-hover">
                      <thead class="thead-info">
                        <tr class="secondary">
                          <th>圖片</th>
                          <th>商品名稱</th>
                          <th>規格/尺寸</th>
                          <th>數量</th>
                          <th>單價</th>
                          <th>小計</th>
                          <th>移除</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php 
						while($rows=mysql_fetch_assoc($rec)){ 
						$total = $rows["UnitPrice"] * $rows["Quantity"];
						?>
                        <tr class="basketItemRow" id="<?echo "BODY_".$rows["BarCode"];?>">
                          <?php 
                          $productID = $rows["ProductID"];
                          $rec_img = mysql_query("SELECT * FROM ImagesFiles WHERE ImageFunction = 'products' AND ImageType = 'detail' AND ForeignID = '$productID' ORDER BY ImageFileName LIMIT 1 ");
                          $row_img = mysql_fetch_assoc($rec_img);
                          ?>                          
                          <th scope="row"><img src="<? echo $row_img["ImagePath"].$row_img["ImageFileName"]; ?>" class="img-responsive img50"></th>
                          <td class="colorA UB"><? echo $rows["ProductName"]; ?></td>
                          <td><? echo $rows["Color"]."/".$rows["Size"]; ?>號</td>
                          <td>
                                <input type="button" value="-" class="qtyminus" field="quantity" />
                                <input type="text" name="quantity" value="<? echo $rows['Quantity']?>" class="qty" />
                                <input type="button" value="+" class="qtyplus" field="quantity" />　
                          </td>
						<input type="hidden" name="real_basket_id" value="<? echo $rows["BasketID"]?>" />
						<input type="hidden" name="real_quantity" value="<? echo $rows["Quantity"]?>" />
                          <td id="unitPrice">$<? echo $rows["UnitPrice"]; ?></td>
                          <td class="item_total_amount">$<? echo $total; ?></td>
                          <td><a class="colorE removeItem2" href="#" targetId="<?echo $rows["BarCode"];?>" onclick="return false"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
						<? } ?>
                      </tbody>
                    </table>
                </div>
                  <div class="TABLE_BOX_mobile">
					
                      
					  <?php 
					  while($mrows=mysql_fetch_assoc($rec)){ 
					  $totalPrice = intval($mrows['Quantity']) * intval($mrows["UnitPrice"]);
					  ?>
					  <div class="tableMO">
                        <div class="tableMO_A">
                          <p><img src="<? echo $mrows["ImagePath"].$mrows["ImageFileName"]; ?>" class="img-responsive"></p>
                        </div>
                        <div class="tableMO_B">
                          <p class="colorA"><? echo $mrows["ListProductName"]; ?></p>
                          <p>商品編號：<? echo $mrows["ProductNo"]; ?></p>
                          <p>規格/尺寸：<span class="colorB"><? echo $mrows["Color"]."/".$mrows["Size"]; ?>號</span></p>
                          <p>數量：
							
                            <input type="button" value="-" class="qtyminus" field="quantity" />
                            <input type="text" name="quantity" value="<? echo $mrows['Quantity']?>" class="qty" />
                            <input type="button" value="+" class="qtyplus" field="quantity" />
							
                          </p>
                          <p>單價：<span class="colorC">$<? echo $mrows["UnitPrice"]; ?></span></p>
                          <p>小計：<span class="colorD">$<? echo $totalPrice; ?></span></p>
                        </div>
                          <button type="button" class="btn btn-warning btn-lg removeItem" targetId="<?echo $mrows["BarCode"];?>"><i class="fa fa-times-circle" aria-hidden="true"></i> 移除</button> 
						   </div>
                      <? } ?>
					 
					  
                    <div class="numberBOX1"><span class="numberA">折扣後 $739</span> <p>省$51</p></div>
                  </div>                  
                    <div class="row">
                        <div class="registrationH2 numberBOX2">已符合折扣活動</div>
                         <div class="col numberBOX3">
                            <div class="col-md-6 col-sm-12 numberBOX4">
                                <p><span><i class="fa fa-check-circle" aria-hidden="true"></i> 滿額折扣</span><strong>滿$3,300現折$300</strong></p><p>【母親節感恩慶】app購物滿額送現金折回饋</p>
                            </div>
                            <div class="col-md-6 col-sm-12 numberBOX5">
                                <a class="colorC" href="">折扣$300 <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            </div>
                          </div>
                         <div class="col numberBOX6">
                            <div class="col-md-6 col-sm-12 numberBOX4">
                                <p><span><i class="fa fa-check-circle" aria-hidden="true"></i> 滿額回饋</span><strong>滿$2,500送贈品</strong></p><p>【母親節感恩慶】app購物滿額送現金折回饋提袋</p>
                            </div>
                            <div class="col-md-6 col-sm-12 numberBOX5">
                                <a class="colorC" href="">獲得贈品 <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            </div>
                          </div>
                        <div class="registrationH3 numberBOX2">未符合折扣活動</div>
                         <div class="col numberBOX3">
                            <div class="col-md-6 col-sm-12 numberBOX7">
                                <p><span><i class="fa fa-times-circle" aria-hidden="true"></i> 滿額折扣</span><strong>滿2件打8折</strong></p><p>換季出清指定款保暖衣任二件8折</p>
                            </div>
                            <div class="col-md-6 col-sm-12 numberBOX5">
                                <a class="colorD" href="">再湊一件打8折 <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            </div>
                          </div>
                         <div class="col numberBOX6">
                            <div class="col-md-6 col-sm-12 numberBOX7">
                                <p><span><i class="fa fa-times-circle" aria-hidden="true"></i> 滿額回饋</span><strong>滿$2,500送贈品</strong></p><p>【母親節感恩慶】app購物滿額送現金折回饋提袋</p>
                            </div>
                            <div class="col-md-6 col-sm-12 numberBOX5">
                                <a class="colorD" href="">再湊$3,000折$300 <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            </div>
                          </div>
                        <div class="row numberBOX8">
                          <p class="colorC">總金額 <span id="totalAmount">$<? echo number_format($summary);?></span></p>
                          <p class="colorD"">(滿$3,000折300)　　　<span>-$300</span></p>
                          <div class="numberHR"></div>
                          <p class="colorB">折扣後<span id="totalAmountB" class="numberB">$<? echo number_format($summary - 300);?></span></p>
                          <p>(不含運費)</p>
                        </div>
                    </div>
                    <div class="login-page">
                    <a href="product.php" class="col-md-6 col-sm-12"><input style="background-color: #e95959;" type="submit" value=" 繼續購物 "></a> <a id="goStep2" href="#"  class="col-md-6 col-sm-12"><input type="submit" value=" 下一步，填寫資料與運送方式 > "></a>
                    </div>
              </div>
        </div>
    </div>
<div id="DOWN">
    <div class="btn-group btn-group-justified">
      <ul>
        <li><a href="menu_mobile.php"><i class="fa fa-list" aria-hidden="true"></i> 商品分類</a></li>
        <li><a href="notes.php"><i class="fa fa-eye" aria-hidden="true"></i> 瀏覽記錄(5)</a></li>
        <li class="activityA"><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 購物車(1)</a></li>
      </ul>
    </div>
</div>
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
		
		$('#goStep2').click(function(e){
			e.preventDefault();
			var updateBasketObj = {};
			var pass = true;
			$('.basketItemRow').each(function(){
				var quantity = $(this).find('input[name=quantity]').val();
				var basketId = $(this).find('input[name=real_basket_id]').val();
				if(quantity == 0) {
					pass = false;
				}
				updateBasketObj[basketId] = quantity;
			});
			if(!pass) {
				alert('商品數量不可為0');
				return;
			}
			
			console.log(JSON.stringify(updateBasketObj));
			$.ajax({
				url: 'updateBasketItem.php', 
				type: 'POST',
				data: {
					updateBasketObj
				},
				success: function(updateStatus) {
					console.log(updateStatus);
					window.location.href = "shoppingcart_2.php";
				}, error: function(xhr) { 
					alert('系統異常。');
				} 
			});
		})
		
		$('.removeItem').click(function(event){
			event.preventDefault();
			var barCode = $(this).attr('targetId');
			alert(barCode);
			var customerId = $('#customerID').val();
			alert(customerId);
			var removeElement = $(this).closest('.tableMO');
			deleteBasketItem(removeElement, customerId, barCode);
		});
		
		$('.removeItem2').click(function(){
			var barCode = $(this).attr('targetId');
			alert(barCode);
			var customerId = $('#customerID').val();
			alert(customerId);
			var removeElement = $(this).closest('.basketItemRow');
			deleteBasketItem(removeElement, customerId, barCode);
		});
		
		function deleteBasketItem(removeElement, customerId, barCode) {
			$.ajax({
				url: 'deleteBasketItem.php', 
				type: 'POST',
				data: {
					CustomerID: customerId,
					BarCode: barCode
				},
				success: function(deleteRow) {
					if(Number(deleteRow) > 0) {
						$(removeElement).remove();
						$('#HEAD_'+barCode).remove();
						var totalRecordsStr = $('#totalRecords').text();
						var startIndext = totalRecordsStr.indexOf('(')+1;
						var endIndext = totalRecordsStr.indexOf(')');
						var totalRecords = Number(totalRecordsStr.substring(totalRecordsStr.indexOf('(')+1, totalRecordsStr.indexOf(')')));
						var newTotalRecordsStr = totalRecordsStr.replace('('+totalRecords+')','('+(totalRecords-1)+')');
						$('#totalRecords').text(newTotalRecordsStr);
					}
				}, error: function(xhr) { 
					alert('系統異常。');
				} 
			});
		}
		
    </script>
</body>
</html>