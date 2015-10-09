<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting_m extends MY_Model {

	static $table='tbl_settings';

	public $rules=array(
		array(
			'field'=>'name',
			'label'=>'Name',
			'rules'=>'trim|required|xss_clean'
			),
		array(
			'field'=>'value',
			'label'=>'Value',
			'rules'=>'trim|xss_clean'
			),
		);

	const UNPUBLISHED=0;
	const PUBLISHED=1;
	const DELETED=2;

	public static function status($key=null){
		$status=array(
			self::PUBLISHED=>'PUBLISHED',
			self::UNPUBLISHED=>'UNPUBLISHED',
			);
		if(isset($key)) return $status[$key];
		return $status;
	}

	public static function actions($key=null){
		$actions=array(
			self::PUBLISHED=>'PUBLISHED',
			self::UNPUBLISHED=>'UNPUBLISHED',
			);
		if(isset($key)) return $actions[$key];
		return $actions;
	}

	// public function read_all()
	// {
	// 	$this->db->select()
	// 	->from($this->table);
	// 	$rs=$this->db->get();
	// 	return $rs->result_array();				 
	// }

	// function read_rows_by($param,$limit=null,$offset=null){
	// 	try {
	// 		if(!is_array($param)) throw new Exception("Error Processing Request, no array", 1);	
	// 		$rs = $this->db->get_where($this->table, $param, $limit, $offset);
	// 		// echo $this->db->last_query();
	// 		// die;
	// 		if($rs->num_rows()==1)
	// 			return $rs->first_row('array');
	// 		return $rs->result_array();		
	// 	} catch (Exception $e) {
	// 		die($e->getMessage());
	// 		$this->session->set_flashdata('error', $e->getMessage());			
	// 		redirect();
	// 	}	
	// }

	// function get_child_permissions($parent_permission_id){
	// 	try {
	// 		$this->db->select()
	// 		->from($this->table)
	// 		->where("parent_permission_id = $parent_permission_id");
	// 		$rs=$this->db->get();
	// 		// echo $this->db->last_query();
	// 		return $rs->result_array();				 			
	// 	} catch (Exception $e) {
			
	// 	}
	// }
	// public function count_rows()
	// {
	// 	$this->db->select()
	// 	->from($this->table)
	// 	->order_by('id','desc');
	// 	$rs=$this->db->get();
	// 	return $rs->num_rows();				 
	// }	
	// public function get_permissions()
	// {
	// 	$this->db->select('id,name,desc')->from($this->table)->where("parent_permission_id is NULL");
	// 	$rs=$this->db->get();
	// 	return $rs->result_array();				 
	// }
	// public function get_permission_name($id=NULL)
	// {
	// 	$this->db->select('name')->from($this->table)->where("id =$id")->limit('1');
	// 	$rs=$this->db->get();
	// 	return $rs->row('name');				 				 
	// }
	// public function create_row($data)
	// {
	// 	$this->db->insert($this->table,$data);
	// }
	// public function update_row($id,$data)
	// {
	// 	$this->db->where('id',$id);
	// 	$this->db->update($this->table,$data);
	// }
	// public function read_row($id)
	// {
	// 	$this->db->select()
	// 	->from($this->table)
	// 	->where('id',$id);
	// 	$rs=$this->db->get();
	// 	return $rs->first_row('array');
	// }
	// public function read_row_by_name($name='')
	// {
	// 	if(!$name)
	// 		return false;
	// 	$this->db->select()
	// 	->from($this->table)
	// 	->where('name',$name);
	// 	$rs=$this->db->get();
	// 	if($rs->num_rows()==0)
	// 		return false;
	// 	return ($rs->first_row('array'));
	// }

	// public function delete_row($id)
	// {
	// 	$this->db->where('id',$id);
	// 	$this->db->delete($this->table);
	// }	

	// public function set_rules_except(array $escape_rules=NUll){
	// 	if($escape_rules && is_array($escape_rules)){
	// 		foreach($this->rules as $rule){
	// 			if(in_array($rule['field'],$escape_rules)) continue;
	// 			$applied_rules[]=$rule;
	// 		}
	// 		return $applied_rules;
	// 	}
	// 	return $this->rules;
	// }
}

