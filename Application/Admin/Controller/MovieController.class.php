<?php
namespace Admin\Controller;
use Think\Controller;
class MovieController extends Controller {
    public function index(){
    	$m = M('movie');

      $list = $m->select();

      $list[0]['crelease_t'] = date('Y-m-d',$list[0]['crelease_t']);
      $list[0]['orelease_t'] = date('Y-m-d',$list[0]['orelease_t']);
      //var_dump($list);
      $this->assign('list',$list);

      $this->display();    
   	}
   	public function add(){
    	$this->display();    
   	}
   	public function classify(){
    	$this->display();    
   	}
   	public function image(){
    	$this->display();    
   	}
   	public function addImage(){
    	$this->display();    
   	}
   	public function brief(){
      $this->display();
    }
    public function addclassify(){
      $this->display();
    }
    public function addc_classify(){
      $this->display();
    }

}