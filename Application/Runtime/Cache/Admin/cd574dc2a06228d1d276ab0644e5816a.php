<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/beehive/Public/CSS/bootstraps/css/bootstrap.min.css">
		<link rel="stylesheet" href="/beehive/Public/CSS/bootstraps/css/bootstrap-theme.min.css">
		<script src="/beehive/Public/css/bootstraps/js/bootstrap.min.js"></script>
		<title>Document</title>
		<style>
			.brief-left{
				width: 380px;
				height: 250px;
				margin-left:10px;
				float: left;
				margin-top: 70px;
			}
			.brief-right{
				width: 430px;
				height: 250px;
				float: right;
				margin-top: 70px;
				margin-right: 105px;
			}	
		</style>
	</head>
	<body>

		<h3 style="margin-left:220px;">别名/简介管理</h3> 
		<div style="float:left;">
			<a class="btn btn-success" style="margin-left:25px;margin-top:20px;" href="/beehive/index.php/Admin/movie/index">返回上级</a>
		</div>
		<br/>
		<div class="brief-left">
			<table class="table table-hover" style="width:100%;margin:5px 5px;">
	            <tr>
	                <th>编号</th>
	                <th>图片</th>
	                <th>电影名</th>
	                             	
				</tr>
				
	            <tr class="active">
		            <td><?php echo ($row["id"]); ?></td>
		            <td><img src="/beehive/Public<?php echo ($r["path"]); ?>" alt="" class="img-responsive" alt="Responsive image"></td>
		            <td><?php echo ($row["name"]); ?></td>
		                   
	            </tr>
	                    
	        </table>
		</div>

		<div class="brief-right">
			<form action="/beehive/index.php/Admin/Movie/editbrief" method="post" class="form-horizontal" style="margin-left:10px;" role="form">
				<input type="hidden" name="id" value="<?php echo ($row["id"]); ?>">
				<div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label" style="padding-right:0px;">影片别名</label>
				    <div class="col-sm-10">
				      	<input type="text" style="width:85%;" class="form-control" name="alias" value="<?php echo ($row["alias"]); ?>">
				    </div>
			  	</div>
				<label for="inputEmail3" style="padding:7px 9px 0 0;margin-top:20px;" class="col-sm-2 control-label">影片简介</label>
			  	<textarea name="brief" style="width:80%;margin-top:50px;margin-bottom:20px;" class="form-control" rows="3"><?php echo ($row["brief"]); ?></textarea>
			  	
			  	<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      	<button type="submit" class="btn btn-default">修改</button>
				    </div>
			  	</div>
			</form>
		</div>
	</body>
</html>