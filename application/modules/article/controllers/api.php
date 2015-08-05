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

    function edit_post()
    {
        try {

            $article=$model->read_row_by_slug($params['name']);
            
            if(!$article){
                throw new Exception("No article found", 1);
            }

            $model=$this->load->model('article/article_m');

            $params = json_decode(file_get_contents('php://input'),true);
            
            $this->response(array('success'=>true,'data'=>$article), 200);                          

            $data['update_data']=array(
                'name'=>$params['name']?:null,
                'slug'=>$params['name']?get_slug($params['name']):null,
                'content'=>$params['content']?:null,
                'status'=>$model::PUBLISHED,
                );

            $updated=$model->update_row($data['update_data'],$article['id']);

            if($updated)
                $this->response(array('success'=>true,'data'=>$params['name']." (Article) successfully updated"), 200);             
            else
                $this->response(array('success'=>false,'error'=>'Could not update article'), 200);

        } catch (Exception $e) {
            $this->response(array('success'=>false,'error'=>"Could not edit article, {$e->getMessage()}"), 200);             
        }
    }

    function remove_post()
    {
        try {

            $params = json_decode(file_get_contents('php://input'),true);

            $model=$this->load->model('article/article_m');

            $article=$model->read_row_by_slug($params['slug']);
            
            if(!$article)
                throw new Exception("No article found", 1);

            $data['update_data']=array(
                'status'=>$model::DELETED,
                );

            $updated=$model->update_row($article['id'],$data['update_data']);

            if($updated)
                $this->response(array('success'=>true,'data'=>$params['name']." (Article) successfully removed"), 200);             
            else
                $this->response(array('success'=>false,'error'=>'Could not update article'), 200);

        } catch (Exception $e) {
            $this->response(array('success'=>false,'error'=>"Could not remove article, {$e->getMessage()}"), 200);             
        }
    }

    function publish_post()
    {
        try {

            $params = json_decode(file_get_contents('php://input'),true);

            $model=$this->load->model('article/article_m');

            $article=$model->read_row_by_slug($params['slug']);
            
            if(!$article)
                throw new Exception("No article found", 1);

            $data['update_data']=array(
                'status'=>$model::PUBLISHED,
                );

            $updated=$model->update_row($article['id'],$data['update_data']);

            if($updated)
                $this->response(array('success'=>true,'data'=>$params['name']." (Article) successfully removed"), 200);             
            else
                $this->response(array('success'=>false,'error'=>'Could not update article'), 200);

        } catch (Exception $e) {
            $this->response(array('success'=>false,'error'=>"Could not remove article, {$e->getMessage()}"), 200);             
        }
    }


}