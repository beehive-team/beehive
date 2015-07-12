<?php
namespace Home\Model;
use Think\Model\ViewModel;
class DiaryViewModel extends ViewModel {
   public $viewFields = array(
        'd_t'=>array('_table'=>'bee_d_t','d_id','t_id'),
        'diary'=>array('id'=>'diaryid','title','u_id','content','time','power','browse','hot','update_time','_table'=>'bee_diary','_on'=>'diary.id=d_t.d_id'),
        'dtag'=>array('id'=>'tagid','name','_on'=>'d_t.t_id=dtag.id')
    );


   protected $_auto = array(
        array('update_time','time',2,'function'),
    );
}