<?php include("header.php"); ?>

<main>
  
    <div id="container">  
		<h2>Admin Page</h2>
		<p>
			Welcome to the admin area, <?php echo htmlentities($_SESSION["username"]); ?>.
		</p>
		
		<ul>
		    <li><a href="manage_content.php">Forum Content</a></li>
		    <li><a href="manage_users.php">Users</a></li>
		    <li><a href="manage_usergroups.php">User Groups</a></li>
		    <li><a href="manage_settings.php">Settings</a></li>		    		    
		    <li><a href="logout.php">Logout</a></li>
		</ul>

		
    </div>
</main>

<?php include("footer.php"); ?>
