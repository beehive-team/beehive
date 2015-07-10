<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap.min.css">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap-theme.min.css">
		<script src="/beehive/Public/js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
		<title>Document</title>

	</head>
	<body>
		<h3 style="margin-left:220px;">添加图片</h3>
		<a class="btn btn-success" style="margin-left:50px;" href="/beehive/index.php/Admin/movie/index">返回上级</a>
		<table class="table table-hover" style="width:41%;margin:20px 230px;">
            <tr>
                <th>编号</th>
                <th>封面图片</th>
                <th>电影名</th>
                             	
			</tr>
			
            <tr class="active">
	            <td><?php echo ($row["id"]); ?></td>
	            <td><img src="/beehive/Public<?php echo ($r["path"]); ?>" alt="" class="img-responsive" alt="Responsive image"></td>
	            <td><?php echo ($row["name"]); ?></td>
	                   
            </tr>
                    
        </table>
		<form action="/beehive/index.php/Admin/Movie/doaddimage" method="post" class="form-horizontal" style="margin-top:30px;margin-left:140px;" role="form" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo ($row["id"]); ?>">
		  	<span style="width:15px;margin-left:80px;">选择图片</span>
		  	<div class="col-md-12">
		  	<p class="col-md-10">			  			   
		  	 	<input type="file" name="file0"style="float:left;margin-left:125px;margin-bottom:15px;"  /><button class="but" style="float:right;margin-right:230px;">继续上传</button>
		  	</p>	  	
		  	 </div>
		  	<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      	<button type="submit" class="btn btn-default">添加</button>
			    </div>
		  	</div>
		</form>
		<script>
			var i=1;
			$(".but").click(function(){
				switch($(this).html()){
					case '继续上传':
						var p_obj = $(this).parent().after($(this).parent().clone(true));
						var p_new = $(p_obj).next('p');	
												
						$(p_new).children('input').attr("name","file"+i)		
						i++;
						$(this).html('删除');
						break;

					case '删除':
						$(this).parent().remove();		
						break;
				}
				return false;
			})
		</script>
	</body>
</html>