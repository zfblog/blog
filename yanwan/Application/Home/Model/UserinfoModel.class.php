<?php
	namespace Home\Model;
	use Think\Model;
	class UserinfoModel extends Model {
		protected $autoCheckFields =false;
		
		//返回皮肤项目的数组；
		public function return_skintype(){
				$skin= M('yw_skin_data');
				$skindata= $skin->where($where)->select();
				$skintype=array();
				foreach($skindata[0] as $key=>$value){
					if($key!='yw_skin_id'){
						$skintype[$key]=explode(',',$value);
					}
				}
				return $skintype;
		  
		}
		
		//返回员工的肤质相关信息
//		public function return_skininfo($where=''){ 
//		$User = M('user_u'); // 实例化User对象
//       // 把查询条件传入查询方法
//        $userinfo= $User->field("yw_user_id,yw_user_skin_type,yw_user_skin_condition,yw_user_nose_condition,yw_user_neck_condition,yw_user_chin_condition,yw_user_eye_condition")->where($where)->select();
//		//得到皮肤相关数据
//		$skintype=$this->return_skintype();
//		//这是用于多个数据的循环
//       	foreach($userinfo as $fkey=>$fvalue){ 
//			$skinarr=array();
//			//将每个用户美容数据切字符串割成数组
//			$skinarr['yw_user_skin_type']=explode(',',$fvalue['yw_user_skin_type']); 
//			$skinarr['yw_user_skin_condition']=explode(',',$fvalue['yw_user_skin_condition']); 
//			$skinarr['yw_user_nose_condition']=explode(',',$fvalue['yw_user_nose_condition']); 
//			$skinarr['yw_user_neck_condition']=explode(',',$fvalue['yw_user_neck_condition']); 
//			$skinarr['yw_user_chin_condition']=explode(',',$fvalue['yw_user_chin_condition']); 
//			$skinarr['yw_user_eye_condition']=explode(',',$fvalue['yw_user_eye_condition']); 
//		    //循环切割之后皮肤状况数据的数据
//			foreach($skinarr as $skey=>$svalue){ //$svalue的是切割之后单独的数组 $skey代表的是 yw_user_skin_condition 等				
//			    $str='';
//				//循环里面的数据 判断有没有该选项
//				foreach($svalue as $tkey=>$tvalue){//$tvalue的是切割的数组里面的数据 $tkey代表的是数字0,1,2,3等
//					if($tvalue==1){
//						$str.=$skintype[$skey][$tkey]."\n";
//					}
//				}
//				$userinfo[$fkey][$skey]=$str;
//		    }
//		}
//		return  $userinfo;
//	}
	
	public function return_skininfo($userinfo){ //将查询出的数据传入解析成字符串
		$skintype=$this->return_skintype();
		//这是用于多个数据的循环
       	foreach($userinfo as $fkey=>$fvalue){ 
			$skinarr=array();
			//将每个用户美容数据切字符串割成数组
			$skinarr['yw_user_skin_type']=explode(',',$fvalue['yw_user_skin_type']); 
			$skinarr['yw_user_skin_condition']=explode(',',$fvalue['yw_user_skin_condition']); 
			$skinarr['yw_user_nose_condition']=explode(',',$fvalue['yw_user_nose_condition']); 
			$skinarr['yw_user_neck_condition']=explode(',',$fvalue['yw_user_neck_condition']); 
			$skinarr['yw_user_chin_condition']=explode(',',$fvalue['yw_user_chin_condition']); 
			$skinarr['yw_user_eye_condition']=explode(',',$fvalue['yw_user_eye_condition']); 
		    //循环切割之后皮肤状况数据的数据
			foreach($skinarr as $skey=>$svalue){ //$svalue的是切割之后单独的数组 $skey代表的是 yw_user_skin_condition 等				
			    $str='';
				//循环里面的数据 判断有没有该选项
				foreach($svalue as $tkey=>$tvalue){//$tvalue的是切割的数组里面的数据 $tkey代表的是数字0,1,2,3等
					if($tvalue==1){
						$str.=$skintype[$skey][$tkey]."\n";
					}
				}
				$userinfo[$fkey][$skey]=$str;
		    }
		}
		return  $userinfo;
	}
	//得到客户的基本信息
	public function return_userinfo($where=''){ 
		$User = M('user_u'); // 实例化User对象
       // 把查询条件传入查询方法
        $userinfo1= $User->field("yw_user_id,yw_user_headpic,yw_user_name,yw_user_phone,yw_user_card_rank,yw_user_integral,yw_user_id,yw_user_skin_type,yw_user_skin_condition,yw_user_nose_condition,yw_user_neck_condition,yw_user_chin_condition,yw_user_eye_condition")->where($where)->select();
		$userinfo=$this->return_skininfo($userinfo1);
		return $userinfo;
	}
	//查询肤质进展
	public function return_newskin($where=''){ 
		$User = M('yw_userconsume'); // 实例化User对象
       // 把查询条件传入查询方法
        $userinfo= $User->field("YW_User_ID,YW_UserConsume_Type")->where($where)->order('YW_UserConsume_Time desc')->limit(1)->select();
		return  $userinfo;
	}
	
	//返回项目名称和id
	public function return_project(){ 
		$User = M('yw_beautyitemlist_project'); // 实例化User对象
       // 把查询条件传入查询方法YW_Project_ID
        $userinfo= $User->field("YW_Project_ID,YW_Project_Name")->where()->select();
		return  $userinfo;
	}
	public function return_prob(){ 
		$User = M('yw_beautyitemlist_largeclass'); // 实例化User对象
       // 把查询条件传入查询方法YW_Project_ID
        $userinfo= $User->field("YW_Largeclass_ID,YW_Largeclass_NAME")->where()->select();
		return  $userinfo;
	}
	public function return_staffall($where=''){ 
		$User = M('staff_u'); // 实例化User对象
		$userinfo= $User->field("YW_Staff_ID,YW_Staff_Name,YW_User_Phone")->where($where)->select();
		return  $userinfo;
	}
	
	//得到皮肤的数据
	public function return_prodata(){ 
		$User = M('yw_beautyitemlist_project'); // 实例化User对象
       // 把查询条件传入查询方法YW_Project_ID
	    $biginfo=$this->return_prob();
		foreach($biginfo as $value){
			//将大类和小类对应查询
			$where="YW_Largeclass_ID=".$value['yw_largeclass_id'];
			$userinfo[$value['yw_largeclass_name']]= $User->field("YW_Project_ID,YW_Project_Name,YW_Largeclass_ID")->where($where)->select();
		}
		return  $userinfo;
	}
	public function return_staffinfo($where=''){ 
		$User = M('staff_u'); // 实例化User对象
		$userinfo= $User->field("YW_Staff_ID,YW_Staff_HeadPic,YW_Staff_Name,YW_User_Phone,YW_Staff_Intro,YW_Staff_WorkingAge,YW_Staff_Goods_Project")->where($where)->select();
		return  $userinfo;
	}
	
	public function return_analyze($where=''){ 
	    $project=$this->return_project();
		$staff=$this->return_staffinfo($where);
		foreach($staff as $key=>$fvalue){
			$skinarr='';
			$skinarr=explode(',',$fvalue['yw_staff_goods_project']);
	        $staff[$key]['yw_staff_goods_project']='';
				foreach($project as  $tvalue){
					$isin = in_array($tvalue['yw_project_id'],$skinarr);
					if($isin){
					   $staff[$key]['yw_staff_goods_project'].=$tvalue['yw_project_name']."&nbsp;&nbsp;";
					}
				}
		}
		return  $staff;
	}	
}
?>