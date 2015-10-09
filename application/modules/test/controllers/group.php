<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Make sure to load the Facebook SDK for PHP via composer or manually

class group extends Frontend_Controller {

	public $data;
	const MODULE='test/';

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','breadcrumb'));
		$this->data['link']=base_url().self::MODULE;
		$this->load->model('group/group_m');
	}


	public function index(){
	}


	public function add()
	{	
		$response['status'] = "success";
		$response['data'] = null;
		try {
			if($this->input->post())
			{
				$rules=array(
					array(
						'field'=>'groupname',
						'label'=>'Group Name',
						'rules'=>'trim|xss_clean|required|alpha'
						),
					);
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{				
					$this->data['insert_data']=array(
						'name'=>$this->input->post('groupname'),
						'desc'=>$this->input->post('desc')
						);
					$this->group_m->create_row($this->data['insert_data']);
					$response['message'] = "Group added successfully.";	
				}
				else{
					throw new Exception(validation_errors(), 1);					
				}		
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
			$this->data['group']=$this->group_m->read_row($id);
			if($this->input->post())
			{
				$rules=array(
					array(
						'field'=>'groupname',
						'label'=>'Group Name',
						'rules'=>'trim|xss_clean|required|alpha'
						),
					);
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{				
					$this->data['update_data']=array(
						'name'=>$this->input->post('groupname'),
						'desc'=>$this->input->post('desc')
						);
					$this->group_m->update_row($id,$this->data['update_data']);
					$response['message'] = "Group updated successfully.";	
				}		
				else{
					throw new Exception(validation_errors(), 1);					
				}		
			}
			if(!$this->data['group']) throw new Exception("No group found", 1);
			$response['data'] = $this->data['group'];
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = $e->getMessage();
		}
		echo json_encode($response);
	}

	public function delete($id=FALSE)
	{
		
		$response['status'] = "success";
		try {
			if(!$id) throw new Exception("Error Processing Request", 1);
			$this->data['group']=$this->group_m->read_row($id);
			if(!$this->data['group']) throw new Exception("no data found", 1);
			$this->data['update_data']=array(
				'status'=>3,
				);
			$this->group_m->update_row($id,$this->data['update_data']);
			$response['message'] = "Group deleted successfully.";			
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = $e->getMessage();
		}
		echo json_encode($response);
	}


}


/* End of file sample.php */
/* Location: ./application/modules/sample/controllers/sample.php */




