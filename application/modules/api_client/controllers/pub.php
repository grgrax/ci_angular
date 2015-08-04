<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pub extends Admin_Controller {

	private $api_url;
	private $response;
	const MODULE="api_client/";

	function __construct(){
		try {
			parent::__construct();
			$this->api_url=get_setting('own_api_url');
			$this->breadcrumb->append_crumb('List IIT categories',base_url().self::MODULE.'index');
			$this->response = json_decode(file_get_contents("$this->api_url/pub/categories"),true);
			$api_url_string="<a class='lower' href='".get_setting('own_api_url')."'>".get_setting('own_api_url')."</a>";
			$this->template_data['link']=base_url().'api_client/pub/';
			$this->template_data['api_url_string']=$api_url_string;
			if(!$this->response) throw new Exception("Couldnt reach API", 1);
		} catch (Exception $e) {
			echo $e->getMessage();			
		}
	}

	function index(){
		$this->template_data['rows']=$this->response['data'];
		$this->template_data['category_m']=$this->response['model'];
		$this->template_data['subview']=self::MODULE.'categories/list';
		$this->load->view('admin/main_layout',$this->template_data);
	}
	
	function add()
	{
		try {
			if($this->input->post())
			{
				$rules=$this->response['model']['rules'];
				/*
				$name=array(
					'field'=>'name',
					'label'=>'Category Name',
					'rules'=>'trim|required|is_unique[tbl_categories.name]|xss_clean'
					);
				array_push($rules,$name);
				*/
				$this->form_validation->set_rules($rules);
				$total=count($this->response['data']);
				if($this->form_validation->run($this)===TRUE)
				{
					// $current_user=current_loggedin_user();
					$slug=url_title($this->input->post('name'), '-', TRUE);
					$data['insert_data']=array(
						'add'=>true,
						'parent_id'=>$this->input->post('parent_id')?$this->input->post('parent_id'):NULL,
						'name'=>$this->input->post('name'),
						'slug'=>$slug,
						'content'=>$this->input->post('content'),
						'image'=>$_FILES['image']['name'],
						'image_title'=>$this->input->post('image_title'),
						'url'=>$this->input->post('url'),
						'order'=>$total+1,
						'published'=>1,
						// 'author'=>$current_user['id'],
						'status'=>1,
						);
					/*
					$path=get_relative_upload_file_path();
					$path.=category_m::file_path;
					if($_FILES['image']['name'])
						upload_picture($path,'image');
					*/
						$response=$this->create($data['insert_data']);
						if(!$response) throw new Exception("Couldnt add new category", 1);
						$this->session->set_flashdata('success', 'category added successfully');
						$this->controller_redirect();				
					}else{
						throw new Exception(validation_errors());
					}
				}			
				$this->breadcrumb->append_crumb('Add','add');
				$this->template_data['parents']=$this->response['parents'];
				$this->template_data['subview']=self::MODULE.'categories/add';
				$this->load->view('admin/main_layout',$this->template_data);
			} catch (Exception $e) {
				echo $e->getMessage();
				die;
				$this->session->set_flashdata('error', 'Couldnt add category '.$e->getMessage());
				$this->controller_redirect();
			}
		}

		function create($data)
		{
			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, "$this->api_url/pub/category");
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);
			$result = json_decode($buffer,true);
			if(isset($result['data']['name']) && $result['data']['name'] == $data['name']){
				return $result;
			}
			else{
				return null;
			}
		}

		function controller_redirect($msg=false){
			if($msg) $this->session->set_flashdata('error', $msg);
			$this->template_data['link']=base_url().self::MODULE;
			redirect($this->template_data['link']);				
		}

	}

