<?php
class page_types_m extends CI_Model
{

	static $table='tbl_page_types';

	function read_all()
	{
		$this->db->select()
		->from(static::$table);
		$rs=$this->db->get();
		return $rs->result_array();				 
	}

	function count_rows()
	{
		$this->db->select()
		->from(static::$table)
		->where("status != ",3)
		->order_by('id','desc');
		$rs=$this->db->get();
		return $rs->num_rows();				 
	}	
	function create_row($data)
	{
		$this->db->insert(static::$table
			,$data);
	}
	function read_row($id)
	{
		$this->db->select()
		->from(static::$table)
		->where('id',$id);
		$rs=$this->db->get();
		return ($rs->first_row('array'));
	}
	function update_row($id,$data)
	{
		try {
			$this->db->where('id',$id);
			$this->db->update(static::$table,$data);
		} catch (Exception $e) {
			echo $e->getMessage();			
		}
	}
	function delete_row($id)
	{
		$this->db->where('id',$id);
		$this->db->update(static::$table,array('status' =>self::DELETED));
		
	}

	function read_row_by($param){
		try {
			if(!is_array($param)) throw new Exception("Error Processing Request, no array read_row_by_n", 1);
			$rs = $this->db->get_where(static::$table, $param);
			// echo "<hr>".$this->db->last_query();
			return $rs->first_row('array');
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
			redirect('dashboard');
		}
	}

	function read_rows_by($param,$limit=null,$offset=null){
		try {
			if(!is_array($param)) throw new Exception("Error Processing Request", 1);
			$this->db->order_by('id','desc');
			$rs = $this->db->get_where(static::$table, $param, $limit, $offset);
			return $rs->result_array();
		} catch (Exception $e) {
			die($e->getMessage());
			$this->session->set_flashdata('error', $e->getMessage());
			redirect('dashboard');
		}
	}


}
?>