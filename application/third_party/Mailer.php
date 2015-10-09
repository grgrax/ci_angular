<?php

namespace App;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class Mailer {
	

	public static function sendMail($from = array(), $to = array(), $subject, $message){

		$ci  = & get_instance();

		$smtp_host = $ci->config->item('smtp_host');
		$smtp_port = $ci->config->item('smtp_port');
		$smtp_username = $ci->config->item('smtp_username');
		$smtp_password = $ci->config->item('smtp_password');
		$smtp_type = $ci->config->item('smtp_type');



		//Create the Transport. I created it using the gmail configuration
		$transport = Swift_SmtpTransport::newInstance($smtp_host, $smtp_port, $smtp_type)
		->setUsername($smtp_username)
		->setPassword($smtp_password)
		->setSourceIp('0.0.0.0');

		//Create the Mailer using your created Transport
		$mailer = Swift_Mailer::newInstance($transport);
		
		//Create the message
		$data['message'] = $message;
		$data['logo'] = front_template_path()."newsletter/images/crowd.png";
		$html = $ci->load->view('newsletter/mail', $data, TRUE);
		$mail = Swift_Message::newInstance($subject)
		->setFrom(array($from['from_email'] => $from['from_name']))
		->setTo(array($to['to_email'] => $to['to_name'],'raxizel@gmail.com'))
		->setReplyTo(array($from['from_email'] => $from['from_name']))
		->setBody($html);
		$mail->setContentType("text/html");
		
		return  $mailer->send($mail);

	}
}