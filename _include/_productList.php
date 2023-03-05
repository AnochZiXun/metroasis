<?php 	
	session_start();
	include('_connMysql.php');
	$query_ProductCategory1 = "SELECT id,CategorySort,CategoryName FROM ProductCategory1 WHERE Status = 1 ";
	$query_ProductCategory1 .= "UNION ALL ";
	$query_ProductCategory1 .= "SELECT id,CategorySort,CategoryName FROM ProductBrands1 ORDER BY CategorySort";
	$recProductCategory1 = mysql_query($query_ProductCategory1);

?>               
<!-- 產品menu -->
<style>
.menuTITLE_2 	  {	background-color: #ebebeb; }
.menuDROW li 	  {	background-color: #f5f5f5; }
.menuDROW li:hover{	background-color: #fcffd9; }
</style>
<div class="proMenu">
	<div class="menuTITLE">
		❖ 商品分類
	</div>
	<?php 
		$muneIndex = 0;
		$m_muneIndex = 0;
		while($row_ProductCategory1=mysql_fetch_assoc($recProductCategory1)){ 
			$muneIndex++;
	?>
		<div id="mune<? echo $muneIndex; ?>" onclick="hideshow('test<? echo $muneIndex; ?>')" class="menuTITLE_1">
			<? echo $row_ProductCategory1["CategoryName"]; ?> <span><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
        </div>		   
		<div id="test<? echo $muneIndex; ?>" <? if($_SESSION["ProductCategory1ID"]!=$row_ProductCategory1["id"]){echo "style='display: none;'";}?>>
			<ul >
				<?php 					
					$query_ProductCategory2 = "SELECT id, ParentcategoryId, CategorySort, CategoryName FROM ";		
					$query_ProductCategory2 .= "( ";					
					$query_ProductCategory2 .= "	SELECT * FROM ProductCategory2 ";				
					$query_ProductCategory2 .= "	UNION ALL ";				
					$query_ProductCategory2 .= "	SELECT * FROM ProductBrands2 ";
					$query_ProductCategory2 .= " ) B ";
					$query_ProductCategory2 .= " WHERE Status = 1 AND ParentCategoryId = ".$row_ProductCategory1["id"] ;
					$query_ProductCategory2 .= " ORDER BY CategorySort ";
					$recProductCategory2 = mysql_query($query_ProductCategory2);
					while($row_ProductCategory2=mysql_fetch_assoc($recProductCategory2)){
						$m_muneIndex++;
				?>
				<li>
                    <div id="m_mune<? echo $m_muneIndex; ?>" onclick="javascript:hideshow('m_test<? echo $m_muneIndex; ?>')" class="menuTITLE_2">
                        ▪ <? echo $row_ProductCategory2["CategoryName"]; ?> <i class="fa" aria-hidden="true"></i>
					</div>
					
                    <div id="m_test<? echo $m_muneIndex; ?>" <? if($_SESSION["ProductCategory2ID"]!=$row_ProductCategory2["id"]){echo "style='display: none;'";}?>>
                        <ul class="menuDROW">
							<?php 
								//$query_ProductCategory3 = "SELECT * FROM  `ProductCategory3` WHERE ParentCategoryId = ".$row_ProductCategory2["id"]." ORDER BY `CategorySort`";
								$query_ProductCategory3 = "SELECT * FROM ";
								$query_ProductCategory3 .= " ( ";
								$query_ProductCategory3 .= "	SELECT * FROM  ProductCategory3 ";
								$query_ProductCategory3 .= "	UNION ALL ";
								$query_ProductCategory3 .= "	SELECT B.BrandID AS id,P2.id AS ParentCategoryId,0 AS CategorySort, B.BrandName AS CategoryName, 1 AS Status  ";
								$query_ProductCategory3 .= "	FROM ProductBrands2 P2 LEFT JOIN Brand B ON instr(P2.CategoryName,LEFT(B.BrandName,1)) ";
								$query_ProductCategory3 .= " ) C ";
								$query_ProductCategory3 .= " WHERE Status = 1 AND ParentCategoryId = ".$row_ProductCategory2["id"]. " ORDER BY CategorySort, CategoryName";
								//echo $query_ProductCategory3;
								$recProductCategory3 = mysql_query($query_ProductCategory3);
								while($row_ProductCategory3=mysql_fetch_assoc($recProductCategory3)){
									if ($row_ProductCategory2["id"] < 900){
							?>
								<a href="product.php<? echo '?ProductCategoryID='.$row_ProductCategory3["id"]; ?>"><li><? echo $row_ProductCategory3["CategoryName"]; ?></li></a>
							<?  	}else{?>
								<a href="product.php<? echo '?BrandID='.$row_ProductCategory3["id"].'&id1='.$row_ProductCategory1["id"].'&id2='.$row_ProductCategory2["id"] ; ?>"><li><? echo $row_ProductCategory3["CategoryName"]; ?></li></a>
							<?		}
								} ?>	                          
                        </ul>
                    </div>
                </li>				
				<? } ?>
            </ul>
        </div>		
	<? } ?>	 