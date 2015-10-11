<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Frontend_Controller extends MX_Controller {

	public $data=array();
	public function __construct()
	{
		
		// echo $this->db->hostname;
		// echo $this->db->username;
		// echo $this->db->password;
		// echo $this->db->database;
		// die('ok');

		try {
			parent::__construct();
			// if(ENVIRONMENT=='development' or $this->config->item('enabe_profiler')==1){
			// 	// $this->output->enable_profiler('config');
			// }		
			$this->load->helper(array('form','text','my_text','my_date','my_table','my_dashboard','my_file','my_ui'));
			
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

			// error handling when there is no signup_user_id
			if(uri_string()!=''){
				if(uri_string()=='campaign' or uri_string()=='campaign/personal_details'){
					if(!$this->session->userdata('signup_user_id'))
						throw new Exception("Session not found", 1);				
				}
			}
			$this->breadcrumb->append_crumb('Dashboard',base_url('donee'));


		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Error while signup, '.$e->getMessage());
			redirect();			
		}
		// echo "inside ".__function__." of class:".get_class()."<br/>";
	}

}
