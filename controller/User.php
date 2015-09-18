<?php

class User {

	static private $author = array(
		'username' => 'long',
		'password' => '22605eb1d4f7e6b093098afc074a0e9d', // long!@#2015POP
	);

	/**
	 * 登录界面
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-06-27
	 */
	public static function login() {

		Flight::render("user/login", array(), false);

	}


	/**
	 * 验证登录
	 *
	 * @return json
	 * @author zhaozl
	 * @since  2015-06-29
	 */
	public static function auth_login() {

		if(IS_POST) {

			$data = Flight::request()->data;
			$username = trim($data->username);
			$password = trim($data->password);

			if(self::$author['username'] == $username && self::$author['password'] == md5($password)) {
				// login process, write the user data into session
	            Session::init();
	            Session::set('is_login', true);
	            Session::set('is_admin', true);
	            Session::set('admin_id', '10000000001');
	            Session::set('admin_name', $username);

				Flight::json(array('success' => true, 'msg' => '登录成功', 'is_admin' => true));
				die;
			}

			$db = Flight::get('db');
			$password = md5($password);
			$res = $db->get("admin", "*", array(
				"AND" => array(
					"OR" => array(
						"admin_name" => $username, 
						"admin_email" => $username, 
						"admin_phone" => $username, 
					),
					"admin_pwd" => $password
					)
				)
			);

			if($res) {
				// 执行登录操作
	            Session::init();
	            Session::set('is_login', true);
	            Session::set('is_admin', true);
	            Session::set('admin_id', $res['admin_id']);
	            Session::set('admin_name', $res['admin_name']);
	            Session::set('admin_phone', $res['admin_phone']);
	            Session::set('admin_email', $res['admin_email']);

				Flight::json(array('success' => true, 'msg' => '登录成功', 'is_admin' => true));
				die;
			}

			$res1 = $db->get("services", "*", array(
				"AND" => array(
					"OR" => array(
						"ser_name" => $username, 
						"ser_email" => $username, 
						"ser_phone" => $username, 
					),
					"ser_pwd" => $password
					)
				)
			);

			if($res1) {
				Session::init();
	            Session::set('is_login', true);
	            Session::set('is_admin', false);
	            Session::set('ser_id', $res['ser_id']);
	            Session::set('ser_name', $res['ser_name']);
	            Session::set('ser_phone', $res['ser_phone']);
	            Session::set('ser_email', $res['ser_email']);

				Flight::json(array('success' => true, 'msg' => '登录成功', 'is_admin' => false));
				die;
			}

			Flight::json(array('success' => true, 'msg' => '登录失败，请检查用户名密码'));
			die;

		}else{

			Flight::json(array('success' => false, 'msg' => '非法操作'));

		}

	}

	/**
	 * 登出操作
	 *
	 * @author zhaozl
	 * @since  2015-07-02
	 */
	public static function logout() {

		Session::destroy();
		Flight::redirect('user/login');

	}

}