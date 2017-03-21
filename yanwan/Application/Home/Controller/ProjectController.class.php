<?php
namespace Home\Controller;
use Think\Controller;
class ProjectController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
	
	//店长查看项目
	public function store_manager_project(){
		$m=M("Yw_beautyitemlist_project");
		$face=$m->where('yw_largeclass_id=1')->select();
		$eyes=$m->where('yw_largeclass_id=2')->select();
		$body=$m->where('yw_largeclass_id=3')->select();
		$neck=$m->where('yw_largeclass_id=4')->select();
		
		if(isset($_GET['jsoncallback'])){
			$arr = array(
				"face"=>$face,  
				"eyes"=>$eyes, 
				"body"=>$body, 
				"neck"=>$neck,   
        	); 
			 
        	echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}else{
			$arr=array($face,$eyes,$body,$neck);
			$this->assign('data',$arr);
			$this->display();
		}
	}

	//客户查看项目
	public function client_project(){
		$m=M("Yw_beautyitemlist_project");
		$face=$m->where('yw_largeclass_id=1')->select();
		$eyes=$m->where('yw_largeclass_id=2')->select();
		$body=$m->where('yw_largeclass_id=3')->select();
		$neck=$m->where('yw_largeclass_id=4')->select();
		
		if(isset($_GET['jsoncallback'])){
			$arr = array(
				"face"=>$face,  
				"eyes"=>$eyes, 
				"body"=>$body, 
				"neck"=>$neck,   
        	); 
			 
        	echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}else{
			$arr=array($face,$eyes,$body,$neck);
			$this->assign('data',$arr);
			$this->display();
		}
	}

	//店长添加项目
	function store_manager_add(){
		$m=M("Yw_beautyitemlist_project");
		
		$m->YW_Project_Name=$_POST['project_name'];
		$m->YW_Project_Efficacy=$_POST['project_efficacy'];
		$m->YW_Project_Cost_Money=$_POST['project_cost_money'];
		$m->YW_Project_Cost_Integral=$_POST['project_cost_integral'];
		$m->YW_Largeclass_ID=$_POST['largeclass_id'];
		$m->YW_Project_Img=$_POST['project_img'];
		$idnum=$m->add();
		if($idnum>0){
			$arr = array(
				"data"=>'1000',   
        	); 
			 
        	echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}else{
			$arr = array(
				"data"=>'1001',   
        	); 
			 
        	echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}
	}
	
	//店长查看单个项目，可修改
	function store_manager_modify(){
		$m=M("Yw_beautyitemlist_project");
		$project_id=$_GET['project_id'];
		$arr=$m->find($project_id);
		
		if(isset($_GET['jsoncallback'])){
			$arr = array(
				"data"=>$arr,   
        	); 
			 
        	echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}else{
			$this->assign('data',$arr);
			$this->display();
		}
	}
	
	//店长修改项目详情
	function store_manager_update(){
		$m=M("Yw_beautyitemlist_project");
		
		$m->YW_Project_ID=$_POST['project_id'];
		$m->YW_Project_Name=$_POST['project_name'];
		$m->YW_Project_Efficacy=$_POST['project_efficacy'];
		$m->YW_Project_Cost_Money=$_POST['project_cost_money'];
		$m->YW_Project_Cost_Integral=$_POST['project_cost_integral'];
		$m->YW_Largeclass_ID=$_POST['largeclass_id'];
		$m->YW_Project_Img=$_POST['project_img'];
		$idnum=$m->save($data);
		if($idnum>0){
			$arr = array(
				"data"=>'1000',   
        	); 
			 
        	echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}else{
			$arr = array(
				"data"=>'1001',   
        	); 
			 
        	echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}
	}
	
	//客户查看单个项目，不可修改
	function client_modify(){
		$m=M("Yw_beautyitemlist_project");
		
		$project_id=$_GET['project_id'];
		$arr=$m->find($project_id);
		
		if(isset($_GET['jsoncallback'])){
			$arr = array(
				"data"=>$arr,   
        	); 
			 
        	echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}else{
			$this->assign('data',$arr);
			$this->display();
		}
	}
	
	//店长删除项目
	function store_manager_delete(){
		$m=M("Yw_beautyitemlist_project");
		
		$project_id=$_GET['project_id'];
		
		$count=$m->delete($project_id);
		
		if($count>0){
			$arr = array(
				"data"=>'1000',   
        	); 
			 
        	echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}else{
			$arr = array(
				"data"=>'1001',   
        	); 
			 
        	echo $_GET['jsoncallback'] . "(".json_encode($arr).")";
		}
		
	}
}