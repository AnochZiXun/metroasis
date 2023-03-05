<?php 

if(isset($_GET['file']))
{
    // $_GET['file'] 即為傳入要下載檔名的引數
	$fileName = str_replace('excel/', '', $_GET['file']);
    header("Content-type:application");
    header("Content-Length: " .(string)(filesize($_GET['file'])));
    header("Content-Disposition: attachment; filename=".$fileName);
	header('Content-Transfer-Encoding: big5');
    readfile($_GET['file']);
}

?>