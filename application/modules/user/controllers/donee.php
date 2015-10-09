<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class donee extends Admin_Controller {

	const MODULE='user/donee/';

	function __construct()
	{
		parent::__construct();
		$this->user_m=$this->load->model('user_m');

		$this->load->model('signup/bank_details_m');
		$this->load->model('group/group_m');
		$this->load->helper(array('user','group/group'));
		$this->template_data['link']=base_url().self::MODULE;
		$this->breadcrumb->append_crumb('List Donees',base_url().self::MODULE.'index');

		$dn_group=get_group(group_m::$dn_param);
		$fb_group=get_group(group_m::$fb_param);
		$this->group_param=array(
			'id_in'=>array($dn_group['id'],$fb_group['id']),
			'status !='=>group_m::DELETED
			);
		$this->template_data['groups']=$this->group_m->read_rows_by($this->group_param);
		$this->template_data['status']=user_m::status();
		$this->donee_param=array(
			'group_id_in'=>array($dn_group['id'],$fb_group['id']),
			'status !='=>user_m::DELETED
			);
		$this->dn_group=$dn_group;
	}


	function index($offset=0)
	{
		try {
			if(!permission_permit(['list-donee'])) redirect_to_dashboard();
			$per_page=25;

			//filter
			$param = '';
			$this->template_data['q_param']=$this->default_param();
			// show_pre($this->template_data['q_param']);	
			if($this->input->get()){	
				$this->template_data['q_param']['u.id >']=0;
				$filters = array();				
				foreach($this->input->get() as $k=>$v){
					if($k == 'per_page' or $k == 'filter'){
					}
					elseif ($v !='' ){
						$filters[$k]=$v;
						$param .=  $k.'='.$v.'&'; 						
					} 
				}				
				$param = substr($param,0,-1);
				$offset = $this->input->get('per_page')?$this->input->get('per_page'):0;
				
				$this->template_data['q_param']=array_merge($this->template_data['q_param'],$filters);
				if(array_key_exists('group_id', $filters))
					unset($this->template_data['q_param']['group_id_in']);
			}else{
				$this->default_param();
			}
			// show_pre($this->template_data['q_param']);	
			//filter		

			$total=count($this->user_m->filter_rows_by($this->template_data['q_param']));
			$this->template_data['rows']=$this->user_m->filter_rows_by($this->template_data['q_param'],$per_page,$offset);

			if($total>$per_page){
				$this->load->library('pagination');
				$config['base_url']=base_url().self::MODULE.'index?'.$param;
				$config['total_rows']=$total;
				$config['per_page']=$per_page;
				$config['prev']='Previous';
				$config['next']='Next';
				$config['page_query_string'] = TRUE;

				$this->pagination->initialize($config);
				$this->template_data['pages']=$this->pagination->create_links();
			}
			$this->template_data['total']=$total;
			$this->template_data['offset']=$offset;
			$this->template_data['subview']=self::MODULE.'index';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt list fund categories '.$e->getMessage());
			$this->controller_redirect();
		}
	}

	function default_param(){
		$dn_group=get_group(group_m::$dn_param);
		$fb_group=get_group(group_m::$fb_param);
		$this->group_param=array(
			'id_in'=>array($dn_group['id'],$fb_group['id']),
			'status !='=>group_m::DELETED
			);
		$this->template_data['groups']=$this->group_m->read_rows_by($this->group_param);
		$this->donee_param=array(
			'group_id_in'=>array($dn_group['id'],$fb_group['id'])
			);
		return $this->donee_param;
		// $this->template_data['q_param']=$this->donee_param;
	}

	function activate($username=NULL){
		try{

			if(!permission_permit(array('list-donee','activate-donee'))) throw new Exception("Permissioin Denied", 1);

			if(!$username) throw new Exception('Invalid paramter');
			$response=$this->get_data(array('username'=>$username));
			show_pre($response);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>user_m::ACTIVE);
			$this->user_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'Donee activated successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', "Couldn't activate donee, ".$e->getMessage());
		}
		$this->controller_redirect();				
	}


	function block($username=NULL){
		try{
			if(!permission_permit(array('list-donee','block-donee'))) throw new Exception("Permissioin Denied", 1);

			$response=$this->get_data(array('username'=>$username));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>user_m::BLOCKED);
			$this->user_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'Donee blocked successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', "Couldn't block donee, ".$e->getMessage());
		}
		$this->controller_redirect();				
	}

	function delete($username=NULL){
		try{

			if(!permission_permit(array('list-donee','delete-donee'))) throw new Exception("Permissioin Denied", 1);

			if(!$username) throw new Exception('Invalid paramter');
			$response=$this->get_data(array('username'=>$username));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>user_m::DELETED);
			$this->user_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'Donee deleted successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', "Couldn't delete donee, ".$e->getMessage());
		}
		$this->controller_redirect();				
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



	function add()
	{
		try {

			if(!permission_permit(array('list-donee','add-donee'))) throw new Exception("Permissioin Denied", 1);
			if($this->input->post())
			{
				$rules=$this->user_m->get_rules(array('username','email','first_name','last_name'));
				$password=array(
					'field'=>'password',
					'label'=>'Password',
					'rules'=>'trim|required|min_length[6]|xss_clean'
					);
				array_push($rules,$password);
				// show_pre($rules);
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['insert_data']=array(
						'group_id'=>$this->dn_group['id'],
						'username'=>$this->input->post('username'),
						'email'=>$this->input->post('email'),
						'pass'=>sha1($this->input->post('password')),
						'first_name'=>$this->input->post('first_name'),
						'last_name'=>$this->input->post('last_name'),
						'status'=>user_m::ACTIVE,
						'created_at'=>date('Y-m-d H:i:s'),
						);
					$this->user_m->create_row($this->template_data['insert_data']);
					$user = get_user(array('username' => $this->input->post('username')));
					$this->template_data['insert_bank_data']=array(
						'bsb'=>$this->input->post('bsb'),
						'bank_name'=>$this->input->post('bank'),
						'acc_no'=>$this->input->post('account_number'),
						'acc_holder_name'=>$this->input->post('account_holder_name'),
						'user_id' => $user['id'],
						'campaign_id' => NULL
					);
					$this->bank_details_m->create_row($this->template_data['insert_bank_data']);
					$this->session->set_flashdata('success', 'Donee added successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Add','add');
			$this->template_data['subview']=self::MODULE.'add';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
			$this->controller_redirect();
		}
	}


	function edit($username=null)
	{
		try {

			if(!permission_permit(array('list-donee','edit-donee'))) $this->controller_redirect('Permissioin Denied');

			if(!$username) throw new Exception("Invalid Parameter", 1);
			$response=$this->get_data(array('username'=>$username));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data['row']=$response['data'];
			$id=$response['data']['id'];

			if($this->input->post())
			{
				$rules=array(
					array(
						'field'=>'username',
						'label'=>'Username',
						'rules'=>"trim|required|route|alpha_numeric|is_username_unique[$id]|xss_clean"
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
						'last_name'=>$this->input->post('last_name'),
						);
					$this->template_data['update_bank_data']=array(
						'bsb'=>$this->input->post('bsb'),
						'bank_name'=>$this->input->post('bank'),
						'acc_no'=>$this->input->post('account_number'),
						'acc_holder_name'=>$this->input->post('account_holder_name'),
						// 'user_id' => $user['id'],
						// 'campaign_id' => NULL
					);
					if($this->input->post('password')){
						$this->template_data['update_data']['pass']=sha1($this->input->post('password'));
					}
					$this->user_m->update_row($id,$this->template_data['update_data']);
					$this->bank_details_m->update_row($this->input->post('bank_id'),$this->template_data['update_bank_data']);
					// $this->user_m->update_row($id,$this->template_data['update_data']);
					$this->session->set_flashdata('success', 'Donee updated successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Edit','edit');
			$this->template_data['subview']=self::MODULE.'edit';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('Could not update donee, ', $e->getMessage());
		}
	}

	function controller_redirect($msg=false){
		if($msg) $this->session->set_flashdata('error', $msg);
		$this->template_data['link']=base_url().self::MODULE;
		redirect($this->template_data['link']);				
	}


}	
/* End of file user.php */
/* Location: ./application/modules/user/controllers/user.php */


