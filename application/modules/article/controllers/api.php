<?php defined('BASEPATH') OR exit('No direct script access allowed');


class api extends DB_REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index_get_()
    {        
        if(!$this->get('slug')) $this->response(array('invalid paramerter'), 400);
        $article=$this->load->model('article/article_m')->read_row_by_slug($this->get('slug'));
        if(!$article) $this->response(array('error'=>'article could not be found'), 404);
        $this->response(array('data'=>$article), 200); 
    }

    public function index_get()
    {
        $model=$this->load->model('article/article_m');
        $articles=$model->read_all(100,0);
        if(!$articles) $this->response(array('nodata' => 'No articles'), 404);
        $r = new ReflectionClass($model);
        $response=array(
            'data'=>$articles,
            'model'=>array(
                'status'=>$model::status(),
                'actions'=>$model::actions(),
                'constant'=>$model::getConstants(),
                'rules'=>$model->get_rules(),
                )
            );
        $this->response($response, 200); 
    }

    public function refresh_get()
    {
        $model=$this->load->model('article/article_m');
        $articles=$model->read_all(100,0);
        if(!$articles) $this->response(array('nodata' => 'No articles'), 404);
        $r = new ReflectionClass($model);
        $response=array(
            'data'=>$articles,
            'model'=>array(
                'status'=>$model::status(),
                'actions'=>$model::actions(),
                'constant'=>$model::getConstants(),
                'rules'=>$model->get_rules(),
                )
            );
        $this->response($response, 200); 
    }

    function article_post()
    {
        $model=$this->load->model('article/article_m');
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
            $article=$model->read_row_by_slug($this->post('slug'));
            $this->response(array('data'=>$article), 200);             
        } 
        else{
            $article=$this->load->model('article/article_m')->read_row_by_slug($this->post('slug'));
            if($article){
                $this->template_data['update_data']=array(
                    'image_title'=>$this->post('image_title'),
                    );
                $path=get_relative_upload_file_path();
                $this->load->model('article/article_m')->update_row($article['id'],$this->template_data['update_data']);
                $article=$this->load->model('article/article_m')->read_row_by_slug($this->post('slug'));
                $this->response(array('data'=>$article), 200); 
            }
            else{
                $this->response(array('error' => 'article could not be found','slug'=>$this->post('slug')), 404);
            }  
        }
    }



}