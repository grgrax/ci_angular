<?php 
class setting extends Admin_Controller {

	const MODULE='setting/';

	function __construct()
	{
		parent::__construct();
		if(!permission_permit(['administrator-setting'])) redirect_to_dashboard();
		$this->load->model('setting_m');
		$this->template_data['setting_m']=$this->setting_m;
		$this->template_data['actions']=setting_m::actions();
		$this->template_data['link']=base_url().self::MODULE;
		$this->breadcrumb->append_crumb('List Settings',base_url().self::MODULE.'index');

	}

	function index($offset=0)
	{
		$this->template_data['link']=base_url().self::MODULE;
		$this->breadcrumb->append_crumb('Update setting',base_url().self::MODULE.'index');		
		$this->template_data['rows']=$this->setting_m->read_rows_by(array('id >'=>0));
		$this->template_data['subview']=self::MODULE.'list';
		$this->load->view('admin/main_layout',$this->template_data);
	}

	function updateAll()
	{
		try {
			if($this->input->post())
			{
				show_pre($this->input->post('setting'));
				die;
				foreach ($this->input->post('setting') as $id => $setting) {
					$this->template_data['update_data']=array(
						'value'=>$setting
						);
					show_pre($setting);
					$this->setting_m->update_row($id,$this->template_data['update_data']);
				}
				$this->session->set_flashdata('success', 'Setting updated successfully');
			}
			else{
				throw new Exception("Could not update Setting.");
			}
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
		}
		$this->controller_redirect();
	}

	function controller_redirect(){
		$this->template_data['url']=base_url().self::MODULE;
		redirect($this->template_data['url']);				
	}

}	
