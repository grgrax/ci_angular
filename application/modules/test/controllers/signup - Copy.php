<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class signup extends Frontend_Controller {

	public $data;
	const MODULE='signup/';

	function __construct()
	{
		try {
			parent::__construct();
			// $this->session->unset_userdata('signup_user_id');
			// error handling when there is no signup_user_id
			// if(uri_string()!=''){
			// 	if(uri_string()=='signup/campaign' or uri_string()=='signup/personal_details'){
			// 		if(!$this->session->userdata('signup_user_id'))
			// 			throw new Exception("Session not found", 1);				
			// 	}
			// }		
			$this->data['link']=base_url().self::MODULE;
			$this->load->model('signup_m');
			$this->load->model('user/user_m');
			
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Error while signup, '.$e->getMessage());
//			redirect();						
		}
	}

	public function index()
	{
		try {
			if($this->input->post())
			{			
				$rules=$this->signup_m->set_rules();
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->data['insert_data']=array(
						'group_id'=>'1',
						'username'=>$this->input->post('username'),
						'first_name'=>$this->input->post('first_name'),
						'last_name'=>$this->input->post('last_name'),
						'email'=>$this->input->post('email'),
						'pass'=>sha1($this->input->post('password')),
						'verification_code'=>md5(date('Y-m-d H:m:s')),
						'status'=>user_m::PENDING,
						'created_at'=>date('Y-m-d H:i:s'),
						);
					$this->signup_m->create_row($this->data['insert_data']);
					$lastuser= $this->signup_m->read_row_by_name($this->input->post('username'));
					if(!$lastuser)
						throw new Exception("No user added", 1);						
					else
						$this->session->set_userdata('signup_user_id', $lastuser['id']);
					$this->campaign();
					// redirect('campaign');
				}
			}
			$this->data['subview']=self::MODULE.'sign_up';
			$this->load->view('front/main_layout',$this->data);		

		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt Signup '.$e->getMessage());
			redirect(current_url());
		}
	}

	public function campaign()
	{
		try {
			$this->load->model('campaign/campaign_m');
			$this->load->model('fund_categories/fund_categories_m');

			$this->data['categories']=$this->fund_categories_m->read_all_published();
			show_pre($this->signup_m);
			$this->data['donee']=$this->signup_m->read_row($this->session->userdata('signup_user_id'));

			if($this->input->post()){
				$rules=$this->campaign_m->set_rules();				
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->data['insert_data']=array(
						'user_id'=>$this->session->userdata('signup_user_id'),
						'campaign_title'=>$this->input->post('campaign_title'),
						'fund_category_id'=>$this->input->post('categories'),
						'description'=>$this->input->post('description'),
						'target_amount'=>$this->input->post('target_amount'),
						'status'=>1,
						'created_at'=>date('Y-m-d H:i:s')
						);
					$this->campaign_m->create_row($this->data['insert_data']);
					$this->load->model('signup/signup_m');
					$this->data['insert_data']=array(
						'address_unit'=>$this->input->post('address_unit'),
						'address_street'=>$this->input->post('address_street'),
						'address_suburb'=>$this->input->post('address_suburb'),
						'address_state_id'=>$this->input->post('address_state_id')
						);
					$this->signup_m->update_row($this->session->userdata('signup_user_id'),$this->data['insert_data']);
					$this->session->set_flashdata('success', 'Campaign created successfully');
					$this->personal_details();
					redirect('campaign/personal_details');			
				}
			}
			$this->data['subview']=self::MODULE.'campaign';
			$this->load->view('front/main_layout',$this->data);		
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt create campaign '.$e->getMessage());
			redirect(current_url());
		}
	}

	public function personal_details()
	{
		try {
			if($this->input->post()){
				$rule=array(
					array(
						'field'=>'checkagree',
						'label'=>'i agree',
						'rules'=>'required'
						)
					);	
				$this->form_validation->set_rules($rule);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->data['insert_data']=array(
						'video'=>$this->input->post('video')
						);

					if($_FILES['photo']['name']){
						$this->data['insert_data']['pic']=$_FILES['photo']['name'];
						$path='uploads/campaign';
						upload_picture($path,'photo');
					}
					if($_FILES['document']['name']){
						$this->data['insert_data']['document']=$_FILES['document']['name'];
						$path='uploads/campaign';
						upload_file($path,'document');
					}

					$this->campaign_m->update_row_by_userid($this->session->userdata('signup_user_id'),$this->data['insert_data']);

					//send verfication code to his/her email
					$from['from_name'] = 'Our Library';
					$from['from_email'] =  'basant@gmail.com';
					$to['to_name'] = 'ramesh';
					$to['to_email'] = 'raxizel@gmail.com';					
					$subject = "Our library Account Confirmation";
					$message= "We're ready to activate your account. All we need to do is make sure this is your email address.";	
					$message.="<br/>";
					$key=md5(date('Y-m-d H:m:s'));
					$user_id=$this->session->userdata('signup_user_id');
					if(!$user_id) 
						throw new Exception("no signup_user_id", 1);				
					$url=base_url("test/activate/$key/$user_id");
					$style="border-radius:3px;background:#3aa54c;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 24px;padding:10px 18px;text-decoration:none;width:180px;text-align:center";
					// $message.=anchor($url, 'Click here to confirm', $style);
					$message.=anchor($url, 'Click here to confirm', '');
					$res = App\Mailer::sendMail($from, $to, $subject, $message);	
					show_pre($res);
					if($res==1){
					}

					$this->session->set_flashdata('success', 'personal details updated successfully');
					//$this->controller_redirect();	
					redirect(current_url());			
				}else{
					die(validation_errors());
					throw new Exception(validation_errors());
				}
			}
			$this->data['subview']=self::MODULE.'personal_details';
			$this->load->view('front/main_layout',$this->data);		
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt add campaign '.$e->getMessage());
			redirect(current_url());
		}
	}	

	public function verify()
	{
		try {
			if($this->input->post()){
			}
			$this->data['subview']=self::MODULE.'verify';
			$this->load->view('front/main_layout',$this->data);		
		} catch (Exception $e) {
			
		}
	}

	

	function controller_redirect($msg=false){
		if($msg) $this->session->set_flashdata('error', $msg);
		$this->data['link']=base_url().self::MODULE;
		redirect($this->data['link']);				
	}

}

/* End of file sample.php */
/* Location: ./application/modules/sample/controllers/sample.php */