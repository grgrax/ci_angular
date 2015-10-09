<?php
class page extends Admin_Controller
{
	const MODULE='page/';

	function __construct()
	{
		parent::__construct();
		if(!permission_permit(['administrator-page'])) redirect_to_dashboard();
		$this->load->helper(array('page'));
		$this->load->model('page_m');
		$this->template_data['page_m']=$this->page_m;
		$this->template_data['status']=page_m::status();
		$this->template_data['actions']=page_m::actions();
		$this->template_data['link']=base_url().self::MODULE;
		$this->template_data['url']=base_url().self::MODULE;
		$this->template_data['rows']=$this->page_m->get_parents();
		$this->breadcrumb->append_crumb('List pages',base_url().self::MODULE.'index');
	}

	function index($offset=0)
	{
		if(!permission_permit(['list-page'])) redirect_to_dashboard();
		$this->template_data['rows']=$this->page_m->read_all();
		$this->template_data['offset']=$offset;
		$this->template_data['subview']=self::MODULE.'list';
		$this->load->view('admin/main_layout',$this->template_data);
	}

	function add()
	{
		try {
			if(!permission_permit(array('list-page','add-page'))) $this->controller_redirect('Permissioin Denied');
			if($this->input->post())
			{
				$this->form_validation->set_rules($this->page_m->set_rules(array('status')));
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['insert_data']=array(
						'name'=>$this->input->post('name'),
						'content'=>$this->input->post('content'),
						'status'=>0,
                        'order'=>$this->page_m->count_rows()+1,
						);
					if($this->input->post('pages')){
						$this->template_data['insert_data']['parent_page_id']=$this->input->post('pages');
					}
					if($this->input->post('page_type')>=0)
						$this->template_data['insert_data']['type']=$this->input->post('page_type');
					$this->page_m->create_row($this->template_data['insert_data']);
					$this->session->set_flashdata('success', 'page added successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Add','add');
            $this->template_data['rows']=$this->page_m->read_all();
            $this->template_data['subview']=self::MODULE.'add';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt add page '.$e->getMessage());
			$this->controller_redirect();
		}
	}

	function edit($id=FALSE)
	{
		try {
			if(!permission_permit(array('list-page','edit-page'))) throw new Exception("Permissioin Denied", 1);
			if(!$id) throw new Exception("Error Processing Request", 1);
			$response=$this->get($id);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data['row']=$response['data'];
			
			if($this->input->post())
			{
				$this->form_validation->set_rules($this->page_m->set_rules());
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['update_data']=array(
						'name'=>$this->input->post('name'),
						'content'=>$this->input->post('content'),
						'status'=>$this->input->post('status'),
						);
					$this->page_m->update_row($id,$this->template_data['update_data']);
					$this->session->set_flashdata('success', 'page updated successfully');
					$this->controller_redirect();				
				}
				else{
					throw new Exception("Could not add page <hr/>");
				}
			}			
			$this->breadcrumb->append_crumb('Edit','edit');
			$this->template_data['subview']=self::MODULE.'edit';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->controller_redirect('Couldnt edit page '.$e->getMessage());
		}
	}

	function activate($id=NULL){
		try{
			if(!permission_permit(array('activate-page'))) $this->controller_redirect('Permissioin Denied');
			if(!$id) throw new Exception('Invalid paramter');
			$response=$this->get($id);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>page_m::ACTIVE);
			$this->page_m->update_row($id,$this->template_data);
			$this->session->set_flashdata('success', 'page activated successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', 'page not activated '.$e->getMessage());
		}
		$this->controller_redirect();				
	}


	function block($id=NULL){
		try{
			if(!permission_permit(array('block-page'))) $this->controller_redirect('Permissioin Denied');
			$response=$this->get($id);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>page_m::BLOCKED);
			$this->page_m->update_row($id,$this->template_data);
			$this->session->set_flashdata('success', 'page blocked successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', 'page not blocked '.$e->getMessage());
		}
		$this->controller_redirect();				
	}

	function delete($id=NULL){
		try{
			if(!permission_permit(array('delete-page'))) $this->controller_redirect('Permissioin Denied');
			if(!$id) throw new Exception('Invalid paramter');
			$response=$this->get($id);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>page_m::DELETED);
			$this->page_m->update_row($id,$this->template_data);
			$this->session->set_flashdata('success', 'page deleted successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', 'page not deleted '.$e->getMessage());
		}
		$this->controller_redirect();				
	}

	function modal(){
		$this->template_data['subview']=self::MODULE.'hello';
		$this->load->view('admin/modal_layout',$this->template_data);
	}

	function upload(){
		$config['upload_path'] = "./uploads/pics/pages/";
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('std_pic'))
		{
			$data['error']=$this->upload->display_errors();
			throw new Exception("Could not add page <hr/>".$data['error']);
		}
		else{
			$data['success'] = array('upload_data' => $this->upload->data());
		}
	}

	function set_upload_rule(){
		if (empty($_FILES['std_pic']['name']))
			$this->form_validation->set_rules('std_pic', 'Student Picture', 'trim|required|xss_clean');
	}

	function controller_redirect($msg=false){
		if($msg) $this->session->set_flashdata('error', $msg);
		$this->template_data['link']=base_url().self::MODULE;
		redirect($this->template_data['link']);				
	}

	function get($id=FALSE){
		$response['success']=false;
		$response['data']='Error Processing Request';
		if(!$id) return $response;
		$page=$this->page_m->read_row($id);
		if($page) {
			$response['success']=true;
			$response['data']=$page;
		}
		else{
			$response['data']='page not found';
		}
		return $response;
	}

	function order(){
		// if(!permission_permit(['list-page'])) redirect_to_dashboard();
		$this->template_data['rows']=$this->page_m->read_pages_for_ordering();
		$this->template_data['subview']=self::MODULE.'order';
		$this->breadcrumb->append_crumb('Order','order');
		$this->load->view('admin/main_layout',$this->template_data);		
	}


}
?>