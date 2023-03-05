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
                  <li class="breadcrumb-item active">活動報名表</li>
                  <li class="breadcrumb-item active">修改報名表</li>
                </ol>
                 <!-- 標題 -->
                <div class="alert alert-info" role="alert">
                    <strong><i class="fa fa-bars" aria-hidden="true"></i></strong> 修改報名表
                </div>
                <!-- 內容開始 -->
                <div class="frameBOX">
                  <div class="activityDetailBOX">
                    <table class="table table-hover">
                      <thead class="thead-info">
                        <tr class="secondary">
                          <th>活動名稱</th>
                          <th>梯次</th>
                          <th>活動日期</th>
                          <th>活動費用</th>
                          <th>報名狀態</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="colorA">新竹尖石尤命的帳幕</td>
                          <td>100</td>
                          <td class="UB">2017/06/10~2017/06/11</td>
                          <td class="colorB">1450</td>
                          <td><span class="colorD">未付款</span></td>
                        </tr>
                      </tbody>
                    </table>

                    <hr>
                    <div class="registrationH1">匯款帳號後五碼：<input type="" style="height: 30px; margin-right: 10px;" placeholder=""><a href="registration_e.php"><button type="button" class="btn btn-success btn-lg">確定送出</button></a></div>
                    <div class="registrationH2"><i class="fa fa-user" aria-hidden="true"></i> 主要聯絡人資料</div>
                  <div class="login-page">      
                    <div class="registrationFORM">
                      <div class="col-lg-12">
                        <form>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">姓名 <i class="fa fa-star" aria-hidden="true"></i> </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="請填寫真實姓名">
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">性別 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="男 / 女">
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">身份號碼 </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder=" 活動使用 - 旅遊平安險">
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label"> 手機 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="例如：0988-888-888">
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">市話 </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="例如：02 - 12345678   #分機999">
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">電子郵件 <i class="fa fa-star" aria-hidden="true"></i> </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="abc12Q234@gmail.com">
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">出生日期 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="80 / 10 / 10 ">
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">地址 </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="">
                          </label>
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">行前訓練課程日 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                            <div class="col-sm-8">
                              <label class="custom-control custom-radio">
                                <input id="radio1" name="radio" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">2017/05/26</span>
                              </label>
                              <label class="custom-control custom-radio">
                                <input id="radio2" name="radio" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">2017/06/10</span>
                              </label>
                              <label class="custom-control custom-radio">
                                <input id="radio2" name="radio" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">2017/06/20</span>
                              </label>
                          </label>
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">使用ADISI帳篷 <i class="fa fa-star" aria-hidden="true"></i> </label>
                            <div class="col-sm-8">
                              <select class="custom-select">
                                <option selected>經典溫馨系列</option>
                                <option value="1">經典溫馨系列</option>
                                <option value="2">經典溫馨系列</option>
                                <option value="3">經典溫馨系列</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">備註 </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="">
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>  
                  </div>

                    <div class="registrationH3"><i class="fa fa-users" aria-hidden="true"></i> 同行人員資料</div>
                  <div class="login-page">      
                    <div class="registrationFORM">
                      <div class="col-lg-12">
                        <form>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">姓名 <i class="fa fa-star" aria-hidden="true"></i> </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="請填寫真實姓名">
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">性別 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="男 / 女">
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">身份號碼  <i class="fa fa-star" aria-hidden="true"></i></label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder=" 活動使用 - 旅遊平安險">
                            </div>
                          </div>
                          <div class="form-box">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">出生日期 <i class="fa fa-star" aria-hidden="true"></i>  </label>
                            <div class="col-sm-8">
                              <input type="" class="form-control" id="inputEmail3" placeholder="80 / 10 / 10 ">
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>  
                  </div>

                  </div>
                    <div style="margin:10px auto;">
                      <ul class="pagination">
                        <li><a href="activity_detail.php"><span aria-hidden="true">&laquo; 回上一頁</span></a></li>
                        <li class="active"><a href="activity.php">回列表</a></li>
                      </ul>
                       <a href="annal.php"><button style="float: right; width: 30%; margin: 20px 0; padding: 10px 30px;" type="button" class="btn btn-success btn-lg">確定修改送出</button></a>
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