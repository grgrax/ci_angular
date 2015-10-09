<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class permission extends Admin_Controller {

	const MODULE='group/permission/';

	function __construct()
	{
		parent::__construct();
		$this->load->model('permission_m');
		$this->template_data['permission_m']=$this->permission_m;
		$this->template_data['url']=base_url().self::MODULE;
		$this->template_data['permissions']=$this->permission_m->get_permissions();
		$this->breadcrumb->append_crumb('List Permissions',base_url().self::MODULE.'index');
	}

	function index($offset=0)
	{
		$per_page=100;
		$total=$this->permission_m->count_rows();
		$this->template_data['rows']=$this->permission_m->read_all(TRUE,$per_page,$offset);
		if($total>$per_page){
			$this->load->library('pagination');
			$config['base_url']=base_url().self::MODULE."index";
			$config['total_rows']=$total;
			$config['per_page']=$per_page;
			$config['prev']='Previous';
			$config['next']='Next';
			$this->pagination->initialize($config);
			$this->template_data['pages']=$this->pagination->create_links();
		}
		$this->template_data['total']=$total;
		$this->template_data['offset']=$offset;
		$this->template_data['subview']=self::MODULE.'list';
		$this->load->view('admin/main_layout',$this->template_data);
	}

	function add($parent_slug=FALSE)
	{
		try {
			if($parent_slug){
				$this->template_data['parent_permission']=$this->permission_m->read_row_by_slug($parent_slug);
				if(!$this->template_data['parent_permission']){
					$this->session->set_flashdata('error', "Permission counldn't be found");
					throw new Exception("Permission counldn't be found", 1);
				}
			} 
			if($this->input->post())
			{
				$this->form_validation->set_rules($this->permission_m->set_rules_except());
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['insert_data']=array(
						'name'=>$this->input->post('name'),
						'slug'=>get_slug($this->input->post('name')),
						'desc'=>$this->input->post('desc')
						);
					if($this->input->post('parent_permission_id'))
						$this->template_data['insert_data']['parent_permission_id']=$this->input->post('parent_permission_id');
					$this->permission_m->create_row($this->template_data['insert_data']);
					$this->session->set_flashdata('success', 'Permission added successfully');
					$this->controller_redirect();				
				}
				else{
					throw new Exception("Could not add permission <hr/>");
				}
			}			
		} catch (Exception $e) {
			if($e->getMessage()=="Permission counldn't be found")
				redirect('group/permission');
			$this->session->set_flashdata('success', 'permission added successfully');
		}
		$this->breadcrumb->append_crumb('Add','add');
		$this->template_data['subview']=self::MODULE.'add';
		$this->load->view('admin/main_layout',$this->template_data);
	}

	function edit($id)
	{
		try {
			if(!$id) throw new Exception("Invalid Parameter", 1);
			$this->template_data['row']=$this->permission_m->read_row($id);
			show_pre($this->template_data['row']);
			exit;
			if($this->input->post())
			{
				$this->form_validation->set_rules($this->permission_m->set_rules());
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['update_data']=array(
						'name'=>$this->input->post('name'),
						'slug'=>get_slug($this->input->post('name')),
						'desc'=>$this->input->post('desc'),
						);
					$this->permission_m->update_row($id,$this->template_data['update_data']);
					$this->session->set_flashdata('success', 'Permission updated successfully');
					$this->controller_redirect();				
				}
				else{
					throw new Exception("Could not add Permission <hr/>");
				}
			}			
		} catch (Exception $e) {

		}
		$this->breadcrumb->append_crumb('Edit','edit');
		$this->template_data['subview']=self::MODULE.'edit';
		$this->load->view('admin/main_layout',$this->template_data);
	}

	function updateAll()
	{
		try {
			if($this->input->post())
			{
				//set validation rules
				foreach ($this->input->post() as $key => $values) {
					foreach ($values as $fn=>$field_val) {
						echo $field_name="permission[$fn][name]";
						$this->form_validation->set_rules($field_name,'Name','trim|required|xss_clean');
					}
					continue;
				}
				//run validation
				if($this->form_validation->run($this)===TRUE)
				{
					foreach ($this->input->post() as $key => $values) {
						foreach ($values as $id=>$field) {
							$this->template_data['update_data']=array(
								'id'=>$id,
								'name'=>$field['name'],
								'slug'=>get_slug($field['name']),
								'desc'=>$field['desc'],
								);
							$this->permission_m->update_row($id,$this->template_data['update_data']);
						}
					}
					$this->session->set_flashdata('success', 'Permission updated successfully');
				}
				else{
					throw new Exception("Could not update Permission.");
				}
			}			
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
		}
		$this->controller_redirect();
	}

	function action($action_id=NULL,$id=NULL){
		try{
			if(!$action_id || !$id) throw new Exception('Invalid paramter');
			switch($action_id){
				case permission_m::DELETED:
				{
					$status=permission_m::DELETED;
					break;
				}
			}
			$this->template_data=array('status'=>$status);
			$this->permission_m->update_row($id,$this->template_data);
			$this->session->set_flashdata('success', 'Permission '.permission_m::status($action_id).' successfully');
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
		$this->controller_redirect();				
	}

	function delete($parent_slug=FALSE)
	{
		try {
			if($parent_slug){
				$this->template_data['permission']=$this->permission_m->read_row_by_slug($parent_slug);
				if(!$this->template_data['permission']){
					throw new Exception("Permission counldn't be found", 1);
				}
				$this->permission_m->delete_row($this->template_data['permission']['id']);
				$this->session->set_flashdata('success', 'Permission deleted successfully');
				$this->controller_redirect();				
			} 
		} catch (Exception $e) {
			$this->session->set_flashdata('success', "Permission couldn't be deleted");
			$this->session->set_flashdata('error', $e->getMessage());
		}
	}


	function controller_redirect(){
		$this->template_data['url']=base_url().self::MODULE;
		redirect($this->template_data['url']);				
	}

}	
