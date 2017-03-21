<?php
namespace Home\Controller;
use Think\Controller;
class UserinfoController extends Controller {
    //查看皮肤状态可选参数
	public function skindata(){
		$code=1005;
		if(isset($_GET['add_id'])){
			header('Content-Type:text/html; charset=utf-8');
			$info = D("Userinfo");
			$userinfo= $info->return_skintype();
			$code=1000;
			if(empty($userinfo)){
				$code=1004;	
			}
		}
//		echo "<pre>";
//		print_r($userinfo);
//      $this->judgeajax($userinfo,$code);
        $this->judge_field(array('add_id'));
        $cons = D("Consume");
        $arr = array(  
				"userinfo" => $userinfo,
				"code" =>  $code
	     );
		$cons->is_tp($arr);
		$this->assign("code",$code);
		$this->assign("id",$_GET['add_id']);
		$this->assign("userinfo",$userinfo);
        $this->display();
	}
	//上传皮肤状态
	public function skintype(){
		$code=1005;
		$this->judge_field(array('YW_User_ID'));
		if(isset($_GET['YW_User_ID'])){
			//echo "<pre>";
			//print_r($_POST);
			$User = M("yw_user_info");
			$fildearr=array('YW_User_Skin_Type','YW_User_Skin_Condition','YW_User_Nose_Ccondition','YW_User_Neck_Condition','YW_User_Chin_Condition','YW_User_Eye_Condition');
			$this->judge_field($fildearr);
			$data=$this->get_file_value($fildearr); //图片名写入数据库
			$where="YW_User_ID=".$_GET['YW_User_ID'];
			$result=$User->where($where)->save($data);
			$code=1001;
			if($result){
			   $code=1000;
			}
		}
	   
		$cons = D("Consume");
		$arr = array(  
				"userinfo" => $userinfo,
				"err" =>  $code
	     );
		$cons->is_tp($arr);
		$this->assign("code",$code);
		$this->assign("id",$_GET['add_id']);
		$this->assign("userinfo",$userinfo); //调用添加账户的显示接口
        $this->display(""); ////调用添加账户的显示接口 或者显示成功的页面
	} 
	
	public function userinfoshow(){ //客户查看基本信息 ：姓名 电话号码 头像 vip等级  个人积分 初始肤质 近期肤质
		 // 实例化User对象
		$info = D("Userinfo");
   	    $where='';
		$code=1005;
        //echo "<pre>";
//        echo $_GET["YW_User_ID"];
		if(isset($_GET["YW_User_ID"])){
			$where="YW_User_ID=".$_GET["YW_User_ID"];
            $newskin=$info->return_newskin($where);
			$this->assign("newskin",$newskin);
			$userinfo=$info->return_userinfo($where);
			$code=1000;
			if(empty($userinfo)){
				$code=1004;
			}
		}
		$this->judge_field(array('YW_User_ID'));
	//	var_dump($userinfo);
		$cons = D("Consume");
		$arr = array(  
				"userinfo" => $userinfo,
				"newskin" =>  $newskin,
				"code" =>  $code
	    );
		$cons->is_tp($arr);
		$this->assign("code",$code);
	    $this->assign("userinfo",$userinfo);
	 //   $this->display("userinfoshow");
    }
		
	//客户修改基本信息
	public function userinfoupdata(){ //图片上传只用form表单 跨域字符长度有限制  可以只山川字段也可以同时上传头像
		$code=1005;
//		print_r($_POST);
//		print_r($_FILES);
		$this->judge_field(array('YW_User_ID'));
		if(isset($_GET["YW_User_ID"])){
			$filearr=array('YW_User_Name','YW_User_Phone');
	        $this->judge_field($filearr);//判断json
			
			$User = M("yw_user_info"); // 实例化User对象
			$infou = M("yw_user");
			 //字段所属表格不一致 所以需要两个表
			$where="YW_User_ID='".$_GET["YW_User_ID"]."'";
			$filearri=array('YW_User_Name');
			$filearru=array('YW_User_Phone');
			$datau=$this->get_file_value($filearru);
			$datai=$this->get_file_value($filearri);
			$code=1000;
		    if(!empty($_FILES['YW_User_HeadPic']['name'])){
			    $code=$this-> uploadimg();
				if($code==1000){
					$result=$User->where($where)->save($datai); 
					$result=$infou->where($where)->save($datau); 
				}
			}else{
				$result=$User->where($where)->save($datai);
				$result=$infou->where($where)->save($datau); 
			}
			//var_dump($result);
//			if(!$result){ //判断更新是否成功
//				$code=1001; 
//			}
	    }
		//echo $code;
		$cons = D("Consume");
		$arr = array(  
				"userinfo" => $userinfo,
				"code" =>  $code
	    );
		$cons->is_tp($arr);
		$this->judgeajax('',$code);
		$this->assign("code",$code);
	//	$this->display("userinfoupdata");
	   //isset($_GET["YW_User_ID"]
	}
	
	
	
	public function staffinfoshow(){ //员工和客户查看查看单个基本信息
	    $info = D("Userinfo");
        $code=1005;
		$this->judge_field(array('YW_Staff_ID'));
		if(isset($_GET["YW_Staff_ID"])){
			$where="YW_Staff_ID=".$_GET["YW_Staff_ID"];
           $userinfo=$info->return_analyze($where);
		   $code=1000;
		   if(empty($userinfo)){
			   $code=1004;
		   }
			
		}
	//	  echo"<pre>";
//        print_r($userinfo);
        $cons = D("Consume");
		$arr = array(  
				"userinfo" => $userinfo,
				"code" =>  $code
	    );
		$cons->is_tp($arr);
	    $this->assign("code",$code);
	    $this->assign("userinfo",$userinfo);       
	    $this->display(); 
    }
			
	//单个顾问修改基本信息
	public function staffinfoupdata(){ //图片上传只用form表单 跨域字符长度有限制  可以只山川字段也可以同时上传头像
		$code=1005;
		//print_r($_POST);
		//print_r($_FILES);
		$this->judge_field(array('YW_Staff_ID'));
		if(isset($_GET["YW_Staff_ID"])){
			$filearr=array('YW_Staff_Name','YW_User_Phone','YW_Staff_Intro',"YW_Staff_WorkingAge");
	        $this->judge_field($filearr);//判断json
			$User = M("yw_staff_info"); // 实例化User对象
			$infou = M("yw_user");
			 //字段所属表格不一致 所以需要两个表
			$wherei="YW_Staff_ID='".$_GET["YW_Staff_ID"]."'";
			$whereu="YW_User_ID='".$_GET["YW_Staff_ID"]."'"; //两个字段的数据不一致
			$filearri=array('YW_User_Name','YW_Staff_Intro',"YW_Staff_WorkingAge");
			$filearru=array('YW_User_Phone');
			
	        $this->judge_field($filearr);//判断json
			$datau=$this->get_file_value($filearru);
			$datai=$this->get_file_value($filearri);
			$code=1000;
			
		    if(!empty($_FILES['YW_Staff_HeadPic']['name'])){
			    $code=$this-> uploadimg();
				if($code==1000){
					$result[]=$User->where($wherei)->save($datai); 
					$result[]=$infou->where($whereu)->save($datau); 
				}
			}else{
				$result[]=$User->where($wherei)->save($datai);
				$result[]=$infou->where($whereu)->save($datau); 
			}
			var_dump($result);
	    }
		echo $code;
		$cons = D("Consume");
		$arr = array(  
				"userinfo" => $userinfo,
				"code" =>  $code
	    );
		$cons->is_tp($arr);
		$this->judgeajax('',$code);
		$this->assign("code",$code);
	//	$this->display("userinfoupdata");
	   //isset($_GET["YW_User_ID"]
	}
	
    public function staffinfoshowall(){ //查看所有顾问得信息
	    $info = D("Userinfo");
		$code=1000;
        $where='';
        $userinfo=$info->return_staffall($where);
		if(empty($userinfo)){
			$code=1004;
		}
		//echo "<pre>";
		//print_r( $userinfo);
	  
	    $cons = D("Consume");
		$arr = array(  
				"userinfo" => $userinfo,
				"code" =>  $code
	    );
		$cons->is_tp($arr);
		$this->assign("userinfo",$userinfo);
		$this->assign("code",$code);
   //     $this->display();
//      print_r($info->return_analyze());
    }	
	
	
	
	

	
	public function projectdata(){
		
		$code=1005;
		$this->judge_field(array('add_id'));
		if(isset($_GET['add_id'])){
			$info = D("Userinfo");
			$userinfo=$info->return_prodata();
		//	$code=1000;
//			echo "<pre>";
			print_r($userinfo);
		}
        $cons = D("Consume");
		$arr = array(  
				"userinfo" => $userinfo,
				"code" =>  $code
	    );
		$cons->is_tp($arr);
		$this->assign("code",$code);
		$this->assign("id",$_GET['add_id']);
		$this->assign("userinfo",$userinfo);
        $this->display();
	}
	//上传擅长项目状态
	public function projecttype(){
		$code=1005;
		$this->judge_field(array('YW_Staff_ID','YW_Staff_Goods_Project'));
		if(isset($_GET['YW_Staff_ID'])){
			$User= M("yw_staff_info");
			$fildearr=array('YW_Staff_Goods_Project');
			$data=$this->get_file_value($fildearr); //图片名写入数据库
			$where="YW_Staff_ID=".$_GET['YW_Staff_ID'];
			//print_r($data);
			//print_r($where);
			$result=$User->where($where)->field('YW_Staff_Goods_Project')->filter('strip_tags')->save($data);
			$code=1001;
			if($result){ //更新成功则$code=1000;
				$code=1000;
				
			}
		$cons = D("Consume");
		$arr = array(  
				"userinfo" => $userinfo,
				"code" =>  $code
	    );
		$cons->is_tp($arr);
		$this->assign("id",$_GET['YW_Staff_ID']);
	    $this->assign("pagename","");//更新成功之后跳转到显示页面之后再跳转的控制器名
		}
	//	$this->display("");
	}
	
	
	public function searchuserinfo(){ 
		$User = M('user_u');
		$info = D("Userinfo");
		$fieldarr=array('field','searchkey');
		$this->judge_field($fieldarr);
		if(isset($_GET['searchkey'])){ //因为json方式请求数据都是get方式
			$where=$_GET['field']." like '%".$_GET['searchkey']."%'";
		}else if (isset($_POST['searchkey'])){
			$where=$_GET['field']." like '%".$_POST['searchkey']."%'";
		}
	    $userinfo=$info->return_userinfo($where);
//		echo "<pre>";
//		var_dump($userinfo);
		$code=1000;
		if(empty($userinfo)){
			$code=1004;
		}
	 	$cons = D("Consume");
		$arr = array(  
				"userinfo" => $userinfo,
				"code" =>  $code
	    );
		$cons->is_tp($arr);
	    $this->assign("code",$code);
	    $this->assign("userinfo",$userinfo);
	    $this->display("userinfoshow");
    }

//	public function projecttupdata(){
//		$User=M("yw_staff_info");
//		$where="YW_Staffinfo_ID=2";
//		$data['YW_Staff_Goods_Project']="1,4,3";
//		$User->where($where)->field('YW_Staff_Goods_Project')->filter('strip_tags')->save($data);
//		echo $User->_sql();
//		
//	}
	
//	public function staffinfoshowall(){ //查看所有顾问得信息
//	    $info = D("Userinfo");
//        $where='';
//        $userinfo=$info->return_staffinfo($where);
//	    $this->assign("userinfo",$userinfo);
////      print_r($info->return_analyze());
//    }
	
	
	
//	public function skininfoshow(){ //员工和客户查看皮肤状况
//	    $code=1005;
//		if(isset($_GET["YW_User_ID"])){
//			$where="YW_User_ID=".$_GET["YW_User_ID"];
//		}else{
//			$where='';
//		}
//		$User = M('yw_user_info'); // 实例化User对象
//	
//       // 把查询条件传入查询方法
//        $userinfo= $User->where($where)->select();
//		$code=1000;
//		if(empty($userinfo)){
//			$code=1004;
//		}
//		//得到皮肤相关数据
//		$skintype=$this->skindata();
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
//					
//					if($tvalue==1){
//						$str.=$skintype[$skey][$tkey]."\n";
//					}
//				}
//				$userinfo[$fkey][$skey]=$str;
//		    }
//		}
//	
//	    $this->judgeajax($userinfo,$code);
//	    $this->assign("code",$code);
//		return $userinfo;
//    }
	
	
	
	
	
	
	//public function staffinfoshow(){ //员工和客户查看查看单个基本信息
//	    $_GET["YW_Staff_ID"]=1;
//	    $User = M('staff_u'); // 实例化User对象
//        $where='';
//		if(isset($_GET["YW_Staff_ID"])){
//			$where="YW_Staff_ID=".$_GET["YW_Staff_ID"];
//		}else{
//			$where="YW_Staff_Type=2";//?
//		}
//       // 把查询条件传入查询方法
//        $userinfo= $User->where($where)->select();
//		//var_dump($userinfo);
//		$code=1000;
//		if(empty($userinfo)){
//			$code=1004;
//		}
//	    $this->judgeajax($userinfo,$code);
//	    $this->assign("code",$code);
//	    $this->assign("userinfo",$userinfo);
//	    $this->display("staffinfoshow");
//    }
	
	
	
	
	
//	public function searchuserinfo(){ 
//		$User = M('user_u');
//		$fieldarr=array('field','searchkey');
//		$this->judge_field($fieldarr);
//		if(isset($_GET['searchkey'])){ //因为json方式请求数据都是get方式
//			$where=$_GET['field']." like '%".$_GET['searchkey']."%'";
//		}else{
//			$where=$_GET['field']." like '%".$_POST['searchkey']."%'";
//		}
//	    $userinfo= $User->where($where)->select();
//		//var_dump($userinfo);
//		$code=1000;
//		if(empty($userinfo)){
//			$code=1004;
//		}
//	    $this->judgeajax($userinfo,$code);
//	    $this->assign("code",$code);
//	    $this->assign("userinfo",$userinfo);
//	    $this->display("userinfoshow");
//    }
//	public function staffachievement(){ //查看总业绩和单数，或者查看自己的添加的单数即自己的业绩
//		$code=1005;
//	    if(isset($_GET['YW_Staff_ID'])){
//			$where="YW_Staff_ID=".$_GET["YW_Staff_ID"];
//			$User = M('yw_userconsume'); // 实例化User对象
//		
//		   // 把查询条件传入查询方法
//		  //$sumScore = $Dao->order('score DESC')->limit('10')->sum('score');
//			$money= $User->where($where)->sum('YW_UserConsume_Money');
//			$count= $User->where($where)->count();
//			$userinfo=array($count,$money);
//			var_dump($userinfo);
//			$code=1000;
//			$this->judgeajax($userinfo,$code);
//			$this->assign("code",$code);
//			$this->assign("userinfo",$userinfo);
//			$this->display("userinfoshow");
//		}
//	
//    }
		//查询到皮肤相关数据

	

	//修改员工基本信息
	//public function staffinfoupdata(){ //图片上传只用form表单 跨域字符长度有限制  可以只山川字段也可以同时上传头像
//		if(isset($_GET["YW_Staff_ID"])){
//			$User = M("yw_staff_info"); // 实例化User对象
//			
//			 //将上传的元素与数据库中的字段一一匹配
//			$where="YW_Staff_ID=".$_GET["YW_Staff_ID"];
//			$filearr=array('YW_Staff_Name','YW_Staff_HeadPic','YW_Staff_Intro','YW_Staff_WorkingAge','YW_Staff_Goods_ Project'); //看是否需要修改手机号
//	        $this->judge_field($filearr);//判断json
//		    
//			if(isset($_FILES)){
//			    $code=$this-> uploadimg();
//				echo $code;
//				if($code==1000){//如果图片上传成功
//					$data=$this->get_file_value($filearr);
//					$User->where($where)->save($data); 
//				}
//			}
//			$this->judgeajax('',$code);
//			$this->assign("code",$code);
//			$this->assign("userinfo",$userinfo);
//			$this->display("staffinfoupdata");
//	    }else{
//			$code=1005;
//			$this->judgeajax('',$code);
//			$this->assign("code",$code);
//			$this->display("staffinfoupdata");
//	   }//isset($_GET["YW_User_ID"]
//	}
	public function uploadimg(){ //图片上传
	    $code=1005;
		if(isset($_GET["YW_User_ID"])){
			$where="YW_User_ID=".$_GET["YW_User_ID"];
			$fieldname="YW_User_HeadPic";
			$User = M('yw_user_info');
			
		}else{
			$where="YW_Staff_ID=".$_GET["YW_Staff_ID"];
			$fieldname="YW_Staff_HeadPic";
			$User = M('yw_staff_info');
			
		}
		$code=1001;
		if($_FILES[$fieldname]['error']==0){ //0表示上传成功  这个也需要单独使用 所以需要这个判断
			$config=array(
				'maxSize' =>2091481,
				'exts'  =>  array('jpeg','png','jpg'),
				'autoSub'=>false,
				'rootPath'=>'./Uploads/headerpic/big/',
			);
			$upload=new \Think\Upload($config);
			$info=$upload->uploadOne($_FILES[$fieldname]);
			$userinfo= $User->where($where)->select();
			var_dump($info);
			//判断文件是否上传成功
			if($info){
				$fieldnamel= strtolower($fieldname);
				$img=new \Think\Image();//实例化图片处理类
				$big_img=$upload->rootPath.$info['savename'];//大图的路径文件名$upload->rootPath这个就是路径
				$img->open($big_img);//打开图片
				$img->thumb(200,200);//生成缩略图
				$small_img="./Uploads/headerpic/small/".$info['savename'];//设置图片路径
				$img->save($small_img);//保存图片
				$code=1000;
				unlink("./Application/Home/upload/headerpic/big/".$userinfo[0][$fieldnamel]."");
				unlink("./Application/Home/upload/headerpic/small/".$userinfo[0][$fieldnamel]."");
				$data[$fieldname] = $info['savename'];
				$User->where($where)->save($data); //图片名写入数据库
				$userinfo= $User->where($where)->select();
				//此处可以跳转成功时的网页
			}
			else{//文件上传失败$userinfo=失败原因
			   $userinfo=$upload->getError();
			}
		}
		//此处可以跳转失败时时的网页
		return $code; //
   }
	//员工和客户查看消费信息 这个我应该不写
//	public function userconsumeshow(){ 
//	    $code=1005;
//		$User = M('yw_userconsume'); 
//		$fieldarr=array('YW_User_ID');
//		$this->judge_field($fieldarr);
//		if($_GET["tablename"]=="yw_user_info"){
//			$where="YW_User_ID=".$_GET["YW_User_ID"];
//		}else{
//			$where="YW_Staff_ID=".$_GET["YW_Staff_ID"];
//		}
//       // 把查询条件传入查询方法
//        $userinfo= $User->where($where)->select();
//		//var_dump($userinfo);
//		$code=1000;
//		if(empty($userinfo)){
//			$code=1004;
//		}
//	    $this->judgeajax($userinfo,$code);
//	    $this->assign("code",$code);
//	    $this->assign("userinfo",$userinfo);
//	    $this->display("userinfoshow");
//    }
//		

		//用于区分时ajax请求还是模板

	protected function judgeajax($userinfo='',$code='',$tplname=''){ //需要返回的信息数组,状态码，跳转到的模板名称
		if(isset($_GET['jsoncallback'])){
			$arr = array(  
				"userinfo" => $userinfo,
				"code" =>  $code
	        );  
            echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
			exit;
	    }

    }
	public function judge_field($field){//只用于ajax
		if(isset($_GET['jsoncallback'])){//先判断是否存在jsoncallback;
			foreach($field as $value){
				if(!isset($_GET[$value])&&!isset($_POST[$value])){
				     echo $_GET['jsoncallback'] ."(".json_encode(array("code"=>"1005","errstr"=>$value)).")";
					 exit;
				}
				
			}
		}
	}
	//用于将需要修改的字段拼成一个数组
    public function get_file_value($arr){ //需要添加的字段
		foreach($arr as $value){
			if(isset($_GET[$value])){
				$data[$value] = $_GET[$value];
			}else if(isset($_POST[$value])){
				$data[$value] = $_POST[$value];
			}
	    }
		return  $data;
	}
	
	
	
//		public function judge_field1($field){//即可用于模板也可用于ajax
//		if(isset($_GET['jsoncallback'])){//先判断是否存在jsoncallback;
//			foreach($field as $value){
//				if(!isset($_GET[$value])&&!isset($_POST[$value])&&!isset($_FILES[$value])){
//				     echo $_GET['jsoncallback'] ."(".json_encode(array("code"=>"1005","errstr"=>$value)).")";
//					 exit;
//				}
//				
//			}
//		}else{
//			foreach($field as $value){
//				if(!isset($_GET[$value])&&!isset($_POST[$value])){
//					  $this->assign("code",1003);
//					  $this->assign("userinfo",$value);
//					  $this->display();
//					  exit;
//				}
//				
//			}
//			
//		}
//	}
	
}