<?php
	
	ini_set("session.cookie_lifetime", 3600 );
	session_start();
	if (!isset($_SESSION['user_level']) or $_SESSION['user_level'] != 1) {
		header("location: login.php");
		exit();
	}

	$user_name = $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
	$user_level = $_SESSION['user_level'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>admin page</title>
	<link rel="stylesheet" type="text/css" href="./css/custom.css">
</head>
<body>

	<header>
		<?php
			require './include/header-admin.php';
		?>
	</header>

	<section>
		<h1>welcome to admin page</h1>
		<?php
			require 'include/search-form.php';
		?>
	</section>

</body>
</html>