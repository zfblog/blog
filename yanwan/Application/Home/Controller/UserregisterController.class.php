<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class UserregisterController extends Controller {
	public function user_register_value(){
		$code="";
		if(IS_AJAX){
			$data['code']  = $code;
			$this->ajaxReturn($data);
		}else{
			$this->assign("code",$code);
	  	  	$this->display("user_register");
		}
	}
	public function user_register(){
		$code="";
		if(isset($_GET["YW_User_Name"]) && isset($_GET["YW_User_Password"]) && isset($_GET["YW_User_Phone"]) && isset($_GET["YW_User_Card_Rank"]) && isset($_GET["YW_Staff_Name"])){
			$YW_User_Phone="";
			$YW_User_Name=$_GET["YW_User_Name"];
			$YW_User_Password=$_GET["YW_User_Password"];
			$YW_User_Phone=$_GET["YW_User_Phone"];
			$YW_User_Card_Rank=$_GET["YW_User_Card_Rank"];
			$YW_Staff_Name=$_GET["YW_Staff_Name"];
			$User = M("yw_user"); // 实例化User对象
			$condition['YW_User_Name'] = $YW_User_Name;// 把查询条件传入查询方法
    		$managementarr=$User->where($condition)->select(); 
			if($managementarr==null){
				$data['YW_User_Name'] = $YW_User_Name;
		    	$data['YW_User_Password'] = $YW_User_Password;
				$data['YW_User_Phone'] = $YW_User_Phone;
		   		$data['YW_User_Rank'] = "0";
			    if($User->add($data)){
    				$condition['YW_User_Name'] = $YW_User_Name;// 把查询条件传入查询方法
 					$User->field('YW_User_ID');
   				 	$YW_User_ID_arr=$User->where($condition)->select(); 
//					echo "<pre/>";
//					print_r($YW_User_ID_arr);
				    $yw_user_info = M("yw_user_info"); // 实例化User对象
				    // 要修改的数据对象属性赋值
//				    echo $YW_Staff_Name."<br/>";
//				    echo $YW_User_ID_arr[0]["yw_user_id"];
				    $data['YW_User_Name'] = $YW_Staff_Name;
				     $data['YW_User_Card_Rank'] = $YW_User_Card_Rank;// 根据条件保存修改的数据
				    $yw_user_info->where('YW_User_ID='.$YW_User_ID_arr[0]["yw_user_id"]);// 根据条件更新记录
				    if($yw_user_info->save($data)==flase){
				    	$code="1001";
				    } else{
				    	$code="1000";
				    }
			    }else{
			    	$code="1001";
			    }
			}else{
				$code="1002";
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
	  	  	$this->display("user_register");
		}
	}
}

