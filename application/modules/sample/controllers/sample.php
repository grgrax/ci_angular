<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sample extends Frontend_Controller {

	private $data;
	const MODULE='sample/';

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','session','breadcrumb'));
		$this->data['link']=base_url().self::MODULE;
	}

	public function ok(){
		echo "inside ok of sample";
		$this->data['subview']=self::MODULE.'list';
		$this->load->view('admin/main_layout',$this->data);
	}
	public function index()
	{

		/*//method 1 CORRECT:
		$ctlObj = modules::load('module01/controller01/');
		$ctlObj->method00();
		//or you could use chaining:
		modules::load('module01/controller01/')->method00();
		*/
		$testimonial = modules::load('testimonial');
		$testimonial->index();
		//or you could use chaining:
		modules::load('testimonial/testimonial/')->add();

		
		/*//method 2 CORRECT:
		$this->load->module('module01/controller01');
		$this->controller01->method00();
		*/
		$this->load->module('testimonial/testimonial');
		$this->testimonial->hello(" testimonial= this->load->module(testimonial) <br/> testimonial->hello() ........ i.e chaining");

		


        /*//method 3 CORRECT:
		modules::run('module01/controller01/logic_method00');   //no trailing slash!
		*/
		modules::run('testimonial/logicgar');   //no trailing slash!



		/** module and controller names are different, you must include the method name also, including 'index' **/
		// modules::run('module/controller/method', $params, $...);

		/** module and controller names are the same but the method is not 'index' **/
		// modules::run('module/method', $params, $...);

		/** module and controller names are the same and the method is 'index' **/
		// echo modules::run('testimonial/add');

		/** Parameters are optional, You may pass any number of parameters. **/
		//Modules::load('testimonial');

	}

}

/* End of file sample.php */
/* Location: ./application/modules/sample/controllers/sample.php */