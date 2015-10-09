<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends Admin_Controller {

	const MODULE='user/';

	function __construct()
	{
		parent::__construct();
		if(!permission_permit(['administrator-user'])) redirect_to_dashboard();			
		$this->load->model('user_m');
		$this->load->model('group/group_m');
		$this->load->helper(array('user','group/group'));
		$this->template_data['user_m']=$this->user_m;
		$this->template_data['url']=base_url().self::MODULE;
		$this->breadcrumb->append_crumb('List Users',base_url().self::MODULE.'index');
		

		$dn_group=get_group(group_m::$dn_param);
		$fb_group=get_group(group_m::$fb_param);
		$this->param=array(
			'group_id_not_in'=>array($dn_group['id'],$fb_group['id']),
			'status !='=>user_m::DELETED
			);
		$this->group_param=array(
			'id_not_in'=>array($dn_group['id'],$fb_group['id']),
			'status !='=>group_m::DELETED
			);
		$this->template_data['groups']=$this->group_m->read_rows_by($this->group_param);
	}

	function index($offset=0)
	{
		if(!permission_permit(['list-user'])) redirect_to_dashboard();
		$per_page=25;
		$total=count($this->user_m->read_rows_by($this->param));
		$this->template_data['rows']=$this->user_m->read_rows_by($this->param,$per_page,$offset);
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

	function activate($username=NULL){
		try{
			if(!permission_permit(array('list-user','activate-user'))) $this->controller_redirect('Permissioin Denied');
			if(!$username) throw new Exception('Invalid paramter');
			$response=$this->get_data(array('username'=>$username));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>user_m::ACTIVE);
			$this->user_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'User activated successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', "Couldn't activate group, ".$e->getMessage());
		}
		$this->controller_redirect();				
	}


	function block($username=NULL){
		try{
			if(!permission_permit(array('list-user','block-user'))) $this->controller_redirect('Permissioin Denied');
			$response=$this->get_data(array('username'=>$username));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>user_m::BLOCKED);
			$this->user_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'User blocked successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', "Couldn't block group, ".$e->getMessage());
		}
		$this->controller_redirect();				
	}

	function delete($username=NULL){
		try{
			if(!permission_permit(array('list-user','delete-user'))) $this->controller_redirect('Permissioin Denied');
			if(!$username) throw new Exception('Invalid paramter');
			$response=$this->get_data(array('username'=>$username));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>user_m::DELETED);
			$this->user_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'User deleted successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', "Couldn't delete group, ".$e->getMessage());
		}
		$this->controller_redirect();				
	}


	function add()
	{
		try {
			if(!permission_permit(array('add-user'))) $this->controller_redirect('Permissioin Denied');
			if($this->input->post())
			{
				$rules=user_m::get_rules(array('username','email','group'));
				$password=array(
					'field'=>'password',
					'label'=>'Password',
					'rules'=>'trim|required|min_length[6]|xss_clean'
					);
				array_push($rules,$password);
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['insert_data']=array(
						'group_id'=>$this->input->post('group'),
						'username'=>$this->input->post('username'),
						'email'=>$this->input->post('email'),
						'pass'=>sha1($this->input->post('password')),
						'status'=>user_m::ACTIVE,
						);
					$this->user_m->create_row($this->template_data['insert_data']);
					$this->session->set_flashdata('success', 'User added successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Add','add');
			$this->template_data['subview']=self::MODULE.'add';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
		}
	}


	function edit($username)
	{
		try {
			if(!permission_permit(array('list-user','edit-user'))) $this->controller_redirect('Permissioin Denied');
			if(!$username) throw new Exception("Invalid Parameter", 1);
			$response=$this->get_data(array('username'=>$username));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data['row']=$response['data'];
			$id=$this->template_data['row']['id'];
			if($this->input->post())
			{
				$rules=array(
					array(
						'field'=>'username',
						'label'=>'Username',
						'rules'=>"trim|required|alpha_numeric|is_username_unique[$id]|xss_clean"
						),
					array(
						'field'=>'email',
						'label'=>'Email Address',
						'rules'=>"trim|required|valid_email|is_user_email_unique[$id]|xss_clean"
						),
					);
				// if($this->input->post('email')!=){
				if($this->input->post('password')){
					$password=array(
						'field'=>'password',
						'label'=>'Password',
						'rules'=>'trim|required|min_length[6]|matches[confirm_password]|xss_clean'
						);
					array_push($rules,$password);
					$password_confirm=array(
						'field'=>'password',
						'label'=>'Confrim Password',
						'rules'=>'trim|required|min_length[6]|xss_clean'
						);
					array_push($rules,$password_confirm);
				}
				// show_pre($rules);
				// die;
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['update_data']=array(
						'username'=>$this->input->post('username'),
						'email'=>$this->input->post('email')
						);
					if($this->input->post('password')){
						$this->template_data['update_data']['pass']=sha1($this->input->post('password'));
					}
					$this->user_m->update_row($id,$this->template_data['update_data']);
					$this->session->set_flashdata('success', 'User updated successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Edit','edit');
			$this->template_data['subview']=self::MODULE.'edit';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt edit user, '.$e->getMessage());
			redirect(current_url());
		}
	}

	function profile(){
		try {
			$id=$this->session->userdata('id');
			if(!$id) throw new Exception("Invalid Parameter", 1);
			$this->template_data['row']=$this->user_m->read_row_by_n(array('id'=>$id));
			if($this->input->post())
			{
				$rules=array(
					array(
						'field'=>'username',
						'label'=>'Username',
						'rules'=>"trim|required|alpha_numeric|is_username_unique[$id]|xss_clean"
						),
					array(
						'field'=>'email',
						'label'=>'Email Address',
						'rules'=>"trim|required|valid_email|is_user_email_unique[$id]|xss_clean"
						),
					);
				if($this->input->post('password')){
					$password=array(
						'field'=>'password',
						'label'=>'Password',
						'rules'=>'trim|required|min_length[6]|matches[confirm_password]|xss_clean'
						);
					array_push($rules,$password);
					$password_confirm=array(
						'field'=>'password',
						'label'=>'Confrim Password',
						'rules'=>'trim|required|min_length[6]|xss_clean'
						);
					array_push($rules,$password_confirm);
				}
				$name_rules=$this->user_m->get_rules(array('first_name','last_name'));
				$rules=array_merge($rules,$name_rules);
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['update_data']=array(
						'username'=>$this->input->post('username'),
						'email'=>$this->input->post('email'),
						'first_name'=>$this->input->post('first_name'),
						'last_name'=>$this->input->post('last_name')
						);
					if($this->input->post('password')){
						$this->template_data['update_data']['pass']=sha1($this->input->post('password'));
					}
					$this->user_m->update_row($id,$this->template_data['update_data']);
					$this->session->set_flashdata('success', 'profile updated successfully');
					redirect('dashboard');				
				}
			}			
			$this->breadcrumb->append_crumb('Edit Profile','profile');
			$this->template_data['subview']=self::MODULE.'profile';
			$this->load->view('admin/main_layout',$this->template_data);

		} catch (Exception $e) {
			$this->session->set_flashdata('Could not update profile, ', $e->getMessage());
			redirect(current_url());
		}
	}

	function get_data($param){
		$response['success']=false;
		$response['data']='Error Processing Request';
		if(!$param) return $response;
		$row=$this->user_m->read_row_by_n($param);
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
/* End of file user.php */
/* Location: ./application/modules/user/controllers/user.php */


