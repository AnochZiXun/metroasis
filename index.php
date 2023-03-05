﻿<?php
session_start();
include_once("_connMysql.php");
include_once("_include/_function.php");
$_SESSION["ProductCategory2ID"] = "";
$_SESSION["ProductCategory1ID"]="";
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
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/slides.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Dropdown Hover CSS -->
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap-dropdownhover.min.css" rel="stylesheet">
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
    <style>
        .span1{
            color: #d33f3f;
            font-size: 18px;
            font-weight: bold;
            line-height: 24px;
            float: right;
            position: relative;
            padding: 0px 10px 0px 0px;
        }
        .span2 {    
            color: #8f8f8f;
            font-size: 13px;
            line-height: 24px;
            float: right;
            position: relative;
            padding: 0px 2px 0px 0px;
            text-decoration: line-through;
        }
    </style>
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
			
			$('#CONTENT-2').flexslider({
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
    <!-- 上方選單 -->
	<?php include_once("_include/_head.php"); ?>
    <!-- banner輪播 (手機版&網頁) -->
	<?php include_once("_include/_banners.php"); ?>  
	<p style="height:8px"></p>
    <!-- 第一內容區-上方四個最新消息 -->
	<?php 
		$query_Banners2 = "SELECT * FROM  `Banners` WHERE BannerType = '2' AND BannerImage <> '' ORDER BY `BannerSort`";
		$recBanners2 = mysql_query($query_Banners2);
	?>
    <div id="CONTENT-1" class="flexslider">
        <div class="row">
            <ul class="slides">
                <?php while($row_Banners2=mysql_fetch_assoc($recBanners2)){ ?>
				<li class="col-md-3 col-sm-6">
					<div class="topproimg">
						<a <?php if ($row_Banners2["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners2["BannerLink"]; ?>">
							<img src="images/banners/banner2/<? echo $row_Banners2["BannerImage"]; ?>" class="img-responsive">
						</a>
					</div>
				</li>
				<? } ?>	  
            </ul>
        </div>
    </div>
    <p style="height:10px"></p>
    <div id="CONTENT-2">
        <!-- 第一塊大的區塊 -->
        <div class="row">
            <!-- 左欄區塊 商品分類-->
            <div class="row leftBOX">
            <?php include_once("_include/_productList.php"); ?>
            <?php include_once("_include/_sale.php"); ?>
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
						<?php 
							$query_News = "SELECT N.*,I.ImageFile ";
							$query_News .= "FROM News N LEFT JOIN (SELECT concat(ImagePath,ImageFileName) as ImageFile,ForeignID FROM ImagesFiles WHERE ImageFunction = 'news' AND ImageType ='detail') I ON N.newsId = I.ForeignID ";
							$query_News .= "WHERE N.State=1 AND (N.StartDate <= sysdate() AND  IFNULL(EndDate,STR_TO_DATE('9999/12/31', '%Y/%m/%d')) >= sysdate()) Order by N.CreateDate DESC LIMIT 0,3";
							//$query_News = "SELECT * FROM `News` WHERE State=1 AND StartDate <= sysdate() AND IFNULL(EndDate,STR_TO_DATE('9999/12/31', '%Y/%m/%d')) >= sysdate() Order by `CreateDate` DESC LIMIT 0,3";
							$rec_News = mysql_query($query_News);
						?>
                        <div id="home" class="tab-pane fade in active">
							<?php while($row_News=mysql_fetch_assoc($rec_News)){ ?>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <a href="news_detail.php?NewsId=<? echo $row_News["NewsID"]; ?>&Category=<? echo $row_News["Category"]; ?>"><img src="<? echo $row_News["ImageFile"]; ?>" class="img-responsive"></a>
                                <a href="news_detail.php?NewsId=<? echo $row_News["NewsID"]; ?>&Category=<? echo $row_News["Category"]; ?>"><h2><? echo $row_News["ShortTitle"]; ?></h2></a>
                                <p><? echo $row_News["ShortContent"]; ?></p>
                            </div>
							<? } ?>	 
                            <a href="news.php"><button type="button" class="btn btn-success btn-sm bottonRIGHT">more</button></a>
                        </div>
                        <div id="menu1" class="tab-pane fade">
							<?php 
								$query_Audio = "SELECT * FROM `Audio` WHERE State=1 AND StartDate <= sysdate() AND IFNULL(EndDate,STR_TO_DATE('9999/12/31', '%Y/%m/%d')) >= sysdate() Order by `IsTop` DESC ,`CreateDate` DESC LIMIT 0,3";
								$rec_Audio = mysql_query($query_Audio);
								while($row_Audio=mysql_fetch_assoc($rec_Audio)){							
							?>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                
                                    <!--<a href="video_detail.php?AudioID=<? echo $row_Audio["AudioID"]; ?>"><img src="images/audio/<? echo $row_Audio["AudioID"]; ?>/<? echo $row_Audio["Image"]; ?>" class="img-responsive"></a>-->
									<iframe width="100%" height="100%" src="<? echo $row_Audio["YoutubeUrl"]; ?>" frameborder="0" allowfullscreen></iframe>
                                
                                <a href="video_detail.php?AudioID=<? echo $row_Audio["AudioID"]; ?>"><h2><? echo $row_Audio["ShortTitle"]; ?></h2></a>
                                <p><? echo $row_Audio["ShortContent"]; ?></p>
                            </div>
							<? } ?>                            
                            <a href="video.php"><button type="button" class="btn btn-success btn-sm bottonRIGHT">more</button></a>
                        </div>
                        <div id="menu2" class="tab-pane fade">
							<?php 
								$query_Activityhighlight = "SELECT A.*,I.ImageFile FROM `Activityhighlight` A LEFT JOIN (SELECT concat(ImagePath,ImageFileName) as ImageFile,ForeignID FROM ImagesFiles WHERE ImageFunction = 'activityhighlight' AND ImageType ='detail') I ON A.ActivityhighlightID = I.ForeignID WHERE State=1 AND StartDate <= sysdate() AND IFNULL(EndDate,STR_TO_DATE('9999/12/31', '%Y/%m/%d')) >= sysdate() Order by `IsTop` DESC ,`CreateDate` DESC LIMIT 0,3";
								$rec_Activityhighlight = mysql_query($query_Activityhighlight);
								while($row_Activityhighlight=mysql_fetch_assoc($rec_Activityhighlight)){							
							?>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <a href="highlights_detail.php?ActivityhighlightID=<? echo $row_Activityhighlight["ActivityhighlightID"]; ?>"><img src="<? echo $row_Activityhighlight["ImageFile"]; ?>" class="img-responsive"></a>
                                <a href="highlights_detail.php?ActivityhighlightID=<? echo $row_Activityhighlight["ActivityhighlightID"]; ?>"><h2><? echo $row_Activityhighlight["ShortTitle"]; ?></h2></a>
                                <p><? echo $row_Activityhighlight["ShortContent"]; ?></p>
                            </div>
							<? } ?>                            
                            <a href="highlights.php"><button type="button" class="btn btn-success btn-sm bottonRIGHT">more</button></a>
                        </div>
                        <div id="menu3" class="tab-pane fade">
							<?php 
								$query_Knowledges = "SELECT K.*,I.ImageFile FROM `Knowledges` K LEFT JOIN (SELECT concat(ImagePath,ImageFileName) as ImageFile,ForeignID FROM ImagesFiles WHERE ImageFunction = 'knowledges' AND ImageType ='detail') I ON K.KnowledgesID = I.ForeignID WHERE State=1 AND StartDate <= sysdate() AND IFNULL(EndDate,STR_TO_DATE('9999/12/31', '%Y/%m/%d')) >= sysdate() Order by `IsTop` DESC ,`CreateDate` DESC LIMIT 0,3";
								$rec_Knowledges = mysql_query($query_Knowledges);
								while($row_Knowledges=mysql_fetch_assoc($rec_Knowledges)){							
							?>
                            <div class="col-md-4 col-sm-12 tabBOX">
                                <a href="knowledge_detail.php?KnowledgesID=<? echo $row_Knowledges["KnowledgesID"]; ?>"><img src="<? echo $row_Knowledges["ImageFile"]; ?>" class="img-responsive"></a>
                                <a href="knowledge_detail.php?KnowledgesID=<? echo $row_Knowledges["KnowledgesID"]; ?>"><h2><? echo $row_Knowledges["ShortTitle"]; ?></h2></a>
                                <p><? echo $row_Knowledges["ShortContent"]; ?></p>
                            </div>
							<? } ?>  
                            <a href="knowledge.php"><button type="button" class="btn btn-success btn-sm bottonRIGHT">more</button></a>
                        </div>
                    </div>
                </div>
                <!-- 廣告 -->
                <!-- 產品區塊 -->
                <div class="proBOX">
                    <ul class="nav nav-tabs">
						<?php 
								$query_promotionalActivity = "SELECT * FROM `PromotionalActivity` WHERE ValidFlag = '1'  Order by `Area`";
								$rec_promotionalActivity = mysql_query($query_promotionalActivity);								
								$area_arr=array();
                                $count_tab = 0;
								while($row_promotionalActivity=mysql_fetch_assoc($rec_promotionalActivity)){
                                    array_push($area_arr, $row_promotionalActivity["Area"]); 
                                    if($count_tab == 0){
                        ?>
                                        <li class="active"><a data-toggle="tab" href="#home2"><? echo $row_promotionalActivity["ActivityName"];?></a></li>
									<? }else{ ?>
                                        <li><a data-toggle="tab" href="#menu<? echo $count_tab ?>a"><? echo $row_promotionalActivity["ActivityName"]; ?></a></li>
						<?		} $count_tab += 1; } 
					    ?>
                    </ul>
                    <div class="tab-content">
                        <? for($bravo = 0 ; $bravo < count($area_arr) ; $bravo++){
                            if($bravo == 0){ ?>
                                <div id="home2" class="tab-pane fade in active container-fluid">
                        <?  }else{ ?>
                                <div id="menu<? echo $bravo ?>a" class="tab-pane fade container-fluid">
                        <?  }
                            for($i = 1 ; $i <= 8 ; $i++){
                                $query_v_Products = "SELECT ProductID, ProductName, ListPrice, ";
                                $query_v_Products .= " CONVERT(SUBSTRING(SortNo,2,3),UNSIGNED INTEGER) AS SortNo, ";
                                $query_v_Products .= "      (select `metroasis`.`ImagesFiles`.`ImagePath` from `metroasis`.`ImagesFiles` where ((`metroasis`.`ImagesFiles`.`ForeignID` = `p`.`ProductID`) and (`metroasis`.`ImagesFiles`.`ImageType` = 'detail') and (`metroasis`.`ImagesFiles`.`ImageFunction` = 'products')) limit 1) AS `ImagePath`, ";
                                $query_v_Products .= "      (select `metroasis`.`ImagesFiles`.`ImageFileName` from `metroasis`.`ImagesFiles` where ((`metroasis`.`ImagesFiles`.`ForeignID` = `p`.`ProductID`) and (`metroasis`.`ImagesFiles`.`ImageType` = 'detail') and (`metroasis`.`ImagesFiles`.`ImageFunction` = 'products')) limit 1) AS `ImageFileName` ";
                                $query_v_Products .= "FROM  Products p ";
                                $query_v_Products .= "WHERE SortNo IS NOT NULL AND LEFT(SortNo,1) = '$area_arr[$bravo]' Order by SortNo LIMIT 0,8";
                                $rec_v_Products = mysql_query($query_v_Products);
                                $isThisPlaceBeUsed = false;
                                while($row_v_Products=mysql_fetch_assoc($rec_v_Products)){
                                //echo $i."SortNo:".$row_v_Products["SortNo"];
                                    if(intval($row_v_Products["SortNo"]) == $i){
                                        $isThisPlaceBeUsed = true; ?>
                            <div class="col-lg-12 col-xs-6 ex01">
                                <a href="product_detail.php?ProductID=<? echo $row_v_Products["ProductID"]; ?>" title="<?echo $row_v_Products["ProductName"];?>">
                                    <div class="g01">
                                        <img src="<? echo $row_v_Products["ImagePath"].$row_v_Products["ImageFileName"]; ?>" class="img-responsive">
                                    </div>
                                    <p style="font-size: 15px; line-height: 30px; margin-top: 0px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><? echo $row_v_Products["ProductName"]; ?></p>
                                    <span class="span1">$<? echo  number_format($row_v_Products["ListPrice"]); ?></span><span class="span2">$<? echo number_format($row_v_Products["ListPrice"]); ?></span>
                                </a>
                            </div>
                            <? } } if(!$isThisPlaceBeUsed){ 
                                #TODO:空白格做得有點骯髒, 待以後優化
                                $rec_v_Products = mysql_query($query_v_Products);
                                while($row_v_Products=mysql_fetch_assoc($rec_v_Products)){
                                ?>
                                <div class="col-lg-12 col-xs-6 ex01" style="visibility: hidden">
                                        <div class="g01">
                                            <img src="<? echo $row_v_Products["ImagePath"].$row_v_Products["ImageFileName"]; ?>" class="img-responsive">
                                        </div>
                                        <p style="font-size: 18px; margin-top: 5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><? echo $row_v_Products["ListProductName"]; ?></p>
                                        <span class="span1">$<? echo  number_format($row_v_Products["ListPrice"]); ?></span><span class="span2">$<? echo number_format($row_v_Products["ListPrice"]); ?></span>
                                </div>
                                <? break; } ?>
                            <? } } ?>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="CONTENT-3">
        <!-- 第二塊大的區塊 品牌代理 -->
        <div id="CONTENT-3-Banner" class="flexslider">
            <div class="col-lg-12">
                <h2 class="page-header">
                    <span class="textshadow10">❖ 品牌代理</span>
                    <a href="brand_category.php"><button type="button" class="btn btn-success" style="margin-top:-5px; margin-left: 40px;">more</button></a>
                </h2>
            </div>
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
        <!-- /.row -->
        <!-- 第三塊大的區塊 購物商場 -->
        <div id="CONTENT-3-Banner2" class="flexslider">
            <div class="col-lg-12">
                <h2 class="page-header">
                    <span class="textshadow10">❖ 城市綠洲其他商城</span>
                </h2>
            </div>
			<?php 
				$query_Banners5 = "SELECT * FROM  `Banners` WHERE BannerType = '5' AND BannerImage <> '' ORDER BY `BannerSort`";
				$recBanners5 = mysql_query($query_Banners5);
			?>
            <div class="row">
                <ul class="slides" style="padding: 0 20px 130px 20px; width: 90%;">
				<?php while($row_Banners5=mysql_fetch_assoc($recBanners5)){ ?>
					 <li class="col-md-2 col-sm-6"><a href="#">
					 	<a <?php if ($row_Banners5["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners5["BannerLink"]; ?>">
							<img src="images/banners/banner5/<? echo $row_Banners5["BannerImage"]; ?>" class="img-responsive">
						</a>
					</li>
				<? } ?>    
                </ul>
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