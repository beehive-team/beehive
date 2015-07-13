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
		<form action="/beehive/index.php/Admin/Movie/doadd" method="post" enctype="multipart/form-data" class="form-horizontal" style="margin-top:20px;margin-left:120px;" role="form">
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label">影片名称</label>
		    	<div class="col-sm-10">
		      		<input name="name" value="" type="text" style="width:35%;" class="form-control" placeholder="请输入电影名">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputPassword3" class="col-sm-2 control-label">国内上映时间</label>
		    	<div class="col-sm-10">
		      		<input name="crelease_t" value="" type="text" style="width:35%;" class="form-control" placeholder="输入上映时间">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label">国外上映时间</label>
		    	<div class="col-sm-10">
		      		<input type="text" name="orelease_t" value="" style="width:35%;" class="form-control" placeholder="输入上映时间">
		    	</div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">导演</label>
			    <div class="col-sm-10">
			      	<input name="director" value="" type="text" style="width:35%;" class="form-control" placeholder="请输入导演名">
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">编剧</label>
			    <div class="col-sm-10">
			      	<input name="writer" value="" type="text" style="width:35%;" class="form-control" placeholder="请输入编剧">
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">制片国家/地区</label>
			    <div class="col-sm-10">
			      	<select name="country" class="form-control" style="width:35%;">
					  	<option value="">请选择...</option>
					  	<?php if(is_array($list)): foreach($list as $key=>$vo): ?><option  value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">片长</label>
			    <div class="col-sm-10">
			      	<input name="tlong" value="" type="text" style="width:35%;" class="form-control" placeholder="影片时长">
			    </div>
		  	</div>
		  	
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">别名</label>
			    <div class="col-sm-10">
			      	<input name="alias" value="" type="text" style="width:35%;" class="form-control" placeholder="请输入别名">
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">影片年份</label>
			    <div class="col-sm-10">
			      	<select name="year" class="form-control" style="width:35%;">
					  	<option>请选择...</option>
					  	<?php if(is_array($li)): foreach($li as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">上传图片</label>
			    <div class="col-sm-10">
			      	<input name="file" type="file" style="width:35%;" >
			    </div>
		  	</div>
		  	<div class="form-group">
			   	<label for="inputEmail3" class="col-sm-2 control-label">选择类型</label>		    
			        <div class="col-sm-10">
			        	<?php if(is_array($lis)): foreach($lis as $key=>$vo): ?><input name="c_id[]" style="margin:6px 2px;"  type="checkbox" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); endforeach; endif; ?>
			   	    </div>
			</div>
			
			<label for="inputEmail3" class="col-sm-2 control-label">影片简介</label>
		  	<textarea name="brief" value="" style="width:35%;margin-bottom:10px;" class="form-control" rows="3"></textarea>
		  	<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      	<button type="submit" class="btn btn-success">添加</button>
			    </div>
		  	</div>

		</form>
	</body>
</html>