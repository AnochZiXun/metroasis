<?php 
include_once('_connMysql.php');

$optionals = array();

$lv = $_REQUEST["lv"];
$lvId = $_REQUEST["lvId"];

switch($lv){
	case "2":
		$strSql = "SELECT id, CategoryName FROM ProductCategory2 WHERE ParentCategoryId = '$lvId' ORDER BY CategorySort";
		break;
	case "3":
		$strSql = "SELECT id, CategoryName FROM ProductCategory3 WHERE ParentCategoryId = '$lvId' ORDER BY CategorySort";
		break;
}
$getNextLvRec = mysql_query($strSql);
while ($nextLvResult = mysql_fetch_assoc($getNextLvRec)) {
	array_push($optionals, $nextLvResult['id']."，".$nextLvResult['CategoryName']);
}

echo implode("＃",$optionals);
?>