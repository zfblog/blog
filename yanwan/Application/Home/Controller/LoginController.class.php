<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	//登陆控制器---方法
	
    public function login(){
    	$code="";
    	if(isset($_GET["YW_User_Name"]) && isset($_GET["YW_User_Password"])){//判断是否接收到参数
    		$YW_User_Name=$_GET["YW_User_Name"];
			$YW_User_Password=$_GET["YW_User_Password"];
    		$yw_user = M('yw_user');				//实例化用户表
  		  	$condition['YW_User_Name'] = $YW_User_Name;
   		 	$condition['YW_User_Password'] = $YW_User_Password;
    		// 把查询条件传入查询方法
    		$yw_user->field('YW_User_ID,YW_User_Rank');
    		$userarr=$yw_user->where($condition)->select(); 
//			echo "<pre/>";
//			print_r($userarr);
			
			if($userarr!=null){				//判断查询是否为空，如果不为空账户密码正确，否则为错误。
					$code="1000";
			}else{
				$code="1001";
			}
    	}else{
    		$code="1005";
    	}
		session('YW_User_ID',$userarr[0]["YW_User_ID"]);
		if(IS_AJAX){
			$data['code']  = $code;
			$data['userarr'] = $userarr;
			$this->ajaxReturn($data);
		}else{
			$this->assign("code",$code);
			$this->assign("userarr",$userarr);
	  	  $this->display();
		}
    }
	public function forget_password(){
		$code="";
		if(isset($_GET["YW_User_Phone"]) && isset($_GET["YW_User_Password"])){
			$YW_User_Phone=$_GET["YW_User_Phone"];
			$YW_User_Password=$_GET["YW_User_Password"];
			$User = M("yw_user"); // 实例化User对象
    		// 要修改的数据对象属性赋值
    		$data['YW_User_Password'] = $YW_User_Password;
   			$User->where('YW_User_Phone='.$YW_User_Phone);// 根据条件更新记录
   			if($User->save($data)==false){
   				$code="1001";
   			}else{
   				$code="1000";
   			}
		}else{
			$code="1005";
		}
		if(IS_AJAX){
			$data['code']  = $code;
			$this->ajaxReturn($data);
		}else{
			$this->assign("code",$code);
	  	 	$this->display();
		}
	}
	public function update_password(){
		$code="";
		if(isset($_GET["YW_User_Name"]) && isset($_GET["YW_User_Passwordnew"]) && isset($_GET["YW_User_Passwordold"])){
			$YW_User_Name=$_GET["YW_User_Name"];
			$YW_User_Passwordnew=$_GET["YW_User_Passwordnew"];
			$YW_User_Passwordold=$_GET["YW_User_Passwordold"];
			$User = M("yw_user"); // 实例化User对象
    		// 要修改的数据对象属性赋值
				$data['YW_User_Password'] = $YW_User_Passwordnew;
	 			$User->where('YW_User_Name='.$YW_User_Name.' and YW_User_Password='.$YW_User_Passwordold);// 根据条件更新记录
	 			if($User->save($data)==false){
	 				$code="1001";
	 			}else{
	 				$code="1000";
	 			}
		}else{
			$code="1005";
		}
		//echo $code;
		if(IS_AJAX){
			$data['code']  = $code;
			$this->ajaxReturn($data);
		}else{
			$this->assign("code",$code);
	  	 	$this->display();
		}
	}
	
		//用来判断是用的接口还是TP
		public function tp_ro_jsoncallback(){
			session_start();
			$_SESSION["tp_type"] = "1";
			$this->display("login");
			//tp_type用来判断是用的接口还是TP 存在session的话就是用的tp 没有的话用的就是 json数据
		}
}