<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title>城市綠洲戶外生活館-單車、運動用品、露營、登山、潛水、健行、保暖</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/slides.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/style_forBS.css" rel="stylesheet">
    <!--bootstrap-->
    <link href="css/style_forDIY.css" rel="stylesheet">
    <!--bootstrap-->
    <link rel="stylesheet" media="screen,projection" href="css/ui.totop.css" />
    <link href="css/flexslider.css" type="text/css" rel="stylesheet" />
    <script src="js/menu.js"></script>
    <!-- menu下拉 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="js/flycan.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () { pageInitial(); });
        $(window).resize(function () { pageInitial(); });
        function pageLoad() {
            var isAsyncPostback = Sys.WebForms.PageRequestManager.getInstance().get_isInAsyncPostBack();
            if (isAsyncPostback) {
                $(document).ready(function () {
                    pageInitial();
                });
            }
        }

        function pageInitial() {
            $('#CONTENT-3-Banner3').flexslider({
                animation: "slide",
                slideshowSpeed: "4000",
                animationSpeed: "1000",
                itemWidth: 180,
                itemHeight: 180,
                itemMargin: 15,
                pauseOnHover: true,
                controlNav: false,
                directionNav: true,
                touch: true
            });

            $('.carousel').carousel({
                interval: 5000 //changes the speed
            })
        }
        
    </script>
</head>
<body>
<?php include("_include/_head.php"); ?>
    <!-- 上方選單end -->
    <div id="CONTENT-2">
        <!-- 第一塊大的區塊 -->
        <div class="row">
            <!-- 左欄區塊 -->
            <div class="row leftBOX">
                <!-- 產品menu -->
                <?php include("_include/_productList.php"); ?>
                <!-- 折扣活動 -->
                <?php include("_include/_sale.php"); ?>
            </div>
            <!-- 右欄區塊 -->
            <div class="row rightBOX">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item"><a href="product.php">商品分類</a></li>
                  <li class="breadcrumb-item"><a href="product.php">露營野趣</a></li>
                  <li class="breadcrumb-item active">女短袖圖勝透氣排汗造型衫</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 女短袖圖勝透氣排汗造型衫
                </div>
                <!-- 內容開始 -->
                <div class="row productDetail_BOX">
                    <div class="col-md-6 col-sm-12">
                        <script type="text/javascript">
                            $(window).load(function() {
                              // The slider being synced must be initialized first
                              $('#carousel').flexslider({
                                animation: "slide",
                                controlNav: false,
                                animationLoop: false,
                                slideshow: false,
                                itemWidth: 100,
                                itemMargin: 10,
                                asNavFor: '#slider'
                              });
                             
                              $('#slider').flexslider({
                                animation: "slide",
                                controlNav: false,
                                animationLoop: false,
                                slideshow: false,
                                sync: "#carousel"
                              });
                            });                        
                        </script>    
                        <div class="productDetail_IMG">              
                            <!-- Place somewhere in the <body> of your page -->
                            <div id="slider" class="flexslider IMGBIG">
                              <ul class="slides productDetail_IMGBIG">
                                <li><img src="images/productIMG/product01.jpg"></li>
                                <li><img src="images/productIMG/product02.jpg"></li>
                                <li><img src="images/productIMG/product03.jpg"></li>
                                <li><img src="images/productIMG/product04.jpg"></li>
                                <!-- items mirrored twice, total of 12 -->
                              </ul>
                            </div>
                            <div id="carousel" class="flexslider productDetail_IMGSM">
                              <ul class="slides">
                                <li><img src="images/productIMG/product01.jpg"></li>
                                <li><img src="images/productIMG/product02.jpg"></li>
                                <li><img src="images/productIMG/product03.jpg"></li>
                                <li><img src="images/productIMG/product04.jpg"></li>
                                <!-- items mirrored twice, total of 12 -->
                              </ul>
                            </div>
                        </div>
                        <div class="productDetail_IMG_PS">
                            <p>本商品適用活動</p>
                            <div><p><span>滿額折扣</span>【母親節感恩慶】app購物滿額送現金折回饋</p></div>
                            <div><p><span>滿額回饋</span>【母親節感恩慶】app購物滿額送現金折回饋提袋</p></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12 productDetail_price">
                        <p>售價: <span class="spanRED">$790</span></p>
                        <p>市價: <span class="through">$900</p>
                        <p>顏色：</p>
                        <div class="proTEXTbox">
                            <ul>
                                <li>黃色</li>
                                <li>白色</li>
                                <li>粉紅色</li>
                                <li>亮綠色</li>
                            </ul>
                        </div>
                        <p>尺吋：</p>
                        <div class="proTEXTbox">
                            <ul>
                                <li>S</li>
                                <li>M</li>
                                <li>XL</li>
                                <li>XXL</li>
                            </ul>
                        </div>
                        <p>數量：</p>
                    <form id='myform' method='POST' action='#'>
                        <label for=""></label><input type='button' value='-' class='qtyminus' field='quantity' /><input type='text' name='quantity' value='0' class='qty' /><input type='button' value='+' class='qtyplus' field='quantity' />
                    </form>
                    <script src="js/qtyplus.js"></script>
                        <div class="productDetail_BTN">
                            <button type="button" class="btn-warning btn-lg btn-block buttonA">加入購物車</button>
                            <a href="shoppingcart.php"><button type="button" class="btn-danger btn-lg btn-block buttonB">立即結帳</button></a>
                        </div>
                        <div class="productDetail_text">
                            <p>商品特色</p>
                            <div class="protitleBOXii">
                                    <p>商品編號：31595876</p>
                                    <p>商品特色</p>
                                <ul>
                                    <li>圖騰印花</li>
                                    <li>下擺綘製後標</li>
                                    <li>背部反光轉印+反光帶(可穿耳機線)</li>
                                    <li>背部露背橫型</li>
                                    <li>罩衫軟式</li>
                                </ul>
                            </div>
                            <div style="margin: 20px 0 0 0;">
                                <div style="float: left;">
                                    <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2F50.63.15.83%2Fproduct_detail.php%3FProductID%3D71&layout=button&size=small&mobile_iframe=true&width=53&height=20&appId" width="53" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                </div>
                                <div style="float: right;">
                                     <a href="#" style="color: #FF0000;">
                                     <span class="fa-stack">
                                      <i class="fa fa-heart-o fa-stack-1x"></i>
                                    </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row productDetail_BOX" style="margin: 20px 0;">
                    <div class="col-12">
                        <h1>詳細說明</h1>
                        <div align="center"><img src="images/productIMG/AL1711119-1.jpg" class="img-responsive"></div>
                    </div>
                    <div class="col-12">
                        <h1>購物需知</h1>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"> <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <span><i class="fa fa-angle-right" aria-hidden="true"></i></span> 商品銷售
                                    </h4>
                                  </div></a>
                                  <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                     <ul>
                                        <li>本公司為連鎖量販店，所經銷商品皆為自助價款，恕不包含非故障換貨、安裝、測試、運送
                                            ‧‧‧‧等服務費用。 </li>
                                        <li>本公司為連鎖量販店，如遇各種情況，需要給付銷售額 10%~50%作為訂金，但如因個人因
                                            素訂購錯誤商品者，訂金恕不退回，作為商品銷退處理費。</li> 
                                        <li>結帳後請立即檢查所購商品，如有疑慮請即刻提出，離櫃後視同檢查完畢。如有爭議無法釐
                                            清，恕需送廠判定。 </li>
                                        <li>商品使用前請先閱讀使用說明書，專業性使用問題可先洽詢供應商﹝製造商或代理商﹞之服
                                            務專線。若無供應商服務專線，請電洽本公司客服部並由專業人員為您服務。 </li>
                                        <li>商品購回後請立即測試並檢查功能是否正常，且配件、包裝內容物是否完整‧‧‧‧等，請於保固
                                            期內妥善保存，若有原廠保證書亦需要妥善保存，外包裝盒請妥為保存，以因應快速換貨或
                                            送修之需要。 </li>
                                        <li>本公司經銷品供應商﹝製造商或代理商﹞因故結束營業或退出市場，因本公司為經銷性質，
                                            得依原廠或供應商的處理方式，作為本公司之售後服務處理原則。 </li>
                                        <li> 如需本公司進行代客安裝或檢測服務，依公告價目收取代客服務費用。</li> 
                                        <li>由於車種不一，若對於商品規格不暸解或商品相容性問題，請向本公司服務人員洽詢或與廠
                                            商聯絡後再行購買。 </li>
                                        <li>如有訂貨，買方應於訂定之交貨日期取回貨品，並付清款項。若須延期請事先告知，並以七
                                            日為限。 </li>
                                        </ul>   
                                     </div>
                                  </div>
                                </div>
                                <div class="panel panel-default">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><div class="panel-heading">
                                    <h4 class="panel-title">
                                      <span><i class="fa fa-angle-right" aria-hidden="true"></i></span> 商品退換
                                    </h4>
                                  </div></a>
                                  <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <ul>
                                        <li>以下商品一經拆封或使用，恕不接受退換。
                                            如：內衣褲、鞋類、睡袋、帳篷、燃料、線材‧‧‧‧等。 【原裝商品、代購訂貨將另行聲明。】 
                                            瑕疵、故障或有相容性問題商品之退、換貨時，需保持商品完整及配件包裝齊全，以退還廠
                                            商為原則。商品主體及其內容物﹝如各項零附件、包裝盒、包裝袋、手冊及贈品等﹞，均不
                                            可有短缺、破損、書寫文字或標記、使用或安裝錯誤之破壞﹝如刮痕、摔傷、電路燒毀、擠
                                            壓變形、異物進入、商品條碼或保固標籤被損毀、移除、變造重貼或無法辨識‧‧‧‧等﹞，以及
                                            任何目視可見之人為損傷。 </li>
                                        <li>瑕疵、故障或有相容性問題商品之退、換貨，請於購買日期起十四日內至本公司辦理。
                                            本公司將依客戶實際需求更換其他商品。 </li>
                                        <li>如因使用期望、效能‧‧‧‧等，非功能故障因素，而欲退、換貨者恕不接受退、換貨。 </li>
                                        <li>使用前未詳閱各商品使用說明書而造成之無法使用、毀損‧‧‧‧等問題時，本公司將不提供退換
                                            貨服務。</li>
                                     </ul>                                        
                                    </div>
                                  </div>
                                </div>
                                <div class="panel panel-default">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><div class="panel-heading">
                                    <h4 class="panel-title">
                                      <span><i class="fa fa-angle-right" aria-hidden="true"></i></span> 送修服務
                                    </h4>
                                  </div></a>
                                  <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <ul>
                                        <li>本公司所經銷商品均由原供應商﹝製造商或代理商﹞負責維修保固，由本公司提供代辦送修
                                             服務。其保固期限、故障因素判定、維修時程及處理費用均依原供應商﹝製造商或代理商﹞
                                             規定及既有程序辦理，並於原供應商﹝製造商或代理商﹞還修後，立即通知客戶前來取件。 </li>
                                        <li>送修品請以原廠包裝材料或安全包材，妥善包裝以確保運送過程之安全。 </li>
                                        <li>原供應商﹝製造商或代理商﹞對保固期內之商品提供維修服務，並得全權決定以零件修理或
                                            同級良品更換，如因該型商品停產或缺料，則原供應商﹝製造商或代理商﹞得以相近規格或
                                            更高規格之良品更換並酌收差價。且故障零件或原故障商品規原供應商﹝製造商或代理商﹞
                                            所有。超過保固期限維修，所有費用均由買方支付。 </li>
                                        <li>本公司及原供應商﹝製造商或代理商﹞對於商品送修期間，因無法使用該商品所造成之不便
                                            ，亦不提供代用品。 </li>
                                        <li>送修品之保管日期，由送修日期為期三個月，逾期視同放棄，本公司不負保管之責，並將自
                                            行處理。</li>
                                     </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="panel panel-default">
                                   <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><div class="panel-heading">
                                    <h4 class="panel-title">
                                     <span><i class="fa fa-angle-right" aria-hidden="true"></i></span> 除外責任
                                    </h4>
                                  </div></a>
                                  <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>以下內容均不在保固範圍內，本公司及原供應商得酌收費用或不予受理。 </p>
                                     <ul>
                                        <li>人為損壞：包含使用錯誤之破壞、刮痕、摔傷、電路燒毀、擠壓變形、異物進入、商品條碼
                                            或保固標籤被損毀、移除、變造重貼或無法辨識等。 </li>
                                        <li>非經本公司授權之修理：包含無授權廠商或客戶之拆卸、修理、改裝、拆修。</li> 
                                        <li>不可抗拒之天災地變，如雷擊、火災、地震、水患‧‧‧‧等。 </li>
                                        <li>本發票如經塗改即屬無效。</li>
                                     </ul>
                                    </div>
                                  </div>
                                </div>
                              </div> 
                    </div>
                    <div class="col-12">
                    <h1>相關商品</h1>
                    <div id="CONTENT-3-Banner3" class="flexslider">
                            <ul class="slides flexslider_boxDD" style="padding: 50px 20px 120px 20px; width: 90%;">
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product02.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product03.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product04.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product05.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product06.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product01.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product02.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product03.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product04.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product05.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                                <li class="col-md-2 col-sm-6"><a href="#">
                                    <img src="images/productIMG/product06.jpg" class="img-responsive"></a>
                                    <p>ADISI 女短袖圖騰透氣排汗造型衫</p>
                                    <span>$890</span>
                                </li>
                            </ul>
                    </div>
                    </div>
                    <a href="product.php"><div class="buttonC"><i class="fa fa-list-ul" aria-hidden="true"></i> 返回列表頁</div></a>
                </div>
            </div>
        </div>
    </div>
 <?php include("_include/_footer.php"); ?>
    <!-- easing plugin ( optional ) -->
    <script src="js-top/easing.js" type="text/javascript"></script>
    <!-- UItoTop plugin -->
    <script src="js-top/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- Starting the plugin -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */
            
            $().UItoTop({ easingType: 'easeOutQuart' });
            
        });
    </script>
</body>
</html>