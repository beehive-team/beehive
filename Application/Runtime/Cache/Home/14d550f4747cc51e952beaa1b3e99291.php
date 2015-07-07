<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<!-- START 公用 head -->
		    <?php echo W('Common/commonHead');?>
		    
		<!-- END 公用 head -->
		<!-- START 自定义 head -->
		<script type="text/javascript" src="/beehive/Public/js/jquery.bxslider.min.js"></script>

		<script type="text/javascript">
			$(function(){
				var key_flag = 0;
				var email_flag = 0;
				var nickname_flag = 0;
				var phone_flag = 0;
				var vcode_flag = 0;

				$('input').blur(function(){
					var value = $(this).val();
					var name = $(this).attr('name');
					switch(name){
						case 'youxiang':
							if(!is_email(value)){
								$(this).siblings('span').html('邮箱不合法');
								key_flag = 0;
							}else{
								$(this).siblings('span').html('');
								key_flag = 1;

							}
						break;
						case 'key':
							if(!is_key(value)){
								$(this).siblings('span').html('密码不合法');
								email_flag = 0;

							}else{
								$(this).siblings('span').html('');
								email_flag = 1;


							}
						break;

						case 'nickname':
							if(is_nickname(value)){
								$(this).siblings('span').html('用户名已存在');
								nickname_flag =0;
							}else{
								$(this).siblings('span').html('');
								nickname_flag =1;

							}
						break;
						case 'mobile':
							if(is_phone(value)){
								$(this).siblings('span').html('请输入正确的手机号');
								phone_flag =0;
							}else{
								$(this).siblings('span').html('');
								phone_flag =1;

							}
						break;
						case 'vcode':
							if(is_vcode(value)){
								$(this).siblings('span').html('请输入正确的验证码');
								vcode_flag =0;
							}else{
								$(this).siblings('span').html('');
								vcode_flag =1;

							}
						break;
					}
					
				})
				
			});
		</script>
		<!-- END 自定义 head -->
	</head>
	<body class="user-page user-register-page">
		<div id="wrap">
			<!-- START header -->
		    <?php echo W('Common/accountHeader');?>
		    
			    
			<!-- END header -->
			
			<div id="main">
				
				
				<div class="inner">

					<h3>欢迎加入蜂巢</h3>
					<div class="form-box">
						<form action="<?php echo U('Common/doreg');?>" method="post">
							<div class="input-box">
								<label for="youxiang">邮&nbsp;&nbsp;&nbsp;箱</label><input type="text" class="youxiang" name="youxiang"/><span></span>
							</div>
							<div class="input-box">
								<label for="key">密&nbsp;&nbsp;&nbsp;码</label><input type="password" class="key" name="key"/><span></span>
							</div>
							<div class="input-box">

							
								<label for="nickname">昵&nbsp;&nbsp;&nbsp;称</label><input type="text" name="nickname"/><span></span>
							</div>
							<div class="input-box">

								<label for="mobile">手机号</label><input type="text" name="mobile"/><span></span>
							</div>
							<div class="input-box">	
								<label for="vcode">验证码</label><input class="vcode"type="text" name="vcode"/><img onclick="this.src=this.src+'?i='+Math.random()"src="<?php echo U('Common/vcode');?>"/><span></span>
							</div>
							<div class="check-box">

								<input type="checkbox" name="agreement"/> <label for="agreement">我已经认真阅读并同意豆瓣的<a href="">《使用协议》</a>。 </label>
							</div>
							<div class="button-box">
								<input type="button" value="注册"/>
							</div>
						</form>
					</div>
					<div class="sider">
						<p>> 已经拥有豆瓣帐号? <a href="">直接登录</a></p>						
					</div>
				</div>

				
				
			</div>
		</div>
		<!-- START footer -->
		    <?php echo W('Common/commonFooter');?>
		    
		<!-- END footer -->

	</body>
</html>