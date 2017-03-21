<?php
    namespace Components;
	class PublicUser extends PageUser{
		public $public_type;
		public $public_value;
		
		public function public_setvalue($public_type){
			$this->public_type = $public_type;
			$this->public_getvalue();
			
		}
		public function public_getvalue(){
			$arr = array();
			
				foreach($this->public_type as $value){
					if(isset($_POST["$value"])){
						$arr[] = $_POST["$value"];
					}else{
						$arr[] = $_GET["$value"];
					}
					
				}
				$this->public_value = $arr;
				return $this->public_value;
		}
		public function public_insert(){
			return $this->db_inster($this->public_type,$this->public_value);
		}
		//返回 数据库 对应字段 和值的 数组 
		//用于返回 多条件查询 的数组
		public function public_keyValue_arr(){
			$arr = array();
			$value_arr = $this->public_value;
			$type_arr = $this->public_type;
			
			foreach($value_arr as $key=>$value){
				if($value != "null" && $value != ""){
					$arr[] = array($type_arr[$key] => $value);
				}
			}
			return $arr;
		}
		
		public function get_value_info1($str){
			//$this->get_jsoncallback();
			if(isset($_GET["$str"])){
	   		 	return $_GET["$str"];
			}else{
	   			 echo $_GET['jsoncallback'] ."(".json_encode(array("err"=>"1005","errstr"=>"$str")).")";
				 exit;
			}
		}

		public function get_value_info($str){
			//$this->get_jsoncallback();
			if(isset($_GET["$str"])){
	   		 	return $_GET["$str"];
			}else{
	   			 echo $_GET['jsoncallback'] ."(".json_encode(array("err"=>"1005","errstr"=>"$str")).")";
				 exit;
			}
		}
		public function get_jsoncallback(){
			if(!isset($_GET['jsoncallback'])){
				 echo "(".json_encode(array("err"=>"1005","errstr"=>"jsoncallback")).")";
				exit;
			}
		}
	}
?>