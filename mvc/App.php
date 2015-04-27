<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 23.04.15
 * Time: 14:42
 */
namespace GF;
include_once 'Loader.php';
class App {
	private static $_instance = null;

	private function __construct(){
		Loader::registerNamespace('GF', dirname(__FILE__).DIRECTORY_SEPARATOR);
		Loader::registerAutoload();
	}
	public function run() {

	}
	/**
	 * @return \GF\App
	 */
	public static function getInstance(){
		if (self::$_instance == null){
			self::$_instance = new \GF\App();
		}
		return self::$_instance;
	}
}