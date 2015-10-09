<?php defined('BASEPATH') OR exit('No direct script access allowed');


class article extends DB_REST_Controller
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
                $param['slug']=$slug;
                $article=$this->load->model('article/article_m')->read_rows_by($param,1);
                if(!$article) throw new Exception("No Article found", 1);
                $data=$article;
            }else{
                $param['id >']=0;
                $articles=$this->load->model('article/article_m')->read_rows_by($param);
                $data=$articles?:null;
            } 
            $this->response(array('sucess'=>true,'data'=>$data), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }

    function in_post()
    {
        try {
            if($this->input->post()){
                $model=$this->load->model('article/article_m');            
                $rules=get_widget_rules('message');
                $this->form_validation->set_rules($rules);
                if($this->form_validation->run($this))
                {
                    die('y');
                    $data['insert_data']=array(
                        'name'=>$this->input->post('name'),
                //     'slug'=>get_slug($this->input->post('name')),
                //     'content'=>$this->input->post('content'),
                // // 'image'=>$_FILES['image']['name'],
                // // 'image_title'=>$this->input->post('image_title'),
                //     'url1'=>$this->input->post('url1')?:'',
                //     'url2'=>$this->input->post('url2')?:'',
                //     'order'=>$this->input->post('order')?$this->input->post('order'):0,
                        'status'=>article_m::PUBLISHED,
                // 'author'=>$current_user['id'],
                        );
                // $path=get_relative_upload_file_path();
                // $path.=$model::file_path;
                // if($_FILES['image']['name']){
                //     upload_picture($model->path,'image');
                // }
                    $sucess=$model->create_row_n($data['insert_data']);
                    if(!$sucess) throw new Exception("Error while inserting.", 1);                
                    $this->response(array('sucess'=>true,'data'=>$this->input->post('name')." saved sucessfully"), 200);
                }
                else{
                    throw new Exception(validation_errors());
                }
            }else{
                throw new Exception("Error Processing Request, No parameter", 1);                
            }
        } catch (Exception $e) {
            // die($e->getMessage());
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }

    function edit_post()
    {
        try {
            $model=$this->load->model('article/article_m');

            if(!$this->post('slug')) throw new Exception("Slug parameter not found", 1);

            $slug=$this->get('slug');

            $get_response=$this->_get($slug);
            if(!$get_response['success']) throw new Exception($get_response['data'], 1);

            $article=$get_response['data'];
            if(!$article) throw new Exception("No Article found", 1);

            $data['update_data']=array(
                'name'=>$this->input->post('name'),
                'content'=>$this->input->post('content'),
                // 'image'=>$_FILES['image']['name'],
                // 'image_title'=>$this->input->post('image_title'),
                'url1'=>$this->input->post('url1')?:'',
                'url2'=>$this->input->post('url2')?:'',
                'order'=>$this->input->post('order'),
                //'author'=>$current_user['id'],
                'status'=>$this->input->post('status'),
                );
                // $path=get_relative_upload_file_path();
                // $path.=$model::file_path;
                // if($_FILES['image']['name']){
                //     upload_picture($model->path,'image');
                // }
            $sucess=$model->update_row_n($article['id'],$data['update_data']);
            if(!$sucess) throw new Exception("Error while updating.", 1);                

            $this->response(array('sucess'=>true,'data'=>$article['name']." updated sucessfully"), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }

    function status_post()
    {
        try {

            $model=$this->load->model('article/article_m');

            if(!$this->post('status')) throw new Exception("Status parameter not found", 1);
            if(!$this->post('slug')) throw new Exception("Slug parameter not found", 1);

            $status=$this->post('status');
            $slug=$this->post('slug');
            $get_response=$this->_get($slug);

            if(!$get_response['success']) throw new Exception($get_response['data'], 1);
            $article=$get_response['data'];

            $update_response=$this->_change_status($status,$article['id'],$article['name']);

            if(!$update_response['success']) throw new Exception($update_response['data'], 1);

            $this->response(array('sucess'=>true,'data'=>$article['name']." ". $update_response['data']." sucessfully"), 200);        

        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'error'=>$e->getMessage()), 404);
        }
    }    

    function _change_status($status=null,$id=null,$name=null)
    {
        $response['success']=false;
        $response['data']='No Status/Id found';

        if(!$status)
            $response['data']='No Status found';
        if(!$id) 
            $response['data']='No Id found';

        $model=$this->load->model('article/article_m');

        $data['update_data']=array(
            'status'=>article_m::PUBLISHED,
            'updated_at'=>date('d-m-Y H:i:s'),
            );

        $sucess=$model->update_row_n($id,$data['update_data']);

        $status_ui=article_m::status($status);

        if(!$sucess) 
            $response['data']='Error while changing status to '.$status_ui;

        $response['success']=false;
        $response['data']=$name.' sucessfully '.$status_ui;

        return $response;
    }

    function _get($slug=FALSE){
        $response['success']=false;
        $response['data']='No Slug found';
        if(!$slug) 
            return $response;
        $param['slug']=$slug;
        $article=$this->load->model('article/article_m')->read_row_by_n($param);
        if($article) {
            $response['success']=true;
            $response['data']=$article;
        }
        else{
            $response['data']='Article not found';
        }
        return $response;
    }

}