<?
define(DEBUG,0);/*debug mode*/
if(DEBUG){
	ob_start();
	echo '<b>__FILE__:</b> ';
	echo __FILE__;
	echo '<br />';
	echo '<b>\$_SERVER:</b> ';
	var_dump($_SERVER);
	echo '<br />';
	echo '<b>\$_GET:</b> ';
	var_dump($_GET);
	echo '<br />';
	echo '<b>\$_POST:</b> ';
	var_dump($_POST);
	echo '<br />';
	echo '<b>\$_FILES:</b> ';
	var_dump($_FILES);
	echo '<br />';
	echo '<b>\$_REQUEST:</b> ';
	var_dump($_REQUEST);
	echo '<br />';
	echo '<b>\$_SESSION:</b> ';
	var_dump($_SESSION);
	echo '<br />';
	echo '<b>\$_ENV:</b> ';
	var_dump($_ENV);
	echo '<br />';
	echo '<b>\$_GLOBALS:</b> ';
	var_dump($GLOBALS);
	echo '<br />';
	$debug_info = ob_get_contents();
	ob_end_clean();
}
define(ROOT_DIR,dirname(__FILE__));
require_once(ROOT_DIR.'/conf/conf.php');
require_once(SYS_DIR.'/application.php');
$app = Application::getInstance();
//$app->request = $_SERVER['REQUEST_URI'];
//$app->url = new url($app->request);
if((is_dir(SYS_INCLUDE_DIR))&&($handler = opendir(SYS_INCLUDE_DIR))){
	while(($filename = readdir($handler)) != false){
		if((is_file(SYS_INCLUDE_DIR.'/'.$filename))&&(substr($filename,strrpos($filename,'.'))=='.php')){
			require_once(SYS_INCLUDE_DIR.'/'.$filename);
			$classname = substr($filename,0,strrpos($filename,'.'));
			if(class_exists($classname)){
				$app->$classname = new $classname;
			}
		}
	}
}
/*or this way:
Или так:
spl_autoload_register(function ($class) {
    require_once(SYS_INCLUDE_DIR.'/'.strtolower($class).'.php');
	...
});*/
if((is_dir(APP_INCLUDE_DIR))&&($handler = opendir(APP_INCLUDE_DIR))){
	while(($filename = readdir($handler)) != false){
		if((is_file(APP_INCLUDE_DIR.'/'.$filename))&&(substr($filename,strrpos($filename,'.'))=='.php')){
			require_once(APP_INCLUDE_DIR.'/'.$filename);
		}
	}
}

switch($app->url->segments[$conf['controllerIndex']]){
	case '':
	case null:
		require_once(APP_CONTROLLERS_DIR.'/'.APP_DEFAULT_CONTROLLER.'.php');
		$adk=APP_DEFAULT_CONTROLLER;
		$app->controller = new $adk;
		$app->method = APP_DEFAULT_METHOD;
		break;
	default:
		if(file_exists(APP_CONTROLLERS_DIR.'/'.$app->url->segments[$conf['controllerIndex']].'.php')){
			require_once(APP_CONTROLLERS_DIR.'/'.$app->url->segments[$conf['controllerIndex']].'.php');
			$app->controller = new $app->url->segments[$conf['controllerIndex']];
			$app->method = !empty($app->url->segments[$conf['methodIndex']])?$app->url->segments[$conf['methodIndex']]:APP_DEFAULT_METHOD;
		}
		else{
			if(file_exists(PAGE_404)){
				header("HTTP/1.0 404 Not Found");
				ob_start();
				include PAGE_404;
				$output = ob_get_contents();
				ob_end_clean();
				$app->show($output);
				
			}
			else{
				require_once(APP_CONTROLLERS_DIR.'/'.APP_DEFAULT_CONTROLLER.'.php');
				$adk=APP_DEFAULT_CONTROLLER;
				$app->controller = new $adk;
				$app->method = APP_DEFAULT_METHOD;
				echo 'not found';
			}
		}
		
		break;
}
$app->show(array('url_segments'=>$app->url->segments, 'url_params'=>$app->url->params, 'request_params'=>$app->request->params, 'coreclass_params'=>$app->coreclass->params, 'controller_response'=>$app->controller->{$app->method}()) );
?>