<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 02.05.15
 * Time: 19:40
 */
namespace GF\Session;
interface ISession {
	public function getSessionID();
	public function saveSession();
	public function destroySession();

	public function __get($name);
	public function __set($name, $value);



}