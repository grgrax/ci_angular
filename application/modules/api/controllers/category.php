<?php defined('BASEPATH') OR exit('No direct script access allowed');


class category extends DB_REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
    }

    function index_get()
    {        
        try {
            if($this->get('slug')){
                $slug=$this->get('slug');
                $get_response=$this->_get($slug);
                if(!$get_response['success']) throw new Exception($get_response['data'], 1);
                $category=$get_response['data'];
                if(!$category) throw new Exception("No category found", 1);
                $data=$category;
            }else{
                $param['id >']=0;
                $categorys=$this->load->model('category/category_m')->read_rows_by($param);
                $data=$categorys?:null;
            } 
            $this->response(array('sucess'=>true,'data'=>$data), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }

    function add_post()
    {
        try {
            $model=$this->load->model('category/category_m');

            $data=array(
                'name'=>$this->input->post('name'),
                'content'=>$this->input->post('content'),
                'slug'=>get_slug($this->input->post('name')),
                'status'=>category_m::ACTIVE,
                );
            $sucess=$model->create_row_n($data);
            if(!$sucess) throw new Exception("Error while updating.", 1);                
            $this->response(array('sucess'=>true,'data'=>$category['name']." added sucessfully"), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }

    }

    function edit_post()
    {
        try {
            $model=$this->load->model('category/category_m');

            $slug=$this->post('slug');
            $get_response=$this->_get($slug);
            if(!$get_response['success']) throw new Exception($get_response['data'], 1);
            $category=$get_response['data'];
            
            if(!$category) throw new Exception("No category found", 1);
            $data=array(
                'name'=>$this->input->post('name'),
                'content'=>$this->input->post('content'),
                'status'=>$this->input->post('status'),
                );
            $sucess=$model->update_row_n($category['id'],$data);
            if(!$sucess) throw new Exception("Error while updating.", 1);                
            $this->response(array('sucess'=>true,'data'=>$category['name']." updated sucessfully"), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }


    function delete_post()
    {
        try {
            $model=$this->load->model('category/category_m');

            $slug=$this->post('slug');
            $get_response=$this->_get($slug);
            if(!$get_response['success']) throw new Exception($get_response['data'], 1);
            $category=$get_response['data'];
            
            if(!$category) throw new Exception("No category found", 1);
            $data=array(
                'status'=>category_m::DELETED,
                );
            $sucess=$model->update_row_n($category['id'],$data);
            if(!$sucess) throw new Exception("Error while updating.", 1);                
            $this->response(array('sucess'=>true,'data'=>$category['name']." deleted sucessfully"), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }


    function _get($slug=FALSE){
        $response['success']=false;
        $response['data']='No Slug found';
        if(!$slug) 
            return $response;
        $param['slug']=$slug;
        $category=$this->load->model('category/category_m')->read_row_by_n($param);
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