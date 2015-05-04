<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 03.05.15
 * Time: 18:41
 */

namespace MVC\Routers;


use MVC\App;

class JsonRPCRouter implements IRouter {
	private $_map = array();
	private $_requestId ;

	public function __construct() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST'
			|| empty($_SERVER['CONTENT_TYPE'])
			|| $_SERVER['CONTENT_TYPE'] != 'application/json'
		) {
			throw new \Exception ('Require json request', 400);
		};
	}

	public function setMethodsMap ($array) {
		if (is_array($array)) {
			$this->_map = $array;
		}
	}

	public function getURI() {
		if (!is_array($this->_map) || count($this->_map) == 0){
			$array = App::getInstance()->getConfig()->rpcRouters;
			if (is_array($array)) {
				$this->_map = $array;
			} else {
				throw new \Exception('Router require method map.', 500);
			}
		}
		$request = json_decode(file_get_contents('php://input'), true);
		if (!is_array($request || !isset($request['method']))) {
			throw new \Exception('Require json request.', 400);
		}
		if(!$this->_map[$request['method']]){
			throw new \Exception ('Method not found.', 501);
					}
		$this->_requestId = $request['id'];
		return $this->_map[$request['method']];
	}
}