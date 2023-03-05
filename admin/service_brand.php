<?
include_once('_connMysql.php');

switch ($_GET['action']) {
    case "checkBrandName":
        $brandName = $_GET['BrandName'];
        $brandId = $_GET['BrandId'];
        $sql_checkBrandName = "select * from Brand where BrandID != '$brandId' and BrandName = '$brandName'";
        $rec_checkBrandName = mysql_query($sql_checkBrandName);
        $countBrandName = $rec_checkBrandName ? mysql_num_rows($rec_checkBrandName) : 0;
        echo $countBrandName > 0 ? json_encode(false) : json_encode(true);
        break;
    case "canBeDeleted":
        $brandId = $_GET['BrandId'];
        $rec = mysql_query("SELECT * FROM Products WHERE BrandID = '$brandId'");
        $count = $rec ? mysql_num_rows($rec) : 0;
        echo $count > 0 ? json_encode(false) : json_encode(true);
        break;
    default:
        break;
}


?>