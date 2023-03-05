<?php
include('_connMysql.php');
//include('check_login.php');

$query_brand = 'SELECT * FROM Brand where 1=1';

if (isset($_GET["BrandID"])){ 
	$BrandID = $_GET["BrandID"];	
	$query_brand = $query_brand.' and BrandID = '.$BrandID;
}

$RecBrand = mysql_query($query_brand);
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
                  <li class="breadcrumb-item"><a href="brand_category.php">品牌一覽</a></li>
                  <li class="breadcrumb-item">GARMON</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> GARMON
                    <!--<div class="FloatR"><i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-arrows-v" aria-hidden="true"></i> 快速搜尋
                        <select class="custom-select">
                          <option selected>按字母排序</option>
                          <option value="1">A</option>
                          <option value="2">B</option>
                          <option value="3">C</option>
                          <option value="4">D</option>
                        </select>
                    </div>-->
                </div>
                <!-- 內容開始 -->
                <div class="branchBrief">
                    <? while($row=mysql_fetch_assoc($RecBrand)){ ?>
						<? echo $row["BrandDescription"]; ?>
					<? } ?>               
                </div>
                    <div style="margin:10px auto; text-align: center;">
                      <ul class="pagination">
						<?
							$BrandID = $_GET["BrandID"];
							$findBrandID = "select (select MAX(BrandID) from Brand where BrandID < $BrandID) as previousId, (select MIN(BrandID) from Brand where BrandID > $BrandID) as nextId from dual";
							$Rec = mysql_query($findBrandID);
							$Res = mysql_fetch_assoc($Rec);
						?>
						
						<? if (empty($Res["previousId"])) { ?>
							<li><a href="brand_brief.php?BrandID=<?echo $_GET["BrandID"]?>"><span aria-hidden="true">&laquo; 上一則</span></a></li>							
						<? } else { ?>
							<li><a href="brand_brief.php?BrandID=<? echo $Res["previousId"];?>"><span aria-hidden="true">&laquo; 上一則</span></a></li>
						<? } ?>
						
						<li class="active"><a href="brand_category.php">回列表</a></li>
						
						<? if (empty($Res["nextId"])) { ?>
							<li><a href="brand_brief.php?BrandID==<? echo $_GET["BrandID"];?>"><span aria-hidden="true">&raquo; 下一則</span></a></li>							
						<? } else { ?>
							<li><a href="brand_brief.php?BrandID=<? echo $Res["nextId"];?>"><span aria-hidden="true">&raquo; 下一則</span></a></li>
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
    </script>
</body>
</html>