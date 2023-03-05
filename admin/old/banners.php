<?php
include('_connMysql.php');
include_once('check_login.php');
include_once('_function.php');
session_start();
if(isset($_POST["action"])&&($_POST["action"]=="save_Banners")){
  truncateTable("Banners");  
  $insert_row = $_POST["seq"];
  for ($i = 1 ; $i < $insert_row ; $i++) {	
	insertRow("Banners" ,$i);	  
  }
  //header("Location: banners.php");
  //BannersSetting
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
    <script type="text/javascript" charset="UTF-8">		
        function pageInitial(){
			var bodyHeight = document.body.clientHeight;
            var bodyWidth = document.body.bodyWidth;
            $("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 100) + "px");
            $("#tabs").attr("style", "overflow:auto;height:" + (bodyHeight - 110) + "px");
            //$("#divDetailBody").attr("style", "height:auto");
            //$("#tabs").attr("style", "height:auto");
            $("#tabs").tabs();
            $.cleditor.defaultOptions.height = bodyHeight - 180;
            //$.cleditor.defaultOptions.width = bodyWidth - 100;
            $("textarea").cleditor();
            $(".Attachs").colorbox({ iframe: true, width: "800px", height: "560px", overlayClose: false, escKey: false });
            $("#ibAttachs").attr("href", 'attachsupload.php?KeyID=&Folder=banners&FunID=banners');
            
            $('#Banner1').flexslider({
                animation: "slide",
                slideshowSpeed: "4000",
                animationSpeed: "1000",
                pauseOnHover: true,
                controlNav: false,
                directionNav: true,
                touch: true
            });
            
            $("#ibSave").click(function() {
			  	$("#Form").submit();
			});
		}

        $(document).ready(function(){
            $("#tab5-a").click(function(){
                $('#Banner2').flexslider({
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
                    itemWidth: 400,
                    itemHeight:400,
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
                    itemWidth: 400,
                    itemHeight:400,
                    itemMargin: 1,
                    pauseOnHover: true,
                    controlNav: false,
                    directionNav: true,
                    touch: true
                });
            });
        });

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
                <div class="divWorkArea">
                    <div id="UpdatePanel1">
                        <div class="divDetailTopBar">
                            <div style="float: left;padding-left:5px">
                                <input type="image" name="ibSave" id="ibSave" title="儲存資料" onmousemove="this.src=&#39;images/mounton.png&#39;" onmouseout="this.src=&#39;images/mountoff.png&#39;"src="images/mountoff.png" style="border-width: 0px;" />
                            </div>
                            <div style="float: left; width: 20px; color: #FFFFFF; text-align: center">|</div>
                            <div style="float: left"><input type="image" name="ibAttachs" id="ibAttachs"title="附件" class="Attachs" src="images/attach.png" style="border-width: 0px;" /></div>
                            <div style="float: left; width: 20px; color: #FFFFFF; text-align: center">|</div>
                            <div style="float: left; width: 20px; color: #FFFFFF; text-align: center">&nbsp;&nbsp;</div>
                            <div style="float: left; padding-right: 10px"><span id="LabMessage" style="color: Red; font-size: 11pt;font-weight: bold;"></span></div>
                        </div>
                        <div id="divDetailBody" class="divDetailBody">
							<form name="Form" method="post" action="" id="Form">
                            <div id="tabs">
                                <ul id="tabsul">                                 
                                    <li id="tab4"><a href="#tabs-4">首頁輪播區一</a></li>
									<li id="tab5"><a id="tab5-a" href="#tabs-5">首頁輪播區二</a></li>
                                    <li id="tab6"><a id="tab6-a" href="#tabs-6">首頁輪播區三</a></li>
									<li id="tab7"><a id="tab7-a" href="#tabs-7">品牌代理</a></li>
                                    <li id="tab8"><a id="tab8-a" href="#tabs-8">其他購物商城</a></li>
                                </ul>
							
								<!--首頁輪播區一-->
                                <div id="tabs-4">									
                                    <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                                        <tr>
                                            <th style="width: 5%">排序</th>
                                            <th style="width: 25%">提示名稱</th>
                                            <th style="width: 25%">圖片名稱</th>
                                            <th style="width: 35%">連結網址</th>
                                            <th style="width: 10%">開新視窗</th>
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
                                                <input name="<? echo "txtBannerSort$seq"; ?>" type="text" value="<? echo $row_Banners["BannerSort"]; ?>" id="<? echo "txtBannerSort$seq"; ?>" class="TextBox" style="width: 30px;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerName$seq"; ?>" type="text" value="<? echo $row_Banners["BannerName"]; ?>" id="<? echo "txtBannerName$seq"; ?>"class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerImage$seq"; ?>" type="text" value="<? echo $row_Banners["BannerImage"]; ?>" id="<? echo "txtBannerImage$seq"; ?>" class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerLink$seq"; ?>" type="text" value="<? echo $row_Banners["BannerLink"]; ?>" id="<? echo "txtBannerLink$seq"; ?>" class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td align="center">
                                                <table id="<? echo "rblIsOpenNew$seq"; ?>" class="RadioButtonList" border="0">
                                                    <tr>
                                                        <td>
                                                            <input id="<? echo "rblIsOpenNew".$seq."_0"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="1" <?php if ($row_Banners["IsOpenNew"] == 1) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_0"; ?>" />是</label>
                                                        </td>
                                                        <td>
                                                            <input id="<? echo "rblIsOpenNew".$seq."_1"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="0" <?php if ($row_Banners["IsOpenNew"] == 0) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_1"; ?>" />否</label>
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
                                    <div id="Banner1" class="flexslider">
                                        <ul class="slides">
                                            <!--預覽banner開始-->
											<?php while($row_Banners1=mysql_fetch_assoc($RecBanners1)){ ?>
												<li>
													<a  <?php if ($row_Banners1["IsOpenNew"] == 1) { ?>
														target="_blank"
														<? } ?>	
														href="<? echo $row_Banners1["BannerLink"]; ?>" title="<? echo $row_Banners1["BannerName"]; ?>">
														<img src="../images/banners/banner1/<? echo $row_Banners1["BannerImage"]; ?>">
													</a>
												</li>
											<? } ?>	                                            
                                            <!--預覽banner結束-->
                                        </ul>
                                    </div><br/>
                                </div>
								<!--首頁輪播區一-->
								<!--首頁輪播區二-->
                                <div id="tabs-5">									
                                    <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                                        <tr>
                                            <th style="width: 5%">排序</th>
                                            <th style="width: 25%">提示名稱</th>
                                            <th style="width: 25%">圖片名稱</th>
                                            <th style="width: 35%">連結網址</th>
                                            <th style="width: 10%">開新視窗</th>
                                        </tr>
										<? 										
											$query_Banners = "SELECT * FROM  `Banners` WHERE `BannerType` = '2' ORDER BY `BannerSort`";
											$RecBanners = mysql_query($query_Banners);
										?>
										<?php while($row_Banners=mysql_fetch_assoc($RecBanners)){ ?>		
										<input name="<? echo "txtBannerType$seq"; ?>" type="hidden" id="<? echo "txtBannerType$seq"; ?>" value="2" />	
										<tr>
                                            <td align="center">
                                                <input name="<? echo "txtBannerSort$seq"; ?>" type="text" value="<? echo $row_Banners["BannerSort"]; ?>" id="<? echo "txtBannerSort$seq"; ?>" class="TextBox" style="width: 30px;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerName$seq"; ?>" type="text" value="<? echo $row_Banners["BannerName"]; ?>" id="<? echo "txtBannerName$seq"; ?>"class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerImage$seq"; ?>" type="text" value="<? echo $row_Banners["BannerImage"]; ?>" id="<? echo "txtBannerImage$seq"; ?>" class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerLink$seq"; ?>" type="text" value="<? echo $row_Banners["BannerLink"]; ?>" id="<? echo "txtBannerLink$seq"; ?>" class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td align="center">
                                                <table id="<? echo "rblIsOpenNew$seq"; ?>" class="RadioButtonList" border="0">
                                                    <tr>
                                                        <td>
                                                            <input id="<? echo "rblIsOpenNew".$seq."_0"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="1" <?php if ($row_Banners["IsOpenNew"] == 1) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_0"; ?>" />是</label>
                                                        </td>
                                                        <td>
                                                            <input id="<? echo "rblIsOpenNew".$seq."_1"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="0" <?php if ($row_Banners["IsOpenNew"] == 0) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_1"; ?>" />否</label>
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
									<div id="Banner2" class="flexslider">
										<ul class="slides" style="padding: 0 20px 130px 20px; width: 90%;">
										<?php while($row_Banners2=mysql_fetch_assoc($recBanners2)){ ?>
											<li class="col-md-2 col-sm-6"><a href="#">
												<a <?php if ($row_Banners2["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners2["BannerLink"]; ?>" title="<? echo $row_Banners2["BannerName"]; ?>">
													<img src="../images/banners/banner2/<? echo $row_Banners2["BannerImage"]; ?>">
												</a>
											</li>
										<? } ?>
										</ul>
									</div>
                                    <br/>
                                </div>
								<!--首頁輪播區二-->
								<!--首頁輪播區三-->
                                <div id="tabs-6">
                                    <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                                        <tr>
                                            <th style="width: 5%">排序</th>
                                            <th style="width: 25%">提示名稱</th>
                                            <th style="width: 25%">圖片名稱</th>
                                            <th style="width: 35%">連結網址</th>
                                            <th style="width: 10%">開新視窗</th>
                                        </tr>
										<? 
											$query_Banners = "SELECT * FROM  `Banners` WHERE `BannerType` = '3' ORDER BY `BannerSort`";
											$RecBanners = mysql_query($query_Banners);
										?>
										<?php while($row_Banners=mysql_fetch_assoc($RecBanners)){ ?>	
										<input name="<? echo "txtBannerType$seq"; ?>" type="hidden" id="<? echo "txtBannerType$seq"; ?>" value="3" />	
										<tr>
                                            <td align="center">
                                                <input name="<? echo "txtBannerSort$seq"; ?>" type="text" value="<? echo $row_Banners["BannerSort"]; ?>" id="<? echo "txtBannerSort$seq"; ?>" class="TextBox" style="width: 30px;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerName$seq"; ?>" type="text" value="<? echo $row_Banners["BannerName"]; ?>" id="<? echo "txtBannerName$seq"; ?>"class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerImage$seq"; ?>" type="text" value="<? echo $row_Banners["BannerImage"]; ?>" id="<? echo "txtBannerImage$seq"; ?>" class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerLink$seq"; ?>" type="text" value="<? echo $row_Banners["BannerLink"]; ?>" id="<? echo "txtBannerLink$seq"; ?>" class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td align="center">
                                                <table id="<? echo "rblIsOpenNew$seq"; ?>" class="RadioButtonList" border="0">
                                                    <tr>
                                                        <td>
                                                            <input id="<? echo "rblIsOpenNew".$seq."_0"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="1" <?php if ($row_Banners["IsOpenNew"] == 1) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_0"; ?>" />是</label>
                                                        </td>
                                                        <td>
                                                            <input id="<? echo "rblIsOpenNew".$seq."_1"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="0" <?php if ($row_Banners["IsOpenNew"] == 0) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_1"; ?>" />否</label>
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
                                    <table class="TableLine" border="1px" cellpadding="5px" width="380px"  bordercolor="#BABAD2">
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
									<?php 
										$query_Banners3 = "SELECT * FROM  `Banners` WHERE BannerType = '3' AND BannerImage <> '' ORDER BY `BannerSort`";
										$RecBanners3 = mysql_query($query_Banners3);
									?>
                                    <div id="Banner3" class="flexslider">
										<ul class="slides" style="padding: 0 20px 130px 20px; width: 90%;">
										<?php while($row_Banners3=mysql_fetch_assoc($RecBanners3)){ ?>
											<li class="col-md-2 col-sm-6"><a href="#">
												<a <?php if ($row_Banners3["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners3["BannerLink"]; ?>" title="<? echo $row_Banners3["BannerName"]; ?>">
													<img src="../images/banners/banner3/<? echo $row_Banners3["BannerImage"]; ?>">
												</a>
											</li>
										<? } ?>
										</ul>
									</div> <br/>
                                </div>
								<!--首頁輪播區三-->
								<!--品牌代理-->								
                                <div id="tabs-7">									
                                    <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                                        <tr>
                                            <th style="width: 5%">排序</th>
                                            <th style="width: 25%">提示名稱</th>
                                            <th style="width: 25%">圖片名稱</th>
                                            <th style="width: 35%">連結網址</th>
                                            <th style="width: 10%">開新視窗</th>
                                        </tr>
										<? 										
											$query_Banners = "SELECT * FROM  `Banners` WHERE `BannerType` = '4' ORDER BY `BannerSort`";
											$RecBanners = mysql_query($query_Banners);
										?>
										<?php while($row_Banners=mysql_fetch_assoc($RecBanners)){ ?>		
										<input name="<? echo "txtBannerType$seq"; ?>" type="hidden" id="<? echo "txtBannerType$seq"; ?>" value="4" />	
										<tr>
                                            <td align="center">
                                                <input name="<? echo "txtBannerSort$seq"; ?>" type="text" value="<? echo $row_Banners["BannerSort"]; ?>" id="<? echo "txtBannerSort$seq"; ?>" class="TextBox" style="width: 30px;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerName$seq"; ?>" type="text" value="<? echo $row_Banners["BannerName"]; ?>" id="<? echo "txtBannerName$seq"; ?>"class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerImage$seq"; ?>" type="text" value="<? echo $row_Banners["BannerImage"]; ?>" id="<? echo "txtBannerImage$seq"; ?>" class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerLink$seq"; ?>" type="text" value="<? echo $row_Banners["BannerLink"]; ?>" id="<? echo "txtBannerLink$seq"; ?>" class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td align="center">
                                                <table id="<? echo "rblIsOpenNew$seq"; ?>" class="RadioButtonList" border="0">
                                                    <tr>
                                                        <td>
                                                            <input id="<? echo "rblIsOpenNew".$seq."_0"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="1" <?php if ($row_Banners["IsOpenNew"] == 1) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_0"; ?>" />是</label>
                                                        </td>
                                                        <td>
                                                            <input id="<? echo "rblIsOpenNew".$seq."_1"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="0" <?php if ($row_Banners["IsOpenNew"] == 0) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_1"; ?>" />否</label>
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

									<div id="Banner4" class="flexslider">
										<ul class="slides" style="padding: 0 20px 130px 20px; width: 90%;">
										<?php while($row_Banners4=mysql_fetch_assoc($recBanners4)){ ?>
											<li class="col-md-2 col-sm-6"><a href="#">
												<a <?php if ($row_Banners4["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners4["BannerLink"]; ?>" title="<? echo $row_Banners4["BannerName"]; ?>">
													<img src="../images/banners/banner4/<? echo $row_Banners4["BannerImage"]; ?>">
												</a>
											</li>
										<? } ?>
										</ul>
									</div><br/>
                                </div>
								<!--品牌代理-->
								<!--其他購物商城-->							
                                <div id="tabs-8">									
                                    <table class="TableLine" border="1px" cellpadding="5px" width="100%" bordercolor="#BABAD2">
                                        <tr>
                                            <th style="width: 5%">排序</th>
                                            <th style="width: 25%">提示名稱</th>
                                            <th style="width: 25%">圖片名稱</th>
                                            <th style="width: 35%">連結網址</th>
                                            <th style="width: 10%">開新視窗</th>
                                        </tr>
										<? 										
											$query_Banners = "SELECT * FROM  `Banners` WHERE `BannerType` = '5' ORDER BY `BannerSort`";
											$RecBanners = mysql_query($query_Banners);
										?>
										<?php while($row_Banners=mysql_fetch_assoc($RecBanners)){ ?>
										<input name="<? echo "txtBannerType$seq"; ?>" type="hidden" id="<? echo "txtBannerType$seq"; ?>" value="5" />										
										<tr>
                                            <td align="center">
                                                <input name="<? echo "txtBannerSort$seq"; ?>" type="text" value="<? echo $row_Banners["BannerSort"]; ?>" id="<? echo "txtBannerSort$seq"; ?>" class="TextBox" style="width: 30px;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerName$seq"; ?>" type="text" value="<? echo $row_Banners["BannerName"]; ?>" id="<? echo "txtBannerName$seq"; ?>"class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerImage$seq"; ?>" type="text" value="<? echo $row_Banners["BannerImage"]; ?>" id="<? echo "txtBannerImage$seq"; ?>" class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td>
                                                <input name="<? echo "txtBannerLink$seq"; ?>" type="text" value="<? echo $row_Banners["BannerLink"]; ?>" id="<? echo "txtBannerLink$seq"; ?>" class="TextBox" style="width: 95%;" />
                                            </td>
                                            <td align="center">
                                                <table id="<? echo "rblIsOpenNew$seq"; ?>" class="RadioButtonList" border="0">
                                                    <tr>
                                                        <td>
                                                            <input id="<? echo "rblIsOpenNew".$seq."_0"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="1" <?php if ($row_Banners["IsOpenNew"] == 1) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_0"; ?>" />是</label>
                                                        </td>
                                                        <td>
                                                            <input id="<? echo "rblIsOpenNew".$seq."_1"; ?>" type="radio" name="<? echo "rblIsOpenNew$seq"; ?>" 
																	value="0" <?php if ($row_Banners["IsOpenNew"] == 0) { ?> checked="checked" <? } ?> /><label for="<? echo "rblIsOpenNew".$seq."_1"; ?>" />否</label>
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

									<div id="Banner5" class="flexslider">
										<ul class="slides" style="padding: 0 20px 130px 20px; width: 90%;">
										<?php while($row_Banners5=mysql_fetch_assoc($recBanners5)){ ?>
											<li class="col-md-2 col-sm-6"><a href="#">
												<a <?php if ($row_Banners5["IsOpenNew"] == 1) { echo "target='_blank'"; } ?> href="<? echo $row_Banners5["BannerLink"]; ?>" title="<? echo $row_Banners5["BannerName"]; ?>">
													<img src="../images/banners/banner5/<? echo $row_Banners5["BannerImage"]; ?>" class="img-responsive">
												</a>
											</li>
										<? } ?>    
										</ul>
									</div><br/>
                                </div>
								<!--其他購物商城-->
								<input name="seq" type="hidden" id="seq" value="<? echo $seq ?>" />
								<input name="action" type="hidden" id="action" value="save_Banners" />
								</form>							
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>		
    </div>
    
</body>
</html>
