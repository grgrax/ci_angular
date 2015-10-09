<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Make sure to load the Facebook SDK for PHP via composer or manually

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
// add other classes you plan to use, e.g.:
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;


class test extends Frontend_Controller {

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

	public function index()
	{
		$this->load->model('user/user_m');
		$users=$this->user_m->read_rows_by(array('group_id'=>3,'status'=>1));
		show_pre($users);
		echo 'null: ';
		$c=get_cms_config();
		echo $c?$c:'no';
		echo '<hr/>not null, not set: ';
		$c=get_cms_config('enabe_jq_validations');
		echo $c?$c:'no';
		echo '<hr/>set: ';
		$c=get_cms_config('enabe_jq_validation');
		echo $c?$c:'no';
		echo '<hr/>fb_key: ';
		$c=get_cms_config('fb_key');
		echo $c?$c:'no';
		die;
	}


	//mails	
	public function mail() {
		try {
			$from['from_name'] = 'Our Library';
			$from['from_email'] =  'basant@gmail.com';
			$to['to_name'] = 'ramesh';
			$to['to_email'] = 'raxizel@gmail.com';					
			$subject = "Our library Account Confirmation";
			$message= "We're ready to activate your account. All we need to do is make sure this is your email address.";	
			$message.="<br/>";
			$key=md5(date('Y-m-d H:m:s'));
			$user_id=$this->session->userdata('lastuser_id');
			$user_id=61;
			if(!$user_id) 
				throw new Exception("no lastuser_id", 1);				
			$url=base_url("test/activate/$key/$user_id");
			$style="border-radius:3px;background:#3aa54c;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 24px;padding:10px 18px;text-decoration:none;width:180px;text-align:center";
		// $message.=anchor($url, 'Click here to confirm', $style);
			$message.=anchor($url, 'Click here to confirm', '');
			$res = App\Mailer::sendMail($from, $to, $subject, $message);	
			show_pre($res);
			if($res==1){
				echo "insert into db";
			}
			else
				echo "fail";
			
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
			echo $e->getMessage();			
		}
	}
	public function php_mail(){
		try {
			$msg = "First line of text\nSecond line of text";
			$msg = wordwrap($msg,70);
			mail("raxizel@gmail.com","My subject",$msg);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function ci_mail() {
		try {

			$configs = array(
				'protocol'=>'smtp',
				'smtp_host'=>'smtp.gmail.com',
				'smtp_port'=>465,
				'smtp_user'=>'celosiadesigns4u@gmail.com',
				'smtp_pass'=>"setedeep",
				'smtp_crypto' => 'ssl',
				);
			$this->load->library("email", $configs);
			$this->email->set_newline("\r\n");
			$this->email->to("raxizel@gmail.com");
			$this->email->from("celosiadesigns4u@gmail.com", "rajat singh");
			$this->email->subject("This is bloody amazing.");
			$this->email->message("Body of the Message");
			if($this->email->send())
			{
				echo "Done!";   
			}
			else
			{
				echo $this->email->print_debugger();    
			}
			die;

			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => $this->config->item('smtp_host'),
				'smtp_port' => $this->config->item('smtp_port'),
				'smtp_user' => $this->config->item('smtp_user'), 
				'smtp_pass' => $this->config->item('smtp_pass'), 
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
				);
			show_pre($config);
			$this->load->library('email', $config);
			$this->email->from('celosiadesigns4u@gmail.com','Our Library'); 
			$this->email->to('raxizel@gmail.com');
			$this->email->subject('Our library Account Confirmation');
			$message = '';
			$message= "We're ready to activate your account. All we need to do is make sure this is your email address.";	
			$message.="<br/>";
			$key=md5(date('Y-m-d H:m:s'));
			// $user_id=$this->session->userdata('lastuser_id');
			$user_id=61;
			if(!$user_id) 
				throw new Exception("no lastuser_id", 1);				
			$url=base_url("test/activate/$key/$user_id");
			$message.=anchor($url, 'Click here to confirm', '');			
			$this->email->message($message);
			if($this->email->send())
			{
				echo 'Email sent.';
			}
			else
			{
				show_error($this->email->print_debugger());
			}
			die;
			$from['from_name'] = 'Our Library';
			$from['from_email'] =  'basant@gmail.com';
			$to['to_name'] = 'ramesh';
			$to['to_email'] = 'raxizel@gmail.com';					
			$subject = "Our library Account Confirmation";
			$message= "We're ready to activate your account. All we need to do is make sure this is your email address.";	
			$message.="<br/>";
			$key=md5(date('Y-m-d H:m:s'));
			$user_id=$this->session->userdata('lastuser_id');
			$user_id=61;
			if(!$user_id) 
				throw new Exception("no lastuser_id", 1);				
			$url=base_url("test/activate/$key/$user_id");
			$style="border-radius:3px;background:#3aa54c;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 24px;padding:10px 18px;text-decoration:none;width:180px;text-align:center";
		// $message.=anchor($url, 'Click here to confirm', $style);
			$message.=anchor($url, 'Click here to confirm', '');
			$res = App\Mailer::sendMail($from, $to, $subject, $message);	
			show_pre($res);
			if($res==1){
				//insert into db
			}

		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
			echo $e->getMessage();			
		}
	}
	public function ci_mail_lib() {
		try {
			$configs = array(
				'protocol'=>'mail',
				'smtp_host'=>'mail.ourlibrary.com.au',
				'smtp_port'=>465,
				'smtp_user'=>'info@ourlibrary.com.au',
				'smtp_pass'=>"ourlib@123",
				'smtp_crypto' => 'ssl',
				);
			$this->load->library("email", $configs);
			$this->email->set_newline("\r\n");
			$this->email->to("raxizel@gmail.com");
			$this->email->from("info@ourlibrary.com.au", "Our Library");
			$this->email->subject("This is bloody amazing.");
			$this->email->message("Body of the Message");
			if($this->email->send())
			{
				echo "Done!";   
			}
			else
			{
				echo $this->email->print_debugger();    
			}
			die;
		} catch (Exception $e) {
			$this->session->set_flashdata('error', $e->getMessage());
			echo $e->getMessage();			
		}
	}

	function php_mail_html(){
		$to = "raxizel@gmail.com, rameshgurung2008@gamil.com";
		$subject = "HTML email";
		$message = "
		<html>
		<head>
			<title>HTML email</title>
		</head>
		<body>
			<p>This email contains HTML Tags!</p>
			<table>
				<tr>
					<th>Firstname</th>
					<th>Lastname</th>
				</tr>
				<tr>
					<td>John</td>
					<td>Doe</td>
				</tr>
			</table>
		</body>
		</html>
		";
// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
		$headers .= 'From: <webmaster@ourlibrary.com>' . "\r\n";
				// $headers .= 'Cc: rameshgurung2008@gmail.com' . "\r\n";
		echo mail($to,$subject,$message,$headers)?'send':'fail';

	}

	public function swift_mailer(){
		try {
		//send verfication code to his/her email
			$from['from_name'] = 'Our Library';
			$from['from_email'] =  'rameshgurung2008@gmail.com';
			$to['to_name'] = 'ramesh';
			$to['to_email'] = 'raxizel@gmail.com';					
			$subject = "Our library Account Confirmation";
			$message= "We're ready to activate your account. All we need to do is make sure this is your email address.";	
			$message.="<br/>";
			$key=md5(date('Y-m-d H:m:s'));
			$url=base_url("test/activate/$key");
			$style="border-radius:3px;background:#3aa54c;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 24px;padding:10px 18px;text-decoration:none;width:180px;text-align:center";
					// $message.=anchor($url, 'Click here to confirm', $style);
			$message.=anchor($url, 'Click here to confirm', '');
			$res = App\Mailer::sendMail($from, $to, $subject, $message);	
			show_pre($res);
			if($res==1){
			}
			
		} catch (Exception $e) {
			die($e->getMessage());			
		}
	}
	//mails

	//fb
	
	function sess_destroy(){
		$this->session->sess_destroy();
	}

	function ok(){
		$this->load->view('ok');		
	}

	public function manage()
	{
		$this->data['subview']=self::MODULE.'manage';
		$this->load->view('front/main_layout',$this->data);		
	}

	public function ajaxupload()
	{
		$this->data['subview']=self::MODULE.'ajax_upload';
		$this->load->view('front/main_layout',$this->data);		
	}

	public function ajaxupload3()
	{
		$this->data['subview']=self::MODULE.'ajax_upload3';
		$this->load->view('front/main_layout',$this->data);		
	}



	public function upload_file()
	{
		$status = "";
		$msg = "";
		$file_element_name = 'userfile';

		if ($status != "error")
		{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|doc|txt';
			$config['max_size'] = 1024 * 8;
			$config['encrypt_name'] = FALSE;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($file_element_name))
			{
				$status = 'error';
				$msg = $this->upload->display_errors('', '');
			}
			else
			{
				$data = $this->upload->data();
				$image_path = $data['full_path'];
				if(file_exists($image_path))
				{
					$status = "success";
					$msg = "File successfully uploaded";
				}
				else
				{
					$status = "error";
					$msg = "Something went wrong when saving the file, please try again.";
				}
			}
			@unlink($_FILES[$file_element_name]);
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

}


/* End of file sample.php */
/* Location: ./application/modules/sample/controllers/sample.php */




