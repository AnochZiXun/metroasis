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
        <img src="images/branchTITLE.jpg" class="img-responsive">
        <div class="branchBOXALL">
          <ul class="nav nav-tabs" style="background-color: #fff; margin: 0 auto 20px auto;">
            <li class="active"><a data-toggle="tab" href="#home">All</a></li>
            <li><a data-toggle="tab" href="#menu1">北區</a></li>
            <li><a data-toggle="tab" href="#menu2">桃竹苗區</a></li>
            <li><a data-toggle="tab" href="#menu3">中南區</a></li>
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>

            </div>
            <div id="menu1" class="tab-pane fade">
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            </div>
            <div id="menu2" class="tab-pane fade">
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            </div>
            <div id="menu3" class="tab-pane fade">
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
            <a href="branch_detail.php">
              <div class="col-lg-4 col-xs-12 branchBOX">
                  <img src="images/branch/01.jpg" class="img-responsive">
                  <h2>台北中山店</h2>
                  <p>台北市中山區中山北路一段21號1樓</p>
                  <span>02-25643702</span>
              </div>
            </a>
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