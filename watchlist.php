<!DOCTYPE html>
<?php
	include_once("_connMysql.php");
	include_once("check_login.php");
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
    <!-- Bootstrap Dropdown Hover JS -->
    <script src="js/bootstrap-dropdownhover.min.js"></script>     
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
            <div class="row rightBOX">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item">會員中心</li>
                  <li class="breadcrumb-item active">收藏商品</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 收藏商品
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
                  <div class="TABLE_BOX">
                    <table class="table table-hover">
                      <thead class="thead-info">
                        <tr class="secondary">
                          <th>圖片</th>
                          <th>商品名稱</th>
                          <th>規格</th>
                          <th>尺寸</th>
                          <th>數量</th>
                          <th>單價</th>
                          <th>小計</th>
                          <th>移除</th>
                          <th>加入購物車</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row"><img src="images/productIMG/product01.jpg" class="img-responsive img50"></th>
                          <td class="colorA UB">女短袖圖勝透氣排汗造型衫<br><p class="colorF">商品編號：AT718213</p></td>
                          <td>粉紅色</td>
                          <td>M號</td>
                          <td>
                              <select class="custom-select">
                                <option selected>- 1 -</option>
                                <option value="1">- 2 -</option>
                                <option value="2">- 3 -</option>
                              </select>　
                          </td>
                          <td>$890</td>
                          <td>$890</td>
                          <td><a class="colorE" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row"><img src="images/productIMG/product02.jpg" class="img-responsive img50"></th>
                          <td class="colorA UB">女短袖圖勝透氣排汗造型衫<br><p class="colorF">商品編號：AT718213</p></td>
                          <td>粉紅色</td>
                          <td>M號</td>
                          <td>
                              <select class="custom-select">
                                <option selected>- 1 -</option>
                                <option value="1">- 2 -</option>
                                <option value="2">- 3 -</option>
                              </select>　
                          </td>
                          <td>$890</td>
                          <td>$890</td>
                          <td><a class="colorE" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row"><img src="images/productIMG/product03.jpg" class="img-responsive img50"></th>
                          <td class="colorA UB">女短袖圖勝透氣排汗造型衫<br><p class="colorF">商品編號：AT718213</p></td>
                          <td>粉紅色</td>
                          <td>M號</td>
                          <td>
                              <select class="custom-select">
                                <option selected>- 1 -</option>
                                <option value="1">- 2 -</option>
                                <option value="2">- 3 -</option>
                              </select>　
                          </td>
                          <td>$890</td>
                          <td>$890</td>
                          <td><a class="colorE" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="TABLE_BOX_mobile">
                      <div class="tableMO">
                        <div class="tableMO_A">
                          <p><img src="images/productIMG/product01.jpg" class="img-responsive"></p>
                        </div>
                        <div class="tableMO_B">
                          <p class="colorA">女短袖圖勝透氣排汗造型衫</p>
                          <p>商品編號：AT718213</p>
                          <p>規格/尺寸：<span class="colorB">粉紅色/M號</span></p>
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
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 加入購物車</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 移除</button> 
                      </div>                     
                      <div class="tableMO">
                        <div class="tableMO_A">
                          <p><img src="images/productIMG/product02.jpg" class="img-responsive"></p>
                        </div>
                        <div class="tableMO_B">
                          <p class="colorA">女短袖圖勝透氣排汗造型衫</p>
                          <p>商品編號：AT718213</p>
                          <p>規格/尺寸：<span class="colorB">粉紅色/M號</span></p>
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
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 加入購物車</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 移除</button> 
                      </div>                     
                      <div class="tableMO">
                        <div class="tableMO_A">
                          <p><img src="images/productIMG/product03.jpg" class="img-responsive"></p>
                        </div>
                        <div class="tableMO_B">
                          <p class="colorA">女短袖圖勝透氣排汗造型衫</p>
                          <p>商品編號：AT718213</p>
                          <p>規格/尺寸：<span class="colorB">粉紅色/M號</span></p>
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
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 加入購物車</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 移除</button> 
                      </div>                     
                      <div class="tableMO">
                        <div class="tableMO_A">
                          <p><img src="images/productIMG/product01.jpg" class="img-responsive"></p>
                        </div>
                        <div class="tableMO_B">
                          <p class="colorA">女短袖圖勝透氣排汗造型衫</p>
                          <p>商品編號：AT718213</p>
                          <p>規格/尺寸：<span class="colorB">粉紅色/M號</span></p>
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
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 加入購物車</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 移除</button> 
                      </div>                     
                      <div class="tableMO">
                        <div class="tableMO_A">
                          <p><img src="images/productIMG/product02.jpg" class="img-responsive"></p>
                        </div>
                        <div class="tableMO_B">
                          <p class="colorA">女短袖圖勝透氣排汗造型衫</p>
                          <p>商品編號：AT718213</p>
                          <p>規格/尺寸：<span class="colorB">粉紅色/M號</span></p>
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
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 加入購物車</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 移除</button> 
                      </div>                     
                      <div class="tableMO">
                        <div class="tableMO_A">
                          <p><img src="images/productIMG/product01.jpg" class="img-responsive"></p>
                        </div>
                        <div class="tableMO_B">
                          <p class="colorA">女短袖圖勝透氣排汗造型衫</p>
                          <p>商品編號：AT718213</p>
                          <p>規格/尺寸：<span class="colorB">粉紅色/M號</span></p>
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
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 加入購物車</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 移除</button> 
                      </div>                     
                  </div>
                  <div class="login-page"> 
                      <a href="index.php"><input type="submit" value=" 繼續購物 "></a>
                  </div>
                <h2 class="page-header">
                    <span class="textshadow10">你可能會喜歡</span>
                </h2>
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
                                <li class="col-md-2 col-sm-6">
                                    <a href="#"><img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                     <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                    <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                </li>
                            </ul>
                    </div>
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