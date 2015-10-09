<?php
class article_m extends MY_Model
{

	static $table='tbl_articles';

	public $rules=array(
		array(
			'field'=>'content',
			'label'=>'Article content',
			'rules'=>'trim|required|xss_clean'
			),
		array(
			'field'=>'category',
			'label'=>'Category',
			'rules'=>'trim|number|xss_clean'
			),
		array(
			'field'=>'url',
			'label'=>'Url',
			'rules'=>'trim|prep_url|xss_clean'
			),
		array(
			'field'=>'image',
			'label'=>'Image',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'image_title',
			'label'=>'Image Title',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'video',
			'label'=>'Video',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'video_title',
			'label'=>'Video Title',
			'rules'=>'trim|alpha_space|xss_clean'
			),
		array(
			'field'=>'video_url',
			'label'=>'Video Url',
			'rules'=>'trim|prep_url|xss_clean'
			),
		array(
			'field'=>'embed_code',
			'label'=>'Embed Code',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'meta_key',
			'label'=>'Meta Keywords',
			'rules'=>'trim|alpha_space|xss_clean'
			),
		array(
			'field'=>'meta_desc',
			'label'=>'Meta Description',
			'rules'=>'trim|alpha_space|xss_clean'
			),
		array(
			'field'=>'meta_robots',
			'label'=>'Meta Robots',
			'rules'=>'trim|alpha_space|xss_clean'
			),
		);

const UNPUBLISHED=0;
const PUBLISHED=1;
const BLOCKED=2;
const DELETED=3;

const WIDGET_MESSAGE='messages';
const WIDGET_PROJECT='projects';
const WIDGET_NEWS='news';

const file_path='articles/';

public static function status($key=null){
	$status=array(
		self::PUBLISHED=>'Published',
		self::UNPUBLISHED=>'Unpublished',
		self::BLOCKED=>'Blocked',
		self::DELETED=>'Deleted',
		);
	if(isset($key)) return $status[$key];
	return $status;
}

public static function actions($key=null){
	$actions=array(
		self::PUBLISHED=>'PUBLISHED',
		self::UNPUBLISHED=>'UNPUBLISHED',
		self::BLOCKED=>'BLOCKED',
		self::DELETED=>'DELETED',
		);
	if(isset($key)) return $actions[$key];
	return $actions;
}

public function __construct(){
}

function read_all($total=0,$start=0)
{
	$this->db->select()
	->from(self::$table)
	->where("status != ",self::DELETED)
	->order_by("id","desc")
	->limit($total,$start);
	$rs=$this->db->get();
	return $rs->result_array();				 
}

function read_all_published()
{
	$this->db->select()
	->from(self::$table)
	->where("status != ",self::DELETED)
	->where("status = ",self::PUBLISHED)
	->order_by("id","desc");
	$rs=$this->db->get();
	return $rs->result_array();				 
}

function read_all_published_of_category($cat_id=null)
{
	$this->db->select()
	->from(self::$table)
	->where("status != ",self::DELETED)
	->where("status = ",self::PUBLISHED)
	->where("category_id = ",$cat_id)
	->order_by("id","desc");
	$rs=$this->db->get();
	return $rs->result_array();				 
}

function read_articles_of_category($cat_id=null,$total=0,$start=0)
{
	$this->db->select()
	->from(self::$table)
	->where("status != ",self::DELETED)
	->where("status = ",self::PUBLISHED)
	->where("category_id = ",$cat_id)
	->order_by("id","desc")
	->limit($total,$start);
	$rs=$this->db->get();
	return $rs->result_array();				 
}

function count_articles_of_category($cat_id=null)
{
	$this->db->select()
	->from(self::$table)
	->where("status != ",self::DELETED)
	->where("status = ",self::PUBLISHED)
	->where("category_id = ",$cat_id)
	->order_by("id","desc");
	$rs=$this->db->get();
	return $rs->num_rows();				 
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
function create_row($data)
{
	$this->db->insert(self::$table,$data);
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
function read_row_by_name($name='')
{
	if(!$name) return false;
	$this->db->select()
	->from(self::$table)
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
		$this->db->update(self::$table,$data);
	} catch (Exception $e) {
		echo $e->getMessage();			
	}
}
function delete_row($id)
{
	$this->db->where('id',$id);
	$this->db->update(self::$table,array('status' =>self::DELETED));

}


public function set_rules($escape_rules=array(''),$edit=false){
	// echo count($escape_rules);
	if(count($escape_rules)){
		foreach($this->rules as $key=>$rule){
			if(in_array($rule['field'],$escape_rules)) continue;
			$applied_rules[]=$rule;
		}
		return $applied_rules;
	}
	return $this->rules;
}


function set_rules_old($escape_rules=array(),$edit=false,$id=null){
	if(is_array($escape_rules)){
		foreach($this->rules as $key=>$rule){
			if($key==0 && $edit && !$id){
				$rule['rules'].="|is_name_unique[tbl_articles,".$id."]";
				// $rule['rules'].="|is_name_unique['tbl_articles']";
// isAlreadyRegistered[".$user->id()."]"
// $this->form_validation->set_rules('email', 'Email', "required|valid_email|isAlreadyRegistered[".$user->id()."]");
				show_pre($rule);
				exit;
			}
			if(in_array($rule['field'],$escape_rules)) continue;
			$applied_rules[]=$rule;
		}
		die("in");
		return $applied_rules;
	}
	else
		die("out");
	exit;
	return $this->rules;
}

//new
function filter_rows_by($param,$limit=null,$offset=null){
	try {
		if(!is_array($param)) throw new Exception("Error Processing Request, no array", 1);	
		$db_param=array();
		$this->db->select("
			a.id,a.category_id,a.order,a.name,a.status,a.title,a.slug,a.content,a.image,a.image_title,a.image_title_2,a.video,
			a.video_title,a.video_url,a.embed_code,a.created_at,a.author,a.modified_by,a.meta_key,a.meta_desc,a.meta_robots,a.url1,
			a.url2,a.updated_at,
			c.name as category_name,c.status,c.slug as category_slug,
			u.username,u.status
			");
		$this->db->join('tbl_categories as c','c.id=a.category_id','inner');			
		$this->db->join('tbl_users as u','u.id=a.author','inner');			
		$this->db->where('a.status !=',user_m::DELETED);
		$this->db->where('c.status !=',category_m::DELETED);
		$this->db->where('u.status !=',user_m::DELETED);

		if(array_key_exists('category_id',$param)){
			$db_param['a.category_id']=$param['category_id'];
		}
		if(array_key_exists('author',$param)){
			$db_param['a.author']=$param['author'];
		}
		if(array_key_exists('name',$param)){
			$db_param['a.name like']=$param['name']."%";
		}
		// show_pre($db_param);
		if(array_key_exists('order_by', $param)){
			$this->db->order_by($param['order_by'],isset($param['order'])?$param['order']:'asc');
		}
		else
			$this->db->order_by('a.id','desc');
		$rs = $this->db->get_where(self::$table." as a", $db_param, $limit, $offset);				
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