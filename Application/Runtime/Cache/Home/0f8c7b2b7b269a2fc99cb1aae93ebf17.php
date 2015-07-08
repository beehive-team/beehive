<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<!-- START 公用 head -->
		    <?php echo W('Common/commonHead');?>
		<!-- END 公用 head -->
		<!-- START 自定义 head -->
		<script type="text/javascript" src="/beehive/Public/js/jquery.bxslider.min.js"></script>

		<script type="text/javascript">

		</script>
		<!-- END 自定义 head -->
	</head>
	<body class="movie-page">
		<div id="wrap">
			<!-- START header -->
		    <?php echo W('Common/allHeader');?>
		    
		    <?php echo W('Common/movieHeader');?>
		    
			    
			<!-- END header -->
			
			<div id="main">
				<div class="inner">
					<div class="f-left con">
						
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
						
					</div>
					<div class="f-left sider">
						<div class="ad">
							<a href=""><img src="/beehive/Public/images/ad4.jpg"/></a>
						</div>

                        <div class="list-box">
                        	<div class="title">
                        		<h3>热门蜂蜜</h3>
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
		    <?php echo W('Common/commonFooter');?>
		    
		   	
		<!-- END footer -->

	</body>
</html>