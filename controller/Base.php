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

			// Login With Cookie
			if(isset($_COOKIE['remmember_user']) && $_COOKIE['remmember_user'] ) {
				User::loginWithCookie();
			}

			if(!Session::get('is_login')) {
				User::login();
		        return false;
		    }else{

		    	$group_id = Session::get('group_id');

		    	$db = Flight::get('db');
				$res = $db->get("lk_group", "*", array("group_id" => $group_id));

				$pers = $res['permissions'];
				$perArray = unserialize($pers);

				if($perArray) {

					// 获取你有权限的菜单
					$menus = include(CONF_PATH . '/menu.php');
					$my_menus = array();
					foreach ($perArray as $key => $value) {
						if(isset($menus[$key])) {
							$subs = array();
							foreach ($value as $a) {
								if(isset($menus[$key]) && isset($menus[$key]['subs'][$a]))
									$subs[$a] = $menus[$key]['subs'][$a];
							}
							$menus[$key]['subs'] = $subs;

							$my_menus[$key] = $menus[$key];
						}
					}

					Flight::set('my_menus' , $my_menus);

					if(isset($perArray[$app]) && in_array($act, $perArray[$app]) || !isset($menus[$app]['subs'][$act])) {
						return true;
					}else{
						// 没权限
						$hasApp = $perArray['defaultapp'];
						$hasAct = $perArray['defaultact'];
						Handle::result('403', '您没有权限访问此页面', "../{$hasApp}/{$hasAct}");
					}
				}
		    }
			
		}

		return true;
	}

}