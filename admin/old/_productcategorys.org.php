<?
include('_connMysql.php');

$category1_sql = "SELECT * FROM ProductCategory1 ORDER BY CategorySort";
$category1_result = mysql_query($category1_sql);
$category2_sql = "SELECT * FROM ProductCategory2 ORDER BY ParentCategoryId, CategorySort";
$category2_result = mysql_query($category2_sql);
$category3_sql = "SELECT * FROM ProductCategory3 ORDER BY ParentCategoryId, CategorySort";
$category3_result = mysql_query($category3_sql);

$ProductCategoryId1="";
$ProductCategoryName1="";
while($category1 = mysql_fetch_assoc($category1_result)){
	if ($ProductCategoryId1 == ""){
		$ProductCategoryId1 = $ProductCategoryId1 . "'". $category1["id"] ."'";
	}else{
		$ProductCategoryId1 = $ProductCategoryId1 . ",'". $category1["id"] ."'";
	}
	
	if ($ProductCategoryName1 == ""){
		$ProductCategoryName1 = $ProductCategoryName1 . "'". $category1["CategoryName"] ."'";
	}else{
		$ProductCategoryName1 = $ProductCategoryName1 . ",'". $category1["CategoryName"] ."'";
	}
}

$ProductCategoryParentId2="";
$ProductCategoryId2="";
$ProductCategoryName2="";
while($category2 = mysql_fetch_assoc($category2_result)){
	if ($ProductCategoryParentId2 == ""){
		$ProductCategoryParentId2 .= "'". $category2["ParentCategoryId"] ."'";
	}else{
		$ProductCategoryParentId2 .= ",'". $category2["ParentCategoryId"] ."'";
	}
	
	if ($ProductCategoryId2 == ""){
		$ProductCategoryId2 .= "'". $category2["id"] ."'";
	}else{
		$ProductCategoryId2 .= ",'". $category2["id"] ."'";
	}
	
	if ($ProductCategoryName2 == ""){
		$ProductCategoryName2 .= "'". $category2["CategoryName"] ."'";
	}else{
		$ProductCategoryName2 .= ",'". $category2["CategoryName"] ."'";
	}
}

$ProductCategoryParentId3="";
$ProductCategoryId3="";
$ProductCategoryName3="";
while($category3 = mysql_fetch_assoc($category3_result)){
	if ($ProductCategoryParentId3 == ""){
		$ProductCategoryParentId3 .= "'". $category3["ParentCategoryId"] ."'";
	}else{
		$ProductCategoryParentId3 .= ",'". $category3["ParentCategoryId"] ."'";
	}
	
	if ($ProductCategoryId3 == ""){
		$ProductCategoryId3 .= "'". $category3["id"] ."'";
	}else{
		$ProductCategoryId3 .= ",'". $category3["id"] ."'";
	}
	
	if ($ProductCategoryName3 == ""){
		$ProductCategoryName3 .= "'". $category3["CategoryName"] ."'";
	}else{
		$ProductCategoryName3 .= ",'". $category3["CategoryName"] ."'";
	}
}

?>
<!--
<select name="ProductCategory1" id="ProductCategory1" class="dropdownlist" onChange="ProductCagegory1_SelectOnChange(this.value,'ProductCategory2','ProductCategory3')"></select> 
<select name="ProductCategory2" id="ProductCategory2" class="dropdownlist" onChange="ProductCagegory2_SelectOnChange(this.value,'ProductCategory3')"></select>
<select name="ProductCategory3" id="ProductCategory3" class="dropdownlist"></select>
-->
<script>
	var ProductCatgoryId1 = [<? echo $ProductCategoryId1 ?>];
	var ProductCatgoryName1 = [<? echo $ProductCategoryName1 ?>];
	var ProductCatgoryParentId2 = [<? echo $ProductCategoryParentId2 ?>];
	var ProductCatgoryId2 = [<? echo $ProductCategoryId2 ?>];
	var ProductCatgoryName2 = [<? echo $ProductCategoryName2 ?>];
	var ProductCatgoryParentId3 = [<? echo $ProductCategoryParentId3 ?>];
	var ProductCatgoryId3 = [<? echo $ProductCategoryId3 ?>];
	var ProductCatgoryName3 = [<? echo $ProductCategoryName3 ?>];
	
	function ProductCagegory1_Initialize(lv1Select){
		var selectOption;
		var selectCategory1 = document.getElementById(lv1Select);
		for (var i = 0; i < this.ProductCatgoryId1.length; i++) {
			selectOption = new Option(this.ProductCatgoryName1[i],this.ProductCatgoryId1[i]);
            selectCategory1.options.add(selectOption);
        }
	}
	
	function ProductCagegory2_Initialize(lv1Select,lv2Select){
		var selectOption;
		var selectCategory1 = document.getElementById(lv1Select);
		var selectCategory2 = document.getElementById(lv2Select);
        var category1Id = selectCategory1.value;
        
        for (var i = 0; i < this.ProductCatgoryId2.length; i++) {
        	if (ProductCatgoryParentId2[i] == category1Id)
        	{
				selectOption = new Option(this.ProductCatgoryName2[i],this.ProductCatgoryId2[i]);
            	selectCategory2.options.add(selectOption);
            }
        }
	}
	
	function ProductCagegory3_Initialize(lv2Select,lv3Select){
		var selectOption;
		var selectCategory2 = document.getElementById(lv2Select);
        var selectCategory3 = document.getElementById(lv3Select);
        var category2Id = selectCategory2.value;
        for (var i = 0; i < this.ProductCatgoryId3.length; i++) {
        	if (ProductCatgoryParentId2[i] == category2Id)
        	{
				selectOption = new Option(this.ProductCatgoryName3[i],this.ProductCatgoryId3[i]);
            	selectCategory3.options.add(selectOption);
            }
        }
	}
	
	function ProductCagegory1_SelectOnChange(category1Id,lv2Select,Lv3Select){
		var selectCategory2 = document.getElementById(lv2Select);
		selectCategory2.innerHTML = "";
        for (var i = 0; i < this.ProductCatgoryId2.length; i++) {
        	if (ProductCatgoryParentId2[i] == category1Id)
        	{
				selectOption = new Option(this.ProductCatgoryName2[i],this.ProductCatgoryId2[i]);
            	selectCategory2.options.add(selectOption);
            }
        }
        if (Lv3Select != ""){
       		ProductCagegory2_SelectOnChange(selectCategory2.value,Lv3Select);
       	}
	}
	
	function ProductCagegory2_SelectOnChange(category2Id,lv3Select){
		var selectCategory3 = document.getElementById(lv3Select);
		selectCategory3.innerHTML = "";
        for (var i = 0; i < this.ProductCatgoryId3.length; i++) {
        	if (ProductCatgoryParentId3[i] == category2Id)
        	{
				selectOption = new Option(this.ProductCatgoryName3[i],this.ProductCatgoryId3[i]);
            	selectCategory3.options.add(selectOption);
            }
        }
	}
	
</script>

<script>
	//ProductCagegory1_Initialize('ProductCategory1');
	//ProductCagegory2_Initialize('ProductCategory1','ProductCategory2');
	//ProductCagegory3_Initialize('ProductCategory2','ProductCategory3');
</script>

