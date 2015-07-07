<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/beehive/Public/CSS/bootstraps/css/bootstrap.min.css">
		<link rel="stylesheet" href="/beehive/Public/CSS/bootstraps/css/bootstrap-theme.min.css">
		<title>电影列表</title>
	</head>
	<body>
		<h3></h3>

		<form class="form-inline" role="form" style="margin-left:66px;">
		  <div class="form-group">
		    <label class="sr-only">电影名</label>
		  <input type="text" class="form-control"  placeholder="输入电影名进行查询">
		  </div>
		  <button type="submit" class="btn btn-default">搜索</button>
		</form>

		<table class="table table-bordered" style="width:89%;margin:10px auto;">
            <tr>
                <th>编号</th>
                <th>片名</th>
                <th>国内上映时间</th>
                <th>国外上映时间</th>
                <th>导演</th>
                <th>编剧</th>
				
				<th>片长</th>         				
				<th>影片年份</th>
				<th>简介/别名</th>
				<th>图片</th>
				<th>操作</th>
			</tr>

			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
	            <td><?php echo ($vo["id"]); ?></td>
	            <td><a class="btn btn-default" href=""><?php echo ($vo["name"]); ?></a></td>
	            <td><?php echo ($vo["crelease_t"]); ?></td>
	            <td><?php echo ($vo["orelease_t"]); ?></td>
	            <td><?php echo ($vo["director"]); ?></td>
	            <td><?php echo ($vo["writer"]); ?></td>
				
				<td><?php echo ($vo["tlong"]); ?></td>		           	           
	            <td><?php echo ($vo["year"]); ?></td>
	            <td><a class="btn btn-primary" href="/beehive/index.php/Admin/movie/brief">查看</a></td>
	            <td><a class="btn btn-info" href="/beehive/index.php/Admin/movie/addImage">添加</a></td>
				<td>					
					<a class="btn btn-success" href="/beehive/index.php/Admin/Movie/edit/id/<?php echo ($vo["id"]); ?>">编辑</a>
					<a class="btn btn-danger" href="/beehive/index.php/Admin/Movie/del/id/<?php echo ($vo["id"]); ?>"">删除</a>  
				
				</td>
            </tr><?php endforeach; endif; ?>
        </table>
	</body>
</html>