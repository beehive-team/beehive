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

      $p = M('power');
      $p_result = $p->select();

      // var_dump($p_result);
      $this->assign('page',$show);// 赋值分页输出
      $this->assign('power',$p_result);// 赋值分页输出

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

    public function addActor(){
      
      $this->display();
    }


    public function power(){
      $models = array('Admin');
       
      $all_controller =$this->getController($models[0]);

     
      
      

      $this->assign('controller',$all_controller);
      $this->display();

    }
    protected function getController($module){
        
        if(empty($module)) return null;
        $module_path = APP_PATH . $module . '/Controller/';  //控制器路径
        // echo $module_path;
        if(!is_dir($module_path)) return null;
        $module_path .= '/*.class.php';
        $ary_files = glob($module_path);

        foreach ($ary_files as $file) {
            if (is_dir($file)) {
                continue;
            }else {
                $files[] = basename($file, C('DEFAULT_C_LAYER').'.class.php');
            }
        }
        // var_dump($files);
        return $files;
    }

    public function getAction(){
      $c = $_POST['controller']['0'];
      
      if(empty($c)) return null;
        $con = A($c);
        $functions = get_class_methods($con);
        //排除部分方法
        $inherents_functions = array('_initialize','__construct','getActionName','isAjax','display','show','fetch','buildHtml','assign','__set','get','__get','__isset','__call','error','success','ajaxReturn','redirect','__destruct', '_empty','theme');
        foreach ($functions as $func){
            if(!in_array($func, $inherents_functions)){
                $customer_functions[] = $func;
            }
        }
        // var_dump($customer_functions);
        $this->ajaxReturn($customer_functions);
      
    }


    
    public function doAddActor(){
      // var_dump($_POST);
      $r = array();
      $data['re'] = $_POST['re'];
      $re = explode(' ',$data['re']);
      // var_dump($re);
      $actor['name'] = $_POST['actor'];
      $actor_m = M('power');
      $actor_id = $actor_m->add($actor);
      foreach ($re as $key => $value) {
        
        $r[] =explode(',', $re[$key]);
      }
      // var_dump($r);
      foreach ($r as $key => $value) {
        if($r[$key][0]==''){
          unset($r[$key]);
        }
      }
      foreach ($r as $key => $value) {
        $model = M('ac_po');
        $data['c_name'] = $r[$key][0];
        $data['a_name'] = $r[$key][1];
        $data['p_id'] = $actor_id;
        $model->add($data);
      }

      
    }

    public function doPower(){
      $data =$_POST;
      // var_dump($_POST);
      $m = M('u_p');
      // echo $this->userId;
      // exit;
      // $m->where("u_id=$this->userId")->delete();
      var_dump($data);
      if($m->add($data)){
        $this->redirect('backUser',0,'');
      }

    }

}