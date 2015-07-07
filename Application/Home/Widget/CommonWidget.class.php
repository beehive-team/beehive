<?php
namespace Home\Widget;
use Think\Controller;
class CommonWidget extends Controller {  
	public function indexHeader(){
		$this->display('Common/indexHeader');
         
    }
	public function commonHead(){
		$this->display('Common/commonHead');

         
    }
}