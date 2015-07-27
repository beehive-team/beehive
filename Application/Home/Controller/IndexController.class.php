<?php
namespace Home\Controller;
class IndexController extends CommonController {
    public function index(){
        //图书部分遍历
        $b = M('book');
        $row1 = $b->table('bee_book b,bee_bimage i')->field('b.id bid,b.name bname,b.score,i.*')->where('b.id=i.b_id and b.release_t and is_cover=1')->select();
        //var_dump($row1);
        $this->assign('row1',$row1);
        //根据评分查询
        $b = M('book');
        $r1 = $b->field('id,name,score,release_t')->order('score desc')->limit(7)->select();
        //var_dump($r1);
        $this->assign('r1',$r1);


        //电影部分遍历
        $m = M('movie');
        $row = $m->table('bee_movie m,bee_mimage i')->field('m.id mid,m.name mname,m.score,i.*')->where('m.id=i.m_id and m.crelease_t>1411056000 and is_cover=1')->select();
        //var_dump($row);
        $this->assign('row',$row);
        //根据评分查询
        $m = M('movie');
        $r = $m->field('id,name,score,orelease_t')->order('score desc')->limit(7)->select();
        //var_dump($r);
        $this->assign('r',$r);
        
        //广告查询遍历
        $m1 = M('ad');
        $list_a = $m1->where('style=1')->select();
        //var_dump($list_a);
        $this->assign('list_a',$list_a);

        if(!empty($_SESSION['home'])){
    		$show = 1;
    	}else{
    		$show = 0;
    	}
    	
        $album = M('album');
        $album_result = $album->field('a.name as a_name,p.name as p_name,path,a.id as a_id')->table('bee_album as a,bee_photo as p')->where("a.id=p.a_id and is_cover=1 and browse=0")->order("hot desc")->select();
        // var_dump($album_result);
        $diary = M('diary');
        $diary_result = $diary->field('d.title,d.id as d_id,u.name as u_name,content')->table('bee_diary d,bee_user u')->where("u.id=d.u_id")->order("hot desc")->select();
        $album_result = array_slice($album_result, 0,4);
        foreach( $diary_result as $key=>$value){
            $diary_result[$key]['content']=strip_tags($diary_result[$key]['content']);
        }
        $diary_result = array_slice($diary_result, 0,8);
        $this->assign('show',$show);
        // var_dump($album_result);
        // var_dump($diary_result);

        $this->assign('album',$album_result);
    	$this->assign('diary',$diary_result);
    	$this->display();
    }
}
