<?php
class category extends Admin_Controller
{
	const MODULE='category/';

	function __construct()
	{
		parent::__construct();
		// if(!permission_permit(['administrator-category'])) redirect_to_dashboard();
		$this->template_data['link']=base_url().self::MODULE;
		$this->breadcrumb->append_crumb('List Categories',base_url().self::MODULE.'index');
	}

	function index($offset=0)
	{
		try {
			
			$db_param['c.id >']=0;
			$per_page=5;

			//filter		
			$param = '';
			if($this->input->get()){				
				$filters = array();				
				foreach($this->input->get() as $k=>$v){
					if($k == 'per_page' or $k == 'filter'){
					}
					elseif ($v !='' ){
						$filters[$k]=$v;
						$param .=  $k.'='.$v.'&'; 						
					} 
				}				
				$offset = $this->input->get('per_page');
				$param = substr($param,0,-1);
				$db_param=$filters;

				foreach ($filters as $key => $value) {
					$db_param[$key]=$value;						
				}				
			}
			//filter		

			$total_rows=count($this->category_m->filter_rows_by($db_param));
			$articles=$this->category_m->filter_rows_by($db_param,$per_page,$offset);

			if($total_rows>$per_page){
				$config['base_url']=base_url().self::MODULE."index";
				$config['total_rows']=$total_rows;
				$config['per_page']=$per_page;
				$config['prev']='Previous';
				$config['next']='Next';
				$this->pagination->initialize($config);
				$this->template_data['pages']=$this->pagination->create_links();
			}
			$this->template_data['rows']=$articles;
			$this->template_data['offset']=$offset;
			$this->template_data['subview']=self::MODULE.'list';
			$this->load->view('admin/main_layout',$this->template_data);
			
		} catch (Exception $e) {			
			$this->session->set_flashdata('error', "Couldn't load Categories ".$e->getMessage());
			redirect('');
		}
	}


	function add()
	{
		try {
			// if(!permission_permit(array('list-category','add-category'))) $this->controller_redirect('Permissioin Denied');
			if($this->input->post())
			{
				$rules=$this->category_m->set_rules();
				$name=array(
					'field'=>'name',
					'label'=>'Category Name',
					'rules'=>'trim|required|is_unique[tbl_categories.name]|xss_clean'
					);
				array_push($rules,$name);
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$current_user=current_loggedin_user();
					$this->template_data['insert_data']=array(
						'parent_id'=>$this->input->post('parent_id')?$this->input->post('parent_id'):NULL,
						'name'=>$this->input->post('name'),
						'slug'=>get_slug($this->input->post('name')),
						'content'=>$this->input->post('content'),
						'image'=>$_FILES['image']['name'],
						'image_title'=>$this->input->post('image_title'),
						'url'=>$this->input->post('url'),
						// 'order'=>$this->category_m->count_rows()+1,
						// 'published'=>1,
						'author'=>$current_user['id'],
						'status'=>category_m::PUBLISHED,
						);
					$path=get_relative_upload_file_path();
					$path.=category_m::file_path;
					if($_FILES['image']['name'])
						upload_picture($path,'image');
					$this->category_m->create_row_n($this->template_data['insert_data']);
					$this->session->set_flashdata('success', 'Category added successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Add','add');
			$this->template_data['subview']=self::MODULE.'add';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt add category '.$e->getMessage());
			redirect(current_url());
		}
	}

	function edit($slug=FALSE)
	{
		try {
			// if(!permission_permit(array('list-category','edit-category'))) throw new Exception("Permissioin Denied", 1);
			if(!$slug) throw new Exception("Error Processing Request", 1);
			$response=$this->get($slug);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data['row']=$response['data'];
			$id=$response['data']['id'];
			
			if($this->input->post())
			{
				$rules=$this->category_m->set_rules();
				$name=$this->input->post('name');
				$name_rule=array(
					'field'=>'name',
					'label'=>'Category Name',
					'rules'=>"trim|required|xss_clean|is_category_name_unique[$id]",
					);
				array_push($rules,$name_rule);

				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['update_data']=array(
						'parent_id'=>$this->input->post('parent_id')?$this->input->post('parent_id'):NULL,
						'content'=>$this->input->post('content'),
						'image'=>$_FILES['image']['name'],
						'image_title'=>$this->input->post('image_title'),
						'url'=>$this->input->post('url'),
						);
					

					$path=get_relative_upload_file_path();
					$path.=category_m::file_path;
					if($_FILES['image']['name'])
						upload_picture($path,'image');
					if(!is_default($slug)){
						$this->template_data['update_data']['name']=$this->input->post('name');
						$this->template_data['update_data']['slug']=get_slug($this->input->post('name'));
					}
					$this->category_m->update_row_n($id,$this->template_data['update_data']);
					$this->session->set_flashdata('success', 'category updated successfully');
					redirect(current_url());
				}
			}			
			$this->breadcrumb->append_crumb('Edit','edit');
			$this->template_data['subview']=self::MODULE.'edit';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->controller_redirect('Couldnt edit category '.$e->getMessage());
			redirect(current_url());
		}
	}

	// function publish($slug=NULL){
	// 	try{
	// 		if(!permission_permit(array('activate-category'))) $this->controller_redirect('Permissioin Denied');
	// 		if(!$slug) throw new Exception('Invalid paramter');
	// 		$response=$this->get($slug);
	// 		if(!$response['success']) throw new Exception($response['data'], 1);
	// 		$this->template_data=array('published'=>category_m::PUBLISHED);
	// 		$this->category_m->update_row($response['data']['id'],$this->template_data);
	// 		$this->session->set_flashdata('success', 'category published successfully');
	// 	}
	// 	catch(Exception $e){
	// 		$this->session->set_flashdata('error', 'category not published '.$e->getMessage());
	// 	}
	// 	$this->controller_redirect();				
	// }


	// function unpublish($slug=NULL){
	// 	try{
	// 		if(!permission_permit(array('block-category'))) $this->controller_redirect('Permissioin Denied');
	// 		$response=$this->get($slug);
	// 		if(!$response['success']) throw new Exception($response['data'], 1);
	// 		$this->template_data=array('published'=>category_m::UNPUBLISHED);
	// 		$this->category_m->update_row($response['data']['id'],$this->template_data);
	// 		$this->session->set_flashdata('success', 'category unpublished successfully');
	// 	}
	// 	catch(Exception $e){
	// 		$this->session->set_flashdata('error', 'category not unpublished '.$e->getMessage());
	// 	}
	// 	$this->controller_redirect();				
	// }

	function delete($slug=NULL){
		try{
			// if(!permission_permit(array('delete-category'))) $this->controller_redirect('Permissioin Denied');
			if(!$slug) throw new Exception('Invalid paramter');
			if(is_default_category($slug)) {
				throw new Exception("default category", 1);
			}
			$response=$this->get($slug);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>category_m::DELETED);
			$this->category_m->update_row_n($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'category deleted successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', 'category not deleted '.$e->getMessage());
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
		$category=$this->category_m->read_rows_by(array('slug'=>$slug),1);
		if($category) {
			$response['success']=true;
			$response['data']=$category;
		}
		else{
			$response['data']='category not found';
		}
		return $response;
	}



}
?>



















