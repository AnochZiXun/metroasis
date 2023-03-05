<?php 		
	include('_connMysql.php');
	$query_Banners1 = "SELECT * FROM  `Banners` WHERE BannerType = '1' AND BannerImage <> '' ORDER BY `BannerSort`";
	$recBanners1 = mysql_query($query_Banners1);
?>
	<!-- 手機版形象banner輪播 -->
    <div id="BANNER_Mobile" class="flexslider">
        <div id="slides">
			<ul class="slides">
		    <?php while($row_Banners1=mysql_fetch_assoc($recBanners1)){ ?>
			<li>
				<a <?php if ($row_Banners1["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners1["BannerLink"]; ?>">
					<img src="images/banners/banner1/<? echo $row_Banners1["BannerImage"]; ?>" class="img-responsive">
				</a>
			</li>	
			<? } ?>	  
			</ul>
        </div>
    </div>
    <!-- 形象banner輪播 -->
    <div id="BANNER">
        <header id="myCarousel" class="carousel slide">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
			<?php 
				$itemActive = true;
				$recBanners1 = mysql_query($query_Banners1);
				while($row_Banners1=mysql_fetch_assoc($recBanners1)){ 
			?>
			<?php if ($itemActive == true) { ?>
				<div class="item active">
			<?php $itemActive = false;} else { ?>
				<div class="item">
			<? } ?>
					<div class="fill">
						<a <?php if ($row_Banners1["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners1["BannerLink"]; ?>">
							<img src="images/banners/banner1/<? echo $row_Banners1["BannerImage"]; ?>" class="img">
						</a>					
					</div>
				</div>				
			<? } ?>	  
        </div>
		  
        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"><img src="images/arr_left.png"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"><img src="images/arr_right.png"></span>
        </a>
    </header>
    </div>