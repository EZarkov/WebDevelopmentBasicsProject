

<?php
	// simple logout
	session_start();
	$_SESSION["admin_id"] = null;
	$_SESSION["username"] = null;
	redirect_to("login.php");
?>
