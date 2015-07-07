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
	<body class="movie-page movie-classify-page">
		<div id="wrap">
			<!-- START header -->
		    <?php echo W('Common/allHeader');?>
		    
		    <?php echo W('Common/movieHeader');?>
		    
			    
			<!-- END header -->
			
			<div id="main">
				<div class="inner">
					<div class="f-left con">
						
						
						<div class="section">
							<div class="top">
								<h3>蜂巢电影分类</h3>
							</div>
							<div class="list-box">
								<h4>类型· · · · · · </h4>
								<ul>
									<li><a href="">爱情</a></li>
									<li><a href="">爱情</a></li>
									<li><a href="">爱情</a></li>
									<li><a href="">爱情</a></li>
									<li><a href="">爱情</a></li>
									<li><a href="">爱情</a></li>
								</ul>
							</div>	
						</div>
						
						
					</div>
					<div class="f-left sider">
						<div class="ad">
							<a href=""><img src="/beehive/Public/images/ad4.jpg"/></a>
						</div>
						<div class="hot">
                            <h3>标签直达</h3>
                            <form>
                                <input type="text" placeholder="去其他标签" name="tag"/>
                                <input type="submit" value="进入"/>
                            </form>
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