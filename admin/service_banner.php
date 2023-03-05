<?
include_once('_connMysql.php');

$action = $_POST["action"];

switch ($action) {
	case 'uploadImage':
		$target_dir = "/home/metroasis/public_html/images/banners/banner".$_POST["bannerType"]."/";
		$imgFile = $_FILES["imgFile"];
		if(move_uploaded_file($imgFile['tmp_name'], $target_dir . $imgFile["name"])){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
		break;
	case 'deleteUselessImage':
		$imgArr = array();
		$imgArr = array_merge($imgArr, get_dir_list("/home/metroasis/public_html/images/banners/banner1/"));
		$imgArr = array_merge($imgArr, get_dir_list("/home/metroasis/public_html/images/banners/banner2/"));
		$imgArr = array_merge($imgArr, get_dir_list("/home/metroasis/public_html/images/banners/banner3/"));
		$imgArr = array_merge($imgArr, get_dir_list("/home/metroasis/public_html/images/banners/banner4/"));
		$imgArr = array_merge($imgArr, get_dir_list("/home/metroasis/public_html/images/banners/banner5/"));
		$recBannerImage = mysql_query("SELECT BannerImage FROM Banners");
		if($recBannerImage){
			$doNotKillMe = array();
			while($rowBannerImage = mysql_fetch_assoc($recBannerImage)){
				for($i = 0 ; $i < count($imgArr) ; $i ++){
					if($rowBannerImage["BannerImage"] == $imgArr[$i][0]){
						array_push($doNotKillMe, $i);
						#給後面看到的人, 這裡千萬不能break, 檔名重複的話會掰掰
					}
				}
			}
			for($i = 0 ; $i < count($imgArr) ; $i ++){
				if(!in_array($i, $doNotKillMe)){
					echo $imgArr[$i][0]." / ".$imgArr[$i][1]."<br>";
					unlink($imgArr[$i][1]);
				}
			}
		}
		break;
	default:
		break;
}

//函式功能 列出該路徑下所有的檔案包含子目錄
function get_dir_list($dir){//$dir 資料夾路徑
    if(is_dir($dir)){//如果是資料夾才執行
        $dh = opendir($dir);//打開資料夾
        chdir ($dir);//指定目錄
        $result = array();
        while (($file = readdir($dh)) !== false) {//列出該目錄的所有檔案
            if (is_dir($file) && basename($file)!='.' && basename($file)!='..'){//若是資料夾 且非 . .. 就在呼叫自已一次 
                get_dir_list($a,$file);
            }else if(filename($file) != "." && filename($file) != ".."){//若非 . .. 就列出檔案
            	array_push($result, array("$file",getcwd()."/"."$file"));
            }
        }
        chdir("../");//回到上一層目錄
        closedir($dh);//關閉資料夾
        return $result;
    }
}

function filename($file){
	$info = pathinfo($file);
	return basename($file,'.'.$info['extension']);
}


?>