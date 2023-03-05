<?php 
include_once("_connMysql.php");
include_once("check_login.php");
include_once("_function.php");
session_start();
if( isset($_POST["action"]) && $_POST["action"] == "save_Banners" ){
    truncateTable("Banners");  
    $insert_row = $_POST["seq"];
    for ($i = 1 ; $i < $insert_row ; $i++) {	
        insertRow("Banners" ,$i);	  
    }
    $insertSql = "UPDATE BannersSetting SET IsDisplay = '" . $_POST["rblIsDisplay"] . "',Height='" . $_POST["txtHeight"] . "' WHERE BannerBlock = '3'";
    mysql_query($insertSql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>城市綠洲-後台管理系統</title>
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
    <link href="css/EricChang.css" type="text/css" rel="stylesheet" />
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
    <script type="text/javascript" charset="UTF-8" src="js/jquery.cleditor.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/metroasis.pageinitial.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/validateInputFile.js"></script>
    <script type="text/javascript" charset="UTF-8">		
        function pageInitial(){
        	<?php if( isset($_POST["action"]) && $_POST["action"] == "save_Banners" ){ ?>
        		deleteUselessImage();
        	<? } ?>
            $(document).find(".orange_18_de5106").html("❖ 廣告專區");
			var bodyHeight = document.body.clientHeight;
            var bodyWidth = document.body.bodyWidth;
            $("#divDetailBody").attr("style", "overflow: hidden; height: auto;");
            $("#tabs").attr("style", "overflow: hidden; height: auto; padding-top: 0px; padding-left: 0px; padding-right: 0px;");
            $("#tabs").tabs();
            $.cleditor.defaultOptions.height = bodyHeight - 180;
            
            $("textarea").cleditor();
            $(".Attachs").colorbox({ iframe: true, width: "800px", height: "560px", overlayClose: false, escKey: false });
            $("#ibAttachs").attr("href", 'attachsupload.php?KeyID=&Folder=banners&FunID=banners');
            $("input[name^='txtBannerSort']").attr("min","1");
            $("input[name^='txtBannerSort'").attr("max","10");
            
            $('#Banner1').flexslider({
                animation: "slide",
                slideshowSpeed: "4000",
                animationSpeed: "1000",
                itemWidth: 1247,
                itemHeight:345,
                pauseOnHover: true,
                controlNav: false,
                directionNav: true,
                touch: true
            });
            
            $(".ibSave").click(function() {
            	$("#bannerType").val($(this).attr("bannerType"));
			  	$("#Form").submit();
			});
            /*輪播區三, 前台對應區塊尚未完成, 因此先隱藏*/
			$("#tabs-6").hide();
			$("#tab6").hide();
		}
        $(document).ready(function(){
            $("#tab5-a").click(function(){
                $('#Banner2').flexslider({
                    animation: "slide",
                    slideshowSpeed: "4000",
                    animationSpeed: "1000",
                    itemWidth: 290,
                    itemHeight:193,
                    itemMargin: 1,
                    pauseOnHover: true,
                    controlNav: false,
                    directionNav: true,
                    touch: true
                });
            });
            $("#tab6-a").click(function(){
                $('#Banner3').flexslider({
                    animation: "slide",
                    slideshowSpeed: "4000",
                    animationSpeed: "1000",
                    itemWidth: 400,
                    itemHeight:400,
                    itemMargin: 1,
                    pauseOnHover: true,
                    controlNav: false,
                    directionNav: true,
                    touch: true
                });
            });
            $("#tab7-a").click(function(){
                $('#Banner4').flexslider({
                    animation: "slide",
                    slideshowSpeed: "4000",
                    animationSpeed: "1000",
                    itemWidth: 220,
                    itemHeight:340,
                    itemMargin: 1,
                    pauseOnHover: true,
                    controlNav: false,
                    directionNav: true,
                    touch: true
                });
            });
            $("#tab8-a").click(function(){
                $('#Banner5').flexslider({
                    animation: "slide",
                    slideshowSpeed: "4000",
                    animationSpeed: "1000",
                    itemWidth: 245,
                    itemHeight:85,
                    itemMargin: 1,
                    pauseOnHover: true,
                    controlNav: false,
                    directionNav: true,
                    touch: true
                });
            });
            switch("<? echo $_POST["bannerType"] ?>"){
            	case "2":
            		$("#tab5-a").trigger("click");
            		break;
            	case "3":
            		$("#tab6-a").trigger("click");
            		break;
            	case "4":
            		$("#tab7-a").trigger("click");
            		break;
            	case "5":
            		$("#tab8-a").trigger("click");
            		break;            		
            	default:
            		break;
            }
         	var x = 10;
         	var y = 20;
            $(".thumbnail").mouseover(function(e){
				var biggerIsBetter = jQuery(this).clone();
				biggerIsBetter.attr("id", "biggerIsBetter");
				biggerIsBetter.attr("style","");
				$("body").append(biggerIsBetter);
				$("#biggerIsBetter").css({"position": "absolute" ,
					"top": (e.pageY+y) + "px", 
					"left": (e.pageX+x)  + "px", 
					"max-width": "600px", 
					"width": "expression(this.width > 600 ? '600px' : this.width)"}).show("fast");
            }).mouseout(function(){
             	$("#biggerIsBetter").remove();
            }).mousemove(function(e){
             	$("#biggerIsBetter").css({"position": "absolute", 
             		"top": (e.pageY+y) + "px", 
             		"left": (e.pageX+x)  + "px", 
             		"max-width": "600px", 
             		"width": "expression(this.width > 600 ? '600px' : this.width)"});
            });
        });
        function loadFile(event,thisUploadFileBtn,imgWidth,imgHeight){
            var uplaodFileBtn = jQuery(thisUploadFileBtn);
            var $file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function(){
              $("#imgForCheckSize").removeAttr('src').attr('src',reader.result);
            };
            reader.readAsDataURL($file);
            if(!validateSingleInput($file)){
                uplaodFileBtn.val("");
            }
            showLoading();
            $("#imgForCheckSize").unbind();
            /*TODO 之後有空再改善, 看能不能上傳過的就不要再傳一次*/
            $("#imgForCheckSize").load(function(){
                if(!isFileSizeOk($file,2097152)){
                alert($file["name"].replace(/.*[\/\\]/, '')+"單一檔案大小應小於2MB");
                uplaodFileBtn.val("");
                }else if(!isImgSizeOk(imgWidth,imgHeight)){
                    uplaodFileBtn.val("");
                    alert("圖片尺寸應為" + imgWidth + " * " + imgHeight);
                }else{
                    uplaodFileBtn.parent().parent().find(":text").val($file["name"].replace(/.*[\/\\]/, ''));
                    $("#uploadImgForm").find(":input").remove();
                    $("#uploadImgForm").append(uplaodFileBtn.clone());
                    $("#uploadImgForm").submit(function(event){
                        var formURL = $(this).attr("action");
                        var formData = new FormData();
                        formData.append("action", "uploadImage");
                        formData.append("imgFile", $file);
                        formData.append("bannerType", uplaodFileBtn.attr("bannerType"));
                        $.ajax(
                        {
                            url : formURL,
                            type: "POST",
                            data : formData,
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            async: false,
                            success:function(data, textStatus, jqXHR){
                            	/*
                                if(data){
                                    alert("上傳成功");
                                }else{
                                    alert("上傳失敗");
                                }
                                */
                                uplaodFileBtn.parent().parent().find("img").attr("src","../images/banners/banner"+uplaodFileBtn.attr("bannerType")+"/"+$file["name"].replace(/.*[\/\\]/, ''));
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                alert("伺服器忙碌中，請稍後再試。");
                            }
                        });
                        event.preventDefault(); //STOP default action
                    });
                    $("#uploadImgForm").submit();
                }          
            });
            stopLoading();
        }
        function isFileSizeOk(file,size){
            return file.size >= size ? false : true;
        }
        function isImgSizeOk(imgWidth,imgHeight){
            $("#imgForCheckSize").css("display","");
            if( $("#imgForCheckSize").width() != imgWidth ||  $("#imgForCheckSize").height() != imgHeight){
                $("#imgForCheckSize").css("display","none");
                return false;
            }else{
                $("#imgForCheckSize").css("display","none");
                return true;
            }
        }
        function deleteUselessImage(){
        	var formData = new FormData();
            formData.append("action", "deleteUselessImage");
        	$.ajax({
				url: "service_banner.php",
				type: "POST",
				data : formData,
                processData: false,
                contentType: false,
				async: false,
				success: function(data) {
					/*who care...*/
				}, error: function(xhr) {
					/*who care...*/
				} 
			});
        }
    </script>
</head>
<body>
    <div id="divBody" style="width:1600px; margin: 0 auto; ">
		<!-- 加上方選單 -->
		<?php include("_nav.php"); ?>
        <div style="overflow: hidden;">
			<!-- 加左方選單 -->
			<?php include("left_nav.php"); ?>
            <div id="divWork" style="float: left; width: 90%">
                <div class="divWorkArea" style="margin-bottom: 100px;">
                    <div id="UpdatePanel1">
                        <div id="divDetailBody">
                        	<div style="height:5px;"></div>
							<form name="Form" method="post" action="" id="Form">
                            <div id="tabs">
                                <ul id="tabsul" style="border-radius: 0px;">                                 
                                    <li id="tab4"><a href="#tabs-4">首頁輪播區(一)</a></li>
									<li id="tab5"><a id="tab5-a" href="#tabs-5">首頁輪播區(二)</a></li>
                                    <li id="tab6"><a id="tab6-a" href="#tabs-6">首頁輪播區(三)</a></li>
									<li id="tab7"><a id="tab7-a" href="#tabs-7">品牌代理</a></li>
                                    <li id="tab8"><a id="tab8-a" href="#tabs-8">城市綠洲其他商城</a></li>
                                </ul>
								
								<!--首頁輪播區一-->
                                <div style="height:10px;"></div>
                                <div id="tabs-4">									
                                    <table class="GridView" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                                        <tr>
                                            <th style="width:  5%"><span class="w_14">排序</span></th>
                                            <th style="width: 20%"><span class="w_14">提示名稱</span></th>
                                            <th style="width: 30%"><span class="w_14">圖片名稱</span></th>
                                            <th style="width: 35%"><span class="w_14">連結網址</span></th>
                                            <th style="width: 10%"><span class="w_14">開新視窗</span></th>
                                        </tr>
										<? 
											$seq = 1; 
											$query_Banners = "SELECT * FROM  `Banners` WHERE `BannerType` = '1' ORDER BY `BannerSort`";
											$RecBanners = mysql_query($query_Banners);
										?>
										<?php while($row_Banners=mysql_fetch_assoc($RecBanners)){ ?>
										<input name="<? echo "txtBannerType$seq"; ?>" type="hidden" id="<? echo "txtBannerType$seq"; ?>" value="1" />											
										<tr>
											<td align="center">
											    <input name="<? echo "txtBannerSort$seq"; ?>" type="number" value="<? echo $row_Banners["BannerSort"]; ?>" id="<? echo "txtBannerSort$seq"; ?>" class="TextBox" style="width: 36px;" />
											</td>
											<td align="center">
											    <input name="<? echo "txtBannerName$seq"; ?>" type="text" value="<? echo $row_Banners["BannerName"]; ?>" id="<? echo "txtBannerName$seq"; ?>" class="TextBox" style="width: 95%;" />
											</td>
											<td align="center">
											    <div style="display: inline; float: left; width: 23%;">
											    	<input type="file" name="imgFile" accept="image/jpg, image/jpeg" onchange="loadFile(event, this,1520,420)" style="color:transparent; width: 70px" bannerType="1">
											  	</div>
											    <div style="display: inline; float: left; width: 50%;">
											    <input name="<? echo "txtBannerImage$seq"; ?>" type="text" value="<? echo $row_Banners["BannerImage"]; ?>" id="<? echo "txtBannerImage$seq"; ?>" class="TextBox" style="width: 95%;" />
											    </div>
											  	<div style="display: inline; float: left; width: 27%;">
											  		<img class="thumbnail" src="../images/banners/banner1/<? echo $row_Banners["BannerImage"]; ?>" border="0" style="width: auto; height: 20px;">
											  	</div>											    
											</td>
											<td align="center">
											    <input name="<? echo "txtBannerLink$seq"; ?>" type="text" value="<? echo $row_Banners["BannerLink"]; ?>" id="<? echo "txtBannerLink$seq"; ?>" class="TextBox" style="width: 95%;" />
											</td>
											<td align="center">
													<table id="<? echo "rblIsOpenNew$seq"; ?>" class="RadioButtonList" border="0">
											        <tr>
											            <td bgcolor="#FFFFFF">
										                	<input id="<? echo "rblIsOpenNew".$seq."_0"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="1" <?php if ($row_Banners["IsOpenNew"] == 1) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_0"; ?>" />是</label>
											            	&nbsp;
															<input id="<? echo "rblIsOpenNew".$seq."_1"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="0" <?php if ($row_Banners["IsOpenNew"] == 0) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_1"; ?>" />否</label>
											                &nbsp;
											          </td>
											        </tr>
											    </table>
											</td>
										</tr>
										<? $seq ++; ?>
										<? } ?>                                        
                                    </table>
									<?php 
										$query_Banners1 = "SELECT * FROM  `Banners` WHERE BannerType = '1' AND BannerImage <> '' ORDER BY `BannerSort`";
										$RecBanners1 = mysql_query($query_Banners1);
									?>
									<br/>
									<div style="width:100%; text-align:center; padding-top: 20px;">
										<input type="button" name="ibSave" value=" 儲存 " onClick="" style="font-size:12pt; height:35px;" class="ibSave ui-button ui-widget ui-state-default ui-corner-all" bannerType="1"/>
									</div>
									<div style="height:30px;"></div>
									<fieldset style="height: 370px;">
										<legend style="font-weight:bold;"><span class="orange_16_de5106">&nbsp;前台預覽&nbsp;</span></legend>
									    <div id="Banner1" class="flexslider" style="height: 320px;">
									            <ul class="slides">
									                <!--預覽banner開始-->
													<?php while($row_Banners1=mysql_fetch_assoc($RecBanners1)){ ?>
														<li>
															<a  <?php if ($row_Banners1["IsOpenNew"] == 1) { ?>
																target="_blank"
																<? } ?>	
																href="<? echo $row_Banners1["BannerLink"]; ?>" title="<? echo $row_Banners1["BannerName"]; ?>">
																<img src="../images/banners/banner1/<? echo $row_Banners1["BannerImage"]; ?>" border="0">
															</a>
														</li>
													<? } ?>	                                            
									                <!--預覽banner結束-->
									            </ul>
									        
									    </div>
	                                </fieldset>
	                                <br/>
                                </div>
								<!--首頁輪播區一-->
								<!--首頁輪播區二-->
                                <div id="tabs-5">									
                                    <table class="GridView" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                                        <tr>
                                            <th style="width:  5%"><span class="w_14">排序</span></th>
                                            <th style="width: 25%"><span class="w_14">提示名稱</span></th>
                                            <th style="width: 25%"><span class="w_14">圖片名稱</span></th>
                                            <th style="width: 35%"><span class="w_14">連結網址</span></th>
                                            <th style="width: 10%"><span class="w_14">開新視窗</span></th>
                                        </tr>
										<? 										
											$query_Banners = "SELECT * FROM  `Banners` WHERE `BannerType` = '2' ORDER BY `BannerSort`";
											$RecBanners = mysql_query($query_Banners);
										?>
										<?php while($row_Banners=mysql_fetch_assoc($RecBanners)){ ?>		
										<input name="<? echo "txtBannerType$seq"; ?>" type="hidden" id="<? echo "txtBannerType$seq"; ?>" value="2" />	
										<tr>
											<td align="center">
											    <input name="<? echo "txtBannerSort$seq"; ?>" type="number" value="<? echo $row_Banners["BannerSort"]; ?>" id="<? echo "txtBannerSort$seq"; ?>" class="TextBox" style="width: 36px;" />
											</td>
											<td align="center">
											    <input name="<? echo "txtBannerName$seq"; ?>" type="text" value="<? echo $row_Banners["BannerName"]; ?>" id="<? echo "txtBannerName$seq"; ?>"class="TextBox" style="width: 95%;" />
											</td>
											<td align="center">
											    <div style="display: inline; float: left; width: 23%;">
											        <input type="file" name="imgFile" accept="image/jpg, image/jpeg" onchange="loadFile(event, this, 300, 200)" style="color:transparent; width: 70px" bannerType="2">
											  	</div>
											    <div style="display: inline; float: left; width: 60%;">
											        <input name="<? echo "txtBannerImage$seq"; ?>" type="text" value="<? echo $row_Banners["BannerImage"]; ?>" id="<? echo "txtBannerImage$seq"; ?>" class="TextBox" style="width: 95%;" />
											    </div>
											    <div style="display: inline; float: left; width: 17%;">
											  		<img class="thumbnail" src="../images/banners/banner2/<? echo $row_Banners["BannerImage"]; ?>" border="0" style="width: auto; height: 20px;">
											  	</div>
											</td>
											<td align="center">
											    <input name="<? echo "txtBannerLink$seq"; ?>" type="text" value="<? echo $row_Banners["BannerLink"]; ?>" id="<? echo "txtBannerLink$seq"; ?>" class="TextBox" style="width: 95%;" />
											</td>
											<td align="center">
											    <table id="<? echo "rblIsOpenNew$seq"; ?>" class="RadioButtonList" border="0">
											        <tr>
											            <td bgcolor="#FFFFFF">
											                <input id="<? echo "rblIsOpenNew".$seq."_0"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="1" <?php if ($row_Banners["IsOpenNew"] == 1) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_0"; ?>" />是</label>
															&nbsp;
										                  	<input id="<? echo "rblIsOpenNew".$seq."_1"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="0" <?php if ($row_Banners["IsOpenNew"] == 0) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_1"; ?>" />否</label>
											                &nbsp;
											            </td>
											        </tr>
											  </table>
											</td>
										</tr>
										<? $seq ++; ?>
										<? } ?>                                        
                                  	</table>
									<?php 
										$query_Banners2 = "SELECT * FROM  `Banners` WHERE BannerType = '2' AND BannerImage <> '' ORDER BY `BannerSort`";
										$recBanners2 = mysql_query($query_Banners2);
									?>
									<br/>
									<div style="width:100%; text-align:center; padding-top: 20px;">
										<input type="button" name="ibSave" value=" 儲存 " onClick="" style="font-size:12pt; height:35px;" class="ibSave ui-button ui-widget ui-state-default ui-corner-all" bannerType="2"/>
									</div>
									<div style="height:30px;"></div>
									<fieldset style="height: 220px;">
										<legend style="font-weight:bold;"><span class="orange_16_de5106">&nbsp;前台預覽&nbsp;</span></legend>
										<div id="Banner2" class="flexslider" style="height: 193px;">
											<ul class="slides" style="padding: 0 20px 130px 20px; width: 90%;">
											<?php while($row_Banners2=mysql_fetch_assoc($recBanners2)){ ?>
												<li class="col-md-2 col-sm-6">
													<a <?php if($row_Banners2["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners2["BannerLink"]; ?>" title="<? echo $row_Banners2["BannerName"]; ?>">
														<img src="../images/banners/banner2/<? echo $row_Banners2["BannerImage"]; ?>" border="0">
													</a>
												</li>
											<? } ?>
											</ul>
										</div>
									</fieldset>
									<br/>
                                </div>
								<!--首頁輪播區二-->
								<!--首頁輪播區三-->
                                <div id="tabs-6">
                                    <table class="GridView" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                                        <tr>
                                            <th style="width:  5%"><span class="w_14">排序</span></th>
                                            <th style="width: 25%"><span class="w_14">提示名稱</span></th>
                                            <th style="width: 25%"><span class="w_14">圖片名稱</span></th>
                                            <th style="width: 35%"><span class="w_14">連結網址</span></th>
                                            <th style="width: 10%"><span class="w_14">開新視窗</span></th>
                                        </tr>
										<? 
											$query_Banners = "SELECT * FROM  `Banners` WHERE `BannerType` = '3' ORDER BY `BannerSort`";
											$RecBanners = mysql_query($query_Banners);
										?>
										<?php while($row_Banners=mysql_fetch_assoc($RecBanners)){ ?>	
										<input name="<? echo "txtBannerType$seq"; ?>" type="hidden" id="<? echo "txtBannerType$seq"; ?>" value="3" />	
										<tr>
											<td align="center">
											    <input name="<? echo "txtBannerSort$seq"; ?>" type="number" value="<? echo $row_Banners["BannerSort"]; ?>" id="<? echo "txtBannerSort$seq"; ?>" class="TextBox" style="width: 36px;" />
											</td>
											<td align="center">
											    <input name="<? echo "txtBannerName$seq"; ?>" type="text" value="<? echo $row_Banners["BannerName"]; ?>" id="<? echo "txtBannerName$seq"; ?>"class="TextBox" style="width: 95%;" />
											</td>
											<td align="center">
											    <div style="display: inline; float: left; width: 23%;">
											    <input type="file" name="imgFile" accept="image/jpg, image/jpeg" onchange="loadFile(event, this,300,200)" style="color:transparent; width: 70px" bannerType="3">
											  	</div>
											    <div style="display: inline; float: left; width: 60%;">
											    <input name="<? echo "txtBannerImage$seq"; ?>" type="text" value="<? echo $row_Banners["BannerImage"]; ?>" id="<? echo "txtBannerImage$seq"; ?>" class="TextBox" style="width: 95%;" />
											    </div>
											    <div style="display: inline; float: left; width: 17%;">
											  		<img class="thumbnail" src="../images/banners/banner3/<? echo $row_Banners["BannerImage"]; ?>" border="0" style="width: auto; height: 20px;">
											  	</div>
											</td>
											<td align="center">
											    <input name="<? echo "txtBannerLink$seq"; ?>" type="text" value="<? echo $row_Banners["BannerLink"]; ?>" id="<? echo "txtBannerLink$seq"; ?>" class="TextBox" style="width: 95%;" />
											</td>
											<td align="center">
											    <table id="<? echo "rblIsOpenNew$seq"; ?>" class="RadioButtonList" border="0">
											        <tr>
											            <td bgcolor="#FFFFFF">
											                <input id="<? echo "rblIsOpenNew".$seq."_0"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="1" <?php if ($row_Banners["IsOpenNew"] == 1) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_0"; ?>" />是</label>
															&nbsp;
										                  	<input id="<? echo "rblIsOpenNew".$seq."_1"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="0" <?php if ($row_Banners["IsOpenNew"] == 0) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_1"; ?>" />否</label>
															&nbsp;
											            </td>
											        </tr>
											  </table>
											</td>
										</tr>
										<? $seq ++; ?>
										<? } ?>                                        
                                	</table>
                             		<br />
                                    <? 
										$query_BannersSetting = "SELECT * FROM `BannersSetting` WHERE `BannerBlock` = '3'";
										$RecBannersSetting = mysql_query($query_BannersSetting);
										$row_BannersSetting=mysql_fetch_assoc($RecBannersSetting)
									?>
                                    <table class="GridView" border="1px" cellpadding="5px" width="380px"  bordercolor="#BABAD2">
                                		<tr>
                                			<td style="width: 100px; text-align:center">廣告輪播顯示</td>
                                			<td style="width: 100px; text-align:center"">
                                				<table class="RadioButtonList" border="0">
                                                    <tr>
                                                        <td>
                                                            <input id="rblIsDisplay0" type="radio" name="rblIsDisplay" 
																	value="1" <?php if ($row_BannersSetting["IsDisplay"] == 1) { ?> checked="checked" <? } ?> /><label for="rblIsDisplay0" />是</label>
                                                        </td>
                                                        <td>
                                                            <input id="rblIsDisplay1" type="radio" name="rblIsDisplay" 
																	value="0" <?php if ($row_BannersSetting["IsDisplay"] == 0) { ?> checked="checked" <? } ?> /><label for="rblIsDisplay1" />否</label>
                                                        </td>
                                                    </tr>
                                                </table>	
                                			</td>
                                			<td style="width: 100px; text-align:center">廣告輪播高度</td>
                                			<td style="width: 80px; text-align:center""><input name="txtHeight" type="text" value="<? echo $row_BannersSetting["Height"]; ?>" id="<? echo "txtHeight"; ?>" class="TextBox" style="width: 80px; text-align:center" /></td>
                                		</tr>
               	          			</table>
                                    <br/>
                                  	<div style="width:100%; text-align:center; padding-top: 20px;">
		                            	<input type="button" name="ibSave" value=" 儲存 " onClick="" style="font-size:12pt; height:35px;" class="ibSave ui-button ui-widget ui-state-default ui-corner-all" bannerType="3"/>
		                       	  	</div>
                                    <div style="height:30px;"></div>
									<?php
										$query_Banners3 = "SELECT * FROM  `Banners` WHERE BannerType = '3' AND BannerImage <> '' ORDER BY `BannerSort`";
										$RecBanners3 = mysql_query($query_Banners3);
									?>
									<fieldset style="height: 290px;">
										<legend style="font-weight:bold;"><span class="orange_16_de5106">&nbsp;前台預覽&nbsp;</span></legend>
	                                    <div id="Banner3" class="flexslider" style="height: 260px;">
											<ul class="slides" style="padding: 0 20px 130px 20px; width: 90%;">
											<?php while($row_Banners3=mysql_fetch_assoc($RecBanners3)){ ?>
												<li class="col-md-2 col-sm-6">
													<a <?php if($row_Banners3["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners3["BannerLink"]; ?>" title="<? echo $row_Banners3["BannerName"]; ?>">
														<img src="../images/banners/banner3/<? echo $row_Banners3["BannerImage"]; ?>">
													</a>
												</li>
											<? } ?>
											</ul>
										</div>
									</fieldset>
									<br/>
                                </div>
								<!--首頁輪播區三-->
								<!--品牌代理-->								
                                <div id="tabs-7">									
                                    <table class="GridView" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                                        <tr>
                                            <th style="width:  5%"><span class="w_14">排序</span></th>
                                            <th style="width: 25%"><span class="w_14">提示名稱</span></th>
                                            <th style="width: 25%"><span class="w_14">圖片名稱</span></th>
                                            <th style="width: 35%"><span class="w_14">連結網址</span></th>
                                            <th style="width: 10%"><span class="w_14">開新視窗</span></th>
                                        </tr>
										<? 										
											$query_Banners = "SELECT * FROM  `Banners` WHERE `BannerType` = '4' ORDER BY `BannerSort`";
											$RecBanners = mysql_query($query_Banners);
										?>
										<?php while($row_Banners=mysql_fetch_assoc($RecBanners)){ ?>		
										<input name="<? echo "txtBannerType$seq"; ?>" type="hidden" id="<? echo "txtBannerType$seq"; ?>" value="4" />	
										<tr>
											<td align="center">
											    <input name="<? echo "txtBannerSort$seq"; ?>" type="number" value="<? echo $row_Banners["BannerSort"]; ?>" id="<? echo "txtBannerSort$seq"; ?>" class="TextBox" style="width: 36px;" />
											</td>
											<td align="center">
											    <input name="<? echo "txtBannerName$seq"; ?>" type="text" value="<? echo $row_Banners["BannerName"]; ?>" id="<? echo "txtBannerName$seq"; ?>"class="TextBox" style="width: 95%;" />
											</td>
											<td align="center">
											    <div style="display: inline; float: left; width: 23%;">
											    <input type="file" name="imgFile" accept="image/jpg, image/jpeg" onchange="loadFile(event, this,220,340)" style="color:transparent; width: 70px" bannerType="4">
											  	</div>
											    <div style="display: inline; float: left; width: 60%;">
											    <input name="<? echo "txtBannerImage$seq"; ?>" type="text" value="<? echo $row_Banners["BannerImage"]; ?>" id="<? echo "txtBannerImage$seq"; ?>" class="TextBox" style="width: 95%;" />
											    </div>
											    <div style="display: inline; float: left; width: 17%;">
											  		<img class="thumbnail" src="../images/banners/banner4/<? echo $row_Banners["BannerImage"]; ?>" border="0" style="width: auto; height: 20px;">
											  	</div>
											</td>
											<td align="center">
											    <input name="<? echo "txtBannerLink$seq"; ?>" type="text" value="<? echo $row_Banners["BannerLink"]; ?>" id="<? echo "txtBannerLink$seq"; ?>" class="TextBox" style="width: 95%;" />
											</td>
											<td align="center">
											    <table id="<? echo "rblIsOpenNew$seq"; ?>" class="RadioButtonList" border="0">
											        <tr>
											            <td bgcolor="#FFFFFF">
											                <input id="<? echo "rblIsOpenNew".$seq."_0"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="1" <?php if ($row_Banners["IsOpenNew"] == 1) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_0"; ?>" />是</label>
															&nbsp;
										                  	<input id="<? echo "rblIsOpenNew".$seq."_1"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="0" <?php if ($row_Banners["IsOpenNew"] == 0) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_1"; ?>" />否</label>
															&nbsp;
											            </td>
											        </tr>
											  </table>
											</td>
										</tr>
										<? $seq ++; ?>
										<? } ?>                                        
                              		</table>
									<?php 
										$query_Banners4 = "SELECT * FROM  `Banners` WHERE BannerType = '4' AND BannerImage <> '' ORDER BY `BannerSort`";
										$recBanners4 = mysql_query($query_Banners4);
									?>
									<br/>
									<div style="width:100%; text-align:center; padding-top: 20px;">
										<input type="button" name="ibSave" value=" 儲存 " onClick="" style="font-size:12pt; height:35px;" class="ibSave ui-button ui-widget ui-state-default ui-corner-all" bannerType="4"/>
									</div>
									<div style="height:30px;"></div>
									<fieldset style="height: 365px;">
										<legend style="font-weight:bold;"><span class="orange_16_de5106">&nbsp;前台預覽&nbsp;</span></legend>
										<div id="Banner4" class="flexslider" style="height: 340px;">
											<ul class="slides" style="padding: 0 20px 130px 20px; width: 90%;">
											<?php while($row_Banners4=mysql_fetch_assoc($recBanners4)){ ?>
												<li class="col-md-2 col-sm-6">
													<a <?php if($row_Banners4["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners4["BannerLink"]; ?>" title="<? echo $row_Banners4["BannerName"]; ?>">
														<img src="../images/banners/banner4/<? echo $row_Banners4["BannerImage"]; ?>">
													</a>
												</li>
											<? } ?>
											</ul>
										</div>
									</fieldset>
									<br/>
                                </div>
								<!--品牌代理-->
								<!--其他購物商城-->							
                                <div id="tabs-8">									
                                    <table class="GridView" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                                        <tr>
                                            <th style="width:  5%"><span class="w_14">排序</span></th>
                                            <th style="width: 25%"><span class="w_14">提示名稱</span></th>
                                            <th style="width: 25%"><span class="w_14">圖片名稱</span></th>
                                            <th style="width: 35%"><span class="w_14">連結網址</span></th>
                                            <th style="width: 10%"><span class="w_14">開新視窗</span></th>
                                        </tr>
										<? 										
											$query_Banners = "SELECT * FROM  `Banners` WHERE `BannerType` = '5' ORDER BY `BannerSort`";
											$RecBanners = mysql_query($query_Banners);
										?>
										<?php while($row_Banners=mysql_fetch_assoc($RecBanners)){ ?>
										<input name="<? echo "txtBannerType$seq"; ?>" type="hidden" id="<? echo "txtBannerType$seq"; ?>" value="5" />										
										<tr>
											<td align="center">
											    <input name="<? echo "txtBannerSort$seq"; ?>" type="number" value="<? echo $row_Banners["BannerSort"]; ?>" id="<? echo "txtBannerSort$seq"; ?>" class="TextBox" style="width: 36px;" />
											</td>
											<td align="center">
											    <input name="<? echo "txtBannerName$seq"; ?>" type="text" value="<? echo $row_Banners["BannerName"]; ?>" id="<? echo "txtBannerName$seq"; ?>"class="TextBox" style="width: 95%;" />
											</td>
											<td align="center">
											    <div style="display: inline; float: left; width: 23%;">
											    <input type="file" name="imgFile" accept="image/jpg, image/jpeg" onchange="loadFile(event, this,245,85)" style="color:transparent; width: 70px" bannerType="5">
											  	</div>
											    <div style="display: inline; float: left; width: 57%;">
											    <input name="<? echo "txtBannerImage$seq"; ?>" type="text" value="<? echo $row_Banners["BannerImage"]; ?>" id="<? echo "txtBannerImage$seq"; ?>" class="TextBox" style="width: 95%;" />
											    </div>
											    <div style="display: inline; float: left; width: 20%;">
											  		<img class="thumbnail" src="../images/banners/banner5/<? echo $row_Banners["BannerImage"]; ?>" border="0" style="width: auto; height: 20px;">
											  	</div>
											</td>
											<td align="center">
											    <input name="<? echo "txtBannerLink$seq"; ?>" type="text" value="<? echo $row_Banners["BannerLink"]; ?>" id="<? echo "txtBannerLink$seq"; ?>" class="TextBox" style="width: 95%;" />
											</td>
											<td align="center">
											    <table id="<? echo "rblIsOpenNew$seq"; ?>" class="RadioButtonList" border="0">
											        <tr>
											            <td bgcolor="#FFFFFF">
											                <input id="<? echo "rblIsOpenNew".$seq."_0"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="1" <?php if ($row_Banners["IsOpenNew"] == 1) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_0"; ?>" />是</label>
															&nbsp;
										                  	<input id="<? echo "rblIsOpenNew".$seq."_1"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="0" <?php if ($row_Banners["IsOpenNew"] == 0) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_1"; ?>" />否</label>
															&nbsp;
											            </td>
											        </tr>
											  </table>
											</td>
										</tr>
										<? $seq ++; ?>
										<? } ?>                                        
                            		</table>
									<?php 
										$query_Banners5 = "SELECT * FROM  `Banners` WHERE BannerType = '5' AND BannerImage <> '' ORDER BY `BannerSort`";
										$recBanners5 = mysql_query($query_Banners5);
									?>
									<br/>
									<div style="width:100%; text-align:center; padding-top: 20px;">
										<input type="button" name="ibSave" value=" 儲存 " onClick="" style="font-size:12pt; height:35px;" class="ibSave ui-button ui-widget ui-state-default ui-corner-all" bannerType="5"/>
									</div>
									<div style="height:30px;"></div>
									<fieldset style="height: 115px;">
										<legend style="font-weight:bold;"><span class="orange_16_de5106">&nbsp;前台預覽&nbsp;</span></legend>
										<div id="Banner5" class="flexslider" style="height: 90px;">
											<ul class="slides" style="padding: 0 20px 130px 20px; width: 90%;">
											<?php while($row_Banners5=mysql_fetch_assoc($recBanners5)){ ?>
												<li class="col-md-2 col-sm-6">
													<a <?php if($row_Banners5["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners5["BannerLink"]; ?>" title="<? echo $row_Banners5["BannerName"]; ?>">
														<img src="../images/banners/banner5/<? echo $row_Banners5["BannerImage"]; ?>" class="img-responsive">
													</a>
												</li>
											<? } ?>    
											</ul>
										</div>
									</fieldset>
									<br/>
                                </div>
								<!--其他購物商城-->
								<input name="seq" type="hidden" id="seq" value="<? echo $seq ?>" />
								<input name="action" type="hidden" id="action" value="save_Banners" />
								<input name="bannerType" type="hidden" id="bannerType" value=""/>
                            </div>
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>		
    </div>
    <form name="uploadImgForm" method="post" enctype="multipart/formdata" action="service_banner.php" id="uploadImgForm" style="display: none;">
        <input type="hidden" name="action" value="uploadImage" />
    </form>
    <img src="" id="imgForCheckSize" style="display: none;"></img>
</body>
</html>
