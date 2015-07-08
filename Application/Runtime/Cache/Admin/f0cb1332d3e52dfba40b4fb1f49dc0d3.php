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
		<?php if(empty($_GET['id'])): ?><a class="btn btn-success" style="margin-left:50px;margin-top:30px;" href="/beehive/index.php/Admin/movie/addclassify">添加一级分类</a>
		<?php else: ?>
		<a class="btn btn-primary" style="margin-left:50px;margin-top:30px;" href="/beehive/index.php/Admin/movie/classify">返回上级</a><?php endif; ?>
		<table class="table table-bordered" style="width:75%;margin:35px auto;">
            <tr>
                <th>编号</th>
                <th>分类名称</th>
                <th>父类ID</th>
                <th>PATH字段</th>
                <th>显示字段</th>
                <th>操作</th>
				
			</tr>
			<?php if(empty($list)): ?><tr>
				<td colspan="6" style="font-size:20px;text-align:center;">没有更多子类了</td>
			</tr>
			<?php else: ?>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
	            <td><?php echo ($vo["id"]); ?></td>
	            <td><?php echo ($vo["name"]); ?></td>
	            <td><?php echo ($vo["pid"]); ?></td>
	            <td><?php echo ($vo["path"]); ?></td>
	            <td>是</td>
				<td>
					<a class="btn btn-info" href="/beehive/index.php/Admin/Movie/classify/id/<?php echo ($vo["id"]); ?>">查看子类</a>
					<a class="btn btn-info" href="/beehive/index.php/Admin/movie/addclassify/id/<?php echo ($vo["id"]); ?>">添加子类</a>
					<a class="btn btn-success" href="/beehive/index.php/Admin/Movie/editclassify/id/<?php echo ($vo["id"]); ?>">编辑</a>
					<a class="btn btn-danger" href="/beehive/index.php/Admin/Movie/delclassify/id/<?php echo ($vo["id"]); ?>">删除</a> 
				
				</td>
            </tr><?php endforeach; endif; endif; ?>
        </table>
	</body>
</html>