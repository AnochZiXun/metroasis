﻿<?php
include('_connMysql.php');
//include('check_login.php');

$query_knowledges = 'SELECT * FROM Knowledges where 1=1';

if (isset($_GET["KnowledgesID"])){ 
	$KnowledgesID = $_GET["KnowledgesID"];	
	$query_knowledges = $query_knowledges.' and KnowledgesID = '.$KnowledgesID;
	
	
	$RecViews = mysql_query("select ReadCount from Knowledges where KnowledgesID = $KnowledgesID");
	$ResViews = mysql_fetch_assoc($RecViews);
	$ori_views = (int)$ResViews["ReadCount"];
	$views = $ori_views+1;
	
	$updateViews = "update Knowledges set ReadCount = $views where KnowledgesID = $KnowledgesID";
	mysql_query($updateViews);
}

$RecKnowledges = mysql_query($query_knowledges);
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
                  <li class="breadcrumb-item"><a href="knowledge.php?page=1&Category=1">活動消息</a></li>
                  <li class="breadcrumb-item active">知識分享</li>
                </ol>
                <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 知識分享
                    <div class="FloatR"><i class="fa fa-leaf" aria-hidden="true"></i> 類型：
                        <?
							$findCategory = "SELECT * FROM RefCommon WHERE Type = 'knowledges'";
							$recCategory = mysql_query($findCategory);
						?>
						<select class="custom-select" name="Category" id="Category" disabled>
                          <? while($rowCategory = mysql_fetch_assoc($recCategory)){ ?>
							<?if ($rowCategory["TypeCode"] == $_GET["Category"]) { ?>
								<option value="<? echo $rowCategory["TypeCode"] ?>" id="<? echo $rowCategory["TypeCode"] ?>" selected><?echo $rowCategory["CodeName"] ?></option>
							<? } ?>
						  <? } ?>
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
						<? while($row=mysql_fetch_assoc($RecKnowledges)){ ?>
						<h1><? echo $row["Title"]; ?>
                        <span> <i class="fa fa-eye" aria-hidden="true"></i> <? echo $row["ReadCount"];?> Views</span>
                        </h1>
                        <div class="txtBox">
                            <p><? echo $row["Content"]; ?></p>
                        </div>
						<? } ?>	
						
						<div style="margin:10px auto; text-align: center;">
							<ul class="pagination">
							<?
								$knowledgesID = $_GET["KnowledgesID"];
								$findKnowledgesID = "select (select MAX(KnowledgesID) from Knowledges where KnowledgesID < $knowledgesID) as previousId, (select MIN(KnowledgesID) from Knowledges where KnowledgesID > $knowledgesID) as nextId from dual";
								$Rec = mysql_query($findKnowledgesID);
								$Res = mysql_fetch_assoc($Rec);
							?>
							
							<? if (empty($Res["previousId"])) { ?>
								<li><a href="knowledge_detail.php?KnowledgesID=<? echo $_GET["KnowledgesID"];?>&Category=<? echo $_GET["Category"];?>"><span aria-hidden="true">&laquo; 上一則</span></a></li>							
							<? } else { ?>
								<li><a href="knowledge_detail.php?KnowledgesID=<? echo $Res["previousId"];?>&Category=<? echo $_GET["Category"];?>"><span aria-hidden="true">&laquo; 上一則</span></a></li>
							<? } ?>
							
							<li class="active"><a href="knowledge.php?page=1&Category=1">回知識分享</a></li>
							
							<? if (empty($Res["nextId"])) { ?>
								<li><a href="knowledge_detail.php?KnowledgesID=<? echo $_GET["KnowledgesID"];?>&Category=<? echo $_GET["Category"];?>"><span aria-hidden="true">&raquo; 下一則</span></a></li>							
							<? } else { ?>
								<li><a href="knowledge_detail.php?KnowledgesID=<? echo $Res["nextId"];?>&Category=<? echo $_GET["Category"];?>"><span aria-hidden="true">&raquo; 下一則</span></a></li>
							<? } ?>
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