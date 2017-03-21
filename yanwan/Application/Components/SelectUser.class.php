<?php
    namespace Components;
	class SelectUser extends PublicUser{
		public $provinces_id;//省份id
		public $cities_id;//城市id
		public $areas_id;//区域id
	
		//随机排序 并返回多少条数据
		/**
		 * $order 
		 * 
		 */
		public function select_All($order,$start,$end,$where){
			$this->db_limit($start, $end);
			$this->db_order($order);
			return $this->db_select("",$where);
		}
		
		//通过 所有的条件数组 来查询 where条件
		public function like_select($type_arr){
			$where="";
			$cities="";
				foreach($type_arr as $key=>$value){
					foreach($value as $vkey=>$vvalue){
					//对省份字符串拼接
						if(isset($value["provinces"])){
							$cities .= $vvalue;
						}
						if(isset($value["cities"])){
							$cities .= ",".$vvalue;
						}
						if(isset($value["areas"])){
							$cities .= ",".$vvalue;
						}
					}
				}
				foreach($type_arr as $key=>$value){
					foreach($value as $vkey=>$vvalue){
						if(isset($value["user_name"])){
							$where .= "user_name like '%$vvalue%' ";
						}else{
							$where .="";
						}
						
						if(isset($value["user_age"]) && $key == 0){
							$age = explode(",", $vvalue);
							$where .= "user_age >= $age[0] and user_age <= $age[1]";
						}else if(isset($value["user_age"]) && $key != 0){
							$age = explode(",", $vvalue);
							$where .= "and user_age >= $age[0] and user_age <= $age[1]";
						}else{
							$where .="";
						}

						if(isset($value["provinces"]) && $key == "0"){
							$where .= " user_address like '%$cities%' ";
						}else if(isset($value["provinces"]) && $key != 0){
							$where .= "and user_address like '%$cities%' ";
						}else{
							$where .="";
						}
						
						
						if(isset($value["user_sex"]) && $key == 0){
							$where .= " $vkey = '$vvalue'";
						}else if(isset($value["user_sex"]) && $key != 0){
							$where .= " and $vkey = '$vvalue'";
						}else{
							$where .="";
						}
					}
				}
				//echo $where;
				return $this->db_select("",$where);
		}
		//把字符串转换成数组
		//然后查询数据库返回 对应id 的 城市名字
		public function str_arr($str){
			$arr = explode(",", $str);
			if($arr[0]!=null){
				$this->db_settablename("provinces");
				$provinces_arr = $this->db_select("","provinceid=$arr[0]");//省份
			}
			if($arr[1]!=null){
				$this->db_settablename("cities");
				$cities_arr = $this->db_select("","cityid = $arr[1]");//城市
			}
			if($arr[2]!=null){
				$this->db_settablename("areas");
				$areas_arr = $this->db_select("","areaid =$arr[2] ");//区
			}
			$city_arr = array($provinces_arr[0]["province"],$cities_arr[0]["city"],$areas_arr[0]["area"]);
			return $city_arr;
		} 
	}
?>