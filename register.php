<?php 
session_start();
include_once("_connMysql.php");
include_once('admin/mycrypt.php');
$mycrypt = new mycrypt;
$siteKey = '6LdtEycUAAAAAKnVni7i6nMokwlMnbWHvq5Z2FRW';
if(isset($_POST["action"]) && $_POST["action"] == 'register'){
	$EMail = $_POST["EMail"];
	$Subscribe = $_POST["Subscribe"]==1 ? 1 : 0;
	$ChineseName = $_POST["ChineseName"];
	$EnglishName = $_POST["EnglishName"];
	$NickName = $_POST["NickName"];
	$Gender = $_POST["Gender"];
	$Birthday = $_POST["Birthday"];
	$IdentityNo = strtoupper($_POST["IdentityNo"]);
	$Mobile = $_POST["Mobile"];
	$Sms = $_POST["Sms"]==1 ? 1 : 0;
	$HomeTel = $_POST["HomeTel"];
	$Fax = $_POST["Fax"];
	$Address = $_POST["Address"];
	$PostalCode = $_POST["PostalCode"];
  $AddressCounty = $_POST["AddressCounty"];
  $AddressDistrict = $_POST["AddressDistrict"];
	
	$sysdate = date('y-m-d H:i:s');	
	$new_passwd = $mycrypt->encrypt($_POST["new_passwd"]);
	
	$insertSql = "INSERT INTO Customers(ChineseName, EnglishName, NickName, Gender, Birthday, IdentityNo, 
				Mobile, EMail, HomeTel, Fax, Address, Passwd, Sms, Subscribe, RegisterDate,
				CreateDate, PostalCode, AddressCounty, AddressDistrict) 
				VALUES ('$ChineseName','$EnglishName','$NickName',$Gender,'$Birthday','$IdentityNo',
				'$Mobile','$EMail','$HomeTel','$Fax','$Address','$new_passwd',$Sms,$Subscribe,'$sysdate',
				'$sysdate', '$PostalCode', '$AddressCounty', '$AddressDistrict')";
	echo $insertSql;
	mysql_query($insertSql);
	
	//mail
	$to = "$EMail"; //收件者
	$subject = "【城市綠洲】加入會員通知信"; //信件標題
	
	$msg = iconv("UTF-8","big5","親愛的會員 您好：
			
	　　【城市綠洲】歡迎您的加入！
			
	　　會員帳號：$EMail

	  (此為系統自動通知信，請勿直接回信。)");//信件內容
	
	$headers = "From: metroasis@metroasis.com"; //寄件者
	
	if(mail("$to", "$subject", "$msg", "$headers")){
		echo '<script type="text/javascript"> alert("信件已經發送成功。"); location.href = "login.php";</script>';//寄信成功就會顯示的提示訊息
	} else {
		echo '<script type="text/javascript"> alert("信件發送失敗！"); </script>';//寄信失敗顯示的錯誤訊息
	}
	
	header("Location: register_complete.php");
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
	  <script type="text/javascript" charset="UTF-8" src="admin/js/metroasis.pageinitial.js"></script>
	  <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="js/jquery.twzipcode.js"></script>
    <!-- Bootstrap Dropdown Hover JS -->
    <script src="js/bootstrap-dropdownhover.min.js"></script>    
    <script type="text/javascript">
        function test(){
          $('#twzipcode').twzipcode({
              countyName:"AddressCounty",
              districtName:"AddressDistrict",
              zipcodeName:"PostalCode",
              css:['AddressCounty form-control','AddressDistrict form-control','PostalCode form-control']
          });
          $(".PostalCode").css("width","auto").attr("readonly","true").css("display","inline");
          $(".AddressCounty").css("width","auto").css("display","inline").css("font-size","14px");
          $(".AddressDistrict").css("width","auto").css("display","inline").css("font-size","14px");
        }
    </script>
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
                  <li class="breadcrumb-item active">加入會員</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 會員註冊程序
                </div>
                <!-- 內容開始 -->
				<form action="" method="POST" enctype="multipart/form-data" id="dataFrom" name="dataFrom">
                <div  id="form1" class="frameBOX">
                  <div class="alert alert-success" role="alert" >
					<p>※ 完成【會員註冊程序】之後，您將會收到系統通知信置您的信箱。</p>
				  </div>  
                  <div class="login-page">
                    <div class="login-body">
                    
                    	<div align="center">
                            <table cellpadding="0" cellspacing="0" width="100%">
                              <tr>
                                <td width="30%" style="text-align:right;">
                                	<span class="b_14">會員帳號：　</span>
                                </td>
                                <td width="70%" style="text-align:left;">
                                    <input style="width:75%" class="form-control user" type="text" id="EMail" name="EMail" placeholder="請輸入E-mail帳號" required="">
                                </td>
                              </tr>
                              <tr>
                                <td style="text-align:right;">
                                    <span class="b_14">密　　碼：　</span>
                                </td>
                                <td  style="text-align:left;">
                                    <input style="width:75%" class="form-control lock" type="password" id="new_passwd" name="new_passwd" placeholder="請輸入密碼 (長度為8~30字元，需有英文大小寫及數字。)" required="">
                                </td>
                              </tr>
                              <tr>
                                <td style="text-align:right;">
                                    <span class="b_14">確認密碼：　</span>
                                </td>
                                <td style="text-align:left;">
                                    <input style="width:75%" class="form-control lock" type="password" id="confirm_passwd" name="confirm_passwd" placeholder="請再次輸入密碼" required="">
                                </td>
                              </tr>
                            </table>
                        </div>
                        
                        <div class="form-check" style="text-align: left; margin: 20px 0; color: #ef4300;" >
							<p align="center">
								<label class="form-check-label">
								  <input class="form-check-input" type="checkbox" value="1" id="readMe">
								</label>
								<span class="b_14">我已詳細閱讀</span><a id="gvGridView_ctl02_hlContents" class="blue_16" onclick="showTerms()" style="cursor:pointer;"> <u style="font-weight: bold;">服務條款</u> </a><span class="b_14">並同意內容。</span>
							</p>
                        </div>
                        <br>
						
						<!--<input type="text" class="user" name="email" placeholder="請將下方顯示的驗證碼輸入至欄位中" required="">
                        <div><img src="images/code.jpg">　<a href="#"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> 看不懂請換一組驗證碼</a></div>-->
						<div align="center" class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>"></div>
						<br>
						<br>
						<div id="trems" style="display:none; text-align:left;" role="alert">
							<?php include_once("TermsOfService.php"); ?>
						</div>					  
                      <input type="button" value=" 下一步 " onclick="checkForm1();"> 
                    
					</div>  
                  </div>
                </div>
				
				
				<div id="form2" style="display: none;" class="frameBOX">
                  <div class="alert alert-success" role="alert" >
                      <p><strong>【隱私權聲明】</strong>親愛的客戶，您個人的隱私權，城市綠洲股份有限公司絕對尊重並予以保護。</p>
                  </div>  
                  <div class="login-page">      
                    <div class="register-body">
                      <div style="width:100%;" align="center">
                          	<img src="images/login_mark.jpg" width="80" height="80">
                            <div style="height:20px;"></div>
                            <table cellpadding="0" cellspacing="0" width="100%">
                              <tr height="55">
                                <td width="22%" style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">會員帳號</span>
                                </td>
                                <td width="3%"><!----></td>
                                <td width="75%" align="left">
                                    <input type="text" class="form-control" id="EMailReadyOnly" placeholder="" name="" readonly="true">
                                </td>
                              </tr>	
                              <tr height="55">
                                <td width="22%" style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">中文姓名</span>
                                </td>
                                <td width="3%"><!----></td>
                                <td width="75%" align="left">
                                    <input type="text" class="form-control" id="ChineseName" placeholder="" name="ChineseName">
                                </td>
                              </tr>
                              <tr height="55">
                                <td style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ffffff;" aria-hidden="true"></i> <span class="b_14">英文姓名</span>
                                </td>
                                <td><!----></td>
                                <td valign="middle">
                                	<input type="text" class="form-control" id="EnglishName" placeholder="" name="EnglishName">
                                </td>
                              </tr>
                              <tr height="70">
                                <td style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">暱稱</span>
                                </td>
                                <td><!----></td>
                                <td style="text-align:left;">
                                	<input type="text" class="form-control" id="NickName" placeholder="" name="NickName">
                                </td>
                              </tr>
                              <tr height="55">
                                <td style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">性別</span>
                                </td>
                                <td><!----></td>
                                <td style="text-align:left;">
                                	<input type="radio" name="Gender" value="1" <? echo $Male; ?> > <span class="b_14">男</span>
                                    &nbsp;&nbsp;
                                    <input type="radio" name="Gender" value="0" <? echo $Female; ?> > <span class="b_14">女</span>
                                </td>
                              </tr>
                              <tr height="55">
                                <td style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">生日</span>
                                </td>
                                <td><!----></td>
                                <td style="text-align:left;">
                                	<input type="date" class="form-control" id="Birthday" placeholder="" name="Birthday">
                                </td>
                              </tr>
                              <tr height="55">
                                <td style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">身分證字號</span>
                                </td>
                                <td><!----></td>
                                <td style="text-align:left;">
                                	<input type="text" class="form-control" id="IdentityNo" placeholder="" name="IdentityNo">
                                </td>
                              </tr>
                              <tr height="55">
                                <td style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">行動電話</span>
                                </td>
                                <td><!----></td>
                                <td style="text-align:left;">
                                	<input type="text" class="form-control" id="Mobile" placeholder="" name="Mobile">
                                </td>
                              </tr>
                              <tr height="55">
                                <td style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ffffff;" aria-hidden="true"></i> <span class="b_14">市內電話</span>
                                </td>
                                <td><!----></td>
                                <td style="text-align:left;">
                                	<input type="tel" class="form-control" id="HomeTel" placeholder="" name="HomeTel">
                                </td>
                              </tr>
                              <tr height="55">
                                <td style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ffffff;" aria-hidden="true"></i> <span class="b_14">傳真號碼</span>
                                </td>
                                <td><!----></td>
                                <td style="text-align:left;">
                                	<input type="tel" class="form-control" id="Fax" placeholder="" name="Fax">
                                </td>
                              </tr>
                              <tr height="55">
                                <td style="text-align:right;">
                                	<i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">通訊地址</span>
                                </td>
                                <td><!----></td>
                                <td style="text-align:left;">
                                  <div id="twzipcode"></div>
                                  <input type="add" class="form-control" id="Address" placeholder="" name="Address">
                                </td>
                              </tr>                              
                              <tr>
                                <td colspan="3" height="30"><!----></td>
                              </tr>
                              <tr height="40">
                                <td colspan="3" style="text-align:center;">
                                    <label class="form-check-label">
                                      <input class="form-check-input" type="checkbox" name="Sms" value="1" checked>
                                      <span class="b_14">我願意收到城市綠洲【簡訊】通知。</span>
                                    </label>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3" height="10"><!----></td>
                              </tr>
                              <tr height="40">
                                <td colspan="3" style="text-align:center;">
                                    <label class="form-check-label">
                                      <input class="form-check-input" type="checkbox" name="Subscribe" value="1" checked>
                                      <span class="b_14">我願意收到城市綠洲【E-mail】通知。</span>
                                    </label>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3" height="20"><!----></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                    <input type="button" value="回上一步 " onclick="show('form1', 'form2')">  
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="button" value=" 確定註冊 " onclick="checkForm2()">
                                    <input type="hidden" name="action" value="register">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3" height="20"><!----></td>
                              </tr>
                            </table>
                      </div>
                    </div>  
                  </div>
                </div>
				</form>
            </div>
        </div>
        <div style="height:50px;"></div>
    </div>
 <?php include_once("_include/_footer.php"); ?>
    <!-- easing plugin ( optional ) -->
    <script src="js-top/easing.js" type="text/javascript"></script>
    <!-- UItoTop plugin -->
    <script src="js-top/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- Starting the plugin -->
    <script type="text/javascript">
		function pageInitial(){
            var bodyHeight = document.body.clientHeight;
            $("#divDetailBody").attr("style", "overflow:auto;height:" + (bodyHeight - 105) + "px");
            $("input[type=submit], button" ).button();
        }
		
		
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
			document.getElementById("dataFrom").submit()
		}
		
		function checkAccountByForm(key, value, form) {
			$.ajax({
				url: 'checkAccount.php?'+key+'='+value,
				type: 'GET',
				async: false,
				success: function(result) {
					if (result) {
						alert(result);
					} else {
						if (form == 'form1') {
							show('form1', 'form2');
						} else {
							formSubmit();
						}
					}
				}
			});
		};
		
		function show(id1, id2)
		{
		  var f1=document.getElementById(id1);
		  var f2=document.getElementById(id2);

		  if(document.getElementById('readMe').checked == true){
  	  		  var response = grecaptcha.getResponse();
			  if(response.length == 0) {
			  	alert("請驗證不為機器人!");
			  	return;
			  }
			  if( f1.style.display == 'none' )
			  {
				f1.style.display='';
				f2.style.display='none';
			  }
			  else
			  {
				f1.style.display='none';
				f2.style.display='';
			  }
        $('#twzipcode').twzipcode({
          countyName:"AddressCounty",
          districtName:"AddressDistrict",
          zipcodeName:"PostalCode",
          css:['AddressCounty form-control','AddressDistrict form-control','PostalCode form-control'],
          readonly:true
        });
        $(".PostalCode").css("width","auto").css("display","inline");
        $(".AddressCounty").css("width","auto").css("display","inline").css("font-size","14px");
        $(".AddressDistrict").css("width","auto").css("display","inline").css("font-size","14px");
		  } else {
				alert("請詳細閱讀並同意《服務條款》!");
		  }
		}
		
		function showTerms()
		{
		  var termsDiv = document.getElementById("trems");
			if( termsDiv.style.display == 'none' )
			{
				termsDiv.style.display='';
			}
			else
			{
				termsDiv.style.display='none';
			}
		}
		
		function validateEmail(Email) {
		    var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		    return $.trim(Email).match(pattern) ? true : false;
		}

		function checkForm1() {
			var EMail = document.dataFrom.EMail.value;
			if(EMail == ""){   
				alert("請填寫帳號!");
				document.dataFrom.EMail.focus();
				return false;
			}
			if(!validateEmail(EMail)){
				alert("Email格式不正確!");
				return false;
			}
			
			$("#EMailReadyOnly").val($("#EMail").val());

			var new_passwd = document.dataFrom.new_passwd.value;
			var confirm_passwd = document.dataFrom.confirm_passwd.value;
			
			if (new_passwd && confirm_passwd) {
				if (new_passwd != confirm_passwd) {
					alert("新密碼兩次輸入不相同!");
					document.dataFrom.Address.focus();
					return false;
				} else {
					//var str = obj.value;
					var regUpper = /[A-Z]/;
					var regLower = /[a-z]/;
					var regNum = /[0-9]/;
					var complex = 0;
					if (regLower.test(new_passwd)) {
						++complex;
					}
					if (regUpper.test(new_passwd)) {
						++complex;
					}
					if (regNum.test(new_passwd)) {
						++complex;
					}
					if (complex < 3) {
						alert("密碼格式須要有英文大小寫及數字!");
						document.dataFrom.Address.focus();
						return false
					}
					if (new_passwd.length < 8) {
						alert("密碼格式須要有 8 個字母!");
						document.dataFrom.Address.focus();
						return false
					}
					if (new_passwd.length > 30) {
						alert("密碼格式不可超過 30 個字母!");
						document.dataFrom.Address.focus();
						return false
					}
				}
				checkAccountByForm('EMail', EMail, 'form1');
			}else{
				if(!new_passwd){
					alert("請填寫密碼！");
					return false;
				}else if(!confirm_passwd){
					alert("請確認密碼！");
					return false;
				}
			}
		}	

		function checkForm2() {	
			var i;

			var ChineseName = document.dataFrom.ChineseName.value;
			if(ChineseName == ""){   
				alert("請填寫中文姓名!");
				document.dataFrom.ChineseName.focus();
				return false;
			} else {
				for(i=0; i<ChineseName.length; i++)   {
					var chineseChar = ChineseName[i];
					if(chineseChar.charCodeAt(i) < 0x4E00 || chineseChar.charCodeAt(i) > 0x9FA5) {
						alert("中文姓名請填寫中文!");
						ChineseName.focus();
						return false;
					}
				}
			}
			
			var NickName = document.dataFrom.NickName.value;
			if(NickName == ""){   
				alert("請填寫暱稱!");
				document.dataFrom.NickName.focus();
				return false;
			}
			
			var Gender = document.dataFrom.Gender.value;
			if(Gender == ""){   
				alert("請選擇性別!");
				document.dataFrom.Gender.focus();
				return false;
			}

			var Birthday = document.dataFrom.Birthday.value;
			if(Birthday == ""){   
				alert("請填寫生日!");
				document.dataFrom.Birthday.focus();
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

      var AddressCounty = document.dataFrom.AddressCounty.value;
      if(AddressCounty == ""){   
        alert("請選擇縣市!");
        document.dataFrom.AddressCounty.focus();
        return false;
      }

      var AddressDistrict = document.dataFrom.AddressDistrict.value;
      if(AddressDistrict == ""){   
        alert("請選擇鄉鎮市區!");
        document.dataFrom.AddressDistrict.focus();
        return false;
      }

			var Address = document.dataFrom.Address.value;
			if(Address == ""){   
				alert("請填寫地址!");
				document.dataFrom.Address.focus();
				return false;
			}
			
			checkAccountByForm('IdentityNo', IdentityNo, 'form2');
		}
    </script>
</body>
</html>