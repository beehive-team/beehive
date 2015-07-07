<?php if (!defined('THINK_PATH')) exit();?><div class="header">
	<div class="inner">
    	<div class="logo">
	    	<img src="/beehive/Public/images/logo.png"/>
	    </div> 
	    <div class="search-box">
	    	<form>
	    		<input class="search"name="search" type="text"/>
	    		<input class="button"type="submit" />
	    	</form>
	    </div>
	    <div class="list-box">
	    	<a class="first"href="">读书</a>
	    	<a class="second"href="">电影</a>
	    	<a class="third"href="">小组</a>
	    	<a class="forth"href="">提问</a>
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