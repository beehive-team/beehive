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
    }

    
    // 显示他人的页面
    public function index(){
        
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
        

        $diary = $diaryView->field('diaryid,title,content,u_id,content,time,power,browse,hot')->where("u_id=$this->p_id")->order('time desc')->group('diaryid')->limit($Page->firstRow.','.$Page->listRows)->select();
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
        
        $result = $album->where("u_id=$this->p_id")->field('album_id,album_name,u_id,power,update_time,browse,tolist,hot')->order('update_time desc')->group('album_id')->select();
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


    


}