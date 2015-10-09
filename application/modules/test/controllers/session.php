<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class session extends Frontend_Controller {

	public $data;
	const MODULE='test/';

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','breadcrumb'));
		$this->data['link']=base_url().self::MODULE;
	}

	public function index(){
		try {
			$this->session->set_userdata('s1',array('s1'=>date('d-m-Y H:i:s')));			
		} catch (Exception $e) {
			die($e->getMessage());			
		}
	}

	public function s2(){
		try {
			$s1=$this->session->userdata('s1');
			if(!$s1) throw new Exception("s1 not set", 1);
			$new_s1['s1.1']=date('d-m-Y H:i:s');			
			$new_s1_temp=array_merge($s1,$new_s1);
			$this->session->set_userdata('s1',$new_s1_temp);	
			$this->session->set_userdata('s2',array('s2'=>date('d-m-Y H:i:s')));	
		} catch (Exception $e) {
			$this->session->flashdata('error',$e->getMessage());
			redirect('test/session/index');		
		}
	}

	public function s3(){
		try {
			$s2=$this->session->userdata('s2');
			if(!$s2) throw new Exception("s2 not set", 1);						
			$this->session->set_userdata('s3',array('s3'=>date('d-m-Y H:i:s')));			
		} catch (Exception $e) {
			$this->session->flashdata('error',$e->getMessage());
			redirect('test/session/s2');		
		}
	}




}


/* End of file sample.php */
/* Location: ./application/modules/sample/controllers/sample.php */




