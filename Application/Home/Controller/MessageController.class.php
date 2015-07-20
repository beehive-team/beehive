<?php
namespace Home\Controller;
class MessageController extends CommonController {

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

        $this->display();
    }

    public function message(){
        $p_id = $_GET['p_id'];
        $model = M('user');
        $p_user = $model->where("id=$p_id")->find();
        $u_id = $this->userId;
        $me = $model->where("id=$u_id")->find();


        var_dump($p_user);
        var_dump($me);
        $conversation = M('conversation');
        $con_result = $conversation->where("(u_id=$u_id and p_id=$p_id)or(u_id=$p_id and p_id=$u_id)")->find();
        if(!empty($con_result)){
            $m_id = $con_result['id'];
            $message = M('message');
            $msg_result = $message->where("m_id=$m_id")->select();
        }
        $this->assign('other',$p_user);
        $this->assign('me',$me);
        $this->display();

    }

    public function sendMessage(){
        $data = $_POST;
        $u_id = $_POST['u_id'];
        $p_id = $_POST['p_id'];
        $data['time']=$this->time;
        $conversation = M('conversation');
        $con_result = $conversation->where("(u_id=$u_id and p_id=$p_id)or(u_id=$p_id and p_id=$u_id)")->find();
        if(!empty($con_result)){
            $m_id = $con_result['id'];
            $message = M('message');
            $data['m_id']=$m_id;
            $insert_id = $message->add($data);
            $this->ajaxReturn($data);
        }else{
            $con['u_id']=$u_id;
            $con['p_id']=$p_id;
            $con['time']=$this->time;

            $m_id = $con_result->add($con);
            $data['m_id'] = $m_id;
        }
    }

}
