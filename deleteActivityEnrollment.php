<?
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>';
session_start();
include('_connMysql.php');
//檢查是否經過登入
if(isset($_SESSION["CustomerID"])){
    $customerId = $_SESSION["CustomerID"];
    $enrollId = $_POST["enrollId"];
	
	#處理候補轉正取
    $rec_delEnrollment = mysql_query("SELECT * FROM ActivityEnrollment WHERE EnrollID = '$enrollId'");
    $row_delEnrollment = mysql_fetch_assoc($rec_delEnrollment);
    $qualification = $row_delEnrollment["Qualification"];
    if($qualification == "1"){
    	$delActivityID = $row_delEnrollment['ActivityID'];
    	$delActivityActType = $row_delEnrollment['ActType'];
        $rec_top1Alternate = mysql_query("SELECT * FROM ActivityEnrollment WHERE ActivityID = '$delActivityID' AND ActType = '$delActivityActType' AND Qualification = '0' ORDER BY CreateDate LIMIT 1");
        if($rec_top1Alternate){
            $row_top1Alternate = mysql_fetch_assoc($rec_top1Alternate);
            $top1AlternateEnrollID = $row_top1Alternate['EnrollID'];
            mysql_query("UPDATE ActivityEnrollment SET Qualification = '1' WHERE EnrollID = '$top1AlternateEnrollID'");
            echo '
            <script>
            $.ajax({
              url: "giveOutYourMoney.php",
              method: "POST",
              data: {
                enrollId: '.$enrollId.'
              }
            }).done(function(){
            }).error(function(a,b,c){
              console.info(a);
              console.info(b);
              console.info(c);
            });
            </script>
            ';
        }
    }

    $deleteSql = "delete from ActivityEnrollment where EnrollID = '$enrollId' and CustomerID = '$customerId'";
    mysql_query($deleteSql);
    $deleteSql = "delete from ActivityEnrollmentDetail where EnrollID = '$enrollId'";
    mysql_query($deleteSql);
    $deleteSql = "delete from ActRentItemDetail where ActEnrollID = '$enrollId'";

    mysql_query($deleteSql);
}
?>