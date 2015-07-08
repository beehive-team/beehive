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
				$('.sec-2 ul').bxSlider({
					auto:true,
					pager:false,
					controls:false
				});
			})
		</script>
		<!-- END 自定义 head -->
	</head>
	<body class="user-page user-index-page">
		<div id="wrap">
			<!-- START header -->
		    <?php echo W('Common/allHeader');?>
		    <?php echo W('Common/userHeader');?>
		    

		    
			    
			<!-- END header -->
			
			<div id="main">
				<div class="inner">
					<div class="f-left con">
						<div class="top">
							
							<div class="setting">
								<a class="set"href="">首页设置</a>
								<div class="interesting">
									<h2>设置你的首页，以下内容的更新会出现在这里：</h2>
									<div class="theme">
										<a href="">美食</a>
										<a href="">美食</a>
										<a href="">美食</a>
										<a href="">美食</a>
									</div>
								</div>
							</div>

							<ul>
								<li><a href=""><span></span>说句话</a></li>
								<li><a href=""><span class="second"></span>发照片</a></li>
								<li><a href=""><span class="third"></span>写日记</a></li>
							</ul>
							
						</div>
					</div>
					<div class="f-left sider"></div>
				</div>
			</div>
		</div>
		<!-- START footer -->
		    
		<!-- END footer -->

	</body>
</html>