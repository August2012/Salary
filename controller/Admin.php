<?php

class Admin {


	public static function index() {

		// 查询客服
		
		$db = Flight::get('db');
		$data = $db->select("services", "*", array("ORDER" => "ser_join"));

		$res = array();
		if($data) {
			foreach ($data as $key => $value) {
				$value['ser_time'] = date('Y-m-d', $value['ser_join']);
				$value['ser_use'] = $value['is_use'] == 1?'启用':'未启用';

				$res[] = $value;
			}
		}

		Flight::jsrender("/public/js/admin/index.js");
		Flight::render("admin/index", array('data' => $res));

	}

	public static function add_service() {
		if(IS_POST) {
			$data = Flight::request()->data;
			$ser_name = isset($data['ser_name'])?trim($data['ser_name']):'';
			$ser_phone = isset($data['ser_phone'])?trim($data['ser_phone']):'';
			$ser_email = isset($data['ser_email'])?trim($data['ser_email']):'';

			if(!$ser_name) {
				Flight::json(array('success' => false, 'message' => '缺少客服名'));
				die;
			}

			if(!$ser_phone) {
				Flight::json(array('success' => false, 'message' => '缺少客服手机号码'));
				die;
			}

			$db = Flight::get('db');
			if($db->has('services', array("ser_name" => $ser_name ))) {
				Flight::json(array('success' => false, 'message' => '此客服名已经存在'));
				die;
			}

			$db = Flight::get('db');
			if($db->has('services', array("ser_phone" => $ser_phone ))) {
				Flight::json(array('success' => false, 'message' => '客服手机已经存在'));
				die;
			}

			$ser_id = $db->insert("services", array(
				"ser_name" => $ser_name,
				"ser_phone" => $ser_phone,
				"ser_email" => $ser_email,
				"ser_join" => time(),
				"is_use" => 1,
			));

			if($ser_id) {
				Flight::json(array('success' => true, 'message' => '添加成功'));
			}else{
				Flight::json(array('success' => false, 'message' => '添加失败'));
			}

		}else{
			Flight::jsrender("/public/js/admin/add_service.js");
			Flight::render("admin/add_service");
		}
	}

	/**
	 * 编辑客服
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-09-18
	 */
	public static function edit_service() {
		if(IS_POST) {
			$data = Flight::request()->data;
			$ser_id = isset($data['ser_id'])?trim($data['ser_id']):'';
			$ser_name = isset($data['ser_name'])?trim($data['ser_name']):'';
			$ser_phone = isset($data['ser_phone'])?trim($data['ser_phone']):'';
			$ser_email = isset($data['ser_email'])?trim($data['ser_email']):'';

			if(!$ser_id) {
				Flight::json(array('success' => false, 'message' => '找不到客服'));
				die;
			}

			if(!$ser_name) {
				Flight::json(array('success' => false, 'message' => '缺少客服名'));
				die;
			}

			if(!$ser_phone) {
				Flight::json(array('success' => false, 'message' => '缺少客服手机号码'));
				die;
			}

			$db = Flight::get('db');
			if($db->has('services', array("AND" => array( "ser_name" => $ser_name, "ser_id[!]" => $ser_id) ))) {
				Flight::json(array('success' => false, 'message' => '此客服名已经存在'));
				die;
			}

			$db = Flight::get('db');
			if($db->has('services', array("AND" => array( "ser_phone" => $ser_phone, "ser_id[!]" => $ser_id) ))) {
				Flight::json(array('success' => false, 'message' => '客服手机已经存在'));
				die;
			}

			$ser_res = $db->update("services", array(
				"ser_name" => $ser_name,
				"ser_phone" => $ser_phone,
				"ser_email" => $ser_email,
				"ser_join" => time(),
				"is_use" => 1,
			), array("ser_id" => $ser_id));

			if($ser_res) {
				Flight::json(array('success' => true, 'message' => '编辑成功'));
			}else{
				Flight::json(array('success' => false, 'message' => '编辑失败'));
			}

		}else{

			$req = Flight::request()->query;
			$ser_id = isset($req['ser_id'])?$req['ser_id']:'';
			$data = Flight::get('db')->get("services", "*", array("ser_id" => $ser_id));

			Flight::jsrender("/public/js/admin/edit_service.js");
			Flight::render("admin/edit_service", $data);
		}
	}

	public static function salary() {

		Flight::render("admin/salary");

	}

	/**
	 * 更改状态信息
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-09-18
	 */
	public static function change_status() {
		$req = Flight::request()->data;
		$ser_id = isset($req['ser_id'])?$req['ser_id']:'';
		$status = isset($req['status'])?$req['status']:'';

		if($status == 1) {
			Flight::get('db')->update("services", array("is_use" => 0), array("ser_id" => $ser_id));
		}

		if($status == 2) {
			Flight::get('db')->update("services", array("is_use" => 1), array("ser_id" => $ser_id));
		}

		Flight::json(array('success' => true, 'message' => '编辑成功'));
	}
	
}