<?
include('_connMysql.php');
$enrollId = $_REQUEST["enrollId"];

$query_enrollment = "SELECT * FROM ActivityEnrollment WHERE EnrollID = '$enrollId'";
$rec_enrollment = mysql_query($query_enrollment);
if (mysql_num_rows($rec_enrollment) == 0) {
    return false;
}
$row_enrollment = mysql_fetch_assoc($rec_enrollment);
$activityID = $row_enrollment["ActivityID"];
switch($row_enrollment["ActType"]){
    case "1":
        $query_activity = "SELECT * FROM ActivityNight WHERE ActivityNightID = '$activityID'";
        $rec_activity = mysql_query($query_activity);
        break;
    case "2":
        $query_activity = "SELECT * FROM ActivityClass WHERE ActivityClassID = '$activityID'";
        $rec_activity = mysql_query($query_activity);
        break;
    default:
        return false;
        break;
}
if (mysql_num_rows($rec_activity) == 0) {
    return false;
}
$row_activity = mysql_fetch_assoc($rec_activity);
$batch = $row_activity["Batch"];

$fullName = $row_enrollment['FullName'];
$verifyCode = $row_enrollment['VerifyCode'];
$email = $row_enrollment['EMail'];

$subject = "城市綠洲單車戶外生活館 - 報名正取通知";
$msg = "親愛的 ".$fullName." 您好：<br>
        <br>
        感謝您熱情參與本次城市綠洲舉辦的".$row_activity['ActivityName']."活動。<br>
        本次活動梯次為".$row_enrollment["ActType"]."-".$batch."。驗證代碼為： ".$verifyCode."<br>
        驗證代碼為您線上驗證報名資料的重要依據，請小心保存。<br>
        <br>
        請於報名後，當日起5天內進行匯款，匯款資料如下：<br>
        <br>
        玉山銀行808　新豐分行，帳號：112 – 694000 – 1361，戶名：山林歲月有限公司<br>
        <br>
        P.S匯款完成後，請至會員中心>我的活動填寫匯款帳號後五碼，或來電通知對帳。<br>
        <br>
        5天內未完成報名驗證及匯款，本公司有權利取消您此次報名。<br>
        <br>
        如果您有任何其他疑問，也歡迎您隨時來電詢問活動的相關訊息。<br>
        最後在此祝您一切順心!<br>";
$headers = "MIME-Version: 1.0\r\n" .
            "Content-type: text/html; charset=big5;\r\n" .
            "From: metroasis@ipo-intl.com\r\n";

mail("$email", "$subject", "$msg", "$headers");

echo $email;
?>