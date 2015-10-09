<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class group extends Admin_Controller {

	const MODULE='group/';

	function __construct()
	{
		parent::__construct();
		if(!permission_permit(['administrator-group'])) redirect_to_dashboard();			
		$this->load->model('group_m');
		$this->load->helper(array('group','user/user','group/group_permission'));
		
		$this->template_data['group_m']=$this->group_m;
		$this->template_data['status']=group_m::status();
		$this->template_data['actions']=group_m::actions();
		
		$this->template_data['url']=base_url().self::MODULE;
		$this->param=array('status !='=>group_m::DELETED);
		$this->template_data['groups']=$this->group_m->read_rows_by($this->param);
		$this->breadcrumb->append_crumb('List Groups',base_url().self::MODULE.'index');
	}

	function index($offset=0)
	{
		if(!permission_permit(['list-group'])) redirect_to_dashboard();
		$per_page=25;
		$total=count($this->group_m->read_rows_by($this->param));
		$this->template_data['rows']=$this->group_m->read_rows_by($this->param,$per_page,$offset);


		// show_pre($this->template_data['rows']);
		// die;
		
		if($total>$per_page){
			$this->load->library('pagination');
			$config['base_url']=base_url().self::MODULE."index";
			$config['total_rows']=$total;
			$config['per_page']=$per_page;
			$config['prev']='Previous';
			$config['next']='Next';
			$this->pagination->initialize($config);
			$this->template_data['pages']=$this->pagination->create_urls();
		}
		$this->template_data['total']=$total;
		$this->template_data['offset']=$offset;
		$this->template_data['subview']=self::MODULE.'index';
		$this->load->view('admin/main_layout',$this->template_data);
	}

	function add()
	{
		try {
			if(!permission_permit(array('add-group'))) $this->controller_redirect('Permissioin Denied');
			if($this->input->post())
			{
				$this->form_validation->set_rules(group_m::get_rules());
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['insert_data']=array(
						'name'=>$this->input->post('name'),
						'desc'=>$this->input->post('desc'),
						'slug'=>get_slug($this->input->post('name')),
						'status'=>group_m::ACTIVE,
						);
					if($this->input->post('group'))
						$this->template_data['insert_data']['parent_group_id']=$this->input->post('group');
					$this->group_m->create_row($this->template_data['insert_data']);
					$this->session->set_flashdata('success', 'Group added successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Add','add');
			$this->template_data['subview']=self::MODULE.'add';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt add group, '.$e->getMessage());
			redirect(current_url());
		}
	}

	function edit($slug)
	{
		try {
			if(!permission_permit(array('list-group','edit-group'))) $this->controller_redirect('Permissioin Denied');
			if(!$slug) throw new Exception("Invalid Parameter", 1);
			$this->template_data['row']=$this->group_m->read_row_by_n(array('slug'=>$slug));
			if(!$this->template_data['row']) {
				$this->session->set_flashdata('error', "Invalid Parameter");
				$this->controller_redirect();				
			}
			$id=$this->template_data['row']['id'];
			if($this->input->post())
			{
				$rules=group_m::get_rules(array('desc'));
				if($this->input->post('name')!=$this->template_data['row']['name']){
					$name=array(
						'field'=>'name',
						'label'=>'Name',
						'rules'=>'trim|required|alpha_numeric|is_unique[tbl_groups.name]|xss_clean'
						);
					array_push($rules,$name);
				}
				$this->form_validation->set_rules($rules);				
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['update_data']=array(
						'name'=>$this->input->post('name'),
						'desc'=>$this->input->post('desc'),
						'status'=>$this->input->post('status'),
						);
					if($this->input->post('group'))
						$this->template_data['insert_data']['parent_group_id']=$this->input->post('group');
					$this->group_m->update_row($id,$this->template_data['update_data']);
					$this->session->set_flashdata('success', 'Group updated successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Edit','edit');
			$this->template_data['subview']=self::MODULE.'edit';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt edit group, '.$e->getMessage());
			redirect(current_url());
		}
	}

	function activate($slug=NULL){
		try{
			if(!permission_permit(array('list-group','activate-group'))) $this->controller_redirect('Permissioin Denied');
			if(!$slug) throw new Exception('Invalid paramter');
			$response=$this->get_data(array('slug'=>$slug));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>group_m::ACTIVE);
			$this->group_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'Group activated successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', "Couldn't activate group, ".$e->getMessage());
		}
		$this->controller_redirect();				
	}


	function block($slug=NULL){
		try{
			if(!permission_permit(array('list-group','block-group'))) $this->controller_redirect('Permissioin Denied');
			$response=$this->get_data(array('slug'=>$slug));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>group_m::BLOCKED);
			$this->group_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'Group blocked successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', "Couldn't block group, ".$e->getMessage());
		}
		$this->controller_redirect();				
	}

	function delete($slug=NULL){
		try{

			if(!permission_permit(array('list-group','delete-group'))) $this->controller_redirect('Permissioin Denied');
			if(!$slug) throw new Exception('Invalid paramter');
			$response=$this->get_data(array('slug'=>$slug));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>group_m::DELETED);
			$this->group_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'Group deleted successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', "Couldn't delete group, ".$e->getMessage());
		}
		$this->controller_redirect();				
	}

	function group_permsission($slug=FALSE)
	{
		try {
			if(!permission_permit(array('list-group','update-permission-group'))) $this->controller_redirect('Permissioin Denied');

			if(!$slug) throw new Exception("Error Processing Request", 1);			
			$var=function(){
				$serialized_data = serialize(array('Math', 'Language', 'Science'));  
				$json_data = json_encode(array('Math', 'Language', 'Science'));  
				show_pre($serialized_data);
				show_pre($json_data);
				show_pre(json_decode($json_data));					
			};

			$response=$this->get_data(array('slug'=>$slug));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data['group']=$response['data'];
			$this->load->model('group_permission_m');
			$this->load->model('permission_m');
			$this->template_data['group_permission_m']=$this->group_permission_m;
			$this->template_data['permission_m']=$this->permission_m;
			//reset old permission and save new permission
			if($this->input->post()){
				$this->group_permission_m->reset_group_permission($this->template_data['group']['id']);
				array_walk($this->input->post('permission'),
					function($val,$key){
						$insert_data=array(
							'group_id'=>$this->template_data['group']['id'],
							'permission_id'=>$key,
							);
						$this->group_permission_m->create_row($insert_data);
					},'');
				$this->session->set_flashdata('success', 'Group Permission updated successfully for Group :: '.ucfirst($this->template_data['group']['name']));
				//$this->controller_redirect();				
			}
			$this->template_data['rows']=$this->permission_m->get_permissions();
			$group_permsissions=$this->group_permission_m->read_row($this->template_data['group']['id'],"p.id as perm_id");
			$gps=array();
			if($group_permsissions){
				foreach ($group_permsissions as $gp) {
					$gps[]=$gp['perm_id'];
				}
			}
			$this->template_data['row']=$this->template_data['group'];
			$this->template_data['group_permsissions']=$gps;
			$this->breadcrumb->append_crumb('Group Permission','#');
			$this->template_data['subview']=self::MODULE.'group_permission';
			$this->load->view('admin/main_layout',$this->template_data);

		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
			$this->controller_redirect();
		}
	}

	function get_data($param){
		$response['success']=false;
		$response['data']='Error Processing Request';
		if(!$param) return $response;
		$row=$this->group_m->read_row_by_n($param);
		if($row) {
			$response['success']=true;
			$response['data']=$row;
		}
		else{
			$response['data']='data not found';
		}
		return $response;
	}

	function controller_redirect($msg=false){
		if($msg) $this->session->set_flashdata('error', $msg);
		$this->template_data['url']=base_url().self::MODULE;
		redirect($this->template_data['url']);				
	}

}	
