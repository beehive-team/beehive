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

    //  个人动态保存
    public function trend($action,$time,$do_id){
        $model = M('trend');
        $data['action']=$action;
        $data['time']=$time;
        $data['u_id']=$this->userId;
        $data['do_id']=$do_id;
        $model->add($data);

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
        $user = M('user');
        $userInfo = $user->where("id=$this->userId")->find();
        // echo $user->getLastsql();
        var_dump($userInfo);

        $diaryView = D('DiaryView');
        

        $diary = $diaryView->field('diaryid,title,content,u_id,content,time,power,browse,hot')->where("u_id=$this->userId")->order('time')->group('diaryid')->limit($Page->firstRow.','.$Page->listRows)->select();

        var_dump($diary);
        array_splice($diary,0,3);
        $face = $model->field('image')->where("id=$this->userId")->find();
        var_dump($face);
        $this->assign('face',$face);
        $this->assign('diary',$diary);
        $this->assign('userInfo',$userInfo);
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
                echo $file['savepath'].$file['savename'];    
            }
            
        }  
        
    }
    
    //显示日记首页
    public function diary(){

        $model = D('DiaryView');
        
        $count =$model->field('diaryid,title,content,u_id,content,time,power,browse,hot')->where("u_id=$this->userId")->group('diaryid')->count();
        
        $Page = new \Think\Page($count,3);
        $show = $Page->show();

        $data = $model->field('diaryid,title,content,u_id,content,time,power,browse,hot')->where("u_id=$this->userId")->group('diaryid')->limit($Page->firstRow.','.$Page->listRows)->select();

        
        foreach($data as $key=>$value){
            $tag = array();
            $data[$key]['content'] = strip_tags($data[$key]['content']);
            $did = $data[$key]['diaryid'];
            $tag[] = $model->field('name')->where("d_id=$did")->select();
            $data[$key]['tag'] = $tag;
            $data[$key]['tag'] = $data[$key]['tag'][0];

            switch ($data[$key]['browse']) {
                case '0':
                    $data[$key]['browse']='仅朋友可见';
                    break;
                case '1':
                    $data[$key]['browse']='所有人可见';
                    break;
                case '2':
                    $data[$key]['browse']='仅自己可见';
                    break;
                
            }
            switch ($data[$key]['power']) {
                case '1':
                    $data[$key]['power'] = '不能回应';
                    break;
                
                case '0' :
                    $data[$key]['power'] = '<a href="">回应</a>';
                    break;
            }

        }
    
       
        // var_dump($data);

        $this->assign('page',$show);
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
        if(empty($data['power'])){
            $data['power']='0';
        }
        if(empty($data['tolist'])){
            $data['tolist']='0';
        }
        
        $tags = $data['tags'];
        unset($data['tags']);
        
        
        $data['ctime'] = $this->time;
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
        //var_dump($data);
        // var_dump($id_arr);
        $data['u_id'] = $this->userId;
        if($d_id = $diary->add($data)){
                
            $dtarr = array();
            $model= M('d_t');
            for($i=0;$i<count($id_arr);$i++){
                
                $dtarr['d_id'] = $d_id;
                $dtarr['t_id'] = $id_arr[$i];
                $model->add($dtarr);
            }

            $this->trend('diary',$this->time,$d_id);
            $this->success('日记发表成功',U('Home/User/diary'));


        }else{
            $this->error('日记发表失败,请重试');
        }        

    }


    //显示相册
    public function album(){
        $album = D('AlbumView');
        $u_id = $this->userId;
        $count = $album->where("u_id=$u_id")->field('album_id,album_name,u_id,power,update_time,browse,tolist,hot')->group('album_id')->count();
        $Page       = new \Think\Page($count,6);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $result = $album->where("u_id=$u_id")->field('album_id,album_name,u_id,power,update_time,browse,tolist,hot')->order('update_time')->limit($Page->firstRow.','.$Page->listRows)->group('album_id')->select();
        
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
        // var_dump($result);

        $this->assign('data',$result);
        $this->assign('page',$show);
        $this->display();
    }

    //发布照片或者创建相册页
    public function publishPhoto(){
        $album = M('album');
        $result = $album->where("u_id=$this->userId")->select();
        // var_dump($result);
        var_dump($result);
        $this->assign('data',$result);
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
        $save = 'Public/Uploads/User/'.$path.'/cut_'.$name;
        $model->image = '/beehive/'.$save;
        $image = new \Think\Image(); 
        $image->open($open);
        $image->crop(400, 400)->save($save);
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

    //返回当前日记的标签
    public function getTag(){
        $diaryid = $_POST['diaryId'];
        $model = D('DiaryView');
        $result =$model->field('name,tagId')->where("diary.id=$diaryid")->select();

        $this->ajaxReturn($result);
    }


    // 修改当前日记的标签
    public function modifyTag(){
        $arr = array();
        $data = $_POST;
        $d_id = $_POST['diaryId'];
        // var_dump($data);
        $tags = $data['tags'];
        $tags = explode(' ',$tags);
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
        // var_dump($id_arr);

        $dtarr = array();
        $model= M('d_t');
        $model->where("d_id=$d_id")->delete();
        for($i=0;$i<count($id_arr);$i++){
            $dtarr['d_id'] = $d_id;
            $dtarr['t_id'] = $id_arr[$i];
            $model->add($dtarr);
        }
    }

    // 修改日记页面显示
    public function modifyDiary(){
        $diaryId = $_GET['id'];
        $model = M('diary');
        $result = $model->where("id=$diaryId")->find();
        // var_dump($result);
        $this->assign('data',$result);
        $this->display();
    }

    //更新日记
    public function updateDiary(){
        // var_dump($_POST);

        $data = $_POST;
        // if(empty($data['power'])){
        //     $data['power']='0';
        // }
        $id = $data['id'];
        $model = D('diary');
        $data = $model->create($data);
        // var_dump($data);
        
        if($model->where("id=$id")->save()){
            $this->success('修改成功',U('Home/User/diary'));
        }else{
            $this->error('保存失败');
        }
        
    }

    //删除日记
    public function deleteDiary(){
        $data = $_POST;
        $id = $_GET['id'];
        $model = D('diary');
        if($model->where("id=$id")->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');

        }
    }

    //创建新相册 
    public function newAlbum(){
        $data = $_POST;
        // var_dump($data);
        $action = array_search('保存', $data);
        switch($action){
            case 'new':
                $data['ctime']=$this->time;
                
                $tags = $data['tag'];
                unset($data['tag']);
                
                
                $data['ctime'] = $this->time;
                // var_dump($data);
                
                $tags = explode(' ',$tags);
               // var_dump($tags);
                $model = M('atag');
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
                // var_dump($data);
                $album = D('album');
                $image = $data;
                $data = $album->create($data);
                // var_dump($data);
                
            
                unset($image['myfile']);
                unset($image['title']);
                unset($image['authority']);
                unset($image['bee']);
                unset($image['ctime']);
                unset($image['album']);
                unset($image['content']);
                $image['time'] = $this->time;
                
                // var_dump($id_arr);
                $data['u_id'] = $this->userId;
                if($a_id = $album->add($data)){
                        
                    $dtarr = array();
                    $model= M('a_t');
                    for($i=0;$i<count($id_arr);$i++){
                        
                        $dtarr['a_id'] = $a_id;
                        $dtarr['t_id'] = $id_arr[$i];
                        $model->add($dtarr);
                    }

                    $image['a_id'] = $a_id;
                    var_dump($image);
                    $arr = array();
                    $j=0;
                    foreach ($image as $key => $value) {
                        $arr[$j] = explode('_',$key);
                        $arr[$j][] = $value;
                        $j++;
                    }
                    // var_dump($arr);
                    $this->insertPhoto($arr,$a_id);

                    
                    $this->trend('album',$this->time,$a_id);

                    $this->success('相册添加成功',U("Home/User/photoList?id=$a_id"));


                }else{
                    $this->error('相册添加失败,请重试');
                }        
                break;
            case 'old':
            

            $data = $_POST;
            unset($data['myfile']);
            unset($data['old']);
            unset($data['title']);
            unset($data['tag']);
            unset($data['content']);
            // var_dump($data);
            $arr = array();
            $j=0;
            foreach ($data as $key => $value) {
                $arr[$j] = explode('_',$key);
                $arr[$j][] = $value;
                $j++;
            }
            // var_dump($arr);
            $photo = M('photo');
            $a_id = $data['album'];
            $c['is_cover'] = 0;
            $photo->where("a_id=$a_id")->save($c);
            $album = M('album');
            $update['update_time']=$this->time;
            $album->where("id=$a_id")->save($update);
            $this->insertPhoto($arr,$data['album']);

            

            break;
        }
        
        

    }

    //处理照片数据
    public function insertPhoto($arr,$a_id){
        // var_dump($arr);
        foreach($arr as $key=>$value){
            if($value['1']=='imgName'){
                $imgId = $value['0']; 
                $imgName= $value['2'];
                $imgName = explode('_',$imgName);
                $imgName[0]=rtrim($imgName[0],'/thumb');
                // var_dump($imgName);
                $photo = M('photo');
                $p['path']=$imgName['0'];
                $p['name']=$imgName['1'];
                $p['a_id']=$a_id;
                $p['time']=$this->time;
                
                for($i=0;$i<count($arr);$i++){
                    if($arr[$i]['1']=='desc'&&$arr[$i]['0']==$imgId){
                        $p['descr'] = $arr[$i]['2'];
                    }

                    if($arr[$i]['0']=='cover'&&$arr[$i]['1']==$imgId){
                        $p['is_cover']='1';
                    }
                    
                    $photo = M('photo');
                    // var_dump($p);
                }
                if($insert_id = $photo->add($p)){
                    $this->trend('photo',$this->time,$insert_id);
                    $this->success('照片发布成功',U("Home/User/PhotoList/id/$a_id"));
                }else{
                    $this->error('照片发布失败');

                }


            }
        }
       

    }
    //显示相应相册的照片列表
    public function photoList(){
        $a_id = $_GET['id'];
        $album = D('AlbumView');
        $result =$album->field('album_name,des,power,u_id,a_time,hot,browse')->where("album.id=$a_id")->select();
        // var_dump($result);
        $photo = M('photo');
        // var_dump($result);
        $p_n = $photo->where("a_id=$a_id")->count();

        $page = new \Think\Page($p_n,6);
        $show = $page->show();
        $p_d = $photo->where("a_id=$a_id")->order('time')->limit($page->firstRow.','.$page->listRows)->select();
        // var_dump($p_d);
        $tags = $album->field('atag_name,atag_id')->where("album.id=$a_id and a_t.a_id=album.id")->select();
        // var_dump($tags);
        $this->assign('tags',$tags);
        $this->assign('p_n',$p_n);
        $this->assign('photo',$p_d);
        $this->assign('data',$result);
        $this->assign('page',$show);
        $this->assign('a_id',$a_id);
        $this->display();
    }

    //添加照片
    public function addPhoto(){
        $a_id = $_GET['id'];
        $this->assign('a_id',$a_id);
        $this->display();

    }
    
    //删除相册

    public function delAlbum(){
        $a_id = $_GET['id'];

        $album = M('album');
        if($album->where("id=$a_id")->delete()){
            $this->success('相册删除成功');
        }else{
            $this->error('照片删除失败');
        }
    }

    //修改相册属性

    public function modifyAlbum(){
        $id = $_GET['id'];
        $album = M('album');
        $result = $album->where("id=$id")->find();
        // var_dump($result);
        $model = D('albumView');
        $tag = $model->field('atag_id,atag_name')->where("album.id=$id and album.id=a_t.a_id")->select();
        // var_dump($tag);
        $str = '';
        foreach ($tag as $key => $value) {
            $str .= $value['atag_name'];
            $str .=' ';
        }
        // echo $str;
        $this->assign('tag',$str);

        $this->assign('data',$result);
        $this->display();
    }

    public function doModifyAlbum(){
        // var_dump($_POST);
        $arr = array();
        $data = $_POST;
        $albumid = $_POST['id'];
        // var_dump($data);
        $tags = $data['tag'];
        $tags = explode(' ',$tags);
        $model = M('atag');
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
        // var_dump($id_arr);

        $dtarr = array();
        $model= M('a_t');
        $model->where("a_id=$albumid")->delete();

        for($i=0;$i<count($id_arr);$i++){
            $dtarr['a_id'] = $albumid;
            $dtarr['t_id'] = $id_arr[$i];
            if(!$model->add($dtarr)){
                $this->error('修改失败');
                exit;
            }
        }
        $this->success('修改成功',U('User/album'));


    }


}
