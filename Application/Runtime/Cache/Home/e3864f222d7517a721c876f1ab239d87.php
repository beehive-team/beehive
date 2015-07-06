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
			$(function(){
				$('.slider').bxSlider({
					auto:true,
					pager:true,
					controls:true,
					minSlides:1,
					maxSlides:4,
					moveSlides:4,
					slideWidth:128,
					slideMargin:20
				});
				$('.big-slider ul').bxSlider({
					auto:true,
					pager:true,
					controls:true,
				});
			})
		</script>
		<!-- END 自定义 head -->
	</head>
	<body class="movie-page movie-ranking-page">
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
								<h2>豆瓣电影排行榜</h2>
								<h3>豆瓣新片榜 · · · · · · </h3>
							</div>
							<div class="bottom">
								<ul>
									<li>
										<div class="img-box f-left"><a href=""><img src="/beehive/Public/images/movie6.jpg"/></a></div>
										<div class="text-box f-left">
											<h5><a href="">电影名</a></h5>
                                            <p>2015-05-15(美国) / 2015-05-14(澳大利亚) / 汤姆·哈迪 / 查理兹·塞隆 / 尼古拉斯·霍尔特 / 休·基斯-拜恩 / 乔什·赫尔曼 / 内森·琼斯 / 佐伊·克罗维兹 / 罗茜·汉丁顿-惠特莉 / 丽莉·克亚芙 / 阿比·丽 / 考特尼·伊顿 / 安格斯·桑普森 / 理查德·卡特...</p>
                                            <p><span class="allstar40"></span> <i>4.7</i>(5968人评价)</p>
                                         </div>
									</li>
								</ul> </div>
						</div>
					</div>
					<div class="f-left sider">

						<div class="classify-ranking">
							<h4>分类排行榜 ·······</h4>
								<div class="classify">
									
									<a href="">小说</a>
									<a href="">随笔</a>
								</div>

							
						</div>
						<div class="ad">
							<a href=""><img src="/beehive/Public/images/ad4.jpg"/></a>
						</div>
                        <div class="list-box">
                        	<div class="title">
                        		<h3>本周口碑榜 ·······</h3>
                        		<h5>6月28日 - 7月5日</h5>
                        	</div>
                            <ul>
                                <li>1<a href=""> 风快的麦克斯</a></li>
                                <li>1<a href=""> 风快的麦克斯</a></li>
                                <li>1<a href=""> 风快的麦克斯</a></li>
                                <li>1<a href=""> 风快的麦克斯</a></li>
                                <li>1<a href=""> 风快的麦克斯</a></li>
                                <li>1<a href=""> 风快的麦克斯</a></li>
                                <li>1<a href=""> 风快的麦克斯</a></li>
                                <li>1<a href=""> 风快的麦克斯</a></li>
                            </ul>

                        </div>
                        <div class="top250">
                        	<div class="title">
                        		<h3>豆瓣电影TOP250</h3>
                        		<a href="">全部</a>
                        	</div>
                            <ul>
                                <li>
                                	<a href=""><img src="/beehive/Public/images/movie6.jpg"/></a>
                                	<p><a href="">出门的世界</a></p>
                                </li>
                                <li>
                                	<a href=""><img src="/beehive/Public/images/movie6.jpg"/></a>
                                	<p><a href="">出门的世界</a></p>
                                </li>
                                <li>
                                	<a href=""><img src="/beehive/Public/images/movie6.jpg"/></a>
                                	<p><a href="">出门的世界</a></p>
                                </li>
								<li>
                                	<a href=""><img src="/beehive/Public/images/movie6.jpg"/></a>
                                	<p><a href="">出门的世界</a></p>
                                </li>
                                <li>
                                	<a href=""><img src="/beehive/Public/images/movie6.jpg"/></a>
                                	<p><a href="">出门的世界</a></p>
                                </li>
                            </ul>

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

	</body>
</html>