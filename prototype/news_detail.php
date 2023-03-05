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
                  <li class="breadcrumb-item"><a href="news.php">活動消息</a></li>
                  <li class="breadcrumb-item active">最新消息</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 最新消息
                    <div class="FloatR"><i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-arrows-v" aria-hidden="true"></i> 類別：
                        <select class="custom-select">
                          <option selected>露營野趣</option>
                          <option value="1">露營野趣</option>
                          <option value="2">露營野趣</option>
                          <option value="3">露營野趣</option>
                          <option value="4">露營野趣</option>
                        </select>
                    </div>
                </div>
                <!-- 內容開始 -->
                <div class="newsPageDetail">
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.9";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        <h1>十一月份露營活動即將開放報名
                        <span><i class="fa fa-calendar" aria-hidden="true"></i> 活動日期：2017-05-05</span>
                        </h1>
                        <div class="txtBox">
                            <p>露營初階班讓剛進入露營的營友，體驗簡單露營。 帳棚搭設、餐廚器材使用、休憩器材展示、兒童手作體驗。露營初階班讓剛進入露營的營友，體驗簡單露營。 帳棚搭設、餐廚器材使用、休憩器材展示、兒童手作體驗。</p>
                            <br><br>
                            <img src="images/news/01.jpg" class="img-responsive">
                        </div>
                    <div style="margin:10px auto; text-align: center;">
                      <ul class="pagination">
                        <li><a href="#"><span aria-hidden="true">&laquo; 上一則</span></a></li>
                        <li class="active"><a href="news.php">回列表</a></li>
                        <li><a href="#"><span aria-hidden="true">&raquo; 下一則</span></a></li>
                      </ul>
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