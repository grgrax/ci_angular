<?php
class club_member extends Admin_Controller
{
	const MODULE='article/admin/widget/';

	function __construct()
	{
		parent::__construct();
		// if(!permission_permit(['administrator-article'])) redirect_to_dashboard();
		$this->load->helper(array('category/category'));
		$this->load->model(array('article_m','category/category_m'));
		$this->template_data['article_m']=$this->article_m;
		$this->template_data['category_m']=$this->category_m;
		$this->template_data['actions']=article_m::actions();
		$this->template_data['link']=base_url().self::MODULE;
		// $this->template_data['categories']=$this->category_m->read_all($this->category_m->count_rows());
		// $this->template_data['rows']=$this->article_m->read_all($this->article_m->count_rows());
		$this->breadcrumb->append_crumb('Footer / Header Section',base_url().self::MODULE.'index');
	}

	function index($widget='messages'){
		switch ($widget) {
			case article_m::WIDGET_MESSAGE:{
				$view='message/ajax/index';
				break;
			}				
			case article_m::WIDGET_PROJECT:{
				$view='project/ajax/index';
				break;
			}				
			case article_m::WIDGET_NEWS:{
				$view='news/ajax/index';
				break;
			}				
			default:{
			}
		}
		$this->template_data['subview']=self::MODULE.$view;
		$result=$this->load->view($this->template_data['subview'],$this->template_data,true);	
		echo $result;	
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
					echo json_encode($$this->template_data['insert_data']);
					// $success=$this->article_m->create_row_n($this->template_data['insert_data']);
					// if(!$success) throw new Exception("database insert error", 1);					
					// $this->session->set_flashdata('success', 'Added successfully');
					// if($category) redirect("article/category/$category_name");
					// $this->controller_redirect();
				}
			}			
			$this->breadcrumb->append_crumb('Add','add');
			$this->template_data['subview']=self::MODULE.'add';
			$this->load->view('admin/widget/club_member/ajax/add');
		} catch (Exception $e) {
			$this->session->set_flashdata('error', 'Couldnt add article '.$e->getMessage());
			redirect(current_url());				
		}
	}

	function add_()
	{
		$response['success']=false;
		try {
			if($this->input->post()){
				switch ($this->input->post('widget_slug')) {
					case 'messages':{
						$rules=get_widget_rules('message');
						break;
					}					
					case article_m::WIDGET_PROJECT:{
						$rules=get_widget_rules(article_m::WIDGET_PROJECT);
						break;
					}					
					case article_m::WIDGET_NEWS:{
						$rules=get_widget_rules(article_m::WIDGET_NEWS);
						break;
					}					
				}
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this))
				{
					switch ($this->input->post('widget_slug')) {
						case 'messages':{
							$data['insert_data']=array(
								'category_id'=>$this->input->post('category_id'),
								'name'=>$this->input->post('name'),
								'slug'=>get_slug($this->input->post('name')),
								'content'=>$this->input->post('content'),
								'title'=>$this->input->post('title'),
								'image'=>$this->input->post('message_uploaded_file'),
								'image_title'=>$this->input->post('image_title')?:'',
								'image_title_2'=>$this->input->post('image_title_2')?:'',
			                    // 'order'=>$this->input->post('order')?$this->input->post('order'):0,
								'status'=>article_m::PUBLISHED,
								'author'=>Current_User::getId(),
								);
							break;
						}					
						case article_m::WIDGET_PROJECT:{
							$data['insert_data']=array(
								'category_id'=>$this->input->post('category_id'),
								'name'=>$this->input->post('name'),
								'slug'=>get_slug($this->input->post('name')),
								'content'=>$this->input->post('content'),
								'status'=>article_m::PUBLISHED,
								'author'=>Current_User::getId(),
								);
							break;
						}					
						case article_m::WIDGET_NEWS:{
							$data['insert_data']=array(
								'category_id'=>$this->input->post('category_id'),
								'name'=>$this->input->post('name'),
								'slug'=>get_slug($this->input->post('name')),
								'content'=>$this->input->post('content'),
								'image'=>$this->input->post('news_uploaded_file'),
								'status'=>article_m::PUBLISHED,
								'author'=>Current_User::getId(),
								);
							break;
						}					
					}
					// show_pre($data['insert_data']);
					// die;
					$sucess=$this->article_m->create_row_n($data['insert_data']);
					if(!$sucess) throw new Exception("Error while inserting.", 1);
					$response['success']=true;
					$response['data']=$this->input->post('name')." saved sucessfully";
				}
				else{
					throw new Exception(validation_errors());
				}
			}else{
				throw new Exception("Error Processing Request, No parameter", 1);                
			}
		} catch (Exception $e) {
			$response['data']=$e->getMessage();
		}
		echo json_encode($response);
	}

	function uploadfile($widget_type)
	{
		try {
			$response['success']=false;
			$path=get_relative_upload_file_path();
			switch ($widget_type) {
				case article_m::WIDGET_MESSAGE:{
					$path.=article_m::file_path.'/'.article_m::WIDGET_MESSAGE."/";
					break;
				}					
				case article_m::WIDGET_NEWS:{
					$path.=article_m::file_path.'/'.article_m::WIDGET_NEWS."/";
					break;
				}
			}
			foreach($_FILES as $file)
			{
				$name=$file['name'];
				$tmp_name=$file['tmp_name'];
				$type=$file['type'];
				$size=$file['size'];

				$target_dir = $path;
				$target_file = $target_dir . basename($name);
				// show_pre($file);
				if($name){	
					if($type != "image/jpg" && $type != "image/png" && $type != "image/jpeg" && $type != "image/gif" ) 
						throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 1);
					if ($size > 500000)
						throw new Exception("Sorry, your file is too large.", 1);
					if (move_uploaded_file($tmp_name, $target_file)) {
						$response['success']=true;			
						$response['data']="The file ". basename($name). " has been uploaded.";
						$response['filename']=basename($name);
					} else {
						throw new Exception("Sorry, there was an error uploading your file", 1);
					}		
				}
				else{
					throw new Exception("No file selected to upload", 1);                
				}
			}
		} catch (Exception $e) {
			$response['data']=$e->getMessage();
		}
		echo json_encode($response);
	}

	function edit()
	{
		$response['success']=false;
		try {
			$slug=$this->input->post('slug');

			if(!$slug) throw new Exception("No slug.", 1);			
			$article_response=$this->get($slug);
			if(!$article_response['success']) throw new Exception($article_response['data'], 1);
			$id=$article_response['data']['id'];			

			$rules=get_widget_rules('message');
			if($this->input->post()){
				switch ($this->input->post('widget_slug')) {
					case 'messages':{
						$rules=get_widget_rules('message');
						break;
					}					
					case article_m::WIDGET_PROJECT:{
						$rules=get_widget_rules(article_m::WIDGET_PROJECT);
						break;
					}					
					case article_m::WIDGET_NEWS:{
						$rules=get_widget_rules(article_m::WIDGET_NEWS);
						break;
					}					
				}
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this))
				{
					switch ($this->input->post('widget_slug')) {
						case 'messages':{
							$data['update_data']=array(
								'name'=>$this->input->post('name'),
								'content'=>$this->input->post('content'),
								'title'=>$this->input->post('title'),
								'image_title'=>$this->input->post('image_title')?:'',
								'image_title_2'=>$this->input->post('image_title_2')?:'',
								'order'=>$this->input->post('order')?:null,
								);
							if($this->input->post('uploaded_file')){
								$data['update_data']['image']=$this->input->post('uploaded_file');									
							}
							break;
						}					
						case article_m::WIDGET_PROJECT:{
							$data['update_data']=array(
								'name'=>$this->input->post('name'),
								'content'=>$this->input->post('content'),
								'modified_by'=>Current_User::getId(),
								'order'=>$this->input->post('order')?:null,
								);
							break;
						}					
						case article_m::WIDGET_NEWS:{
							$data['update_data']=array(
								'name'=>$this->input->post('name'),
								'content'=>$this->input->post('content'),
								'modified_by'=>Current_User::getId(),
								'order'=>$this->input->post('order')?:null,
								);
							if($this->input->post('news_uploaded_file')){
								$data['update_data']['image']=$this->input->post('news_uploaded_file');									
							}
							break;
						}					
					}
					// show_pre($data['update_data']);
					// die;
					$sucess=$this->article_m->update_row_n($id,$data['update_data']);
					if(!$sucess) throw new Exception("Error while updating.", 1);                
					$response['success']=true;
					$response['data']=$this->input->post('name')." updated sucessfully";
				}
				else{
					throw new Exception(validation_errors());
				}
			}else{
				throw new Exception("Error Processing Request, No parameter", 1);                
			}
		} catch (Exception $e) {
			$response['data']=$e->getMessage();
		}
		echo json_encode($response);
	}

	function delete($slug=NULL,$category=false){
		try{
			// if(!permission_permit(array('delete-article'))) $this->controller_redirect('Permissioin Denied');
			$response['success']=false;
			if(!$slug) throw new Exception('Invalid paramter');

			$article_response=$this->get($slug);
			if(!$article_response['success']) throw new Exception($response['data'], 1);

			$this->template_data=array('status'=>article_m::DELETED);

			$sucess=$this->article_m->update_row_n($article_response['data']['id'],$this->template_data);
			if(!$sucess) throw new Exception("Error while deleting.", 1);                
			$response['success']=true;
			$response['data']=$article_response['data']['name']." deleted sucessfully";
		}
		catch(Exception $e){
			$response['data']=$e->getMessage();
		}
		echo json_encode($response);
	}

	function get($slug=null){
		try {
			$response['success']=false;
			if(!$slug) throw new Exception("Error Processing Request", 1);
			$article=$this->article_m->read_rows_by(array('slug'=>$slug),1);
			if(!$article) throw new Exception("No article", 1);			
			$response['success']=true;
			$response['data']=$article;
		} catch (Exception $e) {			
			$response['data']=$e->getMessage();
		}
		// show_pre($response);
		return $response;
	}

	
}
?>