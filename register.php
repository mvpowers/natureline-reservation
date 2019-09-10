<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background-color: #f9f9fa;
		}
	</style>
</head>
<body>

	<?php

		if(isset($_POST['submit'])){
			require 'process-register.php';
		}

		function input($fieldName){

				if (isset($_POST[$fieldName])) {
					
					echo $_POST[$fieldName];
				}
		}
	?>
<h3>register</h3>
<form action="register.php" method="post">
		<label for="user_name">username:</label><input type="text" name="user_name" id="user_name" value="<?php input('user_name')?>" required pattern="[a-zA-Z][a-zA-Z\s]*" title="Alphabetic and space only max of 30 characters" maxlength="30"><br><br>

		<label for="email">email:</label><input type="email" name="email" id="email" required value="<?php input('email')?>" maxlength="60"><br><br>
		<label for="phone">phone:</label><input type="tel" name="phone" id="phone" required maxlength="30" value="<?php input('phone')?>"><br><br>
		<label for="password1">password:</label><input type="password" name="password1" id="password1" required><br><br>
		<label for="password2">re-type password:</label><input type="password" name="password2" id="password2" required><br><br>
		<input type="submit" name="submit" value="register">
	</form>
</body>
</html>