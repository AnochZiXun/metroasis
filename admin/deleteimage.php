<?
include('_connMysql.php');

$imageid = $_GET["imgid"];
$ImageFile_Sql_Delete = "DELETE FROM ImagesFiles WHERE ImageID = " . $imageid;
//echo $ImageFile_Sql_Delete;
mysql_query($ImageFile_Sql_Delete);

$strSql = "SELECT COUNT(*) as CNT FROM ImagesFiles WHERE ImageID = " . $imageid;
//echo $strSql;
$rec = mysql_query($strSql);
$row = mysql_fetch_assoc($rec);

$cnt = $row["CNT"];

if ($cnt == "0"){
	echo "1";
}else{
	echo "-1";
}
?>