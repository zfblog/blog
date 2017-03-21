<?php
    namespace Components;
	class FileupLoadUser extends PublicUser {
		public $arr_1 = array();//上传文件类型数组
		public $arr = array("jpeg", "txt", "png");//一个文件类型的数组
		public $fileupload_name;//上传文件路劲  比如 "file/"
		public $new_file_name;//添加水印修改大小的新文件路径
		public $input_name;//表单提交过来的 file name
		public $file_base64;//base64传输过来的编码文件
		public function setvalues($file_name,$input_name,$arr_1,$file_base64=''){
			$this->fileupload_name = $file_name;
			$this->input_name = $input_name;
			$this->arr_1 = $arr_1;
			$this->file_base64 = $file_base64;
		}
		  public function checkFile($name,$arr){
			$farr = array(false, "1");
			$file_arr = explode(".", $name);
			$file_name = $file_arr[count($file_arr) - 1];
			foreach ($arr as $value) {
				if ($file_name == $value) {
					$farr[0] = "true";
					$farr[1] = "$file_name";
				}
			}
			return $farr;
		}
		public function file_uploadbase(){
				//检测是否符合要求
				$new_arr = $this->checkFile($this->input_name, $this->arr);
				if ($new_arr[0]) {
					$name = time().rand(0,1000). ".$new_arr[1]";
					file_put_contents($this->fileupload_name.$name, $this->file_base64);
					$file_name = $this->fileupload_name . $name;
					$new_name = $this->new_file_name.$name;
					$shuiyin = "";
				//	echo $new_arr[1];
					$this->thumn($file_name,200,200,$new_name,$this->arr_1,$new_arr[1],100,150,$shuiyin);
					return $name;
				} else {
					return 10010; //文件格式不正确
				}
				
		}
		
		
		public function file_upload(){
			if(isset($_FILES[$this->input_name])){
				//检测是否符合要求
				$new_arr = $this->checkFile($_FILES[$this->input_name]["name"], $this->arr);
				
				if ($new_arr[0]) {
					$name = time() . ".$new_arr[1]";
					
					move_uploaded_file($_FILES[$this->input_name]["tmp_name"], $this->fileupload_name.$name);
					//echo "上传成功";
					//echo "<a href='file_upload.html'>返回</a>";
					$file_name = $this->fileupload_name . $name;
					$new_name = $this->new_file_name.$name;
					$shuiyin = "";
					$this->thumn($file_name,200,200,$new_name,$this->arr_1,$new_arr[1],100,150,$shuiyin);
					
					//header("Location:open_file.php");
					//echo "<a href='open_file.php'>显示</a>";
					return $name;
				} else {
					echo "上传失败，文件格式不支持,请返回重新上传"."<br/>";
					echo "$new_arr[0]";
					echo "<a href='file_upload.html'>返回</a>";
				}
			}else{
				 echo "上传失败，文件大小超出范围,请返回重新上传"."<br/>";
					echo "<a href='file_upload.html'>返回</a>";
			}	
		}
		//判断 类型是否匹配 然后返回相对应的数组
		public function getfiletype($arr,$type){
		foreach($arr as $value){
				if($value[2] == $type){
				return $value;
				}
			}
		}
		
		//加水印修改大小
		public function thumn($background,$width,$height,$newfile,$arr,$type,$x,$y,$text){
		//修改大小
		$garr = $this->getfiletype($arr,$type);
		list($s_w,$s_h)=getimagesize($background);
		if($width && ($s_w < $s_h)){
			$width = ($height / $s_h) * $s_w;
		}else{
			$height = ($height / $s_w) * $s_h;
		}
		$new = imagecreatetruecolor($width, $height);
		$img = $garr[0]($background);
		imagecopyresampled($new, $img, 0, 0, 0, 0, $width, $height, $s_w, $s_h);
		$garr[1]($new,$newfile);
		//echo "大小修改成功<br/>";
		//加水印
		$back = $garr[0]($newfile);
		$color = imagecolorallocate($back,255,255,255);
		$f="font/arial.ttf";
		imagettftext($back, 30, 30, $x, $y, $color, $f, $text);
		$garr[1]($back,$newfile);
		//echo "水印修改成功";
		imagedestroy($back);
		imagedestroy($new);
		imagedestroy($img);
		}
	}


?>