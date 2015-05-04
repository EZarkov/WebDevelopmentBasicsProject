<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 13:55
 */
namespace MVC\Routers;
class DefaultRouter implements IRouter {
	private $_controller = null;
	private $_method = null;
	private $_params = array();

	/**
	 * Parse uri
	 */
	public function getURI() {
		return substr($_SERVER['PHP_SELF'], strlen($_SERVER['SCRIPT_NAME']) + 1);
	}

	public function getPost() {
		return $_POST;
	}
}