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
	<title></title>
	<link rel="stylesheet" type="text/css" href="./css/custom.css">
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

<section>
	<?php
		if (isset($_GET['view-record']) and $_GET['view-record'] == true) {
				require 'process-view-bookings.php';
			}
	?>
</section>
</body>
</html>