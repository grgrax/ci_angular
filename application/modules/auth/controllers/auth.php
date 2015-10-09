<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth extends MY_Controller {

	const MODULE='auth/';
	public $template_data='';

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_m');
		$this->template_data['user_m']=$this->user_m;
	}

	public function index()
	{
		$this->template_data['subview']=self::MODULE.'index';
		$this->load->view('admin/main_layout',$this->template_data);
	}

	function login()
	{
		try {
			if($this->session->userdata('admin'))
				redirect('dashboard');
			if($this->input->post())
			{
				$config=array(
					array(
						'field'=>'username',
						'rules'=>'trim|required|min_length[3]'
						),
					array(
						'field'=>'password',
						'rules'=>'trim|required|min_length[5]'
						)
					);	
				$this->form_validation->set_rules($config);
				if($this->form_validation->run($this)===TRUE)
				{
					$username=$this->input->post('username',true);
					$pass=$this->input->post('password',true);
					$this->load->model('user_m');
					$user=$this->user_m->check_login($username,$pass);
					if($user)
					{
						$user_m=$this->user_m;
						switch ($user['status']) {
							case $user_m::PENDING:{
								throw new Exception("Pending user");
								break;
							}
							case $user_m::BLOCKED:{
								throw new Exception("Blocked user");
								break;
							}
							case $user_m::DELETED:{
								throw new Exception("Deleted user");
								break;
							}
						}
						$this->session->set_userdata('username',$user['username']);
						$this->session->set_userdata('id',$user['id']);
						$group_permsissions=$this->load->model('group/group_permission_m')->read_row($user['group_id']);
						$gps=array();
						foreach ($group_permsissions as $k=>$v) {
							$gps[]=$v['slug'];
						}
						$admin=array(
							'id'=>$user['id'],
							'group_id'=>$user['group_id'],
							'group_permsissions'=>$gps,
							);
						$this->session->set_userdata('admin',$admin);

						show_pre($this->session->userdata);
						// die;

						redirect('dashboard');
					}
					else
						throw new Exception("Invalid Username/Password");
				}
				else{
					throw new Exception(validation_errors());
				}
			}
			if(config_item('admin_template')=='metis')
				$view='metis';
			elseif(config_item('admin_template')=='nifty')
				$view='nifty';
			$this->load->view($view,$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
			
			// show_pre($this->session->userdata);
			// die;

			redirect("auth/login");
		}
	}

	function logout()
	{
		// $this->session->unset_userdata('username');
		$this->session->unset_userdata('admin');
		// $this->login();
		redirect('auth/login');
	}


}

/* End of file user.php */
/* Location: ./application/modules/user/controllers/user.php */