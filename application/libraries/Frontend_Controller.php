<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Frontend_Controller extends MX_Controller {

	public $data=array();
	public function __construct()
	{
		
		try {
			parent::__construct();
			if(ENVIRONMENT=='development' or $this->config->item('enabe_profiler')==1){
				// $this->output->enable_profiler('config');
			}		
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Error while signup, '.$e->getMessage());
			redirect();			
		}
	}

}
