<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class group_permission_m extends MY_Model {

	protected $table='tbl_group_permissions';

	public $rules=array(
		array(
			'field'=>'name',
			'label'=>'Name',
			'rules'=>'trim|required|xss_clean'
			),
		array(
			'field'=>'desc',
			'label'=>'Description',
			'rules'=>'trim|required|xss_clean'
			),
		);
	public function create_row($data)
	{
		$this->db->insert($this->table,$data);
	}
	public function update_row($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update($this->table,$data);
	}
	public function read_row($id,$select="p.slug as slug")
	{
		$this->db->select($select);
		$this->db->join('tbl_groups as g','g.id=gp.group_id','inner');			
		$this->db->join('tbl_permissions as p','p.id=gp.permission_id','inner')			
		->from($this->table." as gp")
		->where('group_id',$id);
		$rs=$this->db->get();
		return $rs->result_array();				 
	}

	public function read_row_($id)
	{
		$this->db->select(array('slug'))
		->from($this->table)
		->where('group_id',$id);
		$rs=$this->db->get();
		return $rs->result_array();				 
	}

	public function delete_row($id)
	{
		$this->db->where('id',$id);
		$this->db->delete($this->table);
	}	
	public function reset_group_permission($group_id)
	{
		$this->db->where('group_id',$group_id);
		$this->db->delete($this->table);
	}	

}

