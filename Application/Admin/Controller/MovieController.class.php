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
        if(empty($_GET['id'])){
            $id= 0;
        }else{
            $id=$_GET['id'];
        }
        $m = M('mclassify');

        $list = $m->where("pid=$id")->select();
        
        $this->assign('list',$list);
        
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
        if(empty($_GET['id'])){
            $row['path'] = '0,'; 
            $row['id'] = '0';
        }else{
            $id=$_GET['id'];    
            $m = M('mclassify');
            $row = $m->where("id=$id")->find();
            $row['path'] = $row['path'].$id.',';
        }
        //var_dump($row);
        $this->assign('row',$row);
        $this->display();
    }
    public function doaddclassify(){
        //var_dump($_POST);
        $m = M('mclassify');

        if($m->add($_POST)){
            $this->success('添加成功', U('Movie/classify'));
        }else{
            $this->error('添加失败');
        }
    }
    public function delclassify($id){
        $m = M('mclassify');
        
        if($m->delete($id)){
            $this->success('删除成功',U('Movie/classify'));
        }else{
            $this->error('删除失败');
        }
    }
    
    public function editclassify($id){
        $m = M('mclassify');

        $row=$m->find($id);
        //var_dump($row);

        $this->assign('row',$row);

        $this->display();
    }
    public function doeditclassify(){
        //var_dump($_POST);
        $id = $_POST['id'];
        $m = M('mclassify');

        if($m->where("id=$id")->save($_POST)){
            $this -> success('更新成功',U('Movie/classify'));
        }else{
            $this -> error('更新失败');
        }
    }
      

}