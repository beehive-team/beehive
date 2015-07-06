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

		<!-- END 自定义 head -->
	</head>
	<body class="movie-page movie-comment-page">
		<div id="wrap">
			<!-- START header -->
		    <div class="common_header">
	<div class="f-left">
    	<a href="">蜂巢</a>
    	<a href="">读书</a>
    	<a href="">电影</a>
    	<a href="">小组</a>
    	<a href="">提问</a>
    </div>
	<div class="f-right">
    	<a href="">登录</a>
    	<a href="">注册</a>

	</div>
</div>

		    <div class="movie_header header same_header">
	<div class="top">
		<div class="inner">
			<h2>蜂巢电影</h2>
			 <div class="search-box">
		    	<form>
		    		<input class="search"name="search" type="text"/>
		    		<input class="button"type="submit" />
		    	</form>
		    </div>
		</div>
	</div>
	<div class="bottom">
		<div class="inner">
			<a href="">选电影</a>
			<a href="">排行榜</a>
			<a href="">分类</a>
			<a href="">影评</a>
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
					<div class="f-left con">
						<div class="section sec-4">
							<div class="top">
								<h3>最受欢迎的影评</h3>
								<a href="">更多热门影评》</a>
								<a href="">新片影评》</a>
							</div>
							<div class="bottom">
								<ul>
									<li>
										<div class="img-box f-left"><a href=""><img src="/beehive/Public/images/movie6.jpg"/></a></div>
										<div class="text-box f-left">
											<h5><a href="">标题</a><a class="icon"href="javascript:;">下拉</a></h5>
                                            <p><a href="">作者&nbsp;</a>评论&nbsp;<a href="">电影名</a><span class="allstar40"></span></p>
                                            <p class="detail"> 
                                                fjdklsfjdlsflsdkjflkjdfslfjdl<a class="all"href="">(35个回应)</a>
                                            </p> 
										</div>
									</li>
								</ul> </div>
						</div>
					</div>
					<div class="f-left sider">
						<div class="ad">
							<a href=""><img src="/beehive/Public/images/ad4.jpg"/></a>
						</div>


					</div>
				</div>
			</div>
		</div>
		<!-- START footer -->
		    
<div id="footer">
	<p>version 1.0.0</p>
</div>


		   	
		<!-- END footer -->
		<script type="text/javascript">
			$(function(){
				$("h5 a.icon").toggle(function () {
				    $(this).addClass("selected");
				  },function () {
				    $(this).removeClass("selected");
				  }
				);



			});
		</script>
	</body>
</html>