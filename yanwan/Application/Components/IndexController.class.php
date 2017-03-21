<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function kehu(){/*调用客户数据表*/
    	$index=M('shitu');
    	$cha=$index->select();    	
    	if(isset($_GET['jsoncallback'])){
    		$arr = array(
    				"userinfo" => $cha,
    		);
    		echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
    		exit;
    	}      	
    	if (isset($_GET['id'])){
    		$user = M('shitu');
    	$list=	$user->where("yw_userinfo_id=".$_GET['id'])->find();
    		if(!$list){
    		$this->error("数据错误");	    			
    		}else{    			
    		$this->assign('list',$list);
    	
    	}
    	}    	   	
    	$this->display();
        }
    public function guwen(){ /*调用顾问的数据*/
    	$index=M('yw_staff_info');
    	$cha=$index->select();
    	
    	if(isset($_GET['jsoncallback'])){
    		$arr = array(
    				"userinfo" => $cha,
    		);
    		echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
    		exit;
    	}
    	if (isset($_GET['id'])){
    		$user = M('yw_staff_info');
    		$list=	$user->where("yw_staff_id=".$_GET['id'])->find();
    		//var_dump($list);
    		if(!$list){
    			$this->error("数据错误");
    		}else{
    			$this->assign('list',$list);
    		}
    	}
    	$this->display();
    	}
    public function meirongguwen(){/*美容顾问数据*/
    	$index=M('yw_staff_info');
    	$diao=$index->select();
    	
    	//echo "<pre>";
    	//var_dump($diao);
    	$this->assign('list',$diao);
    	$this->display();
    }
    
   

    
    public function sousuo(){ 
		$User = M('user_u');
		$_GET['field']="YW_User_ID";
		$_GET['searchkey']=$_GET['name'];
		
		//$fieldarr=array('field','searchkey');
		//$this->judge_field($fieldarr);
		if(isset($_GET['searchkey'])){ //因为json方式请求数据都是get方式
			$where=$_GET['field']." like '%".$_GET['searchkey']."%'";
		}else{
			$where=$_GET['field']." like '%".$_POST['searchkey']."%'";
		}
	    $userinfo= $User->where($where)->select();
		//var_dump($userinfo);
		$code=1000;
		if(empty($userinfo)){
			$code=1004;
		}
		print_r($userinfo);
	    //$this->judgeajax($userinfo,$code);
	    $this->assign("code",$code);
	    $this->assign("userinfo",$userinfo);
	    $this->display();
    }
    	
    	
    
}