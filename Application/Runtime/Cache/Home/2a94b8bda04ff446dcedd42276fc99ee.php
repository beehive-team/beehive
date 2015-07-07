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
				$('.sec-2 ul').bxSlider({
					auto:true,
					pager:false,
					controls:false
				});
			})
		</script>
		<!-- END 自定义 head -->
	</head>
	<body class="home-page">
		<div id="wrap">
			<!-- START header -->
		    <div class="header">
	<div class="inner">
    	<div class="logo">
	    	<img src="/beehive/Public/images/logo.png"/>
	    </div> 
	    <div class="search-box">
	    	<form>
	    		<input class="search"name="search" type="text"/>
	    		<input class="button"type="submit" />
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
			$('input').addClass('active');
		}).focusout(function(){
			$('input').removeClass('active');
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
						<ul>
							<li><a href=""><img src="/beehive/Public/images/ad1.jpg"></a></li>
							<li><a href=""><img src="/beehive/Public/images/ad2.jpg"></a></li>
						</ul>
					</div>
				</div>
				<div class="section sec-3">
					<div class="inner">
						<h2>热点内容 ·······</h2>
						<div class="img-box">
							<ul>
								<li>
									<a href="">
										<img src="/beehive/Public/images/photo1.jpg"/>
									</a>
									<a href="">听写和诶插</a><span>86张照片</span>
								</li>
								<li>
									<a href="">
										<img src="/beehive/Public/images/photo2.jpg"/>
							
									</a>
									<a href="">听写和诶插</a><span>86张照片</span>

								</li>
								<li>
									<a href="">
										<img src="/beehive/Public/images/photo3.jpg"/>
									</a>
									<a href="">听写和诶插</a><span>86张照片</span>

								</li>
								<li>
									<a href="">
										<img src="/beehive/Public/images/photo4.jpg"/>
									</a>
									<a href="">听写和诶插</a><span>86张照片</span>

								</li>
							</ul>
						</div>
						<div class="list-box">
							<ul>
								<li class="first"><a href="">题目</a><span>谁谁的日记</span>
								<p>丙戌年，也即一衣带水的邻国平成十八年间，国境东隅的姑苏城一如两千五百年前建城...</p></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的游戏》取景地，现实远比魔幻更美</a></li>
							</ul>
						</div>
						<div class="list-box">
							<ul>
								<li><img src="/beehive/Public/images/ad3.jpg"></li>

								<li class="first"><a href="">题目</a><span>谁谁的日记</span><p>丙戌年，也即一衣带水的邻国平成十八年间，国境东隅的姑苏城一如两千五百年前建城...</p></li>
								<li><a href="">揭秘《权力的f游戏》取景地，现实远比魔幻更美</a></li>
								<li><a href="">揭秘《权力的游戏》取景地，现实远比魔幻更美</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="section sec-4">
					<div class="inner">
						<div class="f-left list">
							<h3>读书</h3>
							<ul>
								<li><a href="">分类浏览</a></li>
								<li><a href="">作者</a></li>
								<li><a href="">书评</a></li>
								<li><a href="">购书单</a></li>
							</ul>
						</div>
						<div class="f-left new">
							<h4>新书速递 ·······</h4><a href="">（更多）</a>
							<ul>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/book1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p><p>[美〕雷蒙德 ...</p>
								</li>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/book1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p><p>[美〕雷蒙德 ...</p>
								</li>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/book1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p><p>[美〕雷蒙德 ...</p>
								</li>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/book1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p><p>[美〕雷蒙德 ...</p>
								</li>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/book1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p><p>[美〕雷蒙德 ...</p>
								</li>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/book1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p><p>[美〕雷蒙德 ...</p>
								</li>
							</ul>
						</div>
						<div class="f-left tags">
							<h4>热门标签 ·······</h4><a href="">（更多）</a>
							<ul>
								<li>
									<span>[文学]</span>
									<a href="">小说</a>
									<a href="">随笔</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="section sec-5">
					<div class="inner">
						<div class="f-left list">
							<h3>电影</h3>
							<ul>
								<li><a href="">选电影</a></li>
								<li><a href="">排行榜</a></li>
								<li><a href="">分类</a></li>
								<li><a href="">影评</a></li>
							</ul>
						</div>
						<div class="f-left new">
							<h4>正在热映 ·······</h4><a href="">（更多）</a>
							<ul>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/movie1.jpg"/></a>

									</div>
									<p><a href="">新手</a></p>
									<span class=""></span><i>7.9</i>

								</li>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/movie1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p>
									<span class=""></span><i>7.9</i>

								</li>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/movie1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p>
									<span class=""></span><i>7.9</i>

								</li>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/movie1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p>
									<span class=""></span><i>7.9</i>

								</li>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/movie1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p>
									<span class="allstar15"></span><i>7.9</i>

								</li>
								<li>
									<div class="pic">
										<a href=""><img src="/beehive/Public/images/movie1.jpg"/></a>
									</div>
									<p><a href="">新手</a></p>
									<span class=""></span><i>7.9</i>

								</li>
							</ul>
						</div>
						<div class="f-left right">
							<h4>影片分类 ·······</h4><a href="">（更多）</a>
								<div class="classify">
									<a href="">小说</a>
									<a href="">随笔</a>
								</div>
							<h4>近期热门 ·······</h4><a href="">（更多）</a>
								<ul>
									<li>1. <a href="">疯狂的麦克斯</a></li>
								</ul>
							</ul>
						</div>
					</div>
				</div>
				<div class="section sec-6">
					<div class="inner">
						<div class="f-left list">
							<h3>小组</h3>
							<ul>
								<li><a href="">精选</a></li>
								<li><a href="">分化</a></li>
								<li><a href="">行摄</a></li>
								<li><a href="">娱乐</a></li>
								<li><a href="">时尚</a></li>
								<li><a href="">生活</a></li>
								<li><a href="">科技</a></li>
							</ul>
						</div>
						<div class="f-left hot">
							<h4>热门小组 ·······</h4><a href="">（更多）</a>
							<ul>
								<li>
									<a class="img-box">
										<img src="/beehive/Public/images/group1.jpg"/>
									</a>
									<p><a href="">你荒废时间的时候会有多少人在拼命</a></p>
									<p>119343 个成员</p>
								</li>
								<li>
									<a class="img-box">
										<img src="/beehive/Public/images/group1.jpg"/>
									</a>
									<p><a href="">你荒废时间的时候会有多少人在拼命</a></p>
									<p>119343 个成员</p>
								</li>
								<li>
									<a class="img-box">
										<img src="/beehive/Public/images/group1.jpg"/>
									</a>
									<p><a href="">你荒废时间的时候会有多少人在拼命</a></p>
									<p>119343 个成员</p>
								</li>
								<li>
									<a class="img-box">
										<img src="/beehive/Public/images/group1.jpg"/>
									</a>
									<p><a href="">你荒废时间的时候会有多少人在拼命</a></p>
									<p>119343 个成员</p>
								</li>

							</ul>
						</div>
						<div class="f-left right">
							<h4>小组分类 ·······</h4>
								<div class="classify">
									<ul>
										<li>
											<p><a class="parents" href="">兴趣》</a></p>
											<a href="">小说</a>
											<a href="">随笔</a>
										</li>
									</ul>
								</div>

							
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