<?  $ecPlatform = json_decode('[{"name":"91APP","value":"0"},{"name":"超級商城","value":"0"},{"name":"摩天商城","value":"0"},{"name":"商店街","value":"0"},{"name":"樂天","value":"0"},{"name":"亞東","value":"0"},{"name":"7net","value":"0"},{"name":"拍賣","value":"0"},{"name":"博(寄)","value":"0"},{"name":"博(轉)","value":"0"},{"name":"24小時購物","value":"0"}]');
	foreach($ecPlatform as $array)
    {
         echo $array->name . "=" . $array->value . "<br />";
    }  
?>