<?php defined('BASEPATH') OR exit('No direct script access allowed');


class group extends DB_REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
    }

    function index_get()
    {        
        try {
            if($this->get('id')){
                $id=$this->get('id');
                $get_response=$this->_get($id);
                if(!$get_response['success']) throw new Exception($get_response['data'], 1);
                $group=$get_response['data'];
                if(!$group) throw new Exception("No group found", 1);
                $data=$group;
            }else{
                $param['id >']=0;
                $groups=$this->load->model('group/group_m')->read_rows_by($param);
                $data=$groups?:null;
            } 
            $this->response(array('sucess'=>true,'data'=>$data), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }

    function add_post()
    {
        try {
            $model=$this->load->model('group/group_m');

            $data=array(
                'name'=>$this->post('name'),
                'desc'=>$this->post('desc'),
                'slug'=>$this->post('name'),
                // 'slug'=>get_slug($this->input->post('name')),
                'status'=>group_m::ACTIVE,
                );
            $sucess=$model->create_row_n($data);
            if(!$sucess) throw new Exception("Error while adding.", 1);                
            $this->response(array('sucess'=>true,'data'=>$data['name']." added sucessfully"), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }

    }

    function edit_put()
    {
        try {
            $model=$this->load->model('group/group_m');

            $id=$this->put('id');
            $get_response=$this->_get($id);
            if(!$get_response['success']) throw new Exception($get_response['data'], 1);
            $group=$get_response['data'];
            
            if(!$group) throw new Exception("No group found", 1);
            $data=array(
                'name'=>$this->put('name'),
                'desc'=>$this->put('desc'),
                'status'=>$this->put('status'),
                );
            $sucess=$model->update_row_n($group['id'],$data);
            if(!$sucess) throw new Exception("Error while updating.", 1);                
            $this->response(array('sucess'=>true,'data'=>$group['name']." updated sucessfully"), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }


    function rem_delete()
    {
        try {
            $model=$this->load->model('group/group_m');

            $id=$this->get('id');
            $get_response=$this->_get($id);
            if(!$get_response['success']) throw new Exception($get_response['data'], 1);
            $group=$get_response['data'];
            
            if(!$group) throw new Exception("No group found", 1);
            $data=array(
                'status'=>group_m::DELETED,
                );
            $sucess=$model->update_row_n($group['id'],$data);
            if(!$sucess) throw new Exception("Error while updating.", 1);                
            $this->response(array('sucess'=>true,'data'=>$group['name']." deleted sucessfully"), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }

    function _get($id=FALSE){
        $response['success']=false;
        $response['data']='No id found';
        if(!$id) 
            return $response;
        $param['id']=$id;
        $group=$this->load->model('group/group_m')->read_row_by_n($param);
        if($group) {
            $response['success']=true;
            $response['data']=$group;
        }
        else{
            $response['data']='group not found';
        }
        return $response;
    }


    function _get_old($slug=FALSE){
        $response['success']=false;
        $response['data']='No Slug found';
        if(!$slug) 
            return $response;
        $param['slug']=$slug;
        $group=$this->load->model('group/group_m')->read_row_by_n($param);
        if($group) {
            $response['success']=true;
            $response['data']=$group;
        }
        else{
            $response['data']='group not found';
        }
        return $response;
    }

}