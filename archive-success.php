<?php
	
	ini_set("session.cookie_lifetime", 3600 );
	session_start();

	$user_name = $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
	$user_level = $_SESSION['user_level'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<header>
		<?php
			require './include/header-admin.php';
		?>
	</header>

	<h1>archive successful</h1>
</body>
</html>