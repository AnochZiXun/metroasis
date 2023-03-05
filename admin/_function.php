<?php

//$table:表格名稱 
function truncateTable($table) {
	$query_truncate = "TRUNCATE TABLE $table"; 	
	//echo $query_truncate."</br>";
	mysql_query($query_truncate);
	return;	
}

//$table:表格名稱 return欄位名稱陣列
function getFieldName($table)
{
	$result = mysql_query("DESC $table");	
	$rowCount = (int)mysql_num_rows($result);	
	for($i = 0; $i < $rowCount; $i++)
	{		 
		$record = mysql_fetch_assoc($result);
		$skipColumn	= array('BannerID');
		//echo $record['Field']."</br>";
		
		if(in_array($record['Field'], $skipColumn))			
			continue;

		$fieldNameArray[] = $record['Field'];
		
		//name：欄位名稱 
		//table：欄位所屬的資料表名稱
		//max_length：欄位的最大長度
		//not_null：欄位是否不可是null 是1否0
		//primary_key：欄位是否為主鍵 是1否0
		//numeric：欄位是否為數值 是1否0
		//type：欄位的資料型態
	}
		
	return $fieldNameArray;
}


//新增資料 $table:表格名稱 , $index:第N筆資料
function insertRow($table, $index) {
    $fieldArray = getFieldName($table);

    $size = sizeof($fieldArray);

    $query_insert = "INSERT INTO $table (";

    for ($i = 0; $i < $size - 1; ++$i) {
        $query_insert .= $fieldArray[$i].",";
    }

    $last = $size - 1;
    $query_insert .= $fieldArray[$last];

    $query_insert .= ") VALUES (";

    for ($i = 0; $i < $size - 1; ++$i) {
		if ($fieldArray[$i] == 'IsOpenNew') {
			$query_insert .= "'".$_POST["rbl".$fieldArray[$i].$index]."',";			
		} else {
			$query_insert .= "'".$_POST["txt".$fieldArray[$i].$index]."',";			
		}
	}
	if ($fieldArray[$i] == 'IsOpenNew') {
		$query_insert .= "'".$_POST["rbl".$fieldArray[$last].$index]."')";
	} else {
		$query_insert .= "'".$_POST["txt".$fieldArray[$last].$index]."')";
	}
    //echo $query_insert."</br>";
    mysql_query($query_insert);

    return;
}

function getFieldData($id,$table,$whereName,$field) {
	$query_sql = "SELECT $field FROM $table WHERE $whereName=$id";
	$query_result = mysql_query($query_sql);
	if($query_result) {
		$row=mysql_fetch_assoc($query_result);  
		return $row[$field];		
	} else {
		return NULL;
	}
}

function isFileExtensionAllowed($filename, $allowedExtensionArr){
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowedExtensionArr) ) {
    	return false;
	}else{
		return true;
	}
}

?>