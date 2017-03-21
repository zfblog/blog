<?php
	
	function __autoload($classname){
		//echo $classname."<br/>";
		$arr = array(
			"class" => array("class"),
			"interface" => array("interface"),
			"libs"=>array("smarty"),
			"libs/sysplugins"=>array("Smarty","smartycompilerexception","smartyexception")
		);
		$f = get_filetype($classname, $arr);
		
		//应为当前都是同目录下的 就不需要加
		//require_once $f."/".$classname.".php";
		if($classname == "Smarty"){
			require_once 'libs/Smarty.class.php';
		}else{
			//echo $f."<br/>";
			require_once $classname.".php";
			//require_once "../".$f."/".$classname.".php";
		}
		
	}
	
	$arr = array(
			"class" => array("class"),
			"interface" => array("interface"),
			"lib" => array("tem","tp","mvc")
		);
	//获取文件夹名
	function get_filetype($classname,$arr){
		foreach($arr as $key=>$value){
			foreach($value as $vvalue){
				if(checkfile($classname,$vvalue)){
					 return $key;
				}
			}
		}
	}
	//获取文件 _ 后面的 字符串
	function checkfile($classname,$value){
		$arr = explode("_",$classname);
		foreach($arr as $cvalue){
			if($cvalue == $value){
				return true;
			}
		}
		$arr = explode(".",$classname);
		foreach($arr as $cvalue){
			if($cvalue == $value){
				return true;
			}
		}
		return false;
	}

	if(!isset($calssname)){
		$calssname = "public_class";
	}
	$page = new $calssname();
	$page->db_setvalue("123.207.37.160","root","","vr_database");
	
?>