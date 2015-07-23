<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
    protected $userId;
    protected $p_id;
    protected $relation;
    public function _initialize(){
        
        $this->userId = $_SESSION['home']['user_id'];

        $this->p_id = $_GET['p_id'];

        $notAllow_action = array(
            
        );
        $current = CONTROLLER_NAME.'/'.ACTION_NAME;

        if(in_array($current,$notAllow_action)){
            if(empty($_SESSION['home'])){
                $this->error('请登录',U('login'));
                exit;
            }
        }


    }
    //判断我和作者的关系
    public function relationship($u_id,$p_id){
        $data['u_id'] = $u_id;
        $data['p_id'] = $p_id;
        if($data['u_id']==$data['p_id']){
            $this->relation = 2;            //  是本人
            return;
        }
        $model = M('friend');
        if($model->where($data)->find()){   
            $this->relation = 1;    //是朋友
        }else{
            $this->relation = 0;    //所有人
        }
    }



    public function exits(){
        $date = $_POST;
        $model = M('User');
        $result = $model->where($date)->find();
        // echo $model->getLastSql();
        
        if(!empty($result)){
            echo  'true';
        }else{
            echo 'false';
        }
        // var_dump($date);

    }

    public function vcode(){
        
        $config = array(    
            'fontSize'    =>    30,    // 验证码字体大小    
            'length'      =>    4,     // 验证码位数
            'expire'      =>    1000,    // 验证码有效期    
        );
        $Verify = new \Think\Verify($config);

        $Verify->entry();
    }

    public function doVcode(){
        $data = $_POST;
        $data = $data['vcode'];
        
        $verify = new \Think\Verify();
        if($verify->check($data,'')){
            echo 'true';
        }else{
            echo 'false';
        }
    }
    public function register(){

        $this->display();
    }
    
    public function doreg(){
        //var_dump($_POST);
        $data = $_POST;
        
        array_pop($data);
        array_pop($data);
        
        $model=D('user');

        $data['ctime'] = time();
        //var_dump($data);
        $data['key'] = md5($data['key']);
        $data = $model->create($data);
        // var_dump($data);
        // exit;
        if(!$data){
            $this->error($model->getError());
            exit;
        }

        if($result = $model->add()){
            $_SESSION['home']['name']=$data['name'];
            $_SESSION['home']['user_id']= $result;

            $this->success('注册成功',U('Home/User/index'));
        }else{
            $this->error('注册失败');
        }
        


    }

    public function dologin(){
        $data = $_POST;
        $cokkie = $_POST['auto'];
        //var_dump($data);
        $info = $data['info'];
        if(preg_match("/^\d{11}$/", $info)){
            $method = 'mobile';
        }else{
            $method = 'youxiang';
        }
        $data['status']=0;
        $data['key']=md5($data['key']);
        $data[$method]=$info;
        $model = D('User');
        $data = $model->create($data);
        if($result = $model->where($data)->find()){
            //var_dump($result);
            if(!empty($cokkie)){
                setcookie('user_name',$result['name'],time()+604800);
                setcookie('user_id',$result['id'],time()+604800);
                setcookie('user_pwd',$result['password'],time()+604800);
            }
            $_SESSION['home']['name']=$result['name'];
            $_SESSION['home']['user_id']= $result['id'];
            
            $this->success('登录成功',U('Home/User/index'));
            //var_dump($_SESSION);
        }else{
            $this->error('登录失败');
        }

        
    }

     //显示喜欢
    public function getLike($num,$u_id){
        //显示喜欢
        $like = M('u_like');
        $like_result = $like->where("u_id=$u_id")->select();
        $like_list = array();
        $diary_k;
        $album_k;
        if($num==1){
            for($i=0;$i<count($like_result);$i++){
                $action = $like_result[$i]['action'];
                switch ($action) {
                    case 'diary':
                        if($diary_k==1){
                            break;
                        }
                        $diary_k=1;

                        $like_list[$i]['action'] = 'diary';
                        $diary_id = $like_result[$i]['like_id'];
                        $like_list[$i]['time']=$like_result[$i]['time'];
                        $diary = M('diary');
                        $like_list[$i]['id']=$diary_id;
                        $diary_title=$diary->field('title')->where("id=$diary_id")->find();
                        $like_list[$i]['name']=$diary_title['title'];
                        break;
                    
                    case 'album':
                        if($album_k==1){
                            break;
                        }
                        $album_k=1;

                        $like_list[$i]['action'] = 'album';
                        $album_id = $like_result[$i]['like_id'];
                        $like_list[$i]['time']=$like_result[$i]['time'];
                        $album= M('album');
                        $album_name=$album->field('name')->where("id=$album_id")->find();
                        
                        $like_list[$i]['name']=$album_name['name'];
                    break;
                }
            }
        }else{
            for($i=0;$i<count($like_result);$i++){
                $action = $like_result[$i]['action'];
                switch ($action) {
                    case 'diary':

                        $like_list[$i]['action'] = 'diary';
                        $diary_id = $like_result[$i]['like_id'];
                        $like_list[$i]['time']=$like_result[$i]['time'];
                        $diary = M('diary');
                        $like_list[$i]['id']=$diary_id;
                        $diary_title=$diary->field('title')->where("id=$diary_id")->find();
                        $like_list[$i]['name']=$diary_title['title'];
                        break;
                    
                    case 'album':

                        $like_list[$i]['action'] = 'album';
                        $album_id = $like_result[$i]['like_id'];
                        $like_list[$i]['time']=$like_result[$i]['time'];
                        $album= M('album');
                        $like_list[$i]['id']=$album_id;
                        $album_name=$album->field('name')->where("id=$album_id")->find();

                        $like_list[$i]['name']=$album_name['name'];
                    break;
                }
            }

        }
        return $like_list;
    }


    //是否喜欢
    public function ifLike($like_id,$action,$u_id,$p_id){   
        $like['like_id'] =$like_id;
        $like['u_id']=$u_id; 
        $like['p_id']=$p_id; 
        $like['action']=$action;
        $model = M('u_like');
        
        if($model->where($like)->find()){
            // echo $model->getLastsql();
            return true;
        }else{
            // echo $model->getLastsql();

            return false;
        }

    }

    // 处理喜欢表
    public function doLike(){
        // var_dump($_POST);

        $data['p_id']=$_POST['u_id'];
        $data['u_id']=$this->userId;
        $data['action']=$_POST['action'];
        $data['time']=$this->time;
        $data['like_id']=$_POST['action_id'];
        

        $hot = M($data['action']);
        $like_id = $data['like_id'];
        $hot_num = $hot->field('hot')->where("id=$like_id")->find();
        $hot_num = $hot_num['hot'];
        if(!empty($hot_num)){
            $hot_num++;
        }else{
            $hot_num=1;
        }
        $hot->where("id=$like_id")->setField('hot',$hot_num);
        // var_dump($data);
        // var_dump($hot_num);
        
        $model = M('u_like');
        if($model->add($data)){
            echo 'true';
        }

    }

    public function removeLike(){
        $data['p_id']=$_POST['u_id'];
        $data['u_id']=$this->userId;
        $data['action']=$_POST['action'];
        $data['like_id']=$_POST['action_id'];
        $model = M('u_like');

        $hot = M($data['action']);
        $like_id = $data['like_id'];
        $hot_num = $hot->field('hot')->where("id=$like_id")->find();
        $hot_num = $hot_num['hot'];
        if($hot_num!=0){
            $hot_num--;
        }else{
            $hot_num=0;
        }
        $hot->where("id=$like_id")->setField('hot',$hot_num);

        if($model->where($data)->delete()){
            echo 'true';
        }
    }

     //显示动态
    public function getTrend($num,$u_id){
        
       
        if($num==1){

            $trend = M('trend');
            $trend_result = $trend->where("u_id=$u_id")->order('time desc')->select();
            // var_dump($trend_result);
            // echo $trend->getLastsql();
            
            $photo_j;
            $album_j;
            $diary_j;
            $say_j;

            for($i=0;$i<count($trend_result);$i++){
                $action_id = $trend_result[$i]['do_id'];
                switch($trend_result[$i]['action']){
                    case 'photo':
                        if($photo_j==1){
                            break;
                        }
                        $photo_j=1;
                        $p = M('photo');
                        $trend_photo = $p->field('bee_photo.id,bee_album.name,bee_photo.time,bee_album.power,bee_album.browse')->table('bee_album ,bee_photo')->where("bee_photo.id=$action_id and bee_photo.a_id=bee_album.id")->order('time desc')->find();
                        $arr[$i]['action'] = 'photo'; 
                        $arr[$i]['time'] = $trend_photo['time']; 
                        $arr[$i]['name']= $trend_photo['name'];
                        $arr[$i]['browse']= $trend_photo['browse'];
                        $arr[$i]['power']= $trend_photo['power'];
                        $arr[$i]['id']= $trend_photo['id'];


                        break;
                    case 'album':
                        if($album_j==1){
                            break;
                        }
                        $album_j=1;
                        $p = M('album');
                        $trend_album = $p->field('id,name,time,browse,power')->where("id=$action_id")->order('time desc')->find();
                        $arr[$i]['action']='album';
                        $arr[$i]['name'] =$trend_album['name'];
                        $arr[$i]['time'] =$trend_album['time'];
                        $arr[$i]['browse'] =$trend_album['browse'];
                        $arr[$i]['power'] =$trend_album['power'];
                        $arr[$i]['id'] =$trend_album['id'];

                        break;
                    case 'diary':
                        if($diary_j==1){
                            break;
                        }
                        $diary_j=1;
                        $p = M('diary');
                        $trend_diary = $p->field('id,title,browse,power,time')->where("id=$action_id")->order('time desc')->find();
                        $arr[$i]['action']='diary';
                        $arr[$i]['name']=$trend_diary['title'];
                        $arr[$i]['time']=$trend_diary['time'];
                        $arr[$i]['browse']=$trend_diary['browse'];
                        $arr[$i]['power']=$trend_diary['power'];
                        $arr[$i]['id']=$trend_diary['id'];
                        break;
                    case 'say':
                        if($say_j==1){
                            break;
                        }
                        $say_j=1;
                        $p = M('say');
                        $trend_say = $p->field('id,content,time')->where("id=$action_id")->order('time desc')->find();
                        $arr[$i]['action']='say';
                        $arr[$i]['content']=$trend_say['content'];
                        $arr[$i]['time']=$trend_say['time'];
                        $arr[$i]['id']=$trend_say['id'];
                    break;
                }



            } 
        }else{

            //显示个人动态
            $trend = M('trend');
            $trend_result = $trend->where("u_id=$u_id")->order('time desc')->select();
            // var_dump($trend_result);
            
         
            for($i=0;$i<count($trend_result);$i++){
                $action_id = $trend_result[$i]['do_id'];
                switch($trend_result[$i]['action']){
                    case 'photo':
                       
                        $p = M('photo');
                        $trend_photo = $p->field('bee_photo.id,bee_album.name,bee_photo.time,bee_album.power,bee_album.browse')->table('bee_album ,bee_photo')->where("bee_photo.id=$action_id and bee_photo.a_id=bee_album.id")->order('time desc')->find();
                        $arr[$i]['action'] = 'photo'; 
                        $arr[$i]['time'] = $trend_photo['time']; 
                        $arr[$i]['name']= $trend_photo['name'];
                        $arr[$i]['browse']= $trend_photo['browse'];
                        $arr[$i]['power']= $trend_photo['power'];
                        $arr[$i]['id']= $trend_photo['id'];


                        break;
                    case 'album':
                        
                        $p = M('album');
                        $trend_album = $p->field('id,name,time,browse,power')->where("id=$action_id")->order('time desc')->find();
                        $arr[$i]['action']='album';
                        $arr[$i]['name'] =$trend_album['name'];
                        $arr[$i]['time'] =$trend_album['time'];
                        $arr[$i]['browse'] =$trend_album['browse'];
                        $arr[$i]['power'] =$trend_album['power'];
                        $arr[$i]['id'] =$trend_album['id'];

                        break;
                    case 'diary':
                        
                        $diary_j=1;
                        $p = M('diary');
                        $trend_diary = $p->field('id,title,browse,power,time')->where("id=$action_id")->order('time desc')->find();
                        $arr[$i]['action']='diary';
                        $arr[$i]['name']=$trend_diary['title'];
                        $arr[$i]['time']=$trend_diary['time'];
                        $arr[$i]['browse']=$trend_diary['browse'];
                        $arr[$i]['power']=$trend_diary['power'];
                        $arr[$i]['id']=$trend_diary['id'];
                        break;
                    case 'say':
                       
                        $say_j=1;
                        $p = M('say');
                        $trend_say = $p->field('id,content,time')->where("id=$action_id")->order('time desc')->find();
                        $arr[$i]['action']='say';
                        $arr[$i]['content']=$trend_say['content'];
                        $arr[$i]['time']=$trend_say['time'];
                        $arr[$i]['id']=$trend_say['id'];
                    break;
                }



            } 

        }

        // var_dump($arr);
        return $arr;
    }


    //判断签名是不是空的
    public function signNull(){
        if(empty($_POST)){
            $u_id = $this->userId;
        }else{
            $u_id = $_POST['u_id'];
        }
        $model = D('user');
        
        if($result = $model->where("id=$u_id")->getField('sign')){
            echo $result;
        }
        
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


    
    //判断是否关注
    public function ifFollow($p_id,$u_id){
        $data['u_id']=$p_id;
        $data['f_id']=$u_id;
        
        $model = M('follow');
        if($model->where($data)->find()){
            // echo $model->getLastsql();
            return true;
        }else{
            // echo $model->getLastsql();

            return false;
        }
    }

    //判断有没有新消息
    public function ifTip(){
        $u_id = $_POST['u_id'];
        $model = M('tip');
        $count = $model->where("p_id='$u_id' and status=0")->count();
        // echo $model->getLastsql();
        echo $count;
    }

    //添加提醒内容
    /*
    *   $p_id   提醒谁
    *   $u_id   谁做的
    *   $action  是什么内容的提醒
    *   $do_id   做的东西的id
    *   $time    时间
    */
    public function addTip($p_id,$u_id,$action,$do_id,$time){
        $data['p_id'] = $p_id;
        $data['u_id'] = $u_id;
        $data['action'] = $action;
        $data['do_id'] = $do_id;
        $data['time'] = $time;
        $m = M('tip');
        $m->add($data);
    }

}
