<?php
namespace Home\Model;
use Think\Model;
class AlbumModel extends Model{
    // 字段映射
    protected $_map = array(
        'authority'=>'power',
        'show'=>'browse',
        'bee'=>'tolist', 
        'ctime'=>'time',
        'title'=>'name',
        'user'=>'u_id',
        'content'=>'des'
       
    );
    
    // // 自动验证
    // protected $_validate = array(     
    //     array('name','require','用户名不能为空！'), //默认情况下用正则进行验证
    //     array('password','require','密码必须填写！'), //默认情况下用正则进行验证
    //     array('email','require','密码必须填写！'), //默认情况下用正则进行验证
    //     array('email','/.*@.*/','邮箱格式不正确！'), //默认情况下用正则进行验证
    // );

    //自动完成
    protected $_auto = array(
        array('power','emp',3,'function'),
        array('tolist','emp',3,'function')
    );


    
}

