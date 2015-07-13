<?php
namespace Admin\Controller;
use Think\Controller;
class BookController extends Controller {
    public function index(){
      $b = M('book');

      $list = $b->select();

      $list[0]['release_t'] = date('Y-m-d',$list[0]['crelease_t']);
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
   	public function doadd(){
        $_POST['release_t'] = strtotime($_POST['release_t']);
        $b = M('book');
        $result=$b->add($_POST);
        if($result){
            $insertId = $result;
            //echo $insertId;
            $this->success('添加成功', U('Book/index'));

        }else{
            $this->error('添加失败');
        }

        $upload = new \Think\Upload();
        $upload->maxSize = 0;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  = './Public';
        $upload->savePath  = './Uploads/book/';
        $info = $upload->upload();
        if(!$info){   
            $this->error($upload->getError());
        }else{   
            foreach($info as $file){
                $file['savepath'].$file['savename'];    
            }
        }

        $data['name']=$file['savename'];
        $data['b_id']=$insertId;
        $data['is_cover']='1';
        $data['i_path']=ltrim($file['savepath'],'.');
        //var_dump($data);
        $b = M('bimage');
        if($b->add($data)){      
          $this->success('成功');
        }else{
          $this->error('上传失败');
        }
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


   	public function edit($id){
        $b = M('book');
        $row = $b->where("id=$id")->find();        
        echo $b->getLastsql();     
        $row['release_t'] = date('Y-m-d',$row['release_t']);
        var_dump($row); 
        $this->assign('row',$row);
        $this->display();
    }

    public function doedit(){
    	$_POST['release_t'] = strtotime($_POST['release_t']);
    	$id= $_POST['id'];
    	$b = M('book');
        if($b->where("id=$id")->save($_POST)){
            $this->success('更新成功',U('Book/index'));
        }else{
            $this->error('更新失败');
        }
    }

    public function del($id){
        $b = M('book');
        if($b->delete($id)){
            $this->success('删除成功',U('Book/index'));
        }else{
            $this->erroe('删除失败');
        }
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
   		$b = M('book');
        $list = $m->table('bee_book b,bee_bimage i')->field('i.id,i.name iname,i.i_path,i.is_cover,b.name')->where('b.id=i.b_id')->select();
        //$list['path'] = $list['i_path'].$list['iname'];
        //var_dump($list);
        $this->assign('list',$list);
    	$this->display();    
   	}

   	public function addCover($id){
        $b = M('book');
        $row = $b->where("id=$id")->find();
        //var_dump($row);
        $this->assign('row',$row);
        
        $b1 = M('bimage');
        $r = $b1->where('is_cover=1 and b_id='.$id)->find();
        //echo $m1->getLastsql();
        $r['path'] = $r['i_path'].$r['name'];
        //var_dump($r);     
        $this->assign('r',$r);

        $this->display();    
   	}
    public function doaddcover(){      
        //var_dump($_FILES);
        $id = $_POST['id'];
        $upload = new \Think\Upload();
        $upload->maxSize = 0;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  = './Public';
        $upload->savePath  = './Uploads/book/';
        $info   =   $upload->upload();
        //var_dump($info);
        //echo '<hr/>';
        
        if(!$info){   
            $this->error($upload->getError());
        }else{            
            foreach($info as $file){
                $data['name']=$file['savename'];
                $data['b_id']=$id;
                //$data['is_cover']='1';
                $data['i_path']=ltrim($file['savepath'],'.');
                //var_dump($data);
                $b = M('bimage');
                if(!$m->add($data)){    
                    $this->error('上传失败');
                }
            }        
          $this->success('上传成功',U('Book/addcover',"id=$id"));            
        }

    }
     public function brief($id){
        $b = M('book');
        $row = $b ->where("id=$id")->find();
        //var_dump($row);
        $this->assign("row",$row);

        $b1 = M('bimage');
        $r = $b1->where('is_cover=1 and b_id='.$id)->find();
        //echo $m1->getLastsql();
        //var_dump($r);
        $r['path'] = $r['i_path'].$r['name'];   //拼接图片路径
             
        $this->assign('r',$r);
        $this->display();
    }
     public function editbrief(){
        var_dump($_POST);
        $id=$_POST['id'];
        $b = M('book');
        if($b->where("id=$id")->save($_POST)){
            $this->success('更新成功',U('Book/brief',"id=$id"));
        }else{
            $this->error('更新失败');
        }

    }
   	
}