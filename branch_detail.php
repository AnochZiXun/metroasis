﻿<?php
include('_connMysql.php');


if (isset($_GET["branchId"])) {
	$branchId = $_GET["branchId"];
} 

$query = "SELECT * FROM Branch where BranchId = '$branchId'";
$RecBranches = mysql_query($query);
$row=mysql_fetch_assoc($RecBranches);

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
    <link rel="stylesheet" href="css/colorbox.css" />
    <script src="js/jquery.colorbox.js"></script>
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
			$(".branchPic").colorbox({rel:'branchPic', transition:"none"});
			//$(".img-responsive").colorbox({ iframe: true, width: "300px", height: "450px", overlayClose: true, escKey: true });
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
              <div class="branchBOX2">
                  <h2><? echo $row["BranchName"]; ?></h2>
                  <p><? echo $row["BranchAddress"]; ?></p>
                  <span>☎ <? echo $row["BranchPhoneNo"]; ?></span>
              </div>           
			  <div id="googlemaps" style="width:100%;height:300px"></div>
			  <div class="HTMLBOX">
                  <? echo $row["BranchDescription"]; ?>
              </div>
            <div style="text-align: center;">
              <ul class="pagination">
                <!--<li><a href="#"><span aria-hidden="true">&laquo; 上一則</span></a></li>-->
                <br>
                <li class="active"><a href="branch.php">回上頁</a></li>
                <!--<li><a href="#"><span aria-hidden="true">&raquo; 下一則</span></a></li>-->
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
	<script src="http://maps.google.com/maps/api/js?libraries=places&key=AIzaSyCjhW_jtMNMWXPp4Vx1mZkvvp_yZBIEKJc"></script>
    <script src="js/gmap/jquery.gmap.js"></script>
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
		
		var mapMarkers = [{
						address: "<? echo $row["BranchAddress"]; ?>",
						html: "<strong>城市綠洲</strong><br><? echo $row["BranchAddress"]; ?><br><br>",
						popup: false,
						icon: {
							image: "images/maker.png",
							iconsize: [28, 42],
							iconanchor: [28, 32]
						}
					}];
		
		// Map Initial Location
		var initLatitude = <? echo $row["Lat"]; ?>;
		var initLongitude = <? echo $row["Lng"]; ?>;

		// Map Extended Settings
		var mapSettings = {
			controls: {
				panControl: true,
				zoomControl: true,
				mapTypeControl: true,
				scaleControl: true,
				streetViewControl: true,
				overviewMapControl: true
			},
			scrollwheel: false,
			markers: mapMarkers,
			latitude: initLatitude,
			longitude: initLongitude,
			zoom: 15
		};

		var map = $("#googlemaps").gMap(mapSettings);

		// Map Center At
		var mapCenterAt = function(options, e) {
			e.preventDefault();
			$("#googlemaps").gMap("centerAt", options);
		}
    </script>
</body>
</html>