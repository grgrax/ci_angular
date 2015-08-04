<?php
class todo_m extends CI_Model
{

	protected $table='tbl_articles';

	public $rules=array(
		array(
			'field'=>'name',
			'label'=>'Name',
			'rules'=>'trim|required|is_unique[tbl_articles.name]|min_length[3]|xss_clean',
			),
		array(
			'field'=>'content',
			'label'=>'Content',
			'rules'=>'trim|required|xss_clean',
			),
		);

	const UNPUBLISHED=1;
	const PUBLISHED=2;
	const DELETED=3;

	const file_path='todo/';


	static function status($key=null){
		$status=array(
			self::UNPUBLISHED=>'UNPUBLISHED',
			self::PUBLISHED=>'PUBLISHED',
			self::DELETED=>'DELETED',
			);
		if(isset($key)) return $status[$key];
		return $status;
	}

	static function actions($key=null){
		$actions=array(
			self::PUBLISHED=>'PUBLISHED',
			self::UNPUBLISHED=>'UNPUBLISHED',
			);
		if(isset($key)) return $actions[$key];
		return $actions;
	}

	function read_all($total=0,$start=0)
	{
		$this->db->select()
		->from($this->table)
		// ->where("status != ",self::DELETED)
		->order_by("id","desc")
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
	function read_all_filter($limit=0,$offset=0,$filters=null)
	{
		if(!$filters)
			$filters["status !="]=self::DELETED;
		show_pre($filters);
		$db_filters=array();
		foreach ($filters as $key => $value) {
			if($key=='status')
				$db_filters[$key]=$value;
			else if($value)
				$db_filters[$key]=$value;
		}
		$rs = $this->db->get_where($this->table, $db_filters, $limit, $offset);
		echo $this->db->last_query();
		return $rs->result_array();				 
	}

	function create_row($data)
	{
		$this->db->insert($this->table,$data);
	}

	function read_rows_by($param,$limit=null,$offset=null){
		try {
			if(!is_array($param)) throw new Exception("Error Processing Request, no array", 1);	
			$rs = $this->db->get_where($this->table, $param, $limit, $offset);
			if($limit==1 && $rs->num_rows()==1)
				return $rs->first_row('array');
			else
				return $rs->result_array();	
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());			
			redirect();
		}	
	}

	function update_row($id,$data)
	{
		try {
			$this->db->where('id',$id);
			$this->db->update($this->table,$data);
		} catch (Exception $e) {
			echo $e->getMessage();			
		}
	}

	function delete_row($id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->table,array('status' =>self::DELETED));

	}

	function get_rules(array $get_rules=NUll){
		if(!$get_rules){
			return $this->rules;
		}
		else{
			$applied_rules=[];
			foreach($this->rules as $rule){
				if(in_array($rule['field'],$get_rules)) 
					$applied_rules[]=$rule;
			}
			return $applied_rules;
		}
	}

}
?>