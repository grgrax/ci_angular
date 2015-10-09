<?php
class category_m extends MY_Model
{

	static $table='tbl_categories';

	public $rules=array(
		array(
			'field'=>'content',
			'label'=>'Category content',
			'rules'=>'trim|xss_clean'
			),
		);

	const UNPUBLISHED=0;
	const PUBLISHED=1;
	const DELETED=2;

	const file_path='categories/';

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

	public function __construct(){
		$this->path=base_url()."uploads/pics/testimonials/";
	}

	function read_all($total=0,$start=0)
	{
		$this->db->select()
		->from(self::$table)
		->where("status != ",self::DELETED)
		->order_by('id','desc')
		->limit($total,$start);
		$rs=$this->db->get();
		return $rs->result_array();				 
	}

	function read_all_published()
	{
		$this->db->select()
		->from(self::$table)
		->where("status != ",self::DELETED)
		->where("published = ",self::PUBLISHED)
		->order_by('parent_id','asc')
		->order_by('order','asc');
		$rs=$this->db->get();
		return $rs->result_array();				 
	}

	function read_all_published_childs($cat_id)
	{
		$this->db->select()
		->from($this->table)
		->where("status != ",self::DELETED)
		->where("published = ",self::PUBLISHED)
		->where("parent_id = ",$cat_id)
		->order_by('id','asc')
		->order_by('order','asc');
		$rs=$this->db->get();
		return $rs->result_array();				 
	}


	//order
	function read_categories_for_ordering()
	{

        //$this->db->select('id,parent_id,order');
		$this->db->from($this->table);
		$this->db->order_by("order", "asc");
		$query = $this->db->get();
		$categorys=$query->result_array();
		$final_categorys=array();
		foreach ($categorys as $category) {
			if(!$category['parent_id']){
				$final_categorys[$category['id']]=$category;
			}
			else
			{
				$final_categorys[$category['parent_id']]['children'][]=$category;
			}
		}
		// show_pre($final_categorys);
		return ($final_categorys);
	}
	public function save_order($categorys)
	{
		$response['success']=false;
		$response['data']='Error Processing Request';
		try {
			if (count($categorys)) {
				foreach ($categorys as $order => $category) {
					$id=$category['item_id'];
					if ($id) {
						$data = array(
							'parent_id' =>  $category['parent_id']?$category['parent_id']:NULL,
							'order' => $order);
						$this->db->set($data)->where('id',$id)->update($this->table);
					}
				}
				$response['success']=true;
				$response['data']="category order successfully update";
			}
		} catch (Exception $e) {
			echo $e->getMessage();
			$response['data']=$e->getMessage();
		}
		return $response;
	}


	//order


	public function get_parents()
	{
		$this->db->select('id,name')->from($this->table)->where("status =".self::ACTIVE." and parent_id is NULL");
		$rs=$this->db->get();
		return $rs->result_array();				 
	}

	public function get_parent_name($id=NULL)
	{
		$this->db->select('name')->from($this->table)->where("id =$id")->limit('1');
		$rs=$this->db->get();
		return $rs->row('name');				 				 
	}

	function count_rows()
	{
		$this->db->select()
		->from($this->table)
		->where("status != ",self::DELETED)
		->order_by('id','desc');
		$rs=$this->db->get();
		return $rs->num_rows();				 
	}	
	function create_row($data)
	{
		$this->db->insert($this->table,$data);
	}
	function read_row($id)
	{
		$this->db->select()
		->from($this->table)
		->where('id',$id);
		$rs=$this->db->get();
		return ($rs->first_row('array'));
	}
	function read_row_by_slug($slug='')
	{
		if(!$slug) return false;
		$this->db->select()
		->from($this->table)
		->where('slug',$slug);
		$rs=$this->db->get();
		if($rs->num_rows()==0)
			return false;
		return ($rs->first_row('array'));
	}
	function read_row_by_name($name='')
	{
		if(!$name) return false;
		$this->db->select()
		->from($this->table)
		->where('name',$name);
		$rs=$this->db->get();
		if($rs->num_rows()==0)
			return false;
		return ($rs->first_row('array'));
	}




	function update_row($id,$data)
	{
		try {
			$this->db->where('id',$id);
			$this->db->update($this->table,$data);
			show_pre($data);
			// exit;
		} catch (Exception $e) {
			echo $e->getMessage();			
		}
	}
	function delete_row($id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->table,array('status' =>self::DELETED));

	}

	function filter_rows_by($param,$limit=null,$offset=null){
		try {
			if(!is_array($param)) throw new Exception("Error Processing Request, no array", 1);	
			$db_param=array();
			$this->db->select("
				c.id,c.name,c.content,c.slug,c.image,c.created_at,c.updated_at,c.image_title,
				u.username,u.status
				");
			$this->db->join('tbl_users as u','u.id=c.author','inner');			
			$this->db->where('c.status !=',category_m::DELETED);
			$this->db->where('u.status !=',user_m::DELETED);
			if(array_key_exists('author',$param)){
				$db_param['c.author']=$param['author'];
			}
			if(array_key_exists('name',$param)){
				$db_param['c.name like']=$param['name']."%";
			}

			$this->db->order_by('c.id','desc');			
			$rs = $this->db->get_where(self::$table." as c", $db_param, $limit, $offset);				
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
	public function set_rules(array $escape_rules=NUll){

		//$rules=array();
		if($escape_rules && is_array($escape_rules)){
			//$rules=$mode=="edit"?$this->rules:$this->add_rules;
			foreach($this->rules as $rule){
				if(in_array($rule['field'],$escape_rules)) continue;
				$applied_rules[]=$rule;
			}
			return $applied_rules;
		}
		return $this->rules;
	}



}
?>