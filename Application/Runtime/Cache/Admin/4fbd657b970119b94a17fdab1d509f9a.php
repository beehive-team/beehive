<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>欢迎登录后台管理页面</title>
        <link rel="stylesheet" type="text/css" href="/beehive/Public/css/admin.css"/>
    </head>
    <frameset frameborder="0" cols="20%,*" name="view">
        <frame src="<?php echo U('Index/menu');?>">
        </frame>
        <frameset rows="10%,*">
            <frame scrolling="no" src="<?php echo U('Index/top');?>"></frame>
            <frame name="content"></frame>
        </frameset>
        
    </frameset>
</html>