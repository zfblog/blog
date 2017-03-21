<?php
namespace Components;
class DbUser {
	public $db_serser;
	public $db_username;
	public $db_userpass;
	public $db_name;
	public $db_conn;
	public $db_tablename;
	public $db_limitstr;
	public $db_orderbystr;
	
	//public  function __construct($db_serser, $db_username, $db_userpass, $db_name){
		
		//$this->db_setvalue($db_serser, $db_username, $db_userpass, $db_name);
	//}
	
	public function db_limit($start, $end) {
		$this->db_limitstr = "limit $start,$end";
	}
	public function db_order($str) {
		$this->db_orderbystr = "order by $str";
	}
	public function db_settablename($db_tablename) {
		$this->db_tablename = $db_tablename;
	}
	public function db_setvalue($db_serser, $db_username, $db_userpass, $db_name) {
		$this->db_serser = $db_serser;
		$this->db_username = $db_username;
		$this->db_userpass = $db_userpass;
		$this->db_name = $db_name;
		$this->db_limitstr = "";
		$this->db_orderbystr = "";
		$this->db_conndb ();
	}
	public function db_conndb() {
		$this->db_conn = mysql_connect ( $this->db_serser, $this->db_username, $this->db_userpass );
		if (! $this->db_conn) {
			die ( 'Could not connect: ' . mysql_error () );
		}
		mysql_select_db ( $this->db_name, $this->db_conn );
		mysql_query ( "SET NAMES utf8" );
	}
	public function db_select($type = "", $where = "") {
		$arr = array ();
		if (empty ( $type )) {
			$type = "*";
		} else {
			$type = implode ( ",", $type );
		}
		if (empty ( $where )) {
			
			$where = "";
		} else {
			$where = "where " . $where;
		}
		$sql = "select $type from " . $this->db_tablename . " $where $this->db_orderbystr $this->db_limitstr ";
		
		//echo $sql."<br/>";
		//exit;	

		$result = mysql_query ( $sql );
		while ( $row = mysql_fetch_array ( $result ) ) {
			$arr [] = $row;
		}
		
		if(empty($arr)){
			$str=1004;
			return $str;
		}
		
		return $arr;
		
	}
	
	

	public function db_delete($where="") {
		
		if (empty($where)) {
				
			$where = "";
		} else {
			$where = "where " . $where;
		}
		$sql="delete from $this->db_tablename  $where";
		
		if(mysql_query($sql)){
			return "1000";
		}else{
			return "1001";
		}
		
	}
	
	public function db_update($typearr,$valuearr,$id,$id_zhi) {
		$sql = "update $this->db_tablename set ";
		for($i=0;$i<count($typearr);$i++){
			if($i == count($typearr)-1){
				$sql.=$typearr[$i]." = "."'".$valuearr[$i]."'";
			}else{
				$sql.=$typearr[$i]." = "."'".$valuearr[$i]."'".",";
			}
		}
		$sql.=" where $id = $id_zhi";
		//echo $sql;
		if(mysql_query($sql)){
			return "1000";
		}else{
			return "1005";
		}
	}
	public function db_update_one($key,$value,$id,$id_zhi){
		$sql="update $this->db_tablename set $key = '$value' where $id = $id_zhi";
		echo $sql;
		if(mysql_query($sql)){
			return "1000";
		}else{
			return "1005";
		}
	}
	public function db_inster($typearr,$valuearr) {
		
		$sql="insert into $this->db_tablename(";

		foreach($typearr as $key=>$value){
			
			if($key==count($typearr)-1){
				$sql.=$value;
				
			}else{
				$sql.=$value.",";
				
			}
		
		}
		
		$sql.=") values(";
		
		foreach($valuearr as $vkey=>$vvalue){
				
			if($vkey==count($valuearr)-1){
				$sql.="'".$vvalue."'";
			}else{
				$sql.="'".$vvalue."',";
			}
		}
		
		
		
		$sql.=")";
		//echo $sql."<br/>";
		if(mysql_query($sql)){
			return "1000";
		}else{
			return "1001";
		}
	}
	
//	public function __destruct(){
//		mysql_close ( $this->db_conn );
//	}
public function sent() {
		echo "send";
	}
	public function db_close() {
		mysql_close ( $this->db_conn );
	}
}
?>