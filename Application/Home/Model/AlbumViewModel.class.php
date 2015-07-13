<?php
namespace Home\Model;
use Think\Model\ViewModel;
class AlbumViewModel extends ViewModel {
   	public $viewFields = array(
        'album'=>array('id'=>'album_id','name'=>'album_name','des','u_id','power','update_time','time'=>'a_time','browse','tolist','hot'),
        'atag'=>array('id'=>'atag_id','name'=>'atag_name'),
        'a_t'=>array('id'=>'atag_id','a_id','t_id','_on'=>'album_id=a_id','_on'=>'atag.id=t_id'),
        // 'photo'=>array('id'=>'photo_id','name'=>'photo_name','time'=>'p_time','a_id','_on'=>'album.id=photo.a_id')
        
    );
 	protected $_auto = array(
        array('update_time','time',3,'function'),
        array('power','emp',3,'function'),
        array('tolist','emp',3,'function')
    );

   
}