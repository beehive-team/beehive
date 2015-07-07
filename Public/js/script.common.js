
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
