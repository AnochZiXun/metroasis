<?
    include_once('_connMysql.php');

    switch ($_GET['action']) {
        case "checkProductNo":
            $productId = $_GET['ProductId'];
            $productNo = $_GET['ProductNo'];
            $sql_checkProductNo = "SELECT COUNT(*) AS Count FROM Products WHERE ProductID != ". $productId ." AND ProductNo = '". $productNo . "'";
            $result_checkProductNo = mysql_query($sql_checkProductNo);
            $row_checkProductNo = mysql_fetch_assoc($result_checkProductNo);
            if($row_checkProductNo['Count'] > 0){
                echo json_encode(false);
            }else{
                echo json_encode(true);
            }
            break;
        case "checkProductName":
            $productId = $_GET['ProductId'];
            $productName = $_GET['ProductName'];
            $sql_checkProductName = "SELECT COUNT(*) AS Count FROM Products WHERE ProductID != ". $productId ." AND ProductName = '". $productName . "'";
            $result_checkProductName = mysql_query($sql_checkProductName);
            $row_checkProductName = mysql_fetch_assoc($result_checkProductName);
            if($row_checkProductName['Count'] > 0){
                echo json_encode(false);
            }else{
                echo json_encode(true);
            }
            break;
        case "checkProductBarCode":
            $barCode = $_GET['BarCode'];
            $pkey = $_GET['Pkey'];
            $delPkeyStr = $_GET['DelPkeyStr'];
            $sql_checkProductBarCode = "SELECT COUNT(*) AS Count FROM ProductBarCode WHERE BarCode = $barCode AND Pkey != '$pkey' AND Pkey NOT IN ($delPkeyStr)";
            $result_checkProductBarCode = mysql_query($sql_checkProductBarCode);
            $row_checkProductBarCode = mysql_fetch_assoc($result_checkProductBarCode);
            if($row_checkProductBarCode['Count'] > 0){
                echo json_encode(false);
            }else{
                echo json_encode(true);
            }
            break;
        default:
            break;
    }

?>