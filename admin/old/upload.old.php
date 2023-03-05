<?
if(isset($_FILES['upload'])){
	//$filen = $_FILES['upload']['tmp_name']; 
	//$con_images = "uploaded/".$_FILES['upload']['name'];
	//move_uploaded_file($filen, $con_images );
	$funcId = $_GET['funcId'];
	$keyId = $_GET['keyId'];
	$funcNum = $_GET['CKEditorFuncNum'] ;
	// Optional: instance name (might be used to load a specific configuration file or anything else).
	$CKEditor = $_GET['CKEditor'] ;
	// Optional: might be used to provide localized messages.
	$langCode = $_GET['langCode'] ;
	
	
	$targetFolder = "/home/metroasis/public_html/images/$funcId/";
    if (!file_exists($targetFolder)) {
    	@mkdir($targetFolder);
    }
    
    if ($keyId != ""){
    	$targetFolder = "/home/metroasis/public_html/images/$funcId/$keyId";
    	if (!file_exists($targetFolder)) {
    		@mkdir($targetFolder);
    	}
    }
	
	if ($keyId != "")
	{
		$target_dir = "/home/metroasis/public_html/images/$funcId/$keyId/";
		$ImagefilePath = "/images/$funcId/$keyId/";
		$url = "http://50.63.15.83/images/$funcId/$keyId/";
	}else{
		$target_dir = "/home/metroasis/public_html/images/$funcId/";
		$ImagefilePath = "/images/$funcId/";
		$url = "http://50.63.15.83/images/$funcId/";
	}
	
	if (move_uploaded_file($_FILES['upload']['tmp_name'][0], $target_dir . $_FILES['upload']['name'][0])) {
		$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$keyId','$funcId','description','$ImagefilePath','". $_FILES['upload']['name'][0] ."')";
		echo $insert;
		mysql_query($insert);
	}
	
	$url .= $_FILES['upload']['name'][0];
	$message = '';
	echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
}
?>