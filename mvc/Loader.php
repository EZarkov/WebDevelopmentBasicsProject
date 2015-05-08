<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 23.04.15
 * Time: 15:10
 */

namespace MVC;


final class Loader {
	private static $namespaces = array();

	private function __construct() {

	}

	public static function registerAutoload() {
		spl_autoload_register(array('\MVC\Loader', 'autoload'));
	}

	public static function autoload($class) {

		self::loadClass($class);
	}

	/**
	 * @param $class
	 * @throws \Exception
	 */
	public static function loadClass($class) {
		foreach (self::$namespaces as $key => $value) {
			if (strpos($class, $key) === 0) {
				$file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
				$file = substr_replace($file, $value, 0, strlen($key)) . '.php';
				$file = realpath($file);
				if ($file && is_readable($file)) {
					include $file;
				} else {
					throw new \Exception ('File cannot be included: ' . $file);
				}
				break;
			}
		}
	}

	public static function registerNamespace($namespace, $path) {
		$namespace = trim($namespace);
		if (strlen($namespace) > 0) {
			if (!$path) {
				throw new \Exception ('Invalid path');
			}
			$_path = realpath($path);
			if ($_path && is_dir($_path) && is_readable($_path)) {
				self::$namespaces[$namespace . '\\'] = $_path . DIRECTORY_SEPARATOR;
			} else {
				//TODO
				throw new \Exception ('Namespace directory read error: ' . $path);
			}
		} else {
			//TODO
			throw new \Exception ('Invalid namespace ' . $namespace);
		}
	}

	public static function registerNamespaces($ns) {
		if (is_array($ns)) {
			foreach ($ns as $key => $value) {
				self::registerNamespace($key, $value);
			}
		} else {
			throw new \Exception('Invalid namespace');
		}
	}

	public static function getNamespaces() {
		return self::$namespaces;
	}

	public static function removeNamespace($namespace) {
		unset (self::$namespaces[$namespace . '\\']);
	}

	public static function clearNamespaces() {
		self::$namespaces = array();
	}
}