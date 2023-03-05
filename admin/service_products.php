<?
include_once('_connMysql.php');

$createUserID = $_GET['CreateUserID'];

switch ($_GET['action']) {
    case "deleteUnsavedCopyItem":
    	$sql_deleteUnsavedCopyItem = "delete from Products where Status = '3' and CreateUserID = $createUserID";
		mysql_query($sql_deleteUnsavedCopyItem);
    	break;
    case "checkBeforeCopy":
    	$sql_checkBeforeCopy = "select * from Products where Status = '3' and CreateUserID = $createUserID";
    	$recCheckBeforeCopy = mysql_query($sql_checkBeforeCopy);
    	$countCopyItem = $recCheckBeforeCopy ? mysql_num_rows($recCheckBeforeCopy) : 0;
    	echo $countCopyItem > 0 ? json_encode(false) : json_encode(true);
    	break;
    default:
        break;
}


?>