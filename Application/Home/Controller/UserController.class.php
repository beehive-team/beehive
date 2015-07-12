<?php
namespace Home\Controller;
class UserController extends CommonController {

    protected $faceName;
    protected $facePath;
    protected $userId;

    public function __construct(){

        parent::__construct();
        $this->userId = $_SESSION['home']['user_id'];
    }


    // 显示首页

    public function index(){
    	$this->display();
    }

    // 上传图片

    public function imgUpload(){

        $upload = new \Think\Upload();// 实例化上传类  
        $upload->maxSize   =     3145728 ;// 设置附件上传大小  
        //$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
 		$upload->rootPath   =     './Public';
        $upload->savePath  =      '/Uploads/say/'; // 设置附件上传（子）目录  
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

    // 显示用户首页
    public function myHome(){

        $model = D('user');
        $data = $model->where("id=$this->userId")->find();
        if($data['image']&&$data['introduce']){
            $info = 'exits';
        }
        $this->assign('exits',$info);
        $this->assign('data',$data);


        $this->display();
    }

    // 头像上传
    public function faceUpload(){

        $upload = new \Think\Upload();// 实例化上传类  
        $upload->maxSize   =     3145728 ;// 设置附件上传大小  
        //$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
        $upload->rootPath   =     './Public/';
        $upload->savePath  =      '/Uploads/User/'; // 设置附件上传（子）目录  
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
                $this->faceName = $file['savename'];
                $this->facePath = $file['savepath'];
                echo '/beehive/Public'.$file['savepath'].$file['savename'];    
            }
            
        }  
        
    }
    
    //显示日记首页
    public function diary(){
        $model = D('DiaryView');

        
        $data = $model->field('diaryid,title,content,u_id,content,time,power,browse,hot')->where("u_id=$this->userId")->group('diary.id')->select();
        
        // var_dump($data);
        foreach($data as $key=>$value){
            $tag = array();
            $data[$key]['content'] = strip_tags($data[$key]['content']);
            $did = $data[$key]['diaryid'];
            $tag[] = $model->field('name')->where("d_id=$did")->select();
            $data[$key]['tag'] = $tag;
            $data[$key]['tag'] = $data[$key]['tag'][0];
        }
    
        
        var_dump($data);
        $this->assign('data',$data);
        // var_dump($data);
        $this->display();

    }

    //显示写日记
    public function writeDiary(){

        $this->display();

    }

    //执行写日记提交后的东西
    public function doDiary(){
        $arr = array();
        //var_dump($_POST);
        $data =$_POST;
        $tags = $data['tags'];
        unset($data['tags']);
        
        
        $data['ctime'] = time();
        // var_dump($data);
        
        $tags = explode(' ',$tags);
       // var_dump($tags);
        $model = M('dtag');
        $id_arr = array();
        for($i = 0;$i<count($tags);$i++){
            
            $arr['name'] = $tags[$i];
            if(!$id = $model->where($arr)->getField('id')){
                $insert_id = $model->add($arr);
                // echo $insert_id;
                array_push($id_arr,$insert_id);
            }else{
                array_push($id_arr,$id);
            }
        }

        $diary = D('diary');
        $data = $diary->create($data);
        var_dump($data);
        var_dump($id_arr);
        $data['u_id'] = $this->userId;
        if($d_id = $diary->add($data)){
                
            $dtarr = array();
            $model= M('d_t');
            for($i=0;$i<count($id_arr);$i++){
                
                $dtarr['d_id'] = $d_id;
                $dtarr['t_id'] = $id_arr[$i];
                $model->add($dtarr);
            }
            $this->success('日记发表成功',U('Home/User/diary'));

        }else{
            $this->error('日记发表失败,请重试');
        }        

    }


    //显示相册
    public function album(){
        $this->display();
    }

    //发布照片或者创建相册页
    public function publishPhoto(){
        $this->display();
    }


    // 照片上传
    public function photoUpload(){

        $upload = new \Think\Upload();// 实例化上传类  
        $upload->maxSize   =     3145728 ;// 设置附件上传大小  
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
        $upload->rootPath   =     './Public';
        $upload->savePath  =      '/Uploads/photo/'; // 设置附件上传（子）目录  
        //var_dump($_FILES);
        // 上传文件   
        $info   =   $upload->upload();



        //var_dump($info);  
        if(!$info) {// 上传错误提示错误信息  
            // $this->error($upload->getError());  
            
            echo 0;
            exit;
        }else{// 上传成功 获取上传文件信息  
            //$this->display('templateList');  
            foreach($info as $file){

                //生成缩略图

                $image = new \Think\Image();

                $image->open('Public'.$file['savepath'].$file['savename']);

                $image->thumb(170, 170)->save('Public'.$file['savepath'].'thumb_'.$file['savename']);

                echo '/beehive/Public'.$file['savepath'].'thumb_'.$file['savename'];    
            }
            
        }  
        
    }


    //更新头像

    public function updateFace(){
        // var_dump($_POST);

        
        $model = D('user');
        
        // var_dump($_SESSION);
        
        $model->image = $_POST['name'];
        if($model->where("id=$this->userId")->save()){
            echo 'true';
        }else{
            echo 'false';
        }
        

    }


    //更新自我介绍
    public function updateIntro(){
        $model = D('user');
        
        $data['intro'] = $_POST['intro'];
        $data = $model->create($data);
        
        if($model->where("id=$this->userId")->save($data)){
            echo 'true';
        }else{
            
            echo 'false';
        }
    }



    //更新签名
    public function updateSign(){
        $model = D('user');
        $data['brief'] = $_POST['brief'];
        $data = $model->create($data);
        if($model->where("id=$this->userId")->save($data)){
            echo $_POST['brief'];
        }else{
            
            echo 'false';
        }
    }

    //判断签名是不是空的
    public function signNull(){
        $model = D('user');

        if($result = $model->where("id=$this->userId")->getField('sign')){
            echo $result;
        }
        
    }


}
