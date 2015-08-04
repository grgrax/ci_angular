<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class ping extends REST_Controller
{
    public function index_get()
    {
        $this->response(
            array('status' => 'SUCCESS', 
                'responseCode' => '0000', 
                'responseMessage' => 'It Works !!!'
                ), 200);
    }

    public function private_get()
    {
        $this->response(
            array('status' => 'SUCCESS', 
                'responseCode' => '0000', 
                'responseMessage' => 'private Works !!!'
                ), 200);
    }

    public function public_get()
    {
        $this->response(
            array('status' => 'SUCCESS', 
                'responseCode' => '0000', 
                'responseMessage' => 'public Works !!!'
                ), 200);
    }
    
}