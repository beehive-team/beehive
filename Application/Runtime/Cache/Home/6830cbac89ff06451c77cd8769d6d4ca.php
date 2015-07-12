<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<!-- START 公用 head -->
		    <?php echo W('Common/commonHead');?>
		<!-- END 公用 head -->
		<!-- START 自定义 head -->
		<link rel="stylesheet" href="/beehive/Public/js/jQuery-File-Upload-master/css/jquery.fileupload.css">  
		<link rel="stylesheet" href="/beehive/Public/js/jQuery-File-Upload-master/css/jquery.fileupload-ui.css"> 
		<script type="text/javascript" src="/beehive/Public/js/jquery.bxslider.min.js"></script>
		<script src="/beehive/Public/js/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js"></script>  
		<script src="/beehive/Public/js/jQuery-File-Upload-master/js/jquery.fileupload.js"></script>  
		<script src="/beehive/Public/js/jQuery-File-Upload-master/js/jquery.iframe-transport.js"></script> 

		<script type="text/javascript">
			$(function(){
				$('.sec-2 ul').bxSlider({
					auto:true,
					pager:false,
					controls:false
				});
				var int_show = false;
				var status = false;
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
					$('.text .input-box textarea').addClass('active');
					if($(this).parents('li').hasClass('sec')){
						$('.file-image').addClass('hide');
						$('.file-image').removeClass('active');
						$('.img-upload').addClass('show');
						status = true;
					}else{
						$('.file-image').addClass('active');
						$('.img-upload').removeClass('show');
						$('.file-image').removeClass('hide');

					}
					$('.publish').show();
				})

				$('.file-image a').click(function(){

					$(this).parents('span').addClass('hide');
					$('.img-upload').addClass('show');
					if(!status){
						$('.top li.sec').find('img').show();
						status = true;
						
						$(this).siblings('.file-image').addClass('active');
						$('.publish').show();
					}else{

					}
				})

				
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
				var img_all = new Array();
				
				$('.upload-box input').fileupload({  
					autoUpload: true,
				    autoUpload: true,
				    acceptFileTypes:  /(\.|\/)(gif|jpe?g|png)$/i,
				    maxNumberOfFiles : 1,
				    
				    add: function (e, data) {
				        data.submit(); //this will 'force' the submit in IE < 10
				    },
				   
				    done:function(e,result){ 
				    	//完成后进行的操作	 
				    	var img_src = JSON.stringify(result.result);
				    	//alert(img_src);
				    	$('.upload-box').before('<div class="img-box">')
				    	     
				    	var new_div = $('.img-upload div.img-box').last(); 
				    	$(new_div).append('<img src='+img_src+'/>');
				    	$(new_div).append('<span><a href="javascript:;"></a></span>');
				    	img_all.push(img_src);
				    	
				    },
				    fail: function(e, data) {
			                  //错误提示
				    	  alert('Fail!');
				    }
				}); 

				$('.img-box span a').on('click','.img-upload',function(){
					
				});
				$(document).on('click','.img-box span a',function(){
					var img_box = $(this).parents('.img-box');
					var i = $(img_box).index();
					
					img_all.splice(i,1);
					$(img_box).remove();

					// alert(img_all);

				})

				$('.info-box .info a.like').click(function(){
					if($(this).hasClass('active')){
						$(this).removeClass('active');
					}else{
						$(this).addClass('active');
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
				<div class="inner clearfix">
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
								<div class="list-box f-left">
									<ul>
										<li class="first"><a href="javascript:;"><span></span>说句话</a><img src="/beehive/Public/images/tri.png"/></li>
										<li class="sec"><a href="javascript:;"><span class="second"></span>发照片</a><img src="/beehive/Public/images/tri.png"/></li>
										<li><a class="thir"href="javascript:;"><span class="third"></span>写日记</a><img src="/beehive/Public/images/tri.png"/></li>
									</ul>
							</div>
							</div>

							<form>
								<div class="text">
								
									<div class="input-box">
										<textarea class="say" placeholder="分享生活点滴"name="text"/></textarea>
										<span class="file-image">
											<a href="javascript:;"></a>
										</span>
									</div>
									<div class="img-upload">
									
										
										<div class="upload-box">
											<span>+<input type="file" data-url="/beehive/index.php/Home/User/imgUpload" multiple name="myfile[]"/></span>
										</div>
										
									</div>	
								
								</div>

								<div class="btn-box publish">
									<input type="submit" value="发布"/>	
								</div>
							</form>
						</div>
						<div class="info-box">
							<ul>
								<li>
									<div class="face-box">
										<img src="/beehive/Public/images/face1.jpg">
									</div>
									<div class="diary info">
										<p><a href="">马提尼</a>的日记: </p>
										<div class="detail">
											<a class="title" href="">了解金融和投资15本有趣的书籍</a>
											<p>十五本关于金融和投资的有趣又有益的书 欢迎大家关注我的微信公众号：理财课堂（Lckt168） 私人微信号：topok11 如果一个人要对金融和投资方面的实际知识得到比较深入的了解，十五本书无疑是... </p>
											<a class="like"href="javascript:;"><span>love</span>喜欢</a>
											<div class="list-box">
												标签：
												<a href="">购物</a>
												<a href="">唇彩</a>
											</div>
										</div>
										<div class="time">
											<p>22分钟前</p>
										</div>
									</div>
								</li>
								<li>
									<div class="face-box">
										<img src="/beehive/Public/images/face1.jpg">
									</div>
									<div class="album info">
										<p><a href="">马提尼</a>的相册: </p>
										<div class="detail">
											<div class="img-box">
												<a href="">
													<img src="/beehive/Public/images/photo5.jpg"/>
													<img src="/beehive/Public/images/photo5.jpg"/>
													<img src="/beehive/Public/images/photo5.jpg"/>
													<img src="/beehive/Public/images/photo5.jpg"/>

												</a>
											</div>
											<a class="like"href="javascript:;"><span>love</span>喜欢</a>
											<div class="list-box">
												标签：
												<a href="">购物</a>
												<a href="">唇彩</a>
											</div>
										</div>
										<div class="time">
											<p>22分钟前</p>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="f-right sider">
						<div class="hot">
							<h2>蜂巢酿蜜</h2>
							<ul>
								<li><a href="">行走的力量行走的力量行走的力量</a></li>
								<li><a href="">行走的力量行走的力量行走的力量</a></li>
								<li><a href="">行走的力量行走的力量行走的力量</a></li>
							</ul>
						</div>
						<div class="ad">
							<img src="/beehive/Public/images/ad4.jpg">
						</div>
						<div class="a-box">
							<a href="">> 申请创建小组</a>
						</div>
						<div class="ad">
							<img src="/beehive/Public/images/ad4.jpg">
						</div>
					</div>
				</div>
				</div>
		</div>
		<!-- START footer -->
		    <?php echo W('Common/commonFooter');?>
		<!-- END footer -->

		<script type="text/javascript">
			
		</script>

	</body>
</html>