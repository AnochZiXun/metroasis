<?php
include_once("_connMysql.php");
$imgSrc_Arr = array();
if (!isset($_SESSION["CustomerID"]) && isset($_SESSION["BrowsingHistory_Arr"])) {	
	$bhArray =  $_SESSION["BrowsingHistory_Arr"];
	$bhArray = array_reverse($bhArray);	
	$productIDStr;	
	for($j=0 ; $j<count($bhArray) ; $j++){
		if ($j==5) {
			break;
		}
		if ($j==0) {
			$productIDStr = "'".$bhArray[$j]."'";
		} else {
			$productIDStr = $productIDStr.",'".$bhArray[$j]."'";			
		}
	}	
	$query_ImagesFiles = "SELECT I.ForeignID,I.ImagePath,I.ImageFileName FROM `ImagesFiles` I WHERE I.ImageFunction = 'products' AND I.ImageType = 'list' AND I.ForeignID in ($productIDStr) LIMIT 0,5";
	//echo $query_ImagesFiles;
	$rec_ImagesFile = mysql_query($query_ImagesFiles);
	while($row_rec_ImagesFile=mysql_fetch_assoc($rec_ImagesFile)){			
		array_push($imgSrc_Arr, $row_rec_ImagesFile['ForeignID']."@".$row_rec_ImagesFile['ImagePath'].$row_rec_ImagesFile['ImageFileName']);
	}
} else {
	$customerID = $_SESSION["CustomerID"];	
	$query_BrowsingHistory = "SELECT DISTINCT BH.ProductID ,I.ImagePath,I.ImageFileName FROM `BrowsingHistory` BH, `ImagesFiles` I WHERE BH.ProductID = I.ForeignID AND BH.`CustomerID` = 1 AND I.ImageFunction = 'products' AND I.ImageType = 'list' Order by BH.`CreateDate` DESC LIMIT 0,5";
	$rec_BrowsingHistory = mysql_query($query_BrowsingHistory);
	while($row_BrowsingHistory=mysql_fetch_assoc($rec_BrowsingHistory )){	
		array_push($imgSrc_Arr, $row_BrowsingHistory['ProductID']."@".$row_BrowsingHistory['ImagePath'].$row_BrowsingHistory['ImageFileName']);
	}
}
?>
	<input type="hidden" id="customerID" value="<?echo $customerID;?>">
    <div id="browsing-history" class="browsing-history">
    <div id="browsing-close" style="display: none;"><img src="images/close.jpg"></div>
    </div>
    <!-- 手機版的右上按鈕 -->
    <span id="TOPBUT" onclick="openNav()">按鈕選單</span>
    <!-- 手機版的上方menu -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <nav>
        <ul>
            <li><a href="about.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 關於我們</a></li>
            <li><a><i class="fa fa-angle-double-right" aria-hidden="true"></i> 活動消息</a>
                <ul style="background-color: #2d5923;">
                    <li><a href="news.php?page=1&Category=1"><i class="fa fa-angle-right" aria-hidden="true"></i> 最新消息</a></li>
                    <li><a href="activity.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 活動報名</a></li>
                    <li><a href="highlights.php?page=1&Category=1"><i class="fa fa-angle-right" aria-hidden="true"></i> 活動花絮</a></li>
                    <li><a href="video.php?page=1&Category=1"><i class="fa fa-angle-right" aria-hidden="true"></i> 影音專區</a></li>
                    <li><a href="knowledge.php?page=1&Category=1"><i class="fa fa-angle-right" aria-hidden="true"></i> 知識分享</a></li>
                </ul>
            </li>
            <li><a href="brand_category.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 經銷品牌</a></li>
            <li><a href="https://www.104.com.tw/jobbank/custjob/index.php?r=cust&j=4c4a432938463f5631323a63443e371a75a3a4224343640212121211f382b2625381j99&jobsource=n104bank1#info06" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 人才招募</a></li>
            <li><a href="branch.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 門市據點</a></li>
            <li><a><i class="fa fa-angle-double-right" aria-hidden="true"></i> 會員中心</a>
                <ul style="background-color: #2d5923;">
                    <li><a href="order.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 我的訂單</a></li>
                    <li><a href="annal.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 我的報名</a></li>
                    <li><a href="watchlist.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 收藏商品</a></li>
                    <li><a href="edit.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 個人資料</a></li>
                    <li><a href="point.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 紅利績點</a></li>
               </ul>
            </li>   
        </ul>
       </nav>
    </div>
    <!-- 頁首區 TOP-->
    <div id="MenuTOP">
        <div class="MenuTOP_box">
		<? if(empty($_SESSION["CustomerID"])){ ?>
            <a href="login.php"><i class="fa fa-user" aria-hidden="true"></i> 會員登入</a>&nbsp;&nbsp;│&nbsp;&nbsp;<a href="register.php">加入會員　</a></div>
		<? } else { ?>
			<span><? echo $_SESSION["NickName"]." 您好 ";?></span>　|　<a href="login.php?logout=true">登出</a>
		<? } ?>
        </div>
    </div>
    <!-- 上方menu和logo -->
    <div id="LOGO-MENU">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <!-- logo -->
            <div id="LOGO_box">
                <a href="index.php"><img src="images/logo.png" class="img-responsive"></a>
            </div>
            <!-- search -->
            <div id="SEARCH_box" class="header-search">
                <form action="product_s.php" id="searchForm" method="post">
                <input type="search" name="Search" id="Search" placeholder="商品搜尋 " required="">
                <button type="button" class="btn btn-default" aria-label="Left Align">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                </form>
            </div>
        </div>
        <!-- 桌機版的上方menu -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-hover="dropdown" data-animations="fadeIn">
            <ul class="nav navbar-nav navbar-right">
                <li class="text-center"><a class="colorH" href="about.php"><span class="fa-stack fa-2x "><i class="fa fa-circle fa-stack-2x ">
                </i><i class="fa fa-exclamation fa-stack-1x fa-inverse"></i></span>
                    <h4>關於我們</h4>
                </a></li>
                <li class="dropdown text-center">
                	<a class="colorH" href="#" data-toggle="dropdown">
                    	<span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-flag fa-stack-1x fa-inverse"></i></span>
                    	<h4>活動消息</h4>
                    	<b style="color: #23451b;" class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="news.php?page=1&Category=0">最新消息</a></li>
                        <li><a href="activity.php">活動報名</a></li>
                        <li><a href="highlights.php?page=1&Category=0">活動花絮</a></li>
                        <li><a href="video.php?page=1&Category=0">影音專區</a></li>
                        <li><a href="knowledge.php?page=1&Category=0">知識分享</a></li>
                    </ul>
                </li>
                <li class="text-center"><a class="colorH" href="brand_category.php"><span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x">
                    </i><i class="fa fa-tags fa-stack-1x fa-inverse"></i></span>
                    <h4>經銷品牌</h4>
                </a></li>
                <li class="text-center"><a class="colorH" href="https://www.104.com.tw/jobbank/custjob/index.php?r=cust&j=4c4a432938463f5631323a63443e371a75a3a4224343640212121211f382b2625381j99&jobsource=n104bank1#info06"
                    target="_blank"><span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x">
                    </i><i class="fa fa-question fa-stack-1x fa-inverse"></i></span>
                    <h4>人才招募</h4>
                </a></li>
                <li class="text-center"><a class="colorH" href="branch.php"><span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x">
                </i><i class="fa fa-map-marker fa-stack-1x fa-inverse"></i></span>
                    <h4>門市據點</h4>
                </a></li>
                <li class="dropdown text-center"><a class="colorH" href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x"></i><i
                        class="fa fa-user fa-stack-1x fa-inverse"></i></span>
                    <h4>會員中心</h4>
                    <b style="color: #23451b;" class="caret"></b></a></a>
                    <ul class="dropdown-menu">
                    	<li><a href="order.php">我的訂單</a></li>
                        <li><a href="annal.php">我的報名</a></li>
                        <li><a href="watchlist.php">收藏商品</a></li>
                        <li><a href="edit.php">個人資料</a></li>
                        <li><a href="point.php">紅利績點</a></li>
                    </ul>
                </li>
                <li class="dropdown text-center"><a class="colorH" href="shoppingcart.php" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x"></i><i
                        class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i></span>
					<?php
						$total_records = 0;
						if(isset($_SESSION["CustomerID"])){
							$customerID = $_SESSION["CustomerID"];
							$query_m_OrderBaskets = "SELECT *,OB.BarCode as BarCode FROM `OrderBaskets` OB, `Products` P WHERE 1=1
														AND OB.ProductID = P.ProductID AND OB.`CustomerID` = '$customerID'";
							$rec_m_OrderBaskets = mysql_query($query_m_OrderBaskets);
							$total_records = mysql_num_rows($rec_m_OrderBaskets);
						}
					?>	
                    <h4 id="totalRecords">購物車<?echo "($total_records)"?></h4>
                    <b style="color: #23451b;" class="caret"></b></a></a>
                    <ul class="dropdown-menu">
                        <div class="menuSC">
                            <h1>最新加入項目</h1>
							<?php if($total_records > 0) {
							while($rows=mysql_fetch_assoc($rec_m_OrderBaskets)){ ?>
								<div class="porLIST" id="<?echo "HEAD_".$rows["BarCode"]?>">
                                    <?php 
                                    $productID = $rows["ProductID"];
                                    $rec_img = mysql_query("SELECT * FROM ImagesFiles WHERE ImageFunction = 'products' AND ImageType = 'detail' AND ForeignID = '$productID' ORDER BY ImageFileName LIMIT 1 ");
                                    $row_img = mysql_fetch_assoc($rec_img);
                                    ?>
									<div class="A"><a href="product_detail.php?ProductID=<? echo $rows["ProductID"]; ?>"><img src="<? echo $row_img["ImagePath"].$row_img["ImageFileName"]; ?>" class="img-responsive"></a></div>
									<div class="B">
										<p><? echo $rows["ProductName"]; ?></p>
										<span>$<? echo $rows["UnitPrice"]; ?></span>
									</div>
									<div class="C"><a class="deleteBasketItemBtn" href="#" targetId="<?echo $rows["BarCode"]?>">
									<input type="hidden" id="barCode" value="<?echo $rows["BarCode"]?>">
									<i class="fa fa-trash" aria-hidden="true"></i></a></div>
								</div>
							<? }?>
							<div class="btnBB"><a href="shoppingcart.php"><button type="button" class="btn-danger btn-lg btn-block buttonB">立即結帳</button></a></div>
							<?}?>                       
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <script>
		$('.deleteBasketItemBtn').click(function(){
			var barCode = $(this).attr('targetId');
			var customerId = $('#customerID').val();
			var removeElement = $(this).closest('.porLIST');
			deleteBasketItem(removeElement, customerId, barCode);
		});
		function deleteBasketItem(removeElement, customerId, barCode) {
			$.ajax({
				url: 'deleteBasketItem.php', 
				type: 'POST',
				data: {
					CustomerID: customerId,
					BarCode: barCode
				},
				success: function(deleteRow) {
					if(Number(deleteRow) > 0) {
						$('#BODY_'+barCode).remove();
						$(removeElement).remove();
						var totalRecordsStr = $('#totalRecords').text();
						var startIndext = totalRecordsStr.indexOf('(')+1;
						var endIndext = totalRecordsStr.indexOf(')');
						var totalRecords = Number(totalRecordsStr.substring(totalRecordsStr.indexOf('(')+1, totalRecordsStr.indexOf(')')));
						var newTotalRecordsStr = totalRecordsStr.replace('('+totalRecords+')','('+(totalRecords-1)+')');
						$('#totalRecords').text(newTotalRecordsStr);
					}
				}, error: function(xhr) { 
					alert('系統異常。');
				} 
			});
		}
        function openNav() {
            document.getElementById("mySidenav").style.width = "160px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
	</script>
