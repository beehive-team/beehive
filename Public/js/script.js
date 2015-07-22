var r='';
var p='';
function del_ff(elem){

	var elem_child = elem.childNodes;

	for(var i=0; i<elem_child.length;i++){

		if(elem_child[i].nodeType == 3){

			elem_child[i].parentNode.removeChild(elem_child[i])

		}

	}		

}
function is_name(name){
	var pattern = /^\w{5,16}$/;
	var result = pattern.test(name);
	return result;
}

function pwd_test(pwd){
	//alert(1)
	var pattern = /^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,22}$/;
	var result = pattern.test(pwd);
	return result;
}

function is_repwd(pwd,repwd){
	//alert(1)
	if(pwd==repwd){
		result = true
	}else{
		result = false
	}
	return result;
}

function funcAjax(mod,to,asy,data=''){
	var xmlhttp;

	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
  			
  			r = xmlhttp.responseText;
  			//alert(r);

  			
  			
    	}
    	
  	}
	switch(mod){
		case 'post':

		xmlhttp.open("POST",to,asy);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(data);

		break;
		case 'get':

		xmlhttp.open("GET",to,asy);
		xmlhttp.send();

		break;
	}
	
	
}

function is_exists(name){
	funcAjax('post','index.php?c=user&a=nameAjax',false,'name='+name);
	//alert(r);
	if(!r==''){
		if(r=='true'){

			return true;
		}else{
			return false;
		}
	}
}
function is_pwd(name,pwd){
	funcAjax('post','index.php?c=user&a=pwdAjax',false,'name='+name+'&pwd='+pwd);
	//alert(r);
	if(!r==''){
		if(r=='true'){

			return true;
		}else{
			return false;
		}
	}
}