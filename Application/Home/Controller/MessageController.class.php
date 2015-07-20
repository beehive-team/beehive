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
        $conversation = M('conversation');
        $u_id = $this->userId;
        $con_result = $conversation->where("u_id=$u_id or p_id=$u_id")->order('update_time desc')->select();
        // var_dump($con_result);
        foreach ($con_result as $key => $value) {
            $data['m_id'] = $con_result[$key]['id'];
            if($con_result[$key]['u_id']!=$this->userId){
                $p_id = $con_result[$key]['p_id'] = $con_result[$key]['u_id'];
            }else{
                $p_id = $con_result[$key]['p_id'];
            }

            $message = M('message');
            $m_id  =$data['m_id'];
            $message_result = $message->where("m_id=$m_id")->order('time desc')->find();
            $con_result[$key]['con'] = $message_result;
            $last_id =$message_result['id'];

            $user = M('user');
            
            
            $user_result = $user->where("id=$p_id")->find();
            $con_result[$key]['user'] = $user_result;
            $re['status'] = 0;
            $re['do_id']=$last_id;
            $re['action'] = 'msg';
            $re['p_id'] = $this->userId;
            
            
            $m = M('tip');
            $result = $m->where($re)->find();
            
            // var_dump($result);
            if(!empty($result)){
                $con_result[$key]['new']=1;
            }else{
                $con_result[$key]['new']=0;

            }
        }
        // var_dump($con_result);
        $this->assign('info',$con_result);
        $this->display();
    }


    // 查信息
    public function message(){
        $p_id = $_GET['p_id'];
        
        
        $model = M('user');
        $p_user = $model->where("id=$p_id")->find();
        $u_id = $this->userId;
        $me = $model->where("id=$u_id")->find();


        // var_dump($p_user);
        // var_dump($me);
        $conversation = M('conversation');
        $con_result = $conversation->where("(u_id=$u_id and p_id=$p_id)or(u_id=$p_id and p_id=$u_id)")->order('time desc')->find();
        if(!empty($con_result)){
            $m_id = $con_result['id'];
            $tip = M('tip');
            $t_info['p_id'] = $this->userId;
            $t_info['m_id'] = $m_id;
            $t_info['action'] = 'msg';
            $tip->where($t_info)->setField('status',1);
            $message = M('message');
            $msg_result = $message->where("m_id=$m_id")->order('time desc')->select();
            // var_dump($msg_result);
            // echo $this->userId;
            foreach ($msg_result as $key => $value) {

                if($msg_result[$key]['u_id']==$this->userId){
                    $msg_result[$key]['who']='me';
                }else{
                    $msg_result[$key]['who']='other';

                }
            }
            $this->assign('msg_result',$msg_result);
        }

        $this->assign('other',$p_user);
        $this->assign('me',$me);
        $this->display();

    }

    // 发信息
    public function sendMessage(){
        $data = $_POST;
        $u_id = $_POST['u_id'];
        $p_id = $_POST['p_id'];
        $data['time']=$this->time;
        $conversation = M('conversation');
        $con_result = $conversation->where("(u_id=$u_id and p_id=$p_id)or(u_id=$p_id and p_id=$u_id)")->find();
        $message = M('message');
        if(!empty($con_result)){
            $m_id = $con_result['id'];
            $conversation->where("id=$m_id")->setField('update_time',$this->time);
            $data['m_id']=$m_id;
            $insert_id = $message->add($data);
            $this->addTip($p_id,$this->userId,'msg',$insert_id,$this->time);
            $this->ajaxReturn($data);
        }else{
            $con['u_id']=$u_id;
            $con['p_id']=$p_id;
            $con['time']=$this->time;
            $con['update_time']=$this->time;
            $con['content']=$data['content'];
            $m_id = $conversation->add($con);
            $con['m_id'] = $m_id;
            $insert_id = $message->add($con);
            $this->addTip($p_id,$this->userId,'msg',$insert_id,$this->time);
            $this->ajaxReturn($con);
        }
    }

}
