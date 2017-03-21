<?php
	namespace Components;
	use Components\DbUser;
	class PageUser extends DbUser{
		public $page;
		public $page_size;
		public $page_count;//分页过后的长度
		public $page_rcount;//总长度
		public $page_where;
		public function page_setvalue($page,$page_size,$page_where=""){
			$this->page = $page;
			$this->page_size = $page_size;
			$this->page_where = $page_where;
			$this->page_rcount();
			$this->page_count();
		}
		public function  page_limit($typearr = ""){
			$arr = array();
			$start = ($this->page-1)*$this->page_size;
			$end = $this->page_size;
			$this->db_limit($start, $end);
			$arr[0] = $this->page_rcount;
			$arr[1] = $this->page_count;
			$arr[2] = $this->page;
			$arr[3] = $this->db_select($typearr,$this->page_where);
			
			return $arr;
		}
		public function  page_count(){
			$this->page_count = ceil($this->page_rcount/$this->page_size);
		}
		public function  page_rcount(){
			$this->page_rcount = count($this->db_select("",$this->page_where));
		}
		public function  show(){
			$where = base64_encode("$this->page_where");//加密操作
			if($this->page == 1){
				$page = $this->page;
			}else{
				$page = $this->page-1;
			}
			
			if($this->page == $this->page_count){
				$next_page = $this->page_count;
			}else{
				$next_page = $this->page+1;
			}
			return "<a href='?page=1&where=$where'>首页</a><a href='?page=$page&where=$where'>上一页</a><a href='?page=$next_page&where=$where'>下一页</a><a href='?page=$this->page_count&where=$where'>尾页</a><br/>";
		} 
		public function  show1(){
			$str = "";
			if($this->page_count>11){
				$mid = $this->page;
				$start = $mid-5;
				$end = $mid+5;
			if($this->page<6){$mid=6;$start=1;$end=11;}
			if($this->page>$this->page_count-5){$start=$this->page_count-10;$end=$this->page_count;}
			}else{
				$start=1;
				$end=$this->page_count;
			}
			
			
			for($i=$start;$i<=$end;$i++){
				$str .="<a href='#' id='$i'>$i</a>";
			}
			return $str;
		}
		
	}
?>