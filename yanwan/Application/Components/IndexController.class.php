<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function kehu(){/*���ÿͻ����ݱ�*/
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
    		$this->error("���ݴ���");	    			
    		}else{    			
    		$this->assign('list',$list);
    	
    	}
    	}    	   	
    	$this->display();
        }
    public function guwen(){ /*���ù��ʵ�����*/
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
    			$this->error("���ݴ���");
    		}else{
    			$this->assign('list',$list);
    		}
    	}
    	$this->display();
    	}
    public function meirongguwen(){/*���ݹ�������*/
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
		if(isset($_GET['searchkey'])){ //��Ϊjson��ʽ�������ݶ���get��ʽ
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