<!DOCTYPE html>
<?
session_start();
include_once('_connMysql.php');
include_once('_include/_function.php');
if(isset($_GET["ProductID"])) {
	$productId = $_GET["ProductID"];
	keepBrowsingHistory($productId);	
}
if(isset($_GET["SortType"])) {
	$sortType = $_GET["SortType"];
} else {
	$sortType = '1';
}
$tableName = 'Products';
$query_products_sql = "SELECT Products.*, (select CategoryName from ProductCategory3 where id = Products.ProductCategoryID) as CategoryName FROM $tableName where ProductID = $productId";
$rec = mysql_query($query_products_sql);
$row = $rec ? mysql_fetch_assoc($rec) : NULL;
if(isset($_GET["ProductCategoryID"]) or isset($row["ProductCategoryID"])) {
	$productCategoryID = $_GET["ProductCategoryID"] ? $_GET["ProductCategoryID"] : $row["ProductCategoryID"];
	$productCategory3 = getCategory('ProductCategory3', $productCategoryID);
	$productCategory2 = getCategory('ProductCategory2', $productCategory3['ParentCategoryId']);
	$productCategory1 = getCategory('ProductCategory1', $productCategory2['ParentCategoryId']);
	$_SESSION["ProductCategory1ID"] = $productCategory1["id"];
	$_SESSION["ProductCategory2ID"] = $productCategory2["id"];
}
$productId = $row["ProductID"];
$query_products_barcode_sql = "SELECT * FROM ProductBarCode where ProductID = '$productId'";
$product_barcode_rec = mysql_query($query_products_barcode_sql);
$size_rec = array();
$color_rec = array();
while($barcode_row=mysql_fetch_assoc($product_barcode_rec)){
	if(!in_array($barcode_row["Size"], $size_rec)) {
		array_push($size_rec, $barcode_row["Size"]);
	}
	if(!in_array($barcode_row["Color"], $color_rec)) {
		array_push($color_rec, $barcode_row["Color"]);
	}
}

if (isset($_POST["action"]) && $_POST["action"] == "addBasket"){
    $productId = $_POST["ProductID"];
	if(!isset($_SESSION["CustomerID"])){
		header("Location: login.php");
	}else{
        $customerID = $_SESSION["CustomerID"];
        $quantity = $_POST["quantity"];
        $unitPrice = $_POST["UnitPrice"];
        $color = $_POST["Color"];
        $size = $_POST["Size"];
        $query_product_barcode_sql = "SELECT * FROM `ProductBarCode` WHERE 1 and `Color`='$color' and `Size`='$size' and `ProductID`='$productId'";
        $query_product_barcode_sql_result = mysql_query($query_product_barcode_sql);
        $query_product_barcode_sql_row = mysql_num_rows($query_product_barcode_sql_result);
        if($query_product_barcode_sql_row > 0 && intval($quantity) > 0) {
            $barcode_row = mysql_fetch_assoc($query_product_barcode_sql_result);  
            $barcode = $barcode_row['BarCode'];
            $query_basket_sql = "SELECT * FROM `OrderBaskets` WHERE 1 and `BarCode`='$barcode' and `CustomerID`='$customerID'";
            $query_basket_sql_result = mysql_query($query_basket_sql);
            $query_basket_sql_result_row = mysql_num_rows($query_basket_sql_result);
            if($query_basket_sql_result_row > 0) {
                // barcode 存在 basket，更新資料
                $query_basket_sql_row = mysql_fetch_assoc($query_basket_sql_result);
                echo $query_basket_sql."<br>";
                echo intval($quantity)."<br>";
                echo intval($query_basket_sql_row['Quantity'])."<br>";
                $quantity = intval($quantity) + intval($query_basket_sql_row['Quantity']);
                $update_order_basket_sql = "UPDATE `OrderBaskets` SET `Quantity`=$quantity WHERE 1 and `BarCode`='$barcode' and `CustomerID`='$customerID'";
                echo $update_order_basket_sql;
                mysql_query($update_order_basket_sql);
            } else {
                // barcode 不存在 basket，寫入資料
                $insert_order_basket_sql = "INSERT INTO `OrderBaskets` 
                (`BasketID`, `ProductID`, `UnitPrice`, `Quantity`, `CustomerID`, `BarCode`) 
                VALUES (NULL, '$productId', '$unitPrice', '$quantity', '$customerID', '$barcode')";
                echo $insert_order_basket_sql;
                mysql_query($insert_order_basket_sql);
            }
        }
        
        $location = "Location: product_detail.php?ProductID=$productId";
        if($productCategoryID) {
            $location = $location."&ProductCategoryID=$productCategoryID";
        }
        if($sortType) {
            $location = $location."&SortType=$sortType";
        }
        header($location);        
    }
	
}
function getCategory($tableName, $id) {
	$query_parent_sql = "select * from $tableName where id=$id order by CategorySort";
	$query_parent_sql_result = mysql_query($query_parent_sql);
	if($query_parent_sql_result) {
		$query_parent=mysql_fetch_assoc($query_parent_sql_result);   
		return $query_parent;		
	} else {
		return NULL;
	}
}
$query_products_CommonConfig_sql = "SELECT ";
$query_products_CommonConfig_sql .= "(SELECT `ConfigContent` FROM `RefCommonConfig` WHERE `ConfigName` = 'ProductSale') AS ProductSale,";
$query_products_CommonConfig_sql .= "(SELECT `ConfigContent` FROM `RefCommonConfig` WHERE `ConfigName` = 'ProductRefund') AS ProductRefund,";
$query_products_CommonConfig_sql .= "(SELECT `ConfigContent` FROM `RefCommonConfig` WHERE `ConfigName` = 'RepairService') AS RepairService,";
$query_products_CommonConfig_sql .= "(SELECT `ConfigContent` FROM `RefCommonConfig` WHERE `ConfigName` = 'Exclusion') AS Exclusion";
$CommonConfig_rec = mysql_query($query_products_CommonConfig_sql);
$CommonConfig_row = mysql_fetch_assoc($CommonConfig_rec);
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
    <script type="text/javascript">
        $(document).ready(function () { pageInitial(); });
        $(window).resize(function () { pageInitial(); });
        function pageLoad() {
            var isAsyncPostback = Sys.WebForms.PageRequestManager.getInstance().get_isInAsyncPostBack();
            if (isAsyncPostback) {
                $(document).ready(function () {
                    pageInitial();
                });
            }
        }
        function pageInitial() {
            $('#CONTENT-3-Banner3').flexslider({
                animation: "slide",
                slideshowSpeed: "4000",
                animationSpeed: "1000",
                itemWidth: 180,
                itemHeight: 180,
                itemMargin: 15,
                pauseOnHover: true,
                controlNav: false,
                directionNav: true,
                touch: true
            });
            $('.carousel').carousel({
                interval: 5000 //changes the speed
            })
        }
        
        $(document).ready(function(){
            $(".liColor").click(function(){
                var color = $(this).html();
                $.ajax({
                    type: "GET",
                    url: "service_queryForProductSize.php?action=queryForSize&ProductID=<? echo $row['ProductID'] ?>" + 
                            "&BarCode=<? echo $row['BarCode'] ?>" +
                            "&Color="+color,
                    dataType: "json",
                    success: function(data) {
                        $("#ulSize").html("");
                        $.each(data, function(i, item){
                            var liHtml = "<li targetId='Size' class='liSize'>" + item + "</li>";
                            $("#ulSize").append(liHtml);
                        });
                        $('.liSize').click(function(){
                            $(this).siblings().attr('style', '');
                            $(this).attr('style','outline:-webkit-focus-ring-color auto 5px;');
                            var $id = $('#'+$(this).attr('targetId'));
                            $id.val($(this).text());
                        });
                    },
                    error: function(jqXHR) {
                        //alert("發生錯誤: " + jqXHR.status);
                    }
                });
            });
        });
    </script>
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
			<?if($productId){?>
            <div class="row rightBOX">
                <!-- 路徑 (商品與商品分類改成一對多的關係後, 由行銷專區進入的product_detail, 無法顯示路徑, 因為無法得知商品分類) -->
                <?php if(isset($_GET["ProductCategoryID"])){ ?>
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item">商品分類</li>
                  <li class="breadcrumb-item"><?echo $productCategory1["CategoryName"]?></li>
                  <li class="breadcrumb-item"><?echo $productCategory2["CategoryName"]?></li>
                  <li class="breadcrumb-item"><a href="product.php<?echo '?ProductCategoryID='.$productCategoryID.'&SortType='.$sortType?>"><?echo $productCategory3["CategoryName"]?></a></li>
                  <li class="breadcrumb-item active"><?echo $row["ProductName"]?></li>
                </ol>
                <? } ?>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> <?echo $row["ProductName"]?>
                </div>
                <!-- 內容開始 -->
                <div class="row productDetail_BOX">
                    <div class="col-md-6 col-sm-12">
                        <script type="text/javascript">
                            $(window).load(function() {
                              // The slider being synced must be initialized first
                              $('#carousel').flexslider({
                                animation: "slide",
                                controlNav: false,
                                animationLoop: false,
                                slideshow: false,
                                itemWidth: 100,
                                itemMargin: 10,
                                asNavFor: '#slider'
                              });
                             
                              $('#slider').flexslider({
                                animation: "slide",
                                controlNav: false,
                                animationLoop: false,
                                slideshow: false,
                                sync: "#carousel"
                              });
                            });                        
                        </script>    
                        <?php 
							$query_ImagesFIles = "SELECT ImagePath , ImageFileName FROM `ImagesFiles` WHERE ForeignID = '" . $productId . "' AND ImageFunction = 'products' AND ImageType = 'detail'";
							$RecImages = mysql_query($query_ImagesFIles);
							$strLi = "";
							while($row_Images1=mysql_fetch_assoc($RecImages)){
                                $strLi = $strLi . "<li><img src='" .$row_Images1["ImagePath"] . $row_Images1["ImageFileName"] . "'></li>";
							}
						?>
                        <div class="productDetail_IMG">              
                            <!-- Place somewhere in the <body> of your page -->
                            <div id="slider" class="flexslider IMGBIG">
                              <ul class="slides productDetail_IMGBIG">
                                <? echo $strLi ?>
                              </ul>
                            </div>
                            <div id="carousel" class="flexslider productDetail_IMGSM">
                              <ul class="slides">
                                <? echo $strLi ?>
                              </ul>
                            </div>
                        </div>
                        <div class="productDetail_IMG_PS">
                            <p>本商品適用活動</p>
                            <div><p><span>滿額折扣</span>【母親節感恩慶】app購物滿額送現金折回饋</p></div>
                            <div><p><span>滿額回饋</span>【母親節感恩慶】app購物滿額送現金折回饋提袋</p></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12 productDetail_price">
    					<form action="product_detail.php" method="POST">
                            <p>售價: <span class="spanRED">$<?echo number_format($row["UnitPrice"])?></span></p>
                            <p>市價: <span class="through">$<?echo number_format($row["ListPrice"])?></p>
    						<input type="hidden" id="unitPrice" name="UnitPrice" value="<?echo $row["UnitPrice"]?>"/>
    						<input type="hidden" id="Color" name="Color" value=""/>
    						<input type="hidden" id="Size" name="Size" value=""/>
                            <p>顏色：</p>
                            <div class="proTEXTbox" >
                                <ul>
    								<? foreach($color_rec as $color){ ?>
                                    <li targetId="Color" class="liColor"><?echo $color?></li>
    								<?}?>
                                </ul>
                            </div>
                            <p>尺寸：</p>
                            <div class="proTEXTbox">
                                <ul id="ulSize">
    								<? foreach($size_rec as $size){ ?>
                                    <li targetId="Size"><?echo $size?></li>
    								<?}?>
                                </ul>
                            </div>
                            <p>數量：</p>
                        
                            <label for=""></label>
                            <input type='button' value='-' class='qtyminus' field='quantity' />
                            <input type='text' name='quantity' value='0' class='qty' />
                            <input type='button' value='+' class='qtyplus' field='quantity' />
                     
                            <div class="productDetail_BTN">
                                <button type="submit" class="btn-warning btn-lg btn-block buttonA">加入購物車</button>
    							<button type="submit" class="btn-danger btn-lg btn-block buttonB">立即結帳</button>
                                <!--<a href="shoppingcart.php"><button type="button" class="btn-danger btn-lg btn-block buttonB">立即結帳</button></a>-->
                            </div>
                            <input type="hidden" name="ProductID" value="<?echo $productId; ?>"/>
                            <input type="hidden" name="action" value="addBasket"/>
    					</form>		
                        <div class="productDetail_text">
                            <p>商品特色</p>
                            <div class="protitleBOXii">
                                <!--
                                <p>商品編號：<?echo $row["ProductID"]?></p>
                                <p>商品特色</p>
                                -->
                                <ul>
								<?$productFeather = $row["ProductFeather"];
								  $productFeatherList = split("\r\n", $productFeather);
								  foreach($productFeatherList as $feather){?>
                                    <li><?echo $feather;?></li>
								  <?}?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row productDetail_BOX" style="margin: 20px 0;">
                    <div class="col-12">
                        <h1>詳細說明</h1>
                        <?  if ($row["YoutubeUrl"] != ""){?>
                        <div align="center">
                        	<br />
                        	<? echo $row["YoutubeUrl"] ?>
                        	<br />
                       	</div>	
                    	<?}?>
                        
                        <div align="center"><?echo $row["ProductDescription"]?></div>
                    </div>
                    <div class="col-12">
                        <h1>購物需知</h1>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"> <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <span><i class="fa fa-angle-right" aria-hidden="true"></i></span> 商品銷售
                                    </h4>
                                  </div></a>
                                  <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                     <ul>
										<? echo $CommonConfig_row["ProductSale"];?>
                                     </ul>   
                                     </div>
                                  </div>
                                </div>
                                <div class="panel panel-default">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><div class="panel-heading">
                                    <h4 class="panel-title">
                                      <span><i class="fa fa-angle-right" aria-hidden="true"></i></span> 商品退換
                                    </h4>
                                  </div></a>
                                  <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <ul>
									 	<? echo $CommonConfig_row["ProductRefund"];?>
                                     </ul>                                        
                                    </div>
                                  </div>
                                </div>
                                <div class="panel panel-default">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><div class="panel-heading">
                                    <h4 class="panel-title">
                                      <span><i class="fa fa-angle-right" aria-hidden="true"></i></span> 送修服務
                                    </h4>
                                  </div></a>
                                  <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <ul>
									 	<? echo $CommonConfig_row["RepairService"];?>
                                     </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="panel panel-default">
                                   <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><div class="panel-heading">
                                    <h4 class="panel-title">
                                     <span><i class="fa fa-angle-right" aria-hidden="true"></i></span> 除外責任
                                    </h4>
                                  </div></a>
                                  <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>以下內容均不在保固範圍內，本公司及原供應商得酌收費用或不予受理。 </p>
                                     <ul>
									 	<? echo $CommonConfig_row["Exclusion"];?>
                                     </ul>
                                    </div>
                                  </div>
                                </div>
                              </div> 
                    </div>
                    <div class="col-12">
                    <h1>相關商品</h1>
                    <div id="CONTENT-3-Banner3" class="flexslider dwt">
                            <ul class="slides flexslider_boxDD" style="padding: 50px 20px 120px 20px; width: 90%;">
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                            </ul>
                    </div>
                    </div>
                    <a href="product.php<?echo '?ProductCategoryID='.$productCategoryID.'&SortType='.$sortType?>"><div class="buttonC"><i class="fa fa-list-ul" aria-hidden="true"></i> 返回列表頁</div></a>
                </div>
            </div>
			<?}?>
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
            $('.proTEXTbox li').click(function(){
				$(this).siblings().attr('style', '');
				$(this).attr('style','outline:-webkit-focus-ring-color auto 5px;');
				var $id = $('#'+$(this).attr('targetId'));
				$id.val($(this).text());
			});
			
			
			
        });
    </script>
</body>
</html>