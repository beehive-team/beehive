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
            //var_dump($_SESSION);

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
}