<?php
namespace Home\Controller;
class BookController extends CommonController {
    public function index(){
    	$b = M('bclassify');
        $list=$b->where("path='0,'")->select();
        var_dump($list);
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
    public function Ajax(){
        //var_dump($_POST);exit;
        $i= $_POST['num'];
        //传过来的是hot 是打开页面默认显示的 
        if($_POST['c_id']=='hot'){
            $b= M('book');
            $lis = $m->table('bee_book b,bee_bimage i')->field('b.name bname,i.*')->where('b.id=i.b_id and i.is_cover=1 and b.hot>5')->limit($i)->select();
            var_dump($lis);
        }
    }
        public function detail(){        
        //获取图书id
        $id=$_GET['id'];
        $b = M('book');
        //进行多表联合查询
        $list = $b->table('bee_book m,bee_bimage i,bee_bclassify f,bee_b_c c')
                ->field('b.*,i.name iname,i.b_id ibid,i.i_path,i.is_cover,f.id fid,f.name fname,c.b_id cbid,c.c_id')
                ->where('b.id=i.b_id and i.is_cover=1 and b.id=c.b_id and c.c_id=f.id and b.id='.$id)
                ->select();
                //var_dump($list);exit;
        $tmp = [];
        //将其他数组的fname写入第一个数组
        for($i = 0; $i<count($list); $i++){
            
            $tmp[] = $list[$i]['fname'];
        }
        $list[0]['fname'] = $tmp;
        //转换时间个格式
        $list[0]['release_t']=date('Y-m-d',$list[0]['release_t']);
        //echo count($list[0]['fname']);
        //var_dump($list[0]);
        $this->assign('list',$list[0]);

        //查询年份 国家 图片
        $b1 = M('book');
        $row= $b1->table('bee_book b,bee_bimage i,bee_bclassify f')
                ->field('b.year,b.country,i.name iname,i.b_id,i.i_path,f.name')
                ->where('b.year=f.id and i.is_cover=0 and b.id=i.b_id and b.id='.$id)
                ->select();
        var_dump($row);
        $this->display();
    }
}
