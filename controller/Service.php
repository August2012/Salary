<?php

class Service {

	public static function index() {
		Flight::jsrender('/public/js/admin/service.js');
		Flight::render('service/index');
	}


	public static function getMyWages() {

		$req = Flight::request()->query;

		$limit = ($req['limit'])?$req['limit']:10;
		$offset = ($req['offset'])?$req['offset']:0;
		$search = ($req['search'])?$req['search']:'';

		$ser_id = Session::get('ser_id');
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
		$cond['AND']['ser_id'] = $ser_id;

		$data = $db->select("wages", array("[>]services" => "ser_id"), "*", $cond);
		$total = $db->count("wages");
		Flight:: json(array("total" => $total, 'rows' => $data));

	}

}