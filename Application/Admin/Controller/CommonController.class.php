<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
    protected $userId;
    protected $p_id;
    protected $relation;
    public function _initialize(){
        $current = CONTROLLER_NAME.'/'.ACTION_NAME;
        $this->userId = $_SESSION['admin']['u_id'];
            
            $this->p_id = $_SESSION['admin']['p_id'];
            // var_dump($_SESSION);
            // echo $current;
        if($current !='Index/index'&&$current!='Index/views'){
            // echo 1;
            $this->userId = $_SESSION['admin']['u_id'];

            $this->p_id = $_SESSION['admin']['p_id'];
            // var_dump($_SESSION);
            $model =M('ac_po');
            $result = $model->field('a_name,c_name')->where("p_id=$this->p_id")->select();
            // var_dump($result);
            // echo $this->p_id;
            foreach ($result as $key => $value) {
                $Allow_action[] = $result[$key]['c_name'].'/'.$result[$key]['a_name']; 
            }
            // var_dump($Allow_action);
        }
        var_dump($Allow_action);
       
        // echo $current; 

        // echo $current;
        
        if($current != 'Index/views' && $current != 'Index/Index'){
            if(!in_array($current,$Allow_action)){
                // echo 1;
                $this->error('您没有权限');

            }     
            
        }
        
        



    }
    
    
    public function dologin(){
        $data = $_POST;
        
    
        // $data['name']='admin';
        // $data['password']=md5(123456);

        $data['password']=md5($data['password']);
        unset($data['pwd']);
        // var_dump($data);
        $model = M('back_user');
        // $model->add($data);
        // exit;
        if($r = $model->where($data)->find()){
            $_SESSION['admin']['u_id']=$r['id'];
            $id  =$r['id'];
            $m = M('u_p');
            $info = $m->where("u_id=$id")->find();
            $_SESSION['admin']['p_id']=$info['p_id'];

            $this->success('登录成功',U('index/views'));
        }else{
            $this->error('登录失败');
           
        }
        // if($result = $model->where($data)->find()){
        //     //var_dump($result);
            
        //     $_SESSION['admin']['name']=$result['name'];
        //     $_SESSION['admin']['user_id']= $result['id'];
            
        //     $this->success('登录成功',U('Home/User/index'));
        //     //var_dump($_SESSION);
        // }else{
        //     $this->error('登录失败');
        // }

        
    }
   
}
