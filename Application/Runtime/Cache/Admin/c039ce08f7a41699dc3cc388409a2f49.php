<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap.min.css">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap-theme.min.css">
		<title>编辑分类</title>
	</head>
	<body>
		<a class="btn btn-success" style="margin-left:50px;margin-top:20px;" href="/beehive/index.php/Admin/movie/classify">返回上级</a>
		<form action="<?php echo U('Movie/doeditclassify');?>" method="post" class="form-horizontal" style="margin-top:50px;margin-left:120px;" role="form">
			<input type="hidden" name="id" value="<?php echo ($row["id"]); ?>">
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
		    	<div class="col-sm-10">
		      		<input type="text" style="width:30%;" class="form-control" name="name" value="<?php echo ($row["name"]); ?>" placeholder="请输入分类名称">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputPassword3" class="col-sm-2 control-label">pid</label>
		    	<div class="col-sm-10">
		      		<input type="text" style="width:30%;" class="form-control" name="pid" value="<?php echo ($row["pid"]); ?>" placeholder="输入pid">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label">path</label>
		    	<div class="col-sm-10">
		      		<input type="text" style="width:30%;" class="form-control" name="path" value="<?php echo ($row["path"]); ?>"  placeholder="输入path">
		    	</div>
		  	</div>
		  	<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      	<button type="submit" class="btn btn-default">编辑</button>
			    </div>
		  	</div>
		</form>
	</body>
</html>