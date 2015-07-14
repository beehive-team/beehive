<?php
namespace Home\Controller;
class MovieController extends CommonController {
    public function index(){
        //实例化分类表
        $m = M('mclassify');
        $list=$m->where("path='0,1,'")->select();
        //var_dump($list);
        $this->assign('list',$list);

        $row = $m->table('bee_movie m,bee_mimage i')->field('m.name mname,i.*')->where('m.id=i.m_id and m.crelease_t>1411056000')->select();
        //var_dump($row);
        $this->assign('row',$row);
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
        //var_dump($_POST);exit;
        if($_POST['c_id']=='hot'){
            $m= M('movie');
            $lis = $m->table('bee_movie m,bee_mimage i')->field('m.name mname,i.*')->where('m.id=i.m_id and m.hot>5')->select();
            //var_dump($lis);

        }else{
            //接收分类id
            $id=$_POST['c_id'];

            $m = M('m_c');
            //查询
            $list = $m->where('c_id='.$id)->select();
            //var_dump($list);
            foreach ($list as $val) {
                $m = M('movie');
                //$val['m_id'];
                $row = $m->table('bee_movie m,bee_mimage i')->field('m.name mname,i.*')->where('m.id='.$val['m_id'].' and m.id=i.m_id')->find();
                $lis[]=$row;
               
            }
            
        }    
        echo json_encode($lis);
    }
}
