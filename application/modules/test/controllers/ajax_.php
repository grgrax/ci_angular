<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Make sure to load the Facebook SDK for PHP via composer or manually

class ajax extends Frontend_Controller {

	public $data;
	const MODULE='test/';

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','breadcrumb'));
		$this->data['link']=base_url().self::MODULE;
		$this->load->model('user/user_m');
	}


	public function user(){
		$this->data['subview']=self::MODULE.'user/ajax/list';
		$result=$this->load->view($this->data['subview'],$this->data,true);	
		echo $result;	
	}


	public function group(){
		$this->data['subview']=self::MODULE.'group/ajax/list';
		$result=$this->load->view($this->data['subview'],$this->data,true);	
		echo $result;	
	}


}


/* End of file sample.php */
/* Location: ./application/modules/sample/controllers/sample.php */




