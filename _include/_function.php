<?php
//keep
function keepBrowsingHistory($productID) {
	$BrowsingHistory_Arr;	
	if (!isset($_SESSION["CustomerID"])) {
		if (!isset($_SESSION["BrowsingHistory_Arr"])) {
			$BrowsingHistory_Arr = array();
			array_push($BrowsingHistory_Arr, $productID);
			$BrowsingHistory_Arr = array_unique($BrowsingHistory_Arr);
			$_SESSION["BrowsingHistory_Arr"]=$BrowsingHistory_Arr;    		
		} else {
			$BrowsingHistory_Arr = $_SESSION["BrowsingHistory_Arr"];
			array_push($BrowsingHistory_Arr, $productID);	
			$BrowsingHistory_Arr = array_unique($BrowsingHistory_Arr);
			$_SESSION["BrowsingHistory_Arr"]=$BrowsingHistory_Arr;    			
		}		 
	} else {
		$customerID = $_SESSION["CustomerID"];		
		if (isset($_SESSION["BrowsingHistory_Arr"])) { 
			$BrowsingHistory_Arr = $_SESSION["BrowsingHistory_Arr"];
			foreach ($BrowsingHistory_Arr as $value) {
				$insertBrowsingHistory = "INSERT INTO `BrowsingHistory`(`ProductID`, `CustomerID`) VALUES ('$value','$customerID')";
				mysql_query($insertBrowsingHistory);
			}
			unset($_SESSION["BrowsingHistory_Arr"]);
		} 
		
		$insertBrowsingHistory = "INSERT INTO `BrowsingHistory`(`ProductID`, `CustomerID`) VALUES ('$productID','$customerID')";
		mysql_query($insertBrowsingHistory);			
	
	}
	//echo print_r($BrowsingHistory_Arr);
	//return;
}


?>
