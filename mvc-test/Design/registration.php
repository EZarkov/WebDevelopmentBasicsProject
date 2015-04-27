<?php include("header.php"); ?>

<main>

<form id='register' action='registration.php' method='post'>
	<fieldset >
	<legend>Register</legend>
		<input type='hidden' name='submitted' id='submitted' value='1'/>

		<label for='name' >Your Full Name*:</label>
		<input type='text' name='name' id='name' required />

		<label for='email' >Email Address*:</label>
		<input type='text' name='email' id='email' required />
		 
		<label for='username' >UserName*:</label>
		<input type='text' name='username' id='username' required />
		 
		<label for='password1' >Password*:</label>
		<input type='password' name='password1' id='password1' required />

		<label for='password2'>Confirm Password*:</label>
		<input type="password" name="password2" id='password2' required />
				
		<input type='submit' name='submit' value='Register' />
	 
	</fieldset>
</form>

</main>

<?php include("footer.php"); ?>
