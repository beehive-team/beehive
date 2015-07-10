<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap.min.css">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap-theme.min.css">
		<script src="/beehive/Public/css/bootstraps/js/bootstrap.min.js"></script>
		<title>Document</title>
	</head>
	<body>
		<form action="/beehive/index.php/Admin/Movie/doedit" method="post" class="form-horizontal" style="margin-top:20px;margin-left:120px;" role="form">
			<input type="hidden" name="id" value="<?php echo ($row["id"]); ?>">
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label">影片名称</label>
		    	<div class="col-sm-10">
		      		<input name="name" name="name" value="<?php echo ($row["name"]); ?>" value="" type="text" style="width:35%;" class="form-control">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputPassword3" class="col-sm-2 control-label">国内上映时间</label>
		    	<div class="col-sm-10">
		      		<input name="crelease_t" value="<?php echo ($row["crelease_t"]); ?>" type="text" style="width:35%;" class="form-control">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label">国外上映时间</label>
		    	<div class="col-sm-10">
		      		<input type="text" name="orelease_t" value="<?php echo ($row["orelease_t"]); ?>" style="width:35%;" class="form-control">
		    	</div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">导演</label>
			    <div class="col-sm-10">
			      	<input name="director" value="<?php echo ($row["director"]); ?>" type="text" style="width:35%;" class="form-control">
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">编剧</label>
			    <div class="col-sm-10">
			      	<input name="writer" value="<?php echo ($row["writer"]); ?>" type="text" style="width:35%;" class="form-control">
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">制片国家/地区</label>
			    <div class="col-sm-10">
			      	<select name="country" class="form-control" style="width:35%;">
					  	<option value="">请选择...</option>
					  	<?php if(is_array($list)): foreach($list as $key=>$vo): ?><option <?php echo ($row['country']==$vo['id']?'selected':''); ?> value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">片长</label>
			    <div class="col-sm-10">
			      	<input name="tlong" value="<?php echo ($row["tlong"]); ?>" type="text" style="width:35%;" class="form-control">
			    </div>
		  	</div>
		  	
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">别名</label>
			    <div class="col-sm-10">
			      	<input name="alias" value="<?php echo ($row["alias"]); ?>" type="text" style="width:35%;" class="form-control">
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">影片年份</label>
			    <div class="col-sm-10">
			      	<select name="year" class="form-control" style="width:35%;">
					  	<option>请选择...</option>
					  	<?php if(is_array($li)): foreach($li as $key=>$vo): ?><option <?php echo ($row['year']==$vo['id']?'selected':''); ?> value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
			    </div>
		  	</div>
			<!--<label for="inputEmail3" class="col-sm-2 control-label">影片简介</label>
		  	<textarea name="brief" value="" style="width:35%;margin-bottom:10px;" class="form-control" rows="3"></textarea>-->
		  	<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      	<button type="submit" class="btn btn-default">修改</button>
			    </div>
		  	</div>

		</form>
	</body>
</html>