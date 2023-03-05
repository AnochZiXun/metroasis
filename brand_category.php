<?php
include('_connMysql.php');
include('_include/_function.php');
//include('check_login.php');

$query_brand = "select B.*,(SELECT concat(ImagePath,ImageFileName) as ImageFile FROM ImagesFiles WHERE ImageFunction = 'brand' AND ImageType ='' AND ForeignID =B.BrandID LIMIT 1) AS ImageFile from Brand B where B.status = 1 ";

if (isset($_GET["Letter"])){ 
	$Letter = $_GET["Letter"];	
	$query_brand = $query_brand." and B.BrandName like '".$Letter."%'";
}
//echo $query_brand;
$query_brand = $query_brand." ORDER BY BrandName";
$RecBrand = mysql_query($query_brand);

$queryBrandNameByLetter = 'select DISTINCT substring(BrandName, 1, 1) as Letter from Brand where status = 1';
$Record = mysql_query($queryBrandNameByLetter);
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
            $('#CONTENT-3-Banner').flexslider({
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
            <img src="images/categoryTITLE.jpg" class="img-responsive">
            <!-- 右欄區塊 -->
            <div style="padding: 20px 0 0 0;">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item">經銷品牌</li>
                </ol>

                 <!-- 標題 -->
                <form action="" method="GET" enctype="multipart/form-data" id="startSearch" name="startSearch">
    				<div class="alert alert-info" role="alert">
                        <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 經銷品牌
    					<div class="FloatR"><i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-arrows-v" aria-hidden="true"></i> 快速搜尋：
                            <select class="custom-select" name="Letter" id="Letter" onChange="formSubmit()">
    						  <option value="" selected>全部</option>
                              <? while($Result=mysql_fetch_assoc($Record)){ ?>
    							<?if ($Result["Letter"] == $_GET["Letter"]) { ?>
    								<option value="<?echo $Result["Letter"]?>" selected><?echo $Result["Letter"]?></option>
    							<? } else {?>
    								<option value="<?echo $Result["Letter"]?>"><?echo $Result["Letter"]?></option>
    							<? } ?>
                              <? } ?>
                            </select>
                        </div>
                    </div>
				</form>

                <!-- 內容開始 -->
                <div class="brand_BOX" style="margin-bottom: 50px; height: auto;">
					<? while($row=mysql_fetch_assoc($RecBrand)){ ?>
                    <div class="col-xs-6 col-sm-2">
						<a href="brand_brief.php?BrandID=<?echo $row["BrandID"]?>">
							<img class="img-responsive" src="<? echo $row["ImageFile"];?>" title="<? echo $row["BrandName"]; ?>">
						</a>
					</div>
					<? } ?>
                </div>
            </div>
        <!-- /.row -->
        </div>
        <!-- 第二塊大的區塊 品牌代理 -->
        <div class="row">
            <div class="" style="margin: 20px 0 0 0px;">
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 品牌代理
                </div>
            </div>
            <div id="CONTENT-3-Banner" class="flexslider" style="margin: 0 0 20px 0;">
                <?php 
                    $query_Banners4 = "SELECT * FROM  `Banners` WHERE BannerType = '4' AND BannerImage <> '' ORDER BY `BannerSort`";
                    $recBanners4 = mysql_query($query_Banners4);
                ?>
                <div class="row">
                    <ul class="slides" style="padding: 0 20px; width: 90%;">
                    <?php while($row_Banners4=mysql_fetch_assoc($recBanners4)){ ?>
                        <li class="col-md-2 col-sm-6"><a href="#">
                            <a <?php if ($row_Banners4["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners4["BannerLink"]; ?>">
                                <img src="images/banners/banner4/<? echo $row_Banners4["BannerImage"]; ?>" class="img-responsive">
                            </a>
                        </li>
                    <? } ?>
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
		
		function formSubmit() {
			document.getElementById("startSearch").submit()
		}
    </script>
</body>
</html>