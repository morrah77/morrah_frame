<?php
class main extends controller {
	public function index($params=array()){
		parent::index();
		return array('params'=>$this->params,'request'=>$this->app->request->request,'class'=>__CLASS__,'method'=>__METHOD__);
	}
	public function param($index=0){
		parent::param();
		return array('params'=>$this->params[$index],'request'=>$this->app->request->request,'class'=>__CLASS__,'method'=>__METHOD__);
	}
}
?>