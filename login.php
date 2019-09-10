<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
	<header>
		<a href="register.php">register</a>
	</header>

	<?php

		if (isset($_POST['submit'])) {
			require ('process-login.php');
		}

		function input($fieldValue){

				if (isset($_POST[$fieldValue])) {
					
					echo $_POST[$fieldValue];
				}
		}
	?>

<h1>login </h1>
<form action="login.php" method="post">
	<input type="email" name="email" placeholder="email" value="<?php input('email') ?>">
	<input type="password" name="password" placeholder="password" value="<?php input('password') ?>">
	<input type="submit" name="submit" value="submit">
</form>
</body>
</html>