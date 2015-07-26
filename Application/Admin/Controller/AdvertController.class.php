<?php
namespace Admin\Controller;
use Think\Controller;
class AdvertController extends CommonController {
    //广告
    public function advert(){
        $m = M('ad');
        $list = $m->select();
        //var_dump($list);
        $this->assign('list',$list);

        $this->display();
    }
    public function addadvert(){
        //var_dump($_POST);exit;
        //var_dump($_FILES);
        $upload = new \Think\Upload();
        $upload->maxSize = 0;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  = './Public';
        $upload->savePath  = './Uploads/ad/';
        //上传单个文件
        $info   =   $upload->uploadOne($_FILES['file']);
        //var_dump($info);exit;

        $m = M('ad');   
        $data['style']=$_POST['style'];
        $data['link'] = $_POST['link'];
        $data['i_name']=$info['savename'];
        $data['i_path']=ltrim($info['savepath'],'.');
        //var_dump($data);exit;

        if($m->add($data)){      
          $this->success('添加成功',U('Advert/advert'));
        }else{
          $this->error('添加失败');
        }        
    }
    public function deladvert($id){
        //var_dump($_GET['id']);
        $m = M('ad');
        if($m->delete($id)){
            $this->success('删除成功',U('Advert/advert'));
        }else{
            $this->error('删除失败');
        }
    }
    
}
