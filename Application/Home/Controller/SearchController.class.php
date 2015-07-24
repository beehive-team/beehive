<?php
namespace Home\Controller;
class SearchController extends CommonController {

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

   
    public function search(){
        $data = '%'.$_POST['search'].'%';
        $d_data['d.title']=array('like',$data);
        
        
        // var_dump($d_data);
        $diary = M('diary');
        $diary_result =$diary->field('u.name as u_name,title,image,d.time,content,u.id as u_id,d.id')->table("bee_user u,bee_diary d")->where("u.id=d.u_id")->where($d_data)->select();
       
        // echo $diary->getLastsql();
        //var_dump($diary_result);

        $user = M('user');
        $u_data['name']=array('like',$data);
        $user_result = $user->where($u_data)->select();
        //var_dump($user_result);

        $movie = M('movie');
        $m_data['m.name']=array('like',$data);
        $m_data['is_cover']=array('eq','1');

        $movie_result = $movie->field('i.name as i_name,m.id,m.name as mname,i.i_path')->table('bee_mimage as i,bee_movie as m')->where($m_data)->select();
        //echo $movie->getLastsql();
        //var_dump($diary_result); 
        $this->assign('diary_list',$diary_result);
        $this->assign('user_list',$user_result);
        $this->assign('movie_list',$movie_result);
        $this->display();   
    }
}
