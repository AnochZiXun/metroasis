<?

    include('_connMysql.php');

    if($_GET['action'] == "queryForSize"){
        $argProductId = $_GET['ProductID'];
        $argProductNo = $_GET['ProductNo'];
        //$argBarCode = $_GET['BarCode'] == '' ? 'NULL' : $_GET['BarCode'];
        $argColor = $_GET['Color'];
        $sql_queryForSize = "SELECT Size FROM ProductBarCode WHERE ProductID = '$argProductId' AND Color = '$argColor'";
        $rec_productSize = mysql_query($sql_queryForSize);
        $result = array();
        while($row=mysql_fetch_assoc($rec_productSize)){
            array_push($result, $row["Size"]);
        }
        echo json_encode($result);
    }

?>