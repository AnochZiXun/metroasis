<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title>城市綠洲戶外生活館-單車、運動用品、露營、登山、潛水、健行、保暖</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
                  <li class="breadcrumb-item active">訂單查詢</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 訂單查詢
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
                  <div class="SEARCH">
                    訂購日期：<input type="text" placeholder="選擇日期">　~　<input type="text" placeholder="選擇日期">
                    訂單編號：<input type="text" placeholder="輸入訂單編號">　<a href="#"><button type="button" class="btn btn-success btn-lg">搜尋</button></a>
                  </div>
                  <div class="TABLE_BOX">
                    <table class="table table-hover">
                      <thead class="thead-info">
                        <tr class="secondary">
                          <th>No.</th>
                          <th>訂單編號：</th>
                          <th>活動日期</th>
                          <th>訂單金額</th>
                          <th>付款狀態</th>
                          <th>出貨狀態</th>
                          <th>修改資料</th>
                          <th>取消訂單</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">已付款</span></td>
                          <td><span class="colorD">未出貨</span></td>
                          <td><a class="colorE" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorD">未付款</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td><a class="colorE" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">已付款</span></td>
                          <td><span class="colorD">未出貨</span></td>
                          <td><a class="colorE" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorF">取消</span></td>
                          <td><span class="colorF">取消</span></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">已付款</span></td>
                          <td><span class="colorD">未出貨</span></td>
                          <td><a class="colorE" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">已付款</span></td>
                          <td><span class="colorD">未出貨</span></td>
                          <td><a class="colorE" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">已付款</span></td>
                          <td><span class="colorD">未出貨</span></td>
                          <td><a class="colorE" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">已付款</span></td>
                          <td><span class="colorD">未出貨</span></td>
                          <td><a class="colorE" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">已付款</span></td>
                          <td><span class="colorD">未出貨</span></td>
                          <td><a class="colorE" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">已付款</span></td>
                          <td><span class="colorD">未出貨</span></td>
                          <td><a class="colorE" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">8170200000244</td>
                          <td class="UB">2017/06/10 21:38:45</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">已付款</span></td>
                          <td><span class="colorD">未出貨</span></td>
                          <td><a class="colorE" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td><a class="colorD" href=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="TABLE_BOX_mobile">
                      <div class="tableMO">
                          <p>No.1</p>
                          <p class="colorA">訂單編號：8170200000244</p>
                          <p>活動日期：2017/06/10 21:38:45</p>
                          <p>訂單金額：<span class="colorB">1450</span></p>
                          <p>付款狀態：<span class="colorC">已付款</span></p>
                          <p>出貨狀態：<span class="colorD">未出貨</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>   
                      <div class="tableMO">
                          <p>No.2</p>
                          <p class="colorA">訂單編號：8170200000244</p>
                          <p>活動日期：2017/06/10 21:38:45</p>
                          <p>訂單金額：<span class="colorB">1450</span></p>
                          <p>付款狀態：<span class="colorC">已付款</span></p>
                          <p>出貨狀態：<span class="colorD">未出貨</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>   
                      <div class="tableMO">
                          <p>No.3</p>
                          <p class="colorA">訂單編號：8170200000244</p>
                          <p>活動日期：2017/06/10 21:38:45</p>
                          <p>訂單金額：<span class="colorB">1450</span></p>
                          <p>付款狀態：<span class="colorC">已付款</span></p>
                          <p>出貨狀態：<span class="colorD">未出貨</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>   
                      <div class="tableMO">
                          <p>No.4</p>
                          <p class="colorA">訂單編號：8170200000244</p>
                          <p>活動日期：2017/06/10 21:38:45</p>
                          <p>訂單金額：<span class="colorB">1450</span></p>
                          <p>付款狀態：<span class="colorC">已付款</span></p>
                          <p>出貨狀態：<span class="colorD">未出貨</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>   
                      <div class="tableMO">
                          <p>No.5</p>
                          <p class="colorA">訂單編號：8170200000244</p>
                          <p>活動日期：2017/06/10 21:38:45</p>
                          <p>訂單金額：<span class="colorB">1450</span></p>
                          <p>付款狀態：<span class="colorC">已付款</span></p>
                          <p>出貨狀態：<span class="colorD">未出貨</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>   
                      <div class="tableMO">
                          <p>No.6</p>
                          <p class="colorA">訂單編號：8170200000244</p>
                          <p>活動日期：2017/06/10 21:38:45</p>
                          <p>訂單金額：<span class="colorB">1450</span></p>
                          <p>付款狀態：<span class="colorC">已付款</span></p>
                          <p>出貨狀態：<span class="colorD">未出貨</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>   

                  </div>

                    <div style="text-align: center;">
                      <ul class="pagination">
                        <li><a href="#"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><span aria-hidden="true">&raquo;</span></a></li>
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