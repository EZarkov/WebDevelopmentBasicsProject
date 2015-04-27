<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 13:40
 */

namespace GF;


class FrontController {
	private static $_instance = null;

	private function __construct(){

	}

	public function dispatch(){
		$a = new Routers\DefaultRouter();
		$a->parse();
	}

	/**
	 * @return \GF\FrontController
	 */
	public static function getInstance(){
		if (self::$_instance == null){
			self::$_instance = new \GF\FrontController();
		}
		return self::$_instance;
	}
}