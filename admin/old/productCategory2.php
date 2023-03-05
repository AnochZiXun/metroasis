<?php
include('_connMysql.php');
include('check_login.php');
include('_productcategorys.php');

if (isset($_GET["id1"])){
	$query_productCategory1 = 'SELECT * FROM ProductCategory1 ORDER BY CategorySort';
	$recProductCategory1 = mysql_query($query_productCategory1);
	
	$id1 = $_GET["id1"];
	if ($id1 !="")
	{
		$query_productCategory2 = 'SELECT * FROM ProductCategory2 WHERE ParentCategoryId= '. $id1 .' ORDER BY CategorySort';
		$recProductCategory2 = mysql_query($query_productCategory2);
	}
	
	if (isset($_GET["id2"])){
		$id2 = $_GET["id2"];
		if ($id2 ==""){ $id2 = "1";}

		$query_productCategory3 = 'SELECT * FROM ProductCategory3 WHERE ParentCategoryId= '. $id2 .'  ORDER BY CategorySort';
		$recProductCategory3 = mysql_query($query_productCategory3);
	}
	
	
}else{
	
	$id1="1";
	$id2="1";
	$query_productCategory1 = 'SELECT * FROM ProductCategory1 ORDER BY CategorySort';
	$recProductCategory1 = mysql_query($query_productCategory1);
	
	$query_productCategory2 = 'SELECT * FROM ProductCategory2 WHERE ParentCategoryId=1 ORDER BY CategorySort';
	$recProductCategory2 = mysql_query($query_productCategory2);
	
	$query_productCategory3 = 'SELECT * FROM ProductCategory3 WHERE ParentCategoryId=1 ORDER BY CategorySort';
	$recProductCategory3 = mysql_query($query_productCategory3);
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="MainMasterHead">
    <title>城市綠洲-後台管理系統</title>
    <meta http-equiv="X-UA-Compatible" content="IE=11, IE=9, IE=8, chrome=10" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="icon" type="image/ico" href="images/favicon_16x16.ico" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link href="css/colorbox.css" type="text/css" rel="stylesheet" />
    <link href="css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
    <link href="css/jquery.cleditor.css" type="text/css" rel="stylesheet" />
    <link href="css/jquery.treeview.css" rel="stylesheet" />
    <link href="css/flexslider.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" charset="UTF-8" src="js/jquery-1.7.2.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.mouse.js"></script>    
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.button.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.sortable.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.colorbox.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.blockUI.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.treeview.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>

    <script type="text/javascript" charset="UTF-8">		
        function pageInitial(){
            var bodyHeight = document.body.clientHeight;
            //$("#divDetailBody").attr("style", "height:" + (bodyHeight - 105) + "px");
            $("input[type=submit], input[type=button]" ).button();
            $("#sortable1").sortable({ placeholder: "ui-state-highlight"});
            $("#sortable2").sortable({ placeholder: "ui-state-highlight"});
            $("#sortable3").sortable({ placeholder: "ui-state-highlight"});
    		$( "#sortable1" ).disableSelection();
    		$( "#sortable2" ).disableSelection();
    		$( "#sortable3" ).disableSelection();
    		
    		ProductCagegory1_Initialize('Level1');
    		ProductCagegory1_Initialize('pc1');
			ProductCagegory2_Initialize('pc1','pc2');
        }
		
		function productCategory_load(id1,id2){
			location.href= 'productCategory2.php?id1='+id1+'&id2='+id2;			
		}
		
    </script>
    <style>
    	#productCategory1Tool
    	{
    		border:1px solid #CCCCCC;
    		padding: 4px 0px 4px 0px;
    		width:90%;
    	}
    	
    	#productCategory2Tool
    	{
    		border:1px solid #CCCCCC;
    		padding: 4px 0px 4px 0px;
    		width:90%;
    	}
    	
    	#productCategory3Tool
    	{
    		border:1px solid #CCCCCC;
    		padding: 4px 0px 4px 0px;
    		width:90%;
    	}
    	#productCategory1
    	{
	   		border:1px solid #CCCCCC;
    		margin-top:5px;
    		width:90%;
    	}
    	
    	#productCategory2
    	{
    		border:1px solid #CCCCCC;
    		margin-top:5px;
    		width:90%;
    	}
    	
    	#productCategory3
    	{
    		border:1px solid #CCCCCC;
    		margin-top:5px;
    		width:90%;
    	}
    	.sortable { list-style-type: none; margin: 0; padding: 0; width: 80%; }
		.sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 22px; cursor:pointer; }
		.sortable li span { position: absolute; margin-left: -1.3em; margin-top:4px; }
    </style>
</head>
<body>
    <div id="divBody" style="width:1600px; margin: 0 auto; ">
		<!-- 加上方選單 -->
		<?php include("_nav.php"); ?>
        <div style="overflow: hidden;">
			<!-- 加左方選單 -->
			<?php include("left_nav.php"); ?>
            <div id="divWork" style="float: left; width: 90%;">
                <div class="divWorkArea">
                    <div id="UpdatePanel1">
                        <div class="SeachBar" style="height: 25px; padding-top: 5px">
							<div style="float: left; height: 25px; padding-top: 5px; font-size:13px">
							</div>
							<div style="float: left; padding-right: 20px;padding-top: 3px;">
							</div>
							<div style="float: left; padding-right: 10px;padding-top: 3px;">
							</div>
                            <div style="float: right">
                            </div>
                        </div>
                        <form action="productCategory.php" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
                        <div id="divDetailBody" class="divDetailBody">
                        	<table class="TableNoLine" style="width:99%">
                        		<tr>
                        			<td style="width:33%;height:20px;">
                        				<div id="productCategory1Tool">
                        					<input type="button" name="reset" id="reset" value="新增分類" />
                        					<input type="text" class="TextBox" name="txtLv1" id="txtLv1" value="" /><br/><br/>
                        				</div>
                        			</td>	
                        			<td style="width:33%">
                        				<div id="productCategory2Tool">
                        					<input type="button" name="reset" id="reset" value="新增分類" />
                        					<input type="text" class="TextBox" name="txtLv2" id="txtLv2" value="" />
                        					<br/>
                        					<input type="button" name="reset" id="reset" value="搬移至" />
                        					<select name="Level1" id="Level1" class="dropdownlist" onChange="ProductCagegory1_SelectOnChange('Level1')"></select>
                        				</div>
                        			</td>
                        			<td style="width:34%">
                        				<div id="productCategory3Tool">
                        					<input type="button" name="reset" id="reset" value="新增分類" />
                        					<input type="text" class="TextBox" name="txtLv3" id="txtLv3" value="" />
                        					<br/>
                        					<input type="button" name="reset" id="reset" value="搬移至" />
                        					<select name="pc1" id="pc1" class="dropdownlist" onChange="ProductCagegory1_SelectOnChange(this.value,'pc2','')"></select>
                        					<select name="pc2" id="pc2" class="dropdownlist"></select>
                        				</div>
                        			</td>
                        		</tr>
                        		<tr>
                        			<td style="vertical-align:top;">
                        				<div id="productCategory1">
			                        		<ul id="sortable1" class="sortable">
				                        	<?  while($row=mysql_fetch_assoc($recProductCategory1)){
				                        		if ($id1 == $row["id"]){ 
				                        	?>
				                        		<li class="ui-state-focus ui-priority-primary" onclick="productCategory_load('<? echo $row["id"]?>','')"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
				                        			<? echo '#'.$row["CategorySort"] . ' - ' .$row["CategoryName"]; ?>
				                        		</li>
				                        	<? }else{ ?>
				                        		<li class="ui-state-default" onclick="productCategory_load('<? echo $row["id"]?>','')"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><? echo '#'.$row["CategorySort"] . ' - ' .$row["CategoryName"]; ?></li>
				                        	<? }} ?>		
				                        	</ul>
			                        	</div>	
                        			</td>	
                        			<td style="vertical-align:top">
                        				<div id="productCategory2">
			                        		<ul id="sortable2" class="sortable">
				                        	<? 	while($row2=mysql_fetch_assoc($recProductCategory2))
				                        		{ if ($id2 == $row2["id"]){ 
				                        	?>
				                        		<li class="ui-state-focus ui-priority-primary" onclick="productCategory_load('<? echo $id1 ?>','<? echo $row2["id"]?>')"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><? echo '#'.$row2["CategorySort"] . ' - ' .$row2["CategoryName"]; ?></li>
				                        	<? }else{ ?>
				                        		<li class="ui-state-default" onclick="productCategory_load('<? echo $id1 ?>','<? echo $row2["id"]?>')"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><? echo '#'.$row2["CategorySort"] . ' - ' .$row2["CategoryName"]; ?></li>
				                        	<? }} ?>		
				                        	</ul>
			                        	</div>
                        			</td>
                        			<td style="vertical-align:top">
                        				<div id="productCategory3">
			                        		<ul id="sortable3" class="sortable">
				                        	<?  if ($recProductCategory3 != null){
				                        		while($row3=mysql_fetch_assoc($recProductCategory3)){ ?>
				                        		<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><? echo '#'.$row3["CategorySort"] . ' - ' .$row3["CategoryName"]; ?></li>
				                        	<? }} ?>		
				                        	</ul>
			                        	</div>
                        			</td>
                        		</tr>
                        	</table>
                    	</div>
                    	<div style="display:none">
                    		<input type="text" id="level1" name="level1" />
                    		<input type="text" id="level2" name="level2" />
                    		<input type="text" id="level3" name="level3" />
                    	</div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>