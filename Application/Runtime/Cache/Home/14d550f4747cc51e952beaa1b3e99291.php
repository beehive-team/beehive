<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<!-- START 公用 head -->
		    <?php echo W('Common/commonHead');?>
		    
		<!-- END 公用 head -->
		<!-- START 自定义 head -->
		<script type="text/javascript" src="/beehive/Public/js/jquery.bxslider.min.js"></script>

		
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
						<form action="<?php echo U('Common/doreg');?>" method="post"  onsubmit="return sub();">
							<div class="input-box">
								<label for="youxiang">邮&nbsp;&nbsp;&nbsp;箱</label><input type="text" class="youxiang" name="youxiang"/><span class="espan"></span>
							</div>
							<div class="input-box">
								<label for="key">密&nbsp;&nbsp;&nbsp;码</label><input type="password" class="key" name="key"/><span></span>
							</div>
							<div class="input-box">

							
								<label for="nickname">昵&nbsp;&nbsp;&nbsp;称</label><input type="text" name="nickname"/><span class="nspan"></span>
							</div>
							<div class="input-box">

								<label for="mobile">手机号</label><input type="text" name="mobile"/><span class="mspan"></span>
							</div>
							<div class="input-box">	
								<label for="vcode">验证码</label><input class="vcode"type="text" name="vcode"/><img onclick="this.src=this.src+'?i='+Math.random()"src="<?php echo U('Common/vcode');?>"/><span class="vspan"></span>
							</div>
							<div class="check-box">

								<input type="checkbox" name="agreement" checked="checked"/> <label for="agreement">我已经认真阅读并同意豆瓣的<a href="">《使用协议》</a>。 </label>
							</div>
							<div class="button-box">
								<input type="submit" value="注册"/><span class="dospan"></span>
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
		<script type="text/javascript">
			
				key_flag = false;
				email_flag = false;
				nickname_flag = false;
				phone_flag = false;
				vcode_flag = false;
				agreement_flag = true;

				$('input').change(function(){
					var value = $(this).val();
					var name = $(this).attr('name');
					switch(name){
						case 'youxiang':
							if(!is_email(value)){
								$('.espan').html('邮箱不合法');
								email_flag = false;
							}else{
								$.post("exits",{email:value},function(data){

									if(data=='true'){
										
										$('.espan').html('邮箱已被注册');

										email_flag =false;

									}else{
										$('.espan').html('');
										
										email_flag =true;
										

									}	

								})
								
							}
						break;
						case 'key':
							//alert(is_key(value));
							if(!is_key(value)){
								$(this).siblings('span').html('密码不合法');
								key_flag = false;

							}else{
								$(this).siblings('span').html('');
								key_flag = true;


							}
						break;

						case 'nickname':
							$.post("exits",{name:value},function(data){

								if(data=='true'){
									
									$('.nspan').html('用户名已存在');

									nickname_flag =false;

								}else{
									$('.nspan').html('');
									
									nickname_flag =true;
									

								}	

							})
						break;
						case 'mobile':

							if(!is_phone(value)){
								$(this).siblings('span').html('请输入正确的手机号');
								phone_flag =false;
							}else{
								

								$.post("exits",{phone:value},function(data){

									if(data=='true'){
										
										$('.mspan').html('手机号已注册');

										phone_flag =false;

									}else{
										$('.mspan').html('');
										
										phone_flag =true;
										

									}	

								})




								

							}
						break;
						case 'vcode':
							
							$.post("doVcode",{vcode:value},function(data){

								if(data=='false'){
									
									$('.vspan').html('请输入正确的验证码');

									vcode_flag =false;

								}else{
									$('.vspan').html('');
									$('.vcode').attr('readonly','readonly');
									vcode_flag =true;
									

								}	

							})
						break;
						case 'agreement':

							if($(this).attr('checked')){
								agreement_flag = true;
								
							}else{
								agreement_flag = false;
							}

						break;
					}
				})
			


			function sub(){
				if(key_flag){
					
					return true;
				}else{
					$('.dospan').html('请输入正确的信息才能注册');
					return false;
				}
				
			}
		</script>

	</body>
</html>