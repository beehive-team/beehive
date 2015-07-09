<?php
namespace Home\Controller;
class UserController extends CommonController {
    public function index(){
    	$this->display();
    }
    public function imgUpload(){

        $upload = new \Think\Upload();// 实例化上传类  
        $upload->maxSize   =     3145728 ;// 设置附件上传大小  
        //$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
 		$upload->rootPath   =     './Public';
        $upload->savePath  =      './Uploads/'; // 设置附件上传（子）目录  
        //var_dump($_FILES);
        // 上传文件   
        $info   =   $upload->upload();
        //var_dump($info);  
        if(!$info) {// 上传错误提示错误信息  
            // $this->error($upload->getError());  
            echo 0;  
        }else{// 上传成功 获取上传文件信息  
            //$this->display('templateList');  
            foreach($info as $file){
            	echo '/beehive/Public'.$file['savepath'].$file['savename'];    
            }
            
        }  
        
    }
}
