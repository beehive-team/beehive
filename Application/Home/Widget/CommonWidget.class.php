<?php
namespace Home\Widget;
use Think\Controller;
class CommonWidget extends Controller {  
	public function indexHeader(){
		$this->display('Public:indexHeader');
         
    }
	public function commonHead(){
		$this->display('Public:commonHead');
     
    }
    public function allHeader(){

        if(!empty($_SESSION['home'])){
            //var_dump($_SESSION)
            $this->assign('user',$_SESSION['home']);
        }
		$this->display('Public:allHeader');
     
    }
    public function movieHeader(){
		$this->display('Public:movieHeader');
     
    }
    public function commonFooter(){
		$this->display('Public:commonFooter');
     
    }
    public function accountHeader(){
		$this->display('Public:accountHeader');
     
    }
    public function userHeader(){
        $this->display('Public:userHeader');
     
    }
    public function bookHeader(){
        $this->display('Public:bookHeader');
     
    }
    public function userTitle(){


        $model = D('User');
        $id = $_SESSION['home']['user_id'];
        $data = $model->where("id=$id")->find();
        
        
        $face = $model->field('image')->where("id=$id")->find();
        // var_dump($face);
        $this->assign('face',$face);
        $this->assign('data',$data);
        // var_dump($data);

      
        $this->display('Public:userTitle');
     
    }
    public function peopleTitle(){


        $model = D('User');
        $id = $_GET['p_id'];
        $data = $model->where("id=$id")->find();
        
        
        $face = $model->field('image')->where("id=$id")->find();
        // var_dump($face);
        $this->assign('face',$face);
        $this->assign('u_id',$id);
        $this->assign('data',$data);
        // var_dump($data);

        
        $this->display('Public:peopleTitle');
     
    }
    public function pager(){
        $this->display('Public:pager');
    }
}