<!DOCTYPE html>
<html>
<head lang="en">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/header-styles.css">
	<link rel="stylesheet" type="text/css" href="styles/nav-styles.css">
	<link rel="stylesheet" type="text/css" href="styles/main-style.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<title><?php echo $this->title; ?></title>
</head>
<body>

<header>
	<div id="head-content">
		<div id="logo">
			<a href="#"><img src="images/samplelogo.png"></a>

			<h3>Dev's Forum</h3>
		</div>
		<div id="head-login">
			<form method="post">
				<label></label>
				<input type="text" name="username" id="username">
				<input type="password" name="password" id="password">
				<input type="submit" name="submit" id="submit" value="Login">
				<br>
				<span><a href="#">Регистрация</a></span>
				<span><a href="#">Забравена парола</a></span>
			</form>

		</div>
	</div>
</header>

	<?php echo $this->getLayoutData('body'); ?>
	<footer>
		<div id="foot-content">
			&copy; Copyright <?php echo date("Y"); ?>, ME"
		</div>
	</footer>

</body>
</html>
