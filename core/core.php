<?php

// 判断当前请求类型
$request = Flight::request();

if($request->method == 'GET') {
	define('IS_GET', true);
	define('IS_POST', false);
}else if($request->method == 'POST') {
	define('IS_POST', true);
	define('IS_GET', false);
}

if($request->ajax) {
	define('IS_AJAX', true);
}else{
	define('IS_AJAX', true);
}


// 注册数据库函数方法, 使用medoo
$db =  new medoo(array(
	// required
	'database_type' => Flight::get('DB_TYPE'),
	'database_name' => Flight::get('DB_NAME'),
	'server'        => Flight::get('DB_HOST'),
	'username'      => Flight::get('DB_USER'),
	'password'      => Flight::get('DB_PWD'),
	'charset'       => Flight::get('DB_ENCODING'),
	'port' 			=> Flight::get('DB_PORT'),
	'option' => array(
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	)
)); 

Flight::set('db', $db);

// 打印函数
function p($target) {
	echo "<pre>";
	var_dump($target);
	echo "</pre>";
}


// 检测文件夹是否存在
function verifyPath($strPath, $createPath = false) {
	$folder_path = strstr ( $strPath, '.' ) ? dirname ( $strPath ) : $strPath;
	
	if (file_exists ( $strPath ) || @is_dir ( $strPath )) {
		return true;
	} else {
		if ($createPath) {
			mk_dir ( $strPath, 0777 );
		} else
			return false;
	}
	return false;
}

// 创建文件夹
function mk_dir( $strPath, $rights = 0777) {
	$folder_path = array($strPath);
	$oldumask    = umask(0);
	while(!@is_dir(dirname(end($folder_path)))
	  && dirname(end($folder_path)) != '/'
	  && dirname(end($folder_path)) != '.'
	  && dirname(end($folder_path)) != '')
	array_push($folder_path, dirname(end($folder_path)));

	while($parent_folder_path = array_pop($folder_path))
		if(!@is_dir($parent_folder_path))
			if(!@mkdir($parent_folder_path, $rights))
				umask($oldumask);
}


// 发送短信功能
function sendMsg($phone_mob, $message) {

	if(!$phone_mob || !$message) {
		return false;
	}

	$time = time();
	// 
	$token = md5(strtolower('sms').strtolower('sendmsg').$time.Flight::get("SECRECT_CODE"));

	$urlParam = array(
		'time' => $time,
		'token' => $token,
		'phone_mob' => trim($phone_mob),
		'message' => trim($message),
		'type' => 2,
	);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, Flight::get('SMS_URL'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$urlParam);
	$output = curl_exec($ch) ;

	curl_close($ch);
	return true;
}

/**  
 * google api 二维码生成【QRcode可以存储最多4296个字母数字类型的任意文本，具体可以查看二维码数据格式】  
 * @param string $chl 二维码包含的信息，可以是数字、字符、二进制信息、汉字。  
 * 不能混合数据类型，数据必须经过UTF-8 URL-encoded  
 * @param int $widhtHeight 生成二维码的尺寸设置  
 * @param string $EC_level 可选纠错级别，QR码支持四个等级纠错，用来恢复丢失的、读错的、模糊的、数据。  
 *       L-默认：可以识别已损失的7%的数据  
 *       M-可以识别已损失15%的数据  
 *       Q-可以识别已损失25%的数据  
 *       H-可以识别已损失30%的数据  
 * @param int $margin 生成的二维码离图片边框的距离  
 */ 
function generateQRfromGoogle($chl,$widhtHeight ='150',$EC_level='L',$margin='0') {
	$chl = urlencode($chl);  
	return 'http://chart.apis.google.com/chart?chs='.$widhtHeight.'x'.$widhtHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.$chl.'"alt="QR code"widhtHeight="'.$widhtHeight.'"widhtHeight="'.$widhtHeight;  
}

/**
 * 本地的API生成二维码
 *
 * @param  [type]     $chl      [description]
 * @param  string     $EC_level [description]
 * @param  string     $piexl    [description]
 * @param  string     $margin   [description]
 * @return [type]               [description]
 * @author zhaozl
 * @since  2015-07-28
 */
function generateQRfromApi($chl, $level = 'M', $piexl = '3', $margin = '4') {
	$chl = urlencode($chl);  
	return Flight::get('QR_URL').'?content='.$chl.'&level='.$level.'&piexl='.$piexl.'&margin='.$margin;
}