<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends MY_Model {

	// protected $table='tbl_users';
	static $table='tbl_users';

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


	static $rules=array(
		array(
			'field'=>'group',
			'label'=>'Group',
			'rules'=>'trim|required|xss_clean'
			),
		array(
			'field'=>'username',
			'label'=>'Username',
			'rules'=>'trim|required|route|alpha_numeric|is_unique[tbl_users.username]|xss_clean'
			),
		array(
			'field'=>'email',
			'label'=>'Email Address',
			'rules'=>'trim|required|valid_email|is_unique[tbl_users.email]|xss_clean'
			),
		array(
			'field'=>'first_name',
			'label'=>'First Name',
			'rules'=>'trim|required|alpha|xss_clean'
			),
		array(
			'field'=>'last_name',
			'label'=>'Last Name',
			'rules'=>'trim|required|alpha|xss_clean'
			),
		);
	
	// public function __construct(){
	// 	parent::__construct();
	// }
	// function read_all($total,$start)
	// {
	// 	$this->db->select()
	// 	->from($this->table)
	// 	->where("status != ",3)
	// 	->order_by('id','desc')
	// 	->limit($total,$start);
	// 	$rs=$this->db->get();
	// 	return $rs->result_array();				 
	// }
	// function read_all_active()
	// {
	// 	$this->db->select()
	// 	->from($this->table)
	// 	->where("status != ",self::DELETED);
	// 	$rs=$this->db->get();
	// 	return $rs->result_array();				 
	// }

	function read_rows_by($param,$limit=null,$offset=null){
		try {
			if(!is_array($param)) throw new Exception("Error Processing Request, no array", 1);	
			if(array_key_exists('group_id_not_in', $param)){
				$this->db->where_not_in('group_id',$param['group_id_not_in']);
				unset($param['group_id_not_in']);
			}
			if(array_key_exists('group_id_in', $param)){
				$this->db->where_in('group_id',$param['group_id_in']);
				unset($param['group_id_in']);
			}
			$this->db->order_by('id','desc');
			return parent::read_rows_by($param,$limit,$offset);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());			
			redirect('dashboard');
		}	
	}

	// function read_row_by_n($param){
	// 	try {
	// 		if(!is_array($param)) throw new Exception("Error Processing Request, no array", 1);	
	// 		$rs = $this->db->get_where($this->table, $param);
	// 		// echo $this->db->last_query();
	// 		return ($rs->first_row('array'));
	// 	} catch (Exception $e) {
	// 		$this->session->set_flashdata('error', $e->getMessage());			
	// 		redirect();
	// 	}	
	// }


	// function count_rows()
	// {
	// 	$this->db->select()
	// 	->from($this->table)
	// 	->where("status != ",3)
	// 	->order_by('id','desc');
	// 	$rs=$this->db->get();
	// 	return $rs->num_rows();				 
	// }	

	function check_login($username,$pass)
	{
		$where=array('username'=>$username,'pass'=>sha1($pass));
		$this->db->select()->from('tbl_users')->where($where);
		$rs=$this->db->get();
		return $rs->first_row('array');

	}
	function check_donee_login($username=null,$pass=null,$group_id=null)
	{
		if(!$username or !$pass or !$group_id) return false;
		$where=array('username'=>$username,'pass'=>sha1($pass),'group_id'=>$group_id);
		$this->db->select()->from('tbl_users')->where($where)->limit(1);
		$rs=$this->db->get();
		if($rs->num_rows()==0)
			return false;
		return $rs->first_row('array');

	}
	// public function create_row($data)
	// {
	// 	$this->db->insert($this->table,$data);
	// }
	// public function update_row($id,$data)
	// {
	// 	$this->db->where('id',$id);
	// 	$this->db->update($this->table,$data);
	// }
	public function update_row_n($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update(self::$table,$data);
		// echo $this->db->last_query();
		// return $this->db->affected_rows();
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
	}
	// public function read_row($id)
	// {
	// 	$this->db->select()
	// 	->from($this->table)
	// 	->where('id',$id);
	// 	$rs=$this->db->get();
	// 	return ($rs->first_row('array'));
	// }
	// public function read_row_by($param)
	// {
	// 	$this->db->select()
	// 	->from($this->table)
	// 	->where($param['key'],$param['value']);
	// 	$rs=$this->db->get();
	// 	// echo $this->db->last_query();
	// 	return ($rs->first_row('array'));
	// }
	// function read_row_by_username($username='')
	// {
	// 	if(!$username) return false;
	// 	$this->db->select()
	// 	->from($this->table)
	// 	->where('username',$username);
	// 	$rs=$this->db->get();
	// 	if($rs->num_rows()==0)
	// 		return false;
	// 	return ($rs->first_row('array'));
	// }

	// public function delete_row($id)
	// {
	// 	$this->db->where('id',$id);
	// 	$this->db->update($this->table,array('status' =>self::DELETED));
	// }	
	// public function set_rules(array $escape_rules=NUll){
	// 	if($escape_rules && is_array($escape_rules)){
	// 		foreach($this->rules as $rule){
	// 			if(in_array($rule['field'],$escape_rules)) continue;
	// 			$applied_rules[]=$rule;
	// 		}
	// 		return $applied_rules;
	// 	}
	// 	return $this->rules;
	// }
	// public function get_rules(array $get_rules=NUll){
	// 	if(!$get_rules){
	// 		return $this->rules;
	// 	}
	// 	else{
	// 		$applied_rules=[];
	// 		foreach($this->rules as $rule){
	// 			if(in_array($rule['field'],$get_rules)){
	// 				$applied_rules[]=$rule;					
	// 			} 
	// 		}
	// 		return $applied_rules;
	// 	}
	// }

	function count_group_user($id){
		$this->db->select(array('count(id) as total' ))
		->from(static::$table)
		->where("status != ",3)
		->where("group_id = $id")
		->order_by('id','desc');
		return $this->db->count_all_results();			 
	}
	// function get_user_name(){
	// 	$id=$this->session->userdata('id');
	// 	if($id){
	// 		$user=$this->read_row($id);
	// 		return $user['username'];			
	// 	}
	// }
	// 
	function filter_rows_by($param,$limit=null,$offset=null){
		try {
			if(!is_array($param)) throw new Exception("Error Processing Request, no array", 1);	
			$db_param=$param;
			$this->db->select("u.id,u.username,u.facebook_id,u.first_name,u.last_name,u.email,u.created_at,u.status,
				g.name,
				");
			$this->db->join('tbl_groups as g','g.id=u.group_id','inner');			
			$this->db->where('g.status !=',group_m::DELETED);

			if(array_key_exists('group_id',$param)){
				$db_param['u.group_id']="{$param['group_id']}";
				unset($db_param['group_id']);
			}else{
				// if(array_key_exists('group_id_in', $param)){
				// 	$this->db->where_in('u.group_id',$param['group_id_in']);
				// 	unset($db_param['group_id_in']);
				// }
				// else{
				// 	$dn_group=get_group(group_m::$dn_param);
				// 	$this->db->where_in('u.group_id',$group_param);
				// 	$fb_group=get_group(group_m::$fb_param);
				// 	$group_param=array(
				// 		'id_in'=>array($dn_group['id'],$fb_group['id']),
				// 		);
				// }
			}
			if(array_key_exists('status',$param)){
				$db_param['u.status']=$param['status'];
				unset($db_param['status']);
			}else{
				$db_param['u.status !=']=user_m::DELETED;				
			}
			if(array_key_exists('username',$param) && $param['username']){
				$db_param['u.username like']="{$param['username']}%";
				unset($db_param['username']);
			}
			if(array_key_exists('email',$param) && $param['email']){
				$db_param['u.email like']="{$param['email']}%";
				unset($db_param['email']);
			}
			if(array_key_exists('starting_at',$param) && $param['starting_at']){
				$db_param['u.created_at >=']=format($param['starting_at'],'Y-m-d');
				unset($db_param['starting_at']);
			}
			if(array_key_exists('ending_at',$param) && $param['ending_at']){
				$db_param['u.created_at <=']=format($param['ending_at'],'Y-m-d');
				unset($db_param['ending_at']);
			}
			if(array_key_exists('first_name',$param) && $param['first_name']){
				$db_param['u.first_name like']="{$param['first_name']}%";
				unset($db_param['first_name']);
			}
			if(array_key_exists('last_name',$param) && $param['last_name']){
				$db_param['u.last_name like']="{$param['last_name']}%";
				unset($db_param['last_name']);
			}
			// show_pre($db_param);
			$this->db->order_by('u.id','desc');			
			$rs = $this->db->get_where(self::$table." as u", $db_param, $limit, $offset);				
			// echo "<hr/>".$this->db->last_query();
			if($limit==1 && $rs->num_rows()==1)
				return $rs->first_row('array');
			else{
				return $rs->result_array();		
			}
		}catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());			
			redirect('dashboard');
		}	
	}

}


/* End of file user.php */
/* Location: ./application/modules/user/models/user.php */