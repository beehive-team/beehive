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
				var int_show = false;
				$('.setting a.set').click(function(){
					if(!int_show){
						$('.interesting').slideDown();
						int_show = true;
					}else{
						$('.interesting').hide();
						int_show = false;
					}

				})

				$('.btn-box a').click(function(){
					if(!int_show){
						$('.interesting').slideDown();
						int_show = true;
					}else{
						$('.interesting').hide();
						int_show = false;
					}
				})

				$('.theme a').click(function(){
					
					if($(this).hasClass('on')){
						$(this).removeClass('on');
					}else{
						$(this).addClass('on');
					}
				})
				$('.top li a').click(function(){
					$('.top li img').hide();
					$(this).parents('li').find('img').show();
				})

				var status = false;
				$('.text .input-box textarea').focus(function(){
					if(!status){
						$('.top li.first').find('img').show();
						status = true;
						$(this).addClass('active');
						$(this).siblings('.file-image').addClass('active');
						$('.publish').show();
					}else{

					}

				})
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
								<a class="set"href="javascript:;">首页设置</a>
								<div class="interesting">
									<form>
										<h2>设置你的首页，以下内容的更新会出现在这里：</h2>
										<h3>兴趣主题</h3>

										<div class="theme clearfix">
											<a href="javascript:;">美食</a>
											<a href="javascript:;">美食</a>
											<a href="javascript:;">美食</a>
											<a href="javascript:;">美食</a>
											<a href="javascript:;">美食</a>
											<a href="javascript:;">美食</a>
											<a href="javascript:;">美食</a>
											<a href="javascript:;">美食</a>
											<a href="javascript:;">美食</a>
											
										</div>
										<h3>我的关注</h3>

										<div class="follow">
											<p>已关注 0 个蜂巢友邻<a href=="">去看看</a></p>
											
										</div>
										<div class="btn-box">
											<input type="submit" value="保存"/>
											<a href="">收起</a>
										</div>
									</form>
								</div>
							</div>

							<ul>
								<li class="first"><a href="javascript:;"><span></span>说句话</a><img src="/beehive/Public/images/tri.png"/></li>
								<li><a href="javascript:;"><span class="second"></span>发照片</a><img src="/beehive/Public/images/tri.png"/></li>
								<li><a href="javascript:;"><span class="third"></span>写日记</a><img src="/beehive/Public/images/tri.png"/></li>
							</ul>
							<form>
								<div class="text">
								
									<div class="input-box">
										<textarea class="say" placeholder="分享生活点滴"name="text"/></textarea>
										<span class="file-image">
											<input class="file"type="file" name="myfile"/>
										</span>
									</div>									
								
								</div>
								<div class="btn-box publish">
									<input type="submit" value="发布"/>	
								</div>
							</form>
						</div>
					</div>
					<div class="f-left sider"></div>
				</div>
			</div>
		</div>
		<!-- START footer -->
		    <?php echo W('Common/commonFooter');?>
		<!-- END footer -->

	</body>
</html>