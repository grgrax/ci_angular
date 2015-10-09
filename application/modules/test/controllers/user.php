<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Make sure to load the Facebook SDK for PHP via composer or manually

class user extends Frontend_Controller {

	public $data;
	const MODULE='test/';

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','breadcrumb'));
		$this->data['link']=base_url().self::MODULE;
		$this->load->model('user/user_m');
	}

	// public function index(){
	// 	$this->data['users']=$this->user_m->read_all_active();
	// 	$this->data['subview']=self::MODULE.'user/list_ajax';
	// 	$this->load->view('front/main_layout',$this->data);		
	// }

	public function index(){
		$this->data['users']=$this->user_m->read_all_active();
		$this->data['subview']=self::MODULE.'user/index';
		$this->load->view('front/main_layout',$this->data);		
	}


	public function add()
	{	
		$response['status'] = "success";
		$response['data'] = null;
		try {
			if($this->input->post())
			{
				$this->data['insert_data']=array(
					'group_id'=>1,
					'username'=>$this->input->post('username'),
					'email'=>$this->input->post('email')
					);
				$this->user_m->create_row($this->data['insert_data']);
				$response['message'] = "User added successfully.";			
			}
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = $e->getMessage();
		}
		echo json_encode($response);
	}

	public function edit($id=FALSE)
	{
		
		$response['status'] = "success";
		$response['data'] = null;
		try {
			if(!$id) throw new Exception("Error Processing Request", 1);
			$this->data['user']=$this->user_m->read_row($id);
			if($this->input->post())
			{
				// $rules=$this->article_m->set_rules();
				// $this->form_validation->set_rules($rules);
				// if($this->form_validation->run($this)===TRUE)
				// {
				$this->data['update_data']=array(
					'username'=>$this->input->post('username'),
					'email'=>$this->input->post('email')
					);
				$this->user_m->update_row($id,$this->data['update_data']);
				// }
				$response['message'] = "User updated successfully.";			
			}
			if(!$this->data['user']) throw new Exception("No user found", 1);
			$response['data'] = $this->data['user'];
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = $e->getMessage();
		}
		// show_pre($response);
		echo json_encode($response);
		// echo json_encode($this->data['user']);
	}

	public function delete($id=FALSE)
	{
		
		$response['status'] = "success";
		try {
			if(!$id) throw new Exception("Error Processing Request", 1);
			$this->data['user']=$this->user_m->read_row($id);
			if(!$this->data['user']) throw new Exception("no data found", 1);
			$this->data['update_data']=array(
				'status'=>3,
				);
			$this->user_m->update_row($id,$this->data['update_data']);
				// }
			$response['message'] = "User deleted successfully.";			
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = $e->getMessage();
		}
		// show_pre($response);
		echo json_encode($response);
		// echo json_encode($this->data['user']);
	}


}


/* End of file sample.php */
/* Location: ./application/modules/sample/controllers/sample.php */




