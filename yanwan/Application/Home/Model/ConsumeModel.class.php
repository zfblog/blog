<?php
	namespace Home\Model;
	use Think\Model;
	class ConsumeModel extends Model {
		protected $autoCheckFields =false;
		//用来判断是否用了内部控制器
		public function is_tp($arr_value){
			if(isset($_SESSION["tp_type"])){
				
			}else{
				$this->isset_jsoncallback();
				echo $_GET['jsoncallback'] . "(".json_encode($arr_value).")";
				exit;
			}
		}
		//判断是否存在jsoncallback
		public function isset_jsoncallback(){
			if(isset($_GET['jsoncallback'])){
				
			}else{
				$arr= array(
					"err" => "jsoncallback",
				);
				echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
				exit;
			}
		}
		
		
		//输出数组方法
		public function prt_r($arr){
			echo "<pre>";
			print_r($arr);
		}
		
		
		//优化的话可以吧 创建数据库表名 对象定义全局变量 不同的表创建不同的对象
		public function value(){
			//return "123";
			$sql = M("yw_userconsume");//设置表名
			
			return $sql->select();
		}
		//返回所有消费记录
		public function return_all(){
			$sql = M("yw_userconsume");
			return $sql->select();
		}
		//返回用户姓名
		public function return_no_repeat(){
			//$sql = M("yw_userconsume");
			//$no_repeat_arr = $sql->distinct(true)->field('YW_User_ID')->select();
			$sql = M("yw_user_info");
			//$user_name = array();
			//foreach($no_repeat_arr as $key => $value){
			$user_name = $sql->field("YW_UserInfo_ID,YW_User_ID,YW_User_Name")->select();
			//}
			return $user_name;
		}
		//返回总计人数
		public function return_user_all(){
			$sql = M("yw_user_info");
			return $sql->field("YW_User_ID")->count();
		}
		//返回员工总数
		public function return_staff_all(){
			$sql = M("yw_staff_info");
			return $sql->field()->count();
		}
		//一共返回多少个订单
		public function return_consume_all(){
			$sql = M("yw_userconsume");
			return $sql->field()->count();
		}
		//返回所有员工姓名
		public function  return_staff_name(){
			$sql = M("yw_staff_info");
			return $sql->field("YW_Staffinfo_ID,YW_Staff_ID,YW_Staff_Name")->select();
		}
		
		
		//员工业绩返回值方法
		/**
		 * YW_Project_Name 项目名称
		 * YW_Project_Img 项目图片
		 * YW_Project_Cost_Money 项目金额
		 */
		public function return_staff_project(){
			session_start();
			$staff_id = "1";
			//if(isset($_SESSION["YW_User_ID"])){
				//$staff_id = $_SESSION["YW_User_ID"];
				$sql = M("yw_staff_performance");
				//个人完成总单数
				$count_performance = 0;
				$staff_performance_arr = $sql->where("YW_Staff_ID = ".$staff_id)->select();//返回对应员工完成的业绩
				$project_arr = array();//该员工负责的项目
				$sql = M("yw_beautyitemlist_project");
				foreach($staff_performance_arr as $key => $value){
					$count_performance += $staff_performance_arr[$key]["yw_count_number"];
					$project_arr[] = array("yw_count_number"=>$staff_performance_arr[$key]["yw_count_number"],"project_arr"=>$sql->where("YW_Project_ID = ".$staff_performance_arr[$key]["yw_project_id"])->field("YW_Project_Name,YW_Project_Img,YW_Project_Cost_Money")->select());
				}
				//返回总数据
				$return_count_arr = array($count_performance,$project_arr);
				return $return_count_arr;
			//}else{
				//return "1009";
			//}
		}
		//返回指定用户消费信息 项目名称金额 时间等
		public function return_userid_all(){
			$user_arr = "";//用户信息数组
			$user_project = "";//指定用户消费项目
			$project_message = "";//项目信息
			$user_time = "";//消费时间
			session_start();
			$staff_id = "1";
			$user_id = "1";
			//if(isset($_SESSION["YW_User_ID"])){
				//$staff_id = $_SESSION["YW_User_ID"];
				//if(isset($_GET["YW_User_ID"])){
					//$user_id = $_GET["YW_User_ID"];
					$sql = M("yw_user_info");
					$user_arr = $sql->where("YW_User_ID = ".$user_id)->field("YW_User_ID,YW_User_Name,YW_User_HeadPic")->select();
					
					$sql = M("yw_userconsume");
					$user_project = $sql->where("YW_User_ID = ".$user_id." and YW_Staff_ID = ".$staff_id)->select();
					
					$sql = M("yw_beautyitemlist_project");
					foreach($user_project as $key => $value){
						$project_message[] = $sql->where("YW_Project_ID =".$user_project[$key]["yw_projectid"])->field("YW_Project_Name,YW_Project_Cost_Money")->select();
					}
					$return_count_arr = array($user_arr,$user_project,$project_message);
					return $return_count_arr;
				//}
			//}else{
				//return "1009";
			//}
		}

		public function add_user_consume($arr){
			$sql = M("yw_userconsume");
			$data["YW_User_ID"] = $arr[0];
			$data["YW_Staff_ID"] = $arr[1];
			$data["YW_projectID"] = $arr[2];
			$data["YW_UserConsume_Money"] = $arr[3];
			$data["YW_UserConsume_Type"] = $arr[4];
			$sql->add($data);
		}
		
		
		//员工业绩
		public function staff_performance(){
			$sql = M("staff_performance");
			$time_arr = $sql->order("YW_UserConsume_ID desc")->select();
			return $time_arr;
		}
		//用户消费
		public function user_performance(){
			$sql = M("user_performance");
			$time_arr = $sql->order("YW_UserConsume_ID desc")->select();
			return $time_arr;
		}
		
	}
?>