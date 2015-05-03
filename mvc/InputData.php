<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 01.05.15
 * Time: 16:11
 */

namespace MVC;


class InputData {
	private static $_instance = null;
	private $_get = array();
	private $_post = array();
	private $_cookies = array();

	function __construct() {
		$this->_cookies = $_COOKIE;
	}

	/**
	 * @return array
	 */
	public function getGet() {
		return $this->_get;
	}

	/**
	 * @param array $get
	 */
	public function setGet($get) {
		if (is_array($get)) {
			$this->_get = $get;
		}
	}

	/**
	 * @return array
	 */
	public function getPost() {
		return $this->_post;
	}

	/**
	 * @param array $post
	 */
	public function setPost($post) {
		if (is_array($post)) {
			$this->_post = $post;
		}
	}

	/**
	 * @param $id
	 * @return bool
	 */
	public function hasGet($id) {
		return array_key_exists($id, $this->_get);
	}

	public function hasPost($key) {
		return array_key_exists($key, $this->_post);
	}

	public function hasCookie($name) {
		return array_key_exists($name, $this->_cookies);

	}

	public function get($id, $normalize = null, $default = null) {
		if ($this->hasGet($id)) {
			if ($normalize != null) {
				return \MVC\Common::normalize($this->_get[$id], $normalize);
			}

			return $this->_get[$id];
		}

		return $default;
	}

	public function post($key, $normalize = null, $default = null) {
		if ($this->hasGet($key)) {
			if ($normalize != null) {
				return \MVC\Common::normalize($this->_post[$key], $normalize);
			}

			return $this->_post[$key];
		}

		return $default;
	}

	public function cookies($name, $normalize = null, $default = null) {
		if ($this->hasCookie($name)) {
			if ($normalize != null) {
				return \MVC\Common::normalize($this->_cookies[$name], $normalize);
			}

			return $this->_cookies[$name];
		}

		return $default;
	}

	/**
	 * @return InputData|null
	 */
	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new InputData();
		}

		return self::$_instance;
	}

}