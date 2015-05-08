<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 05.05.15
 * Time: 16:33
 */

namespace Models;



class Storage_Abstract {
	/**
	 * @var Validation
	 */
	protected static $validate;
	/**
	 * @var \MVC\DB\SimpleDB
	 */
	protected static $db;


	public static function setDbAdapter($adapter) {
		self::$db = $adapter;
	}
	public static function setValidator($validate) {
		self::$validate =  $validate;
	}
}