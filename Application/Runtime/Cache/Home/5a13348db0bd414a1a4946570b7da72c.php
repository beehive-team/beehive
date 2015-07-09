<?php if (!defined('THINK_PATH')) exit();?><div class="movie_header header same_header clearfix">
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
		$('.search-box input').focusin(function(){
			$('.search-box input').addClass('active');
		}).focusout(function(){
			$('.search-box input').removeClass('active');
		})
	})
	</script>
</div>