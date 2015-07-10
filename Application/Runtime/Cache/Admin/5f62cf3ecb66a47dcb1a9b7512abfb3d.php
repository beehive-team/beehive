<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <link rel="stylesheet" type="text/css" href="/beehive/Public/css/admin.css"/>
        <script type="text/javascript" src="/beehive/Public/js/jquery-1.9.1.min.js"></script>
    </head>
    
    <script type="text/javascript">
        $(function(){
            $('ul li a.nav').click(function(){
                $('a.nav').removeClass('active');
                var parent = $(this).parents('li');
                if (parent.hasClass('opened')) {            
                    parent.removeClass('opened');
                    parent.find('.item').slideUp();
                    
                }else{
                    $('ul li').removeClass('opened').find('.item').slideUp()
                    parent.addClass('opened');
                    $(this).addClass('active');
                    parent.find('.item').slideDown();
                }
        
            })
            $('.item a.sub-nav').click(function(){
                $('.item a.sub-nav').removeClass('active');
                $(this).addClass('active');

            })

        });
             
    </script>
    <body class="menu-page">
        <div class="img-box">
            <img src="/beehive/Public/images/logo_small.jpg"/>
        </div>
        <ul>
            <li>
                
                <a class="nav"href="javascript:;">电影信息管理</a>
                <div class="item">
                    <a class="sub-nav" href="/beehive/index.php/Admin/movie/index" target="content">电影信息</a>
                    <a class="sub-nav" href="/beehive/index.php/Admin/movie/add" target="content">添加电影</a>
                    <a class="sub-nav" href="/beehive/index.php/Admin/movie/classify" target="content">分类管理</a>
                    <a class="sub-nav"href="/beehive/index.php/Admin/movie/image" target="content">电影图片</a>
                </div>
                
            </li>
            <li>
                <a class="nav"href="javascript:;">电影标签管理</a>
                <div class="item">
                    <a class="sub-nav"href="/beehive/index.php/Admin/movie/image" target="content">电影标签</a>
                    <a class="sub-nav"href="/beehive/index.php/Admin/movie/addImage" target="content">添加图片</a>
                    <a class="sub-nav"href="hotel/room_info.php" target="content">更多信息</a>
                </div>
            </li>
            <li>
                <a class="nav"href="javascript:;">图书信息管理</a>
                <div class="item">
                    <a class="sub-nav"href="/beehive/index.php/Admin/book/index" target="content">显示图书信息</a>
<!--                     <a class="sub-nav"href="/beehive/index.php/Admin/book/classify" target="content">添加分类信息</a> -->
                    <a class="sub-nav"href="/beehive/index.php/Admin/book/add" target="content">添加图书</a>
                    <a class="sub-nav" href="/beehive/index.php/Admin/book/classify" target="content">图书分类管理</a>
                    <a class="sub-nav"href="/beehive/index.php/Admin/book/cover" target="content">显示封面信息</a>
                    <a class="sub-nav"href="/beehive/index.php/Admin/book/addCover" target="content">添加封面信息</a>
                </div>
            </li>
            <li>
                <a class="nav"href="javascript:;">机+酒信息管理</a>
                <div class="item">
                    <a class="sub-nav"href="tplush/district_info.php" target="content">机+酒地区信息</a>
                    <a class="sub-nav"href="tplush/add_p_h.php" target="content">添加机+酒信息</a>
                    <a class="sub-nav"href="tplush/p_h_info.php" target="content">显示机+酒信息</a>
                </div>
            </li>
            <li>
                <a class="nav"href="javascript:;">订单信息管理</a>
                <div class="item">
                    <a class="sub-nav"href="order/room.php" target="content">显示酒店订单</a>
                    <a class="sub-nav"href="order/ticket.php" target="content">显示机票订单</a>
                    <a class="sub-nav"href="order/tplush.php" target="content">显示机+酒订单</a>
                </div>

            </li>
            <li>
                <a class="nav"href="javascript:;">评论信息管理</a>
                <div class="item">
                    <a class="sub-nav"href="remark/remark_info.php" target="content">显示评论信息</a>
                </div>
            </li>
            <li>
                <a class="nav"href="javascript:;">用户信息管理</a>
                <div class="item">
                    <a class="sub-nav"href="user/user_info.php" target="content">显示用户信息</a>
                </div>
            </li>
        </ul>
    </body>
</html>