<?php
include('_connMysql.php');
if (isset($_GET["BrandID"])){ 
	$brandID = $_GET["BrandID"];	
	$query_brand = "SELECT *,  ";
	$query_brand .= "(SELECT concat(ImagePath,ImageFileName) as ImageFile FROM ImagesFiles WHERE ImageFunction = 'brand' AND ImageType ='' AND ForeignID ='$brandID' LIMIT 1) AS ImageFile1, ";
	$query_brand .= "(SELECT concat(ImagePath,ImageFileName) as ImageFile FROM ImagesFiles WHERE ImageFunction = 'brand' AND ImageType ='banner' AND ForeignID ='$brandID' LIMIT 1) AS ImageFile2 ";
	$query_brand .= "FROM Brand WHERE BrandID=".$brandID;
	//echo $query_brand;
	$RecBrand = mysql_query($query_brand);
}else{
	header('Location: brand_category.php');	
}
?>
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
            <!-- 右欄區塊 -->
            <div>
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item"><a href="brand_category.php">經銷品牌</a></li>
                  <? while($row=mysql_fetch_assoc($RecBrand)){ ?>
				  <li class="breadcrumb-item"><? echo strtoupper($row["BrandName"]); ?></li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
					<strong><i class="fa fa-bars" aria-hidden="true"></i></strong> <? echo $row["BrandName"]; ?>
                   <div  style="float: right;"> <a href="<?echo $row["BrandUrl"]?>" target="_blank" class="colorG">前往 <? echo strtoupper($row["BrandName"])?>官網</a> </div>               
                </div>
                <!-- 內容開始 -->
                <div class="row branchBrief">
                    <div class="imagesBOX" align="center">
                        <img src="<? echo $row["ImageFile2"]; ?>" class="img-responsive">
                    </div>
                    
                    <img src="<? echo $row["ImageFile1"]; ?>" class="img-responsive S" style="float: left; margin: 0 10px 0 0; border:1px #ccc solid;"><h1><? echo $row["BrandTitle"]; ?></h1><p style="line-height: 35px;"><? echo $row["BrandDescription"]; ?></p>
					<? } ?>               
                </div>
                <br>
                <br>
                <table cellpadding="0" cellspacing="0" width="100%" height="1">
                  <tr>
                    <td bgcolor="#e6e6e6">&nbsp;</td>
                  </tr>
                </table>
                <br>
                <br>
                    <!--商品一覽-->
                    <div class="updatNCC">
                        <div class="row">
                            <div class="dwt">
                                <ul>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product02.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product03.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product04.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product02.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="dwt">
                                <ul>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product02.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product03.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product04.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                    <li class="col-md-2 col-sm-6"><a href="#">
                                        <img src="images/productIMG/product02.jpg" class="img-responsive"></a>
                                        <p><a href="#">ADISI 女短袖圖騰排汗衫</a></p>
                                        <span class="span1">$4,660</span><span class="span2">$4,660</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center; margin-bottom: 30px;">
                      <ul class="pagination">
                        <li><a href="brand_category.php">回列表頁</a></li>
                        <li><a href="#"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><span aria-hidden="true">&raquo;</span></a></li>
                      </ul>
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