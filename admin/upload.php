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
	$message = "";
	for ($i = 0 ; $i < count($_FILES['upload']["name"]) ; $i++) {
		if($_FILES['upload']['size'][$i] == 0){
			$message .= $_FILES['upload']['name'][$i]." , ";
			continue;
		}
		if (move_uploaded_file($_FILES['upload']['tmp_name'][$i], $target_dir . $_FILES['upload']['name'][$i])) {
			$insert = "INSERT INTO ImagesFiles (ForeignID,ImageFunction,ImageType,ImagePath,ImageFileName) VALUES ('$keyId','$funcId','description','$ImagefilePath','". $_FILES['upload']['name'][$i] ."')";
			//echo $insert;
			mysql_query($insert);
		}
		$imgUrl = $url.$_FILES['upload']['name'][$i];
		$script = "<script type='text/javascript'>".
					"var oEditor = window.parent.CKEDITOR.instances.ckeditor;".
					"var newElement = window.parent.CKEDITOR.dom.element.createFromHtml( '<p><img data-cke-saved-src=\"".$imgUrl."\" src=\"".$imgUrl."\"></p>', oEditor.document );".
					"oEditor.insertElement(newElement);".
					"window.parent.document.querySelectorAll('a[id^=\"cke_dialog_close_button_\"]')[0].click();".
				  "</script>";
		echo $script;
	}
	if($message != ""){
		$message .= "檔案超過2MB";
		echo "<script type='text/javascript'>alert('".$message."'); window.parent.document.querySelectorAll('a[id^=\"cke_dialog_close_button_\"]')[0].click();</script>";
	}
}
?>