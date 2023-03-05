<?
session_start();
include('_connMysql.php');

if(!isset($_SESSION["CustomerID"])){
	echo 'login';
} else{
	$activityId = $_POST["activityId"];
	$category = $_POST["category"];
	switch($category){
		case "1":
			$likes = mysql_fetch_row(mysql_query("SELECT Likes FROM ActivityNight WHERE ActivityNightID = '$activityId'"))[0];
			$likes++;
			mysql_query("UPDATE ActivityNight SET Likes = '$likes' where ActivityNightID = '$activityId'");
    		break;
  		case "2":
    		$likes = mysql_fetch_row(mysql_query("SELECT Likes FROM ActivityClass WHERE ActivityClassID = '$activityId'"))[0];
    		$likes++;
    		mysql_query("UPDATE ActivityClass SET Likes = '$likes' where ActivityClassID = '$activityId'");
    		break;
  		default:
    		$likes = 0;
    		break;
	}
	echo $likes;
}
?>