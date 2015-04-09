<?php
final class Application{
	/*Classic 'Singleton'
	Классический 'Одиночка'*/
	public static $instance;
	public $url;
	public $request;
	public $controller;
	public $method;
	public $params;
	public $headers;
	public static function getInstance(){
		if(!(self::$instance instanceof self)){
			self::$instance = new self;
		}
		return self::$instance;
	}
	private function __construct(){}
	private function __clone(){}
	private function __sleep(){}
	private function __wakeup(){}
	public static function show($output){
		global $debug_info;
		if(!empty($debug_info)){
			echo $debug_info;
		}
		var_dump($output);
		exit;
	}
	public static function redirect($path){
		header('Location: http://'.HOST.'/'.$path); 
		exit;
	}
}
?>