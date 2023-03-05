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
                  <li class="breadcrumb-item"><a href="#">會員專區</a></li>
                  <li class="breadcrumb-item active">註冊</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 會員註冊成功
                    <div class="FloatR"><i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-arrows-v" aria-hidden="true"></i> 會員中心：
                        <select class="custom-select">
                          <option selected>修改資料</option>
                          <option value="1">訂單查詢</option>
                          <option value="2">我的收藏</option>
                          <option value="3">紅利績點</option>
                          <option value="4">我的報名</option>
                        </select>
                    </div>
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
                  <div class="alert alert-success" role="alert" >
                      <p><strong>【隱私權聲明】</strong>親愛的客戶，您個人的隱私權，城市綠洲股份有限公司絕對尊重並予以保護。 </p>
                  </div>  
                    <div class="login-page">
                    <h1 style="font-size: 30px;"><i class="fa fa-user" aria-hidden="true"></i> 恭喜您正式成為城市綠州會員</h1>
                    <hr>
                    <p style="line-height: 30px;">本服務之目的為提供資訊，非供交易或投資之目的。經由本服務或於本服務網站所得瀏覽之任何廣告內容、文字與圖片之說明、展示樣品或其他銷售資訊以及金融相關服務，均由各廣告主、產品與服務的供應商以及金融服務機構負完全之責任。您應對任何廣告內容以及金融相關服務之真實性以及可信度自行斟酌判斷，且應注意經由本服務傳送任何資訊之正確性與適用性，城市綠洲對任何廣告或金融相關服務均不承擔任何責任。基於任何廣告或金融相關服務之任何交易或投資決定，城市綠洲亦不予負責。 </p>
                    <p style="line-height: 30px;">本服務提供資料查詢之服務，旨在便利您迅速獲取相關資訊及文件。您可能會因此連結至其他業者經營的網站或其他資訊服務，但不表示城市綠洲或本服務與該等業者有任何關係。其他業者經營的網站均由各該業者自行負責，不屬城市綠洲或本服務控制及負責範圍之內。本服務對檢索結果不擔保其合法性、合適性、可依賴性、即時性、有效性、正確性及完整性。您也許會檢索到一些令您厭惡或不需要的網站，這是電腦運作的可能結果，遇到此類情形時，本服務建議您不要瀏覽或儘速離開該等網站。 </p>
                    <a href="index.php"><input type="submit" value=" 回首頁購物 "></a>
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