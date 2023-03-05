<?php 	
	include('_connMysql.php');
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
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/style_forBS.css" rel="stylesheet"><!--bootstrap-->
    <link href="css/style_forDIY.css" rel="stylesheet"><!--bootstrap-->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/accordion.js"></script> 
<script type="text/javascript">
$(function(){
   $(".nav").accordion({
        //accordion: true,
        speed: 500,
	    closedSign: '<i class="fa fa-chevron-down" aria-hidden="true"></i>',
		openedSign: '<i class="fa fa-chevron-up" aria-hidden="true"></i>'
	});
}); 
</script>
<style>
.demo{width:100%;}
ul{list-style:none}
.nav {width: 100%;} 
ul.nav {padding: 0; margin: 0; font-size: 1em; line-height: 0.5em; list-style: none;} 
ul.nav li {
      padding: 0;
      border-bottom: solid 1px #c5c5c5;
      background-color: #fff;
} 
ul.nav li a {line-height: 30px; font-size: 16px; padding: 10px 5px; color: #6aad4f; display: block; text-decoration: none; font-weight: bolder;border-left: 3px #6aad4f solid;}
ul.nav li a:hover {background-color:#6aad4f;    color:white;}
ul.nav ul { margin: 0; padding: 0;display: none;} 
ul.nav ul li { margin: 0; padding: 0; clear: both; background-color:#eee; border-bottom: solid 1px #d6d6d6;} 
ul.nav ul li a { padding-left: 20px; font-size: 14px; font-weight: normal; color: #000;}
ul.nav ul li a:hover {background-color:#52903a; color:#fff;} 
ul.nav ul ul li {background-color:#fff;margin: 0; padding: 0; clear: both;} 
ul.nav ul ul li a {color:#000; padding-left: 30px; font-size: 12px;} 
ul.nav ul ul li a:hover { background-color:#7aa469; color:#000;} 
ul.nav span{float:right;}
</style>
</head>

<body>
<div style="padding: 0px 10px; text-align: center; font-size: 1.2em; display: block; background-color: #23471b; height: 50px; line-height: 50px;">
    <a href="index.php" style="color: #fff;"><i class="fa fa-list" aria-hidden="true"></i> 商品分類 <i class="fa fa-times" aria-hidden="true"></i></a>
  </div>
<?php 
	$query_ProductCategory1 = "SELECT * FROM  `ProductCategory1` ORDER BY `CategorySort`";
	$recProductCategory1 = mysql_query($query_ProductCategory1);
?> 
<div class="demo">
	<ul class="nav">
	  <?php while($row_ProductCategory1=mysql_fetch_assoc($recProductCategory1)){ ?>
         <li><a href="#"><? echo $row_ProductCategory1["CategoryName"]; ?></a>
              <ul>
				  <?php 					
				    $query_ProductCategory2 = "SELECT * FROM  `ProductCategory2` WHERE ParentCategoryId = ".$row_ProductCategory1["id"]." ORDER BY `CategorySort`";					
				    $recProductCategory2 = mysql_query($query_ProductCategory2);
				    while($row_ProductCategory2=mysql_fetch_assoc($recProductCategory2)){						
				  ?> 	
                  <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i><? echo $row_ProductCategory2["CategoryName"]; ?></a>
                    <ul>
					  <?php 
					    $query_ProductCategory3 = "SELECT * FROM  `ProductCategory3` WHERE ParentCategoryId = ".$row_ProductCategory2["id"]." ORDER BY `CategorySort`";
					    $recProductCategory3 = mysql_query($query_ProductCategory3);
					    while($row_ProductCategory3=mysql_fetch_assoc($recProductCategory3)){
					  ?>	
						<li><a href="product.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <? echo $row_ProductCategory3["CategoryName"]; ?></a></li>
					  <? } ?>                     
                    </ul>
                  </li>
				  <? } ?>	
              </ul>
         </li>
		 <? } ?>     
	</ul>
</div>
<div id="DOWN">
    <div class="btn-group btn-group-justified">
      <ul>
        <li class="activityA"><a href="#"><i class="fa fa-list" aria-hidden="true"></i> 商品分類</a></li>
        <li><a href="notes.php"><i class="fa fa-eye" aria-hidden="true"></i> 瀏覽記錄(5)</a></li>
        <li><a href="shoppingcart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 購物車(1)</a></li>
      </ul>
    </div>
</div>
</body>
</html>
