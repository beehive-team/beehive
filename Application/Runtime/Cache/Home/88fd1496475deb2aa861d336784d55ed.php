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
		<style>
	
		.list-box li{

			float:left;
		}
		.list-box li[class="title"]{
			width:313px;
		}
		li{list-style: none; padding: 0; margin: 0;}

		.jing{
			padding-top:30px;
		}

		.hd{
			padding-top:30px;
		}

		</style>
	</head>
	<body class="movie-page">
		<div id="wrap">
			<!-- START header -->
		    <?php echo W('Common/allHeader');?>
		    <?php echo W('Common/bookHeader');?>
			    
			<!-- END header -->
			
			<div id="main">
				<div class="inner">
					<div class="f-left con">
						<div class="section sec-1">
							<div class="top">
								<h3>新书速递</h3>
								<a href="">更多》</a>
							</div>
							<div class="bottom">
								<ul class="slider">
									<li >
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>									
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
								</ul>
							</div>
						</div>

						<div>
						<div class="section sec-1">
							<div class="top">
								<h3>最受关注图书榜</h3>
								<a href="">更多》</a>
							</div>
							<div class="bottom">
								<ul class="slider">
									<li >
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>									
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
								</ul>
							</div>
						</div>
						</div>

						<div>
						<div class="section sec-1">
							<div class="top">
								<h3>电子图书</h3>
								<a href="">更多》</a>
							</div>
							<div class="bottom">
								<ul class="slider">
									<li >
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>									
									<li>
										<a href="">
											<img src="/beehive/Public/images/movie2.jpg"/>
											<p>细说PHP</p>
											<span class="allstar40"></span><i>3.7</i>
										</a>
									</li>
								</ul>
							</div>
						</div>
						</div>

						<div class="section sec-2">
							<div class="top">
								<h3>选图书</h3>
							</div>
							<form>

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
								<p>注册登录后进入书签查看阅读记录，快快登陆吧！<a href="">登录</a><a href="">注册</a></p>
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
												<h4>2015热门书籍</h4>
												<p>来自<span>heheda</span></p>
												<p>sss</p>
											</div>
										</a>
									</li>
									<li>
										<a href="">
											<div class="img-box f-left"><img src="/beehive/Public/images/movie4.jpg"/></div>
											<div class="text-box f-left">
												<h4>2015热门书籍</h4>
												<p>来自<span>heheda</span></p>
												<p>sss</p>
											</div>
										</a>
									</li>
									<li>
										<a href="">
											<div class="img-box f-left"><img src="/beehive/Public/images/movie4.jpg"/></div>
											<div class="text-box f-left">
												<h4>2015热门书籍</h4>
												<p>来自<span>heheda</span></p>
												<p>sss</p>
											</div>
										</a>
									</li>
									<li>
										<a href="">
											<div class="img-box f-left"><img src="/beehive/Public/images/movie4.jpg"/></div>
											<div class="text-box f-left">
												<h4>2015热门书籍</h4>
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
								<h3>评书人</h3>
								<a href="">进入书评专区》</a>
							</div>
							<div class="bottom">
								<ul>
									<li>
										<div class="img-box f-left"><a href=""><img src="/beehive/Public/images/movie6.jpg"/></a></div>
										<div class="text-box f-left">
											<h5><a href="">标题</a></h5>
                                            <p><a href="">作者&nbsp;</a>评论&nbsp;<a href="">书名</a><span class="allstar40"></span></p>
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

				        <ul class="list-box">
				            <li class="title">
				                文学
				            </li>
				            <br/>
				            <li>
				                <a href="" >小说</a>
				            </li>
				            <li>
				                <a href="" >随笔</a>
				            </li>
				            <li>
				                <a href="" >散文</a>
				            </li>
				            <li class="last">
				                  <a href="k" >日本文学</a>
				            </li>
				            <li>
				                <a href="" >童话</a>
				            </li>
				            <li>
				                <a href="" >诗歌</a>
				            </li>
				            <li>
				                <a href="" >名著</a>
				            </li>
				            <li class="">
				                  <a href="" >港台</a>
				            </li>
				            <li class="">
				                  <a href="" class="tag more_tag">更多》</a>
				            </li>
				        </ul>
				    </li>

				      
				    

				    <li>
				        <ul class="list-box">
				            <li class="title">
				                流行
				            </li>
				            <li>
				                <a href="" >漫画</a>
				            </li>
				            <li>
				                <a href="" >绘本</a>
				            </li>
				            <li>
				                <a href="" >推理</a>
				            </li>
				            <li class="last">
				                  <a href="" >青春</a>
				            </li>
				            <li>
				                <a href="" >言情</a>
				            </li>
				            <li>
				                <a href="" >科幻</a>
				            </li>
				            <li>
				                <a href="" >武侠</a>
				            </li>
				            <li class="last">
				                  <a href="" >奇幻</a>
				            </li>
				            <li class="last">
				                  <a href="" class="tag more_tag">更多》</a>
				            </li>
				        </ul>
				    </li>

				      
				    

				    <li>
				        <ul class="list-box">
				            <li class="title">
				                文化
				            </li>
				            <li>
				                <a href="" >历史</a>
				            </li>
				            <li>
				                <a href="" >哲学</a>
				            </li>
				            <li>
				                <a href="" >传记</a>
				            </li>
				            <li class="last">
				                  <a href="" >设计</a>
				            </li>
				            <li>
				                <a href="" >建筑</a>
				            </li>
				            <li>
				                <a href="" >电影</a>
				            </li>
				            <li>
				                <a href="" >回忆录</a>
				            </li>
				            <li class="">
				                  <a href="" >音乐</a>
				            </li>
				            <li class="last">
				                  <a href="" class="tag more_tag">更多》</a>
				            </li>
				        </ul>
				    </li>

				      
				    

				    <li>
				        <ul class="list-box">
				            <li class="title">
				                生活
				            </li>
				            <li>
				                <a href="" >旅行</a>
				            </li>
				            <li>
				                <a href="" >励志</a>
				            </li>
				            <li>
				                <a href="" >职场</a>
				            </li>
				            <li class="last">
				                  <a href="" >美食</a>
				            </li>
				            <li>
				                <a href="" >教育</a>
				            </li>
				            <li>
				                <a href="" >灵修</a>
				            </li>
				            <li>
				                <a href="" >健康</a>
				            </li>
				            <li class="last">
				                  <a href="" >家居</a>
				            </li>
				            <li class="last">
				                  <a href="" class="tag more_tag">更多》</a>
				            </li>
				        </ul>
				    </li>

				      
				    

				    <li>
				        <ul class="list-box">
				            <li class="title">
				                经管
				            </li>
				            <li>
				                <a href="" >经济学</a>
				            </li>
				            <li>
				                <a href="" >管理</a>
				            </li>
				            <li>
				                <a href="" >金融</a>
				            </li>
				            <li class="last">
				                  <a href="" >商业</a>
				            </li>
				            <li>
				                <a href="" >营销</a>
				            </li>
				            <li>
				                <a href="" >理财</a>
				            </li>
				            <li>
				                <a href="" >股票</a>
				            </li>
				            <li class="">
				                  <a href="" >企业史</a>
				            </li>
				            <li class="">
				                  <a href="" class="tag more_tag">更多》</a>
				            </li>
				        </ul>
				    </li>

				      
				    

				    <li>
				        <ul class="list-box">
				            <li class="title">
				                科技
				            </li>
				            <li>
				                <a href="" >科普</a>
				            </li>
				            <li>
				                <a href="" >互联网</a>
				            </li>
				            <li>
				                <a href="" >编程</a>
				            </li>
				            <li class="">
				                  <a href="" >交互设计</a>
				            </li>
				            <li>
				                <a href="" >算法</a>
				            </li>
				            <li>
				                <a href="" class="">通信</a>
				            </li>
				            <li>
				                <a href="" class="">神经网络</a>
				            </li>
				            <li class="last">
				                  <a href="" class="">更多》</a>
				            </li>
				        </ul>
				    </li>

					<div class="section weekly-top">
					    <div class="hd">
					        <h2>畅销图书榜</h2>
					    </div>
					    <div class="bd">
					        <ul class="nav-vendor">
					            <li class="on book-chart-hd" id="jd-book-chart-hd">
					                <img src="/beehive/Public/images/jd.PNG" height="18" width="18">
					                <span>京东</span>
					            </li>
					            <li class="book-chart-hd" id="amazon-book-chart-hd">
					                <img src="/beehive/Public/images/a.PNG" height="18" width="18">
					                <span>亚马逊</span>
					            </li>
					            <li class="book-chart-hd" id="dangdang-book-chart-hd">
					                <img src="/beehive/Public/images/dd.PNG" height="18" width="18">
					                <span>当当</span>
					            </li>
					        </ul>

				            <ul class="list list-ranking">
				                <li class="item">
				                    <span class="rank-num">1.</span>
				                    <div class="book-info">
				                        <a href="" class="name" target="_blank">秘密花园</a>
				                        <div class="author">[英]乔汉娜·贝斯福/Johanna Basford</div>
				                    </div>
				                    <a href="" target="_blank"><span class="buy-button">去购买</span></a>
				                </li>
				                
				                <li class="item">
				                    <span class="rank-num">2.</span>
				                    <div class="book-info">
				                        <a href="" class="name" target="_blank">无声告白</a>
				                        <div class="author">[美] 伍绮诗</div>
				                    </div>
				                    <a href="e" target="_blank"><span class="buy-button">去购买</span></a>
				                </li>
				                
				                <li class="item">
				                    <span class="rank-num">3.</span>
				                    <div class="book-info">
				                        <a href="" class="name" target="_blank">从0到1</a>
				                        <div class="author">彼得·蒂尔/布莱克·马斯特斯</div>
				                    </div>
				                    <a href="" target="_blank"><span class="buy-button">去购买</span></a>
				                </li>
				                
				                <li class="item">
				                    <span class="rank-num">4.</span>
				                    <div class="book-info">
				                        <a href="" class="name" target="_blank">追风筝的人</a>
				                        <div class="author">[美] 卡勒德·胡赛尼</div>
				                    </div>
				                    <a href=""><span class="buy-button">去购买</span></a>
				                </li>
				                
				                <li class="item">
				                    <span class="rank-num">5.</span>
				                    <div class="book-info">
				                        <a href="" class="name" target="_blank">股票投资入门与实战技巧</a>
				                        <div class="author">王坤</div>
				                    </div>
				                    <a href="" target="_blank"><span class="buy-button">去购买</span></a>
				                </li>
				                
				                <li class="item">
				                    <span class="rank-num">6.</span>
				                    <div class="book-info">
				                        <a href="/" class="name" target="_blank">解忧杂货店</a>
				                        <div class="author">(日)东野圭吾</div>
				                    </div>
				                    <a href="" target="_blank"><span class="buy-button">去购买</span></a>
				                </li>
				                
				                <li class="item">
				                    <span class="rank-num">7.</span>
				                    <div class="book-info">
				                        <a href="" class="name" target="_blank">岛上书店</a>
				                        <div class="author">[美] 加布瑞埃拉·泽文</div>
				                    </div>
				                    <a href="" target="_blank"><span class="buy-button">去购买</span></a>
				                </li>
				                
				                <li class="item">
				                    <span class="rank-num">8.</span>
				                    <div class="book-info">
				                        <a href="" class="name" target="_blank">我敢在你怀里孤独</a>
				                        <div class="author">刘若英</div>
				                    </div>
				                    <a href="" target="_blank"><span class="buy-button">去购买</span></a>
				                </li>
				                
				                <li class="item">
				                    <span class="rank-num">9.</span>
				                    <div class="book-info">
				                        <a href="" class="name" target="_blank">花千骨</a>
				                        <div class="author">果果</div>
				                    </div>
				                    <a href="" target="_blank"><span class="buy-button">去购买</span></a>
				                </li>
				                
				                <li class="item">
				                    <span class="rank-num">10.</span>
				                    <div class="book-info">
				                        <a href="" class="name" target="_blank">朝花夕拾</a>
				                        <div class="author">鲁迅</div>
				                    </div>
				                    <a href="" target="_blank"><span class="buy-button">去购买</span></a>
				                </li>
				            </ul>

							 <h2 class="jing">
							    <span class="">蜂巢图书精选</span>
							      <span class="link-more">
							        <a class="" href="http://book.douban.com/top250?icn=index-book250-all">更多»</a>
							      </span>
							  </h2>

							  <div class="content clearfix s" id="book_rec" data-dstat-areaid="58" data-dstat-mode="click,expose">
          
    
							    <dl>
							      <dt>
							        <a onclick="moreurl(this, {from:'top'})" href="">
							          <img src="db_files/s1020454.jpg" class="m_sub_img">
							        </a>
							      </dt>
							      <dd>
							        <a onclick="moreurl(this, {from:'top'})" href="">
							          哭泣的骆驼
							        </a>
							        <p class="extra-info">
							          
							  
							        </p>
							      </dd>
							    </dl>
							    
							    <dl>
							      <dt>
							        <a onclick="moreurl(this, {from:'top'})" href="">
							          <img src="db_files/s1563589.jpg" class="m_sub_img">
							        </a>
							      </dt>
							      <dd>
							        <a onclick="moreurl(this, {from:'top'})" href="">
							          长安乱
							        </a>
							        <p class="extra-info">
							          
							  
							        </p>
							      </dd>
							    </dl>

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