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
                  <li class="breadcrumb-item active">我的報名</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 我的報名
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
                  <div class="SEARCH">
                    活動名稱：<input type="text" placeholder="輸入關鍵字">　
                    活動狀態：
                    <select class="custom-select">
                      <option selected>- 開放報名 -</option>
                      <option value="1">- 未開放 -</option>
                      <option value="2">- 報名截止 -</option>
                    </select>　
                    報名狀態
                    <select class="custom-select">
                      <option selected>- 未付款 -</option>
                      <option value="1">- 已付清 -</option>
                      <option value="2">- 未完成 -</option>
                    </select>　
                    <a href="#"><button type="button" class="btn btn-success btn-lg">搜尋</button></a>
                  </div>
                  <div class="TABLE_BOX">
                    <table class="table table-hover">
                      <thead class="thead-info">
                        <tr class="secondary">
                          <th>No.</th>
                          <th>活動名稱</th>
                          <th>梯次</th>
                          <th>活動日期</th>
                          <th>活動費用</th>
                          <th>活動狀態</th>
                          <th>報名狀態</th>
                          <th>修改</th>
                          <th>取消</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <!-- Modal -->
                          <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">請輸入驗證碼</h4>
                                </div>
                                <div class="modal-body">
                                  <p><input type="" class="form-control" id="inputEmail3" placeholder="請輸入驗證碼"></p>
                                </div>
                                <div class="modal-footer">
                                  <a href="registration_e.php"><button type="button" class="btn btn-success btn-lg">確定送出</button></a>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        <script>
                        $(document).ready(function(){
                            $("#myBtn").click(function(){
                                $("#myModal").modal();
                            });
                        });
                        </script>                        
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorD">未開放</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorF">報名截止</span></td>
                          <td><span class="colorC">已付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorC">開放報名</span></td>
                          <td><span class="colorD">未付款</span></td>
                          <td class="colorE"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td class="colorD"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="TABLE_BOX_mobile">
                      <div class="tableMO">
                          <p>No.1</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>  
                        <!-- Modal -->
                          <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">請輸入驗證碼</h4>
                                </div>
                                <div class="modal-body">
                                  <p><input type="" class="form-control" id="inputEmail3" placeholder="請輸入驗證碼"></p>
                                </div>
                                <div class="modal-footer">
                                  <a href="registration_e.php"><button type="button" class="btn btn-success btn-lg">確定送出</button></a>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        <script>
                        $(document).ready(function(){
                            $("#myBtn").click(function(){
                                $("#myModal").modal();
                            });
                        });
                        </script>                        

                      <div class="tableMO">
                          <p>No.2</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>                     
                      <div class="tableMO">
                          <p>No.3</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>                     
                      <div class="tableMO">
                          <p>No.4</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>                     
                      <div class="tableMO">
                          <p>No.5</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
                          <button type="button" class="btn btn-danger btn-lg"><i id="myBtn" class="fa fa-plus-circle" aria-hidden="true"></i> 修改</button>
                          <button type="button" class="btn btn-warning btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> 取消</button> 
                      </div>                     
                      <div class="tableMO">
                          <p>No.6</p>
                          <p class="colorA">活動名稱：新竹尖石尤命的帳幕</p>
                          <p>梯次：100</p>
                          <p>活動日期：2017/06/10~2017/06/11</p>
                          <p>活動費用：<span class="colorB">1450</span></p>
                          <p>活動狀態：<span class="colorC">開放報名</span></p>
                          <p>報名狀態：<span class="colorD">未付款</span></p>
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