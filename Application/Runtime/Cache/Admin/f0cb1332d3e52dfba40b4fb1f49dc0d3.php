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
		<h3>电影分类列表</h3>
		<table class="table table-bordered" style="width:75%;margin:10px auto;">
            <tr>
                <th>编号</th>
                <th>分类名称</th>
                <th>父类ID</th>
                <th>PATH字段</th>
                <th>显示字段</th>
                <th>操作</th>
				
			</tr>

			
            <tr>
	            <td>1</td>
	            <td>国家</td>
	            <td>0</td>
	            <td>0,</td>
	            <td>是</td>
				<td>
					<a class="btn btn-info" href="">查看子类</a>
					<a class="btn btn-info" href="">添加子类</a>
					<a class="btn btn-success" href="">编辑</a>
					<a class="btn btn-primary" href="">删除</a> 
				
				</td>
            </tr>
           
        </table>
	</body>
</html>