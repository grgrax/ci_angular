<?php
class menu_m extends MY_Model
{

	static $table='tbl_menus';

	public $rules=array(
		array(
			'field'=>'parent_menu',
			'label'=>'Parent Menu',
			'rules'=>'trim|number|xss_clean'
			),
		array(
			'field'=>'page_type',
			'label'=>'Type',
			'rules'=>'trim|number|required|xss_clean'
			),
		array(
			'field'=>'name',
			'label'=>'Menu Name',
			'rules'=>'trim|required|alpha_space_menu|xss_clean'
			),
		array(
			'field'=>'content',
			'label'=>'Menu Content',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'category',
			'label'=>'Category',
			'rules'=>'trim|number|xss_clean'
			),
		array(
			'field'=>'article',
			'label'=>'Article',
			'rules'=>'trim|number|xss_clean'
			),
		array(
			'field'=>'status',
			'label'=>'Status',
			'rules'=>'trim|required|number|xss_clean'
			),
		);

	const PENDING=1;
	const ACTIVE=2;
	const BLOCKED=3;
	const DELETED=4;

	const SIDEBAR_YES='Y';
	const SIDEBAR_NO='N';


	public static function sidebar($key=null){
		$sidebar=array(
			self::SIDEBAR_YES=>'Yes',
			self::SIDEBAR_NO=>'No',
			);
		if(isset($key)) return $sidebar[$key];
		return $sidebar;
	}

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


	protected $path;
	public function __construct(){
		$this->path=base_url()."uploads/pics/testimonials/";
	}

	function read_all()
	{
		$this->db->select()
		->from(self::$table)
		->where("status != ",3)
		->order_by('parent_id','asc')
		->order_by('order','asc');
		$rs=$this->db->get();
		return $rs->result_array();				 
	}

	//order
	function buildTree(array $elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['parent_id'] == $parentId) {
				$children = $this->buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}

		return $branch;
	}
	function read_menus_for_ordering()
	{
		$this->db->select();
		$this->db->from(self::$table);
		$this->db->where("status",self::ACTIVE);
		$this->db->order_by("order", "asc");
		$query = $this->db->get();
		$menus=$query->result_array();
		$final_menus = $this->buildTree($menus);
		// show_pre($final_menus);
		return ($final_menus);
	}
	public function save_order($menus)
	{
		$response['success']=false;
		$response['data']='Error Processing Request';
		try {
			if (count($menus)) {
				foreach ($menus as $order => $menu) {
					$id=$menu['item_id'];
					if ($id) {
						$data = array(
							'parent_id' =>  $menu['parent_id']?$menu['parent_id']:NULL,
							'order' => $order,
							'level'=>$menu['depth']-1,
							);
						$this->db->set($data)->where('id',$id)->update(self::$table);
					}
				}
				$response['success']=true;
				$response['data']="menu order successfully update";
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
		$this->db->select('id,name,slug')
		->from(self::$table)
		->where("status =".self::ACTIVE." and parent_id is NULL")
		->order_by('order','asc');
		$rs=$this->db->get();
		return $rs->result_array();				 
	}

	public function get_parent_name($id=NULL)
	{
		$this->db->select('name')->from(self::$table)->where("id =$id")->limit('1');
		$rs=$this->db->get();
		return $rs->row('name');				 				 
	}

	function count_rows()
	{
		$this->db->select()
		->from(self::$table)
		->where("status != ",3)
		->order_by('id','desc');
		$rs=$this->db->get();
		return $rs->num_rows();				 
	}	

	function nested_childs($id=null)
	{
		$sql="select max(level) as nested_child
		from ".static::$table." where id 
		in(select id from ".static::$table." where parent_id in (select id from ".static::$table." where parent_id=$id)) and status = ".self::ACTIVE;
		$rs=$this->db->query($sql);	
		return $rs->result_array();				 
	}

	function create_row($data)
	{
/*		show_pre($data);
		exit;
*/		$this->db->insert(self::$table
		,$data);
}
function read_row($id)
{
	$this->db->select()
	->from(self::$table)
	->where('id',$id);
	$rs=$this->db->get();
	return ($rs->first_row('array'));
}
public function read_row_by_slug($slug='')
{
	if(!$slug) return false;
	$this->db->select()
	->from(self::$table)
	->where('slug',$slug);
	$rs=$this->db->get();
	if($rs->num_rows()==0)
		return false;
	return ($rs->first_row('array'));
}





function update_row($id,$data)
{
	try {
		show_pre($data);
			//exit;
		$this->db->where('id',$id);
		$this->db->update(self::$table,$data);
		echo $this->db->last_query();
	} catch (Exception $e) {
		echo $e->getMessage();			
	}
}
function delete_row($id)
{
	$this->db->where('id',$id);
	$this->db->update(self::$table,array('status' =>self::DELETED));

}

public function set_rules(array $escape_rules=NUll){
	if($escape_rules && is_array($escape_rules)){
		foreach($this->rules as $rule){
			if(in_array($rule['field'],$escape_rules)) continue;
			$applied_rules[]=$rule;
		}
		return $applied_rules;
	}
	return $this->rules;
}

function filter_rows_by($param,$limit=null,$offset=null){
	try {
		if(!is_array($param)) throw new Exception("Error Processing Request, no array", 1);	
		$db_param=array();
		$this->db->select("
			m.id,m.name,m.slug,m.category_id,m.article_id,m.created_at,m.updated_at,m.level,m.order,m.slug,m.status,m.sidebar,m.url,
			pt.name as page_type,pt.id as page_type_id,
			u.username
			");
		$this->db->join('tbl_page_types as pt','pt.id=m.page_type_id','inner');			
		$this->db->join('tbl_users as u','u.id=m.author','inner');			
		$this->db->where('m.status !=',menu_m::DELETED);
		$this->db->where('u.status !=',user_m::DELETED);

		$this->db->where('m.parent_id',null);

		if(array_key_exists('author',$param)){
			$db_param['m.author']=$param['author'];
		}
		if(array_key_exists('name',$param)){
			$db_param['m.name like']=$param['name']."%";
		}
		$this->db->order_by('m.order','asc');			
		$rs = $this->db->get_where(self::$table." as m", $db_param, $limit, $offset);				
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
?>