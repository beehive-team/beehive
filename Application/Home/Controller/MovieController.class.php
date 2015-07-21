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

        //查询长评

        $m3=M('l_r');
        $r1 = $m3->table('bee_user u,bee_l_r l')
                ->field('u.name,l.*')
                ->where('l.show=1 and u.id=l.u_id and l.m_id='.$id)
                ->select();
        //echo $m3->getLastSql();
        //var_dump($r1);
        $this->assign('r1',$r1);

        //查询短评
        $m3 = M('s_r');
        $r2 = $m3->table('bee_user u,bee_s_r s')
                 ->field('u.name,s.*')
                 ->where('s.show=1 and u.id=s.u_id and s.m_id='.$id)
                 ->select();
        var_dump($r2);
        $this->display();
    }
    //用户发表长评论
    public function longComment(){
        //接收影片ID
        $id = $_GET['id'];
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

        $this->display();
    }
    public function dolongComment(){
        // var_dump($_SESSION);
        // var_dump(time());
        $id=$_POST['m_id'];
        $_POST['u_id']=$_SESSION['home']['user_id'];
        $_POST['time']=time();
        //var_dump($_POST);

        $m = M('l_r');
        if($m->add($_POST)){
            $this->success('评论成功',U('movie/detail',"id=$id"));
        }else{
            $this->error('评论失败');
        }
    }
    public function commentDetail(){
        $this->display();
    }

    public function dosortComment(){
        $id=$_POST['m_id'];
        $_POST['u_id']=$_SESSION['home']['user_id'];
        $_POST['time']=time();
        //var_dump($_POST);

        $m = M('s_r');
        if($m->add($_POST)){
            $this->success('评论成功',U('movie/detail',"id=$id"));
        }else{
            $this->error('评论失败');
        }
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
