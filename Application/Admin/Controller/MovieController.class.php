<?php
namespace Admin\Controller;
use Think\Controller;
class MovieController extends Controller {
    public function index(){
      	$m = M('movie');
        $count = $m->table('bee_movie m,bee_mclassify f')->field('f.name fname,m.*')->where('m.year=f.id')->count();
        // 实例化分页类 传入总记录数和每页显示的记录数
        $Page = new \Think\Page($count,5);
        // 分页显示输出
        $show = $Page->show();

        $list = $m->table('bee_movie m,bee_mclassify f')->field('f.name fname,m.*')->where('m.year=f.id')->limit($Page->firstRow.','.$Page->listRows)->select();
        //echo $m->getLastsql();
        //var_dump($list);exit;
        for($i=0;$i< count($list);$i++){
          $list[$i]['crelease_t'] = date('Y-m-d',$list[$i]['crelease_t']);
          $list[$i]['orelease_t'] = date('Y-m-d',$list[$i]['orelease_t']);
        }
        // echo count($list);
        //var_dump($list);
        $this->assign('list',$list);
        // 赋值分页输出
        $this->assign('page',$show);
        $this->display();
   	}

   
    public function add(){
    	$m = M('mclassify');

        $list = $m -> where('pid=2') -> select();
        $li = $m -> where('pid=3') -> select();
        $lis = $m -> where('pid=1') -> select();
        $this->assign('list',$list);
        $this->assign('li',$li);
        $this->assign('lis',$lis);
        //var_dump($li);
        //var_dump($list);exit; 
        //var_dump($lis);
        $this->display();    
   	}
    public function doadd(){ 

        $_POST['crelease_t'] = strtotime($_POST['crelease_t']);
        $_POST['orelease_t'] = strtotime($_POST['orelease_t']);
        //var_dump($_POST);
        $m = M('movie');
        $insertId=$m->add($_POST);
        /*
        if($result){
            $insertId = $result;
            //echo $insertId;
            $this->success('添加成功', U('Movie/index'));

        }else{
            $this->error('添加失败');
        }
        */
         
        $upload = new \Think\Upload();
        $upload->maxSize = 0;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  = './Public';
        $upload->savePath  = './Uploads/movie/';
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
        $data['m_id']=$insertId;
        $data['is_cover']='1';
        $data['i_path']=ltrim($info['savepath'],'.');
        //var_dump($data);
        $m = M('mimage');
        if($m->add($data)){      
          $this->success('添加成功');
        }else{
          $this->error('添加失败');
        }
        
        $m = M('m_c');
        foreach ($_POST['c_id'] as $val){
            $d['m_id']=$insertId;
            $d['c_id']=$val;
            $m->add($d);
        }
    }
   	
    public function edit($id){
        //查询电影表相关信息显示出来
        $m = M('movie');
        $row = $m->table('bee_movie m,bee_mclassify f')->field('f.name fname,m.*')->where('m.year=f.id and m.id='.$id)->find();
        //echo $m->getLastsql();     
        $row['crelease_t'] = date('Y-m-d',$row['crelease_t']);
        $row['orelease_t'] = date('Y-m-d',$row['orelease_t']);
        //var_dump($row); 
        $this->assign('row',$row);

        //查询分类表 select 遍历出来
        $m = M('mclassify');
        $list = $m -> where('pid=2') -> select();
        $li = $m -> where('pid=3') -> select();
        $lis = $m -> where('pid=1')->field('id,name')-> select();
        $this->assign('list',$list);
        $this->assign('li',$li);
        $this->assign('lis',$lis);
        //var_dump($lis);
        
        //查询映射表  所有类型
        $m = M('m_c');
        $row1=$m->where("m_id=$id")->select();
        //var_dump($row1);
        //将checked写入 整合成一个数组arr
        $arr = array();
        for($i=0;$i<count($lis);$i++){
            $arr[$i]['id']=$lis[$i]['id'];
            $arr[$i]['name']=$lis[$i]['name'];
            for($j=0;$j<count($row1);$j++){
                if($lis[$i]['id']==$row1[$j]['c_id']){
                    $arr[$i]['checked']=1;
                }
            }           
        }
        //var_dump($arr);
        $this->assign('arr',$arr);

        $this->display();
 
    }
    public function doedit(){
        $_POST['crelease_t'] = strtotime($_POST['crelease_t']);
        $_POST['orelease_t'] = strtotime($_POST['orelease_t']);
        //var_dump($_POST);
        $id= $_POST['id'];
        
        $m = M('m_c');
        //先把数据库中的删除 再添加所有类型
        $m->where("m_id=$id")->delete();
        foreach ($_POST['c_id'] as $val){
            $d['m_id']=$id;
            $d['c_id']=$val;
            if(!$m->add($d)){
                $this->error('更新失败');
            }
        }
        //将更改之后的数据更新
        $m = M('movie');
        if($m->where("id=$id")->save($_POST)){
            $this->success('更新成功',U('Movie/index'));
        }else{
            $this->error('更新失败');
        }     
    }
    public function del($id){
        $m = M('movie');
        if($m->delete($id)){
            $this->success('删除成功',U('Movie/index'));
        }else{
            $this->erroe('删除失败');
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
        
      	$this->display(); */  
   	}
   	
    public function image(){
        $m = M('movie');
        //查询信息
        $list1 = $m->table('bee_movie m,bee_mimage i')->field('i.id,i.name iname,i.i_path,i.is_cover,m.name')->where('m.id=i.m_id')->select();
        //通过遍历将path添加到数组
        foreach ($list1 as $val){
            $val['path'] = $val['i_path'].'148_'.$val['iname'];
            //var_dump($val);
            $list[]=$val;
        }     
        //var_dump($list);exit;
        $this->assign('list',$list);   
    	$this->display();    
   	}
   	public function addImage($id){
        $m = M('movie');
        $row = $m->where("id=$id")->find();
        //var_dump($row);exit;
        $this->assign('row',$row);
        
        $m1 = M('mimage');
        $r = $m1->where('is_cover=1 and m_id='.$id)->find();
        //echo $m1->getLastsql();
        $r['path'] = $r['i_path'].'180_'.$r['name'];
        //var_dump($r);     
        $this->assign('r',$r);

        $this->display();    
   	}
    public function doaddimage(){      
        //var_dump($_FILES);
        $id = $_POST['id'];
        $upload = new \Think\Upload();
        $upload->maxSize = 0;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  = './Public';
        $upload->savePath  = './Uploads/movie/';
        $info   =   $upload->upload();
        //var_dump($info);
        //echo '<hr/>';
        
        if(!$info){   
            $this->error($upload->getError());
        }else{            
            foreach($info as $file){
                $data['name']=$file['savename'];
                $data['m_id']=$id;
                //$data['is_cover']='1';
                $data['i_path']=ltrim($file['savepath'],'.');
                //var_dump($data);
                $m = M('mimage');
                if(!$m->add($data)){    
                    $this->error('上传失败');
                }
            }        
          $this->success('上传成功',U('Movie/addimage',"id=$id"));            
        }

    }
  

   	public function brief($id){
        $m = M('movie');
        $row = $m ->where("id=$id")->find();
        //var_dump($row);
        $this->assign("row",$row);

        $m1 = M('mimage');
        $r = $m1->where('is_cover=1 and m_id='.$id)->find();
        //echo $m1->getLastsql();
        $r['path'] = $r['i_path'].'180_'.$r['name'];   //拼接图片路径
        //var_dump($r);     
        $this->assign('r',$r);
        $this->display();
    }
    public function editbrief(){
        var_dump($_POST);
        $id=$_POST['id'];
        $m = M('movie');
        if($m->where("id=$id")->save($_POST)){
            $this->success('更新成功',U('Movie/brief',"id=$id"));
        }else{
            $this->error('更新失败');
        }

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