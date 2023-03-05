<?
include_once("_connMysql.php");
include_once('mycrypt.php');
$mycrypt = new mycrypt;

if(isset($_GET["table"]) && isset($_GET["column"])){
	$table = $_GET["table"];
	$column = $_GET["column"];
	$rec = mysql_query("SELECT $column FROM $table");
	if($rec){
		while($row = mysql_fetch_assoc($rec)){
			mysql_query("UPDATE $table SET $column = '". $mycrypt->encrypt($row["$column"]). "' WHERE $column = '". $row["$column"] . "'");
		}
	}
}

?>