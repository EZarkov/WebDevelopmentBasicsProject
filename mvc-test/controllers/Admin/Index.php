<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 16:04
 */

namespace Controllers\Admin;

use Controllers\DefaultController;

class Index extends DefaultController{
	public function main() {
		echo "Raboti";

	}

	public function user (){
		echo 'user';
	}
}