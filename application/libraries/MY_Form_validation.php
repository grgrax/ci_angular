<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	/**
	 * Alpha-numeric with underscores and dashes
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function alpha_space_($str)
	{
		return ( ! preg_match("/^([a-zA-Z\s])+$/i", $str)) ? FALSE : TRUE;
	}


	function alpha_space($str) {
		$this->CI->form_validation->set_message('alpha_space', 'The %s may only contain alphabet and spaces.');
		return ( ! preg_match("/^([\sa-z0-9\'\.\-\_\&\'])+$/i", $str)) ? FALSE : TRUE;
	}

	function alphanumeric_space($str) {
		$this->CI->form_validation->set_message('alphanumeric_space', 'The %s may only contain alphabet,number and spaces.');
		return ( ! preg_match("/^([\sa-z0-9])+$/i", $str)) ? FALSE : TRUE;
	}

	function valid_personname($str)
	{
		$this->CI->form_validation->set_message('valid_personname', 'The %s may only contain alphabet, . and spaces.');
		return ( ! preg_match("/^([\sa-z\.])+$/i", $str)) ? FALSE : TRUE;
	}

	function alpha_space_menu($str) {
		$this->CI->form_validation->set_message('alpha_space_menu', 'The %s may only contain alphabet and spaces.');
		return ( ! preg_match("/^([\sa-z\-\_\&\'])+$/i", $str)) ? FALSE : TRUE;
	}


	public function is_article_name_unique($str,$id)
	{
		$CI=CI::$APP;
		// $entity=$CI->load->model('article/article_m')->read_row_by_name($str);		
		$entity=$CI->load->model('menu/menu_m')->read_rows_by(array('name'=>$str,'status !='=>menu_m::DELETED),1);		
		if (!$entity){
			return TRUE;			
		}
		else
		{
			if($id!=$entity['id']){
				$CI->form_validation->set_message("is_article_name_unique", "The %s ($str) is already used, please try another <br/>");
				return FALSE;
			}
			return TRUE;
		}
	}

	public function is_category_name_unique($str,$id)
	{
		$CI=CI::$APP;
		$entity=$CI->load->model('category/category_m')->read_rows_by(array('name'=>$str),1);		
		if (!$entity){
			return TRUE;			
		}
		else
		{
			if($id!=$entity['id']){
				$CI->form_validation->set_message("is_category_name_unique", "The %s ($str) is already used, please try another <br/>");
				return FALSE;
			}
			return TRUE;
		}
	}

	public function is_menu_url_unique($str,$id)
	{
		$CI=CI::$APP;
		$entity=$CI->load->model('menu/menu_m')->read_rows_by(array('url'=>$str,'status !='=>menu_m::DELETED),1);		
		if (!$entity){
			$this->CI->form_validation->set_message('is_menu_url_unique', 'The %s may only contain alphabet, - & _');
			return ( ! preg_match("/^([a-z\-\_])+$/i", $str)) ? FALSE : TRUE;
		}
		else
		{
			if($id!=$entity['id']){
				$CI->form_validation->set_message("is_menu_url_unique", "The %s ($str) is already used, please try another <br/>");
				return FALSE;
			}
			return TRUE;
		}
	}

	function isAlreadyRegistered($email,$editUserId)
	{

		// $this->form_validation->set_rules('email', 'Email', "required|valid_email|isAlreadyRegistered[".$user->id()."]");

		$CI=CI::$APP;
		$user=$CI->doctrine->em->getRepository('models\User')->findOneBy(array('email'=>$email));
		if (!$user)
			return TRUE;
		else
		{
			if($editUserId!=$user->id()){
				$CI->form_validation->set_message("isAlreadyRegistered", "The %s ($email) is already registered, please try another email address<br/>");
				return FALSE;
			}
			return TRUE;
		}
	}

	public function is_column_name_unique($str=null,$id=null,$model=null)
	
	{
		$CI=CI::$APP;
		$CI->form_validation->set_message("is_column_name_unique", "str:$str ---- id:$id ---- model:$model");
		return FALSE;			
		if(!$str || !$model || !$id){
			$CI->form_validation->set_message("is_column_name_unique", "The %s ($str) should not be null, please provide some value <br/>");
			return FALSE;			
		}
		$row=$CI->load->model('fund_category/fund_category_m')->read($id);
		$CI->form_validation->set_message("is_column_name_unique", count($row));
		return FALSE;			
		$row=$CI->load->model($modal)->read_rows_by(array('id'=>$id),1);		
		if (!$row){
			// return TRUE;			
			$CI->form_validation->set_message("is_column_name_unique", show_pre($row));
			return FALSE;			
		}
		else
		{
			if($id!=$row[$id]){
				$CI->form_validation->set_message("is_column_name_unique", "The %s ($str) is already used, please try another <br/>");
				return FALSE;
			}
			return TRUE;
		}
	}

	function check_old_password($oldpwd=null,$id=null) {	
		try {
			if(!$oldpwd) throw new Exception("Error Processing Request", 1);
			if(!$id) throw new Exception("Error Processing Request", 1);
			$ci=& get_instance();
			$user=$ci->load->model('user/user_m')->read_row($id);
			if(!$user){
				$ci->form_validation->set_message('check_old_password', $id."Error Processing Request.");
				return false;
			}
			else{
				if($user['pass']!=sha1( $ci->input->post('old_password'))){
					$ci->form_validation->set_message('check_old_password', 'The Old Password is Wrong.');
					return false;
				}
				if($user['pass']==sha1( $ci->input->post('new_password'))){
					$ci->form_validation->set_message('check_old_password', 'The New Password must be different than Old Password.');
					return false;
				}
				return true;
			} 
		} catch (Exception $e) {
			$ci->form_validation->set_message('check_old_password', $e->getMessage());
			return false;
		}
	}


	public function is_fund_category_name_unique($str,$id)
	{
		$CI=CI::$APP;
		$row=$CI->load->model('fund_category/fund_category_m')->read_rows_by(array('name'=>$str),1);		
		if (!$row){
			return TRUE;			
		}
		else
		{
			if($id!=$row['id']){
				$CI->form_validation->set_message("is_fund_category_name_unique", "The %s ($str) is already used, please try another <br/>");
				return FALSE;
			}
			return TRUE;
		}
	}

	public function is_campaign_title_unique($str,$id)
	{
		$CI=CI::$APP;
		$row=$CI->load->model('campaign/campaign_m')->read_rows_by(array('campaign_title'=>$str),1);		
		if (!$row){
			return TRUE;			
		}
		else
		{
			if($id!=$row['id']){
				$CI->form_validation->set_message("is_campaign_title_unique", "The %s ($str) is already used, please try another <br/>");
				return FALSE;
			}
			return TRUE;
		}
	}

	public function is_campaign_url_unique($str,$id)
	{
		$CI=CI::$APP;
		$row=$CI->load->model('campaign/campaign_m')->read_rows_by(array('url_link'=>$str),1);		
		if (!$row){
			return TRUE;			
		}
		else
		{
			if($id!=$row['id']){
				$CI->form_validation->set_message("is_campaign_url_unique", "The %s ($str) is already used, please try another <br/>");
				return FALSE;
			}
			return TRUE;
		}
	}

	public function is_username_unique($str,$id)
	{
		$CI=CI::$APP;
		$row=$CI->load->model('user/user_m')->read_row_by_n(array('username'=>$str));		
		if (!$row) return TRUE;			
		else{
			if($id!=$row['id']){
				$CI->form_validation->set_message("is_username_unique", "The %s ($str) is already used, please try another <br/>");
				return FALSE;
			}
			return TRUE;
		}
	}

	public function is_user_email_unique($str,$id)
	{
		$CI=CI::$APP;
		$row=$CI->load->model('user/user_m')->read_row_by_n(array('email'=>$str));		
		if (!$row) return TRUE;			
		else{
			if($id!=$row['id']){
				$CI->form_validation->set_message("is_user_email_unique", "The %s ($str) is already used, please try another <br/>");
				return FALSE;
			}
			return TRUE;
		}
	}

	public function route($str)
	{
		// return is_route($str)? FALSE : TRUE;
		$CI=CI::$APP;
		if(is_route($str)){
			$CI->form_validation->set_message("route", "The %s ( $str ) is predined keywords, please try another <br/>");
			return FALSE;
		}
		return TRUE;
	}


	//callbacks by forms
}
// END Form Validation Class

