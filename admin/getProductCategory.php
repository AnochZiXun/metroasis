<?
include('_connMysql.php');
include('check_login.php');

if(isset($_GET["tableName"])) {
	$tableName = $_GET["tableName"];
	$parentCategoryId = $_GET["parentCategoryId"];
	$category_sql;
	if("ProductCategory2" == $tableName or "ProductCategory3" == $tableName) {
		$category_sql = "SELECT * FROM $tableName WHERE 1 and ParentCategoryId=$parentCategoryId order by CategorySort";
	}
	if($category_sql) {
		$category_result = mysql_query($category_sql);
	}
	
	$rows = array();
	if ($category_result) {
		while($category = mysql_fetch_assoc($category_result)) {
			$rows[] = $category;
		}
	}

	$result = array('Category' => $rows);
	echo json_encode($result);
}

?>