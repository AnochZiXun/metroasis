<?php
include_once("_connMysql.php");
$action = $_GET["action"];
switch($action){
	case "simpleDuplicateCheck":
		$table = $_GET["table"];
		$column = $_GET["column"];
		$value = $_GET["value"];
		$idColumn = $_GET["idColumn"];
		$id = $_GET["id"];
		$rec = mysql_query("SELECT * FROM $table WHERE $idColumn != '$id' AND $column = '$value'");
		$count = $rec ? mysql_num_rows($rec) : 0 ;
		echo $count > 0 ? json_encode(false) : json_encode(true);
		break;
	default:
		break;
}
?>