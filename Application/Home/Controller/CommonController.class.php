<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
    public function _initialize(){
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
        $data = $model->create($data);
        //var_dump($data);
        if(!$data){
            $this->error($model->getError());
            exit;
        }

        if($result = $model->add()){
            $_SESSION['home']['name']=$data['name'];
            $_SESSION['home']['user_id']= $result;

            $this->success('注册成功','../Home/User/index');
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
            
            $this->success('登录成功','../Home/User/index');
            //var_dump($_SESSION);
        }else{
            $this->error('登录失败');
        }

        
    }

}
