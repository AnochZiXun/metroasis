    <div id="browsing-history" class="browsing-history">
    <div id="browsing-close" style="display: none;"><img src="images/close.jpg"></div><!-- 點開才會出現 -->
        <div class="browsing-header">
            <div class="switch-menu"><span class="switch-menu-icon"><i class="fa fa-compress" aria-hidden="true"></i>
            </i></i></span> <i class="fa fa-eye" aria-hidden="true"></i><span class="menu-text">
                瀏覽紀錄</span> </div>
        </div>
        <div class="browsing-body-desktop">
            <a class="scroll-btn scroll-down scroll-disable"><i class="fa fa-caret-up"></i></a>
            <div class="historyLIST" style="max-height: 285px">
                <ul>
                    <li>
                        <img src="images/productIMG/product01.jpg" class="img-responsive"></li>
                    <li>
                        <img src="images/productIMG/product04.jpg" class="img-responsive"></li>
                </ul>
            </div>
            <a class="scroll-btn scroll-down scroll-disable"><i class="fa fa-caret-down"></i>
            </a><a class="clear-menu-btn" data-ng-if="salePageViewList.length > 0">清除紀錄</a>
        </div>
    </div>
    <!-- 手機版的右上按鈕 -->
    <span id="TOPBUT" onclick="openNav()">按鈕選單</span>
    <!-- 手機版的上方menu -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <nav>
        <ul>
            <li><a href="about.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 關於我們</a></li>
            <li><a><i class="fa fa-angle-double-right" aria-hidden="true"></i> 活動消息</a>
                <ul style="background-color: #2d5923;">
                    <li><a href="news.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 最新消息</a></li>
                    <li><a href="video.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 影音專區</a></li>
                    <li><a href="highlights.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 活動花絮</a></li>
                    <li><a href="knowledge.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 知識分享</a></li>
                    <li><a href="activity.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 活動報名</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 人才招募</a></li>
            <li><a href="branch.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 門市據點</a></li>
            <li><a><i class="fa fa-angle-double-right" aria-hidden="true"></i> 會員中心</a>
                <ul style="background-color: #2d5923;">
                    <li><a href="edit.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 修改資料</a></li>
                    <li><a href="order.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 訂單查詢</a></li>
                    <li><a href="watchlist.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 我的收藏</a></li>
                    <li><a href="point.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 紅利績點</a></li>
                   <li><a href="annal.php"><i class="fa fa-angle-right" aria-hidden="true"></i> 我的報名</a></li>
               </ul>
            </li>   
        </ul>
       </nav>
    </div>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "160px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    <!-- 頁首區 TOP-->
    <div id="MenuTOP">
        <div class="MenuTOP_box">
            <a href="login.php">登入</a> | <a href="register.php">註冊</a></div>
    </div>
    <!-- 上方menu和logo -->
    <div id="LOGO-MENU">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <!-- logo -->
            <div id="LOGO_box">
                <a href="index.php">
                    <img src="images/logo.png"></a>
            </div>
            <!-- search -->
            <div id="SEARCH_box" class="header-search">
                <form action="#" method="post">
                <input type="search" name="Search" placeholder="Search for a Product..." required="">
                <button type="submit" class="btn btn-default" aria-label="Left Align">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                </form>
            </div>
        </div>
        <!-- 桌機版的上方menu -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="text-center"><a href="about.php"><span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x text-success">
                </i><i class="fa fa-exclamation fa-stack-1x fa-inverse"></i></span>
                    <h4>關於我們</h4>
                </a></li>
                <li class="dropdown text-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x text-success"></i><i
                        class="fa fa-flag fa-stack-1x fa-inverse"></i></span>
                    <h4>活動消息</h4>
                    <b style="color: #23451b;" class="caret"></b></a></a>
                    <ul class="dropdown-menu">
                        <li><a href="news.php">最新消息</a> </li>
                        <li><a href="video.php">影音專區</a> </li>
                        <li><a href="highlights.php">活動花絮</a> </li>
                        <li><a href="knowledge.php">知識分享</a> </li>
                        <li><a href="activity.php">活動報名</a> </li>
                    </ul>
                </li>
                <li class="text-center"><a href="https://www.104.com.tw/jobbank/custjob/index.php?r=cust&j=4c4a432938463f5631323a63443e371a75a3a4224343640212121211f382b2625381j99&jobsource=n104bank1#info06"
                    target="_blank"><span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x text-success">
                    </i><i class="fa fa-question fa-stack-1x fa-inverse"></i></span>
                    <h4>人才招募</h4>
                </a></li>
                <li class="text-center"><a href="branch.php"><span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x text-success">
                </i><i class="fa fa-map-marker fa-stack-1x fa-inverse"></i></span>
                    <h4>門市據點</h4>
                </a></li>
                <li class="dropdown text-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x text-success"></i><i
                        class="fa fa-user fa-stack-1x fa-inverse"></i></span>
                    <h4>會員中心</h4>
                    <b style="color: #23451b;" class="caret"></b></a></a>
                    <ul class="dropdown-menu">
                        <li><a href="edit.php">修改資料</a> </li>
                        <li><a href="order.php">訂單查詢</a> </li>
                        <li><a href="watchlist.php">我的收藏</a> </li>
                        <li><a href="point.php">紅利績點</a> </li>
                        <li><a href="annal.php">我的報名</a> </li>
                    </ul>
                </li>
                <li class="dropdown text-center"><a href="shoppingcart.php" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x text-success"></i><i
                        class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i></span>
                    <h4>購物車(3)</h4>
                    <b style="color: #23451b;" class="caret"></b></a></a>
                    <ul class="dropdown-menu">
                        <div class="menuSC">
                            <h1>最新加入項目</h1>
                            <div class="porLIST">
                                <div class="A"><a href=""><img src="images/productIMG/product01.jpg" class="img-responsive"></a></div>
                                <div class="B">
                                    <p>女短袖圖勝透氣排汗造型衫女短袖圖勝透氣排汗造型衫</p>
                                    <span>$790</span>
                                </div>
                                <div class="C"><a href=""><i class="fa fa-trash" aria-hidden="true"></i></a></div>
                            </div>
                            <div class="porLIST">
                                <div class="A"><a href=""><img src="images/productIMG/product02.jpg" class="img-responsive"></a></div>
                                <div class="B">
                                    <p>女短袖圖勝透氣排汗造型衫女短袖圖勝透氣排汗造型衫</p>
                                    <span>$790</span>
                                </div>
                                <div class="C"><a href=""><i class="fa fa-trash" aria-hidden="true"></i></a></div>
                            </div>
                            <div class="porLIST">
                                <div class="A"><a href=""><img src="images/productIMG/product03.jpg" class="img-responsive"></a></div>
                                <div class="B">
                                    <p>女短袖圖勝透氣排汗造型衫女短袖圖勝透氣排汗造型衫</p>
                                    <span>$790</span>
                                </div>
                                <div class="C"><a href=""><i class="fa fa-trash" aria-hidden="true"></i></a></div>
                            </div>
                            <div class="btnBB"><a href="shoppingcart.php"><button type="button" class="btn-danger btn-lg btn-block buttonB">立即結帳</button></a></div>
                        </div>

                    </ul>
                </li>
            </ul>
        </div>
    </div>

