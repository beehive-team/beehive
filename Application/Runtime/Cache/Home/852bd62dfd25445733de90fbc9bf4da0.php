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
	<body class="movie-page">
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
						<div class="section sec-1">
							<div class="top">
								<h3>正在热映</h3>
								<a href="">全部正在热映》</a>
								<a href="">即将上映》</a>
							</div>
							<div class="bottom">
								<ul class="slider">
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>惊魂电影院</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>惊魂电影院</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>惊魂电影院</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>惊魂电影院</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>									
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>惊魂电影院</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="section sec-2">
							<div class="top">
								<h3>选电影</h3>
							</div>
							<form>
								<div class="tab">
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
									<a href="">热门</a>
								</div>
								<div class="chose">
									<div class="sort f-left">
										<label><input type="radio" name="sort" value="hot"/>按热度排序</label>
										<label><input type="radio" name="sort" value="time"/>按时间排序</label>
										<label><input type="radio" name="sort" value="rank"/>按评价排序</label>
									</div>
									<div class="check f-right">
										<label><input type="checkbox" name="check" value="seen"/>我没看过的</label>
									</div>
								</div>
							</form>
							<div class="tip">
								<p>注册登录后可以保存自己的观影记录,快快登录吧！<a href="">登录</a><a href="">注册</a></p>
							</div>
							<div class="movies">
								<ul>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie3.jpg"/>
											<p>疯狂的麦克斯<i>7.8</i></p>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie3.jpg"/>
											<p>疯狂的麦克斯<i>7.8</i></p>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie3.jpg"/>
											<p>疯狂的麦克斯<i>7.8</i></p>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie3.jpg"/>
											<p>疯狂的麦克斯<i>7.8</i></p>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie3.jpg"/>
											<p>疯狂的麦克斯<i>7.8</i></p>
										</a>
									</li>
								</ul>
								<div class="ajax-button">
									<a href="">加载更多</a>
								</div>
							</div>
						</div>
						<div class="section sec-3">
							<div class="top">
								<h3>热门推荐</h3>
							</div>
							<div class="big-slider">
								<ul class="big-slider">
									<li>
										<a href="">
											<div class="img-box f-left"><img src="/beehive/Public/images/movie4.jpg"/></div>
											<div class="text-box f-left">
												<h4>2015年口碑电影</h4>
												<p>来自<span>heheda</span></p>
												<p>sss</p>
											</div>
										</a>
									</li>
									<li>
										<a href="">
											<div class="img-box f-left"><img src="/beehive/Public/images/movie4.jpg"/></div>
											<div class="text-box f-left">
												<h4>2015年口碑电影</h4>
												<p>来自<span>heheda</span></p>
												<p>sss</p>
											</div>
										</a>
									</li>
									<li>
										<a href="">
											<div class="img-box f-left"><img src="/beehive/Public/images/movie4.jpg"/></div>
											<div class="text-box f-left">
												<h4>2015年口碑电影</h4>
												<p>来自<span>heheda</span></p>
												<p>sss</p>
											</div>
										</a>
									</li>
									<li>
										<a href="">
											<div class="img-box f-left"><img src="/beehive/Public/images/movie4.jpg"/></div>
											<div class="text-box f-left">
												<h4>2015年口碑电影</h4>
												<p>来自<span>heheda</span></p>
												<p>sss</p>
											</div>
										</a>
									</li>
								</ul>
							</div>
						</div>
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
											<h5><a href="">标题</a></h5>
                                            <p><a href="">作者&nbsp;</a>评论&nbsp;<a href="">电影名</a><span class="allstar40"></span></p>
                                            <p class="detail"> 
                                                fjdklsfjdlsflsdkjflkjdfslfjdl<a class="all"href="">(全文)</a>
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
						<div class="hot">
                            <h3>热门推荐</h3>
                            <ul>
                                <li><a href="">2015年上xxbannian</a></li>                          
                                <li><a href="">2015年上xxbannian</a></li>                          
                                <li><a href="">2015年上xxbannian</a></li>                          
                            </ul> 
                        </div>

                        <div class="list-box">
                        	<div class="title">
                        		<h3>本周口碑榜</h3><a href="">更多榜单》</a>
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