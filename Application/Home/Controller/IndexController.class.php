<?php
namespace Home\Controller;
class IndexController extends CommonController {
    public function index(){
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
        $diary_result = array_slice($diary_result, 0,8);
        $this->assign('show',$show);
        // var_dump($album_result);
        // var_dump($diary_result);

        $this->assign('album',$album_result);
    	$this->assign('diary',$diary_result);
    	$this->display();
    }
}