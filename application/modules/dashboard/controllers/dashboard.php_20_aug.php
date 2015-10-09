<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends Admin_Controller {

	const MODULE='dashboard/';

	function __construct()
	{

// show_pre($this->session->userdata);
// die;
		parent::__construct();
// die('in');
// $this->load->model('donation/donation_m');
		$this->load->model('campaign/campaign_m');
// $this->load->model('fund_category/fund_category_m');
		$this->load->model(array('group/group_m','user/user_m','category/category_m','article/article_m'));
// load helpers
		$this->load->helper(array('setting/setting','category/category'));

	}

	public function index()
	{
		// $rules=get_widget_rules('message');
		// show_pre($rules);

		if($this->session->userdata('admin')){	
//save options/settings
			try {
				$this->load->model(array('setting/setting_m'));
				if($this->input->post())
				{
					$tab=4;

					if($this->input->post('header')){
						$tab=1;
//upload				
						if($_FILES['header_logo']['name']){
							$k1='header_logo';
							$respone=$this->setting_image_upload($k1);
							if(!isset($respone['success'])) throw new Exception("Header Logo upload error, ".$respone['error'] , 1);
							$picture_name=$respone['success']['upload_data']['file_name'];
							$respone=$this->setting_image_db($k1,$picture_name);														
							if(!isset($respone['success'])) throw new Exception("Header Logo database error, ".$respone['error'] , 1);
						}
					}
					elseif($this->input->post('slider')){
						$tab=2;
					}
					elseif($this->input->post('sidebar')){
						$tab=3;
						if($_FILES['sidebar1_picture']['name']){
							$k1='sidebar1_picture';
							$respone=$this->setting_image_upload($k1);
							// show_pre($respone);
							if(!isset($respone['success'])) throw new Exception("Sidebar 1 Picture upload error, ".$respone['error'] , 1);
							$picture_name=$respone['success']['upload_data']['file_name'];
							$respone=$this->setting_image_db($k1,$picture_name);														
							// show_pre($respone);
							// die;
							if(!isset($respone['success'])) throw new Exception("Sidebar 1 Picture database error, ".$respone['error'] , 1);
						}
						if($_FILES['sidebar2_picture']['name']){
							$k1='sidebar2_picture';
							$respone=$this->setting_image_upload($k1);
							if(!isset($respone['success'])) throw new Exception("Sidebar 2 Picture upload error, ".$respone['error'] , 1);
							$picture_name=$respone['success']['upload_data']['file_name'];
							$respone=$this->setting_image_db($k1,$picture_name);														
							if(!isset($respone['success'])) throw new Exception("Sidebar 2 Picture database error, ".$respone['error'] , 1);
						}
					}
					elseif($this->input->post('footer')){
						$tab=7;
					}
					elseif($this->input->post('contact')){
						$tab=8;
					}
					$this->session->set_userdata('tab',$tab);
// show_pre($this->input->post());
					$submit_buttons=array('header','slider','sidebar','message','project','news_events','footer');					
					$image_inputs=array('header_logo','sidebar1_media','sidebar2_media');					
					foreach ($this->input->post() as $key => $value) {
						if(!in_array($key,$submit_buttons)){
//leave submit btns
							$setting=null;
							$setting=get_setting_n(array('slug'=>$key));
							if(!$setting){
//insert	
								$this->template_data['insert_data']=array(
									'name'=>$key,
									'slug'=>get_slug($key),
									'value'=>$value,
									);						
								$this->setting_m->create_row($this->template_data['insert_data']);
							}elseif($value && $setting['value']!=$value){
//update
								$this->template_data['update_data']=array('value'=>$value);
								$this->setting_m->update_row_n($setting['id'],$this->template_data['update_data']);
							}							
						}
					}
					$this->session->set_flashdata('success', "Setting saved successfully ");
				}
				$this->template_data['subview']=self::MODULE.'index';
				$this->load->view('admin/main_layout',$this->template_data);
			} catch (Exception $e) {
				$this->session->set_flashdata('error', $e->getMessage());
				redirect(current_url());
			}
		}
	}


	private function setting_image_upload($setting_image=null){
		if($setting_image){
			$config['upload_path']='setting/';
			switch ($setting_image) {
				case 'header_logo':{
					$key='header_logo';
					break;
				}
				case 'sidebar1_picture':{
					$key='sidebar1_picture';
					break;
				}
				case 'sidebar2_picture':{
					$key='sidebar2_picture';
					break;
				}
			}
			if($_FILES[$key]['name']){
				$config['file_input_name']=$key;
				return $response=upload_image($config);
			}
		}
	}

	private function setting_image_db($key=null,$value=null){

		if(!$key) throw new Exception("No key to write into db", 1);
		if(!$value) throw new Exception("No value to write into db", 1);

		$setting=null;
		$setting=get_setting_n(array('slug'=>$key));

		if(!$setting){
//insert	
			$this->template_data['insert_data']=array(
				'name'=>$key,
				'slug'=>$key,
				'value'=>$value,
				);						
			$this->setting_m->create_row($this->template_data['insert_data']);
			return array('success'=>'saved');
		}elseif($value && $setting['value']!=$value){
//update
			$this->template_data['update_data']=array('value'=>$value);
			$this->setting_m->update_row_n($setting['id'],$this->template_data['update_data']);
			return array('success'=>'saved');
		}	
	}

}

/* End of file user.php */
/* Location: ./application/modules/user/controllers/user.php */