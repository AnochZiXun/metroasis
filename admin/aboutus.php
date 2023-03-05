<?php
include_once("_connMysql.php");
include_once("check_login.php");
$query = "SELECT * FROM Aboutus";
$row=mysql_fetch_assoc(mysql_query($query));
if ($_POST["action"] == "update"){ 
	//$aboutusBanner = $_POST["AboutusBanner"];	
	//$aboutusBannerPath = $_POST["AboutusBannerPath"];
	$aboutusHtml = $_POST["ckeditor"];
	$update = "UPDATE Aboutus SET AboutusHtml='$aboutusHtml'";	
	//echo $update;
	mysql_query($update);
	echo "<script>location.href='aboutus.php'</script>";
	//echo "<script>parent.$.fn.colorbox.close(); </script>";	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="MainMasterHead">
    <title>城市綠洲-後台管理系統 </title>
    <meta http-equiv="X-UA-Compatible" content="IE=11, IE=9, IE=8, chrome=10" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="icon" type="image/ico" href="images/favicon_16x16.ico" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link href="css/colorbox.css" type="text/css" rel="stylesheet" />
    <link href="css/theme/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />
    <link href="css/jquery.cleditor.css" type="text/css" rel="stylesheet" />
    <link href="css/jquery.treeview.css" rel="stylesheet" />
    <link href="css/flexslider.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" charset="UTF-8" src="js/jquery-1.7.2.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.button.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.datepicker.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.tabs.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.progressbar.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ui/jquery.ui.accordion.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.colorbox.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/fullcalendar.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.maskedinput-1.3.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.blockUI.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.treeview.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" charset="UTF-8">		
        function pageInitial() {
			var bodyHeight = document.body.clientHeight;
            CKEDITOR.replace("ckeditor",{height:620,
				filebrowserUploadUrl: 'upload.php?funcId=aboutus&keyId=&type=Files',
				on: {
			        instanceReady: function() {
			            this.dataProcessor.htmlFilter.addRules( {
			                elements: {
			                    img: function( el ) {
			                        // Add an attribute.
			                        if ( !el.attributes.alt )
			                        // Add some class.
			                        el.addClass( 'img-responsive' );
			                    }
			                }
			            } );            
			        }
			    }
			});
			$("input[type=submit], input[type=button]" ).button();
        }
		function beforeSubmit(){	
        	showLoading();
			var content=CKEDITOR.instances.ckeditor.getData();
			if (content=="")
			{
				alert("「關於我們」為必填欄位!");
				$("#ckeditor").focus();
				stopLoading();
				return false;
			}
        }
    </script>
</head>
<body>
    <div id="divBody" style="width:1600px; margin: 0 auto; ">
		<!-- 加上方選單 -->
		<?php include_once("_nav.php"); ?>
        <div style="overflow: hidden;">
			<!-- 加左方選單 -->
			<?php include_once("left_nav.php"); ?>
            <div id="divWork" style="float: left; width: 90%;">
                <div class="divWorkArea">
					<form name="form1" method="post" action="aboutus.php" id="form1">
					<div>
						<div id="UpdatePanel1">
							<div id="divDetailBody" style="padding-top: 0px;">
                            	<div style="height:5px;"></div>
								<table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
									<tr>
										<td align="center" valign="top" bgcolor="#e5e5e5" style="width: 10%;">
                                        	<br/>
											<span id="Label2" class="DetailLabel"><span class="Mandatory">* 詳細內容</span></span>
										</td>
										<td bgcolor="#FFFFFF"  style="width: 90%;">
											<textarea name="ckeditor" id="ckeditor" rows="2" cols="2"><?echo $row["AboutusHtml"]?></textarea>
										</td>
									</tr>
								</table>
									<div style="width:100%; text-align:center">
				                	<p style="height:10px;"></p>
				   		      		<input type="submit" name="ibSave" id="ibSave"  value=" 儲存 " onClick="return beforeSubmit();" style="font-size:12pt; height:35px" />
				            		<input type="hidden" name="action" value="update"/>
				                    <p style="height:20px;"></p>
				            	</div>
							</div>
							<p style="height:30px;"></p>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
