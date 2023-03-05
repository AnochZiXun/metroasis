<?php 

include('check_login.php');

include('_connMysql.php');

include_once("css/EricChang.css");



$UrlPath = $_SERVER['PHP_SELF'];

$PageName = split('[/]', $UrlPath);

$MenuUrl = $PageName[count($PageName)-1];



$SystemMenu_Sql = "SELECT MenuName FROM SystemMenus WHERE MenuUrl='$MenuUrl'";

$recSystemMenu = mysql_query($SystemMenu_Sql);

$rowSystemMenu = mysql_fetch_assoc($recSystemMenu);

$MenuName = $rowSystemMenu['MenuName'];

?>

<table width="100%" border="0px" cellpadding="0" cellspacing="0">

    <tr>

        <td style="width: 100%;" valign="top">

                <table class="TableNoLine" style="width: 100%;">

                    <tr>

                        <td align="right">

                            <table width="100%" cellpadding="0" cellspacing="0">

                                <tr height="36">

                                	<td width="162">

                                    	<!---->

                                    </td> 

                                    <td align="left"  bgcolor="#eaeaea">

                                    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="orange_18_de5106">❖ <? echo $rowSystemMenu['MenuName']; ?></span>

                                    </td>                                   

                                    <td align="right" bgcolor="#eaeaea" style="width: 300px;" title="click to change password">

                                        <a href="changepassword.php" class="ChangePassword" style="font-size: 14px">

                                            <span class="blue_14">修改密碼</span>

                                        </a>

										&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;

                                        <a href="login.php?logout=true" style=" font-size: 14px">

                                        	<span class="blue_14"><? echo $_SESSION["userName"] ?> 登出</span> 

                                       	</a>

                                        &nbsp;&nbsp;&nbsp;&nbsp;

                                    </td>

                                    <td width="2">

                                    	<!---->

                                    </td>

                                </tr>

                            </table>

                        </td>

                    </tr>

                </table>

        </td>

    </tr>

</table>