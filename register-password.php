<?php
	ini_set("session.cookie_lifetime", 3600 );
	session_start();
	if (!isset($_SESSION['user_level'])) {
		header("location: login.php");
		exit();
	}

	$user_name = $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>change password</title>
</head>
<body>

<header>
	<?php

		if ($_SESSION['user_level'] == 1) {
			require './include/header-admin.php';
		}

		if ($_SESSION['user_level'] == 0) {
			require './include/header-members.php';
		}

	?>
</header>


<?php
		require './include/url.php';
		if (isset($_POST['submit'])) {
			require 'process-change-password.php';
		}
?>
<form action="<?php echo $url?>" method = "post">
	<input type="password" name="password" id="password" placeholder="old password"><br>
	<input type="password" name="password1" id="password1" placeholder="new password"><br>
	<input type="password" name="password2" id="password2" placeholder="retype password"><br>
	<input type="submit" name="submit" id="submit" value="submit">
</form>
</body>
</html>