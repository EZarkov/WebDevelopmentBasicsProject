<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 03.05.15
 * Time: 15:51
 */

namespace MVC;


class View {
	private static $_instance = null;

	private function __construct() {
		$this->viewPath =1;
	}

	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new \MVC\View();
		}

		return self::$_instance;
	}
}