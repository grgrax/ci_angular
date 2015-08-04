<?php defined('BASEPATH') OR exit('No direct script access allowed');


class pri extends DB_REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    // user
    public function user_get()
    {        
        if(!$this->get('username')) $this->response(array('invalid paramerter'), 400);
        $user=$this->load->model('user/user_m')->read_row_by_username($this->get('username'));
        if(!$user) $this->response(array('error'=>'user could not be found'), 404);
        $this->response(array('data'=>$user), 200); 
    }

    public function users_get()
    {
        $users=$this->load->model('user/user_m')->read_all_active();
        if(!$users) $this->response(array('nodata' => 'No Users'), 404);
        $this->response(array('data'=>$users), 200); 
    }
    
    function _user_post()
    {
        if(!$this->post('username')) $this->response(array('user could not be found.'), 400);
        $user=$this->load->model('user/user_m')->read_row_by_username($this->post('username'));
        if($user){
            $this->template_data['update_data']=array(
                'email'=>$this->post('email'),
                );
            $this->load->model('user/user_m')->update_row($user['id'],$this->template_data['update_data']);
            $user=$this->load->model('user/user_m')->read_row_by_username($this->post('username'));
            $this->response(array('status'=>'success','user'=>$user), 200); 
        }
        else
            $this->response(array('error' => 'user could not be found'), 404);
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
            $this->response(array('status'=>'success','data'=>$user), 200); 
        }
        else
            $this->response(array('error' => 'user could not be found'), 404);
    }
    // user
}