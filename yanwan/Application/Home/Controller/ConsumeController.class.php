<?php
	namespace Home\Controller;
	use Think\Controller;
	class ConsumeController extends Controller {
		//http://127.0.0.1/YanWan_project/Home/Consume/user_vip  本地访问路径	
		//http://123.207.37.160/yanwan/index.php/Home/Consume/staff_info 远程服务端
		
		
		//返回用户管理信息
		public function user_vip(){
			header('Content-Type:text/html; charset=utf-8');
			$info = D("Consume");
			
			$user_name = $info->return_no_repeat();//返回用户的名字
			$sum_Money = "0";//返回消费总数
			$count_number = $info->return_user_all();
			$arr = $info->return_all();
			foreach($arr as $key=>$value){
				$sum_Money += $arr[$key]["yw_userconsume_money"];
			}
//			echo $count_number."<br/>";
//			echo $sum_Money."元";
//			echo "<pre>";
//			print_r($user_name);
//			exit;
			$arr = array(
				"user_name" =>	$user_name,
				"sum_Money" => $sum_Money,
				"count_number" => $count_number,
			);
			echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}
		//返回员工管理信息
		public function staff_info(){
			header('Content-Type:text/html; charset=utf-8');
			$info = D("Consume");
			$staff_count = $info->return_staff_all();//员工总数
			$consume_count = $info->return_consume_all();
			$staff_name = $info->return_staff_name();
//			echo $staff_count;
//			echo "<br/>".$consume_count;
//			echo "<pre>";
//			print_r($staff_name);
//			exit;
			$arr = array(
				"staff_count" => $staff_count,
				"consume_count" => $consume_count,
				"staff_name" => $staff_name,
			);
			
			echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}
		
		//返回个人员工业绩信息
		public function staff_performance(){
			header('Content-Type:text/html; charset=utf-8');
			$info = D("Consume");
			$staff_performance_arr = $info->return_staff_project();
			//echo "<pre>";
			//print_r($staff_performance_arr);
			//exit;
			if(isset($_GET['jsoncallback'])){
					if($staff_performance_arr == "1009"){
						$arr = array(
							"err"=>"1009",
						);
						echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
					}else{
						$arr = array(
							//每个项目人数总数
							"staff_performance_count" => $staff_performance_arr[0],
							//项目图片 金额 名字
							"staff_performance_arr" => $staff_performance_arr[1],
						);
						echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
					}
			}else{
				$this->assign("staff_performance_count",$staff_performance_arr[0]);
				$this->assign("staff_performance_arr",$staff_performance_arr[1]);
				$this->display("xfgr");
			}
			
		}
		//返回用户消费记录
		public function show_user_consume(){
			header('Content-Type:text/html; charset=utf-8');
			$info = D("Consume");
			$user_consume_arr = $info->return_userid_all();
			
			//$info->prt_r($user_consume_arr);
			//exit;
		
				$arr = array(
					//用户信息
					"user_arr" => $user_consume_arr[0],
					//用户时间在数组中
					"user_consume_arr" => $user_consume_arr[1],
					//项目信息数组
					"project_arr" => $user_consume_arr[2],
					
				);
				$info->is_tp($arr);
		
				$this->assign("user_arr",$user_consume_arr[0]);
				$this->assign("user_consume_arr",$user_consume_arr[1]);
				$this->assign("project_arr",$user_consume_arr[2]);
				$this->display("xfjl");
		
		}
		//添加用户消费记录
		public function add_user_consume(){
			//提交项目名称
			session_start();
			$YW_Staff_ID = "1";
			$value_arr = array($_GET["YW_User_ID"],$YW_Staff_ID,$_GET["YW_Project_ID"],$_GET["YW_UserConsume_Money"],$_GET["YW_UserConsume_Type"]);
			$info = D("Consume");
			$info->add_user_consume($value_arr);
		}
		//显示添加记录页面 以及返回页面内容
		public function add_show_consume(){
			$this->display("xfyj");
		}
		
		//返回员工业绩数据
		public function time_show(){
			header('Content-Type:text/html; charset=utf-8');
			$info = D("Consume");
			$staff_performance = $info->staff_performance();
			$time_arr_1 = array();
			foreach($staff_performance as $key=>$value){
				$time_arr_1[] = explode(" ",$staff_performance[$key]["yw_userconsume_time"]);
			}
			//$info->prt_r($time_arr_1);
			//$info->prt_r($staff_performance);
			$time_arr_2 = array();//返回所有的数据
			$time_arr_3 = array();//返回日期分组
			
			foreach($staff_performance as $key=>$value){
						$time_arr_3[] = array(
						"yw_staff_name"=>$staff_performance[$key]["yw_staff_name"],
						"yw_project_name"=>$staff_performance[$key]["yw_project_name"],
						"yw_userConsume_time"=>$time_arr_1[$key],
						);
			}
			foreach($staff_performance as $key=>$value){
				if($time_arr_1[$key-1][0]!=$time_arr_1[$key][0]){
					$time_arr_2[] = $time_arr_1[$key][0];
				}
				
			}
			//$info->prt_r($time_arr_3);
			//$info->prt_r($time_arr_2);
			//exit;
			
			
			if(isset($_GET['jsoncallback'])){
				$arr = array(
					"time" => $time_arr_2,
					"message" => $time_arr_3,
				);
				echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
			}else{
				$this->assign("message",$time_arr_3);
				$this->assign("time",$time_arr_2);
				$this->display("staff_time");
			}
		}


		//返回用户消费数据
		public function user_xf(){
			header('Content-Type:text/html; charset=utf-8');
			$info = D("Consume");
			$user_performance = $info->user_performance();
			$time_arr_1 = array();
			foreach($user_performance as $key=>$value){
				$time_arr_1[] = explode(" ",$user_performance[$key]["yw_userconsume_time"]);
			}
			$time_arr_2 = array();//返回所有的数据
			$time_arr_3 = array();//返回日期分组
			
			foreach($user_performance as $key=>$value){
						$time_arr_3[] = array(
						"yw_user_name"=>$user_performance[$key]["yw_user_name"],
						"yw_project_name"=>$user_performance[$key]["yw_project_name"],
						
						"yw_project_cost_money" =>$user_performance[$key]["yw_project_cost_money"],
						"yw_userConsume_time"=>$time_arr_1[$key],
						
						);
			}
			foreach($user_performance as $key=>$value){
				if($time_arr_1[$key-1][0]!=$time_arr_1[$key][0]){
					$time_arr_2[] = $time_arr_1[$key][0];
				}
				
			}
			//$info->prt_r($time_arr_3);
			//$info->prt_r($time_arr_2);
			//$info->prt_r($user_performance);
			//exit;
			
			
			if(isset($_GET['jsoncallback'])){
				$arr = array(
					"time" => $time_arr_2,
					"message" => $time_arr_3,
				);
				echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
			}else{
				$this->assign("message",$time_arr_3);
				$this->assign("time",$time_arr_2);
				$this->display("xfjlsy");
			}
		}
		
		
		
		public function xf(){
			$this->display("xf");
		}
		public function xfgl(){
			$this->display("xfgl");
		}
	}
?>