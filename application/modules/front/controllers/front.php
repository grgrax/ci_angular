<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class front extends Frontend_Controller {

	const MODULE='front/';

	protected $active_menu_url='';
	protected $active_model='';
	protected $active_template='';
	
	function __construct()
	{
		$this->load->model('menu/menu_m');
		$this->load->model('page/page_types_m');
		$this->active_model=$this->menu_m;
		$this->data['content']='';
		parent::__construct();
	}


	public function index($menu_url='home')
	{
		try {
			// $this->active_menu_url=$this->uri->segment(1,'home');
			$this->active_menu_url=$menu_url;
			if (!$this->active_menu_url) throw new Exception();
			switch ($this->active_menu_url) {
				case 'home':{
					$this->_home();
					break;				
				}
				default:{
					$response=$this->_read_from_model();
					if(!$response['success']) throw new Exception($response['data'], 1);
					$template_id=$response['data']['page_type_id'];
					$this->data['menu']=$menu=$response['data'];
					$template=$this->page_types_m->read_row($template_id);
					
					$this->active_template=$template['name'];
					
					if($menu['article_id']){						
						$this->data['article']=$this->article_m->read_rows_by(array('id'=>$menu['article_id'],'status'=>article_m::PUBLISHED),1);
						if(count($this->data['article'])==0) $this->active_template='template_content_not_found';
						// show_pre($this->data['article']);
						// die;
					}
					elseif($menu['category_id']){
						$this->data['category']=$this->category_m->read_rows_by(array('id'=>$menu['category_id'],'status'=>category_m::PUBLISHED),1);
						// show_pre($this->data['category']);
						// echo count($this->data['category']);
						if(count($this->data['category'])==0) $this->active_template='template_content_not_found';
						$this->data['articles']=get_articles_widget(array('category_id'=>$menu['category_id'],'order_by'=>'order'));	
						// show_pre($this->data['articles']);
						// die;
					}
					if($template['name']=='gallery'){
						$this->data['path']=$config['path']="uploads/tinyMCE/main/gallery";
						$config['file_types']=array('jpg','png','gif','jpeg');
						$this->data['gallery_response']=$gallery_response=get_folder_files($config);
					}elseif($template['name']=='blank' || $template['name']=='timeline'){
						$this->active_template='template_content_not_found';
					}
					break;
				}
			}
		} catch (Exception $e) {
			log_message('error', 'Could not load template ' . $this->active_template .' in file ' . __FILE__ . ' at line ' . __LINE__);
			$this->active_template='404';
		}
		$this->data['subview']=$this->active_template;
		// die;
		// show_pre($this);
		$this->load->view('front/main_layout',$this->data);
	}

	public function _home(){
		$response=$this->_read_from_model();
		if(!$response['success']) throw new Exception($response['data'], 1);
		$this->data['content']=$response['data'];
		$this->active_template='home';
	}

	public function _read_from_model(){
		$response['success']=false;
		$response['data']='Error Processing Request';
		if(!$this->active_menu_url) return $response;
		$menu=$this->active_model->read_rows_by(array('url'=>$this->active_menu_url),1);
		if($menu) {
			$response['success']=true;
			$response['data']=$menu;
		}
		else{
			$response['data']='menu not found';
		}
		// show_pre($response);
		// die;
		return $response;		
	}

}

/* End of file user.php */
/* Location: ./application/modules/user/controllers/user.php */