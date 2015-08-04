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

    function add_post()
    {
        try {
           
            $model=$this->load->model('article/article_m');
            $params = json_decode(file_get_contents('php://input'),true);
            
            // $this->response(array('success'=>true,'data'=>$params['name']), 200);                          

            $data['insert_data']=array(
                'name'=>$params['name']?:null,
                'slug'=>$params['name']?get_slug($params['name']):null,
                'content'=>$params['content']?:null,
                'status'=>$model::PUBLISHED,
                );

            $model->create_row($data['insert_data']);
            $article=$model->read_row_by_slug($data['insert_data']['slug']);
            if($article)
                $this->response(array('success'=>true,'data'=>$article), 200);             
            else
                $this->response(array('success'=>false,'error'=>'Could not add article'), 200);

        } catch (Exception $e) {
            $this->response(array('success'=>false,'error'=>$e->getMessage()), 200);             
        }
    }



}