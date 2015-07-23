<?php
namespace Home\Controller;
class BookController extends CommonController {
    public function index(){
    	$b = M('bclassify');
        $list=$b->where("pid>0")->select();
        //var_dump($list);
        $this->assign('list',$list);
        $time = 7*24*3600*1000;
        $date = time();
        $date = $date+$time;
        $row = $b->table('bee_book b,bee_bimage i')->field('b.name bname ,b.writer,i.*')->where("b.id=i.b_id and b.release_t < $date")->select();
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
    public function books(){        
        //获取电影id
        $id=$_GET['id'];
        //echo $id;exit;
        $b = M('book');
        //进行多表联合查询
        $list = $b->table('bee_book b,bee_bimage i,bee_bclassify f,bee_b_c c')
                ->field('b.*,i.name iname,i.b_id ibid,i.i_path,i.is_cover,f.id fid,f.name fname,c.b_id cbid,c.c_id')
                ->where('b.id=i.b_id and i.is_cover=1 and b.id=c.b_id and c.c_id=f.id and b.id='.$id)
                ->select();
                //var_dump($list);
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

        //查询年份  非封面图片
        // $b1 = M('book');
        // $row= $b1->table('bee_book b,bee_bimage i,bee_bclassify f')
        //         ->field('b.country,i.name iname,i.b_id,i.i_path,f.name')
        //         // ->where('b.year=f.id and i.is_cover=0 and b.id=i.b_id and b.id='.$id)
        //         ->select();
        // //var_dump($row);
        // $this->assign('row',$row);
        //查询国家
        $b2=M('book');
        $r = $b2->table('bee_book b,bee_bclassify f ')->field('f.name')->where('f.id=b.writer and b.id='.$id)->find();
        $b2->getLastSql();
        //var_dump($r);
        $this->assign('r',$r);
         

        //查询长评

        $b3=M('l_b');
        $r1 = $b3->table('bee_user u,bee_l_b l')
                ->field('u.name,l.*')
                ->where('l.show=1 and u.id=l.u_id and l.b_id='.$id)
                ->limit(5)
                ->select();
        //echo $b3->getLastSql();
        //var_dump($r1);
        $this->assign('r1',$r1);

        //查询短评
        $b3 = M('s_b');
        $r2 = $b3->table('bee_user u,bee_s_b s')
                 ->field('u.name,s.*')
                 ->where('s.show=1 and u.id=s.u_id and s.b_id='.$id)
                 ->limit(5)
                 ->select();
        //var_dump($r2);
        $this->assign('r2',$r2);
        $this->display();

    }
    public function comment(){
    	$this->display();
    }
    public function longComment(){
        //接收影片ID
        $id = $_GET['id'];
         $b = M('book');
        //进行多表联合查询
        $list = $b->table('bee_book b,bee_bimage i,bee_bclassify f,bee_b_c c')
                ->field('b.*,i.name iname,i.b_id ibid,i.i_path,i.is_cover,f.id fid,f.name fname,c.b_id cbid,c.c_id')
                ->where('b.id=i.b_id and i.is_cover=1 and b.id=c.b_id and c.c_id=f.id and b.id='.$id)
                ->select();
                //var_dump($list);
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

        $this->display();
    }
    public function dolongComment(){
        // var_dump($_SESSION);
        // var_dump(time());
        $id=$_POST['b_id'];
        $_POST['u_id']=$_SESSION['home']['user_id'];
        $_POST['time']=time();
        // var_dump($_POST);exit;

        $b = M('l_b');
        if($b->add($_POST)){
            $this->success('评论成功',U('book/books',"id=$id"));
        }else{
            $this->error('评论失败');
        }
    }

    public function lCommentUseful(){
        $id = $_POST['l_id'];
        $b = M('l_b');
        $b->where("id=$id")->setInc('hot','1');
        $list1 = $b->where("id=$id")->find();
        //var_dump($list1);
        echo json_encode($list1);
        
    }

    public function sCommentUseful(){
        $id = $_POST['s_id'];
        //echo $id;
        $b = M('s_b');
        $b->where("id=$id")->setInc('hot','1');
        $list = $b->where("id=$id")->find();
        //var_dump($list);
        echo json_encode($list);
    }

    public function dosortComment(){
        $id=$_POST['b_id'];
        // echo $id;exit;
        $_POST['u_id']=$_SESSION['home']['user_id'];
        $_POST['time']=time();
        // var_dump($_POST);

        $b = M('s_b');
        if($b->add($_POST)){
            $this->success('评论成功',U('book/books',"id=$id"));
        }else{
            $this->error('评论失败');
        }
    }



    public function commentDetail(){
        $id = $_GET['id'];
        $b = M('l_b');
        $list = $b->table('bee_user u,bee_l_b l')
                 ->field('u.name,l.*')
                 ->where('l.show=1 and u.id=l.u_id and l.id='.$id)
                 ->find();
        //var_dump($list);
        $this->assign('list',$list);

        $bid = $_GET['bid'];
         $b = M('book');
        //进行多表联合查询
        $list1 = $b->table('bee_book b,bee_bimage i,bee_bclassify f,bee_b_c c')
                ->field('b.*,i.name iname,i.b_id ibid,i.i_path,i.is_cover,f.id fid,f.name fname,c.b_id cbid,c.c_id')
                ->where('b.id=i.b_id and i.is_cover=1 and b.id=c.b_id and c.c_id=f.id and b.id='.$bid)
                ->select();
                //var_dump($list1);exit;
        $tmp = [];
        //将其他数组的fname写入第一个数组
        for($i = 0; $i<count($list1); $i++){
            
            $tmp[] = $list1[$i]['fname'];
        }
        $list1[0]['fname'] = $tmp;
        //转换时间格式
        $list1[0]['release_t']=date('Y-m-d',$list1[0]['release_t']);
        //echo count($list1[0]['fname']);
        //var_dump($list1[0]);
        $this->assign('list1',$list1[0]);

        $id = $_GET['id'];
        $b = M('b_replay');
        $list2 =$b->table('bee_user u,bee_b_replay r,bee_l_b l')
        ->field('r.*,u.name uname')
        ->where('r.u_id=u.id and r.r_id=l.id and r.rc_id=""')
        ->select();
        //var_dump($list2);
        $this->assign('list2',$list2);
        $this->display();
    }


    public function allshortComment(){
        $id=$_GET['id'];
        //echo $id;exit;
        //查询短评
        $b3 = M('s_b');
        $r2 = $b3->table('bee_user u,bee_s_b s')
                 ->field('u.name,s.*')
                 ->where('s.show=1 and u.id=s.u_id and s.b_id='.$id)
                 ->limit()
                 ->select();
        //var_dump($r2);
        $this->assign('r2',$r2);

        $b = M('book');
        //进行多表联合查询
        $list1 = $b->table('bee_book b,bee_bimage i,bee_bclassify f,bee_b_c c')
                ->field('b.*,i.name iname,i.b_id ibid,i.i_path,i.is_cover,f.id fid,f.name fname,c.b_id cbid,c.c_id')
                ->where('b.id=i.b_id and i.is_cover=1 and b.id=c.b_id and c.c_id=f.id and b.id='.$id)
                ->select();
                //var_dump($list1);exit;
        $tmp = [];
        //将其他数组的fname写入第一个数组
        for($i = 0; $i<count($list1); $i++){
            
            $tmp[] = $list1[$i]['fname'];
        }
        $list1[0]['fname'] = $tmp;
        //转换时间格式
        $list1[0]['release_t']=date('Y-m-d',$list1[0]['release_t']);
        //echo count($list1[0]['fname']);
        //var_dump($list1[0]);
        $this->assign('list1',$list1[0]);

        $this->display();
    }

    public function alllongComment(){
        $id = $_GET['id'];
        //查询长评表
        $b3 = M('l_b');
        $r1 = $b3->table('bee_user u,bee_l_b l')
                ->field('u.name,l.*')
                ->where('l.show=1 and u.id=l.u_id and l.b_id='.$id)
                ->limit()
                ->select();
        // var_dump($r1);exit;
        $this->assign('r1',$r1);

        $b = M('book');
        //进行多表联合查询
        $list1 = $b->table('bee_book b,bee_bimage i,bee_bclassify f,bee_b_c c')
                ->field('b.*,i.name iname,i.b_id ibid,i.i_path,i.is_cover,f.id fid,f.name fname,c.b_id cbid,c.c_id')
                ->where('b.id=i.b_id and i.is_cover=1 and b.id=c.b_id and c.c_id=f.id and b.id='.$id)
                ->select();
                //var_dump($list1);exit;
        $tmp = [];
        //将其他数组的fname写入第一个数组
        for($i = 0; $i<count($list1); $i++){
            
            $tmp[] = $list1[$i]['fname'];
        }
        $list1[0]['fname'] = $tmp;
        //转换时间格式
        $list1[0]['release_t']=date('Y-m-d',$list1[0]['release_t']);
        //echo count($list1[0]['fname']);
        //var_dump($list1[0]);
        $this->assign('list1',$list1[0]);

        $this->display();
    }



    public function doshortComment(){
        $id=$_POST['b_id'];
        $_POST['u_id']=$_SESSION['home']['user_id'];
        $_POST['time']=time();
        //var_dump($_POST);

        $b = M('s_b');
        if($b->add($_POST)){
            $this->success('评论成功',U('book/books',"id=$id"));
        }else{
            $this->error('评论失败');
        }
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

    public function addcomment(){
        var_dump($_POST);
        $_POST['time']=time();
        $b = M('b_replay');
        if($b->add($_POST)){
            $this->success('success');
        }else{
            $this->error('falied');
        }
    }
    public function select(){
        $r_id = $_POST['r_id'];
        if(empty($r_id)){
        }else{
            $p = M("b_replay");
            $list = $p->where("rc_id='$r_id'")->find();
            $a = $list['u_id'];
            $b = M("user");
            $list2 = $b->where("id='$a'")->find();
            $list['name'] = $list2['name']; 
            $list['time'] = date("Y-m-d H:i:s",$list['time']);
            echo json_encode($list);
        }
    }
}
