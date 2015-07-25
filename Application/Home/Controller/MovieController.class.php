<?php
namespace Home\Controller;
class MovieController extends CommonController {
    public function index(){
        //查询显示广告
        $adlist = $this->ad(0);
        $this->assign('adlist',$adlist);
        

        //实例化分类表
        $m = M('mclassify');
        $list=$m->where("path='0,1,'")->select();
        //var_dump($list);
        $this->assign('list',$list);

        $row = $m->table('bee_movie m,bee_mimage i')->field('m.name mname,m.score,i.*')->where('m.id=i.m_id and m.crelease_t>1411056000 and is_cover=1')->select();
        //var_dump($row);
        $this->assign('row',$row);
        //根据评分查询
        $m = M('movie');
        $r = $m->field('id,name,score,orelease_t')->order('score desc')->limit(7)->select();
        //var_dump($r);
        $this->assign('r',$r);
        //热度电影查询
        $m = M('movie');
        $r2 = $m->field('id,name,orelease_t')->order('hot desc')->limit(3)->select();
        //var_dump($r2);
        $this->assign('r2',$r2);
        //最受欢迎的影评
        $m1=M('l_r');
        $r1 = $m1->table('bee_l_r')->order('hot desc')->limit(3)->select();
        //echo $m1->getLastSql();
        $arr = array();
        foreach ($r1 as $key => $value) {
            $r_id =$r1[$key]['id'];
            $m = M('l_r');
            $arr[] = $res = $m->table('bee_mimage i,bee_user u,bee_l_r l,bee_movie m')
                ->field('i.*,u.name uname,m.name mname,l.content,l.title,l.id lid,l.u_id')
                ->where('l.m_id=m.id and l.u_id=u.id and is_cover=1 and l.m_id=i.m_id and l.id='.$r_id)
                ->find();
        }
        //var_dump($arr);
        $this->assign('arr',$arr);
        //var_dump($r1);
        $this->assign('r1',$r1);

        $this->display();
    }
    public function chose(){
        //查询显示广告
        $adlist = $this->ad(0);
        $this->assign('adlist',$adlist);

        //实例化分类表
        $m = M('mclassify');
        $list=$m->where("path='0,1,'")->select();
        //var_dump($list);
        $this->assign('list',$list);

        $m = M('movie');
        $r = $m->field('id,name,score,orelease_t')->order('score desc')->limit(7)->select();
        //var_dump($r);
        $this->assign('r',$r);

    	$this->display();
    }
    public function ranking(){
        //查询显示广告
        $adlist = $this->ad(0);
        $this->assign('adlist',$adlist);

        //电影热度查询
        $m= M('movie');
        $lis = $m->table('bee_movie m,bee_mimage i')->field('m.alias,m.score,m.director,m.writer,m.name mname,m.orelease_t,i.*')->where('m.id=i.m_id and i.is_cover=1')->order('hot desc')->limit(5)->select();
        //var_dump($lis);
        $this->assign('lis',$lis);

        //根据评分查询
        $m = M('movie');
        $r = $m->field('id,name,score,orelease_t')->order('score desc')->limit(7)->select();
        //var_dump($r);
        $this->assign('r',$r);
    	$this->display();
    }
    public function comment(){
        //查询显示广告
        $adlist = $this->ad(0);
        $this->assign('adlist',$adlist);

        //最受欢迎的影评
        $m1=M('l_r');
        $r1 = $m1->table('bee_l_r')->order('hot desc')->limit(5)->select();
        //echo $m1->getLastSql();
        $arr = array();
        foreach ($r1 as $key => $value) {
            $r_id =$r1[$key]['id'];
            $m = M('l_r');
            $arr[] = $res = $m->table('bee_mimage i,bee_user u,bee_l_r l,bee_movie m')
                ->field('i.*,u.name uname,m.name mname,l.content,l.title,l.id lid,l.u_id')
                ->where('l.m_id=m.id and l.u_id=u.id and is_cover=1 and l.m_id=i.m_id and l.id='.$r_id)
                ->find();
        }
        //var_dump($arr);
        $this->assign('arr',$arr);
    	$this->display();
    }
    public function detail(){        
        //查询显示广告
        $adlist = $this->ad(0);
        $this->assign('adlist',$adlist);

        $adblist = $this->ad(1);
        $this->assign('adblist',$adblist);

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
        // echo $this->userId;

        if($this->ifLike($id,'movie',$this->userId,$this->userId)){
            $like = 1;

        }else{
            $like=0;
        }
        // echo $like;
        $this->assign('u_id',$this->userId);
        $this->assign('like',$like);
        $this->assign('r',$r);

        //查询长评

        $m3=M('l_r');
        $r1 = $m3->table('bee_user u,bee_l_r l')
                ->field('u.name,l.*')
                ->where('l.show=1 and u.id=l.u_id and l.m_id='.$id)
                ->limit(5)
                ->select();
        //echo $m3->getLastSql();
        //var_dump($r1);
        $r6 = $m3->table('bee_user u,bee_l_r l')
                ->field('u.name,l.*')
                ->where('l.show=1 and u.id=l.u_id and l.m_id='.$id)
                ->count();
        //var_dump($r6);

        //循环遍历 计算grade的值总和
        foreach($r1 as $key=>$val){
            //var_dump($val['grade']);
             $sum += $val['grade'];
        }
        //var_dump($sum);
        $data['score']=floor($sum/$r6*10)/10;
        //根据分数对应相应的打分 $star控制css的类
        if($data['score']>=0 && $data['score']<=1){
            $star = '10';
        }elseif($data['score']>=1 && $data['score']<=1.5){
            $star = '15';
        }elseif($data['score']>1.5 && $data['score']<=2.0){
            $star = '20';
        }elseif($data['score']>2.0 && $data['score']<=2.5){
            $star = '25';
        }elseif($data['score']>2.5 && $data['score']<=3.0){
            $star = '30';
        }elseif($data['score']>3.0 && $data['score']<=3.5){
            $star = '35';
        }elseif($data['score']>3.5 && $data['score']<=4.0){
            $star = '40';
        }elseif($data['score']>4.0 && $data['score']<=4.5){
            $star = '45';
        }elseif($data['score']>4.5 && $data['score']<=5.0){
            $star = '50';
        }
        $data['star']=$star;
        //var_dump($star);
        $data['count']=$r6; 
        //echo ceil($r6);
        //var_dump($data);     
        $mov = M('movie');
        $mov->where("id=$id")->field('score')->save($data);
        //var_dump($data);
        $this->assign('data',$data);
        $this->assign('r1',$r1);

        //查询短评
        $m3 = M('s_r');
        $r2 = $m3->table('bee_user u,bee_s_r s')
                 ->field('u.name,s.*')
                 ->where('s.show=1 and u.id=s.u_id and s.m_id='.$id)
                 ->limit(5)
                 ->select();
        //var_dump($r2);
        $this->assign('r2',$r2);

        //查询想看的用户
        $m4 = M('s_r');
        //统计没看过的人数目
        $r4 = $m4->table('bee_user u,bee_s_r s')
                 ->field('u.name,s.time')
                 ->where('s.show=1 and statut=0 and u.id=s.u_id and s.m_id='.$id)
                 ->count();
        //var_dump($r4);
        $this->assign('r4',$r4);
        //统计看过的人数目
        $r5 = $m4->table('bee_user u,bee_s_r s')
                 ->field('u.name,s.time')
                 ->where('s.show=1 and statut=1 and u.id=s.u_id and s.m_id='.$id)
                 ->count();
        //var_dump($r5);
        $this->assign('r5',$r5);       
        //查询想看的用户名字 时间
        $r3 = $m4->table('bee_user u,bee_s_r s')
                 ->field('u.name,s.time')
                 ->where('s.show=1 and statut=0 and u.id=s.u_id and s.m_id='.$id)
                 ->group('u_id')->limit(3)
                 ->select();       
        //var_dump($r3);
        $this->assign('r3',$r3);
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
        $id = $_GET['id'];
        $m = M('l_r');
        $list = $m->table('bee_user u,bee_l_r l')
                 ->field('u.name,l.*')
                 ->where('l.show=1 and u.id=l.u_id and l.id='.$id)
                 ->find();
        var_dump($list);
        $this->assign('list',$list);

        $mid = $_GET['mid'];
         $m = M('movie');
        //进行多表联合查询
        $list1 = $m->table('bee_movie m,bee_mimage i,bee_mclassify f,bee_m_c c')
                ->field('m.*,i.name iname,i.m_id imid,i.i_path,i.is_cover,f.id fid,f.name fname,c.m_id cmid,c.c_id')
                ->where('m.id=i.m_id and i.is_cover=1 and m.id=c.m_id and c.c_id=f.id and m.id='.$mid)
                ->select();
                //var_dump($list1);exit;
        $tmp = [];
        //将其他数组的fname写入第一个数组
        for($i = 0; $i<count($list1); $i++){
            
            $tmp[] = $list1[$i]['fname'];
        }
        $list1[0]['fname'] = $tmp;
        //转换时间格式
        $list1[0]['crelease_t']=date('Y-m-d',$list1[0]['crelease_t']);
        $list1[0]['orelease_t']=date('Y-m-d',$list1[0]['orelease_t']);
        //echo count($list1[0]['fname']);
        //var_dump($list1[0]);
        $this->assign('list1',$list1[0]);
        $this->assign('u_id',$this->userId);

        $this->display();
    }
    public function alllongComment(){
        $id = $_GET['id'];
        //查询长评表
        $m3 = M('l_r');
        $r1 = $m3->table('bee_user u,bee_l_r l')
                ->field('u.name,l.*')
                ->where('l.show=1 and u.id=l.u_id and l.m_id='.$id)
                ->limit()
                ->select();
        //var_dump($r1);
        $this->assign('r1',$r1);

        $m = M('movie');
        //进行多表联合查询
        $list1 = $m->table('bee_movie m,bee_mimage i,bee_mclassify f,bee_m_c c')
                ->field('m.*,i.name iname,i.m_id imid,i.i_path,i.is_cover,f.id fid,f.name fname,c.m_id cmid,c.c_id')
                ->where('m.id=i.m_id and i.is_cover=1 and m.id=c.m_id and c.c_id=f.id and m.id='.$id)
                ->select();
                //var_dump($list1);exit;
        $tmp = [];
        //将其他数组的fname写入第一个数组
        for($i = 0; $i<count($list1); $i++){
            
            $tmp[] = $list1[$i]['fname'];
        }
        $list1[0]['fname'] = $tmp;
        //转换时间格式
        $list1[0]['crelease_t']=date('Y-m-d',$list1[0]['crelease_t']);
        $list1[0]['orelease_t']=date('Y-m-d',$list1[0]['orelease_t']);
        //echo count($list1[0]['fname']);
        //var_dump($list1[0]);
        $this->assign('list1',$list1[0]);

        $this->display();
    }

    public function doshortComment(){
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

    public function allshortComment(){
        $id=$_GET['id'];
        //echo $id;exit;
        //查询短评
        $m3 = M('s_r');
        $r2 = $m3->table('bee_user u,bee_s_r s')
                 ->field('u.name,s.*')
                 ->where('s.show=1 and u.id=s.u_id and s.m_id='.$id)
                 ->limit()
                 ->select();
        //var_dump($r2);
        $this->assign('r2',$r2);

        $m = M('movie');
        //进行多表联合查询
        $list1 = $m->table('bee_movie m,bee_mimage i,bee_mclassify f,bee_m_c c')
                ->field('m.*,i.name iname,i.m_id imid,i.i_path,i.is_cover,f.id fid,f.name fname,c.m_id cmid,c.c_id')
                ->where('m.id=i.m_id and i.is_cover=1 and m.id=c.m_id and c.c_id=f.id and m.id='.$id)
                ->select();
                //var_dump($list1);exit;
        $tmp = [];
        //将其他数组的fname写入第一个数组
        for($i = 0; $i<count($list1); $i++){
            
            $tmp[] = $list1[$i]['fname'];
        }
        $list1[0]['fname'] = $tmp;
        //转换时间格式
        $list1[0]['crelease_t']=date('Y-m-d',$list1[0]['crelease_t']);
        $list1[0]['orelease_t']=date('Y-m-d',$list1[0]['orelease_t']);
        //echo count($list1[0]['fname']);
        //var_dump($list1[0]);
        $this->assign('list1',$list1[0]);

        $this->display();
    }
    //点击有用 ajax改变短评表hot字段
    public function sCommentUseful(){
        $id = $_POST['s_id'];
        //echo $id;
        $m = M('s_r');
        $m->where("id=$id")->setInc('hot','1');
        $list = $m->where("id=$id")->find();
        //var_dump($list);
        echo json_encode($list);
    }
    public function lCommentUseful(){
        $id = $_POST['l_id'];
        $m = M('l_r');
        $m->where("id=$id")->setInc('hot','1');
        $list1 = $m->where("id=$id")->find();
        //var_dump($list1);
        echo json_encode($list1);
        
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
    public function moreComment(){
        //接收参数 每次查的条数
        $i=$_POST['num'];
        //查询评论
        $m1=M('l_r');
        $r1 = $m1->table('bee_l_r')->order('hot desc')->limit($i)->select();
        //echo $m1->getLastSql();
        $arr = array();
        foreach ($r1 as $key => $value) {
            $r_id =$r1[$key]['id'];
            $m = M('l_r');
            $res = $m->table('bee_mimage i,bee_user u,bee_l_r l,bee_movie m')
                ->field('i.*,u.name uname,m.name mname,l.content,l.title,l.id lid,l.u_id')
                ->where('l.m_id=m.id and l.u_id=u.id and is_cover=1 and l.m_id=i.m_id and l.id='.$r_id)
                ->find();
            // $res['content']= mb_substr($res['content'], 0,56);
            //var_dump($res);
            $arr[] = $res;

        }
        //var_dump($arr);
        echo json_encode($arr);
    }

    public function moreRanking(){
        $i=$_POST['num'];
        $m= M('movie');
        $lis = $m->table('bee_movie m,bee_mimage i')->field('m.alias,m.score,m.director,m.writer,m.name mname,m.orelease_t,i.*')->where('m.id=i.m_id and i.is_cover=1')->order('hot desc')->limit($i)->select();

        //var_dump($lis);
        foreach($lis as $val){
            $val['orelease_t'] = date('Y-m-d',$val['orelease_t']);
            $li[] = $val;
          
        }
        //var_dump($li);
        echo json_encode($li);
    }
    /*public function addcomment(){
       
        $_POST['time']=time();
        var_dump($_POST['time']=time());
        var_dump($_POST);

        $m = M('m_replay');
       if($m->add($_POST)){
            $this->success('评论成功');
       }else{
            $this->error('评论失败');
       }
    }*/
}
