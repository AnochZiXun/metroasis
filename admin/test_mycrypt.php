<?php

include_once('mycrypt.php');
$mycrypt = new mycrypt;
$str_beforeEncrypt = $_GET["string"];
$str_afterEncrypt = $mycrypt->encrypt($str_beforeEncrypt);
echo $str_afterEncrypt;
echo "<br>";
echo $mycrypt->decrypt($str_afterEncrypt);

?>