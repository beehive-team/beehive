<?php if (!defined('THINK_PATH')) exit();?><div class="movie_header header same_header">
	<div class="top">
		<div class="inner">
			<h2>蜂巢读书</h2>
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
			<a href="">分类浏览</a>
			<a href="">购书单</a>
			<a href="">电子图书</a>
			<a href="">读书盘点2014</a>
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