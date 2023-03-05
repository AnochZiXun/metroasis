<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title>城市綠洲戶外生活館-單車、運動用品、露營、登山、潛水、健行、保暖</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">   
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
			$('#BANNER_Mobile').flexslider({
                animation: "slide",
                slideshowSpeed: "4000",
                animationSpeed: "1000",
                itemWidth: 400,
				itemHeight:400,
                itemMargin: 1,
                pauseOnHover: true,
                controlNav: false,
                directionNav: true,
                touch: true
            });
			
            $('#CONTENT-1').flexslider({
                animation: "slide",
                slideshowSpeed: "4000",
                animationSpeed: "1000",
                itemWidth: 350,
                itemMargin: 5,
                pauseOnHover: true,
                controlNav: false,
                directionNav: true,
                touch: true
            });

            $('#CONTENT-3-Banner').flexslider({ 
                animation: "slide", 
                slideshowSpeed: "4000", 
                animationSpeed: "1000", 
                itemWidth: 220, 
                itemHeight:340, 
                itemMargin: 12, 
                pauseOnHover: true, 
                controlNav: false, 
                directionNav: true, 
                touch: true, 
                start: function(slider){ 
                 $('#CONTENT-3-Banner .flex-nav-prev').css({'padding-top':'60px'}); 
                 $('#CONTENT-3-Banner .flex-nav-next').css({'padding-top':'60px'}); 
                } 
            });
			$('#CONTENT-3-Banner2').flexslider({
                animation: "slide",
                slideshowSpeed: "4000",
                animationSpeed: "1000",
                itemWidth: 245,
				itemHeight: 85,
                itemMargin: 6,
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
    <!-- 手機版形象banner輪播 -->
    <div id="BANNER_Mobile" class="flexslider">
        <div id="slides">
			<ul class="slides">
            <li><img src="images/banner01s.jpg" class="img-responsive"></li>
            <li><img src="images/banner02s.jpg" class="img-responsive"></li>
            <li><img src="images/banner03s.jpg" class="img-responsive"></li>
			</ul>
        </div>
    </div>
    <!-- 形象banner輪播 -->
    <div id="BANNER">
        <header id="myCarousel" class="carousel slide">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill"><img src="images/banner01.jpg" class="img"></div>
            </div>
            <div class="item">
                <div class="fill"><img src="images/banner02.jpg" class="img"></div>
            </div>
            <div class="item">
                <div class="fill"><img src="images/banner03.jpg" class="img"></div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"><img src="images/arr_left.png"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"><img src="images/arr_right.png"></span>
        </a>
    </header>
    </div>
    <!-- 第一內容區-上方四個最新消息 -->
    <div id="CONTENT-1" class="flexslider">
        <div class="row">
            <ul class="slides">
                <li class="col-md-3 col-sm-6">
                    <div class="topproimg">
                        <a href=""><img src="images/topproimg01.jpg" class="img-responsive"></a></div>
                </li>
                <li class="col-md-3 col-sm-6">
                    <div class="topproimg">
                        <a href=""><img src="images/topproimg02.jpg" class="img-responsive"></a></div>
                </li>
                <li class="col-md-3 col-sm-6">
                    <div class="topproimg">
                        <a href=""><img src="images/topproimg03.jpg" class="img-responsive"></a></div>
                </li>
                <li class="col-md-3 col-sm-6">
                    <div class="topproimg">
                        <a href=""><img src="images/topproimg04.jpg" class="img-responsive"></a></div>
                </li>
                <li class="col-md-3 col-sm-6">
                    <div class="topproimg">
                        <a href=""><img src="images/topproimg01.jpg" class="img-responsive"></a></div>
                </li>
                <li class="col-md-3 col-sm-6">
                    <div class="topproimg">
                        <a href=""><img src="images/topproimg02.jpg" class="img-responsive"></a></div>
                </li>
                <li class="col-md-3 col-sm-6">
                    <div class="topproimg">
                        <a href=""><img src="images/topproimg03.jpg" class="img-responsive"></a></div>
                </li>
                <li class="col-md-3 col-sm-6">
                    <div class="topproimg">
                        <a href=""><img src="images/topproimg04.jpg" class="img-responsive"></a></div>
                </li>
            </ul>
        </div>
    </div>
    <div id="CONTENT-2">
        <!-- 第一塊大的區塊 -->
        <div class="row">
            <!-- 左欄區塊 商品分類-->
            <div class="row leftBOX">
            <?php include("_include/_productList.php"); ?>
            <?php include("_include/_sale.php"); ?>
            </div>
            <!-- 右欄區塊 -->
            <div class="row rightBOX">
                <!-- 活動消息 -->
                <div class="newsBOX">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">最新消息</a></li>
                        <li><a data-toggle="tab" href="#menu1">影音專區</a></li>
                        <li><a data-toggle="tab" href="#menu2">活動花絮</a></li>
                        <li><a data-toggle="tab" href="#menu3">知識分享</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div><a href=""><img src="images/500px_IMG/01.jpg" class="img-responsive"></a></div>
                                <h2>Adisi登山包介紹</h2>
                                <p>Adisi登山包介紹Adisi登山包介紹Adisi登山包介紹AAdisiAAdi....</p>
                            </div>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div><a href=""><img src="images/500px_IMG/01.jpg" class="img-responsive"></a></div>
                                <h2>Adisi登山包介紹</h2>
                                <p>Adisi登山包介紹Adisi登山包介紹Adisi登山包介紹AAdisi登山包介紹AAdi....</p>
                            </div>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div><a href=""><img src="images/500px_IMG/01.jpg" class="img-responsive"></a></div>
                                <h2>Adisi登山包介紹</h2>
                                <p>Adisi登山包介紹Adisi登山包介紹Adisi登山包介紹AAdisi登山包介紹AAdi....</p>
                            </div>
                            <a href="news.php"><button type="button" class="btn btn-success btn-sm bottonRIGHT">more</button></a>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div>
                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/cmQf9Y85tVs"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                                <h2>浩克客廳帳</h2>
                                <p>
                                    浩克客廳帳浩克客廳帳浩克客廳帳浩克客廳帳浩克客廳帳...</p>
                            </div>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div>
                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/xn0ev3rDeYM"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                                <h2>浩克客廳帳</h2>
                                <p>浩克客廳帳浩克客廳帳浩克客廳帳浩克客廳帳浩克客廳帳...</p>
                            </div>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div>
                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/qb-4lvSj_Yk"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                                <h2>2016年1919愛走動</h2>
                                <p>浩克客廳帳浩克客廳帳浩克客廳帳浩克客廳帳浩克客廳帳...</p>
                            </div>
                            <a href="video.php"><button type="button" class="btn btn-success btn-sm bottonRIGHT">
                                more</button></a>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div><a href=""><img src="images/500px_IMG/03.jpg" class="img-responsive"></a></div>
                                <h2>2016年1919愛走動</h2>
                                <p>2016年1919愛走動 2016年1919愛走動 2016年1919愛走動....</p>
                            </div>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div><a href=""><img src="images/500px_IMG/03.jpg" class="img-responsive"></a></div>
                                <h2>2016年1919愛走動</h2>
                                <p>2016年1919愛走動 2016年1919愛走動 2016年1919愛走動....</p>
                            </div>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div><a href=""><img src="images/500px_IMG/03.jpg" class="img-responsive"></a></div>
                                <h2>2016年1919愛走動</h2>
                                <p>2016年1919愛走動 2016年1919愛走動 2016年1919愛走動....</p>
                            </div>
                            <a href="highlights.php"><button type="button" class="btn btn-success btn-sm bottonRIGHT">more</button></a>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div><a href=""><img src="images/500px_IMG/04.jpg" class="img-responsive"></a></div>
                                <h2>瘋啤酒越野賽</h2>
                                <p>2016年1919愛走動 2016年1919愛走動 2016年1919愛走動....</p>
                            </div>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div><a href=""><img src="images/500px_IMG/04.jpg" class="img-responsive"></a></div>
                                <h2>瘋啤酒越野賽</h2>
                                <p>2016年1919愛走動 2016年1919愛走動 2016年1919愛走動....</p>
                            </div>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <div><a href=""><img src="images/500px_IMG/04.jpg" class="img-responsive"></a></div>
                                <h2>瘋啤酒越野賽</h2>
                                <p>2016年1919愛走動 2016年1919愛走動 2016年1919愛走動....</p>
                            </div>
                            <a href="knowledge.php"><button type="button" class="btn btn-success btn-sm bottonRIGHT">more</button></a>
                        </div>
                    </div>
                </div>
                <!-- 廣告 -->
                <div class="adBOX" align="center">Banner(可視左欄高度做 新增 或 隱藏 調整)</div>
                <!-- 產品區塊 -->
                <div class="proBOX">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home2">露營野趣</a></li>
                        <li><a data-toggle="tab" href="#menu1a">登山健行</a></li>
                        <li><a data-toggle="tab" href="#menu2a">機能服飾</a></li>
                        <li><a data-toggle="tab" href="#menu3a">戶外單車</a></li>
                        <li><a data-toggle="tab" href="#menu4a">運動健身</a></li>
                        <li><a data-toggle="tab" href="#menu5a">水類浮潛</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="home2" class="tab-pane fade in active container-fluid">
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product01.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div id="menu1a" class="tab-pane fade container-fluid">
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product02.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product02.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product02.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product02.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product02.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product02.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product02.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product02.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div id="menu2a" class="tab-pane fade container-fluid">
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product03.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product03.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product03.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product03.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product03.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product03.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product03.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product03.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div id="menu3a" class="tab-pane fade container-fluid">
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product04.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product04.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product04.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product04.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product04.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product04.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product04.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product04.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div id="menu4a" class="tab-pane fade container-fluid">
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product05.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product05.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product05.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product05.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product05.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product05.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product05.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product05.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div id="menu5a" class="tab-pane fade container-fluid">
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product06.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product06.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product06.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product06.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product06.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product06.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product06.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="#">
                                    <div class="g01">
                                        <div class="TEXTspan">
                                            <p>
                                                ADISI 女短袖圖騰透氣排汗造型衫</p>
                                            <span>$890</span>
                                        </div>
                                        <img src="images/productIMG/product06.jpg" class="img-responsive">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="CONTENT-3">
        <!-- 第二塊大的區塊 代理品牌 -->
        <div id="CONTENT-3-Banner" class="flexslider">
            <div class="col-lg-12">
                <h2 class="page-header">
                    <span class="textshadow10">品牌代理</span>
                    <a href="brand_category.php"><button type="button" class="btn btn-success">
                        more</button></a></h2>
            </div>
            <div class="row">
                <ul class="slides" style="padding: 0 20px; width: 90%;">
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/Brand_logo/logo01.jpg" class="img-responsive"></a></li>
                </ul>
            </div>
        </div>
        <!-- /.row -->
        <!-- 第三塊大的區塊 購物商場 -->
        <div id="CONTENT-3-Banner2" class="flexslider">
            <div class="col-lg-12">
                <h2 class="page-header">
                    <span class="textshadow10">其他購物商城</span>
                </h2>
            </div>
            <div class="row">
                <ul class="slides" style="padding: 0 20px 130px 20px; width: 90%;">
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo02.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo03.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo04.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo05.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo06.jpg" class="img-responsive"></a></li>
					<li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo01.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo02.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo03.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo04.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo05.jpg" class="img-responsive"></a></li>
                    <li class="col-md-2 col-sm-6"><a href="#">
                        <img src="images/storeLOGO/logo06.jpg" class="img-responsive"></a></li>	
                </ul>
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