<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends MY_Model {

	protected $table='tbl_users';

	const PENDING=0;
	const ACTIVE=1;
	const BLOCKED=2;
	const DELETED=3;


	public static function status($key=null){
		$status=array(
			self::PENDING=>'Pending',
			self::ACTIVE=>'Active',
			self::BLOCKED=>'Blocked',
			self::DELETED=>'Deleted',
			);
		if(isset($key)) return $status[$key];
		return $status;
	}

	public static function actions($key=null){
		$actions=array(
			self::PENDING=>'Pending',
			self::ACTIVE=>'Active',
			self::BLOCKED=>'Block',
			self::DELETED=>'Delete',
			);
		if(isset($key)) return $actions[$key];
		return $actions;
	}


	function read_all($total,$start)
	{
		$this->db->select()
		->from($this->table)
		->where("status != ",3)
		->order_by('id','desc')
		->limit($total,$start);
		$rs=$this->db->get();
		return $rs->result_array();				 
	}
	function count_rows()
	{
		$this->db->select()
		->from($this->table)
		->where("status != ",3)
		->order_by('id','desc');
		$rs=$this->db->get();
		return $rs->num_rows();				 
	}	
	function update_row($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update($this->table,$data);
	}
	function check_login($username,$pass)
	{
		$where=array('username'=>$username,'pass'=>sha1($pass));
		$this->db->select()->from('tbl_users')->where($where);
		$rs=$this->db->get();
		return $rs->first_row('array');

	}


}

/* End of file user.php */
/* Location: ./application/modules/user/models/user.php */