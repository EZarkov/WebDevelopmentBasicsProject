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
	 * @param $configFolder
	 * @throws \Exception
	 */
	public function setConfigFolder($configFolder) {
		if (!$configFolder) {
			throw new \Exception ('Empty config folder path.');
		}
		$_configFolder = realpath($configFolder);
		if ($_configFolder != false && is_dir($_configFolder) && is_readable($_configFolder)){
			//clear old configs
			$this->_configArray = array();
			$this->_configFolder = $_configFolder . DIRECTORY_SEPARATOR;
		} else {
			throw new \Exception ('Config directory read error: ' . $configFolder);
		}
		echo $this->_configFolder;
	}

	public function __get($name){
		if (!$this->_configArray[$name]){
			$this->includeConfigFile($this->_configFolder . $name . '.php');
		}
		if (array_key_exists($name, $this->_configArray)){
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