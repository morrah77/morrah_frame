<?php
class request{
	public $params,$get,$post,$request;/*Параметры из url вида http://example.com/controller/method/params[0]/params[1]...
	URL parameters as http://example.com/controller/method/params[0]/params[1]... */
	public function __construct($params = null){
		global $GLOBALS;
		$this->params = array_merge((array)$GLOBALS['_POST'],(array)$GLOBALS['_GET'],(array)$GLOBALS['_REQUEST']);
		$this->get = (array)$GLOBALS['_GET'];
		$this->post = (array)$GLOBALS['_POST'];
		$this->request = (array)$GLOBALS['_REQUEST'];
	}
}
?>