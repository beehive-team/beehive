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
    	  $m = M('mclassify');

        $list = $m -> where('pid=2') -> select();
        $li = $m -> where('pid=3') -> select();
        $this->assign('list',$list);
        $this->assign('li',$li);
        //var_dump($li);
        //var_dump($list);exit; 
        $this->display();    
   	}
    public function doadd(){    
        $_POST['crelease_t'] = strtotime($_POST['crelease_t']);
        $_POST['orelease_t'] = strtotime($_POST['orelease_t']);
        //var_dump($_POST);
        $m = M('movie');
        if($m->add($_POST)){
            $this->success('添加成功', U('Movie/index'));
        }else{
            $this->error('添加失败');
        }


    }
   	
    public function classify(){
        if(empty($_GET['id'])){
            $id= 0;
        }else{
            $id=$_GET['id'];
        }

        $User = M('mclassify');
        $count = $User->where("pid=$id")->count();
        $Page = new \Think\Page($count,5);
        $show = $Page->show();
        $list = $User->where("pid=$id")->order()->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();

        /*$m = M('mclassify');

        $list = $m->where("pid=$id")->select();
        
        $this->assign('list',$list);
        
      	$this->display();  */  
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