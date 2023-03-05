<?php 
include('check_login.php');

//NotificationNum for activity Enrollment
$query_Enrollment = "SELECT COUNT(*) AS CNT FROM ActivityEnrollment WHERE CreateDate > '" .date("Y/m/d") . "'";
$rec_Enrollment = mysql_query($query_Enrollment);
$row_Enrollment = mysql_fetch_assoc($rec_Enrollment);
$NotificationNum_Enrollment = $row_Enrollment["CNT"];

//NotificationNum for Orders
$query_Orders = "SELECT COUNT(*) AS CNT FROM Orders WHERE CreateDate > '" .date("Y/m/d") . "'";
$rec_Orders = mysql_query($query_Enrollment);
$row_Orders = mysql_fetch_assoc($rec_Orders);
$NotificationNum_Orders = $row_Enrollment["CNT"];

//echo $query_Enrollment;
//echo $query_Orders;


$query_RoleMenu = "SELECT * FROM `v_SystemUserRoleDetail` WHERE `SystemUsersRoleID`='". $_SESSION["systemUsersRoleID"] ."' and `SystemUserID` ='". $_SESSION["userID"] ."' ORDER BY SortNo,SystemMenuID";
$rec_AllRoleDetail = mysql_query($query_RoleMenu);
$strMenu="";
$strMenu = "<ul id='browser' class='filetree treeview-famfamfam'>";
$intRoot1Cnt = 0;
while($row_AllRoleDetail=mysql_fetch_assoc($rec_AllRoleDetail))
{
	$strOpenWin = $row_AllRoleDetail["IsOpenWin"];
	$intRootID = $row_AllRoleDetail["RootID"];
	$strNotificationNum = "";
	//$allRoleMenuArray[$row_AllRoleDetail["MenuID"]] = $row_AllRoleDetail["MenuName"];	
	switch ($intRootID)
	{
		case "0":
		$strMenu = $strMenu. "<li><span class='folder'>" . $row_AllRoleDetail["MenuName"] . "</span><ul>";
		break;
	case "1":
		if ($intRoot1Cnt == 0)
		{	
			$strMenu = $strMenu. "<li><span class='folder'>" . $row_AllRoleDetail["MenuName"] . "</span>";
		}
		else
		{
			$strMenu = $strMenu. "<li><span class='folder'>" . $row_AllRoleDetail["MenuName"] . "</span>";
		}
			$intRoot1Cnt = $intRoot1Cnt + 1;
		break;
	case "2":
		if ($strOpenWin == "1")
		{
			$strBlank = " Target='_Blank' ";
		}
		else
		{
			$strBlank = "";
		}

		if ($row_AllRoleDetail["SystemMenuID"] == "A1-14"){
			
			if ((int)$NotificationNum_Enrollment > 0)
			{
				$strNotificationNum = "<span class='_5ugh _3z_5'>" . $NotificationNum_Enrollment . "</span>";
			}
			else
			{
				$strNotificationNum = "";
			}
		}
		
		
		if ($row_AllRoleDetail["SystemMenuID"] == "A1-15"){
			if ((int)$NotificationNum_Orders > 0)
			{
				$strNotificationNum = "<span class='_5ugh _3z_5'>" . $NotificationNum_Orders . "</span>";
			}
			else
			{
				$strNotificationNum = "";
			}
		}
		
		$strMenu = $strMenu. "<ul><li><span class='file'><a href='" . $row_AllRoleDetail["MenuUrl"] . "'" . $strBlank . ">" . $row_AllRoleDetail["MenuName"] . "</a> " . $strNotificationNum . "</span></li></ul>";
		break;
	}
}
$strMenu = $strMenu. "</li></ul></li></ul>";	


?>
<div id="divMenu" style="width: 10%; float: left; vertical-align: top;" class="stuff">
    <div id="divMenuTree" style="margin-top: 5px; over-flow:auto;border:0px solid #CCCCCC;">
        <!--選單開始-->
        <? echo $strMenu; ?>
        <!--選單結束-->
    </div>
</div>




