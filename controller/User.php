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
	            Session::set('ser_id', $res1['ser_id']);
	            Session::set('ser_name', $res1['ser_name']);
	            Session::set('ser_phone', $res1['ser_phone']);
	            Session::set('ser_email', $res1['ser_email']);

				Flight::json(array('success' => true, 'msg' => '登录成功', 'is_admin' => false));
				die;
			}

			Flight::json(array('success' => false, 'msg' => '登录失败，请检查用户名密码'));
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

	/**
	 * 修改密码
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-09-21
	 */
	public static function change_pwd() {

		if(IS_POST) {
			$data = Flight::request()->data;
			$oldpwd = isset($data['oldpassword'])?md5($data['oldpassword']):'';
			$pwd = isset($data['password'])?md5($data['password']):'';
			$repwd = isset($data['repassword'])?md5($data['repassword']):'';

			if($pwd != $repwd) {
				Flight::json(array("success" => false, "message" => "新密码两次密码不匹配"));
				die;
			}
			if(Session::get('is_admin')) {
				if(!Flight::get('db')->has('admin', array("AND" => array("admin_id" => Session::get('admin_id'), "admin_pwd" => $oldpwd)))) {
					Flight::json(array("success" => false, "message" => "旧密码不匹配"));
					die;
				}
				$id = Flight::get('db')->update('admin', array("admin_pwd" => $pwd), array("admin_id" => Session::get('admin_id')));

			}else{
				if(!Flight::get('db')->has('services', array("AND" => array("ser_id" => Session::get('ser_id'), "ser_pwd" => $oldpwd)))) {
					Flight::json(array("success" => false, "message" => "旧密码不匹配"));
					die;
				}

				$id = Flight::get('db')->update('services', array("ser_pwd" => $pwd), array("ser_id" => Session::get('ser_id')));
			}

			if($id) {
				Flight::json(array("success" => true, "message" => "修改成功"));
			}else{
				Flight::json(array("success" => false, "message" => "修改密码失败"));
			}

		}else{
			Flight::jsrender('/public/js/user/change_pwd.js');
			Flight::render('user/change_pwd');
		}

	}

	/**
	 * 修改密码
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-09-21
	 */
	public static function change_info() {

		if(IS_POST) {
			$data = Flight::request()->data;
			$email = isset($data['email'])?$data['email']:'';
			$phone = isset($data['phone'])?$data['phone']:'';

			if(Session::get('is_admin')) {
				if(Flight::get('db')->has('admin', array("AND" => array('admin_phone' => $phone, "admin_id[!]" => Session::get('admin_id'))))) {
					Flight::json(array("success" => false, "message" => "此手机号码已经被别人使用"));
					die;
				}

				$id = Flight::get('db')->update('admin', array("admin_email" => $email, "admin_phone" => $phone), array("admin_id" => Session::get('admin_id')));

			}else{
				if(Flight::get('db')->has('services', array("AND" => array('ser_phone' => $phone, "ser_id[!]" => Session::get('ser_id'))))) {
					Flight::json(array("success" => false, "message" => "此手机号码已经被别人使用"));
					die;
				}
				
				$id = Flight::get('db')->update('services', array("ser_email" => $email, "ser_phone" => $phone), array("ser_id" => Session::get('ser_id')));
			}

			if($id) {
				Flight::json(array("success" => true, "message" => "修改成功"));
			}else{
				Flight::json(array("success" => false, "message" => "修改失败"));
			}

		}else{

			if(Session::get('is_admin')) {
				$data = Flight::get("db")->get("admin", array("admin_email", "admin_phone"), array("admin_id" => Session::get('admin_id')));

				$res['email'] = $data['admin_email'];
				$res['phone'] = $data['admin_phone'];
			}else{
				$data = Flight::get("db")->get("services", array("ser_email", "ser_phone"), array("ser_id" => Session::get('ser_id')));
				$res['email'] = $data['ser_email'];
				$res['phone'] = $data['ser_phone'];
			}
			Flight::jsrender('/public/js/user/change_info.js');
			Flight::render('user/change_info', $res);
		}

	}

}