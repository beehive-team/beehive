<?php
namespace Home\Controller;
class DiaryController extends CommonController {

    protected $faceName;
    protected $facePath;
    protected $time;
    protected $arr = array();
    protected $replay = array();

    public function _initialize(){
        
        
        $this->userId = $_SESSION['home']['user_id'];
        $this->p_id = $_GET['p_id'];
        $this->time=time();
        $this->relationship($this->userId,$this->p_id);
    }
    
    //显示日记首页
    public function diary(){

        $model = D('DiaryView');

        switch ($this->relation) {
            case '2':  //是本人
                $where['u_id']=$this->userId;
                $status = 'me';
                $where['browse'] =array(ELT,'2');       
                break;
            
            case '1':
                $where['u_id']=$this->p_id;
                $status = 'other';
                $where['browse']=array(ELT,'1');
                break;

            case '0':

                $where['u_id'] = $this->p_id;
                $status = 'other';
                $where['browse'] = array(EQ,'0');
                break;
        }

         // var_dump($where);
        $diary = M('diary');
        $count =$diary->where($where)->count();
        // echo $model->getLastsql();
        $Page = new \Think\Page($count,4);
        $show = $Page->show();
        // echo $count;
        $data = $model->field('diaryid,title,content,u_id,content,time,power,browse,hot')->where($where)->group('diaryid')->limit($Page->firstRow.','.$Page->listRows)->select();
        // echo $model->getLastsql();
      
        // var_dump($data);
        
        


        foreach($data as $key=>$value){
            $tag = array();
            $data[$key]['content'] = strip_tags($data[$key]['content']);
            $did = $data[$key]['diaryid'];
            $tag[] = $model->field('name')->where("d_id=$did")->select();
            $data[$key]['tag'] = $tag;
            $data[$key]['tag'] = $data[$key]['tag'][0];

            switch ($data[$key]['browse']) {
                case '1':
                    $data[$key]['browse']='仅朋友可见';
                    break;
                case '0':
                    $data[$key]['browse']='所有人可见';
                    break;
                case '2':
                    $data[$key]['browse']='仅自己可见';
                    break;
                
            }
            switch ($data[$key]['power']) {
                case '1':
                    $data[$key]['power'] = '不能回应';
                    break;
                
                case '0' :
                    $data[$key]['power'] = '<a href="">回应</a>';
                    break;
            }

            if($this->ifLike($data[$key]['diaryid'],'diary',$this->userId,$this->p_id)){
                $data[$key]['like']=1;

            }
        }
    
       
        // var_dump($data);
        $this->assign('p_id',$this->p_id);
        $this->assign('u_id',$this->userId);
        $this->assign('status',$status);

        $this->assign('page',$show);
        $this->assign('data',$data);
        // var_dump($data);
        $this->display();

    }

    //显示写日记
    public function writeDiary(){

        $this->display();

    }

    //执行写日记提交后的东西
    public function doDiary(){
        $arr = array();
        //var_dump($_POST);
        $data =$_POST;
        if(empty($data['power'])){
            $data['power']='0';
        }
        if(empty($data['tolist'])){
            $data['tolist']='0';
        }
        
        $tags = $data['tags'];
        unset($data['tags']);
        
        
        $data['ctime'] = $this->time;
        // var_dump($data);
        
        $tags = explode(' ',$tags);
       // var_dump($tags);
        $model = M('dtag');
        $id_arr = array();
        for($i = 0;$i<count($tags);$i++){
            
            $arr['name'] = $tags[$i];
            if(!$id = $model->where($arr)->getField('id')){
                $insert_id = $model->add($arr);
                // echo $insert_id;
                array_push($id_arr,$insert_id);
            }else{
                $hot = $model->where($arr)->getField('hot');
                $hot++;
                $model->where($arr)->setField('hot',$hot);
                array_push($id_arr,$id);
            }
        }

        $diary = D('diary');
        $data = $diary->create($data);
        //var_dump($data);
        // var_dump($id_arr);
        $data['u_id'] = $this->userId;
        if($d_id = $diary->add($data)){
                
            $dtarr = array();
            $model= M('d_t');
            for($i=0;$i<count($id_arr);$i++){
                
                $dtarr['d_id'] = $d_id;
                $dtarr['t_id'] = $id_arr[$i];
                $model->add($dtarr);
            }
            
            if($data['power']=='0'){
                $this->trend('diary',$this->time,$d_id);
            }
            $this->success('日记发表成功',U("diary?p_id=$this->userId"));


        }else{
            $this->error('日记发表失败,请重试');
        }        

    }


    // 递归找到回应的父集
    public function getReplayParent($id){
        $model = M('d_replay');
        $r = $model->where("id=$id")->find();
        $r_id = $r['r_id'];
        $par_id = $r['id'];
        array_push($this->arr,$par_id);
       
        if($r_id==0){
            // echo $par_id
            $this->replay = $this->arr;
            // var_dump($this->arr);
            $this->arr = array();
            
        }else{
            
            $this->getReplayParent($r_id);

        }


    }


    // 显示日记详情
    public function diaryDetail(){
        $diary_id = $_GET['id'];
        $model = D('diaryView');

        $data = $model->field('diaryid,title,content,u_id,content,time,power,browse,hot,update_time')->where("diary.id=$diary_id")->find();

        // var_dump($data);
        
        switch ($this->relation) {
            case '2':  //是本人
                
                $status = 'me';
                      
                break;
            
            case '1':
               
                $status = 'other';
             
                break;

            case '0':

           
                $status = 'other';
               
                break;
        }
        $this->assign('status',$status);
        $tag = array();
        
        $did = $data['diaryid'];
        // echo $did;
        $tag[] = $model->field('name')->where("d_id=$did")->select();
        $data['tag'] = $tag;
        // var_dump($tag);
        $data['tag'] = $data['tag'][0];

        switch ($data['browse']) {
            case '1':
                $data['browse']='仅朋友可见';
                break;
            case '0':
                $data['browse']='所有人可见';
                break;
            case '2':
                $data['browse']='仅自己可见';
                break;
            
        }
        switch ($data['power']) {
            case '1':
                $data['power'] = '不能回应';
                $power = 0;
                break;
            
            case '0' :
                $data['power'] = '<a href="">回应</a>';
                $power=1;
                break;
        }
        // echo $this->p_id;
        if($this->ifLike($data['diaryid'],'diary',$this->userId,$this->p_id)){
            $data['like']=1;

        }
        
        if($power==1){
            $model = M('d_replay');
            $replay=$model->field('u_id,r_id,d_id,image,name,r.time,content,r.id')->table('bee_user u,bee_d_replay r')->where("r.d_id=$diary_id and u.id=r.u_id")->order('time')->select();
            // var_dump($replay);
            foreach ($replay as $key => $value) {

                if($replay[$key]['r_id']!=0){

                    // echo $replay[$key]['r_id'];
                    
                    $this->getReplayParent($replay[$key]['r_id']);
                    $replay_info = $this->replay;
                    
                    foreach ($replay_info as $k => $v) {
                        // echo $value;
                       $m = M('d_replay');
                        $result=$model->field('u_id,r_id,d_id,image,name,r.time,content,r.id')->table('bee_user u,bee_d_replay r')->where("u.id=r.u_id and r.id=$v")->find();
                       
                       // var_dump($result);
                       $replay[$key]['parent'][] = $result ;
                    }
                    
                }
            }
            // var_dump($replay);

            $this->assign('replay',$replay);
        }



        $u_id = $data['u_id'];
        $model = D('user');
        $user = $model->field('image,name')->where("id=$u_id")->find();
        $data['user'] = $user;
        // var_dump($data);

        $this->assign('diary',$data);
        $this->assign('power',$power);
        $this->display();
    }


    

    //返回当前日记的标签
    public function getTag(){
        $diaryid = $_POST['diaryId'];
        $model = D('DiaryView');
        $result =$model->field('name,tagId')->where("diary.id=$diaryid")->select();

        $this->ajaxReturn($result);
    }


    // 修改当前日记的标签
    public function modifyTag(){
        $arr = array();
        $data = $_POST;
        $d_id = $_POST['diaryId'];
        // var_dump($data);
        $tags = $data['tags'];
        $tags = explode(' ',$tags);
        $model = M('dtag');
        $id_arr = array();
        for($i = 0;$i<count($tags);$i++){
            
            $arr['name'] = $tags[$i];
            if(!$id = $model->where($arr)->getField('id')){
                $insert_id = $model->add($arr);
                // echo $insert_id;
                array_push($id_arr,$insert_id);
            }else{
                $hot = $model->where($arr)->getField('hot');
                $hot++;
                $model->where($arr)->setField('hot',$hot);
                array_push($id_arr,$id);
            }
        }
        // var_dump($id_arr);

        $dtarr = array();
        $model= M('d_t');
        $model->where("d_id=$d_id")->delete();
        for($i=0;$i<count($id_arr);$i++){
            $dtarr['d_id'] = $d_id;
            $dtarr['t_id'] = $id_arr[$i];
            $model->add($dtarr);
        }
    }

    // 修改日记页面显示
    public function modifyDiary(){
        $diaryId = $_GET['id'];
        $model = M('diary');
        $result = $model->where("id=$diaryId")->find();
        // var_dump($result);
        $this->assign('data',$result);
        $this->display();
    }

    //更新日记
    public function updateDiary(){
        // var_dump($_POST);

        $data = $_POST;
        // if(empty($data['power'])){
        //     $data['power']='0';
        // }
        $id = $data['id'];
        $model = D('diary');
        $data = $model->create($data);
        // var_dump($data);
        
        if($model->where("id=$id")->save()){
            $this->success('修改成功',U('diary'));
        }else{
            $this->error('保存失败');
        }
        
    }

    //删除日记
    public function deleteDiary(){
        $data = $_POST;
        $id = $_GET['id'];
        $model = D('diary');
        if($model->where("id=$id")->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');

        }
    }

    //添加回应
    public function addReplay(){
        // var_dump($_POST);
        $data = $_POST;
        $data['u_id']=$this->userId;
        $data['time'] = $this->time;
        // var_dump($data);
        $d_id = $data['d_id'];
        $diary = M('diary');
        $result = $diary->where("id=$d_id")->find();
        $p_id = $result['u_id'];
        $model = M('d_replay');
        if($model->add($data)){
             //添加提醒
            $this->addTip($p_id,$this->userId,'diary_replay',$d_id,$this->time);

            $this->success('回复成功');
        }

    }


}
