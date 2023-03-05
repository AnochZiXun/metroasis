<?php
  $to ="waynewang.s911@gmail.com"; //收件者
  $subject = "城市綠洲-重設會員密碼信"; //信件標題
  $msg = "親愛的會員 您好：						您的新密碼：Aa123456						請用此密碼登入，並修改您的密碼，謝謝！						(首頁 > 會員中心 > 修改資料)";//信件內容
  $headers = "From: mr.wayne@ipo-intl.com"; //寄件者
  
  if(mail("$to", "$subject", "$msg", "$headers")):
   echo "信件已經發送成功。";//寄信成功就會顯示的提示訊息
  else:
   echo "信件發送失敗！";//寄信失敗顯示的錯誤訊息
  endif;
?>