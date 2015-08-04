<?php defined('BASEPATH') OR exit('No direct script access allowed');


class api extends DB_REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->response(
            array('status' => 'SUCCESS', 
                'responseCode' => '0000', 
                'responseMessage' => 'It Works !!!'
                ));
    }

    // category
    public function category_get()
    {        
        if(!$this->get('slug')) $this->response(array('invalid paramerter'), 400);
        $category=$this->load->model('category/category_m')->read_row_by_slug($this->get('slug'));
        if(!$category) $this->response(array('Category could not be found'), 404);
        $this->response($category, 200); 
    }

    public function categories_get()
    {
        $categories=$this->load->model('category/category_m')->read_all_published();
        if(!$categories) $this->response(array('error' => 'No Categories'), 404);
        $this->response($categories, 200); 
    }

    function category_post()
    {
        if(!$this->post('slug')) $this->response(NULL, 400);
        $category=$this->load->model('category/category_m')->read_row_by_slug($this->post('slug'));
        if($category){
            $this->template_data['update_data']=array(
                // 'parent_id'=>$this->post('parent_id')?$this->post('parent_id'):NULL,
                // 'content'=>$this->post('content'),
                // 'image'=>$_FILES['image']['name'],
                'image_title'=>$this->post('image_title'),
                // 'url'=>$this->post('url'),
                );
            $path=get_relative_upload_file_path();
            $path.=category_m::file_path;
            // if($_FILES['image']['name'])
            //     upload_picture($path,'image');
            // if(!is_default($slug)){
            //     $this->template_data['update_data']['name']=$this->post('name');
            //     $this->template_data['update_data']['slug']=get_slug($this->post('name'));
            // }
            $this->load->model('category/category_m')->update_row($category['id'],$this->template_data['update_data']);
            $category=$this->load->model('category/category_m')->read_row_by_slug($this->post('slug'));
            $this->response($category, 200); 
        }
        else
            $this->response(array('error' => 'Category could not be found'), 404);
    }
    // category

    // user
    public function user_get()
    {        
        if(!$this->get('username')) $this->response(array('invalid paramerter'), 400);
        $user=$this->load->model('user/user_m')->read_row_by_username($this->get('username'));
        if(!$user) $this->response(array('user could not be found'), 404);
        $this->response($user, 200); 
    }

    public function users_get()
    {
        $users=$this->load->model('user/user_m')->read_all_active();
        if(!$users) $this->response(array('error' => 'No Users'), 404);
        $this->response($users, 200); 
    }
    
    function user_post()
    {
        if(!$this->post('username')) $this->response(array('user could not be found.'), 400);
        $user=$this->load->model('user/user_m')->read_row_by_username($this->post('username'));
        if($user){
            $this->template_data['update_data']=array(
                'email'=>$this->post('email'),
                );
            $this->load->model('user/user_m')->update_row($user['id'],$this->template_data['update_data']);
            $user=$this->load->model('user/user_m')->read_row_by_username($this->post('username'));
            // $this->response($user, 200); 
            $this->response(array('status'=>'success','user'=>$user), 200); 
        }
        else
            $this->response(array('error' => 'user could not be found'), 404);
    }
    // user
}