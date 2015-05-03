<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 02.05.15
 * Time: 19:44
 */

namespace MVC\Session;


class NativeSession implements ISession {


	/**
	 * @param $name
	 * @param int $lifetime
	 * @param null $path
	 * @param null $domain
	 * @param bool $secure
	 */
	public function __construct($name, $lifetime = 3600, $path = null, $domain = null, $secure = false) {
		if (strlen($name) < 1) {
			$name = '_sess';
		}
		session_name($name);
		session_set_cookie_params($lifetime, $path, $domain, $secure, true); // 5 - param is set at true to prevent js accses  to cookies
		session_start();

	}

	public function __get($name) {

		return $_SESSION[$name];
	}

	public function __set($name, $value) {
		$_SESSION[$name] = $value;
	}

	public function destroySession() {
		session_destroy();
	}

	public function getSessionID() {
		// TODO: Implement getSessionI() method.
	}

	public function saveSession() {
		// TODO: Implement saveSessionI() method.
	}

}