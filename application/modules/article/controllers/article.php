<?php
class article extends Admin_Controller
{
	const MODULE='article/';

	function __construct()
	{
		try {
			parent::__construct();
		// if(!permission_permit(['administrator-article'])) redirect_to_dashboard();
			$categories=get_published_categories(array('id'=>0));		
			if(count($categories)==0 or !$categories) throw new Exception("No categories found, please add category first", 1);
			$this->template_data['categories']=$categories;
			$this->template_data['link']=base_url().self::MODULE;
			$this->breadcrumb->append_crumb('Articles ',base_url().self::MODULE.'index');
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
			redirect('');			
		}
	}

	function index($offset=0)
	{
		try {

			$db_param['a.id >']=0;
			$per_page=50;


			//filter		
			$param = '';
			if($this->input->get()){				
				unset($db_param['a.id >']);								
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
				// show_pre($db_param);	
			}
			//filter		

			$total_rows=count($this->article_m->filter_rows_by($db_param));
			$articles=$this->article_m->filter_rows_by($db_param,$per_page,$offset);


		// //exclude help articles
		// $all_articles=$final_articles=array();
		// $all_articles=$this->article_m->read_all($per_page,$offset);
		// foreach ($all_articles as $article) {
		// 	$category=$this->category_m->read_row($article['category_id']);
		// 	if($category){
		// 		if($category['slug']!=CATEGORY_HELP) $final_articles[]=$article;				
		// 	}
		// }
		// $this->template_data['rows']=$final_articles;

			if($total_rows>$per_page){
				$this->load->library('pagination');
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
			$this->session->set_flashdata('error', 'Couldnt add '.$e->getMessage());
			redirect('');
		}
	}



	function add($category=null,$name=null)
	{
		try {
			// if(!permission_permit(array('list-article','add-article'))) $this->controller_redirect('Permissioin Denied');
			$category_name=$name;
			if($category && $name){
				$response=$this->get_category($name);
				if(!$response['success']) throw new Exception($response['data'], 1);
				$this->template_data['category']=$response['data'];
				$this->template_data['link']=base_url("article/category/$name");
			}
			if($this->input->post())
			{
				$rules=$this->article_m->set_rules();
				$name=array(
					'field'=>'name',
					'label'=>'Article Name',
					'rules'=>'trim|required|is_unique[tbl_articles.name]|xss_clean'
					);
				array_push($rules,$name);
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$this->template_data['insert_data']=array(
						'category_id'=>$this->input->post('category'),
						'name'=>$this->input->post('name'),
						'slug'=>get_slug($this->input->post('name')),
						'content'=>$this->input->post('content'),
						'url1'=>$this->input->post('url')?:NULL,
						'image_title'=>$this->input->post('image_title')?:NULL,
						'video_title'=>$this->input->post('video_title')?:NULL,
						'video_url'=>$this->input->post('video_url')?:NULL,
						'embed_code'=>$this->input->post('embed_code')?:NULL,
						'meta_desc'=>$this->input->post('meta_desc')?:NULL,
						'meta_key'=>$this->input->post('meta_key')?:NULL,
						'meta_robots'=>$this->input->post('meta_robots')?:NULL,
						'author'=>Current_User::getId(),
						'status'=>article_m::PUBLISHED,
						);
					if($_FILES['image']['name']){
						$this->template_data['insert_data']['image']=$_FILES['image']['name'];
						$path=get_relative_upload_file_path();
						$path.=article_m::file_path;
						upload_picture($path,'image');
					}
					if($_FILES['video']['name']){
						$this->template_data['insert_data']['video']=$_FILES['video']['name'];
						$video_path=get_relative_upload_video_path();
						$video_path.=article_m::file_path;
						upload_video($video_path,'video');
					}
					$success=$this->article_m->create_row_n($this->template_data['insert_data']);
					if(!$success) throw new Exception("database insert error", 1);					
					$this->session->set_flashdata('success', 'Added successfully');
					if($category) redirect("article/category/$category_name");
					$this->controller_redirect();
				}
			}			
			$this->breadcrumb->append_crumb('Add','add');
			$this->template_data['subview']=self::MODULE.'add';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt add article '.$e->getMessage());
			redirect(current_url());				
		}
	}

	function edit($slug=FALSE)
	{
		try {
			// if(!permission_permit(array('list-article','edit-article'))) throw new Exception("Permissioin Denied", 1);
			if(!$slug) throw new Exception("Error Processing Request", 1);
			$response=$this->get($slug);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data['row']=$response['data'];
			$id=$response['data']['id'];			
			if($this->input->post())
			{
				$rules=$this->article_m->set_rules();
				$name=$this->input->post('name');
				$name_rule=array(
					'field'=>'name',
					'label'=>'Article Name',
					'rules'=>"trim|required|xss_clean|is_article_name_unique[$id]",
					);
				array_push($rules,$name_rule);

				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					$current_user=current_loggedin_user();
					$this->template_data['update_data']=array(
						'category_id'=>$this->input->post('category')?$this->input->post('category'):NULL,
						'name'=>$this->input->post('name'),
						'content'=>$this->input->post('content'),
						'url1'=>$this->input->post('url')?:NULL,
						'image_title'=>$this->input->post('image_title')?:NULL,
						'video_title'=>$this->input->post('video_title')?:NULL,
						'video_url'=>$this->input->post('video_url')?:NULL,
						'embed_code'=>$this->input->post('embed_code')?:NULL,
						'meta_desc'=>$this->input->post('meta_desc')?:NULL,
						'meta_key'=>$this->input->post('meta_key')?:NULL,
						'meta_robots'=>$this->input->post('meta_robots')?:NULL,
						'updated_at'=>date('Y-m-d H:i:s'),
						'modified_by'=>Current_User::getId(),
						'order'=>$this->input->post('order')?:null,
						);

					if($_FILES['image']['name']){
						$this->template_data['update_data']['image']=$_FILES['image']['name'];
						$path=get_relative_upload_file_path();
						$path.=article_m::file_path;
						upload_picture($path,'image');
					}
					if($_FILES['video']['name']){
						$this->template_data['update_data']['video']=$_FILES['video']['name'];
						$video_path=get_relative_upload_video_path();
						$video_path.=article_m::file_path;
						upload_video($video_path,'video');
					}
					// show_pre($this->template_data['update_data']);
					// die;
					$this->article_m->update_row($id,$this->template_data['update_data']);
					$this->session->set_flashdata('success', 'Updated successfully');
					// $this->controller_redirect();				
					redirect(current_url());				
				}
			}			
			$this->breadcrumb->append_crumb('Edit','edit');
			$this->template_data['subview']=self::MODULE.'edit';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt edit article '.$e->getMessage());
			redirect(current_url());				
		}
	}

	// function publish($slug=NULL){
	// 	try{
	// 		if(!permission_permit(array('activate-article'))) $this->controller_redirect('Permissioin Denied');
	// 		if(!$slug) throw new Exception('Invalid paramter');
	// 		$response=$this->get($slug);
	// 		if(!$response['success']) throw new Exception($response['data'], 1);
	// 		$this->template_data=array('status'=>article_m::PUBLISHED);
	// 		$this->article_m->update_row($response['data']['id'],$this->template_data);
	// 		$this->session->set_flashdata('success', 'article published successfully');
	// 	}
	// 	catch(Exception $e){
	// 		$this->session->set_flashdata('error', 'article not published '.$e->getMessage());
	// 	}
	// 	$this->controller_redirect();				
	// }


	// function unpublish($slug=NULL){
	// 	try{
	// 		if(!permission_permit(array('block-article'))) $this->controller_redirect('Permissioin Denied');
	// 		$response=$this->get($slug);
	// 		if(!$response['success']) throw new Exception($response['data'], 1);
	// 		$this->template_data=array('status'=>article_m::UNPUBLISHED);
	// 		$this->article_m->update_row($response['data']['id'],$this->template_data);
	// 		$this->session->set_flashdata('success', 'article unpublished successfully');
	// 	}
	// 	catch(Exception $e){
	// 		$this->session->set_flashdata('error', 'article not unpublished '.$e->getMessage());
	// 	}
	// 	$this->controller_redirect();				
	// }

	function delete($slug=NULL,$category=false){
		try{
			if($category){
				// if(!permission_permit(array('delete-article'))) $this->controller_redirect('Permissioin Denied');
			}
			if(!$slug) throw new Exception('Invalid paramter');
			$response=$this->get($slug);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data=array('status'=>article_m::DELETED);
			$this->article_m->update_row($response['data']['id'],$this->template_data);
			$this->session->set_flashdata('success', 'Deleted successfully');
		}
		catch(Exception $e){
			$this->session->set_flashdata('error', 'article not deleted '.$e->getMessage());
		}
		$this->controller_redirect();				
	}


	function controller_redirect($msg=false){
		if($msg) $this->session->set_flashdata('error', $msg);
		$this->template_data['link']=base_url().self::MODULE;
		redirect($this->template_data['link']);				
	}

	function get($slug=FALSE,$response_type_json=null){
		sleep(1);
		$response['success']=false;
		$response['data']='Error Processing Request';
		if(!$slug) return $response;
		$article=$this->article_m->read_rows_by(array('slug'=>$slug),1);
		if($article) {
			$response['success']=true;
			$response['data']=$article;
		}
		else{
			$response['data']='article not found';
		}
		if(!$response_type_json) return $response;
		echo json_encode($response);
	}

	function get_category($slug=FALSE){
		$response['success']=false;
		$response['data']='Error Processing Request';
		if(!$slug) return $response;
		$category=$this->category_m->read_row_by_slug($slug);
		if($category) {
			$response['success']=true;
			$response['data']=$category;
		}
		else{
			$response['data']='category not found';
		}
		return $response;
	}

	function category($slug=null,$offset=0)
	{
		try {
			// if(!permission_permit(['list-article'])) redirect_to_dashboard();
			$per_page=50;			
			$response=$this->get_category($slug);
			if(!$response['success']) throw new Exception($response['data'], 1);
			$this->template_data['category']=$response['data'];

			$id=$response['data']['id'];			
			$total_rows=$this->article_m->count_articles_of_category($id);
			$this->template_data['rows']=$this->article_m->read_articles_of_category($id,$per_page,$offset);
			if($total_rows>$per_page){
				$this->load->library('pagination');
				$config['uri_segment'] = 4;
				$config['base_url']=base_url("article/category/$slug");
				$config['total_rows']=$total_rows;
				$config['per_page']=$per_page;
				$config['prev']='Previous';
				$config['next']='Next';
				$this->pagination->initialize($config);
				$this->template_data['pages']=$this->pagination->create_links();
			}
			$this->template_data['offset']=$offset;
			$this->template_data['subview']=self::MODULE.'list';
			$this->load->view('admin/main_layout',$this->template_data);			
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt load article for such category '.$e->getMessage());
			$this->controller_redirect();			
		}
	}


}
?>