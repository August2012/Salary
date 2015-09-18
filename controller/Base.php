<?php
/**
 * 基础类，过滤所有请求
 *
 * 保证登录状态下
 * 
 */
class Base{

	private static $no_login_array = array(
		'User.login', 'User.auth_login', 'Handle.result'
	);

	public static function index() {

		$req = explode('/', Flight::request()->url);
		$app = isset($req[1])?$req[1]:'';
		$act = isset($req[2])?$req[2]:'';

		if(!in_array("{$app}.{$act}", self::$no_login_array)) {

			if(!Session::get('is_login')) {
				User::login();
		        return false;
		    }else{
				return true;
		    }
		}

		return true;
	}

}