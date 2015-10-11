<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App
{
    public function __construct()
    {
        require_once APPPATH.'third_party/Mailer.php';
    }
}