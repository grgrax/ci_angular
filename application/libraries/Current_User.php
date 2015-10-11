<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Current_User
{

	private static $user_id;
	private static $type;

	const ADMIN=1;
	const DONEE=2;

	public function __construct()
	{
		try {
			$admin=get_session('admin');
			$donee=get_session('donee_id');
			if($admin){
				self::$user_id=$admin;
				self::$type=self::ADMIN;
			}elseif ($donee) {
				self::$user_id=$donee;
				self::$type=self::DONEE;
			}			
		} catch (Exception $e) {
			self::$user_id=0;
			self::$type=null;			
		}
	}

	public static function getUser(){
		$user=array(
			'id'=>self::$user_id,
			'type'=>self::$type,
			);
		return $user;
	}

	public static function isAdmin(){
		echo self::$type==self::ADMIN?1:0;
		die;
		return self::$type==self::ADMIN?1:0;
	}

	public static function isDonee(){
		return self::$type==self::DONEE?1:0;
	}

	public static function getId(){
		$user=self::getUser();
		return $user['id']['id'];
	}

}