<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 02.05.15
 * Time: 19:40
 */
namespace GF\Session;
interface ISession {
	public function getSessionI();
	public function saveSessionI();
	public function destroySessionI();

	public function __get($name);
	public function __set($name, $value);



}