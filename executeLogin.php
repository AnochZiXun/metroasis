<?php
include_once('admin/mycrypt.php');
$mycrypt = new mycrypt; 
session_start();

//errMsg
if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){
	echo "<script type='text/javascript'>alert('密碼輸入錯誤!');</script>";
}

if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="2")){
	echo "<script type='text/javascript'>alert('此帳號尚未註冊!');</script>";
}

//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["email"]);
	unset($_SESSION["ChineseName"]);
	unset($_SESSION["NickName"]);
	unset($_SESSION["CustomerID"]);
	header("Location: index.php");
}

//記住我
if (isset($_POST["rememberMe"])){	
	setcookie("email",$_POST["email"],time()+86400*7);	
	setcookie("rememberMe",$_POST["rememberMe"],time()+86400*7);
} else if (isset($_POST["email"]) && isset($_POST["Passwd"]) && !isset($_POST["rememberMe"])) {
	setcookie("email","");
	setcookie("rememberMe","");
}

//執行會員登入
if(isset($_POST["email"]) && $_POST["email"] != '' && isset($_POST["Passwd"]) && $_POST["Passwd"] != ''){  
    	
	//登入會員資料
    $query_RecLogin = "SELECT * FROM Customers WHERE EMail ='".trim($_POST["email"])."'";
	$RecLogin = mysql_query($query_RecLogin);
	$total_records = mysql_num_rows($RecLogin);
	
	if ($total_records > 0) {
		$row_RecLogin=mysql_fetch_assoc($RecLogin); 
		
		//取出帳號密碼的值
		$email = $row_RecLogin["EMail"];    
		$passwd = $row_RecLogin["Passwd"];
		
		//比對密碼，若登入成功則呈現登入狀態
		if($mycrypt->encrypt($_POST["Passwd"])==$passwd){  
			//設定登入者        
			$_SESSION["EMail"] = $email;        
			$_SESSION["CustomerID"] = $row_RecLogin["CustomerID"];
			$_SESSION["ChineseName"] = $row_RecLogin["ChineseName"];
			$_SESSION["NickName"] = $row_RecLogin["NickName"];
			$_SESSION["Passwd"] = $row_RecLogin["Passwd"];
			header("Location: index.php"); 
			//echo "<script>windos.reload();</script>";
		}else{
			header("Location: login.php?errMsg=1");
		}	
	} else {
		header("Location: login.php?errMsg=2");
	}
}
?>