<?php if (!defined('THINK_PATH')) exit();?><div class="user_header header same_header clearfix">
	<div class="top">
		<div class="inner">
			<div class="logo">
				<img src="/beehive/Public/images/logo.png"/>
			</div>
			<div class="list-box">
				<ul>
					<li><a href="">首页</a></li>
					<li><a href="">我的蜂巢</a></li>
					<li><a href="">浏览发现</a></li>
				</ul>
			</div>
			<div class="search-box">
		    	<form>
		    		<input class="search"name="search" type="text"/>
		    		<input class="button"type="submit" />
		    	</form>
		    </div>
			
		</div>
	</div>
	
	<script type="text/javascript">
	$(function(){
		$('.search-box input').focusin(function(){
			$('.search-box input').addClass('active');
		}).focusout(function(){
			$('.search-box input').removeClass('active');
		})
	})
	</script>
</div>