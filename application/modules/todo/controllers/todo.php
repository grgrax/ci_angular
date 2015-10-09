<?php
class todo extends Frontend_Controller
{
	const MODULE='todo/';

	function __construct()
	{
		try {
			parent::__construct();
			
			$this->load->model('todo_m');
			$this->load->helper(array('todo'));
			
			$this->data['actions']=todo_m::actions();
			$this->data['link']=base_url().self::MODULE;
			$this->data['rows']=$this->todo_m->read_all($this->todo_m->count_rows());
			$this->breadcrumb->append_crumb('List Fund Categories',base_url().self::MODULE.'index');			
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Error '.$e->getMessage());
			redirect();
		}
	}

	function index($offset=0)
	{
		try {
			$per_page=25;
			$total=$this->todo_m->count_rows();
			$this->data['rows']=$this->todo_m->read_all($per_page,$offset);
			if($total>$per_page){
				$this->load->library('pagination');
				$config['base_url']=base_url().self::MODULE."index";
				$config['total_rows']=$total;
				$config['per_page']=$per_page;
				$config['prev']='Previous';
				$config['next']='Next';
				$this->pagination->initialize($config);
				$this->data['pages']=$this->pagination->create_links();
			}
			$this->data['total']=$total;
			$this->data['offset']=$offset;
			$this->data['subview']=self::MODULE.'index';
			$this->load->view('default/main_layout',$this->data);				
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt list fund categories '.$e->getMessage());
			$this->controller_redirect();
		}
	}

	
	function add()
	{
		try {
			if($this->input->post())
			{
				$rules=$this->todo_m->get_rules();
				// if($_FILES['image']['name']==''){
				// 	$glyphicon=array(
				// 		'field'=>'glyphicon',
				// 		'label'=>'Image or Glyphicon class',
				// 		'rules'=>'trim|required|xss_clean'
				// 		);
				// 	array_push($rules,$glyphicon);
				// }
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->data['insert_data']=array(
						'name'=>$this->input->post('name'),
						'slug'=>get_slug($this->input->post('name')),
						'content'=>$this->input->post('content'),
						// 'image'=>$_FILES['image']['name'],
						'status'=>todo_m::PUBLISHED,
						'created_at'=>date('Y-m-d H:i:s'),
						);
					// if($_FILES['image']['name']){
					// 	$path=get_relative_upload_file_path();
					// 	$path.=todo_m::file_path;
					// 	upload_picture($path,'image');
					// }
					$this->todo_m->create_row($this->data['insert_data']);
					$this->session->set_flashdata('success', 'todo added successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Add','add');
			$this->data['subview']=self::MODULE.'add';
			$this->load->view('default/main_layout',$this->data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt add todo, '.$e->getMessage());
			die($e->getMessage());
			$this->controller_redirect();
		}
	}

	function edit($slug=FALSE)
	{
		try {
			
			if(!$slug) throw new Exception("Error Processing Request", 1);
			$response=$this->get_data(array('slug'=>$slug));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->data['row']=$response['data'];
			$id=$response['data']['id'];

			if($this->input->post())
			{
				$rules=$this->todo_m->get_rules(array('name'));
				$name=$this->input->post('name');
				$name_rule=array(
					'field'=>'name',
					'label'=>'Category Fund Name',
					'rules'=>"trim|required|xss_clean|route|is_todo_name_unique[$id]",
					// 'rules'=>"trim|required|xss_clean|is_column_name_unique[$id|todo/todo_m]",
					);
				array_push($rules,$name_rule);
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					// $this->data['update_data']=array(
					// 	'description'=>$this->input->post('description'),
					// 	'image'=>$_FILES['image']['name'],
					// 	'glyphicon'=>$this->input->post('glyphicon'),
					// 	'updated_at'=>date('Y-m-d H:i:s'),
					// 	);
					// die(show_pre($this->data['update_data']));
					// if($_FILES['image']['name']){
					// 	$path=get_relative_upload_file_path();
					// 	$path.=todo_m::file_path;						
					// 	upload_picture($path,'image');
					// }
					$this->data['update_data']['name']=$this->input->post('name');
					$this->data['update_data']['slug']=get_slug($this->input->post('name'));
					$this->todo_m->update_row($id,$this->data['update_data']);
					$this->session->set_flashdata('success', 'category updated successfully');
					$this->controller_redirect();				
				}
			}			
			$this->breadcrumb->append_crumb('Edit','edit');
			$this->data['subview']=self::MODULE.'edit';
			$this->load->view('default/main_layout',$this->data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt edit category, '.$e->getMessage());
			redirect(current_url());
		}
	}

	function publish($slug=NULL){
		try{
			if(!$slug) throw new Exception('Invalid paramter');
			$response=$this->get_data(array('slug'=>$slug));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->data=array('status'=>todo_m::PUBLISHED);
			$this->todo_m->update_row($response['data']['id'],$this->data);
			$this->session->set_flashdata('success', 'category published successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', 'category not published '.$e->get_dataMessage());
		}
		$this->controller_redirect();				
	}

	function unpublish($slug=NULL){
		try{
			$response=$this->get_data(array('slug'=>$slug));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->data=array('status'=>todo_m::UNPUBLISHED);
			$this->todo_m->update_row($response['data']['id'],$this->data);
			$this->session->set_flashdata('success', 'category unpublished successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', 'category not unpublished '.$e->get_dataMessage());
		}
		$this->controller_redirect();				
	}

	function delete($slug=NULL){
		try{
			if(!$slug) throw new Exception('Invalid paramter');
			$response=$this->get_data(array('slug'=>$slug));
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->data=array('status'=>todo_m::DELETED);
			$this->todo_m->update_row($response['data']['id'],$this->data);
			$this->session->set_flashdata('success', 'category deleted successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', 'category not deleted '.$e->getMessage());
		}
		$this->controller_redirect();				
	}

	function controller_redirect($msg=false){
		if($msg) $this->session->set_flashdata('error', $msg);
		$this->data['link']=base_url().self::MODULE;
		redirect($this->data['link']);				
	}

	function get_data($param){
		$response['success']=false;
		$response['data']='Error Processing Request';
		if(!$param) return $response;
		$row=$this->todo_m->read_rows_by($param,1);
		if($row) {
			$response['success']=true;
			$response['data']=$row;
		}
		else{
			$response['data']='data not found';
		}
		return $response;
	}



}
?>