<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <link rel="stylesheet" type="text/css" href="/beehive/Public/css/admin.css"/>
        <script type="text/javascript" src="/beehive/Public/js/jquery-1.9.1.min.js"></script>
    </head>
    


    <body class="top-page">
        <div class="title">
            <h2>欢迎来到beehive后台管理</h2>
        </div>
        <div class="f-right login">
            <p><span><?php echo $_SESSION['db']['dbName']?></span>,欢迎您！上次登录时间：<span><?php echo $_SESSION['db']['date'];?></span><a href="func/logout.php">退出登录</a></p>

        </div>
    </body>
</html>