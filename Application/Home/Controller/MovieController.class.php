<?php
namespace Home\Controller;
class MovieController extends CommonController {
    public function index(){
        //实例化分类表
        $m = M('mclassify');
        $list=$m->where("path='0,1,'")->select();
        //var_dump($list);
        $this->assign('list',$list);

        $row = $m->table('bee_movie m,bee_mimage i')->field('m.name mname,i.*')->where('m.id=i.m_id and m.crelease_t>1411056000 and is_cover=1')->select();
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
        //获取电影id
        $id=$_GET['id'];
        $m = M('movie');
        //进行多表联合查询
        $list = $m->table('bee_movie m,bee_mimage i,bee_mclassify f,bee_m_c c')
                ->field('m.*,i.name iname,i.m_id imid,i.i_path,i.is_cover,f.id fid,f.name fname,c.m_id cmid,c.c_id')
                ->where('m.id=i.m_id and i.is_cover=1 and m.id=c.m_id and c.c_id=f.id and m.id='.$id)
                ->select();
                //var_dump($list);exit;
        $tmp = [];
        //将其他数组的fname写入第一个数组
        for($i = 0; $i<count($list); $i++){
            
            $tmp[] = $list[$i]['fname'];
        }
        $list[0]['fname'] = $tmp;
        //转换时间个格式
        $list[0]['crelease_t']=date('Y-m-d',$list[0]['crelease_t']);
        $list[0]['orelease_t']=date('Y-m-d',$list[0]['orelease_t']);
        //echo count($list[0]['fname']);
        //var_dump($list[0]);
        $this->assign('list',$list[0]);

        //查询年份  非封面图片
        $m1 = M('movie');
        $row= $m1->table('bee_movie m,bee_mimage i,bee_mclassify f')
                ->field('m.year,m.country,i.name iname,i.m_id,i.i_path,f.name')
                ->where('m.year=f.id and i.is_cover=0 and m.id=i.m_id and m.id='.$id)
                ->select();
        //var_dump($row);
        $this->assign('row',$row);
        //查询国家
        $m2=M('movie');
        $r = $m2->table('bee_movie m,bee_mclassify f ')->field('f.name')->where('f.id=m.country and m.id='.$id)->find();
        $m2->getLastSql();
        //var_dump($r);
        $this->assign('r',$r);
        $this->display();
    }

    public function getCata(){
        //var_dump($_POST);exit;
        $i= $_POST['num'];
        //传过来的是hot 是打开页面默认显示的 
        if($_POST['c_id']=='hot'){
            $m= M('movie');
            $lis = $m->table('bee_movie m,bee_mimage i')->field('m.name mname,i.*')->where('m.id=i.m_id and i.is_cover=1 and m.hot>5')->limit($i)->select();
            //var_dump($lis);

        }else{
            //接收分类id
            $id=$_POST['c_id'];
            $i= $_POST['num'];
            $m = M('m_c');
            //查询
            $list = $m->where('c_id='.$id)->limit($i)->select();
            //var_dump($list);
            foreach ($list as $val) {
                $m = M('movie');
                //$val['m_id'];
                $row = $m->table('bee_movie m,bee_mimage i')->field('m.name mname,i.*')->where('m.id='.$val['m_id'].' and m.id=i.m_id and i.is_cover=1')->find();
                $lis[]=$row;
               
            }
            
        }    
        echo json_encode($lis);
    }
}
