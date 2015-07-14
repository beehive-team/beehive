<?php
namespace Home\Controller;
class MovieController extends CommonController {
    public function index(){
        //实例化分类表
        $m = M('mclassify');
        $list=$m->where("path='0,1,'")->select();
        //var_dump($list);
        $this->assign('list',$list);

        $this->display();
    }
    public function chose(){
    	$this->display();
    }
    public function ranking(){
    	$this->display();
    }
    public function comment(){
    	$this->display();
    }
    public function detail(){
        $this->display();
    }

    public function getCata(){
        //var_dump($_POST);
        $id=$_POST['c_id'];
        $m = M('m_c');
        $list = $m->where('c_id='.$id)->select();
        //var_dump($list); 
        //$this->assign('list',$list);
    }
}
