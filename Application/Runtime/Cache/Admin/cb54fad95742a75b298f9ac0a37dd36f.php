<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap.min.css">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap-theme.min.css">
		<script src="/beehive/Public/css/bootstraps/js/bootstrap.min.js"></script>
		<title>Document</title>	
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
		<table class="table table-hover" style="width:75%;margin:10px auto;">
            <tr>
                <th>编号</th>
                <th>图片</th>
                <th>电影名</th>
                <th>是否封面</th>
                <th>操作</th>
				
			</tr>

			
            <tr>
	            <td>1</td>
	            <td><img src="/beehive/Public/images/dlam.jpg" alt="" class="img-responsive" alt="Responsive image"></td>
	            <td>哆啦A梦</td>
	            <td>是</td>            
				<td>
					<a class="btn btn-success" href="">编辑</a>
					<a class="btn btn-primary" href="">删除</a> 
				
				</td>
            </tr>
            <tr>
	            <td>2</td>
	            <td><img src="/beehive/Public/images/cnlzd.jpg" alt=""></td>
	            <td>超能陆战队</td>
	            <td>是</td>            
				<td>
					<a class="btn btn-success" href="">编辑</a>
					<a class="btn btn-primary" href="">删除</a> 
				
				</td>
            </tr>
           
        </table>


		<ul class="pagination" style="margin-left:130px;">
		  <li><a href="#">&laquo;</a></li>
		  <li><a href="#">1</a></li>
		  <li><a href="#">2</a></li>
		  <li><a href="#">3</a></li>
		  <li><a href="#">4</a></li>
		  <li><a href="#">5</a></li>
		  <li><a href="#">&raquo;</a></li>
		</ul>


	</body>
</html>