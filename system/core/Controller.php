<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
}


class CI_Con_rax extends CI_controller
{
	static $model=""; 
	public function index($start=0)
		{
			//echo 
			//static::$title;
			echo static::$model=static::$title;
			$data[static::$model]=$this->blog->read_all(3,$start);	
			//for pagination
			$this->load->library('pagination');
			$config['base_url']=base_url().static::$model."/index";
			$config['total_rows']=static::$model->count_all();
			$config['per_page']=3;
			
			$this->pagination->initialize($config);
			$data['pages']=$this->pagination->create_links();
			//print_r($config);
			$this->load->view('blogs',$data);
		}

}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */