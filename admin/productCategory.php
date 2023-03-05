<?php

include_once("_connMysql.php");

include_once("check_login.php");

include_once("css/EricChang.css");



$id1="";

$id2="";



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



if ($_POST["action"] == "addLv1"){ 

	$CategoryName = $_POST["txtLv1"];

	$check_newCategory = "SELECT COUNT(*) AS CNT FROM ProductCategory1 WHERE CategoryName = '" . $CategoryName . "'";

	$rec_newCategory = mysql_query($check_newCategory);

	$row_newCategory = mysql_fetch_assoc($rec_newCategory);

	$isExist = (int)($row_newCategory["CNT"]);

	if ($isExist == 0){

		$query_newSortNo = "SELECT IFNULL(Max(`CategorySort`),0) + 1 AS SortNo FROM ProductCategory1";

		$rec_newSortNo = mysql_query($query_newSortNo);

		$row_newSortNo = mysql_fetch_assoc($rec_newSortNo);

		$sortNo = $row_newSortNo["SortNo"];

		$CategoryName = $_POST["txtLv1"];

		$insert_newCategory = "INSERT INTO ProductCategory1 (CategorySort,CategoryName) VALUES ($sortNo,'$CategoryName')";

		mysql_query($insert_newCategory);

	} else {

		echo "<script>alert('「". $CategoryName ."」已存在! 請重新輸入!');</script>";

	}

}



if ($_POST["action"] == "addLv2"){ 

	$CategoryName = $_POST["txtLv2"];

	$check_newCategory = "SELECT COUNT(*) AS CNT FROM ProductCategory2 WHERE CategoryName = '" . $CategoryName . "'";

	$rec_newCategory = mysql_query($check_newCategory);

	$row_newCategory = mysql_fetch_assoc($rec_newCategory);

	$isExist = (int)($row_newCategory["CNT"]);

	if ($isExist == 0){

		$query_newSortNo = "SELECT IFNULL(Max(`CategorySort`),0) + 1 AS SortNo FROM ProductCategory2 WHERE ParentCategoryId = ". $id1;

		$rec_newSortNo = mysql_query($query_newSortNo);

		$row_newSortNo = mysql_fetch_assoc($rec_newSortNo);

		$sortNo = $row_newSortNo["SortNo"];

		$CategoryName = $_POST["txtLv2"];

		$insert_newCategory = "INSERT INTO ProductCategory2 (ParentCategoryId,CategorySort,CategoryName) VALUES ($id1,$sortNo,'$CategoryName')";

		mysql_query($insert_newCategory);

	} else {

		echo "<script>alert('「". $CategoryName ."」已存在! 請重新輸入!');$</script>";

	}		

}





if ($_POST["action"] == "addLv3"){ 

	$CategoryName = $_POST["txtLv3"];

	$check_newCategory = "SELECT COUNT(*) AS CNT FROM ProductCategory3 WHERE CategoryName = '" . $CategoryName . "'";

	$rec_newCategory = mysql_query($check_newCategory);

	$row_newCategory = mysql_fetch_assoc($rec_newCategory);

	$isExist = (int)($row_newCategory["CNT"]);

	if ($isExist == 0){

		$query_newSortNo = "SELECT IFNULL(Max(`CategorySort`),0) + 1 AS SortNo FROM ProductCategory3 WHERE ParentCategoryId = ". $id2;

		$rec_newSortNo = mysql_query($query_newSortNo);

		$row_newSortNo = mysql_fetch_assoc($rec_newSortNo);

		$sortNo = $row_newSortNo["SortNo"];

		$CategoryName = $_POST["txtLv3"];

		$insert_newCategory = "INSERT INTO ProductCategory3 (ParentCategoryId,CategorySort,CategoryName) VALUES ($id2,$sortNo,'$CategoryName')";

		mysql_query($insert_newCategory);

	} else {

		echo "<script>alert('「". $CategoryName ."」已存在! 請重新輸入!');$</script>";

	}

}



if ($_POST["action"] == "Lv1Save"){ 

	//CategorySort +','+CategoryName+','+CategoryStatus+','+id;

	$dataString = explode(';', $_POST["txtLv1String"]);

	for ($i = 0; $i < count($dataString); $i++) {

		$update_Category1 = "";

		$valueString = explode(',', $dataString[$i]);

		$update_Category1 = "UPDATE ProductCategory1 SET CategorySort=".$valueString[0].",CategoryName='". $valueString[1] ."',Status=" . $valueString[2] . " WHERE id = ". $valueString[3] ;

		//echo $update_Category1."<br />";

		mysql_query($update_Category1);

	}	

}



if ($_POST["action"] == "Lv2Save"){ 

	$dataString = explode(';', $_POST["txtLv2String"]);

	for ($i = 0; $i < count($dataString); $i++) {

		$update_Category = "";

		$valueString = explode(',', $dataString[$i]);

		$update_Category = "UPDATE ProductCategory2 SET CategorySort=".$valueString[0].",CategoryName='". $valueString[1] ."',Status=" . $valueString[2] . " WHERE id = ". $valueString[3] ;

		mysql_query($update_Category);

	}	

}



if ($_POST["action"] == "Lv3Save"){ 

	$dataString = explode(';', $_POST["txtLv3String"]);

	for ($i = 0; $i < count($dataString); $i++) {

		$update_Category = "";

		$valueString = explode(',', $dataString[$i]);

		$update_Category = "UPDATE ProductCategory3 SET CategorySort=".$valueString[0].",CategoryName='". $valueString[1] ."',Status=" . $valueString[2] . " WHERE id = ". $valueString[3] ;

		mysql_query($update_Category);

	}

}



if ($_POST["action"] == "moveLv2"){ 

	$pc1 = $_POST["Level1"];

	$inString = $_POST["txtLv2Move"];

	$update_moveCategory = "UPDATE ProductCategory2 SET ParentCategoryId = ". $pc1 ." WHERE id IN (".$inString.")";

	//echo $update_moveCategory;

	mysql_query($update_moveCategory);

}



if ($_POST["action"] == "moveLv3"){ 

	$pc2 = $_POST["pc2"];

	$inString = $_POST["txtLv3Move"];

	$update_moveCategory = "UPDATE ProductCategory3 SET ParentCategoryId = ". $pc2 ." WHERE id IN (".$inString.")";

	//echo $update_moveCategory;

	mysql_query($update_moveCategory);

}

if ($_POST["action"] == "deleteLv1"){

	$CategoryId = $_POST["txtLv1Delete"];

	$query_LvCount = "SELECT COUNT(*) AS CNT FROM ProductCategory2 WHERE ParentCategoryId = ". $CategoryId;

	$rec_LvCount = mysql_query($query_LvCount);

	$row_LvCount = mysql_fetch_assoc($rec_LvCount);

	$LvCount = $row_LvCount["CNT"];

	//echo "lvCount=".$LvCount;



	if ($LvCount > 0){

		echo "<script>alert('「大分類」下關連 ". $LvCount ." 筆「中分類」，不得刪除!')</script>";

	}else{

		$rec_CategoryIdInUse = mysql_query("SELECT * FROM ProductsCategorys WHERE CategoryID IN (SELECT P3.id FROM ProductCategory1 P1, ProductCategory2 P2, ProductCategory3 P3 WHERE P1.id = '$CategoryId' and P2.ParentCategoryId = P1.id and P3.ParentCategoryId = P2.id)");

		$count_CategoryIdInUse = $rec_CategoryIdInUse ? mysql_num_rows($rec_CategoryIdInUse) : 0;

		if($count_CategoryIdInUse > 0){

			echo "<script>alert('此「大分類」下關連 ". $count_CategoryIdInUse ." 筆商品，不得刪除!')</script>";

		}else{

			$delete_Category = "DELETE FROM ProductCategory1 WHERE id = ". $CategoryId;

			//echo $delete_Category;

			mysql_query($delete_Category);

		}

	}

}

if ($_POST["action"] == "deleteLv2"){ 

	$CategoryId = $_POST["txtLv2Delete"];

	$query_LvCount = "SELECT COUNT(*) AS CNT FROM ProductCategory2 WHERE ParentCategoryId = ". $CategoryId;

	$rec_LvCount = mysql_query($query_LvCount);

	$row_LvCount = mysql_fetch_assoc($rec_LvCount);

	$LvCount = $row_LvCount["CNT"];

	//echo "lvCount=".$LvCount;

	if ($LvCount > 0){

		echo "<script>alert('「中分類」下關連 ". $LvCount ." 筆「小分類」，不得刪除!')</script>";

	}else{

		$rec_CategoryIdInUse = mysql_query("SELECT * FROM ProductsCategorys WHERE CategoryID IN (SELECT P3.id FROM ProductCategory2 P2, ProductCategory3 P3 WHERE P2.id = '$CategoryId' and P3.ParentCategoryId = P2.id)");

		$count_CategoryIdInUse = $rec_CategoryIdInUse ? mysql_num_rows($rec_CategoryIdInUse) : 0;

		if($count_CategoryIdInUse > 0){

			echo "<script>alert('此「中分類」下關連 ". $count_CategoryIdInUse ." 筆商品，不得刪除!')</script>";

		}else{

			$delete_Category = "DELETE FROM ProductCategory2 WHERE id = ". $CategoryId;

			//echo $delete_Category;

			mysql_query($delete_Category);

		}

	}

}

if ($_POST["action"] == "deleteLv3"){ 

	$CategoryId = $_POST["txtLv3Delete"];

	$rec_CategoryIdInUse = mysql_query("SELECT * FROM ProductsCategorys WHERE CategoryID IN (SELECT P3.id FROM ProductCategory3 P3 WHERE  P3.id = '$CategoryId')");

	$count_CategoryIdInUse = $rec_CategoryIdInUse ? mysql_num_rows($rec_CategoryIdInUse) : 0;

	if($count_CategoryIdInUse > 0){

		echo "<script>alert('此「小分類」下關連 ". $count_CategoryIdInUse ." 筆商品，不得刪除!')</script>";

	}else{

		$delete_Category = "DELETE FROM ProductCategory3 WHERE id = ". $CategoryId;

		mysql_query($delete_Category);

	}

}

if ($_POST["action"] == "RenameSave"){ 	$Level = $_POST["txtReNameLv"];	$CategoryName = $_POST["txtReName"];	$CategoryId = $_POST["txtRenameId"];		switch ($Level){		case "Lv1":			$check_newCategory = "SELECT COUNT(*) AS CNT FROM ProductCategory1 WHERE CategoryName = '" . $CategoryName . "'";			$update_Category = "UPDATE ProductCategory1 SET CategoryName='". $CategoryName ."' WHERE id = ". $CategoryId ;			break;		case "Lv2":			$check_newCategory = "SELECT COUNT(*) AS CNT FROM ProductCategory2 WHERE CategoryName = '" . $CategoryName . "'";			$update_Category = "UPDATE ProductCategory1 SET CategoryName='". $CategoryName ."' WHERE id = ". $CategoryId ;			break;		case "Lv3":			$check_newCategory = "SELECT COUNT(*) AS CNT FROM ProductCategory3 WHERE CategoryName = '" . $CategoryName . "'";			$update_Category = "UPDATE ProductCategory1 SET CategoryName='". $CategoryName ."' WHERE id = ". $CategoryId ;			break;	}	$rec_newCategory = mysql_query($check_newCategory);		$row_newCategory = mysql_fetch_assoc($rec_newCategory);		$isExist = (int)($row_newCategory["CNT"]);		if ($isExist == 0){		mysql_query($update_Category);	} else {		echo "<script>alert('「". $CategoryName ."」已存在! 請重新輸入!');</script>";	}}



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

	$query_productCategory1 = "SELECT * FROM ProductCategory1 ORDER BY CategorySort";

	$recProductCategory1 = mysql_query($query_productCategory1);

	

	$lv2Display = "none";

	if ($id1 !="")

	{

		$lv2Display = "";

		$query_productCategory2 = "SELECT * FROM ProductCategory2 WHERE ParentCategoryId= ". $id1 ." ORDER BY CategorySort";

		$recProductCategory2 = mysql_query($query_productCategory2);

	}

	

	$lv3Display = "none";

	if ($id2 != ""){

		$lv3Display = "";		

		$query_productCategory3 = "SELECT * FROM ProductCategory3 WHERE ParentCategoryId= ". $id2 ."  ORDER BY CategorySort";

		$recProductCategory3 = mysql_query($query_productCategory3);

	}

	

}else{

	$lv2Display = "none";

	$lv3Display = "none";



	$query_productCategory1 = "SELECT * FROM ProductCategory1 ORDER BY CategorySort";

	$recProductCategory1 = mysql_query($query_productCategory1);

	

	//$query_productCategory2 = "SELECT * FROM ProductCategory2 WHERE ParentCategoryId=".$id1." ORDER BY CategorySort";

	//$recProductCategory2 = mysql_query($query_productCategory2);

	

	//$query_productCategory3 = "SELECT * FROM ProductCategory3 WHERE ParentCategoryId=". $id2 ." ORDER BY CategorySort";

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

    <link href="css/EricChang.css" type="text/css" rel="stylesheet" />

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

            var defaultHeight = bodyHeight - 210;

            var Lv1Height = $("#sortable1").height();

            var Lv2Height = $("#sortable2").height();

            var Lv3Height = $("#sortable3").height();

            var MaxLv;

            if (Lv1Height > Lv2Height){

            	MaxLv = Lv1Height + 210;

            } else {

            	MaxLv = Lv2Height + 210;

            }

            if (MaxLv < Lv3Height){

            	MaxLv = Lv3Height + 210;

            }

            if (MaxLv > defaultHeight){

        		defaultHeight = MaxLv + 60;

    		}



            

            $("#divDetailBody").attr("style", "height:" + defaultHeight + "px;width:100%");

            //$("#divDetailBody").attr("style", "width:99.4%");

            $("#divWork").attr("style", "float: left;width: 90%;");

            

            $("input[type=submit], input[type=button]" ).button();

           

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

			

			function alertMessage(strMessage){

				alert(strMessage);

			}

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

        	$("#dialog").dialog( "open" );

        }

        

        function setRename(){

        	var id= $("#txtId").val();

        	var sortNo = $("#txtSortNo").val();

        	var cname = $("#txtName").val();

        	var level = $("#txtLevel").val();

        	var labelId = "";

        	var txtId = "";

        	var form = "";

        	switch (level){

        		case "Lv1":	

        			labelId = '#lv1Name-'+id;

        			txtId = '#txtLv1Name-'+id;										txtRenameId = "#txtRenameId1";										txtRename = "#txtReName1";										action = '#Lv1Save';					        			form = "form4";

        			break;

        		case "Lv2":	

        			labelId = '#lv2Name-'+id;

        			txtId = '#txtLv2Name-'+id;										txtRenameId = "#txtRenameId2";										txtRename = "#txtReName2";										action = '#Lv2Save';

        			form = "form5";

        			break;

        		case "Lv3":	

        			labelId = '#lv3Name-'+id;

        			txtId = '#txtLv3Name-'+id;										txtRenameId = "#txtRenameId3";										txtRename = "#txtReName3";										action = '#Lv3Save';

        			form = "form6";

        			break;

        	}

        	$(labelId).html("&nbsp;&nbsp;#"+sortNo+" - "+cname);

        	$(txtId).val(cname);						$(txtRenameId).val(id);			$(txtRename).val(cname);			$(action).val('RenameSave');			        	$("#dialog").dialog( "close" );						$("#"+form).submit();			

        	        }

        

        function setStatus(id,level,selector,form){

        	var statusVal = "";

        	switch (level){

        		case "Lv1":	

        			labelId = '#lv1Status-'+id;

        			txtId = '#txtLv1Status-'+id;

        			statusVal = $("#txtLv1Status-"+id).val();

        			break;

        		case "Lv2":	

        			labelId = '#lv2Status' +'-'+id;

        			txtId = '#txtLv2Status-'+id;

        			statusVal = $("#txtLv2Status-"+id).val();

        			break;

        		case "Lv3":	

        			labelId = '#lv3Status' +'-'+id;

        			txtId = '#txtLv3Status-'+id;

        			statusVal = $("#txtLv3Status-"+id).val();

        			break;

        	}

        	if (statusVal == "0"){

        		//$(labelId).val("停用");

        		$(txtId).val("1");

        	}else{

        		//$(labelId).val("啟用");

        		$(txtId).val("0");

        	}

        	

        	sequence_Sorttable(selector,form);

		}

		

		function delItem(id,level,form){

			var blnValidate = false;

			var lvName = "";

        	switch (level){

        		case "Lv1":	

        			lvName = $("#txtLv1Name-"+id).val();

        			if (confirm('確定刪除分類「'+lvName +'」嗎?!')){

        				$("#txtLv1Delete").val(id);

        				$("#Lv1Save").val("deleteLv1");

        				blnValidate=true;

        			}

        			break;

        		case "Lv2":	

        			lvName = $("#txtLv2Name-"+id).val();

        			if (confirm('確定刪除分類「'+lvName +'」嗎?!')){

        				$("#txtLv2Delete").val(id);

        				$("#Lv2Save").val("deleteLv2");

        				blnValidate=true;

        			}

        			break;

        		case "Lv3":	

        			lvName = $("#txtLv3Name-"+id).val();

        			if (confirm('確定刪除分類「'+lvName +'」嗎?!')){

        				$("#txtLv3Delete").val(id);

        				$("#Lv3Save").val("deleteLv3");

        				blnValidate=true;

        			}

        			break;

        	}

        	if (blnValidate){

				$("#"+form).submit();

			}

		}

	

		function lv2Category_load(id1){

			location.href= 'productCategory.php?id1='+id1;			

		}

		

		function lv3Category_load(id1,id2){

			location.href= 'productCategory.php?id1='+id1+'&id2='+id2;	

		}

		

		function sequence_Sorttable(selector,form){

			var CategoryString = "";

			var CategorySort = 0;

			var CategoryName = "";

			var CategoryStatus = "";

			var id= "";

			$(selector + " li").each(function(index, element) {

				CategorySort = CategorySort = CategorySort + 1;

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

						blnValidate = true;

					}

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

								blnValidate = true;

							}

							break;

						case "btnLv2Move":

							var Lv2Move = $("#txtLv2Move").val();

							if (Lv2Move == ""){

								alert("請先選擇被搬移的項目!");

							}else{

								var strLv1 = $("#Level1 :selected").text();

								if (confirm('確定將所選項目搬移至「'+strLv1+'」嗎?!')){

									$("#lv2Action").val("moveLv2");	

									blnValidate = true;

								}

							}

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

								blnValidate = true;	

							}	

							break;

						case "btnLv3Move":

							var Lv3Move = $("#txtLv3Move").val();

							if (Lv3Move == ""){

								alert("請先選擇被搬移的項目!");

							}else{

								var strLv1 = $("#pc1 :selected").text();

								var strLv2 = $("#pc2 :selected").text();

								if (confirm('確定將所選項目搬移至「'+strLv1+'->'+ strLv2 +'」嗎?!')){

									$("#lv3Action").val("moveLv3");	

									blnValidate = true;

								}

							}

							break;	

					}

					break;

			}

			if (blnValidate){

				$("#"+form).submit();

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

		.sortable li { margin: 0 3px 0px 0px; padding: 0.4em; font-size: 1.2em; height: 22px; }

		.sortable li span { position: absolute; margin-left: -1.3em; margin-top:4px; }

		.sortable li .divIcon 		{ position: relative; display: inline-block; float:left;height:20px; padding-top:2px;}

		.sortable li .divTitle 		{ position: relative; display: inline-block; float:left;height:25px; width:46%; }

		.sortable li .divTitle2 	{ position: relative; display: inline-block; float:left;height:25px; width:54%; }

		.sortable li .divButton1 	{ position: relative; display: inline-block; float:left;height:25px; }

		.sortable li .divButton2 	{ position: relative; display: inline-block; float:left;height:25px; }

		.sortable li .handle {cursor:pointer}

		.ui-selecting { background: #eee; }

		.ui-selecting .handle { background: #ddd; }

		.ui-selected {   font-weight: bold; color:Red }

		.ui-selected .handle {  }

		.hightlight

		{

		    background: #d3e5d3;

		}

    </style>

</head>

<body>

    <div id="divBody" style="width:1600px; margin: 0 auto; ">

		<!-- 加上方選單 -->

		<?php include_once("_nav.php"); ?>

        <div style="overflow: hidden;">

			<!-- 加左方選單 -->

			<?php include_once("left_nav.php"); ?>

            <div id="divWork" style="float: left; width: 90%;">

                <div class="divWorkArea">

                    <div id="UpdatePanel1">

                        <div id="divDetailBody" class="divDetailBody">

                        <table cellpadding="0" cellspacing="0" width="100%">

                          <tr>

                            <td width="25%" height="10"></td>

                            <td width="75%"></td>

                          </tr>

                          <tr>

                            <td align="left" colspan="2">

                            	<span class="orange_15_de5106"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ 操作說明</b></span><br/>

                            </td>

                          </tr>

                          <tr>

                            <td align="left">

                            	<span class="orange_13_de5106">　　﹝上下排序﹞</span><br/>

                                <span class="orange_13_de5106">　　　1. 滑鼠左鍵按住「↕」符號可上下移動排序。</span><br/>

                                <span class="orange_13_de5106">　　　2. 完成移動後，請按下儲存按鈕。</span><br/>

                                <br/>

                            </td>

                            <td align="left">

                            	<span class="orange_13_de5106">﹝改變上層掛載分類﹞</span><br/>

                                <span class="orange_13_de5106">&nbsp;&nbsp;&nbsp;&nbsp;1. 欲改變上層掛載分類時，請先選擇同分類項目，可用滑鼠圈選範圍或用「Ctrl」鍵複選。(選定項目文字為紅色)</span><br/>

                                <span class="orange_13_de5106">&nbsp;&nbsp;&nbsp;&nbsp;2. 選擇新的上層掛載項目下拉選單之後，按下搬移按鈕完成儲存。</span><br/>

                                <br/>

                            </td>

                          </tr>

                        </table>

                        

                    	<table class="TableNoLine" style="width:100%;margin: 0 auto;" >

                    		<tr>

                    			<td style="width:33%;vertical-align:top;">

                    				<form id="form1" name="form1" action="productCategory.php" method="POST">

                    				<table class="TableLineCategory" style="width:100%; height:80px" cellpadding="4" cellspacing="0">

                    					<tr>

                    						<td style="text-align:right; vertical-align:top; padding-top:6px;"><span class="b_16"><b>大分類：</b></span></td>

                    						<td style="vertical-align:top"><input type="text" class="TextBox" name="txtLv1" id="txtLv1" value="" style="width:98%" /></td>

                    						<td style="vertical-align:top"><input type="button" name="btnLv1Add" id="btnLv1Add" value="新增" onclick="setActionSubmit('form1','btnLv1Add')" /></td>

                    					</tr>

                    					<tr>

                    						<td colspan="3"></td>

                    					</tr>

                    				</table>

                    				<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />

                    				<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />

                    				<input type="hidden" id="lv1Action" name="action" class="TextBox" value="" />

                    				</form>

                    			</td>	

                    			<td style="width:33%;vertical-align:top">

                    				<form id="form2" name="form2" action="productCategory.php" method="POST">

                    				<table class="TableLineCategory" style="width:100%; height:80px" cellpadding="4" cellspacing="0">

                    					<tr>

                    						<td style="text-align:right; vertical-align:top; padding-top:6px;"><span class="b_16"><b><div style="display:<? echo $lv2Display ?>">中分類：</div></b></span></td>

                    						<td><input type="text" class="TextBox" name="txtLv2" id="txtLv2" value="" style="width:98%;display:<? echo $lv2Display ?>" /></td>

                    						<td><input type="button" name="lv1Category" id="btnLv2Add" value="新增" style="display:<? echo $lv2Display ?>" onclick="setActionSubmit('form2','btnLv2Add')" /></td>

                    					</tr>

                    					<tr>

                    						<td></td>

                    						<td>

                    							<select name="Level1" id="Level1" class="dropdownlist" onChange="ProductCagegory1_SelectOnChange('Level1')" style="display:<? echo $lv2Display ?>"></select>

                    							<input type="hidden" class="TextBox" name="txtLv2Move" id="txtLv2Move" value="" />

                    						</td>

                    						<td style="text-align:left"><input type="button" name="btnLv2Move" id="btnLv2Move" value="搬移至大分類" style="display:<? echo $lv2Display ?>" onclick="setActionSubmit('form2','btnLv2Move')" /></td>

                    					</tr>

                    				</table>

                    				<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />

                    				<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />

                    				<input type="hidden" id="lv2Action" name="action" class="TextBox" value="" />

                    				</form>

                    			</td>

                    			<td style="width:34%;vertical-align:top">

                    				<form id="form3" action="productCategory.php" method="POST">

                    				<table class="TableLineCategory" style="width:100%; height:80px;" cellpadding="4" cellspacing="0">

                    					<tr>

                                            <td style="text-align:right; vertical-align:top; padding-top:6px;"><span class="b_16"><b><div style="display:<? echo $lv3Display ?>">小分類：</div></b></span></td>

                    						<td><input type="text" class="TextBox" name="txtLv3" id="txtLv3" value="" style="width:98%;display:<? echo $lv3Display?>" /></td>

                    						<td><input type="button" name="lv1Category" id="btnLv3Add" value="新增" style="display:<? echo $lv3Display?>" onclick="setActionSubmit('form3','btnLv3Add')" /></td>

                    					</tr>

                    					<tr>

                    						<td></td>

                    						<td>

                    							<select name="pc1" id="pc1" class="dropdownlist" onChange="ProductCagegory1_SelectOnChange(this.value,'pc2','')" style="display:<? echo $lv3Display?>"></select>

                    							<select name="pc2" id="pc2" class="dropdownlist" style="display:<? echo $lv3Display?>"></select>

                    							<input type="hidden" class="TextBox" name="txtLv3Move" id="txtLv3Move" value="" />

                    						</td>

                                            <td style="text-align:left"><input type="button" name="btnLv3Move" id="btnLv3Move" value="搬移至中分類" style="display:<? echo $lv3Display?>" onclick="setActionSubmit('form3','btnLv3Move')" /></td>

                    					</tr>

                    				</table>

                    				<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />

                    				<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />

                    				<input type="hidden" id="lv3Action" name="action" class="TextBox" value="" />

                    				</form>

                    			</td>

                    		</tr>

                    		<tr>

                    			<td style="vertical-align:top;">

                    				<table class="TableLineCategory" style="width:100%;" cellpadding="6">

                    					<tr>

                    						<td style="vertical-align:top;">

                    							<ul id="sortable1" class="sortable" style="width:100%">

					                        	<?  while($row=mysql_fetch_assoc($recProductCategory1)){

					                        		if ($row["Status"] == "1"){

					                        			$StatusDesc="O";

					                        		}else{

					                        			$StatusDesc="X";

					                        		}

					                        		

					                        		if ($id1 == $row["id"]){ 

					                        			$class = "ui-state-focus ui-priority-primary hightlight";

						                        	}else{

						                        		$class = "ui-state-default";

						                        	}

					                        	?>

					                        		<li data-id="<? echo $row["id"] ?>" class="<? echo $class ?>">

					                        			

					                        			<div class="handle divIcon">

					                        				<div class="ui-icon ui-icon-arrowthick-2-n-s"></div>

					                        			</div>

					                        			<div id="lv1Name-<? echo $row["id"] ?>" class="divTitle">

					                        				<? echo '&nbsp;&nbsp;#'.str_pad($row["CategorySort"], 2, "0", STR_PAD_LEFT).' - '.$row["CategoryName"]; ?>

					                        			</div>

					                        			<div class="divButton1">

					                        				<input type="button" class="rename" name="lv1Status" id="lv1Status-<? echo $row["id"] ?>"  value="<? echo $StatusDesc ?>" onclick="setStatus('<? echo $row["id"] ?>','Lv1','#sortable1','form4')" />

					                        				<input type="hidden" name="lv1Status" id="txtLv1Status-<? echo $row["id"] ?>" value="<? echo $row["Status"]?>" />

					                        			</div>

					                        			<div class="divButton1">

					                        				<input type="button" class="rename" name="lv1Rename"  value="修改" onclick="<? echo 'TitleRename(\'Lv1\',\'', $row["id"] .'\',\''. $row["CategorySort"] .'\')' ?>" />

					                        				<input type="hidden" name="txtLv1Name" id="txtLv1Name-<? echo $row["id"] ?>" value="<? echo $row["CategoryName"]?>" />

					                        			</div>

                                                        <div class="divButton1">

					                        				<input type="button" class="rename" name="lv1Delete" id="lv1Delete"  value="刪除" onclick="delItem('<? echo $row["id"] ?>','Lv1','form4')" />

					                        			</div>

					                        			<div class="divButton2">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="lv1Detail" value="➜"  onclick="lv2Category_load('<? echo $row["id"]?>')"/></div>

					                        		</li>

					                        	<? } ?>		

					                        	</ul>

                    						</td>

                    					</tr>

                    					<tr>

                    						<td style="text-align:left" valign="top">

                    							<form id="form4" action="productCategory.php" method="POST">

                    								<input type="hidden" name="action" class="TextBox" value="Lv1Save" id="Lv1Save" />

                    								<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />

                    								<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />

                    								<input type="hidden" name="txtLv1Delete" id="txtLv1Delete" class="TextBox" value="" />

	                    							<input type="hidden" name="txtLv1String" class="TextBox" id="txtLv1String" value="" />													<input type="hidden" name="txtReNameLv" id="txtReNameLv" value="Lv1" />													<input type="hidden" name="txtRenameId" class="TextBox" id="txtRenameId1" value="" />													<input type="hidden" name="txtReName" id="txtReName1" value="" />

	                    							<input type="button" name="lv1CategorySort" id="lv1CategorySort" value="儲存大分類排序" onclick="return sequence_Sorttable('#sortable1','form4');" style="height:36px; width:140px;"/>

                    							</form>

                    						</td>

                    					</tr>

                    				</table>

                    			</td>	

                    			<td style="vertical-align:top">

                    				<table id="tbSortable2" class="TableLineCategory" style="width:100%;" cellpadding="6">

                    					<tr>

                    						<td style="vertical-align:top;">

                    							<ul id="sortable2" class="sortable" style="width:100%; display:<? echo $lv2Display ?>">

					                        	<? 	while($row2=mysql_fetch_assoc($recProductCategory2)){

					                        		if ($row2["Status"] == "1"){

					                        			$StatusDesc="O";

					                        		}else{

					                        			$StatusDesc="X";

					                        		}

					                        		

					                        		if ($id2 == $row2["id"]){ 

					                        			$class = "ui-state-focus ui-priority-primary hightlight";

						                        	}else{

						                        		$class = "ui-state-default";

						                        	}

					                        	?>

					                        		<li data-id="<? echo $row2["id"] ?>" class="<? echo $class ?>">

					                        			<div class="handle divIcon">

					                        				<div class="ui-icon ui-icon-arrowthick-2-n-s"></div>

					                        			</div>

					                        			<div id="lv2Name-<? echo $row2["id"] ?>" class="divTitle">

					                        				<? echo '&nbsp;&nbsp;#'.str_pad($row2["CategorySort"], 2, "0", STR_PAD_LEFT).' - '.$row2["CategoryName"]; ?>

					                        			</div>

                                                        <div class="divButton1">

					                        				<input type="button" class="rename" name="lv2Status" id="lv2Status-<? echo $row2["id"] ?>"  value="<? echo $StatusDesc ?>" onclick="setStatus('<? echo $row2["id"] ?>','Lv2','#sortable2','form5')" />

					                        				<input type="hidden" name="lv2Status" id="txtLv2Status-<? echo $row2["id"] ?>" value="<? echo $row2["Status"]?>" />

					                        			</div>

					                        			<div class="divButton1">

					                        				<input type="button" class="rename" name="lv2Rename"  value="修改" onclick="<? echo 'TitleRename(\'Lv2\',\''. $row2["id"] .'\',\''. $row2["CategorySort"] .'\')' ?>" />

					                        				<input type="hidden" name="txtLv2Name" id="txtLv2Name-<? echo $row2["id"] ?>" value="<? echo $row2["CategoryName"]?>" />

					                        			</div>

                                                        <div class="divButton1">

					                        				<input type="button" class="rename" name="lv2Delete" id="lv2Delete"  value="刪除" onclick="delItem('<? echo $row2["id"] ?>','Lv2','form5')" />

					                        			</div>

					                        			<div class="divButton2">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="lv2Detail" value="➜"  onclick="lv3Category_load('<? echo $id1 ?>','<? echo $row2["id"]?>')"/></div>

					                        		</li>

					                        	<? } ?>		

					                        	</ul>

                    						</td>

                    					</tr>

                    					<tr>

                    						<td style="text-align:left" valign="top">

                    							<form id="form5" action="productCategory.php" method="POST">

                    							<input type="hidden" name="action" class="TextBox" value="Lv2Save"  id="Lv2Save"/>

                    							<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />

                    							<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />

                    							<input type="hidden" name="txtLv2Delete" id="txtLv2Delete" class="TextBox" value="" />

                    							<input type="hidden" name="txtLv2String" class="TextBox" id="txtLv2String" value="" />												<input type="hidden" name="txtReNameLv" id="txtReNameLv" value="Lv2" />												<input type="hidden" name="txtRenameId" class="TextBox" id="txtRenameId2" value="" />												<input type="hidden" name="txtReName" id="txtReName2" value="" />

                    							<input type="button" name="lv2CategorySort" id="lv2CategorySort" value="儲存中分類排序" style="display:<? echo $lv2Display?>; height:36px; width:140px;"  onclick="return sequence_Sorttable('#sortable2','form5');"/>

                    							</form>

                    						</td>

                    					</tr>

                    				</table>

                    			</td>

                    			<td style="vertical-align:top">

                    				<table id="tbSortable3" class="TableLineCategory" style="width:100%;" cellpadding="6">

                    					<tr>

                    						<td style="vertical-align:top;">

                    							<ul id="sortable3" class="sortable" style="width:100%;display:<? echo $lv3Display ?>">

					                        	<?  while($row3=mysql_fetch_assoc($recProductCategory3)){

					                        		if ($row3["Status"] == "1"){

					                        			$StatusDesc="O";

					                        		}else{

					                        			$StatusDesc="X";

					                        		}

					                        		

					                        		if ($id3 == $row3["id"]){ 

					                        			$class = "ui-state-focus ui-priority-primary hightlight";

						                        	}else{

						                        		$class = "ui-state-default";

						                        	}

					                        	?>

					                        		<li data-id="<? echo $row3["id"] ?>" class="<? echo $class ?>">

					                        			<div class="handle divIcon">

					                        				<div class="ui-icon ui-icon-arrowthick-2-n-s"></div>

					                        			</div>

					                        			<div id="lv3Name-<? echo $row3["id"] ?>" class="divTitle2">

					                        				<? echo '&nbsp;&nbsp;#'.str_pad($row3["CategorySort"], 2, "0", STR_PAD_LEFT).' - '.$row3["CategoryName"]; ?>

					                        			</div>

					                        			<div class="divButton1">

					                        				<input type="button" class="rename" name="lv3Status" id="lv3Status-<? echo $row3["id"] ?>"  value="<? echo $StatusDesc ?>" onclick="setStatus('<? echo $row3["id"] ?>','Lv3','#sortable3','form6')" />

					                        				<input type="hidden" name="lv3Status" id="txtLv3Status-<? echo $row3["id"] ?>" value="<? echo $row3["Status"]?>" />

					                        			</div>

					                        			<div class="divButton1">

					                        				<input type="button" class="rename" name="lv3Rename"  value="修改" onclick="<? echo 'TitleRename(\'Lv3\',\''. $row3["id"] .'\',\''. $row3["CategorySort"] .'\')' ?>" />

					                        				<input type="hidden" name="txtLv3Name" id="txtLv3Name-<? echo $row3["id"] ?>" value="<? echo $row3["CategoryName"]?>" />

					                        			</div>

					                        			<div class="divButton1">

					                        				<input type="button" class="rename" name="lv3Delete" id="lv3Delete"  value="刪除" onclick="delItem('<? echo $row3["id"] ?>','Lv3','form6')" />

					                        			</div>

					                        		</li>

					                        	<? } ?>		

					                        	</ul>

                    						</td>

                    					</tr>

                    					<tr>

                    						<td style="text-align:left" valign="top">

                    							<form id="form6" action="productCategory.php" method="POST">

                    								<input type="hidden" name="action" class="TextBox" value="Lv3Save"  id="Lv3Save"/>

                    								<input type="hidden" name="id1" class="TextBox" value="<? echo $id1 ?>" />

                    								<input type="hidden" name="id2" class="TextBox" value="<? echo $id2 ?>" />

                    								<input type="hidden" name="txtLv3Delete" id="txtLv3Delete" class="TextBox" value="" />

	                    							<input type="hidden" name="txtLv3String" class="TextBox" id="txtLv3String" value="" />													<input type="hidden" name="txtReNameLv" id="txtReNameLv" value="Lv3" />													<input type="hidden" name="txtRenameId" class="TextBox" id="txtRenameId3" value="" />													<input type="hidden" name="txtReName" id="txtReName3" value="" />

	                    							<input type="button" name="lv3CategorySort" id="lv3CategorySort" value="儲存小分類排序"  style="display:<? echo $lv3Display?>; height:36px; width:140px;"  onclick="return sequence_Sorttable('#sortable3','form6');"/>

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

<!--<p style="height:100px"></p>	-->

</body>

</html>

<? include_once('_productcategorys.php'); ?>

