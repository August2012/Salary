<?php
require 'vender/session/class.session.php';
require 'vender/flight/Flight.php';
require 'vender/medoo/medoo.min.php';

// 定义默认配置变量
$conf = include('conf/conf.php');
foreach ($conf as $key => $value) {
	if(!Flight::has($key)) {
		Flight::set(strtoupper($key), $value);
	}
}

// 修改默认配置
// 覆盖base url 请求
Flight::set('flight.base_url ', Flight::get('SITE_URL'));
// 允许 Flight 处理所有内部错误。 (默认: true)
Flight::set('flight.handle_errors ', true);
// 将错误日志记录到 web server 的错误日志文件。 (默认: false)
Flight::set('flight.log_errors', true);
// 包含视图模板文件的目录 (默认: ./views)
Flight::set('flight.views.path', './view');

// 添加半自动类路径
Flight::path(dirname(__FILE__).'/controller');

// 定义路径
define('ROOT_PATH', dirname(__FILE__));
define('VIEW_PATH', dirname(__FILE__).'/view');
define('CORE_PATH', dirname(__FILE__).'/core');
define('VENDER_PATH', dirname(__FILE__).'/vender');
define('LOG_PATH', dirname(__FILE__).'/log');
define('CONF_PATH', dirname(__FILE__).'/conf');
define('FILE_PATH', dirname(__FILE__).'/files');

// start session
Session::init();

// 加载核心公用方法
require CORE_PATH.'/core.php';
// 加载模板引擎相关方法
require CORE_PATH.'/view.php';
// 加载路由及行为控制解析
require CORE_PATH.'/router.php';

Flight::start();
?>
