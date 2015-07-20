<?php
namespace Home\Controller;
class UserController extends CommonController {

    protected $faceName;
    protected $facePath;
    protected $userId;
    protected $time;

    public function _initialize(){
        
        
        $this->userId = $_SESSION['home']['user_id'];
        $this->time=time();
    }




    // 显示首页

    public function index(){


        $start= 0;
        if(!empty($_POST['limit'])){
            $start += $_POST['limit']/2;

        }
        $length = 1;

        $diary = M('diary');
        $time = $this->time;
        $yesterday=strtotime('yesterday');

        $diary_list = $diary->field('d.id,u.name,title,content,d.time,image,u_id')->table('bee_diary d,bee_user u')->where("d.time<$time AND d.time>$yesterday and d.u_id=u.id and browse<1")->order('hot desc')->group('d.id')->limit($start,$length)->select();
    	// echo $diary->getLastsql();
        // var_dump($diary_list);
        $album = M('album');

        $album_list = $album->field('a.id,u.name as u_name,a.name,des,u_id,a.time,hot,image')->table('bee_album a,bee_user u')->where("a.time<$time AND a.time>$yesterday and a.u_id=u.id and browse<1")->order('hot desc')->group('a.id')->limit($start,$length)->select();
        // var_dump($album_list);
        // echo $album->getLastsql();

        foreach($diary_list as $key=>$value){
            $diary_list[$key]['action'] = 'diary';
            $dtag = M('d_t');
            $d_id = $diary_list[$key]['id'];
            $tag_list = $dtag->field('name')->table('bee_d_t dt,bee_dtag t')->where("d_id=$d_id AND t.id=dt.t_id")->select();
            if(empty($tag_list)){
                $tag_list=null;
            }
            $diary_list[$key]['tag'] =$tag_list;

            $diary_list[$key]['content']=strip_tags($diary_list[$key]['content']);
            // var_dump($tag_list);
            
            if($this->ifLike($diary_list[$key]['id'],'diary',$this->userId,$diary_list[$key]['u_id'])){
                $diary_list[$key]['like']=1;
            }else{
                $diary_list[$key]['like']=0;

            }
        }
        // var_dump($diary_list);
        // var_dump($album_list);
        foreach($album_list as $key=>$value){
            $atag = M('a_t');
            $a_id =$album_list[$key]['id'];
            $tag_list = $atag->field('name')->table('bee_a_t at,bee_atag t')->where("a_id=$a_id AND t.id=at.t_id")->select();
            if(empty($tag_list)){
                $tag_list=null;
            }
            $album_list[$key]['tag']=$tag_list;
            
            $photo = M('photo');
            $p_list = $photo->where("a_id=$a_id")->order('is_cover desc')->select();
            $p_list = array_slice($p_list,0,4);
            // var_dump($p_list);
            $album_list[$key]['photo']=$p_list;
            // var_dump($tag_list);
            $album_list[$key]['action'] = 'album';
            if($this->ifLike($album_list[$key]['id'],'album',$this->userId,$album_list[$key]['u_id'])){
                $album_list[$key]['like']=1;
            }else{
                $album_list[$key]['like']=0;

            }








        }
        // var_dump($album_list);
        for($i=0;$i<count($album_list);$i++){
        
            array_push($diary_list,$album_list[$i]);
            
        }
        // var_dump($diary_list);
        $hot_list = $diary_list;    

        //冒泡排序
        for ($i=0; $i <count($hot_list) ; $i++) { 
            for($j=$i+1;$j<count($hot_list);$j++){
                if ($hot_list[$i]['hot'] < $hot_list[$j]['hot']) {
                    $temp = $hot_list[$i];
                    $hot_list[$i] = $hot_list[$j];
                    $hot_list[$j] = $temp;
                }
            }
        }
        // var_dump($hot_list);
        if(!empty($_POST['limit'])){
            if(!empty($hot_list)){
                $this->ajaxReturn($hot_list);
            }else{
                $this->ajaxReturn();

            }
            
        }
        // var_dump($hot_list);
        
        $this->assign('u_id',$this->userId);
        $this->assign('hot',$hot_list);
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

        $user = M('user');
        $userInfo = $user->where("id=$this->userId")->find();
        // echo $user->getLastsql();
        // var_dump($userInfo);

        $diaryView = D('DiaryView');
        

        $diary = $diaryView->field('diaryid,title,content,u_id,content,time,power,browse,hot')->where("u_id=$this->userId")->order('time desc')->group('diaryid')->limit($Page->firstRow.','.$Page->listRows)->select();
        // var_dump($diary);
        foreach ($diary as $key => $value) {
            $diary[$key]['content'] = strip_tags($diary[$key]['content']);    
            // echo $diary[$key]['content'];
        }        
        $diary = array_slice($diary,0,6);
        // var_dump($diary);
        $face = $model->field('image')->where("id=$this->userId")->find();
        // var_dump($face);


        //显示相册
        $album = D('AlbumView');
        $u_id = $this->userId;
        
        $result = $album->where("u_id=$u_id")->field('album_id,album_name,u_id,power,update_time,browse,tolist,hot')->order('update_time desc')->group('album_id')->select();
        
        foreach ($result as $key => $value) {
            $albumId = $result[$key]['album_id'];
            $photo = M('photo');
            $cover = $photo->where("is_cover=1 and a_id=$albumId")->select();
            // var_dump($cover);
            if(empty($cover)){
                $cover='';
            }else{
                $cover = $cover[0]['path'].'/'.$cover[0]['name'];
            }
            
            // echo $cover;
            $result[$key]['cover']=empty($cover)?'/images/photo_album.png':$cover;
            $result[$key]['count'] = $photo->where("a_id=$albumId")->count();
        }
        $result = array_slice($result,0,5);
        

        // var_dump($result);

        $like_list = $this->getLike(1,$this->userId);
        
        // var_dump($like_list);
        $arr = $this->getTrend(1,$this->userId);
        
        // var_dump($arr);
        // var_dump($like_list);
        $arr = array_slice($arr,0,6);
        // var_dump($arr);
        $intro = $data['introduce'];
        $this->assign('intro',$intro);
        $this->assign('trend',$arr);
        $this->assign('album',$result);

        $this->assign('face',$face);
        $this->assign('diary',$diary);
        $this->assign('userInfo',$userInfo);
        $this->assign('exits',$info);
        $this->assign('data',$data);
        $this->assign('like',$like_list);

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
                echo $file['savepath'].$file['savename'];    
            }
            
        }  
        
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

                $this->ajaxReturn($file['savepath'].'thumb_'.$file['savename'],'eval');    
            }
            
        }  
        
    }


    //更新头像

    public function updateFace(){
        // var_dump($_POST);

        
        $model = D('user');
        
        // var_dump($_SESSION);
        

        $face  = $_POST['name'];
        $face = trim($face,'"');
        $arr = explode('/',$face);
        $path = $arr['5'];
        $name = $arr['6'];
        // echo $face;
        
        // var_dump($_POST['name']);
        $open = 'Public/Uploads/User/'.$path.'/'.$name;
        // echo $open;
        $cut_save = 'Public/Uploads/User/'.$path.'/cut_'.$name;
        $small_save = 'Public/Uploads/User/'.$path.'/small_'.$name;
        $model->image = '/beehive/'.$cut_save;
        $image = new \Think\Image(); 
        $image->open($open);
        $image->thumb(405, 405,\Think\Image::IMAGE_THUMB_FILLED)->save($small_save);
        $image->open($small_save);
        $image->crop(400, 400,\Think\Image::IMAGE_THUMB_CENTER)->save($cut_save);
        
        if($model->where("id=$this->userId")->save($data)){
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


    // 处理说说
    public function dosay(){
        var_dump($_POST);
        $data = $_POST;
        unset($data['myfile']);
        $text['content'] = $data['text'];
        unset($data['text']);
        $say = M('say');
        $text['u_id']=$this->userId;
        $text['time'] = $this->time;
        if($insertId = $say->add($text)){
            if(!$data){
                foreach ($data as $key => $value) {
                    $image['s_id']=$insertId;
                    $image['name']=$data[$key];
                    $s_i = M('s_i');
                    $s_i->add($image);

                }
            }
            $this->trend('say',$this->time,$insertId);

            $this->success('发表成功');
        }


    }

    // 显示提示
    public function tip(){
        $i = 0;
        $j = 0;
        $model = M('tip');
        $result = $model->where("p_id=$this->userId and status=0")->order('time desc')->select();
        // var_dump($result);
        foreach ($result as $key => $value) {
            switch($result[$key]['action']){
                case 'album_replay':
                    $data['id'] = $result[$key]['do_id'];
                    $album = M('album');
                    $album_info = $album->where($data)->find();
                    $result[$key]['info'] = $album_info;
                    break;
                case 'diary_replay':
                    $data['id'] = $result[$key]['do_id'];
                    $diary = M('diary');
                    $diary_info = $diary->where($data)->find();
                    // echo $diary->getLastsql();
                    $result[$key]['info']=$diary_info;
                    break;
                case 'follow':
                    $i++;
                    $f_count = $i;
                    
                    break;
                case 'msg':
                    $j++;
                    $m_count = $j;
                    break;
            }
        }
        $info = $result;
        // var_dump($info);
        $this->assign('info',$info);
        $this->assign('p_id',$this->userId);
        $this->assign('count',$f_count);
        $this->assign('m_count',$m_count);
        
        
        $this->display();
    }



}
