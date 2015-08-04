<?php defined('BASEPATH') OR exit('No direct script access allowed');


class pub extends DB_REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function category_get()
    {        
        if(!$this->get('slug')) $this->response(array('invalid paramerter'), 400);
        $category=$this->load->model('category/category_m')->read_row_by_slug($this->get('slug'));
        if(!$category) $this->response(array('error'=>'Category could not be found'), 404);
        $this->response(array('data'=>$category), 200); 
    }

    public function categories_get()
    {
        $model=$this->load->model('category/category_m');
        $categories=$model->read_all_published();
        $parent_categories=$model->get_parents();
        if(!$categories) $this->response(array('nodata' => 'No Categories'), 404);
        $response=array(
            'data'=>$categories,
            'parents'=>$parent_categories,
            'model'=>array(
                'file_path'=>$model->path,
                'status'=>$model::status(),
                'actions'=>$model::actions(),
                'constant'=>$model::getConstants(),
                'rules'=>$model->set_rules(),
                )
            );
// show_pre($response);
        $this->response($response, 200); 
    }

    function category_post()
    {
        $model=$this->load->model('category/category_m');
        if(!$this->post('slug')) $this->response(NULL, 400);
        if($this->post('add')){
            $data['insert_data']=array(
                'parent_id'=>$this->input->post('parent_id')?$this->input->post('parent_id'):NULL,
                'name'=>$this->input->post('name'),
                'slug'=>$this->input->post('slug'),
                'content'=>$this->input->post('content'),
                'image'=>$_FILES['image']['name'],
                'image_title'=>$this->input->post('image_title'),
                'url'=>$this->input->post('url'),
                'order'=>$this->input->post('order'),
                'published'=>$this->input->post('published'),
                //'author'=>$current_user['id'],
                'status'=>$this->input->post('status'),
                );
            $path=get_relative_upload_file_path();
            $path.=$model::file_path;
            if($_FILES['image']['name']){
                upload_picture($model->path,'image');
            }
            $model->create_row($data['insert_data']);
            $category=$model->read_row_by_slug($this->post('slug'));
            $this->response(array('data'=>$category), 200);             
        } 
        else{
            $category=$this->load->model('category/category_m')->read_row_by_slug($this->post('slug'));
            if($category){
                $this->template_data['update_data']=array(
                    'image_title'=>$this->post('image_title'),
                    );
                $path=get_relative_upload_file_path();
                $this->load->model('category/category_m')->update_row($category['id'],$this->template_data['update_data']);
                $category=$this->load->model('category/category_m')->read_row_by_slug($this->post('slug'));
                $this->response(array('data'=>$category), 200); 
            }
            else{
                $this->response(array('error' => 'Category could not be found','slug'=>$this->post('slug')), 404);
            }  
        }
    }



}