<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class StaffmanagementController extends Controller {
	public function staff_select(){
		$code="";
		if(isset($_GET["YW_User_Rank"])){
			$YW_User_Rank=$_GET["YW_User_Rank"];
			$YW_User_Rank=$YW_User_Rank+1;
			$user_u = M('staff_u');				//实例化用户表
  		  	$condition['YW_User_Rank'] = $YW_User_Rank;
    		// 把查询条件传入查询方法
    		$user_u->field('YW_User_ID,YW_User_Rank,YW_Staff_Name,YW_Staff_HeadPic,YW_Staff_Sex,YW_User_Phone,YW_User_Name');
    		$managementarr=$user_u->where($condition)->select(); 
//			echo "<pre/>";
//			print_r($managementarr);
			if($managementarr==null){
				$code="1004";
			}
			$YW_User_Rank=$YW_User_Rank-1;
		}else{
    		$code="1005";
    	}
		
		if(IS_AJAX){
			$data['code']  = $code;
			$data['managementarr'] = $managementarr;
			$data['YW_User_Rank'] = $YW_User_Rank;
			$this->ajaxReturn($data);
		}else{
			$this->assign("code",$code);
			$this->assign("managementarr",$managementarr);
			$this->assign("YW_User_Rank",$YW_User_Rank);
	  	  	$this->display();
		}
		
	}
	public function staff_delete(){
		$code="";
		if(isset($_GET["YW_User_ID"])){
			$YW_User_ID=$_GET["YW_User_ID"];
			//echo $YW_User_ID;
			$yw_user = M('yw_user');
   			$yw_user->where('YW_User_ID='.$YW_User_ID);
			
			$yw_user->field('YW_User_Rank');
			$YW_User_Rank=$yw_user->where($condition)->select(); 
			$YW_User_Rank1=$YW_User_Rank[0]["yw_user_rank"];
			//echo $YW_User_Rank1;
			
			$yw_user = M('yw_user');
   			$yw_user->where('YW_User_ID='.$YW_User_ID);
			
			if($yw_user->delete()){
				$code="1000";
			}else{
				$code="1001";
			}
		}else{
			$code="1005";
		}
		//echo $code;
		if(IS_AJAX){
			$data['code']  = $code;
			$data['YW_User_Rank'] = $YW_User_Rank1;
			$this->ajaxReturn($data);
		}else{
			$this->assign("code",$code);
			$this->assign("YW_User_Rank",$YW_User_Rank1);
	  	  	$this->display("staff_select");
		}
	}
	public function staff_value(){
		$code="";
		if(isset($_GET["YW_User_Rank"])){
			$YW_User_Rank=$_GET["YW_User_Rank"]+1;
			//echo $YW_User_Rank;
		}else{
			$code="1005";
		}
		if(IS_AJAX){
			$data['code']  = $code;
			$data['YW_User_Rank'] = $YW_User_Rank;
			$this->ajaxReturn($data);
		}else{
			$this->assign("code",$code);
			$this->assign("YW_User_Rank",$YW_User_Rank);
	  	  	$this->display("staff_register");
		}
	}
	public function staff_register(){
		$code="";
		if(isset($_GET["YW_User_Name"]) && isset($_GET["YW_User_Password"]) && isset($_GET["YW_User_Phone"]) && isset($_GET["YW_User_Rank"]) && isset($_GET["YW_Staff_Name"])){
			$YW_User_Phone="";
			$YW_User_Name=$_GET["YW_User_Name"];
			$YW_User_Password=$_GET["YW_User_Password"];
			$YW_User_Phone=$_GET["YW_User_Phone"];
			$YW_User_Rank=$_GET["YW_User_Rank"];
			$YW_Staff_Name=$_GET["YW_Staff_Name"];
			$User = M("yw_user"); // 实例化User对象
			$condition['YW_User_Name'] = $YW_User_Name;// 把查询条件传入查询方法
    		$managementarr=$User->where($condition)->select(); 
			if($managementarr==null){
				$data['YW_User_Name'] = $YW_User_Name;
		    	$data['YW_User_Password'] = $YW_User_Password;
				$data['YW_User_Phone'] = $YW_User_Phone;
		   		$data['YW_User_Rank'] = $YW_User_Rank;
			    if($User->add($data)){
    				$condition['YW_User_Name'] = $YW_User_Name;// 把查询条件传入查询方法
 					$User->field('YW_User_ID');
   				 	$YW_User_ID_arr=$User->where($condition)->select(); 
//					echo "<pre/>";
//					print_r($YW_User_ID_arr);
				    $yw_staff_info = M("yw_staff_info"); // 实例化User对象
				    // 要修改的数据对象属性赋值
//				    echo $YW_Staff_Name."<br/>";
//				    echo $YW_User_ID_arr[0]["yw_user_id"];
				    $data['YW_Staff_Name'] = $YW_Staff_Name;// 根据条件保存修改的数据
				    $yw_staff_info->where('YW_Staff_ID='.$YW_User_ID_arr[0]["yw_user_id"]);// 根据条件更新记录
				    if($yw_staff_info->save($data)==flase){
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
			$data['YW_User_Rank'] = $YW_User_Rank;
			$this->ajaxReturn($data);
		}else{
			$this->assign("code",$code);
			$this->assign("YW_User_Rank",$YW_User_Rank);
	  	  	$this->display("staff_register");
		}
	}
}

