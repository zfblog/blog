<?php
    namespace Components;
	class SendMessageUser extends PublicUser{
		public $filename;
		public $add_file;
		public $read_file;
		public function mkdir_file($filename,$db_tablename,$contacts_id,$user_id){
			$this->filename = $filename;
			$position = strrpos($this->filename,'/');  
			$path = substr($this->filename,0,$position); 
			if(!file_exists($path)){ 
				mkdir($path,0777,true);//创建目录  
				fopen($this->filename,"w");
			}else{
				if(!file_exists($this->filename)){
					fopen($this->filename, "w");
				}
			 	
			}
			//echo $this->filename;
			//创建的同时插入数据库
			$this->db_settablename($db_tablename);
			$message_str = $this->db_select("","user_id = ".$user_id." and contacts_id = ".$contacts_id);
			$message_str1 = $this->db_select("","user_id = ".$contacts_id." and contacts_id = ".$user_id);
			if($message_str[0]["user_message"] == null && $message_str1[0]["user_message"] == null){
				$message_arr = array("user_message");
				$message_value_arr = array($this->filename);
				$this->db_update($message_arr, $message_value_arr, "id", $message_str[0]["id"]);
				$this->db_update($message_arr, $message_value_arr, "id", $message_str1[0]["id"]);
			}
		}
		public function return_file_name($db_tablename,$contacts_id,$user_id){
			$this->db_settablename($db_tablename);
			$message_str = $this->db_select("","user_id = ".$user_id." and contacts_id = ".$contacts_id);
			return $message_str[0]["user_message"];
		}
		public function add_message($message){
			$this->add_file = fopen($this->filename,"a");
			$new_array = array();
			$new_array["草"] = "**";
			$new_array["我日"] = "****";
			$new_array["共产党"] = "****";
			$add_message = $message;
			foreach($new_array as $key=>$value){
				if(strstr($message,$key)){
					$add_message = 	str_replace($key,$value,$add_message);
				}
			}
			$txt = $add_message."\n";
			fwrite($this->add_file, $txt);
			fclose($this->add_file);
		}
		public function send_message(){
			$this->read_file = fopen($this->filename, "r") or die("Unable to open file!");		
			$msg = array();
			while(!feof($this->read_file)){
				$msg[] = array(fgets($this->read_file));
			}
			fclose($this->read_file);
			unset($msg[count($msg)-1]);
			return $msg;
		}
	}	
?>