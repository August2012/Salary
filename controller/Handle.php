<?php

class Handle {

	public static function msg($msg) {

		Flight::render("common/handle", array("msg" => $msg));
		die;

	}

}