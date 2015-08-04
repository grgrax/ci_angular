<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class api_client extends Admin_Controller {

	private $api_url;
	const MODULE="api_client/";

	function __construct(){
		parent::__construct();
		$this->api_url=get_setting('api_url');
	}

	function index(){
		try {
			$user=$this->native_curl_get('ramesh');
			if(!$user) throw new Exception("Couldnt reach API", 1);
			if($this->input->post())
			{
				$rules=array(
					'field'=>'email',
					'label'=>'Email Address',
					'rules'=>'trim|required|valid_email|unique[tbl_users.email]|xss_clean'
					);
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run($this)===TRUE)
				{
					die("ok post");
				}
				else
					die("erorr");
			}
			$this->template_data['user']=$user;
			$this->template_data['subview']=self::MODULE.'list';
			$this->load->view('admin/main_layout',$this->template_data);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	function test(){

		// $this->load->spark('example-spark/1.0.0');    
		// Load the rest client spark
		// $this->load->spark('restclient/2.1.0');
		// Load the library
		// $this->load->library('rest');
		// Run some setup
		// $this->rest->initialize(array('server' => 'http://twitter.com/'));



		// method 1 - json and public api
		// $user = json_decode(file_get_contents("$this->api_url/user/username/ramesh"),true);
		// show_pre($user);

		// method 2 - json and private api
		// $url=explode('http://',$this->api_url);
		// echo $digest_url="http://admin:1234@".$url[1]."/users";
		// $users=json_encode(file_get_contents($digest_url));
		// show_pre($users);

		// method 3- update with native curl
		// $this->native_curl('ramesh@gmail.come');
		$user=$this->native_curl_get('ramesh');

		// method 4- update with curl library
		// $this->ci_curl('ramesh@gmail.comcurl'); 

		// method 5- update with ci curl based rest library
		// $this->rest_client_example('ramesh');

		// $this->template_data['user']=$user;
		// $this->template_data['subview']=self::MODULE.'list';
		// $this->load->view('admin/main_layout',$this->template_data);

		$this->template_data['user']=$user;
		$this->template_data['subview']=self::MODULE.'list';
		$this->load->view('admin/main_layout',$this->template_data);

	}

	function native_curl_get($db_username)
	{
		$username = 'admin';
		$password = '1234';
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, "$this->api_url/user/username/$db_username");
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		$result = json_decode($buffer,true);
		if(isset($result['username']) && $result['username'] == $db_username){
			return $result;
		}
		else{
			return null;
		}
	}


	function native_curl($new_email)
	{
		$username = 'admin';
		$password = '1234';

		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, "$this->api_url/user/");
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
			'username' =>'ramesh',
			'email' => $new_email,
			));
      // Optional, delete this line if your API is open
		// curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		$result = json_decode($buffer);
		if(isset($result->status) && $result->status == 'success')
			echo 'User has been updated.';
		else
			echo 'Something has gone wrong';
	}

	function ci_curl($new_email)
	{
		$username = 'admin';
		$password = '1234';

		$this->load->library('curl');
		$this->curl->create("$this->api_url/user/username/ramesh/");

    // Optional, delete this line if your API is open
		$this->curl->http_login($username, $password);

		$this->curl->post(array(
			'username' =>  'ramesh' ,
			'email' => $new_email
			));

		$result = json_decode($this->curl->execute());

		if(isset($result->status) && $result->status == 'success')
			echo 'User has been updated.';
		else
			echo 'Something has gone wrong';
	}

	function rest_client_example($id)
	{
		$this->load->library('rest', array(
			'server' => "$this->api_url/",
			'http_user' => 'admin',
			'http_pass' => '1234',
   //      'http_auth' => 'basic' // or 'digest'
			));		
		$user = $this->rest->get('user', array('username' => $id), 'json');
		echo $user->name;
	}

}

