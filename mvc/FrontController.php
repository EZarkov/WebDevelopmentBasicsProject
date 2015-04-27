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

	private function __construct() {

	}

	public function dispatch() {
		$a = new Routers\DefaultRouter();
		$a->getURI();

	}

	public function getDefaultControler() {
		$controller = \GF\App::getInstance()->getConfig()->app['default_controller'];
		if ($controller) {
			return $controller;
		}

		return 'Index';
	}

	public function getDefaultMethod() {
		$method = \GF\App::getInstance()->getConfig()->app['default_method'];
		if ($method) {
			return $method;
		}

		return 'index';
	}

	/**
	 * @return \GF\FrontController
	 */
	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new \GF\FrontController();
		}

		return self::$_instance;
	}
}