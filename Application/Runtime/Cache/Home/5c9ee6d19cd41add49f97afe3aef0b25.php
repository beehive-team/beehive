<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<!-- START 公用 head -->
		    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>beehive</title>
<link rel="stylesheet" type="text/css" href="/beehive/Public/css/style.css"/>
<script type="text/javascript" src="/beehive/Public/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/beehive/Public/js/script.common.js"></script>

		<!-- END 公用 head -->
		<!-- START 自定义 head -->
		<script type="text/javascript" src="/beehive/Public/js/jquery.bxslider.min.js"></script>

		<script type="text/javascript">
			
		</script>
		<!-- END 自定义 head -->
	</head>
	<body class="user-page user-login-page">
		<div id="wrap">
			<!-- START header -->
		    <div class="header">
	<div class="inner">
    	<div class="logo">
	    	<img src="/beehive/Public/images/logo.png"/>
	    	<h2>账号</h2>
	    </div> 
	    
	    
	</div>
	<script type="text/javascript">
	$(function(){
		$('input').focusin(function(){
			$('input').addClass('active');
		}).focusout(function(){
			$('input').removeClass('active');
		})
	})
	</script>
</div>

			    
			<!-- END header -->
			
			<div id="main">
				
				
				<div class="inner">

					<h3>登录蜂巢</h3>
					<div class="form-box">
						<form>
							<div class="input-box">
								<label for="email">账&nbsp;&nbsp;&nbsp;号</label><input type="text" name="email"/>
							</div>
							<div class="input-box">
								<label for="psw">密&nbsp;&nbsp;&nbsp;码</label><input type="text" name="psw"/>
							</div>
							
							<div class="check-box">

								<input type="checkbox" name="agreement"/> <label for="agreement">下次自动登录|<a href="">忘记密码了</a> </label>
							</div>
							<div class="button-box">
								<input type="button" value="登录"/>
							</div>
						</form>
					</div>
					<div class="sider">
						<p>> 还没有蜂巢账号<a href="">我要注册</a></p>						
					</div>
				</div>

				
				
			</div>
		</div>
		<!-- START footer -->
		    
<div id="footer">
	<p>version 1.0.0</p>
</div>


		<!-- END footer -->

	</body>
</html>