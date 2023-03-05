<?php
include('_connMysql.php');
include('check_login.php');


$id1="";
$id2="";

if ($_POST["action"] == "addLv1"){ 
	$query_newSortNo = "SELECT IFNULL(Max(`CategorySort`),0) + 1 AS SortNo FROM ProductCategory1";
	$rec_newSortNo = mysql_query($query_newSortNo);
	$row_newSortNo = mysql_fetch_assoc($rec_newSortNo);
	$sortNo = $row_newSortNo["SortNo"];
	$CategoryName = $_POST["txtLv1"];
	$insert_newCategory = "INSERT INTO ProductCategory1 (CategorySort,CategoryName) VALUES ($sortNo,'$CategoryName')";
	mysql_query($insert_newCategory);
	
	
}

if ($_POST["action"] == "addLv2"){ 
	
}


if ($_POST["action"] == "addLv3"){ 
	
}

if ($_POST["action"] == "Lv1Save"){ 
	//CategorySort +','+CategoryName+','+CategoryStatus+','+id;
	
	$dataString = explode(';', $_POST["txtLv1String"]);
	for ($i = 0; $i < count($dataString); $i++) {
		$valueString = explode(',', $dataString[i]);
		echo 'dataString=' . $dataString[i] ."<br />";
		echo 'CategorySort=' . $valueString[0] ."<br />";
		echo 'CategoryName=' . $valueString[1] ."<br />";
		echo 'CategoryStatus=' . $valueString[2] ."<br />";
		echo 'id=' . $valueString[3] ."<br />";
		echo '==================================<br />';
	}
	
}

if ($_POST["action"] == "Lv2Save"){ 
	
}

if ($_POST["action"] == "Lv3Save"){ 
	
}


if (isset($_GET["id1"])){
	$id1 = $_GET["id1"];
}

if (isset($_POST["id1"])){
	$id1 = $_POST["id1"];
}

if (isset($_GET["id2"])){
	$id2 = $_GET["id2"];
}

if (isset($_POST["id2"])){
	$id2 = $_POST["id2"];
}

//echo "id1=". $id1 . "<br/>";
//echo "id2=". $id2;

	
if ($id1 != ""){
	$query_productCategory1 = 'SELECT * FROM ProductCategory1 ORDER BY CategorySort';
	$recProductCategory1 = mysql_query($query_productCategory1);
	
	$lv2Display = "none";
	if ($id1 !="")
	{
		$lv2Display = "";
		$query_productCategory2 = 'SELECT * FROM ProductCategory2 WHERE ParentCategoryId= '. $id1 .' ORDER BY CategorySort';
		$recProductCategory2 = mysql_query($query_productCategory2);
	}
	
	$lv3Display = "none";
	if ($id2 != ""){
		$id2 = $_GET["id2"];
		$lv3Display = "";		
		$query_productCategory3 = 'SELECT * FROM ProductCategory3 WHERE ParentCategoryId= '. $id2 .'  ORDER BY CategorySort';
		$recProductCategory3 = mysql_query($query_productCategory3);
	}
	
}else{
	$lv2Display = "none";
	$lv3Display = "none";

	$query_productCategory1 = 'SELECT * FROM ProductCategory1 ORDER BY CategorySort';
	$recProductCategory1 = mysql_query($query_productCategory1);
	
	//$query_productCategory2 = 'SELECT * FROM ProductCategory2 WHERE ParentCategoryId='.$id1.' ORDER BY CategorySort';
	//$recProductCategory2 = mysql_query($query_productCategory2);
	
	//$query_productCategory3 = 'SELECT * FROM ProductCategory3 WHERE ParentCategoryId='. $id2 .' ORDER BY CategorySort';
	//$recProductCategory3 = mysql_query($query_productCategory3);
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
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.selectable.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.dialog.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.position.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.colorbox.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.blockUI.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.treeview.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>

    <script type="text/javascript" charset="UTF-8">		
        function pageInitial(){
            var bodyHeight = document.body.clientHeight;
            var defaultHeight = bodyHeight;
            var Lv1Height = $("#sortable1").height();
            var Lv2Height = $("#sortable2").height();
            var Lv3Height = $("#sortable3").height();
            var MaxLv;
            if (Lv1Height > Lv2Height){
            	MaxLv = Lv1Height;
            } else {
            	MaxLv = Lv2Height;
            }
            if (MaxLv < Lv3Height){
            	MaxLv = Lv3Height;
            }
            if (MaxLv < bodyHeight)}
        		MaxLv = bodyHeight - 105;
    		} else {
    			MaxLv = MaxLv - 210;
    		}
            
            
            $("#divDetailBody").attr("style", "height:" + MaxLv + "px;width:99.4%");
            $("input[type=submit], input[type=button]" ).button();
            //$("#sortable1").sortable({ 
            //	placeholder: "ui-state-highlight",
            //	stop:function( event, ui ) { sequence_table("#sortable1");}
            //});
            
            //$("#sortable1").sortable({ placeholder: "ui-state-highlight",handle: ".handle",stop:function( event, ui ) { sequence_Sorttable("#sortable1");}});
            $("#sortable1").sortable({ placeholder: "ui-state-highlight",handle: ".handle"});
		    $("#sortable2").sortable({ placeholder: "ui-state-highlight",handle: ".handle"});
            $("#sortable3").sortable({ placeholder: "ui-state-highlight",handle: ".handle"});
            $("#sortable2").selectable({ filter: "li", cancel: ".handle, input", stop: function( event, ui ) {sequence_Selecttable("#sortable2");} });
            $("#sortable3").selectable({ filter: "li", cancel: ".handle, input", stop: function( event, ui ) {sequence_Selecttable("#sortable3");} });
    		$("#sortable1").disableSelection();
    		$("#sortable2").disableSelection();
    		$("#sortable3").disableSelection();
    		
    		$("#dialog").dialog({autoOpen: false});
			$("#myDialog").position({
			   my: "center",
			   at: "center",
			   of: window
			});

    		ProductCagegory1_Initialize('Level1');
    		ProductCagegory1_Initialize('pc1');
			ProductCagegory2_Initialize('pc1','pc2');
        }
        
        function TitleRename(level,id,sortNo){
        	var titleName = "";
        	switch (level){
        		case "Lv1":	
        			titleName = $("#txtLv1Name-"+id).val();
        			break;
        		case "Lv2":	
        			titleName = $("#txtLv2Name-"+id).val();
        			break;
        		case "Lv3":	
        			titleName = $("#txtLv3Name-"+id).val();
        			break;
        	}
        	$("#txtLevel").val(level);
        	$("#txtId").val(id);
        	$("#txtSortNo").val(sortNo);
        	$("#txtName").val(titleName);
        	$( "#dialog" ).dialog( "open" );
        }
        
        function setRename(){
        	var id= $("#txtId").val();
        	var sortNo = $("#txtSortNo").val();
        	var name = $("#txtName").val();
        	var level = $("#txtLevel").val();
        	var labelId = "";
        	var txtId = "";
        	switch (level){
        		case "Lv1":	
        			labelId = '#lv1Name-'+id;
        			txtId = 'txtLv1Name-'+id;
        			break;
        		case "Lv2":	
        			labelId = '#lv2Name' +'-'+id;
        			txtId = 'txtLv2Name-'+id;
        			break;
        		case "Lv3":	
        			labelId = '#lv3Name' +'-'+id;
        			txtId = 'txtLv3Name-'+id;
        			break;
        	}
        	
        	$(labelId).html("#"+sortNo+" - "+name);
        	$(txtId).val(name);
        	
        	$("#dialog").dialog( "close" );
        }
        
        function setStatus(obj,id,level){
        	var status = obj.value;
        	switch (level){
        		case "Lv1":	
        			labelId = '#lv1Status-'+id;
        			txtId = '#txtLv1Status-'+id;
        			break;
        		case "Lv2":	
        			labelId = '#lv2Status' +'-'+id;
        			txtId = '#txtLv2Status-'+id;
        			break;
        		case "Lv3":	
        			labelId = '#lv3Status' +'-'+id;
        			txtId = '#txtLv3Status-'+id;
        			break;
        	}
        	
        	if (status == "啟用"){
        		$(labelId).val("停用");
        		$(txtId).val("1");
        	}else{
        		$(labelId).val("啟用");
        		$(txtId).val("0");
        	}
		}
	
		function lv2Category_load(id1){
			location.href= 'productCategory3.php?id1='+id1;			
		}
		
		function lv3Category_load(id1,id2){
			location.href= 'productCategory3.php?id1='+id1+'&id2='+id2;			
		}
		
		function sequence_Sorttable(selector,form) {
			var CategoryString = "";
			var CategorySort = 0;
			var CategoryName = "";
			var CategoryStatus = "";
			var id= "";
			$(selector + " li").each(function(index, element) {
				CategorySort = CategorySort = CategorySort + 1;;
				CategoryName = "";
				CategoryStatus = "";
				id = $(this).attr("data-id");
				switch (selector){
					case "#sortable1":
						CategoryName = $("#txtLv1Name-"+id).val();
						CategoryStatus = $("#txtLv1Status-"+id).val();
						break;
					case "#sortable2":
						CategoryName = $("#txtLv2Name-"+id).val();
						CategoryStatus = $("#txtLv2Status-"+id).val();
						break;	
					case "#sortable3":
						CategoryName = $("#txtLv3Name-"+id).val();
						CategoryStatus = $("#txtLv3Status-"+id).val();
						break;	
				}
				if (CategoryString == ""){
					CategoryString =  CategorySort +','+CategoryName+','+CategoryStatus+','+id;
				}else{
					CategoryString =  CategoryString + ';'+ CategorySort +','+CategoryName+','+CategoryStatus+','+id;
				}
				
			});
			switch (selector){
				case "#sortable1":
					$("#txtLv1String").val(CategoryString);
					break;
				case "#sortable2":
					$("#txtLv2String").val(CategoryString);
					break;	
				case "#sortable3":
					$("#txtLv3String").val(CategoryString);
					break;	
			}
			$("#"+form).submit();
		}
		
		function sequence_Selecttable(selector) {
			var selectString = "";
			$(selector + " li").each(function(index, element) {
				var strClass = $(element).attr("class");
				
				if (strClass.indexOf("ui-selected") >0){
					var id = $(element).attr("data-id");	
					if (selectString ==""){
						selectString = selectString + id;
					}else{
						selectString = selectString + "," + id;	
					}
					
				}
			});
			switch (selector){
				case "#sortable2":
					$("#txtLv2Move").val(selectString);
					break;	
				case "#sortable3":
					$("#txtLv3Move").val(selectString);
					break;	
			}
		}
		
		function setActionSubmit(form,button){
			var strLvAdd = "";
			var blnValidate = false;
			switch (form){
				case "form1":
					strLvAdd = $("#txtLv1").val();
					if (strLvAdd == ""){
						alert("請輸入欲新增的「大分類」名稱。");
						$("#txtLv1").focus();
					}else{
						$("#lv1Action").val("addLv1");	
					}
					$("#"+form).submit();
					break;
				case "form2":
					strLvAdd = $("#txtLv2").val();
					switch (button){
						case "btnLv2Add":
							if (strLvAdd == ""){
								alert("請輸入欲新增的「中分類」名稱。");
								$("#txtLv2").focus();
							}else{
								$("#lv2Action").val("addLv2");	
							}
							break;
						case "btnLv2Move":
							$("#lv2Action").val("moveLv2");	
							break;	
					}
					break;
				case "form3":	
					strLvAdd = $("#txtLv3").val();
					switch (button){
						case "btnLv3Add":
							if (strLvAdd == ""){
								alert("請輸入欲新增的「小分類」名稱。");
								$("#txtLv3").focus();
							}else{
								$("#lv3Action").val("addLv3");	
							}	
							break;
						case "btnLv3Move":
							$("#lv3Action").val("moveLv3");	
							break;	
					}
					break;
			}
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
		.sortable li { margin: 0 3px 0px 0px; padding: 0.4em; font-size: 1.4em; height: 25px; }
		.sortable li span { position: absolute; margin-left: -1.3em; margin-top:4px; }
		.sortable li .divIcon { position: relative; display: inline-block; float:left;height:20px; padding-top:5px;}
		.sortable li .divTitle { position: relative; display: inline-block; float:left;height:25px;width:57% }
		.sortable li .divTitle2 { position: relative; display: inline-block; float:left;height:25px;width:70% }
		.sortable li .divButton1 { position: relative; display: inline-block; float:left;height:25px; }
		.sortable li .divButton2 { position: relative; display: inline-block; float:left;height:25px;}
		.sortable li .handle {cursor:pointer}
		.ui-selecting { background: #eee; }
		.ui-selecting .handle { background: #ddd; }
		.ui-selected {   font-weight: bold; color:Red }
		.ui-selected .handle {  }
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
                        <div id="divDetailBody" class="divDetailBody"><br/>
                    	<table class="TableNoLine" style="width:100%;margin: 0 auto;" >
                    		<tr>
                    			<td style="width:33%;vertical-align:top;">
                    				<form id="form1" name="form1" action="productCategory3.php" method="POST">
                    				<table class="TableLineCategory" style="width:100%; height:95px" cellpadding="4">
                    					<tr>
                    						<td style="text-align:center"><b>大分類：</b></td>
                    						<td><input type="text" class="TextBox" name="txtLv1" id="txtLv1" value="" style="width:98%" /></td>
                    						<td><input type="button" name="btnLv1Add" id="btnLv1Add" value="新增分類" onclick="setActionSubmit('form1','btnLv1Add')" /></td>
                    					</tr>
                    					<tr>
                    						<td>&nbsp;</td>
                    						<td>&nbsp;</td>
                    						<td>&nbsp;</td>
                    					</tr>
                    					<tr>
                    						<td colspan="3" style="padding-left:10px">
                    							<span style="color:darkblue; font-size:14px">※ 若要排序請直接「拖拉 箭頭」選項上下移動。</span>
                    						</td>
                    					</tr>	
                    				</table>
                    				<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />
                    				<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />
                    				<input type="hidden" id="lv1Action" name="action" class="TextBox" value="" />
                    				</form>
                    			</td>	
                    			<td style="width:33%;vertical-align:top">
                    				<form id="form2" name="form2" action="productCategory3.php" method="POST">
                    				<table class="TableLineCategory" style="width:100%; height:95px" cellpadding="4">
                    					<tr>
                    						<td style="text-align:center"><b><div style="display:<? echo $lv2Display ?>">中分類：</div></b></td>
                    						<td><input type="text" class="TextBox" name="txtLv2" id="txtLv2" value="" style="width:98%;display:<? echo $lv2Display ?>" /></td>
                    						<td><input type="button" name="lv1Category" id="btnLv2Add" value="新增分類" style="display:<? echo $lv2Display ?>" onclick="setActionSubmit('form2','btnLv2Add')" /></td>
                    					</tr>
                    					<tr>
                    						<td style="text-align:center"><input type="button" name="btnLv2Move" id="btnLv2Move" value="搬移至" style="display:<? echo $lv2Display ?>" onclick="setActionSubmit('form2','btnLv2Move')" /></td>
                    						<td>
                    							<select name="Level1" id="Level1" class="dropdownlist" onChange="ProductCagegory1_SelectOnChange('Level1')" style="display:<? echo $lv2Display ?>"></select>
                    							<input type="text" class="TextBox" name="txtLv2Move" id="txtLv2Move" value="" />
                    						</td>
                    						<td></td>
                    					</tr>
                    					<tr>
                    						<td colspan="3" style="padding-left:10px">
                    							<span style="color:red; font-size:14px;display:<? echo $lv2Display?>">※ 搬移請選擇「大分類」，若不選擇將全部搬移。</span>
                    						</td>
                    					</tr>	
                    				</table>
                    				<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />
                    				<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />
                    				<input type="text" id="lv2Action" name="action" class="TextBox" value="" />
                    				</form>
                    			</td>
                    			<td style="width:34%;vertical-align:top">
                    				<form id="form3" action="productCategory3.php" method="POST">
                    				<table class="TableLineCategory" style="width:100%; height:95px;" cellpadding="4">
                    					<tr>
                    						<td style="text-align:center"><b><div style="display:<? echo $lv3Display?>">小分類：</div></b></td>
                    						<td><input type="text" class="TextBox" name="txtLv3" id="txtLv3" value="" style="width:98%;display:<? echo $lv3Display?>" /></td>
                    						<td><input type="button" name="lv1Category" id="btnLv3Add" value="新增分類" style="display:<? echo $lv3Display?>" onclick="setActionSubmit('form3','btnLv3Add')" /></td>
                    					</tr>
                    					<tr>
                    						<td style="text-align:center"><input type="button" name="btnLv3Move" id="btnLv3Move" value="搬移至" style="display:<? echo $lv3Display?>" onclick="setActionSubmit('form3','btnLv3Move')" /></td>
                    						<td colspan="2">
                    							<select name="pc1" id="pc1" class="dropdownlist" onChange="ProductCagegory1_SelectOnChange(this.value,'pc2','')" style="display:<? echo $lv3Display?>"></select>
                    							<select name="pc2" id="pc2" class="dropdownlist" style="display:<? echo $lv3Display?>"></select>
                    							<input type="text" class="TextBox" name="txtLv3Move" id="txtLv3Move" value="" />
                    						</td>
                    					</tr>
                    					<tr>
                    						<td colspan="3" style="padding-left:10px">
                    							<span style="color:red; font-size:14px;display:<? echo $lv3Display?>">※ 搬移請選擇「大分類->中分類」，若不選擇將全部搬移。</span>
                    						</td>
                    					</tr>
                    				</table>
                    				<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />
                    				<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />
                    				<input type="text" id="lv3Action" name="action" class="TextBox" value="" />
                    				</form>
                    			</td>
                    		</tr>
                    		<tr>
                    			<td style="vertical-align:top;">
                    				<table class="TableLineCategory" style="width:100%; height:510px;" cellpadding="6">
                    					<tr>
                    						<td style="vertical-align:top;">
                    							<ul id="sortable1" class="sortable" style="width:100%">
					                        	<?  while($row=mysql_fetch_assoc($recProductCategory1)){
					                        		if ($row["Status"] == "1"){
					                        			$StatusDesc="停用";
					                        		}else{
					                        			$StatusDesc="啟用";
					                        		}
					                        		
					                        		if ($id1 == $row["id"]){ 
					                        			$class = "ui-state-focus ui-priority-primary";
						                        	}else{
						                        		$class = "ui-state-default";
						                        	}
					                        	?>
					                        		<li data-id="<? echo $row["id"] ?>" class="<? echo $class ?>">
					                        			
					                        			<div class="handle divIcon">
					                        				<div class="ui-icon ui-icon-arrowthick-2-n-s"></div>
					                        			</div>
					                        			<div id="lv1Name-<? echo $row["id"] ?>" class="divTitle">
					                        				<? echo '#'.$row["CategorySort"] . ' - ' .$row["CategoryName"]; ?>
					                        			</div>
					                        			<div class="divButton1">
					                        				<input type="button" class="rename" name="lv1Status" id="lv1Status-<? echo $row["id"] ?>"  value="<? echo $StatusDesc ?>" onclick="setStatus(this,'<? echo $row["id"] ?>','Lv1')" />
					                        				<input type="hidden" name="lv1Status" id="txtLv1Status-<? echo $row["id"] ?>" value="<? echo $row["Status"]?>" />
					                        			</div>
					                        			<div class="divButton1">
					                        				<input type="button" class="rename" name="lv1Rename"  value="更名" onclick="<? echo 'TitleRename(\'Lv1\',\'', $row["id"] .'\',\''. $row["CategorySort"] .'\')' ?>" />
					                        				<input type="hidden" name="txtLv1Name" id="txtLv1Name-<? echo $row["id"] ?>" value="<? echo $row["CategoryName"]?>" />
					                        			</div>
					                        			<div class="divButton2"><input type="button" name="lv1Detail" value="明細"  onclick="lv2Category_load('<? echo $row["id"]?>')"/></div>
					                        		</li>
					                        	<? } ?>		
					                        	</ul>
                    						</td>
                    					</tr>
                    					<tr>
                    						<td style="text-align:center">
                    							<form id="form4" action="productCategory3.php" method="POST">
                    								<input type="hidden" name="action" class="TextBox" value="Lv1Save" />
                    								<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />
                    								<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />
	                    							<input type="hidden" name="txtLv1String" class="TextBox" id="txtLv1String" value="" />
	                    							<input type="button" name="lv1CategorySort" id="lv1CategorySort" value="儲存" onclick="return sequence_Sorttable('#sortable1','form4');" />
                    							</form>
                    						</td>
                    					</tr>
                    				</table>
                    			</td>	
                    			<td style="vertical-align:top">
                    				<table class="TableLineCategory" style="width:100%; height:510px;" cellpadding="6">
                    					<tr>
                    						<td style="vertical-align:top;">
                    							<ul id="sortable2" class="sortable" style="width:100%;display:<? echo $lv2Display ?>">
					                        	<? 	while($row2=mysql_fetch_assoc($recProductCategory2)){
					                        		if ($row2["Status"] == "1"){
					                        			$StatusDesc="停用";
					                        		}else{
					                        			$StatusDesc="啟用";
					                        		}
					                        		
					                        		if ($id2 == $row2["id"]){ 
					                        			$class = "ui-state-focus ui-priority-primary";
						                        	}else{
						                        		$class = "ui-state-default";
						                        	}
					                        	?>
					                        		<li data-id="<? echo $row2["id"] ?>" class="<? echo $class ?>">
					                        			<div class="handle divIcon">
					                        				<div class="ui-icon ui-icon-arrowthick-2-n-s"></div>
					                        			</div>
					                        			<div id="lv2Name-<? echo $row2["id"] ?>" class="divTitle">
					                        				<? echo '#'.$row2["CategorySort"] . ' - ' .$row2["CategoryName"]; ?>
					                        			</div>
					                        			<div class="divButton1">
					                        				<input type="button" class="rename" name="lv2Status" id="lv2Status-<? echo $row2["id"] ?>"  value="<? echo $StatusDesc ?>" onclick="setStatus(this,'<? echo $row2["id"] ?>','Lv2')" />
					                        				<input type="hidden" name="lv2Status" id="txtLv2Status-<? echo $row2["id"] ?>" value="<? echo $row2["Status"]?>" />
					                        			</div>
					                        			<div class="divButton1">
					                        				<input type="button" class="rename" name="lv2Rename"  value="更名" onclick="<? echo 'TitleRename(\'Lv2\',\''. $row2["id"] .'\',\''. $row2["CategorySort"] .'\')' ?>" />
					                        				<input type="hidden" name="txtLv2Name" id="txtLv2Name-<? echo $row2["id"] ?>" value="<? echo $row2["CategoryName"]?>" />
					                        			</div>
					                        			<div class="divButton2"><input type="button" name="lv2Detail" value="明細"  onclick="lv3Category_load('<? echo $id1 ?>','<? echo $row2["id"]?>')"/></div>
					                        		</li>
					                        	<? } ?>		
					                        	</ul>
                    						</td>
                    					</tr>
                    					<tr>
                    						<td style="text-align:center">
                    							<form id="form5" action="productCategory3.php" method="POST">
                    							<input type="hidden" name="action" class="TextBox" value="Lv2Save" />
                    							<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />
                    							<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />
                    							<input type="hidden" name="txtLv2String" class="TextBox" id="txtLv1String" value="" />
                    							<input type="button" name="lv2CategorySort" id="lv2CategorySort" value="儲存" style="display:<? echo $lv2Display?>"  onclick="return sequence_Sorttable('#sortable2','form5');"/>
                    							</form>
                    						</td>
                    					</tr>
                    				</table>
                    			</td>
                    			<td style="vertical-align:top">
                    				<table class="TableLineCategory" style="width:100%; height:510px;" cellpadding="6">
                    					<tr>
                    						<td style="vertical-align:top;">
                    							<ul id="sortable3" class="sortable" style="width:100%;display:<? echo $lv3Display ?>">
					                        	<?  while($row3=mysql_fetch_assoc($recProductCategory3)){
					                        		if ($row3["Status"] == "1"){
					                        			$StatusDesc="停用";
					                        		}else{
					                        			$StatusDesc="啟用";
					                        		}
					                        		
					                        		if ($id3 == $row3["id"]){ 
					                        			$class = "ui-state-focus ui-priority-primary";
						                        	}else{
						                        		$class = "ui-state-default";
						                        	}
					                        	?>
					                        		<li data-id="<? echo $row3["id"] ?>" class="<? echo $class ?>">
					                        			<div class="handle divIcon">
					                        				<div class="ui-icon ui-icon-arrowthick-2-n-s"></div>
					                        			</div>
					                        			<div id="lv3Name-<? echo $row3["id"] ?>" class="divTitle2">
					                        				<? echo '#'.$row3["CategorySort"] . ' - ' .$row3["CategoryName"]; ?>
					                        			</div>
					                        			<div class="divButton1">
					                        				<input type="button" class="rename" name="lv3Status" id="lv3Status-<? echo $row3["id"] ?>"  value="<? echo $StatusDesc ?>" onclick="setStatus(this,'<? echo $row3["id"] ?>','Lv3')" />
					                        				<input type="hidden" name="lv3Status" id="txtLv3Status-<? echo $row3["id"] ?>" value="<? echo $row3["Status"]?>" />
					                        			</div>
					                        			<div class="divButton1">
					                        				<input type="button" class="rename" name="lv3Rename"  value="更名" onclick="<? echo 'TitleRename(\'Lv3\',\''. $row3["id"] .'\',\''. $row3["CategorySort"] .'\')' ?>" />
					                        				<input type="hidden" name="txtLv3Name" id="txtLv3Name-<? echo $row3["id"] ?>" value="<? echo $row3["CategoryName"]?>" />
					                        			</div>
					                        		</li>
					                        	<? } ?>		
					                        	</ul>
                    						</td>
                    					</tr>
                    					<tr>
                    						<td style="text-align:center">
                    							<form id="form6" action="productCategory3.php" method="POST">
                    								<input type="hidden" name="action" class="TextBox" value="Lv3Save" />
                    								<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />
                    								<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />
	                    							<input type="hidden" name="txtLv3String" class="TextBox" id="txtLv1String" value="" />
	                    							<input type="button" name="lv3CategorySort" id="lv3CategorySort" value="儲存"  style="display:<? echo $lv3Display?>"  onclick="return sequence_Sorttable('#sortable3','form6');"/>
                    							</form>
                    						</td>
                    					</tr>
                    				</table>
                    			</td>
                    		</tr>
                    	</table>
                        <div style="display:none">
                    		<input type="text" id="level1" name="level1" />
                    		<input type="text" id="level2" name="level2" />
                    		<input type="text" id="level3" name="level3" />
                    	</div>
                    	<div id="dialog" title="更改名稱">
						  <p><input type="text" class="TextBox" id="txtName" name="txtName" value=""/></p>
						  <p><input type="hidden" class="TextBox" id="txtSortNo" name="txtSortNo" value="" /></p>
						  <p><input type="hidden" class="TextBox" id="txtId" name="txtId" value="" /></p>
						  <p><input type="hidden" class="TextBox" id="txtLevel" name="txtLevel" value="" /></p>
						  <p><input type="button" name="btnRename" id="btnRename" value="確認" onclick="setRename()" /></p>
						</div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<? include('_productcategorys.php'); ?>