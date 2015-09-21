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
				"ser_pwd" => md5('password'),
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

		
		Flight::cssrender("/public/js/select2/select2.css");
		Flight::cssrender("/public/js/select2/select2-bootstrap.css");
		Flight::cssrender("/public/css/bootstrap-datepicker.min.css");
		Flight::cssrender("/public/css/bootstrap-datepicker3.min.css");
		Flight::jsrender("/public/js/select2/select2.min.js");
		Flight::jsrender("/public/js/select2/select2_locale_zh-CN.js");
		Flight::jsrender("/public/js/bootstrap-datepicker.min.js");
		Flight::jsrender("/public/js/bootstrap-datepicker.zh-CN.min.js");
		Flight::jsrender("/public/js/bootbox.min.js");
		Flight::jsrender("/public/js/admin/salary.js");

		$db = Flight::get('db');
		$sers = $db->select("services", array("ser_id", "ser_name"), array("is_use" => 1));
		if($sers) {
			$res = array();
			foreach ($sers as $key => $value) {
				$res[$value['ser_id']] = $value['ser_name'];
			}
			Flight::render("admin/salary", array("sers" => $res));
		}else{
			Handle::msg("请先添加客服人员");
		}

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
	
	/**
	 * 发工资
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-09-21
	 */
	public static function save_wages() {
		$data = Flight::request()->data;
		$ser_id = isset($data['ser_id'])?$data['ser_id']:'';
		$money = isset($data['money'])?$data['money']:'';
		$start_date = isset($data['start_date'])?$data['start_date']:'';
		$end_date = isset($data['end_date'])?$data['end_date']:'';
		$detail = isset($data['detail'])?$data['detail']:'';

		if(!$ser_id) {
			Flight::json(array("success" => false, "message" => "缺少客服人员，请选择客服"));
			die;
		}

		if(!$money) {
			Flight::json(array("success" => false, "message" => "未获取到薪资，请填写薪资"));
			die;
		}

		if(!$start_date) {
			Flight::json(array("success" => false, "message" => "未获取到开始时间，请填写开始时间"));
			die;
		}

		if(!$end_date) {
			Flight::json(array("success" => false, "message" => "未获取到结束时间，请填写结束时间"));
			die;
		}

		if(!$detail) {
			Flight::json(array("success" => false, "message" => "未获取到薪资结构描述，请填写薪资结构描述"));
			die;
		}

		$data = array(
			'ser_id' => $ser_id,
			'money' => $money,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'detail' => $detail,
			'admin_id' => Session::get('admin_id'),
			'add_time' => date('Y-m-d H:i:s'),
		);

		$wage_id = Flight::get('db')->insert("wages", $data);

		if($wage_id) {
			Flight::json(array("success" => true, "message" => "发薪成功"));
		}else{
			Flight::json(array("success" => false, "message" => "发薪失败，存储数据失败"));
		}
	}

	/**
	 * 获取薪资记录
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-09-21
	 */
	public static function getWagesRecords() {
		$req = Flight::request()->query;

		$limit = ($req['limit'])?$req['limit']:10;
		$offset = ($req['offset'])?$req['offset']:0;
		$search = ($req['search'])?$req['search']:'';

		$db = Flight::get('db');
		$cond =  array(
			"ORDER" => "add_time DESC",
			"LIMIT" => array($offset, $limit)
		);

		if($search) {
			$cond['AND'] = array(
				"ser_name" => $search,
			); 
		}

		$data = $db->select("wages", array("[>]services" => "ser_id"), "*", $cond);
		$total = $db->count("wages");
		Flight:: json(array("total" => $total, 'rows' => $data));
	}

	/**
	 * 删除记录
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-09-21
	 */
	public static function del_wage() {
		$req = Flight::request()->data;
		$wage_id = ($req['wage_id'])?$req['wage_id']:'';

		if(Flight::get('db')->delete('wages', array("id" => $wage_id))) {
			Flight::json(array("success" => true, "message" => "删除成功"));
		}else{
			Flight::json(array("success" => false, "message" => "删除失败"));
		}
	}

	public static function admin_manage() {
		Flight::cssrender("/public/js/select2/select2.css");
		Flight::cssrender("/public/js/select2/select2-bootstrap.css");
		Flight::cssrender("/public/css/bootstrap-datepicker.min.css");
		Flight::cssrender("/public/css/bootstrap-datepicker3.min.css");
		Flight::jsrender("/public/js/select2/select2.min.js");
		Flight::jsrender("/public/js/select2/select2_locale_zh-CN.js");
		Flight::jsrender("/public/js/bootstrap-datepicker.min.js");
		Flight::jsrender("/public/js/bootstrap-datepicker.zh-CN.min.js");
		Flight::jsrender("/public/js/bootbox.min.js");
		Flight::jsrender("/public/js/admin/admin_manage.js");

	
		Flight::render("admin/admin_manage");
	}

	/**
	 * 获取管理员
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-09-21
	 */
	public static function getAdmins() {
		$req = Flight::request()->query;

		$limit = ($req['limit'])?$req['limit']:10;
		$offset = ($req['offset'])?$req['offset']:0;
		$search = ($req['search'])?$req['search']:'';

		$db = Flight::get('db');
		$cond =  array(
			"ORDER" => "add_time DESC",
			"LIMIT" => array($offset, $limit)
		);

		if($search) {
			$cond['AND'] = array(
				"admin_name" => $search,
			); 
		}

		$data = $db->select("admin", "*", $cond);
		$total = $db->count("admin");
		Flight:: json(array("total" => $total, 'rows' => $data));
	}

	/**
	 * 保存管理员账号
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-09-21
	 */
	public static function save_admin() {
		$data = Flight::request()->data;
		$admin_name = isset($data['admin_name'])?$data['admin_name']:'';
		$admin_pwd = isset($data['admin_pwd'])?$data['admin_pwd']:'';
		$admin_email = isset($data['admin_email'])?$data['admin_email']:'';
		$admin_phone = isset($data['admin_phone'])?$data['admin_phone']:'';

		if(!$admin_name) {
			Flight::json(array("success" => false, "message" => "请填写管理员账号"));
			die;
		}

		if(!$admin_pwd) {
			Flight::json(array("success" => false, "message" => "请填写管理员密码"));
			die;
		}

		if(!$admin_email) {
			Flight::json(array("success" => false, "message" => "请填写管理员邮箱"));
			die;
		}

		if(!$admin_phone) {
			Flight::json(array("success" => false, "message" => "请填写管理员手机号码"));
			die;
		}

		if(Flight::get('db')->has('admin', array("admin_name" => $admin_name))) {
			Flight::json(array("success" => false, "message" => "此账号已经存在"));
			die;
		}

		$data = array(
			'admin_name' => $admin_name,
			'admin_pwd' => md5($admin_pwd),
			'admin_email' => $admin_email,
			'admin_phone' => $admin_phone,
			'add_time' => time()
		);

		$admin_id = Flight::get('db')->insert("admin", $data);

		if($admin_id) {
			Flight::json(array("success" => true, "message" => "添加成功"));
		}else{
			Flight::json(array("success" => false, "message" => "添加失败，存储数据失败"));
		}
	}

	/**
	 * 删除管理员账号
	 *
	 * @return [type]     [description]
	 * @author zhaozl
	 * @since  2015-09-21
	 */
	public static function del_admin() {
		$req = Flight::request()->data;
		$admin_id = ($req['admin_id'])?$req['admin_id']:'';

		if(Flight::get('db')->delete('admin', array("admin_id" => $admin_id))) {
			Flight::json(array("success" => true, "message" => "删除成功"));
		}else{
			Flight::json(array("success" => false, "message" => "删除失败"));
		}
	}


}