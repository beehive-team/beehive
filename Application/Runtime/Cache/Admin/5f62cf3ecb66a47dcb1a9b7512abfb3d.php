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
                    
                </div>
                
            </li>
            <li>
               <a class="nav"href="javascript:;">图片信息管理</a>
               <div class="item">
                   <a class="sub-nav"href="/beehive/index.php/Admin/movie/image" target="content">电影图片</a>
                   <a class="sub-nav"href="/beehive/index.php/Admin/movie/image" target="content">图书图片</a>
               </div>
            </li>
            <li>
                <a class="nav"href="javascript:;">图书信息管理</a>
                <div class="item">
                    <a class="sub-nav"href="/beehive/index.php/Admin/book/index" target="content">显示图书信息</a>
<!--                     <a class="sub-nav"href="/beehive/index.php/Admin/book/classify" target="content">添加分类信息</a> -->
                    <a class="sub-nav"href="/beehive/index.php/Admin/book/add" target="content">添加图书</a>
                    <a class="sub-nav" href="/beehive/index.php/Admin/book/classify" target="content">图书分类管理</a>
                </div>
            </li>
            <li>
               <a class="nav"href="javascript:;">广告信息管理</a>
               <div class="item">
                   <a class="sub-nav"href="/beehive/index.php/Admin/movie/advert" target="content">广告信息</a>
                   <a class="sub-nav"href="order/ticket.php" target="content">显示信息</a>
               </div>
                       
            </li>
            <li>
                <a class="nav"href="javascript:;">评论信息管理</a>
                <div class="item">
                    <a class="sub-nav"href="<?php echo U('Movie/longComment');?>" target="content">电影长评信息</a>
                    <a class="sub-nav"href="<?php echo U('Movie/shortComment');?>" target="content">电影短评信息</a>
                    <a class="sub-nav"href="<?php echo U('Book/longComment');?>" target="content">图书长评信息</a>
                    <a class="sub-nav"href="<?php echo U('Book/shortComment');?>" target="content">图书短评信息</a>
                </div>
            </li>
            <li>
                <a class="nav"href="javascript:;">权限信息管理</a>
                <div class="item">
                    <a class="sub-nav"href="<?php echo U('User/fontUser');?>" target="content">前台用户信息</a>
                    <a class="sub-nav"href="<?php echo U('User/backUser');?>" target="content">后台用户信息</a>
                    <a class="sub-nav"href="<?php echo U('User/power');?>" target="content">添加权限</a>
                    <a class="sub-nav"href="<?php echo U('User/addActor');?>" target="content">添加角色信息</a>
                </div>
            </li>
        </ul>
    </body>
</html>