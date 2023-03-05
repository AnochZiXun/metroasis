<!DOCTYPE html>
<?php
include('_connMysql.php');
include('check_login.php');
$customerID = $_SESSION["CustomerID"];

$query_CustomersPointRecord = "SELECT * FROM  `CustomersPointRecord` WHERE `CustomerID` = '$customerID' ";	

if (isset($_POST["dateFrom"]) && !empty($_POST["dateFrom"])) {
	$dateFrom = trim($_POST["dateFrom"]);
	$query_CustomersPointRecord = $query_CustomersPointRecord." AND `RecordDate` >= '$dateFrom' ";	
}

if (isset($_POST["dateTo"]) && !empty($_POST["dateTo"])) {
	$dateTo = trim($_POST["dateTo"]);
	$query_CustomersPointRecord = $query_CustomersPointRecord." AND `RecordDate` <= '$dateTo' ";
}

if (isset($_POST["orderId"]) && !empty($_POST["orderId"])) {
	$orderId = trim($_POST["orderId"]);
	$query_CustomersPointRecord = $query_CustomersPointRecord." AND `OrderID` = '$orderId' ";	
}

$rec_CustomersPointRecord = mysql_query($query_CustomersPointRecord);
	
//預設每頁筆數
$pageRow_records = 10;
//總筆數
$total_records = mysql_num_rows($rec_CustomersPointRecord);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records); 
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
     $page=1; //則在此設定起始頁數
} else {
     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$pageRow_records; //每一頁開始的資料序號
//echo $query_CustomersPointRecord.' LIMIT '.$start.', '.$pageRow_records;
$rec_CustomersPointRecord = mysql_query($query_CustomersPointRecord.' LIMIT '.$start.', '.$pageRow_records);

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title>城市綠洲戶外生活館</title>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Dropdown Hover CSS -->
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap-dropdownhover.min.css" rel="stylesheet">    
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/slides.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/style_forBS.css" rel="stylesheet">
    <!--bootstrap-->
    <link href="css/style_forDIY.css" rel="stylesheet">
    <!--bootstrap-->
    <link rel="stylesheet" media="screen,projection" href="css/ui.totop.css" />
    <link href="css/flexslider.css" type="text/css" rel="stylesheet" />
    <script src="js/menu.js"></script>
    <!-- menu下拉 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="js/flycan.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="js/jquery.flexslider-min.js"></script>
    <!-- Bootstrap Dropdown Hover JS -->
    <script src="js/bootstrap-dropdownhover.min.js"></script>  
</head>
<body>
<?php include("_include/_head.php"); ?>
    <!-- 上方選單end -->
    <div id="CONTENT-2">
        <!-- 第一塊大的區塊 -->
        <div class="row">
            <!-- 左欄區塊 -->
            <div class="row leftBOX">
                <!-- 產品menu -->
                <?php include("_include/_productList.php"); ?>
                <!-- 折扣活動 -->
                <?php include("_include/_sale.php"); ?>
            </div>
            <!-- 右欄區塊 -->
            <div class="row rightBOX">
                <!-- 路徑 -->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                  <li class="breadcrumb-item">會員中心</li>
                  <li class="breadcrumb-item active">紅利積點</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 紅利積點
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
                  <div class="col-md-6 col-sm-12">
					  <?php 
						$query_Customers = "SELECT * FROM `Customers` WHERE `CustomerID` = '$customerID'";	
						$rec_Customers = mysql_query($query_Customers);	
						$rows_Customers = mysql_fetch_assoc($rec_Customers);
					  ?>	
                      <div class="pointTB"><p>可用點數</p><p class="NUM fontColorA"><? echo $rows_Customers['Point']; ?></p></div>
                      <div class="pointTB"><p>待發放點數</p><p class="NUM fontColorB">0</p></div>
                      <div class="pointTB"><p>到期點數</p><p class="NUM fontColorC">0</p></div>
                  </div>
                  <div class="col-md-6 col-sm-12 pointTBnote">
                       <p class="NUM fontColorC">贈點使用說明</p>
                        <ul>
                          <li>1.訂單每滿100元扣除運費，可獲紅利贈點1號。</li>
                          <li>2.訂單以單次出貨的總金額計算，扣除運費。</li>
                          <li>3.點數過期即失效，請把握使用時機。</li>
                        </ul>
                      <p align="right"><a href="">詳細使用說明></a></p>
                  </div>
                  <div class="col-md-12 TABLE_BOX">
                    <div class="pointSEARCH">
                      入帳日期：<input type="text" placeholder="選擇日期">　~　<input type="text" placeholder="選擇日期">　
                      訂單編號：<input type="text" placeholder="輸入訂單編號">　<a href="#"><button type="button" class="btn btn-success btn-lg">搜尋</button></a>
                    </div>
                    <table class="table table-hover">
                      <thead class="thead-info">
                        <tr class="secondary">
                          <th>No.</th>
                          <th>入帳日期</th>
                          <th>獲得點數</th>
                          <th>兌換點數</th>
                          <th>訂單編號</th>
                          <th>備註</th>
                        </tr>
                      </thead>					
                      <tbody>
						<?php while($row_CustomersPointRecord=mysql_fetch_assoc($rec_CustomersPointRecord)){ ?>
                        <tr>
                          <th scope="row"><? echo $row_CustomersPointRecord['RecordID']; ?></th>
                          <td class="UB"><? echo $row_CustomersPointRecord['RecordDate']; ?></td>
                          <td><span class="colorE"><? echo $row_CustomersPointRecord['PointPlus']; ?></span></td>
                          <td><span class="colorD"><? echo $row_CustomersPointRecord['PointPlus']; ?></span></td>
                          <td><? echo $row_CustomersPointRecord['OrderID']; ?></td>
                          <td><? echo $row_CustomersPointRecord['Memo']; ?></td>
                        </tr>
						<?}?>                       
                      </tbody>
                    </table>
                  </div>
				  <form action="" method="POST" enctype="multipart/form-data" id="startSearch" name="startSearch">
                    <div class="SEARCH">
                      入帳日期：<input name="dateFrom" type="date" placeholder="選擇日期">　~　<input name="dateTo" type="date" placeholder="選擇日期">
                      訂單編號：<input name="orderId" type="number" placeholder="輸入訂單編號">　
					  <a href="#"><button type="submit" class="btn btn-success btn-lg">搜尋</button></a>
                    </div>
				  </form>
                  <div class="TABLE_BOX_mobile">
					  <? 
						mysql_data_seek($rec_CustomersPointRecord, 0);
						while($row_CustomersPointRecord=mysql_fetch_assoc($rec_CustomersPointRecord)){ 
					  ?>	
                      <div class="tableMO">
                          <p>No.<? echo $row_CustomersPointRecord['RecordID']; ?></p>
                          <p class="colorA">入帳日期：<? echo $row_CustomersPointRecord['RecordDate']; ?></p>
                          <p>獲得點數：<span class="colorE"><? echo $row_CustomersPointRecord['PointPlus']; ?></span></p>
                          <p>兌換點數：<span class="colorD"><? echo $row_CustomersPointRecord['PointPlus']; ?></span></p>
                          <p>訂單編號：<? echo $row_CustomersPointRecord['OrderID']; ?></p>
                          <p><? echo $row_CustomersPointRecord['Memo']; ?></p>
                          <button type="button" class="btn btn-danger btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> 我要兌換</button>
                      </div> 
					  <?}?>    
                  </div>

                    <div class="pageBOX">
                      <ul class="pagination">
						<?	
							$prePage = $page-1;
							if ($prePage < 1) {
								$prePage = 1;
							}
						?>
                        <li><a href="point.php?page=<?echo $prePage; ?>"><span aria-hidden="true">&laquo;</span></a></li>
						<? 	for ($i=1 ; $i<=$total_pages ; $i++ ) { ?>								
							<li <? if ($page == $i) { echo "class='active'";} ?>><a href="point.php?page=<?echo $i; ?>"><? echo $i; ?></a></li>
						<? } ?>
						<?	
							$nextPage = $page+1;
							if ($nextPage > $total_pages) {
								$nextPage = $total_pages;
							}
						?> 
                        <li><a href="point.php?page=<?echo $nextPage; ?>"><span aria-hidden="true">&raquo;</span></a></li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php include("_include/_footer.php"); ?>
    <!-- easing plugin ( optional ) -->
    <script src="js-top/easing.js" type="text/javascript"></script>
    <!-- UItoTop plugin -->
    <script src="js-top/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- Starting the plugin -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */
            
            $().UItoTop({ easingType: 'easeOutQuart' });
            
        });
    </script>
</body>
</html>