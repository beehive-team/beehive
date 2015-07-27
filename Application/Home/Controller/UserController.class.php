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

        $friend = M('friend');

        $friend_sql = $friend->field('f_id')->where("u_id=$this->userId")->buildSql();


        $diary_list = $diary->field('d.id,u.name,title,content,d.time,image,u_id')->table('bee_diary d,bee_user u')->where("d.u_id=u.id and browse<1 and u.id in $friend_sql")->order('hot desc')->group('d.id')->limit($start,$length)->select();
    	// echo $diary->getLastsql();
        // var_dump($diary_list);
        $album = M('album');

        $album_list = $album->field('a.id,u.name as u_name,a.name,des,u_id,a.time,image')->table('bee_album a,bee_user u')->where("a.u_id=u.id and browse<1 and u.id in $friend_sql")->order('hot desc')->group('a.id')->limit($start,$length)->select();
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
            	echo $file['savepath'].$file['savename'];    
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
        // echo $this->userId;
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

        //显示我被几个人关注
        $follow = M('follow');
        $follow_result = $follow->where("u_id=$this->userId")->count();
        // echo $follow_result;
        $this->assign('f_count',$follow_result);

        $follow = M('follow');
        $who_result = $follow->where("f_id=$this->userId")->count();
        $who_result;
        $this->assign('w_count',$who_result);


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
        $model->image = '/Uploads/User/'.$path.'/cut_'.$name;
        $image = new \Think\Image(); 
        $image->open($open);
        $image->thumb(110, 110,\Think\Image::IMAGE_THUMB_FILLED)->save($small_save);
        $image->open($small_save);
        $image->crop(100, 100,\Think\Image::IMAGE_THUMB_CENTER)->save($cut_save);
        
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
            // var_dump($data);
            
            if(!empty($data)){
                
                foreach ($data as $key => $value) {
                    $image['s_id']=$insertId;
                    $image['name']=$data[$key];
                    // var_dump($image);
                    // exit;
                    $s_i = M('s_i');
                    $s_i->add($image);

                }
            }
            // exit;
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
                    // echo $album->getLastsql();
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
        $this->assign('userId',$this->userId);
        
        $this->display();
    }

    public function myFollow(){
        $follow = M('follow');
        $follow_result = $follow->table('bee_follow f,bee_user u')->where("u_id=$this->userId and u.id=f_id")->select();
        // var_dump($follow_result);
        
        //设置提示里的status 
        $tip = M('tip');
        $data['action']='follow';
        $data['p_id']=$this->userId;
        $tip->where($data)->setField('status',1);
        $this->assign('follow_result',$follow_result);
        

        $this->display();   
    }

    public function followWho(){
        $follow = M('follow');
        $follow_result = $follow->table('bee_follow f,bee_user u')->where("f_id=$this->userId and u.id=u_id")->select();
        // var_dump($follow_result);
        $this->assign('follow_result',$follow_result);
        $this->display();
    }

    public function myLike(){
        $like_list = $this->getLike('all',$this->userId);
        // var_dump($like_list);
        foreach ($like_list as $key => $value) {
            $id = $like_list[$key]['id'];
            switch ($like_list[$key]['action']) {
                case 'album':
                    $album = M('album');
                    $album_result = $album->field('a.id,u.id as u_id,u.name,a.time,a.name as a_name,image')->table("bee_user u,bee_album a")->where("a.id=$id and a.u_id=u.id")->find();
                    $photo = M('photo');

                    $album_result['photo']=$photo->where("a_id=$id")->select();
                    $like_list[$key]['info']=$album_result;
                    break;
                
                case 'diary':
                    $diary = M('diary');
                    $diary_result =$diary->field('u.name as u_name,title,image,d.time,content,u.id as u_id,d.id')->table("bee_user u,bee_diary d")->where("u.id=d.u_id and d.id=$id")->find();
                    $like_list[$key]['info'] = $diary_result;
                    break;
                case 'movie':
                    $movie = M('movie');
                    $movie_result=$movie->where("id=$id")->find();
                    $photo = M('mimage');
                    $movie_result['photo'] = $photo->where("id=$id")->select();
                    $like_list[$key]['info']=$movie_result;
                    // var_dump($movie_result);
                    break;
                case 'book':

                    break;
            }
        }
        // var_dump($like_list);
        $this->assign('like_list',$like_list);
        $this->display();

    }


     // 显示浏览发现

    public function find(){


        $start= 0;
        if(!empty($_POST['limit'])){
            $start += $_POST['limit']/2;

        }
        $length = 1;

        $diary = M('diary');
        $time = $this->time;
        $yesterday=strtotime('yesterday');

        $diary_list = $diary->field('d.id,u.name,title,content,d.time,image,u_id')->table('bee_diary d,bee_user u')->where("d.u_id=u.id and browse<1")->order('hot desc')->group('d.id')->limit($start,$length)->select();
        // echo $diary->getLastsql();
        // var_dump($diary_list);
        $album = M('album');

        $album_list = $album->field('a.id,u.name as u_name,a.name,des,u_id,a.time,hot,image')->table('bee_album a,bee_user u')->where("a.u_id=u.id and browse<1")->order('hot desc')->group('a.id')->limit($start,$length)->select();
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
        $diary_info = array_slice($diary_list,0,3);
        // var_dump($diary_info);
        $this->assign('diary_info',$diary_info);
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
        // var_dump($diary_list);
        
        $this->assign('u_id',$this->userId);
        $this->assign('hot',$hot_list);
        $this->display();
    }

    public function account(){
        $user = M('user');
        $user_result = $user->field('id,name,phone,email,sex,image,introduce')->where("id=$this->userId")->find();
        // var_dump($user_result); 
        $this->assign('user_info',$user_result);

        $this->display();
    }

    public function userModify(){
        // var_dump($_POST);
        $data=$_POST;
        $user = M('user');
        if($user->where("id=$this->userId")->save($data)){
            $this->success('修改成功');

        }else{
            $this->error('修改失败');

        }

    }
    public function key(){

       
        $this->display();
    }
    public function modifyKey(){
        var_dump($_POST);
        $data['password']= md5($_POST['old']);
        $data['id']=$this->userId;
        $user = M('user');
        $result = $user->where($data)->find();
        if(!$result){
            $this->error('输入的密码错误');
        }elseif($_POST['new']!=$_POST['renew']){
            $this->error('两次密码输入不一致');
        }else{
            $user->where($data)->setField('password',md5($_POST['new']));
            $this->success('修改成功');

        }
    }

     public function broadcast(){
        $like_list = $this->getTrend('all',$this->userId);

        foreach ($like_list as $key => $value) {
            $id = $like_list[$key]['id'];
            switch ($like_list[$key]['action']) {
                case 'album':
                    $album = M('album');
                    $album_result = $album->field('a.id,u.id as u_id,u.name,a.time,a.name as a_name,image')->table("bee_user u,bee_album a")->where("a.id=$id and a.u_id=u.id")->find();
                    $photo = M('photo');

                    $album_result['photo']=$photo->where("a_id=$id")->select();
                    $like_list[$key]['info']=$album_result;

                    break;
                
                case 'diary':
                    $diary = M('diary');
                    $diary_result =$diary->field('u.name as u_name,title,image,d.time,content,u.id as u_id,d.id')->table("bee_user u,bee_diary d")->where("u.id=d.u_id and d.id=$id")->find();
                    $like_list[$key]['info'] = $diary_result;

                    break;
                case 'say':
                    $say = M('say');
                    $say_result = $say->field('s.id,u.id as u_id,u.name,s.time,image')->table("bee_user u,bee_say s")->where("u.id=s.u_id and s.id=$id")->find();
                    // var_dump($say_result);

                    $image = M('s_i');

                    $say_result['photo']=$image->where("s_id=$id")->select();
                    // var_dump($say_result);
                    $like_list[$key]['info']=$say_result;
                    // var_dump($like_list);

                    break;
               
            }
        }
        // var_dump($like_list);
        $this->assign('like_list',$like_list);
        $this->display();

    }

}
