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
				var c_id
				var i=4;
				c_id='hot';
				$.post('/beehive/index.php/Home/Movie/getCata',{c_id:'hot',num:i},function(data){
					for(var tmp in data){
						$('#dys').append('<li><a href="/beehive/index.php/Home/Movie/detail/id/'+data[tmp]['m_id']+'"><img src=/beehive/Public'+data[tmp]['i_path']+'207_'+data[tmp]['name']+'><p>'+data[tmp]['mname']+'<i>7.8</i></p></a></li>');
						}
				},'json')

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
				//var i=2;
				//var c_id
				$('.tab a').click(function(){
					i=4;
					c_id = $(this).attr('rel');
					$.post('/beehive/index.php/Home/Movie/getCata',{c_id:c_id,num:i},function(data){
						//alert(data[0]['mname']);
						$('#dys').empty();
						for(var tmp in data){
							$('#dys').append('<li><a href="/beehive/index.php/Home/Movie/detail/id/'+data[tmp]['m_id']+'"><img src=/beehive/Public'+data[tmp]['i_path']+'207_'+data[tmp]['name']+'><p>'+data[tmp]['mname']+'<i>7.8</ i></p></a></li>');
						}
					},'json')
				})

				$('.ajax-button a').click(function(){
					alert(c_id);
					i=i+4;
					$.post('/beehive/index.php/Home/Movie/getCata',{c_id:c_id,num:i},function(data){
						$('#dys').empty();
						for(var tmp in data){
							$('#dys').append('<li><a href="/beehive/index.php/Home/Movie/detail/id/'+data[tmp]['m_id']+'"><img src=/beehive/Public'+data[tmp]['i_path']+'207_'+data[tmp]['name']+'><p>'+data[tmp]['mname']+'<i>7.8</i></p></a></li>');
						}
											
					},'json')
				})

				$('.tip').css('display','none');
				$('#check').click(function(){
					if($('#check').is(':checked') && '<?php echo (session('home')); ?>' == ''){
						$('.tip').css('display','block');
						//alert('e');
					}else{
						$('.tip').css('display','none');			
					}	
				})		
			})
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
						<div class="section sec-1">
							<div class="top">
								<h3>正在热映</h3>
								<a href="">全部正在热映》</a>
								<a href="">即将上映》</a>
							</div>
							<div class="bottom">
								<ul class="slider">
									<?php if(is_array($row)): foreach($row as $key=>$vo): ?><li>
										<a href="">
											<img src="/beehive/Public/<?php echo ($vo["i_path"]); ?>180_<?php echo ($vo["name"]); ?>"/>
											<p><?php echo ($vo["mname"]); ?></p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li><?php endforeach; endif; ?>
								</ul>
							</div>
						</div>
						<div class="section sec-2">
							<div class="top">
								<h3>选电影</h3>
							</div>
							<form>
								<div class="tab">
									<a rel="hot" href="javascript:;">热门</a>
									<?php if(is_array($list)): foreach($list as $key=>$vo): ?><a class="oa1" rel="<?php echo ($vo["id"]); ?>" href="javascript:;"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; ?>
									
								</div>
								<div class="chose">
									<div class="sort f-left">
										<label><input type="radio" name="sort" value="hot"/>按热度排序</label>
										<label><input type="radio" name="sort" value="time"/>按时间排序</label>
										<label><input type="radio" name="sort" value="rank"/>按评价排序</label>
									</div>
									<div class="check f-right">
										<label><input id="check" type="checkbox" name="check" value="seen"/>我没看过的</label>
									</div>
								</div>
							</form>
							<div class="tip">
								<p>注册登录后可以保存自己的观影记录,快快登录吧！<a href="">登录</a><a href="">注册</a></p>
							</div>
							<div class="movies">
								<ul id="dys">
									<!--<li>
										<a href="">
											<img src="/beehive/Public/images/movie3.jpg"/>
											<p>疯狂的麦克斯<i>7.8</i></p>
										</a>									
									</li>-->
								</ul>
								<div class="ajax-button">
									<a href="javascript:;">加载更多</a>
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
		    <?php echo W('Common/commonFooter');?>
		    
		   	
		<!-- END footer -->

	</body>
</html>