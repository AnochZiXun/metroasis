<?php
	include('_connMysql.php');
?> 
 <footer>
    <div class="row footerBOXadd">
        <div align="center" class="col-md-3 col-sm-12"><img src="images/logo_footer.jpg" class="img-responsive"></div>
        <div class="col-md-3 col-sm-12 footerSTYLE">
            <h1>➴ 北區</h1>
                <ul>
				<?
					$query_footer_Branch = "SELECT * FROM `Branch` WHERE `DISTRICT` = '1' ORDER BY `Lat` DESC";
					$rec_footer_Branch = mysql_query($query_footer_Branch);
					while($row_footer_Branch=mysql_fetch_assoc($rec_footer_Branch)){ 
				?>
                    <li><? echo str_pad($row_footer_Branch["BranchName"], 15, "　"); ?>　☎ <? echo $row_footer_Branch["BranchPhoneNo"]; ?></li>                 
				<? } ?> 	
                </ul>
        </div>
        <div class="col-md-3 col-sm-12 footerSTYLE">
            <h1>➴ 桃竹苗區</h1>
                <ul>
				<?
					$query_footer_Branch = "SELECT * FROM `Branch` WHERE `DISTRICT` = '2' ORDER BY `Lat` DESC";
					$rec_footer_Branch = mysql_query($query_footer_Branch);
					while($row_footer_Branch=mysql_fetch_assoc($rec_footer_Branch)){ 
				?>
                     <li><? echo str_pad($row_footer_Branch["BranchName"], 12, "　"); ?>　☎ <? echo $row_footer_Branch["BranchPhoneNo"]; ?></li>  
				<? } ?> 		 
                </ul>
        </div>
        <div class="col-md-3 col-sm-12 footerSTYLE">
            <h1>➴ 中南區</h1>
                <ul>
				<?
					$query_footer_Branch = "SELECT * FROM `Branch` WHERE `DISTRICT` = '3' ORDER BY `Lat` DESC";
					$rec_footer_Branch = mysql_query($query_footer_Branch);
					while($row_footer_Branch=mysql_fetch_assoc($rec_footer_Branch)){ 
				?>
                    <li><? echo str_pad($row_footer_Branch["BranchName"], 18, "　"); ?>　☎ <? echo $row_footer_Branch["BranchPhoneNo"]; ?></li>  
				<? } ?>	
                </ul>
        </div>
    </div>
     <div class="row footerBOXcopyright">
        <div class="col-lg-12" style="font-size:14px">
            <p>城市綠洲股份有限公司 版權所有 Copyright &copy; 2017 Metroasis Co.LTD. All Rights Reserved. </p>
        </div>
     </div>
</footer>
    <div id="DOWN">
        <div class="btn-group btn-group-justified">
            <ul>
                <li><a href="menu_mobile.php" id="myBtn"><i class="fa fa-list" aria-hidden="true"></i>
                    商品分類</a></li>
                <li><a href="notes.php"><i class="fa fa-eye" aria-hidden="true"></i>瀏覽記錄(5)</a></li>
                <li><a href="shoppingcart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>購物車(1)</a></li>
            </ul>
        </div>
    </div>
