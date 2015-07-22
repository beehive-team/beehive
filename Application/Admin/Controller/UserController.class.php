<?php
namespace Admin\Controller;
class UserController extends CommonController{


    public function fontUser(){
      $font_user = M('user');
      $count = $font_user->count();
      $Page       = new \Think\Page($count,5);
      $show       = $Page->show();// 分页显示输出
      $font_result = $font_user->limit($Page->firstRow.','.$Page->listRows)->select();

      $this->assign('page',$show);// 赋值分页输出
      $this->assign('font',$font_result);
      $this->display();  
    }
    public function backUser(){
      $back_user = M('back_user');
      $count = $back_user->count();
      
      $Page       = new \Think\Page($count,5);
      $show       = $Page->show();// 分页显示输出
      $back_result = $back_user->limit($Page->firstRow.','.$Page->listRows)->select();

      $this->assign('page',$show);// 赋值分页输出

      $this->assign('back',$back_result);
      $this->display();    
    }
   	public function doStatus(){
      $id = $_GET['id'];
      

      switch ($_GET['who']) {
        case 'font':
          $m = M('user');
          $s = $m->field('status')->where("id=$id")->find();
          $s = $s['status'];
          // echo $s;
          if($s==1){
            $data['status']=0;
          }else{
            $data['status']=1;
          }
          $m->where("id=$id")->save($data);
          $this->redirect('fontUser',0,'');
          break;
        
        case 'back':
          $m = M('back_user');

          $s = $m->field('status')->where("id=$id")->find();
          $s = $s['status'];
          // echo $s;

          if($s==1){
            $data['status']=0;
          }else{
            $data['status']=1;
          }
          $m->where("id=$id")->save($data);
          $this->redirect('backUser',0,'');

          break;
      }

    	 
   	}

    public function delete(){
      $id = $_GET['id'];
      

      switch ($_GET['who']) {
        case 'font':
          $m = M('user');
          
          if($s = $m->where("id=$id")->delete()){
            $this->success('删除成功');
          }else{
            $this->error('删除失败');

          }
          
          break;
        
        case 'back':
          $m = M('back_user');

          if($s = $m->where("id=$id")->delete()){
            $this->success('删除成功');
          }else{
            $this->error('删除失败');

          }

          break;
      }

    }



}