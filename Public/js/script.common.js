
function is_key(str){
	reg = /((?=.*\d)(?=.*\D)|(?=.*[a-zA-Z])(?=.*[^a-zA-Z]))^.{8,16}$/;
	if(!reg.test(str)){
		return false;
	}else{
		return true;
	}
}


function is_email(str){
	reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!reg.test(str)){
		return false;
	}else{
		return true;
	}
}

function is_nickname(str){
	$.post("exits",{name:str},function(data){
		if(data=='true'){
			return true; 
		}
		else{
			return false;
		}
	});
}

function is_phone(str){
	
	reg = /^1[3|4|5|8][0-9]\d{4,8}$/;
	if(!reg.test(str)){
		return false;
	}else{
		return true;
	}
}

function is_vcode(str){
	$.post("doVcode",{vcode:str},function(data){

		if(data=='true'){
			return true;
		}else{
			return false;
		}
	});
}

$(function(){
	$('a.like').click(function(){
		var that = $(this);
		var rel = $(this).attr('rel');
		rel = rel.split('_');
		var PATH = "/beehive/index.php/Home/User";
		var action = rel[0];
		var id = rel[1];
		var u_id = rel[2];		
		if($(this).hasClass('active')){
			$.post(PATH+'/removeLike',{action:action,action_id:id,u_id:u_id},function(data){
				if(data){
					$(that).removeClass('active');
				}
			})
			

		}else{
			
			// alert(action);
			$.post(PATH+'/doLike',{action:action,action_id:id,u_id:u_id},function(data){
					
				if(data){
					$(that).addClass('active');
				}
			})
		}
	})
})
