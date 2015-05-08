<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 05.05.15
 * Time: 15:42
 */

namespace Models;



class Storage_Users  extends Storage_Abstract{



	public static function registerUser($name, $pass, $email) {

		self::$validate->setRule('minLength', $name, 5)->setRule('minLength', $pass, 6)->setRule('email', $email);
		self::$validate->validate();
		if (self::$validate->validate()) {
			$data = self::$db->prepare('INSERT INTO `users`  (`user`,`password`, `email`,`registration_date`) VALUES (?,?,?, NOW()) ', array($name, $pass, $email))->execute()->getLstInsertId();

			return $data;
		} else {
			return false;
		}

	}

	public static function loginUser($name, $pass){

		$user = self::$db ->prepare('SELECT `password`, `id` FROM users WHERE `user` = ?', array($name))->execute()->fetchRowAssoc();
		var_dump($user);
		if ($user['password'] == $pass){
			echo 'here';
			return $user['id'];
		}
		return false;
}


}