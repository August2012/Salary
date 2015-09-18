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

			if(self::$author['username'] == $username && self::$author['password'] == $password) {
				// login process, write the user data into session
	            Session::init();
	            Session::set('is_login', true);
	            Session::set('is_admin', true);
	            Session::set('admin_id', '10000000001');
	            Session::set('admin_name', $username);

				Flight::json(array('success' => true, 'msg' => '登录成功'));
				die;
			}

			$db = Flight::get('db');
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

				if(md5($password) == $res['admin_password']) {
					// 执行登录操作

					// login process, write the user data into session
		            Session::init();
		            Session::set('is_login', true);
		            Session::set('admin_id', $res['admin_id']);
		            Session::set('admin_name', $res['admin_name']);
		            Session::set('phone_mob', $res['phone_mob']);
		            Session::set('group_id', $res['group_id']);

					Flight::json(array('success' => true, 'msg' => '登录成功'));

				}else{
					Flight::json(array('success' => false, 'msg' => '用户密码不正确'));
				}

			}else{
				Flight::json(array('success' => false, 'msg' => '找不到用户'));
			}


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