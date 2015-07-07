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
        if(!empty($reuslt)){
            echo  'true';
        }else{
            echo 'false';
        }
        // var_dump($date);

    }
    public function vcode(){
        $Verify = new \Think\Verify();
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
        var_dump($_POST);
    }

}
