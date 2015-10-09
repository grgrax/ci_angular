<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
class DB_REST_Controller extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $config=array(
            'hostname' =>'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'db_ci_ang',
            'dbdriver' => 'mysql'
            );
        $this->db = $this->load->database($config, TRUE);
    }

}