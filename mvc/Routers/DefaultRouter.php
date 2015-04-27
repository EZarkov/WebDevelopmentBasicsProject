<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 13:55
 */
namespace GF\Routers;
class DefaultRouter {
	private $_controller = null;
	private $_method = null;
	private $_params = array();

	/**
	 * Parse uri
	 */
	public function parse() {
		$_uri = substr($_SERVER['PHP_SELF'], strlen($_SERVER['SCRIPT_NAME']) + 1);

		$params = explode('/', $_uri);
		if ($params[0]) {
			$this->_controller .= ucfirst($params[0]);

			if ($params[1]) {
				$this->_method = $params[1];
				unset ($params[0], $params[1]);
				$this->_params = array_values($params);
			}
		}
	}

	/**
	 * @return null
	 */
	public function getController() {
		return $this->_controller;
	}

	/**
	 * @return null
	 */
	public function getMethod() {
		return $this->_method;
	}

	/**
	 * @return array
	 */
	public function getParams() {
		return $this->_params;
	}
}