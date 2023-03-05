<!DOCTYPE html>
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
<?php include("_include/_head.php"); ?>
    <!-- 上方選單end -->
    <div id="CONTENT-2">
        <!-- 第一塊大的區塊 -->
        <div class="row">
            <!-- 左欄區塊 -->
            <div class="row leftBOX">
                <!-- 產品menu -->
                <?php include("_include/_productList.php"); ?>
                <!-- 折扣活動 -->
                <?php include("_include/_sale.php"); ?>
            </div>
            <!-- 右欄區塊 -->
            <div class="row rightBOX">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item">折扣活動</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 慶端午~全館消費滿1288現折88
                </div>
                <!-- 內容開始 -->
                <div class="row productDetail_BOX">
                    <img src="images/banner02.jpg" class="img-responsive">
                    <div class="discount_TOP">
                        <p><i class="fa fa-clock-o" aria-hidden="true"></i> 2017/05/27 11:00~2017/06/01 10:59</p>
                        <ul>
                            <li>全館消費時1288現折88(可累計)</li>
                            <li>COOLCORE Chill Sport涼感運動毛巾下殺339，數量有限售完為止。</li>
                        </ul>
                    </div>
                    <div class="discount_BUY"> 
                        <div class="title"><p>已選購<span style=""> 0 </span>件，原價<span> 0 </span>元，折扣價<span> 0 </span>元</p> <a href="shoppingcart.php"><button type="button" class="btn btn-success">前往結帳</button></a></div>
                        <div><!-- 已選購的商品輪播 -->
                            <div class="col-lg-12 col-xs-6 ex02">
                                <a href="product_detail.php">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex02">
                                <a href="product_detail.php">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex02">
                                <a href="product_detail.php">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex02">
                                <a href="product_detail.php">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                 <!-- 標題 -->
                <div class="discount_CL">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 折扣商品
                    <div class="FloatR"><i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-arrows-v" aria-hidden="true"></i> 分類：
                        <select class="custom-select">
                          <option selected>露影野趣</option>
                          <option value="1">露影野趣</option>
                          <option value="2">露影野趣</option>
                          <option value="3">露影野趣</option>
                          <option value="4">露影野趣</option>
                        </select>
                    </div>
                </div>

                    <div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-6 ex01">
                            <a href="product_detail.php">
                                <div class="g01">
                                    <div class="TEXTspan">
                                        <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                        <span>$890</span>
                                    </div>
                                    <img src="images/productIMG/product01.jpg" class="img-responsive">
                                </div>
                            </a>
                            <select class="custom-select W90">
                              <option selected>顏色/尺吋</option>
                              <option value="1">粉紅 / L號</option>
                              <option value="2">粉紅 / M號</option>
                              <option value="3">粉紅 / S號</option>
                            </select>
                            <div class="W90">
                                <select class="custom-select W50">
                                  <option selected>數量</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>   
                                <button type="button" class="btn btn-warning W45">搶購</button>                       
                            </div>
                        </div>
                    <div class="pageBOX">
                      <ul class="pagination">
                        <li><a href="#"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><span aria-hidden="true">&raquo;</span></a></li>
                        <li><a href="discount_list.php"><span aria-hidden="true">&raquo; 返回列表</span></a></li>
                      </ul>
                    </div>
                  </div>

                    </div>
                    <!-- 已選購 -->
                    <div class="discount_BUY"> 
                        <div class="title"><p>已選購<span style=""> 0 </span>件，原價<span> 0 </span>元，折扣價<span> 0 </span>元</p> <a href="shoppingcart.php"><button type="button" class="btn btn-success">前往結帳</button></a></div>
                        <div><!-- 已選購的商品輪播 -->
                            <div class="col-lg-12 col-xs-6 ex02">
                                <a href="product_detail.php">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex02">
                                <a href="product_detail.php">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex02">
                                <a href="product_detail.php">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex02">
                                <a href="product_detail.php">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php include("_include/_footer.php"); ?>
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