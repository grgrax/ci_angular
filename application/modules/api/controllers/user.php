<?php defined('BASEPATH') OR exit('No direct script access allowed');


class user extends DB_REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
    }

    function index_get()
    {        
        try {
            if($this->get('username')){
                $username=$this->get('username');
                $get_response=$this->_get($username);
                if(!$get_response['success']) throw new Exception($get_response['data'], 1);
                $user=$get_response['data'];
                if(!$user) throw new Exception("No user found", 1);
                $data=$user;
            }else{
                $param['id >']=0;
                $users=$this->load->model('user/user_m')->read_rows_by($param);
                $data=$users?:null;
            } 
            $this->response(array('sucess'=>true,'data'=>$data), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }

    function add_post()
    {
        try {
            $model=$this->load->model('user/user_m');

            $data=array(
                'username'=>$this->input->post('username'),
                'group_id'=>$this->input->post('group'),
                'status'=>user_m::ACTIVE,
                );
            $sucess=$model->create_row_n($data);
            if(!$sucess) throw new Exception("Error while adding.", 1);                
            $this->response(array('sucess'=>true,'data'=>$data['username']." added sucessfully"), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }

    }

    function edit_post()
    {
        try {
            $model=$this->load->model('user/user_m');

            $username=$this->post('username');
            $get_response=$this->_get($username);
            if(!$get_response['success']) throw new Exception($get_response['data'], 1);
            $user=$get_response['data'];
            
            if(!$user) throw new Exception("No user found", 1);
            $data=array(
                'username'=>$this->input->post('username_new'),
                'group_id'=>$this->input->post('group'),
                'status'=>$this->input->post('status'),
                );
            $sucess=$model->update_row_n($user['id'],$data);
            if(!$sucess) throw new Exception("Error while updating.", 1);                
            $this->response(array('sucess'=>true,'data'=>$data['username']." updated sucessfully"), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }


    function delete_post()
    {
        try {
            $model=$this->load->model('user/user_m');

            $username=$this->post('username');
            $get_response=$this->_get($username);
            if(!$get_response['success']) throw new Exception($get_response['data'], 1);
            $user=$get_response['data'];
            
            if(!$user) throw new Exception("No user found", 1);
            $data=array(
                'status'=>user_m::DELETED,
                );
            $sucess=$model->update_row_n($user['id'],$data);
            if(!$sucess) throw new Exception("Error while updating.", 1);                
            $this->response(array('sucess'=>true,'data'=>$user['name']." deleted sucessfully"), 200);        
        } catch (Exception $e) {
            $this->response(array('sucess'=>false,'data'=>$e->getMessage()), 404);
        }
    }


    function _get($username=FALSE){
        $response['success']=false;
        $response['data']='No username found';
        if(!$username) 
            return $response;
        $param['username']=$username;
        $user=$this->load->model('user/user_m')->read_row_by_n($param);
        if($user) {
            $response['success']=true;
            $response['data']=$user;
        }
        else{
            $response['data']='user not found';
        }
        return $response;
    }

}