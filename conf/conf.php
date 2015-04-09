<?php
$conf = array(
	'controllerIndex' => 0,/*which segment of url defines controller*/
	'methodIndex' => 1 /*which segment of url defines method*/
);
define(APP_DIR,'app');/*application scripts directory*/
define(SYS_DIR,'sys');/*system scripts directory*/
define(APP_INCLUDE_DIR,ROOT_DIR.'/'.APP_DIR.'/include');/*application includes directory*/
define(APP_CONTROLLERS_DIR,ROOT_DIR.'/'.APP_DIR.'/controller');/*application controllers directory*/
define(SYS_INCLUDE_DIR,ROOT_DIR.'/'.SYS_DIR.'/include');/*system core scripts directory*/
define(APP_DEFAULT_CONTROLLER,'main');
define(APP_DEFAULT_METHOD,'index');
define(HOST,$_SERVER['HTTP_HOST']);
define(PAGE_404,APP_DIR.'/404.php')
?>