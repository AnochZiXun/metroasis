<?php 
include_once("_connMysql.php");
include_once("executeLogin.php");
$siteKey = "6LdtEycUAAAAAKnVni7i6nMokwlMnbWHvq5Z2FRW";
$cookieMail = $_COOKIE["email"];
if($_COOKIE["rememberMe"] == 1){
	$checkRememberMe = 'checked';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title>城市綠洲戶外生活館</title>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Dropdown Hover CSS -->
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap-dropdownhover.min.css" rel="stylesheet">     
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
    <link href="css/EricChang.css" type="text/css" rel="stylesheet" />
    <script src="js/menu.js"></script>
    <!-- menu下拉 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="js/flycan.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Bootstrap Dropdown Hover JS -->
    <script src="js/bootstrap-dropdownhover.min.js"></script>     
</head>
<body>
<?php include_once("_include/_head.php"); ?>
    <!-- 上方選單end -->
    <div id="CONTENT-2">
        <!-- 第一塊大的區塊 -->
        <div class="row">
            <!-- 左欄區塊 -->
            <div class="row leftBOX">
                <!-- 產品menu -->
                <?php include_once("_include/_productList.php"); ?>
                <!-- 折扣活動 -->
                <?php include_once("_include/_sale.php"); ?>
            </div>
            <!-- 右欄區塊 -->
            <div class="row rightBOX">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item active">會員登入</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 會員登入
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
                  <div class="login-page">      
                    <div class="login-body" align="center">
						<form action="login.php" method="POST" id="loginForm">
                        	<table cellpadding="0" cellspacing="0" width="50%">
                              <tr>
                                <td colspan="2" align="center">
                                	<img src="images/login_mark.jpg" width="80" height="80">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" height="20"><!----></td>
                              </tr>
                              <tr>
                                <td width="35%" style="text-align:right; padding-bottom: 1em; vertical-align: middle;">
                                	<span class="b_14">會員帳號：　</span>
                                </td>
                                <td width="65%" style="text-align:left;">
                            		<input style="width:73%; margin-bottom: 1em;" class="form-control" type="text" name="email" placeholder="您的E-mail帳號。" value="<? echo $cookieMail; ?>">
                                </td>
                              </tr>
                              <tr>
                                <td style="text-align:right; padding-bottom: 1em; vertical-align: middle;">
                                	<span class="b_14">密　　碼：　</span>
                                </td>
                                <td>
                            		<input style="width:73%; margin-bottom: 1em;" class="form-control" type="password" name="Passwd" placeholder="">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" height="20"><!----></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center">
                                	<!--<input type="text" class="user" name="checkString" placeholder="請將下方顯示的驗證碼輸入至欄位中" required="">
                                    <div><img src="images/code.jpg">　<a href="#"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> 看不懂請換一組驗證碼</a></div>-->
                                    <div align="center" class="g-recaptcha" style="padding:0px;" data-sitekey="<?php echo $siteKey;?>"></div>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" height="20"><!----></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center">
                                	<input type="button" style="width:25%" value="登入 " onclick="checkRobt()">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" height="30"><!----></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center">
                                	&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="rememberMe" value="1" <? echo $checkRememberMe; ?>>&nbsp;<span class="b_14">記住我</span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a align="right" href="login_forget_password.php"><i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;<span class="b_14">忘記密碼？</span></a>
                                </td>
                              </tr>
                            </table>
                        </form>
                    </div>
                    <div style="height:30px;"></div>
                    <div style="padding-left:30px;">
                    	<span class="gray_16">您還不是我們的會員嗎？</span> <a href="register.php" class="red_16">《加入會員》</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
 <?php include_once("_include/_footer.php"); ?>
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
		
		function formSubmit() {
			document.getElementById("loginForm").submit()
		}
		
		function checkRobt() {
			var response = grecaptcha.getResponse();
			if(response.length == 0) {
				alert("請驗證不為機器人!");
			} else {
				formSubmit();
			}
		}
    </script>
</body>
</html>