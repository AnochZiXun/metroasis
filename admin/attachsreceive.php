<?php
include('_connMysql.php');
/**
 * upload.php
 *
 * Copyright 2013, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */

#!! IMPORTANT: 
#!! this file is just an example, it doesn't incorporate any security checks and 
#!! is not recommended to be used in production environment as it is. Be sure to 
#!! revise it and customize to your needs.


// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$KeyID = $_REQUEST["KeyID"];
$FunID = $_REQUEST["FunID"];
$Folder = $_REQUEST["Folder"];
$SubFolder = $_REQUEST["SubFolder"];
//shell_exec("echo 'SubFolder : ".$SubFolder."' > /home/metroasis/public_html/admin/logs");
//shell_exec("echo 'KeyID : ".$KeyID."' > /home/metroasis/public_html/admin/logs");
//shell_exec("echo 'Folder : ".$Folder."' > /home/countrylife/public_html/admin/logs");
/* 
// Support CORS
header("Access-Control-Allow-Origin: *");
// other CORS headers if any...
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	exit; // finish preflight CORS requests here
}
*/

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Settings
//$targetDir = "/home/metroasis/public_html/plupload/examples" . DIRECTORY_SEPARATOR . "plupload";

$targetFolder = "/home/metroasis/public_html/images". DIRECTORY_SEPARATOR . $Folder;
if (!file_exists($targetFolder)) {
	@mkdir($targetFolder);
}

if ($KeyID != ""){
	$targetFolder = "/home/metroasis/public_html/images". DIRECTORY_SEPARATOR . $Folder . DIRECTORY_SEPARATOR . $KeyID;
	if (!file_exists($targetFolder)) {
		@mkdir($targetFolder);
	}
}

$ImagefilePath = "";
if ($Folder == "products"){
	$targetDir = "/home/metroasis/public_html/images". DIRECTORY_SEPARATOR . $Folder. DIRECTORY_SEPARATOR . $KeyID . DIRECTORY_SEPARATOR . $SubFolder;
	$ImagefilePath = "/images". DIRECTORY_SEPARATOR . $Folder. DIRECTORY_SEPARATOR . $KeyID . DIRECTORY_SEPARATOR . $SubFolder. DIRECTORY_SEPARATOR;
}else if ($SubFolder == ""){
	$targetDir = "/home/metroasis/public_html/images". DIRECTORY_SEPARATOR . $Folder. DIRECTORY_SEPARATOR . $KeyID ;
	$ImagefilePath = "/images". DIRECTORY_SEPARATOR . $Folder. DIRECTORY_SEPARATOR . $KeyID . DIRECTORY_SEPARATOR;
}else{
	$targetDir = "/home/metroasis/public_html/images". DIRECTORY_SEPARATOR . $Folder . DIRECTORY_SEPARATOR . $SubFolder ;
	$ImagefilePath = "/images". DIRECTORY_SEPARATOR . $Folder . DIRECTORY_SEPARATOR . $SubFolder . DIRECTORY_SEPARATOR ;
}

//shell_exec("echo 'targetDir : ".$targetDir."' > /home/metroasis/public_html/admin/logs");

//$targetDir = 'uploads';
$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds


// Create target dir
if (!file_exists($targetDir)) {
	@mkdir($targetDir);
}

//shell_exec("echo 'targetDir : ".$targetDir."' > /home/metroasis/public_html/admin/logs");
// Get a file name
if (isset($_REQUEST["name"])) {
	$fileName = $_REQUEST["name"];
} elseif (!empty($_FILES)) {
	$fileName = $_FILES["file"]["name"];
} else {
	$fileName = uniqid("file_");
}

//shell_exec("echo 'fileName : ".$fileName."' > /home/countrylife/public_html/admin/logs/attach");

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
//shell_exec("echo 'filePath : ".$filePath."' > /home/countrylife/public_html/admin/logs/attach");
// Chunking might be enabled
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

// Remove old temp files	
if ($cleanupTargetDir) {
	if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
	}

	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

		// If temp file is current file proceed to the next
		if ($tmpfilePath == "{$filePath}.part") {
			continue;
		}

		// Remove temp file if it is older than the max age and is not the current file
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
			@unlink($tmpfilePath);
		}
	}
	closedir($dir);
}	


// Open temp file
if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
	die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

if (!empty($_FILES)) {
	if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
	}

	// Read binary input stream and append it to temp file
	if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
} else {	
	if (!$in = @fopen("php://input", "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
}

while ($buff = fread($in, 4096)) {
	fwrite($out, $buff);
}

@fclose($out);
@fclose($in);

// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
	// Strip the temp .part suffix off 
	rename("{$filePath}.part", $filePath);
	
	$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('" .$KeyID."','".$FunID."','".$SubFolder."','".$ImagefilePath."','".$fileName."')";
	shell_exec("echo \"sql : ".$insert."\" > /home/metroasis/public_html/admin/logs");
	mysql_query($insert);
}

// Return Success JSON-RPC response
die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
