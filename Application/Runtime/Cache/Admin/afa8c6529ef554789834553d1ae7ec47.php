<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap.min.css">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap-theme.min.css">
		<script src="/beehive/Public/css/bootstraps/js/bootstrap.min.js"></script>
		<title>电影列表</title>
	</head>
	<body>
		<h3></h3>

		<form class="form-inline" role="form" style="margin-left:140px;">
		  <div class="form-group">
		    <label class="sr-only">电影名</label>
		  <input type="text" class="form-control"  placeholder="输入电影名进行查询">
		  </div>
		  <button type="submit" class="btn btn-default">搜索</button>
		</form>

		<table class="table table-bordered" style="width:75%;margin:10px auto;">
            <tr>
                <th>编号</th>
                <th>图书名</th>
                <th>国内发行时间</th>
                <th>国外发行时间</th>
                <th>作者</th>
				<th>国家/地区</th>
				<th>字数</th>         
                <th>简介</th>
				<th>别名</th>
				<th>年份</th>
				<th>热销</th>
				<th>操作</th>
			</tr>

			
            <tr>
	            <td>1</td>
	            <td>细说PHP</td>
	            <td>2015-05-28</td>
	            <td>2014-08-08</td>
	            <td>高罗峰</td>
				<td>中国</td>
				<td>XXXX</td>	
	            <td>简介</td>
	            <td>PHP</td>
	            <td>2014</td>
	            <td>是</td>
				<td>
					
					<a class="btn btn-success" href="">编辑</a>
					<a class="btn btn-primary" href="">删除</a>  
				
				</td>
            </tr>
           
        </table>
	</body>
</html>