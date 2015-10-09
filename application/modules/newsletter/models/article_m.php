<?php
class article_m extends CI_Model
{

	protected $table='tbl_articles';

	public $rules=array(
		array(
			'field'=>'content',
			'label'=>'article content',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'category',
			'label'=>'category',
			'rules'=>'trim|number|xss_clean'
			),
		array(
			'field'=>'image',
			'label'=>'image',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'image_title',
			'label'=>'image title',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'video',
			'label'=>'video',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'video_title',
			'label'=>'video title',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'video_url',
			'label'=>'video url',
			'rules'=>'trim|xss_clean|url'
			),
		array(
			'field'=>'embed_code',
			'label'=>'embed code',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'meta_keywords',
			'label'=>'meta keywords',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'meta_description',
			'label'=>'meta description',
			'rules'=>'trim|xss_clean'
			),
		array(
			'field'=>'meta_robots',
			'label'=>'meta robots',
			'rules'=>'trim|xss_clean'
			),
		);

const UNPUBLISHED=0;
const PUBLISHED=1;
const BLOCKED=2;
const DELETED=3;

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
	->from($this->table)
	->where("status != ",self::DELETED)
	->order_by("id","desc")
	->limit($total,$start);
	$rs=$this->db->get();
	return $rs->result_array();				 
}

function read_all_published()
{
	$this->db->select()
	->from($this->table)
	->where("status != ",self::DELETED)
	->where("status = ",self::PUBLISHED)
	->order_by("id","desc");
	$rs=$this->db->get();
	return $rs->result_array();				 
}

function read_all_published_of_category($cat_id=null)
{
	$this->db->select()
	->from($this->table)
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
	->from($this->table)
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
	->from($this->table)
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
	->from($this->table)
	->where("status != ",3)
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
public function read_row_by_slug($slug='')
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
	} catch (Exception $e) {
		echo $e->getMessage();			
	}
}
function delete_row($id)
{
	$this->db->where('id',$id);
	$this->db->update($this->table,array('status' =>self::DELETED));

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


}
?>