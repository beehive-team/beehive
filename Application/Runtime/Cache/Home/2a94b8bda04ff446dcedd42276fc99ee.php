<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<!-- START 公用 head -->
		    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>beehive</title>
<link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
<script type="text/javascript" src="Public/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="Public/js/script.common.js"></script>

		<!-- END 公用 head -->
		<!-- START 自定义 head -->
		<script type="text/javascript" src="files/js/jquery.bxslider.min.js"></script>
		<script type="text/javascript">
			
		</script>
		<!-- END 自定义 head -->
	</head>
	<body class="home-page">
		<div id="wrap">
			<!-- START header -->
		    <div id="header">
	<div class="inner">
    	<div class="logo">
	    	<img src="Public/images/logo.png"/>
	    </div> 
	    <div class="search-box">
	    	<form>
	    		<input name="search" type="text"/>
	    	</form>
	    </div>
	    <div class="list-box">
	    	<a class="first"href="">读书</a>
	    	<a class="second"href="">电影</a>
	    	<a class="third"href="">小组</a>
	    	<a class="forth"href="">提问</a>
	    </div>
	</div>
	<script type="text/javascript">
	$(function(){
		$('input').focusin(function(){
			$(this).addClass('active');
		}).focusout(function(){
			$(this).removeClass('active');
		})
	})
	</script>
</div>

			    
			<!-- END header -->
			
			<div id="main">
				<div class="section sec-1">
					<div class="inner"/>
						<div class="f-left form-box">
							<form>
								<div class="input-box">
									<input type="text" name="name"/><span></span>
								</div>
								<div class="input-box">
									<input type="password" name="psw"/><span></span>
								</div>
								<div class="radio-box">
									<input type="checkbox" name="rember"/><label for="rember">记住我</label>
									<a href="">忘记密码</a>
								</div>
								<div class="btn-box">
									<input type="submit" value="登录">
									<a href="">注册</a>
								</div>
							</form>
						</div>
						<div class="f-right title">
							<h1>蜂巢</h1>
							<p>你想要的都有</p>
						</div>
					</div>
				</div>
				<div class="section sec-2">
					<div class="inner">
						<h2>热点内容 ·······</h2>
						<div class="img-box">
							<ul>
								<li>
									<a href="">
										<img src=""/>
										<span><strong></strong></span>
									</a>
								</li>
								<li>
									<a href="">
										<img src=""/>
										<span><strong></strong></span>
									</a>
								</li>
								<li>
									<a href="">
										<img src=""/>
										<span><strong></strong></span>
									</a>
								</li>
								<li>
									<a href="">
										<img src=""/>
										<span><strong></strong></span>
									</a>
								</li>
							</ul>
						</div>
						<div class="list-box">
							<ul>
								<li><a href=""></a><p></p></li>
								<li><a href=""></a></li>
								<li><a href=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- START footer -->
		    <!--#include file="inc_footer.html"-->
		<!-- END footer -->
	</body>
</html>