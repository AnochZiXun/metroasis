<?php 
$KeyID = $_REQUEST["KeyID"]; 			//主健值
$Folder = $_REQUEST["Folder"]; 			//主目錄
$SubFolder = $_REQUEST["SubFolder"]; 	//子目錄
$FunID = $_REQUEST["FunID"]; 			//ImageType
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <style type="text/css">
	    body {
		    font-family:Verdana, Geneva, sans-serif;
		    font-size:13px;
		    color:#333;
		    background:url(images/bg.jpg);
	    }
	   .divDetailTopBar
        {
            padding-top:0px;
            padding-left:0px;
            height:40px;
            line-height:40px;
            color: #000000;
	        font-family: verdana;
	        background: #C4D5E5;
	        background: -moz-linear-gradient(top, #838959 0%, #585E2E 100%);
	        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#838959), color-stop(100%,#585E2E));
	        background: -webkit-linear-gradient(top, #838959 0%,#585E2E 100%);
	        background: -o-linear-gradient(top, #838959 0%,#585E2E 100%);
	        background: -ms-linear-gradient(top, #838959 0%,#585E2E 100%);
	        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#838959', endColorstr='#585E2E',GradientType=0 );
	        background: linear-gradient(top, #838959 0%,#585E2E 100%);
	        border-top-left-radius: 5px;
	        border-top-right-radius: 5px;
        }
		.divWorkBar{
			height:50px;	
			border: 1px solid #CCCCCC;
			border-top-color:#CCCCCC;
			border-left-color:#CCCCCC;
			border-right-color:#CCCCCC;
			border-bottom-color:#F5F5F5;
		}
		.divDescription
		{
			font-weight : bold;
			margin-top:7px;
			margin-left:10px;
			color:Red;
		}
    </style>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<title>Plupload - Queue widget example</title>
	<link rel="stylesheet" href="css/jquery.plupload.queue.css" type="text/css" media="screen" />
	<link href="css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
	<script src="js/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.button.js"></script>
	<script type="text/javascript" src="js/plupload.full.min.js"></script>
	<script type="text/javascript" src="js/jquery.plupload.queue.js"></script>
	<script type="text/javascript">
		$(function() {
			$("#uploader").pluploadQueue({
				// General settings
				runtimes : 'html5',
				url : 'attachsreceive.php',
				chunk_size : '1mb',
				unique_names : false,
				multipart_params: { "KeyID": $("#hfKeyID").val(), "FunID":"<?echo $FunID?>", "Folder": $("#hfFolder").val(), "SubFolder": $("#hfSubFolder").val()},
				filters : {
					max_file_size : '100mb',
					mime_types: [
						{title : "Image files", extensions : "jpg,gif,png"},
						{title : "Pdf files", extensions : "pdf"}
					]
				},
				preinit: {
	                PostInit: function(up) {
	                    //$("#uploader_start").hide();
	                }
	            }
				// Resize images on clientside if we can
				//resize : {width : 320, height : 240, quality : 90}
			});
			$("input[type=submit], button" ).button();
			$(".plupload_buttons").append("<input name='upload' type='submit' value='上傳檔案'>");
		});
		
		$('form1').submit(function (e) {
          alert('upload click');
          var uploader = $("#uploader").pluploadQueue();
          // Files in queue upload them first
          if (checkSelect()) {
              // When all files are uploaded submit form
              /*uploader.bind('StateChanged', function () {
                  if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                      // $('form')[0].submit();
                      alert("Form submitted");
                  }
              });
              */
              uploader.start();

          } else {
				return false;
          }
          
      });
		
		function checkSelect() {
			var blnReturn = true;
			var strSubFolder = "";
			switch("<?echo $FunID?>"){
				case "brands":
					strSubFolder = $("#hfSubFolder").val();
					if (strSubFolder == ""){
						alert('請先選擇上傳圖片分類!!');
					}
					blnReturn = false;
					break;
				case "banner":
					strSubFolder = $("#hfSubFolder").val();
					if (strSubFolder == ""){
						alert('請先選擇上傳圖片分類!!');
					}
					break;
				case "products":
					strSubFolder = $("#hfSubFolder").val();
					if (strSubFolder == ""){
						alert('請先選擇上傳圖片分類!!');
					}
					blnReturn = false;
					break;
				case "news":
					strSubFolder = $("#hfSubFolder").val();
					if (strSubFolder == ""){
						alert('請先選擇上傳圖片分類!!');
					}
					blnReturn = false;
					break;
				case "qnan":
					
					break;
				case "catalog":
					
					break;
			}
			return blnReturn;
		};
		
		function setSelectValue(strValue){
			location.href="attachsupload.php?KeyID=<?echo $KeyID?>&Folder=<?echo $Folder?>&FunID=<?echo $FunID?>&SubFolder=" + strValue;
		}
	</script>
</head>
<body>
<form name="form1" method="post" action="">
	<div id="ToolBar" class="divDetailTopBar"></div>
	<div id="WorkBar" class="divWorkBar">
		<? if ($FunID == "brand"){
			$brands_1 = '';
			$brands_2 = '';
			switch($SubFolder){
				case "list":
					$brands_1 = "checked";
					break;
				case "description":
					$brands_2 = "checked";
					break;
			}
		?>
		<table id="brands" class="RadioButtonList" border="0" style="width: 600px; font-weight:bold; color:Red">
			<tr>
				<td style="width:40%">
					<input id="news_1" type="radio" name="brands" value="list" onclick="setSelectValue('list')" <?echo $brands_1?>/>
					<label for="rblbrands_1">列表圖 (W 178 * H 150)</label>
				</td>
				<td style="width:30%">
					<input id="news_2" type="radio" name="brands" value="description" onclick="setSelectValue('description')" <?echo $brands_2?> />
					<label for="rblbrands_0">內文 (不限)</label>
				</td>
				<td style="width:30%"></td>
			</tr>
		</table>
		<?}else if ($FunID == "aboutus"){?>
		<div class="divDescription">
			<span>圖片大小無限制</span>
		</div>
		<?}else if ($FunID == "banners"){
			$banners_1 = '';
			$banners_2 = '';
			$banners_3 = '';
			$banners_4 = '';
			$banners_5 = '';
			
			switch($SubFolder){
				case "banner1":
					$banners_1 = "checked";
					break;
				case "banner2":
					$banners_2 = "checked";
					break;
				case "banner3":
					$banners_3 = "checked";
					break;
				case "banner4":
					$banners_4 = "checked";
					break;
				case "banner5":
					$banners_5 = "checked";
					break;
			}
		?>
		<table id="Banners" class="RadioButtonList" border="0" style="width: 700px; font-weight:bold; color:Red">
			<tr>
				<td>
					<input id="banners_1" type="radio" name="banners" value="brand" onclick="setSelectValue('banner1')" <?echo $banners_1?>/>
					<label for="rblbrands_1">輪播區一 (W 1520 * H 420)</label>
				</td>
				<td>
					<input id="banners_2" type="radio" name="banners" value="banner" onclick="setSelectValue('banner2')" <?echo $banners_2?> />
					<label for="rblbrands_2">輪播區二 (W 300 * H 200)</label>
				</td>
				<td>
					<input id="banners_3" type="radio" name="banners" value="description" onclick="setSelectValue('banner3')" <?echo $banners_3?>/>
					<label for="rblbrands_3">輪播區三 (W 300 * H 200)</label>
				</td>
			</tr>
			<tr>
				<td>
					<input id="banners_4" type="radio" name="banners" value="description" onclick="setSelectValue('banner4')" <?echo $banners_4?>/>
					<label for="rblbrands_4">品牌代理 (W 220 * H 340)</label>
				</td>
				<td colspan="2">
					<input id="banners_5" type="radio" name="banners" value="description" onclick="setSelectValue('banner5')" <?echo $banners_5?>/>
					<label for="rblbrands_05">其他商城 (W 245 * H 85)</label>
				</td>
			</tr>
		</table>
		<?}else if ($FunID == "products"){
			$products_1 = '';
			$products_2 = '';
			$products_3 = '';
			
			switch($SubFolder){
				case "list":
					$products_1 = "checked";
					break;
				case "detail":
					$products_2 = "checked";
					break;
				case "description":
					$products_3 = "checked";
					break;
			}
		?>
		<table id="Products" class="RadioButtonList" border="0" style="width: 600px; font-weight:bold; color:Red">
			<tr>
				<td>
					<input id="products_1" type="radio" name="products" value="list" onclick="setSelectValue('list')" <?echo $products_1?>/>
					<label for="rblproducts_1">商品列表 (W 280 * H 280)</label>
				</td>
				<td>
					<input id="products_2" type="radio" name="products" value="detail" onclick="setSelectValue('detail')" <?echo $products_2?> />
					<label for="rblproducts_0">商品圖 (W 450 * H 450)</label>
				</td>
				<td>
					<input id="products_3" type="radio" name="products" value="description" onclick="setSelectValue('description')" <?echo $products_3?> />
					<label for="rblproducts_0">商品內文 (不限)</label>
				</td>
			</tr>
		</table>
		<?}else if ($FunID == "news"){
			$news_1 = '';
			$news_2 = '';
			
			switch($SubFolder){
				case "list":
					$news_1 = "checked";
					break;
				case "description":
					$news_2 = "checked";
					break;
			}	
		?>
		<table id="news" class="RadioButtonList" border="0" style="width: 600px; font-weight:bold; color:Red">
			<tr>
				<td style="width:40%">
					<input id="news_1" type="radio" name="products" value="list" onclick="setSelectValue('list')" <?echo $news_1?>/>
					<label for="rblproducts_1">列表圖 (W 312 * H 214)</label>
				</td>
				<td style="width:30%">
					<input id="news_2" type="radio" name="products" value="description" onclick="setSelectValue('description')" <?echo $news_2?> />
					<label for="rblproducts_0">內文 (不限)</label>
				</td>
				<td style="width:30%"></td>
			</tr>
		</table>
		<?}else if ($FunID == "activityhighlight"){?>
		<div class="divDescription">
			<span>列表圖 (W 312 * H 214)</span>、<span>內文 (不限)</span>
		</div>
		<?}else if ($FunID == "audio"){?>
		<div class="divDescription">
			<span>內文 (不限)</span>
		</div>
		<?}else if ($FunID == "knowledges"){?>
		<div class="divDescription">
			<span>列表圖 (W 312 * H 214)</span>、<span>內文 (不限)</span>
		</div>
		<?}else if ($FunID == "catalog"){?>
		<div class="divDescription">
			<span>圖片大小：W 480 * H 480 , 型錄檔：限定副檔名為.pdf，檔案大小不限。</span>
		</div>
		<?}?>
	</div>
	<div id="uploader" style="width: 100%x; height: 370px;">您的瀏覽器不支援HTML5。</div>
	<input type="hidden" name="hfKeyID" id="hfKeyID" value="<? echo $KeyID ; ?>"/>
	<input type="hidden" name="hfFolder" id="hfFolder" value="<? echo $Folder ; ?>" />
	<input type="hidden" name="hfSubFolder" id="hfSubFolder" value="<? echo $SubFolder ; ?>" />
</form>

</body>
</html>
<script type="text/javascript">
	var strKeyID = $("#hfKeyID").val();
	switch("<?echo $FunID?>"){
		case "brands":
			break;
		case "banner":
			break;
		case "products":
			if (strKeyID==""){
				alert("新增模式，請先存檔後再行上傳圖片!!");
				parent.$.fn.colorbox.close();
			}
			break;
		case "news":
			if (strKeyID==""){
				alert("新增模式，請先存檔後再行上傳圖片!!");
				parent.$.fn.colorbox.close();
			}
			break;
		case "qna":
			if (strKeyID==""){
				alert("新增模式，請先存檔後再行上傳圖片!!");
				parent.$.fn.colorbox.close();
			}
			break;
		case "catalog":
			if (strKeyID==""){
				alert("新增模式，請先存檔後再行上傳圖片!!");
				parent.$.fn.colorbox.close();
			}
			break;
	}
</script>