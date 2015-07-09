<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<!-- START 公用 head -->
		    <?php echo W('Common/commonHead');?>
		<!-- END 公用 head -->
		<!-- START 自定义 head -->
		<link rel="stylesheet" href="/beehive/Public/js/jQuery-File-Upload-master/css/jquery.fileupload.css">  
		<link rel="stylesheet" href="/beehive/Public/js/jQuery-File-Upload-master/css/jquery.fileupload-ui.css"> 
		<script type="text/javascript" src="/beehive/Public/js/jquery.bxslider.min.js"></script>
		<script src="/beehive/Public/js/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js"></script>  
		<script src="/beehive/Public/js/jQuery-File-Upload-master/js/jquery.fileupload.js"></script>  
		<script src="/beehive/Public/js/jQuery-File-Upload-master/js/jquery.iframe-transport.js"></script> 

		<script type="text/javascript">
			$(function(){
				

				
				
				
				var img_all = new Array();
				
				$('.upload-box input').fileupload({  
					autoUpload: true,
				    autoUpload: true,
				    acceptFileTypes:  /(\.|\/)(gif|jpe?g|png)$/i,
				    maxNumberOfFiles : 1,
				    
				    add: function (e, data) {
				        data.submit(); //this will 'force' the submit in IE < 10
				    },
				   
				    done:function(e,result){ 
				    	//完成后进行的操作	 
				    	var img_src = JSON.stringify(result.result);
				    	//alert(img_src);
				    	$('.upload-box').before('<div class="img-box">')
				    	     
				    	var new_div = $('.img-upload div.img-box').last(); 
				    	$(new_div).append('<img src='+img_src+'/>');
				    	$(new_div).append('<span><a href="javascript:;"></a></span>');
				    	img_all.push(img_src);
				    	
				    },
				    fail: function(e, data) {
			                  //错误提示
				    	  alert('Fail!');
				    }
				}); 

				$('.img-box span a').on('click','.img-upload',function(){
					
				});
				$(document).on('click','.img-box span a',function(){
					var img_box = $(this).parents('.img-box');
					var i = $(img_box).index();
					
					img_all.splice(i,1);
					$(img_box).remove();

					// alert(img_all);

				})


			})
		</script>
		<!-- END 自定义 head -->
	</head>
	<body class="user-page user-home-page">
		<div id="wrap">
			<!-- START header -->
		    <?php echo W('Common/allHeader');?>
		    <?php echo W('Common/userHeader');?>

			<!-- END header -->
			
			<div id="main">
				<div class="inner clearfix">
					<div class="f-left con">
						
						
					</div>
					<div class="f-right sider">
						

					</div>
				</div>
				</div>
		</div>
		<!-- START footer -->
		    <?php echo W('Common/commonFooter');?>
		<!-- END footer -->

		<script type="text/javascript">
			
		</script>

	</body>
</html>