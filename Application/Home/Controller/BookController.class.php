<?php
namespace Home\Controller;
class BookController extends CommonController {
    public function index(){
    	$b = M('bclassify');
        $list=$b->where("pid>0")->select();
        //var_dump($list);
        $this->assign('list',$list);

        $row = $b->table('bee_book b,bee_bimage i')->field('b.name bname ,b.writer,i.*')->where('b.id=i.b_id and b.release_t>1411056000')->select();
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
    public function getCata(){
        //var_dump($_POST);exit;
        $i= $_POST['num'];
        //传过来的是hot 是打开页面默认显示的 
        if($_POST['c_id']=='hot'){
            $b= M('book');
            $lis = $b->table('bee_book b,bee_bimage i')->field('b.name bname,i.*')->where('b.id=i.b_id and i.is_cover=1 and b.hot>2')->limit($i)->select();
            //var_dump($lis);

        }else{
            //接收分类id
            $id=$_POST['c_id'];
            $i= $_POST['num'];
            $b = M('b_c');
            //查询
            $list = $b->where('c_id='.$id)->limit($i)->select();
            //echo $b->getLastSql();
            //var_dump($list);
            foreach ($list as $val) {
                $b = M('book');
                //$val['b_id'];
                $row = $b->table('bee_book b,bee_bimage i')->field('b.name bname,i.*')->where('b.id='.$val['b_id'].' and b.id=i.b_id and i.is_cover=1')->find();
                $lis[]=$row;
               
            }
            
        }    
        echo json_encode($lis);
    }
}
