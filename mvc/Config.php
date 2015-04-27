<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 23.04.15
 * Time: 16:53
 */

namespace GF;


class Config {

	private static $_instance = null;
	private $_configArray = array();
	private $_configFolder = null;

	private function __construct() {
	}

	/**
	 * @return null
	 */
	public function getConfigFolder() {
		return $this->_configFolder;
	}

	/**
	 * @param $configFolder
	 * @throws \Exception
	 */
	public function setConfigFolder($configFolder) {
		if (!$configFolder) {
			throw new \Exception ('Empty config folder path.');
		}
		$_configFolder = realpath($configFolder);
		if ($_configFolder != false && is_dir($_configFolder) && is_readable($_configFolder)) {
			//clear old configs
			$this->_configArray = array();
			$this->_configFolder = $_configFolder . DIRECTORY_SEPARATOR;
			$ns = $this->app['namespaces'];
			if (is_array($ns)) {
				\GF\Loader::registerNamespaces($ns);
			}
		} else {
			throw new \Exception ('Config directory read error: ' . $configFolder);
		}
	}

	/**
	 * @param $path
	 * @throws \Exception
	 */
	public function includeConfigFile($path) {
		if (!$path) {
			//TODO
			throw new \Exception ('Invalid path');
		}
		$_file = realpath($path);
		if ($_file != false && is_file($_file) && is_readable($_file)) {
			$_basename = explode('.php', basename($_file))[0];
			$this->_configArray[$_basename] = include $_file;
		} else {
			//TODO
			throw new \Exception ('Config file read error: ' . $path);
		}
	}

	/**
	 * @param $name
	 * @return null
	 */
	public function __get($name) {
		if (!$this->_configArray[$name]) {
			$this->includeConfigFile($this->_configFolder . $name . '.php');
		}
		if (array_key_exists($name, $this->_configArray)) {
			return $this->_configArray[$name];
		}

		return null;
	}

	/**
	 * @return Config|null
	 */
	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new \GF\Config();
		}

		return self::$_instance;
	}
}