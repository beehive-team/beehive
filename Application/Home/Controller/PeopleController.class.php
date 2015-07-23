<?php
namespace Home\Controller;
class PeopleController extends CommonController {

    protected $faceName;
    protected $facePath;
    protected $userId;
    protected $time;

    public function _initialize(){
        
        
        $this->userId = $_SESSION['home']['user_id'];
        $this->time=time();
        $this->p_id = $_GET['p_id'];

        if($this->p_id==$this->userId){
            $this->redirect('user/myHome');
        }
        $this->relationship($this->userId,$this->p_id);
        // echo $this->relation;
    }

    
    // 显示他人的页面
    public function index(){
        

        switch ($this->relation) {
            case '2':  //是本人
                $where['u_id']=$this->userId;
                $status = 'me';
                $where['browse'] =array(ELT,'2');       
                break;
            
            case '1':
                $where['u_id']=$this->p_id;
                $status['other'];
                $where['browse']=array(ELT,'1');
                break;

            case '0':

                $where['u_id'] = $this->p_id;
                $status = 'other';
                $where['browse'] = array(EQ,'0');
                break;
        }



        $model = D('user');
        $data = $model->where("id=$this->p_id")->find();
        if($data['image']&&$data['introduce']){
            $info = 'exits';
        }
        // var_dump($data);
        $user = M('user');
        $userInfo = $user->where("id=$this->p_id")->find();
        // echo $user->getLastsql();
        // var_dump($userInfo);

        $diaryView = D('DiaryView');
        

        $diary = $diaryView->field('diaryid,title,content,u_id,content,time,power,browse,hot')->where($where)->order('time desc')->group('diaryid')->limit($Page->firstRow.','.$Page->listRows)->select();
        // var_dump($diary);
        foreach ($diary as $key => $value) {
            $diary[$key]['content'] = strip_tags($diary[$key]['content']);    
            // echo $diary[$key]['content'];
        }        
        $diary = array_slice($diary,0,6);
        // var_dump($diary);
        $face = $model->field('image')->where("id=$this->p_id")->find();
        // var_dump($face);


        //显示相册
        $album = D('AlbumView');
        $u_id = $this->userId;
        
        $result = $album->where("u_id=$this->p_id")->field('album_id,album_name,u_id,power,update_time,browse,tolist,hot')->where($where)->order('update_time desc')->group('album_id')->select();
        // var_dump($result);
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

        $like_list = $this->getLike(1,$this->p_id);
        
        // var_dump($like_list);
        $arr = $this->getTrend(1,$this->p_id);
        
        
        // var_dump($like_list);


        //判断我有没有关注这个人

        if($this->ifFollow($this->p_id,$this->userId)){
            $is_follow= '1';
        }else{
            $is_follow = '0';
        }
        // echo $follow;


        $follow_model = M('follow');
        $follow_result = $follow_model->where("u_id=$this->p_id")->count();
        // echo $follow_result;
        $this->assign('f_count',$follow_result);

        $follow = M('follow');
        $who_result = $follow_model->where("f_id=$this->p_id")->count();
        $this->assign('w_count',$who_result);



        // echo $follow;
        $this->assign('follow',$is_follow);
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

    public function doFollow(){
        $this->p_id = $_POST['p_id'];
        $model = M('follow');
        $data['u_id']=$this->p_id;
        $data['f_id']= $this->userId;
        $data['time'] = $this->time;

        if($insert_id = $model->add($data)){
            $this->addTip($this->p_id,$this->userId,'follow',$insert_id,$this->time);
            if($this->ifFollow($this->userId,$this->p_id)){
                $model = M('friend');
                $data['u_id']=$this->userId;
                // echo $this->userId;
                // echo $this->p_id;
                $data['f_id']=$this->p_id;
                $data['status']=1;
                $data['time']=$this->time;
                $model->add($data);
                
                $data['f_id']=$this->userId;
                $data['u_id']=$this->p_id;
                $data['time']=$this->time;

                $model->add($data);

                

            }
            echo 'true';
        }else{
            echo 'false';
        }
    }
    public function removeFollow(){
        $this->p_id = $_POST['p_id'];
        $model = M('follow');
        $data['u_id']=$this->p_id;
        $data['f_id']= $this->userId;

        if($model->where($data)->delete()){
            if($this->ifFollow($this->userId,$this->p_id)){
                $model = M('friend');
                $data['u_id']=$this->userId;
                $data['f_id']=$this->p_id;
                $model->where($data)->delete();
                $data['f_id']=$this->userId;
                $data['u_id']=$this->p_id;
                $model->where($data)->delete();

            }
            echo 'true';
        }else{
            echo 'false';
        }
    }

    public function myFollow(){
        $follow = M('follow');
        $p_id = $_GET['p_id'];
        $follow_result = $follow->table('bee_follow f,bee_user u')->where("u_id=$p_id and u.id=f_id")->select();
        // var_dump($follow_result);
        $this->assign('follow_result',$follow_result);
        $this->display();
    }

    public function followWho(){
        $follow = M('follow');
        $p_id = $_GET['p_id'];

        $follow_result = $follow->table('bee_follow f,bee_user u')->where("f_id=$p_id and u.id=u_id")->select();
        // var_dump($follow_result);
        $this->assign('follow_result',$follow_result);
        $this->display();
    }

     public function like(){

        $like_list = $this->getLike('all',$_GET['p_id']);
        
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

                    break;
                case 'book':

                    break;
            }
        }
        // var_dump($like_list);
        $this->assign('like_list',$like_list);
        $this->display();

    }

    


}
