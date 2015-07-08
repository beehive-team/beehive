<?php if (!defined('THINK_PATH')) exit();?><div class="common_header clearfix">
	<div class="f-left ">

    	<a href="<?php echo U('Index/index');?>">蜂巢</a>
    	<a href="">读书</a>
    	<a href="">电影</a>
    	<a href="">小组</a>
    	<a href="">提问</a>
    </div>
	<div class="f-right right">
        <?php if(empty($user)): ?><a href="<?php echo U('Common/login');?>">登录</a>
    	   <a href="<?php echo U('Common/register');?>">注册</a>
        <?php else: ?>
            <ul>
                <li>
                    <a href="">提醒</a>
                </li>
                <li class="nav">
                    <a class="user"href=""><?php echo ($user["name"]); ?>的账号<span class="arrow"></span></a>
                    <div class="item">
                        <a href="">我的蜂巢</a>
                        <a href="">我的账号</a>
                        <a href="">退出</a>
                    </div>
                </li>
            </ul><?php endif; ?>
	</div>
    <script type="text/javascript">
        $(function(){
            $('.nav').hover(function(){
                $(this).find('.item').slideDown();
            },function(){
                $(this).find('.item').stop(false,false).slideUp();

            })
        })
    </script>
</div>