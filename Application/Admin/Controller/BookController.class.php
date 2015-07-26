<?php
namespace Admin\Controller;
use Think\Controller;
class BookController extends CommonController {
    public function index(){
      $b = M('book');

      $list = $b->select();

      $list[0]['release_t'] = date('Y-m-d',$list[0]['release_t']);
      //var_dump($list);
      $this->assign('list',$list);

    	$this->display();    
   	}
   	public function add(){
        $b = M('bclassify');

        $list = $b -> where('pid>0') -> select();
        $this->assign('list',$list);
        //var_dump($li);
        //var_dump($list);exit; 
        $this->display();    
   	}
   	public function doadd(){
        $_POST['release_t'] = strtotime($_POST['release_t']);
        $b = M('book');
        $result=$b->add($_POST);
        $insertId=$result;
        // if($result){
        //     $insertId = $result;
        //     //echo $insertId;
        //     $this->success('添加成功', U('Book/index'));

        // }else{
        //     $this->error('添加失败');
        // }
        // var_dump($_FILES['file']);EXIT;
        $upload = new \Think\Upload();
        $upload->maxSize = 0;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  = './Public';
        $upload->savePath  = './Uploads/book/';
        $info   =   $upload->uploadOne($_FILES['file']);
         $info['savepath'];

        //实例化图像类
        $image = new \Think\Image(); 
        //拼接图片路径
        $info['savepath'] = ltrim($info['savepath'],'.');
        $path = 'Public'.$info['savepath'].$info['savename'];
        $info['savename'];
        //打开图像
        $image->open($path);
        //echo $info['savepath'].'148_'.$info['savename'];exit;
        //按照原图的比例生成缩略图并保存 三种size
        $image->thumb(100, 148,\Think\Image::IMAGE_THUMB_FIXED)->save('Public'.$info['savepath'].'148_'.$info['savename']);
        //再次打开路径
        $image->open($path);

        $image->thumb(128, 180,\Think\Image::IMAGE_THUMB_FIXED)->save('Public'.$info['savepath'].'180_'.$info['savename']);
        $image->open($path);
        
        $image->thumb(140, 207,\Think\Image::IMAGE_THUMB_FIXED)->save('Public'.$info['savepath'].'207_'.$info['savename']);

        if(!$info){   
            $this->error($upload->getError());
        }else{//上传成功 获取文件信息   
            $info['savepath'].$info['savename'];
        }

        $data['name']=$info['savename'];
        $data['b_id']=$insertId;
        $data['is_cover']='1';
        $data['i_path']=ltrim($info['savepath'],'.');
        $b = M('bimage');
        if($b->add($data)){      
          $this->success('成功');
        }else{
          $this->error('上传失败');
        }

        $b = M('b_c');
        foreach ($_POST['c_id'] as $val){
            $d['b_id']=$insertId;
            $d['c_id']=$val;
            $b->add($d);
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
        $_POST['release_t'] = strtotime($_POST['release_t']);
        //var_dump($_POST);
        $b = M('book');
        $insertId=$b->add($_POST);
        /*
        if($result){
            $insertId = $result;
            //echo $insertId;
            $this->success('添加成功', U('Book/index'));

        }else{
            $this->error('添加失败');
        }
        */
         
        $upload = new \Think\Upload();
        $upload->maxSize = 0;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  = './Public';
        $upload->savePath  = './Uploads/book/';
        //上传单个文件
        $info   =   $upload->uploadOne($_FILES['file']);
        

        //实例化图像类
        $image = new \Think\Image(); 
        //拼接图片路径
        $info['savepath'] = ltrim($info['savepath'],'.');
        $path = 'Public'.$info['savepath'].$info['savename'];
        //打开图像
        $image->open($path);
        //echo $info['savepath'].'148_'.$info['savename'];exit;
        //按照原图的比例生成缩略图并保存 三种size
        $image->thumb(100, 148,\Think\Image::IMAGE_THUMB_FIXED)->save('Public'.$info['savepath'].'148_'.$info['savename']);
        //再次打开路径
        $image->open($path);

        $image->thumb(128, 180,\Think\Image::IMAGE_THUMB_FIXED)->save('Public'.$info['savepath'].'180_'.$info['savename']);
        $image->open($path);
        
        $image->thumb(140, 207,\Think\Image::IMAGE_THUMB_FIXED)->save('Public'.$info['savepath'].'207_'.$info['savename']);

        if(!$info){   
            $this->error($upload->getError());
        }else{//上传成功 获取文件信息   
            $info['savepath'].$info['savename'];
        }
       
        $data['name']=$info['savename'];
        $data['b_id']=$insertId;
        $data['is_cover']='1';
        $data['i_path']=ltrim($info['savepath'],'.');
        //var_dump($data);
        $b = M('bimage');
        if($b->add($data)){      
          $this->success('添加成功');
        }else{
          $this->error('添加失败');
        }
        
        $b = M('b_c');
        foreach ($_POST['c_id'] as $val){
            $d['b_id']=$insertId;
            $d['c_id']=$val;
            $b->add($d);
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


    public function longComment(){
        $b = M('l_b');
        $count = $b->table('bee_book b,bee_l_b l,bee_user u')->field('b.name,l.*,u.name uname')->where('l.b_id=b.id and l.u_id=u.id')->count();
        // 实例化分页类 传入总记录数和每页显示的记录数
        $Page = new \Think\Page($count,5);
        // 分页显示输出
        $show = $Page->show();
        $list = $b->table('bee_book b,bee_l_b l,bee_user u')->field('b.name,l.*,u.name uname')->where('l.b_id=b.id and l.u_id=u.id')->limit($Page->firstRow.','.$Page->listRows)->select();
        //var_dump($list);
        $this->assign('list',$list);

        $this->display();
    }




    public function dellongComment($id){
        //var_dump($id);
        $b = M('l_b');
        if($b->delete($id)){
            $this->success('删除成功',U('Book/longComment'));
        }else{
            $this->erroe('删除失败');
        }
    }

    public function shortComment(){
        $b = M('s_b');
        //查询出符合条件的记录总数
        $count = $b->table('bee_book b,bee_s_b s,bee_user u')->field('b.name,s.*,u.name uname')->where('s.b_id=b.id and s.u_id=u.id')->count();
        //var_dump($count);

        // 实例化分页类 传入总记录数和每页显示的记录数
        $Page = new \Think\Page($count,5);
        // 分页显示输出
        $show = $Page->show();
        $list = $b->table('bee_book b,bee_s_b s,bee_user u')->field('b.name,s.*,u.name uname')->where('s.b_id=b.id and s.u_id=u.id')->limit($Page->firstRow.','.$Page->listRows)->select();
        //var_dump($list);
        $this->assign('list',$list);


        $this->display();
    } 



    public function delshortComment($id){
        //var_dump($id);
        $b = M('s_b');
        if($b->delete($id)){
            $this->success('删除成功',U('Book/shortComment'));
        }else{
            $this->erroe('删除失败');
        }
    }

    public function dolongshow(){
        //var_dump($_GET);
        $id=$_GET['id'];
        $data['show'] = $_GET['show']==1?0:1;
        $data['id'] = $_GET['id'];
        //var_dump($data);
        $b=M('l_b');
        if($b->where("id=$id")->save($data)){
            $this->success('修改成功',U('Book/longComment'));
        }else{
            $this->error('修改失败');
        }

    }


    public function doshortshow(){
        //var_dump($_GET);
        $id=$_GET['id'];
        $data['show'] = $_GET['show']==1?0:1;
        $data['id'] = $_GET['id'];
        //var_dump($data);
        $b=M('s_b');
        if($b->where("id=$id")->save($data)){
            $this->success('修改成功',U('Book/shortComment'));
        }else{
            $this->error('修改失败');
        }

    }
   	
}