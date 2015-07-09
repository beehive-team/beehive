<?php
namespace Admin\Controller;
use Think\Controller;
class BookController extends Controller {
    public function index(){
      $b = M('book');

      $list = $b->select();

      $list[0]['crelease_t'] = date('Y-m-d',$list[0]['crelease_t']);
      $list[0]['orelease_t'] = date('Y-m-d',$list[0]['orelease_t']);
      //var_dump($list);
      $this->assign('list',$list);

    	$this->display();    
   	}
   	public function add(){
        $b = M('bclassify');

        $list = $b -> where('pid=2') -> select();
        $li = $b -> where('pid=3') -> select();
        $this->assign('list',$list);
        $this->assign('li',$li);
        //var_dump($li);
        //var_dump($list);exit; 
        $this->display();    
   	}
   	public function classify(){
        if(empty($_GET['id'])){
            $id= 0;
        }else{
            $id=$_GET['id'];
        }

        $User = M('bclassify');
        $count = $User->where("pid=$id")->count();
        $Page = new \Think\Page($count,5);
        $show = $Page->show();
        $list = $User->where("pid=$id")->order()->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();  
   	}

    public function addclassify(){
        if(empty($_GET['id'])){
            $row['path'] = '0,'; 
            $row['id'] = '0';
        }else{
            $id=$_GET['id'];    
            $b = M('bclassify');
            $row = $b->where("id=$id")->find();
            $row['path'] = $row['path'].$id.',';
        }
        //var_dump($row);
        $this->assign('row',$row);
        $this->display();
    }
      public function doaddclassify(){
      //var_dump($_POST);
      $b = M('bclassify');

      if($b->add($_POST)){
          $this->success('添加成功', U('Book/classify'));
      }else{
          $this->error('添加失败');
      }
    }
      public function delclassify($id){
      $b = M('bclassify');
      
      if($b->delete($id)){
          $this->success('删除成功',U('Book/classify'));
      }else{
          $this->error('删除失败');
      }
    }
      public function editclassify($id){
      $b = M('bclassify');

      $row=$b->find($id);
      //var_dump($row);

      $this->assign('row',$row);

      $this->display();
    }

      public function doeditclassify(){
      //var_dump($_POST);
      $id = $_POST['id'];
      $b = M('bclassify');

      if($b->where("id=$id")->save($_POST)){
          $this -> success('更新成功',U('Book/classify'));
      }else{
          $this -> error('更新失败');
      }
    }
      
   	public function cover(){
    	$this->display();    
   	}
   	public function addCover(){
    	$this->display();    
   	}
   	
}