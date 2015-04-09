<?php
class url{
	public $segments,$params;
	public function __construct($request=null){
		global $conf;
		if(!($request)){
			global $_SERVER;
			$request = $_SERVER['REQUEST_URI'];
		}
			//var_dump(preg_replace('/\\+/i','/',$request));
		$segments = explode('/',preg_replace('/\\+/i','/',substr($request,0,strpos($request,'?')?strpos($request,'?'):strlen($request))));
		/*echo __CLASS__ . ': \$request= ';
		var_dump($request);
		echo ' (';var_dump(preg_replace('/\\+/i','/',substr($request,0,strpos($request,'?')?strpos($request,'?'):strlen($request))));echo '), ';
		echo '\$segments = ';
		var_dump($segments);
		echo '<br />';*/
		if(is_array($segments)){
			foreach($segments as $k=>$v){
				if(trim($v)!=''){
					$this->segments[] = $segments[$k];
				}
			}
			foreach($this->segments as $k=>$v){
				if(($k!=$conf['controllerIndex'])&&($k!=$conf['methodIndex'])){
					$this->params[] = $this->segments[$k];
				}
			}
		}
		else{
			$this->segments = array();
		}
	}
	public function getSegment($index){
		return isset($this->segments[$index])?$this->segments[$index]:null;
	}
	public function setSegment($index,$val){
		$this->segments[$index]=$val;
	}
	public function unsetSegment($index,$val){
		unset($this->segments[$index]);
	}
}
?>