<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap.min.css">
		<link rel="stylesheet" href="/beehive/Public/css/bootstraps/css/bootstrap-theme.min.css">
		
		<title>Document</title>
	</head>
	<body>
		<form class="form-horizontal" style="margin-top:20px;margin-left:120px;" role="form">
		  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">图书名称</label>
			    <div class="col-sm-10">
			      	<input type="text" style="width:30%;" class="form-control" id="inputEmail3" placeholder="请输入图书名称">
			    </div>
		  	</div>
		  	<p><input type="file" name="file0"><input type="button" onclick="add(this)" value="继续上传" /></p>
			
		  	<div id="before" class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      	<button type="submit" class="btn btn-default">添加</button>
			    </div>
		  	</div>
		</form>
		<script>
            var i=1;
            function add(obj){
                // 找到obj的爹 p
                var p = obj.parentNode.cloneNode();

                // 把克隆好的p标签，添加到最后一个p标签的前面即可
                document.forms[0].insertBefore(p, document.getElementById("before"));

                // 把按钮的名称变成 删除
                obj.value="删除";
                obj.setAttribute('onclick', 'del(this)');

                // 改变文件上传域中的name属性
                obj.previousSibling.setAttribute('name', 'file'+i);

                i++;
            }

            // 删除
            function del(obj){
                document.forms[0].removeChild(obj.parentNode);
            }
        </script>    
	</body>
</html>