<?php
  $to ="waynewang.s911@gmail.com"; //收件者
  $subject = "測試發信"; //信件標題
  $msg = "smtp發信測試";//信件內容
  $headers = "From: mr.wayne@ipo-intl.com"; //寄件者
  
  if(mail("$to", "$subject", "$msg", "$headers")):
   echo "信件已經發送成功。";//寄信成功就會顯示的提示訊息
  else:
   echo "信件發送失敗！";//寄信失敗顯示的錯誤訊息
  endif;
?>