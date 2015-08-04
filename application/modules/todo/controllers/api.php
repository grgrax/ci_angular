<?php defined('BASEPATH') OR exit('No direct script access allowed');


class api extends DB_REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $model=$this->load->model('article/article_m');
        $articles=$model->read_all(100,0);
        if(!$articles) $this->response(array('nodata' => 'No articles'), 404);
        // $r = new ReflectionClass($model);
        echo json_encode($articles);
        // $this->response(array('data'=>$articles), 200);             
    }

    function add_post($article)
    {
        show_pre($article);
        echo json_encode($article);
        $model=$this->load->model('article/article_m');
        if($article){
            $data['insert_data']=array(
                'name'=>$article.name,
                'slug'=>$article.name,
                'content'=>$article.content,
                'status'=>1,
                );
            // $path=get_relative_upload_file_path();
            // $path.=$model::file_path;
            // if($_FILES['image']['name']){
            //     upload_picture($model->path,'image');
            // }
            $model->create_row($data['insert_data']);
            $article=$model->read_row_by_slug($this->post('slug'));
            // $this->response(array('data'=>$article), 200);             
            echo json_encode($article);
        } 
        // else{
        //     $article=$this->load->model('article/article_m')->read_row_by_slug($this->post('slug'));
        //     if($article){
        //         $this->template_data['update_data']=array(
        //             'image_title'=>$this->post('image_title'),
        //             );
        //         $path=get_relative_upload_file_path();
        //         $this->load->model('article/article_m')->update_row($article['id'],$this->template_data['update_data']);
        //         $article=$this->load->model('article/article_m')->read_row_by_slug($this->post('slug'));
        //         $this->response(array('data'=>$article), 200); 
        //     }
        //     else{
        //         $this->response(array('error' => 'article could not be found','slug'=>$this->post('slug')), 404);
        //     }  
        // }
    }



}