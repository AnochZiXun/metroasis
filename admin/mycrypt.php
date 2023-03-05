<?php
 class mycrypt{   
	#金鑰, 請勿修改, 要修改請記得先對DB資料重新加密
	const KEY = "xup6gjcl4ji3vu3cj0su3";
	#金鑰, 請勿修改, 要修改請記得先對DB資料重新加密
	function encrypt($str){
	  $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
	  $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);  
	  return base64_encode(trim(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, self::KEY, $str, MCRYPT_MODE_ECB, $iv)));  
	}
	function decrypt($str){
	  $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
	  $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	  return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, self::KEY, base64_decode($str), MCRYPT_MODE_ECB, $iv));  
	} 
}
?>