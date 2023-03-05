<?php 
session_start();
include('_connMysql.php');

$siteKey = '6LdtEycUAAAAAKnVni7i6nMokwlMnbWHvq5Z2FRW';

if (isset($_POST["EMail"])) {
	$EMail = $_POST["EMail"];
	$IdentityNo = strtoupper($_POST["IdentityNo"]);
	$Mobile = $_POST["Mobile"];

	$query = "select * from Customers where EMail = '$EMail'  and IdentityNo = '$IdentityNo' and Mobile = '$Mobile'";
	//echo $query."<br>";
	$Record = mysql_query($query);
	$total_records = mysql_num_rows($Record);

	if ($total_records > 0) {
		
		//$random預設為10，更改此數值可以改變亂數的位數----(程式範例-PHP教學)
		$random=8;
		//FOR回圈以$random為判斷執行次數
		for ($i=1;$i<=$random;$i++){
			//亂數$c設定三種亂數資料格式大寫、小寫、數字，隨機產生
			$c=rand(1,3);
			//在$c==1的情況下，設定$a亂數取值為97-122之間，並用chr()將數值轉變為對應英文，儲存在$b
			if($c==1){$a=rand(97,122);$b=chr($a);}
			//在$c==2的情況下，設定$a亂數取值為65-90之間，並用chr()將數值轉變為對應英文，儲存在$b
			if($c==2){$a=rand(65,90);$b=chr($a);}
			//在$c==3的情況下，設定$b亂數取值為0-9之間的數字
			if($c==3){$b=rand(0,9);}
			//使用$randoma連接$b
			$randoma=$randoma.$b;
		}
		
		$update = "update Customers set Passwd = '$randoma' where EMail = '$EMail'  and IdentityNo = '$IdentityNo' and Mobile = '$Mobile'";
		//echo $update;
		$Record = mysql_query($update);
		
		//設定重設會員密碼信
		$to = "$EMail"; //收件者
		
		$subject = iconv("UTF-8","big5","城市綠洲-重設會員密碼信"); //信件標題
		
		$msg = iconv("UTF-8","big5","親愛的會員 您好：
				
				您的新密碼：$randoma
				
				請用此密碼登入，並修改您的密碼，謝謝！
				
				(首頁 > 會員中心 > 修改資料)");//信件內容
		
		$headers = "From: mr.wayne@ipo-intl.com"; //寄件者
		
		if(mail("$to", "$subject", "$msg", "$headers")){
			echo '<script type="text/javascript"> alert("信件已經發送成功。"); location.href = "login.php";</script>';//寄信成功就會顯示的提示訊息
		} else {
			echo '<script type="text/javascript"> alert("信件發送失敗！"); </script>';//寄信失敗顯示的錯誤訊息
		}

	} else {	
		echo '<script type="text/javascript"> alert("輸入的資料有誤。")</script>';	
	}
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
                  <li class="breadcrumb-item"><a href="#">會員專區</a></li>
                  <li class="breadcrumb-item active">忘記密碼</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 忘記密碼
                    <div class="FloatR"><i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-arrows-v" aria-hidden="true"></i> 會員中心：
                        <select class="custom-select">
                          <option selected>修改資料</option>
                          <option value="1">訂單查詢</option>
                          <option value="2">我的收藏</option>
                          <option value="3">紅利績點</option>
                          <option value="4">我的報名</option>
                        </select>
                    </div>
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
                  <div class="alert alert-success" role="alert" >
                      <p><strong>注意!!</strong>請填寫下方資料，當您的資料驗證成功，【系統會重新寄送一組新密碼】至您的帳號信箱。如仍有其他操作上的問題，歡迎您來電詢問，謝謝。</p>
                  </div>  
                  <div class="login-page">      
            <div class="login-body">
				<form action="login_forget_password.php" method="POST" enctype="multipart/form-data" id="dataFrom" name="dataFrom">
                    <input type="text" class="user" name="EMail" placeholder="請輸入您當初註冊的E-mail信箱帳號。" required="">
                    <input type="text" class="user" name="IdentityNo" placeholder="身份證字號碼" required="">
                    <input type="text" class="user" name="Mobile" placeholder="行動電話" required="">
                    <!--<input type="text" class="user" name="code" placeholder="請將下方顯示的驗證碼輸入至欄位中" required="">
                    <div><img src="images/code.jpg">　<a href="#"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> 看不懂請換一組驗證碼</a></div>-->
                    <div align="center" class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>"></div>
					<input type="button" value="確認重設密碼 " onclick="checkForm();">
                </form>
            </div>  
            <h6>您還不是我們的會員嗎? <a href="register.php">註冊會員 »</a> </h6>  
                  </div>
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
		
		function checkForm() {
			var response = grecaptcha.getResponse();
			if(response.length == 0) {
				alert("請驗證不為機器人!");
			} else {
				var EMail = document.dataFrom.EMail.value;
				if(EMail == ""){   
					alert("請填寫帳號!");
					document.dataFrom.EMail.focus();
					return false;
				}
				
				var IdentityNo = document.dataFrom.IdentityNo.value;
				if(IdentityNo == ""){   
					alert("請填寫身份證字號!");
					document.dataFrom.IdentityNo.focus();
					return false;
				} else {
					IdentityNo = IdentityNo.toUpperCase();
					if(IdentityNo.search(/^[A-Z](1|2)\d{8}$/i) == -1){
						alert("請填寫正確身份證字號格式!" );
						document.dataFrom.IdentityNo.focus();
						return false;
					}
				}
				
				var Mobile = document.dataFrom.Mobile.value;
				if(Mobile == ""){   
					alert("請填寫行動電話!");
					document.dataFrom.Mobile.focus();
					return false;
				} else {
					if(Mobile.search(/^[09]{2}[0-9]{8}$/) == -1){
						alert("請填寫正確行動電話格式!" );
						document.dataFrom.Mobile.focus();
						return false;
					}
				}
				
				formSubmit();
			}
		}
		
		function formSubmit() {
			document.getElementById("dataFrom").submit()
		}
    </script>
</body>
</html>