<?php
namespace Home\Controller;
class AlbumController extends CommonController {

    protected $faceName;
    protected $facePath;
    protected $userId;
    protected $time;
    protected $arr = array();
    protected $replay = array();

    public function _initialize(){
        
        $this->p_id = $_GET['p_id'];
        $this->userId = $_SESSION['home']['user_id'];
        $this->relationship($this->userId,$this->p_id);
        
        $this->time=time();
    }

   
    //显示相册
    public function album(){
        $album = D('AlbumView');
        $this->relation;
        switch ($this->relation) {
            case '2':  //是本人
                $where['u_id']=$this->userId;
                $status = 'me';
                $where['browse'] =array(ELT,'2');       
                break;
            
            case '1':   //朋友
                $where['u_id']=$this->p_id;
                $status['other'];
                $where['browse']=array(ELT,'1');
                break;

            case '0':   //陌生人

                $where['u_id'] = $this->p_id;
                $status = 'other';
                $where['browse'] = array(EQ,'0');
                break;
        }


        $u_id = $this->userId;
        $model = M('album');
        
       
        $count = $model->where($where)->count();
        // echo $count;
        $Page       = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $result = $album->where($where)->field('album_id,album_name,u_id,power,update_time,browse,tolist,hot')->order('update_time')->limit($Page->firstRow.','.$Page->listRows)->group('album_id')->select();
        

    


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
        $this->assign('p_id',$this->p_id);
        $this->assign('status',$status);
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

                    if($data['browse']==0){
                        $this->trend('album',$this->time,$a_id);
                    }    
                    

                    $this->success('相册添加成功',U("Album/photoList?id=$a_id"));


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
                    $this->success('照片发布成功',U("Album/PhotoList/id/$a_id"));
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
        $result =$album->field('album_name,des,power,u_id,a_time,hot,browse')->where("album.id=$a_id")->find();
        var_dump($result);
        $photo = M('photo');
        // var_dump($result);
        $p_n = $photo->where("a_id=$a_id")->count();

        $page = new \Think\Page($p_n,1);
        $show = $page->show();
        $p_d = $photo->where("a_id=$a_id")->order('time')->limit($page->firstRow.','.$page->listRows)->select();
        // var_dump($p_d);
        $tags = $album->field('atag_name,atag_id')->where("album.id=$a_id and a_t.a_id=album.id")->select();
        // var_dump($tags);
        if($this->ifLike($a_id,'album',$this->userId,$this->p_id)){
            $like=1;
        }else{
            $like=0;
        }

        // var_dump($p_d);

        switch ($result['browse']) {
            case '0':
                $result['browse']='仅朋友可见';
                break;
            case '1':
                $result['browse']='所有人可见';
                break;
            case '2':
                $result['browse']='仅自己可见';
                break;
            
        }
        switch ($result['power']) {
            case '1':
                $result['power'] = '不能回应';
                $power = 0;
                break;
            
            case '0' :
                $result['power'] = '<a href="">回应</a>';
                $power=1;
                break;
        }


        if($power==1){
            $model = M('a_replay');
            $replay=$model->field('u_id,r_id,a_id,image,name,r.time,content,r.id')->table('bee_user u,bee_a_replay r')->where("r.a_id=$a_id and u.id=r.u_id")->order('time')->select();
            // ECHO $model->getLastSql();
            // var_dump($replay);
            foreach ($replay as $key => $value) {

                if($replay[$key]['r_id']!=0){

                    // echo $replay[$key]['r_id'];
                    
                    $this->getReplayParent($replay[$key]['r_id']);
                    $replay_info = $this->replay;
                    // var_dump($replay_info);
                    foreach ($replay_info as $k => $v) {
                        // echo $value;
                       $m = M('d_replay');
                        $result=$model->field('u_id,r_id,a_id,image,name,r.time,content,r.id')->table('bee_user u,bee_a_replay r')->where("u.id=r.u_id and r.id=$v")->find();
                       
                       // var_dump($result);
                       $replay[$key]['parent'][] = $result ;
                    }
                    
                }
            }
            // var_dump($replay);

            $this->assign('replay',$replay);
        }




        $this->assign('like',$like);
        $this->assign('power',$power);
        $this->assign('tags',$tags);
        $this->assign('u_id',$this->userId);
        $this->assign('p_n',$p_n);
        $this->assign('photo',$p_d);
        $this->assign('data',$result);
        $this->assign('page',$show);
        $this->assign('a_id',$a_id);
        $this->display();
    }


    // 递归找到回应的父集
    public function getReplayParent($id){
        $model = M('a_replay');
        $r = $model->where("id=$id")->find();
        $r_id = $r['r_id'];
        $par_id = $r['id'];
        array_push($this->arr,$par_id);
       
        if($r_id==0){
            // echo $par_id
            $this->replay = $this->arr;
            // var_dump($this->arr);
            $this->arr = array();
            
        }else{
            
            $this->getReplayParent($r_id);

        }


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
                $hot = $model->where($arr)->getField('hot');
                $hot++;
                $model->where($arr)->setField('hot',$hot);
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
        $this->success('修改成功',U("Album/album?p_id=$this->userId"));


    }

    //添加回应
    public function addReplay(){
        // var_dump($_POST);
        $data = $_POST;
        $data['u_id']=$this->userId;
        $data['time'] = $this->time;
        // var_dump($data);
        // exit;
        $model = M('a_replay');
        if($model->add($data)){
            $this->success('回复成功');
        }

    }


    


}
