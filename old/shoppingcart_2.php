<?
    include('_connMysql.php');
    include('check_login.php');

    $customerID = $_SESSION["CustomerID"];
    
  $query_OrderBaskets = "SELECT OB.BasketID, OB.BarCode, OB.ProductID, OB.Quantity, OB.UnitPrice, 
                PB.Color, PB.ProductNo, PB.Size, 
                P.ProductName
                FROM `OrderBaskets` OB,`ProductBarCode` PB, `Products` P WHERE 1=1 
                AND OB.BarCode = PB.BarCode AND OB.ProductID = P.ProductID  
                AND OB.`CustomerID` = '$customerID'";
    $rec = mysql_query($query_OrderBaskets);
    $saleAmount = 0;
    while($rows=mysql_fetch_assoc($rec)){ 
      $saleAmount += $rows["UnitPrice"] * $rows["Quantity"];
    }
    mysql_data_seek($rec, 0);

    
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title>城市綠洲戶外生活館-單車、運動用品、露營、登山、潛水、健行、保暖</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/slides.css" rel="stylesheet">
    <!-- Bootstrap Dropdown Hover CSS -->
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap-dropdownhover.min.css" rel="stylesheet">  
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
	  <script type="text/javascript" src="js/crypto-js/crypto-js.js"></script>
	  <script type="text/javascript" src="js/convert-js/convert_bin_hex.js"></script>
    <!-- Bootstrap Dropdown Hover JS -->
    <script src="js/bootstrap-dropdownhover.min.js"></script> 
</head>
<body>
<?php include("_include/_head.php"); ?>
    <!-- 上方選單end -->
	<input type="hidden" name="customerID" value="<?echo $customerID;?>"/>
    <div id="CONTENT-2">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item active">購物車</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 購物車 / 填寫資料與運送方式
                </div>
        <!-- 第一塊大的區塊 -->
        <div class="row shoppingcartTOP">
            <div class="col"><div class="tobBOX colorB">1</div><p class="colorWb m40">確認訂購明細 <i class="fa fa-chevron-right" aria-hidden="true"></i> </p>
            </div>
            <div class="col"><div class="tobBOX colorA">2</div><p class="colorWa m40">填寫資料與運送方式 <i class="fa fa-chevron-right" aria-hidden="true"></i> </p>
            </div>
            <div class="col"><div class="tobBOX colorB">3</div><p class="colorWb m10">付款完成訂購</p>
            </div>
        </div>
        <div class="row" style="margin: 0 0 30px 0;">
            <div class="frameBOX">
                    <div class="row numberBOX8" style="text-align: center;">
						<input type="hidden" name="saleAmount" value="<? echo $saleAmount;?>"/>
                      <p>本次消費總金額  <span class="numberB colorB">$<? echo number_format($saleAmount);?></span></p>
                    </div>

                    <div align="center">
                    <a type="button" class="" data-toggle="collapse" data-target="#demo">總計<span class="colorB"><? echo mysql_num_rows($rec);?></span>項商品 <i class="fa fa-chevron-down" aria-hidden="true"></i></a></div>

                    <div id="demo" class="collapse" style="padding: 20px 0 0 0;">
                        <table class="table table-hover TABLE_BOX">
                           <tbody>
                            <tr class="secondary">
                              <th>圖片</th>
                              <th>商品名稱</th>
                              <th>規格/尺吋</th>
                              <th>數量</th>
                              <th>單價</th>
                              <th>小計</th>
                            </tr>
                            <?php 
                              while($rows=mysql_fetch_assoc($rec)){ 
                            ?>
                            <tr>
                              <?php 
                              $productID = $rows["ProductID"];
                              $rec_img = mysql_query("SELECT * FROM ImagesFiles WHERE ImageFunction = 'products' AND ImageType = 'detail' AND ForeignID = '$productID' ORDER BY ImageFileName LIMIT 1 ");
                              $row_img = mysql_fetch_assoc($rec_img);
                              ?>                                  
                              <th scope="row"><img src="<? echo $row_img["ImagePath"].$row_img["ImageFileName"]; ?>" class="img-responsive img50"></th>
                              <td class="colorA UB"><? echo $rows["ListProductName"]; ?></td>
                              <td><? echo $rows["Color"]."/".$rows["Size"]; ?>號</td>
                              <td>
                                  <select class="custom-select">
                                    <option selected><? echo $rows["Quantity"]?></option>
                                  </select>　
                              </td>
                              <td>$<? echo $rows["UnitPrice"]; ?></td>
                              <td>$<? echo $rows["UnitPrice"] * $rows["Quantity"]; ?></td>
                            </tr>
                            <? } ?>
                          </tbody>
                        </table>
                      <div class="TABLE_BOX_mobile">
                        <div class="tableMO">
                          <div class="tableMO_A">
                            <p><img src="images/productIMG/product01.jpg" class="img-responsive"></p>
                          </div>
                          <div class="tableMO_B">
                            <p class="colorA">女短袖圖勝透氣排汗造型衫</p>
                            <p>商品編號：AT718213</p>
                            <p>規格/尺吋：<span class="colorB">粉紅色/M號</span></p>
                            <p>數量：
                                <select class="custom-select">
                                  <option selected>- 1 -</option>
                                  <option value="1">- 2 -</option>
                                  <option value="2">- 3 -</option>
                                </select>　
                            </p>
                            <p>單價：<span class="colorC">$890</span></p>
                            <p>小計：<span class="colorD">$890</span></p>
                          </div>
                            <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 移除</button> 
                        </div>
                        <div class="tableMO">
                          <div class="tableMO_A">
                            <p><img src="images/productIMG/product01.jpg" class="img-responsive"></p>
                          </div>
                          <div class="tableMO_B">
                            <p class="colorA">女短袖圖勝透氣排汗造型衫</p>
                            <p>商品編號：AT718213</p>
                            <p>規格/尺吋：<span class="colorB">粉紅色/M號</span></p>
                            <p>數量：
                                <select class="custom-select">
                                  <option selected>- 1 -</option>
                                  <option value="1">- 2 -</option>
                                  <option value="2">- 3 -</option>
                                </select>　
                            </p>
                            <p>單價：<span class="colorC">$890</span></p>
                            <p>小計：<span class="colorD">$890</span></p>
                          </div>
                            <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 移除</button> 
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="registrationH2 numberBOX2">收件人資料</div>
                  <!-- TODO: 結帳流程3 -->
                  <form id="createOrderForm" action="createOrder.php" method="POST">
                  <div class="login-page">      
                      <div class="col-lg-12">
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">姓名 <i class="fa fa-star" aria-hidden="true"></i> </label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="receiverName" id="inputEmail3" placeholder="" required="required" />
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">手機 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <input type="number" class="form-control" name="receiverMobile" id="inputEmail3" placeholder="商品送達門市時會以簡訊通知取貨" required="required" />
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">市話  </label>
                          <div class="col-sm-8">
                            <input type="number" class="form-control" name="receiverLandline" id="inputEmail3" placeholder="" />
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">電子郵件 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputEmail3" name="receiverEMail" placeholder="商品送達門市時會以電子郵件通知取貨" required="required" />
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">送貨地址 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3" name="receiverAddress" placeholder="" required="required" />
                          </div>
                        </div>
                        <div class="form-box">
                          <label for="inputEmail3" class="col-sm-4 form-control-label">備註  </label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3" name="receiverMemo" placeholder="">
                          </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="registrationH3 numberBOX2">運送方式</div>
                        <div class="form-check" style="padding-left: 20px;">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="receiverWay"
                                   id="exampleRadios1" value="1" checked>
                            貨運宅配
                          </label>
                        </div>
                        <div class="form-check" style="padding-left: 20px;">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="receiverWay"
                                   id="exampleRadios3" value="2">
                            門市取貨
                            <?
                              $findStores = "SELECT * FROM RefCommon WHERE Type = 'ReceiverStore' ORDER BY TypeCode ASC";
                              $recStores = mysql_query($findStores);
                            ?>
                            <select class="custom-select" name="receiverStore">
                              <? while($store = mysql_fetch_assoc($recStores)){ ?>
                                  <option name="receiverStoreTypeCode" value="<? echo $store["TypeCode"] ?>"><?echo $store["CodeName"] ?></option>
                              <? } ?>
                            </select>
                          </label>
                        </div>
                        <div class="row numberBOX8">
                          <p class="colorC">總金額 <span>$<? echo number_format($saleAmount);?></span></p>
                          <p style="font-size: 16px;">(再湊$300免運)　　　<span style="font-size: 16px;">運費　　　+$100</span></p>
                          <div class="numberHR"></div>
                          <p class="colorD">(折扣)　　<span>-$600</span></p>
                          <p class="colorB">折扣後　<span class="numberB">$<? echo number_format($saleAmount + 100 - 600);?></span></p>
						  <input type="hidden" id="totalAmount" value="<? echo ($saleAmount + 100 - 600);?>">
						  <input type="hidden" name="saleAmount" value="<? echo $saleAmount;?>"/>
                          <p>(含運費)</p>
                        </div>
                    </div>
                    <div class="login-page">
                    <input type="hidden" name="action" value="add" />
                    <a href="product.php" class="col-md-6 col-sm-12"><input style="background-color: #e95959;" type="submit" value=" 繼續購物 "></a> <a id="pay2go" class="col-md-6 col-sm-12"><input type="submit" value=" 下一步，點我進入付款頁面 > "></a>
                    </div>
                </div>
                 </form>

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
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
</body>
</html>