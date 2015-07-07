<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/beehive/Public/CSS/bootstraps/css/bootstrap.min.css">
		<link rel="stylesheet" href="/beehive/Public/CSS/bootstraps/css/bootstrap-theme.min.css">
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
                <th>片名</th>
                <th>国内上映时间</th>
                <th>国外上映时间</th>
                <th>导演</th>
                <th>编剧</th>
				<th>国家/地区</th>
				<th>片长</th>         
                <th>简介</th>
				<th>别名</th>
				<th>影片年份</th>
				<th>热映</th>
				<th>操作</th>
			</tr>

			
            <tr>
	            <td>1</td>
	            <td>哆啦A梦</td>
	            <td>2015-05-28</td>
	            <td>2014-08-08</td>
	            <td>八木龙一</td>
	            <td>山崎贵</td>
				<td>日本</td>
				<td>95分钟</td>	
	            <td>简介</td>
	            <td>伴我同行/Stand by Me Doraemon</td>
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