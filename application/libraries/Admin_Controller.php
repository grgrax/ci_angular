<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MX_Controller {

	public $template_data='';
	public function __construct()
	{
		parent::__construct();
		if(ENVIRONMENT=='development' or $this->config->item('enabe_profiler')==1){
			// $this->output->enable_profiler('config');
		}		

		$this->template_data='';
		
		// $this->load->library(array('form_validation','session','breadcrumb','form_validation'));

		// show_pre($this->session->all_userdata());
					// show_pre($this->session->userdata);
			// die;

		$admin=get_session('admin');
		
		// show_pre($admin);
		// die('in');

		if(!$admin){
			// die("nn");
			redirect('auth/login');
		}
		else{
			$this->template_data['site_name']=config_item('site_name');
			$this->template_data['powered_by']=config_item('powered_by');
			$this->template_data['errors']='';
			$this->load->helper(array('form','text','my_text','my_date','my_table','my_dashboard','my_file','my_ui'));

			// $this->load->helper(array('setting/setting','user/user','article/article'));
			// $this->load->config('article/article_config', TRUE);

			//load all modules models and helpers
			$modules=array('group','user','setting','category','article','menu');
			foreach ($modules as $module) {
				$model=$module.'/'.$module.'_m';
				$helper=$module.'/'.$module;
				// echo "module:$module";
				// echo ", model:$model";
				// echo ", helper:$helper";
				// echo "<hr/>";
				$this->load->model($model);
				$this->load->helper($helper);
			}
			//load all modules models and helpers
			// die;
			//load all modules models and helpers
			file_helper_init();
			$this->breadcrumb->append_crumb('Dashboard',base_url('dashboard').'');			
			// die("y");
			// refresh permission
			$group_permsissions=$this->load->model('group/group_permission_m')->read_row($admin['group_id']);
			$gps=array();
			foreach ($group_permsissions as $k=>$v) {
				$gps[]=$v['slug'];
			}
			unset($admin['group_permsissions']);
			$admin['group_permsissions']=$gps;
			$this->session->set_userdata('admin',$admin);
			// refresh permission
			
		}
	}	

	public function index()
	{
		echo "inside ".__FUNCTION__." of class:".get_class();
	}


}

/* End of file Admin_Controller.php */
/* Location: ./application/libraries/Admin_Controller.php */