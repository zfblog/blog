<?php
    namespace Components;
	class Login extends PublicUser{
		public $message = "";
		public $where = "";
		public function login_check(){
			
			foreach($this->public_type as $key => $value){
				if($key==count($this->public_type)-1){
				
					$this->where.=$value."='".$this->public_value[$key]."'";
				}else{
		
					$this->where.=$value."='".$this->public_value[$key]."' and ";
				}
			}
			//echo $this->where;

		}
		
		public function return_message(){
			$arr = $this->db_select("",$this->where);
			if($arr == "1004"){
				$this->message = "1001";
			}else{
				$this->message =  "1000";
			}
			$new_arr = array($arr,$this->message);
			return $new_arr;
		}
		
	
	}
?>