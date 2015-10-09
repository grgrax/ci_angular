<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Make sure to load the Facebook SDK for PHP via composer or manually

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
// add other classes you plan to use, e.g.:
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;


class fb extends Frontend_Controller {

	public $data;
	const MODULE='test/';

	function __construct()
	{
		parent::__construct();
		// parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
		// $this->load->library(array('form_validation','session','breadcrumb','facebook'));
		// $this->load->library('facebook');
		$this->load->library(array('form_validation','breadcrumb','session'));
		$this->data['link']=base_url().self::MODULE;
	}
	function index(){
		echo "fb";
	}
	//fb
	public function fb_login()
	{
		$user = $this->facebook->getUser();
		echo $user;

		$this->data['user']=null;
		if(!$user){
			$this->data['url'] = $this->facebook->getLoginUrl(array(
				'redirect_uri' => 'http://localhost/cel/2015/may/projects/donatenow/test/fb_profile', 
				'scope' => array("email") 
				));
		} else {
			$this->data['user'] = $this->facebook->api('/me');
			show_pre($this->data['user']);
			die;
			$this->data['url'] = 'test/fb_profile';
			show_pre($this);
		}
		redirect($this->data['url']);
	}

	public function fb_profile(){

		Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
		Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;

		// echo $accessToken = $this->facebook->getAccessToken();
		// $this->facebook->setAccessToken($accessToken);
		$user = $this->facebook->getUser();
		if($user){
			echo "fb user logged in";
		}
		$this->data['user'] = $this->facebook->api('/me');
		$this->data['subview']=self::MODULE.'profile';
		$this->load->view('front/main_layout',$this->data);
		// $this->session->session_destroy();
	}
	public function p(){
		if($session) {
			try {
				$user_profile = (new FacebookRequest(
					$session, 'GET', '/me'
					))->execute()->getGraphObject(GraphUser::className());
				echo "Name: " . $user_profile->getName();
			} catch(FacebookRequestException $e) {
				echo "Exception occured, code: " . $e->getCode();
				echo " with message: " . $e->getMessage();
			}   
		}	}

		public function fb_logout()
		{
			die("log out");
			$this->load->library('facebook');
        // Logs off session from website
			$this->facebook->destroySession();
        // Make sure you destory website session as well.
			redirect('welcome/login');

		}


		public function signup(){
			$this->data['subview']=self::MODULE.'sign_up';
			$this->load->view('front/main_layout',$this->data);
		}

		public function user(){
			$user = $this->facebook->getUser();
			if(!$user){
            // Generate a login url
				$data['login_url'] = $this->facebook->getLoginUrl(array(
        		// 'redirect_uri' => site_url('test/logout'), 
					'redirect_uri' => 'http://ivmfilms.com', 
                'scope' => array("email") // permissions here
                ));
				redirect($data['login_url']);
			} else {
            // Get user's data and print it
				$user = $this->facebook->api('/me');
				$this->data['user'] = $user;
				$this->data['subview']=self::MODULE.'sign_up';
				$this->load->view('front/main_layout',$this->data);
				show_pre($user);
			}
		}

		public function fb_lib(){
		$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

		$user = $this->facebook->getUser();
 // If user is not yet authenticated, the id will be zero
		if($user == 0){
            // Generate a login url
			$data['login_url'] = $this->facebook->getLoginUrl(array(
        		// 'redirect_uri' => site_url('test/logout'), 
				'redirect_uri' => 'http://ivmfilms.com', 
                'scope' => array("email") // permissions here
                ));
			redirect($data['login_url']);
		} else {
            // Get user's data and print it
			$user = $this->facebook->api('/me');
			$this->data['subview']=self::MODULE.'index';
			$this->load->view('front/main_layout',$this->data);		
			
			print_r($user);
		}
		die;

		if ($user) {
			try {
				$data['user_profile'] = $this->facebook->api('/me');
			} catch (FacebookApiException $e) {
				$user = null;
			}
		}else {
			$this->facebook->destroySession();
		}

		if ($user) {

            // $data['logout_url'] = site_url('http://localhost/crowd/test/login'); // Logs off application
            // OR 
            // Logs off FB!
			$data['logout_url'] = $this->facebook->getLogoutUrl();

		} else {
			$data['login_url'] = $this->facebook->getLoginUrl(array(
        		// 'redirect_uri' => site_url('http://localhost/crowd/test/logout'), 
                'scope' => array("email") // permissions here
                ));
			redirect($data['login_url']);
		}
		show_pre($data);
	}

	public function fb()
	{
		FacebookSession::setDefaultApplication('415752498606532', '056f3da72d450f80fe1b24f8e0b4efed');
		$helper = new FacebookRedirectLoginHelper('http://localhost/crowd/test');
		$loginUrl = $helper->getLoginUrl();
		try {
			// $session = $helper->getSessionFromRedirect();
			// $session = new FacebookSession('AQAKwHUV_D0JrhFJ79TxvDTTnjUeJa5WZ2sBsbAhz2MsbPvfOVxj1PReyTlhFt5kBUSmOQtxOIReSVJc3cPo2n_5Ao8u0w9LAQbeyiEkVZ5');
			$session = new FacebookSession('AQAKwHUV_D0JrhFJ79TxvDTTnjUeJa5WZ2sBsbAhz2MsbPvfOVxj1PReyTlhFt5kBUSmOQtxOIReSVJc3cPo2n_5Ao8u0w9LAQbeyiEkVZ5');
		} catch(FacebookRequestException $ex) {
			die($ex);
		// When Facebook returns an error
		} catch(\Exception $ex) {
			die($ex);
		// When validation fails or other local issues
		}
		if ($session) {
			show_pre($session);
			$request = new FacebookRequest($session, 'GET', '/me');
			$response = $request->execute();
			$graphObject = $response->getGraphObject();
			show_pre($request);
			show_pre($response);
			show_pre($graphObject);
			die("yes");
		// Logged in
		}else
		die("no");
		// Use the login url on a link or button to 
		// redirect to Facebook for authentication
	}

	function sess_destroy(){
		$this->session->sess_destroy();
	}

	function new_fb(){
// init app with app id (APPID) and secret (SECRET)
		// FacebookSession::setDefaultApplication('APPID','SECRET');
		// FacebookSession::setDefaultApplication('415752498606532', '056f3da72d450f80fe1b24f8e0b4efed');
		FacebookSession::setDefaultApplication($this->config->item('APPID'), $this->config->item('SECRET'));

// login helper with redirect_uri
		$helper = new FacebookRedirectLoginHelper( 'http://localhost/cel/2015/may/projects/donatenow/test/new_fb' );
		// $helper = new FacebookRedirectLoginHelper( 'http://localhost/phpmyadmin' );

		try {
			$session = $helper->getSessionFromRedirect();
		} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
		} catch( Exception $ex ) {
  // When validation fails or other local issues
		}

// see if we have a session
		if ( isset( $session ) ) {
  // graph api request for user data
			$request = new FacebookRequest( $session, 'GET', '/me' );
			$response = $request->execute();
  // get response
			$fb_user = $response->getGraphObject()->asArray();

  // print data
			$this->session->set_userdata('fb_user',$fb_user);
			show_pre(get_session('fb_user'));
			//get photos
			$user_photos = (new FacebookRequest(
				$session, 'GET', '/me/photos'
				))->execute()->getGraphObject();
			$user_photos = $user_photos->asArray();
			echo count($user_photos);
			print_r($user_photos);
			//$pic = $user_photos["data"][0]->{"source"};
          	// echo "<img src='$pic' />";die;
			die;
			redirect('test/new_fb_profile');
		} else {
  // show login url
			echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
		}
	}

	function new_fb_profile(){
		if($fb_user=get_session('fb_user')){
			show_pre($fb_user);
		}
		else{
			echo "redirect to new_fb";
			// redirect('test/new_fb');
		}
	}
}


/* End of file sample.php */
/* Location: ./application/modules/sample/controllers/sample.php */




