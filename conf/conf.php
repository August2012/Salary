<?php

return array(

	'SITE_URL'      => 'http://www.ls.com',
	'STATIC_URL'      => 'http://localhost:8085/files',
	'WEB_URL'      => 'http://localhost:8080/qccode',
	'DB_TYPE'       => 'mysql',
	'DB_ENCODING'   => 'utf8',
	'DB_HOST'       => '10.49.0.137',
	'DB_NAME'       => 'lk12349',
	'DB_USER'       => 'lk12349',
	'DB_PORT'       => '3306',
	'DB_PWD'        => '123456',
	
	'CACHE_SERVER'  => 'memcache',
	'MEMCACHE_HOST' => '127.0.0.1',
	'MEMCACHE_PORT' => '11211',
	'REDIS_HOST'    => '127.0.0.1',
	'REDIS_PORT'    => '6379',

	// 本地访问webSocket
	'WEBSOCKET_URL' => '10.49.3.141',
	'WEBSOCKET_PORT' => '9001',
	
	'COOKIE_DOMAIN' => '.ls.com',
	'COOKIE_PATH'   => '/',

	'VERSION'		=> '1.0.0',

	'SMS_URL'		=> 'http://api.12349.loukou.com/Sms/sendMsg',
	'QR_URL'		=> 'http://api.12349.loukou.com/qrcode.php',
	'SECRECT_CODE'  => 'g8c,D3!M&s.tt@#$&^',
);

