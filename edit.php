<?php 
session_start();
include_once("_connMysql.php");
//檢查是否經過登入
include_once("check_login.php");
include_once('admin/mycrypt.php');
$mycrypt = new mycrypt;
$CustomerID = $_SESSION["CustomerID"];
$query = "select * from Customers where CustomerID = $CustomerID";
$Record = mysql_query($query);
$Result = mysql_fetch_assoc($Record); 
if(isset($_POST["action"]) && $_POST["action"] == 'update'){
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
	
	$orig_passwd = $_POST["orig_passwd"];
	$new_passwd = $mycrypt->encrypt($_POST["new_passwd"]);
	$confirm_passwd = $_POST["confirm_passwd"];
	
	$updateSql = "UPDATE Customers SET ChineseName='$ChineseName',EnglishName='$EnglishName',NickName='$NickName',
					Gender=$Gender,Birthday='$Birthday',IdentityNo='$IdentityNo',Mobile='$Mobile',EMail='$EMail',
					HomeTel='$HomeTel',Fax='$Fax',Address='$Address',Sms=$Sms,Subscribe=$Subscribe,Passwd='$new_passwd',
          PostalCode='$PostalCode',AddressCounty='$AddressCounty',AddressDistrict='$AddressDistrict'
					WHERE CustomerID = $CustomerID";
	//echo $updateSql;
	mysql_query($updateSql);
	
	unset($_SESSION["NickName"]);
	$_SESSION["NickName"] = $NickName;
	
	header("Location: edit.php");
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
    <script src="js/jquery.twzipcode.js"></script>
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
                  <li class="breadcrumb-item"><a href="#">會員專區</a></li>
                  <li class="breadcrumb-item active">個人資料</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 個人資料
                    <div class="FloatR"></div>
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
                  <div class="alert alert-success" role="alert" >
                      <p><strong>【隱私權聲明】</strong>親愛的客戶，您個人的隱私權，城市綠洲股份有限公司絕對尊重並予以保護。 <i class="fa fa-star" aria-hidden="true"></i> 必填</p>
                  </div>  
                  <div class="login-page">      
                    <div class="register-body">
                      <div style="width:100%;" align="center">
                      
                      
                      
                      		<img src="images/login_mark.jpg" width="80" height="80">
                            <div style="height:20px;"></div>
                      		<form action="edit.php" method="POST" enctype="multipart/form-data" id="updateFrom" name="updateFrom" onsubmit="return checkForm();">
    							<table cellpadding="0" cellspacing="0" width="100%">
                                  <tr height="55">
                                    <td width="22%" style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">會員帳號</span>
                                    </td>
                                    <td width="3%"><!----></td>
                                    <td width="75%" align="left">
                                      <input type="email" class="form-control" id="EMail" placeholder="您的E-mail帳號" value="<? echo $Result["EMail"]; ?>" >
                                    </td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">中文姓名</span>
                                    </td>
                                    <td><!----></td>
                                    <td align="left">
                                        <input type="text" style="color: black;" class="form-control" id="ChineseName" placeholder="" name="ChineseName" value="<? echo $Result["ChineseName"]; ?>">
                                    </td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ffffff;" aria-hidden="true"></i> <span class="b_14">英文姓名</span>
                                    </td>
                                    <td><!----></td>
                                    <td valign="middle">
                                      <input type="text" style="color: black;" class="form-control" id="EnglishName" placeholder="" name="EnglishName" value="<? echo $Result["EnglishName"]; ?>">
                                    </td>
                                  </tr>
                                  <tr height="70">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">暱稱</span>
                                    </td>
                                    <td><!----></td>
                                    <td style="text-align:left;">
                                      <input type="text" style="color: black;" class="form-control" id="NickName" placeholder="" name="NickName" value="<? echo $Result["NickName"]; ?>">
                                    </td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">性別</span>
                                    </td>
                                    <td><!----></td>
                                    <td style="text-align:left;">
										<? 
                                            if($Result["Gender"] == 1){   $Male = "checked"; }
											                      else{ $Female = "checked"; }
                                        ?>
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
                                      <input type="date" style="color: black;" class="form-control" id="Birthday" placeholder="" name="Birthday" value="<? echo $Result["Birthday"]; ?>">
                                    </td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">身分證字號</span>
                                    </td>
                                    <td><!----></td>
                                    <td style="text-align:left;">
                                      <input type="text" style="color: black;" class="form-control" id="IdentityNo" placeholder="" name="IdentityNo" value="<? echo $Result["IdentityNo"]; ?>">
                                    </td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">行動電話</span>
                                    </td>
                                    <td><!----></td>
                                    <td style="text-align:left;">
                                      <input type="text" style="color: black;" class="form-control" id="Mobile" placeholder="" name="Mobile" value="<? echo $Result["Mobile"]; ?>">
                                    </td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ffffff;" aria-hidden="true"></i> <span class="b_14">市內電話</span>
                                    </td>
                                    <td><!----></td>
                                    <td style="text-align:left;">
                                      <input type="tel" style="color: black;" class="form-control" id="HomeTel" placeholder="" name="HomeTel" value="<? echo $Result["HomeTel"]; ?>">
                                    </td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ffffff;" aria-hidden="true"></i> <span class="b_14">傳真號碼</span>
                                    </td>
                                    <td><!----></td>
                                    <td style="text-align:left;">
                                      <input type="tel" style="color: black;" class="form-control" id="Fax" placeholder="" name="Fax" value="<? echo $Result["Fax"]; ?>">
                                    </td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">通訊地址</span>
                                    </td>
                                    <td><!----></td>
                                    <td style="text-align:left;">
                                      <div id="twzipcode"></div>
                                      <input type="add" class="form-control" id="Address" placeholder="" name="Address" value="<? echo $Result["Address"]; ?>">
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" height="30"><!----></td>
                                  </tr>
                                  <tr height="40">
                                    <td colspan="3" style="text-align:center;">
                                        <? if ($Result["Sms"] == 1){ $checkedSms = "checked"; } ?>
                                        <input class="form-check-input" type="checkbox" name="Sms" value="1" <? echo $checkedSms; ?> >
                                        <span class="b_14">我願意收到城市綠洲【簡訊】通知。</span>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" height="10"><!----></td>
                                  </tr>
                                  <tr height="40">
                                    <td colspan="3" style="text-align:center;">
                                        <? if ($Result["Subscribe"] == 1){ $checkedSubscribe = "checked"; } ?>
                                        <input class="form-check-input" type="checkbox" name="Subscribe" value="1" <? echo $checkedSubscribe; ?> >
                                        <span class="b_14">我願意收到城市綠洲【E-mail】通知。</span>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" height="30"><!----></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" height="30" bgcolor="#ffbfdd" align="center" style="vertical-align:middle;">
                                    	<span class="b_14">修改密碼</span>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" height="30"><!----></td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">舊密碼</span>
                                    </td>
                                    <td><!----></td>
                                    <td valign="middle">
                                    	<input type="password" class="form-control" id="orig_passwd" name="orig_passwd" >
                                    	<input type="hidden" class="form-control" id="db_passwd" name="db_passwd" value="<? echo $mycrypt->decrypt($Result["Passwd"]); ?>">
                                    </td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">新密碼</span>
                                    </td>
                                    <td><!----></td>
                                    <td valign="middle">
                                    	<input type="password" class="form-control" id="new_passwd" name="new_passwd" >
                                    </td>
                                  </tr>
                                  <tr height="55">
                                    <td style="text-align:right;">
                                        <i class="fa fa-star" style="color:#ff3333;" aria-hidden="true"></i> <span class="b_14">新密碼確認</span>
                                    </td>
                                    <td><!----></td>
                                    <td valign="middle">
                                    	<input type="password" class="form-control" id="confirm_passwd" name="confirm_passwd" >
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" height="20"><!----></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3">
                                    	<input style="width:20%" type="submit" value=" 確定修改 ">
                                    	<input type="hidden" name="action" value="update">
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" height="20"><!----></td>
                                  </tr>
                                </table>                        
                        </form>
                                    	
                      </div>
                    </div>  
                    <div style="height:50px;"></div>
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
            
            $('#twzipcode').twzipcode({
              countyName:"AddressCounty",
              districtName:"AddressDistrict",
              zipcodeName:"PostalCode",
              css:['AddressCounty form-control','AddressDistrict form-control','PostalCode form-control'],
              readonly:true,
              countySel:"<? echo $Result["AddressCounty"] ?>",
              districtSel:"<? echo $Result["AddressDistrict"] ?>",
            });
            $(".PostalCode").css("width","auto").css("display","inline");
            $(".AddressCounty").css("width","auto").css("display","inline").css("font-size","14px");
            $(".AddressDistrict").css("width","auto").css("display","inline").css("font-size","14px");

        });
		
		function checkForm() {
			var i;
			
			var EMail = document.updateFrom.EMail.value;
			if(EMail == ""){   
				alert("請填寫帳號!");
				document.updateFrom.EMail.focus();
				return false;
			}
			
			var ChineseName = document.updateFrom.ChineseName.value;
			if(ChineseName == ""){   
				alert("請填寫中文姓名!");
				document.updateFrom.ChineseName.focus();
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
			
			var NickName = document.updateFrom.NickName.value;
			if(NickName == ""){   
				alert("請填寫暱稱!");
				document.updateFrom.NickName.focus();
				return false;
			}
			
			var Birthday = document.updateFrom.Birthday.value;
			if(Birthday == ""){   
				alert("請填寫生日!");
				document.updateFrom.Birthday.focus();
				return false;
			}
			
			var IdentityNo = document.updateFrom.IdentityNo.value;
			if(IdentityNo == ""){   
				alert("請填寫身份證字號!");
				document.updateFrom.IdentityNo.focus();
				return false;
			} else {
				IdentityNo = IdentityNo.toUpperCase();
				if(IdentityNo.search(/^[A-Z](1|2)\d{8}$/i) == -1){
					alert("請填寫正確身份證字號格式!" );
					document.updateFrom.IdentityNo.focus();
					return false;
				}
			}
			
			var Mobile = document.updateFrom.Mobile.value;
			if(Mobile == ""){   
				alert("請填寫行動電話!");
				document.updateFrom.Mobile.focus();
				return false;
			} else {
				if(Mobile.search(/^[09]{2}[0-9]{8}$/) == -1){
					alert("請填寫正確行動電話格式!" );
					document.updateFrom.Mobile.focus();
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

			var Address = document.updateFrom.Address.value;
			if(Address == ""){   
				alert("請填寫地址!");
				document.updateFrom.Address.focus();
				return false;
			}
				
			var db_passwd = document.updateFrom.db_passwd.value;
			var orig_passwd = document.updateFrom.orig_passwd.value;
			var new_passwd = document.updateFrom.new_passwd.value;
			var confirm_passwd = document.updateFrom.confirm_passwd.value;
			
			if (orig_passwd) {
				if (orig_passwd != db_passwd) {
					alert("舊密碼錯誤!");
					document.updateFrom.Address.focus();
					return false;
				}
			}
			
			if (orig_passwd && new_passwd) {
				if (orig_passwd == new_passwd) {
					alert("新舊密碼不可相同!");
					document.updateFrom.Address.focus();
					return false;
				}
			}
			
			if (new_passwd && confirm_passwd) {
				if (new_passwd != confirm_passwd) {
					alert("新密碼兩次輸入不相同!");
					document.updateFrom.Address.focus();
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
						document.updateFrom.Address.focus();
						return false
					}
					if (new_passwd.length < 8) {
						alert("密碼格式須要有 8 個字母!");
						document.updateFrom.Address.focus();
						return false
					}
					if (new_passwd.length > 30) {
						alert("密碼格式不可超過 30 個字母!");
						document.updateFrom.Address.focus();
						return false
					}
				}
			}
		}
    </script>
</body>
</html>