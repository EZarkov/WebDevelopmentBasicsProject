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
	private $__viewPath = null;
	private $__viewDir = null;
	private $__data = array();
	private $__extention = '.php';
	private $__layoutParts = array();
	private $__layoutData = array();


	private function __construct() {
		$this->__viewPath = \MVC\App::getInstance()->getConfig()->app['viewsDirectory'];
		if ($this->__viewPath == null) {
			$this->__viewPath = realpath('../views/');
		}
	}

	public function setViewDirectory($path) {
		$path = trim($path);
		if ($path) {
			$path = realpath($path) . DIRECTORY_SEPARATOR;
			if (is_dir($path) && is_readable($path)) {
				$this->__viewDir = $path;
			} else {
				throw new \Exception ('Invalid view path');
			}
		} else {
			//TODO
			throw new \Exception('Invalid view path', 500);
		}

	}

	public function display($name, $data = array(), $returnAsString = false) {
		if (is_array($data)) {
			$this->__data = array_merge($this->__data, $data);
		}
		if (count($this->__layoutParts) > 0) {
			foreach ($this->__layoutParts as $key => $value) {
				$part = $this->_includeFile($value);

				if ($part) {
					$this->__layoutData[$key] = $part;
				}
			}


		}

		if ($returnAsString) {
			return $this->_includeFile($name);
		} else {
			echo $this->_includeFile($name);
		}
	}

	public function appendToLayout($key, $template) {
		if ($key && $template) {
			$this->__layoutParts[$key] = $template;

		} else {
			throw new \Exception('Layout require valid key and template.', 500);
		}
	}

	public function getLayoutData($name) {

		return $this->__layoutData[$name];
	}


	private function _includeFile($file) {
		if ($this->__viewDir == null) {
			$this->setViewDirectory($this->__viewPath);
		}

		$includeViewFile = $this->__viewDir . str_replace('\\', DIRECTORY_SEPARATOR, $file) . $this->__extention;
		if (file_exists($includeViewFile) && is_readable($includeViewFile)) {

			ob_start();
			/** @var TYPE_NAME $includeViewFile */
			include $includeViewFile;

			return ob_get_clean();
		} else {
			throw new \Exception ('View ' . $file . ' cannot be included', 500);
		}
	}

	function __get($name) {
		return $this->__data[$name];
	}

	function __set($name, $value) {
		$this->__data[$name] = $value;
	}


	/**
	 * @return \MVC\View
	 */
	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new \MVC\View();
		}

		return self::$_instance;
	}
}