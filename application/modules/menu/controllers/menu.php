<?php
class menu extends Admin_Controller
{
	const MODULE='menu/';

	function __construct()
	{
		parent::__construct();
		// if(!permission_permit(['administrator-menu'])) redirect_to_dashboard();
		$this->load->model('page/page_types_m');
		

		$this->template_data['categories']=$this->category_m->filter_rows_by(array('c.id >'=>0));
		$this->template_data['articles']=$this->article_m->filter_rows_by(array('a.id >'=>0));

		$this->template_data['page_types_m']=$this->page_types_m;
		$this->template_data['status']=menu_m::status();
		$this->template_data['actions']=menu_m::actions();
		$this->template_data['link']=base_url().self::MODULE;
		$this->template_data['url']=base_url().self::MODULE;
		
		$this->template_data['rows']=$this->menu_m->filter_rows_by(array('m.id >'=>0));
		$this->template_data['sidebars']=$this->menu_m->sidebar();
		$this->template_data['page_types']=$this->page_types_m->read_rows_by(array('id >'=>0));
		$this->breadcrumb->append_crumb('List Menus',base_url().self::MODULE.'index');
	}

	function index($offset=0)
	{
		// show_pre($this->template_data['rows']);
		// if(!permission_permit(['list-menu'])) redirect_to_dashboard();
		// $this->template_data['rows']=$this->menu_m->read_menus_for_ordering();
		// show_pre($this->template_data['page_types']);

		// show_pre(get_child_menus(1));
		// show_pre(get_page_type(array('id'=>1)));
		// die;
		$this->template_data['offset']=$offset;
		$this->template_data['subview']=self::MODULE.'list';
		$this->load->view('admin/main_layout',$this->template_data);
	}

	function add()
	{
		try {
			// if(!permission_permit(array('list-menu','add-menu'))) $this->controller_redirect('Permissioin Denied');
			if($this->input->post())
			{

				$rules=$this->menu_m->set_rules(array('status'));
				$rules['url']=array(
					'field'=>'url',
					'label'=>'Url',
					'rules'=>"trim|required|xss_clean|is_menu_url_unique[0]",
					);
				// show_pre($rules);
				// die;
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['insert_data']=array(
						'name'=>$this->input->post('name'),
						'slug'=>get_slug($this->input->post('name')),
						'url'=>$this->input->post('url'),
						'desc'=>$this->input->post('desc'),
						'status'=>1,
						'order'=>$this->menu_m->count_rows()+1,
						'page_type_id'=>$this->input->post('page_type'),
						'category_id'=>$this->input->post('category')?:NULL,
						'article_id'=>$this->input->post('article')?:NULL,
						'author'=>Current_User::getId(),
						'status'=>$this->input->post('status')?:menu_m::PENDING,
						'sidebar'=>$this->input->post('sidebar'),
						);
					if($this->input->post('parent_menu')){
						$this->template_data['insert_data']['parent_id']=$this->input->post('parent_menu');
						$parent=$this->menu_m->read_row($this->input->post('parent_menu'));
						if($parent)
							$this->template_data['insert_data']['level']=$parent['level']+1;
					}
					show_pre($this->template_data['insert_data']);
					// die;
					$this->menu_m->create_row($this->template_data['insert_data']);
					$this->session->set_flashdata('success', 'Menu added successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Add','add');
			// $this->template_data['rows']=$this->menu_m->read_all();
			$this->template_data['subview']=self::MODULE.'add';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt add menu '.$e->getMessage());
			$this->controller_redirect();
		}
	}

	function edit($slug=FALSE)
	{
		try {
			// if(!permission_permit(array('list-menu','edit-menu'))) throw new Exception("Permissioin Denied", 1);
			if(!$slug) throw new Exception("Error Processing Request", 1);
			$response=$this->get($slug);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data['row']=$response['data'];
			
			if($this->input->post())
			{
				// show_pre($this->input->post());
				$rules=$this->menu_m->set_rules();
				if($this->input->post('url') && $this->input->post('url')!=$response['data']['url']){
					$id=$response['data']['id'];
					$rules['url']=array(
						'field'=>'url',
						'label'=>'Url',
						'rules'=>"trim|required|xss_clean|is_menu_url_unique[$id]",
						);
				}
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{

					$this->template_data['update_data']=array(
						'parent_id'=>$this->input->post('parent_menu')?:NULL,
						'page_type_id'=>$this->input->post('page_type'),
						'name'=>$this->input->post('name'),
						'desc'=>$this->input->post('desc'),
						'status'=>$this->input->post('status'),
						'category_id'=>$this->input->post('category')?:NULL,
						'article_id'=>$this->input->post('article')?:NULL,
						'sidebar'=>$this->input->post('sidebar'),
						);
					if($this->input->post('url')){
						$this->template_data['update_data']['url']=$this->input->post('url');					
					}
					// show_pre();
					$this->menu_m->update_row_n($response['data']['id'],$this->template_data['update_data']);
					$this->session->set_flashdata('success', 'menu updated successfully');
					redirect(current_url());
					// $this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Edit','edit');
			$this->template_data['subview']=self::MODULE.'edit';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->controller_redirect('Couldnt edit menu '.$e->getMessage());
			redirect(current_url());
		}
	}

	function activate($slug=NULL){
		try{
			if(!permission_permit(array('activate-menu'))) $this->controller_redirect('Permissioin Denied');
			if(!$slug) throw new Exception('Invalid paramter');
			$response=$this->get($slug);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>menu_m::ACTIVE);
			$this->menu_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'menu activated successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', 'menu not activated '.$e->getMessage());
		}
		$this->controller_redirect();				
	}


	// function block($slug=NULL){
	// 	try{
	// 		if(!permission_permit(array('block-menu'))) $this->controller_redirect('Permissioin Denied');
	// 		$response=$this->get($slug);
	// 		if(!$response['success']) throw new Exception($response['data'], 1);
	// 		$this->template_data=array('status'=>menu_m::BLOCKED);
	// 		$this->menu_m->update_row($response['data']['id'],$this->template_data);
	// 		$this->session->set_flashdata('success', 'menu blocked successfully');
	// 	}
	// 	catch(Exception $e){
	// 		$this->session->set_flashdata('error', 'menu not blocked '.$e->getMessage());
	// 	}
	// 	$this->controller_redirect();				
	// }

	function delete($slug=NULL){
		try{
			// if(!permission_permit(array('delete-menu'))) $this->controller_redirect('Permissioin Denied');
			if(!$slug) throw new Exception('Invalid paramter');
			$response=$this->get($slug);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>menu_m::DELETED);
			$this->menu_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'menu deleted successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', 'menu not deleted '.$e->getMessage());
		}
		$this->controller_redirect();				
	}

	function controller_redirect($msg=false){
		if($msg) $this->session->set_flashdata('error', $msg);
		$this->template_data['link']=base_url().self::MODULE;
		redirect($this->template_data['link']);				
	}

	function get($slug=FALSE){
		$response['success']=false;
		$response['data']='Error Processing Request';
		if(!$slug) return $response;
		$menu=$this->menu_m->read_rows_by(array('slug'=>$slug),1);
		if($menu) {
			$response['success']=true;
			$response['data']=$menu;
		}
		else{
			$response['data']='menu not found';
		}
		return $response;
	}

	function order(){
		// if(!permission_permit(['list-menu'])) redirect_to_dashboard();
		$this->template_data['rows']=$this->menu_m->read_menus_for_ordering();
		$this->template_data['subview']=self::MODULE.'order';
		$this->breadcrumb->append_crumb('Order','order');
		$this->load->view('admin/main_layout',$this->template_data);		
	}


}
?>