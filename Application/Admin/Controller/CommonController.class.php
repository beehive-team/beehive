<?php
namespace Admin\Controller;
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
    
    
    public function dologin(){
        $data = $_POST;
        //var_dump($data);
    
        
        $data['key']=md5($data['key']);
        $data[$method]=$info;
        $model = D('User');
        $data = $model->create($data);
        if($result = $model->where($data)->find()){
            //var_dump($result);
            
            $_SESSION['home']['name']=$result['name'];
            $_SESSION['home']['user_id']= $result['id'];
            
            $this->success('登录成功',U('Home/User/index'));
            //var_dump($_SESSION);
        }else{
            $this->error('登录失败');
        }

        
    }
   
}
