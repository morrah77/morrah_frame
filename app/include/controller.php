<?php
class controller{
	public $params,$app;
	public function __construct(){
		$this->app = Application::getInstance();
		$this->params = $this->app->url->params;
	}
	public function index($params=array()){
		$params=(array)$params;
		if(count($params)){
			$this->params = $params;
		}
	}
	public function param($index=0){
		$params=(array)$params;
		if(count($params)){
			$this->params = $params;
		}
	}
}
?>